<?php $errors = session('errors') ?? []; ?>

<!-- ===================================================== -->
<!-- DATA MAHASISWA -->
<!-- ===================================================== -->

<div
    id="form-mahasiswa"
    class="dynamic-form"
    style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-info text-white">

            <h5 class="mb-0">

                <i class="bi bi-mortarboard-fill me-2"></i>

                Data Mahasiswa

            </h5>

        </div>

        <div class="card-body">

            <!-- ================================ -->
            <!-- DATA AKADEMIK -->
            <!-- ================================ -->

            <h6 class="border-bottom pb-2 mb-3 text-primary">

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
                        value="<?= old('nim') ?>"
                        placeholder="Contoh : 231511001">

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

                        <span class="text-danger">*</span>

                    </label>

                    <select
                        id="department_id"
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

                    <?php if (isset($errors['department_id'])) : ?>

                        <div class="invalid-feedback">

                            <?= $errors['department_id'] ?>

                        </div>

                    <?php endif; ?>

                </div>

                <!-- Program Studi -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Program Studi

                        <span class="text-danger">*</span>

                    </label>

                    <select
                        id="study_program_id"
                        name="study_program_id"
                        data-selected="<?= esc(old('study_program_id') ?? '') ?>"
                        class="form-select <?= isset($errors['study_program_id']) ? 'is-invalid' : '' ?>">

                        <option value="">

                            -- Pilih Program Studi --

                        </option>

                    </select>

                    <?php if (isset($errors['study_program_id'])) : ?>

                        <div class="invalid-feedback">

                            <?= $errors['study_program_id'] ?>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <div class="row">

                <!-- Kelas -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Kelas

                    </label>

                    <select
                        name="class_id"
                        class="form-select <?= isset($errors['class_id']) ? 'is-invalid' : '' ?>">

                        <option value="">

                            -- Pilih Kelas --

                        </option>

                        <?php foreach ($classes as $class): ?>

                            <option
                                value="<?= $class['id'] ?>"
                                <?= old('class_id') == $class['id'] ? 'selected' : '' ?>>

                                <?= esc($class['class_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                    <?php if (isset($errors['class_id'])) : ?>

                        <div class="invalid-feedback">

                            <?= $errors['class_id'] ?>

                        </div>

                    <?php endif; ?>

                </div>

                <!-- Angkatan -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Angkatan

                    </label>

                    <input
                        type="number"
                        name="angkatan"
                        class="form-control <?= isset($errors['angkatan']) ? 'is-invalid' : '' ?>"
                        value="<?= old('angkatan') ?>">

                    <?php if (isset($errors['angkatan'])) : ?>

                        <div class="invalid-feedback">

                            <?= $errors['angkatan'] ?>

                        </div>

                    <?php endif; ?>

                </div>

                <!-- Tahun Masuk -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Tahun Masuk

                    </label>

                    <input
                        type="number"
                        name="entry_year"
                        class="form-control <?= isset($errors['entry_year']) ? 'is-invalid' : '' ?>"
                        value="<?= old('entry_year') ?>">

                    <?php if (isset($errors['entry_year'])) : ?>

                        <div class="invalid-feedback">

                            <?= $errors['entry_year'] ?>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <!-- ================================ -->
            <!-- STATUS MAHASISWA -->
            <!-- ================================ -->

            <h6 class="border-bottom pb-2 mt-4 mb-3 text-primary">

                Status Mahasiswa

            </h6>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Status Mahasiswa

                    </label>

                    <select
                        name="student_status"
                        class="form-select <?= isset($errors['student_status']) ? 'is-invalid' : '' ?>">

                        <option value="">

                            -- Pilih Status --

                        </option>

                        <?php

                        $status = [
                            'Aktif',
                            'Cuti',
                            'Lulus',
                            'Drop Out'
                        ];

                        foreach ($status as $item):

                        ?>

                            <option
                                value="<?= $item ?>"
                                <?= old('student_status') == $item ? 'selected' : '' ?>>

                                <?= $item ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                    <?php if (isset($errors['student_status'])) : ?>

                        <div class="invalid-feedback">

                            <?= $errors['student_status'] ?>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>
