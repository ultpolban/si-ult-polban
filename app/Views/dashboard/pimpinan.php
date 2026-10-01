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

<?php
$ultPageTitle    = 'Dashboard Pimpinan';
$ultPageIcon     = 'fa-user-check';
$ultPageSubtitle = 'Pemantauan dan monitoring layanan Unit Layanan Terpadu POLBAN.';
$ultBreadcrumb   = ['Beranda', 'Pimpinan', 'Dashboard'];

ob_start();
?>
    <a href="<?= base_url('report') ?>" class="btn btn-primary">
        <i class="fas fa-file-invoice me-1"></i> Laporan Tiket
    </a>
    <a href="<?= base_url('statistics') ?>" class="btn btn-outline-primary">
        <i class="fas fa-chart-pie me-1"></i> Statistik
    </a>
<?php
$ultPageActions = ob_get_clean();
?>

<?= view('layouts/page_header', [
    'ultPageTitle'    => $ultPageTitle,
    'ultPageIcon'     => $ultPageIcon,
    'ultPageSubtitle' => $ultPageSubtitle,
    'ultBreadcrumb'   => $ultBreadcrumb,
    'ultPageActions'  => $ultPageActions,
]) ?>

<div class="row"><div class="col-lg-4 col-6 mb-3">
        <div class="small-box bg-gradient-navy">
            <div class="inner">
                <h3><?= (int) ($summary['total'] ?? 0) ?></h3>
                <p>Total Tiket</p>
            </div>
            <div class="icon"><i class="fas fa-ticket-alt"></i></div>
        </div>
    </div>

    <div class="col-lg-4 col-6 mb-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= (int) ($summary['pending'] ?? 0) ?></h3>
                <p>Menunggu Verifikasi</p>
            </div>
            <div class="icon"><i class="fas fa-hourglass-half"></i></div>
        </div>
    </div>

    <div class="col-lg-4 col-6 mb-3">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= (int) ($summary['processing'] ?? 0) ?></h3>
                <p>Sedang Diproses</p>
            </div>
            <div class="icon"><i class="fas fa-spinner"></i></div>
        </div>
    </div>

    <div class="col-lg-4 col-6 mb-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= (int) ($summary['completed'] ?? 0) ?></h3>
                <p>Selesai</p>
            </div>
            <div class="icon"><i class="fas fa-check-double"></i></div>
        </div>
    </div>

    <div class="col-lg-4 col-6 mb-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= (int) ($summary['rejected'] ?? 0) ?></h3>
                <p>Ditolak</p>
            </div>
            <div class="icon"><i class="fas fa-times-circle"></i></div>
        </div>
    </div>

    <div class="col-lg-4 col-6 mb-3">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3><?= count($statsByMonth ?? []) ?></h3>
                <p>Bulan Aktif</p>
            </div>
            <div class="icon"><i class="fas fa-calendar-alt"></i></div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-6 mb-3">
        <div class="card card-outline card-primary h-100">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-column mr-1"></i> Pengajuan per Unit</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Unit Layanan</th>
                            <th class="text-center">Jumlah</th>
                        </tr>
                    </thead>
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

    <div class="col-lg-6 mb-3">
        <div class="card card-outline card-info h-100">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-1"></i> Tiket per Status</h3>
            </div>
            <div class="card-body">
                <?php if (empty($statsByStatus)): ?>
                    <p class="text-center text-muted py-4 mb-0">Belum ada data tiket.</p>
                <?php else: ?>
                    <?php $ultMax = max(array_map(static fn ($r) => (int) ($r['total'] ?? 0), $statsByStatus)); ?>
                    <?php foreach ($statsByStatus as $ultRow): ?>
                        <?php
                        $ultStatus = strtolower((string) ($ultRow['status'] ?? ''));
                        $ultMeta   = $statusLabel[$ultStatus] ?? [ucfirst($ultStatus), 'badge-secondary'];
                        $ultTotal  = (int) ($ultRow['total'] ?? 0);
                        $ultPct    = $ultMax > 0 ? round($ultTotal / $ultMax * 100) : 0;
                        ?>
                        <div class="mb-2">
                            <div class="d-flex justify-content-between small mb-1">
                                <span class="badge <?= esc($ultMeta[1]) ?>"><?= esc($ultMeta[0]) ?></span>
                                <span class="font-weight-bold"><?= $ultTotal ?></span>
                            </div>
                            <div class="progress" style="height:8px;">
                                <div class="progress-bar bg-info" style="width:<?= $ultPct ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
