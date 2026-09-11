<?php

namespace App\Controllers;

use App\Models\TicketModel;

class VerificationController extends BaseController
{
    protected TicketModel $ticketModel;
    protected $db;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * ============================================================
     * DAFTAR TIKET YANG MENUNGGU VERIFIKASI
     * ============================================================
     */
    public function index()
    {
        $tickets = $this->db
            ->table('tickets t')
            ->select('
                t.id,
                t.ticket_number,
                t.status,
                t.priority,
                t.submitted_at,
                t.created_at,
                ms.name AS service_name,
                ms.service_unit_id,
                msu.name AS unit_name,
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
                'master_service_units msu',
                'msu.id = ms.service_unit_id',
                'left'
            )
            ->join(
                'user_profiles up',
                'up.id = t.user_profile_id',
                'left'
            )
            ->where('t.status', 'submitted')
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
        $ticket = $this->getTicketData($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('verification'))
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        $riwayat = $this->getHistory($id);

        return view('verification/detail', [
            'ticket'  => $ticket,
            'profile' => $ticket,
            'logs'    => $riwayat,
            'riwayat' => $riwayat
        ]);
    }

    /**
     * ============================================================
     * FORM VERIFIKASI
     * ============================================================
     */
    public function verify($id)
    {
        $ticket = $this->getTicketData($id);

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
         * yang dapat diverifikasi.
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

        $riwayat = $this->getHistory($id);

        return view('petugas/verifikasi', [
            'tiket'   => $ticket,
            'riwayat' => $riwayat
        ]);
    }

    /**
     * ============================================================
     * PROSES HASIL VERIFIKASI
     *
     * submitted
     *      ↓
     * verified
     *
     * atau
     *
     * submitted
     *      ↓
     * revision
     *
     * atau
     *
     * submitted
     *      ↓
     * rejected
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
         * Pastikan masih submitted.
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

        /**
         * ========================================================
         * HASIL VERIFIKASI
         * ========================================================
         */
        $action = strtolower(
            trim(
                (string) $this->request->getPost('hasil_verifikasi')
            )
        );

