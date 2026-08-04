<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<style>

/* =========================================================
   SI-ULT POLBAN - STATISTIK TIKET
   Mengikuti tampilan DATA TIKET
========================================================= */

:root {
    --polban-navy: #1a237e;
    --polban-blue: #005bac;
    --polban-orange: #ff8c00;
    --polban-yellow: #f4c400;
    --polban-green: #198754;
    --soft-bg: #f4f6f9;
    --text-dark: #263238;
    --text-muted: #6c757d;
}


/* =========================
   PAGE
========================= */

.statistik-page {
    animation: pageFadeIn 0.45s ease;
}


/* =========================
   HEADER
========================= */

.statistik-title {
    color: var(--polban-navy);
    font-weight: 800;
    letter-spacing: -0.4px;
}

.statistik-subtitle {
    color: #718096;
    font-size: 0.95rem;
}

.statistik-breadcrumb {
    font-size: 0.9rem;
}

.statistik-breadcrumb a {
    color: var(--polban-blue);
    text-decoration: none;
    font-weight: 600;
}


/* =========================
   STATISTIC CARDS
========================= */

.statistik-stat-card {
    position: relative;
    overflow: hidden;
    border: 0;
    border-radius: 14px;
    min-height: 120px;
    color: white;

    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease;
}

.statistik-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.14) !important;
}


/* Lingkaran dekorasi kanan bawah */

.statistik-stat-card::after {
    content: "";
    position: absolute;

    width: 100px;
    height: 100px;

    right: -25px;
    bottom: -35px;

    border-radius: 50%;

    background: rgba(255,255,255,0.08);
}


/* =========================
   WARNA SAMA DENGAN DATA TIKET
========================= */

.statistik-blue {
    background: linear-gradient(
        135deg,
        #005bac,
        #006fc9
    );
}

.statistik-orange {
    background: linear-gradient(
        135deg,
        #ff8c00,
        #ff9f1c
    );
}

.statistik-yellow {
    background: linear-gradient(
        135deg,
        #f4c400,
        #f8d323
    );

    color: #212529;
}

.statistik-green {
    background: linear-gradient(
        135deg,
        #198754,
        #159957
    );
}


/* =========================
   ICON
========================= */

.statistik-icon {
    width: 52px;
    height: 52px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    background: rgba(255,255,255,0.22);

    font-size: 1.25rem;
}


/* =========================
   NUMBER
========================= */

.statistik-number {
    font-size: 1.8rem;
    font-weight: 800;
    line-height: 1;
}


/* =========================
   LABEL
========================= */

.statistik-label {
    font-size: 0.74rem;
    text-transform: uppercase;
    font-weight: 700;
    opacity: 0.85;
}


/* =========================
   SECTION CARD
========================= */

.statistik-section-card {
    border: 0;
    border-radius: 14px;
    background: #ffffff;

    box-shadow: 0 4px 18px rgba(0,0,0,0.07);

    overflow: hidden;
}


/* =========================
   SECTION HEADER
   dibuat putih seperti Data Tiket
========================= */

.statistik-section-header {
    background: #ffffff;

    padding: 18px 20px;

    border-bottom: 1px solid #edf0f4;
}

.statistik-section-title {
    color: var(--text-dark);

    font-size: 1.05rem;

    font-weight: 800;
}

.statistik-section-title i {
    color: var(--polban-blue);
}


/* =========================
   PROGRESS
========================= */

.statistik-progress {
    height: 24px;

    border-radius: 12px;

    background-color: #e9ecef;

    overflow: hidden;
}

.statistik-progress-bar {
    background: linear-gradient(
        135deg,
        #198754,
        #159957
    );

    border-radius: 12px;

    font-size: 0.85rem;

    font-weight: 700;
}


/* =========================
   CHART
========================= */

.statistik-chart-container {
    position: relative;

    width: 100%;

    height: 320px;
}

.statistik-chart-container-pie {
    position: relative;

    width: 100%;

    height: 320px;
}


/* =========================
   INFO BADGE
========================= */

.statistik-badge {
    display: inline-flex;

    align-items: center;

    padding: 6px 10px;

    border-radius: 6px;

    background: #f5f7fa;

    border: 1px solid #dee2e6;

    color: #344054;

    font-size: 0.76rem;

    font-weight: 700;
}


