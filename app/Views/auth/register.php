<!DOCTYPE html>
<html lang="id">

<head>

    <?= $this->include('layouts/header') ?>

    <style>
        /* Override auth-right untuk register agar scrollable */
        .auth-right {
            overflow-y: auto;
            justify-content: flex-start;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .auth-card {
            min-height: 650px;
            height: auto;
            align-items: stretch;
        }

        /* Partials: sembunyikan dulu semua section khusus pemohon */
        .pemohon-section {
            display: none;
        }

        /* Form select & textarea ikuti style auth */
        .auth-right .form-select {
            height: 52px;
            border-radius: 12px;
        }

        .auth-right textarea.form-control {
            height: auto;
        }

        /* Info box MFA di sisi kiri */
        .mfa-info-box {
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 14px;
            padding: 18px 20px;
            margin-top: 28px;
            font-size: 14px;
            line-height: 1.7;
        }

        .mfa-info-box i {
            color: #FFD580;
        }

        /* Section judul dalam form */
        .form-section-title {
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #293582;
            border-bottom: 2px solid #E9EDF9;
            padding-bottom: 8px;
            margin-bottom: 16px;
            margin-top: 24px;
        }
    </style>

</head>

<body class="auth-page">

    <div class="auth-container">

        <div class="auth-card">

            <!-- ========================================== -->
            <!-- SISI KIRI -->
            <!-- ========================================== -->

            <div class="auth-left">

                <div class="auth-brand">
                    <img src="<?= base_url('assets/images/ULT POLBAN.png') ?>" alt="Logo Politeknik Negeri Bandung">
                </div>

                <div>

                    <span class="system-badge">
                        <i class="bi bi-star-fill me-1"></i> Layanan Terpadu
                    </span>

                    <h1>
                        Bergabung Dengan
                        <br>
                        SI ULT POLBAN
                    </h1>

                    <p>
                        Daftar sebagai pemohon layanan. Lengkapi data sesuai jenis pemohon Anda.
                    </p>

                    <div class="mfa-info-box">
                        <i class="bi bi-shield-lock-fill me-2"></i>
                        <strong>Dilindungi MFA</strong>
                        <br>
                        Setelah mendaftar, pindai QR MFA di aplikasi authenticator lalu masukkan kode verifikasi untuk mengaktifkan akun.
                    </div>

                </div>

            </div>

            <!-- ========================================== -->
            <!-- SISI KANAN -->
            <!-- ========================================== -->

            <div class="auth-right">

                <!-- Logo kecil -->
                <div class="text-center mb-3">
                    <div style="width:56px;height:56px;background:#293582;border-radius:16px;display:inline-flex;align-items:center;justify-content:center;">
                        <span style="color:#fff;font-size:20px;font-weight:700;">ULT</span>
                    </div>
                    <h2 class="mt-3 mb-1">Buat Akun Pemohon</h2>
                    <p class="text-muted small">Pilih jenis pemohon untuk menyesuaikan formulir</p>
                </div>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $err): ?>
                                <li><?= esc($err) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form
                    action="<?= base_url('register/store') ?>"
                    method="post"
                    enctype="multipart/form-data">

                    <?= csrf_field() ?>
                    
                    <?php $errors = session('errors') ?? []; ?>

                    <!-- ================================ -->
                    <!-- JENIS PEMOHON -->
                    <!-- ================================ -->

                    <div class="mb-3">
                        <label class="form-label">Jenis Pemohon <span class="text-danger">*</span></label>
                        <select
                            name="user_type_id"
                            id="user_type_id"
                            class="form-select <?= isset($errors['user_type_id']) ? 'is-invalid' : '' ?>">
                            <option value="">-- Pilih Jenis Pemohon --</option>
                            <?php foreach ($userTypes as $type): ?>
                                <option
                                    value="<?= $type['id'] ?>"
                                    <?= old('user_type_id') == $type['id'] ? 'selected' : '' ?>>
                                    <?= esc($type['type_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- ================================ -->
                    <!-- DATA AKUN (selalu tampil) -->
                    <!-- ================================ -->

                    <div class="form-section-title"><i class="bi bi-person-circle me-2"></i>Data Akun</div>

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input
                            type="text"
                            name="full_name"
                            class="form-control <?= isset($errors['full_name']) ? 'is-invalid' : '' ?>"
                            placeholder="Nama sesuai identitas"
                            value="<?= old('full_name') ?>">
                        <?php if (isset($errors['full_name'])): ?>
                            <div class="invalid-feedback"><?= $errors['full_name'] ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input
                                type="email"
                                name="personal_email"
                                class="form-control <?= isset($errors['personal_email']) ? 'is-invalid' : '' ?>"
                                placeholder="Alamat email aktif"
                                value="<?= old('personal_email') ?>">
                            <?php if (isset($errors['personal_email'])): ?>
                                <div class="invalid-feedback"><?= $errors['personal_email'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor HP <span class="text-danger">*</span></label>
                            <input
                                type="text"
                                name="phone"
                                class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>"
                                placeholder="Nomor HP / WhatsApp"
                                value="<?= old('phone') ?>">
                            <?php if (isset($errors['phone'])): ?>
                                <div class="invalid-feedback"><?= $errors['phone'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- ================================ -->
                    <!-- DATA PRIBADI (selalu tampil) -->
                    <!-- ================================ -->

                    <div class="form-section-title"><i class="bi bi-person-vcard me-2"></i>Data Pribadi</div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="gender" class="form-select <?= isset($errors['gender']) ? 'is-invalid' : '' ?>">
                                <option value="">-- Pilih --</option>
                                <option value="L" <?= old('gender') == 'L' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="P" <?= old('gender') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                            <?php if (isset($errors['gender'])): ?>
                                <div class="invalid-feedback"><?= $errors['gender'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tempat Lahir</label>
                            <input type="text" name="birth_place" class="form-control" placeholder="Kota kelahiran" value="<?= old('birth_place') ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="birth_date" class="form-control" value="<?= old('birth_date') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Foto Profil</label>
                            <input type="file" name="photo" class="form-control" accept=".jpg,.jpeg,.png">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="address" rows="3" class="form-control <?= isset($errors['address']) ? 'is-invalid' : '' ?>" placeholder="Alamat lengkap tempat tinggal"><?= old('address') ?></textarea>
                        <?php if (isset($errors['address'])): ?>
                            <div class="invalid-feedback"><?= $errors['address'] ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- ================================ -->
                    <!-- SECTION MAHASISWA -->
                    <!-- ================================ -->

                    <div id="section-mahasiswa" class="pemohon-section">
                        <div class="form-section-title"><i class="bi bi-mortarboard me-2"></i>Data Mahasiswa</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIM <span class="text-danger">*</span></label>
                                <input type="text" name="nim" class="form-control" placeholder="Nomor Induk Mahasiswa" value="<?= old('nim') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                                <select name="department_id" id="department_id_mhs" class="form-select">
                                    <option value="">-- Pilih Jurusan --</option>
                                    <?php foreach ($departments as $dept): ?>
                                        <option value="<?= $dept['id'] ?>" <?= old('department_id') == $dept['id'] ? 'selected' : '' ?>>
                                            <?= esc($dept['department_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Program Studi <span class="text-danger">*</span></label>
                                <select name="study_program_id" class="form-select">
                                    <option value="">-- Pilih Program Studi --</option>
                                    <?php foreach ($studyPrograms as $prodi): ?>
                                        <option value="<?= $prodi['id'] ?>" <?= old('study_program_id') == $prodi['id'] ? 'selected' : '' ?>>
                                            <?= esc($prodi['program_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kelas <span class="text-danger">*</span></label>
                                <select name="class_id" class="form-select">
                                    <option value="">-- Pilih Kelas --</option>
                                    <?php foreach ($classes as $cls): ?>
                                        <option value="<?= $cls['id'] ?>" <?= old('class_id') == $cls['id'] ? 'selected' : '' ?>>
                                            <?= esc($cls['class_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Angkatan</label>
                                <input type="number" name="angkatan" class="form-control" placeholder="2022" value="<?= old('angkatan') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun Masuk</label>
                                <input type="number" name="entry_year" class="form-control" placeholder="2022" value="<?= old('entry_year') ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status Mahasiswa</label>
                            <select name="student_status" class="form-select">
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif" <?= old('student_status') == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                                <option value="Cuti" <?= old('student_status') == 'Cuti' ? 'selected' : '' ?>>Cuti</option>
                                <option value="Nonaktif" <?= old('student_status') == 'Nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <!-- ================================ -->
                    <!-- SECTION DOSEN -->
                    <!-- ================================ -->

                    <div id="section-dosen" class="pemohon-section">
                        <div class="form-section-title"><i class="bi bi-person-workspace me-2"></i>Data Dosen</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIP <span class="text-danger">*</span></label>
                                <input type="text" name="nip" class="form-control" placeholder="Nomor Induk Pegawai" value="<?= old('nip') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIDN <span class="text-danger">*</span></label>
                                <input type="text" name="nidn" class="form-control" placeholder="Nomor Induk Dosen Nasional" value="<?= old('nidn') ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                                <select name="department_id" class="form-select">
                                    <option value="">-- Pilih Jurusan --</option>
                                    <?php foreach ($departments as $dept): ?>
                                        <option value="<?= $dept['id'] ?>" <?= old('department_id') == $dept['id'] ? 'selected' : '' ?>>
                                            <?= esc($dept['department_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Unit Kerja <span class="text-danger">*</span></label>
                                <select name="work_unit_id" class="form-select">
                                    <option value="">-- Pilih Unit Kerja --</option>
                                    <?php foreach ($workUnits as $unit): ?>
                                        <option value="<?= $unit['id'] ?>" <?= old('work_unit_id') == $unit['id'] ? 'selected' : '' ?>>
                                            <?= esc($unit['unit_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jabatan Akademik</label>
                                <input type="text" name="academic_position" class="form-control" placeholder="Lektor, Asisten Ahli, dll" value="<?= old('academic_position') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jabatan Fungsional</label>
                                <input type="text" name="functional_position" class="form-control" placeholder="Jabatan fungsional" value="<?= old('functional_position') ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status Kepegawaian</label>
                            <select name="employee_status" class="form-select">
                                <option value="">-- Pilih Status --</option>
                                <option value="PNS" <?= old('employee_status') == 'PNS' ? 'selected' : '' ?>>PNS</option>
                                <option value="PPPK" <?= old('employee_status') == 'PPPK' ? 'selected' : '' ?>>PPPK</option>
                                <option value="Honorer" <?= old('employee_status') == 'Honorer' ? 'selected' : '' ?>>Honorer</option>
                            </select>
                        </div>
                    </div>

                    <!-- ================================ -->
                    <!-- SECTION TENDIK -->
                    <!-- ================================ -->

                    <div id="section-tendik" class="pemohon-section">
                        <div class="form-section-title"><i class="bi bi-briefcase me-2"></i>Data Tendik</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIP <span class="text-danger">*</span></label>
                                <input type="text" name="nip" class="form-control" placeholder="Nomor Induk Pegawai" value="<?= old('nip') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Unit Kerja <span class="text-danger">*</span></label>
                                <select name="work_unit_id" class="form-select">
                                    <option value="">-- Pilih Unit Kerja --</option>
                                    <?php foreach ($workUnits as $unit): ?>
                                        <option value="<?= $unit['id'] ?>" <?= old('work_unit_id') == $unit['id'] ? 'selected' : '' ?>>
                                            <?= esc($unit['unit_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status Kepegawaian</label>
                            <select name="employee_status" class="form-select">
                                <option value="">-- Pilih Status --</option>
                                <option value="PNS" <?= old('employee_status') == 'PNS' ? 'selected' : '' ?>>PNS</option>
                                <option value="PPPK" <?= old('employee_status') == 'PPPK' ? 'selected' : '' ?>>PPPK</option>
                                <option value="Honorer" <?= old('employee_status') == 'Honorer' ? 'selected' : '' ?>>Honorer</option>
                            </select>
                        </div>
                    </div>

                    <!-- ================================ -->
                    <!-- SECTION ALUMNI -->
                    <!-- ================================ -->

                    <div id="section-alumni" class="pemohon-section">
                        <div class="form-section-title"><i class="bi bi-award me-2"></i>Data Alumni</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIM <span class="text-danger">*</span></label>
                                <input type="text" name="nim" class="form-control" placeholder="Nomor Induk Mahasiswa" value="<?= old('nim') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun Lulus <span class="text-danger">*</span></label>
                                <input type="number" name="graduation_year" class="form-control" placeholder="2023" value="<?= old('graduation_year') ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jurusan <span class="text-danger">*</span></label>
                                <select name="department_id" class="form-select">
                                    <option value="">-- Pilih Jurusan --</option>
                                    <?php foreach ($departments as $dept): ?>
                                        <option value="<?= $dept['id'] ?>" <?= old('department_id') == $dept['id'] ? 'selected' : '' ?>>
                                            <?= esc($dept['department_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Program Studi <span class="text-danger">*</span></label>
                                <select name="study_program_id" class="form-select">
                                    <option value="">-- Pilih Program Studi --</option>
                                    <?php foreach ($studyPrograms as $prodi): ?>
                                        <option value="<?= $prodi['id'] ?>" <?= old('study_program_id') == $prodi['id'] ? 'selected' : '' ?>>
                                            <?= esc($prodi['program_name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- ================================ -->
                    <!-- SECTION ORANG TUA / WALI -->
                    <!-- ================================ -->

                    <div id="section-orangtua" class="pemohon-section">
                        <div class="form-section-title"><i class="bi bi-people me-2"></i>Data Orang Tua / Wali</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hubungan <span class="text-danger">*</span></label>
                                <select name="relationship" class="form-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="Ayah" <?= old('relationship') == 'Ayah' ? 'selected' : '' ?>>Ayah</option>
                                    <option value="Ibu" <?= old('relationship') == 'Ibu' ? 'selected' : '' ?>>Ibu</option>
                                    <option value="Wali" <?= old('relationship') == 'Wali' ? 'selected' : '' ?>>Wali</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">NIM Mahasiswa <span class="text-danger">*</span></label>
                                <input type="text" name="student_nim" class="form-control" placeholder="NIM anak/yang diwakili" value="<?= old('student_nim') ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Mahasiswa <span class="text-danger">*</span></label>
                            <input type="text" name="student_name" class="form-control" placeholder="Nama lengkap mahasiswa" value="<?= old('student_name') ?>">
                        </div>
                    </div>

                    <!-- ================================ -->
                    <!-- SECTION MITRA -->
                    <!-- ================================ -->

                    <div id="section-mitra" class="pemohon-section">
                        <div class="form-section-title"><i class="bi bi-building me-2"></i>Data Mitra</div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Institusi <span class="text-danger">*</span></label>
                                <input type="text" name="institution_name" class="form-control" placeholder="Nama lembaga/institusi" value="<?= old('institution_name') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jenis Institusi <span class="text-danger">*</span></label>
                                <select name="institution_type" class="form-select">
                                    <option value="">-- Pilih --</option>
                                    <option value="Swasta" <?= old('institution_type') == 'Swasta' ? 'selected' : '' ?>>Swasta</option>
                                    <option value="BUMN" <?= old('institution_type') == 'BUMN' ? 'selected' : '' ?>>BUMN</option>
                                    <option value="Pemerintah" <?= old('institution_type') == 'Pemerintah' ? 'selected' : '' ?>>Pemerintah</option>
                                    <option value="Lainnya" <?= old('institution_type') == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jabatan</label>
                                <input type="text" name="position" class="form-control" placeholder="Jabatan Anda" value="<?= old('position') ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Judul Jabatan</label>
                                <input type="text" name="job_title" class="form-control" placeholder="Job title" value="<?= old('job_title') ?>">
                            </div>
                        </div>
                    </div>

                    <!-- ================================ -->
                    <!-- SECTION PUBLIK -->
                    <!-- ================================ -->

                    <div id="section-publik" class="pemohon-section">
                        <div class="form-section-title"><i class="bi bi-person-badge me-2"></i>Data Publik</div>
                        <div class="mb-3">
                            <label class="form-label">NIK <span class="text-danger">*</span></label>
                            <input type="text" name="identity_number" class="form-control" placeholder="Nomor Induk Kependudukan" value="<?= old('identity_number') ?>">
                        </div>
                    </div>

                    <!-- ================================ -->
                    <!-- PASSWORD -->
                    <!-- ================================ -->

                    <div class="form-section-title"><i class="bi bi-lock me-2"></i>Keamanan</div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input
                                type="password"
                                name="password"
                                class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>"
                                placeholder="Minimal 8 karakter">
                            <?php if (isset($errors['password'])): ?>
                                <div class="invalid-feedback"><?= $errors['password'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control <?= isset($errors['password_confirmation']) ? 'is-invalid' : '' ?>"
                                placeholder="Ulangi password">
                            <?php if (isset($errors['password_confirmation'])): ?>
                                <div class="invalid-feedback"><?= $errors['password_confirmation'] ?></div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- ================================ -->
                    <!-- TOMBOL DAFTAR -->
                    <!-- ================================ -->

                    <button type="submit" class="btn btn-primary w-100 mt-2">
                        <i class="bi bi-person-plus-fill me-2"></i> Daftar
                    </button>

                </form>

                <div class="mt-4 text-center">
                    <p class="mb-0">Sudah punya akun? <a href="<?= base_url('login') ?>">Login di sini</a></p>
                </div>

            </div>
        </div>
    </div>

    <!-- Script tampilkan/sembunyikan section sesuai Jenis Pemohon -->
    <script>
        const sectionMap = {
            1: 'section-mahasiswa',
            2: 'section-dosen',
            3: 'section-tendik',
            4: 'section-alumni',
            5: 'section-orangtua',
            6: 'section-mitra',
            7: 'section-publik',
        };

        const allSections = Object.values(sectionMap);

        function updateSections(val) {
            allSections.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.style.display = 'none';
                    // Disable all inputs in hidden sections to prevent submitting empty values
                    const inputs = el.querySelectorAll('input, select, textarea');
                    inputs.forEach(input => input.disabled = true);
                }
            });

            if (sectionMap[val]) {
                const target = document.getElementById(sectionMap[val]);
                if (target) {
                    target.style.display = 'block';
                    // Enable all inputs in visible section
                    const inputs = target.querySelectorAll('input, select, textarea');
                    inputs.forEach(input => input.disabled = false);
                }
            }
        }

        document.getElementById('user_type_id').addEventListener('change', function () {
            updateSections(parseInt(this.value));
        });

        // Restore section on page reload (validation errors)
        const currentVal = parseInt(document.getElementById('user_type_id').value);
        updateSections(currentVal || 0);
    </script>

    <?= $this->include('layouts/footer') ?>

</body>

</html>