<?php

namespace App\Controllers;

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends BaseController
{
    /**
     * Query dasar laporan tiket.
     */
    private function getReportQuery()
    {
        return db_connect()
            ->table('tickets t')
            ->select("
                t.id,
                t.ticket_number,
                t.title,
                t.description,
                t.status,
                t.priority,
                t.submitted_at,
                t.verified_at,
                t.processed_at,
                t.completed_at,
                t.rejected_at,
                t.cancelled_at,
                t.created_at,
                t.updated_at,

                up.student_name,
                up.name AS profile_name,
                up.nim,
                up.nik,
                up.email,
                up.phone,

                mat.name AS applicant_type,

                ms.name AS service_name,

                msc.id AS category_id,
                msc.name AS category_name
            ")
            ->join(
                'user_profiles up',
                'up.id = t.user_profile_id',
                'left'
            )
            ->join(
                'master_applicant_types mat',
                'mat.id = up.applicant_type_id',
                'left'
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
            );
    }

    /**
     * Ambil tiket berdasarkan filter.
     */
    private function getTickets(array $filters = [])
    {
        $builder = $this->getReportQuery();

        // ==========================
        // SEARCH
        // ==========================
        if (!empty($filters['keyword'])) {
            $keyword = trim($filters['keyword']);

            $builder->groupStart()
                ->like('t.ticket_number', $keyword)
                ->orLike('up.student_name', $keyword)
                ->orLike('up.name', $keyword)
                ->orLike('up.nim', $keyword)
                ->orLike('up.nik', $keyword)
                ->orLike('up.email', $keyword)
                ->orLike('ms.name', $keyword)
                ->groupEnd();
        }

        // ==========================
        // STATUS
        // ==========================
        if (!empty($filters['status'])) {

            $status = strtolower(trim($filters['status']));

            if ($status === 'disposisi') {

                $builder->whereIn('t.status', [
                    'assigned',
                    'disposisi'
                ]);

            } elseif ($status === 'in progress') {

                $builder->whereIn('t.status', [
                    'in_progress',
                    'processed'
                ]);

            } else {

                $builder->where('t.status', $status);
            }
        }

        // ==========================
        // KATEGORI
        // ==========================
        if (!empty($filters['kategori'])) {
            $builder->where(
                'msc.id',
                (int) $filters['kategori']
            );
        }

        $builder
            ->orderBy('t.submitted_at', 'DESC')
            ->orderBy('t.id', 'DESC');

        $tickets = $builder->get()->getResultArray();

        $result = [];

        foreach ($tickets as $ticket) {

            $namaPemohon = !empty($ticket['student_name'])
                ? $ticket['student_name']
                : ($ticket['profile_name'] ?? '');

            $tanggal = $ticket['submitted_at']
                ?? $ticket['created_at']
                ?? '';

            $status = strtolower(
                trim($ticket['status'] ?? 'submitted')
            );

            // ==========================
            // LABEL STATUS
            // ==========================
            $statusLabel = match ($status) {
                'submitted'   => 'Submitted',
                'verified'    => 'Verified',
                'assigned'    => 'Disposisi',
                'disposisi'   => 'Disposisi',
                'in_progress' => 'In Progress',
                'processed'   => 'In Progress',
                'completed'   => 'Completed',
                'rejected'    => 'Rejected',
                'cancelled'   => 'Cancelled',
                default       => ucfirst(
                    str_replace('_', ' ', $status)
                ),
            };

            // ==========================
            // LABEL PRIORITAS
            // ==========================
            $priority = strtolower(
                trim($ticket['priority'] ?? 'normal')
            );

            $priorityLabel = match ($priority) {
                'low'    => 'Low',
                'medium' => 'Medium',
                'high'   => 'High',
                'urgent' => 'Urgent',
                default  => 'Normal',
            };

            $result[] = [
                'id' => $ticket['id'],

                'ticket_number' =>
                    $ticket['ticket_number'] ?? '',

                'nomor_tiket' =>
                    $ticket['ticket_number'] ?? '',

                'no_tiket' =>
                    $ticket['ticket_number'] ?? '',
                'nama_pemohon' => $namaPemohon,

                'applicant_name' => $namaPemohon,

                'applicant_type' => $ticket['applicant_type'] ?? '',

                'jenis_pemohon' =>
                    $ticket['applicant_type'] ?? '',

                'service_name' => $ticket['service_name'] ?? '',

                'layanan' =>
                    $ticket['service_name'] ?? '',

                'kategori' =>
                    $ticket['category_name'] ?? '',

                'kategori_id' =>
                    $ticket['category_id'] ?? '',

                'status' =>
                    $statusLabel,

                'status_raw' =>
                    $status,

                'prioritas' =>
                    $priorityLabel,

                'created_at' =>
                    $tanggal,

                'submitted_at' =>
                    $ticket['submitted_at'] ?? '',

                'nim' =>
                    $ticket['nim'] ?? '',

                'nik' =>
                    $ticket['nik'] ?? '',

                'email' =>
                    $ticket['email'] ?? '',

                'phone' =>
                    $ticket['phone'] ?? '',

                'title' =>
                    $ticket['title'] ?? '',

                'description' =>
                    $ticket['description'] ?? '',
            ];
        }

        return $result;
    }

    /**
     * ==========================
     * HALAMAN LAPORAN TIKET
     * ==========================
     */
    public function index()
    {
        $keyword = trim(
            $this->request->getGet('keyword') ?? ''
        );

        $status = trim(
            $this->request->getGet('status') ?? ''
        );

        $kategori = trim(
            $this->request->getGet('kategori') ?? ''
        );

        $limit = (int) (
            $this->request->getGet('limit') ?? 10
        );

        if ($limit < 1) {
            $limit = 10;
        }

        if ($limit > 500) {
            $limit = 500;
        }

        // Filter utama
        $filters = [
            'keyword'  => $keyword,
            'status'   => $status,
            'kategori' => $kategori,
        ];

        $allTickets = $this->getTickets($filters);

        // ==========================
        // STATISTIK
        // ==========================
        $totalTiket = count($allTickets);

        $waitingVerification = 0;
        $terverifikasi = 0;
        $diproses = 0;

        foreach ($allTickets as $ticket) {

            $statusRaw = $ticket['status_raw'] ?? '';

            if ($statusRaw === 'submitted') {
                $waitingVerification++;
            }

            if ($statusRaw === 'verified') {
                $terverifikasi++;
            }

            if (in_array($statusRaw, [
                'assigned',
                'disposisi',
                'in_progress',
                'processed'
            ], true)) {
                $diproses++;
            }
        }

        // ==========================
        // DATA KATEGORI
        // ==========================
        $categories = db_connect()
            ->table('master_service_categories')
            ->select('id, name')
            ->where('is_active', 1)
            ->orderBy('sort_order', 'ASC')
            ->get()
            ->getResultArray();

        // ==========================
        // LIMIT DATA
        // ==========================
        $laporanList = array_slice(
            $allTickets,
            0,
            $limit
        );

        return view('petugas/laporan_tiket', [

            'laporan_list' =>
                $laporanList,

            'tickets' =>
                $laporanList,

            'total_tiket' =>
                $totalTiket,

            'waiting_verification' =>
                $waitingVerification,

            'terverifikasi' =>
                $terverifikasi,

            'diproses' =>
                $diproses,

            'categories' =>
                $categories,

            'keyword' =>
                $keyword,

            'status' =>
                $status,

            'kategori' =>
                $kategori,

            'limit' =>
                $limit,
        ]);
    }

    /**
     * ==========================
     * EXPORT CSV
     * ==========================
     */
    public function csv()
    {
        $tickets = $this->getTickets([
            'keyword' =>
                trim($this->request->getGet('keyword') ?? ''),

            'status' =>
                trim($this->request->getGet('status') ?? ''),

            'kategori' =>
                trim($this->request->getGet('kategori') ?? ''),
        ]);

        $filename =
            'laporan_tiket_' .
            date('Y-m-d_H-i-s') .
            '.csv';

        $handle = fopen('php://temp', 'r+');

        fputcsv($handle, [
            'Nomor Tiket',
            'Nama Pemohon',
            'Jenis Pemohon',
            'Kategori',
            'Layanan',
            'Status',
            'Prioritas',
            'Tanggal Pengajuan'
        ]);

        foreach ($tickets as $ticket) {

            fputcsv($handle, [
                $ticket['nomor_tiket'] ?? '',
                $ticket['nama_pemohon'] ?? '',
                $ticket['jenis_pemohon'] ?? '',
                $ticket['kategori'] ?? '',
                $ticket['layanan'] ?? '',
                $ticket['status'] ?? '',
                $ticket['prioritas'] ?? '',
                $ticket['created_at'] ?? '',
            ]);
        }

        rewind($handle);

        $csv = stream_get_contents($handle);

        fclose($handle);

        return $this->response
            ->setHeader(
                'Content-Type',
                'text/csv; charset=UTF-8'
            )
            ->setHeader(
                'Content-Disposition',
                'attachment; filename="' .
                $filename .
                '"'
            )
            ->setBody($csv);
    }

    /**
     * ==========================
     * EXPORT EXCEL
     * ==========================
     */
    public function excel()
    {
        if (!class_exists(Spreadsheet::class)) {

            return redirect()
                ->to(base_url('report'))
                ->with(
                    'error',
                    'Export Excel belum tersedia karena library PhpSpreadsheet belum terinstal.'
                );
        }

        $tickets = $this->getTickets([
            'keyword' =>
                trim($this->request->getGet('keyword') ?? ''),

            'status' =>
                trim($this->request->getGet('status') ?? ''),

            'kategori' =>
                trim($this->request->getGet('kategori') ?? ''),
        ]);

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Laporan Tiket');

        $headers = [
            'A1' => 'Nomor Tiket',
            'B1' => 'Nama Pemohon',
            'C1' => 'Jenis Pemohon',
            'D1' => 'Kategori',
            'E1' => 'Layanan',
            'F1' => 'Status',
            'G1' => 'Prioritas',
            'H1' => 'Tanggal Pengajuan',
        ];

        foreach ($headers as $cell => $value) {
            $sheet->setCellValue(
                $cell,
                $value
            );
        }

        $row = 2;

        foreach ($tickets as $ticket) {

            $sheet->setCellValue(
                'A' . $row,
                $ticket['nomor_tiket'] ?? ''
            );

            $sheet->setCellValue(
                'B' . $row,
                $ticket['nama_pemohon'] ?? ''
            );

            $sheet->setCellValue(
                'C' . $row,
                $ticket['jenis_pemohon'] ?? ''
            );

            $sheet->setCellValue(
                'D' . $row,
                $ticket['kategori'] ?? ''
            );

            $sheet->setCellValue(
                'E' . $row,
                $ticket['layanan'] ?? ''
            );

            $sheet->setCellValue(
                'F' . $row,
                $ticket['status'] ?? ''
            );

            $sheet->setCellValue(
                'G' . $row,
                $ticket['prioritas'] ?? ''
            );

            $sheet->setCellValue(
                'H' . $row,
                $ticket['created_at'] ?? ''
            );

            $row++;
        }

        foreach (range('A', 'H') as $column) {
            $sheet
                ->getColumnDimension($column)
                ->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        $filename =
            'laporan_tiket_' .
            date('Y-m-d_H-i-s') .
            '.xlsx';

        ob_start();

        $writer->save('php://output');

        $output = ob_get_clean();

        return $this->response
            ->setHeader(
                'Content-Type',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            )
            ->setHeader(
                'Content-Disposition',
                'attachment; filename="' .
                $filename .
                '"'
            )
            ->setHeader(
                'Cache-Control',
                'max-age=0'
            )
            ->setBody($output);
    }

    /**
     * ==========================
     * EXPORT PDF
     * ==========================
     */
    public function pdf()
    {
        $tickets = $this->getTickets([
            'keyword' =>
                trim($this->request->getGet('keyword') ?? ''),

            'status' =>
                trim($this->request->getGet('status') ?? ''),

            'kategori' =>
                trim($this->request->getGet('kategori') ?? ''),
        ]);

        $html = view('report/pdf', [
            'tickets' => $tickets
        ]);

        $options = new Options();

        $options->set(
            'isRemoteEnabled',
            true
        );

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);

        $dompdf->setPaper(
            'A4',
            'landscape'
        );

        $dompdf->render();

        return $this->response
            ->setContentType('application/pdf')
            ->setBody(
                $dompdf->output()
            );
    }
}
