<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="text-center py-5">

    <div class="mb-3">
        <i class="fas fa-ban text-danger" style="font-size:4rem;"></i>
    </div>

    <h3 class="mb-2">Akses Ditolak</h3>

    <p class="text-muted">
        Anda tidak memiliki hak akses untuk membuka halaman ini.
    </p>

    <a href="<?= site_url('dashboard') ?>"
        class="btn btn-primary mt-2">

        <i class="fas fa-home"></i>

        Kembali ke Dashboard

    </a>

</div>

<?= $this->endSection() ?>