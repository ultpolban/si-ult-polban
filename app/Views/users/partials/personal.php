<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            <i class="bi bi-person-vcard-fill me-2"></i>

            Data Pribadi

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <!-- ==========================================
            JENIS KELAMIN
            =========================================== -->

            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">

                    Jenis Kelamin

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="gender"
                    class="form-select"
                    required>

                    <option value="">

                        -- Pilih --

                    </option>

                    <option
                        value="L"
                        <?= old('gender', $user['gender'] ?? '') == 'L' ? 'selected' : '' ?>>

                        Laki-laki

                    </option>

                    <option
                        value="P"
                        <?= old('gender', $user['gender'] ?? '') == 'P' ? 'selected' : '' ?>>

                        Perempuan

                    </option>

                </select>

            </div>

            <!-- ==========================================
            TEMPAT LAHIR
            =========================================== -->

            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">

                    Tempat Lahir

                </label>

                <input
                    type="text"
                    name="birth_place"
                    class="form-control"
                    value="<?= old('birth_place', $user['birth_place'] ?? '') ?>">

            </div>

            <!-- ==========================================
            TANGGAL LAHIR
            =========================================== -->

            <div class="col-md-4 mb-3">

                <label class="form-label fw-semibold">

                    Tanggal Lahir

                </label>

                <input
                    type="date"
                    name="birth_date"
                    class="form-control"
                    value="<?= old('birth_date', $user['birth_date'] ?? '') ?>">

            </div>

        </div>

        <div class="row">

            <!-- ==========================================
            NO HP
            =========================================== -->

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Nomor HP

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    value="<?= old('phone', $user['phone'] ?? '') ?>"
                    placeholder="08xxxxxxxxxx"
                    required>

            </div>

            <!-- ==========================================
            ALAMAT
            =========================================== -->

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Alamat

                    <span class="text-danger">*</span>

                </label>

                <textarea
                    name="address"
                    rows="3"
                    class="form-control"
                    required><?= old('address', $user['address'] ?? '') ?></textarea>

            </div>

        </div>

    </div>

</div>