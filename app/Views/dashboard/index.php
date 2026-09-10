<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>

.dashboard-title {
    color: #182b80;
    font-weight: 700;
    font-size: 30px;
}

.dashboard-subtitle {
    color: #777;
    font-size: 16px;
}

/* =========================================================
   STATISTIC BOX
   ========================================================= */

.stat-card {
    border-radius: 12px;
    color: white;
    min-height: 105px;
    position: relative;
    overflow: hidden;
    box-shadow: 0 3px 8px rgba(0,0,0,.12);
}

.stat-card .inner {
    padding: 20px;
    position: relative;
    z-index: 2;
}

.stat-card h3 {
    font-size: 27px;
    font-weight: 700;
    margin: 0 0 5px 0;
}

.stat-card p {
    font-size: 16px;
    font-weight: 600;
    margin: 0;
}

.stat-card .stat-icon {
    position: absolute;
    right: 20px;
    top: 25px;
    font-size: 45px;
    opacity: .20;
}

.stat-blue {
    background: #202d87;
}

.stat-orange {
    background: #ff8b00;
}

.stat-yellow {
    background: #f5c400;
}

.stat-green {
    background: #128044;
}

/* =========================================================
   QUICK ACTION
   ========================================================= */

.quick-card {
    border-radius: 12px;
    box-shadow: 0 3px 8px rgba(0,0,0,.10);
    overflow: hidden;
}

.section-header {
    background: #202d87;
    color: white;
    padding: 10px 16px;
    font-size: 18px;
    font-weight: 700;
}

.quick-body {
    padding: 16px;
}

.quick-btn {
    width: 100%;
    border: none;
    color: white !important;
    font-size: 17px;
    font-weight: 600;
    padding: 17px 10px;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 12px;
    box-shadow: 0 2px 5px rgba(0,0,0,.12);
    text-decoration: none !important;
    cursor: pointer;
}

.quick-orange {
    background: #ff8b00;
}

.quick-green {
    background: #128044;
}

.quick-yellow {
    background: #f5c400;
}

.quick-dark {
    background: #343a40;
}

/* =========================================================
   ANALYTICS
   ========================================================= */

.analytics-card {
    border-radius: 12px;
    box-shadow: 0 3px 8px rgba(0,0,0,.10);
    overflow: hidden;
    background: #fff;
}

.analytics-header {
    background: #202d87;
    color: white;
    padding: 13px 16px;
    font-size: 18px;
    font-weight: 700;
}

.analytics-body {
    padding: 20px;
}

/* =========================================================
   FILTER
   ========================================================= */

.period-filter {
    background: #f8f9fa;
    border: 1px solid #e1e4e8;
    border-radius: 10px;
    padding: 15px;
    margin-bottom: 20px;
}

.period-label {
    font-weight: 600;
    color: #555;
    margin-bottom: 7px;
}

.period-control {
    height: 45px;
    border-radius: 8px;
    border: 1px solid #ddd;
}

.date-manual {
    display: none;
}

.date-manual.show {
    display: block;
}

.apply-btn {
    height: 45px;
    border-radius: 8px;
    background: #ff8b00;
    border: none;
    color: white;
    font-weight: 600;
    width: 100%;
}

.apply-btn:hover {
    background: #e77c00;
    color: white;
}

.period-info {
    color: #777;
    font-size: 14px;
}

/* =========================================================
   ANALYTICS STAT
   ========================================================= */

.analytics-stat {
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    padding: 17px;
    height: 100%;
    background: #fff;
}

.analytics-stat .analytics-icon {
    width: 42px;
    height: 42px;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    float: left;
    margin-right: 12px;
}

.analytics-stat .analytics-number {
    font-size: 25px;
    font-weight: 700;
    color: #202d87;
    line-height: 1.1;
}

.analytics-stat .analytics-label {
    font-size: 13px;
    color: #777;
    margin-top: 4px;
}

.icon-total {
    background: #202d87;
}

.icon-submitted {
    background: #ff8b00;
}

