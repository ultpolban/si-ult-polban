<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-4"><h4 class="fw-bold text-dark mb-1"><?= esc($pageTitle ?? 'Tambah Data') ?></h4><p class="text-muted">Silakan isi formulir di bawah ini dengan lengkap.</p></div>

<form action="<?= site_url('master/study-programs/store') ?>" method="post">

    <?= $this->include('master/study-program/_form') ?>

</form>

<?= $this->endSection() ?>

