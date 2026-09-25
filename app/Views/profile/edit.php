<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
    .profile-cover {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        border-radius: 1rem 1rem 0 0;
        height: 120px;
        position: relative;
    }
    .profile-avatar-wrapper {
        position: relative;
        margin-top: -55px;
        display: inline-block;
    }
    .profile-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        border: 4px solid #fff;
        background: #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        font-size: 2.5rem;
        font-weight: 700;
        color: #4f46e5;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
    }
    .photo-upload-btn {
        position: absolute;
        bottom: 4px;
        right: 4px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #4f46e5;
        border: 2px solid #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: white;
        font-size: 0.75rem;
        transition: all 0.2s ease;
    }
    .photo-upload-btn:hover { background: #3730a3; transform: scale(1.1); }
    .profile-sidebar-card {
        background: #fff;
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid rgba(226,232,240,0.8);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }
    .form-section-card {
        background: #fff;
        border-radius: 1rem;
        border: 1px solid rgba(226,232,240,0.8);
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        margin-bottom: 1.25rem;
        overflow: hidden;
    }
    .form-section-header {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        background: #fafafa;
    }
    .form-section-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }
    .form-section-title {
        font-weight: 700;
        font-size: 0.9rem;
        color: #1e293b;
        margin: 0;
    }
    .form-label-custom {
        font-size: 0.8rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 0.4rem;
    }
    .form-control-custom {
        border: 1.5px solid #e2e8f0;
        border-radius: 0.75rem;
        padding: 0.6rem 1rem;
        background: #f8fafc;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }
    .form-control-custom:focus {
        border-color: #4f46e5;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(79,70,229,0.08);
    }
    .radio-group {
        display: flex;
        gap: 1rem;
        padding-top: 0.25rem;
    }
    .radio-option {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        padding: 0.5rem 1rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 0.75rem;
        transition: all 0.2s ease;
        font-size: 0.9rem;
        color: #475569;
    }
    .radio-option:has(input:checked) {
        border-color: #4f46e5;
        background: rgba(79,70,229,0.06);
        color: #4f46e5;
        font-weight: 600;
    }
    .radio-option input { display: none; }
</style>

<!-- Page header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold text-dark mb-1">Edit Profil</h4>
        <p class="text-muted mb-0 small">Perbarui data diri dan informasi akun Anda.</p>
    </div>
    <a href="<?= base_url('profil') ?>" class="btn btn-light btn-sm rounded-pill px-3 shadow-sm">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<form action="<?= base_url('profil/update') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="row g-4 align-items-start">

        <!-- LEFT: Sidebar Profil -->
        <div class="col-lg-3">
            <div class="profile-sidebar-card text-center">
                <!-- Cover -->
                <div class="profile-cover"></div>
                <!-- Avatar -->
                <div class="px-3 pb-4">
                    <div class="d-flex justify-content-center">
                        <div class="profile-avatar-wrapper">
                            <div class="profile-avatar" id="avatar-preview">
                                <?php
                                    $photo = $user['profile_photo'] ?? ($user['photo'] ?? null);
                                ?>
                                <?php if (!empty($photo)) : ?>
                                    <img src="<?= base_url('uploads/profiles/' . $photo) ?>" alt="foto" class="w-100 h-100 object-fit-cover" id="preview-img">
                                <?php else : ?>
                                    <span id="preview-initials"><?= strtoupper(substr(esc($user['name'] ?? 'U'), 0, 1)) ?></span>
                                <?php endif; ?>
                            </div>
                            <label for="photoInput" class="photo-upload-btn" title="Ganti Foto">
                                <i class="bi bi-camera-fill"></i>
                            </label>
                            <input type="file" id="photoInput" name="photo" class="d-none" accept="image/jpg,image/jpeg,image/png,image/webp">
                        </div>
                    </div>
                    <h5 class="fw-bold mt-3 mb-0 text-dark"><?= esc($user['name'] ?? '-') ?></h5>
                    <span class="badge bg-primary bg-opacity-10 text-primary fw-medium mt-1" style="font-size:0.8rem;"><?= esc($user['role_name'] ?? '-') ?></span>
                    <p class="text-muted small mt-2 mb-0" id="photo-filename">Klik ikon kamera untuk ganti foto</p>
                    <p class="text-muted" style="font-size:0.75rem;">JPG, PNG, WebP · Maks. 2 MB</p>
                </div>
            </div>
        </div>

        <!-- RIGHT: Form Fields -->
        <div class="col-lg-9">

            <!-- Informasi Akun -->
            <div class="form-section-card">
                <div class="form-section-header">
                    <div class="form-section-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <h6 class="form-section-title">Informasi Akun</h6>
                </div>
                <div class="p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-custom">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-control-custom" name="full_name"
                                   value="<?= esc(old('full_name', $user['name'] ?? '')) ?>" required placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control form-control-custom" name="email"
                                   value="<?= esc(old('email', $user['email'] ?? '')) ?>" required placeholder="contoh@email.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">No. Telepon</label>
                            <input type="text" class="form-control form-control-custom" name="phone"
                                   value="<?= esc(old('phone', $user['phone'] ?? '')) ?>" placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Jenis Pemohon</label>
                            <select name="applicant_type_id" class="form-select form-control-custom">
                                <option value="">-- Pilih Jenis Pemohon --</option>
                                <?php foreach ($applicantTypes as $type) : ?>
                                    <option value="<?= $type['id'] ?>" <?= old('applicant_type_id', $user['applicant_type_id'] ?? '') == $type['id'] ? 'selected' : '' ?>>
                                        <?= esc($type['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label-custom">Jenis Kelamin</label>
                            <div class="radio-group">
                                <label class="radio-option">
                                    <input type="radio" name="gender" value="L" <?= old('gender', $user['gender'] ?? '') == 'L' ? 'checked' : '' ?>>
                                    <i class="bi bi-gender-male"></i> Laki-laki
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="gender" value="P" <?= old('gender', $user['gender'] ?? '') == 'P' ? 'checked' : '' ?>>
                                    <i class="bi bi-gender-female"></i> Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informasi Akademik -->
            <div class="form-section-card">
                <div class="form-section-header">
                    <div class="form-section-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-mortarboard-fill"></i>
                    </div>
                    <h6 class="form-section-title">Informasi Akademik</h6>
                </div>
                <div class="p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label-custom">NIM</label>
                            <input type="text" class="form-control form-control-custom" name="nim"
                                   value="<?= esc(old('nim', $user['nim'] ?? '')) ?>" placeholder="Nomor Induk Mahasiswa">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">NIK</label>
                            <input type="text" class="form-control form-control-custom" name="nik"
                                   value="<?= esc(old('nik', $user['nik'] ?? '')) ?>" placeholder="Nomor Induk Kependudukan">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Program Studi</label>
                            <select name="study_program_id" class="form-select form-control-custom">
                                <option value="">-- Pilih Program Studi --</option>
                                <?php foreach ($studyPrograms as $prodi) : ?>
                                    <option value="<?= $prodi['id'] ?>" <?= old('study_program_id', $user['study_program_id'] ?? '') == $prodi['id'] ? 'selected' : '' ?>>
                                        <?= esc($prodi['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-custom">Kelas</label>
                            <select name="class_id" class="form-select form-control-custom">
                                <option value="">-- Pilih Kelas --</option>
                                <?php foreach ($classes as $kelas) : ?>
                                    <option value="<?= $kelas['id'] ?>" <?= old('class_id', $user['class_id'] ?? '') == $kelas['id'] ? 'selected' : '' ?>>
                                        <?= esc($kelas['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alamat -->
            <div class="form-section-card">
                <div class="form-section-header">
                    <div class="form-section-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h6 class="form-section-title">Alamat</h6>
                </div>
                <div class="p-4">
                    <label class="form-label-custom">Alamat Lengkap</label>
                    <textarea class="form-control form-control-custom" name="address" rows="3"
                              placeholder="Masukkan alamat lengkap..."><?= esc(old('address', $user['address'] ?? '')) ?></textarea>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex gap-2 justify-content-end">
                <a href="<?= base_url('profil') ?>" class="btn btn-light px-4 rounded-pill">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                    <i class="bi bi-floppy me-2"></i> Simpan Perubahan
                </button>
            </div>

        </div><!-- end col-lg-9 -->
    </div><!-- end row -->
</form>

<script>
document.getElementById('photoInput').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) return;
    if (file.size > 2 * 1024 * 1024) {
        alert('Ukuran file melebihi 2 MB!');
        this.value = '';
        return;
    }
    document.getElementById('photo-filename').textContent = file.name;
    const reader = new FileReader();
    reader.onload = function (ev) {
        const preview = document.getElementById('avatar-preview');
        preview.innerHTML = '';
        const img = document.createElement('img');
        img.src = ev.target.result;
        img.alt = 'preview';
        img.className = 'w-100 h-100 object-fit-cover';
        img.id = 'preview-img';
        preview.appendChild(img);
    };
    reader.readAsDataURL(file);
});
</script>

<?= $this->endSection() ?>
