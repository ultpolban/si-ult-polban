<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KategoriLayananSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['unit_layanan_id' => 2, 'kode' => 'AKD-SURAT', 'nama' => 'Surat Akademik', 'status' => 'Aktif'],
            ['unit_layanan_id' => 2, 'kode' => 'AKD-STATUS', 'nama' => 'Status Mahasiswa', 'status' => 'Aktif'],
            ['unit_layanan_id' => 2, 'kode' => 'AKD-WISUDA', 'nama' => 'Wisuda', 'status' => 'Aktif'],
            ['unit_layanan_id' => 3, 'kode' => 'KEU-UKT', 'nama' => 'UKT', 'status' => 'Aktif'],
            ['unit_layanan_id' => 3, 'kode' => 'KEU-PEMBAYARAN', 'nama' => 'Administrasi Pembayaran', 'status' => 'Aktif'],
            ['unit_layanan_id' => 4, 'kode' => 'KMH-BEASISWA', 'nama' => 'Beasiswa', 'status' => 'Aktif'],
            ['unit_layanan_id' => 4, 'kode' => 'KMH-ORMAWA', 'nama' => 'Organisasi Mahasiswa', 'status' => 'Aktif'],
            ['unit_layanan_id' => 5, 'kode' => 'PERPUS-LAYANAN', 'nama' => 'Layanan Perpustakaan', 'status' => 'Aktif'],
            ['unit_layanan_id' => 6, 'kode' => 'JUR-AKADEMIK', 'nama' => 'Administrasi Jurusan', 'status' => 'Aktif'],
            ['unit_layanan_id' => 7, 'kode' => 'UPTIK-AKUN', 'nama' => 'Akun dan Sistem Informasi', 'status' => 'Aktif'],
        ];

        foreach ($data as &$row) {
            $row['created_at'] = date('Y-m-d H:i:s');
            $row['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db->table('kategori_layanan')->insertBatch($data);
    }
}
