<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UnitLayananSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['kode' => 'ULT', 'nama' => 'Unit Layanan Terpadu', 'status' => 'Aktif'],
            ['kode' => 'AKD', 'nama' => 'Bagian Akademik', 'status' => 'Aktif'],
            ['kode' => 'KEU', 'nama' => 'Bagian Keuangan', 'status' => 'Aktif'],
            ['kode' => 'KEMHS', 'nama' => 'Bagian Kemahasiswaan', 'status' => 'Aktif'],
            ['kode' => 'PERPUS', 'nama' => 'Perpustakaan', 'status' => 'Aktif'],
            ['kode' => 'JUR', 'nama' => 'Jurusan', 'status' => 'Aktif'],
            ['kode' => 'UPTIK', 'nama' => 'UPT Teknologi Informasi dan Komunikasi', 'status' => 'Aktif'],
            ['kode' => 'BAUK', 'nama' => 'Bagian Administrasi Umum', 'status' => 'Aktif'],
            ['kode' => 'ADM', 'nama' => 'Administrasi Umum', 'status' => 'Aktif'],
        ];

        foreach ($data as &$row) {
            $row['created_at'] = date('Y-m-d H:i:s');
            $row['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db->table('unit_layanan')->insertBatch($data);
    }
}
