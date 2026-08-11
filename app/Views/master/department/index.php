<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>
        <h4 class="mb-0"><?= esc($pageTitle) ?></h4>
        <small class="text-muted">
            Kelola data master jurusan.
        </small>
    </div>

    <a href="<?= site_url('master/departments/create') ?>"
        class="btn btn-primary">

        <i class="bi bi-plus-circle"></i>

        Tambah Jurusan

    </a>

</div>

<?php if (session()->getFlashdata('success')) : ?>

    <div class="alert alert-success">

        <?= session()->getFlashdata('success') ?>

    </div>

<?php endif; ?>

<?php if (session()->getFlashdata('errors')) : ?>

    <div class="alert alert-danger">

        <ul class="mb-0">

            <?php foreach (session()->getFlashdata('errors') as $error) : ?>

                <li><?= esc($error) ?></li>

            <?php endforeach ?>

        </ul>

    </div>

<?php endif; ?>


<?= $this->include('master/department/_filter') ?>

<?= $this->include('master/department/_table') ?>

<?= $this->include('master/department/_modal') ?>

<?= $this->include('master/department/_script') ?>


<?= $this->endSection() ?>