<?php
/**
 * app/Views/auth/_register_fields.php
 *
 * Form tambahan berdasarkan jenis pemohon.
 *
 * Variabel:
 * $applicantCode
 * $applicantType
 * $studyPrograms
 * $classes
 */

$applicantCode = strtoupper($applicantCode ?? 'UMUM');
?>

<!-- =========================================================
     MAHASISWA
     ========================================================= -->
<?php if ($applicantCode === 'MHS'): ?>

    <div class="mb-3">
        <label for="full_name" class="form-label">
            Nama Lengkap <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="full_name"
            id="full_name"
            class="form-control"
            value="<?= old('full_name') ?>"
            placeholder="Masukkan nama lengkap"
            required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">
            Email <span class="text-danger">*</span>
        </label>

        <input
            type="email"
            name="email"
            id="email"
            class="form-control"
            value="<?= old('email') ?>"
            placeholder="Masukkan email"
            required>
    </div>

    <div class="mb-3">
        <label for="nim" class="form-label">
            NIM <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="nim"
            id="nim"
            class="form-control"
            value="<?= old('nim') ?>"
            placeholder="Masukkan NIM"
            required>
    </div>

    <div class="mb-3">
        <label for="study_program_id" class="form-label">
            Program Studi <span class="text-danger">*</span>
        </label>

        <select
            name="study_program_id"
            id="study_program_id"
            class="form-select"
            required>

            <option value="">
                -- Pilih Program Studi --
            </option>

            <?php foreach (($studyPrograms ?? []) as $program): ?>

                <option
                    value="<?= $program['id'] ?>"
                    <?= old('study_program_id') == $program['id'] ? 'selected' : '' ?>>

                    <?= esc($program['name']) ?>

                </option>

            <?php endforeach; ?>

        </select>
    </div>

    <div class="mb-3">
        <label for="class_id" class="form-label">
            Kelas <span class="text-danger">*</span>
        </label>

        <select
            name="class_id"
            id="class_id"
            class="form-select"
            required>

            <option value="">
                -- Pilih Kelas --
            </option>

            <?php foreach (($classes ?? []) as $class): ?>

                <option
                    value="<?= $class['id'] ?>"
                    <?= old('class_id') == $class['id'] ? 'selected' : '' ?>>

                    <?= esc($class['name']) ?>

                </option>

            <?php endforeach; ?>

        </select>
    </div>

    <div class="mb-3">
        <label for="phone_number" class="form-label">
            Nomor HP
        </label>

        <input
            type="text"
            name="phone_number"
            id="phone_number"
            class="form-control"
            value="<?= old('phone_number') ?>"
            placeholder="Masukkan nomor HP">
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">
            Alamat
        </label>

        <textarea
            name="address"
            id="address"
            class="form-control"
            rows="3"
            placeholder="Masukkan alamat"><?= old('address') ?></textarea>
    </div>

<?php endif; ?>


<!-- =========================================================
     ALUMNI
     ========================================================= -->
<?php if ($applicantCode === 'ALUMNI'): ?>

    <div class="mb-3">
        <label for="full_name" class="form-label">
            Nama Lengkap <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="full_name"
            id="full_name"
            class="form-control"
            value="<?= old('full_name') ?>"
            required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">
            Email <span class="text-danger">*</span>
        </label>

        <input
            type="email"
            name="email"
            id="email"
            class="form-control"
            value="<?= old('email') ?>"
            required>
    </div>

    <div class="mb-3">
        <label for="nim" class="form-label">
            NIM
        </label>

        <input
            type="text"
            name="nim"
            id="nim"
            class="form-control"
            value="<?= old('nim') ?>">
    </div>

<?php endif; ?>


<!-- =========================================================
     TENDIK
     ========================================================= -->
<?php if ($applicantCode === 'TENDIK'): ?>

    <div class="mb-3">
        <label for="full_name" class="form-label">
            Nama Lengkap <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="full_name"
            id="full_name"
            class="form-control"
            value="<?= old('full_name') ?>"
            required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">
            Email <span class="text-danger">*</span>
        </label>

        <input
            type="email"
            name="email"
            id="email"
            class="form-control"
            value="<?= old('email') ?>"
            required>
    </div>

    <div class="mb-3">
        <label for="position" class="form-label">
            Jabatan
        </label>

        <input
            type="text"
            name="position"
            id="position"
            class="form-control"
            value="<?= old('position') ?>">
    </div>

