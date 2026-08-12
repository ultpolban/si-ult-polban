<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Notifikasi</h3>
            <p class="text-muted mb-0">Informasi dan pemberitahuan untuk akun kamu.</p>
        </div>
        <a href="<?= site_url('notifikasi/read-all') ?>" class="btn btn-outline-primary btn-sm">Tandai semua dibaca</a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <?php if (!empty($notifications)): ?>
                <div class="list-group list-group-flush">
                    <?php foreach ($notifications as $notification): ?>
                        <a href="<?= site_url('notifikasi/read/' . (int) $notification['id']) ?>" class="list-group-item list-group-item-action <?= empty($notification['is_read']) ? 'fw-semibold' : '' ?>">
                            <div class="d-flex justify-content-between gap-3">
                                <div>
                                    <div><?= esc($notification['title'] ?? 'Notifikasi') ?></div>
                                    <div class="small text-muted mt-1"><?= esc($notification['message'] ?? '') ?></div>
                                </div>
                                <small class="text-muted text-nowrap"><?= esc($notification['created_at'] ?? '') ?></small>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="text-center text-muted py-5">Belum ada notifikasi.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
