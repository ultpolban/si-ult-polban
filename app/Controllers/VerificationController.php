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

        // Filter Status
        if (!empty($status)) {
            $builder = $builder->where('status', $status);
        }

        // Pencarian
        if (!empty($keyword)) {
            $builder = $builder
                ->groupStart()
                ->like('ticket_number', $keyword)
                ->orLike('applicant_name', $keyword)
                ->orLike('nim', $keyword)
                ->groupEnd();
        }

        $data['tickets'] = $builder
            ->orderBy('submitted_at', 'DESC')
            ->findAll();

        $data['submitted'] = $ticketModel->where('status', 'Submitted')->countAllResults();
        $data['verified']  = $ticketModel->where('status', 'Verified')->countAllResults();
        $data['revision']  = $ticketModel->where('status', 'Need Revision')->countAllResults();
        $data['rejected']  = $ticketModel->where('status', 'Rejected')->countAllResults();

        return view('verification/index', $data);
    }

    public function detail($id)
    {
        $ticketModel  = new TicketModel();
        $commentModel = new TicketCommentModel();
        $logModel     = new TicketLogModel();

        $data['ticket'] = $ticketModel->find($id);

        $data['comments'] = $commentModel
            ->where('ticket_id', $id)
            ->orderBy('created_at', 'ASC')
            ->findAll();

        $data['logs'] = $logModel
            ->where('ticket_id', $id)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('verification/detail', $data);
    }

    public function process($id)
    {
        $ticketModel = new TicketModel();
        $logModel    = new TicketLogModel();

        $status       = $this->request->getPost('status');
        $assignedUnit = $this->request->getPost('assigned_unit');
        $note         = $this->request->getPost('verification_note');

        // Jika sudah diverifikasi dan dipilih unit,
        // otomatis status menjadi Assigned
        if ($status == 'Verified' && !empty($assignedUnit)) {
            $status = 'Assigned';
        }

        $data = [
            'status'            => $status,
            'assigned_unit'     => $assignedUnit,
            'verification_note' => $note,
            'verified_by'       => 'Petugas ULT',
            'verified_at'       => date('Y-m-d H:i:s')
        ];

        if ($ticketModel->update($id, $data)) {

            // Simpan Audit Log
            $logModel->insert([
                'ticket_id'  => $id,
                'activity'   => 'Status tiket diubah menjadi ' . $status,
                'user_name'  => 'Petugas ULT',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            return redirect()->to('/verification')
                ->with('success', 'Verifikasi berhasil disimpan.');
        }

        dd($ticketModel->errors());
    }

    public function comment($id)
    {
        $commentModel = new TicketCommentModel();

        $commentModel->insert([
            'ticket_id'  => $id,
            'sender'     => 'Petugas ULT',
            'comment'    => $this->request->getPost('comment'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/verification/detail/' . $id)
            ->with('success', 'Komentar berhasil ditambahkan.');
    }
}