<!-- ===================================================== -->
<!-- DATA AKUN -->
<!-- ===================================================== -->

<div class="card shadow-sm mb-4">

    <div class="card-header bg-primary text-white">

        <h5 class="mb-0">

            Data Akun

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Role

                    <span class="text-danger">*</span>

                </label>

                <select
                    class="form-select"
                    name="role_id"
                    id="role_id"
                    required>

                    <option value="">Pilih Role</option>

                    <?php foreach ($roles as $role): ?>

                        <option
                            value="<?= $role['id']; ?>"
                            <?= old('role_id', $user['role_id'] ?? '') == $role['id'] ? 'selected' : ''; ?>>

                            <?= esc($role['role_name']); ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div
                class="col-md-6 mb-3"
                id="userTypeContainer"
                style="display:none;">

                <label class="form-label">

                    Jenis Pemohon

                </label>

                <select
                    class="form-select"
                    id="user_type_id"
                    name="user_type_id">

                    <option value="">

                        Pilih Jenis Pemohon

                    </option>

                    <?php foreach ($userTypes as $type): ?>

                        <option
                            value="<?= $type['id']; ?>"
                            <?= old('user_type_id', $user['user_type_id'] ?? '') == $type['id'] ? 'selected' : ''; ?>>

                            <?= esc($type['type_name']); ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Nama Lengkap

                </label>

                <input
                    type="text"
                    class="form-control"
                    name="full_name"
                    value="<?= old('full_name', $user['full_name'] ?? '') ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Email Personal

                </label>

                <input
                    type="email"
                    class="form-control"
                    name="personal_email"
                    value="<?= old('personal_email', $user['personal_email'] ?? '') ?>">

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Email Institusi

                </label>

                <input
                    type="email"
                    class="form-control"
                    name="institution_email"
                    value="<?= old('institution_email', $user['institution_email'] ?? '') ?>">

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label">

                    Password

                </label>

                <input
                    type="password"
                    class="form-control"
                    name="password">

                <?php if (isset($user['id'])): ?>

                    <small class="text-muted">

                        Kosongkan jika password tidak diubah.

                    </small>

                <?php endif; ?>

            </div>

            <div class="col-md-3 mb-3">

                <label class="form-label">

                    Status

                </label>

                <select
                    class="form-select"
                    name="is_active">

                    <option
                        value="1"
                        <?= old('is_active', $user['is_active'] ?? 1) == 1 ? 'selected' : ''; ?>>

                        Aktif

                    </option>

                    <option
                        value="0"
                        <?= old('is_active', $user['is_active'] ?? 1) == 0 ? 'selected' : ''; ?>>

                        Nonaktif

                    </option>

                </select>

            </div>

        </div>

    </div>

</div>

<!-- ===================================================== -->
<!-- DATA PRIBADI -->
<!-- ===================================================== -->

<div class="card shadow-sm mb-4">

    <div class="card-header bg-success text-white">

        <h5 class="mb-0">

            Data Pribadi

        </h5>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-4 mb-3">

                <label class="form-label">

                    Jenis Kelamin

                </label>

                <select
                    class="form-select"
                    name="gender">

                    <option value="">Pilih</option>

                    <option
                        value="L"
                        <?= old('gender', $user['gender'] ?? '') == 'L' ? 'selected' : ''; ?>>

                        Laki-laki

                    </option>

                    <option
                        value="P"
                        <?= old('gender', $user['gender'] ?? '') == 'P' ? 'selected' : ''; ?>>

                        Perempuan

                    </option>

                </select>

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label">

                    Tempat Lahir

                </label>

                <input
                    type="text"
                    class="form-control"
                    name="birth_place"
                    value="<?= old('birth_place', $user['birth_place'] ?? '') ?>">

            </div>

            <div class="col-md-4 mb-3">

                <label class="form-label">

                    Tanggal Lahir

                </label>

                <input
                    type="date"
                    class="form-control"
                    name="birth_date"
                    value="<?= old('birth_date', $user['birth_date'] ?? '') ?>">

            </div>

        </div>

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Nomor HP

                </label>

                <input
                    type="text"
                    class="form-control"
                    name="phone"
                    value="<?= old('phone', $user['phone'] ?? '') ?>">

            </div>

            <div class="col-md-6 mb-3">

                <label class="form-label">

                    Foto

                </label>

                <input
                    type="file"
                    class="form-control"
                    id="photo"
                    name="photo">

            </div>

        </div>

        <div class="mb-3">

            <label class="form-label">

                Alamat

            </label>

            <textarea
                class="form-control"
                rows="3"
                name="address"><?= old('address', $user['address'] ?? '') ?></textarea>

        </div>

    </div>

