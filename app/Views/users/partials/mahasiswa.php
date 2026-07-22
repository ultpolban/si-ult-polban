<div id="mahasiswaForm" class="dynamic-section" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-info text-white">

            <h5 class="mb-0">

                Data Mahasiswa

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <!-- NIM -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        NIM

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        name="nim"
                        class="form-control"
                        value="<?= old('nim', $user['nim'] ?? '') ?>">

                </div>

                <!-- Jurusan -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Jurusan

                    </label>

                    <select
                        name="department_id"
                        id="department_id"
                        class="form-select">

                        <option value="">Pilih Jurusan</option>

                        <?php foreach ($departments as $department): ?>

                            <option
                                value="<?= $department['id'] ?>"

                                <?= old('department_id', $user['department_id'] ?? '') == $department['id'] ? 'selected' : '' ?>>

                                <?= esc($department['department_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <!-- Program Studi -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Program Studi

                    </label>

                    <select
                        name="study_program_id"
                        id="study_program_id"
                        class="form-select">

                        <option value="">Pilih Program Studi</option>

                        <?php foreach ($studyPrograms as $program): ?>

                            <option
                                value="<?= $program['id'] ?>"

                                <?= old('study_program_id', $user['study_program_id'] ?? '') == $program['id'] ? 'selected' : '' ?>>

                                <?= esc($program['program_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

            <div class="row">

                <!-- Kelas -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Kelas

                    </label>

                    <select
                        name="class_id"
                        class="form-select">

                        <option value="">Pilih Kelas</option>

                        <?php foreach ($classes as $class): ?>

                            <option
                                value="<?= $class['id'] ?>"

                                <?= old('class_id', $user['class_id'] ?? '') == $class['id'] ? 'selected' : '' ?>>

                                <?= esc($class['class_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <!-- Angkatan -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Angkatan

                    </label>

                    <input
                        type="number"
                        name="angkatan"
                        min="2000"
                        max="<?= date('Y') ?>"
                        class="form-control"
                        value="<?= old('angkatan', $user['angkatan'] ?? '') ?>">

                </div>

                <!-- Semester -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Semester

                    </label>

                    <select
                        name="semester"
                        class="form-select">

                        <option value="">Pilih Semester</option>

                        <?php for ($i = 1; $i <= 14; $i++): ?>

                            <option
                                value="<?= $i ?>"

                                <?= old('semester', $user['semester'] ?? '') == $i ? 'selected' : '' ?>>

                                Semester <?= $i ?>

                            </option>

                        <?php endfor; ?>

                    </select>

                </div>

                <!-- Status -->

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Status Mahasiswa

                    </label>

                    <select
                        name="student_status"
                        class="form-select">

                        <option value="">Pilih Status</option>

                        <?php

                        $statusMahasiswa = [

                            'Aktif',

                            'Cuti',

                            'Lulus',

                            'Drop Out'

                        ];

                        ?>

                        <?php foreach ($statusMahasiswa as $status): ?>

                            <option
                                value="<?= $status ?>"

                                <?= old('student_status', $user['student_status'] ?? '') == $status ? 'selected' : '' ?>>

                                <?= $status ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

            <div class="row">

                <!-- Tahun Masuk -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Tahun Masuk

                    </label>

                    <input
                        type="number"
                        name="entry_year"
                        min="2000"
                        max="<?= date('Y') ?>"
                        class="form-control"
                        value="<?= old('entry_year', $user['entry_year'] ?? '') ?>">

                </div>

            </div>

        </div>

    </div>

</div>