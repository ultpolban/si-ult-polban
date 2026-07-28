<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- ===========================================================
HEADER
=========================================================== -->

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

    <div>

        <h2 class="fw-bold mb-1">

            Tambah User

        </h2>

        <p class="text-muted mb-0">

            Tambahkan data pengguna baru ke dalam Sistem Informasi ULT POLBAN.

        </p>

    </div>

    <a
        href="<?= base_url('users') ?>"
        class="btn btn-secondary">

        <i class="bi bi-arrow-left me-2"></i>

        Kembali

    </a>

</div>

<!-- ===========================================================
VALIDATION ERROR
=========================================================== -->

<?php if (session()->getFlashdata('errors')) : ?>

    <div class="alert alert-danger">

        <h6 class="fw-bold">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            Terjadi Kesalahan

        </h6>

        <ul class="mb-0">

            <?php foreach (session()->getFlashdata('errors') as $error): ?>

                <li><?= esc($error) ?></li>

            <?php endforeach; ?>

        </ul>

    </div>

<?php endif; ?>

<!-- ===========================================================
FORM
=========================================================== -->

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            Form Tambah User

        </h5>

    </div>

    <div class="card-body">

        <form
            action="<?= base_url('users/store') ?>"
            method="post"
            enctype="multipart/form-data">

            <?= csrf_field() ?>

            <!-- ===========================================================
            FORM USER
            =========================================================== -->

            <?= $this->include('users/form') ?>

        </form>

    </div>

</div>

<?= $this->include('users/partials/script') ?>

<?= $this->endSection() ?>