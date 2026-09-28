<?php
/*
 |--------------------------------------------------------------
 | Form dinamis berdasarkan jenis pemohon (Registration Request)
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
        placeholder="Minimal 10 karakter"
        minlength="10"
        maxlength="72"
        pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).+"
        title="Minimal 10 karakter serta memuat huruf besar, huruf kecil, angka, dan simbol."
        autocomplete="new-password"
        required>
    <small class="text-muted">
        Minimal 10 karakter dan harus memuat huruf besar, huruf kecil, angka, serta simbol.
    </small>
</div>

<div class="mb-3">
    <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
    <input
        type="password"
        name="password_confirmation"
        class="form-control"
        placeholder="Ulangi password"
        minlength="10"
        maxlength="72"
        autocomplete="new-password"
        required>
</div>

<div class="mb-3">
    <label class="form-label">Keperluan</label>
    <textarea
        name="purpose"
        class="form-control"
        rows="3"
        placeholder="Jelaskan alasan / keperluan meminta akses registrasi"
        maxlength="1000"><?= esc(old('purpose') ?? ($data['purpose'] ?? '')) ?></textarea>
</div>
