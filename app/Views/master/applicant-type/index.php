<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">

    <div>

        <h4 class="mb-0"><?= esc($pageTitle) ?></h4>

        <small class="text-muted">
            Kelola data master jenis pemohon.
        </small>

    </div>

    <a href="<?= site_url('master/applicant-types/create') ?>"
        class="btn btn-primary shadow-sm px-4 rounded-pill">

        <i class="fas fa-plus"></i>

        Tambah Jenis Pemohon

    </a>

</div>

<?= $this->include('components/alert') ?>

<?= $this->include('master/applicant-type/_filter') ?>

<?= $this->include('master/applicant-type/_table') ?>

<?= $this->include('master/applicant-type/_modal') ?>

<?= $this->endSection() ?>
