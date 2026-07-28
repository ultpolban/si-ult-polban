<?php

namespace App\Controllers;

class DosenNotificationController extends BaseController
{
    public function index()
    {
        $notifications = [
            [
                'id' => 1,
                'judul' => 'Pengajuan Berhasil Dikirim',
                'pesan' => 'Pengajuan layanan dosen berhasil dikirim dan sedang menunggu verifikasi.',
                'tanggal' => '28 Juli 2026',
                'waktu' => '09:30',
                'status' => 'baru',
                'icon' => 'fa-check-circle',
            ],
            [
                'id' => 2,
                'judul' => 'Tiket Sedang Diproses',
                'pesan' => 'Tiket pengajuan layanan Anda sedang diproses oleh unit terkait.',
                'tanggal' => '28 Juli 2026',
                'waktu' => '10:15',
                'status' => 'baru',
                'icon' => 'fa-info-circle',
            ],
            [
                'id' => 3,
                'judul' => 'Pengajuan Selesai',
                'pesan' => 'Pengajuan layanan Anda telah selesai diproses.',
                'tanggal' => '28 Juli 2026',
                'waktu' => '11:00',
                'status' => 'dibaca',
                'icon' => 'fa-check-circle',
            ],
        ];

        $data = [
            'title' => 'Notifikasi Dosen',
            'notifications' => $notifications,
            'totalNotifikasi' => count($notifications),
            'belumDibaca' => count(
                array_filter(
                    $notifications,
                    fn($notification) => $notification['status'] === 'baru'
                )
            ),
        ];

        return view('dosen/notification/index', $data);
    }
}