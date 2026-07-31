<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<script src="https://cdn.jsdelivr.net/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<style>
    /* Card Stat Styling */
    .stat-card-modern {
        border-radius: 12px;
        border: none;
        color: #ffffff;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        position: relative;
        overflow: hidden;
    }
    .stat-card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 22px rgba(0, 0, 0, 0.18) !important;
    }
    
    /* Warna Solid Kartu Sesuai Referensi SI-ULT POLBAN */
    .bg-stat-navy { background-color: #1a237e !important; color: #ffffff !important; }
    .bg-stat-orange { background-color: #ff8c00 !important; color: #ffffff !important; }
    .bg-stat-yellow { background-color: #ffc107 !important; color: #212529 !important; }
    .bg-stat-green { background-color: #198754 !important; color: #ffffff !important; }
    .bg-stat-gray { background-color: #6c757d !important; color: #ffffff !important; }
    .bg-stat-red { background-color: #dc3545 !important; color: #ffffff !important; }

    /* Circle Container Ikon */
    .stat-icon-wrapper {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.22);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
    }
    .stat-icon-wrapper-dark {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
    }

    /* Container Header Card */
    .section-card {
        border-radius: 12px;
        border: none;
        background: #ffffff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
    .section-header-navy {
        background-color: #1a237e !important;
        color: #ffffff;
        border-top-left-radius: 12px !important;
        border-top-right-radius: 12px !important;
        padding: 14px 20px;
    }

    .counter-value {
        font-size: 2.1rem;
        font-weight: 700;
        line-height: 1.1;
    }

    .progress-custom {
        height: 24px;
        border-radius: 12px;
        background-color: #e9ecef;
        overflow: hidden;
    }
    .progress-bar-animated-custom {
        background-image: linear-gradient(
            45deg,
            rgba(255, 255, 255, 0.15) 25%,
            transparent 25%,
            transparent 50%,
            rgba(255, 255, 255, 0.15) 50%,
            rgba(255, 255, 255, 0.15) 75%,
            transparent 75%,
            transparent
        );
        background-size: 1rem 1rem;
        animation: progress-bar-stripes 1s linear infinite;
    }

    /* Menjaga area grafik agar memiliki ukuran fisik pasti di DOM */
    .chart-container-box {
        position: relative;
        width: 100%;
        min-height: 320px;
    }
</style>

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold mb-1" style="color: #1a237e; font-size: 1.75rem;">Statistik Tiket</h2>
            <p class="text-muted mb-0" style="font-size: 0.95rem;">Pantau ringkasan dan statistik keseluruhan tiket layanan mahasiswa.</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="<?= base_url('petugas') ?>" class="text-primary text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Statistik Tiket</li>
            </ol>
        </nav>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-xl-3 col-md-6 col-sm-6">
            <div class="card stat-card-modern bg-stat-navy shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="counter-value text-white d-block mb-1" data-target="<?= $total_tiket ?? 13 ?>">0</span>
                        <small class="text-white-50 text-uppercase font-weight-bold" style="font-size: 0.78rem;">Total Tiket</small>
                    </div>
                    <div class="stat-icon-wrapper text-white">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 col-sm-6">
            <div class="card stat-card-modern bg-stat-orange shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="counter-value text-white d-block mb-1" data-target="<?= $submitted ?? 5 ?>">0</span>
                        <small class="text-white-50 text-uppercase font-weight-bold" style="font-size: 0.78rem;">Submitted</small>
                    </div>
                    <div class="stat-icon-wrapper text-white">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 col-sm-6">
            <div class="card stat-card-modern bg-stat-gray shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="counter-value text-white d-block mb-1" data-target="<?= $assigned ?? 3 ?>">0</span>
                        <small class="text-white-50 text-uppercase font-weight-bold" style="font-size: 0.78rem;">Assigned</small>
                    </div>
                    <div class="stat-icon-wrapper text-white">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 col-sm-6">
            <div class="card stat-card-modern bg-stat-green shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="counter-value text-white d-block mb-1" data-target="<?= $in_progress ?? 0 ?>">0</span>
                        <small class="text-white-50 text-uppercase font-weight-bold" style="font-size: 0.78rem;">In Progress</small>
                    </div>
                    <div class="stat-icon-wrapper text-white">
                        <i class="fas fa-sync fa-spin"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="card stat-card-modern bg-stat-green shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="counter-value text-white d-block mb-1" data-target="<?= $completed ?? 0 ?>">0</span>
                        <small class="text-white-50 text-uppercase font-weight-bold" style="font-size: 0.78rem;">Completed</small>
                    </div>
                    <div class="stat-icon-wrapper text-white">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="card stat-card-modern bg-stat-gray shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="counter-value text-white d-block mb-1" data-target="<?= $need_revision ?? 2 ?>">0</span>
                        <small class="text-white-50 text-uppercase font-weight-bold" style="font-size: 0.78rem;">Need Revision</small>
                    </div>
                    <div class="stat-icon-wrapper text-white">
                        <i class="fas fa-edit"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="card stat-card-modern bg-stat-red shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="counter-value text-white d-block mb-1" data-target="<?= $rejected ?? 1 ?>">0</span>
                        <small class="text-white-50 text-uppercase font-weight-bold" style="font-size: 0.78rem;">Rejected</small>
                    </div>
                    <div class="stat-icon-wrapper text-white">
                        <i class="fas fa-times-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card section-card mb-4">
        <div class="section-header-navy d-flex align-items-center justify-content-between">
            <h5 class="mb-0 font-weight-bold" style="font-size: 1.05rem;">
                <i class="fas fa-tasks me-2"></i>Progress Penyelesaian Tiket
            </h5>
            <span class="badge bg-light text-dark px-3 py-1 font-weight-bold" style="border-radius: 6px;">Tahap Verifikasi</span>
        </div>
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="font-weight-bold text-dark" style="font-size: 0.95rem;">Tingkat Tiket Diproses & Selesai</span>
                <span class="font-weight-bold text-success fs-5">70%</span>
            </div>
            
            <div class="progress progress-custom shadow-sm mb-2">
                <div class="progress-bar bg-success progress-bar-animated-custom font-weight-bold text-white" 
                     role="progressbar" 
                     style="width: 70%; font-size: 0.85rem;" 
                     aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                     Verified (70%)
                </div>
            </div>
            <small class="text-muted d-block mt-2">
                <i class="fas fa-info-circle me-1 text-primary"></i>
                Laporan memperlihatkan mayoritas tiket permohonan telah dikirim dan diverifikasi oleh petugas unit layanan.
            </small>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card section-card h-100">
                <div class="section-header-navy">
                    <h5 class="mb-0 font-weight-bold" style="font-size: 1.05rem;">
                        <i class="fas fa-chart-bar me-2"></i>Grafik Distribusi Status Tiket
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="chart-container-box">
                        <canvas id="chartStatistikTiket"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card section-card h-100">
                <div class="section-header-navy">
                    <h5 class="mb-0 font-weight-bold" style="font-size: 1.05rem;">
                        <i class="fas fa-chart-pie me-2"></i>Persentase Status Tiket
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="chart-container-box">
                        <canvas id="chartPiePersentase"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    function renderCharts() {
        // 1. Animasi Angka Counter
        const counters = document.querySelectorAll('.counter-value');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const duration = 1000;
            const stepTime = 20;
            const steps = duration / stepTime;
            const increment = target / steps;
            let current = 0;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    counter.innerText = target;
                    clearInterval(timer);
                } else {
                    counter.innerText = Math.ceil(current);
                }
            }, stepTime);
        });

        // Data statistik dari backend / fallback nilai visual
        const dataStatus = [
            <?= $submitted ?? 5 ?>, 
            <?= $assigned ?? 3 ?>, 
            <?= $in_progress ?? 0 ?>, 
            <?= $completed ?? 0 ?>, 
            <?= $need_revision ?? 2 ?>, 
            <?= $rejected ?? 1 ?>
        ];

        // 2. Render Bar Chart
        const elBar = document.getElementById('chartStatistikTiket');
        if (elBar) {
            new Chart(elBar.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: ['Submitted', 'Assigned', 'In Progress', 'Completed', 'Need Revision', 'Rejected'],
                    datasets: [{
                        label: 'Jumlah Tiket',
                        data: dataStatus,
                        backgroundColor: [
                            '#ffc107', // Yellow/Orange Submitted
                            '#6c757d', // Gray Assigned
                            '#198754', // Green In Progress
                            '#198754', // Green Completed
                            '#6c757d', // Gray Need Revision
                            '#dc3545'  // Red Rejected
                        ],
                        borderRadius: 6,
                        borderSkipped: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        }

        // 3. Render Donut Chart
        const elPie = document.getElementById('chartPiePersentase');
        if (elPie) {
            new Chart(elPie.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['Submitted', 'Assigned', 'In Progress', 'Completed', 'Need Revision', 'Rejected'],
                    datasets: [{
                        data: dataStatus,
                        backgroundColor: [
                            '#ffc107',
                            '#6c757d',
                            '#198754',
                            '#20c997',
                            '#a0a6ab',
                            '#dc3545'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: 12
                            }
                        }
                    }
                }
            });
        }
    }

    // Eksekusi fungsi saat DOM selesai dirender
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', renderCharts);
    } else {
        renderCharts();
    }
</script>

<?= $this->endSection() ?>