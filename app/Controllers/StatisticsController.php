<?php

namespace App\Controllers;

use App\Models\TicketModel;

class StatisticsController extends BaseController
{
    public function index()
    {
        $ticketModel = new TicketModel();

        // Total seluruh tiket
        $total = $ticketModel->countAll();

        // Hitung berdasarkan status
        $submitted = $ticketModel
            ->where('status', 'Submitted')
            ->countAllResults();

        $verified = $ticketModel
            ->where('status', 'Verified')
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

        // Status lain yang mungkin ada di database
        $knownStatusTotal =
            $submitted +
            $verified +
            $assigned +
            $progress +
            $completed +
            $revision +
            $rejected;

        $other = max(0, $total - $knownStatusTotal);

        // Persentase penyelesaian
        $progressPercent = 0;

        if ($total > 0) {
            $progressPercent = round(($completed / $total) * 100);
        }

        $data = [
            'total'           => $total,
            'submitted'       => $submitted,
            'verified'        => $verified,
            'assigned'        => $assigned,
            'progress'        => $progress,
            'completed'       => $completed,
            'revision'        => $revision,
            'rejected'        => $rejected,
            'other'           => $other,
            'progressPercent' => $progressPercent
        ];

        return view('statistics/index', $data);
    }
}