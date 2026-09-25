<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="mb-4"><h4 class="fw-bold text-dark mb-1"><?= esc($pageTitle ?? 'Edit Data') ?></h4><p class="text-muted">Ubah informasi pada formulir di bawah ini.</p></div>
<div class="row">

    <div class="col-lg-12">

        <form
            action="<?= site_url('master/departments/update/' . $department['id']) ?>"
            method="post"
            autocomplete="off">

            <?= $this->include('master/department/_form') ?>

        </form>

    </div>

</div>

<?= $this->endSection() ?>
