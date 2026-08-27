<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold text-dark">
            <i class="bi bi-pencil-square text-primary me-2"></i>Ubah Profil
        </h4>
        <small class="text-muted">Perbarui data diri dan informasi akun Anda.</small>
    </div>
    <a href="<?= base_url('profil') ?>" class="btn btn-outline-secondary btn-sm rounded-pill">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Profil
    </a>
</div>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 bg-danger bg-opacity-10 text-danger mb-4">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<form action="<?= base_url('profil/update') ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="row g-4">
        <!-- Foto Profil -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom border-light py-3">
                    <h6 class="fw-bold mb-0 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.08em;">
                        <i class="bi bi-camera-fill me-2 text-primary"></i>Foto Profil
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex align-items-center gap-4 flex-wrap">
                        <!-- Preview Foto -->
                        <div class="position-relative" id="avatar-preview-wrapper">
                            <div class="rounded-circle border border-3 border-primary border-opacity-25 overflow-hidden bg-light d-flex align-items-center justify-content-center" 
                                 style="width: 100px; height: 100px; font-size: 2rem;" id="avatar-preview">
                                <?php
                                    $photo = $user['profile_photo'] ?? ($user['photo'] ?? null);
                                ?>
                                <?php if (!empty($photo)) : ?>
                                    <img src="<?= base_url('uploads/profiles/' . $photo) ?>" alt="foto" class="w-100 h-100 object-fit-cover" id="preview-img">
                                <?php else : ?>
                                    <span class="fw-bold text-primary" id="preview-initials">
                                        <?= strtoupper(substr(esc($user['name'] ?? 'U'), 0, 1)) ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <!-- Input & Info -->
                        <div>
                            <label for="photoInput" class="btn btn-outline-primary btn-sm rounded-pill mb-2">
                                <i class="bi bi-upload me-1"></i> Pilih Foto
                            </label>
                            <input type="file" id="photoInput" name="photo" class="d-none" accept="image/jpg,image/jpeg,image/png,image/webp">
                            <div class="text-muted small">Format: JPG, PNG, WebP. Maks. 2 MB.</div>
                            <div class="text-muted small mt-1" id="photo-filename">Belum ada foto dipilih.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom border-light py-3">
                    <h6 class="fw-bold mb-0 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.08em;">
                        <i class="bi bi-person-fill me-2 text-primary"></i>Informasi Akun
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light border-0" name="full_name"
                                   value="<?= esc(old('full_name', $user['name'] ?? '')) ?>" required placeholder="Masukkan nama lengkap">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control bg-light border-0" name="email"
                                   value="<?= esc(old('email', $user['email'] ?? '')) ?>" required placeholder="contoh@email.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">No. Telepon</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0 text-muted"><i class="bi bi-telephone"></i></span>
                                <input type="text" class="form-control bg-light border-0" name="phone"
                                       value="<?= esc(old('phone', $user['phone'] ?? '')) ?>" placeholder="08xxxxxxxxxx">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Jenis Pemohon</label>
                            <select name="applicant_type_id" class="form-select bg-light border-0">
                                <option value="">-- Pilih Jenis Pemohon --</option>
                                <?php foreach ($applicantTypes as $type) : ?>
                                    <option value="<?= $type['id'] ?>" <?= old('applicant_type_id', $user['applicant_type_id'] ?? '') == $type['id'] ? 'selected' : '' ?>>
                                        <?= esc($type['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Akademik -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom border-light py-3">
                    <h6 class="fw-bold mb-0 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.08em;">
                        <i class="bi bi-mortarboard-fill me-2 text-primary"></i>Informasi Akademik
                    </h6>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">NIM</label>
                            <input type="text" class="form-control bg-light border-0" name="nim"
                                   value="<?= esc(old('nim', $user['nim'] ?? '')) ?>" placeholder="Nomor Induk Mahasiswa">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">NIK</label>
                            <input type="text" class="form-control bg-light border-0" name="nik"
                                   value="<?= esc(old('nik', $user['nik'] ?? '')) ?>" placeholder="Nomor Induk Kependudukan">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Program Studi</label>
                            <select name="study_program_id" class="form-select bg-light border-0">
                                <option value="">-- Pilih Program Studi --</option>
                                <?php foreach ($studyPrograms as $prodi) : ?>
                                    <option value="<?= $prodi['id'] ?>" <?= old('study_program_id', $user['study_program_id'] ?? '') == $prodi['id'] ? 'selected' : '' ?>>
                                        <?= esc($prodi['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold small">Kelas</label>
                            <select name="class_id" class="form-select bg-light border-0">
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
        </div>

        <!-- Alamat -->
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom border-light py-3">
                    <h6 class="fw-bold mb-0 text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.08em;">
                        <i class="bi bi-geo-alt-fill me-2 text-primary"></i>Alamat
                    </h6>
                </div>
                <div class="card-body p-4">
                    <textarea class="form-control bg-light border-0" name="address" rows="3"
                              placeholder="Masukkan alamat lengkap..."><?= esc(old('address', $user['address'] ?? '')) ?></textarea>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="col-12 d-flex gap-2 justify-content-end pb-2">
            <a href="<?= base_url('profil') ?>" class="btn btn-outline-secondary rounded-pill px-4">
                <i class="bi bi-x-circle me-1"></i>Batal
            </a>
            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm btn-simpan">
                <i class="bi bi-floppy me-2"></i>Simpan Perubahan
            </button>
        </div>
    </div>
</form>

<style>
    .form-control, .form-select {
        transition: all 0.25s ease;
    }
    .form-control:focus, .form-select:focus {
        background-color: #fff !important;
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        transform: translateY(-1px);
    }
    .btn-simpan {
        transition: all 0.3s ease;
    }
    .btn-simpan:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(13, 110, 253, 0.3) !important;
    }
</style>

<script>
document.getElementById('photoInput').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) return;

    // Validasi ukuran
    if (file.size > 2 * 1024 * 1024) {
        alert('Ukuran file melebihi 2 MB!');
        this.value = '';
        return;
    }

    // Tampilkan nama file
    document.getElementById('photo-filename').textContent = file.name;

    // Live preview
    const reader = new FileReader();
    reader.onload = function (ev) {
        const preview = document.getElementById('avatar-preview');

        // Hapus konten lama (initials atau gambar lama)
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
