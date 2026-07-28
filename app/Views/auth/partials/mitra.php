<?php $errors = session('errors') ?? []; ?>

<!-- ===================================================== -->
<!-- DATA MITRA -->
<!-- ===================================================== -->

<div
    id="form-mitra"
    class="dynamic-form"
    style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">

                <i class="bi bi-building-fill me-2"></i>

                Data Mitra

            </h5>

        </div>

        <div class="card-body">

            <h6 class="border-bottom pb-2 mb-3 text-dark">

                Informasi Instansi

            </h6>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Nama Instansi

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="institution_name"
                        class="form-control <?= isset($errors['institution_name']) ? 'is-invalid' : '' ?>"
                        value="<?= old('institution_name') ?>">

                    <?php if (isset($errors['institution_name'])) : ?>

                        <div class="invalid-feedback">

                            <?= $errors['institution_name'] ?>

                        </div>

                    <?php endif; ?>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Jabatan

                    </label>

                    <input
                        type="text"
                        name="position"
                        class="form-control <?= isset($errors['position']) ? 'is-invalid' : '' ?>"
                        value="<?= old('position') ?>"
                        placeholder="Contoh : Manager">

                    <?php if (isset($errors['position'])) : ?>

                        <div class="invalid-feedback">

                            <?= $errors['position'] ?>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Bidang Usaha

                    </label>

                    <input
                        type="text"
                        name="business_field"
                        class="form-control"
                        value="<?= old('business_field') ?>"
                        placeholder="Contoh : Teknologi Informasi">

                </div>

            </div>

            <div class="row">

                <div class="col-md-12 mb-3">

                    <label class="form-label fw-semibold">

                        Alamat Instansi

                    </label>

                    <textarea
                        name="institution_address"
                        rows="3"
                        class="form-control"><?= old('institution_address') ?></textarea>

                </div>

            </div>

        </div>

    </div>

</div>