<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<div class="container py-5">

    <h2 class="fw-bold mb-2">
        Unit Penunjang Akademik (UPA)
    </h2>

    <p class="text-muted mb-4">
        Pilih unit yang sesuai dengan layanan yang Anda butuhkan.
    </p>

    <div class="list-group shadow-sm">

        <a href="<?= base_url('layanan/upa/tik') ?>"
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

            💻 UPT Teknologi Informasi dan Komunikasi

            <span>></span>

        </a>

    </div>

</div>

<?= $this->endSection() ?>