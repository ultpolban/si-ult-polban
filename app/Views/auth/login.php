<?php
$title      = 'Login';
$authHeader = 'Selamat Datang di ULT POLBAN';
?>

<?= $this->include('auth/_header') ?>

    <div class="auth-logo-sm">
        <img src="<?= base_url('assets/img/logo-polban.png') ?>" alt="Logo POLBAN">
    </div>

    <h2>Masuk ke Akun Anda</h2>
    <p>Gunakan email, NIM, atau NIP yang terdaftar.</p>

    <?= $this->include('auth/_flash') ?>

    <form action="<?= base_url('login') ?>" method="post">

        <?= csrf_field() ?>

        <div class="mb-3">
            <label class="form-label" for="email">Email / NIM / NIP</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="text"
                       id="email"
                       name="email"
                       class="form-control"
                       placeholder="Masukkan email, NIM, atau NIP"
                       value="<?= old('email') ?>"
                       autocomplete="username"
                       required>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label" for="password">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password"
                       id="password"
                       name="password"
                       class="form-control"
                       placeholder="Masukkan password"
                       autocomplete="current-password"
                       required>
            </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
        </button>

    </form>

    <p class="text-center mt-3 mb-0" style="font-size:.86rem;">
        Belum punya izin? Ajukan izin registrasi
        <a href="<?= base_url('registration-request') ?>">di sini</a>.
    </p>

    <p class="text-center mt-2 mb-0" style="font-size:.86rem;">
        <a href="<?= base_url('/') ?>" style="font-weight:500;">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
        </a>
    </p>

<?= $this->include('auth/_footer') ?>
