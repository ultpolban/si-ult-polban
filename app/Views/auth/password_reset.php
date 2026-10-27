<?php
$title = 'Reset Password';
$authHeader = 'Atur Ulang Password';
?>

<?= $this->include('auth/_header') ?>

    <div class="auth-logo-sm">
        <img src="<?= base_url('assets/img/logo-polban.png') ?>" alt="Logo POLBAN">
    </div>

    <h2>Atur Password Baru</h2>

    <?php if (! $validToken): ?>
        <div class="alert alert-warning" role="alert">
            Tautan reset tidak valid, sudah kedaluwarsa, atau telah digunakan. Silakan minta tautan baru.
        </div>
        <a href="<?= base_url('password/forgot') ?>" class="btn btn-primary w-100">
            Minta Tautan Reset Baru
        </a>
    <?php else: ?>
        <p>Gunakan password 8 karakter atau lebih, maksimal 72 byte.</p>

        <?= $this->include('auth/_flash') ?>

        <form action="<?= base_url('password/reset/' . rawurlencode($token)) ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label class="form-label" for="password">Password baru</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password"
                           id="password"
                           name="password"
                           class="form-control"
                           autocomplete="new-password"
                           minlength="8"
                           maxlength="72"
                           required>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label" for="password_confirmation">Konfirmasi password baru</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           class="form-control"
                           autocomplete="new-password"
                           minlength="8"
                           maxlength="72"
                           required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-shield-check me-1"></i> Simpan Password Baru
            </button>
        </form>
    <?php endif; ?>

    <p class="text-center mt-3 mb-0" style="font-size:.86rem;">
        <a href="<?= base_url('login/form') ?>">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Login
        </a>
    </p>

<?= $this->include('auth/_footer') ?>