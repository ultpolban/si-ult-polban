<?php

namespace App\Controllers;

use App\Models\TicketModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportController extends BaseController
{
    public function index()
    {
        $ticketModel = new TicketModel();

        $data['tickets'] = $ticketModel
            ->orderBy('submitted_at', 'DESC')
            ->findAll();

        return view('report/index', $data);
    }

    // ==========================
    // EXPORT CSV
    // ==========================
    public function csv()
    {
        $ticketModel = new TicketModel();
        $tickets = $ticketModel->findAll();

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=laporan_tiket.csv");

        $file = fopen('php://output', 'w');

        fputcsv($file, [
            'Nomor Tiket',
            'Nama Pemohon',
            'Jenis Pemohon',
            'Layanan',
            'Status',
            'Tanggal Pengajuan'
        ]);

        foreach ($tickets as $t) {

            fputcsv($file, [

                $t['ticket_number'],
                $t['applicant_name'],
                $t['applicant_type'],
                $t['service_name'],
                $t['status'],
                $t['submitted_at']

            ]);
        }

        fclose($file);
        exit;
    }

    // ==========================
    // EXPORT EXCEL
    // ==========================
    public function excel()
    {
        $ticketModel = new TicketModel();

        $tickets = $ticketModel
            ->orderBy('submitted_at', 'DESC')
            ->findAll();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Nomor Tiket');
        $sheet->setCellValue('B1', 'Nama Pemohon');
        $sheet->setCellValue('C1', 'Jenis Pemohon');
        $sheet->setCellValue('D1', 'Layanan');
        $sheet->setCellValue('E1', 'Status');
        $sheet->setCellValue('F1', 'Tanggal Pengajuan');

        $row = 2;

        foreach ($tickets as $ticket) {

            $sheet->setCellValue('A'.$row, $ticket['ticket_number']);
            $sheet->setCellValue('B'.$row, $ticket['applicant_name']);
            $sheet->setCellValue('C'.$row, $ticket['applicant_type']);
            $sheet->setCellValue('D'.$row, $ticket['service_name']);
            $sheet->setCellValue('E'.$row, $ticket['status']);
            $sheet->setCellValue('F'.$row, $ticket['submitted_at']);

            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="laporan_tiket.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    // ==========================
    // EXPORT PDF
    // ==========================
    public function pdf()
    {
        $ticketModel = new TicketModel();

        $data['tickets'] = $ticketModel
            ->orderBy('submitted_at', 'DESC')
            ->findAll();

        $html = view('report/pdf', $data);

        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $this->response
            ->setContentType('application/pdf')
            ->setBody($dompdf->output());
    }
}