.icon-process {
    background: #f5c400;
}

.icon-completed {
    background: #128044;
}

/* =========================================================
   CHART
   ========================================================= */

.chart-container {
    position: relative;
    height: 350px;
    width: 100%;
}

.chart-card {
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    padding: 15px;
    height: 100%;
}

.chart-title {
    font-size: 16px;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
}

/* =========================================================
   RESPONSIVE
   ========================================================= */

@media(max-width: 768px) {

    .dashboard-title {
        font-size: 24px;
    }

    .quick-btn {
        margin-bottom: 10px;
    }

    .chart-container {
        height: 280px;
    }

}

</style>


<?php

/*
|--------------------------------------------------------------------------
| DATA TIKET
|--------------------------------------------------------------------------
*/

$allTickets = !empty($tickets)
    ? $tickets
    : [];


/*
|--------------------------------------------------------------------------
| KONVERSI DATA UNTUK JAVASCRIPT
|--------------------------------------------------------------------------
*/

$ticketsJson = [];

foreach ($allTickets as $ticket) {

    $ticketsJson[] = [

        'id' => $ticket['id'] ?? '',

        'ticket_number' =>
            $ticket['ticket_number'] ?? '',

        'status' =>
            strtolower(trim($ticket['status'] ?? '')),

        'submitted_at' =>
            $ticket['submitted_at'] ?? '',

        'service_name' =>
            $ticket['service_name'] ?? '',

        'priority' =>
            $ticket['priority'] ?? '',

        'applicant_name' =>
            $ticket['applicant_name'] ?? '',

        'nim' =>
            $ticket['nim'] ?? '',

        'nik' =>
            $ticket['nik'] ?? ''

    ];
}

?>


<!-- =========================================================
     HEADER
     ========================================================= -->

<section class="content-header">

    <div class="container-fluid">

        <div class="row">

            <div class="col-sm-8">

                <h1 class="dashboard-title">
                    Dashboard Petugas ULT
                </h1>

                <div class="dashboard-subtitle">
                    Kelola tiket layanan mahasiswa Politeknik Negeri Bandung.
                </div>

            </div>

            <div class="col-sm-4 text-right">

                <div class="text-muted mt-2">

                    <span style="color:#1683df;">
                        Dashboard
                    </span>

                    &nbsp;/&nbsp;

                    Home

                </div>

            </div>

        </div>

    </div>

</section>


<section class="content">

<div class="container-fluid">


<!-- =========================================================
     STATISTIK ATAS
     ========================================================= -->

<div class="row mb-4">


    <!-- TOTAL -->

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="stat-card stat-blue">

            <div class="inner">

                <h3 id="topTotal">
                    <?= $total_tiket ?? 0 ?>
                </h3>

                <p>
                    Total Tiket
                </p>

            </div>

            <div class="stat-icon">
                <i class="fas fa-ticket-alt"></i>
            </div>

        </div>

    </div>


    <!-- TIKET MASUK -->

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="stat-card stat-orange">

            <div class="inner">

                <h3 id="topMasuk">
                    <?= $submitted ?? 0 ?>
                </h3>

                <p>
                    Tiket Masuk
                </p>

            </div>

            <div class="stat-icon">
                <i class="fas fa-envelope"></i>
            </div>

        </div>

    </div>


    <!-- SELESAI -->

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="stat-card stat-yellow">

            <div class="inner">

                <h3 id="topSelesai">
                    <?= $completed ?? 0 ?>
                </h3>

                <p>
                    Tiket Selesai
                </p>

            </div>

            <div class="stat-icon">
                <i class="fas fa-check-circle"></i>
            </div>

        </div>

    </div>


    <!-- REVISI -->

    <div class="col-lg-3 col-md-6 mb-3">

        <div class="stat-card stat-green">

            <div class="inner">

                <h3 id="topRevisi">
                    <?= $revision ?? 0 ?>
                </h3>

                <p>
                    Perlu Revisi
                </p>

            </div>

            <div class="stat-icon">
                <i class="fas fa-edit"></i>
            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     QUICK ACTION
     ========================================================= -->

