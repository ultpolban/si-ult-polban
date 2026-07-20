<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
    // Dashboard Pemohon
    public function index()
    {
        $data = [

            'title' => 'Dashboard Pemohon',

            'user' => [
                'nama'   => 'Alvin',
                'nim'    => '221511000',
                'prodi'  => 'D4 Teknik Informatika'
            ],

            'statistik' => [
                'total'     => 8,
                'diproses'  => 3,
                'revisi'    => 1,
                'selesai'   => 4
            ],

            'tickets' => [

                [
                    'id'       => 1,
                    'nomor'    => 'ULT-20260716-0001',
                    'layanan'  => 'Surat Aktif Kuliah',
                    'tanggal'  => '16 Juli 2026',
                    'status'   => 'Submitted'
                ],

                [
                    'id'       => 2,
                    'nomor'    => 'ULT-20260716-0002',
                    'layanan'  => 'Legalisir Ijazah',
                    'tanggal'  => '17 Juli 2026',
                    'status'   => 'In Progress'
                ],

                [
                    'id'       => 3,
                    'nomor'    => 'ULT-20260716-0003',
                    'layanan'  => 'Verifikasi Alumni',
                    'tanggal'  => '18 Juli 2026',
                    'status'   => 'Completed'
                ]

            ]

        ];

        return view('dashboard/index', $data);
    }

    // Dashboard Mahasiswa
    public function mahasiswa()
    {
        $data = [

            'title' => 'Dashboard Mahasiswa',

            'user' => [
    'nama'      => 'Alvin',
    'nim'       => '221511000',
    'prodi'     => 'D4 Teknik Informatika',
    'jurusan'   => 'Teknik Komputer dan Informatika',
    'semester'  => 8,
    'angkatan'  => 2022
],
            'statistik' => [
                'layanan'   => 8,
                'selesai'   => 4,
                'proses'    => 3,
                'notifikasi'=> 6
            ],

            'jadwal' => [
                [
                    'judul' => 'Batas Pengajuan Beasiswa',
                    'tanggal' => '25 Juli 2026'
                ],
                [
                    'judul' => 'Pengambilan Surat',
                    'tanggal' => '28 Juli 2026'
                ]
            ],

            'akademik' => [

    'ipk'    => '3.71',

    'sks'    => 98,

    'status' => 'Aktif',

    'dosen'  => 'Dr. Budi Santoso'

]

        ];

        return view('dashboard/mahasiswa', $data);
    }
}