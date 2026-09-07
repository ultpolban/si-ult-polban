<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-history me-2 text-primary"></i>Riwayat Tiket Kemahasiswaan</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>No Tiket</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach (($tickets ?? []) as $ticket): ?>
                        <tr>
                            <td><?= esc($ticket['no_tiket'] ?? '-') ?></td>
                            <td><?= esc($ticket['nama_layanan'] ?? '-') ?></td>
                            <td><?= esc($ticket['status'] ?? '-') ?></td>
                            <td><?= esc($ticket['updated_at'] ?? $ticket['created_at'] ?? '-') ?></td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($tickets)): ?>
                        <tr><td colspan="4" class="text-center text-muted">Belum ada riwayat tiket.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