<div class="quick-card mb-4">

    <div class="section-header">

        <i class="fas fa-bolt mr-1"></i>

        Quick Action

    </div>


    <div class="quick-body">

        <div class="row">

            <div class="col-md-3 mb-2">

                <a
                    href="<?= base_url('datatiket') ?>"
                    class="quick-btn quick-orange"
                >

                    <i class="fas fa-ticket-alt fa-lg"></i>

                    Data Tiket

                </a>

            </div>


            <div class="col-md-3 mb-2">

                <a
                    href="<?= base_url('verification') ?>"
                    class="quick-btn quick-green"
                >

                    <i class="fas fa-user-check fa-lg"></i>

                    Verifikasi

                </a>

            </div>


            <div class="col-md-3 mb-2">

                <a
                    href="<?= base_url('disposisi') ?>"
                    class="quick-btn quick-yellow"
                >

                    <i class="fas fa-share-square fa-lg"></i>

                    Disposisi

                </a>

            </div>


            <div class="col-md-3 mb-2">

                <button
                    type="button"
                    onclick="location.reload()"
                    class="quick-btn quick-dark"
                >

                    <i class="fas fa-sync-alt fa-lg"></i>

                    Refresh

                </button>

            </div>

        </div>

    </div>

</div>


<!-- =========================================================
     STATISTIK & ANALITIK
     ========================================================= -->

<div class="analytics-card mb-4">

    <div class="analytics-header">

        <i class="fas fa-chart-line mr-1"></i>

        Statistik & Analitik Tiket

    </div>


    <div class="analytics-body">


        <!-- FILTER -->

        <div class="period-filter">

            <div class="row align-items-end">

                <div class="col-md-4 mb-2">

                    <label class="period-label">
                        Periode Statistik
                    </label>

                    <select
                        id="periodFilter"
                        class="form-control period-control"
                    >

                        <option value="today">
                            Hari Ini
                        </option>

                        <option value="week">
                            Minggu Ini
                        </option>

                        <option
                            value="month"
                            selected
                        >
                            Bulan Ini
                        </option>

                        <option value="year">
                            Tahun Ini
                        </option>

                        <option value="all">
                            Semua Periode
                        </option>

                        <option value="manual">
                            Tanggal Manual
                        </option>

                    </select>

                </div>


                <div
                    class="col-md-3 mb-2 date-manual"
                    id="manualStart"
                >

                    <label class="period-label">
                        Dari Tanggal
                    </label>

                    <input
                        type="date"
                        id="startDate"
                        class="form-control period-control"
                    >

                </div>


                <div
                    class="col-md-3 mb-2 date-manual"
                    id="manualEnd"
                >

                    <label class="period-label">
                        Sampai Tanggal
                    </label>

                    <input
                        type="date"
                        id="endDate"
                        class="form-control period-control"
                    >

                </div>


                <div class="col-md-2 mb-2">

                    <button
                        type="button"
                        class="apply-btn"
                        onclick="applyAnalyticsFilter()"
                    >

                        <i class="fas fa-filter mr-1"></i>

                        Terapkan

                    </button>

                </div>

            </div>


            <div class="period-info mt-2">

                <i class="fas fa-info-circle mr-1"></i>

                Menampilkan statistik:

                <strong id="periodText">
                    Bulan Ini
                </strong>

            </div>

        </div>


        <!-- RINGKASAN -->

        <div class="row mb-4">


            <div class="col-lg-3 col-md-6 mb-3">

                <div class="analytics-stat clearfix">

                    <div class="analytics-icon icon-total">

                        <i class="fas fa-ticket-alt"></i>

                    </div>

                    <div>

                        <div
                            class="analytics-number"
                            id="analyticsTotal"
                        >
                            0
                        </div>

                        <div class="analytics-label">
                            Total Tiket
                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-3 col-md-6 mb-3">

                <div class="analytics-stat clearfix">

                    <div class="analytics-icon icon-submitted">

                        <i class="fas fa-clock"></i>

                    </div>

                    <div>

                        <div
                            class="analytics-number"
                            id="analyticsSubmitted"
                        >
                            0
                        </div>

                        <div class="analytics-label">
                            Menunggu Verifikasi
                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-3 col-md-6 mb-3">

                <div class="analytics-stat clearfix">

                    <div class="analytics-icon icon-process">

                        <i class="fas fa-spinner"></i>

                    </div>

                    <div>

                        <div
                            class="analytics-number"
                            id="analyticsProcess"
                        >
                            0
                        </div>

                        <div class="analytics-label">
                            Sedang Diproses
                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-3 col-md-6 mb-3">

                <div class="analytics-stat clearfix">

                    <div class="analytics-icon icon-completed">

                        <i class="fas fa-check-double"></i>

                    </div>

                    <div>

                        <div
                            class="analytics-number"
                            id="analyticsCompleted"
                        >
                            0
                        </div>

                        <div class="analytics-label">
                            Tiket Selesai
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- GRAFIK -->

        <div class="row mb-4">


            <div class="col-lg-8 mb-3">

                <div class="chart-card">

                    <div class="chart-title">

                        <i class="fas fa-chart-bar mr-1"></i>

                        Perkembangan Tiket

                    </div>

                    <div class="chart-container">

                        <canvas id="ticketPeriodChart"></canvas>

                    </div>

                </div>

            </div>


            <div class="col-lg-4 mb-3">

                <div class="chart-card">

                    <div class="chart-title">

                        <i class="fas fa-chart-pie mr-1"></i>

                        Distribusi Status

                    </div>

                    <div class="chart-container">

                        <canvas id="ticketStatusChart"></canvas>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


