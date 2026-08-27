<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Tracking Tiket</h3>
            <p class="text-muted mb-0">Cari dan pantau status tiket layanan secara real time.</p>
        </div>
    </div>

    <div class="card card-premium">
        <div class="card-body">
            <form class="row g-3" method="get" action="<?= base_url('tiket/lacak') ?>">
                <div class="col-md-8">
                    <label for="ticketNumber" class="form-label">Nomor Tiket</label>
                    <input type="text" class="form-control" id="ticketNumber" name="ticket_number"
                        value="<?= esc($ticketNumber ?? '') ?>" placeholder="Masukkan nomor tiket..." required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-search mr-2"></i> Cari Tiket
                    </button>
                </div>
            </form>

            <?php if (!empty($ticket)) : ?>
                <?php
                    $statusLabels = [
                        'draft' => 'Draf', 'submitted' => 'Diajukan', 'verification' => 'Verifikasi',
                        'revision' => 'Perlu Revisi', 'processing' => 'Diproses', 'completed' => 'Selesai',
                        'rejected' => 'Ditolak', 'cancelled' => 'Dibatalkan',
                    ];
                    $statusClasses = [
                        'completed' => 'bg-success', 'rejected' => 'bg-danger', 'cancelled' => 'bg-secondary',
                        'processing' => 'bg-primary', 'verification' => 'bg-info text-dark', 'revision' => 'bg-warning text-dark',
                    ];
                    $status = $ticket['status'];
                    $statusLabel = $statusLabels[$status] ?? ucfirst($status);
                    $statusClass = $statusClasses[$status] ?? 'bg-secondary';
                ?>
                <div class="border rounded-3 p-4 mt-4">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                        <div>
                            <div class="text-muted small">Nomor Tiket</div>
                            <h5 class="mb-0"><?= esc($ticket['ticket_number']) ?></h5>
                        </div>
                        <span class="badge <?= $statusClass ?> fs-6"><?= esc($statusLabel) ?></span>
                    </div>
                    <dl class="row mb-0">
                        <dt class="col-sm-3">Layanan</dt><dd class="col-sm-9"><?= esc($ticket['layanan_nama'] ?? '-') ?></dd>
                        <dt class="col-sm-3">Judul</dt><dd class="col-sm-9"><?= esc($ticket['title']) ?></dd>
                        <dt class="col-sm-3">Unit</dt><dd class="col-sm-9"><?= esc($ticket['unit_nama'] ?? '-') ?></dd>
                        <dt class="col-sm-3">Diajukan</dt><dd class="col-sm-9"><?= !empty($ticket['submitted_at']) ? date('d M Y H:i', strtotime($ticket['submitted_at'])) : date('d M Y H:i', strtotime($ticket['created_at'])) ?></dd>
                    </dl>
                    <hr>
                    <h6>Riwayat Status</h6>
                    <ul class="list-group list-group-flush text-start">
                        <?php foreach ($ticket['history'] as $history) : ?>
                            <li class="list-group-item px-0">
                                <strong><?= esc($statusLabels[$history['new_status']] ?? ucfirst($history['new_status'])) ?></strong>
                                <span class="text-muted">— <?= esc($history['description'] ?? $history['action']) ?></span><br>
                                <small class="text-muted"><?= !empty($history['created_at']) ? date('d M Y H:i', strtotime($history['created_at'])) : '-' ?><?= !empty($history['pelaku']) ? ' · ' . esc($history['pelaku']) : '' ?></small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php elseif (!empty($notFound)) : ?>
                <div class="alert alert-warning mt-4 mb-0">Tiket <strong><?= esc($ticketNumber) ?></strong> tidak ditemukan.</div>
            <?php else : ?>
            <div class="mt-4 text-center text-muted">
                <p class="mb-1">Masukkan nomor tiket untuk menampilkan status.</p>
                <p class="small">Contoh: ULT-2024-001</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
