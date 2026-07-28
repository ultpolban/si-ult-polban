<?php $errors = session('errors') ?? []; ?>

<div id="form-tendik" class="dynamic-form" style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-warning">

            <h5 class="mb-0">
                <i class="bi bi-building me-2"></i>
                Data Tenaga Kependidikan
            </h5>

        </div>

        <div class="card-body">

            <h6 class="border-bottom pb-2 mb-3 text-warning">
                Identitas Tendik
            </h6>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        NIP
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="nip"
                        class="form-control <?= isset($errors['nip']) ? 'is-invalid' : '' ?>"
                        value="<?= old('nip') ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Unit Kerja
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="work_unit_id"
                        class="form-select <?= isset($errors['work_unit_id']) ? 'is-invalid' : '' ?>">

                        <option value="">-- Pilih Unit Kerja --</option>

                        <?php foreach ($workUnits as $unit): ?>

                            <option
                                value="<?= $unit['id'] ?>"
                                <?= old('work_unit_id') == $unit['id'] ? 'selected' : '' ?>>

                                <?= esc($unit['unit_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Status Kepegawaian
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="employee_status"
                        class="form-select <?= isset($errors['employee_status']) ? 'is-invalid' : '' ?>">

                        <option value="">-- Pilih Status --</option>

                        <option value="PNS">PNS</option>
                        <option value="PPPK">PPPK</option>
                        <option value="Tetap">Pegawai Tetap</option>
                        <option value="Kontrak">Pegawai Kontrak</option>

                    </select>

                </div>

            </div>

        </div>

    </div>

</div>