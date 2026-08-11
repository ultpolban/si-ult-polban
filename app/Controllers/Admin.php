<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    public function dashboard()
    {
        $userModel = new UserModel();

        $totalUser = $userModel->countAllResults();
        $userAktif = $userModel->where('is_active', 1)->countAllResults();
        $petugasUlt = $userModel->where('role_id', 2)->countAllResults();
        $pemohon = $userModel->where('role_id', 4)->countAllResults();

        // Get 5 recent users with role name
        $recentUsers = $userModel
            ->select('users.*, roles.role_name')
            ->join('roles', 'roles.id = users.role_id')
            ->orderBy('users.id', 'DESC')
            ->limit(5)
            ->findAll();

        $data = [
            'totalUser'   => $totalUser,
            'userAktif'   => $userAktif,
            'petugasUlt'  => $petugasUlt,
            'pemohon'     => $pemohon,
            'recentUsers' => $recentUsers
        ];

        return view('admin/dashboard', $data);
    }


    public function layanan()
    {
        $data['layanan'] = [
            [
                'kode' => 'SRT001',
                'nama' => 'Surat Keterangan Aktif Kuliah',
                'kategori' => 'Akademik',
                'unit' => 'Akademik',
                'sla' => '2 Hari',
                'status' => 'Aktif'
            ],
            [
                'kode' => 'LEG002',
                'nama' => 'Legalisir Ijazah/Transkrip',
                'kategori' => 'Akademik',
                'unit' => 'Akademik',
                'sla' => '3 Hari',
                'status' => 'Aktif'
            ],
        ];

        return view('admin/layanan', $data);
    }

    public function kategoriLayanan()
    {
        return view('admin/kategori_layanan');
    }

    public function persyaratanLayanan()
    {
        return view('admin/persyaratan_layanan');
    }

    public function laporan()
    {
        $data['laporan'] = [
            ['unit' => 'Akademik', 'total' => 520, 'selesai' => 410, 'proses' => 90, 'terlambat' => 20, 'sla' => '95%', 'avg' => '2,1 Hari'],
            ['unit' => 'Kemahasiswaan', 'total' => 312, 'selesai' => 250, 'proses' => 50, 'terlambat' => 12, 'sla' => '92%', 'avg' => '2,3 Hari'],
            ['unit' => 'Keuangan', 'total' => 250, 'selesai' => 210, 'proses' => 30, 'terlambat' => 10, 'sla' => '90%', 'avg' => '2,5 Hari'],
        ];

        return view('admin/laporan', $data);
    }

    public function tiket()
    {
        $data['tiket'] = [
            [
                'kode'     => 'ULT-2024-001',
                'pemohon'  => 'Ahmad Fauzi',
                'layanan'  => 'Surat Keterangan Aktif Kuliah',
                'unit'     => 'Akademik',
                'tanggal'  => '01 Mei 2024',
                'status'   => 'Selesai',
            ],
            [
                'kode'     => 'ULT-2024-002',
                'pemohon'  => 'Siti Rahayu',
                'layanan'  => 'Legalisir Ijazah/Transkrip',
                'unit'     => 'Akademik',
                'tanggal'  => '02 Mei 2024',
                'status'   => 'Proses',
            ],
            [
                'kode'     => 'ULT-2024-003',
                'pemohon'  => 'Budi Santoso',
                'layanan'  => 'Konfirmasi Pembayaran',
                'unit'     => 'Keuangan',
                'tanggal'  => '03 Mei 2024',
                'status'   => 'Menunggu',
            ],
        ];

        return view('admin/tiket', $data);
    }

    public function verifikasiTiket()
    {
        $data['tiket'] = [
            [
                'kode'      => 'ULT-2024-004',
                'pemohon'   => 'Dewi Larasati',
                'layanan'   => 'Surat Keterangan Aktif Kuliah',
                'unit'      => 'Akademik',
                'tanggal'   => '05 Mei 2024',
                'status'    => 'Menunggu Verifikasi',
                'aksi'      => 'Periksa',
            ],
            [
                'kode'      => 'ULT-2024-005',
                'pemohon'   => 'Rian Saputra',
                'layanan'   => 'Legalisir Ijazah/Transkrip',
                'unit'      => 'Akademik',
                'tanggal'   => '06 Mei 2024',
                'status'    => 'Menunggu Verifikasi',
                'aksi'      => 'Periksa',
            ],
            [
                'kode'      => 'ULT-2024-006',
                'pemohon'   => 'Nina Rahma',
                'layanan'   => 'Konfirmasi Pembayaran',
                'unit'      => 'Keuangan',
                'tanggal'   => '07 Mei 2024',
                'status'    => 'Menunggu Verifikasi',
                'aksi'      => 'Periksa',
            ],
        ];

        return view('admin/verifikasi_tiket', $data);
    }

    public function statistik()
    {
        return view('admin/statistik');
    }

    public function tracking()
    {
        return view('admin/tracking');
    }

    public function dashboardPimpinan()
    {
        $data = [
            'totalTicket'    => 1248,
            'ticketSelesai'  => 982,
            'slaTercapai'    => '92,4%',
            'ticketTerlambat' => 52,
            'avgSelesai'     => '2,4 Hari',
            'topServices' => [
                ['name' => 'Surat Keterangan Aktif Kuliah', 'count' => 320, 'percentage' => 85],
                ['name' => 'Legalisir Ijazah/Transkrip', 'count' => 210, 'percentage' => 65],
                ['name' => 'Verifikasi Alumni', 'count' => 156, 'percentage' => 45],
                ['name' => 'Konfirmasi Pembayaran', 'count' => 137, 'percentage' => 40],
                ['name' => 'Permohonan Informasi Publik', 'count' => 90, 'percentage' => 25]
            ]
        ];

        return view('pimpinan/dashboard', $data);
    }
}
