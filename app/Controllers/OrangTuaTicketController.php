<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TicketModel;

class OrangTuaTicketController extends BaseController
{
    public function create()
{
    return view('orangtua/ticket/create');
}

public function store()
{
    // Generate nomor tiket
    $nomor_tiket = 'ULT-ORT-' . date('YmdHis');

    // Simpan sementara ke session
    session()->setFlashdata('nomor_tiket', $nomor_tiket);
    session()->setFlashdata('jenis_layanan', $this->request->getPost('layanan'));
    session()->setFlashdata('status', 'Submitted');

    return redirect()->to(base_url('orangtua/ticket/success'));
}

public function tracking()
{
    $data['tickets'] = [

        [
            'nomor' => 'ULT-ORT-202608070001',
            'layanan' => 'Surat Aktif Kuliah',
            'unit' => 'Akademik',
            'tanggal' => '07 Agustus 2026',
            'status' => 'Diproses'
        ],

        [
            'nomor' => 'ULT-ORT-202608060002',
            'layanan' => 'Informasi UKT/SPP',
            'unit' => 'Keuangan',
            'tanggal' => '06 Agustus 2026',
            'status' => 'Selesai'
        ]

    ];

    return view('orangtua/tracking', $data);
}

public function detail($nomor)
{
    $data['ticket'] = [

        'nomor'          => $nomor,
        'tanggal'        => '07 Agustus 2026',
        'nama_ortu'      => 'Budi Santoso',
        'nik'            => '3273010101040001',
        'nama_mahasiswa' => 'Muhamad Rafi Putra Zakaria',
        'layanan'        => 'Surat Aktif Kuliah',
        'unit'           => 'Akademik',
        'status'         => 'Submitted',
        'keterangan'     => 'Mohon dibuatkan surat aktif kuliah.',
        'dokumen'        => 'surat_pengantar.pdf'

    ];

    return view('orangtua/ticket/detail', $data);
}

public function history()
{
    return view('orangtua/ticket/history');
}

public function success()
{
    return view('orangtua/ticket/success');
}
}