        if ($action === '') {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Silakan pilih hasil verifikasi terlebih dahulu.'
                );
        }

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

        $now = date('Y-m-d H:i:s');

        /**
         * ========================================================
         * DATA FORM
         * ========================================================
         */

        $priority = trim(
            (string) (
                $this->request->getPost('prioritas')
                ?? $this->request->getPost('priority')
                ?? ''
            )
        );

        /**
         * Unit tujuan.
         *
         * Terima beberapa kemungkinan nama field
         * supaya aman dengan view frontend3.
         */
        $assignedTo = trim(
            (string) (
                $this->request->getPost('assigned_to')
                ?? $this->request->getPost('unit_tujuan')
                ?? ''
            )
        );

        $verificationNote = trim(
            (string) (
                $this->request->getPost('catatan_verifikasi')
                ?? ''
            )
        );

        $revisionReason = trim(
            (string) (
                $this->request->getPost('alasan_revisi')
                ?? ''
            )
        );

        $rejectionReason = trim(
            (string) (
                $this->request->getPost('alasan_penolakan')
                ?? ''
            )
        );

        /**
         * ========================================================
         * SIAPKAN DATA UPDATE
         * ========================================================
         */

        $ticketFields = $this->db->getFieldNames('tickets');

        $updateData = [];

        /**
         * STATUS
         */
        if (in_array('status', $ticketFields)) {
            $updateData['status'] = $newStatus;
        }

        /**
         * PRIORITAS
         */
        if (
            $priority !== '' &&
            in_array('priority', $ticketFields)
        ) {
            $updateData['priority'] = strtolower($priority);
        }

        /**
         * UNIT TUJUAN / PETUGAS YANG DITUGASKAN
         */
        if (
            $assignedTo !== '' &&
            in_array('assigned_to', $ticketFields)
        ) {
            $updateData['assigned_to'] = $assignedTo;
        }

        /**
         * CATATAN VERIFIKASI
         *
         * Database backend3 tidak memiliki
         * kolom verification_note.
         *
         * Jadi catatan verifikasi disimpan
         * pada admin_note.
         */
        if (
            $action === 'verify' &&
            $verificationNote !== '' &&
            in_array('admin_note', $ticketFields)
        ) {
            $updateData['admin_note'] = $verificationNote;
        }

        /**
         * ALASAN REVISI
         *
         * Tidak membuat kolom baru.
         * Disimpan ke admin_note.
         */
        if (
            $action === 'revision' &&
            $revisionReason !== '' &&
            in_array('admin_note', $ticketFields)
        ) {
            $updateData['admin_note'] = $revisionReason;
        }

        /**
         * ALASAN PENOLAKAN
         */
        if (
            $action === 'reject' &&
            $rejectionReason !== '' &&
            in_array('rejection_reason', $ticketFields)
        ) {
            $updateData['rejection_reason'] = $rejectionReason;
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
         * ========================================================
         * UPDATE DATABASE
         * ========================================================
         */
        if (empty($updateData)) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tidak ada data yang dapat diperbarui.'
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
                    'Gagal menyimpan hasil verifikasi tiket.'
                );
        }

        /**
         * ========================================================
         * SIMPAN RIWAYAT
         *
         * Menggunakan service_request_logs jika tersedia.
         * Tidak memakai ticket_logs karena tabel tersebut
         * tidak termasuk database backend3.
         * ========================================================
         */
        $this->saveHistory(
            $id,
            $newStatus,
            $now
        );

        /**
         * ========================================================
         * REDIRECT
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
            (string) (
                $this->request->getPost('alasan_revisi')
                ?? $this->request->getPost('comment')
                ?? ''
            )
        );

        $now = date('Y-m-d H:i:s');

        $ticketFields = $this->db
            ->getFieldNames('tickets');

        $updateData = [];

        if (in_array('status', $ticketFields)) {
            $updateData['status'] = 'revision';
        }

        if (
            $comment !== '' &&
            in_array('admin_note', $ticketFields)
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

        $this->saveHistory(
            $id,
            'revision',
            $now
        );

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
     * VERIFIED → PROCESSING
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

        $this->saveHistory(
            $id,
            'processing',
            $now
        );

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

        $reason = trim(
            (string) (
                $this->request->getPost('alasan_penolakan')
                ?? $this->request->getPost('reason')
                ?? ''
            )
        );

        $ticketFields = $this->db
            ->getFieldNames('tickets');

        $updateData = [];

        if (in_array('status', $ticketFields)) {
            $updateData['status'] = 'rejected';
        }

        if (in_array('rejected_at', $ticketFields)) {
            $updateData['rejected_at'] = $now;
        }

        if (
            $reason !== '' &&
            in_array('rejection_reason', $ticketFields)
        ) {
            $updateData['rejection_reason'] = $reason;
        }

        if (empty($updateData)) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tidak ada data yang dapat diperbarui.'
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
                    'Gagal menolak tiket.'
                );
        }

        $this->saveHistory(
            $id,
            'rejected',
            $now
        );

        return redirect()
            ->to(base_url('verification'))
            ->with(
                'success',
                'Tiket berhasil ditolak.'
            );
    }

    /**
     * ============================================================
     * AMBIL DATA TIKET UNTUK VIEW FRONTEND3
     * ============================================================
     */
    private function getTicketData($id)
    {
        $ticket = $this->db
            ->table('tickets t')
            ->select('
                t.id,
                t.ticket_number,
                t.user_profile_id,
                t.service_id,
                t.title,
                t.description,
                t.status,
                t.priority,
                t.assigned_to,
                t.submitted_at,
                t.verified_at,
                t.processed_at,
                t.completed_at,
                t.rejected_at,
                t.cancelled_at,
                t.admin_note,
                t.rejection_reason,
                t.created_at,
                t.updated_at,

                ms.name AS service_name,
                ms.service_unit_id,

                msu.name AS unit_name,

                up.name AS applicant_name,
                up.nim,
                up.nik,
                up.email,
                up.phone,
                up.address
            ')
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_units msu',
                'msu.id = ms.service_unit_id',
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
            return null;
        }

        /**
         * ========================================================
         * ALIAS SESUAI VIEW FRONTEND3
         * ========================================================
         */

        $status = strtolower(
            trim(
                (string) ($ticket['status'] ?? '')
            )
        );

        $priority = strtoupper(
            trim(
                (string) ($ticket['priority'] ?? 'normal')
            )
        );

        $tanggal = $ticket['submitted_at']
            ?? $ticket['created_at']
            ?? null;

        $ticket['nomor_tiket'] =
            $ticket['ticket_number']
            ?? '-';

        $ticket['nama_pemohon'] =
            $ticket['applicant_name']
            ?? '-';

        $ticket['layanan'] =
            $ticket['service_name']
            ?? '-';

        $ticket['unit_tujuan'] =
            $ticket['unit_name']
            ?? '-';

        $ticket['no_hp'] =
            $ticket['phone']
            ?? '-';

        $ticket['judul_permohonan'] =
            $ticket['title']
            ?? '-';

        $ticket['deskripsi'] =
            $ticket['description']
            ?? '-';

        $ticket['tanggal'] =
            $tanggal;

        $ticket['created_at'] =
            $ticket['created_at']
            ?? $tanggal;

        $ticket['status'] =
            $status ?: '-';

        $ticket['prioritas'] =
            $priority;

        return $ticket;
    }

    /**
     * ============================================================
     * AMBIL RIWAYAT TIKET
     *
     * Database backend3 memakai service_request_logs.
     * Kalau tabel tersebut belum punya data, return [].
     * ============================================================
     */
    private function getHistory($ticketId)
    {
        if (!$this->db->tableExists('service_request_logs')) {
            return [];
        }

        $fields = $this->db
            ->getFieldNames('service_request_logs');

        if (!in_array('ticket_id', $fields)) {
            return [];
        }

        $builder = $this->db
            ->table('service_request_logs')
            ->where(
                'ticket_id',
                $ticketId
            );

        if (in_array('created_at', $fields)) {
            $builder->orderBy(
                'created_at',
                'ASC'
            );
        }

        $logs = $builder
            ->get()
            ->getResultArray();

        $riwayat = [];

        foreach ($logs as $log) {
            $status =
                $log['status']
                ?? $log['activity']
                ?? '-';

            $catatan =
                $log['description']
                ?? $log['note']
                ?? $log['activity']
                ?? '-';

            $createdAt =
                $log['created_at']
                ?? null;

            $riwayat[] = [
                'status'     => $status,
                'catatan'    => $catatan,
                'created_at' => $createdAt
            ];
        }

        return $riwayat;
    }

    /**
     * ============================================================
     * SIMPAN RIWAYAT
     *
     * Hanya menggunakan kolom yang benar-benar ada.
     * ============================================================
     */
    private function saveHistory(
        int $ticketId,
        string $status,
        string $createdAt
    ): void {
        if (!$this->db->tableExists('service_request_logs')) {
            return;
        }

        $fields = $this->db
            ->getFieldNames('service_request_logs');

        $data = [];

        if (in_array('ticket_id', $fields)) {
            $data['ticket_id'] = $ticketId;
        }

        if (in_array('status', $fields)) {
            $data['status'] = $status;
        }

        if (in_array('activity', $fields)) {
            $data['activity'] = $status;
        }

        if (in_array('description', $fields)) {
            $data['description'] =
                'Status tiket berubah menjadi ' . $status;
        }

        if (in_array('note', $fields)) {
            $data['note'] =
                'Status tiket berubah menjadi ' . $status;
        }

        if (in_array('created_at', $fields)) {
            $data['created_at'] = $createdAt;
        }

        if (!empty($data)) {
            $this->db
                ->table('service_request_logs')
                ->insert($data);
        }
    }
}