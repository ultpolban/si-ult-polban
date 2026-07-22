<div class="card shadow-sm mb-4">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">

            Data Akun

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <!-- ROLE -->

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Role

                    <span class="text-danger">*</span>

                </label>

                <select
                    name="role_id"
                    id="role_id"
                    class="form-select"
                    required>

                    <option value="">

                        -- Pilih Role --

                    </option>

                    <?php foreach ($roles as $role): ?>

                        <option
                            value="<?= $role['id'] ?>"

                            <?= old('role_id', $user['role_id'] ?? '') == $role['id'] ? 'selected' : '' ?>>

                            <?= esc($role['role_name']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <!-- JENIS PEMOHON -->

            <div
                class="col-md-6 mb-3"
                id="userTypeContainer"
                style="display:none;">

                <label class="form-label">

                    Jenis Pemohon

                </label>

                <select
                    name="user_type_id"
                    id="user_type_id"
                    class="form-select">

                    <option value="">

                        -- Pilih Jenis Pemohon --

                    </option>

                    <?php foreach ($userTypes as $type): ?>

                        <option
                            value="<?= $type['id'] ?>"

                            <?= old('user_type_id', $user['user_type_id'] ?? '') == $type['id'] ? 'selected' : '' ?>>

                            <?= esc($type['type_name']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </div>

        <div class="row">

            <!-- NAMA -->

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Nama Lengkap

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="full_name"
                    class="form-control"
                    value="<?= old('full_name', $user['full_name'] ?? '') ?>"
                    required>

            </div>

            <!-- EMAIL PERSONAL -->

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Email Personal

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="email"
                    name="personal_email"
                    class="form-control"
                    value="<?= old('personal_email', $user['personal_email'] ?? '') ?>"
                    required>

            </div>

        </div>

        <div class="row">

            <!-- EMAIL INSTITUSI -->

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

            <!-- PASSWORD -->

            <div class="col-md-3 mb-3">

                <label class="form-label">

                    Password

                    <?php if (isset($user['id'])): ?>

                        <small class="text-muted">

                            (Kosongkan jika tidak diubah)

                        </small>

                    <?php endif; ?>

                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control">

            </div>

            <!-- STATUS -->

            <div class="col-md-3 mb-3">

                <label class="form-label">

                    Status

                </label>

                <select
                    name="is_active"
                    class="form-select">

                    <option
                        value="1"

                        <?= old('is_active', $user['is_active'] ?? 1) == 1 ? 'selected' : '' ?>>

                        Aktif

                    </option>

                    <option
                        value="0"

                        <?= old('is_active', $user['is_active'] ?? 1) == 0 ? 'selected' : '' ?>>

                        Nonaktif

                    </option>

                </select>

            </div>

        </div>

    </div>

</div>