<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold text-white">

            Tambah Program Studi

        </h2>

        <small class="text-white-50">

            Tambahkan program studi baru.

        </small>

    </div>

</div>

<?= view('study-programs/form') ?>

<?= $this->endSection() ?>