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
                        <h2 class="stat-number text-white mt-1 mb-0 counter-value" data-target="<?= $jumlahTiket ?>">0</h2>
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
                        <h2 class="stat-number text-white mt-1 mb-0 counter-value" data-target="<?= $jumlahSubmitted ?>">0</h2>
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
                        <h2 class="stat-number text-white mt-1 mb-0 counter-value" data-target="<?= $jumlahVerified ?>">0</h2>
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
                        <h2 class="stat-number text-white mt-1 mb-0 counter-value" data-target="<?= $jumlahDisposisi ?>">0</h2>
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
                        <canvas id="mainBarChart" aria-label="Grafik distribusi status tiket"></canvas>
                        <div id="mainBarChartEmpty" class="chart-empty-state d-none" role="status">
                            Belum ada data statistik untuk periode ini.
                        </div>
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
                        <canvas id="mainDoughnutChart" aria-label="Grafik proporsi status tiket"></canvas>
                        <div id="mainDoughnutChartEmpty" class="chart-empty-state d-none" role="status">
                            Belum ada data statistik untuk periode ini.
                        </div>
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
    let barChart = null;
    let doughnutChart = null;
    const initialLabels = <?= json_encode(
        $chartLabels,
        JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT
    ) ?>;
    const initialValues = <?= json_encode($chartValues) ?>;
    const colors = [
        '#ff8c00', '#10b981', '#f4c400', '#1a237e', '#059669',
        '#dc2626', '#0284c7', '#7c3aed', '#64748b', '#db2777'
    ];

    if (typeof Chart !== 'undefined' && Chart.defaults.global) {
        Chart.defaults.global.defaultFontFamily = "'Plus Jakarta Sans', sans-serif";
        Chart.defaults.global.defaultFontColor = '#59636e';
    }

    function showChartMessage(canvasId, emptyId, message) {
        const canvas = document.getElementById(canvasId);
        const emptyState = document.getElementById(emptyId);

        if (canvas) {
            canvas.classList.add('d-none');
        }

        if (emptyState) {
            emptyState.textContent = message;
            emptyState.classList.remove('d-none');
        }
    }

    function showChart(canvasId, emptyId) {
        const canvas = document.getElementById(canvasId);
        const emptyState = document.getElementById(emptyId);

        if (canvas) {
            canvas.classList.remove('d-none');
        }

        if (emptyState) {
            emptyState.classList.add('d-none');
        }
    }

    function renderCharts(labels, values) {
        const total = values.reduce((sum, value) => sum + Number(value || 0), 0);

        if (total === 0) {
            if (barChart) {
                barChart.destroy();
                barChart = null;
            }
            if (doughnutChart) {
                doughnutChart.destroy();
                doughnutChart = null;
            }
            showChartMessage('mainBarChart', 'mainBarChartEmpty', 'Belum ada data statistik untuk periode ini.');
            showChartMessage('mainDoughnutChart', 'mainDoughnutChartEmpty', 'Belum ada data statistik untuk periode ini.');
            return;
        }

        if (typeof Chart === 'undefined') {
            showChartMessage('mainBarChart', 'mainBarChartEmpty', 'Library grafik tidak berhasil dimuat.');
            showChartMessage('mainDoughnutChart', 'mainDoughnutChartEmpty', 'Library grafik tidak berhasil dimuat.');
            return;
        }

        showChart('mainBarChart', 'mainBarChartEmpty');
        showChart('mainDoughnutChart', 'mainDoughnutChartEmpty');

        const datasetColors = labels.map((_, index) => colors[index % colors.length]);
        const barCanvas = document.getElementById('mainBarChart');
        const doughnutCanvas = document.getElementById('mainDoughnutChart');

        try {
            if (barCanvas) {
                if (barChart) {
                    barChart.destroy();
                }
                barChart = new Chart(barCanvas.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Tiket',
                            data: values,
                            backgroundColor: datasetColors,
                            barPercentage: 0.55
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: { duration: 800 },
                        legend: { display: false },
                        tooltips: { backgroundColor: '#1a237e', padding: 10 },
                        scales: {
                            yAxes: [{
                                ticks: { beginAtZero: true, precision: 0 },
                                gridLines: { color: '#edf0f4' }
                            }],
                            xAxes: [{ gridLines: { display: false } }]
                        }
                    }
                });
            }
        } catch (error) {
            console.error('Gagal membuat grafik distribusi status tiket:', error);
            showChartMessage('mainBarChart', 'mainBarChartEmpty', 'Grafik tidak dapat dimuat. Silakan refresh statistik.');
        }

        try {
            if (doughnutCanvas) {
                if (doughnutChart) {
                    doughnutChart.destroy();
                }
                doughnutChart = new Chart(doughnutCanvas.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: datasetColors,
                            borderWidth: 2,
                            borderColor: '#ffffff'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutoutPercentage: 70,
                        legend: {
                            position: 'bottom',
                            labels: { boxWidth: 12, padding: 15 }
                        },
                        tooltips: {
                            backgroundColor: '#1a237e',
                            padding: 10,
                            callbacks: {
                                label: function (tooltipItem, chartData) {
                                    const index = tooltipItem.index;
                                    const value = Number(chartData.datasets[0].data[index] || 0);
                                    const percentage = total > 0 ? (value / total * 100).toFixed(1) : '0.0';
                                    return chartData.labels[index] + ': ' + value + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                });
            }
        } catch (error) {
            console.error('Gagal membuat grafik proporsi tiket:', error);
            showChartMessage('mainDoughnutChart', 'mainDoughnutChartEmpty', 'Grafik tidak dapat dimuat. Silakan refresh statistik.');
        }
    }

    function fetchFilteredStatistik() {
        const periode = document.getElementById('filterPeriode').value;
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const refreshIcon = document.getElementById('refreshIcon');

        if (refreshIcon) refreshIcon.classList.add('fa-spin');

        const parameters = new URLSearchParams({
            periode: periode,
            start_date: startDate,
            end_date: endDate
        });
        const url = `<?= base_url('petugas/api/statistik-data') ?>?${parameters.toString()}`;

        fetch(url)
            .then(res => {
                if (!res.ok) {
                    throw new Error('Permintaan statistik gagal (' + res.status + ').');
                }
                return res.json();
            })
            .then(res => {
                const data = res.data;
                if (
                    res.status !== 'success'
                    || !data
                    || !Array.isArray(data.status_labels)
                    || !Array.isArray(data.status_values)
                    || data.status_labels.length !== data.status_values.length
                ) {
                    throw new Error('Format data statistik tidak sesuai.');
                }
                renderCharts(data.status_labels, data.status_values);
            })
            .catch(err => {
                console.error('Error mengambil statistik tiket:', err);
                showChartMessage('mainBarChart', 'mainBarChartEmpty', 'Statistik gagal dimuat. Silakan coba refresh kembali.');
                showChartMessage('mainDoughnutChart', 'mainDoughnutChartEmpty', 'Statistik gagal dimuat. Silakan coba refresh kembali.');
            })
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
    renderCharts(initialLabels, initialValues);
});
</script>

<?= $this->endSection() ?>