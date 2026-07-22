<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-lg-10">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    <h3 class="mb-0">
                        Registrasi Pemohon SI-ULT POLBAN
                    </h3>

                </div>

                <div class="card-body">

                    <?php if (session()->getFlashdata('errors')) : ?>

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                <?php foreach (session()->getFlashdata('errors') as $error): ?>

                                    <li><?= esc($error) ?></li>

                                <?php endforeach; ?>

                            </ul>

                        </div>

                    <?php endif; ?>

                    <form
                        action="<?= base_url('register') ?>"
                        method="post"
                        enctype="multipart/form-data">

                        <?= csrf_field() ?>

                        <?= $this->include('auth/register/account') ?>

                        <?= $this->include('auth/register/personal') ?>

                        <?= $this->include('auth/register/mahasiswa') ?>

                        <?= $this->include('auth/register/dosen') ?>

                        <?= $this->include('auth/register/tendik') ?>

                        <?= $this->include('auth/register/alumni') ?>

                        <?= $this->include('auth/register/orangtua') ?>

                        <?= $this->include('auth/register/mitra') ?>

                        <?= $this->include('auth/register/publik') ?>

                        <div class="text-end mt-4">

                            <a
                                href="<?= base_url('login') ?>"
                                class="btn btn-secondary">

                                Kembali

                            </a>

                            <button
                                class="btn btn-primary"
                                type="submit">

                                Registrasi

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->include('auth/register/script') ?>

<?= $this->endSection() ?>