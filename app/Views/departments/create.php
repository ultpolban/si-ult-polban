<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-building-add text-primary"></i>

                Tambah Jurusan

            </h2>

            <p class="text-muted mb-0">

                Tambahkan data jurusan baru ke dalam sistem SI-ULT POLBAN.

            </p>

        </div>

        <a
            href="<?= base_url('departments') ?>"
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

    <div class="card border-0 shadow">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                <i class="bi bi-pencil-square"></i>

                Form Tambah Jurusan

            </h5>

        </div>

        <div class="card-body">

            <form
                action="<?= base_url('departments/store') ?>"
                method="post">

                <?= csrf_field() ?>

                <div class="row">

                    <div class="col-lg-8">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Kode Jurusan

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="department_code"
                                class="form-control"
                                placeholder="Contoh : TS"
                                value="<?= old('department_code') ?>"
                                required>

                            <small class="text-muted">

                                Gunakan kode singkat jurusan (misal: TS, TM, TE).

                            </small>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Nama Jurusan

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="department_name"
                                class="form-control"
                                placeholder="Masukkan nama jurusan"
                                value="<?= old('department_name') ?>"
                                required>

                            <small class="text-muted">

                                Nama jurusan akan digunakan pada data Program Studi dan Mahasiswa.

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

                                    Pastikan kode jurusan tidak sama dengan jurusan lain.

                                </p>

                                <p class="mb-2">

                                    Contoh kode jurusan di POLBAN:

                                </p>

                                <ul class="mb-0">

                                    <li>TS - Teknik Sipil</li>

                                    <li>TM - Teknik Mesin</li>

                                    <li>TE - Teknik Elektro</li>

                                    <li>TK - Teknik Kimia</li>

                                    <li>AN - Administrasi Niaga</li>

                                    <li>AK - Akuntansi</li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">

                    <a
                        href="<?= base_url('departments') ?>"
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

                            Simpan Jurusan

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>