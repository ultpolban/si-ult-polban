<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class WorkUnitSeeder extends Seeder
{
    public function run()
    {
        $data = [

            [
                'unit_code' => 'DIR',
                'unit_name' => 'Direktorat',
                'description' => 'Direktorat POLBAN',
                'status' => 'Aktif'
            ],

            [
                'unit_code' => 'AKD',
                'unit_name' => 'Bagian Akademik',
                'description' => 'Administrasi Akademik',
                'status' => 'Aktif'
            ],

            [
                'unit_code' => 'KEU',
                'unit_name' => 'Bagian Keuangan',
                'description' => 'Administrasi Keuangan',
                'status' => 'Aktif'
            ],

            [
                'unit_code' => 'KMH',
                'unit_name' => 'Bagian Kemahasiswaan',
                'description' => 'Pelayanan Kemahasiswaan',
                'status' => 'Aktif'
            ],

            [
                'unit_code' => 'LIB',
                'unit_name' => 'Perpustakaan',
                'description' => 'Perpustakaan POLBAN',
                'status' => 'Aktif'
            ],

            [
                'unit_code' => 'TIK',
                'unit_name' => 'UPT TIK',
                'description' => 'Unit Teknologi Informasi',
                'status' => 'Aktif'
            ],

            [
                'unit_code' => 'BHS',
                'unit_name' => 'UPT Bahasa',
                'description' => 'Unit Bahasa',
                'status' => 'Aktif'
            ],

            [
                'unit_code' => 'K3',
                'unit_name' => 'UPT K3',
                'description' => 'Keselamatan dan Kesehatan Kerja',
                'status' => 'Aktif'
            ],

            [
                'unit_code' => 'HMS',
                'unit_name' => 'Humas',
                'description' => 'Hubungan Masyarakat',
                'status' => 'Aktif'
            ],

            [
                'unit_code' => 'SPI',
                'unit_name' => 'SPI',
                'description' => 'Satuan Pengawas Internal',
                'status' => 'Aktif'
            ]

        ];

        $this->db->table('work_units')->insertBatch($data);
    }
}
