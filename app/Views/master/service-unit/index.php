<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h4 class="mb-0"><?= esc($pageTitle) ?></h4>

        <small class="text-muted">
            Kelola data master unit layanan.
        </small>

    </div>

    <a href="<?= site_url('master/service-units/create') ?>"
        class="btn btn-primary">

        <i class="fas fa-plus"></i>

        Tambah Unit Layanan

    </a>

</div>

<?= $this->include('components/alert') ?>

<?= $this->include('master/service-unit/_filter') ?>

<?= $this->include('master/service-unit/_table') ?>

<?= $this->include('master/service-unit/_modal') ?>

<?= $this->endSection() ?>