<?php

namespace App\Controllers;

use App\Models\TicketModel;

class ReportController extends BaseController
{
    public function index()
    {
        $ticketModel = new TicketModel();

        $builder = $ticketModel;

        // Cari berdasarkan nomor tiket
        if ($this->request->getGet('ticket_number')) {
            $builder->like(
                'ticket_number',
                $this->request->getGet('ticket_number')
            );
        }

        $data = [
            'tickets' => $builder
                ->orderBy('submitted_at', 'DESC')
                ->findAll()
        ];

        return view('report/index', $data);
    }

    public function exportPdf()
{
    // ambil data tiket
    // load view pdf
    // tampilkan PDF
}

public function exportExcel()
{
    // buat spreadsheet
    // isi data tiket
    // download .xlsx
}

public function print()
{
    $ticketModel = new \App\Models\TicketModel();

    $data['tickets'] = $ticketModel->findAll();

    return view('report/print', $data);
}

}