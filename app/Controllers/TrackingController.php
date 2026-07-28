<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\TicketLogModel;
use DateTime;

class TrackingController extends BaseController
{
    public function index()
    {
        return view('tracking/index');
    }

    public function search()
    {
        $ticketModel = new TicketModel();
        $logModel    = new TicketLogModel();

        $ticketNumber = $this->request->getPost('ticket_number');

        $ticket = $ticketModel
            ->where('ticket_number', $ticketNumber)
            ->first();

            $mulai = new \DateTime($ticket['submitted_at']);
$sekarang = new \DateTime();

$selisih = $mulai->diff($sekarang);

$ticket['lama_proses'] =
    $selisih->days . " Hari " .
    $selisih->h . " Jam";

        // Jika tiket tidak ditemukan
        if (!$ticket) {

            return view('tracking/index', [
                'ticket' => null,
                'logs'   => [],
                'error'  => 'Nomor tiket tidak ditemukan.'
            ]);

        }

        // Ambil riwayat aktivitas tiket
        $logs = $logModel
            ->where('ticket_id', $ticket['id'])
            ->orderBy('created_at', 'ASC')
            ->findAll();

        return view('tracking/index', [
            'ticket' => $ticket,
            'logs'   => $logs
        ]);
    }
}