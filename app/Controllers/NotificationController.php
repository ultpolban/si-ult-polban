<?php

namespace App\Controllers;

use App\Controllers\AdminController;
use App\Services\NotificationService;

class NotificationController extends AdminController
{
    protected NotificationService $notificationService;

    public function __construct()
    {
        parent::__construct();

        $this->notificationService = service('notificationService');
    }

    /**
     * Daftar notifikasi
     */
    public function index()
    {
        $userId = (int) ($this->user['id'] ?? session()->get('user_id'));

        $notifications = $this->notificationService->getNotifications($userId);

        return view('notifications/index', $this->viewData([
            'title'         => 'Notifikasi',
            'pageTitle'     => 'Notifikasi',
            'breadcrumb'    => ['Notifikasi'],
            'notificationList' => $notifications,
        ]));
    }

    /**
     * Tandai dibaca
     */
    public function read(int $id)
    {
        $this->notificationService->markAsRead($id);

        return redirect()->back();
    }

    /**
     * Tandai semua dibaca
     */
    public function readAll()
    {
        $userId = (int) ($this->user['id'] ?? session()->get('user_id'));

        $model = $this->notificationService->getModel();

        $model->where('user_id', $userId)
            ->where('is_read', 0)
            ->set(['is_read' => 1, 'read_at' => date('Y-m-d H:i:s')])
            ->update();

        return redirect()->back()
            ->with('success', 'Semua notifikasi ditandai sudah dibaca.');
    }
}
