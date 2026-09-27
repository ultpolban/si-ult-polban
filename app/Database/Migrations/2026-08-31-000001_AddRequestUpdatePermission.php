<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRequestUpdatePermission extends Migration
{
    /**
     * Kolom `request.update` dipakai oleh TicketController (edit/update/change-status),
     * namun tidak ada di PermissionSeeder lama maupun database hasil seed sebelumnya.
     * Migration ini menambahkan permission tersebut beserta pemberiannya ke role terkait.
     */
    public function up()
    {
        $db = \Config\Database::connect();
        $now = date('Y-m-d H:i:s');

        // 1. Pastikan permission request.update ada
        $exists = $db->table('permissions')
            ->where('code', 'request.update')
            ->countAllResults();

        if ($exists === 0) {
            $db->table('permissions')->insert([
                'code'        => 'request.update',
                'name'        => 'Ubah Pengajuan',
                'module'      => 'Request',
                'description' => 'Ubah Pengajuan / Tiket',
                'sort_order'  => 2,
                'is_active'   => 1,
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }

        $permission = $db->table('permissions')
            ->select('id')
            ->where('code', 'request.update')
            ->get()
            ->getRow();

        if (! $permission) {
            return;
        }

        // 2. Berikan permission ke role yang relevan (petugas & unit tujuan,
        //    admin/superadmin sudah otomatis bypass di PermissionService).
        $roles = $db->table('roles')
            ->whereIn('code', ['PETUGAS_ULT', 'UNIT_TUJUAN', 'ADMIN_ULT', 'SUPER_ADMIN'])
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

    public function down()
    {
        $db = \Config\Database::connect();

        $permission = $db->table('permissions')
            ->select('id')
            ->where('code', 'request.update')
            ->get()
            ->getRow();

        if (! $permission) {
            return;
        }

        $db->table('role_permissions')
            ->where('permission_id', $permission->id)
            ->delete();

        $db->table('permissions')
            ->where('id', $permission->id)
            ->delete();
    }
}