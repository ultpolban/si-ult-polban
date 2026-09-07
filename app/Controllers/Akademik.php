<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TicketModel;
use App\Models\DokumenHasilModel;

class Akademik extends BaseController
{
    protected $db;
    protected $ticketModel;
    protected $dokumenHasilModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->ticketModel = new TicketModel();
        $this->dokumenHasilModel = new DokumenHasilModel();
    }


    /* =====================================================
       AMBIL SEMUA TIKET AKADEMIK
    ===================================================== */

    protected function tickets(): array
    {
        return $this->db->table('tickets t')
            ->select(
                't.*,
                 t.ticket_number AS no_tiket,
                 t.title AS judul,
                 t.description AS deskripsi,
                 ms.name AS nama_layanan,
                 msc.name AS nama_kategori,
                 msu.name AS nama_unit'
            )
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_categories msc',
                'msc.id = ms.service_category_id',
                'left'
            )
            ->join(
                'master_service_units msu',
                'msu.id = msc.service_unit_id',
                'left'
            )
            ->where(
                'LOWER(msu.name)',
                'bagian akademik'
            )
            ->orderBy(
                't.id',
                'DESC'
            )
            ->get()
            ->getResultArray();
    }


    /* =====================================================
       NORMALISASI STATUS
    ===================================================== */

    protected function normalizeStatus(string $status): ?string
    {
        $status = strtolower(trim($status));

        $map = [

            'draft'       => 'submitted',
            'submitted'   => 'submitted',
            'menunggu'    => 'submitted',
            'waiting'     => 'submitted',

            'verification' => 'processing',
            'processing'   => 'processing',
            'in_progress'  => 'processing',
            'diproses'     => 'processing',

            'completed'    => 'completed',
            'complete'     => 'completed',
            'selesai'      => 'completed',

            'rejected'     => 'rejected',
            'ditolak'      => 'rejected',

        ];

        return $map[$status] ?? null;
    }


    /* =====================================================
       LABEL STATUS
    ===================================================== */

    protected function statusLabel(string $status): string
    {
        switch ($this->normalizeStatus($status)) {

            case 'submitted':
                return 'Menunggu';

            case 'processing':
                return 'Diproses';

            case 'completed':
                return 'Selesai';

            case 'rejected':
                return 'Ditolak';

            default:
                return 'Menunggu';
        }
    }


    /* =====================================================
       HITUNG STATUS
    ===================================================== */

    protected function statusCounts(array $tickets): array
    {
        $counts = [
            'menunggu' => 0,
            'diproses' => 0,
            'selesai'  => 0,
            'ditolak'  => 0,
        ];

        foreach ($tickets as $ticket) {

            $status = $this->normalizeStatus(
                (string) ($ticket['status'] ?? '')
            );

            switch ($status) {

                case 'submitted':
                    $counts['menunggu']++;
                    break;

                case 'processing':
                    $counts['diproses']++;
                    break;

                case 'completed':
                    $counts['selesai']++;
                    break;

                case 'rejected':
                    $counts['ditolak']++;
                    break;
            }
        }

        return $counts;
    }


    /* =====================================================
       DATA VIEW DASHBOARD
    ===================================================== */

    protected function viewData(array $tickets): array
    {
        $counts = $this->statusCounts($tickets);

        $total = count($tickets);

        return [

            'title' => 'Dashboard Akademik',

            'unit' => 'Akademik',

            'tickets' => $tickets,

            'tiket' => $tickets,

            'total' => $total,

            'totalTiket' => $total,

            'menunggu' => $counts['menunggu'],

            'diproses' => $counts['diproses'],

            'selesai' => $counts['selesai'],

            'ditolak' => $counts['ditolak'],

            'persentaseSelesai' =>
                $total
                    ? round(
                        ($counts['selesai'] / $total) * 100
                    )
                    : 0,

            'statistikLayanan' => [],

            'dataTiketUrl' =>
                site_url('akademik/data-tiket'),

        ];
    }


    /* =====================================================
       INDEX
    ===================================================== */

    public function index()
    {
        return $this->dashboard();
    }


    /* =====================================================
       DASHBOARD
    ===================================================== */

    public function dashboard()
    {
        return view(
            'akademik/dashboard',
            $this->viewData(
                $this->tickets()
            )
        );
    }


    /* =====================================================
       DATA TIKET
    ===================================================== */

    public function dataTiket()
    {
        $tickets = $this->tickets();

        $keyword = trim(
            (string) $this->request->getGet('keyword')
        );

        if ($keyword !== '') {

            $tickets = array_values(
                array_filter(
                    $tickets,
                    static function ($ticket) use ($keyword) {

                        return str_contains(
                            strtolower(
                                implode(
                                    ' ',
                                    array_map(
                                        'strval',
                                        $ticket
                                    )
                                )
                            ),
                            strtolower($keyword)
                        );
                    }
                )
            );
        }

        return view(
            'akademik/data_tiket',
            [

                'tickets' => $tickets,

                'tiket' => $tickets,

                'keyword' => $keyword,

                'unit' => 'Akademik',

                'nama_unit' => 'Akademik',

            ]
        );
    }


    /* =====================================================
       STATISTIK
    ===================================================== */

    public function statistik()
    {
        $tickets = $this->db->table('tickets t')
            ->select('t.status')
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_categories msc',
                'msc.id = ms.service_category_id',
                'left'
            )
            ->join(
                'master_service_units msu',
                'msu.id = msc.service_unit_id',
                'left'
            )
            ->where(
                'LOWER(msu.name)',
                'bagian akademik'
            )
            ->get()
            ->getResultArray();

        return view(
            'akademik/statistik',
            $this->viewData($tickets)
        );
    }


    /* =====================================================
       DETAIL TIKET
    ===================================================== */

    public function detail($id)
    {
        $id = (int) $id;

        $ticket = $this->ticketsById($id);

        if (!$ticket) {

            return redirect()
                ->to('akademik/data-tiket')
                ->with(
                    'error',
                    'Tiket Akademik tidak ditemukan.'
                );
        }

        /*
         * Pastikan status yang dikirim ke view
         * selalu konsisten.
         */
        $ticket['status_normalized'] =
            $this->normalizeStatus(
                (string) ($ticket['status'] ?? '')
            );

        $ticket['status_label'] =
            $this->statusLabel(
                (string) ($ticket['status'] ?? '')
            );

        return view(
            'akademik/detail',
            [
                'tiket' => $ticket,
                'unit' => 'Akademik',
                'nama_unit' => 'Akademik',
            ]
        );
    }


    /* =====================================================
       CARI TIKET BERDASARKAN ID
    ===================================================== */

    protected function ticketsById(int $id): ?array
    {
        $ticket = $this->db->table('tickets t')
            ->select(
                't.*,
                 t.ticket_number AS no_tiket,
                 t.title AS judul,
                 t.description AS deskripsi,
                 ms.name AS nama_layanan,
                 msc.name AS nama_kategori,
                 msu.name AS nama_unit'
            )
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_categories msc',
                'msc.id = ms.service_category_id',
                'left'
            )
            ->join(
                'master_service_units msu',
                'msu.id = msc.service_unit_id',
                'left'
            )
            ->where(
                't.id',
                $id
            )
            ->where(
                'LOWER(msu.name)',
                'bagian akademik'
            )
            ->get()
            ->getRowArray();

        if ($ticket) {
            return $ticket;
        }

        return null;
    }


    /* =====================================================
       HALAMAN PROSES TIKET
    ===================================================== */

    public function proses($id)
    {
        $id = (int) $id;

        $ticket = $this->ticketsById($id);

        if (!$ticket) {

            return redirect()
                ->to('akademik/data-tiket')
                ->with(
                    'error',
                    'Tiket Akademik tidak ditemukan.'
                );
        }

        return view(
            'akademik/proses',
            [
                'tiket' => $ticket,
                'unit' => 'Akademik',
                'nama_unit' => 'Akademik',
            ]
        );
    }


    /* =====================================================
       RIWAYAT
    ===================================================== */

    public function riwayat()
    {
        return view(
            'akademik/riwayat',
            [
                'tickets' => $this->tickets(),
                'unit' => 'Akademik',
            ]
        );
    }


    /* =====================================================
       LOG AKTIVITAS
    ===================================================== */

    public function logAktivitas()
    {
        $logs = $this->db
            ->table('activity_logs al')
            ->select(
                'al.reference_id AS ticket_id,
                 t.ticket_number AS no_tiket,
                 msu.name AS unit,
                 ms.name AS layanan,
                 al.action AS aktivitas,
                 t.status,
                 al.created_at AS waktu'
            )
            ->join(
                'tickets t',
                't.id = al.reference_id',
                'inner'
            )
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'inner'
            )
            ->join(
                'master_service_categories msc',
                'msc.id = ms.service_category_id',
                'inner'
            )
            ->join(
                'master_service_units msu',
                'msu.id = msc.service_unit_id',
                'inner'
            )
            ->where(
                'al.module',
                'Akademik'
            )
            ->where(
                'LOWER(msu.name)',
                'bagian akademik'
            )
            ->orderBy(
                'al.created_at',
                'DESC'
            )
            ->get()
            ->getResultArray();

        return view(
            'akademik/log_aktivitas',
            [
                'unit' => 'Akademik',
                'units' => [
                    'Bagian Akademik'
                ],
                'logs' => $logs,
                'keyword' => '',
            ]
        );
    }


    /* =====================================================
       PROFILE
    ===================================================== */

    public function profile()
    {
        return view(
            'akademik/profile',
            [
                'unit' => 'Akademik'
            ]
        );
    }


    /* =====================================================
       UPDATE PROFILE
    ===================================================== */

    public function updateProfile()
    {
        return redirect()
            ->to('akademik/profile');
    }


    /* =====================================================
       UPDATE PROSES TIKET
    ===================================================== */

    public function updateProses($id)
    {
        $id = (int) $id;

        $ticket = $this->ticketsById($id);

        if (!$ticket) {

            return redirect()
                ->to('akademik/data-tiket')
                ->with(
                    'error',
                    'Tiket Akademik tidak ditemukan.'
                );
        }

        $statusInput = trim(
            (string) $this->request->getPost('status')
        );

        $catatan = trim(
            (string) (
                $this->request->getPost('catatan')
                ??
                $this->request->getPost('admin_note')
                ??
                ''
            )
        );

        /*
         * NORMALISASI STATUS
         *
         * Semua tiket memakai status database:
         *
         * submitted
         * processing
         * completed
         * rejected
         */

        $status = $this->normalizeStatus(
            $statusInput
        );

        if ($status === null) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Status tiket tidak valid.'
                );
        }


        $oldStatus = $ticket['status'] ?? null;

        /*
         * UPDATE DATABASE
         */

        $updateData = [

            'status' => $status,

            'admin_note' => $catatan,

        ];


        $updated = $this->ticketModel
            ->where(
                'id',
                $id
            )
            ->set(
                $updateData
            )
            ->update();


        if (!$updated) {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Status tiket gagal diperbarui.'
                );
        }


        /*
         * LOG PERUBAHAN STATUS
         */

        $now = date(
            'Y-m-d H:i:s'
        );

        $this->db
            ->table('activity_logs')
            ->insert(
                [

                    'user_id' =>
                        session()->get('user_id')
                        ?: null,

                    'action' =>
                        'Mengubah status tiket menjadi '
                        . $this->statusLabel($status),

                    'module' =>
                        'Akademik',

                    'reference_id' =>
                        (string) $id,

                    'old_data' =>
                        json_encode(
                            [
                                'status' =>
                                    $oldStatus,
                            ]
                        ),

                    'new_data' =>
                        json_encode(
                            [
                                'ticket_id' =>
                                    $id,

                                'ticket_number' =>
                                    $ticket['ticket_number']
                                    ?? null,

                                'status' =>
                                    $status,

                                'status_label' =>
                                    $this->statusLabel($status),

                                'catatan' =>
                                    $catatan,

                                'waktu' =>
                                    $now,
                            ]
                        ),

                    'ip_address' =>
                        $this->request
                            ->getIPAddress(),

                    'user_agent' =>
                        $this->request
                            ->getUserAgent()
                            ->getAgentString(),

                    'created_at' =>
                        $now,

                ]
            );


        return redirect()
            ->to(
                'akademik/detail/' . $id
            )
            ->with(
                'success',
                'Perubahan tiket Akademik berhasil disimpan.'
            );
    }


    /* =====================================================
       UPLOAD DOKUMEN
    ===================================================== */

    public function upload($id)
    {
        $ticket = $this->ticketsById(
            (int) $id
        );

        if (!$ticket) {

            return redirect()
                ->to('akademik/data-tiket')
                ->with(
                    'error',
                    'Tiket Akademik tidak ditemukan.'
                );
        }

        return view(
            'akademik/upload',
            [
                'tiket' => $ticket,
                'unit' => 'Akademik',
            ]
        );
    }


    /* =====================================================
       SIMPAN UPLOAD
    ===================================================== */

    public function simpanUpload($id)
    {
        $id = (int) $id;

        $ticket = $this->ticketsById($id);

        $file =
            $this->request->getFile('dokumen');

        if (
            !$ticket
            ||
            !$file
            ||
            !$file->isValid()
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumen Akademik tidak valid.'
                );
        }

        $name =
            $file->getRandomName();

        $file->move(
            WRITEPATH . 'uploads/hasil',
            $name
        );

        $this->dokumenHasilModel
            ->insert(
                [
                    'penanganan_id' => $id,
                    'nama_file' => $name,
                ]
            );

        return redirect()
            ->to(
                'akademik/detail/' . $id
            )
            ->with(
                'success',
                'Dokumen Akademik berhasil diunggah.'
            );
    }


    /* =====================================================
       KIRIM KE PETUGAS ULT
    ===================================================== */

    public function kirim($id)
    {
        return $this->setStatus(
            (int) $id,
            'sent_to_ult'
        );
    }


    /* =====================================================
       KIRIM KE PEMOHON
    ===================================================== */

    public function kirimKePemohon($id)
    {
        return $this->setStatus(
            (int) $id,
            'sent_to_applicant'
        );
    }


    /* =====================================================
       SET STATUS PENGIRIMAN
       BERLAKU UNTUK SEMUA TIKET
    ===================================================== */

    protected function setStatus(
        $id,
        string $sentFlag
    ) {
        $id = (int) $id;


        /*
         * VALIDASI TUJUAN
         */

        if (
            !in_array(
                $sentFlag,
                [
                    'sent_to_ult',
                    'sent_to_applicant'
                ],
                true
            )
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tujuan pengiriman tidak valid.'
                );
        }


        /*
         * AMBIL TIKET BERDASARKAN ID
         *
         * PENTING:
         * Tidak menggunakan nomor tiket.
         * Jadi tiket 1, tiket 2, tiket 3,
         * semuanya berdiri sendiri.
         */

        $ticket = $this->ticketsById($id);


        if (!$ticket) {

            return redirect()
                ->to('akademik/data-tiket')
                ->with(
                    'error',
                    'Tiket Akademik tidak ditemukan.'
                );
        }


        /*
         * NORMALISASI STATUS
         */

        $ticketStatus =
            $this->normalizeStatus(
                (string) (
                    $ticket['status'] ?? ''
                )
            );


        /*
         * PENGIRIMAN HANYA BOLEH
         * JIKA STATUS SELESAI
         */

        if ($ticketStatus !== 'completed') {

            return redirect()
                ->to(
                    'akademik/detail/' . $id
                )
                ->with(
                    'error',
                    'Tiket harus berstatus Selesai terlebih dahulu.'
                );
        }


        /*
         * WAKTU PENGIRIMAN
         */

        $now =
            date(
                'Y-m-d H:i:s'
            );


        /*
         * DATA UPDATE
         */

        $update = [

            $sentFlag => 1,

            $sentFlag . '_at' => $now,

        ];


        /*
         * UPDATE BERDASARKAN ID TIKET
         */

        $updated =
            $this->ticketModel
                ->where(
                    'id',
                    $id
                )
                ->set(
                    $update
                )
                ->update();


        if (!$updated) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket Akademik gagal diperbarui.'
                );
        }


        /*
         * LOG AKTIVITAS
         */

        $action =
            $sentFlag === 'sent_to_ult'
                ? 'Tiket dikirim ke Petugas ULT'
                : 'Tiket dikirim ke Pemohon';


        $this->db
            ->table('activity_logs')
            ->insert(
                [

                    'user_id' =>
                        session()->get('user_id')
                        ?: null,

                    'action' =>
                        $action,

                    'module' =>
                        'Akademik',

                    'reference_id' =>
                        (string) $id,

                    'old_data' =>
                        json_encode(
                            [

                                'status' =>
                                    $ticket['status']
                                    ?? null,

                                'sent_to_ult' =>
                                    $ticket['sent_to_ult']
                                    ?? 0,

                                'sent_to_applicant' =>
                                    $ticket['sent_to_applicant']
                                    ?? 0,

                            ]
                        ),

                    'new_data' =>
                        json_encode(
                            [

                                'ticket_id' =>
                                    $id,

                                'ticket_number' =>
                                    $ticket['ticket_number']
                                    ?? null,

                                'unit' =>
                                    $ticket['nama_unit']
                                    ?? 'Bagian Akademik',

                                'layanan' =>
                                    $ticket['nama_layanan']
                                    ?? null,

                                'status' =>
                                    'completed',

                                'tujuan' =>
                                    $sentFlag === 'sent_to_ult'
                                        ? 'Petugas ULT'
                                        : 'Pemohon',

                                'waktu_pengiriman' =>
                                    $now,

                            ]
                        ),

                    'ip_address' =>
                        $this->request
                            ->getIPAddress(),

                    'user_agent' =>
                        $this->request
                            ->getUserAgent()
                            ->getAgentString(),

                    'created_at' =>
                        $now,

                ]
            );


        /*
         * PESAN BERHASIL
         */

        return redirect()
            ->to(
                'akademik/detail/' . $id
            )
            ->with(
                'success',
                $sentFlag === 'sent_to_ult'
                    ? 'Tiket Akademik berhasil dikirim ke Petugas ULT.'
                    : 'Tiket Akademik berhasil dikirim ke Pemohon.'
            );
    }


    /* =====================================================
       HAPUS DOKUMEN
    ===================================================== */

    public function hapusDokumen($id)
    {
        if (
            !$this->dokumenHasilModel
                ->deleteForUnit(
                    (int) $id,
                    'Akademik'
                )
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Dokumen Akademik tidak ditemukan.'
                );
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Dokumen Akademik berhasil dihapus.'
            );
    }
}