<?php endif; ?>


<!-- =========================================================
     DOSEN
     ========================================================= -->
<?php if ($applicantCode === 'DOSEN'): ?>

    <div class="mb-3">
        <label for="full_name" class="form-label">
            Nama Lengkap <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="full_name"
            id="full_name"
            class="form-control"
            value="<?= old('full_name') ?>"
            required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">
            Email <span class="text-danger">*</span>
        </label>

        <input
            type="email"
            name="email"
            id="email"
            class="form-control"
            value="<?= old('email') ?>"
            required>
    </div>

    <div class="mb-3">
        <label for="position" class="form-label">
            Jabatan
        </label>

        <input
            type="text"
            name="position"
            id="position"
            class="form-control"
            value="<?= old('position') ?>">
    </div>

<?php endif; ?>


<!-- =========================================================
     MITRA
     ========================================================= -->
<?php if ($applicantCode === 'MITRA'): ?>

    <div class="mb-3">
        <label for="full_name" class="form-label">
            Nama Lengkap <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="full_name"
            id="full_name"
            class="form-control"
            value="<?= old('full_name') ?>"
            required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">
            Email <span class="text-danger">*</span>
        </label>

        <input
            type="email"
            name="email"
            id="email"
            class="form-control"
            value="<?= old('email') ?>"
            required>
    </div>

    <div class="mb-3">
        <label for="institution_name" class="form-label">
            Nama Instansi / Perusahaan
        </label>

        <input
            type="text"
            name="institution_name"
            id="institution_name"
            class="form-control"
            value="<?= old('institution_name') ?>">
    </div>

    <div class="mb-3">
        <label for="position" class="form-label">
            Jabatan
        </label>

        <input
            type="text"
            name="position"
            id="position"
            class="form-control"
            value="<?= old('position') ?>">
    </div>

<?php endif; ?>


<!-- =========================================================
     WALI
     ========================================================= -->
<?php if ($applicantCode === 'WALI'): ?>

    <div class="mb-3">
        <label for="full_name" class="form-label">
            Nama Lengkap <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="full_name"
            id="full_name"
            class="form-control"
            value="<?= old('full_name') ?>"
            required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">
            Email <span class="text-danger">*</span>
        </label>

        <input
            type="email"
            name="email"
            id="email"
            class="form-control"
            value="<?= old('email') ?>"
            required>
    </div>

    <div class="mb-3">
        <label for="nik" class="form-label">
            NIK
        </label>

        <input
            type="text"
            name="nik"
            id="nik"
            class="form-control"
            value="<?= old('nik') ?>">
    </div>

<?php endif; ?>


<!-- =========================================================
     UMUM
     ========================================================= -->
<?php if ($applicantCode === 'UMUM' || $applicantCode === ''): ?>

    <div class="mb-3">
        <label for="full_name" class="form-label">
            Nama Lengkap <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="full_name"
            id="full_name"
            class="form-control"
            value="<?= old('full_name') ?>"
            required>
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">
            Email <span class="text-danger">*</span>
        </label>

        <input
            type="email"
            name="email"
            id="email"
            class="form-control"
            value="<?= old('email') ?>"
            placeholder="Masukkan email"
            required>
    </div>

<?php endif; ?>


<!-- =========================================================
     PASSWORD
     ========================================================= -->

<div class="mb-3">
    <label for="password" class="form-label">
        Password <span class="text-danger">*</span>
    </label>

    <input
        type="password"
        name="password"
        id="password"
        class="form-control"
        placeholder="Minimal 8 karakter"
        minlength="8"
        required>
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">
        Konfirmasi Password <span class="text-danger">*</span>
    </label>

    <input
        type="password"
        name="password_confirmation"
        id="password_confirmation"
        class="form-control"
        placeholder="Ulangi password"
        minlength="8"
        required>
</div>