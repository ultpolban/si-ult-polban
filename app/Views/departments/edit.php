<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-pencil-square text-warning"></i>

                Edit Jurusan

            </h2>

            <p class="text-muted mb-0">

                Perbarui data jurusan pada sistem SI-ULT POLBAN.

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

            <strong>Terjadi Kesalahan!</strong>

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

        <div class="card-header bg-warning">

            <h5 class="mb-0">

                <i class="bi bi-pencil-fill"></i>

                Form Edit Jurusan

            </h5>

        </div>

        <div class="card-body">

            <form
                action="<?= base_url('departments/update/' . $department['id']) ?>"
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
                                value="<?= old('department_code', $department['department_code']) ?>"
                                placeholder="Contoh : TS"
                                required>

                            <small class="text-muted">

                                Gunakan kode jurusan yang unik.

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
                                value="<?= old('department_name', $department['department_name']) ?>"
                                placeholder="Masukkan nama jurusan"
                                required>

                            <small class="text-muted">

                                Nama jurusan digunakan pada Program Studi dan data Mahasiswa.

                            </small>

                        </div>

                    </div>

                    <div class="col-lg-4">

                        <div class="card bg-light border-0">

                            <div class="card-body">

                                <h6 class="fw-bold">

                                    <i class="bi bi-info-circle-fill text-warning"></i>

                                    Informasi

                                </h6>

                                <hr>

                                <p>

                                    Perubahan data jurusan akan berpengaruh pada seluruh Program Studi yang berada di bawah jurusan tersebut.

                                </p>

                                <ul class="mb-0">

                                    <li>TS - Teknik Sipil</li>

                                    <li>TM - Teknik Mesin</li>

                                    <li>TR - Teknik Refrigerasi</li>

                                    <li>TE - Teknik Elektro</li>

                                    <li>TK - Teknik Kimia</li>

                                    <li>AK - Akuntansi</li>

                                    <li>AN - Administrasi Niaga</li>

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
                            class="btn btn-warning">

                            <i class="bi bi-save-fill"></i>

                            Update Jurusan

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>