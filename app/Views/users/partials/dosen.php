<div id="dosenForm" class="dynamic-section" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-warning">

            <h5 class="mb-0">

                Data Dosen

            </h5>

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
                        value="<?= old('nip', $user['nip'] ?? '') ?>">

                </div>

                <!-- NIDN -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        NIDN

                    </label>

                    <input
                        type="text"
                        name="nidn"
                        class="form-control"
                        value="<?= old('nidn', $user['nidn'] ?? '') ?>">

                </div>

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

                            <option
                                value="<?= $unit['id'] ?>"

                                <?= old('work_unit_id', $user['work_unit_id'] ?? '') == $unit['id'] ? 'selected' : '' ?>>

                                <?= esc($unit['unit_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

            <div class="row">

                <!-- Jurusan -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Jurusan

                    </label>

                    <select
                        name="department_id"
                        class="form-select">

                        <option value="">

                            Pilih Jurusan

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

                <!-- Jabatan Akademik -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Jabatan Akademik

                    </label>

                    <select
                        name="academic_position"
                        class="form-select">

                        <option value="">Pilih Jabatan</option>

                        <?php

                        $academicPositions = [

                            'Asisten Ahli',

                            'Lektor',

                            'Lektor Kepala',

                            'Profesor'

                        ];

                        ?>

                        <?php foreach ($academicPositions as $jabatan): ?>

                            <option
                                value="<?= $jabatan ?>"

                                <?= old('academic_position', $user['academic_position'] ?? '') == $jabatan ? 'selected' : '' ?>>

                                <?= $jabatan ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

            <div class="row">

                <!-- Jabatan Fungsional -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Jabatan Fungsional

                    </label>

                    <input
                        type="text"
                        name="functional_position"
                        class="form-control"
                        value="<?= old('functional_position', $user['functional_position'] ?? '') ?>">

                </div>

                <!-- Email Institusi -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Email Institusi

                    </label>

                    <input
                        type="email"
                        name="institution_email"
                        class="form-control"
                        value="<?= old('institution_email', $user['institution_email'] ?? '') ?>">

                </div>

            </div>

        </div>

    </div>

</div>