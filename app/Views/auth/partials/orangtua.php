<?php $errors = session('errors') ?? []; ?>

<!-- ===================================================== -->
<!-- DATA ORANG TUA / WALI -->
<!-- ===================================================== -->

<div
    id="form-orangtua"
    class="dynamic-form"
    style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-danger text-white">

            <h5 class="mb-0">

                <i class="bi bi-people-fill me-2"></i>

                Data Orang Tua / Wali

            </h5>

        </div>

        <div class="card-body">

            <h6 class="border-bottom pb-2 mb-3 text-danger">

                Hubungan Dengan Mahasiswa

            </h6>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Hubungan

                        <span class="text-danger">*</span>

                    </label>

                    <select
                        name="relationship"
                        class="form-select <?= isset($errors['relationship']) ? 'is-invalid' : '' ?>">

                        <option value="">

                            -- Pilih Hubungan --

                        </option>

                        <option value="Ayah" <?= old('relationship') == 'Ayah' ? 'selected' : '' ?>>

                            Ayah

                        </option>

                        <option value="Ibu" <?= old('relationship') == 'Ibu' ? 'selected' : '' ?>>

                            Ibu

                        </option>

                        <option value="Wali" <?= old('relationship') == 'Wali' ? 'selected' : '' ?>>

                            Wali

                        </option>

                    </select>

                    <?php if (isset($errors['relationship'])) : ?>

                        <div class="invalid-feedback">

                            <?= $errors['relationship'] ?>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <h6 class="border-bottom pb-2 mt-4 mb-3 text-danger">

                Data Mahasiswa

            </h6>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        NIM Mahasiswa

                    </label>

                    <input
                        type="text"
                        name="student_nim"
                        class="form-control <?= isset($errors['nim']) ? 'is-invalid' : '' ?>"
                        value="<?= old('nim') ?>"
                        placeholder="231511001">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Nama Mahasiswa

                    </label>

                    <input
                        type="text"
                        name="student_name"
                        class="form-control"
                        value="<?= old('student_name') ?>"
                        placeholder="Nama mahasiswa">

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Jurusan

                    </label>

                    <select
                        id="department_orangtua"
                        name="department_id"
                        class="form-select">

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

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Program Studi

                    </label>

                    <select
                        id="study_program_orangtua"
                        name="study_program_id"
                        class="form-select">

                        <option value="">

                            -- Pilih Program Studi --

                        </option>

                    </select>

                </div>

            </div>

        </div>

    </div>

</div>