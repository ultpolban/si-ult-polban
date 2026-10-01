<?php
$title      = $title ?? 'Verifikasi Izin Registrasi';
$authHeader = 'Izin Registrasi';
?>

<?= $this->include('auth/_header') ?>

    <div class="text-center mb-4">

        <img
            src="<?= base_url('assets/img/logo-polban.png') ?>"
            alt="Logo POLBAN"
            width="72">

        <h2 class="mt-3 mb-1">Verifikasi Izin</h2>

        <p>Periksa izin sebelum melanjutkan registrasi</p>

    </div>

    <?= $this->include('auth/_flash') ?>

    <div class="card border shadow-sm mb-3">

        <div class="card-body">

            <p class="mb-2">

                Registrasi hanya dapat diakses oleh calon pengguna yang
                permintaan izinnya telah <strong>disetujui admin</strong>.

            </p>

            <p class="mb-0 text-muted small">

                Belum mendapatkan izin?

                <a href="<?= base_url('registration-request') ?>">

                    Ajukan permintaan izin registrasi di sini

                </a>

            </p>

        </div>

    </div>

    <form action="<?= base_url('register/gate') ?>" method="post">

        <?= csrf_field() ?>

        <div class="mb-3">

            <label class="form-label">

                Email yang Disetujui <span class="text-danger">*</span>

            </label>

            <div class="input-group">

                <span class="input-group-text"><i class="fas fa-envelope"></i></span>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan email yang telah disetujui"
                    value="<?= old('email') ?>"
                    maxlength="150"
                    autocomplete="email"
                    required>

            </div>

        </div>

        <button type="submit" class="btn btn-primary w-100">

            <i class="fas fa-check-circle me-2"></i> Verifikasi

        </button>

    </form>

        <p class="mt-4 mb-0">

            <small class="text-muted">

                Belum punya izin?

                <a href="<?= base_url('registration-request') ?>">Ajukan izin registrasi</a>

            </small>

        </p>

        <p class="mt-2">

            <small class="text-muted">

                Sudah punya akun?

                <a href="<?= base_url('login/form') ?>">Login di sini</a>

            </small>

        </p>

        <p class="mt-2">

            <a href="<?= base_url('/') ?>" class="text-muted" style="font-weight:400;">

                <i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda

            </a>

        </p>

    </div>

<?= $this->include('auth/_footer') ?>
