<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <!-- Kolom Kiri: Informasi Profil (View) -->
    <div class="col-md-4">
        <div class="card card-primary card-outline shadow-sm">
            <div class="card-body box-profile">
                <div class="text-center mb-4">
                    <img class="profile-user-img img-fluid img-circle shadow"
                     src="<?= base_url(($profile['photo'] ?? null) ?: ($user['profile_photo'] ?? null) ?: 'assets/img/avatar.png') ?>"
                         alt="User profile picture" style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%; border: 3px solid #dee2e6;">
                </div>
                <h3 class="profile-username text-center fw-bold text-dark"><?= esc($user['full_name'] ?? '-') ?></h3>
                <p class="text-muted text-center mb-4"><?= esc($user['role_name'] ?? '-') ?></p>

                <ul class="list-group list-group-flush mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted"><i class="fas fa-envelope mr-2"></i> Email</span>
                        <span class="fw-medium text-dark"><?= esc($user['email'] ?? '-') ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted"><i class="fas fa-phone mr-2"></i> No. Telepon</span>
                        <span class="fw-medium text-dark"><?= esc($profile['phone'] ?? '-') ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted"><i class="fas fa-venus-mars mr-2"></i> Gender</span>
                        <span class="fw-medium text-dark"><?= ($user['gender'] ?? '') === 'L' ? 'Laki-laki' : (($user['gender'] ?? '') === 'P' ? 'Perempuan' : '-') ?></span>
                    </li>
                    <?php 
                        $applicantTypeName = '-';
                        foreach($applicantTypes as $at) { if(!is_null($profile) && ($profile['applicant_type_id'] ?? '') == $at['id']) $applicantTypeName = $at['name']; }
                    ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted"><i class="fas fa-user-tag mr-2"></i> Tipe Pemohon</span>
                        <span class="fw-medium text-dark"><?= esc($applicantTypeName) ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted"><i class="fas fa-id-card mr-2"></i> NIM / NIK</span>
                        <span class="fw-medium text-dark"><?= esc(($profile['nim'] ?? '') ?: ($profile['nik'] ?? '') ?: '-') ?></span>
                    </li>
                    <?php 
                        $studyProgramName = '-';
                        foreach($studyPrograms as $sp) { if(!is_null($profile) && ($profile['study_program_id'] ?? '') == $sp['id']) $studyProgramName = $sp['name']; }
                    ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted"><i class="fas fa-graduation-cap mr-2"></i> Program Studi</span>
                        <span class="fw-medium text-dark"><?= esc($studyProgramName) ?></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Form Ubah Profil -->
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="card-title mb-0 fw-bold"><i class="fas fa-user-edit text-primary mr-2"></i> Ubah Profil</h5>
            </div>
            
            <div class="card-body">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= esc(session()->getFlashdata('success')) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= esc(session()->getFlashdata('error')) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="<?= site_url('profile/update') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="full_name" class="form-control bg-light" value="<?= old('full_name', $user['full_name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control bg-light" value="<?= old('email', $user['email'] ?? '') ?>" required>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">No. Telepon</label>
                            <input type="text" name="phone" class="form-control bg-light" value="<?= old('phone', $profile['phone'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Jenis Pemohon</label>
                            <select name="applicant_type_id" class="form-select bg-light">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($applicantTypes as $at): ?>
                                    <option value="<?= $at['id'] ?>" <?= !is_null($profile) && ($profile['applicant_type_id'] ?? '') == $at['id'] ? 'selected' : '' ?>>>
                                        <?= esc($at['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Jenis Kelamin</label>
                            <div class="d-flex gap-4 pt-2">
                                <div class="form-check">
                                    <input type="radio" name="gender" id="profile_gender_l" value="L" class="form-check-input" <?= ($user['gender'] ?? '') === 'L' ? 'checked' : '' ?>>
                                    <label for="profile_gender_l" class="form-check-label">Laki-laki</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="gender" id="profile_gender_p" value="P" class="form-check-input" <?= ($user['gender'] ?? '') === 'P' ? 'checked' : '' ?>>
                                    <label for="profile_gender_p" class="form-check-label">Perempuan</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Ganti Foto Profil (Maks. 2MB)</label>
                            <input type="file" name="photo" class="form-control bg-light" accept="image/*">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">NIM</label>
                            <input type="text" name="nim" class="form-control bg-light" value="<?= old('nim', $profile['nim'] ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">NIK</label>
                            <input type="text" name="nik" class="form-control bg-light" value="<?= old('nik', $profile['nik'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Program Studi</label>
                            <select name="study_program_id" class="form-select bg-light">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($studyPrograms as $sp): ?>
                                    <option value="<?= $sp['id'] ?>" <?= !is_null($profile) && ($profile['study_program_id'] ?? '') == $sp['id'] ? 'selected' : '' ?>>>
                                        <?= esc($sp['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Kelas</label>
                            <select name="class_id" class="form-select bg-light">
                                <option value="">-- Pilih --</option>
                                <?php foreach ($classes as $c): ?>
                                    <option value="<?= $c['id'] ?>" <?= !is_null($profile) && ($profile['class_id'] ?? '') == $c['id'] ? 'selected' : '' ?>>>
                                        <?= esc($c['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted">Alamat</label>
                        <textarea name="address" rows="2" class="form-control bg-light"><?= old('address', $profile['address'] ?? '') ?></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4 shadow-sm">
                            <i class="fas fa-save mr-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>