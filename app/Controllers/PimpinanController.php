<?php

namespace App\Controllers;

use App\Services\TicketService;

/**
 * =====================================================================
 *  Dashboard Pimpinan
 * =====================================================================
 *
 *  Read-only monitoring: statistik, laporan, dan tracking tiket.
 */
class PimpinanController extends BaseController
{
    protected TicketService $ticketService;

    public function __construct()
    {
        helper(['role']);

        $this->ticketService = new TicketService();
    }

    public function dashboard()
    {
        $data = [
            'title'         => 'Dashboard Pimpinan',
            'pageTitle'     => 'Dashboard Pimpinan',
            'breadcrumb'    => ['Beranda', 'Pimpinan'],
            'summary'       => $this->ticketService->summary(),
            'statsByStatus' => $this->ticketService->statsByStatus(),
            'statsByUnit'   => $this->ticketService->statsByUnit(),
            'statsByMonth'  => $this->ticketService->statsByMonth(),
        ];

        return view('dashboard/pimpinan', $data);
    }

    public function ringkasan()
    {
        $data = [
            'title'         => 'Ringkasan Tiket',
            'pageTitle'     => 'Ringkasan Tiket',
            'breadcrumb'    => ['Beranda', 'Ringkasan Tiket'],
            'summary'       => $this->ticketService->summary(),
            'statsByUnit'   => $this->ticketService->statsByUnit(),
            'statsByType'   => $this->ticketService->statsByApplicantType(),
            'latestTickets' => $this->ticketService->latest(15),
        ];

        return view('dashboard/pimpinan_ringkasan', $data);
    }
}