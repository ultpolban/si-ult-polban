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

        <a href="<?= base_url('layanan/upa/perpustakaan') ?>"
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

            📚 UPA Perpustakaan

            <span>></span>

        </a>

        <a href="<?= base_url('layanan/upa/bahasa') ?>"
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

            🌐 UPA Bahasa

            <span>></span>

        </a>

        <a href="<?= base_url('layanan/upa/tik') ?>"
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

            💻 UPA Teknologi Informasi dan Komunikasi

            <span>></span>

        </a>

        <a href="<?= base_url('layanan/upa/karir') ?>"
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

            💼 UPA Pengembangan Karir dan Kewirausahaan

            <span>></span>

        </a>

        <a href="<?= base_url('layanan/upa/perawatan') ?>"
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

            🔧 UPA Perawatan dan Perbaikan

            <span>></span>

        </a>

        <a href="<?= base_url('layanan/upa/uji-kompetensi') ?>"
            class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

            📝 UPA Layanan Uji Kompetensi

            <span>></span>

        </a>

    </div>

</div>

<?= $this->endSection() ?>