<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php

/**
 * =====================================================================
 *  CATATAN PENGEMBANGAN (tidak ikut tampil di halaman)
 * =====================================================================
 *
 *  Halaman ini tidak lagi menyisipkan <style> sendiri. Seluruh komponen
 *  yang dipakai (stat-tamu-card, btn-quick-action, ticket-table-card,
 *  ticket-select, chart-box, ...) kini punya definisi tunggal di
 *  public/assets/css/ult-dashboard.css bagian "20.7 ALIAS CLASS LAMA",
 *  sehingga warnanya sama dengan dashboard lain.
 *
 *  PENTING: baris ini harus berada DI DALAM blok PHP. Kalau ditulis
 *  setelah tag penutup, seluruh tulisan komentar akan tercetak sebagai
 *  teks di atas halaman. Gunakan tools/php_leak.php untuk memeriksanya.
 *
 * @package Views\petugas
 */
?> 

<div class="container-fluid px-4 py-4 dashboard-page">
    <!-- HEADER & BREADCRUMB -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="dashboard-title mb-1" style="font-size:1.75rem;">
                Dashboard Petugas
            </h1>
            <p class="dashboard-subtitle mb-0">
                Ringkasan statistik & aktivitas permohonan layanan mahasiswa ULT.
            </p>
        </div>
        <nav aria-label="breadcrumb" class="dashboard-breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active text-muted">Statistik Utama</li>
            </ol>
        </nav>
    </div>

    <!-- 4 KOTAK STATISTIK SAMA DENGAN HALAMAN DATA TIKET -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-navy p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Total Tiket</span>
                        <h2 class="stat-number text-white mt-1 mb-0 counter-value" data-target="<?= $jumlahTiket ?? 21 ?>">0</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-ticket-alt"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-orange p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Menunggu Verifikasi</span>
                        <h2 class="stat-number text-white mt-1 mb-0 counter-value" data-target="<?= $jumlahSubmitted ?? 6 ?>">0</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-clock"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-green p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Terverifikasi</span>
                        <h2 class="stat-number text-white mt-1 mb-0 counter-value" data-target="<?= $jumlahVerified ?? 7 ?>">0</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-user-check"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-yellow p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Diproses / Disposisi</span>
                        <h2 class="stat-number text-white mt-1 mb-0 counter-value" data-target="<?= $jumlahDisposisi ?? 5 ?>">0</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-cogs"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- QUICK ACTION BUTTONS -->
    <div class="quick-action-card mb-4 reveal-item">
        <div class="quick-action-header d-flex align-items-center">
            <i class="fas fa-bolt text-warning me-2"></i> Akses Cepat Petugas
        </div>
        <div class="p-3">
            <div class="row g-3">
                <div class="col-md-3">
                    <a href="<?= base_url('datatiket') ?>" class="btn-quick-action bg-tamu-navy">
                        <i class="fas fa-list-alt"></i> Semua Data Tiket
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= base_url('datatiket?status=Submitted') ?>" class="btn-quick-action bg-tamu-orange">
                        <i class="fas fa-user-clock"></i> Verifikasi Tiket
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="<?= base_url('datatiket?status=Verified') ?>" class="btn-quick-action bg-tamu-yellow">
                        <i class="fas fa-share"></i> Disposisi Layanan
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="javascript:void(0)" id="btnRefreshData" class="btn-quick-action" style="background: #475569;">
                        <i class="fas fa-sync-alt" id="refreshIcon"></i> Refresh Statistik
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- OPSI FILTER STATISTIK ULTRA DEWA -->
    <div class="card ticket-filter-card mb-4 reveal-item">
        <div class="card-body p-3">
            <div class="row g-3 align-items-center justify-content-between">
                <div class="col-md-4">
                    <h5 class="fw-bold text-dark mb-0 d-flex align-items-center">
                        <i class="fas fa-chart-line text-primary me-2"></i> Analitik & Grafik Tiket
                    </h5>
                    <small class="text-muted">Pantau persebaran status dan tren permohonan</small>
                </div>

                <div class="col-md-8">
                    <div class="d-flex align-items-center justify-content-md-end gap-2 flex-wrap">
                        <div class="filter-select-wrapper">
                            <select id="filterPeriode" class="form-select ticket-select" style="width: auto; min-width: 200px;">
                                <option value="semua">Semua Periode</option>
                                <option value="hari">Hari Ini</option>
                                <option value="minggu">Minggu Ini</option>
                                <option value="bulan" selected>Bulan Ini</option>
                                <option value="tahun">Tahun Ini</option>
                                <option value="custom">Manual (Custom Tanggal)</option>
                            </select>
                        </div>

                        <div id="customDateBox" class="d-none align-items-center gap-2">
                            <input type="date" id="startDate" class="form-control ticket-input" value="<?= date('Y-m-01') ?>">
                            <span class="text-muted fw-bold style-range-separator" style="font-size: 0.8rem;">s/d</span>
                            <input type="date" id="endDate" class="form-control ticket-input" value="<?= date('Y-m-d') ?>">
                            <button type="button" id="btnApplyDate" class="btn btn-apply-filter">
                                <i class="fas fa-check"></i> Terapkan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- GRAFIK DUA COLUMN (BAR & DOUGHNUT) -->
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card ticket-table-card h-100 reveal-item">
                <div class="ticket-table-header d-flex justify-content-between align-items-center">
                    <div class="ticket-table-title">
                        <i class="fas fa-chart-bar text-primary me-2"></i> Distribusi Status Tiket
                    </div>
                    <span class="badge bg-light text-dark border">Bar Chart</span>
                </div>
                <div class="p-4">
                    <div class="chart-box">
                        <canvas id="mainBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card ticket-table-card h-100 reveal-item">
                <div class="ticket-table-header d-flex justify-content-between align-items-center">
                    <div class="ticket-table-title">
                        <i class="fas fa-chart-pie text-primary me-2"></i> Proporsi Persentase
                    </div>
                    <span class="badge bg-light text-dark border">Donut Chart</span>
                </div>
                <div class="p-4">
                    <div class="chart-box">
                        <canvas id="mainDoughnutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // 1. ANIMASI SAMA SEPERTI TIKET.PHP: ENTRANCE STAGGERED REVEAL
    const reveals = document.querySelectorAll('.reveal-item');
    reveals.forEach((el, index) => {
        setTimeout(() => {
            el.classList.add('show');
        }, index * 80);
    });

    // 2. ANIMASI COUNTER ANGKA BERJALAN INTERAKTIF
    function runCounters() {
        const counters = document.querySelectorAll('.counter-value');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const duration = 1000;
            const startTime = performance.now();

            function updateCounter(currentTime) {
                const elapsedTime = currentTime - startTime;
                const progress = Math.min(elapsedTime / duration, 1);
                const easeOut = 1 - Math.pow(1 - progress, 3);

                counter.innerText = Math.floor(easeOut * target);

                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.innerText = target;
                }
            }
            requestAnimationFrame(updateCounter);
        });
    }
    runCounters();

    // 3. INISIALISASI CHART.JS PRO LEVEL
    let barChart, doughnutChart;
    const labels = ['Submitted', 'Verified', 'Disposisi', 'In Progress', 'Completed', 'Rejected'];
    const colors = ['#ff8c00', '#10b981', '#f4c400', '#1a237e', '#059669', '#dc2626'];

    if (typeof Chart !== 'undefined') {
        Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
        Chart.defaults.color = '#59636e';
    }

    function initCharts(dataValues) {
        // Bar Chart
        const ctxBar = document.getElementById('mainBarChart');
        if (ctxBar) {
            barChart = new Chart(ctxBar.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Tiket',
                        data: dataValues,
                        backgroundColor: colors,
                        borderRadius: 8,
                        barPercentage: 0.55
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: { duration: 1000, easing: 'easeOutQuart' },
                    plugins: {
                        legend: { display: false },
                        tooltip: { backgroundColor: '#1a237e', padding: 10, borderRadius: 8 }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { color: '#edf0f4' } },
                        x: { grid: { display: false } }
                    }
                }
            });
        }

        // Doughnut Chart
        const ctxDoughnut = document.getElementById('mainDoughnutChart');
        if (ctxDoughnut) {
            doughnutChart = new Chart(ctxDoughnut.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: dataValues,
                        backgroundColor: colors,
                        borderWidth: 2,
                        borderColor: '#ffffff',
                        hoverOffset: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { position: 'bottom', labels: { boxWidth: 12, padding: 15 } },
                        tooltip: { backgroundColor: '#1a237e', padding: 10, borderRadius: 8 }
                    }
                }
            });
        }
    }

    // 4. MENGUPDATE DATA STATISTIK SECARA DINAMIS (INTERAKTIF LEVEL DEWA)
    function updateCharts(newData) {
        if (barChart) {
            barChart.data.datasets[0].data = newData;
            barChart.update();
        }
        if (doughnutChart) {
            doughnutChart.data.datasets[0].data = newData;
            doughnutChart.update();
        }
    }

    function fetchFilteredStatistik() {
        const periode = document.getElementById('filterPeriode').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const refreshIcon = document.getElementById('refreshIcon');

        if (refreshIcon) refreshIcon.classList.add('fa-spin');

        const url = `<?= base_url('dashboard/api/statistik-data') ?>?periode=${periode}&start_date=${startDate}&end_date=${endDate}`;

        fetch(url)
            .then(res => res.json())
            .then(res => {
                if (res.status === 'success') {
                    const d = res.data;
                    updateCharts([
                        d.submitted ?? 0,
                        d.verified ?? 0,
                        d.disposisi ?? 0,
                        d.in_progress ?? 0,
                        d.completed ?? 0,
                        d.rejected ?? 0
                    ]);
                }
            })
            .catch(err => console.error("Error fetching stats:", err))
            .finally(() => {
                if (refreshIcon) refreshIcon.classList.remove('fa-spin');
            });
    }

    // Event Control
    const filterPeriode = document.getElementById('filterPeriode');
    const customDateBox = document.getElementById('customDateBox');

    if (filterPeriode) {
        filterPeriode.addEventListener('change', function () {
            if (this.value === 'custom') {
                customDateBox.classList.remove('d-none');
                customDateBox.classList.add('d-flex');
            } else {
                customDateBox.classList.remove('d-flex');
                customDateBox.classList.add('d-none');
                fetchFilteredStatistik();
            }
        });
    }

    const btnApplyDate = document.getElementById('btnApplyDate');
    if (btnApplyDate) {
        btnApplyDate.addEventListener('click', function(e) {
            // Interactive Ripple Effect
            const btn = e.currentTarget;
            btn.style.transform = 'scale(0.95)';
            setTimeout(() => btn.style.transform = '', 150);

            fetchFilteredStatistik();
        });
    }

    const btnRefreshData = document.getElementById('btnRefreshData');
    if (btnRefreshData) {
        btnRefreshData.addEventListener('click', function() {
            fetchFilteredStatistik();
            runCounters();
        });
    }

    // Initial Load Chart dengan Data Default PHP
    initCharts([
        <?= $jumlahSubmitted ?? 6 ?>,
        <?= $jumlahVerified ?? 7 ?>,
        <?= $jumlahDisposisi ?? 5 ?>,
        2, 1, 0
    ]);
});
</script>

<?= $this->endSection() ?>