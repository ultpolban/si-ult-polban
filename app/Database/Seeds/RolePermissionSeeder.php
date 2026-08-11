<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh Role
        |--------------------------------------------------------------------------
        */

        $roles = [];

        foreach ($this->db->table('roles')->get()->getResultArray() as $role) {
            $roles[$role['code']] = $role['id'];
        }

        /*
        |--------------------------------------------------------------------------
        | Ambil seluruh Permission
        |--------------------------------------------------------------------------
        */

        $permissions = [];

        foreach ($this->db->table('permissions')->get()->getResultArray() as $permission) {
            $permissions[$permission['code']] = $permission['id'];
        }

        /*
        |--------------------------------------------------------------------------
        | Mapping Role => Permission
        |--------------------------------------------------------------------------
        */

        $rolePermissions = [

            /*
    |--------------------------------------------------------------------------
    | Super Admin
    |--------------------------------------------------------------------------
    */

            'SUPER_ADMIN' => ['*'],


            /*
    |--------------------------------------------------------------------------
    | Admin ULT
    |--------------------------------------------------------------------------
    */

            'ADMIN_ULT' => [

                'dashboard.view',

                // User
                'user.view',
                'user.create',
                'user.update',
                'user.delete',
                'user.restore',
                'user.reset_password',

                // Applicant Type
                'applicant_type.view',
                'applicant_type.create',
                'applicant_type.update',
                'applicant_type.delete',
                'applicant_type.restore',

                // Department
                'department.view',
                'department.create',
                'department.update',
                'department.delete',
                'department.restore',

                // Study Program
                'study_program.view',
                'study_program.create',
                'study_program.update',
                'study_program.delete',
                'study_program.restore',

                // Class
                'class.view',
                'class.create',
                'class.update',
                'class.delete',
                'class.restore',

                // Service Unit
                'service_unit.view',
                'service_unit.create',
                'service_unit.update',
                'service_unit.delete',
                'service_unit.restore',

                // Service Category
                'service_category.view',
                'service_category.create',
                'service_category.update',
                'service_category.delete',
                'service_category.restore',

                // Service
                'service.view',
                'service.create',
                'service.update',
                'service.delete',
                'service.restore',

                // Service Requirement
                'service_requirement.view',
                'service_requirement.create',
                'service_requirement.update',
                'service_requirement.delete',
                'service_requirement.restore',

                // Ticket
                'request.view',
                'request.create',
                'request.update',
                'request.verify',
                'request.approve',
                'request.reject',
                'request.complete',
                'request.cancel',

                // Notification
                'notification.view',

                // Activity Log
                'activity_log.view',

                // Report
                'report.view',
                'report.export',

                // Statistic
                'statistic.view',
            ],


            /*
    |--------------------------------------------------------------------------
    | Petugas ULT
    |--------------------------------------------------------------------------
    */

            'PETUGAS_ULT' => [

                'dashboard.view',

                // Tiket
                'request.view',
                'request.create',
                'request.update',
                'request.verify',
                'request.approve',
                'request.reject',
                'request.complete',

                // Notifikasi
                'notification.view',

                // Laporan & Statistik
                'report.view',
                'report.export',
                'statistic.view',
            ],


            /*
    |--------------------------------------------------------------------------
    | Unit Tujuan
    |--------------------------------------------------------------------------
    */

            'UNIT_TUJUAN' => [

                'dashboard.view',

                // Tiket
                'request.view',
                'request.update',
                'request.complete',
                'request.reject',

                // Notifikasi
                'notification.view',

                // Statistik
                'statistic.view',
            ],


            /*
    |--------------------------------------------------------------------------
    | Pimpinan
    |--------------------------------------------------------------------------
    */

            'PIMPINAN' => [

                'dashboard.view',

                // Tiket
                'request.view',

                // Notifikasi
                'notification.view',

                // Laporan
                'report.view',
                'report.export',

                // Statistik
                'statistic.view',
            ],


            /*
    |--------------------------------------------------------------------------
    | Pemohon
    |--------------------------------------------------------------------------
    */

            'PEMOHON' => [

                'dashboard.view',

                'request.view',
                'request.create',
                'request.cancel',

                'notification.view',
            ],
        ];

        $insertData = [];

        foreach ($rolePermissions as $roleCode => $permissionCodes) {

            if (! isset($roles[$roleCode])) {
                continue;
            }

            /*
            |---------------------------------------------------------------
            | Super Admin -> Semua Permission
            |---------------------------------------------------------------
            */

            if ($permissionCodes === ['*']) {

                foreach ($permissions as $permissionId) {

                    $insertData[] = [
                        'role_id'       => $roles[$roleCode],
                        'permission_id' => $permissionId,
                        'created_at'    => $now,
                        'updated_at'    => $now,
                    ];
                }

                continue;
            }

            /*
            |---------------------------------------------------------------
            | Role Biasa
            |---------------------------------------------------------------
            */

            foreach ($permissionCodes as $permissionCode) {

                if (! isset($permissions[$permissionCode])) {
                    continue;
                }

                $insertData[] = [
                    'role_id'       => $roles[$roleCode],
                    'permission_id' => $permissions[$permissionCode],
                    'created_at'    => $now,
                    'updated_at'    => $now,
                ];
            }
        }

        $this->db->table('role_permissions')->insertBatch($insertData);
    }
}