</div>

</section>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>

/* =========================================================
   DATA TIKET
   ========================================================= */

const dashboardTickets =
    <?= json_encode(
        $ticketsJson,
        JSON_UNESCAPED_UNICODE |
        JSON_UNESCAPED_SLASHES
    ) ?>;


/* =========================================================
   CHART
   ========================================================= */

let ticketPeriodChart = null;
let ticketStatusChart = null;


/* =========================================================
   STATUS DATABASE
   ========================================================= */

const statusList = [
    'submitted',
    'verified',
    'assigned',
    'in_progress',
    'completed',
    'need_revision',
    'rejected'
];


/* =========================================================
   NAMA STATUS
   ========================================================= */

const statusLabel = {

    submitted: 'Submitted',

    verified: 'Verified',

    assigned: 'Assigned',

    in_progress: 'In Progress',

    completed: 'Completed',

    need_revision: 'Need Revision',

    rejected: 'Rejected'

};


/* =========================================================
   SAAT HALAMAN SELESAI
   ========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const period =
            document.getElementById(
                'periodFilter'
            );

        period.addEventListener(
            'change',
            function () {

                toggleManualDate();

            }
        );

        toggleManualDate();

        applyAnalyticsFilter();

    }
);


/* =========================================================
   TOGGLE MANUAL DATE
   ========================================================= */

function toggleManualDate()
{
    const period =
        document.getElementById(
            'periodFilter'
        ).value;

    const start =
        document.getElementById(
            'manualStart'
        );

    const end =
        document.getElementById(
            'manualEnd'
        );

    if (period === 'manual') {

        start.classList.add('show');

        end.classList.add('show');

    } else {

        start.classList.remove('show');

        end.classList.remove('show');

    }
}


/* =========================================================
   FORMAT DATE
   ========================================================= */

function formatDate(date)
{
    const year =
        date.getFullYear();

    const month =
        String(
            date.getMonth() + 1
        ).padStart(2, '0');

    const day =
        String(
            date.getDate()
        ).padStart(2, '0');

    return (
        year +
        '-' +
        month +
        '-' +
        day
    );
}


/* =========================================================
   PARSE DATE
   ========================================================= */

