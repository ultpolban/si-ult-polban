<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form
    action="<?= site_url('roles/store') ?>"
    method="post">

    <?= $this->include('management/roles/_form') ?>

</form>

<?= $this->endSection() ?>