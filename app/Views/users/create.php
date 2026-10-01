<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="mb-3">

    <h2 class="mb-1">Tambah User</h2>

    <p class="text-muted mb-0">Buat akun pengguna baru pada sistem.</p>

</div>

<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>

<?php endif; ?>

<?php $errors = session()->getFlashdata('errors'); ?>

<?php if (is_array($errors) && $errors !== []): ?>

    <?php foreach ($errors as $error): ?>

        <div class="alert alert-danger"><?= esc($error) ?></div>

    <?php endforeach; ?>

<?php endif; ?>

<div class="card">

    <div class="card-body">

        <form
            method="post"
            action="<?= base_url('users/store') ?>"
            data-lock-submit>

            <?= csrf_field() ?>

            <div class="form-group">

                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>

                <input
                    type="text"
                    name="full_name"
                    class="form-control"
                    value="<?= old('full_name') ?>"
                    maxlength="150"
                    required>

            </div>

            <div class="form-group">

                <label class="form-label">Email <span class="text-danger">*</span></label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="<?= old('email') ?>"
                    maxlength="150"
                    required>

            </div>

            <div class="form-group">

                <label class="form-label">Nomor HP</label>

                <input
                    type="text"
                    name="phone_number"
                    class="form-control"
                    value="<?= old('phone_number') ?>"
                    maxlength="20">

            </div>

            <div class="form-group">

                <label class="form-label">Nomor Identitas (NIK/NIM/NIP)</label>

                <input
                    type="text"
                    name="identity_number"
                    class="form-control"
                    value="<?= old('identity_number') ?>"
                    maxlength="30">

            </div>

            <div class="form-group">

                <label class="form-label">Role <span class="text-danger">*</span></label>

                <select name="role_id" class="form-select" required>

                    <option value="">-- Pilih Role --</option>

                    <?php foreach ($roles as $role): ?>

                        <option
                            value="<?= esc($role['id']) ?>"
                            <?= (string) old('role_id') === (string) $role['id'] ? 'selected' : '' ?>>

                            <?= esc($role['name']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">

                <label class="form-label">Password <span class="text-danger">*</span></label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    minlength="<?= password_min_length() ?>"
                    maxlength="<?= password_max_length() ?>"
                    title="<?= password_hint() ?>"
                    autocomplete="new-password"
                    required>

                <small class="text-muted"><?= password_hint() ?></small>

            </div>

            <button type="submit" class="btn btn-primary">

                <i class="fas fa-save me-1"></i> Simpan

            </button>

            <a href="<?= base_url('users') ?>" class="btn btn-secondary">Batal</a>

        </form>

    </div>

</div>

<?= $this->endSection() ?>
