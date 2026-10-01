<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
helper('role');

$summary = $summary ?? ['total' => 0, 'pending' => 0, 'processing' => 0, 'completed' => 0, 'rejected' => 0];

$statusLabel = [
    'submitted'    => ['Submitted', 'badge-warning'],
    'verified'     => ['Verified', 'badge-info'],
    'verification' => ['Verifikasi', 'badge-info'],
    'assigned'     => ['Disposisi', 'badge-primary'],
    'processing'   => ['Diproses', 'badge-primary'],
    'completed'    => ['Selesai', 'badge-success'],
    'rejected'     => ['Ditolak', 'badge-danger'],
    'revision'     => ['Revisi', 'badge-secondary'],
];
?>

<div class="content-header mb-3">
    <div class="container-fluid">
        <h1 class="mb-1">
            <i class="fas fa-chart-simple mr-2 text-primary"></i>
            Ringkasan Tiket
        </h1>
        <p class="text-muted mb-0">Rekapitulasi pengajuan layanan per unit dan per jenis pemohon.</p>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-6 mb-3">
        <div class="small-box bg-gradient-navy">
            <div class="inner"><h3><?= (int) ($summary['total'] ?? 0) ?></h3><p>Total Tiket</p></div>
            <div class="icon"><i class="fas fa-ticket-alt"></i></div>
        </div>
    </div>
    <div class="col-lg-4 col-6 mb-3">
        <div class="small-box bg-success">
            <div class="inner"><h3><?= (int) ($summary['completed'] ?? 0) ?></h3><p>Selesai</p></div>
            <div class="icon"><i class="fas fa-check-double"></i></div>
        </div>
    </div>
    <div class="col-lg-4 col-6 mb-3">
        <div class="small-box bg-warning">
            <div class="inner"><h3><?= (int) ($summary['pending'] ?? 0) ?></h3><p>Menunggu</p></div>
            <div class="icon"><i class="fas fa-hourglass-half"></i></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-5 mb-3">
        <div class="card card-outline card-primary h-100">
            <div class="card-header"><h3 class="card-title">Per Unit Layanan</h3></div>
            <div class="card-body table-responsive p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead><tr><th>Unit</th><th class="text-center">Jumlah</th></tr></thead>
                    <tbody>
                        <?php if (empty($statsByUnit)): ?>
                            <tr><td colspan="2" class="text-center text-muted py-4">Belum ada data.</td></tr>
                        <?php else: ?>
                            <?php foreach ($statsByUnit as $ultRow): ?>
                                <tr>
                                    <td><?= esc($ultRow['unit'] ?? '-') ?></td>
                                    <td class="text-center font-weight-bold"><?= (int) ($ultRow['total'] ?? 0) ?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-5 mb-3">
        <div class="card card-outline card-info h-100">
            <div class="card-header"><h3 class="card-title">Per Jenis Pemohon</h3></div>
            <div class="card-body table-responsive p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead><tr><th>Jenis Pemohon</th><th class="text-center">Jumlah</th></tr></thead>
                    <tbody>
                        <?php if (empty($statsByType)): ?>
                            <tr><td colspan="2" class="text-center text-muted py-4">Belum ada data.</td></tr>
                        <?php else: ?>
                            <?php foreach ($statsByType as $ultRow): ?>
                                <tr>
                                    <td><?= esc($ultRow['applicant_type'] ?? '-') ?></td>
                                    <td class="text-center font-weight-bold"><?= (int) ($ultRow['total'] ?? 0) ?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="card card-outline card-primary mb-3">
    <div class="card-header">
        <h3 class="card-title">15 Tiket Terbaru</h3>
        <div class="card-tools">
            <a href="<?= base_url('report') ?>" class="btn btn-sm btn-primary">Laporan Lengkap</a>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-striped mb-0">
            <thead>
                <tr>
                    <th>No</th><th>Nomor Tiket</th><th>Layanan</th><th>Status</th><th>Dibuat</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($latestTickets)): ?>
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada tiket.</td></tr>
                <?php else: ?>
                    <?php $ultNo = 1; ?>
                    <?php foreach ($latestTickets as $ultTicket): ?>
                        <?php
                        $ultStatus = strtolower((string) ($ultTicket['status'] ?? ''));
                        $ultMeta   = $statusLabel[$ultStatus] ?? [ucfirst($ultStatus), 'badge-secondary'];
                        ?>
                        <tr>
                            <td><?= $ultNo++ ?></td>
                            <td class="font-weight-bold"><?= esc($ultTicket['ticket_number'] ?? '-') ?></td>
                            <td><?= esc($ultTicket['service_name'] ?? ($ultTicket['title'] ?? '-')) ?></td>
                            <td><span class="badge <?= esc($ultMeta[1]) ?>"><?= esc($ultMeta[0]) ?></span></td>
                            <td class="text-nowrap"><?= esc($ultTicket['created_at'] ?? '-') ?></td>
                        </tr>
                    <?php endforeach ?>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
