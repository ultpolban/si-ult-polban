<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Grafik Statistik</h3>
            <p class="text-muted mb-0">Visualisasi data layanan unit terpadu</p>
        </div>
        <div class="d-flex align-items-center">
            <select class="select-filter mr-2" style="height: 38px;">
                <option>Semua Layanan</option>
                <option>Surat Keterangan Aktif Kuliah</option>
                <option>Legalisir Ijazah/Transkrip</option>
            </select>
            <select class="select-filter mr-2" style="height: 38px;">
                <option>01 Mei 2024 - 07 Mei 2024</option>
                <option>30 Hari Terakhir</option>
                <option>Tahun Ini</option>
            </select>
            <button class="btn btn-filter-submit d-flex align-items-center" style="height: 38px;">
                <i class="fas fa-sync-alt mr-1"></i> Refresh
            </button>
        </div>
    </div>

    <!-- Charts Row 1 (Three Columns) -->
    <div class="row">
        <!-- Tiket Masuk per Hari -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card card-premium">
                <div class="card-header">
                    <h5>Tiket Masuk per Hari</h5>
                </div>
                <div class="card-body">
                    <div style="height: 240px; position: relative;">
                        <canvas id="dailyTicketsBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tiket per Kategori -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card card-premium">
                <div class="card-header">
                    <h5>Tiket per Kategori</h5>
                </div>
                <div class="card-body">
                    <div style="height: 240px; position: relative;" class="d-flex align-items-center justify-content-center">
                        <canvas id="categoryPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tiket Selesai vs Terlambat -->
        <div class="col-lg-4 col-md-6 col-12">
            <div class="card card-premium">
                <div class="card-header">
                    <h5>Tiket Selesai vs Terlambat</h5>
                </div>
                <div class="card-body">
                    <div style="height: 240px; position: relative;" class="d-flex align-items-center justify-content-center">
                        <canvas id="selesaiTerlambatDonutChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Row 2 (Full Width) -->
    <div class="row mt-2">
        <!-- Tren Tiket 30 Hari Terakhir -->
        <div class="col-12">
            <div class="card card-premium">
                <div class="card-header">
                    <h5>Tren Tiket (30 Hari Terakhir)</h5>
                </div>
                <div class="card-body">
                    <div style="height: 300px; position: relative;">
                        <canvas id="trend30DaysChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Libraries -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. Tiket Masuk per Hari (Bar Chart)
    const barCtx = document.getElementById('dailyTicketsBarChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['01 Mei', '02 Mei', '03 Mei', '04 Mei', '05 Mei', '06 Mei', '07 Mei'],
            datasets: [{
                data: [120, 150, 180, 110, 210, 160, 190],
                backgroundColor: '#0d6efd',
                borderRadius: 4,
                barThickness: 16
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    grid: { color: 'rgba(226, 232, 240, 0.6)' },
                    ticks: { color: '#64748b', font: { family: 'Inter', size: 10 } },
                    border: { dash: [5, 5] }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#64748b', font: { family: 'Inter', size: 10 } }
                }
            }
        }
    });

    // 2. Tiket per Kategori (Pie Chart)
    const pieCtx = document.getElementById('categoryPieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Akademik', 'Kemahasiswaan', 'Keuangan', 'Umum', 'Lainnya'],
            datasets: [{
                data: [35, 25, 20, 10, 10],
                backgroundColor: ['#1e2f99', '#f7921d', '#0093ad', '#0f766e', '#64748b'],
                borderWidth: 1,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 10,
                        padding: 10,
                        font: { family: 'Inter', size: 10, weight: 500 },
                        color: '#475569'
                    }
                }
            }
        }
    });

    // 3. Selesai vs Terlambat (Donut Chart with center value)
    const selesaiTerlambatCtx = document.getElementById('selesaiTerlambatDonutChart').getContext('2d');
    
    // Custom plugin to write center text
    const centerTextPlugin = {
        id: 'centerText',
        beforeDraw: function(chart) {
            const width = chart.width,
                  height = chart.height,
                  ctx = chart.ctx;
            ctx.restore();
            
            // Draw "Total" label
            ctx.font = "500 0.78rem Inter";
            ctx.textBaseline = "middle";
            ctx.fillStyle = "#64748b";
            const textTotal = "Total",
                  textTotalX = Math.round((width - ctx.measureText(textTotal).width) / 2) - 30, // adjust X offset since legend is on right
                  textTotalY = height / 2 - 12;
            ctx.fillText(textTotal, textTotalX, textTotalY);
            
            // Draw count
            ctx.font = "700 1.4rem Inter";
            ctx.fillStyle = "#1e2f99";
            const textVal = "1.248",
                  textValX = Math.round((width - ctx.measureText(textVal).width) / 2) - 30,
                  textValY = height / 2 + 10;
            ctx.fillText(textVal, textValX, textValY);
            ctx.save();
        }
    };

    new Chart(selesaiTerlambatCtx, {
        type: 'doughnut',
        data: {
            labels: ['Selesai', 'Terlambat', 'Proses'],
            datasets: [{
                data: [982, 52, 214],
                backgroundColor: ['#1e2f99', '#d63c06', '#00b4d8'],
                borderWidth: 2,
                borderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '72%',
            plugins: {
                legend: {
                    position: 'right',
                    labels: {
                        boxWidth: 10,
                        padding: 12,
                        font: { family: 'Inter', size: 10, weight: 500 },
                        color: '#475569'
                    }
                }
            }
        },
        plugins: [centerTextPlugin]
    });

    // 4. Tren Tiket (30 Hari Terakhir) (Double Smooth Line Chart)
    const trendCtx = document.getElementById('trend30DaysChart').getContext('2d');
    
    // Generate dates for labels
    const daysLabels = [];
    for (let i = 9; i <= 30; i++) daysLabels.push(i + ' Apr');
    for (let i = 1; i <= 8; i++) daysLabels.push(i + ' Mei');

    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: daysLabels,
            datasets: [
                {
                    label: 'Tiket Masuk',
                    data: [
                        45, 52, 49, 63, 58, 70, 68, 72, 60, 55, 62, 75, 80, 85, 90, 78,
                        82, 95, 110, 105, 120, 115, 130, 160, 200, 180, 240, 220, 250, 230
                    ],
                    borderColor: '#1e2f99',
                    borderWidth: 2,
                    backgroundColor: 'transparent',
                    tension: 0.35,
                    pointRadius: 2,
                    pointBackgroundColor: '#1e2f99'
                },
                {
                    label: 'Tiket Selesai',
                    data: [
                        35, 42, 40, 50, 48, 62, 58, 65, 50, 45, 52, 65, 70, 75, 82, 70,
                        75, 85, 98, 92, 105, 98, 100, 120, 150, 130, 210, 190, 215, 205
                    ],
                    borderColor: '#f7921d',
                    borderWidth: 2,
                    backgroundColor: 'transparent',
                    tension: 0.35,
                    pointRadius: 2,
                    pointBackgroundColor: '#f7921d'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 12,
                        font: { family: 'Inter', size: 11, weight: 500 },
                        color: '#64748b'
                    }
                }
            },
            scales: {
                y: {
                    grid: { color: 'rgba(226, 232, 240, 0.6)' },
                    ticks: { color: '#64748b', font: { family: 'Inter', size: 10 } },
                    border: { dash: [5, 5] }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#64748b', font: { family: 'Inter', size: 10 }, maxTicksLimit: 12 }
                }
            }
        }
    });
});
</script>

<?= $this->endSection() ?>

