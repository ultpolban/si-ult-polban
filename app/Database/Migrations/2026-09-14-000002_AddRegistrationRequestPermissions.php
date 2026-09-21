<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRegistrationRequestPermissions extends Migration
{
    /**
     * Menambahkan permission untuk fitur Permintaan Izin Registrasi
     * beserta pemberiannya ke role SUPER_ADMIN dan ADMIN_ULT.
     */
    public function up()
    {
        $db  = \Config\Database::connect();
        $now = date('Y-m-d H:i:s');

        $permissions = [
            'registration_request.view'    => [
                'name'       => 'Lihat Permintaan Registrasi',
                'sort_order' => 1,
            ],
            'registration_request.approve' => [
                'name'       => 'Setujui Permintaan Registrasi',
                'sort_order' => 2,
            ],
            'registration_request.reject'  => [
                'name'       => 'Tolak Permintaan Registrasi',
                'sort_order' => 3,
            ],
        ];

        foreach ($permissions as $code => $meta) {
            // 1. Pastikan permission ada
            $exists = $db->table('permissions')
                ->where('code', $code)
                ->countAllResults();

            if ($exists === 0) {
                $db->table('permissions')->insert([
                    'code'        => $code,
                    'name'        => $meta['name'],
                    'module'      => 'Registrasi',
                    'description' => $meta['name'],
                    'sort_order'  => $meta['sort_order'],
                    'is_active'   => 1,
                    'created_at'  => $now,
                    'updated_at'  => $now,
                ]);
            }

            $permission = $db->table('permissions')
                ->select('id')
                ->where('code', $code)
                ->get()
                ->getRow();

            if (! $permission) {
                continue;
            }

            // 2. Berikan permission ke role yang relevan
            //    (SUPER_ADMIN & ADMIN_ULT otomatis bypass di PermissionService,
            //    namun tetap di-seed agar konsisten di tabel role_permissions).
            $roles = $db->table('roles')
                ->whereIn('code', ['SUPER_ADMIN', 'ADMIN_ULT'])
                ->get()
                ->getResultArray();

            foreach ($roles as $role) {
                $assigned = $db->table('role_permissions')
                    ->where('role_id', $role['id'])
                    ->where('permission_id', $permission->id)
                    ->countAllResults();

                if ($assigned === 0) {
                    $db->table('role_permissions')->insert([
                        'role_id'       => $role['id'],
                        'permission_id' => $permission->id,
                        'created_at'    => $now,
                        'updated_at'    => $now,
                    ]);
                }
            }
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();

        $codes = [
            'registration_request.view',
            'registration_request.approve',
            'registration_request.reject',
        ];

        foreach ($codes as $code) {
            $permission = $db->table('permissions')
                ->select('id')
                ->where('code', $code)
                ->get()
                ->getRow();

            if (! $permission) {
                continue;
            }

            $db->table('role_permissions')
                ->where('permission_id', $permission->id)
                ->delete();

            $db->table('permissions')
                ->where('id', $permission->id)
                ->delete();
        }
    }
}
