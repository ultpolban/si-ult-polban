<?php

namespace App\Controllers;

class NotificationController extends BaseController
{
    public function index()
    {
        $userId = (int) (session()->get('user_id') ?? 0);
        if ($userId <= 0) {
            return redirect()->to('/login');
        }

        $notifications = db_connect()
            ->table('notifications')
            ->where('user_id', $userId)
            ->where('deleted_at', null)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResultArray();

        return view('notifications/index', [
            'title' => 'Notifikasi',
            'notifications' => $notifications,
        ]);
    }

    public function read(int $id)
    {
        $userId = (int) (session()->get('user_id') ?? 0);
        if ($userId <= 0) {
            return redirect()->to('/login');
        }

        db_connect()->table('notifications')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->update([
                'is_read' => 1,
                'read_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->to('/notifikasi');
    }

    public function readAll()
    {
        $userId = (int) (session()->get('user_id') ?? 0);
        if ($userId <= 0) {
            return redirect()->to('/login');
        }

        db_connect()->table('notifications')
            ->where('user_id', $userId)
            ->where('is_read', 0)
            ->update([
                'is_read' => 1,
                'read_at' => date('Y-m-d H:i:s'),
            ]);

        return redirect()->to('/notifikasi');
    }
}
