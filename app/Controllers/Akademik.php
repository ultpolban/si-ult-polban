<?php

namespace App\Controllers;

use App\Models\AkademikTicketModel;
use App\Models\AkademikActivityLogModel;

class Akademik extends BaseController
{
    protected AkademikTicketModel $tickets;
    protected AkademikActivityLogModel $activityLogs;

    public function __construct()
    {
        $this->tickets = new AkademikTicketModel();
        $this->activityLogs = new AkademikActivityLogModel();
    }

    /* =========================================================
       DASHBOARD
    ========================================================= */

    public function dashboard()
    {
        $tickets = $this->tickets
            ->orderBy('id', 'DESC')
            ->findAll();

        $total = count($tickets);
        $menunggu = 0;
        $diproses = 0;
        $selesai = 0;

        foreach ($tickets as $ticket) {
            $status = strtolower(
                trim((string) ($ticket['status'] ?? ''))
            );

            if (
                str_contains($status, 'menunggu') ||
                str_contains($status, 'pending') ||
                str_contains($status, 'submitted')
            ) {
                $menunggu++;
            } elseif (
                str_contains($status, 'diproses') ||
                str_contains($status, 'processing') ||
                str_contains($status, 'process')
            ) {
                $diproses++;
            } elseif (
                str_contains($status, 'selesai') ||
                str_contains($status, 'completed') ||
                str_contains($status, 'complete')
            ) {
                $selesai++;
            }
        }

        return view('akademik/dashboard', [
            'title'    => 'Dashboard Akademik',
            'unit'     => 'Akademik',
            'total'    => $total,
            'menunggu' => $menunggu,
            'diproses' => $diproses,
            'selesai'  => $selesai,
        ]);
    }

    /* =========================================================
       DATA TIKET
    ========================================================= */

    public function dataTiket()
    {
        $tickets = $this->tickets
            ->orderBy('id', 'DESC')
            ->findAll();

        $tickets = array_map(
            fn ($ticket) => $this->decorateTicket($ticket),
            $tickets
        );

        return view('akademik/data_tiket', [
            'title'   => 'Data Tiket Akademik',
            'unit'    => 'Akademik',
            'tickets' => $tickets,
            'tiket'   => $tickets,
        ]);
    }

    /* =========================================================
       PROFILE
    ========================================================= */

    public function profile()
    {
        return view('akademik/profile', [
            'title'   => 'Profil Petugas Akademik',
            'name'    => session()->get('full_name') ?: 'Petugas Akademik',
            'email'   => session()->get('email') ?: '',
            'nip'     => session()->get('identity_number') ?: '',
            'no_hp'   => session()->get('phone_number') ?: '',
            'jabatan' => 'Petugas Unit Layanan',
        ]);
    }

    public function updateProfile()
    {
        $name = trim(
            (string) $this->request->getPost('name')
        );

        session()->set('full_name', $name);

        return redirect()
            ->to(base_url('akademik/profile'))
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }

    /* =========================================================
       STATISTIK
    ========================================================= */

    public function statistik()
    {
        $tickets = $this->tickets
            ->orderBy('id', 'DESC')
            ->findAll();

        $total = count($tickets);
        $menunggu = 0;
        $diproses = 0;
        $selesai = 0;
        $statistikLayanan = [];

        foreach ($tickets as $ticket) {
            $status = strtolower(
                trim((string) ($ticket['status'] ?? ''))
            );

            if (
                str_contains($status, 'menunggu') ||
                str_contains($status, 'pending') ||
                str_contains($status, 'submitted')
            ) {
                $menunggu++;
            } elseif (
                str_contains($status, 'diproses') ||
                str_contains($status, 'processing') ||
                str_contains($status, 'process')
            ) {
                $diproses++;
            } elseif (
                str_contains($status, 'selesai') ||
                str_contains($status, 'completed') ||
                str_contains($status, 'complete')
            ) {
                $selesai++;
            }

            $layanan = trim(
                (string) ($ticket['service_name'] ?? 'Lainnya')
            );

            if ($layanan === '') {
                $layanan = 'Lainnya';
            }

            $statistikLayanan[$layanan] =
                ($statistikLayanan[$layanan] ?? 0) + 1;
        }

        ksort($statistikLayanan);

        return view('akademik/statistik', [
            'title'              => 'Statistik Akademik',
            'unit'               => 'Akademik',
            'totalTiket'         => $total,
            'total'              => $total,
            'menunggu'           => $menunggu,
            'diproses'           => $diproses,
            'selesai'            => $selesai,
            'persentaseSelesai'  => $total > 0
                ? round(($selesai / $total) * 100)
                : 0,
            'statistikLayanan'   => $statistikLayanan,
        ]);
    }

