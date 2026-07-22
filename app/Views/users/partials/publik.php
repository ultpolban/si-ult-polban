<div id="publikForm" class="dynamic-section" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">

                Data Masyarakat Umum

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <!-- NIK -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        NIK

                    </label>

                    <input
                        type="text"
                        name="identity_number"
                        class="form-control"
                        value="<?= old('identity_number', $user['identity_number'] ?? '') ?>">

                </div>

                <!-- Pekerjaan -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Pekerjaan

                    </label>

                    <input
                        type="text"
                        name="job_title"
                        class="form-control"
                        value="<?= old('job_title', $user['job_title'] ?? '') ?>">

                </div>

            </div>

            <div class="row">

                <!-- Instansi -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Instansi (Opsional)

                    </label>

                    <input
                        type="text"
                        name="institution_name"
                        class="form-control"
                        value="<?= old('institution_name', $user['institution_name'] ?? '') ?>">

                </div>

                <!-- No HP -->

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