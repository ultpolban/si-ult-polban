<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * =====================================================================
 *  Seeder User Demo (opsional)
 * =====================================================================
 *
 *  Membuat satu akun untuk setiap role dan setiap jenis pemohon
 *  sehingga seluruh dashboard & menu dapat diuji.
 *
 *  Jalankan:
 *      php spark db:seed DemoUserSeeder
 *
 *  Password seluruh akun demo: "Polban123"
 *  Hapus akun demo sebelum going-live:
 *      php spark db:seed --delete  (atau hapus manual)
 */
class DemoUserSeeder extends Seeder
{
    public const DEMO_PASSWORD = 'Polban123';

    public function run()
    {
        $rows = [
            // role,                 nama,            email,                        NIK,     jenis pemohon
            ['SUPER_ADMIN',           'Super Admin',   'superadmin@polban.ac.id',     'ADM001', null],
            ['ADMIN_ULT',             'Admin ULT',     'adminult@polban.ac.id',       'ADM002', null],
            ['PETUGAS_ULT',           'Petugas ULT',   'petugasult@polban.ac.id',     'PTG003', null],
            ['UNIT_TUJUAN',           'Unit Tujuan',   'unittujuan@polban.ac.id',     'UNT004', null],
            ['PIMPINAN',              'Pimpinan',      'pimpinan@polban.ac.id',       'PMP005', null],
            ['PEMOHON',               'Budi Mahasiswa', 'mhs@polban.ac.id',           'MHS006', 'MHS'],
            ['PEMOHON',               'Dina Dosen',    'dosen@polban.ac.id',          'DSN007', 'DOSEN'],
            ['PEMOHON',               'Eka Tendik',    'tendik@polban.ac.id',         'TDK008', 'TENDIK'],
            ['PEMOHON',               'Fajar Alumni',  'alumni@polban.ac.id',         'ALM009', 'ALUMNI'],
            ['PEMOHON',               'Gita Mitra',    'mitra@polban.ac.id',          'MTR010', 'MITRA'],
            ['PEMOHON',               'Hadi Wali',     'wali@polban.ac.id',           'WAL011', 'WALI'],
            ['PEMOHON',               'Indah Umum',    'umum@polban.ac.id',           'UMU012', 'UMUM'],
        ];

        $password = password_hash(self::DEMO_PASSWORD, PASSWORD_DEFAULT);

        foreach ($rows as $row) {
            $this->upsertUser($row, $password);
        }

        echo PHP_EOL . 'User demo siap. Password: ' . self::DEMO_PASSWORD . PHP_EOL;
    }

    private function upsertUser(array $row, string $password): void
    {
        [$roleCode, $name, $email, $identity, $applicant] = $row;

        $roleId = (int) ($this->db->table('roles')
            ->select('id')
            ->where('code', $roleCode)
            ->get()
            ->getRowArray()['id'] ?? 0);

        if ($roleId <= 0) {
            echo "ROLE MISSING: {$roleCode}\n";
            return;
        }

        $existing = $this->db->table('users')->where('email', $email)->get()->getRowArray();

        if ($existing) {
            $userId = (int) $existing['id'];

            $this->db->table('users')->where('id', $userId)->update([
                'role_id'    => $roleId,
                'password'   => $password,
                'is_active'  => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            echo "UPDATED: {$email}\n";
        } else {
            $this->db->table('users')->insert([
                'role_id'           => $roleId,
                'full_name'         => $name,
                'identity_number'   => $identity,
                'phone_number'      => '081200000000',
                'email'             => $email,
                'password'          => $password,
                'is_active'         => 1,
                'email_verified_at' => date('Y-m-d H:i:s'),
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s'),
            ]);

            $userId = (int) $this->db->insertID();

            echo "CREATED: {$email}\n";
        }

        if ($applicant === null) {
            return;
        }

        $typeId = (int) ($this->db->table('master_applicant_types')
            ->select('id')
            ->where('code', $applicant)
            ->get()
            ->getRowArray()['id'] ?? 0);

        if ($typeId <= 0) {
            return;
        }

        $hasProfile = $this->db->table('user_profiles')
            ->where('user_id', $userId)
            ->countAllResults() > 0;

        if ($hasProfile) {
            $this->db->table('user_profiles')
                ->where('user_id', $userId)
                ->update([
                    'applicant_type_id' => $typeId,
                    'updated_at'        => date('Y-m-d H:i:s'),
                ]);

            return;
        }

        $this->db->table('user_profiles')->insert([
            'user_id'           => $userId,
            'applicant_type_id' => $typeId,
            'name'              => $name,
            'email'             => $email,
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s'),
        ]);
    }
}