<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold text-white mb-1">

            Edit Jenis Pemohon

        </h2>

        <small class="text-white-50">

            Perbarui data jenis pemohon.

        </small>

    </div>

</div>

<?= view('user-types/form') ?>

<?= $this->endSection() ?>