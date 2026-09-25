<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<style>
    .metric-card {
        background: #ffffff;
        border-radius: 1rem;
        border: 1px solid rgba(226, 232, 240, 0.8);
        padding: 1.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        height: 100%;
    }
    .metric-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: #cbd5e1;
    }
    .metric-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }
    .metric-title {
        color: #64748b;
        font-size: 0.875rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }
    .metric-value {
        color: #0f172a;
        font-size: 2rem;
        font-weight: 800;
        line-height: 1.2;
    }
    .icon-primary { background: rgba(79, 70, 229, 0.1); color: #4f46e5; }
    .icon-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .icon-info { background: rgba(14, 165, 233, 0.1); color: #0ea5e9; }
    .icon-success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
    <div>
        <h4 class="fw-bold text-dark mb-1">
            <i class="bi bi-bar-chart-line-fill text-primary me-2"></i>Statistik & Laporan
        </h4>
        <small class="text-muted">Ringkasan visual dari semua data pengajuan layanan.</small>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="metric-card">
            <div class="metric-icon-wrapper icon-primary">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div class="metric-title">Total Pengajuan</div>
            <div class="metric-value rt-value" data-rt-key="total"><?= esc($summary['total']) ?></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="metric-card">
            <div class="metric-icon-wrapper icon-warning">
                <i class="fas fa-clock"></i>
            </div>
            <div class="metric-title">Menunggu</div>
            <div class="metric-value rt-value" data-rt-key="pending"><?= esc($summary['pending']) ?></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="metric-card">
            <div class="metric-icon-wrapper icon-info">
                <i class="fas fa-cogs"></i>
            </div>
            <div class="metric-title">Diproses</div>
            <div class="metric-value rt-value" data-rt-key="processing"><?= esc($summary['processing']) ?></div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="metric-card">
            <div class="metric-icon-wrapper icon-success">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="metric-title">Selesai</div>
            <div class="metric-value rt-value" data-rt-key="completed"><?= esc($summary['completed']) ?></div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-6">
        <div class="card card-premium h-100">
            <div class="card-header bg-white border-bottom border-light py-3">
                <h6 class="fw-bold mb-0 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.08em;">
                    <i class="fas fa-chart-pie me-2 text-primary"></i>Pengajuan per Status
                </h6>
            </div>
            <div class="card-body p-4 d-flex align-items-center justify-content-center">
                <div style="width: 100%; max-width: 350px;">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-premium h-100">
            <div class="card-header bg-white border-bottom border-light py-3">
                <h6 class="fw-bold mb-0 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.08em;">
                    <i class="fas fa-chart-bar me-2 text-primary"></i>Pengajuan per Unit Layanan
                </h6>
            </div>
            <div class="card-body p-4">
                <canvas id="unitChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-premium h-100">
            <div class="card-header bg-white border-bottom border-light py-3">
                <h6 class="fw-bold mb-0 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.08em;">
                    <i class="fas fa-users me-2 text-primary"></i>Pengajuan per Jenis Pemohon
                </h6>
            </div>
            <div class="card-body p-4 d-flex align-items-center justify-content-center">
                <div style="width: 100%; max-width: 350px;">
                    <canvas id="applicantChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card card-premium h-100">
            <div class="card-header bg-white border-bottom border-light py-3">
                <h6 class="fw-bold mb-0 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.08em;">
                    <i class="fas fa-chart-line me-2 text-primary"></i>Pengajuan per Bulan
                </h6>
            </div>
            <div class="card-body p-4">
                <canvas id="monthChart"></canvas>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Set global font for premium look
    Chart.defaults.font.family = "'Poppins', 'Inter', sans-serif";
    Chart.defaults.color = "#64748b";

    const statusLabels = [];
    const statusData = [];
    <?php foreach ($byStatus as $row): ?>
        statusLabels.push('<?= addslashes($statusMap[$row['status']] ?? $row['status']) ?>');
        statusData.push(<?= (int) $row['total'] ?>);
    <?php endforeach; ?>
    new Chart(document.getElementById('statusChart'), {
        type: 'doughnut',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusData,
                backgroundColor: ['#6c757d', '#f59e0b', '#0ea5e9', '#6c757d', '#3b82f6', '#10b981', '#ef4444', '#dc3545'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: { cutout: '65%', plugins: { legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true, pointStyle: 'circle' } } } }
    });

    const unitLabels = [];
    const unitData = [];
    <?php foreach ($byUnit as $row): ?>
        unitLabels.push('<?= addslashes($row['unit']) ?>');
        unitData.push(<?= (int) $row['total'] ?>);
    <?php endforeach; ?>
    new Chart(document.getElementById('unitChart'), {
        type: 'bar',
        data: {
            labels: unitLabels,
            datasets: [{
                label: 'Jumlah',
                data: unitData,
                backgroundColor: 'rgba(79, 70, 229, 0.85)',
                borderRadius: 6,
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [4, 4], drawBorder: false } },
                x: { grid: { display: false } }
            }
        }
    });

    const applicantLabels = [];
    const applicantData = [];
    <?php foreach ($byApplicantType as $row): ?>
        applicantLabels.push('<?= addslashes($row['applicant_type']) ?>');
        applicantData.push(<?= (int) $row['total'] ?>);
    <?php endforeach; ?>
    new Chart(document.getElementById('applicantChart'), {
        type: 'pie',
        data: {
            labels: applicantLabels,
            datasets: [{
                data: applicantData,
                backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#ef4444', '#0ea5e9', '#8b5cf6', '#f97316', '#14b8a6'],
                borderWidth: 0,
                hoverOffset: 4
            }]
        },
        options: { plugins: { legend: { position: 'bottom', labels: { padding: 20, usePointStyle: true, pointStyle: 'circle' } } } }
    });

    const monthLabels = [];
    const monthData = [];
    <?php foreach ($byMonth as $row): ?>
        monthLabels.push('<?= addslashes($row['month']) ?>');
        monthData.push(<?= (int) $row['total'] ?>);
    <?php endforeach; ?>
    new Chart(document.getElementById('monthChart'), {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Jumlah',
                data: monthData,
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#10b981',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { borderDash: [4, 4], drawBorder: false } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
<?= $this->endSection() ?>
