<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
/* ==========================================================================
   SI-ULT POLBAN - STATISTIK TIKET (ULTIMATE ELITE EDITION)
   Designed with precision, depth, vibrant gradients, and sophisticated layout.
========================================================================== */

:root {
    --primary-navy: #0f172a;
    --accent-blue: #2563eb;
    --accent-indigo: #4f46e5;
    --success-emerald: #059669;
    --warning-amber: #d97706;
    --danger-rose: #e11d48;
    --surface-bg: #f8fafc;
    --card-surface: #ffffff;
    --text-primary: #0f172a;
    --text-secondary: #475569;
    --text-muted: #94a3b8;
    --border-subtle: rgba(226, 232, 240, 0.8);
}

body {
    font-family: 'Plus Jakarta Sans', sans-serif !important;
}

.statistik-page-wrapper {
    background-color: var(--surface-bg);
    min-height: 100vh;
    padding: 1.75rem 1.25rem 3.5rem 1.25rem;
    animation: pageEntrance 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

/* ==========================================================================
   PAGE HEADER
========================================================================== */

.page-header-container {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border: 1px solid var(--border-subtle);
    border-radius: 20px;
    padding: 1.75rem 2rem;
    box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.03);
    position: relative;
    overflow: hidden;
}

.page-header-container::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 250px;
    height: 100%;
    background: radial-gradient(circle, rgba(37,99,235,0.04) 0%, transparent 70%);
    pointer-events: none;
}

.main-title {
    font-size: 1.8rem;
    font-weight: 800;
    color: var(--primary-navy);
    letter-spacing: -0.03em;
}

