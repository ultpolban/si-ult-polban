<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card shadow">

    <div class="card-header bg-warning d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            Edit User

        </h5>

        <a href="<?= base_url('users') ?>" class="btn btn-dark btn-sm">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>

    <div class="card-body">

        <?php if (session()->getFlashdata('errors')) : ?>

            <div class="alert alert-danger">

                <ul class="mb-0">

                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>

                        <li><?= esc($error) ?></li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>

        <form
            action="<?= base_url('users/update/' . $user['id']) ?>"
            method="post"
            enctype="multipart/form-data">

            <?= csrf_field() ?>

            <?= $this->include('users/form') ?>

            <hr>

            <div class="text-end">

                <a
                    href="<?= base_url('users') ?>"
                    class="btn btn-secondary">

                    Batal

                </a>

                <button
                    type="submit"
                    class="btn btn-warning">

                    <i class="bi bi-pencil-square"></i>

                    Update

                </button>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>