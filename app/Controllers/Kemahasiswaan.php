<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TicketModel;
use App\Models\DokumenHasilModel;

class Kemahasiswaan extends BaseController
{
    protected $ticketModel;
    protected $dokumenHasilModel;


    // =========================================================
    // CONSTRUCTOR
    // =========================================================

    public function __construct()
    {
        $this->ticketModel = new TicketModel();

        $this->dokumenHasilModel = new DokumenHasilModel();
    }


    // =========================================================
    // INDEX
    // =========================================================

    public function index()
    {
        return $this->dashboard();
    }


    // =========================================================
    // DASHBOARD KEMAHASISWAAN
    // =========================================================

    public function dashboard()
    {
        $tickets = $this->ticketModel
            ->orderBy('id', 'DESC')
            ->findAll();


        // =====================================================
        // STATISTIK
        // =====================================================

        $menunggu = 0;

        $diproses = 0;

        $selesai = 0;

        $ditolak = 0;

        $dibatalkan = 0;


        foreach ($tickets as $ticket) {

            $status = strtolower(
                trim(
                    (string) ($ticket['status'] ?? '')
                )
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

                    $dibatalkan++;

                    break;
            }
        }


        // =====================================================
        // DATA VIEW
        // =====================================================

        $data = [

            'title' => 'Dashboard Kemahasiswaan',

            'total' => count($tickets),

            'menunggu' => $menunggu,

            'diproses' => $diproses,

            'selesai' => $selesai,

            'ditolak' => $ditolak,

            'dibatalkan' => $dibatalkan,

            'tiket' => $tickets,

        ];


        return view(
            'kemahasiswaan/dashboard',
            $data
        );
    }


    // =========================================================
    // PROFIL KEMAHASISWAAN
    // =========================================================

    public function profile()
    {
        $session = session();


        $data = [

            'title' => 'Profil Petugas Kemahasiswaan',


            'name' => $session->get('name')
                ?: 'Siti Nurhaliza',


            'nip' => $session->get('nip')
                ?: '199001182024012003',


            'email' => $session->get('email')
                ?: 'siti.nurhaliza@polban.ac.id',


            'no_hp' => $session->get('no_hp')
                ?: '081376543210',


            'jabatan' => $session->get('jabatan')
                ?: 'Petugas Unit Layanan',

        ];


        return view(
            'kemahasiswaan/profile',
            $data
        );
    }


    // =========================================================
    // EDIT PROFIL
    // =========================================================

    public function editProfil()
    {
        $session = session();


        $data = [

            'title' => 'Edit Profil Petugas Kemahasiswaan',


            'name' => $session->get('name')
                ?: 'Siti Nurhaliza',


            'nip' => $session->get('nip')
                ?: '199001182024012003',


            'email' => $session->get('email')
                ?: 'siti.nurhaliza@polban.ac.id',


            'no_hp' => $session->get('no_hp')
                ?: '081376543210',


            'jabatan' => $session->get('jabatan')
                ?: 'Petugas Unit Layanan',

        ];


        return view(
            'kemahasiswaan/edit-profil',
            $data
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
                ->to(
                    base_url(
                        'kemahasiswaan/edit-profil'
                    )
                )
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
                ->to(
                    base_url(
                        'kemahasiswaan/edit-profil'
                    )
                )
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
                ->to(
                    base_url(
                        'kemahasiswaan/edit-profil'
                    )
                )
                ->withInput()
                ->with(
                    'error',
                    'Email wajib diisi.'
                );
        }


        if (!filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        )) {

            return redirect()
                ->to(
                    base_url(
                        'kemahasiswaan/edit-profil'
                    )
                )
                ->withInput()
                ->with(
                    'error',
                    'Format email tidak valid.'
                );
        }


        // =====================================================
        // SIMPAN SESSION
        // =====================================================

        $session->set([

            'name' => $name,

            'nip' => $nip,

            'email' => $email,

            'no_hp' => $no_hp,

            'jabatan' => $jabatan,

        ]);


