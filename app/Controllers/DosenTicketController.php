<?php

namespace App\Controllers;

class DosenTicketController extends BaseController
{
    /**
     * ================================
     * FORM AJUKAN LAYANAN
     * ================================
     */
    public function create()
    {
        // Data dosen sementara dari session
        $user = session()->get('user') ?? [];

        $data = [
            'title' => 'Ajukan Layanan',
            'user'  => $user,
        ];

        return view('dosen/ticket/create', $data);
    }


    /**
     * ================================
     * PROSES FORM PENGAJUAN
     * ================================
     */
    public function store()
{
    // ==========================================
    // AMBIL ACTION
    // ==========================================

    $action = $this->request->getPost('action');


    // ==========================================
    // AMBIL DATA FORM
    // ==========================================

    $unitTujuan   = $this->request->getPost('unit_tujuan');
    $jenisLayanan = $this->request->getPost('jenis_layanan');
    $judul        = $this->request->getPost('judul');
    $keterangan   = $this->request->getPost('keterangan');


    // ==========================================
    // VALIDASI
    // ==========================================

    if (empty($unitTujuan)) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Unit tujuan wajib dipilih.'
            );

    }


    if (empty($jenisLayanan)) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Jenis layanan wajib dipilih.'
            );

    }


    if (empty($judul)) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Judul / keperluan wajib diisi.'
            );

    }


    if (empty($keterangan)) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Keterangan wajib diisi.'
            );

    }


    // ==========================================
    // UPLOAD DOKUMEN OPSIONAL
    // ==========================================

    $dokumen = $this->request->getFile('dokumen');

    $namaDokumen = null;


    if (
        $dokumen &&
        $dokumen->isValid() &&
        !$dokumen->hasMoved()
    ) {


        // Maksimal 2 MB

        if (
            $dokumen->getSize() >
            2 * 1024 * 1024
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Ukuran dokumen maksimal adalah 2 MB.'
                );

        }


        // Format yang diperbolehkan

        $allowedExtensions = [
            'pdf',
            'jpg',
            'jpeg',
            'png'
        ];


        $extension = strtolower(
            $dokumen->getClientExtension()
        );


        if (
            !in_array(
                $extension,
                $allowedExtensions
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Format dokumen harus PDF, JPG, JPEG, atau PNG.'
                );

        }


        // Buat folder upload

        $uploadPath =
            FCPATH . 'uploads/dokumen';


        if (!is_dir($uploadPath)) {

            mkdir(
                $uploadPath,
                0777,
                true
            );

        }


        // Nama file random

        $namaDokumen =
            $dokumen->getRandomName();


        // Pindahkan file

        $dokumen->move(
            $uploadPath,
            $namaDokumen
        );

    }


    // ==========================================
    // NOMOR TIKET SEMENTARA
    // ==========================================

    $nomorTiket =
        'ULT-' .
        date('Ymd') .
        '-0001';


    // ==========================================
    // DATA TIKET
    // ==========================================

    $ticket = [

        'nomor_tiket' =>
            $nomorTiket,

        'unit_tujuan' =>
            $unitTujuan,

        'jenis_layanan' =>
            $jenisLayanan,

        'judul' =>
            $judul,

        'keterangan' =>
            $keterangan,

        'dokumen' =>
            $namaDokumen,

        'status' =>
            $action === 'draft'
                ? 'Draft'
                : 'Submitted',

        'created_at' =>
            date('Y-m-d H:i:s'),

    ];


    // ==========================================
    // JIKA SIMPAN DRAFT
    // ==========================================

    if ($action === 'draft') {

        // Ambil draft sebelumnya

        $drafts =
            session()->get('dosen_drafts')
            ?? [];


        // Tambahkan draft baru

        $drafts[] =
            $ticket;


        // Simpan ke session

        session()->set(
            'dosen_drafts',
            $drafts
        );


        // Redirect ke halaman draft

        return redirect()
            ->to(
                base_url(
                    'dosen/ticket/draft'
                )
            )
            ->with(
                'success',
                'Draft pengajuan berhasil disimpan.'
            );

    }


    // ==========================================
    // JIKA AJUKAN LAYANAN
    // ==========================================

    session()->setFlashdata(
        'ticket',
        $ticket
    );


    return redirect()
        ->to(
            base_url(
                'dosen/ticket/success'
            )
        );
}


    /**
     * ================================
     * HALAMAN SUCCESS
     * ================================
     */
    public function success()
    {
        $ticket = session()->getFlashdata('ticket') ?? [];

        $data = [
            'title'  => 'Pengajuan Berhasil',
            'ticket' => $ticket,
        ];

        return view(
            'dosen/ticket/success',
            $data
        );
    }


    /**
     * ================================
     * HISTORY / TRACKING TIKET
     * ================================
     */
   public function history()
{
    // Ambil tiket yang sudah diajukan
    $tickets = session()->get('dosen_tickets') ?? [];

    $data = [
        'title'   => 'Tracking Tiket',
        'tickets' => $tickets,
    ];

    return view(
        'dosen/ticket/history',
        $data
    );
}

    /**
     * ================================
     * DETAIL TIKET
     * ================================
     */
    public function detail($id)
    {
        return view(
            'dosen/ticket/detail',
            [
                'title' => 'Detail Tiket',
                'id'    => $id
            ]
        );
    }


    public function draft()
{
    $drafts =
        session()->get('dosen_drafts')
        ?? [];


    $data = [

        'title' =>
            'Draft Pengajuan',

        'drafts' =>
            $drafts,

    ];


    return view(
        'dosen/ticket/draft',
        $data
    );
}


