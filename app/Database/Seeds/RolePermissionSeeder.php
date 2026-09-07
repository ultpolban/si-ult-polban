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

            'ADMIN_ULT' => ['*'],


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
