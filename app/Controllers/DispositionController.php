<?php

namespace App\Controllers;

use App\Models\TicketModel;

class DispositionController extends BaseController
{
    protected $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
    }

    // Daftar tiket yang sudah diverifikasi
    public function index()
    {
        $data['tickets'] = $this->ticketModel
            ->where('status', 'Verified')
            ->findAll();

        return view('disposition/index', $data);
    }

    // Detail disposisi
 public function detail($id)
{
    $ticketModel = new TicketModel();

    $ticket = $ticketModel->find($id);

    if (!$ticket) {
        return redirect()->to('/disposition')
            ->with('error', 'Tiket tidak ditemukan.');
    }

    return view('disposition/detail', [
        'ticket' => $ticket
    ]);
}

    // Proses kirim ke unit
public function process($id)
{
    $ticketModel = new TicketModel();

    $ticket = $ticketModel->find($id);

    if (!$ticket) {
        return redirect()->back()
            ->with('error', 'Tiket tidak ditemukan.');
    }

    // Unit tujuan otomatis dari tiket
    $unitTujuan = $ticket['assigned_unit'];

    // Instruksi dari petugas
    $instruction = $this->request->getPost('instruction');

    $ticketModel->update($id, [
        'assigned_unit' => $unitTujuan,
        'status'       => 'Assigned',
    ]);

    return redirect()->to('/disposition')
        ->with('success', 'Tiket berhasil didisposisikan ke unit ' . $unitTujuan);
}
}