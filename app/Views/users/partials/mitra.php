<div
    id="mitra-section"
    class="user-type-section"
    style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">

                <i class="bi bi-buildings-fill me-2"></i>

                Data Mitra

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <!-- ==========================================
                NAMA INSTANSI
                =========================================== -->

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Nama Instansi

                    </label>

                    <input
                        type="text"
                        name="institution_name"
                        class="form-control"
                        value="<?= old('institution_name', $user['institution_name'] ?? '') ?>">

                </div>

                <!-- ==========================================
                JENIS INSTANSI
                =========================================== -->

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Jenis Instansi

                    </label>

                    <input
                        type="text"
                        name="institution_type"
                        class="form-control"
                        value="<?= old('institution_type', $user['institution_type'] ?? '') ?>">

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
                POSISI / JOB TITLE
                =========================================== -->

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Posisi / Job Title

                    </label>

                    <input
                        type="text"
                        name="job_title"
                        class="form-control"
                        value="<?= old('job_title', $user['job_title'] ?? '') ?>">

                </div>

            </div>

        </div>

    </div>

</div>