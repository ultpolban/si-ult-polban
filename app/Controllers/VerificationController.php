<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\TicketLogModel;
use App\Models\TicketCommentModel;

class VerificationController extends BaseController
{
    public function index()
    {
        $ticketModel = new TicketModel();

        $status  = $this->request->getGet('status');
        $keyword = $this->request->getGet('keyword');

        $builder = $ticketModel;

        if (!empty($status)) {
            $builder = $builder->where('status', $status);
        }

        if (!empty($keyword)) {
            $builder = $builder
                ->groupStart()
                ->like('ticket_number', $keyword)
                ->orLike('applicant_name', $keyword)
                ->orLike('nim', $keyword)
                ->groupEnd();
        }

        $data = [
            'tickets' => $builder
                ->orderBy('submitted_at', 'DESC')
                ->findAll(),

            'submitted' => $ticketModel->where('status', 'Submitted')->countAllResults(),
            'assigned'  => $ticketModel->where('status', 'Assigned')->countAllResults(),
            'verified'  => $ticketModel->where('status', 'Verified')->countAllResults(),
            'progress'  => $ticketModel->where('status', 'In Progress')->countAllResults(),
            'completed' => $ticketModel->where('status', 'Completed')->countAllResults(),
            'revision'  => $ticketModel->where('status', 'Need Revision')->countAllResults(),
            'rejected'  => $ticketModel->where('status', 'Rejected')->countAllResults(),
        ];

        return view('verification/index', $data);
    }

    public function detail($id)
    {
        $ticketModel  = new TicketModel();
        $commentModel = new TicketCommentModel();
        $logModel     = new TicketLogModel();

        $data = [
            'ticket' => $ticketModel->find($id),

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

    public function process($id)
    {
        $ticketModel = new TicketModel();
        $logModel    = new TicketLogModel();

        $ticket = $ticketModel->find($id);

        if (!$ticket) {
            return redirect()->back()->with('error', 'Tiket tidak ditemukan.');
        }

        $status = $this->request->getPost('status');
        $assignedUnit = $this->request->getPost('assigned_unit');
        $note = $this->request->getPost('verification_note');

        if ($status == "Verified" && !empty($assignedUnit)) {
            $status = "Assigned";
        }

        $ticketModel->update($id, [

            'status' => $status,
            'assigned_unit' => $assignedUnit,
            'verification_note' => $note,
            'verified_by' => session()->get('name') ?? 'Petugas ULT',
            'verified_at' => date('Y-m-d H:i:s')

        ]);

        $logModel->insert([

            'ticket_id' => $id,
            'activity' => "Status diubah menjadi {$status}",
            'user_name' => session()->get('name') ?? 'Petugas ULT',
            'created_at' => date('Y-m-d H:i:s')

        ]);

        return redirect()
            ->to('/verification/detail/'.$id)
            ->with('success','Verifikasi berhasil disimpan.');
    }

    public function comment($id)
    {
        $commentModel = new TicketCommentModel();

        $commentModel->insert([

            'ticket_id' => $id,
            'sender' => session()->get('name') ?? 'Petugas ULT',
            'comment' => $this->request->getPost('comment'),
            'created_at' => date('Y-m-d H:i:s')

        ]);

        return redirect()
            ->to('/verification/detail/'.$id)
            ->with('success','Komentar berhasil ditambahkan.');
    }
}