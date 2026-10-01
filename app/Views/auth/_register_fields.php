<?php
/*
 |--------------------------------------------------------------
 | Form dinamis berdasarkan jenis pemohon (Registrasi)
 | Variabel: $applicantCode, $applicantType, $studyPrograms, $classes
 |--------------------------------------------------------------
 */
helper('security');
?>

<?php
// Pastikan variabel default tersedia
$data = $data ?? [];
?>

<?= $this->include('components/applicant_fields') ?>

<div class="mb-3">
    <label class="form-label">Password <span class="text-danger">*</span></label>
    <input
        type="password"
        name="password"
        class="form-control"
        placeholder="Minimal <?= password_min_length() ?> karakter"
        minlength="<?= password_min_length() ?>"
        maxlength="<?= password_max_length() ?>"
        title="<?= password_hint() ?>"
        autocomplete="new-password"
        required>
    <small class="text-muted">
        <?= password_hint() ?>
    </small>
</div>

<div class="mb-3">
    <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
    <input
        type="password"
        name="password_confirmation"
        class="form-control"
        placeholder="Ulangi password"
        minlength="<?= password_min_length() ?>"
        maxlength="<?= password_max_length() ?>"
        autocomplete="new-password"
        required>
</div>