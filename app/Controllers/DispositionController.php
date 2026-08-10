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
        $data['ticket'] = $this->ticketModel->find($id);

        if (!$data['ticket']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('disposition/detail', $data);
    }

    // Proses kirim ke unit
public function process($id)
{
    $data = [
        'assigned_unit' => $this->request->getPost('assigned_unit'),
        'priority'      => $this->request->getPost('priority'),
        'status'        => 'Assigned',
    ];

    $this->ticketModel->update($id, $data);

    return redirect()->to(base_url('disposition'))
        ->with('success', 'Tiket berhasil didisposisikan.');
}
}