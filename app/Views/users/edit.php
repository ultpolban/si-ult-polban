<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="row">

        <div class="col-lg-12">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h2 class="fw-bold">

                        Edit User

                    </h2>

                    <p class="text-muted mb-0">

                        Perbarui data pengguna SI-ULT POLBAN.

                    </p>

                </div>

                <a
                    href="<?= base_url('users') ?>"
                    class="btn btn-secondary">

                    <i class="bi bi-arrow-left me-2"></i>

                    Kembali

                </a>

            </div>

        </div>

    </div>

    <?php if (session()->getFlashdata('errors')) : ?>

        <div class="alert alert-danger">

            <ul class="mb-0">

                <?php foreach (session()->getFlashdata('errors') as $error): ?>

                    <li><?= esc($error) ?></li>

                <?php endforeach; ?>

            </ul>

        </div>

    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>

        <div class="alert alert-danger">

            <?= session()->getFlashdata('error') ?>

        </div>

    <?php endif; ?>

    <div class="card shadow-sm">

        <div class="card-body">

            <form
                action="<?= base_url('users/update/' . $user['id']) ?>"
                method="post"
                enctype="multipart/form-data">

                <?= csrf_field() ?>

                <?= $this->include('users/form') ?>

            </form>

        </div>

    </div>

</div>

<?= $this->include('users/partials/script') ?>

<?= $this->endSection() ?>