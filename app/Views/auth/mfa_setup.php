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

                        Setup Autentikasi
                        <br>
                        Dua Faktor

                    </h1>

                    <p>

                        Tingkatkan keamanan akun Anda dengan Google Authenticator.

                    </p>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="auth-right text-center">

                <h2>

                    Setup MFA

                </h2>

                <p class="text-muted mb-4">
                    1. Unduh aplikasi Google Authenticator. <br>
                    2. Pindai QR Code di bawah ini.
                </p>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <div class="mb-4">
                    <img src="<?= $qrImage ?>" alt="QR Code" style="max-width: 200px; border: 1px solid #ddd; padding: 10px; border-radius: 8px;">
                </div>

                <p class="text-muted small mb-3">Atau masukkan kode rahasia: <strong><?= $secret ?></strong></p>

                <form action="<?= base_url('mfa/setup-verify') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-4 text-start">
                        <label class="form-label">Kode Verifikasi 6 Digit</label>
                        <input
                            type="text"
                            name="code"
                            class="form-control text-center fs-4 fw-bold"
                            placeholder="000000"
                            maxlength="6"
                            pattern="\d{6}"
                            required>
                    </div>

                    <button class="btn btn-primary w-100">
                        <i class="bi bi-shield-check me-2"></i> Aktifkan MFA
                    </button>
                </form>

            </div>

        </div>

    </div>

    <?= $this->include('layouts/footer') ?>

</body>

</html>
