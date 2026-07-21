<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-pencil-square text-warning"></i>

                Edit Unit Kerja

            </h2>

            <p class="text-muted mb-0">

                Perbarui informasi Unit Kerja pada sistem SI-ULT POLBAN.

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

        <div class="card-header bg-warning">

            <h5 class="mb-0">

                <i class="bi bi-pencil-fill"></i>

                Form Edit Unit Kerja

            </h5>

        </div>

        <div class="card-body">

            <form
                action="<?= base_url('work-units/update/' . $unit['id']) ?>"
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
                                value="<?= old('unit_code', $unit['unit_code']) ?>"
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
                                value="<?= old('unit_name', $unit['unit_name']) ?>"
                                required>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Deskripsi

                            </label>

                            <textarea
                                name="description"
                                rows="4"
                                class="form-control"><?= old('description', $unit['description']) ?></textarea>

                        </div>

                        <div class="mb-4">

                            <label class="form-label fw-semibold">

                                Status

                            </label>

                            <select
                                name="status"
                                class="form-select">

                                <option
                                    value="Aktif"
                                    <?= old('status', $unit['status']) == 'Aktif' ? 'selected' : '' ?>>

                                    Aktif

                                </option>

                                <option
                                    value="Tidak Aktif"
                                    <?= old('status', $unit['status']) == 'Tidak Aktif' ? 'selected' : '' ?>>

                                    Tidak Aktif

                                </option>

                            </select>

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

                                    Perubahan Unit Kerja akan memengaruhi data tujuan disposisi dan referensi organisasi di SI-ULT POLBAN.

                                </p>

                                <ul class="mb-0">

                                    <li>Pastikan kode tetap unik.</li>

                                    <li>Nama Unit mudah dikenali.</li>

                                    <li>Deskripsi dapat dikosongkan.</li>

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
                            class="btn btn-warning">

                            <i class="bi bi-save-fill"></i>

                            Update Unit Kerja

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>