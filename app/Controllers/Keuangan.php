<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TicketModel;

class Keuangan extends BaseController
{
    protected $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
    }


    // =========================================================
    // INDEX
    // =========================================================

    public function index()
    {
        return $this->dashboard();
    }


    // =========================================================
    // DASHBOARD
    // =========================================================

    public function dashboard()
    {
        $tickets = $this->ticketModel
            ->orderBy('id', 'DESC')
            ->findAll();

        $menunggu = 0;
        $diproses = 0;
        $selesai  = 0;
        $ditolak  = 0;
        $dibatalkan = 0;

        foreach ($tickets as $ticket) {

            $status = strtolower(
                trim((string) ($ticket['status'] ?? ''))
            );

            switch ($status) {

                case 'menunggu':
                    $menunggu++;
                    break;

                case 'diproses':
                    $diproses++;
                    break;

                case 'selesai':
                    $selesai++;
                    break;

                case 'ditolak':
                    $ditolak++;
                    break;

                case 'dibatalkan':
                case 'dibatalkan':
                    $dibatalkan++;
                    break;
            }
        }

        $data = [

            'title' => 'Dashboard Keuangan',

            'total' => count($tickets),

            'menunggu' => $menunggu,

            'diproses' => $diproses,

            'selesai' => $selesai,

            'ditolak' => $ditolak,

            'dibatalkan' => $dibatalkan,

            'tiket' => $tickets,
        ];

        return view(
            'keuangan/dashboard',
            $data
        );
    }


    // =========================================================
    // PROFIL PETUGAS
    // =========================================================

    public function profil()
    {
        $session = session();

        $data = [

            'title' => 'Profil Petugas Keuangan',

            'name' => $session->get('name')
                ?: 'Andi Pratama',

            'nip' => $session->get('nip')
                ?: '198705152024011001',

            'email' => $session->get('email')
                ?: 'andi.pratama@polban.ac.id',

            'no_hp' => $session->get('no_hp')
                ?: '081234567890',

            'jabatan' => $session->get('jabatan')
                ?: 'Petugas Unit Layanan',

        ];

        return view(
            'keuangan/profil',
            $data
        );
    }


    // =========================================================
    // PROFILE
    // =========================================================

    public function profile()
    {
        return $this->profil();
    }


    // =========================================================
    // EDIT PROFIL
    // =========================================================

    public function editProfil()
    {
        return redirect()->to(
            base_url('keuangan/profile')
        );
    }


    // =========================================================
    // UPDATE PROFIL
    // =========================================================

    public function updateProfil()
    {
        $session = session();

        $name = trim(
            (string) $this->request->getPost('name')
        );

        $nip = trim(
            (string) $this->request->getPost('nip')
        );

        $email = trim(
            (string) $this->request->getPost('email')
        );

        $no_hp = trim(
            (string) $this->request->getPost('no_hp')
        );

        $jabatan = trim(
            (string) $this->request->getPost('jabatan')
        );


        // =====================================================
        // VALIDASI NAMA
        // =====================================================

        if ($name === '') {

            return redirect()
                ->to(base_url('keuangan/profile'))
                ->withInput()
                ->with(
                    'error',
                    'Nama Lengkap wajib diisi.'
                );
        }


        // =====================================================
        // VALIDASI NIP
        // =====================================================

        if ($nip === '') {

            return redirect()
                ->to(base_url('keuangan/profile'))
                ->withInput()
                ->with(
                    'error',
                    'NIP wajib diisi.'
                );
        }


        // =====================================================
        // VALIDASI EMAIL
        // =====================================================

        if ($email === '') {

            return redirect()
                ->to(base_url('keuangan/profile'))
                ->withInput()
                ->with(
                    'error',
                    'Email wajib diisi.'
                );
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            return redirect()
                ->to(base_url('keuangan/profile'))
                ->withInput()
                ->with(
                    'error',
                    'Format email tidak valid.'
                );
        }


        // =====================================================
        // SIMPAN KE SESSION
        // =====================================================

        $session->set([

            'name' => $name,

            'nip' => $nip,

            'email' => $email,

            'no_hp' => $no_hp,

            'jabatan' => $jabatan,

        ]);


        // =====================================================
        // KEMBALI
        // =====================================================

        return redirect()
            ->to(base_url('keuangan/profile'))
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }


    // =========================================================
    // UPDATE PROFILE
    // =========================================================

    public function updateProfile()
    {
        return $this->updateProfil();
    }


    // =========================================================
    // DETAIL TIKET
    // =========================================================

    public function detail($id)
    {
        $tiket = $this->ticketModel
            ->find($id);

        if (!$tiket) {

            return redirect()
                ->to(base_url('keuangan/dashboard'))
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }


        return view(
            'keuangan/detail',
            [
                'title' => 'Detail Tiket Keuangan',

                'tiket' => $tiket,
            ]
        );
    }


    // =========================================================
    // PROSES TIKET
    // =========================================================

    public function proses($id)
    {
        $tiket = $this->ticketModel
            ->find($id);

        if (!$tiket) {

            return redirect()
                ->to(base_url('keuangan/dashboard'))
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }


        return view(
            'keuangan/proses',
            [
                'title' => 'Proses Tiket Keuangan',

                'tiket' => $tiket,
            ]
        );
    }


    // =========================================================
    // UPDATE PROSES TIKET
    // =========================================================

    public function updateProses($id)
    {
        $tiket = $this->ticketModel
            ->find($id);

        if (!$tiket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }


        $status = trim(
            (string) $this->request->getPost('status')
        );

        $catatan = trim(
            (string) $this->request->getPost('catatan')
        );


        // =====================================================
        // DATA UPDATE
        // =====================================================

        $dataUpdate = [

            'status' => $status,

        ];


        // =====================================================
        // SIMPAN CATATAN KE ADMIN NOTE
        // =====================================================

        if ($catatan !== '') {

            $dataUpdate['admin_note'] = $catatan;
        }


        // =====================================================
        // UPDATE WAKTU BERDASARKAN STATUS
        // =====================================================

        $now = date('Y-m-d H:i:s');

        switch (strtolower($status)) {

            case 'diproses':

                $dataUpdate['processed_at'] = $now;

                break;


            case 'selesai':

                $dataUpdate['completed_at'] = $now;

                break;


            case 'ditolak':

                $dataUpdate['rejected_at'] = $now;

                break;


            case 'dibatalkan':

                $dataUpdate['cancelled_at'] = $now;

                break;
        }


        // =====================================================
        // UPDATE DATABASE
        // =====================================================

        $this->ticketModel->update(
            $id,
            $dataUpdate
        );


        return redirect()
            ->to(
                base_url(
                    'keuangan/detail/' . $id
                )
            )
            ->with(
                'success',
                'Status tiket berhasil diperbarui.'
            );
    }


    // =========================================================
    // KIRIM KE PETUGAS ULT
    // =========================================================

    public function kirim($id)
    {
        $tiket = $this->ticketModel
            ->find($id);

        if (!$tiket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }


        $status = strtolower(
            trim((string) ($tiket['status'] ?? ''))
        );


        if ($status !== 'selesai') {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket hanya bisa dikirim ke Petugas ULT setelah status Selesai.'
                );
        }


        /*
         * Setelah dikirim ke ULT,
         * status dikembalikan menjadi Diproses.
         */

        $this->ticketModel->update(

            $id,

            [
                'status' => 'Diproses',

                'processed_at' => date(
                    'Y-m-d H:i:s'
                ),
            ]
        );


        return redirect()
            ->to(
                base_url(
                    'keuangan/detail/' . $id
                )
            )
            ->with(
                'success',
                'Tiket berhasil dikirim ke Petugas ULT.'
            );
    }


    // =========================================================
    // KIRIM KE PEMOHON
    // =========================================================

    public function kirimKePemohon($id)
    {
        $tiket = $this->ticketModel
            ->find($id);

        if (!$tiket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }


        $status = strtolower(
            trim((string) ($tiket['status'] ?? ''))
        );


        if (!in_array(
            $status,
            [
                'selesai',
                'diproses'
            ],
            true
        )) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket hanya bisa dikirim ke pemohon setelah status Selesai atau Diproses.'
                );
        }


        $this->ticketModel->update(

            $id,

            [
                'status' => 'Selesai',

                'completed_at' => date(
                    'Y-m-d H:i:s'
                ),
            ]
        );


        return redirect()
            ->to(
                base_url(
                    'keuangan/detail/' . $id
                )
            )
            ->with(
                'success',
                'Tiket berhasil dikirim ke pemohon.'
            );
    }


    // =========================================================
    // RIWAYAT
    // =========================================================

    public function riwayat()
    {
        $tickets = $this->ticketModel
            ->orderBy('id', 'DESC')
            ->findAll();

        return view(
            'keuangan/dashboard',
            [
                'title' => 'Riwayat Tiket Keuangan',

                'total' => count($tickets),

                'menunggu' => 0,

                'diproses' => 0,

                'selesai' => 0,

                'ditolak' => 0,

                'dibatalkan' => 0,

                'tiket' => $tickets,
            ]
        );
    }


    // =========================================================
    // HAPUS DOKUMEN
    // =========================================================

    public function hapusDokumen($id)
    {
        return redirect()
            ->back()
            ->with(
                'success',
                'Dokumen berhasil diproses.'
            );
    }
}