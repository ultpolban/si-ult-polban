<?php

namespace App\Controllers;

use App\Models\TicketModel;

class DataTicketController extends BaseController
{
    protected $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
    }

    /**
     * Halaman utama Data Tiket
     */
    public function index()
    {
        $keyword = trim((string) $this->request->getGet('keyword'));
        $status  = trim((string) $this->request->getGet('status'));
        
       // Ambil angka dari input user
$perPage = (int) ($this->request->getGet('per_page') ?? 10);

// Pengaman jika user mengetik angka 0, minus, atau mengosongkan input
if ($perPage < 1) {
    $perPage = 10; // Default kembali ke 10 jika input tidak valid
}

        $builder = $this->ticketModel
            ->select("
                tickets.id,
                tickets.ticket_number,
                tickets.title,
                tickets.description,
                tickets.status,
                tickets.priority,
                tickets.submitted_at,
                tickets.verified_at,

                user_profiles.name AS applicant_name,
                user_profiles.nim,
                user_profiles.nik,
                user_profiles.email,
                user_profiles.phone,

                master_services.name AS service_name,
                master_services.service_unit_id,

                master_service_units.name AS unit_name
            ")
            ->join(
                'user_profiles',
                'user_profiles.id = tickets.user_profile_id',
                'left'
            )
            ->join(
                'master_services',
                'master_services.id = tickets.service_id',
                'left'
            )
            ->join(
                'master_service_units',
                'master_service_units.id = master_services.service_unit_id',
                'left'
            );

        // SEARCH
        if ($keyword !== '') {
            $builder
                ->groupStart()
                    ->like('tickets.ticket_number', $keyword)
                    ->orLike('user_profiles.name', $keyword)
                    ->orLike('user_profiles.nim', $keyword)
                    ->orLike('user_profiles.nik', $keyword)
                    ->orLike('master_services.name', $keyword)
                ->groupEnd();
        }

        // FILTER STATUS
        if ($status !== '') {
            $builder->where('tickets.status', $status);
        }

        // 2. Gunakan paginate() bawaan CI4 menggantikan findAll()
        $tickets = $builder
            ->orderBy('tickets.submitted_at', 'DESC')
            ->paginate($perPage, 'datatiket');

        return view('datatiket/index', [
            'tickets'     => $tickets,
            'pager'       => $this->ticketModel->pager,
            'perPage'     => $perPage,
            'keyword'     => $keyword,
            'status'      => $status,
            'total_tiket' => $this->ticketModel->countAll(),
            'submitted'   => $this->ticketModel->where('status', 'Submitted')->countAllResults(),
        ]);
    }
}