<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">

    <div>

        <h4 class="mb-0"><?= esc($pageTitle ?? $title ?? 'Manajemen Permintaan Registrasi') ?></h4>

        <small class="text-muted">

            Kelola permintaan izin registrasi calon pengguna.

        </small>

    </div>

</div>

<?= $this->include('components/alert') ?>

<?= $this->include('management/registration-requests/_filter') ?>

<?= $this->include('management/registration-requests/_table') ?>

<?= $this->endSection() ?>

