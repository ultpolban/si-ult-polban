<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\TicketLogModel;

class UnitController extends BaseController
{
    public function index()
    {
        $ticketModel = new TicketModel();

        $data['tickets'] = $ticketModel
            ->where('status', 'Assigned')
            ->findAll();

        return view('unit/index', $data);
    }

    public function process($id)
    {
        $ticketModel = new TicketModel();
        $logModel = new TicketLogModel();

        $ticketModel->update($id, [
            'status' => 'In Progress'
        ]);

        $logModel->insert([
            'ticket_id'  => $id,
            'activity'   => 'Tiket sedang diproses oleh unit.',
            'user_name'  => 'Petugas Unit',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/unit')
            ->with('success', 'Tiket sedang diproses.');
    }

    public function complete($id)
    {
        $ticketModel = new TicketModel();
        $logModel = new TicketLogModel();

        $ticketModel->update($id, [
            'status' => 'Completed',
            'completed_at' => date('Y-m-d H:i:s')
        ]);

        $logModel->insert([
            'ticket_id'  => $id,
            'activity'   => 'Tiket telah selesai diproses.',
            'user_name'  => 'Petugas Unit',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/unit')
            ->with('success', 'Tiket selesai diproses.');
    }
}