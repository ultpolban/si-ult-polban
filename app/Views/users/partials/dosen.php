<div
    id="dosen-section"
    class="user-type-section"
    style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-warning">

            <h5 class="mb-0">

                <i class="bi bi-person-workspace me-2"></i>

                Data Dosen

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <!-- NIP -->

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        NIP

                    </label>

                    <input
                        type="text"
                        name="nip"
                        class="form-control"
                        value="<?= old('nip', $user['nip'] ?? '') ?>">

                </div>

                <!-- NIDN -->

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        NIDN

                    </label>

                    <input
                        type="text"
                        name="nidn"
                        class="form-control"
                        value="<?= old('nidn', $user['nidn'] ?? '') ?>">

                </div>

            </div>

            <div class="row">

                <!-- Jurusan -->

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

                <!-- Unit Kerja -->

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Unit Kerja

                    </label>

                    <select
                        name="work_unit_id"
                        class="form-select">

                        <option value="">

                            -- Pilih Unit Kerja --

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

                <!-- ==========================================
                JABATAN AKADEMIK
                =========================================== -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Jabatan Akademik

                    </label>

                    <input
                        type="text"
                        name="academic_position"
                        class="form-control"
                        value="<?= old('academic_position', $user['academic_position'] ?? '') ?>">

                </div>

                <!-- ==========================================
                JABATAN FUNGSIONAL
                =========================================== -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Jabatan Fungsional

                    </label>

                    <input
                        type="text"
                        name="functional_position"
                        class="form-control"
                        value="<?= old('functional_position', $user['functional_position'] ?? '') ?>">

                </div>

                <!-- ==========================================
                STATUS PEGAWAI
                =========================================== -->

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">

                        Status Pegawai

                    </label>

                    <select
                        name="employee_status"
                        class="form-select">

                        <option value="">

                            -- Pilih Status --

                        </option>

                        <?php

                        $statusPegawai = [

                            'PNS',
                            'PPPK',
                            'Kontrak',
                            'Honorer'

                        ];

                        foreach ($statusPegawai as $status):

                        ?>

                            <option
                                value="<?= $status ?>"
                                <?= old('employee_status', $user['employee_status'] ?? '') == $status ? 'selected' : '' ?>>

                                <?= $status ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

        </div>

    </div>

</div>