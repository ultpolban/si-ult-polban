<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h4><?= esc($pageTitle) ?></h4>

        <small class="text-muted">
            Kelola data permission sistem.
        </small>

    </div>

    <a href="<?= site_url('permissions/create') ?>"
        class="btn btn-primary">

        <i class="fas fa-plus-circle"></i>

        Tambah Permission

    </a>

</div>

<?= $this->include('components/alert') ?>

<?= $this->include('management/permissions/_filter') ?>

<?= $this->include('management/permissions/_table') ?>

<?= $this->include('management/permissions/_modal') ?>

<?= $this->endSection() ?>