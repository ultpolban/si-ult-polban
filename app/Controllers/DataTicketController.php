<?php

namespace App\Controllers;

use App\Models\TicketModel;

class DataTicketController extends BaseController
{
    protected $ticketModel;
    protected $db;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * ============================================================
     * HALAMAN UTAMA DATA TIKET
     * ============================================================
     */
    public function index()
    {
        // ========================================================
        // PARAMETER FILTER
        // ========================================================
        $keyword = trim((string) (
            $this->request->getGet('search')
            ?? $this->request->getGet('keyword')
            ?? ''
        ));

        $status = strtolower(trim((string) (
            $this->request->getGet('status')
            ?? ''
        )));

        $category = trim((string) (
            $this->request->getGet('kategori')
            ?? $this->request->getGet('category')
            ?? ''
        ));

        $perPage = (int) (
            $this->request->getGet('limit')
            ?? $this->request->getGet('per_page')
            ?? 10
        );

        if ($perPage < 1) {
            $perPage = 10;
        }

        // ========================================================
        // QUERY DATA
        // ========================================================
        $builder = $this->buildTicketQuery();

        // SEARCH
        if ($keyword !== '') {
            $builder
                ->groupStart()
                    ->like('tickets.ticket_number', $keyword)
                    ->orLike('user_profiles.name', $keyword)
                    ->orLike('user_profiles.student_name', $keyword)
                    ->orLike('user_profiles.nim', $keyword)
                    ->orLike('user_profiles.nik', $keyword)
                    ->orLike('master_services.name', $keyword)
                ->groupEnd();
        }

        // FILTER STATUS
        if ($status !== '') {
            $builder->where(
                'LOWER(tickets.status)',
                $status
            );
        }

        // ========================================================
        // DATA TIKET
        // ========================================================
        $tickets = $builder
            ->orderBy('tickets.submitted_at', 'DESC')
            ->get()
            ->getResultArray();

        log_message('error', 'DEBUG TICKET: ' . print_r($tickets, true));

        // ========================================================
        // MAPPING BACKEND → FRONTEND
        // ========================================================
        foreach ($tickets as &$ticket) {

            $ticket['nomor_tiket'] =
                $ticket['ticket_number']
                ?? '-';

            $ticket['nama_pemohon'] =
                $ticket['applicant_name']
                ?? $ticket['student_name']
                ?? $ticket['name']
                ?? '-';

            $ticket['layanan'] =
                !empty($ticket['service_name'])
                ? $ticket['service_name']
                : ((int) ($ticket['unit_id'] ?? 0) === 1 ? 'Unit Layanan Terpadu' : '-');

            $ticket['unit_layanan'] =
                $ticket['unit_name']
                ?? '-';

            $ticket['kategori'] =
                $ticket['category_name']
                ?? '-';

            $ticket['jumlah_lampiran'] =
    (int) ($ticket['jumlah_lampiran'] ?? 0);

            $ticket['status'] =
                strtolower(
                    trim(
                        $ticket['status']
                        ?? ''
                    )
                );

            $ticket['created_at'] =
    $ticket['submitted_at']
    ?? $ticket['created_at']
    ?? null;

            $ticket['id'] =
                $ticket['id']
                ?? null;
        }

        unset($ticket);

        // ========================================================
        // ADAPTER FRONTEND3
        // ========================================================
        $realTickets = $tickets;
        $dummyTickets = [];
        $filteredTickets = $tickets;
        $tiket_list = $tickets;

        // ========================================================
        // STATISTIK
        // ========================================================
        $jumlahTiket =
            $this->ticketModel
                ->countAllResults();

        $jumlahSubmitted =
            $this->ticketModel
                ->where('status', 'submitted')
                ->countAllResults();

        $jumlahVerified =
            $this->ticketModel
                ->whereIn('status', [
                    'verified',
                    'assigned',
                    'processing',
                    'in_progress',
                    'completed'
                ])
                ->countAllResults();

        $jumlahDisposisi =
            $this->ticketModel
                ->whereIn('status', [
                    'assigned',
                    'processing',
                    'in_progress'
                ])
                ->countAllResults();

        // ========================================================
        // KIRIM KE VIEW
        // ========================================================
        return view('petugas/tiket', [

            // Data utama
            'tickets' => $tickets,


            // Filter
            'perPage' => $perPage,
            'keyword' => $keyword,
            'status' => $status,
            'category' => $category,

            // Statistik
            'totalTickets' => $jumlahTiket,

            'totalPending' =>
                $this->ticketModel
                    ->whereIn('status', [
                        'submitted',
                        'verification'
                    ])
                    ->countAllResults(),

            'totalVerified' =>
                $jumlahVerified,

            'totalProcessed' =>
                $jumlahDisposisi,

            'total_tiket' =>
                $jumlahTiket,

            'submitted' =>
                $jumlahSubmitted,

            // Adapter frontend3
            'realTickets' =>
                $realTickets,

            'dummyTickets' =>
                $dummyTickets,

            'filteredTickets' =>
                $filteredTickets,

            'tiket_list' =>
                $tiket_list,

            // Statistik frontend3
            'jumlahTiket' =>
                $jumlahTiket,

            'jumlahSubmitted' =>
                $jumlahSubmitted,

            'jumlahVerified' =>
                $jumlahVerified,

            'jumlahDisposisi' =>
                $jumlahDisposisi,
        ]);
    }


