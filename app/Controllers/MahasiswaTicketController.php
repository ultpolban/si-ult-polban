<?php

namespace App\Controllers;

class MahasiswaTicketController extends BaseController
{
    // =====================================================
    // FORM AJUKAN LAYANAN
    // =====================================================

    public function create()
    {
        return view(
            'mahasiswa/ticket/create'
        );
    }


    // =====================================================
    // SIMPAN TIKET / DRAFT
    // =====================================================

    public function store()
    {
        // ==========================================
        // DATA FORM
        // ==========================================

        $unitLayanan = $this->request->getPost(
            'unit_layanan'
        );

        $layanan = $this->request->getPost(
            'layanan'
        );

        $keterangan = $this->request->getPost(
            'keterangan'
        );

        $action = $this->request->getPost(
            'action'
        );


        // ==========================================
        // DATA USER LOGIN
        // ==========================================

        $user = session()->get('user') ?? [];


        // ==========================================
        // VALIDASI
        // ==========================================

        if (
            empty($unitLayanan) ||
            empty($layanan) ||
            empty($keterangan)
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Mohon lengkapi semua data pengajuan.'
                );
        }


        // ==========================================
        // UPLOAD DOKUMEN
        // MAKSIMAL 2 MB
        // ==========================================

        $dokumen = $this->request->getFile(
            'dokumen'
        );

        $namaDokumen = null;


