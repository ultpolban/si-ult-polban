<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

    <div>

        <h2 class="mb-1">Log Aktivitas Unit</h2>

        <p class="text-muted mb-0">Riwayat aktivitas terakhir pada tiket unit layanan.</p>

    </div>

    <div class="d-flex gap-2">

        <a href="<?= base_url('unit/dashboard') ?>" class="btn btn-secondary btn-sm">

            <i class="fas fa-tachometer-alt me-1"></i> Dashboard Unit

        </a>

        <a href="<?= base_url('unit') ?>" class="btn btn-primary btn-sm">

            <i class="fas fa-arrow-left me-1"></i> Kembali ke Data Tiket

        </a>

    </div>

</div>

<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>

<?php endif; ?>

<div class="card mb-3">

    <div class="card-header"><h3 class="card-title">Filter Log</h3></div>

    <div class="card-body">

        <form method="get" action="<?= base_url('unit/log-aktivitas') ?>" class="row g-3 align-items-end">

            <div class="col-md-6">

                <label class="form-label">Kata Kunci</label>

                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Cari aktivitas, nomor tiket, atau petugas..."
                    value="<?= esc($keyword) ?>">

            </div>

            <div class="col-md-3">

                <label class="form-label">Jumlah Data</label>

                <select name="limit" class="form-control">

                    <?php foreach ([25, 50, 100, 250] as $n): ?>

                        <option value="<?= $n ?>" <?= $limit === $n ? 'selected' : '' ?>>
                            <?= $n ?> data
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="col-md-3">

                <button type="submit" class="btn btn-primary w-100">

                    <i class="fas fa-filter me-1"></i> Terapkan

                </button>

            </div>

        </form>

    </div>

</div>

<?php
$labelStatus = [
    'assigned'   => ['Menunggu', 'bg-warning'],
    'processing' => ['Diproses', 'bg-info'],
    'completed'  => ['Selesai', 'bg-success'],
    'rejected'   => ['Ditolak', 'bg-danger'],
];
?>

<div class="card">

    <div class="card-header"><h3 class="card-title">Riwayat Aktivitas</h3></div>

    <div class="card-body">

        <?php if (empty($rows)): ?>

            <div class="alert alert-info mb-0">

                <i class="fas fa-info-circle me-2"></i> Belum ada aktivitas tercatat.

            </div>

        <?php else: ?>

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">

                        <tr>

                            <th style="width: 170px;">Waktu</th>

                            <th style="width: 180px;">No Tiket</th>

                            <th>Layanan</th>

                            <th>Aktivitas</th>

                            <th style="width: 180px;">Petugas</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php foreach ($rows as $row): ?>

                        <?php
                        $status = strtolower(trim((string) ($row['ticket_status'] ?? '')));
                        $badge  = $labelStatus[$status][1] ?? 'bg-secondary';
                        $label  = $labelStatus[$status][0] ?? ucfirst($status);
                        ?>

                        <tr>

                            <td><?= esc($row['created_at'] ?? '-') ?></td>

                            <td>

                                <?php if (! empty($row['ticket_id'])): ?>

                                    <a href="<?= base_url('unit/detail/' . (int) $row['ticket_id']) ?>">
                                        <?= esc($row['ticket_number'] ?? '-') ?>
                                    </a>

                                    <span class="badge <?= esc($badge) ?> mt-1">
                                        <?= esc($label) ?>
                                    </span>

                                <?php else: ?>

                                    -

                                <?php endif; ?>

                            </td>

                            <td><?= esc($row['service_name'] ?? '-') ?></td>

                            <td><?= esc($row['activity'] ?? '-') ?></td>

                            <td><?= esc($row['user_name'] ?? '-') ?></td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>
