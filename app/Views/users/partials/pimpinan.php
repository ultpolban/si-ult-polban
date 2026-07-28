<div id="pimpinanForm" class="dynamic-section" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">

                Data Pimpinan

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

                <!-- Jabatan -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Jabatan Pimpinan

                    </label>

                    <select
                        name="position"
                        class="form-select">

                        <option value="">

                            Pilih Jabatan

                        </option>

                        <?php

                        $positions = [

                            'Direktur',

                            'Wakil Direktur I',

                            'Wakil Direktur II',

                            'Wakil Direktur III',

                            'Wakil Direktur IV',

                            'Ketua Jurusan',

                            'Sekretaris Jurusan',

                            'Kepala UPT',

                            'Koordinator Program Studi'

                        ];

                        ?>

                        <?php foreach ($positions as $position): ?>

                            <option
                                value="<?= $position ?>"
                                <?= old('position', $user['position'] ?? '') == $position ? 'selected' : '' ?>>

                                <?= $position ?>

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
                        value="<?= old('institution_email', $user['institution_email'] ?? '') ?>">

                </div>

                <!-- Nomor HP -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Nomor HP

                    </label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="<?= old('phone', $user['phone'] ?? '') ?>">

                </div>

            </div>

        </div>

    </div>

</div>