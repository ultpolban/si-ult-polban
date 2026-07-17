<?php

namespace App\Controllers;

class NotificationController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Notifikasi',

            'notifications' => [

                [
                    'judul' => 'Pengajuan berhasil dikirim',
                    'isi' => 'Pengajuan Surat Keterangan Aktif Kuliah berhasil dikirim.',
                    'tanggal' => '17 Juli 2026',
                    'icon' => 'success'
                ],

                [
                    'judul' => 'Pengajuan sedang diproses',
                    'isi' => 'Petugas sedang memverifikasi dokumen Anda.',
                    'tanggal' => '17 Juli 2026',
                    'icon' => 'warning'
                ],

                [
                    'judul' => 'Pengajuan selesai',
                    'isi' => 'Silakan datang ke ULT untuk mengambil dokumen.',
                    'tanggal' => '18 Juli 2026',
                    'icon' => 'primary'
                ]

            ]
        ];

        return view('notification/index', $data);
    }
}