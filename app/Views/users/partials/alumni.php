<div id="alumniForm" class="dynamic-section" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-info text-white">

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
                        value="<?= old('nim', $user['nim'] ?? '') ?>">

                </div>

                <!-- Jurusan -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Jurusan

                    </label>

                    <select
                        name="department_id"
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

                <!-- Tahun Lulus -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Tahun Lulus

                    </label>

                    <input
                        type="number"
                        name="graduation_year"
                        min="1980"
                        max="<?= date('Y') ?>"
                        class="form-control"
                        value="<?= old('graduation_year', $user['graduation_year'] ?? '') ?>">

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
                        value="<?= old('graduation_number', $user['graduation_number'] ?? '') ?>">

                </div>

                <!-- Pekerjaan -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Pekerjaan Saat Ini

                    </label>

                    <input
                        type="text"
                        name="job_title"
                        class="form-control"
                        value="<?= old('job_title', $user['job_title'] ?? '') ?>">

                </div>

            </div>

            <div class="row">

                <!-- Nama Instansi -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Nama Instansi / Perusahaan

                    </label>

                    <input
                        type="text"
                        name="institution_name"
                        class="form-control"
                        value="<?= old('institution_name', $user['institution_name'] ?? '') ?>">

                </div>

                <!-- Jenis Instansi -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Jenis Instansi

                    </label>

                    <input
                        type="text"
                        name="institution_type"
                        class="form-control"
                        placeholder="Pemerintah / Swasta / Wirausaha"
                        value="<?= old('institution_type', $user['institution_type'] ?? '') ?>">

                </div>

            </div>

        </div>

    </div>

</div>