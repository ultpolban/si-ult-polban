<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-bell"></i>

            Notifikasi

        </h3>

        <div class="card-tools">

            <a href="<?= site_url('notifications/read-all') ?>"
                class="btn btn-sm btn-default">

                <i class="fas fa-check-double"></i>

                Tandai Semua Dibaca

            </a>

        </div>

    </div>

    <div class="card-body p-0">

        <div class="list-group list-group-flush">

            <?php if (empty($notificationList)): ?>

                <div class="p-4 text-center text-muted">

                    <i class="fas fa-bell-slash fa-2x mb-2"></i>

                    <p>Tidak ada notifikasi.</p>

                </div>

            <?php else: ?>

                <?php foreach ($notificationList as $n): ?>

                    <a href="<?= site_url('notifications/read/' . $n['id']) ?>"
                        class="list-group-item list-group-item-action <?= $n['is_read'] ? '' : 'font-weight-bold' ?>">

                        <div class="d-flex w-100 justify-content-between">

                            <h6 class="mb-1"><?= esc($n['title']) ?></h6>

                            <small class="text-muted"><?= esc($n['created_at']) ?></small>

                        </div>

                        <p class="mb-1"><?= esc($n['message']) ?></p>

                    </a>

                <?php endforeach; ?>

            <?php endif; ?>

        </div>

    </div>

</div>

<?= $this->endSection() ?>