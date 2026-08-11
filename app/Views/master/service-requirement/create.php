<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form
    action="<?= site_url('master/service-requirements/store') ?>"
    method="post">

    <?= $this->include('master/service-requirement/_form') ?>

</form>

<?= $this->endSection() ?>