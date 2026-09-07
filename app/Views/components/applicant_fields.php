<?php
/*
 |--------------------------------------------------------------
 | Form dinamis berdasarkan jenis pemohon
 | Variabel:
 | $applicantCode
 | $applicantType
 | $studyPrograms
 | $classes
 | $data
 |
 | Dipakai untuk:
 | - Registrasi
 | - Tambah User
 | - Edit User
 |--------------------------------------------------------------
 */

$applicantCode = $applicantCode ?? 'UMUM';
$applicantType = $applicantType ?? null;
$studyPrograms = $studyPrograms ?? [];
$classes       = $classes ?? [];
$data          = $data ?? [];

/*
 |--------------------------------------------------------------
 | Helper nilai lama / data edit
 |--------------------------------------------------------------
 */
$getValue = static function (string $key, $default = '') use ($data) {
    return old($key) ?? ($data[$key] ?? $default);
};

$selectedStudyProgram = $getValue('study_program_id');
$selectedClass        = $getValue('class_id');
?>

<!-- =========================================================
     NAMA LENGKAP
========================================================= -->

<div class="mb-3">
    <label for="full_name" class="form-label">
        Nama Lengkap <span class="text-danger">*</span>
    </label>

    <input
        type="text"
        name="full_name"
        id="full_name"
        class="form-control <?= validation_show_error('full_name') ? 'is-invalid' : '' ?>"
        value="<?= esc($getValue('full_name', $data['name'] ?? '')) ?>"
        placeholder="Nama sesuai identitas"
        required>

    <div class="invalid-feedback">
        <?= validation_show_error('full_name') ?>
    </div>
</div>


<!-- =========================================================
     JENIS KELAMIN
========================================================= -->

<div class="mb-3">
    <label class="form-label">
        Jenis Kelamin
    </label>

    <div class="d-flex gap-4">
        <div class="form-check">
            <input
                type="radio"
                name="gender"
                id="gender_l"
                value="L"
                class="form-check-input <?= validation_show_error('gender') ? 'is-invalid' : '' ?>"
                <?= $getValue('gender') === 'L' ? 'checked' : '' ?>>
            <label for="gender_l" class="form-check-label">
                Laki-laki
            </label>
        </div>

        <div class="form-check">
            <input
                type="radio"
                name="gender"
                id="gender_p"
                value="P"
                class="form-check-input <?= validation_show_error('gender') ? 'is-invalid' : '' ?>"
                <?= $getValue('gender') === 'P' ? 'checked' : '' ?>>
            <label for="gender_p" class="form-check-label">
                Perempuan
            </label>
        </div>
    </div>

    <div class="invalid-feedback">
        <?= validation_show_error('gender') ?>
    </div>
</div>


<?php if ($applicantCode === 'MHS') : ?>

    <!-- =====================================================
         MAHASISWA
    ====================================================== -->

    <div class="mb-3">
        <label for="nim" class="form-label">
            NIM <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="nim"
            id="nim"
            class="form-control <?= validation_show_error('nim') ? 'is-invalid' : '' ?>"
            value="<?= esc($getValue('nim')) ?>"
            placeholder="Nomor Induk Mahasiswa"
            required>

        <div class="invalid-feedback">
            <?= validation_show_error('nim') ?>
        </div>
    </div>


    <div class="row">

        <!-- PROGRAM STUDI -->
        <div class="col-md-6 mb-3">
            <label for="study_program_id" class="form-label">
                Program Studi <span class="text-danger">*</span>
            </label>

            <select
                name="study_program_id"
                id="study_program_id"
                class="form-select <?= validation_show_error('study_program_id') ? 'is-invalid' : '' ?>"
                required>

                <option value="">
                    -- Pilih Program Studi --
                </option>

                <?php foreach ($studyPrograms as $sp) : ?>

                    <?php
                    $degree = trim((string) ($sp['degree'] ?? ''));

                    $programName = $sp['name'] ?? '';

                    $displayName = $programName;

                    if ($degree !== '') {
                        $displayName .= ' — ' . $degree;
                    }
                    ?>

                    <option
                        value="<?= esc($sp['id']) ?>"
                        <?= (string) $selectedStudyProgram === (string) $sp['id'] ? 'selected' : '' ?>>

                        <?= esc($displayName) ?>

                    </option>

                <?php endforeach; ?>

            </select>

            <div class="invalid-feedback">
                <?= validation_show_error('study_program_id') ?>
            </div>
        </div>


        <!-- KELAS -->
        <div class="col-md-6 mb-3">
            <label for="class_id" class="form-label">
                Kelas <span class="text-danger">*</span>
            </label>

            <select
                name="class_id"
                id="class_id"
                class="form-select <?= validation_show_error('class_id') ? 'is-invalid' : '' ?>"
                required>

                <option value="">
                    -- Pilih Kelas --
                </option>

                <?php foreach ($classes as $kls) : ?>

                    <option
                        value="<?= esc($kls['id']) ?>"
                        <?= (string) $selectedClass === (string) $kls['id'] ? 'selected' : '' ?>>

                        <?= esc($kls['name']) ?>

                    </option>

                <?php endforeach; ?>

            </select>

            <div class="invalid-feedback">
                <?= validation_show_error('class_id') ?>
            </div>
        </div>

    </div>


