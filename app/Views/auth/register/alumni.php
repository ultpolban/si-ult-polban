<div id="form-alumni" class="dynamic-form" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-warning">
            <h5 class="mb-0">
                Data Alumni
            </h5>
        </div>

        <div class="card-body">

            <div class="row">

                <!-- NIM -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        NIM
                    </label>

                    <input
                        type="text"
                        name="nim"
                        class="form-control"
                        value="<?= old('nim') ?>">

                </div>

                <!-- Jurusan -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Jurusan
                    </label>

                    <select
                        id="department_alumni"
                        name="department_id"
                        class="form-select">

                        <option value="">
                            Pilih Jurusan
                        </option>

                        <?php foreach ($departments as $department): ?>

                            <option value="<?= $department['id'] ?>">

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
                        id="study_program_alumni"
                        name="study_program_id"
                        class="form-select">

                        <option value="">
                            Pilih Program Studi
                        </option>

                        <?php foreach ($studyPrograms as $program): ?>

                            <option value="<?= $program['id'] ?>">

                                <?= esc($program['education_level']) ?>
                                -
                                <?= esc($program['program_name']) ?>

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
                        class="form-control"
                        min="2000"
                        max="<?= date('Y') ?>"
                        value="<?= old('entry_year') ?>">

                </div>

                <!-- Tahun Lulus -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Tahun Lulus
                    </label>

                    <input
                        type="number"
                        name="graduation_year"
                        class="form-control"
                        min="2000"
                        max="<?= date('Y') ?>"
                        value="<?= old('graduation_year') ?>">

                </div>

                <!-- Nomor Ijazah -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Nomor Ijazah
                    </label>

                    <input
                        type="text"
                        name="graduation_number"
                        class="form-control"
                        value="<?= old('graduation_number') ?>">

                </div>

            </div>

            <div class="row">

                <!-- Pekerjaan -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Pekerjaan Saat Ini
                    </label>

                    <input
                        type="text"
                        name="job_title"
                        class="form-control"
                        value="<?= old('job_title') ?>">

                </div>

                <!-- Instansi -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Nama Instansi
                    </label>

                    <input
                        type="text"
                        name="institution_name"
                        class="form-control"
                        value="<?= old('institution_name') ?>">

                </div>

            </div>

        </div>

    </div>

</div>