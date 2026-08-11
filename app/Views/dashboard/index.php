<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="mb-4">

        <h3 class="fw-bold">

            Dashboard

        </h3>

        <p class="text-muted">

            Selamat datang,
            <strong><?= esc($user['full_name'] ?? session('full_name') ?? 'User') ?></strong>

        </p>

    </div>

    <div class="row">

        <div class="col-md-3 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6 class="text-muted">

                        Total User

                    </h6>

                    <h2>

                        <?= esc($totalUsers) ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6 class="text-muted">

                        Total Layanan

                    </h6>

                    <h2>

                        <?= esc($totalServices) ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6 class="text-muted">

                        Total Pengajuan

                    </h6>

                    <h2>

                        <?= esc($totalRequests) ?>

                    </h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card shadow-sm border-0">

                <div class="card-body">

                    <h6 class="text-muted">

                        Menunggu Approval

                    </h6>

                    <h2>

                        <?= esc($pendingRequests) ?>

                    </h2>

                </div>

            </div>

        </div>

    </div>

    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <h5 class="mb-0">

                Notifikasi Terbaru

            </h5>

        </div>

        <div class="card-body">

            <?php if (!empty($notifications)): ?>

                <div class="list-group">

                    <?php foreach ($notifications as $notif): ?>

                        <div class="list-group-item">

                            <h6>

                                <?= esc($notif['title']) ?>

                            </h6>

                            <p class="mb-0 text-muted">

                                <?= esc($notif['message']) ?>

                            </p>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php else: ?>

                <div class="text-center text-muted py-4">

                    Belum ada notifikasi.

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>

<?= $this->endSection() ?>