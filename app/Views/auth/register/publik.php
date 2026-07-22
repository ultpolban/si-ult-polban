<div id="form-publik" class="dynamic-form" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">
                Data Pengguna Umum
            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <!-- Nomor Identitas -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Nomor Identitas (KTP/Paspor)
                    </label>

                    <input
                        type="text"
                        name="identity_number"
                        class="form-control"
                        value="<?= old('identity_number') ?>">

                </div>

                <!-- Pekerjaan -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Pekerjaan
                    </label>

                    <input
                        type="text"
                        name="job_title"
                        class="form-control"
                        value="<?= old('job_title') ?>">

                </div>

                <!-- Instansi -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Instansi
                    </label>

                    <input
                        type="text"
                        name="institution_name"
                        class="form-control"
                        value="<?= old('institution_name') ?>">

                </div>

            </div>

            <div class="row">

                <!-- Jenis Instansi -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Jenis Instansi
                    </label>

                    <select
                        name="institution_type"
                        class="form-select">

                        <option value="">Pilih Jenis Instansi</option>

                        <option value="Pemerintah">Pemerintah</option>
                        <option value="Swasta">Swasta</option>
                        <option value="Sekolah">Sekolah</option>
                        <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                        <option value="LSM">LSM</option>
                        <option value="Masyarakat">Masyarakat</option>
                        <option value="Lainnya">Lainnya</option>

                    </select>

                </div>

                <!-- Website -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Website (Opsional)
                    </label>

                    <input
                        type="url"
                        name="website"
                        class="form-control"
                        placeholder="https://">

                </div>

            </div>

            <div class="row">

                <!-- Alamat Instansi -->
                <div class="col-md-12 mb-3">

                    <label class="form-label">
                        Alamat Instansi
                    </label>

                    <textarea
                        name="institution_address"
                        rows="3"
                        class="form-control"><?= old('institution_address') ?></textarea>

                </div>

            </div>

        </div>

    </div>

</div>