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
     * Halaman utama Data Tiket
     */
    public function index()
    {
        $keyword = trim((string) $this->request->getGet('keyword'));
        $status  = trim((string) $this->request->getGet('status'));
        $category = trim((string) $this->request->getGet('category'));

        // Ambil jumlah data per halaman
        $perPage = (int) ($this->request->getGet('per_page') ?? 10);

        if ($perPage < 1) {
            $perPage = 10;
        }

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
        if ($category !== '') {
            $builder->where('master_service_categories.name', $category);
        }

        $tickets = $builder
            ->orderBy('tickets.submitted_at', 'DESC')
            ->paginate($perPage, 'datatiket');

        return view('datatiket/index', [
            'tickets'        => $tickets,
            'pager'          => $this->ticketModel->pager,
            'perPage'        => $perPage,
            'keyword'        => $keyword,
            'status'         => $status,
            'category'       => $category,

            'totalTickets'   => $this->ticketModel->countAll(),

            'totalPending'   => $this->ticketModel
                ->whereIn('status', [
                    'submitted',
                    'verification'
                ])
                ->countAllResults(),

            'totalVerified'  => $this->ticketModel
                ->whereIn('status', [
                    'verified',
                    'assigned',
                    'processing',
                    'completed'
                ])
                ->countAllResults(),

            'totalProcessed' => $this->ticketModel
                ->whereIn('status', [
                    'assigned',
                    'processing'
                ])
                ->countAllResults(),

            'total_tiket'    => $this->ticketModel->countAll(),

            'submitted'      => $this->ticketModel
                ->where('status', 'submitted')
                ->countAllResults(),
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
                tickets.id,
                tickets.ticket_number,
                tickets.title,
                tickets.description,
                tickets.status,
                tickets.priority,
                tickets.submitted_at,
                tickets.verified_at,
                tickets.created_at,

                user_profiles.name AS applicant_name,
                user_profiles.nim,
                user_profiles.nik,
                user_profiles.email,
                user_profiles.phone,

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
     *
     * URL:
     * /datatiket/export/pdf
     * /datatiket/export/excel
     * /datatiket/export/csv
     */
    private function getExportData()
    {
        $keyword  = trim((string) $this->request->getGet('keyword'));
        $status   = trim((string) $this->request->getGet('status'));
        $category = trim((string) $this->request->getGet('category'));

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
        if ($category !== '') {
            $builder->where('master_service_categories.name', $category);
        }

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

        $filename = 'data-tiket-' . date('Y-m-d-H-i-s') . '.csv';

        $this->response->setHeader(
            'Content-Type',
            'text/csv; charset=UTF-8'
        );

        $this->response->setHeader(
            'Content-Disposition',
            'attachment; filename="' . $filename . '"'
        );

        $output = fopen('php://output', 'w');

        // BOM agar Excel membaca UTF-8 dengan benar
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
     *
     * Menghasilkan file HTML yang dapat dibuka oleh Microsoft Excel.
     */
    public function exportExcel()
    {
        $tickets = $this->getExportData();

        $filename = 'data-tiket-' . date('Y-m-d-H-i-s') . '.xls';

        $this->response->setHeader(
            'Content-Type',
            'application/vnd.ms-excel; charset=UTF-8'
        );

        $this->response->setHeader(
            'Content-Disposition',
            'attachment; filename="' . $filename . '"'
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

                    <td>' . $no++ . '</td>

                    <td>' . esc($ticket['ticket_number'] ?? '-') . '</td>

                    <td>' . esc($ticket['applicant_name'] ?? '-') . '</td>

                    <td>' . esc($ticket['nim'] ?? '-') . '</td>

                    <td>' . esc($ticket['nik'] ?? '-') . '</td>

                    <td>' . esc($ticket['email'] ?? '-') . '</td>

                    <td>' . esc($ticket['phone'] ?? '-') . '</td>

                    <td>' . esc($ticket['service_name'] ?? '-') . '</td>

                    <td>' . esc($ticket['unit_name'] ?? '-') . '</td>

                    <td>' . esc($ticket['status'] ?? '-') . '</td>

                    <td>' . esc($ticket['priority'] ?? '-') . '</td>

                    <td>' . esc($ticket['submitted_at'] ?? '-') . '</td>

                    <td>' . esc($ticket['verified_at'] ?? '-') . '</td>

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
     *
     * Untuk PDF, sementara menggunakan tampilan HTML
     * yang bisa dicetak menjadi PDF melalui browser.
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