</div>

<!-- ===================================================== -->
<!-- FORM MAHASISWA -->
<!-- ===================================================== -->

<div
    id="form-mahasiswa"
    class="dynamic-form"
    style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-info text-white">

            <h5 class="mb-0">

                Data Mahasiswa

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        NIM

                        <span class="text-danger">*</span>

                    </label>

                    <input
                        type="text"
                        class="form-control"
                        name="nim"
                        value="<?= old('nim', $user['nim'] ?? '') ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Jurusan

                    </label>

                    <select
                        id="department_id"
                        name="department_id"
                        class="form-select">

                        <option value="">

                            Pilih Jurusan

                        </option>

                        <?php foreach ($departments as $department): ?>

                            <option
                                value="<?= $department['id']; ?>"
                                <?= old('department_id', $user['department_id'] ?? '') == $department['id'] ? 'selected' : ''; ?>>

                                <?= esc($department['department_name']); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Program Studi

                    </label>

                    <select
                        id="study_program_id"
                        name="study_program_id"
                        class="form-select">

                        <option value="">

                            Pilih Program Studi

                        </option>

                        <?php
                        if (isset($studyPrograms)) :

                            foreach ($studyPrograms as $program) :
                        ?>

                                <option
                                    value="<?= $program['id']; ?>"
                                    <?= old('study_program_id', $user['study_program_id'] ?? '') == $program['id'] ? 'selected' : ''; ?>>

                                    <?= esc($program['education_level']); ?> - <?= esc($program['program_name']); ?>

                                </option>

                        <?php

                            endforeach;

                        endif;

                        ?>

                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Kelas

                    </label>

                    <select
                        name="class_id"
                        class="form-select">

                        <option value="">

                            Pilih Kelas

                        </option>

                        <?php foreach ($classes as $class): ?>

                            <option
                                value="<?= $class['id']; ?>"
                                <?= old('class_id', $user['class_id'] ?? '') == $class['id'] ? 'selected' : ''; ?>>

                                <?= esc($class['class_name']); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Angkatan

                    </label>

                    <input
                        type="number"
                        class="form-control"
                        name="angkatan"
                        min="2000"
                        max="2100"
                        value="<?= old('angkatan', $user['angkatan'] ?? '') ?>">

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Semester

                    </label>

                    <select
                        name="semester"
                        class="form-select">

                        <option value="">

                            Pilih Semester

                        </option>

                        <?php for ($i = 1; $i <= 14; $i++): ?>

                            <option
                                value="<?= $i; ?>"
                                <?= old('semester', $user['semester'] ?? '') == $i ? 'selected' : ''; ?>>

                                Semester <?= $i; ?>

                            </option>

                        <?php endfor; ?>

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label class="form-label">

                        Tahun Masuk

                    </label>

                    <input
                        type="number"
                        class="form-control"
                        name="entry_year"
                        min="2000"
                        max="2100"
                        value="<?= old('entry_year', $user['entry_year'] ?? '') ?>">

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status Mahasiswa

                    </label>

                    <select
                        name="student_status"
                        class="form-select">

                        <option value="">

                            Pilih Status

                        </option>

                        <option
                            value="Aktif"
                            <?= old('student_status', $user['student_status'] ?? '') == 'Aktif' ? 'selected' : ''; ?>>

                            Aktif

                        </option>

                        <option
                            value="Cuti"
                            <?= old('student_status', $user['student_status'] ?? '') == 'Cuti' ? 'selected' : ''; ?>>

                            Cuti

                        </option>

                        <option
                            value="Lulus"
                            <?= old('student_status', $user['student_status'] ?? '') == 'Lulus' ? 'selected' : ''; ?>>

                            Lulus

                        </option>

                        <option
                            value="Drop Out"
                            <?= old('student_status', $user['student_status'] ?? '') == 'Drop Out' ? 'selected' : ''; ?>>

                            Drop Out

                        </option>

                    </select>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ===================================================== -->
