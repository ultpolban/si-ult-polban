<?php

namespace App\Controllers;

use App\Models\TicketModel;

class DataTicket extends BaseController
{
    protected $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
    }

    // Semua tiket
   public function index()
{
    $keyword = $this->request->getGet('keyword');
    $status = $this->request->getGet('status');
    $submission_type = $this->request->getGet('submission_type');

    $builder = $this->ticketModel;

    if (!empty($keyword)) {
        $builder->groupStart()
            ->like('ticket_number', $keyword)
            ->orLike('applicant_name', $keyword)
            ->orLike('nim', $keyword)
            ->orLike('service_name', $keyword)
            ->groupEnd();
    }

    if (!empty($status)) {
        $builder->where('status', $status);
    }

    if (!empty($submission_type)) {
        $builder->where('submission_type', $submission_type);
    }

    $data = [
        'keyword' => $keyword,
        'status' => $status,
        'submission_type' => $submission_type,
        'tickets' => $builder
            ->orderBy('submitted_at', 'DESC')
            ->findAll(),
    ];

    return view('datatiket/index', $data);
}
}