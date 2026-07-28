<?php $errors = session('errors') ?? []; ?>

<div class="card mb-4 shadow-sm">

    <div class="card-header bg-primary text-white">

        <strong>
            <i class="bi bi-person-circle me-2"></i>
            Data Akun
        </strong>

    </div>

    <div class="card-body">

        <!-- ========================= -->
        <!-- Nama Lengkap -->
        <!-- ========================= -->

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Nama Lengkap
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="text"
                    name="full_name"
                    class="form-control <?= isset($errors['full_name']) ? 'is-invalid' : '' ?>"
                    value="<?= old('full_name') ?>">

                <?php if (isset($errors['full_name'])) : ?>
                    <div class="invalid-feedback">
                        <?= $errors['full_name'] ?>
                    </div>
                <?php endif; ?>

            </div>

        </div>

        <!-- ========================= -->
        <!-- Jenis Pemohon -->
        <!-- ========================= -->

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Jenis Pemohon
                    <span class="text-danger">*</span>
                </label>

                <select
                    name="user_type_id"
                    id="user_type_id"
                    class="form-select <?= isset($errors['user_type_id']) ? 'is-invalid' : '' ?>">

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

                <?php if (isset($errors['user_type_id'])) : ?>
                    <div class="invalid-feedback">
                        <?= $errors['user_type_id'] ?>
                    </div>
                <?php endif; ?>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Email Pribadi
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="email"
                    name="personal_email"
                    class="form-control <?= isset($errors['personal_email']) ? 'is-invalid' : '' ?>"
                    value="<?= old('personal_email') ?>">

                <?php if (isset($errors['personal_email'])) : ?>
                    <div class="invalid-feedback">
                        <?= $errors['personal_email'] ?>
                    </div>
                <?php endif; ?>

            </div>

        </div>

        <!-- ========================= -->
        <!-- Email Institusi -->
        <!-- ========================= -->

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Email Institusi

                </label>

                <input
                    type="email"
                    name="institution_email"
                    class="form-control <?= isset($errors['institution_email']) ? 'is-invalid' : '' ?>"
                    value="<?= old('institution_email') ?>">

                <?php if (isset($errors['institution_email'])) : ?>
                    <div class="invalid-feedback">
                        <?= $errors['institution_email'] ?>
                    </div>
                <?php endif; ?>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Foto Profil

                </label>

                <input
                    type="file"
                    name="photo"
                    class="form-control <?= isset($errors['photo']) ? 'is-invalid' : '' ?>"
                    accept=".jpg,.jpeg,.png">

                <?php if (isset($errors['photo'])) : ?>
                    <div class="invalid-feedback">
                        <?= $errors['photo'] ?>
                    </div>
                <?php endif; ?>

            </div>

        </div>

        <!-- ========================= -->
        <!-- Password -->
        <!-- ========================= -->

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Password
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="password"
                    name="password"
                    class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>">

                <?php if (isset($errors['password'])) : ?>
                    <div class="invalid-feedback">
                        <?= $errors['password'] ?>
                    </div>
                <?php endif; ?>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">
                    Konfirmasi Password
                    <span class="text-danger">*</span>
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control <?= isset($errors['password_confirmation']) ? 'is-invalid' : '' ?>">

                <?php if (isset($errors['password_confirmation'])) : ?>
                    <div class="invalid-feedback">
                        <?= $errors['password_confirmation'] ?>
                    </div>
                <?php endif; ?>

            </div>

        </div>

    </div>

</div>