<?php

namespace App\Controllers;

class MahasiswaTicketController extends BaseController
{
    // ==========================================
    // AJUKAN LAYANAN
    // ==========================================
    public function create()
    {
        $data = [
            'title' => 'Ajukan Layanan',

            'user' => [
                'nama' => 'Alvin',
                'nim'  => '221511000'
            ]
        ];

        return view('mahasiswa/ticket/create', $data);
    }


    // ==========================================
    // SIMPAN PENGAJUAN
    // ==========================================
    public function store()
    {
        $data = [
            'title' => 'Pengajuan Berhasil',

            'ticket' => [
                'nomor'    => 'ULT-MHS-' . date('Ymd') . '-' . rand(1000, 9999),
                'layanan'  => $this->request->getPost('layanan'),
                'keterangan' => $this->request->getPost('keterangan'),
                'status'   => 'Submitted'
            ]
        ];

        return view('mahasiswa/ticket/success', $data);
    }


    // ==========================================
    // HALAMAN SUKSES
    // ==========================================
    public function success()
    {
        $data = [
            'title' => 'Pengajuan Berhasil'
        ];

        return view('mahasiswa/ticket/success', $data);
    }


    // ==========================================
    // TRACKING TIKET
    // ==========================================
    public function history()
    {
        $data = [

            'title' => 'Tracking Tiket Mahasiswa',

            'tickets' => [

                [
                    'id'       => 1,
                    'nomor'    => 'ULT-MHS-001',
                    'layanan'  => 'Surat Aktif Kuliah',
                    'unit'     => 'Akademik',
                    'tanggal'  => '20 Juli 2026',
                    'status'   => 'Completed'
                ],

                [
                    'id'       => 2,
                    'nomor'    => 'ULT-MHS-002',
                    'layanan'  => 'Surat Beasiswa',
                    'unit'     => 'Kemahasiswaan',
                    'tanggal'  => '18 Juli 2026',
                    'status'   => 'In Progress'
                ],

                [
                    'id'       => 3,
                    'nomor'    => 'ULT-MHS-003',
                    'layanan'  => 'Legalisir Transkrip',
                    'unit'     => 'Akademik',
                    'tanggal'  => '15 Juli 2026',
                    'status'   => 'Submitted'
                ]

            ]

        ];

        return view('mahasiswa/ticket/history', $data);
    }


    // ==========================================
    // DETAIL TIKET
    // ==========================================
    public function detail($id)
    {
        $data = [

            'title' => 'Detail Tiket Mahasiswa',

            'ticket' => [

                'id'         => $id,
                'nomor'      => 'ULT-MHS-00' . $id,
                'layanan'    => 'Surat Aktif Kuliah',
                'unit'       => 'Akademik',
                'tanggal'    => '20 Juli 2026',
                'status'     => 'In Progress',
                'keterangan' => 'Pengajuan layanan sedang diproses oleh unit terkait.'

            ]

        ];

        return view('mahasiswa/ticket/detail', $data);
    }
}