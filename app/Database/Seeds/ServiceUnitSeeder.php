<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ServiceUnitSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        $data = [

            [
                'code' => 'ULT',
                'name' => 'Unit Layanan Terpadu',
                'description' => 'Unit Layanan Terpadu Politeknik Negeri Bandung',
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'code' => 'AKD',
                'name' => 'Bagian Akademik',
                'description' => 'Pelayanan akademik mahasiswa',
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'code' => 'KEU',
                'name' => 'Bagian Keuangan',
                'description' => 'Pelayanan administrasi keuangan',
                'sort_order' => 3,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'code' => 'KEMHS',
                'name' => 'Bagian Kemahasiswaan',
                'description' => 'Pelayanan kemahasiswaan',
                'sort_order' => 4,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'code' => 'PERPUS',
                'name' => 'Perpustakaan',
                'description' => 'Pelayanan perpustakaan',
                'sort_order' => 5,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'code' => 'JUR',
                'name' => 'Jurusan',
                'description' => 'Pelayanan administrasi jurusan',
                'sort_order' => 6,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'code' => 'UPTIK',
                'name' => 'UPT Teknologi Informasi dan Komunikasi',
                'description' => 'Pelayanan teknologi informasi',
                'sort_order' => 7,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'code' => 'ADM',
                'name' => 'Administrasi Umum',
                'description' => 'Unit layanan administrasi umum',
                'is_active' => 1,
                'sort_order' => 12,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'code' => 'BAUK',
                'name' => 'Bagian Administrasi Umum',
                'description' => 'Administrasi umum dan kepegawaian',
                'sort_order' => 8,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ];

        $this->db->table('master_service_units')->insertBatch($data);
    }
}
