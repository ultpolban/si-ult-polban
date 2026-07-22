<?php

namespace App\Controllers;

use App\Models\TicketModel;

class StatisticsController extends BaseController
{
    public function index()
    {
        $ticketModel = new TicketModel();

        $data = [

            'total' => $ticketModel->countAll(),

            'submitted' => $ticketModel
                ->where('status','Submitted')
                ->countAllResults(),

            'assigned' => $ticketModel
                ->where('status','Assigned')
                ->countAllResults(),

            'progress' => $ticketModel
                ->where('status','In Progress')
                ->countAllResults(),

            'completed' => $ticketModel
                ->where('status','Completed')
                ->countAllResults(),

            'revision' => $ticketModel
                ->where('status','Need Revision')
                ->countAllResults(),

            'rejected' => $ticketModel
                ->where('status','Rejected')
                ->countAllResults(),

        ];

        return view('statistics/index',$data);
    }
}