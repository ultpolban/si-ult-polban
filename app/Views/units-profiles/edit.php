<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<form action="<?= site_url('units-profiles/update/' . $profile['id']) ?>" method="post">
<?= $this->include('units-profiles/_form') ?>
</form>
<?= $this->endSection() ?>