<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<h1>Dashboard Pimpinan</h1>

<p>Selamat datang <?= session()->get('name') ?></p>

<?= $this->endSection() ?>