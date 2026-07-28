<?php

namespace App\Controllers;

class TendikTicketController extends BaseController
{
    // =========================================================
    // FORM AJUKAN LAYANAN
    // =========================================================
    public function create()
    {
        $user = session()->get('user') ?? [];

        $data = [
            'title' => 'Ajukan Layanan',
            'user'  => $user,
        ];

        return view(
            'tendik/ticket/create',
            $data
        );
    }


    // =========================================================
    // PROSES SIMPAN / AJUKAN LAYANAN
    // =========================================================
    public function store()
    {
        // -----------------------------------------------------
        // AMBIL DATA FORM
        // -----------------------------------------------------
        $unitTujuan = $this->request
            ->getPost('unit_tujuan');

        $jenisLayanan = $this->request
            ->getPost('jenis_layanan');

        $judul = $this->request
            ->getPost('judul');

        $keterangan = $this->request
            ->getPost('keterangan');

        $action = $this->request
            ->getPost('action');


        // -----------------------------------------------------
        // DATA USER
        // -----------------------------------------------------
        $user = session()->get('user') ?? [];


        // -----------------------------------------------------
        // VALIDASI DATA WAJIB
        // -----------------------------------------------------
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


        // -----------------------------------------------------
        // AMBIL FILE DOKUMEN
        // -----------------------------------------------------
        $dokumen = $this->request
            ->getFile('dokumen');


        // -----------------------------------------------------
        // PROSES UPLOAD DOKUMEN
        // -----------------------------------------------------
        $dokumenData = $this->processDocument(
            $dokumen
        );


        // -----------------------------------------------------
        // JIKA UPLOAD GAGAL
        // -----------------------------------------------------
        if (
            $dokumenData === false
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Dokumen gagal diupload. Pastikan format file benar dan ukuran maksimal 2 MB.'
                );
        }


        // -----------------------------------------------------
        // NOMOR TIKET
        // -----------------------------------------------------
        $nomorTiket =
            'TEN-' .
            date('YmdHis');


        // -----------------------------------------------------
        // DATA TIKET
        // -----------------------------------------------------
        $ticket = [

            'id' =>
                time(),

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

            'dokumen' =>
                $dokumenData,

            'status' =>
                'Submitted',

            'created_at' =>
                date('Y-m-d H:i:s'),

        ];


