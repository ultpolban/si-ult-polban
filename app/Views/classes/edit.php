<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <h2>Tambah Kelas</h2>

    <a href="<?= base_url('classes') ?>" class="btn btn-secondary">

        Kembali

    </a>

</div>

<form action="<?= base_url('classes/update/'.$class['id']) ?>" method="post">

    <?= csrf_field() ?>

    <?= $this->include('classes/form') ?>

    <div class="mt-4">

        <button class="btn btn-primary">

            Simpan

        </button>

    </div>

</form>

<?= $this->endSection() ?>