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
     * Halaman verifikasi tiket
     */
    public function index()
    {
        $tickets = $this->ticketModel->getByStatus('submitted');

        return view('verification/index', [
            'tickets' => $tickets
        ]);
    }

    /**
     * Detail tiket
     */
    public function detail($id)
    {
        $ticket = $this->ticketModel->getTicketDetail($id);

        if (!$ticket) {
            return redirect()
                ->to('/verification')
                ->with('error', 'Data tiket tidak ditemukan.');
        }

        /*
         * Data pemohon
         */
        $profile = null;

        if (!empty($ticket['user_profile_id'])) {

            $profile = $this->db
                ->table('user_profiles')
                ->where('id', $ticket['user_profile_id'])
                ->get()
                ->getRowArray();
        }

        /*
         * Data unit layanan
         */
        $unit = null;

        if (!empty($ticket['service_unit_id'])) {

            $unit = $this->db
                ->table('master_service_units')
                ->where('id', $ticket['service_unit_id'])
                ->get()
                ->getRowArray();
        }

        /*
         * Komentar
         */
        $comments = [];

        if ($this->db->tableExists('ticket_comments')) {

            $comments = $this->db
                ->table('ticket_comments')
                ->where('ticket_id', $id)
                ->orderBy('id', 'ASC')
                ->get()
                ->getResultArray();
        }

        /*
         * Log tiket
         */
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
     * Verifikasi tiket
     */
    public function verify($id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to('/verification')
                ->with('error', 'Tiket tidak ditemukan.');
        }

        $status = strtolower(trim($ticket['status'] ?? ''));

        if ($status !== 'submitted') {

            return redirect()
                ->to('/verification')
                ->with(
                    'error',
                    'Tiket tidak dapat diverifikasi karena statusnya bukan submitted.'
                );
        }

        $updated = $this->ticketModel->update($id, [
            'status'      => 'verified',
            'verified_at' => date('Y-m-d H:i:s')
        ]);

        if (!$updated) {

            return redirect()
                ->to('/verification')
                ->with('error', 'Gagal memperbarui status tiket.');
        }

        $this->addTicketLog(
            $id,
            'verified',
            'Tiket berhasil diverifikasi oleh Petugas ULT.'
        );

        return redirect()
            ->to('/verification')
            ->with('success', 'Tiket berhasil diverifikasi.');
    }

    /**
     * Need Revision
     */
    public function revision($id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to('/verification')
                ->with('error', 'Tiket tidak ditemukan.');
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

        $this->addTicketComment($id, $comment);

        $this->addTicketLog(
            $id,
            'need_revision',
            $comment
        );

        return redirect()
            ->to('/verification')
            ->with(
                'success',
                'Tiket berhasil dikembalikan untuk revisi.'
            );
    }

    /**
     * Reject
     */
    public function reject($id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to('/verification')
                ->with('error', 'Tiket tidak ditemukan.');
        }

        $comment = trim(
            (string) $this->request->getPost('comment')
        );

        if ($comment === '') {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Alasan penolakan wajib diisi.'
                );
        }

        $updated = $this->ticketModel->update($id, [
            'status' => 'rejected'
        ]);

        if (!$updated) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Gagal mengubah status tiket.'
                );
        }

        $this->addTicketComment($id, $comment);

        $this->addTicketLog(
            $id,
            'rejected',
            $comment
        );

        return redirect()
            ->to('/verification')
            ->with(
                'success',
                'Tiket berhasil ditolak.'
            );
    }

    /**
     * Simpan komentar ke ticket_comments
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
     * Simpan log tiket
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