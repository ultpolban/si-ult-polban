<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form
    action="<?= site_url('users/store') ?>"
    method="post"
    id="userForm">

    <?= $this->include('management/users/_form') ?>

</form>

<?= $this->endSection() ?>
