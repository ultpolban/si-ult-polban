<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\TicketCommentModel;
use CodeIgniter\RESTful\ResourceController;

class TicketController extends BaseController
{
    protected $ticketModel;
    protected $commentModel;

    public function __construct()
    {
        $this->ticketModel  = new TicketModel();
        $this->commentModel = new TicketCommentModel();
    }

    public function index()
    {
        $data['tickets'] = $this->ticketModel->getTicketDetails();
        return view('tickets/index', $data);
    }

    public function show($id)
    {
        $data['ticket']   = $this->ticketModel->getTicketDetails($id);
        $data['comments'] = $this->commentModel->getCommentsByTicket($id);

        if (!$data['ticket']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Tiket tidak ditemukan');
        }

        return view('tickets/detail', $data);
    }

    public function store()
    {
        $ticketCode = 'TCK-' . date('Ymd') . '-' . rand(100, 999);

        $data = [
            'ticket_code'     => $ticketCode,
            'user_profile_id' => $this->request->getPost('user_profile_id'),
            'service_id'      => $this->request->getPost('service_id'),
            'title'           => $this->request->getPost('title'),
            'description'     => $this->request->getPost('description'),
            'priority'        => $this->request->getPost('priority') ?? 'medium',
            'status'          => 'open',
        ];

        $file = $this->request->getFile('attachment');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(WRITEPATH . 'uploads', $newName);
            $data['attachment'] = $newName;
        }

        $this->ticketModel->insert($data);

        return redirect()->to('/tickets')->with('success', 'Tiket berhasil dibuat: ' . $ticketCode);
    }

    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');
        
        $updateData = ['status' => $status];
        if ($status === 'resolved') {
            $updateData['resolved_at'] = date('Y-m-d H:i:s');
        } elseif ($status === 'closed') {
            $updateData['closed_at'] = date('Y-m-d H:i:s');
        }

        $this->ticketModel->update($id, $updateData);

        return redirect()->back()->with('success', 'Status tiket berhasil diperbarui.');
    }
}