<?php
/**
 * Halaman pengajuan izin registrasi.
 *
 * Memakai layout auth bersama (auth/_header + auth/_footer) supaya:
 *   - tema, warna, dan tinggi kartu konsisten dengan login/registrasi
 *   - <select> "Jenis Pemohon" dapat kotak pencarian (Select2)
 */
$title      = $title ?? 'Permintaan Izin Registrasi';
$authHeader = 'Permintaan Izin Registrasi';
?>

<?= $this->include('auth/_header') ?>

    <h2>Minta Izin Registrasi</h2>
    <p>Pilih jenis pemohon untuk menyesuaikan formulir.</p>

    <?= $this->include('auth/_flash') ?>

    <form action="<?= base_url('registration-request') ?>" method="post" id="registrationRequestForm">

        <?= csrf_field() ?>

        <!-- Step 1: Pilih Jenis Pemohon -->
        <div class="mb-3">
            <label class="form-label" for="applicantType">
                Jenis Pemohon <span class="text-danger">*</span>
            </label>

            <select
                name="applicant_type_id"
                id="applicantType"
                class="form-select"
                data-ult-search="1"
                data-ult-placeholder="-- Pilih Jenis Pemohon --"
                required>

                <option value="">-- Pilih Jenis Pemohon --</option>

                <?php foreach (($applicantTypes ?? []) as $at): ?>
                    <option value="<?= $at['id'] ?>"
                        data-code="<?= esc($at['code']) ?>"
                        <?= (string) old('applicant_type_id') === (string) $at['id'] ? 'selected' : '' ?>>
                        <?= esc($at['name']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <!-- Step 2: Form dinamis per jenis pemohon -->
        <div id="dynamicFields">
            <p class="text-muted text-center py-3">
                Pilih jenis pemohon terlebih dahulu.
            </p>
        </div>

        <button type="submit" class="btn btn-primary w-100">
            <i class="bi bi-send me-1"></i> Ajukan Izin
        </button>

    </form>

    <p class="text-center mt-3 mb-0" style="font-size:.86rem;">
        Sudah punya akun? <a href="<?= base_url('login/form') ?>">Login di sini</a>
    </p>

    <p class="text-center mt-2 mb-0" style="font-size:.86rem;">
        <a href="<?= base_url('/') ?>" style="font-weight:500;">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
        </a>
    </p>

<?= $this->section('scripts') ?>

<script>
    (function ($) {
        if (! $) { return; }

        var fieldsUrl   = <?= json_encode(base_url('registration-request/fields')) ?>;
        var $dynamic    = $('#dynamicFields');
        var $applicant  = $('#applicantType');

        function loadFields(id) {
            if (! id) {
                if (window.ultSelects) { window.ultSelects.destroy('#dynamicFields'); }

                $dynamic.html(
                    '<p class="text-muted text-center py-3">Pilih jenis pemohon terlebih dahulu.</p>'
                );

                return;
            }

            $dynamic.html('<p class="text-muted text-center py-3">Memuat formulir...</p>');

            $.get(fieldsUrl + '/' + id, function (res) {
                if (! res) { return; }

                $dynamic.html(res);

                // Form baru memuat <select> -> pastikan bisa dicari
                if (window.ultSelects) { window.ultSelects.refresh('#dynamicFields'); }
            }).fail(function () {
                $dynamic.html(
                    '<p class="text-danger text-center py-3">Gagal memuat formulir jenis pemohon.</p>'
                );
            });
        }

        $applicant.on('change', function () { loadFields($(this).val()); });

        // Muat ulang saat halaman kembali dari validasi gagal
        loadFields($applicant.val());
    })(window.jQuery);
</script>

<?= $this->endSection() ?>

<?= $this->include('auth/_footer') ?>
