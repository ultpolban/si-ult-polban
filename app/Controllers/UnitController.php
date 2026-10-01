<?php

namespace App\Controllers;

use App\Models\TicketModel;
use App\Models\TicketLogModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class UnitController extends BaseController
{
    protected TicketModel $ticketModel;
    protected TicketLogModel $ticketLogModel;
    protected $db;

    /**
     * Status tiket yang boleh dipilih pada form update status unit.
     */
    private const ALLOWED_STATUSES = [
        'assigned',
        'processing',
        'completed',
        'rejected',
    ];

    /**
     * Judul kolom export Data Tiket Unit.
     * Mengikuti kolom tabel pada halaman `unit/tiket`
     * ditambah prioritas & tanggal pengajuan.
     *
     * @var list<string>
     */
    private const EXPORT_HEADERS = [
        'No',
        'No Tiket',
        'Pemohon',
        'Layanan',
        'Unit',
        'Status',
        'Prioritas',
        'Tanggal Pengajuan',
    ];

    public function __construct()
    {
        $this->ticketModel = new TicketModel();
        $this->ticketLogModel = new TicketLogModel();
        $this->db = \Config\Database::connect();
    }

    /**
     * ============================================================
     * HELPER: Ambil tiket unit (assigned + processing)
     *
     * ============================================================
     */
    protected function unitTickets(): array
    {
        $tickets = $this->db
            ->table('tickets t')
            ->select('
                t.*,
                ms.name AS service_display_name,
                ms.code AS service_code,
                ms.service_unit_id,
                msu.name AS unit_name
            ')
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_units msu',
                'msu.id = t.assigned_to',
                'left'
            )
            ->whereIn('LOWER(t.status)', ['assigned', 'processing'])
            ->orderBy('t.updated_at', 'DESC')
            ->get()
            ->getResultArray();

        /*
         * Ambil data pemohon berdasarkan user_profile_id.
         */
        foreach ($tickets as &$ticket) {
            $ticket['applicant_name'] = '-';

            if (!empty($ticket['user_profile_id'])) {
                $profile = $this->db
                    ->table('user_profiles')
                    ->where('id', $ticket['user_profile_id'])
                    ->get()
                    ->getRowArray();

                if ($profile) {
                    foreach (['name', 'full_name', 'nama', 'username'] as $key) {
                        if (!empty($profile[$key])) {
                            $ticket['applicant_name'] = $profile[$key];
                            break;
                        }
                    }
                }
            }
        }

        unset($ticket);

        return $tickets;
    }

    /**
     * ============================================================
     * HALAMAN UNIT LAYANAN
     *
     * Menampilkan tiket:
     * assigned
     * processing
     * ============================================================
     */
    public function index()
    {
        return view('unit/index', [
            'tickets' => $this->unitTickets(),
        ]);
    }

    /**
     * Alias "Data Tiket Unit" (dipakai menu sidebar unit).
     */
    public function tiket()
    {
        return $this->index();
    }

    /**
     * ============================================================
     * EXPORT DATA TIKET UNIT (CSV / EXCEL / PDF)
     *
     * Data yang diekspor sama persis dengan yang tampil pada
     * halaman "Data Tiket" (`unit/tiket`), sehingga hasil unduhan
     * selalu konsisten dengan tabel di layar.
     * ============================================================
     */

    /**
     * Baris data untuk file export.
     *
     * @return list<array<int, int|string>>
     */
    protected function exportRows(): array
    {
        $rows = [];

        foreach ($this->unitTickets() as $i => $ticket) {
            $rows[] = [
                $i + 1,
                (string) ($ticket['ticket_number'] ?? '-'),
                (string) ($ticket['applicant_name'] ?? '-'),
                (string) ($ticket['service_display_name'] ?? '-'),
                (string) ($ticket['unit_name'] ?? '-'),
                ucwords(strtolower(trim((string) ($ticket['status'] ?? '')))) ?: '-',
                (string) ($ticket['priority'] ?? '-'),
                (string) ($ticket['submitted_at'] ?? ($ticket['created_at'] ?? '-')),
            ];
        }

        return $rows;
    }

    /**
     * Nama file export dengan stempel waktu.
     */
    protected function exportFilename(string $extension): string
    {
        return 'data-tiket-unit-' . date('Y-m-d-H-i-s') . '.' . $extension;
    }

    /**
     * EXPORT CSV
     */
    public function exportCsv()
    {
        $handle = fopen('php://temp', 'r+');

        // BOM agar Excel membaca karakter UTF-8 dengan benar.
        fwrite($handle, "\xEF\xBB\xBF");

        fputcsv($handle, self::EXPORT_HEADERS);

        foreach ($this->exportRows() as $row) {
            fputcsv($handle, $row);
        }

        rewind($handle);

        $csv = (string) stream_get_contents($handle);

        fclose($handle);

        return $this->response
            ->setHeader('Content-Type', 'text/csv; charset=UTF-8')
            ->setHeader(
                'Content-Disposition',
                'attachment; filename="' . $this->exportFilename('csv') . '"'
            )
            ->setBody($csv);
    }

    /**
     * EXPORT EXCEL (.xlsx via PhpSpreadsheet)
     */
    public function exportExcel()
    {
        if (! class_exists(Spreadsheet::class)) {
            return redirect()
                ->to(base_url('unit/tiket'))
                ->with(
                    'error',
                    'Export Excel belum tersedia karena library PhpSpreadsheet belum terinstal.'
                );
        }

        $rows   = $this->exportRows();
        $columns = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Data Tiket Unit');
        $sheet->setCellValue('A1', 'Data Tiket Unit Layanan Terpadu');
        $sheet->setCellValue('A2', 'Dicetak pada: ' . date('d-m-Y H:i:s'));
        $sheet->setCellValue('A3', 'Total Tiket: ' . count($rows));

        $headerRow = 5;

        foreach ($columns as $index => $column) {
            $sheet->setCellValue($column . $headerRow, self::EXPORT_HEADERS[$index]);
        }

        $row = $headerRow + 1;

        foreach ($rows as $record) {
            foreach ($columns as $index => $column) {
                $sheet->setCellValue($column . $row, $record[$index]);
            }

            $row++;
        }

        foreach ($columns as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);

        ob_start();
        $writer->save('php://output');
        $output = (string) ob_get_clean();

        $spreadsheet->disconnectWorksheets();
        unset($spreadsheet);

        return $this->response
            ->setHeader(
                'Content-Type',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            )
            ->setHeader(
                'Content-Disposition',
                'attachment; filename="' . $this->exportFilename('xlsx') . '"'
            )
            ->setHeader('Cache-Control', 'max-age=0')
            ->setBody($output);
    }

    /**
     * EXPORT PDF (via Dompdf)
     */
    public function exportPdf()
    {
        if (! class_exists(Dompdf::class)) {
            return redirect()
                ->to(base_url('unit/tiket'))
                ->with(
                    'error',
                    'Export PDF belum tersedia karena library Dompdf belum terinstal.'
                );
        }

        $html = view('unit/export_pdf', [
            'tickets' => $this->unitTickets(),
            'tanggal' => date('d-m-Y H:i:s'),
        ]);

        $options = new Options();
        $options->set('isRemoteEnabled', false);

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        return $this->response
            ->setContentType('application/pdf')
            ->setHeader(
                'Content-Disposition',
                'attachment; filename="' . $this->exportFilename('pdf') . '"'
            )
            ->setBody((string) $dompdf->output());
    }

    /**
     * ============================================================
     * DASHBOARD UNIT (ringkasan antrean tiket)
     * ============================================================
     */
    public function dashboard()
    {
        $tickets = $this->unitTickets();

        $summary = [
            'total'      => count($tickets),
            'assigned'   => 0,
            'processing' => 0,
        ];

        foreach ($tickets as $ticket) {
            $status = strtolower(trim((string) ($ticket['status'] ?? '')));

            if (isset($summary[$status])) {
                $summary[$status]++;
            }
        }

        return view('unit/dashboard', [
            'tickets' => $tickets,
            'summary' => $summary,
        ]);
    }

    /**
     * ============================================================
     * LAPORAN / REKAP TIKET UNIT
     * ============================================================
     */
    public function laporan()
    {
        $from = trim((string) $this->request->getGet('from'));
        $to   = trim((string) $this->request->getGet('to'));

        $builder = $this->db
            ->table('tickets t')
            ->select('
                t.ticket_number,
                t.status,
                t.priority,
                t.submitted_at,
                t.processed_at,
                t.completed_at,
                t.created_at,
                ms.name AS service_name,
                msu.name AS unit_name
            ')
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_units msu',
                'msu.id = t.assigned_to',
                'left'
            )
            ->orderBy('t.created_at', 'DESC');

        if ($from !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $from)) {
            $builder->where('t.created_at >=', $from . ' 00:00:00');
        }

        if ($to !== '' && preg_match('/^\d{4}-\d{2}-\d{2}$/', $to)) {
            $builder->where('t.created_at <=', $to . ' 23:59:59');
        }

        $rows = $builder->get()->getResultArray();

        $rekap = array_fill_keys(self::ALLOWED_STATUSES, 0);

        foreach ($rows as $row) {
            $status = strtolower(trim((string) ($row['status'] ?? '')));

            if (isset($rekap[$status])) {
                $rekap[$status]++;
            }
        }

        return view('unit/laporan', [
            'rows'  => $rows,
            'rekap' => $rekap,
            'from'  => $from,
            'to'    => $to,
        ]);
    }


    /**
     * ============================================================
     * LOG AKTIVITAS UNIT
     *
     * Menampilkan riwayat aktivitas (ticket_logs) terakhir pada
     * tiket yang ditangani unit layanan.
     * ============================================================
     */
    public function logAktivitas()
    {
        $keyword = trim((string) $this->request->getGet('keyword'));
        $limit   = (int) ($this->request->getGet('limit') ?: 100);

        if (! in_array($limit, [25, 50, 100, 250], true)) {
            $limit = 100;
        }

        $builder = $this->db
            ->table('ticket_logs tl')
            ->select('
                tl.id,
                tl.ticket_id,
                tl.activity,
                tl.user_name,
                tl.created_at,
                t.ticket_number,
                t.status AS ticket_status,
                ms.name AS service_name,
                msu.name AS unit_name
            ')
            ->join(
                'tickets t',
                't.id = tl.ticket_id',
                'left'
            )
            ->join(
                'master_services ms',
                'ms.id = t.service_id',
                'left'
            )
            ->join(
                'master_service_units msu',
                'msu.id = t.assigned_to',
                'left'
            )
            ->orderBy('tl.created_at', 'DESC')
            ->orderBy('tl.id', 'DESC')
            ->limit($limit);

        if ($keyword !== '') {
            $builder
                ->groupStart()
                ->like('tl.activity', $keyword)
                ->like('tl.user_name', $keyword)
                ->like('t.ticket_number', $keyword)
                ->groupEnd();
        }

        try {
            $rows = $builder->get()->getResultArray();
        } catch (\Throwable $e) {
            $rows = [];
        }

        return view('unit/log_aktivitas', [
            'rows'    => $rows,
            'keyword' => $keyword,
            'limit'   => $limit,
        ]);
    }


    /**
     * ============================================================
     * DETAIL TIKET UNIT
     * ============================================================
     */
    public function detail(int $id)
    {
        $ticket = $this->ticketModel->find($id);

        if (! $ticket) {
            return redirect()
                ->to(base_url('unit'))
                ->with('error', 'Tiket tidak ditemukan.');
        }

        return view('unit/detail', [
            'ticket' => $ticket,
            'logs'   => $this->readLogs($id),
        ]);
    }

    /**
     * ============================================================
     * FORM UPDATE STATUS TIKET
     * ============================================================
     */
    public function updateStatusForm(int $id)
    {
        $ticket = $this->ticketModel->find($id);

        if (! $ticket) {
            return redirect()
                ->to(base_url('unit'))
                ->with('error', 'Tiket tidak ditemukan.');
        }

        return view('unit/update_status', [
            'ticket'   => $ticket,
            'statuses' => self::ALLOWED_STATUSES,
        ]);
    }

    /**
     * ============================================================
     * SIMPAN UPDATE STATUS TIKET
     * ============================================================
     */
    public function updateStatus(int $id)
    {
        $ticket = $this->ticketModel->find($id);

        if (! $ticket) {
            return redirect()
                ->to(base_url('unit'))
                ->with('error', 'Tiket tidak ditemukan.');
        }

        $status = strtolower(
            trim((string) $this->request->getPost('status'))
        );

        if (! in_array($status, self::ALLOWED_STATUSES, true)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Status yang dipilih tidak valid.');
        }

        $now  = date('Y-m-d H:i:s');
        $data = [
            'status'     => $status,
            'updated_at' => $now,
        ];

        if ($status === 'processing' && empty($ticket['processed_at'])) {
            $data['processed_at'] = $now;
        }

        if ($status === 'completed') {
            $data['completed_at'] = $now;
        }

        if (! $this->ticketModel->update($id, $data)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui status tiket.');
        }

        $note = trim((string) $this->request->getPost('catatan'));

        if ($note === '') {
            $note = 'Status tiket diubah menjadi ' . $status . ' oleh unit layanan.';
        }

        $this->ticketLogModel->addLog(
            $id,
            $note,
            session()->get('name') ?? 'Petugas Unit'
        );

        return redirect()
            ->to(base_url('unit'))
            ->with('success', 'Status tiket berhasil diperbarui.');
    }

    /**
     * Ambil riwayat log tiket (aman bila tabel log belum terisi).
     */
    protected function readLogs(int $id): array
    {
        try {
            return $this->ticketLogModel
                ->where('ticket_id', $id)
                ->orderBy('created_at', 'DESC')
                ->findAll();
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * ============================================================
     * PROSES TIKET
     *
     * assigned
     *     ↓
     * processing
     * ============================================================
     */
    public function process($id = null)
    {
        if (empty($id)) {
            return redirect()
                ->to(base_url('unit'))
                ->with('error', 'ID tiket tidak ditemukan.');
        }

        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('unit'))
                ->with('error', 'Tiket tidak ditemukan.');
        }

        if (
            strtolower(trim($ticket['status'] ?? '')) !== 'assigned'
        ) {
            return redirect()
                ->to(base_url('unit'))
                ->with(
                    'error',
                    'Tiket ini belum berada dalam antrean unit.'
                );
        }

        $now = date('Y-m-d H:i:s');

        $updated = $this->ticketModel->update($id, [
            'status'       => 'processing',
            'processed_at' => $now,
            'updated_at'   => $now
        ]);

        if (!$updated) {
            return redirect()
                ->to(base_url('unit'))
                ->with(
                    'error',
                    'Gagal mengubah status tiket menjadi processing.'
                );
        }

        $this->ticketLogModel->addLog(
            $id,
            'Tiket mulai diproses oleh unit layanan.',
            session()->get('name') ?? 'Petugas Unit'
        );

        return redirect()
            ->to(base_url('unit'))
            ->with(
                'success',
                'Tiket berhasil diproses.'
            );
    }


    /**
     * ============================================================
     * SELESAIKAN TIKET
     *
     * processing
     *     ↓
     * completed
     * ============================================================
     */
    public function complete($id = null)
    {
        if (empty($id)) {
            return redirect()
                ->to(base_url('unit'))
                ->with('error', 'ID tiket tidak ditemukan.');
        }

        $ticket = $this->ticketModel->find($id);

        if (!$ticket) {
            return redirect()
                ->to(base_url('unit'))
                ->with('error', 'Tiket tidak ditemukan.');
        }

        if (
            strtolower(trim($ticket['status'] ?? '')) !== 'processing'
        ) {
            return redirect()
                ->to(base_url('unit'))
                ->with(
                    'error',
                    'Tiket belum berstatus processing.'
                );
        }

        $now = date('Y-m-d H:i:s');

        $updated = $this->ticketModel->update($id, [
            'status'       => 'completed',
            'completed_at' => $now,
            'updated_at'   => $now
        ]);

        if (!$updated) {
            return redirect()
                ->to(base_url('unit'))
                ->with(
                    'error',
                    'Gagal menyelesaikan tiket.'
                );
        }

        $this->ticketLogModel->addLog(
            $id,
            'Tiket telah selesai diproses oleh unit layanan.',
            session()->get('name') ?? 'Petugas Unit'
        );

        return redirect()
            ->to(base_url('unit'))
            ->with(
                'success',
                'Tiket berhasil diselesaikan.'
            );
    }
}