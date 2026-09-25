<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TicketModel;
use App\Models\TicketAttachmentModel;

class TicketController extends BaseController
{
    protected $ticketModel;
    protected $attachmentModel;

    public function __construct()
    {
        $this->ticketModel     = new TicketModel();
        $this->attachmentModel = new TicketAttachmentModel();
    }

    /**
     * ============================================================
     * DETAIL TIKET
     * ============================================================
     * GET /ticket/detail/(:num)
     */
    public function detail($id = null)
    {
        if ($id === null || !is_numeric($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'ID tiket tidak ditemukan.'
            );
        }

        // ========================================================
        // AMBIL DATA TIKET
        // ========================================================
        $ticket = $this->ticketModel->getTicketDetail((int) $id);

        if (!$ticket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Data tiket tidak ditemukan.'
            );
        }

        // ========================================================
        // AMBIL LAMPIRAN
        // ========================================================
        $attachments = [];

        if (class_exists(TicketAttachmentModel::class)) {
            $attachments = $this->attachmentModel
                ->where('ticket_id', (int) $id)
                ->orderBy('id', 'ASC')
                ->findAll();
        }

        // ========================================================
        // NORMALISASI DATA UNTUK VIEW DETAIL
        // ========================================================
        $tiket = [
            'id' => $ticket['id'] ?? $id,

            // Nomor tiket
            'ticket_number' =>
                $ticket['ticket_number']
                ?? '-',

            // Status
            'status' =>
                strtolower(
                    trim(
                        $ticket['status']
                        ?? 'submitted'
                    )
                ),

            // Prioritas
            'priority' =>
                $ticket['priority']
                ?? 'normal',

            // Layanan
            'service_name' =>
                $ticket['service_name']
                ?? '-',

            // Unit layanan
            'unit_name' =>
                $ticket['unit_name']
                ?? $ticket['service_unit_name']
                ?? '-',

            // Jenis pemohon
            'applicant_type' =>
                $ticket['applicant_type']
                ?? $ticket['applicant_type_name']
                ?? '-',

            // Nama pemohon
            'applicant_name' =>
                $ticket['applicant_name']
                ?? $ticket['student_name']
                ?? $ticket['name']
                ?? '-',

            // NIM / NIK
            'nim' =>
                $ticket['nim']
                ?? null,

            'nik' =>
                $ticket['nik']
                ?? null,

            // Email
            'email' =>
                $ticket['email']
                ?? '-',

            // Nomor HP
            'phone' =>
                $ticket['phone']
                ?? '-',

            // Judul
            'title' =>
                $ticket['title']
                ?? $ticket['service_name']
                ?? '-',

            // Deskripsi
            'description' =>
                $ticket['description']
                ?? '',

            // Timeline
            'submitted_at' =>
                $ticket['submitted_at']
                ?? null,

            'verified_at' =>
                $ticket['verified_at']
                ?? null,

            'processed_at' =>
                $ticket['processed_at']
                ?? null,

            'completed_at' =>
                $ticket['completed_at']
                ?? null,

            'rejected_at' =>
                $ticket['rejected_at']
                ?? null,

            'cancelled_at' =>
                $ticket['cancelled_at']
                ?? null,
        ];

        // ========================================================
        // TIMELINE
        // ========================================================
        $timeline = [];

        if (!empty($tiket['submitted_at'])) {
            $timeline[] = [
                'title' => 'Tiket Berhasil Diajukan',
                'date'  => $tiket['submitted_at'],
                'icon'  => 'fa-paper-plane',
            ];
        }

        if (!empty($tiket['verified_at'])) {
            $timeline[] = [
                'title' => 'Tiket Telah Diverifikasi',
                'date'  => $tiket['verified_at'],
                'icon'  => 'fa-check-circle',
            ];
        }

        /*
         * processed_at digunakan untuk proses tiket.
         */
        if (!empty($tiket['processed_at'])) {
            $timeline[] = [
                'title' => 'Tiket Sedang Diproses',
                'date'  => $tiket['processed_at'],
                'icon'  => 'fa-cogs',
            ];
        }

        if (!empty($tiket['completed_at'])) {
            $timeline[] = [
                'title' => 'Permohonan Selesai',
                'date'  => $tiket['completed_at'],
                'icon'  => 'fa-check-double',
            ];
        }

        if (!empty($tiket['rejected_at'])) {
            $timeline[] = [
                'title' => 'Permohonan Ditolak',
                'date'  => $tiket['rejected_at'],
                'icon'  => 'fa-times-circle',
            ];
        }

        if (!empty($tiket['cancelled_at'])) {
            $timeline[] = [
                'title' => 'Permohonan Dibatalkan',
                'date'  => $tiket['cancelled_at'],
                'icon'  => 'fa-ban',
            ];
        }

        // ========================================================
        // DATA VIEW
        // ========================================================
        $data = [
            'title'       => 'Detail Informasi Tiket',
            'ticket'      => $ticket,
            'tiket'       => $tiket,
            'timeline'    => $timeline,
            'attachments' => $attachments,
            'lampiran'    => $attachments,
        ];

        return view('petugas/detail', $data);
    }
}