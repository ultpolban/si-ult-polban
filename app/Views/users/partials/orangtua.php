<div id="orangtuaForm" class="dynamic-section" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-warning">

            <h5 class="mb-0">

                Data Orang Tua / Wali

            </h5>

        </div>

        <div class="card-body">

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

                        <option value="Ayah"
                            <?= old('relationship', $user['relationship'] ?? '') == 'Ayah' ? 'selected' : '' ?>>
                            Ayah
                        </option>

                        <option value="Ibu"
                            <?= old('relationship', $user['relationship'] ?? '') == 'Ibu' ? 'selected' : '' ?>>
                            Ibu
                        </option>

                        <option value="Wali"
                            <?= old('relationship', $user['relationship'] ?? '') == 'Wali' ? 'selected' : '' ?>>
                            Wali
                        </option>

                    </select>

                </div>

                <!-- NIK -->

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        NIK

                    </label>

                    <input
                        type="text"
                        name="identity_number"
                        class="form-control"
                        value="<?= old('identity_number', $user['identity_number'] ?? '') ?>">

                </div>

                <!-- No HP -->

                <div class="col-md-4 mb-3">

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

            <hr>

            <h6 class="mb-3">

                Data Mahasiswa

            </h6>

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
                        value="<?= old('student_name', $user['student_name'] ?? '') ?>">

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
                        value="<?= old('student_nim', $user['student_nim'] ?? '') ?>">

                </div>

            </div>

        </div>

    </div>

</div>