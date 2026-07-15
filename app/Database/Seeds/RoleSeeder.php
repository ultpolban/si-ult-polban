<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'role_name' => 'Admin',
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
                'role_name' => 'Pemohon',
                'description' => 'Mahasiswa/Dosen/Publik'
            ],
            [
                'role_name' => 'Pimpinan',
                'description' => 'Pimpinan POLBAN'
            ],
        ];

        $this->db->table('roles')->insertBatch($data);
    }
}
