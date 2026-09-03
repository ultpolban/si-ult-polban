<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($title ?? 'Setup MFA') ?> - SI ULT POLBAN</title>

    <link rel="icon" href="<?= base_url('assets/img/favicon.svg') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">

</head>

<body>

    <div class="auth-page">

        <div class="container py-5">

            <div class="row justify-content-center">

                <div class="col-md-8 col-lg-6">

                    <div class="card shadow-sm">

                        <div class="card-body p-4">

                            <div class="text-center mb-3">

                                <img src="<?= base_url('assets/images/logo.svg') ?>"
                                    alt="Logo"
                                    width="64">

                                <h4 class="mt-2 mb-1">Verifikasi Dua Langkah (MFA)</h4>

                                <p class="text-muted mb-0">

                                    <?= esc($account['full_name'] ?? '') ?> -

                                    <?= esc($account['email'] ?? '') ?>

                                </p>

                            </div>

                            <hr>

                            <?php if (session()->getFlashdata('error')) : ?>

                                <div class="alert alert-danger">

                                    <i class="fas fa-exclamation-circle me-2"></i>

                                    <?= esc(session()->getFlashdata('error')) ?>

                                </div>

                            <?php endif; ?>

                            <?php if (session()->getFlashdata('errors')) : ?>

                                <?php foreach (session()->getFlashdata('errors') as $error) : ?>

                                    <div class="alert alert-danger py-2">

                                        <i class="fas fa-exclamation-circle me-2"></i>

                                        <?= esc($error) ?>

                                    </div>

                                <?php endforeach; ?>

                            <?php endif; ?>

                            <h6 class="fw-bold">

                                <span class="badge bg-primary">1</span>

                                Buka aplikasi authenticator

                            </h6>

                            <p class="text-muted small">

                                Buka aplikasi authenticator (Google Authenticator,

                                Microsoft Authenticator, Authy, dll.) lalu pindai

                                kode QR di bawah ini.

                            </p>

                            <div class="text-center my-3">

                                <div id="qrcode"></div>

                            </div>
<div class="row g-2 mb-3">
                                <div class="col">

                                    <label class="form-label small text-muted">

                                        Kode rahasia (manual secret)

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control form-control-sm text-monospace"
                                        value="<?= esc($secret) ?>"
                                        readonly
                                        onclick="this.select()">

                                </div>

                            </div>

                            <hr>

                            <h6 class="fw-bold">

                                <span class="badge bg-primary">2</span>

                                Simpan kode pemulihan (recovery codes)

                            </h6>

                            <p class="text-muted small">

                                Kode di bawah ini (10) hanya bisa digunakan sekali. Simpan

                                di tempat aman. Gunakan kode ini jika kehilangan

                                akses ke aplikasi authenticator.

                            </p>

                            <?php foreach ($recoveryCodes as $code) : ?>

                                <span class="badge bg-light text-dark border d-inline-block mb-1 font-monospace">

                                    <?= esc($code) ?>

                                </span>

                            <?php endforeach; ?>

                            <hr>

                            <h6 class="fw-bold">

                                <span class="badge bg-primary">3</span>

                                Verifikasi kode MFA

                            </h6>

                            <p class="text-muted small">

                                Masukkan 6 digit kode dari aplikasi authenticator

                                untuk mengaktifkan akun.

                            </p>

                            <form action="<?= base_url('register/mfa/verify') ?>"
                                method="post">

                                <?= csrf_field(); ?>

                                <div class="mb-3">

                                    <label class="form-label">

                                        Kode MFA

                                    </label>

                                    <input
                                        type="text"
                                        name="mfa_code"
                                        class="form-control text-center font-monospace"
                                        placeholder="123456"
                                        inputmode="numeric"
                                        maxlength="6"
                                        autocomplete="one-time-code"
                                        value="<?= esc(old('mfa_code')) ?>"
                                        required>

                                </div>

                                <button
                                    type="submit"
                                    class="btn btn-primary w-100">

                                    <i class="fas fa-shield-halved me-2"></i>

                                    Verifikasi &amp; Lengkapi

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            var uri = <?= json_encode($uri) ?>;

            var qr = new QRCode(document.getElementById('qrcode'), {
                text: uri,
                width: 220,
                height: 220,
                colorDark: "#1b2a4a",
                colorLight: "#ffffff",
            });

        });
    </script>

</body>

</html>