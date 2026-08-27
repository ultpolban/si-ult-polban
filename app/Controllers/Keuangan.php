<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TicketModel;
use App\Models\DokumenHasilModel;

class Keuangan extends BaseController
{
    protected $ticketModel;
    protected $dokumenHasilModel;

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
    // HELPER STATUS
    // =========================================================

    private function statusTampilan($status)
    {
        $status = strtolower(trim((string) $status));

        $mapping = [
            'draft'        => 'Menunggu',
            'submitted'    => 'Menunggu',
            'menunggu'     => 'Menunggu',

            'verification' => 'Diproses',
            'processing'   => 'Diproses',
            'in_progress'  => 'Diproses',
            'diproses'     => 'Diproses',

            'completed'    => 'Selesai',
            'complete'     => 'Selesai',
            'selesai'      => 'Selesai',

            'rejected'     => 'Ditolak',
            'ditolak'      => 'Ditolak',

            'cancelled'    => 'Dibatalkan',
            'canceled'     => 'Dibatalkan',
            'dibatalkan'   => 'Dibatalkan',

            'revision'     => 'Revisi',
            'revisi'       => 'Revisi',
        ];

        return $mapping[$status] ?? ucfirst($status);
    }


    // =========================================================
    // CARI STATUS ENUM DATABASE
    // =========================================================

    private function cariStatusDatabase(array $candidates)
    {
        $db = \Config\Database::connect();

        $result = $db
            ->query("SHOW COLUMNS FROM tickets LIKE 'status'")
            ->getRowArray();

        if (!$result) {
            return null;
        }

        $columnType = $result['Type'] ?? '';

        $enumValues = [];

        if (
            preg_match(
                "/^enum\\((.*)\\)$/i",
                $columnType,
                $matches
            )
        ) {
            preg_match_all(
                "/'((?:[^'\\\\]|\\\\.)*)'/",
                $matches[1],
                $enumMatches
            );

            if (!empty($enumMatches[1])) {

                foreach ($enumMatches[1] as $value) {
                    $enumValues[] = stripslashes($value);
                }
            }
        }

        foreach ($candidates as $candidate) {

            foreach ($enumValues as $enumValue) {

                if (
                    strtolower(trim($enumValue))
                    ===
                    strtolower(trim($candidate))
                ) {
                    return $enumValue;
                }
            }
        }

        return null;
    }


    // =========================================================
    // QUERY TIKET LENGKAP
    // =========================================================

    private function queryTiket()
    {
        return $this->ticketModel
            ->select(
                'tickets.*,
                 tickets.ticket_number AS no_tiket,
                 tickets.title AS judul,
                 tickets.description AS deskripsi,
                 master_services.name AS nama_layanan,
                 master_service_categories.name AS nama_kategori,
                 master_service_units.name AS nama_unit'
            )

            ->join(
                'master_services',
                'master_services.id = tickets.service_id',
                'left'
            )

            ->join(
                'master_service_categories',
                'master_service_categories.id = master_services.service_category_id',
                'left'
            )

            ->join(
                'master_service_units',
                'master_service_units.id = master_services.service_unit_id',
                'left'
            );
    }


    // =========================================================
    // DASHBOARD
    // =========================================================

