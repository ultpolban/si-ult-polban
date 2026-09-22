<?php

namespace App\Controllers;

use App\Models\NotificationModel;

class NotificationController extends BaseController
{
    protected $notificationModel;

    public function __construct()
    {
        $this->notificationModel = new NotificationModel();
    }

    /**
     * Tandai satu notifikasi sebagai sudah dibaca.
     */
    public function read($id)
    {
        $userId = session()->get('user_id');

        if (empty($userId)) {
            return $this->response->setStatusCode(401);
        }

        $notification = $this->notificationModel
            ->where('id', (int) $id)
            ->where('user_id', (int) $userId)
            ->first();

        if (!$notification) {
            return $this->response->setStatusCode(404);
        }

        $this->notificationModel
            ->where('id', (int) $id)
            ->where('user_id', (int) $userId)
            ->set([
                'is_read' => 1,
                'read_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ])
            ->update();

        return $this->response->setJSON([
            'success' => true
        ]);
    }

    /**
     * Tandai seluruh notifikasi user sebagai sudah dibaca.
     */
    public function readAll()
    {
        $userId = session()->get('user_id');

        if (empty($userId)) {
            return $this->response->setStatusCode(401);
        }

        $this->notificationModel
            ->where('user_id', (int) $userId)
            ->where('is_read', 0)
            ->set([
                'is_read' => 1,
                'read_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ])
            ->update();

        return $this->response->setJSON([
            'success' => true
        ]);
    }
}