<!-- FORM DOSEN -->
<!-- ===================================================== -->

<div
    id="form-dosen"
    class="dynamic-form"
    style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-info text-white">

            <h5 class="mb-0">

                Data Dosen

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        NIP

                    </label>

                    <input
                        type="text"
                        name="nip"
                        class="form-control"
                        value="<?= old('nip', $user['nip'] ?? '') ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        NIDN

                    </label>

                    <input
                        type="text"
                        name="nidn"
                        class="form-control"
                        value="<?= old('nidn', $user['nidn'] ?? '') ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Status Pegawai

                    </label>

                    <select
                        name="employee_status"
                        class="form-select">

                        <option value="">Pilih Status</option>

                        <option value="PNS"
                            <?= old('employee_status', $user['employee_status'] ?? '') == 'PNS' ? 'selected' : ''; ?>>

                            PNS

                        </option>

                        <option value="PPPK"
                            <?= old('employee_status', $user['employee_status'] ?? '') == 'PPPK' ? 'selected' : ''; ?>>

                            PPPK

                        </option>

                        <option value="Kontrak"
                            <?= old('employee_status', $user['employee_status'] ?? '') == 'Kontrak' ? 'selected' : ''; ?>>

                            Kontrak

                        </option>

                        <option value="Honorer"
                            <?= old('employee_status', $user['employee_status'] ?? '') == 'Honorer' ? 'selected' : ''; ?>>

                            Honorer

                        </option>

                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Jurusan

                    </label>

                    <select
                        name="department_id"
                        class="form-select">

                        <option value="">Pilih Jurusan</option>

                        <?php foreach ($departments as $department): ?>

                            <option
                                value="<?= $department['id']; ?>"
                                <?= old('department_id', $user['department_id'] ?? '') == $department['id'] ? 'selected' : ''; ?>>

                                <?= esc($department['department_name']); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Program Studi

                    </label>

                    <select
                        name="study_program_id"
                        class="form-select">

                        <option value="">Pilih Program Studi</option>

                        <?php if (isset($studyPrograms)): ?>

                            <?php foreach ($studyPrograms as $program): ?>

                                <option
                                    value="<?= $program['id']; ?>"
                                    <?= old('study_program_id', $user['study_program_id'] ?? '') == $program['id'] ? 'selected' : ''; ?>>

                                    <?= esc($program['education_level']); ?> - <?= esc($program['program_name']); ?>

                                </option>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Unit Kerja

                    </label>

                    <select
                        name="work_unit_id"
                        class="form-select">

                        <option value="">Pilih Unit Kerja</option>

                        <?php foreach ($workUnits as $unit): ?>

                            <option
                                value="<?= $unit['id']; ?>"
                                <?= old('work_unit_id', $user['work_unit_id'] ?? '') == $unit['id'] ? 'selected' : ''; ?>>

                                <?= esc($unit['unit_name']); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Jabatan Akademik

                    </label>

                    <input
                        type="text"
                        name="academic_position"
                        class="form-control"
                        value="<?= old('academic_position', $user['academic_position'] ?? '') ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Jabatan Fungsional

                    </label>

                    <input
                        type="text"
                        name="functional_position"
                        class="form-control"
                        value="<?= old('functional_position', $user['functional_position'] ?? '') ?>">

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ===================================================== -->
<!-- FORM PEGAWAI -->
<!-- Administrator -->
<!-- Petugas ULT -->
<!-- Unit Tujuan -->
<!-- Pimpinan -->
<!-- Tendik -->
<!-- ===================================================== -->

