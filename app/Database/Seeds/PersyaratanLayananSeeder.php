<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PersyaratanLayananSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['layanan_id' => 1, 'persyaratan' => 'Bukti Pembayaran', 'tipe_file' => 'pdf', 'ukuran' => '4096 MB', 'wajib' => 'Wajib', 'status' => 'Aktif'],
            ['layanan_id' => 2, 'persyaratan' => 'Bukti Pembayaran', 'tipe_file' => 'pdf', 'ukuran' => '4096 MB', 'wajib' => 'Wajib', 'status' => 'Aktif'],
            ['layanan_id' => 3, 'persyaratan' => 'Bukti Pembayaran', 'tipe_file' => 'pdf', 'ukuran' => '4096 MB', 'wajib' => 'Wajib', 'status' => 'Aktif'],
            ['layanan_id' => 4, 'persyaratan' => 'Bukti Pembayaran', 'tipe_file' => 'pdf', 'ukuran' => '4096 MB', 'wajib' => 'Wajib', 'status' => 'Aktif'],
            ['layanan_id' => 5, 'persyaratan' => 'Draft Surat', 'tipe_file' => 'pdf', 'ukuran' => '4096 MB', 'wajib' => 'Wajib', 'status' => 'Aktif'],
            ['layanan_id' => 6, 'persyaratan' => 'Form Konseling', 'tipe_file' => 'pdf', 'ukuran' => '2048 MB', 'wajib' => 'Wajib', 'status' => 'Aktif'],
            ['layanan_id' => 7, 'persyaratan' => 'Form Pengajuan Judul', 'tipe_file' => 'pdf', 'ukuran' => '4096 MB', 'wajib' => 'Wajib', 'status' => 'Aktif'],
            ['layanan_id' => 8, 'persyaratan' => 'Form Usulan Buku', 'tipe_file' => 'pdf', 'ukuran' => '2048 MB', 'wajib' => 'Wajib', 'status' => 'Aktif'],
            ['layanan_id' => 9, 'persyaratan' => 'Formulir Pendaftaran', 'tipe_file' => 'pdf', 'ukuran' => '4096 MB', 'wajib' => 'Wajib', 'status' => 'Aktif'],
            ['layanan_id' => 10, 'persyaratan' => 'KHS Terbaru', 'tipe_file' => 'pdf', 'ukuran' => '4096 MB', 'wajib' => 'Wajib', 'status' => 'Aktif'],
        ];

        foreach ($data as &$row) {
            $row['created_at'] = date('Y-m-d H:i:s');
            $row['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db->table('persyaratan_layanan')->insertBatch($data);
    }
}
