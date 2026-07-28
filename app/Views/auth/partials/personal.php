<?php $errors = session('errors') ?? []; ?>

<div class="card mb-4 shadow-sm">

    <div class="card-header bg-success text-white">

        <strong>
            <i class="bi bi-person-vcard me-2"></i>
            Data Pribadi
        </strong>

    </div>

    <div class="card-body">

        <!-- ========================= -->
        <!-- Tempat & Tanggal Lahir -->
        <!-- ========================= -->

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Tempat Lahir

                </label>

                <input
                    type="text"
                    name="birth_place"
                    class="form-control <?= isset($errors['birth_place']) ? 'is-invalid' : '' ?>"
                    value="<?= old('birth_place') ?>">

                <?php if (isset($errors['birth_place'])) : ?>

                    <div class="invalid-feedback">

                        <?= $errors['birth_place'] ?>

                    </div>

                <?php endif; ?>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Tanggal Lahir

                </label>

                <input
                    type="date"
                    name="birth_date"
                    class="form-control <?= isset($errors['birth_date']) ? 'is-invalid' : '' ?>"
                    value="<?= old('birth_date') ?>">

                <?php if (isset($errors['birth_date'])) : ?>

                    <div class="invalid-feedback">

                        <?= $errors['birth_date'] ?>

                    </div>

                <?php endif; ?>

            </div>

        </div>

        <!-- ========================= -->
        <!-- Jenis Kelamin & Telepon -->
        <!-- ========================= -->

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Jenis Kelamin
                    <span class="text-danger">*</span>

                </label>

                <select
                    name="gender"
                    class="form-select <?= isset($errors['gender']) ? 'is-invalid' : '' ?>">

                    <option value="">

                        -- Pilih Jenis Kelamin --

                    </option>

                    <option
                        value="L"
                        <?= old('gender') == 'L' ? 'selected' : '' ?>>

                        Laki-laki

                    </option>

                    <option
                        value="P"
                        <?= old('gender') == 'P' ? 'selected' : '' ?>>

                        Perempuan

                    </option>

                </select>

                <?php if (isset($errors['gender'])) : ?>

                    <div class="invalid-feedback">

                        <?= $errors['gender'] ?>

                    </div>

                <?php endif; ?>

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Nomor HP
                    <span class="text-danger">*</span>

                </label>

                <input
                    type="text"
                    name="phone"
                    class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
                    value="<?= old('phone') ?>">

                <?php if (isset($errors['phone'])) : ?>

                    <div class="invalid-feedback">

                        <?= $errors['phone'] ?>

                    </div>

                <?php endif; ?>

            </div>

        </div>

        <!-- ========================= -->
        <!-- Alamat -->
        <!-- ========================= -->

        <div class="row">

            <div class="col-md-12 mb-3">

                <label class="form-label">

                    Alamat
                    <span class="text-danger">*</span>

                </label>

                <textarea
                    name="address"
                    rows="4"
                    class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>"><?= old('address') ?></textarea>

                <?php if (isset($errors['address'])) : ?>

                    <div class="invalid-feedback">

                        <?= $errors['address'] ?>

                    </div>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>