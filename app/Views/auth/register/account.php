<!-- ===================================================== -->
<!-- DATA AKUN -->
<!-- ===================================================== -->

<div class="card shadow-sm mb-4">

    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Data Akun</h5>
    </div>

    <div class="card-body">

        <div class="row">

            <!-- Nama -->
            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Nama Lengkap
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    class="form-control"
                    name="full_name"
                    value="<?= old('full_name') ?>"
                    required>
            </div>

            <!-- Jenis Pemohon -->
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Jenis Pemohon
                    <span class="text-danger">*</span>
                </label>

                <select
                    name="user_type_id"
                    id="user_type_id"
                    class="form-select"
                    required>

                    <option value="">
                        -- Pilih Jenis Pemohon --
                    </option>

                    <?php foreach ($userTypes as $type): ?>

                        <option
                            value="<?= $type['id'] ?>"
                            <?= old('user_type_id') == $type['id'] ? 'selected' : '' ?>>

                            <?= esc($type['type_name']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </div>

        <div class="row">

            <!-- Email Personal -->
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Email Personal
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="email"
                    name="personal_email"
                    class="form-control"
                    value="<?= old('personal_email') ?>"
                    required>

            </div>

            <!-- Email Institusi -->
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Email Institusi
                </label>

                <input
                    type="email"
                    name="institution_email"
                    class="form-control"
                    value="<?= old('institution_email') ?>">

            </div>

        </div>

        <div class="row">

            <!-- Password -->
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Password
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>

            </div>

            <!-- Konfirmasi -->
            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Konfirmasi Password
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    required>

            </div>

        </div>

    </div>

</div>