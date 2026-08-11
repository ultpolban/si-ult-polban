<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form action="<?= site_url('master/classes/update/' . $class['id']) ?>" method="post">

    <?= $this->include('master/class/_form') ?>

</form>

<?= $this->endSection() ?>