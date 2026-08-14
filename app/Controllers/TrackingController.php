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

        return view('tracking/index', [
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
            return view('tracking/index', [
                'ticket'   => null,
                'logs'     => [],
                'tickets'  => [],
                'error'    => 'Nomor tiket tidak ditemukan.',
                'isSearch' => true
            ]);
        }

        return view('tracking/index', [
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

        $status = $ticket['status'] ?? '';

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

            case 'Completed':
                $progressStep = 5;
                break;

            case 'In Progress':
                $progressStep = 4;
                break;

            case 'Assigned':
                $progressStep = 3;
                break;

            case 'Verified':
                $progressStep = 2;
                break;

            default:
                $progressStep = 1;
                break;
        }

        $ticket['progress_step'] = $progressStep;

        $ticket['lama_proses'] = $this->calculateDuration(
            $ticket['submitted_at'] ?? null,
            $ticket['updated_at'] ?? null,
            $status
        );

        return view('tracking/detail', [
            'ticket' => $ticket,
            'logs'   => $logs
        ]);
    }

    /**
     * Tiket yang sudah didisposisikan
     */
    private function getTrackingTickets()
    {
        return $this->ticketModel
            ->whereIn('status', [
                'Assigned',
                'In Progress',
                'Completed'
            ])
            ->where('assigned_unit !=', '')
            ->orderBy('updated_at', 'DESC')
            ->findAll();
    }

    /**
     * ==========================================================
     * DUMMY TEST
     * ==========================================================
     *
     * Digunakan hanya untuk mencoba perubahan status tiket
     * dari Assigned -> In Progress -> Completed.
     *
     * Nanti fungsi ini bisa dihapus setelah testing selesai.
     */
    public function dummy($ticketNumber, $status)
    {
        $ticket = $this->ticketModel
            ->where('ticket_number', $ticketNumber)
            ->first();

        // Tiket tidak ditemukan
        if (!$ticket) {
            return redirect()
                ->to(base_url('tracking'))
                ->with('error', 'Nomor tiket tidak ditemukan.');
        }

        // Status yang boleh digunakan untuk dummy
        $allowedStatus = [
            'Assigned',
            'In Progress',
            'Completed'
        ];

        if (!in_array($status, $allowedStatus)) {
            return redirect()
                ->to(base_url('tracking/detail/' . $ticketNumber))
                ->with('error', 'Status dummy tidak valid.');
        }

        $updateData = [
            'status'     => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Jika selesai, simpan waktu selesai
        if ($status === 'Completed') {
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

            if ($status === 'Completed' && !empty($updatedAt)) {
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