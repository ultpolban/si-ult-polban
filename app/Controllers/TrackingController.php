<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\TicketLogModel;

class TrackingController extends BaseController
{
    protected $ticketModel;
    protected $logModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->logModel    = new TicketLogModel();
    }

    /**
     * Halaman utama tracking
     */
    public function index()
    {
        $tickets = $this->getTrackingTickets();

        return view('petugas/tracking_tiket', [
            'ticket'   => null,
            'logs'     => [],
            'tickets'  => $tickets,
            'error'    => session()->getFlashdata('error'),
            'isSearch' => false
        ]);
    }

    /**
     * Pencarian tiket
     */
    public function search()
    {
        $ticketNumber = trim(
            $this->request->getPost('ticket_number')
                ?: $this->request->getGet('ticket_number')
                ?: ''
        );

        if ($ticketNumber === '') {
            return redirect()->to(base_url('tracking'));
        }

        $ticket = $this->ticketModel
            ->where('ticket_number', $ticketNumber)
            ->first();

        if (!$ticket) {
            return view('petugas/tracking_tiket', [
                'ticket'   => null,
                'logs'     => [],
                'tickets'  => [],
                'error'    => 'Nomor tiket tidak ditemukan.',
                'isSearch' => true
            ]);
        }

        return view('petugas/tracking_tiket', [
            'ticket'   => null,
            'logs'     => [],
            'tickets'  => [$ticket],
            'error'    => null,
            'isSearch' => true
        ]);
    }

    /**
     * Detail / progres tiket
     */
    public function detail($ticketNumber = null)
    {
        if (!$ticketNumber) {
            return redirect()->to(base_url('tracking'));
        }

        $ticket = $this->ticketModel
            ->where('ticket_number', $ticketNumber)
            ->first();

        if (!$ticket) {
            return redirect()
                ->to(base_url('tracking'))
                ->with('error', 'Nomor tiket tidak ditemukan.');
        }

        return $this->showDetail($ticket);
    }

    /**
     * Tampilkan detail tiket
     */
    private function showDetail(array $ticket)
    {
        $logs = [];

        if (!empty($ticket['id'])) {
            $logs = $this->logModel
                ->where('ticket_id', $ticket['id'])
                ->orderBy('created_at', 'ASC')
                ->findAll();
        }

        $status = strtolower(trim($ticket['status'] ?? ''));

        /*
         * Progress:
         *
         * 1 = Diajukan
         * 2 = Diverifikasi
         * 3 = Didisposisikan
         * 4 = Diproses Unit
         * 5 = Selesai
         */

        switch ($status) {

            case 'completed':
                $progressStep = 5;
                break;

            case 'in progress':
            case 'in_progress':
                $progressStep = 4;
                break;

            case 'assigned':
                $progressStep = 3;
                break;

            case 'verified':
                $progressStep = 2;
                break;

            default:
                $progressStep = 1;
                break;
        }

        $ticket['progress_step'] = $progressStep;

        $ticket['lama_proses'] = $this->calculateDuration(
            $ticket['submitted_at'] ?? null,
            $ticket['completed_at'] ?? $ticket['updated_at'] ?? null,
            $status
        );

        return view('tracking/detail', [
            'ticket' => $ticket,
            'logs'   => $logs
        ]);
    }

    /**
     * Tiket yang sudah masuk tahap disposisi
     */
private function getTrackingTickets()
{
    return $this->ticketModel
        ->select('
            tickets.*,
            master_services.name AS service_name,
            master_service_units.name AS unit_name,
            user_profiles.student_name AS student_name
        ')
        ->join(
            'master_services',
            'master_services.id = tickets.service_id',
            'left'
        )
        ->join(
            'master_service_units',
            'master_service_units.id = master_services.service_unit_id',
            'left'
        )
        ->join(
            'user_profiles',
            'user_profiles.id = tickets.user_profile_id',
            'left'
        )
        ->whereIn('tickets.status', [
            'assigned',
            'in_progress',
            'in progress',
            'completed'
        ])
        ->orderBy('tickets.updated_at', 'DESC')
        ->findAll();
}

    /**
     * ==========================================================
     * DUMMY TEST
     * ==========================================================
     *
     * Dipertahankan sementara untuk testing perubahan status.
     */
    public function dummy($ticketNumber, $status)
    {
        $ticket = $this->ticketModel
            ->where('ticket_number', $ticketNumber)
            ->first();

        if (!$ticket) {
            return redirect()
                ->to(base_url('tracking'))
                ->with('error', 'Nomor tiket tidak ditemukan.');
        }

        $statusMap = [
            'Assigned'    => 'assigned',
            'In Progress' => 'in_progress',
            'Completed'   => 'completed'
        ];

        if (!isset($statusMap[$status])) {
            return redirect()
                ->to(base_url('tracking/detail/' . $ticketNumber))
                ->with('error', 'Status dummy tidak valid.');
        }

        $dbStatus = $statusMap[$status];

        $updateData = [
            'status'     => $dbStatus,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($dbStatus === 'completed') {
            $updateData['completed_at'] = date('Y-m-d H:i:s');
        }

        $this->ticketModel
            ->where('ticket_number', $ticketNumber)
            ->set($updateData)
            ->update();

        return redirect()->to(
            base_url('tracking/detail/' . $ticketNumber)
        );
    }

    /**
     * Hitung lama proses
     */
    private function calculateDuration(
        $submittedAt,
        $updatedAt = null,
        $status = null
    ) {
        if (empty($submittedAt)) {
            return '-';
        }

        try {
            $mulai = new \DateTime($submittedAt);

            if ($status === 'completed' && !empty($updatedAt)) {
                $akhir = new \DateTime($updatedAt);
            } else {
                $akhir = new \DateTime();
            }

            $selisih = $mulai->diff($akhir);

            $hari = (int) $selisih->days;
            $jam  = (int) $selisih->h;

            return $hari . ' Hari ' . $jam . ' Jam';

        } catch (\Throwable $e) {
            return '-';
        }
    }
}