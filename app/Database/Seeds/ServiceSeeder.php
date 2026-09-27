<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        /*
        |--------------------------------------------------------------------------
        | Mapping Unit
        |--------------------------------------------------------------------------
        */

        $unitMap = [];

        foreach ($this->db->table('master_service_units')->get()->getResultArray() as $row) {
            $unitMap[$row['code']] = $row['id'];
        }

        /*
        |--------------------------------------------------------------------------
        | Mapping Category
        |--------------------------------------------------------------------------
        */

        $categoryMap = [];

        foreach ($this->db->table('master_service_categories')->get()->getResultArray() as $row) {
            $categoryMap[$row['code']] = $row['id'];
        }

        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */

        $services = [

            /*
            ==========================================================
            AKADEMIK
            ==========================================================
            */

            [
                'service_unit_id' => $unitMap['AKD'],
                'service_category_id' => $categoryMap['AKD-SURAT'],
                'code' => 'SURAT-AKTIF',
                'name' => 'Surat Keterangan Aktif Kuliah',
                'description' => 'Permohonan Surat Keterangan Aktif Kuliah.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['AKD'],
                'service_category_id' => $categoryMap['AKD-SURAT'],
                'code' => 'SURAT-MHS',
                'name' => 'Surat Keterangan Mahasiswa',
                'description' => 'Permohonan Surat Keterangan Mahasiswa.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['AKD'],
                'service_category_id' => $categoryMap['AKD-SURAT'],
                'code' => 'DAFTAR-NILAI',
                'name' => 'Permohonan Daftar Nilai',
                'description' => 'Permohonan Daftar Nilai Akademik.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 3,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['AKD'],
                'service_category_id' => $categoryMap['AKD-SURAT'],
                'code' => 'LEGALISIR-IJAZAH',
                'name' => 'Legalisasi Ijazah',
                'description' => 'Permohonan legalisasi ijazah.',
                'service_hours' => 48,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 4,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['AKD'],
                'service_category_id' => $categoryMap['AKD-SURAT'],
                'code' => 'LEGALISIR-TRANSKRIP',
                'name' => 'Legalisasi Transkrip Nilai',
                'description' => 'Permohonan legalisasi transkrip nilai.',
                'service_hours' => 48,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 5,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            ==========================================================
            STATUS MAHASISWA
            ==========================================================
            */

            [
                'service_unit_id' => $unitMap['AKD'],
                'service_category_id' => $categoryMap['AKD-STATUS'],
                'code' => 'CUTI-AKADEMIK',
                'name' => 'Pengajuan Cuti Akademik',
                'description' => 'Pengajuan cuti akademik.',
                'service_hours' => 72,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 6,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['AKD'],
                'service_category_id' => $categoryMap['AKD-STATUS'],
                'code' => 'AKTIF-KEMBALI',
                'name' => 'Aktif Kembali Setelah Cuti',
                'description' => 'Permohonan aktif kembali setelah cuti.',
                'service_hours' => 72,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 7,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['AKD'],
                'service_category_id' => $categoryMap['AKD-STATUS'],
                'code' => 'PENGUNDURAN-DIRI',
                'name' => 'Pengunduran Diri Mahasiswa',
                'description' => 'Permohonan pengunduran diri sebagai mahasiswa.',
                'service_hours' => 120,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 8,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            ==========================================================
            WISUDA
            ==========================================================
            */

            [
                'service_unit_id' => $unitMap['AKD'],
                'service_category_id' => $categoryMap['AKD-WISUDA'],
                'code' => 'PENDAFTARAN-WISUDA',
                'name' => 'Pendaftaran Wisuda',
                'description' => 'Permohonan pendaftaran wisuda.',
                'service_hours' => 72,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 9,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['AKD'],
                'service_category_id' => $categoryMap['AKD-WISUDA'],
                'code' => 'YUDISIUM',
                'name' => 'Administrasi Yudisium',
                'description' => 'Permohonan administrasi yudisium.',
                'service_hours' => 72,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 10,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            ==========================================================
            KEUANGAN - UKT
            ==========================================================
            */

            [
                'service_unit_id' => $unitMap['KEU'],
                'service_category_id' => $categoryMap['KEU-UKT'],
                'code' => 'PENGAJUAN-UKT',
                'name' => 'Pengajuan Penyesuaian UKT',
                'description' => 'Pengajuan penyesuaian besaran UKT.',
                'service_hours' => 120,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 11,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['KEU'],
                'service_category_id' => $categoryMap['KEU-UKT'],
                'code' => 'CICILAN-UKT',
                'name' => 'Pengajuan Cicilan UKT',
                'description' => 'Pengajuan pembayaran UKT secara cicilan.',
                'service_hours' => 120,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 12,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['KEU'],
                'service_category_id' => $categoryMap['KEU-UKT'],
                'code' => 'PENUNDAAN-UKT',
                'name' => 'Pengajuan Penundaan Pembayaran UKT',
                'description' => 'Pengajuan penundaan pembayaran UKT.',
                'service_hours' => 120,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 13,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            ==========================================================
            ADMINISTRASI PEMBAYARAN
            ==========================================================
            */

            [
                'service_unit_id' => $unitMap['KEU'],
                'service_category_id' => $categoryMap['KEU-PEMBAYARAN'],
                'code' => 'VALIDASI-PEMBAYARAN',
                'name' => 'Validasi Pembayaran',
                'description' => 'Validasi bukti pembayaran mahasiswa.',
                'service_hours' => 24,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 14,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['KEU'],
                'service_category_id' => $categoryMap['KEU-PEMBAYARAN'],
                'code' => 'PENGEMBALIAN-DANA',
                'name' => 'Pengembalian Dana',
                'description' => 'Permohonan pengembalian dana pembayaran.',
                'service_hours' => 168,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 15,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['KEU'],
                'service_category_id' => $categoryMap['KEU-PEMBAYARAN'],
                'code' => 'KWITANSI',
                'name' => 'Permohonan Kwitansi Pembayaran',
                'description' => 'Permohonan penerbitan kwitansi pembayaran resmi.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 16,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['KEU'],
                'service_category_id' => $categoryMap['KEU-PEMBAYARAN'],
                'code' => 'KOREKSI-PEMBAYARAN',
                'name' => 'Koreksi Data Pembayaran',
                'description' => 'Permohonan koreksi data pembayaran mahasiswa.',
                'service_hours' => 48,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 17,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            ==========================================================
            KEMAHASISWAAN - BEASISWA
            ==========================================================
            */

            [
                'service_unit_id' => $unitMap['KEMHS'],
                'service_category_id' => $categoryMap['KMH-BEASISWA'],
                'code' => 'BEASISWA-PENDAFTARAN',
                'name' => 'Pendaftaran Beasiswa',
                'description' => 'Pengajuan pendaftaran program beasiswa.',
                'service_hours' => 120,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 18,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['KEMHS'],
                'service_category_id' => $categoryMap['KMH-BEASISWA'],
                'code' => 'BEASISWA-PERPANJANGAN',
                'name' => 'Perpanjangan Beasiswa',
                'description' => 'Pengajuan perpanjangan beasiswa.',
                'service_hours' => 120,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 19,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['KEMHS'],
                'service_category_id' => $categoryMap['KMH-BEASISWA'],
                'code' => 'BEASISWA-SURAT',
                'name' => 'Surat Rekomendasi Beasiswa',
                'description' => 'Permohonan surat rekomendasi beasiswa.',
                'service_hours' => 48,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 20,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
            ==========================================================
            ORGANISASI MAHASISWA
            ==========================================================
            */

            [
                'service_unit_id' => $unitMap['KEMHS'],
                'service_category_id' => $categoryMap['KMH-ORMAWA'],
                'code' => 'ORMAWA-KEGIATAN',
                'name' => 'Persetujuan Kegiatan Organisasi Mahasiswa',
                'description' => 'Pengajuan persetujuan kegiatan organisasi mahasiswa.',
                'service_hours' => 72,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 21,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['KEMHS'],
                'service_category_id' => $categoryMap['KMH-ORMAWA'],
                'code' => 'ORMAWA-PENDANAAN',
                'name' => 'Pengajuan Pendanaan Kegiatan',
                'description' => 'Pengajuan bantuan dana kegiatan organisasi mahasiswa.',
                'service_hours' => 120,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 22,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['KEMHS'],
                'service_category_id' => $categoryMap['KMH-ORMAWA'],
                'code' => 'ORMAWA-FASILITAS',
                'name' => 'Peminjaman Fasilitas Kegiatan',
                'description' => 'Pengajuan peminjaman fasilitas untuk kegiatan mahasiswa.',
                'service_hours' => 48,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 23,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['KEMHS'],
                'service_category_id' => $categoryMap['KMH-ORMAWA'],
                'code' => 'PRESTASI-MHS',
                'name' => 'Pelaporan Prestasi Mahasiswa',
                'description' => 'Pelaporan prestasi akademik maupun non-akademik mahasiswa.',
                'service_hours' => 48,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 24,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['KEMHS'],
                'service_category_id' => $categoryMap['KMH-ORMAWA'],
                'code' => 'KONSELING-MHS',
                'name' => 'Layanan Konseling Mahasiswa',
                'description' => 'Pengajuan layanan konseling mahasiswa.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 25,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
==========================================================
PERPUSTAKAAN
==========================================================
*/

            [
                'service_unit_id' => $unitMap['PERPUS'],
                'service_category_id' => $categoryMap['PERPUS-LAYANAN'],
                'code' => 'BEBAS-PUSTAKA',
                'name' => 'Surat Bebas Pustaka',
                'description' => 'Permohonan Surat Bebas Pustaka bagi mahasiswa.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 26,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['PERPUS'],
                'service_category_id' => $categoryMap['PERPUS-LAYANAN'],
                'code' => 'DAFTAR-ANGGOTA',
                'name' => 'Pendaftaran Anggota Perpustakaan',
                'description' => 'Pendaftaran anggota perpustakaan.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 27,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['PERPUS'],
                'service_category_id' => $categoryMap['PERPUS-LAYANAN'],
                'code' => 'GANTI-KARTU-PERPUS',
                'name' => 'Penggantian Kartu Perpustakaan',
                'description' => 'Permohonan penggantian kartu anggota perpustakaan.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 28,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['PERPUS'],
                'service_category_id' => $categoryMap['PERPUS-LAYANAN'],
                'code' => 'DENDA-PERPUS',
                'name' => 'Pembayaran Denda Perpustakaan',
                'description' => 'Layanan pembayaran denda keterlambatan pengembalian buku.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 29,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['PERPUS'],
                'service_category_id' => $categoryMap['PERPUS-LAYANAN'],
                'code' => 'USUL-BUKU',
                'name' => 'Usulan Pengadaan Buku',
                'description' => 'Pengajuan usulan pengadaan koleksi buku baru.',
                'service_hours' => 168,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 30,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['PERPUS'],
                'service_category_id' => $categoryMap['PERPUS-LAYANAN'],
                'code' => 'LITERATUR',
                'name' => 'Bantuan Penelusuran Literatur',
                'description' => 'Permohonan bantuan pencarian referensi ilmiah.',
                'service_hours' => 48,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 31,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
==========================================================
JURUSAN / PROGRAM STUDI
==========================================================
*/

            [
                'service_unit_id' => $unitMap['JUR'],
                'service_category_id' => $categoryMap['JUR-AKADEMIK'],
                'code' => 'DOSEN-PA',
                'name' => 'Pengajuan Dosen Pembimbing Akademik',
                'description' => 'Permohonan penetapan atau perubahan dosen pembimbing akademik.',
                'service_hours' => 72,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 32,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['JUR'],
                'service_category_id' => $categoryMap['JUR-AKADEMIK'],
                'code' => 'PKL',
                'name' => 'Pengajuan Kerja Praktik / PKL',
                'description' => 'Pengajuan administrasi Kerja Praktik atau PKL.',
                'service_hours' => 72,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 33,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['JUR'],
                'service_category_id' => $categoryMap['JUR-AKADEMIK'],
                'code' => 'MAGANG',
                'name' => 'Pengajuan Magang',
                'description' => 'Pengajuan administrasi kegiatan magang.',
                'service_hours' => 72,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 34,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['JUR'],
                'service_category_id' => $categoryMap['JUR-TA'],
                'code' => 'TA-PEMBIMBING',
                'name' => 'Pengajuan Dosen Pembimbing Tugas Akhir',
                'description' => 'Permohonan penetapan dosen pembimbing tugas akhir.',
                'service_hours' => 72,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 35,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['JUR'],
                'service_category_id' => $categoryMap['JUR-TA'],
                'code' => 'TA-JUDUL',
                'name' => 'Pengajuan Judul Tugas Akhir',
                'description' => 'Pengajuan atau perubahan judul tugas akhir.',
                'service_hours' => 72,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 36,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['JUR'],
                'service_category_id' => $categoryMap['JUR-TA'],
                'code' => 'SEMPRO',
                'name' => 'Pendaftaran Seminar Proposal',
                'description' => 'Pendaftaran seminar proposal tugas akhir.',
                'service_hours' => 72,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 37,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['JUR'],
                'service_category_id' => $categoryMap['JUR-TA'],
                'code' => 'SEMHAS',
                'name' => 'Pendaftaran Seminar Hasil',
                'description' => 'Pendaftaran seminar hasil tugas akhir.',
                'service_hours' => 72,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 38,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['JUR'],
                'service_category_id' => $categoryMap['JUR-TA'],
                'code' => 'SIDANG-TA',
                'name' => 'Pendaftaran Sidang Tugas Akhir',
                'description' => 'Pendaftaran sidang tugas akhir.',
                'service_hours' => 120,
                'max_file_size' => 4096,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 39,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['JUR'],
                'service_category_id' => $categoryMap['JUR-AKADEMIK'],
                'code' => 'SURAT-PENGANTAR',
                'name' => 'Surat Pengantar Jurusan',
                'description' => 'Permohonan surat pengantar dari jurusan.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 40,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
==========================================================
UPTIK / TEKNOLOGI INFORMASI
==========================================================
*/

            [
                'service_unit_id' => $unitMap['UPTIK'],
                'service_category_id' => $categoryMap['UPTIK-AKUN'],
                'code' => 'RESET-PASSWORD',
                'name' => 'Reset Password Akun Mahasiswa',
                'description' => 'Permohonan reset password akun mahasiswa.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 41,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['UPTIK'],
                'service_category_id' => $categoryMap['UPTIK-AKUN'],
                'code' => 'AKTIVASI-AKUN',
                'name' => 'Aktivasi Akun Mahasiswa',
                'description' => 'Permohonan aktivasi akun mahasiswa.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 42,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['UPTIK'],
                'service_category_id' => $categoryMap['UPTIK-AKUN'],
                'code' => 'EMAIL-INSTITUSI',
                'name' => 'Aktivasi Email Institusi',
                'description' => 'Permohonan aktivasi email institusi.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 43,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['UPTIK'],
                'service_category_id' => $categoryMap['UPTIK-AKUN'],
                'code' => 'UBAH-DATA-AKUN',
                'name' => 'Perubahan Data Akun',
                'description' => 'Permohonan perubahan data akun pengguna.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 44,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
==========================================================
UPTIK - LAYANAN TI
==========================================================
*/

            [
                'service_unit_id' => $unitMap['UPTIK'],
                'service_category_id' => $categoryMap['UPTIK-LAYANAN'],
                'code' => 'WIFI-KAMPUS',
                'name' => 'Akses WiFi Kampus',
                'description' => 'Permohonan bantuan akses WiFi kampus.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 45,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['UPTIK'],
                'service_category_id' => $categoryMap['UPTIK-LAYANAN'],
                'code' => 'VPN',
                'name' => 'Akses VPN Kampus',
                'description' => 'Permohonan akses VPN kampus.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 46,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['UPTIK'],
                'service_category_id' => $categoryMap['UPTIK-LAYANAN'],
                'code' => 'HELPDESK-TI',
                'name' => 'Layanan Helpdesk TI',
                'description' => 'Pelaporan kendala layanan teknologi informasi.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 47,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
==========================================================
ADMINISTRASI UMUM
==========================================================
*/

            [
                'service_unit_id' => $unitMap['ADM'],
                'service_category_id' => $categoryMap['ADM-UMUM'],
                'code' => 'PINJAM-RUANG',
                'name' => 'Peminjaman Ruangan',
                'description' => 'Permohonan peminjaman ruangan.',
                'service_hours' => 48,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 48,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['ADM'],
                'service_category_id' => $categoryMap['ADM-UMUM'],
                'code' => 'PINJAM-SARPRAS',
                'name' => 'Peminjaman Sarana dan Prasarana',
                'description' => 'Permohonan peminjaman sarana dan prasarana.',
                'service_hours' => 48,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 49,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_unit_id' => $unitMap['ADM'],
                'service_category_id' => $categoryMap['ADM-UMUM'],
                'code' => 'SURAT-MASUK',
                'name' => 'Layanan Surat Masuk dan Keluar',
                'description' => 'Administrasi surat masuk dan surat keluar.',
                'service_hours' => 24,
                'max_file_size' => 2048,
                'is_online' => 1,
                'is_active' => 1,
                'sort_order' => 50,
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ];

        $this->db->table('master_services')->insertBatch($services);
    }
}