<?php elseif ($applicantCode === 'ALUMNI') : ?>

    <!-- =====================================================
         ALUMNI
    ====================================================== -->

    <div class="row">

        <!-- NIM -->
        <div class="col-md-6 mb-3">

            <label for="nim" class="form-label">
                NIM <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                name="nim"
                id="nim"
                class="form-control <?= validation_show_error('nim') ? 'is-invalid' : '' ?>"
                value="<?= esc($getValue('nim')) ?>"
                placeholder="NIM saat kuliah"
                required>

            <div class="invalid-feedback">
                <?= validation_show_error('nim') ?>
            </div>

        </div>


        <!-- PROGRAM STUDI -->
        <div class="col-md-6 mb-3">

            <label for="study_program_id" class="form-label">
                Program Studi
            </label>

            <select
                name="study_program_id"
                id="study_program_id"
                class="form-select <?= validation_show_error('study_program_id') ? 'is-invalid' : '' ?>">

                <option value="">
                    -- Pilih Program Studi --
                </option>

                <?php foreach ($studyPrograms as $sp) : ?>

                    <?php
                    $degree = trim((string) ($sp['degree'] ?? ''));

                    $programName = $sp['name'] ?? '';

                    $displayName = $programName;

                    if ($degree !== '') {
                        $displayName .= ' — ' . $degree;
                    }
                    ?>

                    <option
                        value="<?= esc($sp['id']) ?>"
                        <?= (string) $selectedStudyProgram === (string) $sp['id'] ? 'selected' : '' ?>>

                        <?= esc($displayName) ?>

                    </option>

                <?php endforeach; ?>

            </select>

            <div class="invalid-feedback">
                <?= validation_show_error('study_program_id') ?>
            </div>

        </div>

    </div>


<?php elseif ($applicantCode === 'DOSEN' || $applicantCode === 'TENDIK') : ?>

    <!-- =====================================================
         DOSEN & TENDIK
    ====================================================== -->

    <div class="mb-3">

        <label for="identity_number" class="form-label">
            NIP/NIDN <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="identity_number"
            id="identity_number"
            class="form-control <?= validation_show_error('identity_number') ? 'is-invalid' : '' ?>"
            value="<?= esc($getValue('identity_number')) ?>"
            placeholder="Nomor Induk Pegawai / NIDN"
            required>

        <div class="invalid-feedback">
            <?= validation_show_error('identity_number') ?>
        </div>

    </div>


