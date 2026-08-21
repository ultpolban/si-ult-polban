<?php

namespace App\Controllers;

use App\Models\TicketModel;
use CodeIgniter\Database\BaseConnection;

class VerificationController extends BaseController
{
    protected TicketModel $ticketModel;
    protected BaseConnection $db;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * ============================================================
     * HALAMAN VERIFIKASI
     * Hanya menampilkan tiket yang masih SUBMITTED
     * ============================================================
     */
    public function index()
    {
        $tickets = $this->ticketModel->getByStatus('submitted');

        return view('verification/index', [
            'tickets' => $tickets
        ]);
    }

    /**
     * ============================================================
     * DETAIL TIKET
     * ============================================================
     */
    public function detail($id)
    {
        $ticket = $this->ticketModel->getTicketDetail($id);

        if (!$ticket) {
            return redirect()
                ->to('/verification')
                ->with('error', 'Data tiket tidak ditemukan.');
        }

        // Data pemohon
        $profile = null;

        if (!empty($ticket['user_profile_id'])) {
            $profile = $this->db
                ->table('user_profiles')
                ->where('id', $ticket['user_profile_id'])
                ->get()
                ->getRowArray();
        }

        // Data unit layanan
        $unit = null;

        if (!empty($ticket['service_unit_id'])) {
            $unit = $this->db
                ->table('master_service_units')
                ->where('id', $ticket['service_unit_id'])
                ->get()
                ->getRowArray();
        }

        // Komentar
        $comments = [];

        if ($this->db->tableExists('ticket_comments')) {
            $comments = $this->db
                ->table('ticket_comments')
                ->where('ticket_id', $id)
                ->orderBy('id', 'ASC')
                ->get()
                ->getResultArray();
        }

        // Log tiket
        $logs = [];

        if ($this->db->tableExists('ticket_logs')) {
            $logs = $this->db
                ->table('ticket_logs')
                ->where('ticket_id', $id)
                ->orderBy('id', 'ASC')
                ->get()
                ->getResultArray();
        }

        return view('verification/detail', [
            'ticket'   => $ticket,
            'profile'  => $profile,
            'unit'     => $unit,
            'comments' => $comments,
            'logs'     => $logs
        ]);
    }

    /**
     * Alias process
     */
    public function process($id)
    {
        return $this->detail($id);
    }

    /**
     * ============================================================
     * VERIFIKASI TIKET
     *
     * submitted
     *     ↓
     * verified
     *     ↓
     * masuk antrean DISPOSISI
     *
     * TIDAK langsung dikirim ke unit.
     * ============================================================
     */
    public function verify($id)
    {
        // Pastikan tiket ada
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to('/verification')
                ->with('error', 'Tiket tidak ditemukan.');
        }

        // Pastikan hanya tiket submitted yang boleh diverifikasi
        if (($ticket['status'] ?? '') !== 'submitted') {
            return redirect()
                ->to('/verification')
                ->with(
                    'error',
                    'Tiket ini tidak dapat diverifikasi karena statusnya sudah berubah.'
                );
        }

        $now = date('Y-m-d H:i:s');

        // Ambil user yang melakukan verifikasi
        $userId = session()->get('user_id');

        $updateData = [
            'status'      => 'verified',
            'verified_at' => $now
        ];

        /*
         * Jika kolom verified_by memang tersedia,
         * simpan ID petugas yang melakukan verifikasi.
         */
        $ticketFields = $this->db->getFieldNames('tickets');

        if (
            in_array('verified_by', $ticketFields) &&
            !empty($userId)
        ) {
            $updateData['verified_by'] = $userId;
        }

        // Update tiket
        $updated = $this->ticketModel->update($id, $updateData);

        if (!$updated) {
            return redirect()
                ->back()
                ->with('error', 'Gagal memverifikasi tiket.');
        }

        // Simpan log
        $this->addTicketLog(
            $id,
            'verified',
            'Tiket telah diverifikasi oleh Petugas ULT dan masuk ke antrean disposisi.'
        );

