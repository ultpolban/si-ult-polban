<?php

namespace App\Controllers;

use App\Controllers\AdminController;
use App\Services\TicketService;
use App\Models\MasterServiceUnitModel;
use App\Models\MasterApplicantTypeModel;
use App\Constants\Permissions;

class ReportController extends AdminController
{
    protected TicketService $ticketService;
    protected MasterServiceUnitModel $unitModel;
    protected MasterApplicantTypeModel $applicantTypeModel;

    public function __construct()
    {
        parent::__construct();

        $this->ticketService     = new TicketService();
        $this->unitModel         = new MasterServiceUnitModel();
        $this->applicantTypeModel = new MasterApplicantTypeModel();
    }

    /**
     * Laporan pengajuan.
     */
    public function index()
    {
        $this->authorize(Permissions::REPORT_VIEW);

        $filters = [
            'status'            => trim($this->request->getGet('status') ?? ''),
            'unit_id'           => (int) $this->request->getGet('unit_id') ?: null,
            'applicant_type_id' => (int) $this->request->getGet('applicant_type_id') ?: null,
            'date_from'         => trim($this->request->getGet('date_from') ?? ''),
            'date_to'           => trim($this->request->getGet('date_to') ?? ''),
        ];

        $result = $this->ticketService->report($filters);

        return view('reports/index', $this->viewData([
            'title'           => 'Laporan Pengajuan',
            'pageTitle'       => 'Laporan Pengajuan',
            'breadcrumb'      => ['Tiket', 'Laporan'],
            'filters'         => $filters,
            'tickets'         => $result['tickets'],
            'pager'           => $result['pager'],
            'statusMap'       => $this->statusMap(),
            'units'           => $this->unitModel->getActive(),
            'applicantTypes'  => $this->applicantTypeModel->getActive(),
        ]));
    }

    /**
     * Export CSV.
     */
    public function export()
    {
        $this->authorize(Permissions::REPORT_EXPORT);

        $filters = [
            'status'            => trim($this->request->getGet('status') ?? ''),
            'unit_id'           => (int) $this->request->getGet('unit_id') ?: null,
            'applicant_type_id' => (int) $this->request->getGet('applicant_type_id') ?: null,
            'date_from'         => trim($this->request->getGet('date_from') ?? ''),
            'date_to'           => trim($this->request->getGet('date_to') ?? ''),
        ];

        $format = trim($this->request->getGet('format') ?? 'csv');
        $rows = $this->ticketService->export($filters);
        $statusMap = $this->statusMap();

        if ($format === 'excel') {
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            
            $headers = ['No', 'No. Tiket', 'Judul', 'Layanan', 'Unit', 'Pemohon', 'Jenis Pemohon', 'Status', 'Prioritas', 'Tanggal'];
            $sheet->fromArray($headers, NULL, 'A1');
            
            $data = [];
            $no = 1;
            foreach ($rows as $row) {
                $status = $row['status'] ?? '';
                $data[] = [
                    $no++,
                    $row['ticket_number'] ?? '',
                    $row['title'] ?? '',
                    $row['service_name'] ?? '',
                    $row['service_unit_name'] ?? '',
                    $row['applicant_name'] ?? '',
                    $row['applicant_type'] ?? '-',
                    $statusMap[$status] ?? ucfirst(str_replace('_', ' ', $status)),
                    ucfirst($row['priority'] ?? ''),
                    $row['created_at'] ?? '',
                ];
            }
            $sheet->fromArray($data, NULL, 'A2');
            
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $filename = 'laporan_pengajuan_' . date('Ymd_His') . '.xlsx';
            
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="' . $filename . '"');
            $writer->save('php://output');
            exit;
        } 
        
        if ($format === 'pdf') {
            $dompdf = new \Dompdf\Dompdf();
            
            $html = '<h2>Laporan Pengajuan</h2>';
            $html .= '<table border="1" cellpadding="5" cellspacing="0" width="100%" style="font-size: 10px;">';
            $html .= '<tr><th>No</th><th>No. Tiket</th><th>Judul</th><th>Layanan</th><th>Unit</th><th>Pemohon</th><th>Status</th><th>Tanggal</th></tr>';
            
            $no = 1;
            foreach ($rows as $row) {
                $status = $row['status'] ?? '';
                $html .= '<tr>';
                $html .= '<td>' . $no++ . '</td>';
                $html .= '<td>' . ($row['ticket_number'] ?? '') . '</td>';
                $html .= '<td>' . ($row['title'] ?? '') . '</td>';
                $html .= '<td>' . ($row['service_name'] ?? '') . '</td>';
                $html .= '<td>' . ($row['service_unit_name'] ?? '') . '</td>';
                $html .= '<td>' . ($row['applicant_name'] ?? '') . '</td>';
                $html .= '<td>' . ($statusMap[$status] ?? ucfirst(str_replace('_', ' ', $status))) . '</td>';
                $html .= '<td>' . ($row['created_at'] ?? '') . '</td>';
                $html .= '</tr>';
            }
            $html .= '</table>';
            
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'landscape');
            $dompdf->render();
            
            $filename = 'laporan_pengajuan_' . date('Ymd_His') . '.pdf';
            $dompdf->stream($filename);
            exit;
        }

        // Default CSV
        $filename = 'laporan_pengajuan_' . date('Ymd_His') . '.csv';
        $output = fopen('php://temp', 'w');
        fputs($output, "\xEF\xBB\xBF");
        fputcsv($output, [
            'No', 'No. Tiket', 'Judul', 'Layanan', 'Unit', 'Pemohon',
            'Jenis Pemohon', 'Status', 'Prioritas', 'Tanggal'
        ]);

        $no = 1;
        foreach ($rows as $row) {
            $status = $row['status'] ?? '';
            fputcsv($output, [
                $no++,
                $row['ticket_number'] ?? '',
                $row['title'] ?? '',
                $row['service_name'] ?? '',
                $row['service_unit_name'] ?? '',
                $row['applicant_name'] ?? '',
                $row['applicant_type'] ?? '-',
                $statusMap[$status] ?? ucfirst(str_replace('_', ' ', $status)),
                ucfirst($row['priority'] ?? ''),
                $row['created_at'] ?? '',
            ]);
        }

        rewind($output);
        $content = stream_get_contents($output);
        fclose($output);

        return $this->response
            ->setHeader('Content-Type', 'text/csv; charset=UTF-8')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($content);
    }

    /**
     * Peta status.
     */
    protected function statusMap(): array
    {
        return [
            'draft'       => 'Draft',
            'submitted'   => 'Diajukan',
            'verification' => 'Verifikasi',
            'revision'    => 'Revisi',
            'processing'  => 'Diproses',
            'completed'   => 'Selesai',
            'rejected'    => 'Ditolak',
            'cancelled'   => 'Dibatalkan',
        ];
    }
}
