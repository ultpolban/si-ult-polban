<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h4 class="mb-0"><?= esc($pageTitle) ?></h4>

        <small class="text-muted">
            Kelola data master kategori layanan.
        </small>

    </div>

    <a
        href="<?= site_url('master/service-categories/create') ?>"
        class="btn btn-primary">

        <i class="fas fa-plus"></i>

        Tambah Kategori

    </a>

</div>

<?= $this->include('components/alert') ?>

<?= $this->include('master/service-category/_filter') ?>

<?= $this->include('master/service-category/_table') ?>

<?= $this->include('master/service-category/_modal') ?>

<?= $this->endSection() ?>