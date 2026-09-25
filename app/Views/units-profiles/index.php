<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0"><?= esc($pageTitle) ?></h4>
        <small class="text-muted">Hanya berisi deskripsi lengkap tentang setiap unit layanan.</small>
    </div>
    <a href="<?= site_url('units-profiles/create') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Tambah Deskripsi Unit
    </a>
</div>

<?= $this->include('components/alert') ?>
<?= $this->include('units-profiles/_filter') ?>
<?= $this->include('units-profiles/_table') ?>
<?= $this->include('units-profiles/_modal') ?>

<?= $this->endSection() ?>