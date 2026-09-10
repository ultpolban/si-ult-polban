<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    .statistics-page {
        padding-bottom: 30px;
    }

    /* =========================================================
       FILTER PERIODE
    ========================================================== */

    .statistics-filter-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 20px;
        background: #fff;
        overflow: hidden;
    }

    .statistics-filter-header {
        background: #293b91;
        color: #fff;
        padding: 12px 18px;
        font-size: 18px;
        font-weight: 600;
    }

    .statistics-filter-body {
        padding: 20px;
    }

    .statistics-filter-body label {
        font-weight: 600;
        color: #343a40;
        margin-bottom: 8px;
    }

    .statistics-filter-body .form-control {
        height: 45px;
        border-radius: 6px;
        border: 1px solid #ced4da;
    }

    .statistics-filter-body .form-control:focus {
        border-color: #293b91;
        box-shadow: 0 0 0 0.15rem rgba(41, 59, 145, 0.15);
    }

    .btn-apply-statistics {
        height: 45px;
        min-width: 150px;
        background: #ff8c00;
        border-color: #ff8c00;
        color: #fff;
        font-weight: 600;
        border-radius: 6px;
    }

    .btn-apply-statistics:hover {
        background: #e67e00;
        border-color: #e67e00;
        color: #fff;
    }

    .manual-date-wrapper {
        display: none;
        margin-top: 15px;
        padding: 15px;
        background: #f8f9fa;
        border: 1px solid #e1e1e1;
        border-radius: 6px;
    }

    .manual-date-wrapper.active {
        display: block;
    }

    .period-info {
        margin-top: 12px;
        padding: 10px 14px;
        background: #f1f3f9;
        border-left: 4px solid #293b91;
        border-radius: 4px;
        color: #495057;
        font-size: 14px;
    }

    /* =========================================================
       SMALL BOX
    ========================================================== */

    .statistics-page .small-box {
        border-radius: 5px;
        min-height: 120px;
        margin-bottom: 20px;
    }

    .statistics-page .small-box h3 {
        font-size: 32px;
        font-weight: 700;
    }

    .statistics-page .small-box p {
        font-size: 16px;
    }

    /* =========================================================
       CARD
    ========================================================== */

    .statistics-page .card {
        border-radius: 8px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    .statistics-page .card-header {
        background: #293b91;
        color: white;
        padding: 12px 18px;
    }

    .statistics-page .card-header .card-title {
        margin: 0;
        font-size: 18px;
        font-weight: 500;
    }

    .statistics-page .card-body {
        background: #fff;
    }

    /* =========================================================
       PROGRESS
    ========================================================== */

    .statistics-page .progress {
        height: 28px;
        border-radius: 4px;
        background: #e9ecef;
    }

    .statistics-page .progress-bar {
        font-size: 14px;
        font-weight: 600;
        line-height: 28px;
    }

    /* =========================================================
       CHART
    ========================================================== */

    .statistics-page canvas {
        width: 100% !important;
        max-height: 480px;
    }
</style>


<div class="statistics-page">

    <!-- =========================================================
         FILTER PERIODE STATISTIK
    ========================================================== -->

    <div class="statistics-filter-card">

        <div class="statistics-filter-header">
            <i class="fas fa-filter mr-1"></i>
            Periode Statistik
        </div>

        <div class="statistics-filter-body">

            <form
                action="<?= site_url('statistics') ?>"
                method="get"
                id="statisticsFilterForm"
            >

                <div class="row align-items-end">

                    <!-- PILIH PERIODE -->
                    <div class="col-md-7 col-lg-5">

                        <label for="periode">
                            Periode
                        </label>

                        <select
                            name="periode"
                            id="periode"
                            class="form-control"
                        >

                            <option
                                value="hari_ini"
                                <?= ($periode ?? '') === 'hari_ini' ? 'selected' : '' ?>
                            >
                                Hari Ini
                            </option>

                            <option
                                value="minggu_ini"
                                <?= ($periode ?? '') === 'minggu_ini' ? 'selected' : '' ?>
                            >
                                Minggu Ini
                            </option>

                            <option
                                value="bulan_ini"
                                <?= ($periode ?? 'bulan_ini') === 'bulan_ini' ? 'selected' : '' ?>
                            >
                                Bulan Ini
                            </option>

                            <option
                                value="tahun_ini"
                                <?= ($periode ?? '') === 'tahun_ini' ? 'selected' : '' ?>
                            >
                                Tahun Ini
                            </option>

                            <option
                                value="semua"
                                <?= ($periode ?? '') === 'semua' ? 'selected' : '' ?>
                            >
                                Semua Periode
                            </option>

                            <option
                                value="manual"
                                <?= ($periode ?? '') === 'manual' ? 'selected' : '' ?>
                            >
                                Tanggal Manual
                            </option>

                        </select>

                    </div>


                    <!-- TOMBOL TERAPKAN -->
                    <div class="col-md-5 col-lg-3 mt-3 mt-md-0">

                        <button
                            type="submit"
                            class="btn btn-apply-statistics btn-block"
                        >
                            <i class="fas fa-filter mr-1"></i>
                            Terapkan
                        </button>

                    </div>

                </div>


                <!-- =================================================
                     TANGGAL MANUAL
                ================================================== -->

                <div
                    id="manualDateWrapper"
                    class="manual-date-wrapper <?= ($periode ?? '') === 'manual' ? 'active' : '' ?>"
                >

                    <div class="row">

                        <!-- TANGGAL MULAI -->
                        <div class="col-md-5">

                            <label for="tanggal_mulai">
                                Tanggal Mulai
                            </label>

                            <input
                                type="date"
                                name="tanggal_mulai"
                                id="tanggal_mulai"
                                class="form-control"
                                value="<?= esc($tanggal_mulai ?? '') ?>"
                            >

                        </div>


                        <!-- TANGGAL SELESAI -->
                        <div class="col-md-5">

                            <label for="tanggal_selesai">
                                Tanggal Selesai
                            </label>

                            <input
                                type="date"
                                name="tanggal_selesai"
                                id="tanggal_selesai"
                                class="form-control"
                                value="<?= esc($tanggal_selesai ?? '') ?>"
                            >

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     INFORMASI PERIODE AKTIF
                ================================================== -->

                <div class="period-info">

                    <i class="fas fa-calendar-alt mr-1"></i>

                    <strong>Periode aktif:</strong>

                    <?php

                    $namaPeriode = [
                        'hari_ini'   => 'Hari Ini',
                        'minggu_ini' => 'Minggu Ini',
                        'bulan_ini'  => 'Bulan Ini',
                        'tahun_ini'  => 'Tahun Ini',
                        'semua'      => 'Semua Periode',
                        'manual'     => 'Tanggal Manual',
                    ];

                    echo esc(
                        $namaPeriode[$periode ?? 'bulan_ini']
                        ?? 'Bulan Ini'
                    );

                    ?>

                    <?php if (
                        !empty($tanggal_mulai) &&
                        !empty($tanggal_selesai)
                    ): ?>

                        <span>
                            (
                            <?= date(
                                'd/m/Y',
                                strtotime($tanggal_mulai)
                            ) ?>

                            s/d

                            <?= date(
                                'd/m/Y',
                                strtotime($tanggal_selesai)
                            ) ?>
                            )
                        </span>

                    <?php endif; ?>

                </div>

            </form>

        </div>

    </div>


    <!-- =========================================================
         BARIS 1
    ========================================================== -->

    <div class="row">

        <!-- TOTAL -->
        <div class="col-lg-3 col-6">

            <div class="small-box bg-primary">

                <div class="inner">

                    <h3>
                        <?= $total ?>
                    </h3>

                    <p>
                        Total Tiket
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>

            </div>

        </div>


        <!-- SUBMITTED -->
        <div class="col-lg-3 col-6">

            <div class="small-box bg-warning">

                <div class="inner">

                    <h3>
                        <?= $submitted ?>
                    </h3>

                    <p>
                        Submitted
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-paper-plane"></i>
                </div>

            </div>

        </div>


        <!-- VERIFIED -->
        <div class="col-lg-3 col-6">

            <div class="small-box bg-info">

                <div class="inner">

                    <h3>
                        <?= $verified ?>
                    </h3>

                    <p>
                        Verified
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-check"></i>
                </div>

            </div>

        </div>


        <!-- ASSIGNED -->
        <div class="col-lg-3 col-6">

            <div class="small-box bg-primary">

                <div class="inner">

                    <h3>
                        <?= $assigned ?>
                    </h3>

                    <p>
                        Assigned
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-share"></i>
                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         BARIS 2
    ========================================================== -->

    <div class="row">

        <!-- IN PROGRESS -->
        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>
                        <?= $progress ?>
                    </h3>

                    <p>
                        In Progress
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-spinner"></i>
                </div>

            </div>

        </div>


        <!-- COMPLETED -->
        <div class="col-lg-3 col-6">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>
                        <?= $completed ?>
                    </h3>

                    <p>
                        Completed
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>

            </div>

        </div>


        <!-- NEED REVISION -->
        <div class="col-lg-3 col-6">

            <div class="small-box bg-secondary">

                <div class="inner">

                    <h3>
                        <?= $revision ?>
                    </h3>

                    <p>
                        Need Revision
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-edit"></i>
                </div>

            </div>

        </div>


        <!-- REJECTED -->
        <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">

                <div class="inner">

                    <h3>
                        <?= $rejected ?>
                    </h3>

                    <p>
                        Rejected
                    </p>

                </div>

                <div class="icon">
                    <i class="fas fa-times-circle"></i>
                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         STATUS LAINNYA
    ========================================================== -->

    <?php if ($other > 0): ?>

        <div class="row">

            <div class="col-lg-3 col-6">

                <div class="small-box bg-dark">

                    <div class="inner">

                        <h3>
                            <?= $other ?>
                        </h3>

                        <p>
                            Status Lainnya
                        </p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-question-circle"></i>

                    </div>

                </div>

            </div>

        </div>

    <?php endif; ?>


    <!-- =========================================================
         PROGRESS PENYELESAIAN
    ========================================================== -->

    <div class="card">

        <div class="card-header">

            <h3 class="card-title">

                <i class="fas fa-tasks mr-1"></i>

                Progress Penyelesaian Tiket

            </h3>

        </div>

        <div class="card-body">

            <div class="progress progress-lg">

                <div
                    class="progress-bar bg-success"
                    role="progressbar"
                    style="width: <?= $progressPercent ?>%;"
                    aria-valuenow="<?= $progressPercent ?>"
                    aria-valuemin="0"
                    aria-valuemax="100"
                >
                    <?= $progressPercent ?>%
                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         GRAFIK
    ========================================================== -->

    <div class="card">

        <div class="card-header">

            <h3 class="card-title">

                <i class="fas fa-chart-bar mr-1"></i>

                Grafik Statistik Tiket

            </h3>

        </div>

        <div class="card-body">

            <canvas
                id="ticketChart"
                height="100">
            </canvas>

        </div>

    </div>

</div>


<!-- =============================================================
     CHART JS
============================================================== -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | FILTER PERIODE
    |--------------------------------------------------------------------------
    */

    const periodeSelect =
        document.getElementById('periode');

    const manualDateWrapper =
        document.getElementById('manualDateWrapper');

    const tanggalMulai =
        document.getElementById('tanggal_mulai');

    const tanggalSelesai =
        document.getElementById('tanggal_selesai');


    function toggleManualDate() {

        if (periodeSelect.value === 'manual') {

            manualDateWrapper.classList.add('active');

            tanggalMulai.setAttribute(
                'required',
                'required'
            );

            tanggalSelesai.setAttribute(
                'required',
                'required'
            );

        } else {

            manualDateWrapper.classList.remove('active');

            tanggalMulai.removeAttribute(
                'required'
            );

            tanggalSelesai.removeAttribute(
                'required'
            );

        }

    }


    periodeSelect.addEventListener(
        'change',
        toggleManualDate
    );


    toggleManualDate();


    /*
    |--------------------------------------------------------------------------
    | VALIDASI TANGGAL MANUAL
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('statisticsFilterForm')
        .addEventListener('submit', function (event) {

            if (periodeSelect.value === 'manual') {

                if (
                    !tanggalMulai.value ||
                    !tanggalSelesai.value
                ) {

                    event.preventDefault();

                    alert(
                        'Silakan pilih tanggal mulai dan tanggal selesai.'
                    );

                    return;
                }


                if (
                    tanggalMulai.value >
                    tanggalSelesai.value
                ) {

                    event.preventDefault();

                    alert(
                        'Tanggal mulai tidak boleh lebih besar dari tanggal selesai.'
                    );

                    return;
                }

            }

        });


    /*
    |--------------------------------------------------------------------------
    | CHART
    |--------------------------------------------------------------------------
    */

    const canvas =
        document.getElementById('ticketChart');

    if (!canvas) {
        return;
    }


    new Chart(canvas, {

        type: 'bar',

        data: {

            labels: [

                'Submitted',
                'Verified',
                'Assigned',
                'In Progress',
                'Completed',
                'Need Revision',
                'Rejected',
                'Lainnya'

            ],

            datasets: [

                {

                    label: 'Jumlah Tiket',

                    data: [

                        <?= (int) $submitted ?>,
                        <?= (int) $verified ?>,
                        <?= (int) $assigned ?>,
                        <?= (int) $progress ?>,
                        <?= (int) $completed ?>,
                        <?= (int) $revision ?>,
                        <?= (int) $rejected ?>,
                        <?= (int) $other ?>

                    ],

                    borderWidth: 1

                }

            ]

        },

        options: {

            responsive: true,

            maintainAspectRatio: true,

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

    });

});

</script>


<?= $this->endSection() ?>