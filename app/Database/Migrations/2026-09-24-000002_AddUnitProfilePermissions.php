<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUnitProfilePermissions extends Migration
{
    public function up()
    {
        $db = \Config\Database::connect();
        $now = date('Y-m-d H:i:s');
        $items = [
            ['code' => 'unit_profile.view', 'name' => 'Lihat Deskripsi Unit', 'module' => 'Unit Profile', 'description' => 'Lihat deskripsi lengkap tentang unit', 'sort_order' => 1],
            ['code' => 'unit_profile.create', 'name' => 'Tambah Deskripsi Unit', 'module' => 'Unit Profile', 'description' => 'Tambah deskripsi lengkap tentang unit', 'sort_order' => 2],
            ['code' => 'unit_profile.update', 'name' => 'Ubah Deskripsi Unit', 'module' => 'Unit Profile', 'description' => 'Ubah deskripsi lengkap tentang unit', 'sort_order' => 3],
            ['code' => 'unit_profile.delete', 'name' => 'Hapus Deskripsi Unit', 'module' => 'Unit Profile', 'description' => 'Hapus deskripsi lengkap tentang unit', 'sort_order' => 4],
            ['code' => 'unit_profile.restore', 'name' => 'Pulihkan Deskripsi Unit', 'module' => 'Unit Profile', 'description' => 'Pulihkan deskripsi lengkap tentang unit', 'sort_order' => 5],
        ];
        $ids = [];
        foreach ($items as $row) {
            $exists = $db->table('permissions')->where('code', $row['code'])->get()->getRow();
            if (! $exists) {
                $db->table('permissions')->insert(array_merge($row, ['is_active' => 1, 'created_at' => $now, 'updated_at' => $now]));
                $ids[] = (int) $db->insertID();
            } else {
                // Update label bila sebelumnya memakai nama lama "Profil Unit"
                $db->table('permissions')->where('id', $exists->id)->update([
                    'name'        => $row['name'],
                    'description' => $row['description'],
                    'updated_at'  => $now,
                ]);
                $ids[] = (int) $exists->id;
            }
        }
        $roles = $db->table('roles')->whereIn('code', ['SUPER_ADMIN', 'ADMIN_ULT', 'PETUGAS_ULT'])->get()->getResultArray();
        foreach ($roles as $role) {
            foreach ($ids as $pid) {
                $has = $db->table('role_permissions')->where('role_id', $role['id'])->where('permission_id', $pid)->countAllResults();
                if ($has === 0) {
                    $db->table('role_permissions')->insert(['role_id' => $role['id'], 'permission_id' => $pid, 'created_at' => $now, 'updated_at' => $now]);
                }
            }
        }
    }

    public function down()
    {
        $db = \Config\Database::connect();
        $rows = $db->table('permissions')->where('module', 'Unit Profile')->get()->getResultArray();
        foreach ($rows as $r) {
            $db->table('role_permissions')->where('permission_id', $r['id'])->delete();
            $db->table('permissions')->where('id', $r['id'])->delete();
        }
    }
}
