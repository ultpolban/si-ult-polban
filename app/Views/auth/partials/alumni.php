<?php $errors = session('errors') ?? []; ?>

<!-- ===================================================== -->
<!-- DATA ALUMNI -->
<!-- ===================================================== -->

<div
    id="form-alumni"
    class="dynamic-form"
    style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-secondary text-white">

            <h5 class="mb-0">

                <i class="bi bi-award me-2"></i>

                Data Alumni

            </h5>

        </div>

        <div class="card-body">

            <h6 class="border-bottom pb-2 mb-3 text-secondary">

                Data Akademik

            </h6>

            <div class="row">

                <!-- NIM -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        NIM

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="nim"
                        class="form-control <?= isset($errors['nim']) ? 'is-invalid' : '' ?>"
                        value="<?= old('nim') ?>">

                    <?php if (isset($errors['nim'])) : ?>

                        <div class="invalid-feedback">

                            <?= $errors['nim'] ?>

                        </div>

                    <?php endif; ?>

                </div>

                <!-- Jurusan -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Jurusan

                    </label>

                    <select
                        id="department_alumni"
                        name="department_id"
                        class="form-select <?= isset($errors['department_id']) ? 'is-invalid' : '' ?>">

                        <option value="">

                            -- Pilih Jurusan --

                        </option>

                        <?php foreach ($departments as $department): ?>

                            <option
                                value="<?= $department['id'] ?>"
                                <?= old('department_id') == $department['id'] ? 'selected' : '' ?>>

                                <?= esc($department['department_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <!-- Program Studi -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Program Studi

                    </label>

                    <select
                        id="study_program_alumni"
                        name="study_program_id"
                        class="form-select <?= isset($errors['study_program_id']) ? 'is-invalid' : '' ?>">

                        <option value="">

                            -- Pilih Program Studi --

                        </option>

                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Tahun Lulus

                    </label>

                    <input
                        type="number"
                        name="graduation_year"
                        min="2000"
                        max="<?= date('Y') ?>"
                        class="form-control <?= isset($errors['graduation_year']) ? 'is-invalid' : '' ?>"
                        value="<?= old('graduation_year') ?>">

                    <?php if (isset($errors['graduation_year'])) : ?>

                        <div class="invalid-feedback">

                            <?= $errors['graduation_year'] ?>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <h6 class="border-bottom pb-2 mt-4 mb-3 text-secondary">

                Pekerjaan Saat Ini

            </h6>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Nama Instansi

                    </label>

                    <input
                        type="text"
                        name="institution_name"
                        class="form-control <?= isset($errors['institution_name']) ? 'is-invalid' : '' ?>"
                        value="<?= old('institution_name') ?>"
                        placeholder="Contoh : PT Telkom Indonesia">

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
                        placeholder="Contoh : Software Engineer">

                </div>

            </div>

        </div>

    </div>

</div>