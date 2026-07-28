<?php $errors = session('errors') ?? []; ?>

<!-- ===================================================== -->
<!-- DATA PUBLIK -->
<!-- ===================================================== -->

<div
    id="form-publik"
    class="dynamic-form"
    style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                <i class="bi bi-people me-2"></i>

                Data Masyarakat Umum

            </h5>

        </div>

        <div class="card-body">

            <h6 class="border-bottom pb-2 mb-3 text-primary">

                Informasi Tambahan

            </h6>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Asal Instansi

                    </label>

                    <input
                        type="text"
                        name="institution_name"
                        class="form-control <?= isset($errors['institution_name']) ? 'is-invalid' : '' ?>"
                        value="<?= old('institution_name') ?>"
                        placeholder="Kosongkan jika tidak ada">

                    <?php if (isset($errors['institution_name'])) : ?>

                        <div class="invalid-feedback">

                            <?= $errors['institution_name'] ?>

                        </div>

                    <?php endif; ?>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Pekerjaan

                    </label>

                    <input
                        type="text"
                        name="position"
                        class="form-control <?= isset($errors['position']) ? 'is-invalid' : '' ?>"
                        value="<?= old('position') ?>"
                        placeholder="Contoh : Wiraswasta">

                    <?php if (isset($errors['position'])) : ?>

                        <div class="invalid-feedback">

                            <?= $errors['position'] ?>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12 mb-3">

                    <label class="form-label fw-semibold">

                        Keperluan Menghubungi ULT

                    </label>

                    <textarea
                        name="notes"
                        rows="4"
                        class="form-control"
                        placeholder="Tuliskan secara singkat tujuan Anda menghubungi ULT..."><?= old('notes') ?></textarea>

                </div>

            </div>

        </div>

    </div>

</div>