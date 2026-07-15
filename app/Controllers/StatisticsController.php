<?php

namespace App\Controllers;

use App\Models\TicketModel;

class StatisticsController extends BaseController
{
    public function index()
    {
        $ticketModel = new TicketModel();

        $submitted = $ticketModel->where('status', 'Submitted')->countAllResults();
        $verified = $ticketModel->where('status', 'Verified')->countAllResults();
        $completed = $ticketModel->where('status', 'Completed')->countAllResults();
        $diproses = $ticketModel->where('status', 'Diproses Unit')->countAllResults();

        return view('statistics/index', [
            'submitted' => $submitted,
            'verified' => $verified,
            'completed' => $completed,
            'diproses' => $diproses
        ]);
    }
}