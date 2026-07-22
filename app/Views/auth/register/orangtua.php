<div id="form-orangtua" class="dynamic-form" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">
                Data Orang Tua / Wali
            </h5>
        </div>

        <div class="card-body">

            <div class="row">

                <!-- Nama Mahasiswa -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Nama Mahasiswa
                    </label>

                    <input
                        type="text"
                        name="student_name"
                        class="form-control"
                        value="<?= old('student_name') ?>">

                </div>

                <!-- NIM -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        NIM Mahasiswa
                    </label>

                    <input
                        type="text"
                        name="student_nim"
                        class="form-control"
                        value="<?= old('student_nim') ?>">

                </div>

            </div>

            <div class="row">

                <!-- Hubungan -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Hubungan
                    </label>

                    <select
                        name="relationship"
                        class="form-select">

                        <option value="">Pilih Hubungan</option>

                        <option value="Ayah">Ayah</option>
                        <option value="Ibu">Ibu</option>
                        <option value="Wali">Wali</option>

                    </select>

                </div>

                <!-- Jurusan -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Jurusan
                    </label>

                    <select
                        id="department_orangtua"
                        name="department_id"
                        class="form-select">

                        <option value="">
                            Pilih Jurusan
                        </option>

                        <?php foreach ($departments as $department): ?>

                            <option value="<?= $department['id']; ?>">

                                <?= esc($department['department_name']); ?>

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
                        id="study_program_orangtua"
                        name="study_program_id"
                        class="form-select">

                        <option value="">
                            Pilih Program Studi
                        </option>

                        <?php foreach ($studyPrograms as $program): ?>

                            <option value="<?= $program['id']; ?>">

                                <?= esc($program['education_level']); ?>
                                -
                                <?= esc($program['program_name']); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

            <div class="row">

                <!-- Angkatan -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Angkatan Mahasiswa
                    </label>

                    <input
                        type="number"
                        name="angkatan"
                        class="form-control"
                        value="<?= old('angkatan') ?>">

                </div>

                <!-- Semester -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Semester
                    </label>

                    <select
                        name="semester"
                        class="form-select">

                        <option value="">Pilih Semester</option>

                        <?php for ($i = 1; $i <= 14; $i++): ?>

                            <option value="<?= $i ?>">
                                Semester <?= $i ?>
                            </option>

                        <?php endfor; ?>

                    </select>

                </div>

                <!-- Status -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Status Mahasiswa
                    </label>

                    <select
                        name="student_status"
                        class="form-select">

                        <option value="">Pilih Status</option>

                        <option value="Aktif">Aktif</option>
                        <option value="Cuti">Cuti</option>
                        <option value="Lulus">Lulus</option>
                        <option value="Drop Out">Drop Out</option>

                    </select>

                </div>

            </div>

        </div>

    </div>

</div>