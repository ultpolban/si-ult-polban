<?php

namespace App\Controllers;

use App\Models\TicketModel;

class StatisticsController extends BaseController
{
    public function index()
    {
        $ticketModel = new TicketModel();

        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA TIKET
        |--------------------------------------------------------------------------
        | Gunakan getTickets() yang sama seperti DashboardController
        | agar sumber data statistik sama dengan Dashboard.
        */
        $tickets = $ticketModel->getTickets();

        /*
        |--------------------------------------------------------------------------
        | FILTER PERIODE
        |--------------------------------------------------------------------------
        | Samakan dengan DashboardController.
        */
        $periode = $this->request->getGet('periode') ?? 'bulan_ini';

        $tanggalMulai   = null;
        $tanggalSelesai = null;

        $hariIni = date('Y-m-d');

        switch ($periode) {

            case 'hari_ini':

                $tanggalMulai   = $hariIni;
                $tanggalSelesai = $hariIni;

                break;

            case 'minggu_ini':

                $tanggalMulai = date(
                    'Y-m-d',
                    strtotime('monday this week')
                );

                $tanggalSelesai = date(
                    'Y-m-d',
                    strtotime('sunday this week')
                );

                break;

            case 'bulan_ini':

                $tanggalMulai   = date('Y-m-01');
                $tanggalSelesai = date('Y-m-t');

                break;

            case 'tahun_ini':

                $tanggalMulai   = date('Y-01-01');
                $tanggalSelesai = date('Y-12-31');

                break;

            case 'semua':

                $tanggalMulai   = null;
                $tanggalSelesai = null;

                break;

            case 'manual':

                $tanggalMulai =
                    $this->request->getGet('tanggal_mulai');

                $tanggalSelesai =
                    $this->request->getGet('tanggal_selesai');

                if (!$tanggalMulai || !$tanggalSelesai) {

                    $periode = 'bulan_ini';

                    $tanggalMulai   = date('Y-m-01');
                    $tanggalSelesai = date('Y-m-t');
                }

                break;

            default:

                $periode = 'bulan_ini';

                $tanggalMulai   = date('Y-m-01');
                $tanggalSelesai = date('Y-m-t');

                break;
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER TIKET BERDASARKAN TANGGAL
        |--------------------------------------------------------------------------
        */
        $filteredTickets = $tickets;

        if ($tanggalMulai && $tanggalSelesai) {

            $startTimestamp = strtotime(
                $tanggalMulai . ' 00:00:00'
            );

            $endTimestamp = strtotime(
                $tanggalSelesai . ' 23:59:59'
            );

            $filteredTickets = array_filter(
                $tickets,
                function ($ticket) use (
                    $startTimestamp,
                    $endTimestamp
                ) {

                    if (empty($ticket['submitted_at'])) {
                        return false;
                    }

                    $ticketTimestamp = strtotime(
                        $ticket['submitted_at']
                    );

                    return (
                        $ticketTimestamp >= $startTimestamp &&
                        $ticketTimestamp <= $endTimestamp
                    );
                }
            );

            $filteredTickets = array_values(
                $filteredTickets
            );
        }

        /*
        |--------------------------------------------------------------------------
        | HITUNG STATUS
        |--------------------------------------------------------------------------
        */
        $total     = count($filteredTickets);
        $submitted = 0;
        $verified  = 0;
        $assigned  = 0;
        $progress  = 0;
        $completed = 0;
        $revision  = 0;
        $rejected  = 0;

        foreach ($filteredTickets as $ticket) {

            $status = strtolower(
                trim($ticket['status'] ?? '')
            );

            switch ($status) {

                case 'submitted':
                    $submitted++;
                    break;

                case 'verified':
                    $verified++;
                    break;

                case 'assigned':
                    $assigned++;
                    break;

                case 'in progress':
                case 'processing':
                    $progress++;
                    break;

                case 'completed':
                    $completed++;
                    break;

                case 'need revision':
                case 'revision':
                    $revision++;
                    break;

                case 'rejected':
                    $rejected++;
                    break;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | STATUS LAINNYA
        |--------------------------------------------------------------------------
        */
        $knownStatusTotal =
            $submitted +
            $verified +
            $assigned +
            $progress +
            $completed +
            $revision +
            $rejected;

        $other = max(
            0,
            $total - $knownStatusTotal
        );

        /*
        |--------------------------------------------------------------------------
        | PERSENTASE PENYELESAIAN
        |--------------------------------------------------------------------------
        */
        $progressPercent = 0;

        if ($total > 0) {

            $progressPercent = round(
                ($completed / $total) * 100
            );
        }

        /*
        |--------------------------------------------------------------------------
        | DATA CHART
        |--------------------------------------------------------------------------
        */
        $statusChart = [
            'submitted'     => $submitted,
            'verified'      => $verified,
            'assigned'      => $assigned,
            'in progress'   => $progress,
            'completed'     => $completed,
            'need revision' => $revision,
            'rejected'      => $rejected,
            'other'         => $other,
        ];

        /*
        |--------------------------------------------------------------------------
        | DATA KE VIEW
        |--------------------------------------------------------------------------
        */
        $data = [

            // Periode
            'periode'        => $periode,
            'tanggal_mulai'  => $tanggalMulai,
            'tanggal_selesai'=> $tanggalSelesai,

            // Data tiket
            'tickets' => $filteredTickets,

            // Statistik
            'total'     => $total,
            'submitted' => $submitted,
            'verified'  => $verified,
            'assigned'  => $assigned,
            'progress'  => $progress,
            'completed' => $completed,
            'revision'  => $revision,
            'rejected'  => $rejected,
            'other'     => $other,

            // Progress
            'progressPercent' => $progressPercent,

            // Chart
            'statusChart' => $statusChart,
        ];

        return view(
            'statistics/index',
            $data
        );
    }
}