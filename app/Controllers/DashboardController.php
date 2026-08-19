<?php

namespace App\Controllers;

use App\Models\TicketModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $ticketModel = new TicketModel();

        // Mengambil jumlah total tiket untuk badge "Data Tiket"
        $totalTiket = $ticketModel->countAll();

        // Mengambil jumlah tiket "Submitted" untuk badge "Verifikasi Tiket" & Notifikasi Lonceng
        $submittedTiket = $ticketModel->where('status', 'Submitted')->countAllResults();

        $data = [
            'total'       => $totalTiket,
            'total_tiket' => $totalTiket,      // Digunakan untuk badge di Sidebar Data Tiket
            'submitted'   => $submittedTiket,  // Digunakan untuk badge Verifikasi Tiket & Notifikasi Lonceng
            
            'assigned' => $ticketModel
                ->where('status', 'Assigned')
                ->countAllResults(),

            'verified' => $ticketModel
                ->where('status', 'Verified')
                ->countAllResults(),

            'progress' => $ticketModel
                ->where('status', 'In Progress')
                ->countAllResults(),

            'completed' => $ticketModel
                ->where('status', 'Completed')
                ->countAllResults(),

            'revision' => $ticketModel
                ->where('status', 'Need Revision')
                ->countAllResults(),

            'rejected' => $ticketModel
                ->where('status', 'Rejected')
                ->countAllResults(),

            'tickets' => $ticketModel
                ->orderBy('submitted_at', 'DESC')
                ->findAll(5)
        ];

        return view('dashboard/index', $data);
    }
}