<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
$status  = strtolower(trim($ticket['status'] ?? ''));
$badge   = [
    'assigned'   => 'bg-warning',
    'processing' => 'bg-info',
    'completed'  => 'bg-success',
    'rejected'   => 'bg-danger',
][$status] ?? 'bg-secondary';
?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

    <div>

        <h2 class="mb-1">Detail Tiket</h2>

        <p class="text-muted mb-0"><?= esc($ticket['ticket_number'] ?? '-') ?></p>

    </div>

    <div>

        <a href="<?= base_url('unit') ?>" class="btn btn-secondary btn-sm">

            <i class="fas fa-arrow-left me-1"></i> Data Tiket

        </a>

        <a
            href="<?= base_url('unit/update-status/' . $ticket['id']) ?>"
            class="btn btn-primary btn-sm">

            <i class="fas fa-sync-alt me-1"></i> Update Status

        </a>

    </div>

</div>

<div class="card mb-3">

    <div class="card-header"><h3 class="card-title">Informasi Tiket</h3></div>

    <div class="card-body">

        <div class="row">

            <?php
            $fields = [
                'Nomor Tiket'  => $ticket['ticket_number'] ?? '-',
                'Layanan'      => $ticket['service_name'] ?? '-',
                'Deskripsi'    => $ticket['description'] ?? '-',
                'Prioritas'    => $ticket['priority'] ?? '-',
                'Diajukan'     => $ticket['submitted_at'] ?? ($ticket['created_at'] ?? '-'),
                'Diproses'     => $ticket['processed_at'] ?? '-',
                'Diselesaikan' => $ticket['completed_at'] ?? '-',
            ];
            ?>

            <?php foreach ($fields as $label => $value): ?>

                <div class="col-md-6 mb-3">

                    <div class="text-muted small"><?= esc($label) ?></div>

                    <div class="fw-semibold"><?= esc($value) ?></div>

                </div>

            <?php endforeach; ?>

            <div class="col-md-6 mb-3">

                <div class="text-muted small">Status</div>

                <span class="badge <?= esc($badge) ?>"><?= esc($status) ?></span>

            </div>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header"><h3 class="card-title">Riwayat Aktivitas</h3></div>

    <div class="card-body">

        <?php if (empty($logs)): ?>

            <div class="alert alert-info mb-0">Belum ada riwayat aktivitas pada tiket ini.</div>

        <?php else: ?>

            <ul class="list-group">

                <?php foreach ($logs as $log): ?>

                    <li class="list-group-item">

                        <div class="fw-semibold"><?= esc($log['activity'] ?? '-') ?></div>

                        <small class="text-muted">

                            <?= esc($log['user_name'] ?? 'Sistem') ?>
                            &mdash; <?= esc($log['created_at'] ?? '-') ?>

                        </small>

                    </li>

                <?php endforeach; ?>

            </ul>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>
