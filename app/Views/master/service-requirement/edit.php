<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="mb-4"><h4 class="fw-bold text-dark mb-1"><?= esc($pageTitle ?? 'Edit Data') ?></h4><p class="text-muted">Ubah informasi pada formulir di bawah ini.</p></div>

<form
    action="<?= site_url('master/service-requirements/update/' . $requirement['id']) ?>"
    method="post">

    <?= $this->include('master/service-requirement/_form') ?>

</form>

<?= $this->endSection() ?>

