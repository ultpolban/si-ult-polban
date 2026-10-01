<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        /*
        |--------------------------------------------------------------------------
        | Role kanonik aplikasi (konsisten dengan RolePermissionSeeder & Routes)
        |--------------------------------------------------------------------------
        */

        $roles = [

            [
                'code'        => 'SUPER_ADMIN',
                'name'        => 'Super Administrator',
                'description' => 'Memiliki akses penuh ke seluruh sistem.',
                'sort_order'  => 1,
            ],

            [
                'code'        => 'ADMIN_ULT',
                'name'        => 'Admin ULT',
                'description' => 'Mengelola layanan dan operasional Unit Layanan Terpadu.',
                'sort_order'  => 2,
            ],

            [
                'code'        => 'PETUGAS_ULT',
                'name'        => 'Petugas ULT',
                'description' => 'Memverifikasi dan memproses layanan Unit Layanan Terpadu.',
                'sort_order'  => 3,
            ],

            [
                'code'        => 'UNIT_TUJUAN',
                'name'        => 'Unit Tujuan',
                'description' => 'Unit layanan tujuan yang menindaklanjuti tiket.',
                'sort_order'  => 4,
            ],

            [
                'code'        => 'PIMPINAN',
                'name'        => 'Pimpinan',
                'description' => 'Melihat laporan dan statistik layanan.',
                'sort_order'  => 5,
            ],

            [
                'code'        => 'PEMOHON',
                'name'        => 'Pemohon',
                'description' => 'Pengguna yang mengajukan layanan.',
                'sort_order'  => 6,
            ],

        ];

        foreach ($roles as $role) {
            $existing = $this->db->table('roles')
                ->where('code', $role['code'])
                ->get()
                ->getRowArray();

            $role['is_active']  = true;
            $role['updated_at'] = $now;

            if ($existing) {
                // Update agar sesuai definisi terbaru (tetap aktif)
                unset($role['code']);
                $this->db->table('roles')
                    ->where('id', $existing['id'])
                    ->update($role);
            } else {
                $role['created_at'] = $now;
                $this->db->table('roles')->insert($role);
            }
        }
    }
}
