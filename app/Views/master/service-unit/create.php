<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form action="<?= site_url('master/service-units/store') ?>" method="post">

    <?= $this->include('master/service-unit/_form') ?>

</form>

<?= $this->endSection() ?>