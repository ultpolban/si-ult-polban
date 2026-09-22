<?php

namespace App\Controllers;

use App\Models\TicketModel;

class DataTicketController extends BaseController
{
    protected $ticketModel;

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
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

        $status = trim((string) (
            $this->request->getGet('status')
            ?? ''
        ));

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
                    ->orLike('user_profiles.nim', $keyword)
                    ->orLike('user_profiles.nik', $keyword)
                    ->orLike('master_services.name', $keyword)
                ->groupEnd();
        }

        // FILTER STATUS
        if ($status !== '') {
            $builder->where('tickets.status', $status);
        }

        // FILTER KATEGORI
        // Belum digunakan karena kategori belum tersedia
        // langsung pada query backend3.

        // ========================================================
        // DATA TIKET
        // ========================================================
        $tickets = $builder
            ->orderBy('tickets.submitted_at', 'DESC')
            ->paginate($perPage, 'datatiket');

        // ========================================================
        // MAPPING BACKEND3 → FRONTEND3
        // ========================================================
      foreach ($tickets as &$ticket) {

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

    // Layanan
    $ticket['layanan'] =
        $ticket['service_name']
        ?? '-';

    // Unit layanan
    $ticket['unit_layanan'] =
        $ticket['unit_name']
        ?? '-';

    // Kategori
    $ticket['kategori'] =
        $ticket['category_name']
        ?? '-';

    // Status
    $ticket['status'] =
        strtolower(
            trim(
                $ticket['status']
                ?? ''
            )
        );

    // Created
    $ticket['created_at'] =
        $ticket['created_at']
        ?? $ticket['submitted_at']
        ?? null;

    // ID
    $ticket['id'] =
        $ticket['id']
        ?? null;
}

