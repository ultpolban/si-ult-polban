<?php

namespace App\Controllers;

use App\Models\TicketModel;

class DashboardController extends BaseController
{
    /**
     * =========================================================
     * DASHBOARD UTAMA
     * =========================================================
     */
    public function index()
    {
        $ticketModel = new TicketModel();

        /*
        |---------------------------------------------------------
        | Ambil seluruh tiket
        |---------------------------------------------------------
        */
        $tickets = $ticketModel->getTickets();

        if (!is_array($tickets)) {
            $tickets = [];
        }

        /*
        |---------------------------------------------------------
        | Hitung statistik dashboard utama
        | Statistik utama menggunakan SEMUA tiket.
        |---------------------------------------------------------
        */
        $jumlahTiket       = count($tickets);
        $jumlahSubmitted   = 0;
        $jumlahVerified    = 0;
        $jumlahDisposisi   = 0;
        $jumlahCompleted   = 0;
        $jumlahRejected    = 0;
        $jumlahRevision    = 0;

        foreach ($tickets as $ticket) {

            $status = strtolower(
                trim($ticket['status'] ?? '')
            );

            switch ($status) {

                case 'submitted':
                    $jumlahSubmitted++;
                    break;

                case 'verified':
                    $jumlahVerified++;
                    break;

                case 'assigned':
                    $jumlahDisposisi++;
                    break;

                case 'in progress':
                case 'in_progress':
                case 'processing':
                    $jumlahDisposisi++;
                    break;

                case 'completed':
                    $jumlahCompleted++;
                    break;

                case 'rejected':
                    $jumlahRejected++;
                    break;

                case 'revision':
                case 'need revision':
                case 'need_revision':
                    $jumlahRevision++;
                    break;
            }
        }

        /*
        |---------------------------------------------------------
        | Data Dashboard Utama
        |---------------------------------------------------------
        */
        $data = [

            'jumlahTiket' =>
                $jumlahTiket,

            'jumlahSubmitted' =>
                $jumlahSubmitted,

            'jumlahVerified' =>
                $jumlahVerified,

            'jumlahDisposisi' =>
                $jumlahDisposisi,

            'jumlahCompleted' =>
                $jumlahCompleted,

            'jumlahRejected' =>
                $jumlahRejected,

            'jumlahRevision' =>
                $jumlahRevision,
        ];

        return view(
            'petugas/dashboard',
            $data
        );
    }


    /**
     * =========================================================
     * HALAMAN STATISTIK & ANALITIK
     * =========================================================
     */
    public function statistik()
    {
        $ticketModel = new TicketModel();

        $tickets = $ticketModel->getTickets();

        if (!is_array($tickets)) {
            $tickets = [];
        }

        /*
        |---------------------------------------------------------
        | Default halaman statistik = Bulan Ini
        |---------------------------------------------------------
        */
        $periode = $this->request->getGet('periode')
            ?? 'bulan_ini';

        $tanggalMulai   = null;
        $tanggalSelesai = null;

        switch ($periode) {

            case 'hari_ini':

                $tanggalMulai =
                    date('Y-m-d');

                $tanggalSelesai =
                    date('Y-m-d');

                break;


            case 'minggu_ini':

                $tanggalMulai =
                    date(
                        'Y-m-d',
                        strtotime('monday this week')
                    );

                $tanggalSelesai =
                    date(
                        'Y-m-d',
                        strtotime('sunday this week')
                    );

                break;


            case 'bulan_ini':

                $tanggalMulai =
                    date('Y-m-01');

                $tanggalSelesai =
                    date('Y-m-t');

                break;


            case 'tahun_ini':

                $tanggalMulai =
                    date('Y-01-01');

                $tanggalSelesai =
                    date('Y-12-31');

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

                if (
                    empty($tanggalMulai) ||
                    empty($tanggalSelesai)
                ) {
                    $periode = 'bulan_ini';

                    $tanggalMulai =
                        date('Y-m-01');

                    $tanggalSelesai =
                        date('Y-m-t');
                }

                break;


            default:

                $periode = 'bulan_ini';

                $tanggalMulai =
                    date('Y-m-01');

                $tanggalSelesai =
                    date('Y-m-t');

                break;
        }

        /*
        |---------------------------------------------------------
        | Filter tiket berdasarkan submitted_at
        |---------------------------------------------------------
        */
        $filteredTickets = $tickets;

        if (
            !empty($tanggalMulai) &&
            !empty($tanggalSelesai)
        ) {

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

                    if (
                        empty(
                            $ticket['submitted_at']
                        )
                    ) {
                        return false;
                    }

                    $timestamp = strtotime(
                        $ticket['submitted_at']
                    );

                    return (
                        $timestamp >=
                            $startTimestamp
                        &&
                        $timestamp <=
                            $endTimestamp
                    );
                }
            );

