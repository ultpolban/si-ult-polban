<?php

namespace App\Controllers;

class MahasiswaTicketController extends BaseController
{
    // ==========================================
    // AJUKAN LAYANAN
    // ==========================================
    public function create()
    {
        $data = [
            'title' => 'Ajukan Layanan',

            'user' => [
                'nama' => 'Alvin',
                'nim'  => '221511000'
            ]
        ];

        return view(
            'mahasiswa/ticket/create',
            $data
        );
    }


    // ==========================================
    // SIMPAN PENGAJUAN
    // ==========================================
    public function store()
    {
        // Ambil aksi dari tombol
        $action = $this->request->getPost('action');


        // Ambil data form
        $layanan = $this->request->getPost('layanan');

        $keterangan =
            $this->request->getPost('keterangan');


        // ==========================================
        // VALIDASI
        // ==========================================

        if (empty($layanan)) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Jenis layanan wajib dipilih.'
                );

        }


        // ==========================================
        // BUAT DATA PENGAJUAN
        // ==========================================

        $ticket = [

            'id' =>
                time(),

            'nomor' =>
                'ULT-MHS-' .
                date('YmdHis'),

            'layanan' =>
                $layanan,

            'keterangan' =>
                $keterangan ?: '-',

            'unit' =>
                'Akademik',

            'tanggal' =>
                date('d F Y'),

            'status' =>
                'Submitted'

        ];


        // ==========================================
        // SIMPAN DRAFT
        // ==========================================

        if ($action === 'draft') {

            // Ambil draft lama
            $drafts =
                session()->get(
                    'mahasiswa_drafts'
                ) ?? [];


            // Buat nomor draft
            $ticket['nomor'] =
                'DRAFT-MHS-' .
                date('YmdHis');


            // Status Draft
            $ticket['status'] =
                'Draft';


            // Masukkan draft baru
            $drafts[] =
                $ticket;


            // Simpan ke Session
            session()->set(
                'mahasiswa_drafts',
                $drafts
            );


            // Simpan draft terakhir
            session()->setFlashdata(
                'draft',
                $ticket
            );


            // Redirect ke halaman sukses draft
            return redirect()
                ->to(
                    base_url(
                        'mahasiswa/ticket/draft-success'
                    )
                );

        }


        // ==========================================
        // KIRIM PENGAJUAN LANGSUNG
        // ==========================================

        if ($action === 'submit') {

            // Ambil tiket lama
            $tickets =
                session()->get(
                    'mahasiswa_tickets'
                ) ?? [];


            // Tambahkan tiket baru
            $tickets[] =
                $ticket;


            // Simpan tiket
            session()->set(
                'mahasiswa_tickets',
                $tickets
            );


            // Simpan tiket terakhir
            session()->setFlashdata(
                'ticket',
                $ticket
            );


            // Redirect Success
            return redirect()
                ->to(
                    base_url(
                        'mahasiswa/ticket/success'
                    )
                );

        }


        // ==========================================
        // ACTION TIDAK VALID
        // ==========================================

        return redirect()
            ->back()
            ->withInput()
            ->with(
                'error',
                'Aksi pengajuan tidak valid.'
            );
    }


    // ==========================================
    // HALAMAN SUCCESS
    // ==========================================
    public function success()
    {
        $ticket =
            session()->getFlashdata(
                'ticket'
            );


        return view(
            'mahasiswa/ticket/success',
            [

                'title' =>
                    'Pengajuan Berhasil',

                'ticket' =>
                    $ticket

            ]
        );
    }


    // ==========================================
    // HALAMAN DRAFT BERHASIL
    // ==========================================
    public function draftSuccess()
    {
        $draft =
            session()->getFlashdata(
                'draft'
            );


        return view(
            'mahasiswa/ticket/draft_success',
            [

                'title' =>
                    'Draft Berhasil Disimpan',

                'ticket' =>
                    $draft

            ]
        );
    }


    // ==========================================
    // DAFTAR DRAFT
    // ==========================================
    public function draft()
    {
        $drafts =
            session()->get(
                'mahasiswa_drafts'
            ) ?? [];


        return view(
            'mahasiswa/ticket/draft',
            [

                'title' =>
                    'Draft Pengajuan',

                'drafts' =>
                    $drafts

            ]
        );
    }


    // ==========================================
    // EDIT DRAFT
    // ==========================================
    public function editDraft($id)
    {
        $drafts =
            session()->get(
                'mahasiswa_drafts'
            ) ?? [];


        if (!isset(
            $drafts[$id]
        )) {

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

                'title' =>
                    'Edit Draft Pengajuan',

                'draft' =>
                    $drafts[$id],

                'draft_id' =>
                    $id

            ]
        );
    }


    // ==========================================
    // UPDATE DRAFT
    // ==========================================
    public function updateDraft($id)
    {
        $drafts =
            session()->get(
                'mahasiswa_drafts'
            ) ?? [];


        if (!isset(
            $drafts[$id]
        )) {

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


        $action =
            $this->request->getPost(
                'action'
            );


        $drafts[$id]['layanan'] =
            $this->request->getPost(
                'layanan'
            );


        $drafts[$id]['keterangan'] =
            $this->request->getPost(
                'keterangan'
            );


        // ==========================================
        // KIRIM DRAFT MENJADI TIKET
        // ==========================================

        if ($action === 'submit') {

            $drafts[$id]['status'] =
                'Submitted';


            $tickets =
                session()->get(
                    'mahasiswa_tickets'
                ) ?? [];


            // Masukkan draft ke tiket
            $tickets[] =
                $drafts[$id];


            // Simpan tiket
            session()->set(
                'mahasiswa_tickets',
                $tickets
            );


            // Hapus draft
            unset(
                $drafts[$id]
            );


            // Rapikan index array
            $drafts =
                array_values(
                    $drafts
                );


            // Simpan draft terbaru
            session()->set(
                'mahasiswa_drafts',
                $drafts
            );


            // Redirect success
            session()->setFlashdata(
                'ticket',
                end($tickets)
            );


            return redirect()
                ->to(
                    base_url(
                        'mahasiswa/ticket/success'
                    )
                );

        }


        // ==========================================
        // SIMPAN PERUBAHAN DRAFT
        // ==========================================

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
    // TRACKING TIKET
    // ==========================================
    public function history()
    {
        $tickets =
            session()->get(
                'mahasiswa_tickets'
            ) ?? [];


        return view(
            'mahasiswa/ticket/history',
            [

                'title' =>
                    'Tracking Tiket Mahasiswa',

                'tickets' =>
                    $tickets

            ]
        );
    }


    // ==========================================
    // DETAIL TIKET
    // ==========================================
    public function detail($id)
    {
        $tickets =
            session()->get(
                'mahasiswa_tickets'
            ) ?? [];


        if (!isset(
            $tickets[$id]
        )) {

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

                'title' =>
                    'Detail Tiket Mahasiswa',

                'ticket' =>
                    $tickets[$id]

            ]
        );
    }
}