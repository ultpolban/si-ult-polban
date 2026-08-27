<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">

            <i class="bi bi-person-badge-fill me-2"></i>

            Data Akun

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <!-- ==========================================
            ROLE
            =========================================== -->

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Role

                    <span class="text-danger">*</span>

                </label>

                <select
                    id="role_id"
                    name="role_id"
                    class="form-select"
                    required>

                    <option value="">

                        -- Pilih Role --

                    </option>

                    <?php foreach ($roles as $role): ?>

                        <option
                            value="<?= $role['id'] ?>"
                            <?= old('role_id', $user['role_id'] ?? '') == $role['id'] ? 'selected' : '' ?>>

                            <?= esc($role['role_name'] ?? $role['name'] ?? '-') ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <!-- ==========================================
            JENIS PEMOHON
            =========================================== -->

            <div
                class="col-md-6 mb-3"
                id="user-type-wrapper">

                <label class="form-label fw-semibold">

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
                            <?= old('user_type_id', $user['user_type_id'] ?? '') == $type['id'] ? 'selected' : '' ?>>

                            <?= esc($type['type_name']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </div>

        <div class="row">

            <!-- ==========================================
            NAMA
            =========================================== -->

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

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

            <!-- ==========================================
            STATUS
            =========================================== -->

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Status Akun

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

        <div class="row">

            <!-- ==========================================
            EMAIL PRIBADI
            =========================================== -->

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Email Pribadi

                    <span class="text-danger">*</span>

                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="<?= old('email', $user['personal_email'] ?? '') ?>"
                    required>

            </div>

            <!-- ==========================================
            EMAIL INSTITUSI
            =========================================== -->

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Email Institusi

                </label>

                <input
                    type="email"
                    name="institution_email"
                    class="form-control"
                    value="<?= old('institution_email', $user['institution_email'] ?? '') ?>">

            </div>

        </div>

        <div class="row">

            <!-- ==========================================
            PASSWORD
            =========================================== -->

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Password

                    <?php if (empty($user)) : ?>

                        <span class="text-danger">*</span>

                    <?php endif; ?>

                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    <?= empty($user) ? 'required' : '' ?>>

                <?php if (!empty($user)) : ?>

                    <small class="text-muted">

                        Kosongkan jika password tidak ingin diubah.

                    </small>

                <?php endif; ?>

            </div>

            <!-- ==========================================
            KONFIRMASI PASSWORD
            =========================================== -->

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Konfirmasi Password

                    <?php if (empty($user)) : ?>

                        <span class="text-danger">*</span>

                    <?php endif; ?>

                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    <?= empty($user) ? 'required' : '' ?>>

            </div>

        </div>

        <div class="row">

            <!-- ==========================================
            FOTO
            =========================================== -->

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Foto Profil

                </label>

                <div class="mb-3">

                    <img
                        id="photo-preview"
                        src="<?= !empty($user['photo']) ? base_url('uploads/users/' . $user['photo']) : '' ?>"
                        class="img-thumbnail"
                        style="<?= empty($user['photo']) ? 'display:none;' : '' ?>"
                        width="150">

                </div>

                <input
                    type="file"
                    name="photo"
                    class="form-control"
                    accept=".jpg,.jpeg,.png">

                <small class="text-muted">

                    Format: JPG, JPEG, PNG. Maksimal 2 MB.

                </small>

            </div>

            <!-- ==========================================
            PREVIEW FOTO
            =========================================== -->

            <div class="col-md-6 mb-3">

                <label class="form-label fw-semibold">

                    Preview Foto

                </label>

                <div>

                    <?php if (!empty($user['photo'])) : ?>

                        <img
                            src="<?= base_url('uploads/users/' . $user['photo']) ?>"
                            class="img-thumbnail"
                            style="width:150px;height:150px;object-fit:cover;"
                            alt="Foto User">

                    <?php else : ?>

                        <div
                            class="border rounded d-flex align-items-center justify-content-center bg-light"
                            style="width:150px;height:150px;">

                            <i
                                class="bi bi-person-circle text-secondary"
                                style="font-size:80px;"></i>

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>
