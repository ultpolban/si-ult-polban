<div id="form-mitra" class="dynamic-form" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">
                Data Mitra
            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <!-- Nama Instansi -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Nama Instansi
                    </label>

                    <input
                        type="text"
                        name="institution_name"
                        class="form-control"
                        value="<?= old('institution_name') ?>">

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

                        <option value="Perusahaan">Perusahaan</option>
                        <option value="Instansi Pemerintah">Instansi Pemerintah</option>
                        <option value="BUMN">BUMN</option>
                        <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                        <option value="Sekolah">Sekolah</option>
                        <option value="Industri">Industri</option>
                        <option value="Lainnya">Lainnya</option>

                    </select>

                </div>

            </div>

            <div class="row">

                <!-- Jabatan -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Jabatan
                    </label>

                    <input
                        type="text"
                        name="job_title"
                        class="form-control"
                        value="<?= old('job_title') ?>">

                </div>

                <!-- Unit Kerja Tujuan -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Unit Tujuan
                    </label>

                    <select
                        name="work_unit_id"
                        class="form-select">

                        <option value="">
                            Pilih Unit
                        </option>

                        <?php foreach ($workUnits as $unit): ?>

                            <option value="<?= $unit['id'] ?>">
                                <?= esc($unit['unit_name']) ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <!-- Nomor Telepon Kantor -->
                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Telepon Kantor
                    </label>

                    <input
                        type="text"
                        name="office_phone"
                        class="form-control">

                </div>

            </div>

            <div class="row">

                <!-- Website -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Website Instansi
                    </label>

                    <input
                        type="url"
                        name="website"
                        class="form-control"
                        placeholder="https://">

                </div>

                <!-- Alamat Instansi -->
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Alamat Instansi
                    </label>

                    <input
                        type="text"
                        name="institution_address"
                        class="form-control">

                </div>

            </div>

        </div>

    </div>

</div>