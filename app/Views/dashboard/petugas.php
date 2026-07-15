<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<h1>Dashboard Petugas ULT</h1>

<p>Selamat datang <?= session()->get('name') ?></p>

<?= $this->endSection() ?>