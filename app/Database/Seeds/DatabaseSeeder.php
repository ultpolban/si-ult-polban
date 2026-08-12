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
}
