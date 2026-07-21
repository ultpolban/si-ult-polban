<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= esc($title ?? 'Register') ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {

            background: #f4f6f9;

            font-family: "Segoe UI", sans-serif;

        }

        .register-wrapper {

            max-width: 1100px;

            margin: 40px auto;

        }

        .register-card {

            background: #fff;

            border: none;

            border-radius: 18px;

            box-shadow: 0 8px 30px rgba(0, 0, 0, .08);

            overflow: hidden;

        }

        .register-header {

            background: linear-gradient(135deg, #0d6efd, #2563eb);

            color: white;

            padding: 35px;

            text-align: center;

        }

        .register-header h2 {

            margin: 0;

            font-weight: 700;

        }

        .register-header p {

            margin-top: 10px;

            opacity: .95;

        }

        .section-card {

            border: 1px solid #e5e7eb;

            border-radius: 14px;

            margin-bottom: 30px;

        }

        .section-header {

            background: #f8fafc;

            border-bottom: 1px solid #e5e7eb;

            padding: 15px 20px;

            font-size: 18px;

            font-weight: 600;

            color: #0d6efd;

        }

        .section-body {

            padding: 25px;

        }

        label {

            font-weight: 600;

            margin-bottom: 6px;

        }

        .form-control,
        .form-select {

            border-radius: 10px;

            min-height: 46px;

        }

        .required {

            color: red;

        }

        .dynamic-section {

            display: none;

        }

        .btn-register {

            min-height: 50px;

            border-radius: 12px;

            font-weight: 600;

        }

        .btn-login {

            min-height: 50px;

            border-radius: 12px;

        }

        .photo-preview {

            width: 140px;

            height: 140px;

            border-radius: 12px;

            object-fit: cover;

            border: 2px dashed #d1d5db;

            display: none;

            margin-top: 15px;

        }

        .input-group-text {

            cursor: pointer;

        }

        @media (max-width:768px) {

            .register-wrapper {

                margin: 15px;

            }

            .register-header {

                padding: 25px;

            }

        }
    </style>

</head>

<body>

    <div class="container register-wrapper">

        <div class="register-card">

            <div class="register-header">

                <h2>

                    <i class="bi bi-person-plus-fill"></i>

                    Registrasi Pemohon

                </h2>

                <p>

                    Sistem Informasi Unit Layanan Terpadu (ULT) POLBAN

                </p>

            </div>

            <div class="p-4">

                <?php if (session()->getFlashdata('error')) : ?>

                    <div class="alert alert-danger">

                        <?= session()->getFlashdata('error') ?>

                    </div>

                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')) : ?>

                    <div class="alert alert-danger">

                        <ul class="mb-0">

                            <?php foreach (session()->getFlashdata('errors') as $error): ?>

                                <li><?= esc($error) ?></li>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                <?php endif; ?>

                <form
                    action="<?= base_url('register') ?>"
                    method="post"
                    enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <!-- ===================================================== -->
                    <!-- DATA AKUN -->
                    <!-- ===================================================== -->

                    <div class="section-card">

                        <div class="section-header">

                            <i class="bi bi-person-circle"></i>

                            Data Akun

                        </div>

                        <div class="section-body">

                            <div class="row">

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Nama Lengkap
                                        <span class="required">*</span>
                                    </label>

                                    <input
                                        type="text"
                                        name="full_name"
                                        class="form-control"
                                        placeholder="Masukkan nama lengkap"
                                        value="<?= old('full_name') ?>"
                                        required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Jenis Pemohon
                                        <span class="required">*</span>
                                    </label>

                                    <select
                                        class="form-select"
                                        name="user_type_id"
                                        id="user_type_id"
                                        required>

                                        <option value="">
                                            -- Pilih Jenis Pemohon --
                                        </option>

                                        <?php foreach ($userTypes as $type): ?>

                                            <option
                                                value="<?= $type['id'] ?>"
                                                data-name="<?= strtolower($type['type_name']) ?>"
                                                <?= old('user_type_id') == $type['id'] ? 'selected' : '' ?>>

                                                <?= esc($type['type_name']) ?>

                                            </option>

                                        <?php endforeach; ?>

                                    </select>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Email Pribadi
                                        <span class="required">*</span>
                                    </label>

                                    <input
                                        type="email"
                                        class="form-control"
                                        name="personal_email"
                                        placeholder="contoh@email.com"
                                        value="<?= old('personal_email') ?>"
                                        required>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>

                                        Email Institusi

                                    </label>

                                    <input
                                        type="email"
                                        class="form-control"
                                        name="institution_email"
                                        placeholder="nama@polban.ac.id"
                                        value="<?= old('institution_email') ?>">

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Password
                                        <span class="required">*</span>
                                    </label>

                                    <div class="input-group">

                                        <input
                                            type="password"
                                            class="form-control"
                                            id="password"
                                            name="password"
                                            required>

                                        <span
                                            class="input-group-text"
                                            onclick="togglePassword('password', this)">

                                            <i class="bi bi-eye"></i>

                                        </span>

                                    </div>

                                </div>

                                <div class="col-md-6 mb-3">

                                    <label>
                                        Konfirmasi Password
                                        <span class="required">*</span>
                                    </label>

                                    <div class="input-group">

                                        <input
                                            type="password"
                                            class="form-control"
                                            id="password_confirmation"
                                            name="password_confirmation"
                                            required>

                                        <span
                                            class="input-group-text"
                                            onclick="togglePassword('password_confirmation', this)">

                                            <i class="bi bi-eye"></i>

                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- ===================================================== -->
                    <!-- DATA PRIBADI -->
                    <!-- ===================================================== -->

                    <div class="section-card">

                        <div class="section-header">

                            <i class="bi bi-person-vcard-fill"></i>

                            Data Pribadi

                        </div>

                        <div class="section-body">

                            <div class="row">

                                <!-- Jenis Kelamin -->
                                <div class="col-md-6 mb-3">

                                    <label>

                                        Jenis Kelamin

                                        <span class="required">*</span>

                                    </label>

                                    <select
                                        name="gender"
                                        class="form-select"
                                        required>

                                        <option value="">-- Pilih --</option>

                                        <option value="L"
                                            <?= old('gender') == 'L' ? 'selected' : '' ?>>
                                            Laki-laki
                                        </option>

                                        <option value="P"
                                            <?= old('gender') == 'P' ? 'selected' : '' ?>>
                                            Perempuan
                                        </option>

                                    </select>

                                </div>

                                <!-- Nomor HP -->
                                <div class="col-md-6 mb-3">

                                    <label>

                                        Nomor HP

                                        <span class="required">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        name="phone"
                                        class="form-control"
                                        placeholder="08xxxxxxxxxx"
                                        value="<?= old('phone') ?>"
                                        required>

                                </div>

                                <!-- Tempat Lahir -->
                                <div class="col-md-6 mb-3">

                                    <label>

                                        Tempat Lahir

                                    </label>

                                    <input
                                        type="text"
                                        name="birth_place"
                                        class="form-control"
                                        value="<?= old('birth_place') ?>">

                                </div>

                                <!-- Tanggal Lahir -->
                                <div class="col-md-6 mb-3">

                                    <label>

                                        Tanggal Lahir

                                    </label>

                                    <input
                                        type="date"
                                        name="birth_date"
                                        class="form-control"
                                        value="<?= old('birth_date') ?>">

                                </div>

                                <!-- Upload Foto -->
                                <div class="col-md-6 mb-3">

                                    <label>

                                        Foto

                                    </label>

                                    <input
                                        type="file"
                                        name="photo"
                                        id="photo"
                                        class="form-control"
                                        accept=".jpg,.jpeg,.png">

                                    <img
                                        id="photoPreview"
                                        class="photo-preview"
                                        alt="Preview Foto">

                                </div>

                                <!-- Alamat -->
                                <div class="col-md-6 mb-3">

                                    <label>

                                        Alamat

                                    </label>

                                    <textarea
                                        name="address"
                                        rows="5"
                                        class="form-control"
                                        placeholder="Masukkan alamat lengkap"><?= old('address') ?></textarea>

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- ===================================================== -->
                    <!-- DATA KHUSUS PEMOHON -->
                    <!-- ===================================================== -->

                    <div class="section-card">

                        <div class="section-header">

                            <i class="bi bi-mortarboard-fill"></i>

                            Data Khusus Pemohon

                        </div>

                        <div class="section-body">

                            <!-- ================= MAHASISWA ================= -->

                            <div id="form-mahasiswa" class="dynamic-section">

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label>NIM <span class="required">*</span></label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="nim"
                                            value="<?= old('nim') ?>">

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Jurusan <span class="required">*</span></label>

                                        <select
                                            class="form-select"
                                            id="department_id"
                                            name="department_id">

                                            <option value="">-- Pilih Jurusan --</option>

                                            <?php foreach ($departments as $department): ?>

                                                <option
                                                    value="<?= $department['id'] ?>">

                                                    <?= esc($department['department_name']) ?>

                                                </option>

                                            <?php endforeach; ?>

                                        </select>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Program Studi</label>

                                        <select
                                            class="form-select"
                                            id="study_program_id"
                                            name="study_program_id">

                                            <option value="">-- Pilih Program Studi --</option>

                                        </select>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Jenjang Pendidikan</label>

                                        <input
                                            type="text"
                                            id="education_level"
                                            class="form-control"
                                            readonly>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Kelas</label>

                                        <select
                                            class="form-select"
                                            name="class_id">

                                            <option value="">-- Pilih Kelas --</option>

                                            <?php foreach ($classes as $class): ?>

                                                <option value="<?= $class['id'] ?>">

                                                    <?= esc($class['class_name']) ?>

                                                </option>

                                            <?php endforeach; ?>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <!-- ================= DOSEN ================= -->

                            <div id="form-dosen" class="dynamic-section">

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label>NIP</label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="nip">

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>NIDN</label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="nidn">

                                    </div>

                                    <div class="col-md-12 mb-3">

                                        <label>Unit Kerja</label>

                                        <select
                                            class="form-select"
                                            name="work_unit_id">

                                            <option value="">-- Pilih Unit Kerja --</option>

                                            <?php foreach ($workUnits as $unit): ?>

                                                <option value="<?= $unit['id'] ?>">

                                                    <?= esc($unit['unit_name']) ?>

                                                </option>

                                            <?php endforeach; ?>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <!-- ================= TENDIK ================= -->

                            <div id="form-tendik" class="dynamic-section">

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label>NIP</label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="nip">

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Unit Kerja</label>

                                        <select
                                            class="form-select"
                                            name="work_unit_id">

                                            <option value="">-- Pilih Unit Kerja --</option>

                                            <?php foreach ($workUnits as $unit): ?>

                                                <option value="<?= $unit['id'] ?>">

                                                    <?= esc($unit['unit_name']) ?>

                                                </option>

                                            <?php endforeach; ?>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <!-- ================= ALUMNI ================= -->

                            <div id="form-alumni" class="dynamic-section">

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label>NIM</label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="nim">

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Tahun Lulus</label>

                                        <input
                                            type="number"
                                            class="form-control"
                                            name="graduation_year"
                                            min="1990"
                                            max="<?= date('Y') ?>">

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Jurusan</label>

                                        <select
                                            class="form-select"
                                            id="department_alumni"
                                            name="department_id">

                                            <option value="">-- Pilih Jurusan --</option>

                                            <?php foreach ($departments as $department): ?>

                                                <option value="<?= $department['id'] ?>">

                                                    <?= esc($department['department_name']) ?>

                                                </option>

                                            <?php endforeach; ?>

                                        </select>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Program Studi</label>

                                        <select
                                            class="form-select"
                                            id="study_program_alumni"
                                            name="study_program_id">

                                            <option value="">-- Pilih Program Studi --</option>

                                        </select>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Jenjang Pendidikan</label>

                                        <input
                                            type="text"
                                            id="education_level_alumni"
                                            class="form-control"
                                            readonly>

                                    </div>

                                </div>

                            </div>


                            <!-- ================= ORANG TUA ================= -->

                            <div id="form-orang-tua" class="dynamic-section">

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label>Hubungan</label>

                                        <select
                                            class="form-select"
                                            name="relationship">

                                            <option value="">-- Pilih Hubungan --</option>

                                            <option value="Ayah">Ayah</option>

                                            <option value="Ibu">Ibu</option>

                                            <option value="Wali">Wali</option>

                                        </select>

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Nama Mahasiswa</label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="student_name">

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>NIM Mahasiswa</label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="student_nim">

                                    </div>

                                </div>

                            </div>


                            <!-- ================= MITRA ================= -->

                            <div id="form-mitra" class="dynamic-section">

                                <div class="row">

                                    <div class="col-md-6 mb-3">

                                        <label>Nama Instansi</label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="institution_name">

                                    </div>

                                    <div class="col-md-6 mb-3">

                                        <label>Jabatan</label>

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="position">

                                    </div>

                                </div>

                            </div>


                            <!-- ================= PUBLIK ================= -->

                            <div id="form-publik" class="dynamic-section">

                                <div class="alert alert-info mb-0">

                                    <i class="bi bi-info-circle-fill"></i>

                                    Pemohon kategori <strong>Publik</strong> tidak perlu
                                    mengisi data tambahan.

                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- ===================================================== -->
                    <!-- TOMBOL -->
                    <!-- ===================================================== -->

                    <div class="d-grid gap-2 mb-3">

                        <button type="submit" class="btn btn-primary btn-register">

                            <i class="bi bi-person-check-fill"></i>

                            Daftar

                        </button>

                        <a href="<?= base_url('login') ?>" class="btn btn-outline-secondary btn-login">

                            <i class="bi bi-arrow-left"></i>

                            Kembali ke Login

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        /* ============================================================
   SHOW / HIDE PASSWORD
============================================================ */

        function togglePassword(id, element) {

            const input = document.getElementById(id);
            const icon = element.querySelector("i");

            if (input.type === "password") {

                input.type = "text";
                icon.classList.replace("bi-eye", "bi-eye-slash");

            } else {

                input.type = "password";
                icon.classList.replace("bi-eye-slash", "bi-eye");

            }

        }

        /* ============================================================
           PREVIEW FOTO
        ============================================================ */

        const photoInput = document.getElementById("photo");

        if (photoInput) {

            photoInput.addEventListener("change", function() {

                const file = this.files[0];

                if (!file) return;

                if (file.size > 2 * 1024 * 1024) {

                    alert("Ukuran foto maksimal 2 MB");

                    this.value = "";

                    return;

                }

                const reader = new FileReader();

                reader.onload = function(e) {

                    const img = document.getElementById("photoPreview");

                    img.src = e.target.result;
                    img.style.display = "block";

                };

                reader.readAsDataURL(file);

            });

        }

        /* ============================================================
           DYNAMIC FORM PEMOHON
        ============================================================ */

        const typeSelect = document.getElementById("user_type_id");

        const forms = {

            1: document.getElementById("form-mahasiswa"),
            2: document.getElementById("form-dosen"),
            3: document.getElementById("form-tendik"),
            4: document.getElementById("form-alumni"),
            5: document.getElementById("form-orang-tua"),
            6: document.getElementById("form-mitra"),
            7: document.getElementById("form-publik")

        };

        function hideAllForms() {

            Object.values(forms).forEach(function(form) {

                if (!form) return;

                form.style.display = "none";

                form.querySelectorAll("input, select, textarea").forEach(function(el) {

                    el.disabled = true;
                    el.required = false;

                });

            });

        }

        function showForm(id) {

            hideAllForms();

            if (!forms[id]) return;

            forms[id].style.display = "block";

            forms[id].querySelectorAll("input, select, textarea").forEach(function(el) {

                el.disabled = false;

            });

            forms[id].querySelectorAll("[data-required]").forEach(function(el) {

                el.required = true;

            });

        }

        if (typeSelect) {

            typeSelect.addEventListener("change", function() {

                showForm(parseInt(this.value));

            });

            if (typeSelect.value) {

                showForm(parseInt(typeSelect.value));

            }

        }

        /* ============================================================
           AJAX PROGRAM STUDI
        ============================================================ */

        function loadProgramStudy(departmentId, programId, educationId) {

            const department = document.getElementById(departmentId);
            const program = document.getElementById(programId);
            const education = document.getElementById(educationId);

            if (!department || !program) return;

            department.addEventListener("change", function() {

                if (this.value === "") {

                    program.innerHTML = '<option value="">-- Pilih Program Studi --</option>';

                    if (education) education.value = "";

                    return;

                }

                fetch("<?= base_url('study-programs') ?>/" + this.value)

                    .then(response => response.json())

                    .then(data => {

                        let html = '<option value="">-- Pilih Program Studi --</option>';

                        data.forEach(function(item) {

                            html += `
                        <option
                            value="${item.id}"
                            data-level="${item.education_level}">
                            ${item.program_name}
                        </option>
                    `;

                        });

                        program.innerHTML = html;

                        if (education) education.value = "";

                    });

            });

            program.addEventListener("change", function() {

                const option = this.options[this.selectedIndex];

                if (education) {

                    education.value = option.dataset.level ?? "";

                }

            });

        }

        /* Mahasiswa */

        loadProgramStudy(
            "department_id",
            "study_program_id",
            "education_level"
        );

        /* Alumni */

        loadProgramStudy(
            "department_alumni",
            "study_program_alumni",
            "education_level_alumni"
        );
    </script>

</body>

</html>