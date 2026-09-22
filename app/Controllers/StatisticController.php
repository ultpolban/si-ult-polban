<?php

namespace App\Controllers;

use App\Controllers\AdminController;
use App\Services\TicketService;
use App\Constants\Permissions;

class StatisticController extends AdminController
{
    protected TicketService $ticketService;

    public function __construct()
    {
        parent::__construct();

        $this->ticketService = new TicketService();
    }

    /**
     * Halaman statistik.
     */
    public function index()
    {
        $this->authorize(Permissions::STATISTIC_VIEW);

        return view('statistics/index', $this->viewData([
            'title'          => 'Statistik Pengajuan',
            'pageTitle'      => 'Statistik Pengajuan',
            'breadcrumb'     => ['Tiket', 'Statistik'],
            'summary'        => $this->ticketService->summary(),
            'byStatus'       => $this->ticketService->statsByStatus(),
            'byUnit'         => $this->ticketService->statsByUnit(),
            'byApplicantType' => $this->ticketService->statsByApplicantType(),
            'byMonth'        => $this->ticketService->statsByMonth(),
            'statusMap'      => $this->statusMap(),
        ]));
    }

    /**
     * Peta status.
     */
    protected function statusMap(): array
    {
        return [
            'draft'       => 'Draft',
            'submitted'   => 'Diajukan',
            'verification' => 'Verifikasi',
            'revision'    => 'Revisi',
            'processing'  => 'Diproses',
            'completed'   => 'Selesai',
            'rejected'    => 'Ditolak',
            'cancelled'   => 'Dibatalkan',
        ];
    }
}
