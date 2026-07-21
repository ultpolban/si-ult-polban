<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-mortarboard-fill text-primary"></i>

                Tambah Program Studi

            </h2>

            <p class="text-muted mb-0">

                Tambahkan Program Studi baru ke dalam sistem SI-ULT POLBAN.

            </p>

        </div>

        <a
            href="<?= base_url('study-programs') ?>"
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

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                <i class="bi bi-plus-circle-fill"></i>

                Form Tambah Program Studi

            </h5>

        </div>

        <div class="card-body">

            <form
                action="<?= base_url('study-programs/store') ?>"
                method="post">

                <?= csrf_field() ?>

                <div class="row">

                    <div class="col-lg-8">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Jurusan

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="department_id"
                                class="form-select"
                                required>

                                <option value="">-- Pilih Jurusan --</option>

                                <?php foreach ($departments as $department): ?>

                                    <option
                                        value="<?= $department['id'] ?>"
                                        <?= old('department_id') == $department['id'] ? 'selected' : '' ?>>

                                        <?= esc($department['department_name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Kode Program Studi

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="program_code"
                                class="form-control"
                                placeholder="Contoh : D4IF"
                                value="<?= old('program_code') ?>"
                                required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Nama Program Studi

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="program_name"
                                class="form-control"
                                placeholder="Masukkan nama Program Studi"
                                value="<?= old('program_name') ?>"
                                required>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">

                                    Jenjang

                                </label>

                                <select
                                    name="education_level"
                                    class="form-select">

                                    <option value="D3" <?= old('education_level') == 'D3' ? 'selected' : '' ?>>D3</option>

                                    <option value="D4" <?= old('education_level') == 'D4' ? 'selected' : '' ?>>D4</option>

                                    <option value="S2" <?= old('education_level') == 'S2' ? 'selected' : '' ?>>S2</option>

                                </select>

                            </div>

                            <div class="col-md-6 mb-4">

                                <label class="form-label fw-semibold">

                                    Status

                                </label>

                                <select
                                    name="status"
                                    class="form-select">

                                    <option value="Aktif" <?= old('status') == 'Aktif' ? 'selected' : '' ?>>

                                        Aktif

                                    </option>

                                    <option value="Tidak Aktif" <?= old('status') == 'Tidak Aktif' ? 'selected' : '' ?>>

                                        Tidak Aktif

                                    </option>

                                </select>

                            </div>

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

                                <p>

                                    Program Studi harus berada di dalam salah satu Jurusan yang telah tersedia.

                                </p>

                                <ul class="mb-0">

                                    <li>Pastikan kode Program Studi unik.</li>

                                    <li>Pilih jenjang yang sesuai.</li>

                                    <li>Status dapat diubah kapan saja.</li>

                                    <li>Data ini digunakan saat registrasi mahasiswa.</li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">

                    <a
                        href="<?= base_url('study-programs') ?>"
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

                            Simpan Program Studi

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>