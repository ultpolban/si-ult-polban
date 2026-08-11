<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h4 class="mb-0"><?= esc($pageTitle ?? $title ?? 'Manajemen User') ?></h4>

        <small class="text-muted">

            Kelola data pengguna sistem.

        </small>

    </div>

    <a href="<?= site_url('users/create') ?>"
        class="btn btn-primary">

        <i class="fas fa-plus-circle"></i>

        Tambah User

    </a>

</div>

<?= $this->include('components/alert') ?>

<?= $this->include('management/users/_filter') ?>

<?= $this->include('management/users/_table') ?>

<?= $this->include('management/users/_modal') ?>

<?= $this->endSection() ?>