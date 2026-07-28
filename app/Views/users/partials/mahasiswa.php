<div
    id="mahasiswa-section"
    class="user-type-section"
    style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-info text-white">

            <h5 class="mb-0">

                <i class="bi bi-mortarboard-fill me-2"></i>

                Data Mahasiswa

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
                ANGKATAN
                =========================================== -->

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Angkatan

                    </label>

                    <input
                        type="number"
                        name="angkatan"
                        class="form-control"
                        min="2000"
                        max="<?= date('Y') ?>"
                        value="<?= old('angkatan', $user['angkatan'] ?? '') ?>">

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
                        id="department_id"
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

                        <?php if (!empty($studyPrograms)) : ?>

                            <?php foreach ($studyPrograms as $studyProgram): ?>

                                <option
                                    value="<?= $studyProgram['id'] ?>"
                                    <?= old('study_program_id', $user['study_program_id'] ?? '') == $studyProgram['id'] ? 'selected' : '' ?>>

                                    <?= esc($studyProgram['education_level']) ?>
                                    -
                                    <?= esc($studyProgram['program_name']) ?>

                                </option>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </select>

                </div>

            </div>

            <div class="row">

                <!-- ==========================================
                KELAS
                =========================================== -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Kelas

                    </label>

                    <select
                        name="class_id"
                        class="form-select">

                        <option value="">

                            -- Pilih Kelas --

                        </option>

                        <?php foreach ($classes as $class): ?>

                            <option
                                value="<?= $class['id'] ?>"
                                <?= old('class_id', $user['class_id'] ?? '') == $class['id'] ? 'selected' : '' ?>>

                                <?= esc($class['class_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <!-- ==========================================
                TAHUN MASUK
                =========================================== -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Tahun Masuk

                    </label>

                    <input
                        type="number"
                        name="entry_year"
                        class="form-control"
                        min="2000"
                        max="<?= date('Y') ?>"
                        value="<?= old('entry_year', $user['entry_year'] ?? '') ?>">

                </div>

                <!-- ==========================================
                STATUS MAHASISWA
                =========================================== -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Status Mahasiswa

                    </label>

                    <select
                        name="student_status"
                        class="form-select">

                        <option value="">

                            -- Pilih Status --

                        </option>

                        <?php

                        $statusMahasiswa = [

                            'Aktif',
                            'Cuti',
                            'Lulus',
                            'Drop Out'

                        ];

                        foreach ($statusMahasiswa as $status):

                        ?>

                            <option
                                value="<?= $status ?>"
                                <?= old('student_status', $user['student_status'] ?? '') == $status ? 'selected' : '' ?>>

                                <?= $status ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

        </div>

    </div>

</div>