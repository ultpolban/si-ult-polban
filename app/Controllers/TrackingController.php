<?php

namespace App\Controllers;

use App\Models\TicketModel;

class TrackingController extends BaseController
{
    public function index()
    {
        return view('tracking/index');
    }

    public function search()
    {
        $ticketModel = new TicketModel();

        $ticketNumber = $this->request->getPost('ticket_number');

        $ticket = $ticketModel
            ->where('ticket_number', $ticketNumber)
            ->first();

        return view('tracking/index', [
            'ticket' => $ticket
        ]);
    }
}