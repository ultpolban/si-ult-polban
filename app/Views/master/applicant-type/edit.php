<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<form action="<?= site_url('master/applicant-types/update/' . $applicantType['id']) ?>" method="post">

    <?= $this->include('master/applicant-type/_form') ?>

</form>

<?= $this->endSection() ?>