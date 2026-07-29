<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container mt-4">

    <div class="alert alert-success">

        <h3>Pengajuan Berhasil!</h3>

        <p>Terima kasih, pengajuan Anda berhasil dikirim.</p>

        <h5>Nomor Tiket:</h5>

        <h3 class="text-primary"><?= esc($ticket_number) ?></h3>

        <a href="<?= base_url('online') ?>" class="btn btn-primary mt-3">
            Kembali
        </a>

    </div>

</div>

<?= $this->endSection() ?>