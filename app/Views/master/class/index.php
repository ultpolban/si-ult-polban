<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h4><?= esc($pageTitle) ?></h4>

    </div>

    <a href="<?= site_url('master/classes/create') ?>" class="btn btn-primary">

        <i class="fas fa-plus"></i>

        Tambah Kelas

    </a>

</div>

<?= $this->include('components/alert') ?>

<?= $this->include('master/class/_filter') ?>

<?= $this->include('master/class/_table') ?>

<?= $this->include('master/class/_modal') ?>

<?= $this->endSection() ?>