<?php

namespace App\Controllers;

use App\Models\TicketModel;

class StatisticsController extends BaseController
{
    /**
     * ==========================================================
     * TENTUKAN PERIODE
     * ==========================================================
     */
    private function getPeriod()
    {
        $periode = $this->request->getGet('periode') ?? 'bulan';

        switch ($periode) {

            case 'hari':
            case 'hari_ini':

                return [
                    'periode' => 'hari',
                    'mulai'   => date('Y-m-d'),
                    'selesai' => date('Y-m-d'),
                ];

            case 'minggu':
            case 'minggu_ini':

                return [
                    'periode' => 'minggu',
                    'mulai'   => date('Y-m-d', strtotime('monday this week')),
                    'selesai' => date('Y-m-d', strtotime('sunday this week')),
                ];

            case 'bulan':
            case 'bulan_ini':

                return [
                    'periode' => 'bulan',
                    'mulai'   => date('Y-m-01'),
                    'selesai' => date('Y-m-t'),
                ];

            case 'tahun':
            case 'tahun_ini':

                return [
                    'periode' => 'tahun',
                    'mulai'   => date('Y-01-01'),
                    'selesai' => date('Y-12-31'),
                ];

            case 'custom':
            case 'manual':

                $mulai = $this->request->getGet('start_date')
                    ?? $this->request->getGet('tanggal_mulai');

                $selesai = $this->request->getGet('end_date')
                    ?? $this->request->getGet('tanggal_selesai');

                if ($mulai && $selesai) {
                    return [
                        'periode' => 'custom',
                        'mulai'   => $mulai,
                        'selesai' => $selesai,
                    ];
                }

                return [
                    'periode' => 'bulan',
                    'mulai'   => date('Y-m-01'),
                    'selesai' => date('Y-m-t'),
                ];

            case 'semua':

                return [
                    'periode' => 'semua',
                    'mulai'   => null,
                    'selesai' => null,
                ];

            default:

                return [
                    'periode' => 'bulan',
                    'mulai'   => date('Y-m-01'),
                    'selesai' => date('Y-m-t'),
                ];
        }
    }

    /**
     * ==========================================================
     * AMBIL TIKET BERDASARKAN PERIODE
     * ==========================================================
     */
    private function getFilteredTickets()
    {
        $ticketModel = new TicketModel();

        $tickets = $ticketModel->getTickets();

        $period = $this->getPeriod();

        /*
         * Kalau pilih SEMUA, jangan filter tanggal.
         */
        if (!$period['mulai'] || !$period['selesai']) {
            return $tickets;
        }

        $startTimestamp = strtotime(
            $period['mulai'] . ' 00:00:00'
        );

        $endTimestamp = strtotime(
            $period['selesai'] . ' 23:59:59'
        );

        $filtered = array_filter(
            $tickets,
            function ($ticket) use ($startTimestamp, $endTimestamp) {

                $tanggal =
                    $ticket['submitted_at']
                    ?? $ticket['created_at']
                    ?? null;

                if (!$tanggal) {
                    return false;
                }

                $timestamp = strtotime($tanggal);

                return
                    $timestamp >= $startTimestamp
                    && $timestamp <= $endTimestamp;
            }
        );

        return array_values($filtered);
    }

