<div
    id="tendik-section"
    class="user-type-section"
    style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-secondary text-white">

            <h5 class="mb-0">

                <i class="bi bi-briefcase-fill me-2"></i>

                Data Tenaga Kependidikan

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <!-- ==========================================
                NIP
                =========================================== -->

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

                <!-- ==========================================
                UNIT KERJA
                =========================================== -->

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
                JABATAN
                =========================================== -->

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Jabatan

                    </label>

                    <input
                        type="text"
                        name="position"
                        class="form-control"
                        value="<?= old('position', $user['position'] ?? '') ?>">

                </div>

                <!-- ==========================================
                STATUS PEGAWAI
                =========================================== -->

                <div class="col-md-6 mb-3">

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