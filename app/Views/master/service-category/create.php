<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form
    action="<?= site_url('master/service-categories/store') ?>"
    method="post">

    <?= $this->include('master/service-category/_form') ?>

</form>

<?= $this->endSection() ?>