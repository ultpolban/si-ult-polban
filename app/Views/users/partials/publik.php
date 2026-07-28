<div
    id="publik-section"
    class="user-type-section"
    style="display:none;">

    <div class="card shadow-sm border-0 mb-4">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">

                <i class="bi bi-person-badge-fill me-2"></i>

                Data Masyarakat Umum

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <!-- ==========================================
                NOMOR IDENTITAS
                =========================================== -->

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">

                        Nomor Identitas (KTP/SIM/Paspor)

                    </label>

                    <input
                        type="text"
                        name="identity_number"
                        class="form-control"
                        value="<?= old('identity_number', $user['identity_number'] ?? '') ?>">

                </div>

            </div>

        </div>

    </div>

</div>