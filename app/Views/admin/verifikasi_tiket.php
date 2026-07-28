<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Verifikasi Tiket</h3>
            <p class="text-muted mb-0">Tinjau tiket yang perlu diverifikasi dan lanjutkan proses layanan.</p>
        </div>
    </div>

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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($tiket as $t): ?>
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
                                    <span class="status-badge badge-menunggu">
                                        <?= esc($t['status']) ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary"><?= esc($t['aksi']) ?></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>