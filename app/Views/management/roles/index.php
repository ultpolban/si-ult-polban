<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h4 class="mb-0"><?= esc($pageTitle) ?></h4>

        <small class="text-muted">

            Kelola data role pengguna.

        </small>

    </div>

    <a href="<?= site_url('roles/create') ?>"
        class="btn btn-primary">

        <i class="fas fa-plus-circle"></i>

        Tambah Role

    </a>

</div>

<?= $this->include('components/alert') ?>

<?= $this->include('management/roles/_filter') ?>

<?= $this->include('management/roles/_table') ?>

<?= $this->include('management/roles/_modal') ?>

<?= $this->endSection() ?>