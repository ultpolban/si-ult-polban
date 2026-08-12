<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

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
                'code'        => 'PETUGAS_AKADEMIK',
                'name'        => 'Petugas Akademik',
                'description' => 'Memverifikasi dan memproses layanan akademik.',
                'sort_order'  => 3,
            ],

            [
                'code'        => 'PETUGAS_KEUANGAN',
                'name'        => 'Petugas Keuangan',
                'description' => 'Memverifikasi dan memproses layanan keuangan.',
                'sort_order'  => 4,
            ],

            [
                'code'        => 'PETUGAS_UMUM',
                'name'        => 'Petugas Umum',
                'description' => 'Memverifikasi dan memproses layanan umum.',
                'sort_order'  => 5,
            ],

            [
                'code'        => 'PEMOHON',
                'name'        => 'Pemohon',
                'description' => 'Pengguna yang mengajukan layanan.',
                'sort_order'  => 6,
            ],

        ];

        foreach ($roles as &$role) {
            $role['is_active'] = true;
            $role['created_at'] = $now;
            $role['updated_at'] = $now;
        }

        $this->db->table('roles')->insertBatch($roles);
    }
}
