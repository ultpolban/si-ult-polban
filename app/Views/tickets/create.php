<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0"><?= esc($pageTitle) ?></h4><small class="text-muted">Buat tiket layanan baru.</small>
    </div>
    <a href="<?= site_url('tickets') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
</div>
<?= $this->include('components/alert') ?>
<div class="card">
    <div class="card-body">
        <form action="<?= site_url('tickets/store') ?>" method="post">
            <?= csrf_field() ?>
            <?= $this->include('tickets/_form') ?>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="<?= site_url('tickets') ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>