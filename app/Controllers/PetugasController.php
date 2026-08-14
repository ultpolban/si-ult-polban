<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PetugasController extends BaseController
{
    /**
     * ============================================================
     * DATA TIKET
     * ============================================================
     * Semua halaman memakai sumber data yang sama.
     * Jadi tiket dummy juga bisa:
     * - Detail
     * - Verifikasi
     * - Disposisi
     */
    private function getAllTiket()
    {
        return [

            // =====================================================
            // 3 TIKET AWAL
            // =====================================================

            [
                'id' => 1,
                'nomor_tiket' => 'ULT-20260720-0001',
                'nama_pemohon' => 'Rafi Putra',
                'nim' => '231511001',
                'nik' => '3201123456780001',
                'layanan' => 'Surat Aktif Kuliah',
                'kategori' => 'Akademik',
                'prioritas' => 'High',
                'status' => 'Submitted',
                'dokumen' => '',
                'tanggal' => '20 Juli 2026',
                'created_at' => '2026-07-20 08:30:00',
                'email' => 'rafi@student.polban.ac.id',
                'no_hp' => '081234567890',
                'deskripsi' => 'Saya mengajukan Surat Aktif Kuliah untuk keperluan beasiswa.'
            ],

            [
                'id' => 2,
                'nomor_tiket' => 'ULT-20260721-0002',
                'nama_pemohon' => 'Siti Nurhaliza',
                'nim' => '231511002',
                'nik' => '3201123456780002',
                'layanan' => 'Bantuan UKT',
                'kategori' => 'Keuangan',
                'prioritas' => 'Medium',
                'status' => 'Verified',
                'dokumen' => '',
                'tanggal' => '21 Juli 2026',
                'created_at' => '2026-07-21 09:15:00',
                'email' => 'siti@student.polban.ac.id',
                'no_hp' => '081298765432',
                'deskripsi' => 'Mengajukan bantuan pembayaran UKT semester ganjil.'
            ],

            [
                'id' => 3,
                'nomor_tiket' => 'ULT-20260722-0003',
                'nama_pemohon' => 'Ahmad Fauzi',
                'nim' => '231511003',
                'nik' => '3201123456780003',
                'layanan' => 'Beasiswa Prestasi',
                'kategori' => 'Kemahasiswaan',
                'prioritas' => 'Low',
                'status' => 'Disposisi',
                'dokumen' => '',
                'tanggal' => '22 Juli 2026',
                'created_at' => '2026-07-22 10:00:00',
                'email' => 'ahmad@student.polban.ac.id',
                'no_hp' => '081377788899',
                'deskripsi' => 'Mengajukan beasiswa prestasi akademik.'
            ],

            // =====================================================
            // DATA DUMMY
            // =====================================================

            [
                'id' => 4,
                'nomor_tiket' => 'ULT-20260808-0015',
                'nama_pemohon' => 'Rian Hidayat',
                'nim' => '231511004',
                'nik' => '3201123456780015',
                'layanan' => 'Surat Aktif Kuliah',
                'kategori' => 'Akademik',
                'prioritas' => 'High',
                'status' => 'Submitted',
                'dokumen' => 'ada',
                'tanggal' => '08 Agustus 2026',
                'created_at' => '2026-08-08 14:30:00',
                'email' => 'rian@student.polban.ac.id',
                'no_hp' => '081234560004',
                'deskripsi' => 'Pengajuan surat aktif kuliah.'
            ],

            [
                'id' => 5,
                'nomor_tiket' => 'ULT-20260808-0014',
                'nama_pemohon' => 'Dewi Lestari',
                'nim' => '231511005',
                'nik' => '3201123456780014',
                'layanan' => 'Bantuan UKT',
                'kategori' => 'Keuangan',
                'prioritas' => 'Medium',
                'status' => 'Verified',
                'dokumen' => '',
                'tanggal' => '08 Agustus 2026',
                'created_at' => '2026-08-08 13:45:00',
                'email' => 'dewi@student.polban.ac.id',
                'no_hp' => '081234560005',
                'deskripsi' => 'Pengajuan bantuan UKT.'
            ],

            [
                'id' => 6,
                'nomor_tiket' => 'ULT-20260808-0013',
                'nama_pemohon' => 'Fajar Nugraha',
                'nim' => '231511006',
                'nik' => '3201123456780013',
                'layanan' => 'Beasiswa Prestasi',
                'kategori' => 'Kemahasiswaan',
                'prioritas' => 'Low',
                'status' => 'Disposisi',
                'dokumen' => 'ada',
                'tanggal' => '08 Agustus 2026',
                'created_at' => '2026-08-08 12:30:00',
                'email' => 'fajar@student.polban.ac.id',
                'no_hp' => '081234560006',
                'deskripsi' => 'Pengajuan beasiswa prestasi.'
            ],

            [
                'id' => 7,
                'nomor_tiket' => 'ULT-20260807-0012',
                'nama_pemohon' => 'Siti Aminah',
                'nim' => '231511007',
                'nik' => '3201123456780012',
                'layanan' => 'Surat Keterangan Lulus',
                'kategori' => 'Akademik',
                'prioritas' => 'Medium',
                'status' => 'Submitted',
                'dokumen' => 'ada',
                'tanggal' => '07 Agustus 2026',
                'created_at' => '2026-08-07 16:20:00',
                'email' => 'sitiaminah@student.polban.ac.id',
                'no_hp' => '081234560007',
                'deskripsi' => 'Pengajuan surat keterangan lulus.'
            ],

            [
                'id' => 8,
                'nomor_tiket' => 'ULT-20260807-0011',
                'nama_pemohon' => 'Budi Santoso',
                'nim' => '231511008',
                'nik' => '3201123456780011',
                'layanan' => 'Pengajuan Cuti',
                'kategori' => 'Akademik',
                'prioritas' => 'Medium',
                'status' => 'Verified',
                'dokumen' => '',
                'tanggal' => '07 Agustus 2026',
                'created_at' => '2026-08-07 15:10:00',
                'email' => 'budi@student.polban.ac.id',
                'no_hp' => '081234560008',
                'deskripsi' => 'Pengajuan cuti akademik.'
            ],

            [
                'id' => 9,
                'nomor_tiket' => 'ULT-20260807-0010',
                'nama_pemohon' => 'Ahmad Fauzi',
                'nim' => '231511009',
                'nik' => '3201123456780010',
                'layanan' => 'Beasiswa Prestasi',
                'kategori' => 'Kemahasiswaan',
                'prioritas' => 'Low',
                'status' => 'Disposisi',
                'dokumen' => '',
                'tanggal' => '07 Agustus 2026',
                'created_at' => '2026-08-07 13:00:00',
                'email' => 'ahmad2@student.polban.ac.id',
                'no_hp' => '081234560009',
                'deskripsi' => 'Pengajuan beasiswa prestasi.'
            ],

            [
                'id' => 10,
                'nomor_tiket' => 'ULT-20260807-0009',
                'nama_pemohon' => 'Annisa Rahma',
                'nim' => '231511010',
                'nik' => '3201123456780009',
                'layanan' => 'Legalisir Ijazah',
                'kategori' => 'Akademik',
                'prioritas' => 'High',
                'status' => 'Completed',
                'dokumen' => 'ada',
                'tanggal' => '07 Agustus 2026',
                'created_at' => '2026-08-07 11:45:00',
                'email' => 'annisa@student.polban.ac.id',
                'no_hp' => '081234560010',
                'deskripsi' => 'Permohonan legalisir ijazah.'
            ],

            [
                'id' => 11,
                'nomor_tiket' => 'ULT-20260807-0008',
                'nama_pemohon' => 'Yoga Pratama',
                'nim' => '231511011',
                'nik' => '3201123456780008',
                'layanan' => 'Keringanan UKT',
                'kategori' => 'Keuangan',
                'prioritas' => 'Medium',
                'status' => 'Verified',
                'dokumen' => 'ada',
                'tanggal' => '07 Agustus 2026',
                'created_at' => '2026-08-07 10:30:00',
                'email' => 'yoga@student.polban.ac.id',
                'no_hp' => '081234560011',
                'deskripsi' => 'Pengajuan keringanan UKT.'
            ],

            [
                'id' => 12,
                'nomor_tiket' => 'ULT-20260807-0007',
                'nama_pemohon' => 'Intan Permata',
                'nim' => '231511012',
                'nik' => '3201123456780007',
                'layanan' => 'Surat Pengantar PKL',
                'kategori' => 'Akademik',
                'prioritas' => 'High',
                'status' => 'Submitted',
                'dokumen' => '',
                'tanggal' => '07 Agustus 2026',
                'created_at' => '2026-08-07 09:20:00',
                'email' => 'intan@student.polban.ac.id',
                'no_hp' => '081234560012',
                'deskripsi' => 'Pengajuan surat pengantar PKL.'
            ],

            [
                'id' => 13,
                'nomor_tiket' => 'ULT-20260807-0006',
                'nama_pemohon' => 'Reza Pahlevi',
                'nim' => '231511013',
                'nik' => '3201123456780006',
                'layanan' => 'Pindah Kelas',
                'kategori' => 'Akademik',
                'prioritas' => 'Medium',
                'status' => 'Rejected',
                'dokumen' => 'ada',
                'tanggal' => '07 Agustus 2026',
                'created_at' => '2026-08-07 08:15:00',
                'email' => 'reza@student.polban.ac.id',
                'no_hp' => '081234560013',
                'deskripsi' => 'Permohonan pindah kelas.'
            ],

            [
                'id' => 14,
                'nomor_tiket' => 'ULT-20260806-0005',
                'nama_pemohon' => 'Putri Wulandari',
                'nim' => '231511014',
                'nik' => '3201123456780005',
                'layanan' => 'Konseling Akademik',
                'kategori' => 'Kemahasiswaan',
                'prioritas' => 'Low',
                'status' => 'Completed',
                'dokumen' => '',
                'tanggal' => '06 Agustus 2026',
                'created_at' => '2026-08-06 16:00:00',
                'email' => 'putri@student.polban.ac.id',
                'no_hp' => '081234560014',
                'deskripsi' => 'Pengajuan layanan konseling akademik.'
            ],

            [
                'id' => 15,
                'nomor_tiket' => 'ULT-20260806-0004',
                'nama_pemohon' => 'Dedi Kurniawan',
                'nim' => '231511015',
                'nik' => '3201123456780004',
                'layanan' => 'Penggantian KTM Hilang',
                'kategori' => 'Kemahasiswaan',
                'prioritas' => 'High',
                'status' => 'Verified',
                'dokumen' => 'ada',
                'tanggal' => '06 Agustus 2026',
                'created_at' => '2026-08-06 14:30:00',
                'email' => 'dedi@student.polban.ac.id',
                'no_hp' => '081234560015',
                'deskripsi' => 'Permohonan penggantian KTM yang hilang.'
            ],

            [
                'id' => 16,
                'nomor_tiket' => 'ULT-20260806-0003',
                'nama_pemohon' => 'Nabila Putri',
                'nim' => '231511016',
                'nik' => '3201123456780003',
                'layanan' => 'Surat Rekomendasi',
                'kategori' => 'Akademik',
                'prioritas' => 'Medium',
                'status' => 'Disposisi',
                'dokumen' => 'ada',
                'tanggal' => '06 Agustus 2026',
                'created_at' => '2026-08-06 12:00:00',
                'email' => 'nabila@student.polban.ac.id',
                'no_hp' => '081234560016',
                'deskripsi' => 'Pengajuan surat rekomendasi.'
            ],

            [
                'id' => 17,
                'nomor_tiket' => 'ULT-20260806-0002',
                'nama_pemohon' => 'Galih Ramadhan',
                'nim' => '231511017',
                'nik' => '3201123456780002',
                'layanan' => 'Bantuan Beasiswa',
                'kategori' => 'Keuangan',
                'prioritas' => 'High',
                'status' => 'Verified',
                'dokumen' => '',
                'tanggal' => '06 Agustus 2026',
                'created_at' => '2026-08-06 10:45:00',
                'email' => 'galih@student.polban.ac.id',
                'no_hp' => '081234560017',
                'deskripsi' => 'Pengajuan bantuan beasiswa.'
            ],

            [
                'id' => 18,
                'nomor_tiket' => 'ULT-20260806-0001',
                'nama_pemohon' => 'Maya Sari',
                'nim' => '231511018',
                'nik' => '3201123456780001',
                'layanan' => 'Surat Aktif Kuliah',
                'kategori' => 'Akademik',
                'prioritas' => 'Medium',
                'status' => 'Submitted',
                'dokumen' => 'ada',
                'tanggal' => '06 Agustus 2026',
                'created_at' => '2026-08-06 08:30:00',
                'email' => 'maya@student.polban.ac.id',
                'no_hp' => '081234560018',
                'deskripsi' => 'Pengajuan surat aktif kuliah.'
            ],
        ];
    }

    // ============================================================
    // DASHBOARD
    // ============================================================

    public function dashboard()
    {
        return view('petugas/dashboard');
    }

    // ============================================================
    // DATA TIKET
    // ============================================================

    public function tiket()
    {
        return view('petugas/tiket', [
            'tiket_list' => $this->getAllTiket()
        ]);
    }

    // ============================================================
    // DETAIL
    // ============================================================

    public function detail($id = null)
    {
        $tiket = $this->findTiket($id);

        return view('petugas/detail', [
            'id' => $id,
            'tiket' => $tiket
        ]);
    }

    // ============================================================
    // VERIFIKASI
    // ============================================================

    public function verifikasi($id = null)
    {
        $tiket = $this->findTiket($id);

        return view('petugas/verifikasi', [
            'tiket' => $tiket,
            'id' => $id
        ]);
    }

    // ============================================================
    // SIMPAN VERIFIKASI
    // ============================================================

    public function simpanVerifikasi($id = null)
    {
        $statusVerifikasi = $this->request->getPost('status_verifikasi');
        $catatan = $this->request->getPost('catatan');

        return redirect()
            ->to(base_url('petugas/tiket'))
            ->with('success', 'Verifikasi tiket berhasil disimpan!');
    }

    // ============================================================
    // DISPOSISI
    // ============================================================

    public function disposisi($id = null)
    {
        $tiket = $this->findTiket($id);

        return view('petugas/disposisi', [
            'tiket' => $tiket,
            'id' => $id
        ]);
    }

    // ============================================================
    // KIRIM DISPOSISI
    // ============================================================

    public function kirimDisposisi($id = null)
    {
        $unitTujuan = $this->request->getPost('unit_tujuan');
        $prioritas = $this->request->getPost('prioritas');
        $targetSla = $this->request->getPost('target_sla');

        return redirect()
            ->to(base_url('petugas/tiket'))
            ->with('success', 'Disposisi tiket berhasil dikirim!');
    }

    // ============================================================
    // CARI TIKET BERDASARKAN ID
    // ============================================================

    private function findTiket($id)
    {
        $allTiket = $this->getAllTiket();

        foreach ($allTiket as $tiket) {
            if ((int) $tiket['id'] === (int) $id) {
                return $tiket;
            }
        }

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    // ============================================================
    // MENU LAIN
    // ============================================================

    public function laporanTamu()
    {
        return view('petugas/laporan_tamu');
    }

    public function statistikTiket()
    {
        return view('petugas/statistik_tiket');
    }

    public function laporanTiket()
    {
        return view('petugas/laporan_tiket');
    }

    public function trackingTiket()
    {
        return view('petugas/tracking_tiket');
    }

    public function detail_tamu($id)
    {
        return view('petugas/detail_tamu', [
            'id' => $id
        ]);
    }

    public function verifikasi_tamu($id)
    {
        return view('petugas/verifikasi_tamu', [
            'id' => $id
        ]);
    }

    public function disposisi_tamu($id)
    {
        return view('petugas/disposisi_tamu', [
            'id' => $id
        ]);
    }

    public function edit_tamu($id)
    {
        return view('petugas/edit_tamu', [
            'id' => $id
        ]);
    }

    public function delete_tamu($id)
    {
        return redirect()
            ->back()
            ->with('success', 'Data tiket/tamu berhasil dihapus.');
    }

    public function profile()
{
    return view('petugas/profile');
}

}