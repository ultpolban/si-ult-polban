<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-shield-plus text-primary"></i>

                Tambah Role

            </h2>

            <p class="text-muted mb-0">

                Tambahkan role baru untuk pengguna SI-ULT POLBAN.

            </p>

        </div>

        <a
            href="<?= base_url('roles') ?>"
            class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left-circle"></i>

            Kembali

        </a>

    </div>


    <?php if (session()->getFlashdata('errors')) : ?>

        <div class="alert alert-danger alert-dismissible fade show shadow-sm">

            <strong>

                Terjadi Kesalahan!

            </strong>

            <hr>

            <ul class="mb-0">

                <?php foreach (session()->getFlashdata('errors') as $error) : ?>

                    <li><?= esc($error) ?></li>

                <?php endforeach; ?>

            </ul>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>

        </div>

    <?php endif; ?>


    <!-- Card -->

    <div class="card border-0 shadow">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                <i class="bi bi-pencil-square"></i>

                Form Tambah Role

            </h5>

        </div>

        <div class="card-body">

            <form action="<?= base_url('roles/store') ?>" method="post">

                <?= csrf_field() ?>

                <div class="row">

                    <div class="col-lg-8">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Nama Role

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="role_name"
                                class="form-control"
                                placeholder="Contoh : Administrator Sistem"
                                value="<?= old('role_name') ?>"
                                required>

                            <small class="text-muted">

                                Nama role harus unik.

                            </small>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Deskripsi

                            </label>

                            <textarea
                                name="description"
                                rows="5"
                                class="form-control"
                                placeholder="Masukkan deskripsi role..."><?= old('description') ?></textarea>

                            <small class="text-muted">

                                Deskripsi digunakan untuk menjelaskan fungsi dari role tersebut.

                            </small>

                        </div>

                    </div>

                    <div class="col-lg-4">

                        <div class="card bg-light border-0">

                            <div class="card-body">

                                <h6 class="fw-bold">

                                    <i class="bi bi-info-circle-fill text-primary"></i>

                                    Informasi

                                </h6>

                                <hr>

                                <p class="mb-2">

                                    Role menentukan hak akses pengguna pada sistem.

                                </p>

                                <p class="mb-0">

                                    Contoh role:

                                </p>

                                <ul class="mt-2 mb-0">

                                    <li>Administrator</li>

                                    <li>Petugas ULT</li>

                                    <li>Unit Tujuan</li>

                                    <li>Pimpinan</li>

                                    <li>Pemohon</li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">

                    <a
                        href="<?= base_url('roles') ?>"
                        class="btn btn-outline-secondary">

                        <i class="bi bi-arrow-left-circle"></i>

                        Kembali

                    </a>

                    <div>

                        <button
                            type="reset"
                            class="btn btn-outline-warning me-2">

                            <i class="bi bi-arrow-clockwise"></i>

                            Reset

                        </button>

                        <button
                            type="submit"
                            class="btn btn-primary">

                            <i class="bi bi-check-circle-fill"></i>

                            Simpan Role

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>