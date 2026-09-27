<?php
/*
 |--------------------------------------------------------------
 | Form dinamis berdasarkan jenis pemohon (Registrasi)
 | Variabel: $applicantCode, $applicantType, $studyPrograms, $classes
 |--------------------------------------------------------------
 */
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
        placeholder="Minimal 8 karakter"
        minlength="8"
        required>
</div>

<div class="mb-3">
    <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
    <input
        type="password"
        name="password_confirmation"
        class="form-control"
        placeholder="Ulangi password"
        minlength="8"
        required>
</div>