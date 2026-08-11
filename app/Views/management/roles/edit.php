<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form
    action="<?= site_url('roles/update/' . $role['id']) ?>"
    method="post">

    <?= $this->include('management/roles/_form') ?>

</form>

<?= $this->endSection() ?>