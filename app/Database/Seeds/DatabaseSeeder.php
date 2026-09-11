<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        echo PHP_EOL;
        echo "======================================" . PHP_EOL;
        echo " SI ULT POLBAN DATABASE SEEDER" . PHP_EOL;
        echo "======================================" . PHP_EOL;

        $this->truncateTables();

        /*
        |--------------------------------------------------------------------------
        | ROLE & PERMISSION
        |--------------------------------------------------------------------------
        */

        $this->call(RoleSeeder::class);

        $this->call(PermissionSeeder::class);

        $this->call(RolePermissionSeeder::class);


        /*
        |--------------------------------------------------------------------------
        | DATA AKADEMIK
        |--------------------------------------------------------------------------
        */

        $this->call(ApplicantTypeSeeder::class);

        $this->call(DepartmentSeeder::class);

        $this->call(StudyProgramSeeder::class);

        $this->call(ClassSeeder::class);


        /*
        |--------------------------------------------------------------------------
        | MASTER LAYANAN
        |--------------------------------------------------------------------------
        */

        // harus dibuat dulu
        $this->call(ServiceUnitSeeder::class);


        // membutuhkan service_unit_id
        $this->call(ServiceCategorySeeder::class);


        // membutuhkan unit + category
        $this->call(ServiceSeeder::class);


        /*
        |--------------------------------------------------------------------------
        | REQUIREMENT
        |--------------------------------------------------------------------------
        */

        $this->call(ServiceRequirementSeeder::class);


        /*
        |--------------------------------------------------------------------------
        | ADMIN DEFAULT
        |--------------------------------------------------------------------------
        */

        $this->call(AdminSeeder::class);

        $this->call(AkademikSeeder::class);

        $this->call(UptTikSeeder::class);

        $this->call(AdministrasiUmumSeeder::class);

        $this->seedExistingUnitUsers();

        $this->call(FinanceSeeder::class);

        $this->call(PerpustakaanSeeder::class);

        $this->call(JurusanSeeder::class);

        $this->call(UnitDummyTicketsSeeder::class);


echo PHP_EOL;
        echo "======================================" . PHP_EOL;
        echo " DATABASE SEEDING SELESAI" . PHP_EOL;
        echo "======================================" . PHP_EOL;
    }

    /**
     * Kosongkan seluruh tabel sebelum seeding agar idempotent.
     * Urutan mengikuti dependensi foreign key (child dulu, parent terakhir).
     */
    protected function truncateTables(): void
    {
        $this->db->query('SET FOREIGN_KEY_CHECKS = 0');

        $tables = [
            'service_request_logs',
            'service_request_files',
            'service_requests',
            'notifications',
            'activity_logs',
            'upt_tik_activity_logs',
            'upt_tik_tickets',
            'administrasi_umum_activity_logs',
            'administrasi_umum_tickets',
            'perpustakaan_activity_logs',
            'perpustakaan_tickets',
            'jurusan_activity_logs',
            'jurusan_tickets',
            'kemahasiswaan_activity_logs',
            'kemahasiswaan_tickets',
            'keuangan_activity_logs',
            'keuangan_tickets',
            'akademik_activity_logs',
            'akademik_tickets',
            'role_permissions',
            'user_profiles',
            'users',
            'permissions',
            'roles',
            'master_service_requirements',
            'master_services',
            'master_service_categories',
            'master_service_units',
            'master_classes',
            'master_study_programs',
            'master_departments',
            'master_applicant_types',
        ];

        foreach ($tables as $table) {
            $this->db->query("TRUNCATE TABLE `{$table}`");
        }

        $this->db->query('SET FOREIGN_KEY_CHECKS = 1');
    }

    protected function seedExistingUnitUsers(): void
    {
        $users = [
            [
                'role_code' => 'PETUGAS_KEMAHASISWAAN',
                'full_name' => 'Petugas Kemahasiswaan',
                'identity_number' => 'KMS001',
                'email' => 'petugas.kemahasiswaan@polban.ac.id',
                'password' => 'Kemahasiswaan123',
            ],
        ];

        foreach ($users as $user) {
            $role = $this->db
                ->table('roles')
                ->where('code', $user['role_code'])
                ->get()
                ->getRowArray();

            if (!$role) {
                continue;
            }

            $now = date('Y-m-d H:i:s');

            $this->db->table('users')->insert([
                'role_id' => $role['id'],
                'full_name' => $user['full_name'],
                'identity_number' => $user['identity_number'],
                'phone_number' => null,
                'email' => $user['email'],
                'password' => password_hash($user['password'], PASSWORD_DEFAULT),
                'profile_photo' => null,
                'is_active' => true,
                'last_login' => null,
                'remember_token' => null,
                'email_verified_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
