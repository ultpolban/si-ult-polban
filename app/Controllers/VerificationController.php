<?php

namespace App\Controllers;

use App\Models\TicketModel;

class VerificationController extends BaseController
{
    public function index()
    {
        $ticketModel = new TicketModel();

        $data = [
            'title'   => 'Verifikasi Tiket',
            'tickets' => $ticketModel->findAll()
        ];

        return view('verification/index', $data);
    }

    public function detail($id)
    {
        $ticketModel = new TicketModel();

        $ticket = $ticketModel->find($id);

        if (!$ticket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('verification/detail', [
            'ticket' => $ticket
        ]);
    }

    public function verify($id)
    {
        $ticketModel = new TicketModel();

        $ticketModel->update($id, [
            'status' => 'Verified',
            'verified_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/verification')
            ->with('success', 'Tiket berhasil diverifikasi.');
    }

    public function disposition($id)
    {
        $ticketModel = new TicketModel();

        $ticketModel->update($id, [
            'assigned_unit_id' => 1,
            'status' => 'Diproses Unit'
        ]);

        return redirect()->to('/verification')
            ->with('success', 'Tiket berhasil didisposisikan ke Unit Kerja.');
    }
}