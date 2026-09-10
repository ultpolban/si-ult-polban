<?php

namespace App\Controllers;

use App\Models\TicketModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $ticketModel = new TicketModel();

        /*
        |--------------------------------------------------------------------------
        | AMBIL SEMUA TIKET
        |--------------------------------------------------------------------------
        */
        $tickets = $ticketModel->getTickets();


        /*
        |--------------------------------------------------------------------------
        | NORMALISASI DATA
        |--------------------------------------------------------------------------
        */
        foreach ($tickets as &$ticket) {

            $ticket['status'] = strtolower(
                trim($ticket['status'] ?? '')
            );

            /*
            | Nama layanan
            */
            $ticket['service_name'] =
                $ticket['service_display_name'] ?? '-';

            /*
            | Data pemohon sudah berasal dari JOIN TicketModel
            */
            $ticket['applicant_name'] =
                $ticket['applicant_name'] ?? '-';

            $ticket['nim'] =
                $ticket['nim'] ?? '';

            $ticket['nik'] =
                $ticket['nik'] ?? '';

            $ticket['email'] =
                $ticket['applicant_email'] ?? '';

            $ticket['phone'] =
                $ticket['applicant_phone'] ?? '';
        }

        unset($ticket);


        /*
        |--------------------------------------------------------------------------
        | PERIODE
        |--------------------------------------------------------------------------
        */
        $periode = $this->request->getGet('periode') ?? 'bulan_ini';

        $tanggalMulai   = null;
        $tanggalSelesai = null;

        switch ($periode) {

            case 'hari_ini':

                $tanggalMulai   = date('Y-m-d');
                $tanggalSelesai = date('Y-m-d');

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
        | FILTER TANGGAL
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

                    $timestamp = strtotime(
                        $ticket['submitted_at']
                    );

                    return (
                        $timestamp >= $startTimestamp &&
                        $timestamp <= $endTimestamp
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
        $totalTiket     = count($filteredTickets);
        $submittedTiket = 0;
        $verifiedTiket  = 0;
        $assignedTiket  = 0;
        $progressTiket  = 0;
        $completedTiket = 0;
        $revisionTiket  = 0;
        $rejectedTiket  = 0;


        foreach ($filteredTickets as $ticket) {

            $status = strtolower(
                trim($ticket['status'] ?? '')
            );

            switch ($status) {

                case 'submitted':
                    $submittedTiket++;
                    break;

                case 'verified':
                    $verifiedTiket++;
                    break;

                case 'assigned':
                    $assignedTiket++;
                    break;

                case 'in progress':
                case 'in_progress':
                case 'processing':
                    $progressTiket++;
                    break;

                case 'completed':
                    $completedTiket++;
                    break;

                case 'need revision':
                case 'need_revision':
                case 'revision':
                    $revisionTiket++;
                    break;

                case 'rejected':
                    $rejectedTiket++;
                    break;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | DIPROSES UNIT
        |--------------------------------------------------------------------------
        */
        $diprosesUnit =
            $assignedTiket +
            $progressTiket;


        /*
        |--------------------------------------------------------------------------
        | SLA
        |--------------------------------------------------------------------------
        */
        $batasSLA = date(
            'Y-m-d H:i:s',
            strtotime('-24 hours')
        );

        $terlambatSLA = 0;

        foreach ($filteredTickets as $ticket) {

            $status = strtolower(
                trim($ticket['status'] ?? '')
            );

            if (
                in_array(
                    $status,
                    [
                        'assigned',
                        'in progress',
                        'in_progress',
                        'processing'
                    ],
                    true
                )
            ) {

                if (
                    !empty($ticket['submitted_at']) &&
                    $ticket['submitted_at'] < $batasSLA
                ) {
                    $terlambatSLA++;
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | PRIORITAS TINGGI
        |--------------------------------------------------------------------------
        */
        $prioritasTinggi = 0;

        foreach ($filteredTickets as $ticket) {

            $priority = strtolower(
                trim($ticket['priority'] ?? '')
            );

            if (
                in_array(
                    $priority,
                    ['high', 'tinggi'],
                    true
                )
            ) {
                $prioritasTinggi++;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | DATA JSON
        |--------------------------------------------------------------------------
        */
        $ticketsJson = [];

        foreach ($filteredTickets as $ticket) {

            $ticketsJson[] = [

                'id' =>
                    $ticket['id'] ?? '',

                'ticket_number' =>
                    $ticket['ticket_number'] ?? '',

                'status' =>
                    strtolower(
                        trim($ticket['status'] ?? '')
                    ),

                'submitted_at' =>
                    $ticket['submitted_at'] ?? '',

                'service_name' =>
                    $ticket['service_name'] ?? '',

                'service_code' =>
                    $ticket['service_code'] ?? '',

                'priority' =>
                    $ticket['priority'] ?? '',

                'applicant_name' =>
                    $ticket['applicant_name'] ?? '',

                'nim' =>
                    $ticket['nim'] ?? '',

                'nik' =>
                    $ticket['nik'] ?? '',

                'email' =>
                    $ticket['email'] ?? '',

                'phone' =>
                    $ticket['phone'] ?? '',
            ];
        }


        /*
        |--------------------------------------------------------------------------
        | DATA CHART
        |--------------------------------------------------------------------------
        */
        $statusChart = [

            'submitted' =>
                $submittedTiket,

            'verified' =>
                $verifiedTiket,

            'assigned' =>
                $assignedTiket,

            'in_progress' =>
                $progressTiket,

            'completed' =>
                $completedTiket,

            'need_revision' =>
                $revisionTiket,

            'rejected' =>
                $rejectedTiket,
        ];


        /*
        |--------------------------------------------------------------------------
        | DATA VIEW
        |--------------------------------------------------------------------------
        */
        $data = [

            'periode' =>
                $periode,

            'tanggal_mulai' =>
                $tanggalMulai,

            'tanggal_selesai' =>
                $tanggalSelesai,


            /*
            | Semua tiket yang sudah difilter
            */
            'tickets' =>
                $filteredTickets,

            'ticketsJson' =>
                $ticketsJson,


            /*
            | Statistik
            */
            'total' =>
                $totalTiket,

            'total_tiket' =>
                $totalTiket,

            'submitted' =>
                $submittedTiket,

            'tiket_masuk' =>
                $submittedTiket,

            'verified' =>
                $verifiedTiket,

            'assigned' =>
                $assignedTiket,

            'progress' =>
                $progressTiket,

            'diproses_unit' =>
                $diprosesUnit,

            'completed' =>
                $completedTiket,

            'revision' =>
                $revisionTiket,

            'rejected' =>
                $rejectedTiket,


            /*
            | SLA
            */
            'terlambat_sla' =>
                $terlambatSLA,

            'sla_aman' =>
                max(
                    0,
                    $diprosesUnit - $terlambatSLA
                ),

            'sla_mendekati' =>
                0,

            'sla_terlambat' =>
                $terlambatSLA,


            /*
            | Prioritas
            */
            'prioritas_tinggi' =>
                $prioritasTinggi,


            /*
            | Chart
            */
            'statusChart' =>
                $statusChart,

            'chart_submitted' =>
                $submittedTiket,

            'chart_verified' =>
                $verifiedTiket,

            'chart_assigned' =>
                $assignedTiket,

            'chart_progress' =>
                $progressTiket,

            'chart_completed' =>
                $completedTiket,

            'chart_revision' =>
                $revisionTiket,

            'chart_rejected' =>
                $rejectedTiket,
        ];


        return view(
            'dashboard/index',
            $data
        );
    }
}