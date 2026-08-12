<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Manajemen Tiket</h3>
            <p class="text-muted mb-0">Daftar tiket layanan yang masuk</p>
        </div>
    </div>

    <!-- Tiket Table Card -->
    <div class="card card-premium">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-premium">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Kode Tiket</th>
                            <th>Pemohon</th>
                            <th>Layanan</th>
                            <th>Unit</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($tiket as $t): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="font-weight-bold" style="color: #1e2f99; font-family: monospace;">
                                <?= esc($t['kode']) ?>
                            </td>
                            <td><?= esc($t['pemohon']) ?></td>
                            <td><?= esc($t['layanan']) ?></td>
                            <td><?= esc($t['unit']) ?></td>
                            <td><?= esc($t['tanggal']) ?></td>
                            <td>
                                <?php
                                    $badgeClass = 'badge-nonaktif';
                                    if ($t['status'] === 'Selesai')   $badgeClass = 'badge-aktif';
                                    if ($t['status'] === 'Proses')    $badgeClass = 'badge-proses';
                                    if ($t['status'] === 'Menunggu')  $badgeClass = 'badge-menunggu';
                                ?>
                                <span class="status-badge <?= $badgeClass ?>">
                                    <?= esc($t['status']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>

                        <?php if (empty($tiket)): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                Belum ada tiket masuk.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

