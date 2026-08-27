<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Global Card & Smooth Transition */
    .dashboard-card {
        border-radius: 12px !important;
        border: none !important;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    /* Stat Cards Hover & Dynamic Design */
    .stat-card-modern {
        border-radius: 12px !important;
        position: relative;
        overflow: hidden;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .stat-card-modern:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15) !important;
    }
    .stat-card-icon {
        opacity: 0.25;
        transition: opacity 0.25s ease, transform 0.25s ease;
    }
    .stat-card-modern:hover .stat-card-icon {
        opacity: 0.45;
        transform: scale(1.1);
    }
    .stat-badge-number {
        font-size: 1.1rem !important;
        border-radius: 8px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    /* Quick Action Button Styling */
    .btn-quick-action {
        border-radius: 10px !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
        border: none !important;
    }
    .btn-quick-action:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2) !important;
        filter: brightness(1.05);
    }

    /* Modern Glassmorphism Filter Section & Select */
    .card-filter-header {
        border-radius: 20px;
        border: 1px solid rgba(226, 232, 240, 0.8);
        background: #ffffff;
        box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.04), 0 8px 10px -6px rgba(15, 23, 42, 0.04);
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
        padding: 0.55rem 2.5rem 0.55rem 2.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #1e293b;
        cursor: pointer;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    }

    .select-ultra:hover {
        border-color: #94a3b8;
        background-color: #f8fafc;
    }

    .select-ultra:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
    }

    .filter-icon-left {
        position: absolute;
        left: 14px;
        color: #64748b;
        pointer-events: none;
        font-size: 0.9rem;
    }

    .filter-icon-right {
        position: absolute;
        right: 14px;
        color: #64748b;
        pointer-events: none;
        font-size: 0.8rem;
        transition: transform 0.2s ease;
    }

    .select-ultra:focus ~ .filter-icon-right {
        transform: rotate(180deg);
        color: #2563eb;
    }

    .input-date-ultra {
        border: 1.5px solid #cbd5e1;
        border-radius: 12px;
        padding: 0.5rem 0.75rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: #334155;
        outline: none;
        transition: all 0.2s ease;
    }

    .input-date-ultra:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
    }

    .btn-apply-filter {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        border: none;
        color: #ffffff;
        font-weight: 600;
        font-size: 0.85rem;
        border-radius: 12px;
        padding: 0.55rem 1.25rem;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
        transition: all 0.2s ease;
    }

    .btn-apply-filter:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
    }

    .card-ultra {
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04) !important;
        background: #ffffff;
    }

    .chart-wrapper-box { position: relative; width: 100%; height: 320px; }
</style>

