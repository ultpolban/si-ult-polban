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

                    <?php if (session()->getFlashdata('success')) : ?>

                        <div class="alert alert-success">

                            <i class="fas fa-check-circle me-2"></i>

                            <?= esc(session()->getFlashdata('success')) ?>

                        </div>

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

                                <?php foreach ($applicantTypes as $at): ?>

                                    <option value="<?= $at['id'] ?>"
                                        data-code="<?= esc($at['code']) ?>"
                                        <?= old('applicant_type_id') == $at['id'] ? 'selected' : '' ?>>

                                        <?= esc($at['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

<div id="dynamicFields">

    <p class="text-muted text-center py-3">
        Pilih jenis pemohon terlebih dahulu.
    </p>

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
$(document).ready(function () {

    const fieldsUrl = "<?= base_url('register/fields') ?>";

    function loadApplicantFields() {

        const applicantTypeId = $('#applicantType').val();

        console.log('Applicant Type ID:', applicantTypeId);
        console.log(
            'Request URL:',
            fieldsUrl + '/' + applicantTypeId
        );

        if (!applicantTypeId) {

            $('#dynamicFields').html(
                '<p class="text-muted text-center py-3">' +
                'Pilih jenis pemohon terlebih dahulu.' +
                '</p>'
            );

            return;
        }

        $.ajax({

            url: fieldsUrl + '/' + applicantTypeId,

            type: 'GET',

            success: function (response) {

                console.log('Response fields:', response);

                $('#dynamicFields').html(response);

            },

            error: function (xhr) {

                console.error(
                    'Gagal mengambil field.'
                );

                console.error(
                    'Status:',
                    xhr.status
                );

                console.error(
                    'Response:',
                    xhr.responseText
                );

                $('#dynamicFields').html(
                    '<div class="alert alert-danger">' +
                    'Gagal memuat form jenis pemohon.' +
                    '</div>'
                );
            }

        });
    }


    // Ketika dropdown berubah
    $('#applicantType').on('change', function () {

        loadApplicantFields();

    });


    // Ketika halaman pertama kali dibuka
    loadApplicantFields();

});
</script>

</body>
</html>