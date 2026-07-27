<?php

namespace App\Controllers;

class DosenNotificationController extends BaseController
{
    /**
     * Halaman Notifikasi Dosen
     */
    public function index()
    {
        // Data sementara untuk frontend
        // Nanti akan diganti dengan data dari database

        $notifications = [];

        return view('dosen/notification/index', [
            'title'         => 'Notifikasi Dosen',
            'notifications' => $notifications
        ]);
    }
}