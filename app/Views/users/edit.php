<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="mb-3">

    <h2 class="mb-1">Edit User</h2>

    <p class="text-muted mb-0">

        <?= esc($user['full_name'] ?? '') ?> &mdash; <?= esc($user['email'] ?? '') ?>

    </p>

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
            action="<?= base_url('users/update/' . $user['id']) ?>"
            data-lock-submit>

            <?= csrf_field() ?>

            <div class="form-group">

                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>

                <input
                    type="text"
                    name="full_name"
                    class="form-control"
                    value="<?= old('full_name', $user['full_name'] ?? '') ?>"
                    maxlength="150"
                    required>

            </div>

            <div class="form-group">

                <label class="form-label">Email <span class="text-danger">*</span></label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="<?= old('email', $user['email'] ?? '') ?>"
                    maxlength="150"
                    required>

            </div>

            <div class="form-group">

                <label class="form-label">Nomor HP</label>

                <input
                    type="text"
                    name="phone_number"
                    class="form-control"
                    value="<?= old('phone_number', $user['phone_number'] ?? '') ?>"
                    maxlength="20">

            </div>

            <div class="form-group">

                <label class="form-label">Nomor Identitas (NIK/NIM/NIP)</label>

                <input
                    type="text"
                    name="identity_number"
                    class="form-control"
                    value="<?= old('identity_number', $user['identity_number'] ?? '') ?>"
                    maxlength="30">

            </div>

            <div class="form-group">

                <label class="form-label">Role <span class="text-danger">*</span></label>

                <select name="role_id" class="form-select" required>

                    <?php foreach ($roles as $role): ?>

                        <option
                            value="<?= esc($role['id']) ?>"
                            <?= (string) old('role_id', $user['role_id'] ?? '') === (string) $role['id'] ? 'selected' : '' ?>>

                            <?= esc($role['name']) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="form-group">

                <label class="form-label">Status Akun</label>

                <select name="is_active" class="form-select">

                    <option
                        value="1"
                        <?= (int) old('is_active', $user['is_active'] ?? 0) === 1 ? 'selected' : '' ?>>

                        Aktif

                    </option>

                    <option
                        value="0"
                        <?= (int) old('is_active', $user['is_active'] ?? 0) === 0 ? 'selected' : '' ?>>

                        Nonaktif

                    </option>

                </select>

            </div>

            <div class="form-group">

                <label class="form-label">Password Baru</label>

                <input
                    type="password"
                    name="password"
                    class="form-control"
                    minlength="<?= password_min_length() ?>"
                    maxlength="<?= password_max_length() ?>"
                    title="<?= password_hint() ?>"
                    autocomplete="new-password"
                    placeholder="Kosongkan bila tidak diubah">

            </div>

            <button type="submit" class="btn btn-primary">

                <i class="fas fa-save me-1"></i> Simpan Perubahan

            </button>

            <a href="<?= base_url('users') ?>" class="btn btn-secondary">Batal</a>

        </form>

    </div>

</div>

<?= $this->endSection() ?>
