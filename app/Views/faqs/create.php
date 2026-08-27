<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form
    action="<?= site_url('faqs/store') ?>"
    method="post">

    <?= $this->include('faqs/_form') ?>

</form>

<?= $this->endSection() ?>