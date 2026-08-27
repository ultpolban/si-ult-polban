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
    // HELPER STATUS
    // =========================================================

    private function statusTampilan($status)
    {
        $status = strtolower(trim((string) $status));

        $mapping = [

            // MENUNGGU
            'draft'        => 'Menunggu',
            'submitted'    => 'Menunggu',
            'menunggu'     => 'Menunggu',

            // DIPROSES
            'verification' => 'Diproses',
            'processing'   => 'Diproses',
            'in_progress'  => 'Diproses',
            'diproses'     => 'Diproses',

            // SELESAI
            'completed'    => 'Selesai',
            'complete'     => 'Selesai',
            'selesai'      => 'Selesai',

            // DITOLAK
            'rejected'     => 'Ditolak',
            'ditolak'      => 'Ditolak',

            // DIBATALKAN
            'cancelled'    => 'Dibatalkan',
            'canceled'     => 'Dibatalkan',
            'dibatalkan'   => 'Dibatalkan',

            // REVISI
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
    // DASHBOARD
    // =========================================================

    public function dashboard()
    {
        $tickets = $this->ticketModel
            ->orderBy('id', 'DESC')
            ->findAll();

        $menunggu   = 0;
        $diproses   = 0;
        $selesai    = 0;
        $ditolak    = 0;
        $dibatalkan = 0;

        foreach ($tickets as &$ticket) {

            // =================================================
            // SIMPAN STATUS ASLI DATABASE
            // =================================================

            $statusAsli = strtolower(
                trim(
                    (string) ($ticket['status'] ?? '')
                )
            );

            $ticket['status_asli'] = $statusAsli;


            // =================================================
            // TERJEMAHKAN STATUS KE BAHASA INDONESIA
            // =================================================

            $statusIndonesia =
                $this->statusTampilan($statusAsli);

            $ticket['status_tampilan'] =
                $statusIndonesia;


            // =================================================
            // INI YANG PENTING
            //
            // Status yang dikirim ke dashboard sekarang
            // sudah Bahasa Indonesia.
            //
            // completed  -> Selesai
            // processing -> Diproses
            // submitted  -> Menunggu
            // =================================================

            $ticket['status'] =
                $statusIndonesia;


            // =================================================
            // HITUNG STATUS
            // MENGGUNAKAN STATUS ASLI DATABASE
            // =================================================

            switch ($statusAsli) {

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


        // =====================================================
        // DATA DASHBOARD
        // =====================================================

        $data = [

            'title' =>
                'Dashboard Kemahasiswaan',

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
            'kemahasiswaan/dashboard',
            $data
        );
    }


    // =========================================================
    // PROFILE
    // =========================================================

    public function profile()
    {
        $session = session();

        $data = [

            'title' =>
                'Profil Petugas Kemahasiswaan',

            'name' =>
                $session->get('name')
                ?: 'Siti Nurhaliza',

            'nip' =>
                $session->get('nip')
                ?: '199001182024012003',

            'email' =>
                $session->get('email')
                ?: 'siti.nurhaliza@polban.ac.id',

            'no_hp' =>
                $session->get('no_hp')
                ?: '081376543210',

            'jabatan' =>
                $session->get('jabatan')
                ?: 'Petugas Unit Layanan',
        ];

        return view(
            'kemahasiswaan/profile',
            $data
        );
    }


    // =========================================================
    // EDIT PROFILE
    // =========================================================

    public function editProfil()
    {
        $session = session();

        $data = [

            'title' =>
                'Edit Profil Petugas Kemahasiswaan',

            'name' =>
                $session->get('name')
                ?: 'Siti Nurhaliza',

            'nip' =>
                $session->get('nip')
                ?: '199001182024012003',

            'email' =>
                $session->get('email')
                ?: 'siti.nurhaliza@polban.ac.id',

            'no_hp' =>
                $session->get('no_hp')
                ?: '081376543210',

            'jabatan' =>
                $session->get('jabatan')
                ?: 'Petugas Unit Layanan',
        ];

        return view(
            'kemahasiswaan/edit-profil',
            $data
        );
    }


    // =========================================================
    // UPDATE PROFILE
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


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

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
        $tiket = $this->ticketModel

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
            )

            ->where(
                'tickets.id',
                $id
            )

            ->first();


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
        // STATUS
        // =====================================================

        $statusAsli =
            $tiket['status'] ?? '';

        $tiket['status_asli'] =
            $statusAsli;

        $tiket['status_tampilan'] =
            $this->statusTampilan(
                $statusAsli
            );


        // =====================================================
        // DOKUMEN HASIL
        // =====================================================

        $dokumenHasil =
            $this->dokumenHasilModel
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

            $tiket['deskripsi'] = '-';
        }


        // =====================================================
        // CATATAN
        // =====================================================

        if (
            !isset($tiket['admin_note']) ||
            $tiket['admin_note'] === null
        ) {

            $tiket['admin_note'] = '';
        }


        if (
            !isset($tiket['catatan']) ||
            $tiket['catatan'] === null
        ) {

            $tiket['catatan'] =
                $tiket['admin_note'];
        }


        return view(
            'kemahasiswaan/detail',
            [
                'title' =>
                    'Detail Tiket Kemahasiswaan',

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
        $tiket = $this->ticketModel

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
            )

            ->where(
                'tickets.id',
                $id
            )

            ->first();


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
        // STATUS
        // =====================================================

        $statusAsli =
            $tiket['status'] ?? '';

        $tiket['status_asli'] =
            $statusAsli;

        $tiket['status_tampilan'] =
            $this->statusTampilan(
                $statusAsli
            );


        // =====================================================
        // DOKUMEN HASIL
        // =====================================================

        $dokumenHasil =
            $this->dokumenHasilModel
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

            $tiket['deskripsi'] = '-';
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
            'kemahasiswaan/proses',
            [
                'title' =>
                    'Proses Tiket Kemahasiswaan',

                'tiket' =>
                    $tiket,
            ]
        );
    }


    // =========================================================
    // UPDATE PROSES TIKET
    // =========================================================

    public function updateProses($id)
    {
        $db = \Config\Database::connect();


        // =====================================================
        // CARI TIKET
        // =====================================================

        $tiket = $db
            ->table('tickets')
            ->where('id', $id)
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


        // =====================================================
        // AMBIL FORM
        // =====================================================

        $statusForm = strtolower(
            trim(
                (string) $this->request->getPost('status')
            )
        );


        $catatan = trim(
            (string) $this->request->getPost('catatan')
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

            'admin_note' =>
                $catatan,
        ];


        $now =
            date('Y-m-d H:i:s');


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
        // UPDATE DATABASE
        // =====================================================

        try {

            $builder =
                $db->table('tickets');


            $builder
                ->where(
                    'id',
                    $id
                )
                ->update(
                    $updateData
                );


            $error =
                $db->error();


            if (!empty($error['code'])) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Database gagal memperbarui status: ' .
                        ($error['message'] ?? 'Unknown error')
                    );
            }

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
        // CEK DATABASE
        // =====================================================

        $cekTiket =
            $db
                ->table('tickets')
                ->select(
                    'id, status, admin_note'
                )
                ->where(
                    'id',
                    $id
                )
                ->get()
                ->getRowArray();


        if (!$cekTiket) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Tiket tidak ditemukan setelah update.'
                );
        }


        $statusSekarang =
            strtolower(
                trim(
                    (string) (
                        $cekTiket['status'] ?? ''
                    )
                )
            );


        $statusTarget =
            strtolower(
                trim(
                    $statusDatabase
                )
            );


        if (
            $statusSekarang
            !==
            $statusTarget
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Status gagal disimpan. Database berisi: ' .
                    ($cekTiket['status'] ?? '')
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


                // =================================================
                // MAKSIMAL 5 MB
                // =================================================

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


                // =================================================
                // EXTENSION
                // =================================================

                $extension =
                    strtolower(
                        $file->getClientExtension()
                    );


                $allowedExtensions = [

                    'pdf',
                    'jpg',
                    'jpeg',
                    'png',

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


                // =================================================
                // NAMA FILE
                // =================================================

                $newName =
                    $file->getRandomName();


                // =================================================
                // PINDAHKAN FILE
                // =================================================

                if (
                    $file->move(
                        $uploadPath,
                        $newName
                    )
                ) {

                    $this->dokumenHasilModel
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


        // =====================================================
        // REDIRECT DETAIL
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
                'Proses tiket berhasil disimpan. Status tiket sekarang: ' .
                $this->statusTampilan(
                    $statusDatabase
                )
            );
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


        $penangananId =
            $dokumen['penanganan_id'];


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
        $db =
            \Config\Database::connect();


        $tiket =
            $db
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


        // =====================================================
        // STATUS ASLI DATABASE
        // =====================================================

        $statusSekarang =
            strtolower(
                trim(
                    (string) (
                        $tiket['status'] ?? ''
                    )
                )
            );


        // =====================================================
        // HANYA DARI SELESAI
        // =====================================================

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


        // =====================================================
        // CARI STATUS DIPROSES
        // =====================================================

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
        $db =
            \Config\Database::connect();


        $tiket =
            $db
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


        // =====================================================
        // STATUS ASLI DATABASE
        // =====================================================

        $statusSekarang =
            strtolower(
                trim(
                    (string) (
                        $tiket['status'] ?? ''
                    )
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


        // =====================================================
        // CARI STATUS SELESAI
        // =====================================================

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