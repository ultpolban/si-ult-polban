<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($title ?? 'Login') ?> - SI ULT POLBAN</title>

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

                            Sistem Informasi<br>

                            Layanan Terpadu<br>

                            POLBAN

                        </h1>

                        <p>

                            Satu pintu untuk seluruh layanan akademik,

                            administrasi, dan kemahasiswaan.

                        </p>

                    </div>

                    <div class="auth-icon">

                        <i class="fas fa-graduation-cap"></i>

                    </div>

                </div>

                <!-- Right -->
                <div class="auth-right">

                    <div class="text-center mb-4">

                        <img src="<?= base_url('assets/images/logo.svg') ?>"
                            alt="Logo"
                            width="72">

                        <h2 class="mt-3 mb-1">Selamat Datang</h2>

                        <p>Silakan login untuk melanjutkan</p>

                    </div>

                    <?php if (session()->getFlashdata('error')) : ?>

                        <div class="alert alert-danger">

                            <i class="fas fa-exclamation-circle me-2"></i>

                            <?= esc(session()->getFlashdata('error')) ?>

                        </div>

                    <?php endif; ?>

                    <form action="<?= base_url('login') ?>"
                        method="post">

                        <?= csrf_field(); ?>

                        <div class="mb-3">

                            <label class="form-label">

                                Email / NIM / NIP

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    <i class="fas fa-envelope"></i>

                                </span>

                                <input
                                    type="text"
                                    name="email"
                                    class="form-control"
                                    placeholder="Masukkan email atau NIM"
                                    value="<?= old('email') ?>"
                                    required>

                            </div>

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Password

                            </label>

                            <div class="input-group">

                                <span class="input-group-text">

                                    <i class="fas fa-lock"></i>

                                </span>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Masukkan password"
                                    required>

                            </div>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100">

                            <i class="fas fa-sign-in-alt me-2"></i>

                            Login

                        </button>

                    </form>

                    <div class="text-center mt-3">

                        <small class="text-muted">

                            Belum punya akun?

                            <a href="<?= base_url('register') ?>">

                                Daftar sebagai Pemohon

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