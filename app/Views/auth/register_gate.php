<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($title ?? 'Verifikasi Izin Registrasi') ?> - SI ULT POLBAN</title>

    <link rel="icon" href="<?= base_url('assets/img/favicon.svg') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">

</head>

<body>

    <div class="auth-page">

        <div class="auth-container">

            <div class="auth-card">

                <!-- Left -->
                <div class="auth-left">

                    <div>

                        <span class="system-badge">

                            <i class="fas fa-star me-1"></i>

                            Layanan Terpadu

                        </span>

                        <h1>

                            Izin<br>

                            Registrasi

                        </h1>

                        <p>

                            Registrasi hanya dapat dilakukan

                            setelah permintaan izin Anda disetujui admin.

                        </p>

                        <div class="mt-3 alert alert-light border small">

                            <i class="fas fa-shield-alt me-2"></i>

                            Masukkan email yang digunakan saat

                            mengajukan permintaan izin registrasi.

                        </div>

                    </div>

                    <div class="auth-icon">

                        <i class="fas fa-shield-halved"></i>

                    </div>

                </div>

                <!-- Right -->
                <div class="auth-right">

                    <div class="text-center mb-4">

                        <img src="<?= base_url('assets/img/logo.svg') ?>"
                            alt="Logo"
                            width="72">

                        <h2 class="mt-3 mb-1">Verifikasi Izin</h2>

                        <p>Periksa izin sebelum melanjutkan registrasi</p>

                    </div>
<?php if (session()->getFlashdata('error')) : ?>

                        <div class="alert alert-danger">

                            <i class="fas fa-exclamation-circle me-2"></i>

                            <?= esc(session()->getFlashdata('error')) ?>

                        </div>

                    <?php endif; ?>

                    <div class="card border shadow-sm mb-3">

                        <div class="card-body">

                            <p class="mb-2">

                                Registrasi saat ini hanya dapat diakses oleh

                                calon pengguna yang permintaan izinnya telah

                                <strong>disetujui admin</strong>.

                            </p>

                            <p class="mb-0 text-muted small">

                                Belum mendapatkan izin?

                                <a href="<?= base_url('registration-request') ?>">

                                    Ajukan permintaan izin registrasi di sini

                                </a>

                            </p>

                        </div>

                    </div>

                    <form action="<?= base_url('register/gate') ?>"
                        method="post">

                        <?= csrf_field(); ?>

                        <div class="mb-3">

                            <label class="form-label">

                                Email yang Disetujui <span class="text-danger">*</span>

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    <i class="fas fa-envelope"></i>

                                </span>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Masukkan email yang telah disetujui"
                                    value="<?= old('email') ?>"
                                    maxlength="150"
                                    required>

                            </div>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            <i class="fas fa-check-circle me-2"></i>

                            Verifikasi

                        </button>

                    </form>

                    <div class="text-center mt-3">

                        <small class="text-muted">

                            Sudah punya akun?

                            <a href="<?= base_url('login') ?>">

                                Login di sini

                            </a>

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>