<?php

namespace App\Controllers;

use App\Models\UserModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $role = session()->get('role_id');

        switch ($role) {

            case 1: // Admin
                $userModel = new UserModel();

                $data = [
                    'totalUser' => $userModel->countAll()
                ];

                return view('dashboard/admin', $data);

            case 2: // Petugas
                return view('dashboard/petugas');

            case 3: // Unit Kerja
                return view('dashboard/unit');

            case 4: // Pemohon
                return view('dashboard/pemohon');

            case 5: // Pimpinan
                return view('dashboard/pimpinan');

            default:
                session()->destroy();
                return redirect()->to('/login');
        }
    }
}
