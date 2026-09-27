<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form
    action="<?= site_url('permissions/update/' . $permission['id']) ?>"
    method="post">

    <?= $this->include('management/permissions/_form') ?>

</form>

<?= $this->endSection() ?>