unset($ticket);

        // ========================================================
        // ADAPTER FRONTEND3
        // ========================================================
        $totalData = count($tickets);

        // Tidak ada dummy data
        $realTickets = $tickets;
        $dummyTickets = [];

        $filteredTickets = $tickets;
        $tiket_list = $tickets;

        // Pagination frontend3
        $currentPage = (int) (
            $this->request->getGet('page')
            ?? $this->request->getGet('page_datatiket')
            ?? 1
        );

        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $offset = ($currentPage - 1) * $perPage;

        $paginatedList = array_slice(
            $tickets,
            $offset,
            $perPage
        );

        $totalPages = $perPage > 0
            ? (int) ceil($totalData / $perPage)
            : 1;

        if ($totalPages < 1) {
            $totalPages = 1;
        }

        // ========================================================
        // STATISTIK
        // ========================================================
        $jumlahTiket = $this->ticketModel->countAll();

        $jumlahSubmitted = $this->ticketModel
            ->where('status', 'submitted')
            ->countAllResults();

        $jumlahVerified = $this->ticketModel
            ->whereIn('status', [
                'verified',
                'assigned',
                'processing',
                'completed'
            ])
            ->countAllResults();

        $jumlahDisposisi = $this->ticketModel
            ->whereIn('status', [
                'assigned',
                'processing'
            ])
            ->countAllResults();

        // ========================================================
        // KIRIM KE VIEW FRONTEND3
        // ========================================================
        return view('petugas/tiket', [

            // Data utama
            'tickets' => $tickets,

            // Pager CI4
            'pager' => $this->ticketModel->pager,

            // Filter
            'perPage' => $perPage,
            'keyword' => $keyword,
            'status' => $status,
            'category' => $category,

            // Statistik backend3
            'totalTickets' =>
                $this->ticketModel->countAll(),

            'totalPending' =>
                $this->ticketModel
                    ->whereIn('status', [
                        'submitted',
                        'verification'
                    ])
                    ->countAllResults(),

            'totalVerified' =>
                $this->ticketModel
                    ->whereIn('status', [
                        'verified',
                        'assigned',
                        'processing',
                        'completed'
                    ])
                    ->countAllResults(),

            'totalProcessed' =>
                $this->ticketModel
                    ->whereIn('status', [
                        'assigned',
                        'processing'
                    ])
                    ->countAllResults(),

            'total_tiket' =>
                $this->ticketModel->countAll(),

            'submitted' =>
                $this->ticketModel
                    ->where('status', 'submitted')
                    ->countAllResults(),

            // ====================================================
            // ADAPTER FRONTEND3
            // ====================================================
            'realTickets' => $realTickets,
            'dummyTickets' => $dummyTickets,
            'filteredTickets' => $filteredTickets,
            'tiket_list' => $tiket_list,

            'currentPage' => $currentPage,
            'offset' => $offset,
            'paginatedList' => $paginatedList,
            'totalData' => $totalData,
            'totalPages' => $totalPages,

            // Statistik frontend3
            'jumlahTiket' => $jumlahTiket,
            'jumlahSubmitted' => $jumlahSubmitted,
            'jumlahVerified' => $jumlahVerified,
            'jumlahDisposisi' => $jumlahDisposisi,
        ]);
    }


    /**
     * ============================================================
     * DETAIL DATA TIKET
     * ============================================================
     *
     * GET /datatiket/detail/25
     */
    public function detail($id = null)
    {
        if ($id === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'ID tiket tidak ditemukan'
            );
        }

        // Ambil data dari database backend3
        $ticket = $this->ticketModel->getTicketDetail($id);

        if (!$ticket) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Tiket tidak ditemukan'
            );
        }

        // ========================================================
        // MAPPING BACKEND3 → FRONTEND3
        // ========================================================
        $ticket['nomor_tiket'] =
            $ticket['ticket_number'] ?? '-';

       $ticket['nama_pemohon'] =
    $ticket['applicant_name']
    ?? $ticket['student_name']
    ?? $ticket['name']
    ?? '-';

        $ticket['layanan'] =
            $ticket['service_name'] ?? '-';

        $ticket['kategori'] =
            $ticket['category_name'] ?? '-';

        $ticket['status'] = strtolower(
            trim($ticket['status'] ?? '')
        );

        $ticket['created_at'] =
            $ticket['created_at']
            ?? $ticket['submitted_at']
            ?? null;

        // ========================================================
        // VIEW FRONTEND3
        // ========================================================
        return view('petugas/detail', [
            'ticket' => $ticket,
            'tiket' => $ticket,
        ]);
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
            user_profiles.applicant_type_id,

            master_applicant_types.name AS applicant_type,

            master_services.name AS service_name,
            master_services.service_unit_id,

            master_service_units.name AS unit_name
        ")
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
        );
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

        $status = trim((string) (
            $this->request->getGet('status')
            ?? ''
        ));

        $category = trim((string) (
            $this->request->getGet('kategori')
            ?? $this->request->getGet('category')
            ?? ''
        ));

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
            $builder->where('tickets.status', $status);
        }

        // Kategori belum digunakan
        // karena relasi kategori belum tersedia.

        return $builder
            ->orderBy('tickets.submitted_at', 'DESC')
            ->findAll();
    }


    /**
     * ============================================================
     * EXPORT CSV
     * ============================================================
     */
    public function exportCsv()
    {
        $tickets = $this->getExportData();

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

        $output = fopen('php://output', 'w');

        // BOM UTF-8
        fwrite($output, "\xEF\xBB\xBF");

        // HEADER
        fputcsv($output, [
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
        ]);

        $no = 1;

        foreach ($tickets as $ticket) {

            fputcsv($output, [
                $no++,
                $ticket['ticket_number'] ?? '-',
                $ticket['applicant_name'] ?? '-',
                $ticket['nim'] ?? '-',
                $ticket['nik'] ?? '-',
                $ticket['email'] ?? '-',
                $ticket['phone'] ?? '-',
                $ticket['service_name'] ?? '-',
                $ticket['unit_name'] ?? '-',
                $ticket['status'] ?? '-',
                $ticket['priority'] ?? '-',
                $ticket['submitted_at'] ?? '-',
                $ticket['verified_at'] ?? '-'
            ]);
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
        $tickets = $this->getExportData();

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
            ' . date('d-m-Y H:i:s') . '
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
                        esc($ticket['ticket_number'] ?? '-') .
                    '</td>

                    <td>' .
                        esc($ticket['applicant_name'] ?? '-') .
                    '</td>

                    <td>' .
                        esc($ticket['nim'] ?? '-') .
                    '</td>

                    <td>' .
                        esc($ticket['nik'] ?? '-') .
                    '</td>

                    <td>' .
                        esc($ticket['email'] ?? '-') .
                    '</td>

                    <td>' .
                        esc($ticket['phone'] ?? '-') .
                    '</td>

                    <td>' .
                        esc($ticket['service_name'] ?? '-') .
                    '</td>

                    <td>' .
                        esc($ticket['unit_name'] ?? '-') .
                    '</td>

                    <td>' .
                        esc($ticket['status'] ?? '-') .
                    '</td>

                    <td>' .
                        esc($ticket['priority'] ?? '-') .
                    '</td>

                    <td>' .
                        esc($ticket['submitted_at'] ?? '-') .
                    '</td>

                    <td>' .
                        esc($ticket['verified_at'] ?? '-') .
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

        return $this->response->setBody($html);
    }


    /**
     * ============================================================
     * EXPORT PDF
     * ============================================================
     */
    public function exportPdf()
    {
        $tickets = $this->getExportData();

        return view('datatiket/export_pdf', [
            'tickets' => $tickets,
            'tanggal' => date('d-m-Y H:i:s')
        ]);
    }
}