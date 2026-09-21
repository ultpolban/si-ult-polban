<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

/**
 * Seeder mapping akses layanan berdasarkan jenis pemohon.
 *
 * Matriks ini menentukan jenis pemohon mana saja yang BOLEH mengakses
 * suatu layanan. Jenis pemohon yang tidak tercantum TIDAK BOLEH mengakses
 * layanan tersebut (dicek pada form pengajuan & tiket).
 */
class ServiceApplicantTypeSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // Ambil ID berdasarkan kode agar mapping tidak rapuh terhadap urutan
        $services = $db->table('master_services')
            ->select('id, code')
            ->where('is_active', 1)
            ->get()
            ->getResultArray();

        $applicantTypes = $db->table('master_applicant_types')
            ->select('id, code')
            ->get()
            ->getResultArray();

        $serviceIds = [];
        foreach ($services as $service) {
            $serviceIds[strtoupper($service['code'])] = (int) $service['id'];
        }

        $applicantIds = [];
        foreach ($applicantTypes as $type) {
            $applicantIds[strtoupper($type['code'])] = (int) $type['id'];
        }

        /*
        |--------------------------------------------------------------------------
        | Matriks akses: kode layanan => daftar kode jenis pemohon yang diizinkan
        |--------------------------------------------------------------------------
        |
        | MHS  = Mahasiswa          CAMABA = Calon Mahasiswa
        | ALUMNI = Alumni            DOSEN = Dosen
        | TENDIK = Tendik            MITRA = Mitra
        | INSTANSI = Instansi        UMUM = Masyarakat Umum
        | WALI = Orang Tua / Wali
        |
        */
        $mapping = [
            // Akademik & Administrasi Akademik
            'SURAT-AKTIF'        => ['MHS'],
            'SURAT-MHS'          => ['MHS'],
            'DAFTAR-NILAI'       => ['MHS', 'ALUMNI'],
            'LEGALISIR-IJAZAH'   => ['MHS', 'ALUMNI'],
            'LEGALISIR-TRANSKRIP'=> ['MHS', 'ALUMNI'],
            'CUTI-AKADEMIK'      => ['MHS'],
            'AKTIF-KEMBALI'      => ['MHS'],
            'PENGUNDURAN-DIRI'   => ['MHS'],
            'PENDAFTARAN-WISUDA' => ['MHS', 'ALUMNI'],
            'YUDISIUM'           => ['MHS'],

            // Keuangan
            'PENGAJUAN-UKT'      => ['MHS', 'WALI'],
            'CICILAN-UKT'        => ['MHS', 'WALI'],
            'PENUNDAAN-UKT'      => ['MHS', 'WALI'],
            'VALIDASI-PEMBAYARAN'=> ['MHS', 'WALI'],
            'PENGEMBALIAN-DANA'  => ['MHS', 'WALI'],
            'KWITANSI'           => ['MHS', 'WALI'],
            'KOREKSI-PEMBAYARAN' => ['MHS', 'WALI'],

            // Beasiswa & Kemahasiswaan
            'BEASISWA-PENDAFTARAN' => ['MHS', 'CAMABA'],
            'BEASISWA-PERPANJANGAN'=> ['MHS'],
            'BEASISWA-SURAT'       => ['MHS'],
            'ORMAWA-KEGIATAN'      => ['MHS'],
            'ORMAWA-PENDANAAN'     => ['MHS'],
            'ORMAWA-FASILITAS'     => ['MHS'],
            'PRESTASI-MHS'         => ['MHS'],
            'KONSELING-MHS'        => ['MHS'],

            // Perpustakaan
            'BEBAS-PUSTAKA'        => ['MHS', 'ALUMNI'],
            'DAFTAR-ANGGOTA'       => ['MHS', 'DOSEN', 'TENDIK', 'UMUM'],
            'GANTI-KARTU-PERPUS'   => ['MHS', 'DOSEN', 'TENDIK', 'UMUM'],
            'DENDA-PERPUS'         => ['MHS', 'DOSEN', 'TENDIK', 'UMUM'],
            'USUL-BUKU'            => ['MHS', 'DOSEN', 'TENDIK'],
            'LITERATUR'            => ['MHS', 'ALUMNI', 'DOSEN', 'TENDIK'],

            // Akademik Jurusan
            'DOSEN-PA'             => ['MHS'],
            'PKL'                  => ['MHS'],
            'MAGANG'               => ['MHS'],
            'TA-PEMBIMBING'        => ['MHS'],
            'TA-JUDUL'             => ['MHS'],
            'SEMPRO'               => ['MHS'],
            'SEMHAS'               => ['MHS'],
            'SIDANG-TA'            => ['MHS'],
            'SURAT-PENGANTAR'      => ['MHS', 'ALUMNI'],

            // TIK & Akun
            'RESET-PASSWORD'       => ['MHS', 'CAMABA', 'DOSEN', 'TENDIK'],
            'AKTIVASI-AKUN'        => ['MHS', 'CAMABA', 'DOSEN', 'TENDIK'],
            'EMAIL-INSTITUSI'      => ['MHS', 'DOSEN', 'TENDIK'],
            'UBAH-DATA-AKUN'       => ['MHS', 'DOSEN', 'TENDIK'],
            'WIFI-KAMPUS'          => ['MHS', 'DOSEN', 'TENDIK'],
            'VPN'                  => ['MHS', 'DOSEN', 'TENDIK'],
            'HELPDESK-TI'          => ['MHS', 'DOSEN', 'TENDIK', 'UMUM'],

            // Sarana, Prasarana & Umum
            'PINJAM-RUANG'         => ['MHS', 'DOSEN', 'TENDIK', 'UMUM'],
            'PINJAM-SARPRAS'       => ['MHS', 'DOSEN', 'TENDIK', 'UMUM'],
            'SURAT-MASUK'          => ['DOSEN', 'TENDIK', 'MITRA', 'INSTANSI', 'UMUM'],
        ];

        $builder = $db->table('service_applicant_types');

        foreach ($mapping as $serviceCode => $applicantCodes) {
            $serviceId = $serviceIds[strtoupper($serviceCode)] ?? null;

            if ($serviceId === null) {
                continue;
            }

            foreach ($applicantCodes as $applicantCode) {
                $applicantId = $applicantIds[strtoupper($applicantCode)] ?? null;

                if ($applicantId === null) {
                    continue;
                }

                $exists = $builder->where('service_id', $serviceId)
                    ->where('applicant_type_id', $applicantId)
                    ->countAllResults();

                if ($exists === 0) {
                    $builder->insert([
                        'service_id'        => $serviceId,
                        'applicant_type_id' => $applicantId,
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s'),
                    ]);
                }
            }
        }
    }
}
