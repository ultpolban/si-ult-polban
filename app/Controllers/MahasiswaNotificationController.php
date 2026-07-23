<?php

namespace App\Controllers;

class MahasiswaNotificationController extends BaseController
{
    public function index()
    {
        $data = [

            'title' => 'Notifikasi Mahasiswa',

            'notifications' => [

                [
                    'judul'   => 'Pengajuan Berhasil Dikirim',
                    'pesan'    => 'Pengajuan layanan Surat Aktif Kuliah berhasil dikirim dan sedang menunggu verifikasi.',
                    'tanggal'  => '20 Juli 2026, 09:30',
                    'tipe'     => 'success',
                    'dibaca'   => false
                ],

                [
                    'judul'   => 'Tiket Sedang Diproses',
                    'pesan'    => 'Tiket ULT-MHS-002 sedang diproses oleh unit Kemahasiswaan.',
                    'tanggal'  => '20 Juli 2026, 14:20',
                    'tipe'     => 'info',
                    'dibaca'   => false
                ],

                [
                    'judul'   => 'Pengajuan Selesai',
                    'pesan'    => 'Pengajuan Legalisir Transkrip kamu telah selesai diproses.',
                    'tanggal'  => '20 Juli 2026, 10:15',
                    'tipe'     => 'success',
                    'dibaca'   => true
                ]

            ]

        ];

        return view('mahasiswa/notification/index', $data);
    }
}