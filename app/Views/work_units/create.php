<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-building-add text-primary"></i>

                Tambah Unit Kerja

            </h2>

            <p class="text-muted mb-0">

                Tambahkan Unit Kerja baru ke dalam sistem SI-ULT POLBAN.

            </p>

        </div>

        <a
            href="<?= base_url('work-units') ?>"
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

                Form Tambah Unit Kerja

            </h5>

        </div>

        <div class="card-body">

            <form
                action="<?= base_url('work-units/store') ?>"
                method="post">

                <?= csrf_field() ?>

                <div class="row">

                    <div class="col-lg-8">

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Kode Unit

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="unit_code"
                                class="form-control"
                                placeholder="Contoh : ULT"
                                value="<?= old('unit_code') ?>"
                                required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Nama Unit Kerja

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                name="unit_name"
                                class="form-control"
                                placeholder="Masukkan nama Unit Kerja"
                                value="<?= old('unit_name') ?>"
                                required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Deskripsi

                            </label>

                            <textarea
                                name="description"
                                rows="4"
                                class="form-control"
                                placeholder="Masukkan deskripsi Unit Kerja"><?= old('description') ?></textarea>

                        </div>

                        <div class="mb-4">

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

                    <div class="col-lg-4">

                        <div class="card bg-light border-0">

                            <div class="card-body">

                                <h6 class="fw-bold">

                                    <i class="bi bi-info-circle-fill text-primary"></i>

                                    Informasi

                                </h6>

                                <hr>

                                <p>

                                    Unit Kerja digunakan sebagai tujuan disposisi layanan dan identitas organisasi di SI-ULT POLBAN.

                                </p>

                                <ul class="mb-0">

                                    <li>Kode Unit harus unik.</li>

                                    <li>Nama Unit harus jelas.</li>

                                    <li>Deskripsi bersifat opsional.</li>

                                    <li>Status dapat diubah kapan saja.</li>

                                </ul>

                            </div>

                        </div>

                    </div>

                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-between">

                    <a
                        href="<?= base_url('work-units') ?>"
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

                            Simpan Unit Kerja

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>