function parseTicketDate(dateString)
{
    if (!dateString) {
        return null;
    }

    const date =
        new Date(
            dateString.replace(
                ' ',
                'T'
            )
        );

    if (
        isNaN(
            date.getTime()
        )
    ) {
        return null;
    }

    return date;
}


/* =========================================================
   FILTER TIKET
   ========================================================= */

function getFilteredTickets()
{
    const period =
        document.getElementById(
            'periodFilter'
        ).value;

    const now =
        new Date();

    let startDate = null;
    let endDate = null;


    /* HARI INI */

    if (period === 'today') {

        startDate =
            new Date(
                now.getFullYear(),
                now.getMonth(),
                now.getDate()
            );

        endDate =
            new Date(
                now.getFullYear(),
                now.getMonth(),
                now.getDate(),
                23,
                59,
                59
            );

    }


    /* MINGGU INI */

    else if (period === 'week') {

        const day =
            now.getDay();

        const diff =
            day === 0
                ? -6
                : 1 - day;

        startDate =
            new Date(
                now.getFullYear(),
                now.getMonth(),
                now.getDate() + diff
            );

        endDate =
            new Date(
                startDate.getFullYear(),
                startDate.getMonth(),
                startDate.getDate() + 6,
                23,
                59,
                59
            );

    }


    /* BULAN INI */

    else if (period === 'month') {

        startDate =
            new Date(
                now.getFullYear(),
                now.getMonth(),
                1
            );

        endDate =
            new Date(
                now.getFullYear(),
                now.getMonth() + 1,
                0,
                23,
                59,
                59
            );

    }


    /* TAHUN INI */

    else if (period === 'year') {

        startDate =
            new Date(
                now.getFullYear(),
                0,
                1
            );

        endDate =
            new Date(
                now.getFullYear(),
                11,
                31,
                23,
                59,
                59
            );

    }


    /* MANUAL */

    else if (period === 'manual') {

        const start =
            document.getElementById(
                'startDate'
            ).value;

        const end =
            document.getElementById(
                'endDate'
            ).value;

        if (!start || !end) {

            return [];

        }

        startDate =
            new Date(
                start + 'T00:00:00'
            );

        endDate =
            new Date(
                end + 'T23:59:59'
            );

        if (startDate > endDate) {

            return [];

        }

    }


    /* SEMUA */

    if (period === 'all') {

        return dashboardTickets;

    }


    /* FILTER */

    return dashboardTickets.filter(
        function (ticket) {

            const ticketDate =
                parseTicketDate(
                    ticket.submitted_at
                );

            if (!ticketDate) {

                return false;

            }

            return (
                ticketDate >= startDate &&
                ticketDate <= endDate
            );

        }
    );
}


/* =========================================================
   UPDATE ANALYTICS
   ========================================================= */

function updateAnalytics()
{
    const filteredTickets =
        getFilteredTickets();


    const statusCount = {};

    statusList.forEach(
        function (status) {

            statusCount[status] = 0;

        }
    );


    filteredTickets.forEach(
        function (ticket) {

            const status =
                String(
                    ticket.status || ''
                ).toLowerCase().trim();

            if (
                Object.prototype.hasOwnProperty.call(
                    statusCount,
                    status
                )
            ) {

                statusCount[status]++;

            }

        }
    );


    const total =
        filteredTickets.length;

    const submitted =
        statusCount.submitted || 0;

    const process =
        (statusCount.assigned || 0) +
        (statusCount.in_progress || 0);

    const completed =
        statusCount.completed || 0;

    const revision =
        statusCount.need_revision || 0;


    /* KARTU ATAS */

    document.getElementById(
        'topTotal'
    ).textContent = total;

    document.getElementById(
        'topMasuk'
    ).textContent = submitted;

    document.getElementById(
        'topSelesai'
    ).textContent = completed;

    document.getElementById(
        'topRevisi'
    ).textContent = revision;


    /* KARTU ANALITIK */

    document.getElementById(
        'analyticsTotal'
    ).textContent = total;

    document.getElementById(
        'analyticsSubmitted'
    ).textContent = submitted;

    document.getElementById(
        'analyticsProcess'
    ).textContent = process;

    document.getElementById(
        'analyticsCompleted'
    ).textContent = completed;


    /* TEKS PERIODE */

    updatePeriodText();


    /* CHART */

    updatePeriodChart(
        filteredTickets
    );

    updateStatusChart(
        statusCount
    );
}


