<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['unit_layanan_id' => 2, 'kategori_layanan_id' => 1, 'kode' => 'SURAT-AKTIF', 'nama' => 'Surat Keterangan Aktif Kuliah', 'sla' => 24, 'online' => 'Online', 'status' => 'Aktif'],
            ['unit_layanan_id' => 2, 'kategori_layanan_id' => 1, 'kode' => 'SURAT-MHS', 'nama' => 'Surat Keterangan Mahasiswa', 'sla' => 24, 'online' => 'Online', 'status' => 'Aktif'],
            ['unit_layanan_id' => 2, 'kategori_layanan_id' => 1, 'kode' => 'DAFTAR-NILAI', 'nama' => 'Permohonan Daftar Nilai', 'sla' => 24, 'online' => 'Online', 'status' => 'Aktif'],
            ['unit_layanan_id' => 2, 'kategori_layanan_id' => 1, 'kode' => 'LEGALISIR-IJAZAH', 'nama' => 'Legalisasi Ijazah', 'sla' => 48, 'online' => 'Online', 'status' => 'Aktif'],
            ['unit_layanan_id' => 2, 'kategori_layanan_id' => 1, 'kode' => 'LEGALISIR-TRANSKRIP', 'nama' => 'Legalisasi Transkrip Nilai', 'sla' => 48, 'online' => 'Online', 'status' => 'Aktif'],
            ['unit_layanan_id' => 2, 'kategori_layanan_id' => 2, 'kode' => 'CUTI-AKADEMIK', 'nama' => 'Pengajuan Cuti Akademik', 'sla' => 72, 'online' => 'Online', 'status' => 'Aktif'],
            ['unit_layanan_id' => 2, 'kategori_layanan_id' => 2, 'kode' => 'AKTIF-KEMBALI', 'nama' => 'Aktif Kembali Setelah Cuti', 'sla' => 72, 'online' => 'Online', 'status' => 'Aktif'],
            ['unit_layanan_id' => 2, 'kategori_layanan_id' => 2, 'kode' => 'PENGUNDURAN-DIRI', 'nama' => 'Pengunduran Diri Mahasiswa', 'sla' => 120, 'online' => 'Online', 'status' => 'Aktif'],
            ['unit_layanan_id' => 2, 'kategori_layanan_id' => 3, 'kode' => 'PENDAFTARAN-WISUDA', 'nama' => 'Pendaftaran Wisuda', 'sla' => 72, 'online' => 'Online', 'status' => 'Aktif'],
            ['unit_layanan_id' => 2, 'kategori_layanan_id' => 3, 'kode' => 'YUDISIUM', 'nama' => 'Administrasi Yudisium', 'sla' => 72, 'online' => 'Online', 'status' => 'Aktif'],
        ];

        foreach ($data as &$row) {
            $row['created_at'] = date('Y-m-d H:i:s');
            $row['updated_at'] = date('Y-m-d H:i:s');
        }

        $this->db->table('layanans')->insertBatch($data);
    }
}