<?php elseif ($applicantCode === 'WALI') : ?>

    <!-- =====================================================
         ORANG TUA / WALI
    ====================================================== -->

    <div class="row">

        <!-- NAMA MAHASISWA -->
        <div class="col-md-6 mb-3">

            <label for="student_name" class="form-label">
                Nama Mahasiswa <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                name="student_name"
                id="student_name"
                class="form-control <?= validation_show_error('student_name') ? 'is-invalid' : '' ?>"
                value="<?= esc($getValue('student_name')) ?>"
                placeholder="Nama mahasiswa/anak"
                required>

            <div class="invalid-feedback">
                <?= validation_show_error('student_name') ?>
            </div>

        </div>


        <!-- NIM -->
        <div class="col-md-6 mb-3">

            <label for="nim" class="form-label">
                NIM Mahasiswa
            </label>

            <input
                type="text"
                name="nim"
                id="nim"
                class="form-control <?= validation_show_error('nim') ? 'is-invalid' : '' ?>"
                value="<?= esc($getValue('nim')) ?>"
                placeholder="NIM mahasiswa/anak">

            <div class="invalid-feedback">
                <?= validation_show_error('nim') ?>
            </div>

        </div>

    </div>


<?php elseif ($applicantCode === 'MITRA') : ?>

    <!-- =====================================================
         MITRA / INSTANSI
    ====================================================== -->

    <div class="row">

        <!-- NAMA INSTANSI -->
        <div class="col-md-6 mb-3">

            <label for="institution_name" class="form-label">
                Nama Perusahaan / Instansi <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                name="institution_name"
                id="institution_name"
                class="form-control <?= validation_show_error('institution_name') ? 'is-invalid' : '' ?>"
                value="<?= esc($getValue('institution_name')) ?>"
                placeholder="Nama perusahaan / instansi"
                required>

            <div class="invalid-feedback">
                <?= validation_show_error('institution_name') ?>
            </div>

        </div>


        <!-- JABATAN -->
        <div class="col-md-6 mb-3">

            <label for="position" class="form-label">
                Jabatan
            </label>

            <input
                type="text"
                name="position"
                id="position"
                class="form-control <?= validation_show_error('position') ? 'is-invalid' : '' ?>"
                value="<?= esc($getValue('position')) ?>"
                placeholder="Jabatan di perusahaan / instansi">

            <div class="invalid-feedback">
                <?= validation_show_error('position') ?>
            </div>

        </div>

    </div>


<?php else : ?>

    <!-- =====================================================
         UMUM & LAINNYA
    ====================================================== -->

    <div class="mb-3">

        <label for="nik" class="form-label">
            NIK <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="nik"
            id="nik"
            class="form-control <?= validation_show_error('nik') ? 'is-invalid' : '' ?>"
            value="<?= esc($getValue('nik')) ?>"
            placeholder="Nomor Induk Kependudukan"
            required>

        <div class="invalid-feedback">
            <?= validation_show_error('nik') ?>
        </div>

    </div>

<?php endif; ?>


<!-- =========================================================
     KONTAK
========================================================= -->

<div class="row">

    <!-- EMAIL -->
    <div class="col-md-6 mb-3">

        <label for="email" class="form-label">
            Email <span class="text-danger">*</span>
        </label>

        <input
            type="email"
            name="email"
            id="email"
            class="form-control <?= validation_show_error('email') ? 'is-invalid' : '' ?>"
            value="<?= esc($getValue('email')) ?>"
            placeholder="Alamat email aktif"
            required>

        <div class="invalid-feedback">
            <?= validation_show_error('email') ?>
        </div>

    </div>


    <!-- NOMOR HP -->
    <div class="col-md-6 mb-3">

        <label for="phone_number" class="form-label">
            Nomor HP <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="phone_number"
            id="phone_number"
            class="form-control <?= validation_show_error('phone_number') ? 'is-invalid' : '' ?>"
            value="<?= esc($getValue('phone_number', $data['phone'] ?? '')) ?>"
            placeholder="Nomor HP / WhatsApp"
            required>

        <div class="invalid-feedback">
            <?= validation_show_error('phone_number') ?>
        </div>

    </div>


    <!-- ALAMAT -->
    <div class="col-12 mb-3">

        <label for="address" class="form-label">
            Alamat Lengkap
        </label>

        <textarea
            name="address"
            id="address"
            rows="2"
            class="form-control <?= validation_show_error('address') ? 'is-invalid' : '' ?>"
            placeholder="Alamat lengkap tempat tinggal"><?= esc($getValue('address')) ?></textarea>

        <div class="invalid-feedback">
            <?= validation_show_error('address') ?>
        </div>

    </div>

</div>