/* =========================================================
   TEKS PERIODE
   ========================================================= */

function updatePeriodText()
{
    const period =
        document.getElementById(
            'periodFilter'
        ).value;

    let text = '';


    if (period === 'today') {

        text = 'Hari Ini';

    }

    else if (period === 'week') {

        text = 'Minggu Ini';

    }

    else if (period === 'month') {

        text = 'Bulan Ini';

    }

    else if (period === 'year') {

        text = 'Tahun Ini';

    }

    else if (period === 'all') {

        text = 'Semua Periode';

    }

    else if (period === 'manual') {

        const start =
            document.getElementById(
                'startDate'
            ).value;

        const end =
            document.getElementById(
                'endDate'
            ).value;

        if (start && end) {

            text =
                formatDisplayDate(start) +
                ' s/d ' +
                formatDisplayDate(end);

        } else {

            text = 'Tanggal Manual';

        }

    }


    document.getElementById(
        'periodText'
    ).textContent = text;
}


/* =========================================================
   FORMAT DISPLAY DATE
   ========================================================= */

function formatDisplayDate(
    dateString
)
{
    const date =
        new Date(
            dateString +
            'T00:00:00'
        );

    return date.toLocaleDateString(
        'id-ID',
        {
            day: '2-digit',
            month: 'long',
            year: 'numeric'
        }
    );
}


/* =========================================================
   GRAFIK PERKEMBANGAN
   ========================================================= */