            $filteredTickets =
                array_values(
                    $filteredTickets
                );
        }

        /*
        |---------------------------------------------------------
        | Hitung status
        |---------------------------------------------------------
        */
        $submittedTiket = 0;
        $verifiedTiket  = 0;
        $assignedTiket  = 0;
        $progressTiket  = 0;
        $completedTiket = 0;
        $revisionTiket  = 0;
        $rejectedTiket  = 0;

        foreach (
            $filteredTickets
            as $ticket
        ) {

            $status = strtolower(
                trim(
                    $ticket['status'] ?? ''
                )
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

                case 'revision':
                case 'need revision':
                case 'need_revision':
                    $revisionTiket++;
                    break;

                case 'rejected':
                    $rejectedTiket++;
                    break;
            }
        }

        /*
        |---------------------------------------------------------
        | Total tiket
        |---------------------------------------------------------
        */
        $totalTiket =
            count($filteredTickets);

        /*
        |---------------------------------------------------------
        | Disposisi / diproses unit
        |---------------------------------------------------------
        */
        $diprosesUnit =
            $assignedTiket +
            $progressTiket;

        /*
        |---------------------------------------------------------
        | Data view
        |---------------------------------------------------------
        */
        $data = [

            'periode' =>
                $periode,

            'tanggal_mulai' =>
                $tanggalMulai,

            'tanggal_selesai' =>
                $tanggalSelesai,

            'totalTiket' =>
                $totalTiket,

            'submittedTiket' =>
                $submittedTiket,

            'verifiedTiket' =>
                $verifiedTiket,

            'assignedTiket' =>
                $assignedTiket,

            'progressTiket' =>
                $progressTiket,

            'diprosesUnit' =>
                $diprosesUnit,

            'completedTiket' =>
                $completedTiket,

            'revisionTiket' =>
                $revisionTiket,

            'rejectedTiket' =>
                $rejectedTiket,
        ];

        return view(
            'petugas/statistik',
            $data
        );
    }


    /**
     * =========================================================
     * API STATISTIK
     * =========================================================
     */
    public function statistikData()
    {
        $ticketModel = new TicketModel();

        $tickets = $ticketModel->getTickets();

        if (!is_array($tickets)) {
            $tickets = [];
        }

        /*
        |---------------------------------------------------------
        | Ambil periode
        |---------------------------------------------------------
        */
        $periode =
            $this->request->getGet('periode')
            ?? 'bulan_ini';

        /*
        |---------------------------------------------------------
        | Samakan format frontend lama
        |---------------------------------------------------------
        */
        $periodeMap = [

            'hari' =>
                'hari_ini',

            'minggu' =>
                'minggu_ini',

            'bulan' =>
                'bulan_ini',

            'tahun' =>
                'tahun_ini',

            'custom' =>
                'manual',

            'semua' =>
                'semua',
        ];

        if (
            isset(
                $periodeMap[$periode]
            )
        ) {
            $periode =
                $periodeMap[$periode];
        }

        $tanggalMulai   = null;
        $tanggalSelesai = null;

        /*
        |---------------------------------------------------------
        | Tentukan periode
        |---------------------------------------------------------
        */
        switch ($periode) {

            case 'hari_ini':

                $tanggalMulai =
                    date('Y-m-d');

                $tanggalSelesai =
                    date('Y-m-d');

                break;


            case 'minggu_ini':

                $tanggalMulai =
                    date(
                        'Y-m-d',
                        strtotime(
                            'monday this week'
                        )
                    );

                $tanggalSelesai =
                    date(
                        'Y-m-d',
                        strtotime(
                            'sunday this week'
                        )
                    );

                break;


            case 'bulan_ini':

                $tanggalMulai =
                    date('Y-m-01');

                $tanggalSelesai =
                    date('Y-m-t');

                break;


            case 'tahun_ini':

                $tanggalMulai =
                    date('Y-01-01');

                $tanggalSelesai =
                    date('Y-12-31');

                break;


            case 'semua':

                $tanggalMulai   = null;
                $tanggalSelesai = null;

                break;


            case 'manual':

                $tanggalMulai =
                    $this->request->getGet(
                        'start_date'
                    )
                    ??
                    $this->request->getGet(
                        'tanggal_mulai'
                    );

                $tanggalSelesai =
                    $this->request->getGet(
                        'end_date'
                    )
                    ??
                    $this->request->getGet(
                        'tanggal_selesai'
                    );

                if (
                    empty($tanggalMulai) ||
                    empty($tanggalSelesai)
                ) {

                    $tanggalMulai =
                        date('Y-m-01');

                    $tanggalSelesai =
                        date('Y-m-t');
                }

                break;


            default:

                $tanggalMulai =
                    date('Y-m-01');

                $tanggalSelesai =
                    date('Y-m-t');

                break;
        }

        /*
        |---------------------------------------------------------
        | Filter tiket
        |---------------------------------------------------------
        */
        $filteredTickets = $tickets;

        if (
            !empty($tanggalMulai) &&
            !empty($tanggalSelesai)
        ) {

            $startTimestamp =
                strtotime(
                    $tanggalMulai .
                    ' 00:00:00'
                );

            $endTimestamp =
                strtotime(
                    $tanggalSelesai .
                    ' 23:59:59'
                );

            $filteredTickets =
                array_filter(
                    $tickets,
                    function ($ticket)
                    use (
                        $startTimestamp,
                        $endTimestamp
                    ) {

                        if (
                            empty(
                                $ticket['submitted_at']
                            )
                        ) {
                            return false;
                        }

                        $timestamp =
                            strtotime(
                                $ticket[
                                    'submitted_at'
                                ]
                            );

                        return (
                            $timestamp >=
                                $startTimestamp
                            &&
                            $timestamp <=
                                $endTimestamp
                        );
                    }
                );

            $filteredTickets =
                array_values(
                    $filteredTickets
                );
        }

        /*
        |---------------------------------------------------------
        | Hitung status
        |---------------------------------------------------------
        */
        $submittedTiket = 0;
        $verifiedTiket  = 0;
        $assignedTiket  = 0;
        $progressTiket  = 0;
        $completedTiket = 0;
        $rejectedTiket  = 0;

        foreach (
            $filteredTickets
            as $ticket
        ) {

            $status =
                strtolower(
                    trim(
                        $ticket['status']
                        ?? ''
                    )
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

                case 'rejected':
                    $rejectedTiket++;
                    break;
            }
        }

        /*
        |---------------------------------------------------------
        | Diproses / Disposisi
        |---------------------------------------------------------
        */
        $diprosesUnit =
            $assignedTiket +
            $progressTiket;

        /*
        |---------------------------------------------------------
        | Response JSON
        |---------------------------------------------------------
        */
        return $this->response
            ->setJSON([

                'status' =>
                    'success',

                'data' => [

                    'total' =>
                        count(
                            $filteredTickets
                        ),

                    'submitted' =>
                        $submittedTiket,

                    'verified' =>
                        $verifiedTiket,

                    'disposisi' =>
                        $diprosesUnit,

                    'assigned' =>
                        $assignedTiket,

                    'in_progress' =>
                        $progressTiket,

                    'completed' =>
                        $completedTiket,

                    'rejected' =>
                        $rejectedTiket,
                ],
            ]);
    }
}