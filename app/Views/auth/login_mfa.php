<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($title ?? 'Verifikasi Dua Langkah') ?> - SI ULT POLBAN</title>

    <link rel="icon" href="<?= base_url('assets/img/favicon.svg') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/app.css') ?>">

</head>

<body>

    <div class="auth-page">

        <div class="auth-container">

            <div class="auth-card">

                <!-- Left -->
                <div class="auth-left">

                    <div>

                        <span class="system-badge">

                            <i class="fas fa-shield-halved me-1"></i>

                            Keamanan Berlapis

                        </span>

                        <h1>

                            Verifikasi<br>

                            Dua Langkah<br>

                            (MFA)

                        </h1>

                        <p>

                            Lindungi akun Anda dengan kode sekali pakai

                            dari aplikasi authenticator atau kode pemulihan.

                        </p>

                    </div>

                    <div class="auth-icon">

                        <i class="fas fa-shield-halved"></i>

                    </div>

                </div>

                <!-- Right -->
                <div class="auth-right">

                    <div class="text-center mb-4">

                        <img src="<?= base_url('assets/adminlte/img/logo.png') ?>"

                            alt="Logo"

                            width="72">

                        <h2 class="mt-3 mb-1">Verifikasi Dua Langkah</h2>

                        <p class="text-muted mb-0">

                            <?= esc($account['full_name'] ?? '') ?> -

                            <?= esc($account['email'] ?? '') ?>

                        </p>

                    </div>

                    <?php if (session()->getFlashdata('error')) : ?>

                        <div class="alert alert-danger">

                            <i class="fas fa-exclamation-circle me-2"></i>

                            <?= esc(session()->getFlashdata('error')) ?>

                        </div>

                    <?php endif; ?>

                    <form action="<?= base_url('login/mfa/verify') ?>"

                        method="post">

                        <?= csrf_field(); ?>

                        <div class="mb-3">

                            <label class="form-label">

                                Kode MFA / Kode Pemulihan

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    <i class="fas fa-key"></i>

                                </span>

                                <input

                                    type="text"

                                    name="mfa_code"

                                    class="form-control text-center font-monospace"

                                    placeholder="Masukkan 6 digit kode"

                                    inputmode="text"

                                    maxlength="20"

                                    autocomplete="one-time-code"

                                    autofocus

                                    value="<?= esc(old('mfa_code')) ?>"

                                    required>

                            </div>

                        </div>

                        <button

                            type="submit"

                            class="btn btn-primary w-100">

                            <i class="fas fa-shield-halved me-2"></i>

                            Verifikasi &amp; Masuk

                        </button>

                    </form>

                    <div class="text-center mt-3">

                        <a href="<?= base_url('login') ?>">

                            <small>

                                <i class="fas fa-arrow-left me-1"></i>

                                Kembali ke Login

                            </small>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>