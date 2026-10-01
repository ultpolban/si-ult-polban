<?php

namespace App\Controllers;

use App\Models\NotificationModel;

class MahasiswaNotificationController extends BaseController
{
    protected NotificationModel $notificationModel;

    public function __construct()
    {
        helper(['url']);

        $this->notificationModel = new NotificationModel();
    }


    // =====================================================
    // AMBIL USER ID YANG SEDANG LOGIN
    // =====================================================

    private function getUserId()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            $user = session()->get('user');

            if (is_array($user)) {
                $userId = $user['id'] ?? null;
            }
        }

        return $userId;
    }


    // =====================================================
    // HALAMAN NOTIFIKASI
    // =====================================================

    public function index()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Silakan login terlebih dahulu.'
                );
        }


        // Ambil notifikasi dari database
        $rows = $this->notificationModel
            ->getByUser((int) $userId);


        // =================================================
        // UBAH FORMAT DATABASE AGAR COCOK DENGAN VIEW LAMA
        // =================================================

        $notifications = [];

        foreach ($rows as $row) {

            $notifications[] = [

                'id' =>
                    $row['id'] ?? null,

                'judul' =>
                    $row['title'] ?? 'Notifikasi',

                'pesan' =>
                    $row['message'] ?? '',

                'tanggal' =>
                    !empty($row['created_at'])
                        ? date(
                            'd F Y, H:i',
                            strtotime($row['created_at'])
                        )
                        : '-',

                'tipe' =>
                    $row['type'] ?? 'info',

                'dibaca' =>
                    (bool) ($row['is_read'] ?? 0),

                'url' =>
                    $row['url'] ?? null,

                'service_request_id' =>
                    $row['service_request_id'] ?? null,
            ];
        }


        // =================================================
        // JUMLAH BELUM DIBACA
        // =================================================

        $unreadCount =
            $this->notificationModel
                ->countUnread((int) $userId);


        // =================================================
        // DATA VIEW
        // =================================================

        $data = [

            'title' =>
                'Notifikasi Mahasiswa',

            'notifications' =>
                $notifications,

            'unreadCount' =>
                $unreadCount,
        ];


        return view(
            'mahasiswa/notification/index',
            $data
        );
    }


    // =====================================================
    // TANDAI SATU NOTIFIKASI SUDAH DIBACA
    // =====================================================

    public function read(int $id)
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect()
                ->to('/login');
        }


        $notification =
            $this->notificationModel
                ->where('id', $id)
                ->where('user_id', $userId)
                ->first();


        if (!$notification) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Notifikasi tidak ditemukan.'
                );
        }


        $this->notificationModel
            ->markAsRead(
                $id,
                (int) $userId
            );


        // Kalau ada URL, langsung arahkan
        if (!empty($notification['url'])) {
            return redirect()->to(
                $notification['url']
            );
        }


        return redirect()
            ->back()
            ->with(
                'success',
                'Notifikasi ditandai sudah dibaca.'
            );
    }


    // =====================================================
    // TANDAI SEMUA SUDAH DIBACA
    // =====================================================

    public function readAll()
    {
        $userId = $this->getUserId();

        if (!$userId) {
            return redirect()
                ->to('/login');
        }


        $this->notificationModel
            ->markAllAsRead(
                (int) $userId
            );


        return redirect()
            ->back()
            ->with(
                'success',
                'Semua notifikasi sudah dibaca.'
            );
    }
}