<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold text-white mb-1">

            Tambah Role

        </h2>

        <small class="text-white-50">

            Tambahkan role baru ke dalam sistem SI-ULT POLBAN.

        </small>

    </div>

</div>

<?= view('roles/form') ?>

<?= $this->endSection() ?>