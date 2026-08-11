<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form action="<?= site_url('master/study-programs/store') ?>" method="post">

    <?= $this->include('master/study-program/_form') ?>

</form>

<?= $this->endSection() ?>