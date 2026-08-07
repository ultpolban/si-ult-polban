<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class OrangTuaNotificationController extends BaseController
{
    public function index()
    {
        $data['notifications'] = [

            [
                'icon' => 'fas fa-paper-plane',
                'color' => 'primary',
                'judul' => 'Pengajuan berhasil dikirim',
                'pesan' => 'ULT-ORT-20260807102531 berhasil dikirim.',
                'waktu' => '5 menit yang lalu'
            ],

            [
                'icon' => 'fas fa-check-circle',
                'color' => 'success',
                'judul' => 'Tiket telah diverifikasi',
                'pesan' => 'Pengajuan Surat Aktif Kuliah telah diverifikasi petugas.',
                'waktu' => '30 menit yang lalu'
            ],

            [
                'icon' => 'fas fa-share',
                'color' => 'warning',
                'judul' => 'Diteruskan ke Unit Akademik',
                'pesan' => 'Tiket sedang diproses Unit Akademik.',
                'waktu' => '1 jam yang lalu'
            ],

            [
                'icon' => 'fas fa-check',
                'color' => 'success',
                'judul' => 'Pengajuan selesai',
                'pesan' => 'Silakan unduh surat yang telah diterbitkan.',
                'waktu' => 'Kemarin'
            ]

        ];

        return view('orangtua/notification/index', $data);
    }
}