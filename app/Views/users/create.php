<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card shadow">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h4 class="mb-0">

            Tambah User

        </h4>

        <a href="<?= base_url('users') ?>" class="btn btn-secondary">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>

    <div class="card-body">

        <?php if (session()->getFlashdata('errors')): ?>

            <div class="alert alert-danger">

                <ul class="mb-0">

                    <?php foreach (session()->getFlashdata('errors') as $error): ?>

                        <li><?= esc($error) ?></li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>

        <form
            action="<?= base_url('users/store') ?>"
            method="post"
            enctype="multipart/form-data">

            <?= csrf_field() ?>

            <!-- ACCOUNT -->

            <?= $this->include('users/partials/account') ?>

            <!-- PERSONAL -->

            <?= $this->include('users/partials/personal') ?>

            <!-- ROLE -->

            <?= $this->include('users/partials/petugas') ?>

            <?= $this->include('users/partials/unit_tujuan') ?>

            <?= $this->include('users/partials/pimpinan') ?>

            <!-- PEMOHON -->

            <?= $this->include('users/partials/mahasiswa') ?>

            <?= $this->include('users/partials/dosen') ?>

            <?= $this->include('users/partials/alumni') ?>

            <?= $this->include('users/partials/orangtua') ?>

            <?= $this->include('users/partials/mitra') ?>

            <?= $this->include('users/partials/publik') ?>

            <!-- BUTTON -->

            <?= $this->include('users/partials/button') ?>

        </form>

    </div>

</div>

<?= $this->include('users/partials/script') ?>

<?= $this->endSection() ?>