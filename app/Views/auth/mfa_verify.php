<!DOCTYPE html>
<html lang="id">

<head>

    <?= $this->include('layouts/header') ?>

</head>

<body class="auth-page">

    <div class="auth-container">

        <div class="auth-card">

            <!-- LEFT -->

            <div class="auth-left">

                <div class="auth-brand">
                    <img
                        src="<?= base_url('assets/images/ULT POLBAN.png') ?>"
                        alt="Logo Politeknik Negeri Bandung">
                </div>

                <div>

                    <span class="system-badge">

                        SI ULT POLBAN

                    </span>

                    <h1>

                        Verifikasi
                        <br>
                        Keamanan

                    </h1>

                    <p>

                        Akun Anda dilindungi oleh Multi-Factor Authentication.

                    </p>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="auth-right">

                <h2>

                    Verifikasi MFA

                </h2>

                <p class="text-muted mb-4">
                    Masukkan 6 digit kode dari aplikasi Google Authenticator Anda.
                </p>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('mfa/verify') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4">
                        <label class="form-label">Kode Authenticator</label>
                        <input
                            type="text"
                            name="code"
                            class="form-control text-center fs-3 fw-bold tracking-widest"
                            placeholder="000000"
                            maxlength="6"
                            pattern="\d{6}"
                            autofocus
                            required>
                    </div>

                    <button class="btn btn-primary w-100">
                        <i class="bi bi-unlock me-2"></i> Verifikasi & Login
                    </button>
                    
                    <div class="mt-4 text-center">
                        <a href="<?= base_url('logout') ?>" class="text-danger"><i class="bi bi-x-circle me-1"></i> Batal Login</a>
                    </div>
                </form>

            </div>

        </div>

    </div>

    <?= $this->include('layouts/footer') ?>

</body>

</html>
