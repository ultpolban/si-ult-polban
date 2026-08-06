<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="dashboard-title mb-1">
            Dashboard Keuangan
        </h2>
        <p class="dashboard-subtitle">
            Selamat datang,
            <strong><?= session()->get('name') ?></strong>
            👋
        </p>
    </div>
    <div class="text-end">
        <span class="badge bg-primary px-3 py-2">
            <i class="fas fa-calendar-alt me-1"></i>
            <?= date('d M Y') ?>
        </span>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card bg-primary">
            <h2><?= $total ?></h2>
            <p>Total Tiket</p>
            <i class="fas fa-ticket-alt"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card bg-warning">
            <h2><?= $menunggu ?></h2>
            <p>Menunggu</p>
            <i class="fas fa-hourglass-half"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card bg-info">
            <h2><?= $diproses ?></h2>
            <p>Diproses</p>
            <i class="fas fa-spinner"></i>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card bg-success">
            <h2><?= $selesai ?></h2>
            <p>Selesai</p>
            <i class="fas fa-check-circle"></i>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">
            <i class="fas fa-list me-2 text-primary"></i>
            Tiket Terbaru
        </h5>
        <span class="badge bg-secondary">
            <?= count($tiket ?? []) ?> Tiket
        </span>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th>No Tiket</th>
                        <th>Nama Pengaju</th>
                        <th>NIK</th>
                        <th>Jenis Layanan</th>
                        <th>Unit Layanan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th width="130">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($tiket)): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                <i class="fas fa-folder-open fa-2x mb-2"></i><br>
                                Belum ada data tiket.
                            </td>
                        </tr>
                    <?php endif; ?>

                    <?php foreach (($tiket ?? []) as $t): ?>
                        <?php
                        $badge = 'secondary';
                        if (($t['status'] ?? '') === 'Menunggu') {
                            $badge = 'warning';
                        } elseif (($t['status'] ?? '') === 'Diproses') {
                            $badge = 'primary';
                        } elseif (($t['status'] ?? '') === 'Selesai') {
                            $badge = 'success';
                        } elseif (($t['status'] ?? '') === 'Ditolak') {
                            $badge = 'danger';
                        }
                        ?>

                        <tr>
                            <td><strong><?= $t['no_tiket'] ?? '-' ?></strong></td>
                            <td><?= $t['nama_pemohon'] ?? '-' ?></td>
                            <td><?= $t['nim'] ?? '-' ?></td>
                            <td><?= $t['nama_layanan'] ?? '-' ?></td>
                            <td><?= $t['nama_unit'] ?? '-' ?></td>
                            <td><?= !empty($t['created_at']) ? date('d-m-Y', strtotime($t['created_at'])) : '-' ?></td>
                            <td><span class="badge bg-<?= $badge ?>"><?= $t['status'] ?? '-' ?></span></td>
                            <td>
<a href="<?= base_url('keuangan/detail/' . ($t['id'] ?? 0)) ?>" 
class="btn btn-primary btn-sm">

<i class="fas fa-eye"></i> Detail

</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