/* =========================
   ANIMATION
========================= */

.reveal-item {
    opacity: 0;

    transform: translateY(12px);
}

.reveal-item.show {
    opacity: 1;

    transform: translateY(0);

    transition:
        all 0.4s ease;
}


@keyframes pageFadeIn {

    from {
        opacity: 0;
        transform: translateY(8px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }

}


/* =========================
   RESPONSIVE
========================= */

@media (max-width: 767px) {

    .statistik-page {
        padding-left: 8px;
        padding-right: 8px;
    }

    .statistik-title {
        font-size: 1.45rem;
    }

    .statistik-breadcrumb {
        display: none;
    }

    .statistik-number {
        font-size: 1.5rem;
    }

    .statistik-chart-container,
    .statistik-chart-container-pie {
        height: 280px;
    }

}

</style>


<div class="container-fluid px-4 py-4 statistik-page">


    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h1
                class="statistik-title mb-1"
                style="font-size: 1.75rem;"
            >
                Statistik Tiket
            </h1>

            <p class="statistik-subtitle mb-0">
                Pantau ringkasan dan statistik keseluruhan tiket layanan mahasiswa.
            </p>

        </div>


        <nav
            aria-label="breadcrumb"
            class="statistik-breadcrumb"
        >

            <ol class="breadcrumb bg-transparent p-0 m-0">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('petugas/dashboard') ?>">
                        Dashboard
                    </a>

                </li>

                <li class="breadcrumb-item active text-muted">

                    Statistik Tiket

                </li>

            </ol>

        </nav>

    </div>



    <!-- =====================================================
         STATISTIC CARDS
    ====================================================== -->

    <div class="row g-3 mb-4">


        <!-- TOTAL -->

        <div class="col-xl-3 col-md-6">

            <div class="card statistik-stat-card statistik-blue shadow-sm reveal-item">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="statistik-label">

                                Total Tiket

                            </div>

                            <div
                                class="statistik-number mt-2 counter-statistik"
                                data-target="<?= $total_tiket ?? 13 ?>"
                            >

                                0

                            </div>

                        </div>


                        <div class="statistik-icon">

                            <i class="fas fa-ticket-alt"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- SUBMITTED -->

        <div class="col-xl-3 col-md-6">

            <div class="card statistik-stat-card statistik-orange shadow-sm reveal-item">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="statistik-label">

                                Menunggu Verifikasi

                            </div>

                            <div
                                class="statistik-number mt-2 counter-statistik"
                                data-target="<?= $submitted ?? 5 ?>"
                            >

                                0

                            </div>

                        </div>


                        <div class="statistik-icon">

                            <i class="fas fa-clock"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- VERIFIED / ASSIGNED -->

        <div class="col-xl-3 col-md-6">

            <div class="card statistik-stat-card statistik-green shadow-sm reveal-item">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="statistik-label">

                                Terverifikasi

                            </div>

                            <div
                                class="statistik-number mt-2 counter-statistik"
                                data-target="<?= $assigned ?? 3 ?>"
                            >

                                0

                            </div>

                        </div>


                        <div class="statistik-icon">

                            <i class="fas fa-user-check"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- IN PROGRESS -->

        <div class="col-xl-3 col-md-6">

            <div class="card statistik-stat-card statistik-yellow shadow-sm reveal-item">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="statistik-label">

                                Sedang Diproses

                            </div>

                            <div
                                class="statistik-number mt-2 counter-statistik"
                                data-target="<?= $in_progress ?? 0 ?>"
                            >

                                0

                            </div>

                        </div>


                        <div class="statistik-icon">

                            <i class="fas fa-cogs"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- =====================================================
         SECOND ROW STATISTICS
    ====================================================== -->

    <div class="row g-3 mb-4">


        <!-- COMPLETED -->

        <div class="col-xl-4 col-md-4">

            <div class="card statistik-stat-card statistik-green shadow-sm reveal-item">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="statistik-label">

                                Selesai

                            </div>

                            <div
                                class="statistik-number mt-2 counter-statistik"
                                data-target="<?= $completed ?? 0 ?>"
                            >

                                0

                            </div>

                        </div>


                        <div class="statistik-icon">

                            <i class="fas fa-check-circle"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- REVISION -->

        <div class="col-xl-4 col-md-4">

            <div class="card statistik-stat-card statistik-orange shadow-sm reveal-item">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="statistik-label">

                                Perlu Perbaikan

                            </div>

                            <div
                                class="statistik-number mt-2 counter-statistik"
                                data-target="<?= $need_revision ?? 2 ?>"
                            >

                                0

                            </div>

                        </div>


                        <div class="statistik-icon">

                            <i class="fas fa-edit"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>



        <!-- REJECTED -->

        <div class="col-xl-4 col-md-4">

            <div class="card statistik-stat-card statistik-yellow shadow-sm reveal-item">

                <div class="card-body p-3">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="statistik-label">

                                Ditolak

                            </div>

                            <div
                                class="statistik-number mt-2 counter-statistik"
                                data-target="<?= $rejected ?? 1 ?>"
                            >

                                0

                            </div>

                        </div>


                        <div class="statistik-icon">

                            <i class="fas fa-times-circle"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- =====================================================
         PROGRESS
    ====================================================== -->

    <div class="card statistik-section-card mb-4 reveal-item">


        <div class="statistik-section-header d-flex justify-content-between align-items-center">

            <div>

                <div class="statistik-section-title">

                    <i class="fas fa-tasks mr-2"></i>

                    Progress Penyelesaian Tiket

                </div>

                <small class="text-muted">

                    Ringkasan perkembangan proses tiket layanan mahasiswa.

                </small>

            </div>


            <span class="statistik-badge">

                <i class="fas fa-chart-line mr-1"></i>

                Statistik

            </span>

        </div>


        <div class="card-body p-4">


            <div class="d-flex justify-content-between align-items-center mb-2">

                <span class="font-weight-bold text-dark">

                    Tingkat Tiket Diproses & Selesai

                </span>


                <span class="font-weight-bold text-success">

                    70%

                </span>

            </div>


            <div class="progress statistik-progress shadow-sm mb-2">

                <div
                    class="progress-bar statistik-progress-bar"
                    role="progressbar"
                    style="width: 70%;"
                    aria-valuenow="70"
                    aria-valuemin="0"
                    aria-valuemax="100"
                >

                    Verified (70%)

                </div>

            </div>


            <small class="text-muted d-block mt-2">

                <i class="fas fa-info-circle mr-1 text-primary"></i>

                Mayoritas tiket permohonan telah diproses dan diverifikasi oleh petugas unit layanan.

            </small>

        </div>

    </div>



    <!-- =====================================================
         CHARTS
    ====================================================== -->

    <div class="row g-4 mb-4">


        <!-- BAR CHART -->

        <div class="col-lg-8">

            <div class="card statistik-section-card h-100 reveal-item">


                <div class="statistik-section-header">

                    <div class="statistik-section-title">

                        <i class="fas fa-chart-bar mr-2"></i>

                        Grafik Distribusi Status Tiket

                    </div>

                    <small class="text-muted">

                        Jumlah tiket berdasarkan status proses.

                    </small>

                </div>


                <div class="card-body p-4">

                    <div class="statistik-chart-container">

                        <canvas id="chartStatistikTiket"></canvas>

                    </div>

                </div>

            </div>

        </div>



        <!-- DONUT -->

        <div class="col-lg-4">

            <div class="card statistik-section-card h-100 reveal-item">


                <div class="statistik-section-header">

                    <div class="statistik-section-title">

                        <i class="fas fa-chart-pie mr-2"></i>

                        Persentase Status Tiket

                    </div>

                    <small class="text-muted">

                        Perbandingan status tiket.

                    </small>

                </div>


                <div class="card-body p-4">

                    <div class="statistik-chart-container-pie">

                        <canvas id="chartPiePersentase"></canvas>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>



<script>

document.addEventListener("DOMContentLoaded", function () {


    /* =====================================================
       REVEAL ANIMATION
    ====================================================== */

    const revealItems =
        document.querySelectorAll('.reveal-item');


    revealItems.forEach(function (item, index) {

        setTimeout(function () {

            item.classList.add('show');

        }, index * 80);

    });



    /* =====================================================
       COUNTER ANIMATION
    ====================================================== */

    const counters =
        document.querySelectorAll('.counter-statistik');


    counters.forEach(function (counter) {

        const target =
            parseInt(counter.getAttribute('data-target')) || 0;

        const duration = 1000;

        const stepTime = 20;

        const steps =
            duration / stepTime;

        const increment =
            target / steps;

        let current = 0;


        const timer =
            setInterval(function () {

                current += increment;


                if (current >= target) {

                    counter.innerText = target;

                    clearInterval(timer);

                } else {

                    counter.innerText =
                        Math.ceil(current);

                }

            }, stepTime);

    });



    /* =====================================================
       DATA CHART
    ====================================================== */

    const dataStatus = [

        <?= $submitted ?? 5 ?>,

        <?= $assigned ?? 3 ?>,

        <?= $in_progress ?? 0 ?>,

        <?= $completed ?? 0 ?>,

        <?= $need_revision ?? 2 ?>,

        <?= $rejected ?? 1 ?>

    ];



    /* =====================================================
       BAR CHART
    ====================================================== */

    const barCanvas =
        document.getElementById('chartStatistikTiket');


    if (barCanvas) {

        new Chart(
            barCanvas.getContext('2d'),
            {

                type: 'bar',


                data: {

                    labels: [

                        'Submitted',

                        'Assigned',

                        'In Progress',

                        'Completed',

                        'Need Revision',

                        'Rejected'

                    ],


                    datasets: [

                        {

                            label: 'Jumlah Tiket',

                            data: dataStatus,


                            backgroundColor: [

                                '#ff8c00',

                                '#f4c400',

                                '#198754',

                                '#198754',

                                '#ff8c00',

                                '#f4c400'

                            ],


                            borderColor: [

                                '#ff8c00',

                                '#f4c400',

                                '#198754',

                                '#198754',

                                '#ff8c00',

                                '#f4c400'

                            ],


                            borderWidth: 1,

                            borderRadius: 7,

                            borderSkipped: false

                        }

                    ]

                },


                options: {

                    responsive: true,

                    maintainAspectRatio: false,


                    plugins: {

                        legend: {

                            display: false

                        },


                        tooltip: {

                            callbacks: {

                                label: function (context) {

                                    return (
                                        ' Jumlah Tiket: '
                                        + context.raw
                                    );

                                }

                            }

                        }

                    },


                    scales: {

                        y: {

                            beginAtZero: true,

                            ticks: {

                                precision: 0,

                                stepSize: 1

                            },

                            grid: {

                                color: '#edf0f4'

                            }

                        },


                        x: {

                            grid: {

                                display: false

                            }

                        }

                    }

                }

            }

        );

    }



    /* =====================================================
       DONUT CHART
    ====================================================== */

    const pieCanvas =
        document.getElementById('chartPiePersentase');


    if (pieCanvas) {

        new Chart(
            pieCanvas.getContext('2d'),
            {

                type: 'doughnut',


                data: {

                    labels: [

                        'Submitted',

                        'Assigned',

                        'In Progress',

                        'Completed',

                        'Need Revision',

                        'Rejected'

                    ],


                    datasets: [

                        {

                            data: dataStatus,


                            backgroundColor: [

                                '#ff8c00',

                                '#f4c400',

                                '#198754',

                                '#198754',

                                '#ff8c00',

                                '#f4c400'

                            ],


                            borderColor: '#ffffff',

                            borderWidth: 3,

                            hoverOffset: 6

                        }

                    ]

                },


                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    cutout: '60%',


                    plugins: {

                        legend: {

                            position: 'bottom',


                            labels: {

                                boxWidth: 12,

                                boxHeight: 12,

                                padding: 14,

                                usePointStyle: true,

                                pointStyle: 'circle'

                            }

                        },


                        tooltip: {

                            callbacks: {

                                label: function (context) {


                                    const value =
                                        context.raw;


                                    const total =
                                        context.dataset.data.reduce(
                                            function (
                                                sum,
                                                item
                                            ) {

                                                return sum + item;

                                            },
                                            0
                                        );


                                    const percentage =
                                        total > 0
                                            ? (
                                                value /
                                                total *
                                                100
                                            ).toFixed(1)
                                            : 0;


                                    return (
                                        ' '
                                        + context.label
                                        + ': '
                                        + value
                                        + ' tiket ('
                                        + percentage
                                        + '%)'
                                    );

                                }

                            }

                        }

                    }

                }

            }

        );

    }

});

</script>


<?= $this->endSection() ?>