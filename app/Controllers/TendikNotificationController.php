<?php

namespace App\Controllers;

class TendikNotificationController extends BaseController
{
    /**
     * ==========================================
     * HALAMAN NOTIFIKASI TENDIK
     * ==========================================
     */
    public function index()
    {
        // Ambil notifikasi dari session
        $notifications = session()->get('tendik_notifications') ?? [];


        // Jika belum ada notifikasi,
        // tampilkan beberapa notifikasi contoh
        if (empty($notifications)) {

            $notifications = [

                [
                    'id' => 1,

                    'judul' =>
                        'Pengajuan Berhasil Dikirim',

                    'pesan' =>
                        'Pengajuan layanan Anda berhasil dikirim dan sedang menunggu verifikasi.',

                    'tanggal' =>
                        date(
                            'Y-m-d H:i:s',
                            strtotime('-2 days')
                        ),

                    'status' =>
                        'unread',

                    'icon' =>
                        'fas fa-check-circle',

                ],


                [
                    'id' => 2,

                    'judul' =>
                        'Tiket Sedang Diproses',

                    'pesan' =>
                        'Tiket pengajuan Anda sedang diproses oleh unit tujuan.',

                    'tanggal' =>
                        date(
                            'Y-m-d H:i:s',
                            strtotime('-1 day')
                        ),

                    'status' =>
                        'unread',

                    'icon' =>
                        'fas fa-info-circle',

                ],


                [
                    'id' => 3,

                    'judul' =>
                        'Pengajuan Selesai',

                    'pesan' =>
                        'Pengajuan layanan Anda telah selesai diproses.',

                    'tanggal' =>
                        date(
                            'Y-m-d H:i:s',
                            strtotime('-5 hours')
                        ),

                    'status' =>
                        'read',

                    'icon' =>
                        'fas fa-check',

                ],

            ];

        }


        // Hitung total notifikasi
        $totalNotifikasi =
            count($notifications);


        // Hitung notifikasi belum dibaca
        $belumDibaca =
            count(
                array_filter(
                    $notifications,
                    function ($notification) {

                        return (
                            ($notification['status']
                                ?? 'read')
                            === 'unread'
                        );

                    }
                )
            );


        // Data untuk view
        $data = [

            'title' =>
                'Notifikasi',

            'notifications' =>
                $notifications,

            'totalNotifikasi' =>
                $totalNotifikasi,

            'belumDibaca' =>
                $belumDibaca,

        ];


        return view(
            'tendik/notification/index',
            $data
        );
    }


    /**
     * ==========================================
     * TANDAI SEMUA NOTIFIKASI SUDAH DIBACA
     * ==========================================
     */
    public function markAllRead()
    {
        $notifications =
            session()->get(
                'tendik_notifications'
            )
            ?? [];


        foreach (
            $notifications
            as $key => $notification
        ) {

            $notifications[$key]['status'] =
                'read';

        }


        session()->set(
            'tendik_notifications',
            $notifications
        );


        return redirect()
            ->to(
                base_url(
                    'tendik/notification'
                )
            )
            ->with(
                'success',
                'Semua notifikasi telah ditandai sebagai sudah dibaca.'
            );
    }
}