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

                <div>

                    <span class="system-badge">

                        SI ULT POLBAN

                    </span>

                    <h1>

                        Sistem Informasi
                        <br>
                        Unit Layanan Terpadu

                    </h1>

                    <p>

                        Politeknik Negeri Bandung

                    </p>

                </div>

                <div class="auth-icon">

                    <i class="bi bi-shield-lock-fill"></i>

                </div>

            </div>

            <!-- RIGHT -->

            <div class="auth-right">

                <h2>

                    Login

                </h2>

                <p class="text-muted mb-4">

                    Silakan login menggunakan akun Anda.

                </p>

                <?php if (session()->getFlashdata('error')): ?>

                    <div class="alert alert-danger">

                        <?= session()->getFlashdata('error') ?>

                    </div>

                <?php endif; ?>

                <form action="<?= base_url('login') ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="mb-3">

                        <label class="form-label">

                            Email

                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            placeholder="Masukkan Email"
                            required>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">

                            Password

                        </label>

                        <div class="input-group">

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan Password"
                                required>

                            <button
                                type="button"
                                class="btn btn-outline-secondary"
                                onclick="togglePassword()">

                                <i
                                    id="eye"
                                    class="bi bi-eye">

                                </i>

                            </button>

                        </div>

                    </div>

                    <button
                        class="btn btn-primary w-100">

                        <i class="bi bi-box-arrow-in-right me-2"></i>

                        Login

                    </button>

                </form>

                <div class="text-center mt-4">

                    Belum mempunyai akun?

                    <a href="<?= base_url('register') ?>">

                        Daftar Sekarang

                    </a>

                </div>

            </div>

        </div>

    </div>

    <script>
        function togglePassword() {

            let pass = document.getElementById('password');

            let eye = document.getElementById('eye');

            if (pass.type === "password") {

                pass.type = "text";

                eye.className = "bi bi-eye-slash";

            } else {

                pass.type = "password";

                eye.className = "bi bi-eye";

            }

        }
    </script>

    <?= $this->include('layouts/footer') ?>

</body>

</html>