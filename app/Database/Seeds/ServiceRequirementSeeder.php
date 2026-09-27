<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ServiceRequirementSeeder extends Seeder
{
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        /*
        |--------------------------------------------------------------------------
        | Mapping Service
        |--------------------------------------------------------------------------
        */

        $serviceMap = [];

        foreach ($this->db->table('master_services')->get()->getResultArray() as $service) {
            $serviceMap[$service['code']] = $service['id'];
        }

        $requirements = [

            [
                'service_id' => $serviceMap['SURAT-AKTIF'],
                'name' => 'KTM',
                'description' => 'Scan KTM',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['SURAT-AKTIF'],
                'name' => 'KRS Semester Berjalan',
                'description' => 'Scan KRS',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['SURAT-MHS'],
                'name' => 'KTM',
                'description' => 'Scan KTM',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,png',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['SURAT-MHS'],
                'name' => 'KRS',
                'description' => 'KRS aktif',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['DAFTAR-NILAI'],
                'name' => 'KTM',
                'description' => 'Scan KTM',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,png',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['LEGALISIR-IJAZAH'],
                'name' => 'Scan Ijazah',
                'description' => 'Ijazah asli',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['LEGALISIR-IJAZAH'],
                'name' => 'KTP',
                'description' => 'Identitas',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,png',
                'max_file_size' => 2048,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['LEGALISIR-TRANSKRIP'],
                'name' => 'Scan Transkrip',
                'description' => 'Transkrip nilai',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PENYESUAIAN UKT
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['PENGAJUAN-UKT'],
                'name' => 'Surat Permohonan',
                'description' => 'Surat permohonan penyesuaian UKT.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['PENGAJUAN-UKT'],
                'name' => 'KTM',
                'description' => 'Scan KTM.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['PENGAJUAN-UKT'],
                'name' => 'Kartu Keluarga',
                'description' => 'Scan KK.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 4096,
                'sort_order' => 3,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['PENGAJUAN-UKT'],
                'name' => 'Slip Gaji Orang Tua',
                'description' => 'Slip gaji atau surat penghasilan.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 4096,
                'sort_order' => 4,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| CICILAN UKT
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['CICILAN-UKT'],
                'name' => 'Surat Permohonan',
                'description' => 'Surat permohonan cicilan UKT.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['CICILAN-UKT'],
                'name' => 'KTM',
                'description' => 'Scan KTM.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['CICILAN-UKT'],
                'name' => 'KRS',
                'description' => 'KRS semester berjalan.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 3,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PENUNDAAN PEMBAYARAN UKT
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['PENUNDAAN-UKT'],
                'name' => 'Surat Permohonan',
                'description' => 'Surat penundaan pembayaran.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['PENUNDAAN-UKT'],
                'name' => 'KTM',
                'description' => 'Scan KTM.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| VALIDASI PEMBAYARAN
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['VALIDASI-PEMBAYARAN'],
                'name' => 'Bukti Pembayaran',
                'description' => 'Upload bukti pembayaran.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PENGEMBALIAN DANA
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['PENGEMBALIAN-DANA'],
                'name' => 'Surat Permohonan',
                'description' => 'Surat pengembalian dana.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['PENGEMBALIAN-DANA'],
                'name' => 'Bukti Pembayaran',
                'description' => 'Bukti transfer/pembayaran.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 4096,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| KWITANSI PEMBAYARAN
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['KWITANSI'],
                'name' => 'Bukti Pembayaran',
                'description' => 'Upload bukti pembayaran.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| KOREKSI PEMBAYARAN
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['KOREKSI-PEMBAYARAN'],
                'name' => 'Bukti Pembayaran',
                'description' => 'Upload bukti pembayaran.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['KOREKSI-PEMBAYARAN'],
                'name' => 'Surat Permohonan',
                'description' => 'Jelaskan data yang perlu diperbaiki.',
                'is_required' => 0,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PENDAFTARAN BEASISWA
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['BEASISWA-PENDAFTARAN'],
                'name' => 'Formulir Pendaftaran',
                'description' => 'Formulir pendaftaran beasiswa.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['BEASISWA-PENDAFTARAN'],
                'name' => 'KTM',
                'description' => 'Scan KTM.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['BEASISWA-PENDAFTARAN'],
                'name' => 'KHS / Transkrip Nilai',
                'description' => 'Nilai akademik terbaru.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 3,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['BEASISWA-PENDAFTARAN'],
                'name' => 'Surat Penghasilan Orang Tua',
                'description' => 'Surat keterangan penghasilan.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 4,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PERPANJANGAN BEASISWA
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['BEASISWA-PERPANJANGAN'],
                'name' => 'KHS Terbaru',
                'description' => 'KHS semester terakhir.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['BEASISWA-PERPANJANGAN'],
                'name' => 'Surat Pernyataan',
                'description' => 'Surat pernyataan masih memenuhi syarat.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| SURAT REKOMENDASI BEASISWA
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['BEASISWA-SURAT'],
                'name' => 'Surat Permohonan',
                'description' => 'Permohonan surat rekomendasi.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PERSETUJUAN KEGIATAN ORMAWA
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['ORMAWA-KEGIATAN'],
                'name' => 'Proposal Kegiatan',
                'description' => 'Proposal kegiatan organisasi.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 8192,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['ORMAWA-KEGIATAN'],
                'name' => 'Susunan Panitia',
                'description' => 'Daftar panitia kegiatan.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PENDANAAN KEGIATAN
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['ORMAWA-PENDANAAN'],
                'name' => 'Proposal Anggaran',
                'description' => 'Proposal dan RAB kegiatan.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 8192,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PEMINJAMAN FASILITAS
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['ORMAWA-FASILITAS'],
                'name' => 'Surat Permohonan',
                'description' => 'Surat peminjaman fasilitas.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PELAPORAN PRESTASI
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['PRESTASI-MHS'],
                'name' => 'Sertifikat Prestasi',
                'description' => 'Sertifikat atau piagam prestasi.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['PRESTASI-MHS'],
                'name' => 'Dokumentasi',
                'description' => 'Foto atau dokumentasi kegiatan.',
                'is_required' => 0,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 8192,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| KONSELING MAHASISWA
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['KONSELING-MHS'],
                'name' => 'Form Konseling',
                'description' => 'Formulir permohonan konseling.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| SURAT BEBAS PUSTAKA
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['BEBAS-PUSTAKA'],
                'name' => 'KTM',
                'description' => 'Scan KTM.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['BEBAS-PUSTAKA'],
                'name' => 'KRS Terakhir',
                'description' => 'KRS semester terakhir.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PENDAFTARAN ANGGOTA PERPUSTAKAAN
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['DAFTAR-ANGGOTA'],
                'name' => 'KTM',
                'description' => 'Scan KTM.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PENGGANTIAN KARTU PERPUSTAKAAN
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['GANTI-KARTU-PERPUS'],
                'name' => 'Surat Kehilangan (Jika Hilang)',
                'description' => 'Surat kehilangan dari kepolisian (opsional jika hilang).',
                'is_required' => 0,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['GANTI-KARTU-PERPUS'],
                'name' => 'KTM',
                'description' => 'Scan KTM.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PEMBAYARAN DENDA
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['DENDA-PERPUS'],
                'name' => 'Bukti Pembayaran',
                'description' => 'Upload bukti pembayaran denda.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| USUL PENGADAAN BUKU
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['USUL-BUKU'],
                'name' => 'Form Usulan Buku',
                'description' => 'Form usulan pengadaan buku.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PENELUSURAN LITERATUR
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['LITERATUR'],
                'name' => 'Topik Penelitian',
                'description' => 'Dokumen atau uraian topik penelitian.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,doc,docx',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| DOSEN PEMBIMBING AKADEMIK
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['DOSEN-PA'],
                'name' => 'KTM',
                'description' => 'Scan KTM',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PENGAJUAN PKL
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['PKL'],
                'name' => 'Proposal PKL',
                'description' => 'Proposal Kerja Praktik',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 8192,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['PKL'],
                'name' => 'Transkrip Nilai',
                'description' => 'Transkrip sementara',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['PKL'],
                'name' => 'KRS',
                'description' => 'KRS aktif',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 3,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| MAGANG
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['MAGANG'],
                'name' => 'Proposal Magang',
                'description' => 'Proposal magang',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 8192,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['MAGANG'],
                'name' => 'CV',
                'description' => 'Curriculum Vitae',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 2048,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| DOSEN PEMBIMBING TA
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['TA-PEMBIMBING'],
                'name' => 'Proposal TA',
                'description' => 'Proposal tugas akhir',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 8192,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['TA-PEMBIMBING'],
                'name' => 'Transkrip Nilai',
                'description' => 'Transkrip akademik',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| JUDUL TA
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['TA-JUDUL'],
                'name' => 'Form Pengajuan Judul',
                'description' => 'Form pengajuan judul',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['TA-JUDUL'],
                'name' => 'Proposal Singkat',
                'description' => 'Ringkasan proposal',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| SEMINAR PROPOSAL
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['SEMPRO'],
                'name' => 'Proposal TA',
                'description' => 'Proposal lengkap',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 8192,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['SEMPRO'],
                'name' => 'Lembar Persetujuan Pembimbing',
                'description' => 'Persetujuan pembimbing',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 2048,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| SEMINAR HASIL
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['SEMHAS'],
                'name' => 'Laporan TA',
                'description' => 'Draft laporan TA',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 10240,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['SEMHAS'],
                'name' => 'Lembar Bimbingan',
                'description' => 'Lembar konsultasi',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| SIDANG TA
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['SIDANG-TA'],
                'name' => 'Laporan Final',
                'description' => 'Laporan tugas akhir final',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 15360,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['SIDANG-TA'],
                'name' => 'Lembar Persetujuan',
                'description' => 'Persetujuan pembimbing',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 4096,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['SIDANG-TA'],
                'name' => 'Bukti Bebas Pustaka',
                'description' => 'Surat bebas pustaka',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 2048,
                'sort_order' => 3,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| SURAT PENGANTAR JURUSAN
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['SURAT-PENGANTAR'],
                'name' => 'Surat Permohonan',
                'description' => 'Surat permohonan',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| RESET PASSWORD
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['RESET-PASSWORD'],
                'name' => 'KTM',
                'description' => 'Scan KTM',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| AKTIVASI AKUN
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['AKTIVASI-AKUN'],
                'name' => 'KTM',
                'description' => 'Scan KTM',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| EMAIL INSTITUSI
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['EMAIL-INSTITUSI'],
                'name' => 'KTM',
                'description' => 'Scan KTM',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PERUBAHAN DATA AKUN
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['UBAH-DATA-AKUN'],
                'name' => 'KTP / KTM',
                'description' => 'Identitas pemohon.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| WIFI KAMPUS
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['WIFI-KAMPUS'],
                'name' => 'KTM',
                'description' => 'Scan KTM.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,jpg,jpeg,png',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| VPN
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['VPN'],
                'name' => 'Surat Permohonan',
                'description' => 'Permohonan akses VPN.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| HELPDESK TI
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['HELPDESK-TI'],
                'name' => 'Screenshot Kendala',
                'description' => 'Screenshot error (opsional).',
                'is_required' => 0,
                'allowed_extensions' => 'jpg,jpeg,png,pdf',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PEMINJAMAN RUANGAN
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['PINJAM-RUANG'],
                'name' => 'Surat Permohonan',
                'description' => 'Surat peminjaman ruangan.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'service_id' => $serviceMap['PINJAM-RUANG'],
                'name' => 'Proposal Kegiatan',
                'description' => 'Proposal kegiatan (jika ada).',
                'is_required' => 0,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 8192,
                'sort_order' => 2,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| PEMINJAMAN SARANA PRASARANA
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['PINJAM-SARPRAS'],
                'name' => 'Surat Permohonan',
                'description' => 'Surat permohonan peminjaman.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf',
                'max_file_size' => 2048,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            /*
|--------------------------------------------------------------------------
| SURAT MASUK / KELUAR
|--------------------------------------------------------------------------
*/

            [
                'service_id' => $serviceMap['SURAT-MASUK'],
                'name' => 'Draft Surat',
                'description' => 'Draft surat yang akan diproses.',
                'is_required' => 1,
                'allowed_extensions' => 'pdf,doc,docx',
                'max_file_size' => 4096,
                'sort_order' => 1,
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],

        ];

        $this->db->table('master_service_requirements')->insertBatch($requirements);
    }
}