<div class="container-fluid px-4 py-4">

    <!-- HEADER TITLE & BREADCRUMB -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 font-weight-bold text-dark mb-1" style="color: #1a237e !important;">Dashboard Petugas ULT</h1>
            <p class="text-muted mb-0">Kelola tiket layanan mahasiswa Politeknik Negeri Bandung.</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0">
                <li class="breadcrumb-item"><a href="<?= base_url('petugas/dashboard') ?>" class="text-primary text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Home</li>
            </ol>
        </nav>
    </div>

    <!-- 4 STAT CARDS KERTAS UTAMA DASHBOARD -->
    <div class="row mb-4">
        
        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100 stat-card-modern" style="background-color: #1a237e;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="badge badge-light text-primary font-weight-bold px-3 py-1 mb-2 stat-badge-number counter-value" data-target="120">0</span>
                        <h6 class="mb-0 font-weight-bold">Tiket Masuk</h6>
                    </div>
                    <i class="fas fa-envelope fa-2x stat-card-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100 stat-card-modern" style="background-color: #ff8c00;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="badge badge-light text-warning font-weight-bold px-3 py-1 mb-2 stat-badge-number counter-value" data-target="95">0</span>
                        <h6 class="mb-0 font-weight-bold">Diverifikasi</h6>
                    </div>
                    <i class="fas fa-check-circle fa-2x stat-card-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100 stat-card-modern" style="background-color: #f1c40f;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="badge badge-light text-dark font-weight-bold px-3 py-1 mb-2 stat-badge-number counter-value" data-target="20">0</span>
                        <h6 class="mb-0 font-weight-bold text-white">Dipproses Unit</h6>
                    </div>
                    <i class="fas fa-spinner fa-2x stat-card-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-3 mb-xl-0">
            <div class="card border-0 text-white shadow-sm h-100 stat-card-modern" style="background-color: #107c41;">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="badge badge-light text-success font-weight-bold px-3 py-1 mb-2 stat-badge-number counter-value" data-target="5">0</span>
                        <h6 class="mb-0 font-weight-bold">Terlambat SLA</h6>
                    </div>
                    <i class="fas fa-clock fa-2x stat-card-icon"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- QUICK ACTION SECTION -->
    <div class="card border-0 shadow-sm mb-4 dashboard-card">
        <div class="card-header text-white border-0 py-2 px-3" style="background-color: #1a237e; border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <h6 class="font-weight-bold mb-0">
                <i class="fas fa-bolt mr-2"></i>Quick Action
            </h6>
        </div>
        <div class="card-body p-3">
            <div class="row">
                <div class="col-md-3 mb-2 mb-md-0">
                    <a href="<?= base_url('petugas/tiket') ?>"
                       class="btn btn-block text-white font-weight-bold py-3 shadow-sm d-flex align-items-center justify-content-center btn-quick-action"
                       style="background:#ff8c00;">
                        <i class="fas fa-ticket-alt fa-2x mr-3"></i>
                        Data Tiket
                    </a>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <a href="<?= base_url('petugas/tiket?status=Submitted') ?>"
                       class="btn btn-block text-white font-weight-bold py-3 shadow-sm d-flex align-items-center justify-content-center btn-quick-action"
                       style="background:#107c41;">
                        <i class="fas fa-user-check fa-2x mr-3"></i>
                        Verifikasi
                    </a>
                </div>
                <div class="col-md-3 mb-2 mb-md-0">
                    <a href="<?= base_url('petugas/tiket?status=Verified') ?>"
                       class="btn btn-block text-white font-weight-bold py-3 shadow-sm d-flex align-items-center justify-content-center btn-quick-action"
                       style="background:#f1c40f;">
                        <i class="fas fa-share-square fa-2x mr-3"></i>
                        Disposisi
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="javascript:location.reload()" 
                       class="btn btn-block text-white font-weight-bold py-3 shadow-sm d-flex align-items-center justify-content-center btn-quick-action" 
                       style="background-color: #343a40;">
                        <i class="fas fa-sync-alt fa-2x mr-3"></i> Refresh
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTER PERIODE & TANGGAL MANUAL STATISTIK TIKET -->
    <div class="card card-filter-header p-4 mb-4">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
                <h3 class="fw-bold text-dark mb-1" style="letter-spacing: -0.5px;">Statistik & Analitik Tiket</h3>
                <p class="text-muted small mb-0">Pantau pergerakan data tiket layanan bantuan ULT secara real-time dan akurat.</p>
            </div>
            
            <div class="d-flex align-items-center gap-3 flex-wrap">
                <div class="filter-dropdown-wrapper">
                    <i class="fas fa-filter filter-icon-left"></i>
                    <select id="filterPeriode" class="select-ultra">
                        <option value="semua">Semua Periode</option>
                        <option value="hari">Hari Ini</option>
                        <option value="minggu">Minggu Ini</option>
                        <option value="bulan" selected>Bulan Ini</option>
                        <option value="tahun">Tahun Ini</option>
                        <option value="custom">Filter Tanggal Manual</option>
                    </select>
                    <i class="fas fa-chevron-down filter-icon-right"></i>
                </div>
                
                <div id="customDateContainer" class="d-none align-items-center gap-2">
                    <input type="date" id="startDate" class="input-date-ultra" value="<?= date('Y-m-01') ?>">
                    <span class="text-muted small fw-bold">s/d</span>
                    <input type="date" id="endDate" class="input-date-ultra" value="<?= date('Y-m-d') ?>">
                    <button type="button" id="btnTerapkanTanggal" class="btn btn-apply-filter">
                        <i class="fas fa-check me-1"></i> Terapkan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- GRAFIK STATISTIK -->
    <div class="row g-4 mb-4">
        <div class="col-lg-8">
            <div class="card card-ultra h-100">
                <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                    <h6 class="fw-bold text-dark mb-0"><i class="fas fa-chart-bar text-primary me-2"></i>Distribusi Kategori Status Tiket</h6>
                    <small class="text-muted">Grafik Utama</small>
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
                    <h6 class="fw-bold text-dark mb-0"><i class="fas fa-chart-pie text-primary me-2"></i>Proporsi Status Tiket</h6>
                    <small class="text-muted">Persentase</small>
                </div>
                <div class="card-body p-4">
                    <div class="chart-wrapper-box">
                        <canvas id="mainDoughnutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        
        // 1. Animasi Counter Angka Berjalan (Original Dashboard)
        const counters = document.querySelectorAll('.counter-value');
        counters.forEach(counter => {
            const target = +counter.getAttribute('data-target');
            const duration = 1000;
            const stepTime = 25;
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

        // 2. Fade In Effect Saat Halaman Dimuat
        const cards = document.querySelectorAll('.dashboard-card, .stat-card-modern');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(10px)';
            card.style.transition = `all 0.3s ease-out ${index * 0.05}s`;
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 50);
        });

        // 3. Script Grafik Chart JS
        let barChart, doughnutChart;

        const labelsArray = ['Submitted', 'Assigned', 'In Progress', 'Completed', 'Need Revision', 'Rejected'];
        const colorPalette = ['#ff8c00', '#f4c400', '#0284c7', '#10b981', '#d97706', '#ef4444'];

        if (typeof Chart !== 'undefined') {
            Chart.defaults.font.family = "'Plus Jakarta Sans', sans-serif";
            Chart.defaults.color = '#64748b';
        }

        function initCharts(initialData) {
            const barCanvas = document.getElementById('mainBarChart');
            if (barCanvas) {
                const barCtx = barCanvas.getContext('2d');
                barChart = new Chart(barCtx, {
                    type: 'bar',
                    data: {
                        labels: labelsArray,
                        datasets: [{
                            label: 'Jumlah Tiket',
                            data: initialData,
                            backgroundColor: colorPalette,
                            borderRadius: 8,
                            barPercentage: 0.55
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, ticks: { precision: 0 } },
                            x: { grid: { display: false } }
                        }
                    }
                });
            }

            const doughnutCanvas = document.getElementById('mainDoughnutChart');
            if (doughnutCanvas) {
                const doughnutCtx = doughnutCanvas.getContext('2d');
                doughnutChart = new Chart(doughnutCtx, {
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
                        plugins: { legend: { position: 'bottom' } }
                    }
                });
            }
        }

        function updateDashboardUI(data) {
            const updatedArray = [
                data.submitted,
                data.assigned,
                data.in_progress,
                data.completed,
                data.need_revision,
                data.rejected
            ];

            if (barChart) {
                barChart.data.datasets[0].data = updatedArray;
                barChart.update();
            }

            if (doughnutChart) {
                doughnutChart.data.datasets[0].data = updatedArray;
                doughnutChart.update();
            }
        }

        function fetchFilteredData() {
            const periode = document.getElementById('filterPeriode').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;

            const url = `<?= base_url('petugas/api/statistik-data') ?>?periode=${periode}&start_date=${startDate}&end_date=${endDate}`;

            fetch(url)
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success') {
                        updateDashboardUI(res.data);
                    }
                })
                .catch(err => console.error("Error fetching data:", err));
        }

        const filterPeriode = document.getElementById('filterPeriode');
        const customDateContainer = document.getElementById('customDateContainer');

        if (filterPeriode && customDateContainer) {
            filterPeriode.addEventListener('change', function () {
                if (this.value === 'custom') {
                    customDateContainer.classList.remove('d-none');
                    customDateContainer.classList.add('d-flex');
                } else {
                    customDateContainer.classList.remove('d-flex');
                    customDateContainer.classList.add('d-none');
                    fetchFilteredData();
                }
            });
        }

        const btnTerapkanTanggal = document.getElementById('btnTerapkanTanggal');
        if (btnTerapkanTanggal) {
            btnTerapkanTanggal.addEventListener('click', function () {
                fetchFilteredData();
            });
        }

        initCharts([
            <?= $submitted ?? 5 ?>,
            <?= $assigned ?? 3 ?>,
            <?= $in_progress ?? 2 ?>,
            <?= $completed ?? 2 ?>,
            <?= $need_revision ?? 1 ?>,
            <?= $rejected ?? 0 ?>
        ]);

    });
</script>

<?= $this->endSection() ?>