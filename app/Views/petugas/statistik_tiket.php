<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    body,
    .container-fluid {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif !important;
        background-color: #f8fafc;
        color: #1e293b;
    }

    .card-filter-header {
        border-radius: 20px;
        border: 1px solid rgba(226, 232, 240, 0.9);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(16px);
        box-shadow:
            0 10px 30px -5px rgba(15, 23, 42, 0.05),
            0 8px 10px -6px rgba(15, 23, 42, 0.03);
        transition: all 0.3s ease;
    }

    .card-filter-header:hover {
        box-shadow:
            0 16px 35px -5px rgba(15, 23, 42, 0.08);
    }

    .filter-dropdown-wrapper {
        position: relative;
        display: inline-flex;
        align-items: center;
    }

    .select-ultra {
        appearance: none;
        -webkit-appearance: none;
        background-color: #ffffff;
        border: 1.5px solid #cbd5e1;
        border-radius: 12px;
        padding: 0.6rem 2.5rem 0.6rem 2.6rem;
        font-size: 0.875rem;
        font-weight: 700;
        color: #1e293b;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }

    .select-ultra:hover {
        border-color: #94a3b8;
        background-color: #f8fafc;
        transform: translateY(-1px);
    }

    .select-ultra:focus {
        outline: none;
        border-color: #2563eb;
        background-color: #ffffff;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
    }

    .filter-icon-left {
        position: absolute;
        left: 14px;
        color: #2563eb;
        pointer-events: none;
        font-size: 0.9rem;
        z-index: 2;
    }

    .filter-icon-right {
        position: absolute;
        right: 14px;
        color: #64748b;
        pointer-events: none;
        font-size: 0.8rem;
        transition: all 0.3s ease;
        z-index: 2;
    }

    .select-ultra:focus ~ .filter-icon-right {
        transform: rotate(180deg);
        color: #2563eb;
    }

    #customDateContainer {
        background: #f1f5f9;
        padding: 5px 10px;
        border-radius: 14px;
        border: 1.5px solid #e2e8f0;
        animation: slideInCustom .35s ease;
    }

    @keyframes slideInCustom {
        from {
            opacity: 0;
            transform: translateY(-6px) scale(.97);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .input-date-ultra {
        border: 1.5px solid #cbd5e1;
        border-radius: 10px;
        padding: 0.45rem 0.75rem;
        font-size: 0.83rem;
        font-weight: 600;
        color: #334155;
        background-color: #ffffff;
        outline: none;
        transition: all .2s ease;
    }

    .input-date-ultra:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
    }

    .btn-apply-filter {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border: none;
        color: #ffffff;
        font-weight: 700;
        font-size: .85rem;
        border-radius: 10px;
        padding: .5rem 1.25rem;
        box-shadow: 0 4px 12px rgba(37, 99, 235, .25);
        transition: all .25s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-apply-filter:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, .35);
        color: #ffffff;
    }

    .stat-tamu-card {
        border-radius: 18px;
        border: none;
        color: #ffffff;
        transition: all .35s ease;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .stat-tamu-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -30%;
        width: 180px;
        height: 180px;
        background: rgba(255, 255, 255, .12);
        border-radius: 50%;
        z-index: -1;
        transition: transform .5s ease;
    }

    .stat-tamu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(0, 0, 0, .15) !important;
    }

    .stat-tamu-card:hover::before {
        transform: scale(1.25);
    }

    .bg-tamu-navy {
        background: linear-gradient(135deg, #1a237e 0%, #283593 100%) !important;
    }

    .bg-tamu-orange {
        background: linear-gradient(135deg, #ff8c00 0%, #f57c00 100%) !important;
    }

    .bg-tamu-yellow {
        background: linear-gradient(135deg, #f4c400 0%, #fb8c00 100%) !important;
    }

    .bg-tamu-blue {
        background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%) !important;
    }

    .bg-tamu-green {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
    }

    .bg-tamu-amber {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%) !important;
    }

    .bg-tamu-red {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
    }

    .icon-tamu-circle {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: rgba(255, 255, 255, .22);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
    }

    .card-ultra {
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .04) !important;
        background: #ffffff;
    }

    .progress-track-elite {
        background: #e2e8f0;
        height: 14px;
        border-radius: 8px;
        overflow: hidden;
    }

    .progress-fill-elite {
        background: linear-gradient(90deg, #10b981 0%, #059669 100%);
        height: 100%;
        border-radius: 8px;
        transition: width .8s ease-in-out;
    }

    .chart-wrapper-box {
        position: relative;
        width: 100%;
        height: 320px;
    }

    .timeline-tracking {
        position: relative;
        padding-left: 28px;
    }

    .timeline-tracking::before {
        content: '';
        position: absolute;
        left: 9px;
        top: 8px;
        bottom: 8px;
        width: 2px;
        background: #e2e8f0;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 22px;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-dot {
        position: absolute;
        left: -28px;
        top: 2px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #ffffff;
        border: 4px solid #1a237e;
    }

    .timeline-dot.success {
        border-color: #10b981;
    }

    .timeline-dot.warning {
        border-color: #ff8c00;
    }

    .timeline-dot.info {
        border-color: #0284c7;
    }

    .badge-status-ult {
        font-size: .72rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
    }

    .badge-ult-navy {
        background-color: #eef2ff;
        color: #1a237e;
        border: 1px solid #c7d2fe;
    }

    .badge-ult-green {
        background-color: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .badge-ult-orange {
        background-color: #ffedd5;
        color: #9a3412;
        border: 1px solid #fed7aa;
    }
</style>

<?php
$totalTiket   = (int) ($total_tiket ?? 0);
$submitted    = (int) ($submitted ?? 0);
$assigned     = (int) ($assigned ?? 0);
$inProgress   = (int) ($in_progress ?? 0);
$completed    = (int) ($completed ?? 0);
$needRevision = (int) ($need_revision ?? 0);
$rejected     = (int) ($rejected ?? 0);
$efisiensi    = (float) ($efisiensi ?? 0);

$timeline = $timeline ?? [];
?>

<div class="container-fluid px-4 py-4">

    <!-- HEADER & FILTER -->
    <div class="card card-filter-header p-4 mb-4">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">

            <div>
                <h3 class="fw-bold text-dark mb-1">
                    Statistik & Analitik Tiket
                </h3>

                <p class="text-muted small mb-0">
                    Pantau pergerakan data tiket layanan bantuan ULT secara real-time dan akurat.
                </p>
            </div>

            <div class="d-flex align-items-center gap-3 flex-wrap">

                <div class="filter-dropdown-wrapper">

                    <i class="fas fa-filter filter-icon-left"></i>

                    <select id="filterPeriode" class="select-ultra">

                        <option value="semua">
                            Semua Periode
                        </option>

                        <option value="hari">
                            Hari Ini
                        </option>

                        <option value="minggu">
                            Minggu Ini
                        </option>

                        <option value="bulan" selected>
                            Bulan Ini
                        </option>

                        <option value="tahun">
                            Tahun Ini
                        </option>

                        <option value="custom">
                            Filter Tanggal Manual
                        </option>

                    </select>

                    <i class="fas fa-chevron-down filter-icon-right"></i>

                </div>

                <div
                    id="customDateContainer"
                    class="d-none align-items-center gap-2"
                >

                    <input
                        type="date"
                        id="startDate"
                        class="input-date-ultra"
                        value="<?= date('Y-m-01') ?>"
                    >

                    <span class="text-muted small fw-bold">
                        s/d
                    </span>

                    <input
                        type="date"
                        id="endDate"
                        class="input-date-ultra"
                        value="<?= date('Y-m-d') ?>"
                    >

                    <button
                        type="button"
                        id="btnTerapkanTanggal"
                        class="btn btn-apply-filter"
                    >
                        <i class="fas fa-check"></i>
                        Terapkan
                    </button>

                </div>

            </div>
        </div>
    </div>


    <!-- STATISTIK UTAMA -->
    <div class="row g-3 mb-3">

        <!-- TOTAL -->
        <div class="col-xl-3 col-md-6">

            <div class="card stat-tamu-card bg-tamu-navy p-3 shadow-sm">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:.72rem;">
                            Total Tiket Masuk
                        </span>

                        <h2
                            class="fw-extrabold mb-0 text-white mt-1 counter"
                            id="cnt-total"
                        >
                            <?= $totalTiket ?>
                        </h2>

                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-ticket-alt"></i>
                    </div>

                </div>

            </div>

        </div>


        <!-- SUBMITTED -->
        <div class="col-xl-3 col-md-6">

            <div class="card stat-tamu-card bg-tamu-orange p-3 shadow-sm">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:.72rem;">
                            Menunggu Verifikasi
                        </span>

                        <h2
                            class="fw-extrabold mb-0 text-white mt-1 counter"
                            id="cnt-submitted"
                        >
                            <?= $submitted ?>
                        </h2>

                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-paper-plane"></i>
                    </div>

                </div>

            </div>

        </div>


        <!-- ASSIGNED / VERIFIED -->
        <div class="col-xl-3 col-md-6">

            <div class="card stat-tamu-card bg-tamu-yellow p-3 shadow-sm">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:.72rem;">
                            Terverifikasi
                        </span>

                        <h2
                            class="fw-extrabold mb-0 text-white mt-1 counter"
                            id="cnt-assigned"
                        >
                            <?= $assigned ?>
                        </h2>

                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-clipboard-check"></i>
                    </div>

                </div>

            </div>

        </div>


        <!-- IN PROGRESS -->
        <div class="col-xl-3 col-md-6">

            <div class="card stat-tamu-card bg-tamu-blue p-3 shadow-sm">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:.72rem;">
                            Sedang Diproses
                        </span>

                        <h2
                            class="fw-extrabold mb-0 text-white mt-1 counter"
                            id="cnt-in-progress"
                        >
                            <?= $inProgress ?>
                        </h2>

                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-spinner"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- STATISTIK TAMBAHAN -->
    <div class="row g-3 mb-4">

        <!-- COMPLETED -->
        <div class="col-xl-4 col-md-4">

            <div class="card stat-tamu-card bg-tamu-green p-3 shadow-sm">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:.72rem;">
                            Tiket Selesai
                        </span>

                        <h2
                            class="fw-extrabold mb-0 text-white mt-1 counter"
                            id="cnt-completed"
                        >
                            <?= $completed ?>
                        </h2>

                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-check-circle"></i>
                    </div>

                </div>

            </div>

        </div>


        <!-- REVISION -->
        <div class="col-xl-4 col-md-4">

            <div class="card stat-tamu-card bg-tamu-amber p-3 shadow-sm">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:.72rem;">
                            Perlu Perbaikan
                        </span>

                        <h2
                            class="fw-extrabold mb-0 text-white mt-1 counter"
                            id="cnt-revision"
                        >
                            <?= $needRevision ?>
                        </h2>

                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-edit"></i>
                    </div>

                </div>

            </div>

        </div>


        <!-- REJECTED -->
        <div class="col-xl-4 col-md-4">

            <div class="card stat-tamu-card bg-tamu-red p-3 shadow-sm">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <span class="text-white-50 text-uppercase fw-bold"
                              style="font-size:.72rem;">
                            Tiket Ditolak
                        </span>

                        <h2
                            class="fw-extrabold mb-0 text-white mt-1 counter"
                            id="cnt-rejected"
                        >
                            <?= $rejected ?>
                        </h2>

                    </div>

                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-ban"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- EFISIENSI -->
    <div class="card card-ultra p-4 mb-4">

        <div class="d-flex justify-content-between align-items-center mb-2">

            <span class="fw-bold text-dark" style="font-size:.95rem;">
                Tingkat Efisiensi & Penyelesaian Tiket ULT
            </span>

            <span
                class="fw-bold text-success"
                id="text-efisiensi"
            >
                <?= $efisiensi ?>% Efektif
            </span>

        </div>

        <div class="progress-track-elite mb-2">

            <div
                class="progress-fill-elite"
                id="bar-efisiensi"
                style="width: <?= $efisiensi ?>%;"
            ></div>

        </div>

        <small class="text-muted">

            <i class="fas fa-info-circle text-primary me-1"></i>

            Data dihitung berdasarkan perbandingan tiket selesai
            & diproses terhadap total tiket masuk.

        </small>

    </div>


    <!-- GRAFIK -->
    <div class="row g-4 mb-4">

        <div class="col-lg-8">

            <div class="card card-ultra h-100">

                <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">

                    <h6 class="fw-bold text-dark mb-0">

                        <i class="fas fa-chart-bar text-primary me-2"></i>

                        Distribusi Status Tiket

                    </h6>

                    <small class="text-muted">
                        Grafik Utama
                    </small>

                </div>

                <div class="card-body p-4">

                    <div class="chart-wrapper-box">

                        <canvas id="mainBarChart"></canvas>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-lg-4">

            <div class="card card-ultra h-100">

                <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">

                    <h6 class="fw-bold text-dark mb-0">

                        <i class="fas fa-chart-pie text-primary me-2"></i>

                        Proporsi Status Tiket

                    </h6>

                    <small class="text-muted">
                        Persentase
                    </small>

                </div>

                <div class="card-body p-4">

                    <div class="chart-wrapper-box">

                        <canvas id="mainDoughnutChart"></canvas>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- TIMELINE -->
    <div class="card card-ultra">

        <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">

            <h6 class="fw-bold text-dark mb-0">

                <i class="fas fa-stream text-primary me-2"></i>

                Tracking & Aktivitas Terakhir Dashboard Petugas ULT

            </h6>

            <span class="badge bg-primary text-white rounded-pill px-3 py-1">
                Real-Time Sync
            </span>

        </div>

        <div class="card-body p-4">

            <div
                class="timeline-tracking"
                id="timelineContainer"
            >

                <?php if (!empty($timeline)): ?>

                    <?php foreach ($timeline as $item): ?>

                        <div class="timeline-item">

                            <div class="timeline-dot <?= esc($item['dot_class'] ?? 'info') ?>"></div>

                            <div class="d-flex justify-content-between align-items-start mb-1">

                                <h6 class="fw-bold text-dark mb-0">

                                    <?= esc($item['kode'] ?? '-') ?>

                                    -

                                    <?= esc($item['pemohon'] ?? '-') ?>

                                    (<?= esc($item['layanan'] ?? '-') ?>)

                                </h6>

                                <span class="text-muted small">
                                    <?= esc($item['waktu'] ?? '-') ?>
                                </span>

                            </div>

                            <p class="text-muted small mb-2">
                                <?= esc($item['detail'] ?? '-') ?>
                            </p>

                            <div>

                                <span class="badge-status-ult <?= esc($item['status_class'] ?? 'badge-ult-navy') ?>">

                                    Status:
                                    <?= esc($item['status'] ?? '-') ?>

                                </span>

                                <span class="badge-status-ult badge-ult-navy ms-1">

                                    Disposisi:
                                    <?= esc($item['disposisi'] ?? '-') ?>

                                </span>

                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="text-center py-4">

                        <i class="fas fa-chart-line text-muted mb-2"
                           style="font-size:2rem;"></i>

                        <p class="text-muted mb-0">
                            Belum ada aktivitas tiket pada periode ini.
                        </p>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>


<script>
document.addEventListener("DOMContentLoaded", function () {

    let barChart = null;
    let doughnutChart = null;

    const labelsArray = [
        'Submitted',
        'Assigned',
        'In Progress',
        'Completed',
        'Need Revision',
        'Rejected'
    ];

    const colorPalette = [
        '#ff8c00',
        '#f4c400',
        '#0284c7',
        '#10b981',
        '#d97706',
        '#ef4444'
    ];

    Chart.defaults.font.family =
        "'Plus Jakarta Sans', sans-serif";

    Chart.defaults.color = '#64748b';


    // ========================================================
    // CHART
    // ========================================================

    function initCharts(initialData) {

        const barElement =
            document.getElementById('mainBarChart');

        const doughnutElement =
            document.getElementById('mainDoughnutChart');

        if (!barElement || !doughnutElement) {
            return;
        }

        const barCtx =
            barElement.getContext('2d');

        barChart = new Chart(barCtx, {

            type: 'bar',

            data: {

                labels: labelsArray,

                datasets: [{

                    label: 'Jumlah Tiket',

                    data: initialData,

                    backgroundColor: colorPalette,

                    borderRadius: 8,

                    barPercentage: .55

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                animation: {
                    duration: 800
                },

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
                    },

                    x: {
                        grid: {
                            display: false
                        }
                    }

                }

            }

        });


        const doughnutCtx =
            doughnutElement.getContext('2d');

        doughnutChart = new Chart(
            doughnutCtx,
            {

                type: 'doughnut',

                data: {

                    labels: labelsArray,

                    datasets: [{

                        data: initialData,

                        backgroundColor: colorPalette,

                        borderWidth: 2,

                        borderColor: '#ffffff'

                    }]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    cutout: '70%',

                    plugins: {

                        legend: {
                            position: 'bottom'
                        }

                    }

                }

            }
        );
    }


    // ========================================================
    // COUNTER
    // ========================================================

    function animateCounter(elementId, targetValue) {

        const el =
            document.getElementById(elementId);

        if (!el) {
            return;
        }

        targetValue =
            Number(targetValue) || 0;

        const start =
            parseInt(el.innerText) || 0;

        const duration = 650;

        let startTime = null;

        function step(timestamp) {

            if (!startTime) {
                startTime = timestamp;
            }

            const progress =
                Math.min(
                    (timestamp - startTime) / duration,
                    1
                );

            const easeOut =
                1 - Math.pow(1 - progress, 3);

            el.innerText =
                Math.floor(
                    easeOut *
                    (targetValue - start) +
                    start
                );

            if (progress < 1) {

                window.requestAnimationFrame(step);

            } else {

                el.innerText = targetValue;

            }
        }

        window.requestAnimationFrame(step);
    }


    // ========================================================
    // UPDATE UI
    // ========================================================

    function updateDashboardUI(data) {

        data = data || {};

        animateCounter(
            'cnt-total',
            data.total_tiket ?? 0
        );

        animateCounter(
            'cnt-submitted',
            data.submitted ?? 0
        );

        animateCounter(
            'cnt-assigned',
            data.assigned ?? 0
        );

        animateCounter(
            'cnt-in-progress',
            data.in_progress ?? 0
        );

        animateCounter(
            'cnt-completed',
            data.completed ?? 0
        );

        animateCounter(
            'cnt-revision',
            data.need_revision ?? 0
        );

        animateCounter(
            'cnt-rejected',
            data.rejected ?? 0
        );


        // ====================================================
        // EFISIENSI
        // ====================================================

        const efisiensi =
            Number(data.efisiensi ?? 0);

        const textEfisiensi =
            document.getElementById('text-efisiensi');

        const barEfisiensi =
            document.getElementById('bar-efisiensi');

        if (textEfisiensi) {

            textEfisiensi.innerText =
                `${efisiensi}% Efektif`;

        }

        if (barEfisiensi) {

            barEfisiensi.style.width =
                `${Math.min(Math.max(efisiensi, 0), 100)}%`;

        }


        // ====================================================
        // CHART
        // ====================================================

        const updatedArray = [

            Number(data.submitted ?? 0),

            Number(data.assigned ?? 0),

            Number(data.in_progress ?? 0),

            Number(data.completed ?? 0),

            Number(data.need_revision ?? 0),

            Number(data.rejected ?? 0)

        ];


        if (barChart) {

            barChart.data.datasets[0].data =
                updatedArray;

            barChart.update();

        }


        if (doughnutChart) {

            doughnutChart.data.datasets[0].data =
                updatedArray;

            doughnutChart.update();

        }


        // ====================================================
        // TIMELINE
        // ====================================================

        const timelineContainer =
            document.getElementById('timelineContainer');

        if (
            timelineContainer &&
            Array.isArray(data.timeline)
        ) {

            if (data.timeline.length === 0) {

                timelineContainer.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-chart-line text-muted mb-2"
                           style="font-size:2rem;"></i>
                        <p class="text-muted mb-0">
                            Belum ada aktivitas tiket pada periode ini.
                        </p>
                    </div>
                `;

                return;
            }


            let timelineHtml = '';

            data.timeline.forEach(function (item) {

                timelineHtml += `

                    <div class="timeline-item">

                        <div class="timeline-dot ${item.dot_class || 'info'}"></div>

                        <div class="d-flex justify-content-between align-items-start mb-1">

                            <h6 class="fw-bold text-dark mb-0">

                                ${escapeHtml(item.kode || '-')}

                                -

                                ${escapeHtml(item.pemohon || '-')}

                                (${escapeHtml(item.layanan || '-')})

                            </h6>

                            <span class="text-muted small">

                                ${escapeHtml(item.waktu || '-')}

                            </span>

                        </div>

                        <p class="text-muted small mb-2">

                            ${escapeHtml(item.detail || '-')}

                        </p>

                        <div>

                            <span class="badge-status-ult ${item.status_class || 'badge-ult-navy'}">

                                Status:
                                ${escapeHtml(item.status || '-')}

                            </span>

                            <span class="badge-status-ult badge-ult-navy ms-1">

                                Disposisi:
                                ${escapeHtml(item.disposisi || '-')}

                            </span>

                        </div>

                    </div>

                `;
            });

            timelineContainer.innerHTML =
                timelineHtml;
        }
    }


    // ========================================================
    // ESCAPE HTML
    // ========================================================

    function escapeHtml(value) {

        const div =
            document.createElement('div');

        div.textContent =
            value ?? '';

        return div.innerHTML;
    }


    // ========================================================
    // AJAX FILTER
    // ========================================================

    function fetchFilteredData() {

        const periode =
            document.getElementById('filterPeriode')?.value || 'bulan';

        const startDate =
            document.getElementById('startDate')?.value || '';

        const endDate =
            document.getElementById('endDate')?.value || '';


        const params =
            new URLSearchParams({

                periode: periode,

                start_date: startDate,

                end_date: endDate

            });


        const url =
            `<?= base_url('statistics/api/statistik-data') ?>?${params.toString()}`;


        fetch(url, {

            method: 'GET',

            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }

        })

        .then(function (response) {

            if (!response.ok) {
                throw new Error(
                    'HTTP Error ' + response.status
                );
            }

            return response.json();

        })

        .then(function (response) {

            if (response.status === 'success') {

                updateDashboardUI(
                    response.data
                );

            } else {

                console.error(
                    'Gagal mengambil data statistik:',
                    response
                );

            }

        })

        .catch(function (error) {

            console.error(
                'Error mengambil data statistik:',
                error
            );

        });
    }


    // ========================================================
    // FILTER PERIODE
    // ========================================================

    const filterPeriode =
        document.getElementById('filterPeriode');

    const customDateContainer =
        document.getElementById('customDateContainer');


    if (filterPeriode) {

        filterPeriode.addEventListener(
            'change',
            function () {

                if (this.value === 'custom') {

                    customDateContainer.classList.remove(
                        'd-none'
                    );

                    customDateContainer.classList.add(
                        'd-flex'
                    );

                } else {

                    customDateContainer.classList.remove(
                        'd-flex'
                    );

                    customDateContainer.classList.add(
                        'd-none'
                    );

                    fetchFilteredData();

                }

            }
        );

    }


    // ========================================================
    // BUTTON FILTER MANUAL
    // ========================================================

    const btnTerapkan =
        document.getElementById(
            'btnTerapkanTanggal'
        );


    if (btnTerapkan) {

        btnTerapkan.addEventListener(
            'click',
            function () {

                this.style.transform =
                    'scale(.95)';

                setTimeout(() => {

                    this.style.transform = '';

                }, 150);

                fetchFilteredData();

            }
        );

    }


    // ========================================================
    // INITIAL CHART
    // ========================================================

    initCharts([

        <?= $submitted ?>,

        <?= $assigned ?>,

        <?= $inProgress ?>,

        <?= $completed ?>,

        <?= $needRevision ?>,

        <?= $rejected ?>

    ]);

});
</script>

<?= $this->endSection() ?>