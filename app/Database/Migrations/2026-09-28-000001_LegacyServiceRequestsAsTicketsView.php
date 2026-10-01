<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * =====================================================================
 *  2026-09-28 - Legacy `service_requests` -> View kompatibilitas `tickets`
 * =====================================================================
 *
 *  Latar belakang:
 *   Migrasi 2026-09-15-000001 (UnifyTicketsAndAlignRoles) menetapkan
 *   tabel `tickets` sebagai sumber data kanonik pengajuan layanan.
 *   Sebagian besar view lama (frontend pemohon, laporan, disposisi)
 *   masih query ke `service_requests`, sehingga dashboard pemohon dan
 *   beberapa menu berakhir error 500 karena kolom `title`, `priority`,
 *   dan `assigned_to` tidak ada pada tabel lama.
 *
 *  Solusi:
 *   1. Pindahkan sisa data (bila ada) dari `service_requests` ke `tickets`.
 *   2. Hapus tabel legacy `service_requests`.
 *   3. Buat VIEW kompatibilitas bernama `service_requests` yang menunjuk
 *      ke `tickets`, sehingga seluruh query lama langsung memakai data
 *      kanonik tanpa error.
 */
class LegacyServiceRequestsAsTicketsView extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();

        $db->query('SET FOREIGN_KEY_CHECKS = 0');

        try {
            if ($db->tableExists('tickets') && $db->tableExists('service_requests')) {
                $this->migrateLegacyRows($db);
                $this->dropForeignKeys($db);
                $db->query('DROP TABLE IF EXISTS `service_requests`');
            }

            if ($db->tableExists('tickets')) {
                $this->createCompatView($db);
            }
        } finally {
            $db->query('SET FOREIGN_KEY_CHECKS = 1');
        }
    }

    /**
     * Pindahkan baris legacy yang belum punya tiket dengan nomor sama.
     */
    private function migrateLegacyRows($db): void
    {
        $legacyColumns = $db->getFieldNames('service_requests');
        $ticketColumns = $db->getFieldNames('tickets');

        if ($legacyColumns === [] || $ticketColumns === []) {
            return;
        }

        $shared = array_values(array_intersect($legacyColumns, $ticketColumns));
        $shared = array_values(array_diff($shared, ['id']));

        if ($shared === []) {
            return;
        }

        $rows = $db->table('service_requests')->get()->getResultArray();

        foreach ($rows as $row) {
            $ticketNumber = (string) ($row['ticket_number'] ?? '');

            $exists = $ticketNumber !== '' && $db->table('tickets')
                ->where('ticket_number', $ticketNumber)
                ->countAllResults() > 0;

            if ($exists) {
                continue;
            }

            $insert = [];

            foreach ($shared as $column) {
                $insert[$column] = $row[$column];
            }

            if (isset($insert['ticket_number']) && trim((string) $insert['ticket_number']) === '') {
                $insert['ticket_number'] = 'LEGACY-' . $row['id'];
            }

            $db->table('tickets')->insert($insert);
        }
    }

    /**
     * Lepaskan FK yang masih menunjuk ke service_requests.
     */
    private function dropForeignKeys($db): void
    {
        $candidates = ['service_request_logs', 'service_request_files', 'notifications'];

        foreach ($candidates as $table) {
            if (! $db->tableExists($table)) {
                continue;
            }

            $name = $this->findForeignKeyName($db, $table);

            if ($name !== null) {
                $db->query("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$name}`");
            }
        }
    }

    private function findForeignKeyName($db, string $table): ?string
    {
        try {
            $row = $db->query(
                'SELECT CONSTRAINT_NAME
                   FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
                  WHERE TABLE_SCHEMA = DATABASE()
                    AND REFERENCED_TABLE_NAME = ?
                  LIMIT 1',
                ['service_requests']
            )->getRowArray();

            $name = (string) ($row['CONSTRAINT_NAME'] ?? '');

            return $name !== '' ? $name : null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * View kompatibilitas: service_requests -> tickets
     */
    private function createCompatView($db): void
    {
        $db->query('DROP VIEW IF EXISTS `service_requests`');

        $db->query(
            'CREATE VIEW `service_requests` AS
             SELECT
                 tickets.id,
                 tickets.ticket_number,
                 tickets.user_profile_id,
                 NULL AS user_id,
                 tickets.service_id,
                 tickets.title,
                 tickets.description,
                 tickets.status,
                 tickets.priority,
                 tickets.assigned_to,
                 tickets.submitted_at,
                 tickets.verified_at,
                 tickets.processed_at,
                 tickets.completed_at,
                 tickets.rejected_at,
                 tickets.cancelled_at,
                 tickets.admin_note,
                 tickets.rejection_reason,
                 tickets.created_at,
                 tickets.updated_at,
                 tickets.deleted_at
             FROM `tickets`'
        );
    }

    public function down()
    {
        $db = \Config\Database::connect();

        $db->query('DROP VIEW IF EXISTS `service_requests`');
    }
}