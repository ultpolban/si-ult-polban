<?php

namespace App\Controllers;

use App\Models\AdministrasiUmumActivityLogModel;
use App\Models\AdministrasiUmumTicketModel;

class AdministrasiUmum extends BaseController
{
    private const UNIT_NAME = 'Bagian Administrasi Umum';

    private AdministrasiUmumTicketModel $ticketModel;
    private AdministrasiUmumActivityLogModel $activityLogModel;

    public function __construct()
    {
        $this->ticketModel = new AdministrasiUmumTicketModel();
        $this->activityLogModel = new AdministrasiUmumActivityLogModel();
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        $this->writeActivity(
            'DASHBOARD_VIEW',
            'Membuka dashboard Administrasi Umum'
        );

        return view(
            'administrasi_umum/dashboard',
            $this->dashboardData()
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DATA TIKET
    |--------------------------------------------------------------------------
    */

    public function dataTiket()
    {
        $this->writeActivity(
            'TICKET_LIST_VIEW',
            'Membuka data tiket Administrasi Umum'
        );

        $keyword = trim(
            (string) $this->request->getGet('keyword')
        );

        $query = $this->ticketModel
            ->orderBy('id', 'DESC');

        if ($keyword !== '') {
            $query
                ->groupStart()
                ->like('ticket_number', $keyword)
                ->orLike('applicant_name', $keyword)
                ->orLike('service_name', $keyword)
                ->orLike('status', $keyword)
                ->groupEnd();
        }

        return view(
            'administrasi_umum/data_tiket',
            [
                'tiket' =>
                    $query->paginate(
                        15,
                        'administrasi_umum'
                    ),

                'pager' =>
                    $this->ticketModel->pager,

                'keyword' =>
                    $keyword,

                'nama_unit' =>
                    self::UNIT_NAME,
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DETAIL TIKET
    |--------------------------------------------------------------------------
    */

    public function detail(int $id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(
                    base_url(
                        'administrasi-umum/data-tiket'
                    )
                )
                ->with(
                    'error',
                    'Tiket Administrasi Umum tidak ditemukan.'
                );
        }

        $this->writeActivity(
            'TICKET_DETAIL_VIEW',
            'Melihat detail tiket ' .
                $ticket['ticket_number'],
            $id,
            $ticket['status']
        );

        return view(
            'administrasi_umum/detail',
            [
                'tiket' =>
                    $ticket,

                'nama_unit' =>
                    self::UNIT_NAME,
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PROSES TIKET
    |--------------------------------------------------------------------------
    */

    public function proses(int $id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(
                    base_url(
                        'administrasi-umum/data-tiket'
                    )
                )
                ->with(
                    'error',
                    'Tiket Administrasi Umum tidak ditemukan.'
                );
        }

        return view(
            'administrasi_umum/proses',
            [
                'tiket' =>
                    $ticket,

                'nama_unit' =>
                    self::UNIT_NAME,
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PROSES TIKET
    |--------------------------------------------------------------------------
    */

    public function updateProses(int $id)
    {
        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(
                    base_url(
                        'administrasi-umum/data-tiket'
                    )
                )
                ->with(
                    'error',
                    'Tiket Administrasi Umum tidak ditemukan.'
                );
        }

        $statusInput = strtolower(
            trim(
                (string) $this->request->getPost('status')
            )
        );

        /*
         * Status dari view:
         *
         * menunggu
         * diproses
         * selesai
         *
         * Status database:
         *
         * submitted
         * processing
         * completed
         */

        $statusMap = [

            'menunggu' =>
                'submitted',

            'diproses' =>
                'processing',

            'selesai' =>
                'completed',

            /*
             * Kompatibilitas status database
             */

            'submitted' =>
                'submitted',

            'processing' =>
                'processing',

            'completed' =>
                'completed',

            'rejected' =>
                'rejected',

            'cancelled' =>
                'cancelled',
        ];

        if (
            !array_key_exists(
                $statusInput,
                $statusMap
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
            $statusMap[$statusInput];

        /*
         * Catatan
         */

        $adminNote = trim(
            (string) $this->request->getPost(
                'catatan'
            )
        );

        if ($adminNote === '') {
            $adminNote = trim(
                (string) $this->request->getPost(
                    'admin_note'
                )
            );
        }

        /*
         * Data update
         */

        $update = [

            'status' =>
                $status,

            'admin_note' =>
                $adminNote,
        ];

        /*
         * Waktu mulai diproses
         */

        if ($status === 'processing') {

            $update['processed_at'] =
                !empty(
                    $ticket['processed_at']
                )
                    ? $ticket['processed_at']
                    : date(
                        'Y-m-d H:i:s'
                    );
        }

        /*
         * Waktu selesai
         */

        if ($status === 'completed') {

            $update['completed_at'] =
                !empty(
                    $ticket['completed_at']
                )
                    ? $ticket['completed_at']
                    : date(
                        'Y-m-d H:i:s'
                    );
        }

        /*
         * Update database
         */

        if (
            !$this->ticketModel->update(
                $id,
                $update
            )
        ) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Proses tiket gagal disimpan.'
                );
        }

        /*
         * Log proses
         */

        $this->writeActivity(
            'TICKET_PROCESSED',
            'Memproses tiket ' .
                $ticket['ticket_number'],
            $id,
            $status,
            $adminNote
        );

        /*
         * Log perubahan status
         */

        if (
            $status !==
            ($ticket['status'] ?? null)
        ) {

            $this->writeActivity(
                'STATUS_CHANGED',
                'Mengubah status tiket ' .
                    $ticket['ticket_number'],
                $id,
                $status
            );
        }

        /*
         * Log catatan
         */

        if ($adminNote !== '') {

            $this->writeActivity(
                'NOTE_ADDED',
                'Menambahkan catatan pada tiket ' .
                    $ticket['ticket_number'],
                $id,
                $status,
                $adminNote
            );
        }

        return redirect()
            ->to(
                base_url(
                    'administrasi-umum/detail/' .
                    $id
                )
            )
            ->with(
                'success',
                'Proses tiket berhasil diperbarui.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD HASIL LAYANAN
    |--------------------------------------------------------------------------
    */

    public function upload(int $id)
    {
        $ticket =
            $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(
                    base_url(
                        'administrasi-umum/data-tiket'
                    )
                )
                ->with(
                    'error',
                    'Tiket Administrasi Umum tidak ditemukan.'
                );
        }

        return view(
            'administrasi_umum/upload',
            [
                'tiket' =>
                    $ticket,

                'nama_unit' =>
                    self::UNIT_NAME,
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN UPLOAD HASIL
    |--------------------------------------------------------------------------
    */

    public function simpanUpload(int $id)
    {
        $ticket =
            $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(
                    base_url(
                        'administrasi-umum/data-tiket'
                    )
                )
                ->with(
                    'error',
                    'Tiket Administrasi Umum tidak ditemukan.'
                );
        }

        $update = [

            'result_note' =>
                trim(
                    (string)
                    $this->request->getPost(
                        'result_note'
                    )
                ),
        ];

        $uploadedFiles = [];

        $rawFiles =
            $this->request->getFileMultiple(
                'result_file'
            );

        if (
            is_array($rawFiles) &&
            !empty($rawFiles)
        ) {

            $allowedExtensions = [

                'pdf',
                'jpg',
                'jpeg',
                'png',
            ];

            $uploadDirectory =
                WRITEPATH .
                'uploads/administrasi_umum';

            if (
                !is_dir(
                    $uploadDirectory
                )
            ) {

                mkdir(
                    $uploadDirectory,
                    0750,
                    true
                );
            }

            foreach (
                $rawFiles as $file
            ) {

                if (
                    !$file ||
                    !$file->isValid() ||
                    $file->hasMoved()
                ) {

                    return redirect()
                        ->back()
                        ->withInput()
                        ->with(
                            'error',
                            'File hasil layanan tidak valid.'
                        );
                }

                $extension =
                    strtolower(
                        (string)
                        $file->getClientExtension()
                    );

                if (
                    !in_array(
                        $extension,
                        $allowedExtensions,
                        true
                    )
                ) {

                    return redirect()
                        ->back()
                        ->withInput()
                        ->with(
                            'error',
                            'Format file tidak valid. Gunakan PDF, JPG, JPEG, atau PNG.'
                        );
                }

                if (
                    $file->getSize() >
                    5 * 1024 * 1024
                ) {

                    return redirect()
                        ->back()
                        ->withInput()
                        ->with(
                            'error',
                            'Ukuran file terlalu besar. Maksimal 5 MB per file.'
                        );
                }

                $newName =
                    $file->getRandomName();

                $file->move(
                    $uploadDirectory,
                    $newName
                );

                $uploadedFiles[] =
                    $newName;
            }

            /*
             * File lama tetap dipertahankan.
             */

            $existingFiles =
                $this->normalizeResultFiles(
                    $ticket['result_file']
                    ?? null
                );

            $storedFiles =
                array_values(
                    array_unique(
                        array_merge(
                            $existingFiles,
                            $uploadedFiles
                        )
                    )
                );

            $update['result_file'] =
                json_encode(
                    $storedFiles,
                    JSON_UNESCAPED_SLASHES
                );
        }

        $this->ticketModel->update(
            $id,
            $update
        );

        $this->writeActivity(
            'RESULT_UPLOADED',
            'Menambahkan hasil layanan tiket ' .
                $ticket['ticket_number'],
            $id,
            $ticket['status'],
            $update['result_note']
        );

        return redirect()
            ->to(
                base_url(
                    'administrasi-umum/detail/' .
                    $id
                )
            )
            ->with(
                'success',
                'Hasil layanan berhasil disimpan.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | KIRIM KE PETUGAS ULT
    |--------------------------------------------------------------------------
    */

    public function kirim(int $id)
    {
        $ticket =
            $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(
                    base_url(
                        'administrasi-umum/data-tiket'
                    )
                )
                ->with(
                    'error',
                    'Tiket Administrasi Umum tidak ditemukan.'
                );
        }

        $status =
            strtolower(
                trim(
                    (string)
                    ($ticket['status'] ?? '')
                )
            );

        /*
         * Tiket harus selesai terlebih dahulu.
         */

        if (
            !in_array(
                $status,
                [
                    'completed',
                    'complete',
                    'selesai',
                ],
                true
            )
        ) {

            return redirect()
                ->to(
                    base_url(
                        'administrasi-umum/detail/' .
                        $id
                    )
                )
                ->with(
                    'error',
                    'Tiket harus berstatus Selesai sebelum dikirim ke Petugas ULT.'
                );
        }

        /*
         * Pastikan kolom pengiriman tersedia.
         */

        $update = [

            'sent_to_ult' =>
                1,

            'sent_to_ult_at' =>
                date(
                    'Y-m-d H:i:s'
                ),
        ];

        if (
            !$this->ticketModel->update(
                $id,
                $update
            )
        ) {

            return redirect()
                ->to(
                    base_url(
                        'administrasi-umum/detail/' .
                        $id
                    )
                )
                ->with(
                    'error',
                    'Tiket gagal dikirim ke Petugas ULT.'
                );
        }

        /*
         * Log aktivitas.
         */

        $this->writeActivity(
            'TICKET_SENT_TO_ULT',
            'Mengirim tiket ' .
                $ticket['ticket_number'] .
                ' ke Petugas ULT',
            $id,
            $ticket['status']
        );

        return redirect()
            ->to(
                base_url(
                    'administrasi-umum/detail/' .
                    $id
                )
            )
            ->with(
                'success',
                'Tiket berhasil dikirim ke Petugas ULT.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | KIRIM KE PEMOHON
    |--------------------------------------------------------------------------
    */

    public function kirimPemohon(int $id)
    {
        $ticket =
            $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(
                    base_url(
                        'administrasi-umum/data-tiket'
                    )
                )
                ->with(
                    'error',
                    'Tiket Administrasi Umum tidak ditemukan.'
                );
        }

        $status =
            strtolower(
                trim(
                    (string)
                    ($ticket['status'] ?? '')
                )
            );

        /*
         * Tiket harus selesai terlebih dahulu.
         */

        if (
            !in_array(
                $status,
                [
                    'completed',
                    'complete',
                    'selesai',
                ],
                true
            )
        ) {

            return redirect()
                ->to(
                    base_url(
                        'administrasi-umum/detail/' .
                        $id
                    )
                )
                ->with(
                    'error',
                    'Tiket harus berstatus Selesai sebelum dikirim ke Pemohon.'
                );
        }

        /*
         * Update status pengiriman ke pemohon.
         */

        $update = [

            'sent_to_applicant' =>
                1,

            'sent_to_applicant_at' =>
                date(
                    'Y-m-d H:i:s'
                ),
        ];

        if (
            !$this->ticketModel->update(
                $id,
                $update
            )
        ) {

            return redirect()
                ->to(
                    base_url(
                        'administrasi-umum/detail/' .
                        $id
                    )
                )
                ->with(
                    'error',
                    'Hasil layanan gagal dikirim ke Pemohon.'
                );
        }

        /*
         * Log aktivitas.
         */

        $this->writeActivity(
            'TICKET_SENT_TO_APPLICANT',
            'Mengirim hasil layanan tiket ' .
                $ticket['ticket_number'] .
                ' ke Pemohon',
            $id,
            $ticket['status']
        );

        return redirect()
            ->to(
                base_url(
                    'administrasi-umum/detail/' .
                    $id
                )
            )
            ->with(
                'success',
                'Hasil layanan berhasil dikirim ke Pemohon.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | LIHAT FILE
    |--------------------------------------------------------------------------
    */

    public function lihatFile(
        string $fileName
    ) {
        return $this->serveUploadedFile(
            $fileName,
            false
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DOWNLOAD FILE
    |--------------------------------------------------------------------------
    */

    public function downloadFile(
        string $fileName
    ) {
        return $this->serveUploadedFile(
            $fileName,
            true
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SERVE FILE
    |--------------------------------------------------------------------------
    */

    private function serveUploadedFile(
        string $fileName,
        bool $download
    ) {

        $safeFileName =
            basename($fileName);

        $filePath =
            WRITEPATH .
            'uploads/administrasi_umum/' .
            $safeFileName;

        if (
            !is_file($filePath)
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'File hasil layanan tidak ditemukan.'
                );
        }

        $mimeType =
            mime_content_type(
                $filePath
            )
            ?: 'application/octet-stream';

        $response =
            $this->response;

        $response->setHeader(
            'Content-Type',
            $mimeType
        );

        $response->setHeader(
            'Content-Disposition',
            (
                $download
                    ? 'attachment'
                    : 'inline'
            ) .
            '; filename="' .
            $safeFileName .
            '"'
        );

        $response->setBody(
            file_get_contents(
                $filePath
            )
        );

        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | NORMALIZE FILE
    |--------------------------------------------------------------------------
    */

    private function normalizeResultFiles(
        $value
    ): array {

        if (empty($value)) {
            return [];
        }

        if (is_string($value)) {

            $decoded =
                json_decode(
                    $value,
                    true
                );

            if (is_array($decoded)) {

                return array_values(
                    array_filter(
                        array_map(
                            static fn($item) =>
                                trim(
                                    (string) $item
                                ),
                            $decoded
                        ),
                        static fn($item) =>
                            $item !== ''
                    )
                );
            }

            return trim(
                (string) $value
            ) !== ''
                ? [(string) $value]
                : [];
        }

        if (is_array($value)) {

            return array_values(
                array_filter(
                    array_map(
                        static fn($item) =>
                            trim(
                                (string) $item
                            ),
                        $value
                    ),
                    static fn($item) =>
                        $item !== ''
                )
            );
        }

        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | STATISTIK
    |--------------------------------------------------------------------------
    */

    public function statistik()
    {
        return view(
            'administrasi_umum/statistik',
            $this->dashboardData()
        );
    }

    /*
    |--------------------------------------------------------------------------
    | PROFILE
    |--------------------------------------------------------------------------
    */

    public function profile()
    {
        $profile =
            db_connect()
                ->table('users')
                ->select(
                    'id, full_name, identity_number, phone_number, email, is_active'
                )
                ->where(
                    'id',
                    (int)
                    session()->get(
                        'user_id'
                    )
                )
                ->get()
                ->getRowArray()
                ?: [];

        $this->writeActivity(
            'PROFILE_VIEW',
            'Membuka profil petugas Administrasi Umum'
        );

        return view(
            'administrasi_umum/profile',
            [
                'profile' =>
                    $profile,

                'unit' =>
                    self::UNIT_NAME,
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE PROFILE
    |--------------------------------------------------------------------------
    */

    public function updateProfile()
    {
        $userId =
            (int)
            session()->get(
                'user_id'
            );

        $name =
            trim(
                (string)
                $this->request->getPost(
                    'full_name'
                )
            );

        if ($name === '') {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Nama lengkap wajib diisi.'
                );
        }

        db_connect()
            ->table('users')
            ->where(
                'id',
                $userId
            )
            ->update(
                [
                    'full_name' =>
                        $name,

                    'identity_number' =>
                        trim(
                            (string)
                            $this->request->getPost(
                                'identity_number'
                            )
                        ),

                    'phone_number' =>
                        trim(
                            (string)
                            $this->request->getPost(
                                'phone_number'
                            )
                        ),
                ]
            );

        session()->set(
            'full_name',
            $name
        );

        $this->writeActivity(
            'PROFILE_UPDATED',
            'Mengubah profil petugas Administrasi Umum'
        );

        return redirect()
            ->to(
                base_url(
                    'administrasi-umum/profile'
                )
            )
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | LOG AKTIVITAS
    |--------------------------------------------------------------------------
    */

    public function logAktivitas()
    {
        $this->writeActivity(
            'ACTIVITY_LOG_VIEW',
            'Membuka log aktivitas Administrasi Umum'
        );

        $keyword =
            trim(
                (string)
                $this->request->getGet(
                    'keyword'
                )
            );

        $query =
            $this->activityLogModel
                ->withUsers();

        if ($keyword !== '') {

            $query
                ->groupStart()
                ->like(
                    'administrasi_umum_activity_logs.activity',
                    $keyword
                )
                ->orLike(
                    'administrasi_umum_activity_logs.action',
                    $keyword
                )
                ->orLike(
                    'users.full_name',
                    $keyword
                )
                ->orLike(
                    'administrasi_umum_activity_logs.status',
                    $keyword
                )
                ->groupEnd();
        }

        return view(
            'administrasi_umum/log_aktivitas',
            [
                'logs' =>
                    $query->paginate(
                        20,
                        'administrasi_umum_logs'
                    ),

                'pager' =>
                    $this->activityLogModel->pager,

                'keyword' =>
                    $keyword,

                'unit' =>
                    self::UNIT_NAME,
            ]
        );
    }

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD DATA
    |--------------------------------------------------------------------------
    */

    private function dashboardData(): array
    {
        $tickets =
            $this->ticketModel
                ->findAll();

        $counts = [

            'submitted' =>
                0,

            'processing' =>
                0,

            'completed' =>
                0,

            'rejected' =>
                0,
        ];

        foreach (
            $tickets as $ticket
        ) {

            if (
                array_key_exists(
                    $ticket['status'] ?? '',
                    $counts
                )
            ) {

                $counts[
                    $ticket['status']
                ]++;
            }
        }

        return [

            'title' =>
                'Dashboard Administrasi Umum',

            'unit' =>
                self::UNIT_NAME,

            'total' =>
                count($tickets),

            'menunggu' =>
                $counts['submitted'],

            'diproses' =>
                $counts['processing'],

            'selesai' =>
                $counts['completed'],

            'ditolak' =>
                $counts['rejected'],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | WRITE ACTIVITY
    |--------------------------------------------------------------------------
    */

    private function writeActivity(
        string $action,
        string $activity,
        ?int $ticketId = null,
        ?string $status = null,
        ?string $note = null
    ): void {

        $this->activityLogModel
            ->insert(
                [

                    'user_id' =>
                        (int)
                        session()->get(
                            'user_id'
                        )
                        ?: null,

                    'ticket_id' =>
                        $ticketId,

                    'action' =>
                        $action,

                    'activity' =>
                        $activity,

                    'status' =>
                        $status,

                    'note' =>
                        $note,

                    'ip_address' =>
                        $this->request
                            ->getIPAddress(),

                    'user_agent' =>
                        $this->request
                            ->getUserAgent()
                            ->getAgentString(),

                    'created_at' =>
                        date(
                            'Y-m-d H:i:s'
                        ),
                ]
            );
    }
}