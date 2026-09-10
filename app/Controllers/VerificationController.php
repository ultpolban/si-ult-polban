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
     * HALAMAN DAFTAR VERIFIKASI
     * HANYA MENAMPILKAN TIKET SUBMITTED
     * ============================================================
     */
    public function index()
    {
        $tickets = $this->db
            ->table('tickets t')
            ->select('
                t.id,
                t.ticket_number,
                t.user_profile_id,
                t.service_id,
                t.status,
                t.priority,
                t.submitted_at,
                t.created_at,
                ms.name AS service_name,
                up.name AS applicant_name,
                up.nim,
                up.nik
            ')
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'user_profiles up',
                'up.id = t.user_profile_id',
                'left'
            )
            ->where('LOWER(t.status)', 'submitted')
            ->orderBy('t.submitted_at', 'DESC')
            ->get()
            ->getResultArray();

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
        $ticket = $this->db
            ->table('tickets t')
            ->select('
                t.*,
                ms.name AS service_name
            ')
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->where('t.id', $id)
            ->get()
            ->getRowArray();

        if (!$ticket) {
            return redirect()
                ->to(base_url('verification'))
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        $profile = null;

        if (!empty($ticket['user_profile_id'])) {
            $profile = $this->db
                ->table('user_profiles')
                ->where(
                    'id',
                    $ticket['user_profile_id']
                )
                ->get()
                ->getRowArray();
        }

        $logs = [];

        if ($this->db->tableExists('ticket_logs')) {
            $logs = $this->db
                ->table('ticket_logs')
                ->where(
                    'ticket_id',
                    $id
                )
                ->orderBy(
                    'created_at',
                    'ASC'
                )
                ->get()
                ->getResultArray();
        }

        return view('verification/detail', [
            'ticket'  => $ticket,
            'profile' => $profile,
            'logs'    => $logs
        ]);
    }

    /**
     * ============================================================
     * FORM VERIFIKASI
     * ============================================================
     */
    public function verify($id)
    {
        $ticket = $this->db
            ->table('tickets t')
            ->select('
                t.*,

                ms.name AS service_name,

                up.name AS applicant_name,
                up.nim,
                up.nik,
                up.email,
                up.phone
            ')
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'user_profiles up',
                'up.id = t.user_profile_id',
                'left'
            )
            ->where(
                't.id',
                $id
            )
            ->get()
            ->getRowArray();

        if (!$ticket) {
            return redirect()
                ->to(base_url('verification'))
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        /**
         * Hanya tiket submitted
         * yang boleh masuk form verifikasi.
         */
        if (
            strtolower(
                trim($ticket['status'] ?? '')
            ) !== 'submitted'
        ) {
            return redirect()
                ->to(base_url('verification'))
                ->with(
                    'error',
                    'Tiket ini sudah diproses.'
                );
        }

        /**
         * RIWAYAT LOG
         */
        $logs = [];

        if ($this->db->tableExists('ticket_logs')) {
            $logs = $this->db
                ->table('ticket_logs')
                ->where(
                    'ticket_id',
                    $id
                )
                ->orderBy(
                    'created_at',
                    'DESC'
                )
                ->get()
                ->getResultArray();
        }

        return view('verification/verify', [
            'ticket' => $ticket,
            'logs'   => $logs
        ]);
    }

    /**
     * ============================================================
     * SIMPAN HASIL VERIFIKASI
     *
     * submitted
     *     ↓
     * verified
     *     ↓
     * disposition
     * ============================================================
     */
    public function process($id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('verification'))
                ->with(
                    'error',
                    'Tiket tidak ditemukan.'
                );
        }

        /**
         * Pastikan tiket masih submitted.
         */
        if (
            strtolower(
                trim($ticket['status'] ?? '')
            ) !== 'submitted'
        ) {
            return redirect()
                ->to(base_url('verification'))
                ->with(
                    'error',
                    'Tiket sudah diproses atau tidak dapat diverifikasi.'
                );
        }

        $now = date('Y-m-d H:i:s');

        /**
         * ========================================================
         * HASIL VERIFIKASI
         * ========================================================
         *
         * Nilai yang dikirim dari form:
         *
         * verify   = Verified
         * revision = Revision
         * reject   = Rejected
         */
        $action = strtolower(
            trim(
                (string) $this->request->getPost('action')
            )
        );

        /**
         * Jika action kosong, default verify.
         */
        if ($action === '') {
            $action = 'verify';
        }

        /**
         * Mapping action ke status database.
         */
        $statusMap = [
            'verify'   => 'verified',
            'revision' => 'revision',
            'reject'   => 'rejected'
        ];

        if (!isset($statusMap[$action])) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Hasil verifikasi tidak valid.'
                );
        }

        $newStatus = $statusMap[$action];

        /**
         * ========================================================
         * DATA YANG DIISI DARI FORM
         * ========================================================
         */

        $priority = trim(
            (string) $this->request->getPost('priority')
        );

        /**
         * Unit tujuan.
         *
         * Nilai ini diambil dari form.
         * Kalau form sudah mengisi unit tujuan,
         * nilai tersebut akan disimpan ke tiket.
         */
        $assignedTo = trim(
            (string) $this->request->getPost('assigned_to')
        );

        /**
         * Catatan verifikasi.
         */
        $verificationNote = trim(
            (string) $this->request->getPost('verification_note')
        );

        /**
         * Komentar petugas.
         */
        $comment = trim(
            (string) $this->request->getPost('comment')
        );

        /**
         * ========================================================
         * SIAPKAN DATA UPDATE
         * ========================================================
         */
        $updateData = [];

        $ticketFields = $this->db
            ->getFieldNames('tickets');

        /**
         * STATUS
         */
        if (in_array('status', $ticketFields)) {
            $updateData['status'] = $newStatus;
        }

        /**
         * PRIORITY
         */
        if (
            $priority !== '' &&
            in_array('priority', $ticketFields)
        ) {
            $updateData['priority'] = $priority;
        }

        /**
         * ========================================================
         * UNIT TUJUAN
         * ========================================================
         *
         * Ini bagian penting:
         * nilai assigned_to dari form disimpan ke tickets
         * jika kolom tersebut memang tersedia di database.
         */
        if (
            $assignedTo !== '' &&
            in_array('assigned_to', $ticketFields)
        ) {
            $updateData['assigned_to'] = $assignedTo;
        }

        /**
         * ========================================================
         * CATATAN VERIFIKASI
         * ========================================================
         */
        if (
            $verificationNote !== '' &&
            in_array('verification_note', $ticketFields)
        ) {
            $updateData['verification_note'] = $verificationNote;
        }

        /**
         * ========================================================
         * KOMENTAR
         * ========================================================
         */
        if (
            $comment !== '' &&
            in_array('admin_note', $ticketFields)
        ) {
            $updateData['admin_note'] = $comment;
        }

        /**
         * VERIFIED AT
         */
        if (
            $action === 'verify' &&
            in_array('verified_at', $ticketFields)
        ) {
            $updateData['verified_at'] = $now;
        }

        /**
         * REJECTED AT
         */
        if (
            $action === 'reject' &&
            in_array('rejected_at', $ticketFields)
        ) {
            $updateData['rejected_at'] = $now;
        }

        /**
         * Jika tidak ada data yang bisa diupdate.
         */
        if (empty($updateData)) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tidak ada data yang dapat diperbarui.'
                );
        }

        /**
         * ========================================================
         * UPDATE TIKET
         * ========================================================
         */
        $updated = $this->ticketModel->update(
            $id,
            $updateData
        );

        if (!$updated) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Gagal menyimpan hasil verifikasi tiket.'
                );
        }

        /**
         * ========================================================
         * SIMPAN LOG
         * ========================================================
         */
        if ($this->db->tableExists('ticket_logs')) {

            $logFields = $this->db
                ->getFieldNames('ticket_logs');

            $logData = [];

            if (in_array('ticket_id', $logFields)) {
                $logData['ticket_id'] = $id;
            }

            if (in_array('activity', $logFields)) {

                $activityMap = [
                    'verify'   => 'verified',
                    'revision' => 'revision',
                    'reject'   => 'rejected'
                ];

                $logData['activity'] =
                    $activityMap[$action];
            }

            if (in_array('user_name', $logFields)) {
                $logData['user_name'] =
                    session()->get('name')
                    ?? 'Petugas ULT';
            }

            if (in_array('created_at', $logFields)) {
                $logData['created_at'] = $now;
            }

            if (!empty($logData)) {
                $this->db
                    ->table('ticket_logs')
                    ->insert($logData);
            }
        }

        /**
         * ========================================================
         * REDIRECT SESUAI HASIL VERIFIKASI
         * ========================================================
         */

        if ($action === 'verify') {
            return redirect()
                ->to(base_url('disposition'))
                ->with(
                    'success',
                    'Tiket berhasil diverifikasi dan masuk ke antrean disposisi.'
                );
        }

        if ($action === 'revision') {
            return redirect()
                ->to(base_url('verification'))
                ->with(
                    'success',
                    'Tiket berhasil dikembalikan untuk diperbaiki.'
                );
        }

        if ($action === 'reject') {
            return redirect()
                ->to(base_url('verification'))
                ->with(
                    'success',
                    'Tiket berhasil ditolak.'
                );
        }

        return redirect()
            ->to(base_url('verification'));
    }

    /**
     * ============================================================
     * KEMBALIKAN TIKET UNTUK REVISI
     * ============================================================
     */
    public function revision($id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('verification'))
                ->with(
                    'error',
                    'Tiket tidak ditemukan.'
                );
        }

        if (
            strtolower(
                trim($ticket['status'] ?? '')
            ) !== 'submitted'
        ) {
            return redirect()
                ->to(base_url('verification'))
                ->with(
                    'error',
                    'Tiket ini sudah diproses.'
                );
        }

        $comment = trim(
            (string) $this->request->getPost('comment')
        );

        $now = date('Y-m-d H:i:s');

        $ticketFields = $this->db
            ->getFieldNames('tickets');

        $updateData = [];

        if (in_array('status', $ticketFields)) {
            $updateData['status'] = 'revision';
        }

        if (
            in_array('admin_note', $ticketFields) &&
            $comment !== ''
        ) {
            $updateData['admin_note'] = $comment;
        }

        if (empty($updateData)) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tidak ada field yang dapat diperbarui.'
                );
        }

        $updated = $this->ticketModel->update(
            $id,
            $updateData
        );

        if (!$updated) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Gagal mengubah status tiket.'
                );
        }

        if ($this->db->tableExists('ticket_logs')) {

            $logFields = $this->db
                ->getFieldNames('ticket_logs');

            $logData = [];

            if (in_array('ticket_id', $logFields)) {
                $logData['ticket_id'] = $id;
            }

            if (in_array('activity', $logFields)) {
                $logData['activity'] = 'revision';
            }

            if (in_array('user_name', $logFields)) {
                $logData['user_name'] =
                    session()->get('name')
                    ?? 'Petugas ULT';
            }

            if (in_array('created_at', $logFields)) {
                $logData['created_at'] = $now;
            }

            if (!empty($logData)) {
                $this->db
                    ->table('ticket_logs')
                    ->insert($logData);
            }
        }

        return redirect()
            ->to(base_url('verification'))
            ->with(
                'success',
                'Tiket berhasil dikembalikan untuk diperbaiki.'
            );
    }

    /**
     * ============================================================
     * PROSES TIKET
     * VERIFIED
     *     ↓
     * PROCESSING
     * ============================================================
     */
    public function processing($id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('verification'))
                ->with(
                    'error',
                    'Tiket tidak ditemukan.'
                );
        }

        if (
            strtolower(
                trim($ticket['status'] ?? '')
            ) !== 'verified'
        ) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket belum diverifikasi atau sudah diproses.'
                );
        }

        $now = date('Y-m-d H:i:s');

        $ticketFields = $this->db
            ->getFieldNames('tickets');

        $updateData = [];

        if (in_array('status', $ticketFields)) {
            $updateData['status'] = 'processing';
        }

        if (in_array('processed_at', $ticketFields)) {
            $updateData['processed_at'] = $now;
        }

        $updated = $this->ticketModel->update(
            $id,
            $updateData
        );

        if (!$updated) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Gagal mengubah status tiket.'
                );
        }

        if ($this->db->tableExists('ticket_logs')) {

            $logFields = $this->db
                ->getFieldNames('ticket_logs');

            $logData = [];

            if (in_array('ticket_id', $logFields)) {
                $logData['ticket_id'] = $id;
            }

            if (in_array('activity', $logFields)) {
                $logData['activity'] = 'processing';
            }

            if (in_array('user_name', $logFields)) {
                $logData['user_name'] =
                    session()->get('name')
                    ?? 'Petugas ULT';
            }

            if (in_array('created_at', $logFields)) {
                $logData['created_at'] = $now;
            }

            if (!empty($logData)) {
                $this->db
                    ->table('ticket_logs')
                    ->insert($logData);
            }
        }

        return redirect()
            ->to(base_url('tracking'))
            ->with(
                'success',
                'Tiket berhasil diproses.'
            );
    }

    /**
     * ============================================================
     * TOLAK TIKET
     * ============================================================
     */
    public function reject($id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('verification'))
                ->with(
                    'error',
                    'Tiket tidak ditemukan.'
                );
        }

        if (
            strtolower(
                trim($ticket['status'] ?? '')
            ) !== 'submitted'
        ) {
            return redirect()
                ->to(base_url('verification'))
                ->with(
                    'error',
                    'Tiket ini sudah diproses.'
                );
        }

        $now = date('Y-m-d H:i:s');

        $ticketFields = $this->db
            ->getFieldNames('tickets');

        $updateData = [];

        if (in_array('status', $ticketFields)) {
            $updateData['status'] = 'rejected';
        }

        if (in_array('rejected_at', $ticketFields)) {
            $updateData['rejected_at'] = $now;
        }

        $updated = $this->ticketModel->update(
            $id,
            $updateData
        );

        if (!$updated) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Gagal menolak tiket.'
                );
        }

        if ($this->db->tableExists('ticket_logs')) {

            $logFields = $this->db
                ->getFieldNames('ticket_logs');

            $logData = [];

            if (in_array('ticket_id', $logFields)) {
                $logData['ticket_id'] = $id;
            }

            if (in_array('activity', $logFields)) {
                $logData['activity'] = 'rejected';
            }

            if (in_array('user_name', $logFields)) {
                $logData['user_name'] =
                    session()->get('name')
                    ?? 'Petugas ULT';
            }

            if (in_array('created_at', $logFields)) {
                $logData['created_at'] = $now;
            }

            if (!empty($logData)) {
                $this->db
                    ->table('ticket_logs')
                    ->insert($logData);
            }
        }

        return redirect()
            ->to(base_url('verification'))
            ->with(
                'success',
                'Tiket berhasil ditolak.'
            );
    }
}