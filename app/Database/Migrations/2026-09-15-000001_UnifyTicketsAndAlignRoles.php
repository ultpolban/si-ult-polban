<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * =====================================================================
 * 2026-09-15 - Unifikasi Data Tiket & Penyelarasan Role
 * =====================================================================
 *
 * Tujuan:
 *  1. Menjadikan tabel `tickets` sebagai sumber data utama (canonical)
 *     pengajuan layanan. Data lama dari `service_requests` dimigrasikan
 *     ke `tickets`, lalu relasi foreign key pada:
 *        - service_request_logs
 *        - service_request_files
 *        - notifications
 *     diarahkan ulang ke tabel `tickets`.
 *     Tabel `service_requests` kemudian dihapus (legacy).
 *
 *  2. Menyelaraskan master role agar konsisten dengan permission:
 *     menambahkan role PETUGAS_ULT, UNIT_TUJUAN, dan PIMPINAN yang
 *     selama ini sudah direferensikan pada RolePermissionSeeder,
 *     serta menonaktifkan role lama (PETUGAS_AKADEMIK /
 *     PETUGAS_KEUANGAN / PETUGAS_UMUM) yang tidak memiliki permission.
 */
class UnifyTicketsAndAlignRoles extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        // -------------------------------------------------------------
        // 0. Matikan pemeriksaan foreign key selama proses migrasi
        // -------------------------------------------------------------
        $db->query('SET FOREIGN_KEY_CHECKS=0');

        try {
            // ---------------------------------------------------------
            // 1. Migrasi data dari service_requests ke tickets
            // ---------------------------------------------------------
            $hasOldTable = $db->tableExists('service_requests');

            if ($hasOldTable) {
                $requests = $db->table('service_requests')->get()->getResultArray();
                $mapping  = [];

                foreach ($requests as $req) {
                    $oldId = (int) $req['id'];

                    // Cegah duplikat bila nomor tiket sudah ada di tickets
                    $existing = $db->table('tickets')
                        ->where('ticket_number', $req['ticket_number'])
                        ->get()
                        ->getRowArray();

                    if ($existing) {
                        $mapping[$oldId] = (int) $existing['id'];
                        continue;
                    }

                    unset($req['id']);

                    $db->table('tickets')->insert($req);
                    $mapping[$oldId] = (int) $db->insertID();
                }

                // -----------------------------------------------------
                // 2. Arahkan ulang referensi foreign key
                // -----------------------------------------------------
                $this->dropForeignKeyOnColumn($db, 'service_request_logs', 'service_request_id', 'service_request_logs_service_request_id_foreign');
                $this->dropForeignKeyOnColumn($db, 'service_request_files', 'service_request_id', 'service_request_files_service_request_id_foreign');
                $this->dropForeignKeyOnColumn($db, 'notifications', 'service_request_id', 'notifications_service_request_id_foreign');

                foreach ($mapping as $oldId => $newId) {
                    $db->table('service_request_logs')
                        ->where('service_request_id', $oldId)
                        ->update(['service_request_id' => $newId]);

                    $db->table('service_request_files')
                        ->where('service_request_id', $oldId)
                        ->update(['service_request_id' => $newId]);

                    $db->table('notifications')
                        ->where('service_request_id', $oldId)
                        ->update(['service_request_id' => $newId]);
                }

                // 3. Tambahkan kembali foreign key ke tabel tickets (guard: hanya bila belum ada)
                $this->addForeignKeyIfMissing(
                    $db,
                    'service_request_logs',
                    'service_request_id',
                    'tickets',
                    'service_request_logs_service_request_id_foreign',
                    'CASCADE',
                    'CASCADE'
                );

                $this->addForeignKeyIfMissing(
                    $db,
                    'service_request_files',
                    'service_request_id',
                    'tickets',
                    'service_request_files_service_request_id_foreign',
                    'CASCADE',
                    'CASCADE'
                );

                $this->addForeignKeyIfMissing(
                    $db,
                    'notifications',
                    'service_request_id',
                    'tickets',
                    'notifications_service_request_id_foreign',
                    'CASCADE',
                    'CASCADE'
                );

                // 4. Hapus tabel legacy
                $db->query('DROP TABLE IF EXISTS `service_requests`');
            }
        } catch (\Throwable $e) {
            $db->query('SET FOREIGN_KEY_CHECKS=1');
            throw $e;
        }

        // -------------------------------------------------------------
        // 5. Penyelarasan role (diselaraskan dengan RolePermissionSeeder)
        // -------------------------------------------------------------
        $roles = $db->table('roles');
        $now   = date('Y-m-d H:i:s');

        $canonicalRoles = [
            'PETUGAS_ULT' => ['Petugas ULT', 'Memverifikasi dan memproses layanan Unit Layanan Terpadu.', 3],
            'UNIT_TUJUAN' => ['Unit Tujuan', 'Unit layanan tujuan yang menindaklanjuti tiket.', 4],
            'PIMPINAN'    => ['Pimpinan', 'Melihat laporan dan statistik layanan.', 5],
        ];

        foreach ($canonicalRoles as $code => [$name, $description, $sort]) {
            $found = $roles->where('code', $code)->get()->getRowArray();

            $data = [
                'name'        => $name,
                'description' => $description,
                'sort_order'  => $sort,
                'is_active'   => 1,
                'updated_at'  => $now,
            ];

            if ($found) {
                $roles->where('id', $found['id'])->update($data);
            } else {
                $data['code']       = $code;
                $data['created_at'] = $now;
                $roles->insert($data);
            }
        }

        // Role lama hasil seeder awal yang tidak memiliki permission
        // dipindahkan penggunanya ke PETUGAS_ULT lalu dinonaktifkan.
        $legacyCodes = ['PETUGAS_AKADEMIK', 'PETUGAS_KEUANGAN', 'PETUGAS_UMUM'];

        $petugasUlt = $roles->where('code', 'PETUGAS_ULT')->get()->getRowArray();

        if ($petugasUlt) {
            foreach ($legacyCodes as $legacyCode) {
                $legacy = $roles->where('code', $legacyCode)->get()->getRowArray();

                if (! $legacy) {
                    continue;
                }

                $db->table('users')
                    ->where('role_id', $legacy['id'])
                    ->set('role_id', $petugasUlt['id'])
                    ->update();

                $roles->where('id', $legacy['id'])->update([
                    'is_active'  => 0,
                    'sort_order' => 99,
                    'updated_at' => $now,
                ]);
            }
        }

        // -------------------------------------------------------------
        // 6. Nyalakan kembali pemeriksaan foreign key
        // -------------------------------------------------------------
        $db->query('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Cari nama foreign key pada kolom tertentu (spesifik kolom agar tidak
     * menghapus FK yang tidak terkait, tangah per tabel ada banyak FK).
     */
    protected function findForeignKeyName($db, string $table, string $column): ?string
    {
        try {
            $rows = $db->query(
                'SELECT tc.CONSTRAINT_NAME
                 FROM INFORMATION_SCHEMA.TABLE_CONSTRAINTS AS tc
                 JOIN INFORMATION_SCHEMA.KEY_COLUMN_USAGE AS kcu
                     ON kcu.CONSTRAINT_NAME = tc.CONSTRAINT_NAME
                    AND kcu.TABLE_SCHEMA = tc.TABLE_SCHEMA
                 WHERE tc.TABLE_SCHEMA = ?
                   AND tc.TABLE_NAME = ?
                   AND tc.CONSTRAINT_TYPE = ?
                   AND kcu.COLUMN_NAME = ?',
                [$db->getDatabase(), $table, 'FOREIGN KEY', $column]
            )->getResultArray();

            if ($rows && count($rows) > 0) {
                $name = (string) ($rows[0]['CONSTRAINT_NAME'] ?? '');

                if ($name !== '') {
                    return $name;
                }
            }
        } catch (\Throwable $e) {
            // Lanjut ke fallback
        }

        return null;
    }

    /**
     * Hapus foreign key pada kolom tertentu (bila masih ada).
     */
    protected function dropForeignKeyOnColumn($db, string $table, string $column, string $expectedName): void
    {
        $name = $this->findForeignKeyName($db, $table, $column);

        if ($name === null) {
            $name = $expectedName;
        }

        try {
            $db->query("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$name}`");
        } catch (\Throwable $e) {
            // Abaikan bila belum ada
        }
    }

    /**
     * Tambahkan foreign key bila kolom tersebut belum punya FK.
     */
    protected function addForeignKeyIfMissing(
        $db,
        string $table,
        string $column,
        string $refTable,
        string $constraintName,
        string $onDelete,
        string $onUpdate
    ): void {
        if ($this->findForeignKeyName($db, $table, $column) !== null) {
            return;
        }

        $db->query(
            "ALTER TABLE `{$table}`
             ADD CONSTRAINT `{$constraintName}`
             FOREIGN KEY (`{$column}`) REFERENCES `{$refTable}` (`id`)
             ON DELETE {$onDelete} ON UPDATE {$onUpdate}"
        );
    }

    public function down()
    {
        // Tidak dapat di-rollback secara aman — wajib refresh dari migrasi awal.
        log_message('info', '[UnifyTicketsAndAlignRoles] down() sengaja tidak mengembalikan data legacy.');
    }
}