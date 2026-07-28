<?php $errors = session('errors') ?? []; ?>

<div id="form-dosen" class="dynamic-form" style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-success text-white">
            <h5 class="mb-0">
                <i class="bi bi-person-workspace me-2"></i>
                Data Dosen
            </h5>
        </div>

        <div class="card-body">

            <h6 class="border-bottom pb-2 mb-3 text-success">
                Identitas Dosen
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

                    <?php if (isset($errors['nip'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['nip'] ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">
                        NIDN
                    </label>

                    <input
                        type="text"
                        name="nidn"
                        class="form-control <?= isset($errors['nidn']) ? 'is-invalid' : '' ?>"
                        value="<?= old('nidn') ?>">

                    <?php if (isset($errors['nidn'])): ?>
                        <div class="invalid-feedback">
                            <?= $errors['nidn'] ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Jurusan
                        <span class="text-danger">*</span>
                    </label>

                    <select
                        name="department_id"
                        class="form-select <?= isset($errors['department_id']) ? 'is-invalid' : '' ?>">

                        <option value="">-- Pilih Jurusan --</option>

                        <?php foreach ($departments as $department): ?>

                            <option
                                value="<?= $department['id'] ?>"
                                <?= old('department_id') == $department['id'] ? 'selected' : '' ?>>

                                <?= esc($department['department_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

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

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">
                        Jabatan Akademik
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="academic_position"
                        class="form-control <?= isset($errors['academic_position']) ? 'is-invalid' : '' ?>"
                        value="<?= old('academic_position') ?>"
                        placeholder="Contoh : Lektor">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label fw-semibold">
                        Jabatan Fungsional
                        <span class="text-danger">*</span>
                    </label>

                    <input
                        type="text"
                        name="functional_position"
                        class="form-control <?= isset($errors['functional_position']) ? 'is-invalid' : '' ?>"
                        value="<?= old('functional_position') ?>"
                        placeholder="Contoh : Asisten Ahli">

                </div>

                <div class="col-md-4 mb-3">

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
                        <option value="Tetap">Tetap</option>
                        <option value="Kontrak">Kontrak</option>

                    </select>

                </div>

            </div>

        </div>

    </div>

</div>