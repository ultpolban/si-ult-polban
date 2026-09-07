<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header"><h5 class="mb-0">Upload Dokumen Keuangan</h5></div>
    <div class="card-body">
        <p>Tiket: <strong><?= esc($tiket['no_tiket'] ?? '-') ?></strong></p>
        <form method="post" action="<?= base_url('keuangan/simpanUpload/' . (int) ($tiket['id'] ?? 0)) ?>" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="file" name="dokumen" class="form-control mb-3" required>
            <button type="submit" class="btn btn-primary"><i class="fas fa-upload me-1"></i> Upload</button>
            <a href="<?= base_url('keuangan/detail/' . (int) ($tiket['id'] ?? 0)) ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
