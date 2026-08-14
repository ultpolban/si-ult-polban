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

        // =========================
        // PENCARIAN
        // =========================
        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('ticket_number', $keyword)
                ->orLike('applicant_name', $keyword)
                ->orLike('nim', $keyword)
                ->orLike('service_name', $keyword)
                ->groupEnd();
        }

        // =========================
        // FILTER STATUS
        // =========================
        if (!empty($status)) {
            $builder->where('status', $status);
        }

        // =========================
        // FILTER JENIS
        // =========================
        if (!empty($submission_type)) {
            $builder->where('submission_type', $submission_type);
        }

        // =========================
        // PAGINATION
        // MAKSIMAL 10 TIKET / HALAMAN
        // =========================
        $tickets = $builder
            ->orderBy('submitted_at', 'DESC')
            ->paginate(10);

        $data = [
            'keyword'        => $keyword,
            'status'         => $status,
            'submission_type'=> $submission_type,
            'tickets'        => $tickets,
            'pager'          => $this->ticketModel->pager,
        ];

        return view('datatiket/index', $data);
    }
}