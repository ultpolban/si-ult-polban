<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TicketModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $role = session()->get('role_id');

        switch ($role) {

            case 1: // Admin

                $userModel = new UserModel();
                $ticketModel = new TicketModel();

                $data = [
                    'totalUser'   => $userModel->countAll(),
                    'totalTicket' => $ticketModel->countAll(),

                    'submitted' => $ticketModel
                        ->where('status', 'Submitted')
                        ->countAllResults(),

                    'verified' => $ticketModel
                        ->where('status', 'Verified')
                        ->countAllResults(),

                    'completed' => $ticketModel
                        ->where('status', 'Completed')
                        ->countAllResults(),

                    'tickets' => $ticketModel
                        ->orderBy('submitted_at', 'DESC')
                        ->findAll()
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