<div
    id="form-pegawai"
    class="dynamic-form"
    style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-secondary text-white">

            <h5 class="mb-0">

                Data Pegawai

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        NIP

                    </label>

                    <input
                        type="text"
                        name="nip"
                        class="form-control"
                        value="<?= old('nip', $user['nip'] ?? '') ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Status Pegawai

                    </label>

                    <select
                        name="employee_status"
                        class="form-select">

                        <option value="">Pilih Status</option>

                        <option
                            value="PNS"
                            <?= old('employee_status', $user['employee_status'] ?? '') == 'PNS' ? 'selected' : ''; ?>>

                            PNS

                        </option>

                        <option
                            value="PPPK"
                            <?= old('employee_status', $user['employee_status'] ?? '') == 'PPPK' ? 'selected' : ''; ?>>

                            PPPK

                        </option>

                        <option
                            value="Kontrak"
                            <?= old('employee_status', $user['employee_status'] ?? '') == 'Kontrak' ? 'selected' : ''; ?>>

                            Kontrak

                        </option>

                        <option
                            value="Honorer"
                            <?= old('employee_status', $user['employee_status'] ?? '') == 'Honorer' ? 'selected' : ''; ?>>

                            Honorer

                        </option>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Jabatan

                    </label>

                    <input
                        type="text"
                        name="position"
                        class="form-control"
                        value="<?= old('position', $user['position'] ?? '') ?>">

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Unit Kerja

                    </label>

                    <select
                        name="work_unit_id"
                        class="form-select">

                        <option value="">Pilih Unit Kerja</option>

                        <?php foreach ($workUnits as $unit): ?>

                            <option
                                value="<?= $unit['id']; ?>"
                                <?= old('work_unit_id', $user['work_unit_id'] ?? '') == $unit['id'] ? 'selected' : ''; ?>>

                                <?= esc($unit['unit_name']); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Email Institusi

                    </label>

                    <input
                        type="email"
                        class="form-control"
                        name="institution_email"
                        value="<?= old('institution_email', $user['institution_email'] ?? '') ?>">

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ===================================================== -->
<!-- FORM ALUMNI -->
<!-- ===================================================== -->

<div id="form-alumni" class="dynamic-form" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-warning">

            <h5 class="mb-0">

                Data Alumni

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label>NIM</label>

                    <input
                        type="text"
                        class="form-control"
                        name="nim"
                        value="<?= old('nim', $user['nim'] ?? '') ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Tahun Lulus</label>

                    <input
                        type="number"
                        class="form-control"
                        name="graduation_year"
                        value="<?= old('graduation_year', $user['graduation_year'] ?? '') ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label>Jurusan</label>

                    <select
                        name="department_id"
                        class="form-select">

                        <option value="">Pilih Jurusan</option>

                        <?php foreach ($departments as $department): ?>

                            <option
                                value="<?= $department['id']; ?>"
                                <?= old('department_id', $user['department_id'] ?? '') == $department['id'] ? 'selected' : ''; ?>>

                                <?= esc($department['department_name']); ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ===================================================== -->
<!-- FORM ORANG TUA -->
<!-- ===================================================== -->

<div id="form-orangtua" class="dynamic-form" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-danger text-white">

            <h5 class="mb-0">

                Data Orang Tua / Wali

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Nama Mahasiswa</label>

                    <input
                        type="text"
                        class="form-control"
                        name="student_name"
                        value="<?= old('student_name', $user['student_name'] ?? '') ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label>NIM Mahasiswa</label>

                    <input
                        type="text"
                        class="form-control"
                        name="student_nim"
                        value="<?= old('student_nim', $user['student_nim'] ?? '') ?>">

                </div>

            </div>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Hubungan</label>

                    <select
                        name="relationship"
                        class="form-select">

                        <option value="">Pilih</option>

                        <option value="Ayah">Ayah</option>

                        <option value="Ibu">Ibu</option>

                        <option value="Wali">Wali</option>

                    </select>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ===================================================== -->
<!-- FORM MITRA -->
<!-- ===================================================== -->

<div id="form-mitra" class="dynamic-form" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-dark text-white">

            <h5 class="mb-0">

                Data Mitra

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Nama Instansi</label>

                    <input
                        type="text"
                        class="form-control"
                        name="institution_name"
                        value="<?= old('institution_name', $user['institution_name'] ?? '') ?>">

                </div>

                <div class="col-md-3 mb-3">

                    <label>Jenis Instansi</label>

                    <input
                        type="text"
                        class="form-control"
                        name="institution_type"
                        value="<?= old('institution_type', $user['institution_type'] ?? '') ?>">

                </div>

                <div class="col-md-3 mb-3">

                    <label>Jabatan</label>

                    <input
                        type="text"
                        class="form-control"
                        name="job_title"
                        value="<?= old('job_title', $user['job_title'] ?? '') ?>">

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ===================================================== -->
<!-- FORM PUBLIK -->
<!-- ===================================================== -->

