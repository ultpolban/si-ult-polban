<div
    id="alumni-section"
    class="user-type-section"
    style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">

                <i class="bi bi-award-fill me-2"></i>

                Data Alumni

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <!-- ==========================================
                NIM
                =========================================== -->

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        NIM

                    </label>

                    <input
                        type="text"
                        name="nim"
                        class="form-control"
                        value="<?= old('nim', $user['nim'] ?? '') ?>">

                </div>

                <!-- ==========================================
                TAHUN LULUS
                =========================================== -->

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Tahun Lulus

                    </label>

                    <input
                        type="number"
                        name="graduation_year"
                        class="form-control"
                        min="2000"
                        max="<?= date('Y') ?>"
                        value="<?= old('graduation_year', $user['graduation_year'] ?? '') ?>">

                </div>

            </div>

            <div class="row">

                <!-- ==========================================
                JURUSAN
                =========================================== -->

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Jurusan

                    </label>

                    <select
                        name="department_id"
                        class="form-select">

                        <option value="">

                            -- Pilih Jurusan --

                        </option>

                        <?php foreach ($departments as $department): ?>

                            <option
                                value="<?= $department['id'] ?>"
                                <?= old('department_id', $user['department_id'] ?? '') == $department['id'] ? 'selected' : '' ?>>

                                <?= esc($department['department_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <!-- ==========================================
                PROGRAM STUDI
                =========================================== -->

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Program Studi

                    </label>

                    <select
                        name="study_program_id"
                        id="study_program_id"
                        class="form-select"
                        data-selected="<?= old('study_program_id', $user['study_program_id'] ?? '') ?>">

                        <option value="">

                            -- Pilih Program Studi --

                        </option>

                        <?php foreach ($studyPrograms as $studyProgram): ?>

                            <option
                                value="<?= $studyProgram['id'] ?>"
                                <?= old('study_program_id', $user['study_program_id'] ?? '') == $studyProgram['id'] ? 'selected' : '' ?>>

                                <?= esc($studyProgram['education_level']) ?>

                                -

                                <?= esc($studyProgram['program_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

        </div>

    </div>

</div>