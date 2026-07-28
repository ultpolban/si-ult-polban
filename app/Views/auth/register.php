<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-xl-10">

            <div class="card shadow border-0">

                <div class="card-header bg-primary text-white">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <h4 class="mb-1">

                                <i class="bi bi-person-plus-fill"></i>

                                Registrasi Pemohon

                            </h4>

                            <small>

                                Silakan lengkapi seluruh data sesuai jenis pemohon.

                            </small>

                        </div>

                    </div>

                </div>

                <div class="card-body">

                    <?php if (session()->getFlashdata('error')) : ?>

                        <div class="alert alert-danger">

                            <?= session()->getFlashdata('error') ?>

                        </div>

                    <?php endif; ?>

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
                        action="<?= base_url('register/store') ?>"
                        method="post"
                        enctype="multipart/form-data">

                        <?= csrf_field() ?>

                        <!-- ================================================= -->
                        <!-- DATA AKUN -->
                        <!-- ================================================= -->

                        <?= $this->include('auth/partials/account') ?>

                        <!-- ================================================= -->
                        <!-- DATA PRIBADI -->
                        <!-- ================================================= -->

                        <?= $this->include('auth/partials/personal') ?>

                        <!-- ================================================= -->
                        <!-- DATA KHUSUS PEMOHON -->
                        <!-- ================================================= -->

                        <?= $this->include('auth/partials/mahasiswa') ?>

                        <?= $this->include('auth/partials/dosen') ?>

                        <?= $this->include('auth/partials/tendik') ?>

                        <?= $this->include('auth/partials/alumni') ?>

                        <?= $this->include('auth/partials/orangtua') ?>

                        <?= $this->include('auth/partials/mitra') ?>

                        <?= $this->include('auth/partials/publik') ?>

                        <!-- ================================================= -->
                        <!-- BUTTON -->
                        <!-- ================================================= -->

                        <div class="card border-0 bg-light mt-4">

                            <div class="card-body">

                                <div class="d-flex justify-content-end gap-2">

                                    <a
                                        href="<?= base_url('login') ?>"
                                        class="btn btn-secondary">

                                        <i class="bi bi-arrow-left"></i>

                                        Kembali

                                    </a>

                                    <button
                                        type="reset"
                                        class="btn btn-warning">

                                        <i class="bi bi-arrow-clockwise"></i>

                                        Reset

                                    </button>

                                    <button
                                        type="submit"
                                        class="btn btn-primary">

                                        <i class="bi bi-check-circle-fill"></i>

                                        Daftar

                                    </button>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>


<?= $this->section('script') ?>

<?= $this->include('auth/partials/script') ?>

<?= $this->endSection() ?>