public function editDraft($index)
{
    // Ambil semua draft
    $drafts = session()->get('dosen_drafts') ?? [];


    // Cek apakah draft tersedia
    if (!isset($drafts[$index])) {

        return redirect()
            ->to(base_url('dosen/ticket/draft'))
            ->with(
                'error',
                'Draft tidak ditemukan.'
            );

    }


    // Ambil draft yang dipilih
    $draft = $drafts[$index];


    // Data user
    $user = session()->get('user') ?? [];


    $data = [

        'title' => 'Lanjutkan Draft Pengajuan',

        'user' => $user,

        'draft' => $draft,

        'draft_index' => $index,

    ];


    return view(
        'dosen/ticket/edit_draft',
        $data
    );
}

public function updateDraft($index)
{
    // ==========================================
    // AMBIL SEMUA DRAFT
    // ==========================================

    $drafts = session()->get('dosen_drafts') ?? [];


    // ==========================================
    // CEK APAKAH DRAFT ADA
    // ==========================================

    if (!isset($drafts[$index])) {

        return redirect()
            ->to(base_url('dosen/ticket/draft'))
            ->with(
                'error',
                'Draft tidak ditemukan.'
            );

    }


    // ==========================================
    // AMBIL DATA DARI FORM
    // ==========================================

    $unitTujuan = $this->request
        ->getPost('unit_tujuan');

    $jenisLayanan = $this->request
        ->getPost('jenis_layanan');

    $judul = $this->request
        ->getPost('judul');

    $keterangan = $this->request
        ->getPost('keterangan');


    // ==========================================
    // VALIDASI FIELD WAJIB
    // ==========================================

    if (
        empty($unitTujuan) ||
        empty($jenisLayanan) ||
        empty($judul) ||
        empty($keterangan)
    ) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Semua field wajib harus diisi.'
            );

    }


    // ==========================================
    // UPDATE DATA DRAFT
    // ==========================================

    $draft = $drafts[$index];


    $draft['unit_tujuan'] =
        $unitTujuan;

    $draft['jenis_layanan'] =
        $jenisLayanan;

    $draft['judul'] =
        $judul;

    $draft['keterangan'] =
        $keterangan;

    $draft['status'] =
        'Submitted';

    $draft['updated_at'] =
        date('Y-m-d H:i:s');


    // ==========================================
    // SIMPAN DATA TIKET YANG SUDAH DIAJUKAN
    // KE SESSION TIKET DOSEN
    // ==========================================

    $submittedTickets =
        session()->get('dosen_tickets') ?? [];


    $submittedTickets[] =
        $draft;


    session()->set(
        'dosen_tickets',
        $submittedTickets
    );


    // ==========================================
    // HAPUS DRAFT DARI SESSION
    // ==========================================

    unset(
        $drafts[$index]
    );


    // Rapikan kembali index array
    $drafts = array_values(
        $drafts
    );


    // Simpan draft yang tersisa
    session()->set(
        'dosen_drafts',
        $drafts
    );


    // ==========================================
    // KIRIM DATA TIKET KE SUCCESS
    // ==========================================

    session()->setFlashdata(
        'ticket',
        $draft
    );


    // ==========================================
    // REDIRECT SUCCESS
    // ==========================================

    return redirect()
        ->to(
            base_url(
                'dosen/ticket/success'
            )
        );
}
}