    public function dashboard()
    {
        $tickets = $this
            ->queryTiket()
            ->orderBy('tickets.id', 'DESC')
            ->findAll();

        $menunggu   = 0;
        $diproses   = 0;
        $selesai    = 0;
        $ditolak    = 0;
        $dibatalkan = 0;

        foreach ($tickets as &$ticket) {

            $statusDatabase = strtolower(
                trim(
                    (string) ($ticket['status'] ?? '')
                )
            );

            // Status yang ditampilkan di dashboard
            $ticket['status_tampilan'] =
                $this->statusTampilan(
                    $statusDatabase
                );

            // =================================================
            // DATA TAMBAHAN AGAR TABEL TIDAK KOSONG
            // =================================================

            if (
                empty($ticket['nama_pemohon']) &&
                !empty($ticket['applicant_name'])
            ) {
                $ticket['nama_pemohon'] =
                    $ticket['applicant_name'];
            }

            if (
                empty($ticket['nim']) &&
                !empty($ticket['nik'])
            ) {
                $ticket['nim'] =
                    $ticket['nik'];
            }

            if (
                empty($ticket['created_at']) &&
                !empty($ticket['tanggal'])
            ) {
                $ticket['created_at'] =
                    $ticket['tanggal'];
            }


            // =================================================
            // HITUNG STATUS
            // =================================================

            switch ($statusDatabase) {

                case 'draft':
                case 'submitted':
                case 'menunggu':

                    $menunggu++;
                    break;


                case 'verification':
                case 'processing':
                case 'in_progress':
                case 'diproses':

                    $diproses++;
                    break;


                case 'completed':
                case 'complete':
                case 'selesai':

                    $selesai++;
                    break;


                case 'rejected':
                case 'ditolak':

                    $ditolak++;
                    break;


                case 'cancelled':
                case 'canceled':
                case 'dibatalkan':

                    $dibatalkan++;
                    break;
            }
        }

        unset($ticket);


        $data = [

            'title' =>
                'Dashboard Keuangan',

            'total' =>
                count($tickets),

            'menunggu' =>
                $menunggu,

            'diproses' =>
                $diproses,

            'selesai' =>
                $selesai,

            'ditolak' =>
                $ditolak,

            'dibatalkan' =>
                $dibatalkan,

            'tiket' =>
                $tickets,
        ];


        return view(
            'keuangan/dashboard',
            $data
        );
    }


    // =========================================================
    // PROFIL
    // =========================================================

    public function profil()
    {
        $session = session();

        $data = [

            'title' =>
                'Profil Petugas Keuangan',

            'name' =>
                $session->get('name')
                ?: 'Andi Pratama',

            'nip' =>
                $session->get('nip')
                ?: '198705152024011001',

            'email' =>
                $session->get('email')
                ?: 'andi.pratama@polban.ac.id',

            'no_hp' =>
                $session->get('no_hp')
                ?: '081234567890',

            'jabatan' =>
                $session->get('jabatan')
                ?: 'Petugas Unit Layanan',
        ];

        return view(
            'keuangan/profil',
            $data
        );
    }


    // =========================================================
    // PROFILE ALIAS
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


        if ($name === '') {

            return redirect()
                ->to(base_url('keuangan/profile'))
                ->withInput()
                ->with(
                    'error',
                    'Nama Lengkap wajib diisi.'
                );
        }


        if ($nip === '') {

            return redirect()
                ->to(base_url('keuangan/profile'))
                ->withInput()
                ->with(
                    'error',
                    'NIP wajib diisi.'
                );
        }


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


        $session->set([

            'name' =>
                $name,

            'nip' =>
                $nip,

            'email' =>
                $email,

            'no_hp' =>
                $no_hp,

            'jabatan' =>
                $jabatan,
        ]);


