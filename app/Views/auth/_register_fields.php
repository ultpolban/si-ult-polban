<?php
/*
 |--------------------------------------------------------------
 | Form dinamis berdasarkan jenis pemohon (Registrasi)
 |--------------------------------------------------------------
 */

$applicantCode = strtoupper((string) ($applicantCode ?? ''));
$studyPrograms = $studyPrograms ?? [];
$classes       = $classes ?? [];
?>

<?php if ($applicantCode === 'MAHASISWA'): ?>

    <div class="mb-3">
        <label class="form-label">
            Program Studi <span class="text-danger">*</span>
        </label>

        <select
            name="study_program_id"
            class="form-select"
            required>
            <option value="">-- Pilih Program Studi --</option>

            <?php foreach ($studyPrograms as $program): ?>
                <option value="<?= esc($program['id'] ?? '') ?>">
                    <?= esc($program['name'] ?? '') ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">
            Kelas <span class="text-danger">*</span>
        </label>

        <select
            name="class_id"
            class="form-select"
            required>
            <option value="">-- Pilih Kelas --</option>

            <?php foreach ($classes as $class): ?>
                <option value="<?= esc($class['id'] ?? '') ?>">
                    <?= esc($class['name'] ?? '') ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

<?php endif; ?>

<div class="mb-3">
    <label class="form-label">
        Password <span class="text-danger">*</span>
    </label>

    <input
        type="password"
        name="password"
        class="form-control"
        placeholder="Minimal 8 karakter"
        minlength="8"
        required>
</div>

<div class="mb-3">
    <label class="form-label">
        Konfirmasi Password <span class="text-danger">*</span>
    </label>

    <input
        type="password"
        name="password_confirmation"
        class="form-control"
        placeholder="Ulangi password"
        minlength="8"
        required>
</div>
