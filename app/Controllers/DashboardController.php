<?php

namespace App\Controllers;

class DashboardController extends BaseController
{
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
}