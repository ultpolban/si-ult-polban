<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DokumenHasilModel;

class UnitLayanan extends BaseController
{
    protected $db;
    protected $dokumenHasilModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();

        $this->dokumenHasilModel = new DokumenHasilModel();
    }

    /* =========================================================
     * CEK TABEL
     * ========================================================= */
    private function tableExists(string $table): bool
    {
        try {
            return $this->db->tableExists($table);
        } catch (\Throwable $e) {
            return false;
        }
    }

    /* =========================================================
     * CEK KOLOM
     * ========================================================= */
    private function fieldExists(string $field, string $table): bool
    {
        try {
            return $this->db->fieldExists($field, $table);
        } catch (\Throwable $e) {
            return false;
        }
    }

    /* =========================================================
     * CARI KOLOM
     * ========================================================= */
    private function findField(string $table, array $fields): ?string
    {
        foreach ($fields as $field) {
            if ($this->fieldExists($field, $table)) {
                return $field;
            }
        }

        return null;
    }

    /* =========================================================
     * CARI ID PENANGANAN TIKET
     * ========================================================= */
    private function getPenangananId($ticketId)
    {
        if (!$this->tableExists('penanganan_tiket')) {
            return $ticketId;
        }

        $ticketField = $this->findField(
            'penanganan_tiket',
            [
                'ticket_id',
                'tiket_id',
                'pengajuan_tiket_id'
            ]
        );

        $idField = $this->findField(
            'penanganan_tiket',
            [
                'id'
            ]
        );

        if (
            $ticketField === null ||
            $idField === null
        ) {
            return $ticketId;
        }

        try {

            $row = $this->db
                ->table('penanganan_tiket')
                ->where(
                    $ticketField,
                    $ticketId
                )
                ->orderBy(
                    $idField,
                    'DESC'
                )
                ->get(1)
                ->getRowArray();

            if (!empty($row[$idField])) {
                return $row[$idField];
            }

        } catch (\Throwable $e) {

            return $ticketId;
        }

        return $ticketId;
    }

    /* =========================================================
     * AMBIL DOKUMEN HASIL
     * ========================================================= */
    private function getDokumenHasil($ticketId): array
    {
        if (!$this->tableExists('dokumen_hasil')) {
            return [];
        }

        if (
            !$this->fieldExists(
                'penanganan_id',
                'dokumen_hasil'
            )
        ) {
            return [];
        }

        try {

            $penangananId =
                $this->getPenangananId(
                    $ticketId
                );

            return $this->db
                ->table('dokumen_hasil')
                ->where(
                    'penanganan_id',
                    $penangananId
                )
                ->orderBy(
                    'id',
                    'DESC'
                )
                ->get()
                ->getResultArray();

        } catch (\Throwable $e) {

            return [];
        }
    }

    /* =========================================================
     * FORMAT STATUS
     * ========================================================= */
    private function formatStatus($status): string
    {
        $status = strtolower(trim((string) $status));

        $map = [
            'draft'        => 'Draft',

            'submitted'    => 'Menunggu',
            'menunggu'     => 'Menunggu',

            'verification' => 'Verifikasi',
            'verifikasi'   => 'Verifikasi',

            'revision'     => 'Revisi',
            'revisi'       => 'Revisi',

            'processing'   => 'Diproses',
            'diproses'     => 'Diproses',

            'completed'    => 'Selesai',
            'selesai'      => 'Selesai',

            'rejected'     => 'Ditolak',
            'ditolak'      => 'Ditolak',

            'cancelled'    => 'Dibatalkan',
            'dibatalkan'   => 'Dibatalkan',
        ];

        return $map[$status] ?? ucfirst($status);
    }

    /* =========================================================
     * FORMAT TIKET
     * ========================================================= */
    private function formatTicket(array $ticket): array
    {
        $ticketNumber =
            $ticket['ticket_number']
            ?? $ticket['no_tiket']
            ?? (
                'TKT-' .
                date(
                    'Ymd',
                    strtotime(
                        $ticket['created_at']
                        ?? $ticket['tanggal']
                        ?? date('Y-m-d')
                    )
                ) .
                '-' .
                str_pad(
                    (string) ($ticket['id'] ?? ''),
                    3,
                    '0',
                    STR_PAD_LEFT
                )
            );

        $namaPemohon =
            $ticket['user_name']
            ?? $ticket['nama_pemohon']
            ?? $ticket['name']
            ?? 'Pemohon';

        $nik =
            $ticket['nik']
            ?? $ticket['NIK']
            ?? '-';

        $createdAt =
            $ticket['created_at']
            ?? $ticket['submitted_at']
            ?? $ticket['tanggal']
            ?? null;

        return [

            'id' =>
                $ticket['id'] ?? null,

            'no_tiket' =>
                $ticketNumber,

            'ticket_number' =>
                $ticketNumber,

            'judul' =>
                $ticket['title']
                ?? $ticket['judul']
                ?? 'Permohonan Layanan',

            'title' =>
                $ticket['title']
                ?? $ticket['judul']
                ?? 'Permohonan Layanan',

            'deskripsi' =>
                $ticket['description']
                ?? $ticket['deskripsi']
                ?? '-',

            'description' =>
                $ticket['description']
                ?? $ticket['deskripsi']
                ?? '-',

            'status' =>
                $this->formatStatus(
                    $ticket['status'] ?? 'submitted'
                ),

            'status_database' =>
                $ticket['status'] ?? 'submitted',

            'priority' =>
                $ticket['priority'] ?? 'normal',

            'user_profile_id' =>
                $ticket['user_profile_id'] ?? null,

            'service_id' =>
                $ticket['service_id'] ?? null,

            'assigned_to' =>
                $ticket['assigned_to'] ?? null,

            'created_at' =>
                $createdAt,

            'tanggal' =>
                $createdAt,

            'updated_at' =>
                $ticket['updated_at'] ?? null,

            'submitted_at' =>
                $ticket['submitted_at'] ?? null,

            'verified_at' =>
                $ticket['verified_at'] ?? null,

            'processed_at' =>
                $ticket['processed_at'] ?? null,

            'completed_at' =>
                $ticket['completed_at'] ?? null,

            'rejected_at' =>
                $ticket['rejected_at'] ?? null,

            'cancelled_at' =>
                $ticket['cancelled_at'] ?? null,

            'admin_note' =>
                $ticket['admin_note']
                ?? $ticket['catatan']
                ?? '',

            'catatan' =>
                $ticket['admin_note']
                ?? $ticket['catatan']
                ?? '',

            'nama_layanan' =>
                $ticket['service_name']
                ?? $ticket['nama_layanan']
                ?? $ticket['title']
                ?? 'Layanan',

            'nama_kategori' =>
                $ticket['category_name']
                ?? $ticket['nama_kategori']
                ?? 'Layanan ULT',

            'nama_unit' =>
                $ticket['unit_name']
                ?? $ticket['nama_unit']
                ?? 'Unit Layanan',

            'nama_pemohon' =>
                $namaPemohon,

            'nik' =>
                ($nik === '' || $nik === null)
                    ? '-'
                    : $nik,

            'nim' =>
                $ticket['nim'] ?? '-',

            'email' =>
                $ticket['email'] ?? '-',

            'no_hp' =>
                $ticket['no_hp'] ?? '-',

            'file_pendukung' =>
                $ticket['file_pendukung'] ?? null,

            'dokumen_hasil' =>
                [],

            'sent_to_ult' =>
                (int) ($ticket['sent_to_ult'] ?? 0),

            'sent_to_ult_at' =>
                $ticket['sent_to_ult_at'] ?? null,

            'sent_to_applicant' =>
                (int) ($ticket['sent_to_applicant'] ?? 0),

            'sent_to_applicant_at' =>
                $ticket['sent_to_applicant_at'] ?? null,
        ];
    }

    /* =========================================================
     * QUERY TIKET
     * ========================================================= */
    private function ticketBuilder()
    {
        if (!$this->tableExists('tickets')) {
            return null;
        }

        $builder = $this->db
            ->table('tickets t')
            ->select('t.*');

        /* =====================================================
         * MASTER SERVICES
         * ===================================================== */
        if ($this->tableExists('master_services')) {

            $serviceNameField = $this->findField(
                'master_services',
                [
                    'name',
                    'service_name',
                    'title',
                    'nama_layanan'
                ]
            );

            $builder->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            );

            if ($serviceNameField !== null) {

                $builder->select(
                    'ms.' .
                    $serviceNameField .
                    ' AS service_name'
                );
            }
        }

        /* =====================================================
         * MASTER CATEGORY
         * ===================================================== */
        $categoryJoined = false;

        if (
            $this->tableExists('master_services') &&
            $this->tableExists('master_service_categories')
        ) {

            $categoryField = $this->findField(
                'master_services',
                [
                    'service_category_id',
                    'master_service_category_id',
                    'kategori_id'
                ]
            );

            if ($categoryField !== null) {

                $categoryNameField = $this->findField(
                    'master_service_categories',
                    [
                        'name',
                        'category_name',
                        'nama_kategori',
                        'title'
                    ]
                );

                if ($categoryNameField !== null) {

                    $builder->join(
                        'master_service_categories msc',
                        'msc.id = ms.' . $categoryField,
                        'left'
                    );

                    $builder->select(
                        'msc.' .
                        $categoryNameField .
                        ' AS category_name'
                    );

                    $categoryJoined = true;
                }
            }
        }

        /* =====================================================
         * MASTER UNIT
         * ===================================================== */
        if ($this->tableExists('master_service_units')) {

            $unitNameField = $this->findField(
                'master_service_units',
                [
                    'name',
                    'unit_name',
                    'nama_unit',
                    'title'
                ]
            );

            if ($unitNameField !== null) {

                $unitFieldService = null;

                if ($this->tableExists('master_services')) {

                    $unitFieldService = $this->findField(
                        'master_services',
                        [
                            'service_unit_id',
                            'master_service_unit_id',
                            'unit_id',
                            'unit_layanan_id'
                        ]
                    );
                }

                /* UNIT LANGSUNG DI SERVICE */
                if ($unitFieldService !== null) {

                    $builder->join(
                        'master_service_units msu',
                        'msu.id = ms.' . $unitFieldService,
                        'left'
                    );

                    $builder->select(
                        'msu.' .
                        $unitNameField .
                        ' AS unit_name'
                    );
                }

                /* UNIT MELALUI CATEGORY */
                elseif (
                    $categoryJoined &&
                    $this->tableExists(
                        'master_service_categories'
                    )
                ) {

                    $unitFieldCategory = $this->findField(
                        'master_service_categories',
                        [
                            'service_unit_id',
                            'master_service_unit_id',
                            'unit_id',
                            'unit_layanan_id'
                        ]
                    );

                    if ($unitFieldCategory !== null) {

                        $builder->join(
                            'master_service_units msu',
                            'msu.id = msc.' .
                            $unitFieldCategory,
                            'left'
                        );

                        $builder->select(
                            'msu.' .
                            $unitNameField .
                            ' AS unit_name'
                        );
                    }
                }
            }
        }

        return $builder;
    }

    /* =========================================================
     * GET 1 TIKET
     * ========================================================= */
    private function getTicket($id)
    {
        $builder = $this->ticketBuilder();

        if ($builder === null) {
            return null;
        }

        return $builder
            ->where('t.id', $id)
            ->get()
            ->getRowArray();
    }

    /* =========================================================
     * GET SEMUA TIKET
     * ========================================================= */
    private function getAllTickets(): array
    {
        $builder = $this->ticketBuilder();

        if ($builder === null) {
            return [];
        }

        return $builder
            ->orderBy('t.id', 'DESC')
            ->get()
            ->getResultArray();
    }

    /* =========================================================
     * GET TIKET PER UNIT
     * ========================================================= */
    private function getTicketsByUnit(
        string $namaUnit,
        ?int $limit = null
    ): array {

        $tickets = $this->getAllTickets();

        if (empty($tickets)) {
            return [];
        }

        $hasil = [];

        foreach ($tickets as $ticket) {

            $unit = trim(
                (string) (
                    $ticket['unit_name']
                    ?? $ticket['nama_unit']
                    ?? ''
                )
            );

            if (
                strcasecmp(
                    $unit,
                    $namaUnit
                ) === 0
            ) {

                $hasil[] = $ticket;
            }
        }

        /* FALLBACK AKADEMIK */
        if (
            empty($hasil) &&
            strcasecmp(
                $namaUnit,
                'Akademik'
            ) === 0
        ) {

            foreach ($tickets as $ticket) {

                $gabungan = strtolower(
                    (
                        $ticket['service_name']
                        ?? ''
                    ) .
                    ' ' .
                    (
                        $ticket['category_name']
                        ?? ''
                    ) .
                    ' ' .
                    (
                        $ticket['title']
                        ?? ''
                    )
                );

                if (
                    str_contains(
                        $gabungan,
                        'akademik'
                    ) ||
                    str_contains(
                        $gabungan,
                        'aktif kuliah'
                    )
                ) {

                    $hasil[] = $ticket;
                }
            }
        }

        /* URUTKAN TERBARU */
        usort(
            $hasil,
            function ($a, $b) {

                return
                    (int) ($b['id'] ?? 0)
                    <=>
                    (int) ($a['id'] ?? 0);
            }
        );

        if ($limit !== null) {

            $hasil = array_slice(
                $hasil,
                0,
                $limit
            );
        }

        return $hasil;
    }

    /* =========================================================
     * FORMAT TIKET PER UNIT
     * ========================================================= */
    private function getFormattedTicketsByUnit(
        string $namaUnit,
        ?int $limit = null
    ): array {

        $tickets = $this->getTicketsByUnit(
            $namaUnit,
            $limit
        );

        $dataTiket = [];

        foreach ($tickets as $ticket) {

            $dataTiket[] =
                $this->formatTicket(
                    $ticket
                );
        }

        return $dataTiket;
    }

    /* =========================================================
     * INDEX
     * ========================================================= */
    public function index()
    {
        return redirect()->to(
            base_url(
                'unit-layanan/dashboard'
            )
        );
    }

    /* =========================================================
     * DASHBOARD UNIT LAYANAN UMUM
     * ========================================================= */
    public function dashboard()
    {
        return $this->dashboardUnit(
            'Unit Layanan'
        );
    }

    /* =========================================================
     * DASHBOARD AKADEMIK
     * ========================================================= */
    public function akademik()
    {
        return $this->dashboardUnit(
            'Akademik'
        );
    }

    /* =========================================================
     * DASHBOARD KEUANGAN
     * ========================================================= */
    public function keuangan()
    {
        return $this->dashboardUnit(
            'Keuangan'
        );
    }

    /* =========================================================
     * DASHBOARD KEMAHASISWAAN
     * ========================================================= */
    public function kemahasiswaan()
    {
        return $this->dashboardUnit(
            'Kemahasiswaan'
        );
    }

    /* =========================================================
     * DASHBOARD PER UNIT
     * ========================================================= */
    private function dashboardUnit(
        string $namaUnit
    ) {

        $allUnitTickets =
            $this->getTicketsByUnit(
                $namaUnit
            );

        $menunggu = 0;
        $diproses = 0;
        $selesai = 0;

        $total = count(
            $allUnitTickets
        );

        foreach (
            $allUnitTickets as $ticket
        ) {

            $status = strtolower(
                trim(
                    (string) (
                        $ticket['status']
                        ?? ''
                    )
                )
            );

            /* MENUNGGU */
            if (
                in_array(
                    $status,
                    [
                        'submitted',
                        'menunggu',
                        'verification',
                        'verifikasi',
                        'revision',
                        'revisi'
                    ],
                    true
                )
            ) {

                $menunggu++;
            }

            /* DIPROSES */
            if (
                in_array(
                    $status,
                    [
                        'processing',
                        'diproses'
                    ],
                    true
                )
            ) {

                $diproses++;
            }

            /* SELESAI */
            if (
                in_array(
                    $status,
                    [
                        'completed',
                        'selesai'
                    ],
                    true
                )
            ) {

                $selesai++;
            }
        }

        return view(
            'unit_layanan/dashboard',
            [
                'title' =>
                    'Dashboard ' .
                    $namaUnit,

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
            ]
        );
    }

    /* =========================================================
     * DATA TIKET UNIT LAYANAN UMUM
     * ========================================================= */
    public function dataTiket()
    {
        $keyword = trim(
            (string) $this->request->getGet(
                'keyword'
            )
        );

        $tickets = $this->getAllTickets();

        $dataTiket = [];

        foreach ($tickets as $ticket) {

            $dataTiket[] =
                $this->formatTicket(
                    $ticket
                );
        }

        if ($keyword !== '') {

            $search =
                strtolower(
                    $keyword
                );

            $dataTiket =
                array_values(
                    array_filter(
                        $dataTiket,
                        function ($row)
                        use ($search) {

                            $fields = [

                                $row['no_tiket']
                                    ?? '',

                                $row['nama_pemohon']
                                    ?? '',

                                $row['nik']
                                    ?? '',

                                $row['nim']
                                    ?? '',

                                $row['nama_layanan']
                                    ?? '',

                                $row['nama_unit']
                                    ?? '',

                                $row['status']
                                    ?? '',
                            ];

                            foreach (
                                $fields
                                as $field
                            ) {

                                if (
                                    str_contains(
                                        strtolower(
                                            (string)
                                            $field
                                        ),
                                        $search
                                    )
                                ) {

                                    return true;
                                }
                            }

                            return false;
                        }
                    )
                );
        }

        return view(
            'unit_layanan/data_tiket',
            [
                'title' =>
                    'Data Tiket',

                'nama_unit' =>
                    'Semua Unit',

                'tiket' =>
                    $dataTiket,

                'keyword' =>
                    $keyword,
            ]
        );
    }

    /* =========================================================
     * DATA TIKET AKADEMIK
     * ========================================================= */
    public function dataTiketAkademik()
    {
        return $this->dataTiketUnit(
            'Akademik'
        );
    }

    /* =========================================================
     * DATA TIKET KEUANGAN
     * ========================================================= */
    public function dataTiketKeuangan()
    {
        return $this->dataTiketUnit(
            'Keuangan'
        );
    }

    /* =========================================================
     * DATA TIKET KEMAHASISWAAN
     * ========================================================= */
    public function dataTiketKemahasiswaan()
    {
        return $this->dataTiketUnit(
            'Kemahasiswaan'
        );
    }

    /* =========================================================
     * DATA TIKET UNIT
     * ========================================================= */
    private function dataTiketUnit(
        string $namaUnit
    ) {

        $keyword = trim(
            (string) $this->request->getGet(
                'keyword'
            )
        );

        $dataTiket =
            $this->getFormattedTicketsByUnit(
                $namaUnit
            );

        if ($keyword !== '') {

            $search =
                strtolower(
                    $keyword
                );

            $dataTiket =
                array_values(
                    array_filter(
                        $dataTiket,
                        function ($row)
                        use ($search) {

                            $fields = [

                                $row['no_tiket']
                                    ?? '',

                                $row['nama_pemohon']
                                    ?? '',

                                $row['nik']
                                    ?? '',

                                $row['nim']
                                    ?? '',

                                $row['nama_layanan']
                                    ?? '',

                                $row['nama_unit']
                                    ?? '',

                                $row['status']
                                    ?? '',
                            ];

                            foreach (
                                $fields
                                as $field
                            ) {

                                if (
                                    str_contains(
                                        strtolower(
                                            (string)
                                            $field
                                        ),
                                        $search
                                    )
                                ) {

                                    return true;
                                }
                            }

                            return false;
                        }
                    )
                );
        }

        return view(
            'unit_layanan/data_tiket',
            [
                'title' =>
                    'Data Tiket ' .
                    $namaUnit,

                'nama_unit' =>
                    $namaUnit,

                'tiket' =>
                    $dataTiket,

                'keyword' =>
                    $keyword,
            ]
        );
    }

    /* =========================================================
     * DETAIL
     * ========================================================= */
    public function detail($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        $tiket =
            $this->formatTicket(
                $ticket
            );

        $tiket['dokumen_hasil'] =
            $this->getDokumenHasil($id);

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

    /* =========================================================
     * DETAIL AKADEMIK
     * ========================================================= */
    public function detailAkademik($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->to(
                    base_url(
                        'akademik/data-tiket'
                    )
                )
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        $tiket =
            $this->formatTicket(
                $ticket
            );

        $tiket['dokumen_hasil'] =
            $this->getDokumenHasil($id);

        return view(
            'unit_layanan/detail',
            [
                'title' =>
                    'Detail Tiket Akademik',

                'tiket' =>
                    $tiket,
            ]
        );
    }

    /* =========================================================
     * PROSES
     * ========================================================= */
    public function proses($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        return view(
            'unit_layanan/proses',
            [
                'title' =>
                    'Proses Tiket',

                'tiket' =>
                    $this->formatTicket(
                        $ticket
                    ),
            ]
        );
    }

    /* =========================================================
     * UPDATE PROSES
     * ========================================================= */
    public function updateProses($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        $statusInput = trim(
            (string)
            $this->request->getPost(
                'status'
            )
        );

        $catatan = trim(
            (string)
            $this->request->getPost(
                'catatan'
            )
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

        $statusMap = [

            'menunggu' =>
                'submitted',

            'submitted' =>
                'submitted',

            'verifikasi' =>
                'verification',

            'verification' =>
                'verification',

            'revisi' =>
                'revision',

            'revision' =>
                'revision',

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

            'dibatalkan' =>
                'cancelled',

            'cancelled' =>
                'cancelled',
        ];

        $statusKey =
            strtolower(
                $statusInput
            );

        if (
            !isset(
                $statusMap[
                    $statusKey
                ]
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
            $statusMap[
                $statusKey
            ];

        $now =
            date(
                'Y-m-d H:i:s'
            );

        $data = [];

        if (
            $this->fieldExists(
                'status',
                'tickets'
            )
        ) {

            $data['status'] =
                $status;
        }

        if (
            $this->fieldExists(
                'admin_note',
                'tickets'
            )
        ) {

            $data['admin_note'] =
                $catatan;
        }

        if (
            $this->fieldExists(
                'updated_at',
                'tickets'
            )
        ) {

            $data['updated_at'] =
                $now;
        }

        if (
            $status === 'processing' &&
            $this->fieldExists(
                'processed_at',
                'tickets'
            )
        ) {

            $data['processed_at'] =
                $now;
        }

        if (
            $status === 'completed' &&
            $this->fieldExists(
                'completed_at',
                'tickets'
            )
        ) {

            $data['completed_at'] =
                $now;
        }

        if (
            $status === 'rejected' &&
            $this->fieldExists(
                'rejected_at',
                'tickets'
            )
        ) {

            $data['rejected_at'] =
                $now;
        }

        if (
            $status === 'rejected' &&
            $this->fieldExists(
                'rejection_reason',
                'tickets'
            )
        ) {

            $data['rejection_reason'] =
                $catatan;
        }

        if (!empty($data)) {

            $this->db
                ->table('tickets')
                ->where(
                    'id',
                    $id
                )
                ->update(
                    $data
                );
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Tiket berhasil diperbarui.'
            );
    }

    /* =========================================================
     * PROFILE
     * ========================================================= */
    public function profile()
    {
        $session =
            session();

        return view(
            'unit_layanan/profile',
            [

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
            ]
        );
    }

    /* =========================================================
     * UPDATE PROFILE
     * ========================================================= */
    public function updateProfile()
    {
        $session =
            session();

        $name = trim(
            (string)
            $this->request->getPost(
                'name'
            )
        );

        $nip = trim(
            (string)
            $this->request->getPost(
                'nip'
            )
        );

        $email = trim(
            (string)
            $this->request->getPost(
                'email'
            )
        );

        $no_hp = trim(
            (string)
            $this->request->getPost(
                'no_hp'
            )
        );

        $jabatan = trim(
            (string)
            $this->request->getPost(
                'jabatan'
            )
        );

        if ($name === '') {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'Nama Lengkap wajib diisi.'
                );
        }

        if ($nip === '') {

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    'NIP wajib diisi.'
                );
        }

        if ($email === '') {

            return redirect()
                ->back()
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
                ->back()
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
            ->back()
            ->with(
                'success',
                'Profil berhasil diperbarui.'
            );
    }

    /* =========================================================
     * UPLOAD
     * ========================================================= */
    public function upload($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        return view(
            'unit_layanan/upload',
            [
                'title' =>
                    'Upload Dokumen Hasil',

                'tiket' =>
                    $this->formatTicket(
                        $ticket
                    ),

                'dokumen_hasil' =>
                    $this->getDokumenHasil($id),
            ]
        );
    }

    /* =========================================================
     * SIMPAN UPLOAD
     * ========================================================= */
    public function simpanUpload($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        if (!$this->tableExists('dokumen_hasil')) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tabel dokumen_hasil belum tersedia.'
                );
        }

        if (
            !$this->fieldExists(
                'penanganan_id',
                'dokumen_hasil'
            ) ||
            !$this->fieldExists(
                'nama_file',
                'dokumen_hasil'
            )
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Struktur tabel dokumen_hasil belum sesuai.'
                );
        }

        $files =
            $this->request
                ->getFileMultiple(
                    'file_hasil'
                );

        if (!is_array($files)) {

            $files = $files
                ? [$files]
                : [];
        }

        if (empty($files)) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Silahkan pilih dokumen terlebih dahulu.'
                );
        }

        $uploadPath =
            FCPATH .
            'uploads/hasil';

        if (!is_dir($uploadPath)) {

            mkdir(
                $uploadPath,
                0777,
                true
            );
        }

        $penangananId =
            $this->getPenangananId(
                $id
            );

        $uploaded = 0;

        foreach ($files as $file) {

            if (
                !$file ||
                !$file->isValid() ||
                $file->hasMoved()
            ) {
                continue;
            }

            if (
                $file->getSize() >
                5242880
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

            $newFileName =
                $file->getRandomName();

            $file->move(
                $uploadPath,
                $newFileName
            );

            try {

                $inserted =
                    $this->dokumenHasilModel
                        ->insert(
                            [
                                'penanganan_id' =>
                                    $penangananId,

                                'nama_file' =>
                                    $newFileName,
                            ]
                        );

                if ($inserted) {

                    $uploaded++;
                } else {

                    $filePath =
                        $uploadPath .
                        DIRECTORY_SEPARATOR .
                        $newFileName;

                    if (
                        is_file(
                            $filePath
                        )
                    ) {

                        unlink(
                            $filePath
                        );
                    }
                }

            } catch (\Throwable $e) {

                $filePath =
                    $uploadPath .
                    DIRECTORY_SEPARATOR .
                    $newFileName;

                if (
                    is_file(
                        $filePath
                    )
                ) {

                    unlink(
                        $filePath
                    );
                }
            }
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
            ->back()
            ->with(
                'success',
                $uploaded .
                ' dokumen berhasil diupload.'
            );
    }

    /* =========================================================
     * KIRIM KE PETUGAS ULT
     * ========================================================= */
    public function kirim($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        $status =
            strtolower(
                trim(
                    (string) (
                        $ticket['status']
                        ?? ''
                    )
                )
            );

        if (
            $status !==
            'completed'
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket hanya bisa dikirim setelah status Selesai.'
                );
        }

        $data = [];

        if (
            $this->fieldExists(
                'sent_to_ult',
                'tickets'
            )
        ) {

            $data[
                'sent_to_ult'
            ] = 1;
        }

        if (
            $this->fieldExists(
                'sent_to_ult_at',
                'tickets'
            )
        ) {

            $data[
                'sent_to_ult_at'
            ] =
                date(
                    'Y-m-d H:i:s'
                );
        }

        if (
            $this->fieldExists(
                'updated_at',
                'tickets'
            )
        ) {

            $data[
                'updated_at'
            ] =
                date(
                    'Y-m-d H:i:s'
                );
        }

        if (!empty($data)) {

            $this->db
                ->table('tickets')
                ->where(
                    'id',
                    $id
                )
                ->update(
                    $data
                );
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Tiket berhasil dikirim ke Petugas ULT.'
            );
    }

    /* =========================================================
     * KIRIM KE PEMOHON
     * ========================================================= */
    public function kirimKePemohon($id)
    {
        $ticket =
            $this->getTicket($id);

        if (!$ticket) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Data tiket tidak ditemukan.'
                );
        }

        $status =
            strtolower(
                trim(
                    (string) (
                        $ticket['status']
                        ?? ''
                    )
                )
            );

        if (
            $status !==
            'completed'
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Tiket hanya bisa dikirim ke pemohon setelah status Selesai.'
                );
        }

        $data = [];

        if (
            $this->fieldExists(
                'sent_to_applicant',
                'tickets'
            )
        ) {

            $data[
                'sent_to_applicant'
            ] = 1;
        }

        if (
            $this->fieldExists(
                'sent_to_applicant_at',
                'tickets'
            )
        ) {

            $data[
                'sent_to_applicant_at'
            ] =
                date(
                    'Y-m-d H:i:s'
                );
        }

        if (
            $this->fieldExists(
                'updated_at',
                'tickets'
            )
        ) {

            $data[
                'updated_at'
            ] =
                date(
                    'Y-m-d H:i:s'
                );
        }

        if (!empty($data)) {

            $this->db
                ->table('tickets')
                ->where(
                    'id',
                    $id
                )
                ->update(
                    $data
                );
        }

        return redirect()
            ->back()
            ->with(
                'success',
                'Tiket berhasil dikirim ke Pemohon.'
            );
    }

    /* =========================================================
     * RIWAYAT
     * ========================================================= */
    public function riwayat()
    {
        return redirect()->to(
            base_url(
                'unit-layanan/dashboard'
            )
        );
    }

    /* =========================================================
     * HAPUS DOKUMEN
     * ========================================================= */
    public function hapusDokumen($id)
    {
        return redirect()
            ->back()
            ->with(
                'error',
                'Fitur penghapusan dokumen hasil belum tersedia.'
            );
    }

    /* =========================================================
     * STATISTIK
     * =========================================================
     *
     * PERBAIKAN:
     * Statistik sekarang menggunakan tabel:
     *
     * tickets
     * master_services
     * master_service_categories
     * master_service_units
     *
     * BUKAN:
     * pengajuan_tiket
     * layanan
     * kategori_layanan
     * unit_layanan
     *
     * ========================================================= */
    public function statistik()
    {
        /*
         * Tentukan unit berdasarkan URL
         */
        $uri = strtolower(
            $this->request
                ->getUri()
                ->getPath()
        );

        if (
            str_contains(
                $uri,
                'kemahasiswaan'
            )
        ) {

            $unit = 'Kemahasiswaan';

        } elseif (
            str_contains(
                $uri,
                'keuangan'
            )
        ) {

            $unit = 'Keuangan';

        } elseif (
            str_contains(
                $uri,
                'akademik'
            )
        ) {

            $unit = 'Akademik';

        } else {

            $unit = 'Unit Layanan';
        }


        /*
         * Ambil tiket berdasarkan unit
         *
         * Data diambil dari tabel tickets
         * melalui ticketBuilder().
         */
        $tiket =
            $this->getTicketsByUnit(
                $unit
            );


        /*
         * Jika unit umum "Unit Layanan",
         * tampilkan semua tiket.
         */
        if (
            $unit === 'Unit Layanan'
        ) {

            $tiket =
                $this->getAllTickets();
        }


        /*
         * Statistik
         */
        $totalTiket = 0;
        $menunggu = 0;
        $diproses = 0;
        $selesai = 0;

        /*
         * Statistik berdasarkan layanan
         */
        $statistikLayanan = [];


        foreach (
            $tiket as $row
        ) {

            $status =
                strtolower(
                    trim(
                        (string) (
                            $row['status']
                            ?? ''
                        )
                    )
                );


            /*
             * Tiket ditolak tidak dihitung
             */
            if (
                in_array(
                    $status,
                    [
                        'rejected',
                        'ditolak'
                    ],
                    true
                )
            ) {
                continue;
            }


            /*
             * Tiket dibatalkan juga tidak
             * dihitung sebagai statistik utama.
             */
            if (
                in_array(
                    $status,
                    [
                        'cancelled',
                        'dibatalkan'
                    ],
                    true
                )
            ) {
                continue;
            }


            /*
             * Total tiket
             */
            $totalTiket++;


            /*
             * MENUNGGU
             */
            if (
                in_array(
                    $status,
                    [
                        'submitted',
                        'menunggu',
                        'verification',
                        'verifikasi',
                        'revision',
                        'revisi'
                    ],
                    true
                )
            ) {

                $menunggu++;
            }


            /*
             * DIPROSES
             */
            elseif (
                in_array(
                    $status,
                    [
                        'processing',
                        'diproses'
                    ],
                    true
                )
            ) {

                $diproses++;
            }


            /*
             * SELESAI
             */
            elseif (
                in_array(
                    $status,
                    [
                        'completed',
                        'selesai'
                    ],
                    true
                )
            ) {

                $selesai++;
            }


            /*
             * STATISTIK BERDASARKAN LAYANAN
             */
            $namaLayanan =
                trim(
                    (string) (
                        $row['service_name']
                        ?? $row['nama_layanan']
                        ?? 'Layanan'
                    )
                );

            if (
                $namaLayanan === ''
            ) {

                $namaLayanan =
                    'Layanan';
            }


            if (
                !isset(
                    $statistikLayanan[
                        $namaLayanan
                    ]
                )
            ) {

                $statistikLayanan[
                    $namaLayanan
                ] = 0;
            }


            $statistikLayanan[
                $namaLayanan
            ]++;
        }


        /*
         * Ubah statistik layanan
         * menjadi array agar mudah
         * digunakan oleh view.
         */
        $statistikLayananFormatted = [];

        foreach (
            $statistikLayanan
            as $namaLayanan => $jumlah
        ) {

            $statistikLayananFormatted[] = [

                'nama_layanan' =>
                    $namaLayanan,

                'jumlah' =>
                    $jumlah,
            ];
        }


        /*
         * Urutkan berdasarkan
         * jumlah tiket terbanyak.
         */
        usort(
            $statistikLayananFormatted,
            function (
                $a,
                $b
            ) {

                return
                    (int) $b['jumlah']
                    <=>
                    (int) $a['jumlah'];
            }
        );


        /*
         * Persentase selesai
         */
        $persentaseSelesai = 0;

        if (
            $totalTiket > 0
        ) {

            $persentaseSelesai =
                round(
                    (
                        $selesai /
                        $totalTiket
                    ) * 100,
                    2
                );
        }


        /*
         * Kirim data ke view
         */
        return view(
            'unit_layanan/statistik',
            [

                'title' =>
                    'Statistik Tiket ' .
                    $unit,

                'unit' =>
                    $unit,

                'nama_unit' =>
                    $unit,

                'tiket' =>
                    $tiket,

                'totalTiket' =>
                    $totalTiket,

                'menunggu' =>
                    $menunggu,

                'diproses' =>
                    $diproses,

                'selesai' =>
                    $selesai,

                'persentaseSelesai' =>
                    $persentaseSelesai,

                'statistikLayanan' =>
                    $statistikLayananFormatted,
            ]
        );
    }
}
