<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form
    action="<?= site_url('master/services/update/' . $service['id']) ?>"
    method="post">

    <?= $this->include('master/service/_form') ?>

</form>

<?= $this->endSection() ?>