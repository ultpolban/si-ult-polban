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
    $status = $this->request->getPost('status');

   $this->ticketModel->update($id, [

    'status'            => 'Assigned',

    'assigned_unit'     => $this->request->getPost('assigned_unit'),

    'verified_by'       => session('name'),

    'verification_note' => $this->request->getPost('verification_note'),

    'verified_at'       => date('Y-m-d H:i:s')

]);

    return redirect()->to('/verification')
            ->with('success','Tiket berhasil diverifikasi.');
}
}