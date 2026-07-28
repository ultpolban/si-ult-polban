<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UnitsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'unit_name' => 'Bagian Akademik',
                'description' => 'Administrasi Akademik',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'unit_name' => 'Bagian Kemahasiswaan',
                'description' => 'Pengaturan kemahasiswaan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'unit_name' => 'Bagian Keuangan',
                'description' => 'Administrasi Keuangan',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'unit_name' => 'Direktorat',
                'description' => 'Direktorat POLBAN',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'unit_name' => 'Humas',
                'description' => 'Humas/Ikatan Alumni',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'unit_name' => 'Perpustakaan',
                'description' => 'Perpustakaan POLBAN',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'unit_name' => 'SPI',
                'description' => 'Satuan Pengawas Internal',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'unit_name' => 'UPT Bahasa',
                'description' => 'Unit Bahasa',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'unit_name' => 'UPT K3',
                'description' => 'Keselamatan dan Kesehatan Kerja',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'unit_name' => 'UPT TIK',
                'description' => 'Lajit Teknologi Informasi',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('units')->insertBatch($data);
    }
}
