<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'role_name' => 'Administrator',
                'description' => 'Administrator Sistem'
            ],
            [
                'role_name' => 'Petugas ULT',
                'description' => 'Petugas Unit Layanan Terpadu'
            ],
            [
                'role_name' => 'Unit Tujuan',
                'description' => 'Unit yang memproses layanan'
            ],
            [
                'role_name' => 'Pimpinan',
                'description' => 'Pimpinan POLBAN'
            ],
            [
                'role_name' => 'Pemohon',
                'description' => 'Mahasiswa, Dosen, Tendik, Alumni, Orang Tua, Mitra, Publik'
            ],
        ];

        $this->db->table('roles')->insertBatch($roles);
    }
}
