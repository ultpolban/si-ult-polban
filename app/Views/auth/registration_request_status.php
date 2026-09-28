<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($title ?? 'Status Permintaan Registrasi') ?> - SI ULT POLBAN</title>

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

                            Status<br>

                            Permintaan Registrasi

                        </h1>

                        <p>

                            Periksa status permintaan izin

                            registrasi Anda.

                        </p>

                    </div>

                    <div class="auth-icon">

                        <i class="fas fa-search"></i>

                    </div>

                </div>

                <!-- Right -->
                <div class="auth-right">

                    <div class="text-center mb-4">

                        <img src="<?= base_url('assets/img/logo.svg') ?>"
                            alt="Logo"
                            width="72">

                        <h2 class="mt-3 mb-1">Cek Status</h2>

                        <p>Masukkan email yang digunakan saat mengajukan</p>

                    </div>

                    <?php if (session()->getFlashdata('success')) : ?>

                        <div class="alert alert-success">

                            <i class="fas fa-check-circle me-2"></i>

                            <?= esc(session()->getFlashdata('success')) ?>

                        </div>

                    <?php endif; ?>

                    <?php if (session()->getFlashdata('error')) : ?>

                        <div class="alert alert-danger">

                            <i class="fas fa-exclamation-circle me-2"></i>

                            <?= esc(session()->getFlashdata('error')) ?>

                        </div>

                    <?php endif; ?>
<form
                        action="<?= base_url('registration-request/status') ?>"
                        method="get">

                        <div class="input-group mb-3">

                            <span class="input-group-text">

                                <i class="fas fa-envelope"></i>

                            </span>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="Masukkan email"
                                value="<?= esc($email ?? '') ?>"
                                required>

                            <button class="btn btn-primary">

                                <i class="fas fa-search"></i>

                            </button>

                        </div>

                    </form>

                    <?php if ($email !== '') : ?>

                        <?php if (! $request) : ?>

                            <div class="alert alert-warning">

                                <i class="fas fa-exclamation-triangle me-2"></i>

                                Tidak ditemukan permintaan untuk email

                                <strong><?= esc($email) ?></strong>.

                            </div>

                        <?php else : ?>

                            <div class="card border shadow-sm">

                                <div class="card-body">

                                    <h5 class="card-title mb-3"><?= esc($request['full_name']) ?></h5>

                                    <p class="mb-1 text-muted small"><?= esc($request['email']) ?></p>

                                    <p class="text-muted small">
                                        Diajukan: <?= esc($request['created_at']) ?>
                                    </p>
<?php if ($request['status'] === 'pending') : ?>

                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-clock me-1"></i>Menunggu Persetujuan
                                        </span>

                                        <p class="mt-3 mb-0 text-muted small">
                                            Permintaan Anda sedang diperiksa oleh admin.
                                        </p>

                                    <?php elseif ($request['status'] === 'approved') : ?>

                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i>Disetujui
                                        </span>

                                        <p class="mt-3 mb-0">
                                            Permintaan izin registrasi Anda telah disetujui.
                                            Akun Anda sudah dibuat dan menunggu aktivasi.
                                        </p>

                                        <p class="mt-2 mb-0 text-muted small">
                                            Lanjutkan untuk menyiapkan verifikasi dua langkah (MFA)
                                            agar akun dapat digunakan.
                                        </p>

                                        <a
                                            href="<?= base_url('register') ?>"
                                            class="btn btn-success w-100 mt-3">

                                            <i class="fas fa-user-plus me-2"></i>

                                            Lanjutkan Registrasi

                                        </a>

                                    <?php elseif ($request['status'] === 'rejected') : ?>

                                        <span class="badge bg-danger">
                                            <i class="fas fa-times-circle me-1"></i>Ditolak
                                        </span>

                                        <p class="mt-3 mb-0 text-muted small">
                                            Maaf, permintaan izin registrasi Anda ditolak.
                                        </p>

                                        <?php if (! empty($request['rejection_reason'])) : ?>

                                            <div class="alert alert-danger py-2 mt-2 mb-0 small">
                                                <strong>Alasan:</strong> <?= esc($request['rejection_reason']) ?>
                                            </div>

                                        <?php endif; ?>

                                        <p class="mt-2 mb-0 text-muted small">
                                            Anda dapat mengajukan kembali jika diperlukan.
                                        </p>

                                        <a
                                            href="<?= base_url('registration-request') ?>"
                                            class="btn btn-outline-primary w-100 mt-3">

                                            <i class="fas fa-redo me-2"></i>

                                            Ajukan Ulang

                                        </a>

                                    <?php endif; ?>

                                </div>

                            </div>

                        <?php endif; ?>

                    <?php endif; ?>
<div class="text-center mt-3">

                        <small class="text-muted">

                            Belum mengajukan?

                            <a href="<?= base_url('registration-request') ?>">

                                Ajukan permintaan

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