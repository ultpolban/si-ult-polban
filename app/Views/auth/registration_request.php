<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($title ?? 'Permintaan Izin Registrasi') ?> - SI ULT POLBAN</title>

    <link rel="icon" href="<?= base_url('assets/img/favicon.svg') ?>">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="<?= base_url('assets/css/app.css') ?>">

</head>

<body>

    <div class="auth-page">

        <div class="auth-container auth-register">

            <div class="auth-card">

                <!-- Left -->
                <div class="auth-left">

                    <div>

                        <span class="system-badge">

                            <i class="fas fa-star me-1"></i>

                            Layanan Terpadu

                        </span>

                        <h1>

                            Permintaan Izin<br>

                            Registrasi

                        </h1>

                        <p>

                            Lengkapi data Anda untuk mengajukan izin

                            registrasi sebagai pemohon layanan.

                        </p>

                        <div class="mt-3 alert alert-light border small">

                            <i class="fas fa-shield-alt me-2"></i>

                            Permintaan Anda akan diperiksa admin. Setelah disetujui,

                            akun pemohon dibuat dan Anda menyiapkan verifikasi dua

                            langkah (MFA) sebelum dapat login.

                        </div>

                    </div>

                    <div class="auth-icon">

                        <i class="fas fa-user-lock"></i>

                    </div>

                </div>

                <!-- Right -->
                <div class="auth-right">

                    <div class="text-center mb-4">

                        <img src="<?= base_url('assets/img/logo.svg') ?>"
                            alt="Logo"
                            width="64">

                        <h2 class="mt-3 mb-1">Minta Izin Registrasi</h2>

                        <p>Pilih jenis pemohon untuk menyesuaikan formulir</p>

                    </div>

                    <?php if (session()->getFlashdata('info')) : ?>

                        <div class="alert alert-info">

                            <i class="fas fa-info-circle me-2"></i>

                            <?= esc(session()->getFlashdata('info')) ?>

                        </div>

                    <?php endif; ?>

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

                    <?php if (session()->getFlashdata('errors')) : ?>

                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>

                            <div class="alert alert-danger py-2">

                                <i class="fas fa-exclamation-circle me-2"></i>

                                <?= esc($error) ?>

                            </div>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    <form action="<?= base_url('registration-request') ?>"
                        method="post"
                        id="registrationRequestForm">

                        <?= csrf_field(); ?>

                        <!-- Step 1: Pilih Jenis Pemohon -->
                        <div class="mb-3">

                            <label class="form-label fw-bold">

                                Jenis Pemohon <span class="text-danger">*</span>

                            </label>

                            <select
                                name="applicant_type_id"
                                id="applicantType"
                                class="form-select"
                                required>

                                <option value="">-- Pilih Jenis Pemohon --</option>

                                <?php foreach (($applicantTypes ?? []) as $at) : ?>

                                    <option value="<?= $at['id'] ?>"
                                        data-code="<?= esc($at['code']) ?>"
                                        <?= (string) old('applicant_type_id') === (string) $at['id'] ? 'selected' : '' ?>>

                                        <?= esc($at['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <!-- Step 2: Form dinamis per jenis pemohon -->
                        <div id="dynamicFields">

                            <p class="text-muted text-center py-3">

                                Pilih jenis pemohon terlebih dahulu.

                            </p>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100 mt-2">

                            <i class="fas fa-paper-plane me-2"></i>

                            Kirim Permintaan

                        </button>

                    </form>

                    <div class="text-center mt-3">

                        <small class="text-muted">

                            Sudah mengajukan?

                            <a href="<?= base_url('registration-request/status') ?>">

                                Cek status di sini

                            </a>

                        </small>

                    </div>

                    <div class="text-center mt-2">

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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(function() {

            const fieldsUrl = "<?= base_url('registration-request/fields') ?>";

            const $dynamicFields = $('#dynamicFields');
            const $applicantType = $('#applicantType');

            function loadFields(id) {

                if (!id) {
                    $dynamicFields.html(
                        '<p class="text-muted text-center py-3">Pilih jenis pemohon terlebih dahulu.</p>'
                    );
                    return;
                }

                $dynamicFields.html(
                    '<p class="text-muted text-center py-3">Memuat formulir...</p>'
                );

                $.get(fieldsUrl + '/' + id, function(res) {

                    if (res) {
                        $dynamicFields.html(res);
                    }

                }).fail(function() {

                    $dynamicFields.html(
                        '<p class="text-danger text-center py-3">Gagal memuat formulir jenis pemohon.</p>'
                    );

                });

            }

            $applicantType.on('change', function() {
                loadFields($(this).val());
            });

            // Muat ulang saat halaman kembali dari validasi gagal (old input terisi).
            loadFields($applicantType.val());

        });
    </script>

</body>

</html>