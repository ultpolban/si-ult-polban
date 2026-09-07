<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($title ?? 'Registrasi') ?> - SI ULT POLBAN</title>

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

                            Bergabung Dengan<br>

                            SI ULT POLBAN

                        </h1>

                        <p>

                            Daftar sebagai pemohon layanan.

                            Lengkapi data sesuai jenis pemohon Anda.

                        </p>

                        <div class="mt-3 alert alert-light border small">

                            <i class="fas fa-shield-hot me-2"></i>

                            Setelah mendaftar, pindai kode QR MFA

                            di aplikasi authenticator lalu masukkan

                            kode verifikasi untuk mengaktifkan akun.

                        </div>

                    </div>

                    <div class="auth-icon">

                        <i class="fas fa-user-plus"></i>

                    </div>

                </div>

                <!-- Right -->
                <div class="auth-right">
<div class="text-center mb-4">

                        <img src="<?= base_url('assets/images/logo.svg') ?>"
                            alt="Logo"
                            width="64">

                        <h2 class="mt-3 mb-1">Buat Akun Pemohon</h2>

                        <p>Pilih jenis pemohon untuk menyesuaikan formulir</p>

                    </div>

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

                    <form action="<?= base_url('register') ?>"
                        method="post"
                        id="registerForm">

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

                                <?php foreach ($applicantTypes as $at) : ?>

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

                            <?= $this->include('auth/_register_fields') ?>

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100 mt-2">

                            <i class="fas fa-user-plus me-2"></i>

                            Daftar

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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(function() {

            const fieldsUrl = "<?= base_url('register/fields') ?>";

            const $dynamicFields = $('#dynamicFields');
            const $applicantType = $('#applicantType');

            function loadFields(id) {

                if (!id) {
                    $dynamicFields.html(
                        '<p class="text-muted text-center py-3">Pilih jenis pemohon terlebih dahulu.</p>'
                    );
                    return;
                }

                $.get(fieldsUrl + '/' + id, function(res) {

                    if (res) {
                        $dynamicFields.html(res);
                    }

                });

            }

            $applicantType.on('change', function() {
                loadFields($(this).val());
            });

        });
    </script>

</body>

</html>