        // =====================================================
        // SIMPAN SEBAGAI DRAFT
        // =====================================================
        if (
            $action === 'draft'
        ) {

            // Ambil draft lama
            $drafts =
                session()->get(
                    'tendik_drafts'
                )
                ?? [];


            // Ubah status
            $ticket['status'] =
                'Draft';


            // Tambahkan draft baru
            $drafts[] =
                $ticket;


            // Simpan ke session
            session()->set(
                'tendik_drafts',
                $drafts
            );


            // Kembali ke halaman draft
            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/draft'
                    )
                )
                ->with(
                    'success',
                    'Pengajuan berhasil disimpan sebagai draft.'
                );
        }


        // =====================================================
        // AJUKAN LANGSUNG
        // =====================================================
        if (
            $action === 'submit'
        ) {

            // Ambil tiket lama
            $tickets =
                session()->get(
                    'tendik_tickets'
                )
                ?? [];


            // Tambahkan tiket baru
            $tickets[] =
                $ticket;


            // Simpan tiket
            session()->set(
                'tendik_tickets',
                $tickets
            );


            // Simpan data untuk halaman sukses
            session()->setFlashdata(
                'ticket',
                $ticket
            );


            // Redirect halaman sukses
            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/success'
                    )
                );
        }


        // =====================================================
        // ACTION TIDAK VALID
        // =====================================================
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Aksi pengajuan tidak valid.'
            );
    }


    // =========================================================
    // PROSES UPLOAD DOKUMEN
    // =========================================================
    private function processDocument($dokumen)
    {
        // -----------------------------------------------------
        // TIDAK ADA FILE
        // -----------------------------------------------------
        if (
            !$dokumen ||
            $dokumen->getError() === UPLOAD_ERR_NO_FILE
        ) {

            return null;
        }


        // -----------------------------------------------------
        // CEK FILE VALID
        // -----------------------------------------------------
        if (
            !$dokumen->isValid()
        ) {

            return false;
        }


        // -----------------------------------------------------
        // CEK UKURAN MAKSIMAL 2 MB
        // -----------------------------------------------------
        if (
            $dokumen->getSize()
            >
            2 * 1024 * 1024
        ) {

            return false;
        }


        // -----------------------------------------------------
        // FORMAT FILE YANG DIPERBOLEHKAN
        // -----------------------------------------------------
        $allowedExtensions = [

            'pdf',
            'doc',
            'docx',
            'jpg',
            'jpeg',
            'png',

        ];


        // Ambil extension
        $extension =
            strtolower(
                $dokumen->getClientExtension()
            );


        // -----------------------------------------------------
        // CEK EXTENSION
        // -----------------------------------------------------
        if (
            !in_array(
                $extension,
                $allowedExtensions
            )
        ) {

            return false;
        }


        // -----------------------------------------------------
        // FOLDER UPLOAD
        // -----------------------------------------------------
        $uploadPath =
            WRITEPATH .
            'uploads/dokumen/';


        // Buat folder jika belum ada
        if (
            !is_dir(
                $uploadPath
            )
        ) {

            mkdir(
                $uploadPath,
                0777,
                true
            );
        }


        // -----------------------------------------------------
        // BUAT NAMA FILE RANDOM
        // -----------------------------------------------------
        $newName =
            $dokumen->getRandomName();


        // -----------------------------------------------------
        // PINDAHKAN FILE
        // -----------------------------------------------------
        $dokumen->move(
            $uploadPath,
            $newName
        );


        // -----------------------------------------------------
        // DATA DOKUMEN
        // -----------------------------------------------------
        return [

            'nama_asli' =>
                $dokumen
                    ->getClientName(),

            'nama_file' =>
                $newName,

            'path' =>
                'uploads/dokumen/' .
                $newName,

            'ukuran' =>
                $dokumen
                    ->getSize(),

            'extension' =>
                $extension,

        ];
    }


    // =========================================================
    // HALAMAN SUCCESS
    // =========================================================
    public function success()
    {
        $ticket =
            session()->getFlashdata(
                'ticket'
            )
            ?? [];


        $data = [

            'title' =>
                'Pengajuan Berhasil',

            'ticket' =>
                $ticket,

        ];


        return view(
            'tendik/ticket/success',
            $data
        );
    }


    // =========================================================
    // TRACKING TIKET
    // =========================================================
    public function history()
    {
        // Ambil semua tiket Tendik
        $tickets =
            session()->get(
                'tendik_tickets'
            )
            ?? [];


        $data = [

            'title' =>
                'Tracking Tiket Tendik',

            'tickets' =>
                $tickets,

        ];


        return view(
            'tendik/ticket/history',
            $data
        );
    }


    // =========================================================
    // DETAIL TIKET
    // =========================================================
    public function detail($id)
    {
        // Ambil semua tiket
        $tickets =
            session()->get(
                'tendik_tickets'
            )
            ?? [];


        // Cari tiket berdasarkan ID
        $ticket = null;


        foreach (
            $tickets
            as $item
        ) {

            if (
                (string)($item['id'] ?? '')
                ===
                (string)$id
            ) {

                $ticket =
                    $item;

                break;
            }
        }


        // Jika tiket tidak ditemukan
        if (
            !$ticket
        ) {

            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/history'
                    )
                )
                ->with(
                    'error',
                    'Tiket tidak ditemukan.'
                );
        }


        // -----------------------------------------------------
        // AMBIL BALASAN TENDIK
        // -----------------------------------------------------
        $replies =
            session()->get(
                'tendik_replies'
            )
            ?? [];


        $ticket['balasan'] =
            $replies[$id]['balasan']
            ?? null;


        $ticket['tanggal_balasan'] =
            $replies[$id]['tanggal']
            ?? null;


        // -----------------------------------------------------
        // DATA DETAIL
        // -----------------------------------------------------
        $data = [

            'title' =>
                'Detail Tiket Tendik',

            'ticket' =>
                $ticket,

        ];


        return view(
            'tendik/ticket/detail',
            $data
        );
    }


    // =========================================================
    // HALAMAN DRAFT
    // =========================================================
    public function draft()
    {
        // Ambil semua draft
        $drafts =
            session()->get(
                'tendik_drafts'
            )
            ?? [];


        $data = [

            'title' =>
                'Draft Pengajuan',

            'drafts' =>
                $drafts,

        ];


        return view(
            'tendik/ticket/draft',
            $data
        );
    }


    // =========================================================
    // EDIT / LANJUTKAN DRAFT
    // =========================================================
    public function editDraft($index)
    {
        // Ambil semua draft
        $drafts =
            session()->get(
                'tendik_drafts'
            )
            ?? [];


        // Cek draft
        if (
            !isset(
                $drafts[$index]
            )
        ) {

            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/draft'
                    )
                )
                ->with(
                    'error',
                    'Draft tidak ditemukan.'
                );
        }


        // Ambil draft yang dipilih
        $draft =
            $drafts[$index];


        // Ambil user
        $user =
            session()->get(
                'user'
            )
            ?? [];


        $data = [

            'title' =>
                'Lanjutkan Draft Pengajuan',

            'user' =>
                $user,

            'draft' =>
                $draft,

            'draft_index' =>
                $index,

        ];


        return view(
            'tendik/ticket/edit_draft',
            $data
        );
    }


    // =========================================================
    // UPDATE / KIRIM DRAFT
    // =========================================================
    public function updateDraft($index)
    {
        // -----------------------------------------------------
        // AMBIL DRAFT
        // -----------------------------------------------------
        $drafts =
            session()->get(
                'tendik_drafts'
            )
            ?? [];


        // -----------------------------------------------------
        // CEK DRAFT
        // -----------------------------------------------------
        if (
            !isset(
                $drafts[$index]
            )
        ) {

            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/draft'
                    )
                )
                ->with(
                    'error',
                    'Draft tidak ditemukan.'
                );
        }


        // -----------------------------------------------------
        // AMBIL DATA FORM
        // -----------------------------------------------------
        $unitTujuan =
            $this->request
                ->getPost(
                    'unit_tujuan'
                );

        $jenisLayanan =
            $this->request
                ->getPost(
                    'jenis_layanan'
                );

        $judul =
            $this->request
                ->getPost(
                    'judul'
                );

        $keterangan =
            $this->request
                ->getPost(
                    'keterangan'
                );

        $action =
            $this->request
                ->getPost(
                    'action'
                );


        // -----------------------------------------------------
        // VALIDASI DATA WAJIB
        // -----------------------------------------------------
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


        // -----------------------------------------------------
        // AMBIL DOKUMEN BARU
        // -----------------------------------------------------
        $dokumen =
            $this->request
                ->getFile(
                    'dokumen'
                );


        // -----------------------------------------------------
        // PERTAHANKAN DOKUMEN LAMA
        // -----------------------------------------------------
        $dokumenData =
            $drafts[$index]['dokumen']
            ?? null;


        // -----------------------------------------------------
        // JIKA ADA DOKUMEN BARU
        // -----------------------------------------------------
        if (
            $dokumen &&
            $dokumen->getError()
            !==
            UPLOAD_ERR_NO_FILE
        ) {

            // Proses upload
            $newDocument =
                $this->processDocument(
                    $dokumen
                );


            // Cek upload
            if (
                $newDocument === false
            ) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Dokumen gagal diupload. Pastikan format file benar dan ukuran maksimal 2 MB.'
                    );
            }


            // Gunakan dokumen baru
            $dokumenData =
                $newDocument;
        }


        // -----------------------------------------------------
        // AMBIL DATA DRAFT
        // -----------------------------------------------------
        $draft =
            $drafts[$index];


        // -----------------------------------------------------
        // UPDATE DATA
        // -----------------------------------------------------
        $draft['unit_tujuan'] =
            $unitTujuan;

        $draft['jenis_layanan'] =
            $jenisLayanan;

        $draft['judul'] =
            $judul;

        $draft['keterangan'] =
            $keterangan;

        $draft['dokumen'] =
            $dokumenData;

        $draft['updated_at'] =
            date(
                'Y-m-d H:i:s'
            );


        // =====================================================
        // JIKA MASIH INGIN SIMPAN SEBAGAI DRAFT
        // =====================================================
        if (
            $action === 'draft'
        ) {

            // Status tetap Draft
            $draft['status'] =
                'Draft';


            // Update draft pada index yang sama
            $drafts[$index] =
                $draft;


            // Simpan kembali
            session()->set(
                'tendik_drafts',
                $drafts
            );


            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/draft'
                    )
                )
                ->with(
                    'success',
                    'Draft berhasil diperbarui.'
                );
        }


        // =====================================================
        // JIKA KIRIM PENGAJUAN
        // =====================================================
        if (
            $action === 'submit'
        ) {

            // Ubah status
            $draft['status'] =
                'Submitted';


            // Ambil tiket lama
            $submittedTickets =
                session()->get(
                    'tendik_tickets'
                )
                ?? [];


            // Tambahkan ke tracking
            $submittedTickets[] =
                $draft;


            // Simpan tiket
            session()->set(
                'tendik_tickets',
                $submittedTickets
            );


            // Hapus draft
            unset(
                $drafts[$index]
            );


            // Rapikan index
            $drafts =
                array_values(
                    $drafts
                );


            // Simpan draft tersisa
            session()->set(
                'tendik_drafts',
                $drafts
            );


            // Simpan untuk success page
            session()->setFlashdata(
                'ticket',
                $draft
            );


            // Redirect success
            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/success'
                    )
                );
        }


        // =====================================================
        // ACTION TIDAK VALID
        // =====================================================
        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Aksi pengajuan tidak valid.'
            );
    }


    // =========================================================
    // HAPUS DRAFT
    // =========================================================
    public function deleteDraft($index)
    {
        // Ambil draft
        $drafts =
            session()->get(
                'tendik_drafts'
            )
            ?? [];


        // Cek draft
        if (
            !isset(
                $drafts[$index]
            )
        ) {

            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/draft'
                    )
                )
                ->with(
                    'error',
                    'Draft tidak ditemukan.'
                );
        }


        // Hapus draft
        unset(
            $drafts[$index]
        );


        // Rapikan array
        $drafts =
            array_values(
                $drafts
            );


        // Simpan kembali
        session()->set(
            'tendik_drafts',
            $drafts
        );


        return redirect()
            ->to(
                base_url(
                    'tendik/ticket/draft'
                )
            )
            ->with(
                'success',
                'Draft pengajuan berhasil dihapus.'
            );
    }

    public function notification()
{
    $notifications = session()->get('tendik_notifications') ?? [

        [
            'id' => 1,

            'judul' =>
                'Pengajuan Berhasil Dikirim',

            'pesan' =>
                'Pengajuan layanan Anda berhasil dikirim dan sedang menunggu proses verifikasi.',

            'tanggal' =>
                date('d F Y H:i'),

        ],

        [
            'id' => 2,

            'judul' =>
                'Informasi Pengajuan',

            'pesan' =>
                'Anda dapat memantau perkembangan pengajuan melalui menu Tracking Tiket.',

            'tanggal' =>
                date('d F Y H:i'),

        ],

    ];


    $data = [

        'title' =>
            'Notifikasi',

        'notifications' =>
            $notifications,

    ];


    return view(
        'tendik/notification',
        $data
    );
}


    // =========================================================
    // BALASAN TENDIK TERHADAP CATATAN PETUGAS
    // =========================================================
    public function reply($id)
    {
        // Ambil balasan
        $balasan =
            $this->request
                ->getPost(
                    'balasan'
                );


        // Validasi
        if (
            empty(
                trim(
                    $balasan
                )
            )
        ) {

            return redirect()
                ->to(
                    base_url(
                        'tendik/ticket/detail/' .
                        $id
                    )
                )
                ->with(
                    'error',
                    'Balasan tidak boleh kosong.'
                );
        }


        // Ambil replies lama
        $replies =
            session()->get(
                'tendik_replies'
            )
            ?? [];


        // Simpan balasan
        $replies[$id] = [

            'balasan' =>
                $balasan,

            'tanggal' =>
                date(
                    'Y-m-d H:i:s'
                ),

        ];


        // Simpan ke session
        session()->set(
            'tendik_replies',
            $replies
        );


        // Kembali ke detail
        return redirect()
            ->to(
                base_url(
                    'tendik/ticket/detail/' .
                    $id
                )
            )
            ->with(
                'success',
                'Balasan berhasil dikirim.'
            );
    }
}