        // =====================================================
        // KEMBALI KE PROFIL
        // =====================================================

        return redirect()
            ->to(
                base_url(
                    'kemahasiswaan/profile'
                )
            )
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
                ->to(
                    base_url(
                        'kemahasiswaan/dashboard'
                    )
                )
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }


        // =====================================================
        // DOKUMEN HASIL
        // =====================================================

        $dokumenHasil = [];

        if ($this->dokumenHasilModel) {

            $dokumenHasil = $this->dokumenHasilModel
                ->where(
                    'penanganan_id',
                    $id
                )
                ->findAll();
        }


        $tiket['dokumen_hasil'] = $dokumenHasil;


        return view(
            'kemahasiswaan/detail',
            [
                'title' => 'Detail Tiket Kemahasiswaan',

                'tiket' => $tiket,
            ]
        );
    }


    // =========================================================
    // HALAMAN PROSES
    // =========================================================

    public function proses($id)
    {
        $tiket = $this->ticketModel
            ->find($id);


        if (!$tiket) {

            return redirect()
                ->to(
                    base_url(
                        'kemahasiswaan/dashboard'
                    )
                )
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }


        // =====================================================
        // DOKUMEN SEBELUMNYA
        // =====================================================

        $dokumenHasil = [];

        if ($this->dokumenHasilModel) {

            $dokumenHasil = $this->dokumenHasilModel
                ->where(
                    'penanganan_id',
                    $id
                )
                ->findAll();
        }


        $tiket['dokumen_hasil'] = $dokumenHasil;


        return view(
            'kemahasiswaan/proses',
            [
                'title' => 'Proses Tiket Kemahasiswaan',

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


        // =====================================================
        // AMBIL FORM
        // =====================================================

        $status = trim(
            (string) $this->request
                ->getPost('status')
        );


        $catatan = trim(
            (string) $this->request
                ->getPost('catatan')
        );


        // =====================================================
        // STATUS YANG DIIZINKAN
        // =====================================================

        $statusDiizinkan = [

            'Menunggu',

            'Diproses',

            'Selesai',

            'Ditolak',

            'Dibatalkan',

        ];


        if (!in_array(
            $status,
            $statusDiizinkan,
            true
        )) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Status tiket tidak valid.'
                );
        }


        // =====================================================
        // DATA UPDATE
        // =====================================================

        $updateData = [

            'status' => $status,

        ];


        // =====================================================
        // CATATAN
        // =====================================================

        if ($catatan !== '') {

            $updateData['admin_note'] = $catatan;
        }


        // =====================================================
        // WAKTU STATUS
        // =====================================================

        $now = date(
            'Y-m-d H:i:s'
        );


        switch (
            strtolower($status)
        ) {

            case 'diproses':

                $updateData['processed_at'] = $now;

                break;


            case 'selesai':

                $updateData['completed_at'] = $now;

                break;


            case 'ditolak':

                $updateData['rejected_at'] = $now;

                break;


            case 'dibatalkan':

                $updateData['cancelled_at'] = $now;

                break;
        }


        // =====================================================
        // UPDATE TICKET
        // =====================================================

        $this->ticketModel
            ->update(
                $id,
                $updateData
            );


        // =====================================================
        // UPLOAD DOKUMEN HASIL
        // =====================================================

        $files = $this->request
            ->getFileMultiple(
                'file_hasil'
            );


        if ($files === null) {

            $files = [];
        }


        if (!is_array($files)) {

            $files = [$files];
        }


        if (!empty($files)) {

            $uploadPath =
                FCPATH .
                'uploads/hasil/';


            // =================================================
            // BUAT FOLDER
            // =================================================

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }


            foreach ($files as $file) {

                // =============================================
                // FILE TIDAK VALID
                // =============================================

                if (
                    !$file ||
                    !$file->isValid() ||
                    $file->hasMoved()
                ) {

                    continue;
                }


                // =============================================
                // MAKSIMAL 5 MB
                // =============================================

                if (
                    $file->getSize()
                    > 5 * 1024 * 1024
                ) {

                    return redirect()
                        ->back()
                        ->with(
                            'error',

                            'File "' .
                            $file->getName() .
                            '" melebihi ukuran maksimal 5 MB.'
                        );
                }


                // =============================================
                // EKSTENSI
                // =============================================

                $extension = strtolower(
                    $file->getClientExtension()
                );


                $allowedExtensions = [

                    'pdf',

                    'jpg',

                    'jpeg',

                    'png',

                ];


                if (!in_array(
                    $extension,
                    $allowedExtensions,
                    true
                )) {

                    return redirect()
                        ->back()
                        ->with(
                            'error',

                            'Format file "' .
                            $file->getName() .
                            '" tidak diperbolehkan.'
                        );
                }


                // =============================================
                // NAMA FILE
                // =============================================

                $newName =
                    $file->getRandomName();


                // =============================================
                // PINDAHKAN FILE
                // =============================================

                if (
                    $file->move(
                        $uploadPath,
                        $newName
                    )
                ) {

                    // =========================================
                    // SIMPAN DATABASE
                    // =========================================

                    $this->dokumenHasilModel
                        ->insert([

                            'penanganan_id' => $id,

                            'nama_file' => $newName,

                        ]);
                }
            }
        }


        // =====================================================
        // SELESAI
        // =====================================================

        return redirect()
            ->to(
                base_url(
                    'kemahasiswaan/detail/' .
                    $id
                )
            )
            ->with(
                'success',
                'Proses tiket berhasil disimpan.'
            );
    }


    // =========================================================
    // HAPUS DOKUMEN
    // =========================================================

    public function hapusDokumen($id)
    {
        $dokumen = $this->dokumenHasilModel
            ->find($id);


        if (!$dokumen) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumen tidak ditemukan.'
                );
        }


        // =====================================================
        // HAPUS FILE
        // =====================================================

        $filePath =
            FCPATH .
            'uploads/hasil/' .
            $dokumen['nama_file'];


        if (is_file($filePath)) {

            unlink($filePath);
        }


        // =====================================================
        // ID PENANGANAN
        // =====================================================

        $penangananId =
            $dokumen['penanganan_id'];


        // =====================================================
        // HAPUS DATABASE
        // =====================================================

        $this->dokumenHasilModel
            ->delete($id);


        return redirect()
            ->to(
                base_url(
                    'kemahasiswaan/proses/' .
                    $penangananId
                )
            )
            ->with(
                'success',
                'Dokumen berhasil dihapus.'
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
            trim(
                (string) (
                    $tiket['status']
                    ?? ''
                )
            )
        );


        if ($status !== 'selesai') {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket hanya bisa dikirim ke Petugas ULT setelah status Selesai.'
                );
        }


        // =====================================================
        // KIRIM KE ULT
        // =====================================================

        $this->ticketModel
            ->update(
                $id,
                [

                    'status' => 'Diproses',

                    'processed_at' =>
                        date(
                            'Y-m-d H:i:s'
                        ),

                ]
            );


        return redirect()
            ->to(
                base_url(
                    'kemahasiswaan/detail/' .
                    $id
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
            trim(
                (string) (
                    $tiket['status']
                    ?? ''
                )
            )
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


        // =====================================================
        // UPDATE SELESAI
        // =====================================================

        $this->ticketModel
            ->update(
                $id,
                [

                    'status' => 'Selesai',

                    'completed_at' =>
                        date(
                            'Y-m-d H:i:s'
                        ),

                ]
            );


        return redirect()
            ->to(
                base_url(
                    'kemahasiswaan/detail/' .
                    $id
                )
            )
            ->with(
                'success',
                'Tiket berhasil dikirim ke pemohon.'
            );
    }
}