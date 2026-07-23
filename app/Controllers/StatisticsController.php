<?php

namespace App\Controllers;

use App\Models\TicketModel;

class StatisticsController extends BaseController
{
    public function index()
    {
        $ticketModel = new TicketModel();

        // Hitung jumlah tiap status
        $total = $ticketModel->countAll();

        $submitted = $ticketModel
            ->where('status', 'Submitted')
            ->countAllResults();

        $assigned = $ticketModel
            ->where('status', 'Assigned')
            ->countAllResults();

        $progress = $ticketModel
            ->where('status', 'In Progress')
            ->countAllResults();

        $completed = $ticketModel
            ->where('status', 'Completed')
            ->countAllResults();

        $revision = $ticketModel
            ->where('status', 'Need Revision')
            ->countAllResults();

        $rejected = $ticketModel
            ->where('status', 'Rejected')
            ->countAllResults();

        // Persentase tiket selesai
        $progressPercent = 0;

        if ($total > 0) {
            $progressPercent = round(($completed / $total) * 100);
        }

        $data = [
            'total'            => $total,
            'submitted'        => $submitted,
            'assigned'         => $assigned,
            'progress'         => $progress,
            'completed'        => $completed,
            'revision'         => $revision,
            'rejected'         => $rejected,
            'progressPercent'  => $progressPercent
        ];

        return view('statistics/index', $data);
    }
}