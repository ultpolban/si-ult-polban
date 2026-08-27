<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UnitLayanan extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    /**
     * =========================================================
     * CEK APAKAH TABEL ADA
     * =========================================================
     */
    private function tableExists(string $table): bool
    {
        return $this->db->tableExists($table);
    }

    /**
     * =========================================================
     * AMBIL DATA TIKET
     * =========================================================
     */
    private function getTicket($id)
    {
        /*
         * Gunakan tickets terlebih dahulu.
         * JOIN services hanya dilakukan jika tabelnya memang ada.
         */

        $builder = $this->db
            ->table('tickets t')
            ->select('t.*');

        /*
         * =====================================================
         * JOIN SERVICES
         * =====================================================
         */
        if ($this->tableExists('services')) {

            $builder
                ->select('s.name AS service_name')
                ->join(
                    'services s',
                    's.id = t.service_id',
                    'left'
                );

            /*
             * =================================================
             * JOIN SERVICE CATEGORIES
             * =================================================
             */
            if ($this->tableExists('service_categories')) {

                $builder
                    ->select('sc.name AS category_name')
                    ->join(
                        'service_categories sc',
                        'sc.id = s.category_id',
                        'left'
                    );

                /*
                 * =============================================
                 * JOIN SERVICE UNITS
                 * =============================================
                 */
                if ($this->tableExists('service_units')) {

                    $builder
                        ->select('su.name AS unit_name')
                        ->join(
                            'service_units su',
                            'su.id = sc.service_unit_id',
                            'left'
                        );
                }
            }
        }

        return $builder
            ->where('t.id', $id)
            ->get()
            ->getRowArray();
    }

    /**
     * =========================================================
     * AMBIL SEMUA TIKET
     * =========================================================
     */
    private function getAllTickets()
    {
        $builder = $this->db
            ->table('tickets t')
            ->select('t.*');

        /*
         * JOIN SERVICES JIKA ADA
         */
        if ($this->tableExists('services')) {

            $builder
                ->select('s.name AS service_name')
                ->join(
                    'services s',
                    's.id = t.service_id',
                    'left'
                );

            /*
             * JOIN CATEGORY JIKA ADA
             */
            if ($this->tableExists('service_categories')) {

                $builder
                    ->select('sc.name AS category_name')
                    ->join(
                        'service_categories sc',
                        'sc.id = s.category_id',
                        'left'
                    );

                /*
                 * JOIN UNIT JIKA ADA
                 */
                if ($this->tableExists('service_units')) {

                    $builder
                        ->select('su.name AS unit_name')
                        ->join(
                            'service_units su',
                            'su.id = sc.service_unit_id',
                            'left'
                        );
                }
            }
        }

        return $builder
            ->orderBy('t.id', 'DESC')
            ->get()
            ->getResultArray();
    }

    /**
     * =========================================================
     * AMBIL 2 TIKET TERBARU BERDASARKAN UNIT
     * =========================================================
     */
    private function getLatestTickets($namaUnit = null)
    {
        $builder = $this->db
            ->table('tickets t')
            ->select('t.*');

        /*
         * =====================================================
         * JOIN SERVICES JIKA ADA
         * =====================================================
         */
        if ($this->tableExists('services')) {

            $builder
                ->select('s.name AS service_name')
                ->join(
                    'services s',
                    's.id = t.service_id',
                    'left'
                );

            /*
             * =================================================
             * JOIN CATEGORY JIKA ADA
             * =================================================
             */
            if ($this->tableExists('service_categories')) {

                $builder
                    ->select('sc.name AS category_name')
                    ->join(
                        'service_categories sc',
                        'sc.id = s.category_id',
                        'left'
                    );

                /*
                 * =================================================
                 * JOIN UNIT JIKA ADA
                 * =================================================
                 */
                if ($this->tableExists('service_units')) {

                    $builder
                        ->select('su.name AS unit_name')
                        ->join(
                            'service_units su',
                            'su.id = sc.service_unit_id',
                            'left'
                        );

                    /*
                     * FILTER UNIT
                     */
                    if ($namaUnit !== null) {

                        $builder->where(
                            'su.name',
                            $namaUnit
                        );
                    }
                }
            }
        }

        /*
         * =====================================================
         * HANYA 2 TIKET TERBARU
         * =====================================================
         */
        return $builder
            ->orderBy('t.id', 'DESC')
            ->limit(2)
            ->get()
            ->getResultArray();
    }

    /**
     * =========================================================
     * FORMAT STATUS
     * =========================================================
     */
    private function formatStatus($status)
    {
        $status = strtolower(
            trim((string) $status)
        );

        $statusMap = [

            'draft' =>
                'Draft',

            'submitted' =>
                'Menunggu',

            'verification' =>
                'Verifikasi',

            'revision' =>
                'Revisi',

            'processing' =>
                'Diproses',

            'completed' =>
                'Selesai',

            'rejected' =>
                'Ditolak',

            'cancelled' =>
                'Dibatalkan',
        ];

        return $statusMap[$status]
            ?? ucfirst($status);
    }

    /**
     * =========================================================
     * FORMAT DATA TIKET UNTUK VIEW
     * =========================================================
     */
    private function formatTicket(array $ticket): array
    {
        return [

            'id' =>
                $ticket['id']
                ?? null,

            'no_tiket' =>
                $ticket['ticket_number']
                ?? 'TKT-' . ($ticket['id'] ?? ''),

            'ticket_number' =>
                $ticket['ticket_number']
                ?? 'TKT-' . ($ticket['id'] ?? ''),

            'judul' =>
                $ticket['title']
                ?? 'Permohonan Layanan',

            'title' =>
                $ticket['title']
                ?? 'Permohonan Layanan',

            'deskripsi' =>
                $ticket['description']
                ?? 'Tidak ada deskripsi tambahan.',

            'description' =>
                $ticket['description']
                ?? 'Tidak ada deskripsi tambahan.',

            /*
             * STATUS UNTUK TAMPILAN
             */
            'status' =>
                $this->formatStatus(
                    $ticket['status']
                    ?? 'submitted'
                ),

            /*
             * STATUS ASLI DATABASE
             */
            'status_database' =>
                $ticket['status']
                ?? 'submitted',

            'priority' =>
                $ticket['priority']
                ?? 'normal',

            'user_profile_id' =>
                $ticket['user_profile_id']
                ?? null,

            'service_id' =>
                $ticket['service_id']
                ?? null,

            'assigned_to' =>
                $ticket['assigned_to']
                ?? null,

            'created_at' =>
                $ticket['created_at']
                ?? $ticket['submitted_at']
                ?? null,

            'updated_at' =>
                $ticket['updated_at']
                ?? null,

            'submitted_at' =>
                $ticket['submitted_at']
                ?? null,

            'verified_at' =>
                $ticket['verified_at']
                ?? null,

            'processed_at' =>
                $ticket['processed_at']
                ?? null,

            'completed_at' =>
                $ticket['completed_at']
                ?? null,

            'rejected_at' =>
                $ticket['rejected_at']
                ?? null,

            'cancelled_at' =>
                $ticket['cancelled_at']
                ?? null,

            'admin_note' =>
                $ticket['admin_note']
                ?? '',

            'catatan' =>
                $ticket['admin_note']
                ?? '',

            /*
             * DATA LAYANAN
             */
            'nama_layanan' =>
                $ticket['service_name']
                ?? 'Layanan',

            'nama_kategori' =>
                $ticket['category_name']
                ?? 'Layanan ULT',

            'nama_unit' =>
                $ticket['unit_name']
                ?? 'Unit Layanan',

            /*
             * PEMOHON
             */
            'nama_pemohon' =>
                $ticket['user_name']
                ?? $ticket['nama_pemohon']
                ?? 'Pemohon',

            'nim' =>
                $ticket['nim']
                ?? '-',

            /*
             * DOKUMEN
             */
            'dokumen_hasil' =>
                [],
        ];
    }

    /**
     * =========================================================
     * INDEX
     * =========================================================
     */
    public function index()
    {
        $tickets =
            $this->getAllTickets();

        $dataTiket = [];

        foreach ($tickets as $ticket) {

            $dataTiket[] =
                $this->formatTicket(
                    $ticket
                );
        }

        return view(
            'unit_layanan/index',
            [
                'title' =>
                    'Dashboard Unit Layanan',

                'tiket' =>
                    $dataTiket,
            ]
        );
    }

    /**
     * =========================================================
     * DETAIL TIKET
     * =========================================================
     */
    public function detail($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->to(
                    base_url(
                        'unit-layanan/dashboard'
                    )
                )
                ->with(
                    'error',
                    'Data tiket tidak ditemukan'
                );
        }

        $tiket =
            $this->formatTicket(
                $ticket
            );

        return view(
            'unit_layanan/detail',
            [
                'title' =>
                    'Detail Tiket',

                'tiket' =>
                    $tiket,
            ]
        );
    }

    /**
     * =========================================================
     * PROSES TIKET
     * =========================================================
     */
    public function proses($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->to(
                    base_url(
                        'unit-layanan/dashboard'
                    )
                )
                ->with(
                    'error',
                    'Data tiket tidak ditemukan'
                );
        }

        $tiket =
            $this->formatTicket(
                $ticket
            );

        return view(
            'unit_layanan/proses',
            [
                'title' =>
                    'Proses Tiket',

                'tiket' =>
                    $tiket,
            ]
        );
    }

    /**
     * =========================================================
     * UPDATE PROSES TIKET
     * =========================================================
     */
    public function updateProses($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan'
                );
        }

        $statusInput =
            trim(
                (string)
                $this->request
                    ->getPost('status')
            );

        $catatan =
            trim(
                (string)
                $this->request
                    ->getPost('catatan')
            );

        if ($statusInput === '') {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Status tiket wajib dipilih.'
                );
        }

        /**
         * =====================================================
         * KONVERSI STATUS FORM
         * =====================================================
         */
        $statusMap = [

            'menunggu' =>
                'submitted',

            'submitted' =>
                'submitted',

            'diproses' =>
                'processing',

            'processing' =>
                'processing',

            'selesai' =>
                'completed',

            'completed' =>
                'completed',

            'ditolak' =>
                'rejected',

            'rejected' =>
                'rejected',

            'draft' =>
                'draft',

            'verification' =>
                'verification',

            'revision' =>
                'revision',

            'cancelled' =>
                'cancelled',

            'dibatalkan' =>
                'cancelled',
        ];

        $statusKey =
            strtolower(
                $statusInput
            );

        if (
            !isset(
                $statusMap[$statusKey]
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Status tiket tidak valid.'
                );
        }

        $status =
            $statusMap[$statusKey];

        /**
         * =====================================================
         * DATA UPDATE
         * =====================================================
         */
        $data = [

            'status' =>
                $status,

            'admin_note' =>
                $catatan,

            'updated_at' =>
                date(
                    'Y-m-d H:i:s'
                ),
        ];

        /**
         * =====================================================
         * TIMESTAMP STATUS
         * =====================================================
         */
        if ($status === 'processing') {

            $data['processed_at'] =
                date(
                    'Y-m-d H:i:s'
                );
        }

        if ($status === 'completed') {

            $data['completed_at'] =
                date(
                    'Y-m-d H:i:s'
                );
        }

        if ($status === 'rejected') {

            $data['rejected_at'] =
                date(
                    'Y-m-d H:i:s'
                );

            $data['rejection_reason'] =
                $catatan;
        }

        /**
         * =====================================================
         * UPDATE DATABASE
         * =====================================================
         */
        $this->db
            ->table('tickets')
            ->where(
                'id',
                $id
            )
            ->update($data);

        return redirect()
            ->to(
                base_url(
                    'unit-layanan/detail/' . $id
                )
            )
            ->with(
                'success',
                'Tiket berhasil diperbarui.'
            );
    }

    /**
     * =========================================================
     * DASHBOARD UTAMA
     * =========================================================
     */
    public function dashboard()
    {
        /**
         * =====================================================
         * JUMLAH MENUNGGU
         * =====================================================
         */
        $menunggu =
            $this->db
                ->table('tickets')
                ->whereIn(
                    'status',
                    [
                        'submitted',
                        'verification',
                        'revision'
                    ]
                )
                ->countAllResults();

        /**
         * =====================================================
         * JUMLAH DIPROSES
         * =====================================================
         */
        $diproses =
            $this->db
                ->table('tickets')
                ->where(
                    'status',
                    'processing'
                )
                ->countAllResults();

        /**
         * =====================================================
         * JUMLAH SELESAI
         * =====================================================
         */
        $selesai =
            $this->db
                ->table('tickets')
                ->where(
                    'status',
                    'completed'
                )
                ->countAllResults();

        /**
         * =====================================================
         * TOTAL TIKET
         * =====================================================
         */
        $total =
            $this->db
                ->table('tickets')
                ->countAllResults();

        /**
         * =====================================================
         * AMBIL 2 TIKET TERBARU
         * =====================================================
         */
        $tickets =
            $this->getLatestTickets();

        $dataTiket = [];

        foreach ($tickets as $ticket) {

            $dataTiket[] =
                $this->formatTicket(
                    $ticket
                );
        }

        return view(
            'unit_layanan/dashboard',
            [

                'title' =>
                    'Dashboard Unit Layanan',

                'menunggu' =>
                    $menunggu,

                'diproses' =>
                    $diproses,

                'selesai' =>
                    $selesai,

                'total' =>
                    $total,

                'tiket' =>
                    $dataTiket,
            ]
        );
    }

    /**
     * =========================================================
     * DASHBOARD AKADEMIK
     * =========================================================
     */
    public function akademik()
    {
        return $this->dashboardUnit(
            'Akademik',
            'akademik/dashboard'
        );
    }

    /**
     * =========================================================
     * DASHBOARD KEUANGAN
     * =========================================================
     */
    public function keuangan()
    {
        return $this->dashboardUnit(
            'Keuangan',
            'keuangan/dashboard'
        );
    }

    /**
     * =========================================================
     * DASHBOARD KEMAHASISWAAN
     * =========================================================
     */
    public function kemahasiswaan()
    {
        return $this->dashboardUnit(
            'Kemahasiswaan',
            'kemahasiswaan/dashboard'
        );
    }

    /**
     * =========================================================
     * DASHBOARD BERDASARKAN UNIT
     * =========================================================
     */
    private function dashboardUnit(
        string $namaUnit,
        string $view
    ) {
        /**
         * =====================================================
         * AMBIL 2 TIKET UNIT
         * =====================================================
         */
        $tickets =
            $this->getLatestTickets(
                $namaUnit
            );

        $dataTiket = [];

        foreach ($tickets as $ticket) {

            $dataTiket[] =
                $this->formatTicket(
                    $ticket
                );
        }

        /**
         * =====================================================
         * DEFAULT STATISTIK
         * =====================================================
         */
        $menunggu = 0;
        $diproses = 0;
        $selesai = 0;
        $total = 0;

        /**
         * =====================================================
         * JIKA SERVICES DAN UNIT TERSEDIA
         * =====================================================
         */
        if (
            $this->tableExists('services') &&
            $this->tableExists('service_categories') &&
            $this->tableExists('service_units')
        ) {

            $builder =
                $this->db
                    ->table('tickets t')
                    ->join(
                        'services s',
                        's.id = t.service_id',
                        'left'
                    )
                    ->join(
                        'service_categories sc',
                        'sc.id = s.category_id',
                        'left'
                    )
                    ->join(
                        'service_units su',
                        'su.id = sc.service_unit_id',
                        'left'
                    )
                    ->where(
                        'su.name',
                        $namaUnit
                    );

            $menunggu =
                (clone $builder)
                    ->whereIn(
                        't.status',
                        [
                            'submitted',
                            'verification',
                            'revision'
                        ]
                    )
                    ->countAllResults();

            $diproses =
                (clone $builder)
                    ->where(
                        't.status',
                        'processing'
                    )
                    ->countAllResults();

            $selesai =
                (clone $builder)
                    ->where(
                        't.status',
                        'completed'
                    )
                    ->countAllResults();

            $total =
                (clone $builder)
                    ->countAllResults();
        }

        /**
         * =====================================================
         * JIKA TABEL UNIT BELUM ADA
         *
         * Statistik menggunakan semua tiket.
         * =====================================================
         */
        else {

            $menunggu =
                $this->db
                    ->table('tickets')
                    ->whereIn(
                        'status',
                        [
                            'submitted',
                            'verification',
                            'revision'
                        ]
                    )
                    ->countAllResults();

            $diproses =
                $this->db
                    ->table('tickets')
                    ->where(
                        'status',
                        'processing'
                    )
                    ->countAllResults();

            $selesai =
                $this->db
                    ->table('tickets')
                    ->where(
                        'status',
                        'completed'
                    )
                    ->countAllResults();

            $total =
                $this->db
                    ->table('tickets')
                    ->countAllResults();
        }

        return view(
            $view,
            [

                'title' =>
                    'Dashboard ' . $namaUnit,

                'nama_unit' =>
                    $namaUnit,

                'menunggu' =>
                    $menunggu,

                'diproses' =>
                    $diproses,

                'selesai' =>
                    $selesai,

                'total' =>
                    $total,

                'tiket' =>
                    $dataTiket,
            ]
        );
    }

    /**
     * =========================================================
     * PROFIL PETUGAS
     * =========================================================
     */
    public function profile()
    {
        $session =
            session();

        $data = [

            'title' =>
                'Profil Petugas Unit Layanan',

            'name' =>
                $session->get('name')
                ?: 'Budi Santoso',

            'nip' =>
                $session->get('nip')
                ?: '198603122024011002',

            'email' =>
                $session->get('email')
                ?: 'budi.santoso@polban.ac.id',

            'no_hp' =>
                $session->get('no_hp')
                ?: '081298765432',

            'jabatan' =>
                $session->get('jabatan')
                ?: 'Petugas Unit Layanan',
        ];

        return view(
            'unit_layanan/profile',
            $data
        );
    }

    /**
     * =========================================================
     * UPDATE PROFIL
     * =========================================================
     */
    public function updateProfile()
    {
        $session =
            session();

        $name =
            trim(
                (string)
                $this->request
                    ->getPost('name')
            );

        $nip =
            trim(
                (string)
                $this->request
                    ->getPost('nip')
            );

        $email =
            trim(
                (string)
                $this->request
                    ->getPost('email')
            );

        $no_hp =
            trim(
                (string)
                $this->request
                    ->getPost('no_hp')
            );

        $jabatan =
            trim(
                (string)
                $this->request
                    ->getPost('jabatan')
            );

        if ($name === '') {

            return redirect()
                ->to(
                    base_url(
                        'unit-layanan/profile'
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
                        'unit-layanan/profile'
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
                        'unit-layanan/profile'
                    )
                )
                ->withInput()
                ->with(
                    'error',
                    'Email wajib diisi.'
                );
        }

        if (
            !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )
        ) {

            return redirect()
                ->to(
                    base_url(
                        'unit-layanan/profile'
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
                    'unit-layanan/profile'
                )
            )
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }

    /**
     * =========================================================
     * UPLOAD
     * =========================================================
     */
    public function upload($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->to(
                    base_url(
                        'unit-layanan/dashboard'
                    )
                )
                ->with(
                    'error',
                    'Data tiket tidak ditemukan'
                );
        }

        $tiket =
            $this->formatTicket(
                $ticket
            );

        return view(
            'unit_layanan/upload',
            [

                'title' =>
                    'Upload Dokumen Hasil',

                'tiket' =>
                    $tiket,

                'dokumen_hasil' =>
                    [],
            ]
        );
    }

    /**
     * =========================================================
     * SIMPAN UPLOAD
     * =========================================================
     */
    public function simpanUpload($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan'
                );
        }

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

        if (empty($files)) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Silahkan pilih dokumen terlebih dahulu'
                );
        }

        $uploadPath =
            FCPATH . 'uploads/hasil';

        if (!is_dir($uploadPath)) {

            mkdir(
                $uploadPath,
                0777,
                true
            );
        }

        $uploaded = 0;

        foreach ($files as $file) {

            if (
                !$file ||
                !$file->isValid() ||
                $file->hasMoved()
            ) {

                continue;
            }

            /*
             * MAKSIMAL 5 MB PER FILE
             */
            if (
                $file->getSize()
                > 5242880
            ) {

                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'Ukuran file maksimal 5 MB.'
                    );
            }

            $extension =
                strtolower(
                    $file
                        ->getClientExtension()
                );

            if (
                !in_array(
                    $extension,
                    [
                        'pdf',
                        'jpg',
                        'jpeg',
                        'png'
                    ],
                    true
                )
            ) {

                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'Format file hanya PDF, JPG, JPEG, atau PNG.'
                    );
            }

            $file->move(
                $uploadPath,
                $file->getRandomName()
            );

            $uploaded++;
        }

        if ($uploaded === 0) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tidak ada file yang berhasil diupload.'
                );
        }

        return redirect()
            ->to(
                base_url(
                    'unit-layanan/detail/' . $id
                )
            )
            ->with(
                'success',
                $uploaded .
                ' dokumen berhasil diupload.'
            );
    }

    /**
     * =========================================================
     * KIRIM KE ULT
     * =========================================================
     */
    public function kirim($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan'
                );
        }

        $status =
            strtolower(
                (string)
                ($ticket['status'] ?? '')
            );

        /*
         * HANYA COMPLETED YANG BISA DIKIRIM
         */
        if ($status !== 'completed') {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket hanya bisa dikirim setelah status Selesai.'
                );
        }

        $this->db
            ->table('tickets')
            ->where(
                'id',
                $id
            )
            ->update([
                'updated_at' =>
                    date(
                        'Y-m-d H:i:s'
                    ),
            ]);

        return redirect()
            ->to(
                base_url(
                    'unit-layanan/detail/' . $id
                )
            )
            ->with(
                'success',
                'Tiket berhasil dikirim ke Petugas ULT.'
            );
    }

    /**
     * =========================================================
     * KIRIM KE PEMOHON
     * =========================================================
     */
    public function kirimKePemohon($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan'
                );
        }

        $status =
            strtolower(
                (string)
                ($ticket['status'] ?? '')
            );

        if (
            !in_array(
                $status,
                [
                    'completed',
                    'processing'
                ],
                true
            )
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket hanya bisa dikirim ke pemohon setelah status Selesai atau Diproses.'
                );
        }

        $data = [

            'status' =>
                'completed',

            'updated_at' =>
                date(
                    'Y-m-d H:i:s'
                ),
        ];

        if (
            $this->db->fieldExists(
                'completed_at',
                'tickets'
            )
        ) {

            $data['completed_at'] =
                date(
                    'Y-m-d H:i:s'
                );
        }

        $this->db
            ->table('tickets')
            ->where(
                'id',
                $id
            )
            ->update($data);

        return redirect()
            ->to(
                base_url(
                    'unit-layanan/detail/' . $id
                )
            )
            ->with(
                'success',
                'Tiket berhasil dikirim ke pemohon.'
            );
    }

    /**
     * =========================================================
     * RIWAYAT
     * =========================================================
     */
    public function riwayat()
    {
        return redirect()
            ->to(
                base_url(
                    'unit-layanan/dashboard'
                )
            );
    }

    /**
     * =========================================================
     * HAPUS DOKUMEN
     * =========================================================
     */
    public function hapusDokumen($id)
    {
        return redirect()
            ->back()
            ->with(
                'error',
                'Fitur penghapusan dokumen hasil belum tersedia pada struktur database baru.'
            );
    }
}