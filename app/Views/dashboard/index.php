<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0">Dashboard</h4>
        <small class="text-muted">
            Selamat datang kembali, <strong><?= esc($user['full_name'] ?? session('full_name') ?? 'User') ?></strong>.
        </small>
    </div>
    <span class="badge bg-light border text-dark">
        <i class="fas fa-sync-alt me-1"></i>Data otomatis diperbarui
    </span>
</div>

<div class="row g-3 mb-4">

    <?php if (!empty($totalUsers)): ?>
        <div class="col-xl col-md-6 col-12">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 p-3 me-3 bg-primary bg-opacity-10 text-primary">
                        <i class="fas fa-users fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small">Total User</div>
                        <div class="fs-4 fw-bold"><?= (int) $totalUsers ?></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="col-xl col-md-6 col-12">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-body d-flex align-items-center">
                <div class="rounded-3 p-3 me-3 bg-success bg-opacity-10 text-success">
                    <i class="fas fa-server fs-4"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Layanan</div>
                    <div class="fs-4 fw-bold"><?= (int) $totalServices ?></div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $stateCards = [
        'total'      => ['icon' => 'fa-ticket-alt', 'color' => 'primary', 'value' => $totalRequests],
        'pending'    => ['icon' => 'fa-clock',      'color' => 'warning', 'value' => $pendingRequests],
        'processing' => ['icon' => 'fa-cogs',       'color' => 'info',    'value' => $processingRequests],
        'completed'  => ['icon' => 'fa-check',      'color' => 'success', 'value' => $completedRequests],
        'rejected'   => ['icon' => 'fa-times',      'color' => 'danger',  'value' => $rejectedRequests],
    ];

    foreach ($stateCards as $key => $card): ?>
        <div class="col-xl-2 col-md-6 col-12">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-3 p-3 me-3 bg-<?= $card['color'] ?> bg-opacity-10 text-<?= $card['color'] ?>">
                        <i class="fas <?= $card['icon'] ?> fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small"><?= ticket_state_label($key) ?></div>
                        <div class="fs-4 fw-bold rt-value" data-rt-key="<?= $key ?>"><?= (int) $card['value'] ?></div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>

    <div class="row g-3">

    <div class="col-lg-8">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0">
                    <i class="fas fa-list me-2 text-primary"></i>
                    <?= $roleCode === 'PEMOHON' ? 'Pengajuan Saya' : 'Pengajuan Terbaru' ?>
                </h6>
                <a href="<?= site_url('tracking') ?>" class="btn btn-sm btn-outline-primary">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No. Tiket</th>
                                <th>Layanan / Judul</th>
                                <th>Pemohon</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="rt-latest-tickets">
                            <?php if (empty($latestTickets)): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Belum ada pengajuan.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($latestTickets as $t): ?>
                                    <tr>
                                        <td>
                                            <a href="<?= site_url('tracking/show/' . (int) $t['id']) ?>" class="fw-semibold text-decoration-none">
                                                <?= esc($t['ticket_number']) ?>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="fw-semibold"><?= esc($t['title']) ?></div>
                                            <small class="text-muted"><?= esc($t['service_name'] ?? '-') ?></small>
                                        </td>
                                        <td><?= esc($t['applicant_name'] ?? '-') ?></td>
                                        <td><?= ticket_status_badge($t['status'] ?? '') ?></td>
                                        <td class="text-end">
                                            <a href="<?= site_url('tracking/show/' . (int) $t['id']) ?>" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye"></i>
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
    </div>

    <div class="col-lg-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white">
                <h6 class="mb-0">
                    <i class="fas fa-bell me-2 text-warning"></i>
                    Notifikasi Terbaru
                </h6>
            </div>
            <div class="card-body">
                <?php if (empty($notifications)): ?>
                    <div class="text-center text-muted py-4">
                        <i class="far fa-bell-slash fs-3 mb-2 d-block"></i>
                        Tidak ada notifikasi baru.
                    </div>
                <?php else: ?>
                    <?php $nCount = 0; ?>
                    <?php foreach ($notifications as $notif): ?>
                        <?php if ($nCount >= 5) { break; } $nCount++; ?>
                        <a href="<?= !empty($notif['url']) ? esc($notif['url']) : site_url('notifications') ?>" class="d-block text-decoration-none mb-2">
                            <div class="border rounded p-2">
                                <div class="d-flex justify-content-between">
                                    <strong class="small"><?= esc($notif['title']) ?></strong>
                                    <small class="text-muted text-nowrap ms-2">
                                        <?= esc(date('d/m H:i', strtotime($notif['created_at'] ?? 'now'))) ?>
                                    </small>
                                </div>
                                <div class="small text-muted text-truncate"><?= esc($notif['message']) ?></div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                    <a href="<?= site_url('notifications') ?>" class="btn btn-sm btn-outline-secondary w-100 mt-1">
                        Lihat Semua Notifikasi
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>