    /**
     * ==========================================================
     * HITUNG STATISTIK
     * ==========================================================
     */
    private function calculateStatistics(array $tickets)
    {
        $total      = count($tickets);
        $submitted  = 0;
        $verified   = 0;
        $assigned   = 0;
        $progress   = 0;
        $completed  = 0;
        $revision   = 0;
        $rejected   = 0;

        foreach ($tickets as $ticket) {

            $status = strtolower(
                trim($ticket['status'] ?? '')
            );

            switch ($status) {

                /*
                 * MENUNGGU VERIFIKASI
                 */
                case 'submitted':
                    $submitted++;
                    break;

                /*
                 * SUDAH DIVERIFIKASI
                 */
                case 'verified':
                    $verified++;
                    break;

                /*
                 * SUDAH DIDISPOSISIKAN
                 */
                case 'assigned':
                case 'disposisi':
                    $assigned++;
                    break;

                /*
                 * SEDANG DIPROSES
                 */
                case 'in progress':
                case 'in_progress':
                case 'processing':
                    $progress++;
                    break;

                /*
                 * SELESAI
                 */
                case 'completed':
                    $completed++;
                    break;

                /*
                 * PERLU REVISI
                 */
                case 'need revision':
                case 'need_revision':
                case 'revision':
                    $revision++;
                    break;

                /*
                 * DITOLAK
                 */
                case 'rejected':
                    $rejected++;
                    break;
            }
        }

        /*
         * ======================================================
         * EFISIENSI
         * ======================================================
         *
         * Persentase tiket yang sudah selesai dibanding
         * seluruh tiket pada periode yang dipilih.
         */
        $efisiensi = $total > 0
            ? round(($completed / $total) * 100)
            : 0;

        /*
         * ======================================================
         * TIMELINE
         * ======================================================
         *
         * Ambil maksimal 5 tiket terbaru.
         */
        $timeline = array_slice($tickets, 0, 5);

        $timelineData = [];

        foreach ($timeline as $ticket) {

            $status = strtolower(
                trim($ticket['status'] ?? '')
            );

            /*
             * Default
             */
            $statusLabel = 'Submitted / Menunggu';
            $statusClass = 'badge-ult-navy';
            $dotClass    = 'info';
            $detail      = 'Tiket baru diterima oleh sistem.';

            switch ($status) {

                case 'completed':

                    $statusLabel = 'Completed / Selesai';
                    $statusClass = 'badge-ult-green';
                    $dotClass    = 'success';
                    $detail      = 'Tiket telah selesai diproses.';

                    break;

                case 'verified':

                    $statusLabel = 'Verified / Terverifikasi';
                    $statusClass = 'badge-ult-green';
                    $dotClass    = 'success';
                    $detail      = 'Tiket telah diverifikasi oleh Petugas ULT.';

                    break;

                case 'assigned':
                case 'disposisi':

                    $statusLabel = 'Assigned / Disposisi';
                    $statusClass = 'badge-ult-orange';
                    $dotClass    = 'warning';
                    $detail      = 'Tiket telah didisposisikan ke unit tujuan.';

                    break;

                case 'in progress':
                case 'in_progress':
                case 'processing':

                    $statusLabel = 'In Progress / Diproses';
                    $statusClass = 'badge-ult-orange';
                    $dotClass    = 'warning';
                    $detail      = 'Tiket sedang diproses oleh unit tujuan.';

                    break;

                case 'rejected':

                    $statusLabel = 'Rejected / Ditolak';
                    $statusClass = 'badge-ult-orange';
                    $dotClass    = 'warning';
                    $detail      = 'Tiket ditolak dalam proses verifikasi.';

                    break;

                case 'need revision':
                case 'need_revision':
                case 'revision':

                    $statusLabel = 'Need Revision / Perlu Perbaikan';
                    $statusClass = 'badge-ult-orange';
                    $dotClass    = 'warning';
                    $detail      = 'Tiket membutuhkan perbaikan data.';

                    break;
            }

            /*
             * Nama pemohon
             */
            $namaPemohon =
                !empty($ticket['student_name'])
                    ? $ticket['student_name']
                    : (
                        !empty($ticket['profile_name'])
                            ? $ticket['profile_name']
                            : 'Pemohon'
                    );

            /*
             * Nama layanan
             */
            $layanan =
                !empty($ticket['service_name'])
                    ? $ticket['service_name']
                    : 'Layanan ULT';

            /*
             * Unit tujuan
             */
            $unit =
                !empty($ticket['unit_name'])
                    ? $ticket['unit_name']
                    : '-';

            /*
             * Tanggal pengajuan
             */
            $tanggal =
                $ticket['submitted_at']
                ?? $ticket['created_at']
                ?? null;

            $timelineData[] = [

                'kode' =>
                    $ticket['ticket_number']
                    ?? '-',

                'pemohon' =>
                    $namaPemohon,

                'layanan' =>
                    $ticket['title']
                    ?? $layanan,

                'waktu' =>
                    $tanggal
                        ? date(
                            'd-m-Y H:i',
                            strtotime($tanggal)
                        )
                        : '-',

                'detail' =>
                    $detail,

                'status' =>
                    $statusLabel,

                'status_class' =>
                    $statusClass,

                'dot_class' =>
                    $dotClass,

                'disposisi' =>
                    $unit,
            ];
        }

        /*
         * ======================================================
         * HASIL AKHIR
         * ======================================================
         */
        return [

            'total_tiket' =>
                $total,

            'submitted' =>
                $submitted,

            'verified' =>
                $verified,

            'assigned' =>
                $assigned,

            'in_progress' =>
                $progress,

            'completed' =>
                $completed,

            'need_revision' =>
                $revision,

            'rejected' =>
                $rejected,

            'efisiensi' =>
                $efisiensi,

            'timeline' =>
                $timelineData,
        ];
    }

    /**
     * ==========================================================
     * HALAMAN STATISTIK
     * ==========================================================
     */
    public function index()
    {
        $period = $this->getPeriod();

        $tickets = $this->getFilteredTickets();

        $statistics = $this->calculateStatistics($tickets);

        $data = array_merge(
            [
                'periode' =>
                    $period['periode'],

                'tanggal_mulai' =>
                    $period['mulai'],

                'tanggal_selesai' =>
                    $period['selesai'],

                'tickets' =>
                    $tickets,
            ],
            $statistics
        );

        return view(
            'petugas/statistik_tiket',
            $data
        );
    }

    /**
     * ==========================================================
     * API STATISTIK AJAX
     * ==========================================================
     */
    public function statistikData()
    {
        $tickets = $this->getFilteredTickets();

        $statistics = $this->calculateStatistics($tickets);

        return $this->response->setJSON([
            'status' => 'success',
            'data'   => $statistics,
        ]);
    }
}