function updatePeriodChart(
    tickets
)
{
    const period =
        document.getElementById(
            'periodFilter'
        ).value;

    let labels = [];
    let values = [];


    /* SEMUA PERIODE */

    if (period === 'all') {

        const grouped = {};

        tickets.forEach(
            function (ticket) {

                const date =
                    parseTicketDate(
                        ticket.submitted_at
                    );

                if (!date) {
                    return;
                }

                const key =
                    date.getFullYear() +
                    '-' +
                    String(
                        date.getMonth() + 1
                    ).padStart(2, '0');

                if (!grouped[key]) {

                    grouped[key] = 0;

                }

                grouped[key]++;

            }
        );


        Object.keys(grouped)
            .sort()
            .forEach(
                function (key) {

                    const parts =
                        key.split('-');

                    const date =
                        new Date(
                            Number(parts[0]),
                            Number(parts[1]) - 1,
                            1
                        );

                    labels.push(
                        date.toLocaleDateString(
                            'id-ID',
                            {
                                month: 'short',
                                year: 'numeric'
                            }
                        )
                    );

                    values.push(
                        grouped[key]
                    );

                }
            );

    }


    /* TAHUN */

    else if (period === 'year') {

        const grouped = {};

        for (
            let month = 0;
            month < 12;
            month++
        ) {

            grouped[month] = 0;

        }


        tickets.forEach(
            function (ticket) {

                const date =
                    parseTicketDate(
                        ticket.submitted_at
                    );

                if (!date) {
                    return;
                }

                grouped[
                    date.getMonth()
                ]++;

            }
        );


        for (
            let month = 0;
            month < 12;
            month++
        ) {

            const date =
                new Date(
                    new Date().getFullYear(),
                    month,
                    1
                );

            labels.push(
                date.toLocaleDateString(
                    'id-ID',
                    {
                        month: 'short'
                    }
                )
            );

            values.push(
                grouped[month]
            );

        }

    }


    /* BULAN */

    else if (period === 'month') {

        const now =
            new Date();

        const days =
            new Date(
                now.getFullYear(),
                now.getMonth() + 1,
                0
            ).getDate();

        const grouped = {};

        for (
            let day = 1;
            day <= days;
            day++
        ) {

            grouped[day] = 0;

        }


        tickets.forEach(
            function (ticket) {

                const date =
                    parseTicketDate(
                        ticket.submitted_at
                    );

                if (!date) {
                    return;
                }

                grouped[
                    date.getDate()
                ]++;

            }
        );


        for (
            let day = 1;
            day <= days;
            day++
        ) {

            labels.push(
                String(day)
            );

            values.push(
                grouped[day]
            );

        }

    }


    /* HARI / MINGGU / MANUAL */

    else {

        const grouped = {};

        tickets.forEach(
            function (ticket) {

                const date =
                    parseTicketDate(
                        ticket.submitted_at
                    );

                if (!date) {
                    return;
                }

                const key =
                    formatDate(date);

                if (!grouped[key]) {

                    grouped[key] = 0;

                }

                grouped[key]++;

            }
        );


        Object.keys(grouped)
            .sort()
            .forEach(
                function (key) {

                    labels.push(
                        formatDisplayDate(key)
                    );

                    values.push(
                        grouped[key]
                    );

                }
            );


        if (labels.length === 0) {

            labels.push(
                'Tidak ada data'
            );

            values.push(0);

        }

    }


    if (ticketPeriodChart) {

        ticketPeriodChart.destroy();

    }


    const canvas =
        document.getElementById(
            'ticketPeriodChart'
        );

    if (!canvas) {
        return;
    }


    ticketPeriodChart =
        new Chart(
            canvas.getContext('2d'),
            {

                type: 'bar',

                data: {

                    labels: labels,

                    datasets: [
                        {
                            label: 'Jumlah Tiket',

                            data: values,

                            backgroundColor:
                                '#202d87',

                            borderRadius: 6,

                            borderWidth: 0
                        }
                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {

                        legend: {
                            display: false
                        }

                    },

                    scales: {

                        y: {

                            beginAtZero: true,

                            ticks: {
                                precision: 0
                            }

                        }

                    }

                }

            }
        );
}


/* =========================================================
   GRAFIK STATUS
   ========================================================= */

function updateStatusChart(
    statusCount
)
{
    const values =
        statusList.map(
            function (status) {

                return (
                    statusCount[status] ||
                    0
                );

            }
        );


    if (ticketStatusChart) {

        ticketStatusChart.destroy();

    }


    const canvas =
        document.getElementById(
            'ticketStatusChart'
        );

    if (!canvas) {
        return;
    }


    ticketStatusChart =
        new Chart(
            canvas.getContext('2d'),
            {

                type: 'doughnut',

                data: {

                    labels: statusList.map(
                        function (status) {

                            return statusLabel[
                                status
                            ];

                        }
                    ),

                    datasets: [
                        {

                            data: values,

                            backgroundColor: [
                                '#ffc107',
                                '#28a745',
                                '#17a2b8',
                                '#007bff',
                                '#128044',
                                '#343a40',
                                '#dc3545'
                            ],

                            borderWidth: 2,

                            borderColor: '#ffffff'

                        }
                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    plugins: {

                        legend: {

                            position: 'bottom',

                            labels: {

                                boxWidth: 12

                            }

                        }

                    }

                }

            }
        );
}


/* =========================================================
   TERAPKAN FILTER
   ========================================================= */

function applyAnalyticsFilter()
{
    const period =
        document.getElementById(
            'periodFilter'
        ).value;


    if (period === 'manual') {

        const start =
            document.getElementById(
                'startDate'
            ).value;

        const end =
            document.getElementById(
                'endDate'
            ).value;


        if (!start || !end) {

            alert(
                'Silakan pilih Dari Tanggal dan Sampai Tanggal terlebih dahulu.'
            );

            return;

        }


        if (start > end) {

            alert(
                'Dari Tanggal tidak boleh lebih besar dari Sampai Tanggal.'
            );

            return;

        }

    }


    updateAnalytics();
}

</script>


<?= $this->endSection() ?>