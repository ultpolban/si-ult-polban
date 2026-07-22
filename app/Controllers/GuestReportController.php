<?php

namespace App\Controllers;

use App\Models\TicketModel;

class GuestReportController extends BaseController
{
    public function index()
    {
        return view('guest_report/create');
    }

    public function store()
{
    $ticketModel = new TicketModel();

    $ticketNumber = 'ULT-' . date('YmdHis');

    $file = $this->request->getFile('attachment');

    $attachment = null;

    if ($file && $file->isValid() && !$file->hasMoved()) {

        $attachment = $file->getRandomName();

        $file->move(FCPATH . 'uploads', $attachment);

    }

    $ticketModel->insert([

        'ticket_number'      => $ticketNumber,
        'service_name'       => $this->request->getPost('service_name'),
        'applicant_name'     => $this->request->getPost('applicant_name'),
        'applicant_type'     => $this->request->getPost('applicant_type'),
        'nim'                => $this->request->getPost('nim'),
        'email'              => $this->request->getPost('email'),
        'phone'              => $this->request->getPost('phone'),
        'ticket_title'       => $this->request->getPost('ticket_title'),
        'ticket_description' => $this->request->getPost('ticket_description'),
        'attachment'         => $attachment,

        'status'             => 'Submitted',
        'priority'           => 'Normal',
        'submitted_at'       => date('Y-m-d H:i:s')

    ]);

    return redirect()->to('/guest-report')
                     ->with('success', 'Laporan berhasil dibuat.');
}
}