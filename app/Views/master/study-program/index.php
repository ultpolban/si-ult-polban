<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h4 class="mb-0"><?= esc($pageTitle) ?></h4>

        <small class="text-muted">

            Kelola data master program studi.

        </small>

    </div>

    <a href="<?= site_url('master/study-programs/create') ?>"
        class="btn btn-primary">

        <i class="fas fa-plus"></i>

        Tambah Program Studi

    </a>

</div>

<?= $this->include('components/alert') ?>

<?= $this->include('master/study-program/_filter') ?>

<?= $this->include('master/study-program/_table') ?>

<?= $this->include('master/study-program/_modal') ?>

<?= $this->endSection() ?>