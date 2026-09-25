<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<style>
    /* Premium Dashboard Styles */
    .metric-card {
        background: #ffffff;
        border-radius: 1rem;
        border: 1px solid rgba(226, 232, 240, 0.8);
        padding: 1.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
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
    .dashboard-section-card {
        background: #ffffff;
        border-radius: 1rem;
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }
    .dashboard-section-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(248, 250, 252, 0.5);
    }
    .dashboard-section-title {
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        font-size: 1.1rem;
    }
    .table-premium th {
        background-color: #f8fafc;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        border-bottom: 2px solid #e2e8f0;
        padding: 1rem 1.5rem;
    }
    .table-premium td {
        padding: 1rem 1.5rem;
        vertical-align: middle;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
    }
    .table-premium tbody tr {
        transition: background-color 0.2s;
    }
    .table-premium tbody tr:hover {
        background-color: #f8fafc;
    }
    
    /* Icon Colors */
    .icon-primary { background: rgba(79, 70, 229, 0.1); color: #4f46e5; }
    .icon-success { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    .icon-info { background: rgba(14, 165, 233, 0.1); color: #0ea5e9; }
    .icon-warning { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
    .icon-danger { background: rgba(239, 68, 68, 0.1); color: #ef4444; }

    /* Badge Customizations */
    .badge-status {
        padding: 0.35em 0.8em;
        font-weight: 600;
        border-radius: 9999px;
    }
</style>

<!-- Welcome Header --> <div class="dashboard-header w-100 d-flex justify-content-between align-items-center"> <div> <h2 class="fw-bold mb-1 text-dark">Dashboard Overview</h2> <p class="mb-0 text-secondary"> Selamat datang kembali, <strong><?= esc($user['full_name'] ?? session('full_name') ?? 'User') ?></strong>. </p> </div> <div> <div class="live-update-badge shadow-sm"> <i class="fas fa-sync-alt fa-spin me-2"></i> <span>Live Update</span> </div> </div> </div> <!-- Metrics Grid -->
<div class="row g-4 mb-4">
    <?php if (!empty($totalUsers)): ?>
        <div class="col-xl-2 col-lg-4 col-sm-6">
            <div class="metric-card">
                <div class="metric-icon-wrapper icon-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="metric-title">Total User</div>
                <div class="metric-value"><?= (int) $totalUsers ?></div>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-xl-2 col-lg-4 col-sm-6">
        <div class="metric-card">
            <div class="metric-icon-wrapper icon-success">
                <i class="fas fa-server"></i>
            </div>
            <div class="metric-title">Total Layanan</div>
            <div class="metric-value"><?= (int) $totalServices ?></div>
        </div>
    </div>

    <?php
    $stateCards = [
        ['label' => 'Total Pengajuan', 'value' => $totalTickets ?? 0,  'color' => 'icon-primary', 'icon' => 'fa-file-alt'],
        ['label' => 'Menunggu',       'value' => $statusCounts['submitted'] ?? 0, 'color' => 'icon-warning', 'icon' => 'fa-clock'],
        ['label' => 'Diproses',       'value' => $statusCounts['in_progress'] ?? 0, 'color' => 'icon-info', 'icon' => 'fa-spinner'],
        ['label' => 'Selesai',        'value' => $statusCounts['completed'] ?? 0, 'color' => 'icon-success', 'icon' => 'fa-check-circle'],
    ];
    if (isset($statusCounts['rejected']) && $statusCounts['rejected'] > 0) {
        $stateCards[] = ['label' => 'Ditolak', 'value' => $statusCounts['rejected'], 'color' => 'icon-danger', 'icon' => 'fa-times-circle'];
    }
    
    // Fill remaining columns in the 6-col grid (2 spaces taken by users & services)
    // If more than 4, it wraps to next row automatically.
    ?>
    <?php foreach($stateCards as $card): ?>
        <div class="col-xl-2 col-lg-4 col-sm-6">
            <div class="metric-card">
                <div class="metric-icon-wrapper <?= $card['color'] ?>">
                    <i class="fas <?= $card['icon'] ?>"></i>
                </div>
                <div class="metric-title"><?= $card['label'] ?></div>
                <div class="metric-value"><?= (int) $card['value'] ?></div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Main Content Area -->
<div class="row g-4">
    <!-- Recent Tickets -->
    <div class="col-xl-8 col-lg-7">
        <div class="dashboard-section-card h-100">
            <div class="dashboard-section-header">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded me-3">
                        <i class="fas fa-list-ul"></i>
                    </div>
                    <h3 class="dashboard-section-title">Pengajuan Terbaru</h3>
                </div>
                <a href="<?= base_url('pengajuan') ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3 fw-medium">
                    Lihat Semua <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-premium mb-0">
                    <thead>
                        <tr>
                            <th>No. Tiket</th>
                            <th>Layanan / Judul</th>
                            <th>Pemohon</th>
                            <th>Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recentTickets)): ?>
                            <tr>
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="fas fa-inbox fa-3x mb-3 text-light"></i><br>
                                    Belum ada pengajuan terbaru.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($recentTickets as $ticket): 
                                $statusBadgeClass = match($ticket['status']) {
                                    'submitted' => 'bg-warning text-dark',
                                    'in_progress' => 'bg-info text-white',
                                    'completed' => 'bg-success text-white',
                                    'rejected' => 'bg-danger text-white',
                                    'cancelled' => 'bg-secondary text-white',
                                    default => 'bg-light text-dark border'
                                };
                                $statusLabel = match($ticket['status']) {
                                    'submitted' => 'Diajukan',
                                    'in_progress' => 'Diproses',
                                    'completed' => 'Selesai',
                                    'rejected' => 'Ditolak',
                                    'cancelled' => 'Dibatalkan',
                                    default => ucfirst($ticket['status'])
                                };
                            ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-light text-dark border font-monospace px-2 py-1">
                                            <?= esc($ticket['ticket_number']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= esc($ticket['layanan_nama'] ?? $ticket['title']) ?></div>
                                        <div class="small text-muted text-truncate" style="max-width: 200px;"><?= esc($ticket['title']) ?></div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2 text-secondary fw-bold" style="width: 32px; height: 32px;">
                                                <?= strtoupper(substr($ticket['pemohon_nama'] ?? 'U', 0, 1)) ?>
                                            </div>
                                            <div class="small fw-medium text-dark"><?= esc($ticket['pemohon_nama'] ?? '-') ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-status <?= $statusBadgeClass ?>">
                                            <?= $statusLabel ?>
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <a href="<?= base_url('pengajuan/detail/' . $ticket['id']) ?>" class="btn btn-sm btn-light rounded-circle text-primary" data-bs-toggle="tooltip" title="Lihat Detail">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Notifications -->
    <div class="col-xl-4 col-lg-5">
        <div class="dashboard-section-card h-100">
            <div class="dashboard-section-header">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning p-2 rounded me-3">
                        <i class="fas fa-bell"></i>
                    </div>
                    <h3 class="dashboard-section-title">Notifikasi Terbaru</h3>
                </div>
                <a href="<?= base_url('notifikasi') ?>" class="text-decoration-none text-muted small hover-primary">Semua</a>
            </div>
            <div class="card-body p-0">
                <?php if (empty($recentNotifications)): ?>
                    <div class="text-center py-5 text-muted px-4">
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 64px; height: 64px;">
                            <i class="fas fa-bell-slash fs-4 text-secondary"></i>
                        </div>
                        <p class="mb-0">Tidak ada notifikasi baru saat ini.</p>
                    </div>
                <?php else: ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($recentNotifications as $notif): ?>
                            <a href="<?= base_url('notifikasi/read/' . $notif['id']) ?>" class="list-group-item list-group-item-action p-3 border-bottom <?= !$notif['is_read'] ? 'bg-primary bg-opacity-10' : '' ?>">
                                <div class="d-flex w-100 justify-content-between mb-1">
                                    <h6 class="mb-0 fw-bold <?= !$notif['is_read'] ? 'text-primary' : 'text-dark' ?>">
                                        <?= esc($notif['title']) ?>
                                    </h6>
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        <?= \CodeIgniter\I18n\Time::parse($notif['created_at'])->humanize() ?>
                                    </small>
                                </div>
                                <p class="mb-0 text-muted small text-truncate" style="max-width: 90%;">
                                    <?= esc($notif['message']) ?>
                                </p>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize tooltips if bootstrap is available
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        }
    });
</script>

<?= $this->endSection() ?>