    /* =========================================================
       UPLOAD DOKUMEN TERPISAH
    ========================================================= */

    public function upload($id)
    {
        $id = (int) $id;

        $ticket = $this->tickets->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('akademik/data-tiket'))
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        return view('akademik/upload', [
            'title' => 'Upload Dokumen Akademik',
            'unit'  => 'Akademik',
            'tiket' => $this->decorateTicket($ticket),
        ]);
    }

    /* =========================================================
       KIRIM TIKET KE PETUGAS ULT
    ========================================================= */

    public function kirim($id)
    {
        $id = (int) $id;

        $ticket = $this->tickets->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('akademik/data-tiket'))
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        $this->tickets->update($id, [
            'sent_to_ult'    => 1,
            'sent_to_ult_at' => date('Y-m-d H:i:s'),
        ]);

        $this->writeActivityLog(
            $ticket,
            $ticket['status'] ?? 'Selesai',
            'Tiket dikirim ke Petugas ULT.'
        );

        return redirect()
            ->to(base_url('akademik/detail/' . $id))
            ->with(
                'success',
                'Tiket berhasil dikirim ke Petugas ULT.'
            );
    }

    /* =========================================================
       KIRIM TIKET KE PEMOHON
    ========================================================= */

    public function kirimKePemohon($id)
    {
        $id = (int) $id;

        $ticket = $this->tickets->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('akademik/data-tiket'))
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        $this->tickets->update($id, [
            'sent_to_applicant'    => 1,
            'sent_to_applicant_at' => date('Y-m-d H:i:s'),
        ]);

        $this->writeActivityLog(
            $ticket,
            $ticket['status'] ?? 'Selesai',
            'Hasil layanan dikirim ke Pemohon.'
        );

        return redirect()
            ->to(base_url('akademik/detail/' . $id))
            ->with(
                'success',
                'Hasil layanan berhasil dikirim ke Pemohon.'
            );
    }

    /* =========================================================
       RIWAYAT
    ========================================================= */

    public function riwayat()
    {
        $tickets = $this->tickets
            ->orderBy('id', 'DESC')
            ->findAll();

        $tickets = array_map(
            fn ($ticket) => $this->decorateTicket($ticket),
            $tickets
        );

        return view('akademik/riwayat', [
            'title' => 'Riwayat Tiket Akademik',
            'tiket' => $tickets,
        ]);
    }

    /* =========================================================
       HAPUS DOKUMEN HASIL
    ========================================================= */

    public function hapusDokumen($id)
    {
        $id = (int) $id;

        $ticket = $this->tickets->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('akademik/data-tiket'))
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        $filename = trim(
            (string) ($ticket['result_file'] ?? '')
        );

        if ($filename !== '') {
            $path = WRITEPATH . 'uploads/akademik/' . basename($filename);

            if (is_file($path)) {
                @unlink($path);
            }
        }

        $this->tickets->update($id, [
            'result_file' => null,
            'result_note' => null,
        ]);

        return redirect()
            ->to(base_url('akademik/detail/' . $id))
            ->with(
                'success',
                'Dokumen hasil layanan berhasil dihapus.'
            );
    }

    /* =========================================================
       DETAIL TIKET
    ========================================================= */

    public function detail($id)
    {
        $ticket = $this->tickets->find((int) $id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('akademik/data-tiket'))
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        $ticket = $this->decorateTicket($ticket);

        return view('akademik/detail', [
            'title' => 'Detail Pengajuan Tiket',
            'unit'  => 'Akademik',
            'tiket' => $ticket,
        ]);
    }

    /* =========================================================
       PROSES TIKET
    ========================================================= */

    public function proses($id)
    {
        $ticket = $this->tickets->find((int) $id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('akademik/data-tiket'))
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        $ticket = $this->decorateTicket($ticket);

        return view('akademik/proses', [
            'title' => 'Proses Tiket Akademik',
            'unit'  => 'Akademik',
            'tiket' => $ticket,
        ]);
    }

    /* =========================================================
       UPDATE PROSES TIKET
    ========================================================= */

    public function updateProses($id)
    {
        $id = (int) $id;

        $ticket = $this->tickets->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('akademik/data-tiket'))
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

        if ($status === '') {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Status tiket wajib dipilih.'
                );
        }

        $data = [
            'status'     => $status,
            'admin_note' => $catatan,
        ];

        $statusLower = strtolower($status);

        /* =====================================================
           WAKTU DIPROSES
        ===================================================== */

        if (
            str_contains($statusLower, 'diproses') ||
            str_contains($statusLower, 'processing') ||
            str_contains($statusLower, 'process')
        ) {
            $data['processed_at'] = date('Y-m-d H:i:s');
        }

        /* =====================================================
           WAKTU SELESAI
        ===================================================== */

        if (
            str_contains($statusLower, 'selesai') ||
            str_contains($statusLower, 'completed') ||
            str_contains($statusLower, 'complete')
        ) {
            $data['completed_at'] = date('Y-m-d H:i:s');
        }

        /* =====================================================
           UPLOAD SURAT HASIL
        ===================================================== */

        $uploadedFile = null;

        /*
         * Prioritas 1:
         * name="dokumen"
         */

        $dokumen = $this->request->getFile('dokumen');

        if (
            $dokumen &&
            $dokumen->getError() !== UPLOAD_ERR_NO_FILE
        ) {
            $uploadedFile = $dokumen;
        }

        /*
         * Prioritas 2:
         * name="file_hasil[]"
         */

        if (!$uploadedFile) {
            $files = $this->request->getFileMultiple('file_hasil');

            if (!empty($files)) {
                foreach ($files as $candidate) {
                    if (
                        $candidate &&
                        $candidate->getError() !== UPLOAD_ERR_NO_FILE
                    ) {
                        $uploadedFile = $candidate;
                        break;
                    }
                }
            }
        }

        /* =====================================================
           VALIDASI FILE
        ===================================================== */

        if ($uploadedFile) {

            if (!$uploadedFile->isValid()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'File surat hasil tidak valid.'
                    );
            }

            /*
             * Maksimal 5 MB
             */

            if ($uploadedFile->getSizeByUnit('mb') > 5) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Ukuran surat hasil maksimal 5 MB.'
                    );
            }

            /*
             * Extension yang diperbolehkan
             */

            $allowedExtensions = [
                'pdf',
                'jpg',
                'jpeg',
                'png',
            ];

            $extension = strtolower(
                $uploadedFile->getClientExtension()
            );

            if (!in_array(
                $extension,
                $allowedExtensions,
                true
            )) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Format file hanya PDF, JPG, JPEG, atau PNG.'
                    );
            }

            /* =================================================
               FOLDER UPLOAD AKADEMIK
            ================================================= */

            $uploadPath = WRITEPATH . 'uploads/akademik';

            if (!is_dir($uploadPath)) {
                if (!mkdir($uploadPath, 0750, true)) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with(
                            'error',
                            'Folder upload Akademik gagal dibuat.'
                        );
                }
            }

            /*
             * Pastikan folder dapat ditulisi
             */

            if (!is_writable($uploadPath)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Folder upload Akademik tidak dapat ditulisi.'
                    );
            }

            /* =================================================
               NAMA FILE BARU
            ================================================= */

            $newName = $uploadedFile->getRandomName();

            /* =================================================
               PINDAHKAN FILE
            ================================================= */

            try {
                $uploadedFile->move(
                    $uploadPath,
                    $newName
                );
            } catch (\Throwable $e) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'Surat hasil gagal disimpan.'
                    );
            }

            /*
             * Pastikan file benar-benar ada
             */

            $savedPath = $uploadPath . DIRECTORY_SEPARATOR . $newName;

            if (!is_file($savedPath)) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->with(
                        'error',
                        'File berhasil diproses tetapi tidak ditemukan di server.'
                    );
            }

            /*
             * Simpan nama file ke database
             */

            $data['result_file'] = $newName;

            $data['result_note'] =
                'Surat hasil layanan Akademik berhasil diunggah.';
        }

        /* =====================================================
           UPDATE DATABASE TIKET
        ===================================================== */

        if (!$this->tickets->update($id, $data)) {
            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Data tiket gagal diperbarui.'
                );
        }

        /* =====================================================
           LOG AKTIVITAS
        ===================================================== */

        $activityText = $uploadedFile
            ? 'Surat hasil layanan diunggah.'
            : (
                $catatan !== ''
                    ? $catatan
                    : 'Status tiket diperbarui.'
            );

        $this->writeActivityLog(
            $ticket,
            $status,
            $activityText
        );

        /* =====================================================
           REDIRECT DETAIL
        ===================================================== */

        return redirect()
            ->to(
                base_url(
                    'akademik/detail/' . $id
                )
            )
            ->with(
                'success',
                $uploadedFile
                    ? 'Proses tiket dan surat hasil berhasil disimpan.'
                    : 'Proses tiket berhasil diperbarui.'
            );
    }

    /* =========================================================
       UPLOAD DOKUMEN TERPISAH
    ========================================================= */

    public function simpanUpload($id)
    {
        $id = (int) $id;

        $ticket = $this->tickets->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('akademik/data-tiket'))
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        $file = $this->request->getFile('dokumen');

        if (
            !$file ||
            $file->getError() === UPLOAD_ERR_NO_FILE ||
            !$file->isValid()
        ) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumen Akademik tidak valid.'
                );
        }

        if ($file->getSizeByUnit('mb') > 5) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Ukuran file maksimal 5 MB.'
                );
        }

        $allowedExtensions = [
            'pdf',
            'jpg',
            'jpeg',
            'png',
        ];

        $extension = strtolower(
            $file->getClientExtension()
        );

        if (!in_array(
            $extension,
            $allowedExtensions,
            true
        )) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Format file hanya PDF, JPG, JPEG, atau PNG.'
                );
        }

        $uploadPath =
            WRITEPATH . 'uploads/akademik';

        if (!is_dir($uploadPath)) {
            if (!mkdir($uploadPath, 0750, true)) {
                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'Folder upload Akademik gagal dibuat.'
                    );
            }
        }

        if (!is_writable($uploadPath)) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Folder upload Akademik tidak dapat ditulisi.'
                );
        }

        $newName = $file->getRandomName();

        try {
            $file->move(
                $uploadPath,
                $newName
            );
        } catch (\Throwable $e) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumen gagal disimpan.'
                );
        }

        $savedPath =
            $uploadPath .
            DIRECTORY_SEPARATOR .
            $newName;

        if (!is_file($savedPath)) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumen tidak ditemukan setelah proses upload.'
                );
        }

        $this->tickets->update(
            $id,
            [
                'result_file' =>
                    $newName,

                'result_note' =>
                    'Dokumen hasil layanan diunggah.',
            ]
        );

        $this->writeActivityLog(
            $ticket,
            $ticket['status'] ?? 'Selesai',
            'Dokumen hasil layanan diunggah.'
        );

        return redirect()
            ->to(
                base_url(
                    'akademik/detail/' . $id
                )
            )
            ->with(
                'success',
                'Dokumen Akademik berhasil diunggah.'
            );
    }

    /* =========================================================
       LIHAT DOKUMEN LANGSUNG
    ========================================================= */

    public function lihat($filename)
    {
        $filename = basename(
            urldecode((string) $filename)
        );

        if ($filename === '' || $filename === '.') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Nama dokumen tidak valid.'
            );
        }

        $path =
            WRITEPATH .
            'uploads/akademik/' .
            $filename;

        if (!is_file($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Dokumen tidak ditemukan.'
            );
        }

        $mime = mime_content_type($path);

        return $this->response
            ->setHeader(
                'Content-Type',
                $mime ?: 'application/octet-stream'
            )
            ->setHeader(
                'Content-Disposition',
                'inline; filename="' .
                basename($filename) .
                '"'
            )
            ->setBody(
                file_get_contents($path)
            );
    }

    /* =========================================================
       DOWNLOAD DOKUMEN LANGSUNG
    ========================================================= */

    public function download($filename)
    {
        $filename = basename(
            urldecode((string) $filename)
        );

        if ($filename === '' || $filename === '.') {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Nama dokumen tidak valid.'
            );
        }

        $path =
            WRITEPATH .
            'uploads/akademik/' .
            $filename;

        if (!is_file($path)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException(
                'Dokumen tidak ditemukan.'
            );
        }

        return $this->response->download(
            $path,
            null
        );
    }

    /* =========================================================
       LOG AKTIVITAS
    ========================================================= */

    public function logAktivitas()
    {
        $keyword = trim(
            (string) $this->request->getGet('keyword')
        );

        $unitFilter = trim(
            (string) $this->request->getGet('unit')
        );

        $logs = $this->activityLogs
            ->orderBy('id', 'DESC')
            ->findAll();

        $result = [];

        foreach ($logs as $log) {

            $ticketId = (int) (
                $log['ticket_id']
                ??
                $log['tiket_id']
                ??
                0
            );

            $ticket = null;

            if ($ticketId > 0) {
                $ticket = $this->tickets->find(
                    $ticketId
                );
            }

            /*
             * Fallback nomor tiket
             */

            if (
                !$ticket &&
                !empty($log['ticket_number'])
            ) {
                $ticket = $this->tickets
                    ->where(
                        'ticket_number',
                        $log['ticket_number']
                    )
                    ->first();
            }

            $noTiket =
                $log['no_tiket']
                ??
                $log['ticket_number']
                ??
                ($ticket['ticket_number'] ?? '-');

            $layanan =
                $log['layanan']
                ??
                $log['service_name']
                ??
                ($ticket['service_name'] ?? '-');

            $status =
                $log['status']
                ??
                ($ticket['status'] ?? '-');

            /*
             * Ambil file dari tiket Akademik
             */

            $fileHasil =
                $ticket['result_file']
                ??
                $log['file_hasil']
                ??
                $log['result_file']
                ??
                '';

            $unit =
                $log['unit']
                ??
                'Akademik';

            $aktivitas =
                $log['aktivitas']
                ??
                $log['activity']
                ??
                $log['action']
                ??
                '-';

            $waktu =
                $log['waktu']
                ??
                $log['tanggal']
                ??
                $log['created_at']
                ??
                '-';

            /* =================================================
               FILTER KEYWORD
            ================================================= */

            if ($keyword !== '') {

                $haystack = strtolower(
                    $noTiket . ' ' .
                    $unit . ' ' .
                    $layanan . ' ' .
                    $aktivitas . ' ' .
                    $status
                );

                if (!str_contains(
                    $haystack,
                    strtolower($keyword)
                )) {
                    continue;
                }
            }

            /* =================================================
               FILTER UNIT
            ================================================= */

            if (
                $unitFilter !== '' &&
                strtolower($unitFilter) !==
                strtolower($unit)
            ) {
                continue;
            }

            /* =================================================
               HASIL UNTUK VIEW
            ================================================= */

            $result[] = [

                'log_id' =>
                    (int) ($log['id'] ?? 0),

                'ticket_id' =>
                    $ticketId > 0
                        ? $ticketId
                        : (int) ($ticket['id'] ?? 0),

                'no_tiket' =>
                    $noTiket,

                'unit' =>
                    $unit,

                'layanan' =>
                    $layanan,

                'aktivitas' =>
                    $aktivitas,

                'status' =>
                    $status,

                'waktu' =>
                    $waktu,

                'file_hasil' =>
                    $fileHasil,

                'result_file' =>
                    $fileHasil,
            ];
        }

        $units = [
            'Akademik',
        ];

        return view(
            'akademik/log_aktivitas',
            [
                'title' =>
                    'Log Aktivitas Akademik',

                'unit' =>
                    'Akademik',

                'logs' =>
                    $result,

                'units' =>
                    $units,

                'keyword' =>
                    $keyword,
            ]
        );
    }

    /* =========================================================
       LIHAT SURAT DARI LOG AKTIVITAS
    ========================================================= */

    public function lihatLog($logId)
    {
        $logId = (int) $logId;

        $log = $this->activityLogs->find($logId);

        if (!$log) {
            return redirect()
                ->to(base_url('akademik/log-aktivitas'))
                ->with(
                    'error',
                    'Log aktivitas tidak ditemukan.'
                );
        }

        /*
         * Cari tiket berdasarkan ticket_id
         */

        $ticketId = (int) (
            $log['ticket_id']
            ??
            $log['tiket_id']
            ??
            0
        );

        $ticket = null;

        if ($ticketId > 0) {
            $ticket = $this->tickets->find($ticketId);
        }

        /*
         * Fallback berdasarkan nomor tiket
         */

        if (
            !$ticket &&
            !empty($log['ticket_number'])
        ) {
            $ticket = $this->tickets
                ->where(
                    'ticket_number',
                    $log['ticket_number']
                )
                ->first();
        }

        if (!$ticket) {
            return redirect()
                ->to(base_url('akademik/log-aktivitas'))
                ->with(
                    'error',
                    'Tiket Akademik terkait tidak ditemukan.'
                );
        }

        /*
         * Ambil result_file
         */

        $filename = trim(
            (string) (
                $ticket['result_file']
                ??
                $log['file_hasil']
                ??
                $log['result_file']
                ??
                ''
            )
        );

        if ($filename === '') {
            return redirect()
                ->to(base_url('akademik/log-aktivitas'))
                ->with(
                    'error',
                    'Surat hasil untuk tiket ini belum tersedia.'
                );
        }

        /*
         * Bersihkan nama file
         */

        $filename = basename(
            urldecode($filename)
        );

        /*
         * Lokasi file Akademik
         */

        $path =
            WRITEPATH .
            'uploads/akademik/' .
            $filename;

        /*
         * Pastikan file benar-benar ada
         */

        if (!is_file($path)) {
            return redirect()
                ->to(base_url('akademik/log-aktivitas'))
                ->with(
                    'error',
                    'File surat hasil tidak ditemukan di penyimpanan Akademik.'
                );
        }

        /*
         * Tampilkan dokumen
         */

        return $this->lihat($filename);
    }

    /* =========================================================
       DOWNLOAD SURAT DARI LOG AKTIVITAS
    ========================================================= */

    public function downloadLog($logId)
    {
        $logId = (int) $logId;

        $log = $this->activityLogs->find($logId);

        if (!$log) {
            return redirect()
                ->to(base_url('akademik/log-aktivitas'))
                ->with(
                    'error',
                    'Log aktivitas tidak ditemukan.'
                );
        }

        /*
         * Cari tiket berdasarkan ID
         */

        $ticketId = (int) (
            $log['ticket_id']
            ??
            $log['tiket_id']
            ??
            0
        );

        $ticket = null;

        if ($ticketId > 0) {
            $ticket = $this->tickets->find($ticketId);
        }

        /*
         * Fallback nomor tiket
         */

        if (
            !$ticket &&
            !empty($log['ticket_number'])
        ) {
            $ticket = $this->tickets
                ->where(
                    'ticket_number',
                    $log['ticket_number']
                )
                ->first();
        }

        if (!$ticket) {
            return redirect()
                ->to(base_url('akademik/log-aktivitas'))
                ->with(
                    'error',
                    'Tiket Akademik terkait tidak ditemukan.'
                );
        }

        /*
         * Ambil result_file
         */

        $filename = trim(
            (string) (
                $ticket['result_file']
                ??
                $log['file_hasil']
                ??
                $log['result_file']
                ??
                ''
            )
        );

        if ($filename === '') {
            return redirect()
                ->to(base_url('akademik/log-aktivitas'))
                ->with(
                    'error',
                    'Surat hasil untuk tiket ini belum tersedia.'
                );
        }

        /*
         * Bersihkan nama file
         */

        $filename = basename(
            urldecode($filename)
        );

        /*
         * Pastikan file ada
         */

        $path =
            WRITEPATH .
            'uploads/akademik/' .
            $filename;

        if (!is_file($path)) {
            return redirect()
                ->to(base_url('akademik/log-aktivitas'))
                ->with(
                    'error',
                    'File surat hasil tidak ditemukan di penyimpanan Akademik.'
                );
        }

        /*
         * Download
         */

        return $this->download($filename);
    }

    /* =========================================================
       ALIAS ROUTE LAMA
       Supaya route yang masih menggunakan
       lihatDokumenLog/downloadDokumenLog tetap aman
    ========================================================= */

    public function lihatDokumenLog($logId)
    {
        return $this->lihatLog($logId);
    }

    public function downloadDokumenLog($logId)
    {
        return $this->downloadLog($logId);
    }

    /* =========================================================
       SIMPAN LOG AKTIVITAS
    ========================================================= */

    private function writeActivityLog(
        array $ticket,
        string $status,
        string $activity
    ): void {

        $ticketId = (int) (
            $ticket['id'] ?? 0
        );

        if ($ticketId <= 0) {
            return;
        }

        $data = [
            'ticket_id' =>
                $ticketId,

            'ticket_number' =>
                $ticket['ticket_number']
                ?? null,

            'activity' =>
                $activity,

            'status' =>
                $status,

            'created_at' =>
                date('Y-m-d H:i:s'),
        ];

        try {

            $this->activityLogs->insert($data);

        } catch (\Throwable $e) {

            /*
             * Error log tidak boleh
             * menghentikan proses tiket.
             */

        }
    }

    /* =========================================================
       DECORATE TICKET
    ========================================================= */

    private function decorateTicket(
        array $ticket
    ): array {

        $resultFile = trim(
            (string) (
                $ticket['result_file']
                ?? ''
            )
        );

        /*
         * Dokumen hasil
         */

        if ($resultFile !== '') {

            $ticket['dokumen_hasil'] = [

                [
                    'nama_file' =>
                        $resultFile,

                    'nama_asli' =>
                        $resultFile,
                ],

            ];

        } else {

            $ticket['dokumen_hasil'] = [];
        }

        /*
         * Alias field
         */

        $ticket['no_tiket'] =
            $ticket['ticket_number']
            ??
            $ticket['no_tiket']
            ??
            '-';

        $ticket['nama_pemohon'] =
            $ticket['applicant_name']
            ??
            $ticket['nama_pemohon']
            ??
            '-';

        $ticket['nik'] =
            $ticket['applicant_identifier']
            ??
            $ticket['nik']
            ??
            '-';

        $ticket['nama_unit'] =
            $ticket['unit_name']
            ??
            $ticket['nama_unit']
            ??
            'Akademik';

        $ticket['nama_layanan'] =
            $ticket['service_name']
            ??
            $ticket['nama_layanan']
            ??
            '-';

        $ticket['deskripsi'] =
            $ticket['description']
            ??
            $ticket['deskripsi']
            ??
            '-';

        return $ticket;
    }
}