        return redirect()
            ->to(base_url('keuangan/profile'))
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }


    // =========================================================
    // UPDATE PROFILE ALIAS
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
        $tiket = $this
            ->queryTiket()
            ->where(
                'tickets.id',
                $id
            )
            ->first();


        if (!$tiket) {

            return redirect()
                ->to(
                    base_url(
                        'keuangan/dashboard'
                    )
                )
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }


        // =====================================================
        // STATUS
        // =====================================================

        $tiket['status_tampilan'] =
            $this->statusTampilan(
                $tiket['status'] ?? ''
            );


        // =====================================================
        // DOKUMEN HASIL
        // =====================================================

        $dokumenHasil = $this
            ->dokumenHasilModel
            ->where(
                'penanganan_id',
                $id
            )
            ->findAll();


        if (!is_array($dokumenHasil)) {
            $dokumenHasil = [];
        }


        $tiket['dokumen_hasil'] =
            $dokumenHasil;


        // =====================================================
        // DESKRIPSI
        // =====================================================

        if (
            !isset($tiket['deskripsi']) ||
            $tiket['deskripsi'] === null ||
            $tiket['deskripsi'] === ''
        ) {

            $tiket['deskripsi'] =
                '-';
        }


        // =====================================================
        // CATATAN
        // =====================================================

        if (
            !isset($tiket['catatan']) ||
            $tiket['catatan'] === null
        ) {

            $tiket['catatan'] =
                $tiket['admin_note'] ?? '';
        }


        return view(
            'keuangan/detail',
            [
                'title' =>
                    'Detail Tiket Keuangan',

                'tiket' =>
                    $tiket,
            ]
        );
    }


    // =========================================================
    // PROSES TIKET
    // =========================================================

    public function proses($id)
    {
        $tiket = $this
            ->queryTiket()
            ->where(
                'tickets.id',
                $id
            )
            ->first();


        if (!$tiket) {

            return redirect()
                ->to(
                    base_url(
                        'keuangan/dashboard'
                    )
                )
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }


        $tiket['status_tampilan'] =
            $this->statusTampilan(
                $tiket['status'] ?? ''
            );


        $dokumenHasil = $this
            ->dokumenHasilModel
            ->where(
                'penanganan_id',
                $id
            )
            ->findAll();


        if (!is_array($dokumenHasil)) {
            $dokumenHasil = [];
        }


        $tiket['dokumen_hasil'] =
            $dokumenHasil;


        if (
            empty($tiket['deskripsi'])
        ) {
            $tiket['deskripsi'] = '-';
        }


        if (
            !isset($tiket['catatan'])
        ) {
            $tiket['catatan'] =
                $tiket['admin_note'] ?? '';
        }


        return view(
            'keuangan/proses',
            [
                'title' =>
                    'Proses Tiket Keuangan',

                'tiket' =>
                    $tiket,
            ]
        );
    }


    // =========================================================
    // UPDATE PROSES
    // =========================================================

    public function updateProses($id)
    {
        $db = \Config\Database::connect();


        $tiket = $db
            ->table('tickets')
            ->where(
                'id',
                $id
            )
            ->get()
            ->getRowArray();


        if (!$tiket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }


        $statusForm = strtolower(
            trim(
                (string)
                $this->request->getPost('status')
            )
        );


        $catatan = trim(
            (string)
            $this->request->getPost('catatan')
        );


        // =====================================================
        // MAPPING STATUS
        // =====================================================

        $mapping = [

            'menunggu' => [
                'submitted',
                'menunggu',
                'draft'
            ],

            'diproses' => [
                'processing',
                'verification',
                'in_progress',
                'diproses'
            ],

            'selesai' => [
                'completed',
                'complete',
                'selesai'
            ],

            'ditolak' => [
                'rejected',
                'ditolak'
            ],

            'dibatalkan' => [
                'cancelled',
                'canceled',
                'dibatalkan'
            ],
        ];


        if (!isset($mapping[$statusForm])) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Status tiket tidak valid.'
                );
        }


        // =====================================================
        // CARI ENUM DATABASE
        // =====================================================

        $statusDatabase =
            $this->cariStatusDatabase(
                $mapping[$statusForm]
            );


        if ($statusDatabase === null) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Status "' .
                    $statusForm .
                    '" tidak tersedia pada ENUM database.'
                );
        }


        // =====================================================
        // DATA UPDATE
        // =====================================================

        $updateData = [

            'status' =>
                $statusDatabase,
        ];


        if ($catatan !== '') {

            $updateData['admin_note'] =
                $catatan;
        }


        $now = date(
            'Y-m-d H:i:s'
        );


        switch ($statusForm) {

            case 'diproses':

                $updateData['processed_at'] =
                    $now;

                break;


            case 'selesai':

                $updateData['completed_at'] =
                    $now;

                break;


            case 'ditolak':

                $updateData['rejected_at'] =
                    $now;

                break;


            case 'dibatalkan':

                $updateData['cancelled_at'] =
                    $now;

                break;
        }


        // =====================================================
        // UPDATE
        // =====================================================

        try {

            $db
                ->table('tickets')
                ->where(
                    'id',
                    $id
                )
                ->update(
                    $updateData
                );

        } catch (\Throwable $e) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Gagal menyimpan status: ' .
                    $e->getMessage()
                );
        }


        // =====================================================
        // UPLOAD DOKUMEN HASIL
        // =====================================================

        $files =
            $this->request
                ->getFileMultiple(
                    'file_hasil'
                );


        if (!is_array($files)) {
            $files = [];
        }


        if (!empty($files)) {

            $uploadPath =
                FCPATH .
                'uploads/hasil/';


            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }


            foreach ($files as $file) {

                if (
                    !$file ||
                    !$file->isValid() ||
                    $file->hasMoved()
                ) {
                    continue;
                }


                if (
                    $file->getSize()
                    >
                    5 * 1024 * 1024
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


                $extension =
                    strtolower(
                        $file->getClientExtension()
                    );


                $allowedExtensions = [
                    'pdf',
                    'jpg',
                    'jpeg',
                    'png'
                ];


                if (
                    !in_array(
                        $extension,
                        $allowedExtensions,
                        true
                    )
                ) {

                    return redirect()
                        ->back()
                        ->with(
                            'error',
                            'Format file "' .
                            $file->getName() .
                            '" tidak diperbolehkan.'
                        );
                }


                $newName =
                    $file->getRandomName();


                if (
                    $file->move(
                        $uploadPath,
                        $newName
                    )
                ) {

                    $this
                        ->dokumenHasilModel
                        ->insert([

                            'penanganan_id' =>
                                $id,

                            'nama_file' =>
                                $newName,

                            'nama_asli' =>
                                $file->getClientName(),

                            'ukuran_file' =>
                                $file->getSize(),

                            'tipe_file' =>
                                $file->getClientMimeType(),

                            'created_at' =>
                                date(
                                    'Y-m-d H:i:s'
                                ),

                            'updated_at' =>
                                date(
                                    'Y-m-d H:i:s'
                                ),
                        ]);
                }
            }
        }


        return redirect()
            ->to(
                base_url(
                    'keuangan/detail/' .
                    $id
                )
            )
            ->with(
                'success',
                'Proses tiket berhasil disimpan. Status tiket sekarang: ' .
                $this->statusTampilan(
                    $statusDatabase
                )
            );
    }


    // =========================================================
    // KIRIM KE PETUGAS ULT
    // =========================================================

    public function kirim($id)
    {
        $db = \Config\Database::connect();


        $tiket = $db
            ->table('tickets')
            ->where(
                'id',
                $id
            )
            ->get()
            ->getRowArray();


        if (!$tiket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }


        $statusSekarang =
            strtolower(
                trim(
                    (string)
                    ($tiket['status'] ?? '')
                )
            );


        if (
            !in_array(
                $statusSekarang,
                [
                    'completed',
                    'complete',
                    'selesai'
                ],
                true
            )
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket hanya bisa dikirim ke Petugas ULT setelah status Selesai.'
                );
        }


        $statusDiproses =
            $this->cariStatusDatabase([
                'processing',
                'verification',
                'in_progress',
                'diproses'
            ]);


        if ($statusDiproses === null) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Status Diproses tidak tersedia pada ENUM database.'
                );
        }


        $db
            ->table('tickets')
            ->where(
                'id',
                $id
            )
            ->update([

                'status' =>
                    $statusDiproses,

                'processed_at' =>
                    date(
                        'Y-m-d H:i:s'
                    ),
            ]);


        return redirect()
            ->to(
                base_url(
                    'keuangan/detail/' .
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
        $db = \Config\Database::connect();


        $tiket = $db
            ->table('tickets')
            ->where(
                'id',
                $id
            )
            ->get()
            ->getRowArray();


        if (!$tiket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }


        $statusSekarang =
            strtolower(
                trim(
                    (string)
                    ($tiket['status'] ?? '')
                )
            );


        if (
            !in_array(
                $statusSekarang,
                [
                    'completed',
                    'complete',
                    'selesai',
                    'processing',
                    'verification',
                    'in_progress',
                    'diproses'
                ],
                true
            )
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket belum dapat dikirim ke pemohon.'
                );
        }


        $statusSelesai =
            $this->cariStatusDatabase([
                'completed',
                'complete',
                'selesai'
            ]);


        if ($statusSelesai === null) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Status Selesai tidak tersedia pada ENUM database.'
                );
        }


        $db
            ->table('tickets')
            ->where(
                'id',
                $id
            )
            ->update([

                'status' =>
                    $statusSelesai,

                'completed_at' =>
                    date(
                        'Y-m-d H:i:s'
                    ),
            ]);


        return redirect()
            ->to(
                base_url(
                    'keuangan/detail/' .
                    $id
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
        return $this->dashboard();
    }


    // =========================================================
    // HAPUS DOKUMEN
    // =========================================================

    public function hapusDokumen($id)
    {
        $dokumen =
            $this->dokumenHasilModel
                ->find($id);


        if (!$dokumen) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumen tidak ditemukan.'
                );
        }


        $filePath =
            FCPATH .
            'uploads/hasil/' .
            $dokumen['nama_file'];


        if (is_file($filePath)) {
            unlink($filePath);
        }


        $this
            ->dokumenHasilModel
            ->delete($id);


        return redirect()
            ->back()
            ->with(
                'success',
                'Dokumen berhasil dihapus.'
            );
    }
}