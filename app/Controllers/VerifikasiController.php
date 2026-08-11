<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PengajuanLayananModel;

class VerifikasiController extends BaseController
{
    public function index()
    {
        $pengajuanModel = new PengajuanLayananModel();
        
        $data = [
            'title'     => 'Verifikasi Pengajuan',
            // In a real app we'd fetch with user (pemohon) details
            'pengajuan' => $pengajuanModel->getPengajuanWithDetails()
        ];
        
        return view('verifikasi/index', $data);
    }
}
