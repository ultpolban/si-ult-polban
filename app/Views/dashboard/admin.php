<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <h1>Dashboard Admin</h1>
</div>

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">

            <div class="inner">
                <h3><?= $totalUser ?></h3>
                <p>Total User</p>
            </div>

            <div class="icon">
                <i class="fas fa-users"></i>
            </div>

        </div>
    </div>

</div>

<?= $this->endSection() ?>