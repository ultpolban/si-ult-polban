<?php

namespace App\Controllers;

use App\Models\KeuanganTicketModel;

class Keuangan extends BaseController
{
    private const UNIT = 'Keuangan';

    private KeuanganTicketModel $tickets;

    public function __construct()
    {
        $this->tickets = new KeuanganTicketModel();
    }

    /* =========================================================
       DASHBOARD
    ========================================================= */

    public function index()
    {
        return $this->dashboard();
    }

    public function dashboard()
    {
        return view(
            'keuangan/dashboard',
            $this->viewData($this->allTickets())
        );
    }


    /* =========================================================
       DATA TIKET
    ========================================================= */

    public function dataTiket()
    {
        $keyword = trim(
            (string) $this->request->getGet('keyword')
        );

        $query = $this->tickets
            ->orderBy('id', 'DESC');

        if ($keyword !== '') {
            $query->groupStart()
                ->like('ticket_number', $keyword)
                ->orLike('applicant_name', $keyword)
                ->orLike('service_name', $keyword)
                ->orLike('status', $keyword)
                ->groupEnd();
        }

        $rows = $query->findAll();

        foreach ($rows as &$row) {
            $row['status_tampilan'] = $this->label(
                $row['status'] ?? 'submitted'
            );
        }

        return view('keuangan/data_tiket', [
            'tickets'   => $rows,
            'tiket'     => $rows,
            'keyword'   => $keyword,
            'unit'      => self::UNIT,
            'nama_unit' => self::UNIT,
        ]);
    }


    /* =========================================================
       STATISTIK
    ========================================================= */

    public function statistik()
    {
        return view(
            'keuangan/statistik',
            $this->viewData($this->allTickets())
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

        $query = db_connect()
            ->table('keuangan_activity_logs al')
            ->select(
                'al.*,
                 t.ticket_number AS no_tiket,
                 t.unit_name AS unit,
                 t.service_name AS layanan'
            )
            ->join(
                'keuangan_tickets t',
                't.id = al.ticket_id',
                'left'
            )
            ->orderBy('al.created_at', 'DESC');

        if ($keyword !== '') {
            $query->groupStart()
                ->like('al.activity', $keyword)
                ->orLike('al.action', $keyword)
                ->orLike('t.ticket_number', $keyword)
                ->groupEnd();
        }

        return view('keuangan/log_aktivitas', [
            'unit'    => self::UNIT,
            'units'   => [self::UNIT],
            'logs'    => $query->get()->getResultArray(),
            'keyword' => $keyword,
        ]);
    }


    /* =========================================================
       PROFILE
    ========================================================= */

    public function profile()
    {
        return $this->profil();
    }

    public function profil()
    {
        return view('keuangan/profil', [
            'title'   => 'Profil Petugas Keuangan',
            'name'    => session()->get('full_name') ?: 'Petugas Keuangan',
            'email'   => session()->get('email') ?: '',
            'nip'     => session()->get('identity_number') ?: '',
            'no_hp'   => session()->get('phone_number') ?: '',
            'jabatan' => 'Petugas Unit Layanan',
        ]);
    }

    public function editProfil()
    {
        return redirect()->to(
            base_url('keuangan/profile')
        );
    }

    public function updateProfile()
    {
        return $this->updateProfil();
    }

    public function updateProfil()
    {
        $name = trim(
            (string) $this->request->getPost('name')
        );

        session()->set('full_name', $name);

        return redirect()
            ->to(base_url('keuangan/profile'))
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }


    /* =========================================================
       DETAIL TIKET
    ========================================================= */

    public function detail($id)
    {
        $id = (int) $id;

        $ticket = $this->tickets->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('keuangan/data-tiket'))
                ->with(
                    'error',
                    'Tiket Keuangan tidak ditemukan.'
                );
        }

        /*
        |--------------------------------------------------------------------------
        | Pastikan data result_file terbaca
        |--------------------------------------------------------------------------
        */

        $ticket = $this->decorate($ticket);

