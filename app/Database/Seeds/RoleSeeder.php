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
                'code'        => 'PETUGAS_TIK',
                'name'        => 'Petugas UPT TIK',
                'description' => 'Mengelola tiket layanan teknologi informasi dan komunikasi.',
                'sort_order'  => 4,
            ],

            [
                'code'        => 'PETUGAS_UMUM',
                'name'        => 'Petugas Administrasi Umum',
                'description' => 'Mengelola tiket layanan Bagian Administrasi Umum.',
                'sort_order'  => 5,
            ],

            [
                'code'        => 'PETUGAS_KEMAHASISWAAN',
                'name'        => 'Petugas Kemahasiswaan',
                'description' => 'Memverifikasi dan memproses layanan kemahasiswaan.',
                'sort_order'  => 6,
            ],

            [
                'code'        => 'PETUGAS_KEUANGAN',
                'name'        => 'Petugas Keuangan',
                'description' => 'Memverifikasi dan memproses layanan keuangan.',
                'sort_order'  => 7,
            ],

            [
                'code'        => 'PETUGAS_PERPUSTAKAAN',
                'name'        => 'Petugas Perpustakaan',
                'description' => 'Memverifikasi dan memproses layanan perpustakaan.',
                'sort_order'  => 8,
            ],

            [
                'code'        => 'PETUGAS_JURUSAN',
                'name'        => 'Petugas Jurusan',
                'description' => 'Memverifikasi dan memproses layanan jurusan.',
                'sort_order'  => 9,
            ],

            [
                'code'        => 'PEMOHON',
                'name'        => 'Pemohon',
                'description' => 'Pengguna yang mengajukan layanan.',
                'sort_order'  => 10,
            ],

        ];

        foreach ($roles as &$role) {
            $role['is_active'] = true;
            $role['created_at'] = $now;
            $role['updated_at'] = $now;

            $existing = $this->db
                ->table('roles')
                ->where('code', $role['code'])
                ->get()
                ->getRowArray();

            if ($existing) {
                $this->db->table('roles')
                    ->where('id', $existing['id'])
                    ->update($role);
                continue;
            }

            $this->db->table('roles')->insert($role);
        }
    }
}