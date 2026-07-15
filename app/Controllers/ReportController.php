<?php

namespace App\Controllers;

use App\Models\TicketModel;

class ReportController extends BaseController
{
    public function index()
    {
        $ticketModel = new TicketModel();

        $builder = $ticketModel;

        // Filter Status
        if ($this->request->getGet('status')) {
            $builder = $builder->where(
                'status',
                $this->request->getGet('status')
            );
        }

        // Filter Tanggal Awal
        if ($this->request->getGet('tanggal_awal')) {
            $builder = $builder->where(
                'submitted_at >=',
                $this->request->getGet('tanggal_awal') . ' 00:00:00'
            );
        }

        // Filter Tanggal Akhir
        if ($this->request->getGet('tanggal_akhir')) {
            $builder = $builder->where(
                'submitted_at <=',
                $this->request->getGet('tanggal_akhir') . ' 23:59:59'
            );
        }

        $data['tickets'] = $builder
            ->orderBy('submitted_at', 'DESC')
            ->findAll();

        return view('report/index', $data);
    }

}