        if (
            $dokumen &&
            $dokumen->isValid() &&
            !$dokumen->hasMoved()
        ) {

            // Validasi ukuran
            if (
                $dokumen->getSize()
                > 2 * 1024 * 1024
            ) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Ukuran dokumen maksimal 2 MB.'
                    );
            }


            // Validasi ekstensi
            $allowedExtensions = [

                'pdf',
                'jpg',
                'jpeg',
                'png',
                'doc',
                'docx'

            ];


            $extension = strtolower(
                $dokumen->getExtension()
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
                        'Format dokumen tidak didukung.'
                    );
            }


            // ==========================================
            // FOLDER UPLOAD
            // ==========================================

            $uploadPath =
                FCPATH .
                'uploads/dokumen';


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


            // ==========================================
            // NAMA FILE RANDOM
            // ==========================================

            $namaDokumen =
                $dokumen->getRandomName();


            // ==========================================
            // PINDAHKAN FILE
            // ==========================================

            $dokumen->move(
                $uploadPath,
                $namaDokumen
            );
        }


        // ==========================================
        // DATA TIKET
        // ==========================================

        $ticket = [

    'id' => time(),

    'nomor' => 'ULT-MHS-' . date('YmdHis'),

    'nama' => $user['nama'] ?? 'Mahasiswa',

    'nik' => $user['nik'] ?? '',

    'nim' => $user['nim'] ?? '',

    'email' => $user['email'] ?? '',

    'unit_layanan' => $unitLayanan,

    'layanan' => $layanan,

    'keterangan' => $keterangan,

    'dokumen' => $namaDokumen,

    'status' => 'Submitted',

    'created_at' => date('Y-m-d H:i:s')

];


        // =====================================================
        // SIMPAN SEBAGAI DRAFT
        // =====================================================

        if (
            $action === 'draft'
        ) {

            $ticket['status'] =
                'Draft';


            $drafts =
                session()->get(
                    'mahasiswa_drafts'
                )
                ?? [];


            $drafts[] =
                $ticket;


            session()->set(
                'mahasiswa_drafts',
                $drafts
            );


            return redirect()
                ->to(
                    base_url(
                        'mahasiswa/ticket/draft'
                    )
                )
                ->with(
                    'success',
                    'Pengajuan berhasil disimpan sebagai draft.'
                );
        }


        // =====================================================
        // KIRIM PENGAJUAN
        // =====================================================

        if (
            $action === 'submit'
        ) {

            $tickets =
                session()->get(
                    'mahasiswa_tickets'
                )
                ?? [];


            $tickets[] =
                $ticket;


            session()->set(
                'mahasiswa_tickets',
                $tickets
            );


            session()->setFlashdata(
                'ticket',
                $ticket
            );


            return redirect()
                ->to(
                    base_url(
                        'mahasiswa/ticket/success'
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


    // =====================================================
    // HALAMAN DRAFT
    // =====================================================

    public function draft()
    {
        $drafts =
            session()->get(
                'mahasiswa_drafts'
            )
            ?? [];


        return view(
            'mahasiswa/ticket/draft',
            [
                'drafts' => $drafts
            ]
        );
    }


    // =====================================================
    // EDIT DRAFT
    // =====================================================

    public function editDraft($index)
    {
        $drafts =
            session()->get(
                'mahasiswa_drafts'
            )
            ?? [];


        if (
            !isset(
                $drafts[$index]
            )
        ) {

            return redirect()
                ->to(
                    base_url(
                        'mahasiswa/ticket/draft'
                    )
                )
                ->with(
                    'error',
                    'Draft tidak ditemukan.'
                );
        }


        return view(
            'mahasiswa/ticket/edit_draft',
            [

                'draft' =>
                    $drafts[$index],

                'draft_id' =>
                    $index

            ]
        );
    }


    // =====================================================
    // UPDATE DRAFT
    // =====================================================

    public function updateDraft($index)
    {
        $drafts =
            session()->get(
                'mahasiswa_drafts'
            )
            ?? [];


        if (
            !isset(
                $drafts[$index]
            )
        ) {

            return redirect()
                ->to(
                    base_url(
                        'mahasiswa/ticket/draft'
                    )
                )
                ->with(
                    'error',
                    'Draft tidak ditemukan.'
                );
        }


        $unitLayanan =
            $this->request->getPost(
                'unit_layanan'
            );

        $layanan =
            $this->request->getPost(
                'layanan'
            );

        $keterangan =
            $this->request->getPost(
                'keterangan'
            );

        $action =
            $this->request->getPost(
                'action'
            );


        if (
            empty($unitLayanan) ||
            empty($layanan) ||
            empty($keterangan)
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Mohon lengkapi semua data.'
                );
        }


        $draft =
            $drafts[$index];


        $draft['unit_layanan'] =
            $unitLayanan;

        $draft['layanan'] =
            $layanan;

        $draft['keterangan'] =
            $keterangan;


        // ==========================================
        // UPLOAD DOKUMEN BARU
        // ==========================================

        $dokumen =
            $this->request->getFile(
                'dokumen'
            );


        if (
            $dokumen &&
            $dokumen->isValid() &&
            !$dokumen->hasMoved()
        ) {

            if (
                $dokumen->getSize()
                > 2 * 1024 * 1024
            ) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Ukuran dokumen maksimal 2 MB.'
                    );
            }


            $allowedExtensions = [

                'pdf',
                'jpg',
                'jpeg',
                'png',
                'doc',
                'docx'

            ];


            $extension =
                strtolower(
                    $dokumen->getExtension()
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
                        'Format dokumen tidak didukung.'
                    );
            }


            $uploadPath =
                FCPATH .
                'uploads/dokumen';


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


            $namaDokumen =
                $dokumen->getRandomName();


            $dokumen->move(
                $uploadPath,
                $namaDokumen
            );


            $draft['dokumen'] =
                $namaDokumen;
        }


        // ==========================================
        // SIMPAN KEMBALI SEBAGAI DRAFT
        // ==========================================

        if (
            $action === 'draft'
        ) {

            $draft['status'] =
                'Draft';


            $drafts[$index] =
                $draft;


            session()->set(
                'mahasiswa_drafts',
                $drafts
            );


            return redirect()
                ->to(
                    base_url(
                        'mahasiswa/ticket/draft'
                    )
                )
                ->with(
                    'success',
                    'Draft berhasil diperbarui.'
                );
        }


        // ==========================================
        // KIRIM DRAFT MENJADI TIKET
        // ==========================================

        if (
            $action === 'submit'
        ) {

            $draft['status'] =
                'Submitted';


            $draft['updated_at'] =
                date(
                    'Y-m-d H:i:s'
                );


            $tickets =
                session()->get(
                    'mahasiswa_tickets'
                )
                ?? [];


            $tickets[] =
                $draft;


            session()->set(
                'mahasiswa_tickets',
                $tickets
            );


            // Hapus draft
            unset(
                $drafts[$index]
            );


            $drafts =
                array_values(
                    $drafts
                );


            session()->set(
                'mahasiswa_drafts',
                $drafts
            );


            session()->setFlashdata(
                'ticket',
                $draft
            );


            return redirect()
                ->to(
                    base_url(
                        'mahasiswa/ticket/success'
                    )
                );
        }


        return redirect()
            ->back()
            ->with(
                'error',
                'Aksi tidak valid.'
            );
    }


    // =====================================================
    // TRACKING TIKET / HISTORY
    // =====================================================

    public function history()
    {
        $tickets =
            session()->get(
                'mahasiswa_tickets'
            )
            ?? [];


        return view(
            'mahasiswa/ticket/history',
            [

                'tickets' =>
                    $tickets

            ]
        );
    }


    // =====================================================
    // DETAIL TIKET
    // =====================================================

    public function detail($id)
    {
        $tickets =
            session()->get(
                'mahasiswa_tickets'
            )
            ?? [];


        $ticketFound = null;


        foreach (
            $tickets
            as $ticket
        ) {

            if (
                (string)($ticket['id'] ?? '')
                === (string)$id
            ) {

                $ticketFound =
                    $ticket;

                break;
            }
        }


        if (
            $ticketFound === null
        ) {

            return redirect()
                ->to(
                    base_url(
                        'mahasiswa/ticket/history'
                    )
                )
                ->with(
                    'error',
                    'Tiket tidak ditemukan.'
                );
        }


        return view(
            'mahasiswa/ticket/detail',
            [

                'ticket' =>
                    $ticketFound

            ]
        );
    }


    // =====================================================
    // HALAMAN SUCCESS
    // =====================================================

    public function success()
    {
        $ticket =
            session()->getFlashdata(
                'ticket'
            );


        return view(
            'mahasiswa/ticket/success',
            [

                'ticket' =>
                    $ticket

            ]
        );
    }

    // =====================================================
