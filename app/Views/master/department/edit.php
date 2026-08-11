<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

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