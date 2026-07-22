<div id="form-tendik" class="dynamic-form" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Data Tenaga Kependidikan</h5>
        </div>

        <div class="card-body">

            <div class="row">

                <!-- NIP -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        NIP
                    </label>

                    <input
                        type="text"
                        name="nip"
                        class="form-control"
                        value="<?= old('nip') ?>">

                </div>

                <!-- Status Pegawai -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Status Pegawai
                    </label>

                    <select
                        name="employee_status"
                        class="form-select">

                        <option value="">Pilih Status</option>

                        <option value="PNS">PNS</option>
                        <option value="PPPK">PPPK</option>
                        <option value="Kontrak">Kontrak</option>
                        <option value="Honorer">Honorer</option>

                    </select>

                </div>

                <!-- Jabatan -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Jabatan
                    </label>

                    <input
                        type="text"
                        name="position"
                        class="form-control"
                        value="<?= old('position') ?>">

                </div>

            </div>

            <div class="row">

                <!-- Unit Kerja -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Unit Kerja
                    </label>

                    <select
                        name="work_unit_id"
                        class="form-select">

                        <option value="">
                            Pilih Unit Kerja
                        </option>

                        <?php foreach ($workUnits as $unit): ?>

                            <option value="<?= $unit['id']; ?>">
                                <?= esc($unit['unit_name']); ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <!-- Jurusan -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Jurusan
                    </label>

                    <select
                        id="department_tendik"
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
                        id="study_program_tendik"
                        name="study_program_id"
                        class="form-select">

                        <option value="">
                            Pilih Program Studi
                        </option>

                        <?php foreach ($studyPrograms as $program): ?>

                            <option value="<?= $program['id']; ?>">

                                <?= esc($program['education_level']) ?>
                                -
                                <?= esc($program['program_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

            <div class="row">

                <!-- Email Institusi -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Email Institusi
                    </label>

                    <input
                        type="email"
                        name="institution_email"
                        class="form-control"
                        value="<?= old('institution_email') ?>">

                </div>

            </div>

        </div>

    </div>

</div>