// BALAS CATATAN / PESAN DARI PETUGAS
// =====================================================
public function reply($id)
{
    // Ambil pesan dari form
    $pesan = trim(
        $this->request->getPost('pesan')
    );

    // Validasi pesan
    if (empty($pesan)) {

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Pesan balasan tidak boleh kosong.'
            );
    }


    // =====================================================
    // AMBIL DATA TIKET MAHASISWA
    // =====================================================

    $tickets = session()->get(
        'mahasiswa_tickets'
    ) ?? [];


    // =====================================================
    // CARI TIKET BERDASARKAN ID
    // =====================================================

    $ticketFound = false;


    foreach ($tickets as $key => $ticket) {

        if (
            isset($ticket['id']) &&
            (string) $ticket['id'] === (string) $id
        ) {

            $ticketFound = true;


            // =================================================
            // JIKA BELUM ADA ARRAY BALASAN
            // =================================================

            if (
                !isset(
                    $tickets[$key]['balasan']
                )
                ||
                !is_array(
                    $tickets[$key]['balasan']
                )
            ) {

                $tickets[$key]['balasan'] = [];
            }


            // =================================================
            // DATA USER YANG SEDANG LOGIN
            // =================================================

            $user =
                session()->get(
                    'user'
                )
                ?? [];


            // =================================================
            // TAMBAHKAN BALASAN
            // =================================================

            $tickets[$key]['balasan'][] = [

                'id' =>
                    time(),

                'pengirim' =>
                    $user['nama']
                    ?? 'Mahasiswa',

                'role' =>
                    'Mahasiswa',

                'pesan' =>
                    $pesan,

                'created_at' =>
                    date(
                        'Y-m-d H:i:s'
                    )

            ];


            break;
        }
    }


    // =====================================================
    // JIKA TIKET TIDAK DITEMUKAN
    // =====================================================

    if (!$ticketFound) {

        return redirect()
            ->back()
            ->with(
                'error',
                'Tiket tidak ditemukan.'
            );
    }


    // =====================================================
    // SIMPAN KEMBALI KE SESSION
    // =====================================================

    session()->set(
        'mahasiswa_tickets',
        $tickets
    );


    // =====================================================
    // KEMBALI KE DETAIL TIKET
    // =====================================================

    return redirect()
        ->to(
            base_url(
                'mahasiswa/ticket/detail/' .
                $id
            )
        )
        ->with(
            'success',
            'Balasan berhasil dikirim.'
        );
}
}