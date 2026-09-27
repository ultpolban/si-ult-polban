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

        $rows = $this->ticketService->export($filters);

        $statusMap = $this->statusMap();

        $filename = 'laporan_pengajuan_' . date('Ymd_His') . '.csv';

        $output = fopen('php://temp', 'w');

        fputs($output, "\xEF\xBB\xBF"); // BOM UTF-8 utk Excel

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