<div id="form-publik" class="dynamic-form" style="display:none;">

    <div class="card shadow-sm mb-4">

        <div class="card-header bg-success text-white">

            <h5 class="mb-0">

                Data Pengguna Umum

            </h5>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label>Nomor Identitas (KTP/Paspor)</label>

                    <input
                        type="text"
                        class="form-control"
                        name="identity_number"
                        value="<?= old('identity_number', $user['identity_number'] ?? '') ?>">

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const role = document.getElementById('role_id');

        const userType = document.getElementById('user_type_id');

        const userTypeContainer = document.getElementById('userTypeContainer');

        function hideAllForms() {

            document.querySelectorAll('.dynamic-form').forEach(function(form) {

                form.style.display = 'none';

            });

        }

        function showRoleForm() {

            hideAllForms();

            let roleText = "";

            if (role.selectedIndex > 0) {

                roleText = role.options[role.selectedIndex].text.trim().toLowerCase();

            }

            /*
            ===========================================
            PEMOHON
            ===========================================
            */

            if (roleText === 'pemohon') {

                userTypeContainer.style.display = '';

                showPemohon();

                return;

            }

            userTypeContainer.style.display = 'none';

            /*
            ===========================================
            ADMIN
            ===========================================
            */

            if (roleText === 'administrator') {

                document.getElementById('form-pegawai').style.display = 'block';

            }

            /*
            ===========================================
            PETUGAS
            ===========================================
            */

            if (roleText === 'petugas ult') {

                document.getElementById('form-pegawai').style.display = 'block';

            }

            /*
            ===========================================
            UNIT
            ===========================================
            */

            if (roleText === 'unit tujuan') {

                document.getElementById('form-pegawai').style.display = 'block';

            }

            /*
            ===========================================
            PIMPINAN
            ===========================================
            */

            if (roleText === 'pimpinan') {

                document.getElementById('form-pegawai').style.display = 'block';

            }

        }

        function showPemohon() {

            hideAllForms();

            let type = "";

            if (userType.selectedIndex > 0) {

                type = userType.options[userType.selectedIndex].text.trim().toLowerCase();

            }

            switch (type) {

                case 'mahasiswa':

                    document.getElementById('form-mahasiswa').style.display = 'block';

                    break;

                case 'dosen':

                    document.getElementById('form-dosen').style.display = 'block';

                    break;

                case 'tendik':

                    document.getElementById('form-pegawai').style.display = 'block';

                    break;

                case 'alumni':

                    document.getElementById('form-alumni').style.display = 'block';

                    break;

                case 'orang tua':

                case 'orang tua/wali':

                case 'wali':

                    document.getElementById('form-orangtua').style.display = 'block';

                    break;

                case 'mitra':

                    document.getElementById('form-mitra').style.display = 'block';

                    break;

                case 'publik':

                    document.getElementById('form-publik').style.display = 'block';

                    break;

            }

        }

        role.addEventListener('change', showRoleForm);

        userType.addEventListener('change', showPemohon);

        showRoleForm();

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const department = document.getElementById('department_id');
        const study = document.getElementById('study_program_id');

        if (!department || !study) {
            return;
        }

        department.addEventListener('change', function() {

            const id = this.value;

            study.innerHTML = '<option>Loading...</option>';

            if (id == '') {

                study.innerHTML =
                    '<option value="">Pilih Program Studi</option>';

                return;

            }

            fetch("<?= base_url('study-programs/by-department') ?>/" + id)

                .then(res => res.json())

                .then(function(data) {

                    study.innerHTML =
                        '<option value="">Pilih Program Studi</option>';

                    data.forEach(function(item) {

                        const jenjang =
                            item.education_level ?? '';

                        study.innerHTML += `
                        <option value="${item.id}">
                            ${jenjang} - ${item.program_name}
                        </option>
                    `;

                    });

                })

                .catch(function() {

                    study.innerHTML =
                        '<option value="">Gagal Memuat Data</option>';

                });

        });

    });
</script>