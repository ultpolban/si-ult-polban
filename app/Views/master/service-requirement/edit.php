<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form
    action="<?= site_url('master/service-requirements/update/' . $requirement['id']) ?>"
    method="post">

    <?= $this->include('master/service-requirement/_form') ?>

</form>

<?= $this->endSection() ?>