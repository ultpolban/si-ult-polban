<?php
$title = 'Lupa Password';
$authHeader = 'Pemulihan Akun SI ULT POLBAN';
?>

<?= $this->include('auth/_header') ?>

    <div class="auth-logo-sm">
        <img src="<?= base_url('assets/img/logo-polban.png') ?>" alt="Logo POLBAN">
    </div>

    <h2>Lupa Password?</h2>
    <p>Masukkan email yang terdaftar. Jika akun aktif, kami akan mengirimkan tautan reset.</p>

    <?= $this->include('auth/_flash') ?>

    <form action="<?= base_url('password/forgot') ?>" method="post">
        <?= csrf_field() ?>

        <div class="mb-4">
            <label class="form-label" for="email">Email terdaftar</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email"
                       id="email"
                       name="email"
                       class="form-control"
                       placeholder="nama@contoh.ac.id"
                       value="<?= esc(old('email')) ?>"
                       autocomplete="email"
                       maxlength="150"
                       required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-send me-1"></i> Kirim Tautan Reset
        </button>
    </form>

    <p class="text-center mt-3 mb-0" style="font-size:.86rem;">
        <a href="<?= base_url('login/form') ?>">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Login
        </a>
    </p>

<?= $this->include('auth/_footer') ?>