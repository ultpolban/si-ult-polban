<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-4"><h4 class="fw-bold text-dark mb-1"><?= esc($pageTitle ?? 'Edit Data') ?></h4><p class="text-muted">Ubah informasi pada formulir di bawah ini.</p></div>

<form action="<?= site_url('master/applicant-types/update/' . $applicantType['id']) ?>" method="post">

    <?= $this->include('master/applicant-type/_form') ?>

</form>

<?= $this->endSection() ?>

