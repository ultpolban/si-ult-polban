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
    (string) (
        $this->request->getPost('ticket_number')
        ?: $this->request->getGet('ticket_number')
        ?: $this->request->getGet('q')
        ?: ''
    )
);
        if ($ticketNumber === '') {
            return redirect()->to(base_url('tracking'));
        }

       $ticket = $this->findAccessibleTicket($ticketNumber);
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

       $ticket = $this->findAccessibleTicket((string) $ticketNumber);
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
    $builder = $this->ticketModel
        ->select('tickets.*')
        ->join('master_services', 'master_services.id = tickets.service_id', 'left')
        ->join('master_service_units', 'master_service_units.id = tickets.unit_id', 'left')
        ->join('user_profiles', 'user_profiles.id = tickets.user_profile_id', 'left')
        ->whereIn('tickets.status', [
            'assigned',
            'in_progress',
            'in progress',
            'completed',
        ]);

    if (! $this->canViewAllTickets()) {
        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            return [];
        }

        $profile = (new \App\Models\UserProfileModel())
            ->where('user_id', $userId)
            ->first();

        if (! $profile) {
            return [];
        }

        $builder->where(
            'tickets.user_profile_id',
            (int) $profile['id']
        );
    }

    return $builder
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
 * Menentukan apakah akun boleh melihat semua tiket.
 */
private function canViewAllTickets(): bool
{
    log_message(
    'debug',
    'Tracking debug: user_id=' . session()->get('user_id')
    . ', role_code=' . session()->get('role_code')
);
    $roleCode = strtoupper(trim((string) session()->get('role_code')));

    return in_array($roleCode, [
        'PETUGAS_ULT',
        'ADMIN_ULT',
        'SUPER_ADMIN',
    ], true);
}

/**
 * Mengambil tiket hanya jika pengguna berhak melihatnya.
 */
private function findAccessibleTicket(string $ticketNumber): ?array
{
    $builder = $this->ticketModel
        ->where('ticket_number', $ticketNumber);

    if (! $this->canViewAllTickets()) {
        log_message(
    'debug',
    'Tracking filter: user_id=' . $userId
    . ', profile_id=' . $profile['id']
);
        if (! session()->get('isLoggedIn')) {
            return null;
        }

        $userId = (int) session()->get('user_id');

        if ($userId <= 0) {
            return null;
        }

        $profile = (new \App\Models\UserProfileModel())
            ->where('user_id', $userId)
            ->first();

        if (! $profile) {
            return null;
        }

        log_message(
    'debug',
    'Tracking filter: user_id=' . $userId
    . ', profile_id=' . $profile['id']
);
        $builder->where(
            'user_profile_id',
            (int) $profile['id']
        );
    }

    return $builder->first();
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