        /*
         * Setelah diverifikasi:
         *
         * VERIFIED
         *    ↓
         * DISPOSISI
         *
         * BUKAN langsung ke unit.
         */
        return redirect()
            ->to('/disposition')
            ->with(
                'success',
                'Tiket berhasil diverifikasi dan masuk ke antrean disposisi.'
            );
    }

    /**
     * ============================================================
     * KEMBALIKAN TIKET UNTUK REVISI
     *
     * submitted
     *     ↓
     * need_revision
     *     ↓
     * pemohon memperbaiki
     * ============================================================
     */
    public function revision($id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to('/verification')
                ->with('error', 'Tiket tidak ditemukan.');
        }

        if (($ticket['status'] ?? '') !== 'submitted') {
            return redirect()
                ->to('/verification')
                ->with(
                    'error',
                    'Tiket ini tidak dapat dikembalikan karena statusnya sudah berubah.'
                );
        }

        $comment = trim(
            (string) $this->request->getPost('comment')
        );

        if ($comment === '') {
            return redirect()
                ->back()
                ->with('error', 'Alasan revisi wajib diisi.');
        }

        $updated = $this->ticketModel->update($id, [
            'status' => 'need_revision'
        ]);

        if (!$updated) {
            return redirect()
                ->back()
                ->with('error', 'Gagal mengubah status tiket.');
        }

        // Simpan komentar alasan revisi
        $this->addTicketComment($id, $comment);

        // Simpan log
        $this->addTicketLog(
            $id,
            'need_revision',
            'Tiket dikembalikan kepada pemohon untuk diperbaiki: ' . $comment
        );

        return redirect()
            ->to('/verification')
            ->with(
                'success',
                'Tiket berhasil dikembalikan kepada pemohon untuk diperbaiki.'
            );
    }

    /**
     * ============================================================
     * TOLAK TIKET
     *
     * submitted
     *     ↓
     * rejected
     * ============================================================
     */
    public function reject($id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to('/verification')
                ->with('error', 'Tiket tidak ditemukan.');
        }

        if (($ticket['status'] ?? '') !== 'submitted') {
            return redirect()
                ->to('/verification')
                ->with(
                    'error',
                    'Tiket ini tidak dapat ditolak karena statusnya sudah berubah.'
                );
        }

        $comment = trim(
            (string) $this->request->getPost('comment')
        );

        if ($comment === '') {
            return redirect()
                ->back()
                ->with('error', 'Alasan penolakan wajib diisi.');
        }

        $updated = $this->ticketModel->update($id, [
            'status' => 'rejected'
        ]);

        if (!$updated) {
            return redirect()
                ->back()
                ->with('error', 'Gagal mengubah status tiket.');
        }

        // Simpan alasan penolakan
        $this->addTicketComment($id, $comment);

        // Simpan log
        $this->addTicketLog(
            $id,
            'rejected',
            'Tiket ditolak: ' . $comment
        );

        return redirect()
            ->to('/verification')
            ->with(
                'success',
                'Tiket berhasil ditolak.'
            );
    }

    /**
     * ============================================================
     * SIMPAN KOMENTAR
     * ============================================================
     */
    private function addTicketComment($ticketId, $comment)
    {
        if (!$this->db->tableExists('ticket_comments')) {
            return;
        }

        $fields = $this->db->getFieldNames('ticket_comments');

        $data = [];

        if (in_array('ticket_id', $fields)) {
            $data['ticket_id'] = $ticketId;
        }

        if (in_array('comment', $fields)) {
            $data['comment'] = $comment;
        } elseif (in_array('content', $fields)) {
            $data['content'] = $comment;
        } elseif (in_array('message', $fields)) {
            $data['message'] = $comment;
        }

        if (in_array('user_id', $fields)) {
            $userId = session()->get('user_id');

            if (!empty($userId)) {
                $data['user_id'] = $userId;
            }
        }

        if (in_array('created_at', $fields)) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        if (!empty($data)) {
            $this->db
                ->table('ticket_comments')
                ->insert($data);
        }
    }

    /**
     * ============================================================
     * SIMPAN LOG TIKET
     * ============================================================
     */
    private function addTicketLog(
        $ticketId,
        $status,
        $description
    ) {
        if (!$this->db->tableExists('ticket_logs')) {
            return;
        }

        $fields = $this->db->getFieldNames('ticket_logs');

        $data = [];

        if (in_array('ticket_id', $fields)) {
            $data['ticket_id'] = $ticketId;
        }

        if (in_array('user_id', $fields)) {
            $userId = session()->get('user_id');

            if (!empty($userId)) {
                $data['user_id'] = $userId;
            }
        }

        if (in_array('status', $fields)) {
            $data['status'] = $status;
        }

        if (in_array('description', $fields)) {
            $data['description'] = $description;
        } elseif (in_array('note', $fields)) {
            $data['note'] = $description;
        } elseif (in_array('message', $fields)) {
            $data['message'] = $description;
        }

        if (in_array('created_at', $fields)) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }

        if (!empty($data)) {
            $this->db
                ->table('ticket_logs')
                ->insert($data);
        }
    }
}