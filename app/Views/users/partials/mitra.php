<div id="mitraForm" class="dynamic-section" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                Data Mitra

            </h5>

        </div>

        <div class="card-body">

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

                    <select
                        name="institution_type"
                        class="form-select">

                        <option value="">Pilih Jenis Instansi</option>

                        <option value="Perguruan Tinggi"
                            <?= old('institution_type', $user['institution_type'] ?? '') == 'Perguruan Tinggi' ? 'selected' : '' ?>>
                            Perguruan Tinggi
                        </option>

                        <option value="Perusahaan"
                            <?= old('institution_type', $user['institution_type'] ?? '') == 'Perusahaan' ? 'selected' : '' ?>>
                            Perusahaan
                        </option>

                        <option value="Instansi Pemerintah"
                            <?= old('institution_type', $user['institution_type'] ?? '') == 'Instansi Pemerintah' ? 'selected' : '' ?>>
                            Instansi Pemerintah
                        </option>

                        <option value="BUMN"
                            <?= old('institution_type', $user['institution_type'] ?? '') == 'BUMN' ? 'selected' : '' ?>>
                            BUMN
                        </option>

                        <option value="BUMD"
                            <?= old('institution_type', $user['institution_type'] ?? '') == 'BUMD' ? 'selected' : '' ?>>
                            BUMD
                        </option>

                        <option value="Lainnya"
                            <?= old('institution_type', $user['institution_type'] ?? '') == 'Lainnya' ? 'selected' : '' ?>>
                            Lainnya
                        </option>

                    </select>

                </div>

            </div>

            <div class="row">

                <!-- Jabatan -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Jabatan

                    </label>

                    <input
                        type="text"
                        name="job_title"
                        class="form-control"
                        value="<?= old('job_title', $user['job_title'] ?? '') ?>">

                </div>

                <!-- NIK -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        NIK / Nomor Identitas

                    </label>

                    <input
                        type="text"
                        name="identity_number"
                        class="form-control"
                        value="<?= old('identity_number', $user['identity_number'] ?? '') ?>">

                </div>

            </div>

            <div class="row">

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