    /**
     * ============================================================
     * DETAIL DATA TIKET
     * ============================================================
     *
     * GET /datatiket/detail/38
     */
    public function detail($id = null)
    {
        if ($id === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'ID tiket tidak ditemukan'
            );
        }

        // ========================================================
        // AMBIL DATA TIKET
        // ========================================================
        $ticket =
            $this->ticketModel
                ->getTicketDetail($id);

        log_message('error', 'DEBUG DETAIL TICKET: ' . print_r($ticket, true));

        if (!$ticket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Tiket tidak ditemukan'
            );
        }

        // ========================================================
        // NORMALISASI DATA TIKET
        // ========================================================

        // Nomor tiket
        $ticket['nomor_tiket'] =
            $ticket['ticket_number']
            ?? '-';

        // Nama pemohon
        $ticket['nama_pemohon'] =
            $ticket['applicant_name']
            ?? $ticket['student_name']
            ?? $ticket['name']
            ?? '-';

        $ticket['layanan'] =
            !empty($ticket['service_name'])
            ? $ticket['service_name']
            : ((int) ($ticket['unit_id'] ?? 0) === 1 ? 'Unit Layanan Terpadu' : '-');
        // Unit layanan
        $ticket['unit_layanan'] =
            $ticket['unit_name']
            ?? '-';

        // Kategori
        $ticket['kategori'] =
            $ticket['category_name']
            ?? $ticket['applicant_type']
            ?? '-';

        // Status
        $ticket['status'] =
            strtolower(
                trim(
                    $ticket['status']
                    ?? 'submitted'
                )
            );

        // Prioritas
        $ticket['priority'] =
            $ticket['priority']
            ?? 'normal';

        $ticket['prioritas'] =
            $ticket['priority'];

        // ========================================================
        // TANGGAL
        // ========================================================

        $ticket['created_at'] =
            $ticket['created_at']
            ?? $ticket['submitted_at']
            ?? null;

        // ========================================================
        // IDENTITAS PEMOHON
        // ========================================================

        $ticket['nim'] =
            $ticket['nim']
            ?? null;

        $ticket['nik'] =
            $ticket['nik']
            ?? null;

        $ticket['email'] =
            $ticket['email']
            ?? $ticket['applicant_email']
            ?? null;

        $ticket['phone'] =
            $ticket['phone']
            ?? $ticket['applicant_phone']
            ?? null;

        $ticket['no_hp'] =
            $ticket['phone']
            ?? '-';

        // ========================================================
        // JUDUL & DESKRIPSI
        // ========================================================

        $ticket['title'] =
            $ticket['title']
            ?? '';

        $ticket['judul_permohonan'] =
            $ticket['title']
            ?? '-';

        $ticket['description'] =
            $ticket['description']
            ?? '';

        $ticket['keterangan'] =
            $ticket['description']
            ?? '';

        // ========================================================
        // TIMELINE
        // ========================================================

        $timeline =
            $this->buildTimeline($ticket);

        // ========================================================
        // FILE PERSYARATAN
        // ========================================================

        /*
         * PENTING:
         *
         * tickets.id = 38
         *
         * bukan berarti
         *
         * service_request_files.service_request_id = 38
         *
         * Relasinya:
         *
         * tickets.ticket_number
         *        ↓
         * service_requests.ticket_number
         *        ↓
         * service_requests.id
         *        ↓
         * service_request_files.service_request_id
         */
        $attachments =
            $this->getTicketFiles(
                (int) $id,
                $ticket['ticket_number'] ?? null
            );

        // ========================================================
        // KIRIM KE VIEW
        // ========================================================

        return view('petugas/detail', [

            'title' =>
                'Detail Informasi Tiket',

            'ticket' =>
                $ticket,

            'tiket' =>
                $ticket,

            'timeline' =>
                $timeline,

            'attachments' =>
                $attachments,

            'lampiran' =>
                $attachments,
        ]);
    }


    /**
     * ============================================================
     * BUILD TIMELINE
     * ============================================================
     */
    private function buildTimeline(array $ticket): array
    {
        $timeline = [];

        $steps = [
            [
                'field' => 'submitted_at',
                'title' => 'Tiket Berhasil Diajukan',
                'icon'  => 'fa-paper-plane',
            ],
            [
                'field' => 'verified_at',
                'title' => 'Tiket Telah Diverifikasi',
                'icon'  => 'fa-check-circle',
            ],
            [
                'field' => 'processed_at',
                'title' => 'Tiket Sedang Diproses',
                'icon'  => 'fa-cogs',
            ],
            [
                'field' => 'completed_at',
                'title' => 'Permohonan Selesai',
                'icon'  => 'fa-check-double',
            ],
            [
                'field' => 'rejected_at',
                'title' => 'Permohonan Ditolak',
                'icon'  => 'fa-times-circle',
            ],
            [
                'field' => 'cancelled_at',
                'title' => 'Permohonan Dibatalkan',
                'icon'  => 'fa-ban',
            ],
        ];

        foreach ($steps as $step) {

            if (
                isset($ticket[$step['field']])
                && !empty($ticket[$step['field']])
            ) {

                $timestamp =
                    strtotime(
                        $ticket[$step['field']]
                    );

                $timeline[] = [
                    'title' =>
                        $step['title'],

                    'date' =>
                        $ticket[$step['field']],

                    'icon' =>
                        $step['icon'],

                    '_timestamp' =>
                        $timestamp ?: 0,
                ];
            }
        }

        // Urut berdasarkan waktu
        usort(
            $timeline,
            function ($a, $b) {
                return
                    $a['_timestamp']
                    <=>
                    $b['_timestamp'];
            }
        );

        // Hapus field internal
        foreach ($timeline as &$item) {
            unset($item['_timestamp']);
        }

        unset($item);

        return $timeline;
    }


    /**
     * ============================================================
     * AMBIL FILE TIKET
     * ============================================================
     *
     * RELASI DATABASE:
     *
     * tickets
     *    ↓ ticket_number
     *
     * service_requests
     *    ↓ id
     *
     * service_request_files
     *
     * Nama persyaratan:
     *
     * master_service_requirements
     */
    private function getTicketFiles(
        int $ticketId,
        ?string $ticketNumber = null
    ): array {

        $db =
            $this->db;

        // ========================================================
        // CEK TABLE
        // ========================================================

        if (
            !$db->tableExists(
                'service_request_files'
            )
        ) {
            return [];
        }

        if (
            !$db->tableExists(
                'service_requests'
            )
        ) {
            return [];
        }

        // ========================================================
        // JIKA TICKET NUMBER TIDAK DIKIRIM
        // AMBIL DARI TABEL TICKETS
        // ========================================================

        if (
            empty($ticketNumber)
            && $db->tableExists('tickets')
        ) {

            $ticketRow =
                $db
                    ->table('tickets')
                    ->select('ticket_number')
                    ->where(
                        'id',
                        $ticketId
                    )
                    ->get()
                    ->getRowArray();

            if ($ticketRow) {

                $ticketNumber =
                    $ticketRow['ticket_number']
                    ?? null;
            }
        }

        // ========================================================
        // TICKET NUMBER WAJIB ADA
        // ========================================================

        if (empty($ticketNumber)) {
            return [];
        }

        // ========================================================
        // CARI SERVICE REQUEST
        // ========================================================

        $serviceRequest =
            $db
                ->table('service_requests')
                ->select('id')
                ->where(
                    'ticket_number',
                    $ticketNumber
                )
                ->get()
                ->getRowArray();

        if (!$serviceRequest) {
            return [];
        }

        $serviceRequestId =
            (int) $serviceRequest['id'];

        // ========================================================
        // QUERY FILE
        // ========================================================

        $builder =
            $db
                ->table(
                    'service_request_files'
                )
                ->select('
                    service_request_files.*,
                    master_service_requirements.name AS requirement_name
                ')
                ->join(
                    'master_service_requirements',
                    'master_service_requirements.id = service_request_files.requirement_id',
                    'left'
                )
                ->where(
                    'service_request_files.service_request_id',
                    $serviceRequestId
                );

        // ========================================================
        // SOFT DELETE
        // ========================================================

        $fields =
            $db->getFieldNames(
                'service_request_files'
            );

        if (
            in_array(
                'deleted_at',
                $fields,
                true
            )
        ) {

            $builder->where(
                'service_request_files.deleted_at',
                null
            );
        }

        // ========================================================
        // URUTKAN FILE
        // ========================================================

        if (
            in_array(
                'created_at',
                $fields,
                true
            )
        ) {

            $builder->orderBy(
                'service_request_files.created_at',
                'ASC'
            );

        } else {

            $builder->orderBy(
                'service_request_files.id',
                'ASC'
            );
        }

        // ========================================================
        // EKSEKUSI
        // ========================================================

        $files =
            $builder
                ->get()
                ->getResultArray();

        if (empty($files)) {
            return [];
        }

        // ========================================================
        // NORMALISASI
        // ========================================================

        $result = [];

        foreach ($files as $file) {

            // ----------------------------------------------------
            // NAMA FILE
            // ----------------------------------------------------

            $fileName =
                !empty($file['original_name'])
                    ? $file['original_name']
                    : (
                        !empty($file['file_name'])
                            ? $file['file_name']
                            : 'File persyaratan'
                    );

            // ----------------------------------------------------
            // PATH
            // ----------------------------------------------------

            $filePath =
                $file['file_path']
                ?? '';

            // ----------------------------------------------------
            // NAMA PERSYARATAN
            // ----------------------------------------------------

            $requirementName =
                $file['requirement_name']
                ?? 'Persyaratan';

            // ----------------------------------------------------
            // DATA UNTUK VIEW
            // ----------------------------------------------------

            $result[] = [

                // ID file
                'id' =>
                    $file['id']
                    ?? null,

                // ID tiket
                'ticket_id' =>
                    $ticketId,

                // ID service request
                'service_request_id' =>
                    $serviceRequestId,

                // ID requirement
                'requirement_id' =>
                    !empty(
                        $file['requirement_id']
                    )
                        ? (int)
                            $file['requirement_id']
                        : null,

                // Nama requirement
                'requirement_name' =>
                    $requirementName,

                // Nama file asli
                'file_name' =>
                    $fileName,

                'original_name' =>
                    $file['original_name']
                    ?? $fileName,

                // Nama file tersimpan
                'stored_name' =>
                    $file['file_name']
                    ?? null,

                // Path file
                'file_path' =>
                    $filePath,

                // Extension
                'file_extension' =>
                    $file['file_extension']
                    ?? '',

                // MIME
                'mime_type' =>
                    $file['mime_type']
                    ?? '',

                // Ukuran
                'file_size' =>
                    $file['file_size']
                    ?? null,

                // Waktu upload
                'created_at' =>
                    $file['created_at']
                    ?? null,
            ];
        }

        return $result;
    }


    /**
     * ============================================================
     * QUERY DATA TIKET
     * ============================================================
     */
    private function buildTicketQuery()
{
    return $this->ticketModel
        ->select("
            tickets.*,

            COALESCE(
                user_profiles.student_name,
                user_profiles.name
            ) AS applicant_name,

            user_profiles.name,
            user_profiles.student_name,
            user_profiles.nim,
            user_profiles.nik,
            user_profiles.email,
            user_profiles.phone,
            user_profiles.address,
            user_profiles.applicant_type_id,

            master_applicant_types.name AS applicant_type,

            master_services.name AS service_name,
            master_services.service_unit_id,

            COALESCE(
                master_service_units.name,
                unit_direct.name
            ) AS unit_name,

            master_service_categories.id AS category_id,
            master_service_categories.name AS category_name,

            COUNT(service_request_files.id) AS jumlah_lampiran
        ", false)

        ->join(
            'user_profiles',
            'user_profiles.id = tickets.user_profile_id',
            'left'
        )

        ->join(
            'master_applicant_types',
            'master_applicant_types.id = user_profiles.applicant_type_id',
            'left'
        )

        ->join(
            'master_services',
            'master_services.id = tickets.service_id',
            'left'
        )

        ->join(
            'master_service_units',
            'master_service_units.id = master_services.service_unit_id',
            'left'
        )

        ->join(
            'master_service_units unit_direct',
            'unit_direct.id = tickets.unit_id',
            'left'
        )

        ->join(
            'master_service_categories',
            'master_service_categories.id = master_services.service_category_id',
            'left'
        )

        ->join(
            'service_requests',
            'service_requests.ticket_number = tickets.ticket_number',
            'left'
        )

        ->join(
            'service_request_files',
            'service_request_files.service_request_id = service_requests.id',
            'left'
        )

        ->groupBy('tickets.id');
}


    /**
     * ============================================================
     * EXPORT DATA
     * ============================================================
     */
    private function getExportData()
    {
        $keyword = trim((string) (
            $this->request->getGet('search')
            ?? $this->request->getGet('keyword')
            ?? ''
        ));

        $status = strtolower(trim((string) (
            $this->request->getGet('status')
            ?? ''
        )));

        $category = trim((string) (
            $this->request->getGet('kategori')
            ?? $this->request->getGet('category')
            ?? ''
        ));

        $builder =
            $this->buildTicketQuery();

        // SEARCH
        if ($keyword !== '') {

            $builder
                ->groupStart()

                    ->like(
                        'tickets.ticket_number',
                        $keyword
                    )

                    ->orLike(
                        'user_profiles.name',
                        $keyword
                    )

                    ->orLike(
                        'user_profiles.student_name',
                        $keyword
                    )

                    ->orLike(
                        'user_profiles.nim',
                        $keyword
                    )

                    ->orLike(
                        'user_profiles.nik',
                        $keyword
                    )

                    ->orLike(
                        'master_services.name',
                        $keyword
                    )

                ->groupEnd();
        }

        // FILTER STATUS
        if ($status !== '') {

            $builder->where(
                'LOWER(tickets.status)',
                $status
            );
        }

        return $builder
            ->orderBy(
                'tickets.submitted_at',
                'DESC'
            )
            ->findAll();
    }


    /**
     * ============================================================
     * EXPORT CSV
     * ============================================================
     */
    public function exportCsv()
    {
        $tickets =
            $this->getExportData();

        $filename =
            'data-tiket-' .
            date('Y-m-d-H-i-s') .
            '.csv';

        $this->response->setHeader(
            'Content-Type',
            'text/csv; charset=UTF-8'
        );

        $this->response->setHeader(
            'Content-Disposition',
            'attachment; filename="' .
            $filename .
            '"'
        );

        $output =
            fopen(
                'php://output',
                'w'
            );

        fwrite(
            $output,
            "\xEF\xBB\xBF"
        );

        fputcsv(
            $output,
            [
                'No',
                'No. Tiket',
                'Nama Pemohon',
                'NIM',
                'NIK',
                'Email',
                'No. HP',
                'Layanan',
                'Unit Layanan',
                'Status',
                'Prioritas',
                'Tanggal Pengajuan',
                'Tanggal Verifikasi'
            ]
        );

        $no = 1;

        foreach ($tickets as $ticket) {

            fputcsv(
                $output,
                [
                    $no++,

                    $ticket['ticket_number']
                    ?? '-',

                    $ticket['applicant_name']
                    ?? '-',

                    $ticket['nim']
                    ?? '-',

                    $ticket['nik']
                    ?? '-',

                    $ticket['email']
                    ?? '-',

                    $ticket['phone']
                    ?? '-',

                    $ticket['service_name']
                    ?? '-',

                    $ticket['unit_name']
                    ?? '-',

                    $ticket['status']
                    ?? '-',

                    $ticket['priority']
                    ?? '-',

                    $ticket['submitted_at']
                    ?? '-',

                    $ticket['verified_at']
                    ?? '-'
                ]
            );
        }

        fclose($output);

        return $this->response;
    }


    /**
     * ============================================================
     * EXPORT EXCEL
     * ============================================================
     */
    public function exportExcel()
    {
        $tickets =
            $this->getExportData();

        $filename =
            'data-tiket-' .
            date('Y-m-d-H-i-s') .
            '.xls';

        $this->response->setHeader(
            'Content-Type',
            'application/vnd.ms-excel; charset=UTF-8'
        );

        $this->response->setHeader(
            'Content-Disposition',
            'attachment; filename="' .
            $filename .
            '"'
        );

        $html = '
        <!DOCTYPE html>
        <html>
        <head>

            <meta charset="UTF-8">

            <style>

                table {
                    border-collapse: collapse;
                    width: 100%;
                }

                th {
                    background-color: #1e293b;
                    color: white;
                    font-weight: bold;
                    border: 1px solid #000;
                    padding: 8px;
                }

                td {
                    border: 1px solid #000;
                    padding: 6px;
                }

            </style>

        </head>

        <body>

        <h2>DATA TIKET PERMOHONAN</h2>

        <p>
            Tanggal Export:
            ' .
            date('d-m-Y H:i:s') .
            '
        </p>

        <table>

            <thead>

                <tr>

                    <th>No</th>
                    <th>No. Tiket</th>
                    <th>Nama Pemohon</th>
                    <th>NIM</th>
                    <th>NIK</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Layanan</th>
                    <th>Unit Layanan</th>
                    <th>Status</th>
                    <th>Prioritas</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Verifikasi</th>

                </tr>

            </thead>

            <tbody>
        ';

        $no = 1;

        foreach ($tickets as $ticket) {

            $html .= '
                <tr>

                    <td>' .
                        $no++ .
                    '</td>

                    <td>' .
                        esc(
                            $ticket['ticket_number']
                            ?? '-'
                        ) .
                    '</td>

                    <td>' .
                        esc(
                            $ticket['applicant_name']
                            ?? '-'
                        ) .
                    '</td>

                    <td>' .
                        esc(
                            $ticket['nim']
                            ?? '-'
                        ) .
                    '</td>

                    <td>' .
                        esc(
                            $ticket['nik']
                            ?? '-'
                        ) .
                    '</td>

                    <td>' .
                        esc(
                            $ticket['email']
                            ?? '-'
                        ) .
                    '</td>

                    <td>' .
                        esc(
                            $ticket['phone']
                            ?? '-'
                        ) .
                    '</td>

                    <td>' .
                        esc(
                            $ticket['service_name']
                            ?? '-'
                        ) .
                    '</td>

                    <td>' .
                        esc(
                            $ticket['unit_name']
                            ?? '-'
                        ) .
                    '</td>

                    <td>' .
                        esc(
                            $ticket['status']
                            ?? '-'
                        ) .
                    '</td>

                    <td>' .
                        esc(
                            $ticket['priority']
                            ?? '-'
                        ) .
                    '</td>

                    <td>' .
                        esc(
                            $ticket['submitted_at']
                            ?? '-'
                        ) .
                    '</td>

                    <td>' .
                        esc(
                            $ticket['verified_at']
                            ?? '-'
                        ) .
                    '</td>

                </tr>
            ';
        }

        $html .= '
            </tbody>

        </table>

        </body>

        </html>
        ';

        return $this->response
            ->setBody($html);
    }


    /**
     * ============================================================
     * EXPORT PDF
     * ============================================================
     */
    public function exportPdf()
    {
        $tickets =
            $this->getExportData();

        return view(
            'datatiket/export_pdf',
            [
                'tickets' =>
                    $tickets,

                'tanggal' =>
                    date('d-m-Y H:i:s')
            ]
        );
    }
}