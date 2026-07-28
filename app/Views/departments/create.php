<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold text-white mb-1">

            Tambah Jurusan

        </h2>

        <small class="text-white-50">

            Tambahkan jurusan baru ke dalam sistem.

        </small>

    </div>

</div>

<?= view('departments/form') ?>

<?= $this->endSection() ?>