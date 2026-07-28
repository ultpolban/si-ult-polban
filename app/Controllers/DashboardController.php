<?php

namespace App\Controllers;

use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $roleId = session()->get('role_id');

        if ($roleId == 1) {
            return redirect()->to('/admin/dashboard');
        } elseif ($roleId == 5) {
            return redirect()->to('/pimpinan/dashboard');
        }

        $data = [
            'totalUser'      => 120,
            'totalLayanan'   => 15,
            'totalTicket'    => 42,
            'ticketSelesai'  => 30,
        ];

        // Determine view based on role
        $roleViews = [
            2 => 'dashboard/petugas',
            3 => 'dashboard/unit',
            4 => 'dashboard/pemohon',
        ];

        $view = $roleViews[$roleId] ?? 'dashboard/index';

        return view($view, $data);
    }
}
