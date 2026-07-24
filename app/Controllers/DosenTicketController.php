<?php

namespace App\Controllers;

class DosenTicketController extends BaseController
{
    /**
     * Halaman Ajukan Layanan Dosen
     */
    public function create()
    {
        // Data sementara untuk frontend
        // Nanti bisa diganti dengan data dari database/session

        $user = session()->get('user');

        return view('dosen/ticket/create', [
            'title' => 'Ajukan Layanan',
            'user'  => $user ?? []
        ]);
    }


    /**
     * Halaman Tracking Tiket Dosen
     */
    public function history()
    {
        // Data sementara
        // Nanti diambil dari database

        $tickets = [];

        return view('dosen/ticket/history', [
            'title'   => 'Tracking Tiket',
            'tickets' => $tickets,
            'keyword' => $this->request->getGet('keyword')
        ]);
    }


    /**
     * Detail Tiket Dosen
     */
    public function detail($id)
    {
        // Data sementara
        // Nanti tiket diambil berdasarkan ID dari database

        $ticket = [
            'id'              => $id,
            'nomor'           => 'ULT-20260724-0001',
            'unit'            => 'Bidang Akademik & Kemahasiswaan',
            'layanan'         => 'Layanan Akademik',
            'judul'           => 'Pengajuan Layanan',
            'tanggal'         => date('Y-m-d'),
            'status'          => 'Submitted',
            'keterangan'      => 'Contoh data tiket sementara.',
            'dokumen'         => null,
            'catatan_petugas' => null,
            'balasan_pemohon' => null
        ];

        return view('dosen/ticket/detail', [
            'title'  => 'Detail Tiket',
            'ticket' => $ticket
        ]);
    }
}