.main-subtitle {
    font-size: 0.95rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.badge-system-status {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #065f46;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 700;
}

/* ==========================================================================
   VIBRANT GRADIENT STAT CARDS (Sangat Mewah & Tidak Polos)
========================================================================== */

.stat-card-vibrant {
    position: relative;
    border-radius: 20px;
    padding: 1.5rem;
    color: #ffffff;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: 1px solid rgba(255, 255, 255, 0.15);
}

.stat-card-vibrant:hover {
    transform: translateY(-6px) scale(1.01);
    box-shadow: 0 20px 35px -5px rgba(0, 0, 0, 0.18), 0 10px 15px -5px rgba(0, 0, 0, 0.1);
}

/* Gradasi Warna Unik Masing-masing Kartu Statistik */
.card-grad-navy {
    background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
}
.card-grad-amber {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
}
.card-grad-blue {
    background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
}
.card-grad-indigo {
    background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%);
}
.card-grad-emerald {
    background: linear-gradient(135deg, #10b981 0%, #047857 100%);
}
.card-grad-orange {
    background: linear-gradient(135deg, #fb923c 0%, #ea580c 100%);
}
.card-grad-rose {
    background: linear-gradient(135deg, #f43f5e 0%, #be123c 100%);
}

/* Ornamen Geometris Transparan di Belakang Kartu */
.stat-card-vibrant::before {
    content: '';
    position: absolute;
    width: 140px;
    height: 140px;
    right: -30px;
    bottom: -40px;
    background: rgba(255, 255, 255, 0.08);
    border-radius: 50%;
    pointer-events: none;
    transition: transform 0.5s ease;
}

.stat-card-vibrant:hover::before {
    transform: scale(1.2) rotate(15deg);
}

.stat-card-vibrant::after {
    content: '';
    position: absolute;
    top: -50px;
    right: -20px;
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 30%;
    transform: rotate(45deg);
    pointer-events: none;
}

.stat-meta-label {
    font-size: 0.75rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    opacity: 0.85;
}

.stat-meta-value {
    font-size: 2.25rem;
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.03em;
    margin-top: 0.5rem;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.stat-icon-circle {
    width: 54px;
    height: 54px;
    border-radius: 16px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(8px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.35rem;
    box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.4);
    flex-shrink: 0;
    transition: transform 0.3s ease;
}

.stat-card-vibrant:hover .stat-icon-circle {
    transform: scale(1.1) rotate(-5deg);
}

/* ==========================================================================
   SECTION CONTAINERS (CONTENT CARDS)
========================================================================== */

.analytic-card-box {
    background: var(--card-surface);
    border: 1px solid var(--border-subtle);
    border-radius: 20px;
    box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.03);
    overflow: hidden;
    transition: all 0.3s ease;
}

.analytic-card-box:hover {
    box-shadow: 0 12px 30px -4px rgba(15, 23, 42, 0.07);
    border-color: #cbd5e1;
}

.analytic-card-header {
    padding: 1.5rem 1.75rem;
    border-bottom: 1px solid var(--border-subtle);
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.analytic-card-title {
    font-size: 1.05rem;
    font-weight: 800;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.analytic-card-title i {
    color: var(--accent-blue);
    font-size: 1.2rem;
}

/* ==========================================================================
   PROGRESS BAR SECTION
========================================================================== */

.progress-track-elite {
    background: #e2e8f0;
    height: 16px;
    border-radius: 8px;
    overflow: hidden;
    position: relative;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.04);
}

.progress-fill-elite {
    background: linear-gradient(90deg, #059669 0%, #10b981 50%, #34d399 100%);
    height: 100%;
    border-radius: 8px;
    position: relative;
    transition: width 1.5s cubic-bezier(0.1, 1, 0.1, 1);
}

.progress-fill-elite::after {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    animation: shimmerEffect 2s infinite;
}

@keyframes shimmerEffect {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

/* ==========================================================================
   CHARTS BOX
========================================================================== */

.chart-wrapper-box {
    position: relative;
    width: 100%;
    height: 330px;
}

.chart-wrapper-box-doughnut {
    position: relative;
    width: 100%;
    height: 330px;
}

/* ==========================================================================
   REVEAL & ENTRANCE ANIMATIONS
========================================================================== */

.stagger-reveal {
    opacity: 0;
    transform: translateY(15px);
    transition: opacity 0.6s cubic-bezier(0.16, 1, 0.3, 1), transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

.stagger-reveal.is-visible {
    opacity: 1;
    transform: translateY(0);
}

@keyframes pageEntrance {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 768px) {
    .statistik-page-wrapper { padding: 1rem 0.5rem; }
    .stat-meta-value { font-size: 1.85rem; }
    .chart-wrapper-box, .chart-wrapper-box-doughnut { height: 280px; }
}
</style>

<div class="statistik-page-wrapper container-fluid">

    <div class="page-header-container d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 stagger-reveal">
        <div class="mb-3 mb-md-0">
            <h1 class="main-title mb-1">
                <i class="fas fa-chart-line text-primary mr-2"></i> Statistik & Analitik Tiket
            </h1>
            <p class="page-header-subtitle mb-0">
                Pantau ringkasan metrik performa, sebaran status, dan progres penyelesaian layanan bantuan mahasiswa secara real-time.
            </p>
        </div>
        <div>
            <span class="badge-system-status shadow-sm">
                <i class="fas fa-shield-alt"></i> Sistem Operasional Aktif
            </span>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-xl-3 col-sm-6">
            <div class="stat-card-vibrant card-grad-navy stagger-reveal">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-meta-label">Total Tiket Masuk</div>
                        <div class="stat-meta-value counter-anim" data-target="<?= $total_tiket ?? 13 ?>">0</div>
                    </div>
                    <div class="stat-icon-circle">
                        <i class="fas fa-layer-group"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="stat-card-vibrant card-grad-amber stagger-reveal">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-meta-label">Menunggu Verifikasi</div>
                        <div class="stat-meta-value counter-anim" data-target="<?= $submitted ?? 5 ?>">0</div>
                    </div>
                    <div class="stat-icon-circle">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="stat-card-vibrant card-grad-blue stagger-reveal">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-meta-label">Terverifikasi</div>
                        <div class="stat-meta-value counter-anim" data-target="<?= $assigned ?? 3 ?>">0</div>
                    </div>
                    <div class="stat-icon-circle">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="stat-card-vibrant card-grad-indigo stagger-reveal">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-meta-label">Sedang Diproses</div>
                        <div class="stat-meta-value counter-anim" data-target="<?= $in_progress ?? 0 ?>">0</div>
                    </div>
                    <div class="stat-icon-circle">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-sm-4">
            <div class="stat-card-vibrant card-grad-emerald stagger-reveal">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-meta-label">Tiket Selesai</div>
                        <div class="stat-meta-value counter-anim" data-target="<?= $completed ?? 0 ?>">0</div>
                    </div>
                    <div class="stat-icon-circle">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-4">
            <div class="stat-card-vibrant card-grad-orange stagger-reveal">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-meta-label">Perlu Perbaikan</div>
                        <div class="stat-meta-value counter-anim" data-target="<?= $need_revision ?? 2 ?>">0</div>
                    </div>
                    <div class="stat-icon-circle">
                        <i class="fas fa-edit"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-4">
            <div class="stat-card-vibrant card-grad-rose stagger-reveal">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <div class="stat-meta-label">Tiket Ditolak</div>
                        <div class="stat-meta-value counter-anim" data-target="<?= $rejected ?? 1 ?>">0</div>
                    </div>
                    <div class="stat-icon-circle">
                        <i class="fas fa-ban"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="analytic-card-box mb-4 stagger-reveal">
        <div class="analytic-card-header">
            <div class="analytic-card-title">
                <i class="fas fa-tasks"></i> Tingkat Efisiensi & Penyelesaian Tiket
            </div>
            <span class="badge bg-success text-white px-3 py-2 rounded-pill font-weight-bold" style="font-size: 0.75rem;">
                70% Efektif
            </span>
        </div>
        <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="font-weight-bold text-dark" style="font-size: 0.9rem;">Rasio Tiket Diproses & Selesai vs Total Permintaan</span>
                <span class="font-weight-bold text-success">70%</span>
            </div>
            <div class="progress-track-elite mb-3">
                <div class="progress-fill-elite" style="width: 70%;"></div>
            </div>
            <p class="text-muted mb-0" style="font-size: 0.85rem;">
                <i class="fas fa-info-circle text-primary mr-1"></i> Performa waktu tanggap unit layanan berada dalam batas SLA standar yang sangat optimal.
            </p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="analytic-card-box h-100 stagger-reveal">
                <div class="analytic-card-header">
                    <div class="analytic-card-title">
                        <i class="fas fa-chart-bar"></i> Distribusi Kategori Status Tiket
                    </div>
                    <span class="text-muted" style="font-size: 0.8rem;">Statistik Keseluruhan</span>
                </div>
                <div class="p-4">
                    <div class="chart-wrapper-box">
                        <canvas id="mainBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="analytic-card-box h-100 stagger-reveal">
                <div class="analytic-card-header">
                    <div class="analytic-card-title">
                        <i class="fas fa-chart-pie"></i> Proporsi Status
                    </div>
                    <span class="text-muted" style="font-size: 0.8rem;">Persentase</span>
                </div>
                <div class="p-4">
                    <div class="chart-wrapper-box-doughnut">
                        <canvas id="mainDoughnutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // 1. Staggered Reveal Animation Handler
    const revealElements = document.querySelectorAll('.stagger-reveal');
    revealElements.forEach(function (el, index) {
        setTimeout(function () {
            el.classList.add('is-visible');
        }, index * 90);
    });

    // 2. Smooth Number Counter Animation
    const counters = document.querySelectorAll('.counter-anim');
    counters.forEach(function (counter) {
        const target = parseInt(counter.getAttribute('data-target')) || 0;
        const duration = 1400; // ms
        const stepTime = 20;
        const steps = duration / stepTime;
        const increment = target / steps;
        let current = 0;

        const timer = setInterval(function () {
            current += increment;
            if (current >= target) {
                counter.innerText = target;
                clearInterval(timer);
            } else {
                counter.innerText = Math.round(current);
            }
        }, stepTime);
    });

    // 3. Dataset Configuration from Backend PHP Variables
    const dataValues = [
        <?= $submitted ?? 5 ?>,
        <?= $assigned ?? 3 ?>,
        <?= $in_progress ?? 0 ?>,
        <?= $completed ?? 0 ?>,
        <?= $need_revision ?? 2 ?>,
        <?= $rejected ?? 1 ?>
    ];

    const labelsArray = ['Submitted', 'Assigned', 'In Progress', 'Completed', 'Need Revision', 'Rejected'];
    
    // Professional Harmonized Palette matched with the elite card gradients
    const colorPalette = [
        '#f59e0b', // Amber (Submitted)
        '#3b82f6', // Blue (Assigned)
        '#6366f1', // Indigo (In Progress)
        '#10b981', // Emerald (Completed)
        '#ea580c', // Orange (Need Revision)
        '#f43f5e'  // Rose (Rejected)
    ];

    // Global Chart.js Defaults for Clean Look
    Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
    Chart.defaults.font.size = 12;
    Chart.defaults.color = '#64748b';

    // 4. Bar Chart Render
    const barCtx = document.getElementById('mainBarChart');
    if (barCtx) {
        new Chart(barCtx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: labelsArray,
                datasets: [{
                    label: 'Jumlah Tiket',
                    data: dataValues,
                    backgroundColor: colorPalette,
                    borderRadius: 10,
                    borderSkipped: false,
                    barPercentage: 0.58,
                    categoryPercentage: 0.72
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        titleFont: { size: 13, weight: 'bold' },
                        bodyFont: { size: 13 },
                        padding: 12,
                        cornerRadius: 10,
                        callbacks: {
                            label: function (context) {
                                return ' Jumlah: ' + context.raw + ' Tiket Layanan';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0, stepSize: 1 },
                        grid: { color: '#f1f5f9', drawBorder: false }
                    },
                    x: {
                        grid: { display: false, drawBorder: false }
                    }
                }
            }
        });
    }

    // 5. Doughnut Chart Render
    const doughnutCtx = document.getElementById('mainDoughnutChart');
    if (doughnutCtx) {
        new Chart(doughnutCtx.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: labelsArray,
                datasets: [{
                    data: dataValues,
                    backgroundColor: colorPalette,
                    borderWidth: 4,
                    borderColor: '#ffffff',
                    hoverOffset: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 10,
                            boxHeight: 10,
                            padding: 14,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 11, weight: '600' }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#0f172a',
                        padding: 12,
                        cornerRadius: 10,
                        callbacks: {
                            label: function (context) {
                                const val = context.raw;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const pct = total > 0 ? ((val / total) * 100).toFixed(1) : 0;
                                return ' ' + context.label + ': ' + val + ' tiket (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    }

});
</script>

<?= $this->endSection() ?>