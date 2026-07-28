<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold text-white">

            Edit Unit Kerja

        </h2>

        <small class="text-white-50">

            Perbarui data unit kerja.

        </small>

    </div>

</div>

<?= view('work-units/form') ?>

<?= $this->endSection() ?>