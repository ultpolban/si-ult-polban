<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h4 class="mb-0"><?= esc($pageTitle) ?></h4>

        <small class="text-muted">

            Kelola persyaratan setiap layanan.

        </small>

    </div>

    <a href="<?= site_url('master/service-requirements/create') ?>"
        class="btn btn-primary">

        <i class="fas fa-plus"></i>

        Tambah Persyaratan

    </a>

</div>

<?= $this->include('components/alert') ?>

<?= $this->include('master/service-requirement/_filter') ?>

<?= $this->include('master/service-requirement/_table') ?>

<?= $this->include('master/service-requirement/_modal') ?>

<?= $this->endSection() ?>