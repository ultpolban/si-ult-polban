<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PetugasController extends BaseController
{
    public function dashboard()
    {
        return view('petugas/dashboard');
    }

    public function tiket()
    {
        // 1. Ambil input filter dari form/URL GET
        $search   = $this->request->getGet('search');
        $status   = $this->request->getGet('status');
        $kategori = $this->request->getGet('kategori');

        // 2. Data Dummy Tiket (Sesuaikan dengan query Model DB Anda jika sudah ada)
        $allTiket = [
            [
                'id'           => 1,
                'nomor_tiket'  => 'ULT-20260720-0001',
                'nama_pemohon' => 'Rafi Putra',
                'nim'          => '231511001',
                'layanan'      => 'Surat Aktif Kuliah',
                'kategori'     => 'Akademik',
                'prioritas'    => 'High',
                'status'       => 'Submitted',
                'tanggal'      => '2026-07-20'
            ],
            [
                'id'           => 2,
                'nomor_tiket'  => 'ULT-20260721-0002',
                'nama_pemohon' => 'Siti Nurhaliza',
                'nim'          => '231511002',
                'layanan'      => 'Bantuan UKT',
                'kategori'     => 'Keuangan',
                'prioritas'    => 'Medium',
                'status'       => 'Verified',
                'tanggal'      => '2026-07-21'
            ],
            [
                'id'           => 3,
                'nomor_tiket'  => 'ULT-20260722-0003',
                'nama_pemohon' => 'Ahmad Fauzi',
                'nim'          => '231511003',
                'layanan'      => 'Beasiswa Prestasi',
                'kategori'     => 'Kemahasiswaan',
                'prioritas'    => 'Low',
                'status'       => 'Disposisi',
                'tanggal'      => '2026-07-22'
            ]
        ];

        // 3. Logika Filter Data
        $filteredTiket = array_filter($allTiket, function ($item) use ($search, $status, $kategori) {
            $matchSearch = true;
            $matchStatus = true;
            $matchKategori = true;

            if (!empty($search)) {
                $searchLower = strtolower($search);
                $matchSearch = (strpos(strtolower($item['nomor_tiket']), $searchLower) !== false) ||
                               (strpos(strtolower($item['nama_pemohon']), $searchLower) !== false) ||
                               (strpos(strtolower($item['nim']), $searchLower) !== false) ||
                               (strpos(strtolower($item['layanan']), $searchLower) !== false);
            }

            if (!empty($status)) {
                $matchStatus = (strtolower($item['status']) === strtolower($status));
            }

            if (!empty($kategori)) {
                $matchKategori = (strtolower($item['kategori']) === strtolower($kategori));
            }

            return $matchSearch && $matchStatus && $matchKategori;
        });

        $data = [
            'tiket_list' => $filteredTiket,
            'search'     => $search,
            'status'     => $status,
            'kategori'   => $kategori
        ];

        return view('petugas/tiket', $data);
    }

    public function detail($id = null)
{
    $allTiket = [

        [
            'id' => 1,
            'nomor_tiket' => 'ULT-20260720-0001',
            'nama_pemohon' => 'Rafi Putra',
            'nim' => '231511001',
            'layanan' => 'Surat Aktif Kuliah',
            'kategori' => 'Akademik',
            'prioritas' => 'High',
            'status' => 'Submitted',
            'tanggal' => '20 Juli 2026',
            'email' => 'rafi@student.polban.ac.id',
            'no_hp' => '081234567890',
            'deskripsi' => 'Saya mengajukan Surat Aktif Kuliah untuk keperluan beasiswa.'
        ],

        [
            'id' => 2,
            'nomor_tiket' => 'ULT-20260721-0002',
            'nama_pemohon' => 'Siti Nurhaliza',
            'nim' => '231511002',
            'layanan' => 'Bantuan UKT',
            'kategori' => 'Keuangan',
            'prioritas' => 'Medium',
            'status' => 'Verified',
            'tanggal' => '21 Juli 2026',
            'email' => 'siti@student.polban.ac.id',
            'no_hp' => '081298765432',
            'deskripsi' => 'Mengajukan bantuan pembayaran UKT semester ganjil.'
        ],

        [
            'id' => 3,
            'nomor_tiket' => 'ULT-20260722-0003',
            'nama_pemohon' => 'Ahmad Fauzi',
            'nim' => '231511003',
            'layanan' => 'Beasiswa Prestasi',
            'kategori' => 'Kemahasiswaan',
            'prioritas' => 'Low',
            'status' => 'Disposisi',
            'tanggal' => '22 Juli 2026',
            'email' => 'ahmad@student.polban.ac.id',
            'no_hp' => '081377788899',
            'deskripsi' => 'Mengajukan beasiswa prestasi akademik.'
        ]

    ];

    $tiket = null;

    foreach ($allTiket as $item) {

        if ($item['id'] == $id) {

            $tiket = $item;
            break;

        }

    }

    if (!$tiket) {

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

    }

    return view('petugas/detail', [

        'id' => $id,
        'tiket' => $tiket

    ]);
}

    public function verifikasi($id = null)
{
    $allTiket = [
        [
            'id' => 1,
            'nomor_tiket' => 'ULT-20260720-0001',
            'nama_pemohon' => 'Rafi Putra',
            'nim' => '231511001',
            'layanan' => 'Surat Aktif Kuliah',
            'kategori' => 'Akademik',
            'prioritas' => 'High',
            'status' => 'Submitted',
            'tanggal' => '2026-07-20',
            'email' => 'rafi@student.polban.ac.id',
            'no_hp' => '081234567890',
            'deskripsi' => 'Mengajukan Surat Aktif Kuliah.'
        ],
        [
            'id' => 2,
            'nomor_tiket' => 'ULT-20260721-0002',
            'nama_pemohon' => 'Siti Nurhaliza',
            'nim' => '231511002',
            'layanan' => 'Bantuan UKT',
            'kategori' => 'Keuangan',
            'prioritas' => 'Medium',
            'status' => 'Verified',
            'tanggal' => '2026-07-21',
            'email' => 'siti@student.polban.ac.id',
            'no_hp' => '081298765432',
            'deskripsi' => 'Mengajukan bantuan pembayaran UKT.'
        ],
        [
            'id' => 3,
            'nomor_tiket' => 'ULT-20260722-0003',
            'nama_pemohon' => 'Ahmad Fauzi',
            'nim' => '231511003',
            'layanan' => 'Beasiswa Prestasi',
            'kategori' => 'Kemahasiswaan',
            'prioritas' => 'Low',
            'status' => 'Disposisi',
            'tanggal' => '2026-07-22',
            'email' => 'ahmad@student.polban.ac.id',
            'no_hp' => '081212121212',
            'deskripsi' => 'Mengajukan Beasiswa Prestasi.'
        ]
    ];

    $tiket = null;

    foreach ($allTiket as $row) {
        if ($row['id'] == $id) {
            $tiket = $row;
            break;
        }
    }

    return view('petugas/verifikasi', [
        'tiket' => $tiket,
        'id' => $id
    ]);
}

    // =======================================================
    // METHOD UNTUK MENYIMPAN HASIL VERIFIKASI (MEMPERBAIKI ERROR 404)
    // =======================================================
    public function simpanVerifikasi($id = null)
    {
        // Tangkap data dari form verifikasi
        $statusVerifikasi = $this->request->getPost('status_verifikasi');
        $catatan          = $this->request->getPost('catatan');

        // TODO: Silakan tambahkan kode update ke database Anda di sini
        // Contoh: $this->tiketModel->update($id, ['status' => $statusVerifikasi, 'catatan' => $catatan]);

        // Redirect kembali ke halaman data tiket dengan pesan sukses
        return redirect()->to(base_url('petugas/tiket'))->with('success', 'Verifikasi tiket berhasil disimpan!');
    }

    public function disposisi($id = null)
{
    $allTiket = [

        [
            'id' => 1,
            'nomor_tiket' => 'ULT-20260720-0001',
            'nama_pemohon' => 'Rafi Putra',
            'nim' => '231511001',
            'layanan' => 'Surat Aktif Kuliah',
            'kategori' => 'Akademik',
            'prioritas' => 'High',
            'status' => 'Submitted',
            'tanggal' => '20 Juli 2026',
            'email' => 'rafi@student.polban.ac.id',
            'no_hp' => '081234567890',
            'deskripsi' => 'Saya mengajukan Surat Aktif Kuliah untuk keperluan beasiswa.'
        ],

        [
            'id' => 2,
            'nomor_tiket' => 'ULT-20260721-0002',
            'nama_pemohon' => 'Siti Nurhaliza',
            'nim' => '231511002',
            'layanan' => 'Bantuan UKT',
            'kategori' => 'Keuangan',
            'prioritas' => 'Medium',
            'status' => 'Verified',
            'tanggal' => '21 Juli 2026',
            'email' => 'siti@student.polban.ac.id',
            'no_hp' => '081298765432',
            'deskripsi' => 'Mengajukan bantuan pembayaran UKT semester ganjil.'
        ],

        [
            'id' => 3,
            'nomor_tiket' => 'ULT-20260722-0003',
            'nama_pemohon' => 'Ahmad Fauzi',
            'nim' => '231511003',
            'layanan' => 'Beasiswa Prestasi',
            'kategori' => 'Kemahasiswaan',
            'prioritas' => 'Low',
            'status' => 'Disposisi',
            'tanggal' => '22 Juli 2026',
            'email' => 'ahmad@student.polban.ac.id',
            'no_hp' => '081377788899',
            'deskripsi' => 'Mengajukan beasiswa prestasi akademik.'
        ]

    ];

    $tiket = null;

    foreach ($allTiket as $row) {

        if ($row['id'] == $id) {

            $tiket = $row;
            break;

        }

    }

    if (!$tiket) {

        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();

    }

    return view('petugas/disposisi', [

        'tiket' => $tiket,
        'id' => $id

    ]);
}
    // =======================================================
    // METHOD UNTUK MENGIRIM DISPOSISI (MENCEGAH ERROR SERUPA)
    // =======================================================
    public function kirimDisposisi($id = null)
    {
        // Tangkap data dari form disposisi
        $unitTujuan = $this->request->getPost('unit_tujuan');
        $prioritas  = $this->request->getPost('prioritas');
        $targetSla  = $this->request->getPost('target_sla');

        // TODO: Silakan tambahkan kode update/insert disposisi ke database Anda di sini

        // Redirect kembali ke halaman data tiket dengan pesan sukses
        return redirect()->to(base_url('petugas/tiket'))->with('success', 'Disposisi tiket berhasil dikirim!');
    }

}

