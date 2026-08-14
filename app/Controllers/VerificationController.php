<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\TicketLogModel;
use App\Models\TicketCommentModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class VerificationController extends BaseController
{
    public function index()
{
    $ticketModel = new TicketModel();

    // Ambil filter
    $keyword = trim($this->request->getGet('keyword') ?? '');
    $status = trim($this->request->getGet('status') ?? '');
    $submission_type = trim($this->request->getGet('submission_type') ?? '');

    // =========================
    // FILTER TIKET
    // =========================
    $builder = $ticketModel;

    // Filter status
    if ($status !== '') {
        $builder->where('status', $status);
    }

    // Filter pencarian
    if ($keyword !== '') {
        $builder->groupStart()
            ->like('ticket_number', $keyword)
            ->orLike('applicant_name', $keyword)
            ->orLike('nim', $keyword)
            ->orLike('service_name', $keyword)
            ->groupEnd();
    }

    // Filter sumber
    if ($submission_type !== '') {
        $builder->where('submission_type', $submission_type);
    }

    // =========================
    // PAGINATION
    // 10 TIKET PER HALAMAN
    // =========================
    $tickets = $builder
        ->orderBy('submitted_at', 'DESC')
        ->paginate(10, 'default');

    // =========================
    // DATA UNTUK VIEW
    // =========================
    $data = [
        'keyword' => $keyword,
        'status' => $status,
        'submission_type' => $submission_type,
        'tickets' => $tickets,

        // Pager
        'pager' => $ticketModel->pager,

        // Statistik
        'submitted' => (new TicketModel())
            ->where('status', 'Submitted')
            ->countAllResults(),

        'assigned' => (new TicketModel())
            ->where('status', 'Assigned')
            ->countAllResults(),

        'verified' => (new TicketModel())
            ->where('status', 'Verified')
            ->countAllResults(),

        'progress' => (new TicketModel())
            ->where('status', 'In Progress')
            ->countAllResults(),

        'completed' => (new TicketModel())
            ->where('status', 'Completed')
            ->countAllResults(),

        'revision' => (new TicketModel())
            ->where('status', 'Need Revision')
            ->countAllResults(),

        'rejected' => (new TicketModel())
            ->where('status', 'Rejected')
            ->countAllResults(),
    ];

    return view('verification/index', $data);
}

    public function detail($id = null)
    {
        if (!$id) {
            return redirect()->to(base_url('verification'));
        }

        $ticketModel = new TicketModel();
        $commentModel = new TicketCommentModel();
        $logModel = new TicketLogModel();

        $ticket = $ticketModel->find($id);

        if (!$ticket) {
            throw PageNotFoundException::forPageNotFound(
                "Tiket tidak ditemukan."
            );
        }

        $data = [
            'ticket' => $ticket,

            'comments' => $commentModel
                ->where('ticket_id', $id)
                ->orderBy('created_at', 'ASC')
                ->findAll(),

            'logs' => $logModel
                ->where('ticket_id', $id)
                ->orderBy('created_at', 'DESC')
                ->findAll()
        ];

        return view('verification/detail', $data);
    }


    public function verify($id)
    {
        $ticket = (new TicketModel())->find($id);

        if (!$ticket) {
            throw PageNotFoundException::forPageNotFound();
        }

        return view('verification/verify', [
            'ticket' => $ticket,

            'logs' => (new TicketLogModel())
                ->where('ticket_id', $id)
                ->orderBy('created_at', 'DESC')
                ->findAll()
        ]);
    }


    public function revision($id)
    {
        $ticketModel = new TicketModel();

        $ticketModel->update($id, [
            'status' => 'Need Revision'
        ]);

        return redirect()
            ->to(base_url('verification'))
            ->with(
                'success',
                'Tiket berhasil dikembalikan untuk revisi.'
            );
    }


    public function reject($id)
    {
        $ticketModel = new TicketModel();

        $ticketModel->update($id, [
            'status' => 'Rejected'
        ]);

        return redirect()
            ->to(base_url('verification'))
            ->with(
                'success',
                'Tiket berhasil ditolak.'
            );
    }


    public function process($id = null)
    {
        if (!$id) {
            return redirect()->to(base_url('verification'));
        }

        $ticketModel = new TicketModel();
        $logModel = new TicketLogModel();
        $commentModel = new TicketCommentModel();

        $status = $this->request->getPost('status');
        $priority = $this->request->getPost('priority');
        $assignedUnit = $this->request->getPost('assigned_unit');
        $note = $this->request->getPost('verification_note');
        $comment = $this->request->getPost('comment');

        $petugas = session('name') ?? 'Petugas ULT';

        $ticketModel->update($id, [
            'status' => $status,
            'priority' => $priority,
            'assigned_unit' => $assignedUnit,
            'verification_note' => $note,
            'verified_by' => $petugas,
            'verified_at' => date('Y-m-d H:i:s')
        ]);

        $logModel->insert([
            'ticket_id' => $id,
            'activity' => 'Status tiket diubah menjadi ' . $status,
            'user_name' => $petugas,
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if (!empty($comment)) {
            $commentModel->insert([
                'ticket_id' => $id,
                'comment' => $comment,
                'sender' => $petugas,
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()
            ->to(base_url('verification/detail/' . $id))
            ->with(
                'success',
                'Verifikasi tiket berhasil disimpan.'
            );
    }


    public function comment($id = null)
    {
        if (!$id) {
            return redirect()->to(base_url('verification'));
        }

        $commentModel = new TicketCommentModel();

        $comment = $this->request->getPost('comment');

        if (!empty($comment)) {
            $commentModel->insert([
                'ticket_id' => $id,
                'comment' => $comment,
                'sender' => session('name') ?? 'Petugas',
                'created_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()
            ->to(base_url('verification/detail/' . $id))
            ->with(
                'success',
                'Komentar berhasil ditambahkan.'
            );
    }
}