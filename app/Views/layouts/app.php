<?= $this->extend('layouts/index'); // <-- Ganti 'index' sesuai dengan nama file layout utama kamu (misal: 'app', 'template', atau 'index') ?>

<?= $this->section('content'); ?>

<!-- Header Halaman -->
<div class="content-header p-0 mb-3">
    <div class="container-fluid pl-0">
        <h1 class="m-0 text-dark font-weight-bold">Riwayat Log Sistem</h1>
        <p class="text-muted text-sm">Pantau seluruh rekam jejak aktivitas dan riwayat transaksi sistem.</p>
    </div>
</div>

<!-- Ringkasan Statistik -->
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $totalLog ?? 25 ?></h3>
                <p>Total Log Aktivitas</p>
            </div>
            <div class="icon"><i class="fas fa-history"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner text-white">
                <h3><?= $disposisi ?? 12 ?></h3>
                <p>Disposisi Tiket</p>
            </div>
            <div class="icon"><i class="fas fa-share"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $verifikasi ?? 8 ?></h3>
                <p>Verifikasi Berkas</p>
            </div>
            <div class="icon"><i class="fas fa-check-circle"></i></div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3><?= $lainnya ?? 5 ?></h3>
                <p>Aktivitas Lainnya</p>
            </div>
            <div class="icon"><i class="fas fa-cog"></i></div>
        </div>
    </div>
</div>

<!-- Tabel Log Aktivitas -->
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title font-weight-bold"><i class="fas fa-list mr-1"></i> Data Log Aktivitas</h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead class="thead-dark">
                <tr>
                    <th>Waktu</th>
                    <th>Petugas / Aktor</th>
                    <th>Aktivitas</th>
                    <th>Objek Tiket</th>
                    <th>Rincian Detail</th>
                    <th class="text-right">IP Address</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($logs)): ?>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td>
                                <strong><?= esc($log['waktu']) ?></strong><br>
                                <small class="text-muted"><i class="far fa-clock"></i> <?= esc($log['jam']) ?></small>
                            </td>
                            <td>
                                <strong><?= esc($log['aktor']) ?></strong><br>
                                <small class="text-muted"><?= esc($log['nip']) ?></small>
                            </td>
                            <td>
                                <span class="badge badge-warning p-2"><?= esc($log['aktivitas']) ?></span>
                            </td>
                            <td><strong class="text-primary"><?= esc($log['objek_tiket']) ?></strong></td>
                            <td>
                                <?= $log['detail'] ?>
                                <?php if (!empty($log['priority'])): ?>
                                    <span class="badge badge-danger"><?= esc($log['priority']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-right"><code><?= esc($log['ip_address']) ?></code></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada aktivitas tercatat.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection(); ?>