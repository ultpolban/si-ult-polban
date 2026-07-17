<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TicketModel;

class TicketController extends BaseController
{
    /**
     * Form Pengajuan Layanan
     */
    public function create()
    {
        $data = [
            'title' => 'Ajukan Layanan',

            // Sementara masih dummy
            'services' => [
                [
                    'id' => 1,
                    'nama' => 'Surat Keterangan Aktif Kuliah'
                ],
                [
                    'id' => 2,
                    'nama' => 'Legalisir Ijazah'
                ],
                [
                    'id' => 3,
                    'nama' => 'Verifikasi Alumni'
                ],
                [
                    'id' => 4,
                    'nama' => 'Konfirmasi Pembayaran UKT'
                ]
            ]
        ];

        return view('ticket/create', $data);
    }

    /**
     * Simpan Pengajuan
     */
    public function store()
    {
        $ticket = new TicketModel();

        $ktm = $this->request->getFile('ktm');
        $krs = $this->request->getFile('krs');

        $ktmName = null;
        $krsName = null;

        if ($ktm && $ktm->isValid() && !$ktm->hasMoved()) {
            $ktmName = $ktm->getRandomName();
            $ktm->move(FCPATH . 'uploads/ktm', $ktmName);
        }

        if ($krs && $krs->isValid() && !$krs->hasMoved()) {
            $krsName = $krs->getRandomName();
            $krs->move(FCPATH . 'uploads/krs', $krsName);
        }

        $ticket->save([
            'ticket_number'  => 'ULT-' . date('Ymd') . '-' . rand(1000,9999),
            'service_name'   => $this->request->getPost('service'),
            'applicant_name' => $this->request->getPost('nama'),
            'nim'            => $this->request->getPost('nim'),
            'study_program'  => $this->request->getPost('prodi'),
            'catatan'        => $this->request->getPost('catatan'),
            'ktm_file'       => $ktmName,
            'krs_file'       => $krsName,
            'status'         => 'Submitted'
        ]);

        return redirect()->to('/ticket/history');
    }

    /**
     * Halaman Berhasil
     */
    public function success()
    {
        return view('ticket/success', [
            'title' => 'Pengajuan Berhasil'
        ]);
    }

    /**
     * Riwayat Tiket
     */
    public function history()
{
    $data = [

        'title' => 'Tracking Tiket',

        'tickets' => [

            [
                'id' => 1,
                'nomor' => 'ULT-20260716-0001',
                'layanan' => 'Surat Aktif Kuliah',
                'status' => 'Submitted',
                'tanggal' => '16 Juli 2026'
            ],

            [
                'id' => 2,
                'nomor' => 'ULT-20260716-0002',
                'layanan' => 'Legalisir Ijazah',
                'status' => 'In Progress',
                'tanggal' => '16 Juli 2026'
            ],

            [
                'id' => 3,
                'nomor' => 'ULT-20260716-0003',
                'layanan' => 'Verifikasi Alumni',
                'status' => 'Completed',
                'tanggal' => '16 Juli 2026'
            ]

        ]

    ];

    return view('ticket/history',$data);
}

    /**
     * Detail Tiket
     */
    public function detail($id)
{
    $data = [
        'title' => 'Detail Tiket',
        'ticket' => [
            'id' => $id,
            'ticket_number'  => 'ULT-20260716-000' . $id,
            'service_name'   => 'Surat Keterangan Aktif Kuliah',
            'applicant_name' => 'Nama Mahasiswa',
            'nim'            => '231511001',
            'study_program'  => 'D4 Teknik Informatika',
            'status'         => 'Submitted',
            'catatan'        => 'Pengajuan untuk keperluan beasiswa.',
            'ktm_file'       => 'ktm.pdf',
            'krs_file'       => 'krs.pdf'
        ]
    ];

    return view('ticket/detail', $data);
}
}