        return view('keuangan/detail', [
            'tiket' => $ticket,
            'title' => 'Detail Tiket Keuangan',
        ]);
    }


    /* =========================================================
       PROSES TIKET
    ========================================================= */

    public function proses($id)
    {
        $id = (int) $id;

        $ticket = $this->tickets->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('keuangan/data-tiket'))
                ->with(
                    'error',
                    'Tiket Keuangan tidak ditemukan.'
                );
        }

        return view('keuangan/proses', [
            'tiket' => $this->decorate($ticket),
            'title' => 'Proses Tiket Keuangan',
        ]);
    }


    /* =========================================================
       UPDATE PROSES
    ========================================================= */

    public function updateProses($id)
    {
        $id = (int) $id;

        $ticket = $this->tickets->find($id);

        if (!$ticket) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket Keuangan tidak ditemukan.'
                );
        }

        $input = strtolower(
            trim((string) $this->request->getPost('status'))
        );

        $statusMap = [
            'menunggu'  => 'submitted',
            'diproses'  => 'processing',
            'selesai'   => 'completed',
            'ditolak'   => 'rejected',
            'dibatalkan'=> 'cancelled',
        ];

        $status = $statusMap[$input] ?? null;

        if (!$status) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Status tiket tidak valid.'
                );
        }

        $note = trim(
            (string) $this->request->getPost('catatan')
        );

        $updateData = [
            'status'     => $status,
            'admin_note' => $note,
        ];

        if ($status === 'processing') {
            $updateData['processed_at'] = date(
                'Y-m-d H:i:s'
            );
        }

        if ($status === 'completed') {
            $updateData['completed_at'] = date(
                'Y-m-d H:i:s'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Update melalui model
        |--------------------------------------------------------------------------
        */

        $this->tickets->update(
            $id,
            $updateData
        );

        $this->log(
            'STATUS_CHANGED',
            'Mengubah status tiket ' .
            ($ticket['ticket_number'] ?? '-'),
            $id,
            $status,
            $note
        );

        return redirect()
            ->to(base_url('keuangan/detail/' . $id))
            ->with(
                'success',
                'Status tiket Keuangan berhasil diperbarui.'
            );
    }


    /* =========================================================
       HALAMAN UPLOAD
    ========================================================= */

    public function upload($id)
    {
        $id = (int) $id;

        $ticket = $this->tickets->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('keuangan/data-tiket'))
                ->with(
                    'error',
                    'Tiket Keuangan tidak ditemukan.'
                );
        }

        return view('keuangan/upload', [
            'tiket' => $ticket,
            'unit'  => self::UNIT,
        ]);
    }


    /* =========================================================
       SIMPAN DOKUMEN HASIL
    ========================================================= */

    public function simpanUpload($id)
    {
        $id = (int) $id;

        /*
        |--------------------------------------------------------------------------
        | Cari tiket
        |--------------------------------------------------------------------------
        */

        $ticket = $this->tickets->find($id);

        if (!$ticket) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket Keuangan tidak ditemukan.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Ambil file
        |--------------------------------------------------------------------------
        */

        $file = $this->request->getFile('dokumen');

        if (!$file) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumen belum dipilih.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi file
        |--------------------------------------------------------------------------
        */

        if (!$file->isValid()) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumen tidak valid. Silakan pilih file kembali.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi ukuran maksimal 5 MB
        |--------------------------------------------------------------------------
        */

        if ($file->getSize() > (5 * 1024 * 1024)) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Ukuran dokumen maksimal 5 MB.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi ekstensi
        |--------------------------------------------------------------------------
        */

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
                    'Format dokumen harus PDF, JPG, JPEG, atau PNG.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Folder upload khusus Keuangan
        |--------------------------------------------------------------------------
        */

        $directory = WRITEPATH . 'uploads/keuangan';

        if (!is_dir($directory)) {
            if (!mkdir($directory, 0755, true) && !is_dir($directory)) {
                return redirect()
                    ->back()
                    ->with(
                        'error',
                        'Folder penyimpanan dokumen tidak dapat dibuat.'
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Hapus file hasil lama jika ada
        |--------------------------------------------------------------------------
        */

        if (!empty($ticket['result_file'])) {

            $oldFile = $directory .
                DIRECTORY_SEPARATOR .
                basename($ticket['result_file']);

            if (is_file($oldFile)) {
                @unlink($oldFile);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Nama file baru
        |--------------------------------------------------------------------------
        */

        $newFileName = $file->getRandomName();


        /*
        |--------------------------------------------------------------------------
        | Pindahkan file
        |--------------------------------------------------------------------------
        */

        try {

            $file->move(
                $directory,
                $newFileName
            );

        } catch (\Throwable $e) {

            log_message(
                'error',
                'Upload dokumen Keuangan gagal: ' .
                $e->getMessage()
            );

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumen gagal disimpan ke server.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan nama file ke DATABASE
        |
        | Menggunakan Query Builder secara langsung supaya result_file
        | tetap tersimpan meskipun belum masuk allowedFields model.
        |--------------------------------------------------------------------------
        */

        $db = db_connect();

        $updated = $db
            ->table('keuangan_tickets')
            ->where('id', $id)
            ->update([
                'result_file' => $newFileName,
                'result_note' => 'Dokumen hasil layanan diunggah.',
            ]);


        /*
        |--------------------------------------------------------------------------
        | Jika database gagal di-update
        |--------------------------------------------------------------------------
        */

        if (!$updated) {

            /*
            | Hapus file yang sudah terlanjur disimpan
            */

            $savedFile = $directory .
                DIRECTORY_SEPARATOR .
                $newFileName;

            if (is_file($savedFile)) {
                @unlink($savedFile);
            }

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumen berhasil di-upload tetapi gagal disimpan ke database.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Catat aktivitas
        |--------------------------------------------------------------------------
        */

        $this->log(
            'RESULT_UPLOADED',
            'Mengunggah hasil layanan ' .
            ($ticket['ticket_number'] ?? '-'),
            $id,
            $ticket['status'] ?? null,
            'File: ' . $newFileName
        );


        /*
        |--------------------------------------------------------------------------
        | Kembali ke detail
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->to(base_url('keuangan/detail/' . $id))
            ->with(
                'success',
                'Dokumen hasil layanan berhasil diunggah dan disimpan.'
            );
    }


    /* =========================================================
       KIRIM TIKET
    ========================================================= */

    public function kirim($id)
    {
        return $this->updateStatus(
            (int) $id,
            'processing'
        );
    }


    /* =========================================================
       KIRIM KE PEMOHON
    ========================================================= */

    public function kirimKePemohon($id)
    {
        return $this->updateStatus(
            (int) $id,
            'completed'
        );
    }


    /* =========================================================
       RIWAYAT
    ========================================================= */

    public function riwayat()
    {
        return $this->dashboard();
    }


    /* =========================================================
       HAPUS DOKUMEN
    ========================================================= */

    public function hapusDokumen($id)
    {
        $id = (int) $id;

        $ticket = $this->tickets->find($id);

        if (!$ticket) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket tidak ditemukan.'
                );
        }

        if (!empty($ticket['result_file'])) {

            $path = WRITEPATH .
                'uploads/keuangan/' .
                basename($ticket['result_file']);

            if (is_file($path)) {
                @unlink($path);
            }
        }

        db_connect()
            ->table('keuangan_tickets')
            ->where('id', $id)
            ->update([
                'result_file' => null,
                'result_note' => null,
            ]);

        $this->log(
            'RESULT_DELETED',
            'Menghapus dokumen hasil layanan ' .
            ($ticket['ticket_number'] ?? '-'),
            $id,
            $ticket['status'] ?? null
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Dokumen hasil layanan berhasil dihapus.'
            );
    }


    /* =========================================================
       LIHAT FILE
    ========================================================= */

    public function lihatFile(string $fileName)
    {
        return $this->serveUploadedFile(
            $fileName,
            false
        );
    }


    /* =========================================================
       DOWNLOAD FILE
    ========================================================= */

    public function downloadFile(string $fileName)
    {
        return $this->serveUploadedFile(
            $fileName,
            true
        );
    }


    /* =========================================================
       SERVE FILE
    ========================================================= */

    private function serveUploadedFile(
        string $fileName,
        bool $download
    ) {
        $safeFileName = basename($fileName);

        $filePath = WRITEPATH .
            'uploads/keuangan/' .
            $safeFileName;

        if (!is_file($filePath)) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'File hasil layanan tidak ditemukan.'
                );
        }

        $mimeType = mime_content_type($filePath);

        if (!$mimeType) {
            $mimeType = 'application/octet-stream';
        }

        $response = $this->response;

        $response->setHeader(
            'Content-Type',
            $mimeType
        );

        $response->setHeader(
            'Content-Disposition',
            ($download ? 'attachment' : 'inline') .
            '; filename="' .
            $safeFileName .
            '"'
        );

        $response->setBody(
            file_get_contents($filePath)
        );

        return $response;
    }


    /* =========================================================
       GET ALL TICKETS
    ========================================================= */

    private function allTickets(): array
    {
        return $this->tickets
            ->orderBy('id', 'DESC')
            ->findAll();
    }


    /* =========================================================
       DECORATE TICKET
    ========================================================= */

    private function decorate(array $ticket): array
    {
        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        $ticket['status_tampilan'] = $this->label(
            $ticket['status'] ?? 'submitted'
        );


        /*
        |--------------------------------------------------------------------------
        | Dokumen hasil
        |--------------------------------------------------------------------------
        |
        | result_file berasal dari kolom keuangan_tickets.
        |
        */

        $ticket['dokumen_hasil'] = [];

        if (!empty($ticket['result_file'])) {

            $ticket['dokumen_hasil'][] = [
                'nama_file'  => $ticket['result_file'],
                'nama_asli'  => $ticket['result_file'],
                'file_name'  => $ticket['result_file'],
                'original_name' => $ticket['result_file'],
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | Data tambahan untuk view
        |--------------------------------------------------------------------------
        */

        $ticket['catatan'] = $ticket['admin_note'] ?? '';

        $ticket['deskripsi'] =
            $ticket['description'] ?? '-';

        $ticket['nama_layanan'] =
            $ticket['service_name'] ?? '-';

        $ticket['nama_unit'] =
            self::UNIT;

        $ticket['nama_pemohon'] =
            $ticket['applicant_name'] ?? '-';

        /*
        | Alias nomor tiket
        */

        $ticket['no_tiket'] =
            $ticket['ticket_number']
            ?? $ticket['no_tiket']
            ?? '-';


        /*
        | Alias identitas
        */

        $ticket['nik'] =
            $ticket['nik']
            ?? $ticket['nim']
            ?? $ticket['identity_number']
            ?? '-';


        /*
        | Nama layanan
        */

        $ticket['layanan'] =
            $ticket['service_name']
            ?? '-';


        return $ticket;
    }


    /* =========================================================
       LABEL STATUS
    ========================================================= */

    private function label(string $status): string
    {
        return [
            'submitted'  => 'Menunggu',
            'processing' => 'Diproses',
            'completed'  => 'Selesai',
            'rejected'   => 'Ditolak',
            'cancelled'  => 'Dibatalkan',
        ][strtolower($status)] ?? ucfirst($status);
    }


    /* =========================================================
       VIEW DATA
    ========================================================= */

    private function viewData(array $tickets): array
    {
        $counts = [
            'menunggu' => 0,
            'diproses' => 0,
            'selesai'  => 0,
            'ditolak'  => 0,
        ];

        foreach ($tickets as $ticket) {

            $key = [
                'submitted'  => 'menunggu',
                'processing' => 'diproses',
                'completed'  => 'selesai',
                'rejected'   => 'ditolak',
            ][$ticket['status'] ?? ''] ?? null;

            if ($key) {
                $counts[$key]++;
            }
        }

        return [
            'title'            => 'Dashboard Keuangan',
            'unit'             => self::UNIT,
            'tickets'          => $tickets,
            'tiket'            => $tickets,
            'total'            => count($tickets),
            'totalTiket'       => count($tickets),
            ...$counts,
            'statistikLayanan' => [],
            'dataTiketUrl'     => site_url(
                'keuangan/data-tiket'
            ),
        ];
    }


    /* =========================================================
       UPDATE STATUS
    ========================================================= */

    private function updateStatus(
        int $id,
        string $status
    ) {
        $ticket = $this->tickets->find($id);

        if (!$ticket) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket tidak ditemukan.'
                );
        }

        $data = [
            'status' => $status,
        ];

        if ($status === 'processing') {
            $data['processed_at'] =
                date('Y-m-d H:i:s');
        }

        if ($status === 'completed') {
            $data['completed_at'] =
                date('Y-m-d H:i:s');
        }

        $this->tickets->update(
            $id,
            $data
        );

        $this->log(
            'STATUS_CHANGED',
            'Mengubah status tiket ' .
            ($ticket['ticket_number'] ?? '-'),
            $id,
            $status
        );

        return redirect()
            ->to(base_url('keuangan/detail/' . $id))
            ->with(
                'success',
                'Status tiket berhasil diperbarui.'
            );
    }


    /* =========================================================
       LOG
    ========================================================= */

    private function log(
        string $action,
        string $activity,
        ?int $ticketId = null,
        ?string $status = null,
        ?string $note = null
    ): void {

        db_connect()
            ->table('keuangan_activity_logs')
            ->insert([
                'user_id' => (int) session()->get('user_id') ?: null,
                'ticket_id' => $ticketId,
                'action' => $action,
                'activity' => $activity,
                'status' => $status,
                'note' => $note,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
    }
}