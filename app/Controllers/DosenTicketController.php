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
    // AMBIL DATA FORM
    // ==========================================

    $unitTujuan = $this->request->getPost('unit_tujuan');
    $jenisLayanan = $this->request->getPost('jenis_layanan');
    $judul = $this->request->getPost('judul');
    $keterangan = $this->request->getPost('keterangan');
    $action = $this->request->getPost('action');


    // ==========================================
    // DATA USER DOSEN
    // ==========================================

    $user = session()->get('user') ?? [];


    // ==========================================
    // VALIDASI
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
                'Mohon lengkapi semua data yang wajib diisi.'
            );

    }


    // ==========================================
    // NOMOR TIKET
    // ==========================================

    $nomorTiket =
        'DOS-' .
        date('YmdHis');


    // ==========================================
    // DATA TIKET
    // ==========================================

    $ticket = [

        'id' => time(),

        'nomor_tiket' =>
            $nomorTiket,

        'nama' =>
            $user['nama'] ?? '',

        'nip' =>
            $user['nip'] ?? '',

        'email' =>
            $user['email'] ?? '',

        'unit_tujuan' =>
            $unitTujuan,

        'jenis_layanan' =>
            $jenisLayanan,

        'judul' =>
            $judul,

        'keterangan' =>
            $keterangan,

        'status' =>
            'Submitted',

        'created_at' =>
            date('Y-m-d H:i:s'),

    ];


    // ==========================================
    // JIKA SIMPAN DRAFT
    // ==========================================

    if ($action === 'draft') {

        $drafts =
            session()->get('dosen_drafts')
            ?? [];


        $drafts[] =
            $ticket;


        session()->set(
            'dosen_drafts',
            $drafts
        );


        return redirect()
            ->to(
                base_url(
                    'dosen/ticket/draft'
                )
            )
            ->with(
                'success',
                'Pengajuan berhasil disimpan sebagai draft.'
            );

    }


    // ==========================================
    // JIKA AJUKAN LANGSUNG
    // ==========================================

    if ($action === 'submit') {

        // Ambil tiket yang sudah ada
        $tickets =
            session()->get('dosen_tickets')
            ?? [];


        // Tambahkan tiket baru
        $tickets[] =
            $ticket;


        // Simpan ke session tiket Dosen
        session()->set(
            'dosen_tickets',
            $tickets
        );


        // Simpan untuk halaman success
        session()->setFlashdata(
            'ticket',
            $ticket
        );


        // Redirect ke success
        return redirect()
            ->to(
                base_url(
                    'dosen/ticket/success'
                )
            );

    }


    // ==========================================
    // JIKA ACTION TIDAK DIKENALI
    // ==========================================

    return redirect()
        ->back()
        ->withInput()
        ->with(
            'error',
            'Aksi pengajuan tidak valid.'
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
    // ==========================================
    // AMBIL DATA BALASAN DOSEN DARI SESSION
    // ==========================================

    $replies = session()->get('dosen_replies') ?? [];

    $balasan = $replies[$id]['balasan'] ?? null;


    // ==========================================
    // DATA DETAIL TIKET
    // ==========================================

    $data = [

        'title' => 'Detail Tiket Dosen',

        'ticket' => [

            'id' => $id,

            'nomor' =>
                'ULT-DOSEN-00' . $id,

            'layanan' =>
                'Layanan Dosen',

            'unit' =>
                'Akademik',

            'tanggal' =>
                date('d F Y'),

            'status' =>
                'Submitted',

            'keterangan' =>
                'Pengajuan layanan dosen.',

            // Catatan dari petugas
            'catatan_petugas' =>
                'Mohon lengkapi dokumen pendukung pengajuan Anda.',

            // Balasan dari dosen
            'balasan' =>
                $balasan

        ]

    ];


    // ==========================================
    // TAMPILKAN DETAIL TIKET
    // ==========================================

    return view(
        'dosen/ticket/detail',
        $data
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

// ==========================================
// HAPUS DRAFT
// ==========================================
public function deleteDraft($index)
{
    // Ambil semua draft dari session
    $drafts = session()->get('dosen_drafts') ?? [];

    // Cek apakah draft dengan index tersebut tersedia
    if (!isset($drafts[$index])) {

        return redirect()
            ->to(base_url('dosen/ticket/draft'))
            ->with(
                'error',
                'Draft tidak ditemukan.'
            );
    }

    // Hapus draft berdasarkan index
    unset($drafts[$index]);

    // Rapikan kembali index array
    $drafts = array_values($drafts);

    // Simpan kembali draft yang tersisa ke session
    session()->set(
        'dosen_drafts',
        $drafts
    );

    // Kembali ke halaman draft
    return redirect()
        ->to(base_url('dosen/ticket/draft'))
        ->with(
            'success',
            'Draft pengajuan berhasil dihapus.'
        );
}

// ==========================================
// BALASAN DOSEN TERHADAP CATATAN PETUGAS
// ==========================================
public function reply($id)
{
    // Ambil isi balasan dari form
    $balasan = $this->request->getPost('balasan');

    // Validasi balasan
    if (empty(trim($balasan))) {

        return redirect()
            ->to(base_url('dosen/ticket/detail/' . $id))
            ->with(
                'error',
                'Balasan tidak boleh kosong.'
            );
    }

    // ==========================================
    // SEMENTARA SIMPAN KE SESSION
    // ==========================================

    $replies = session()->get('dosen_replies') ?? [];

    $replies[$id] = [
        'balasan' => $balasan,
        'tanggal' => date('Y-m-d H:i:s')
    ];

    session()->set(
        'dosen_replies',
        $replies
    );

    // ==========================================
    // KEMBALI KE DETAIL TIKET
    // ==========================================

    return redirect()
        ->to(base_url('dosen/ticket/detail/' . $id))
        ->with(
            'success',
            'Balasan berhasil dikirim.'
        );
}
}