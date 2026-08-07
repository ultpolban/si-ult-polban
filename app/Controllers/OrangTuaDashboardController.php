<?php

namespace App\Controllers;

class OrangTuaDashboardController extends BaseController
{
    public function index()
    {
        $data = [

            'title' => 'Dashboard Orang Tua',

            // =============================
            // DATA DUMMY
            // =============================

            'orangtua' => [

                'nama'          => 'Bapak Ahmad Wijaya',

                'nik'           => '3273010101010001',

                'anak'          => 'Muhamad Rafi Putra Zakaria',

                'nim'           => '241511001',

                'program_studi' => 'D4 Teknik Informatika',

                'jurusan'       => 'Teknik Komputer dan Informatika',

                'status'        => 'Aktif'

            ],

            // Statistik

            'jumlah'    => 0,

            'proses'    => 0,

            'revisi'    => 0,

            'selesai'   => 0,

            // Riwayat dummy

            'riwayat' => []

        ];

        return view('orangtua/dashboard', $data);
    }
}