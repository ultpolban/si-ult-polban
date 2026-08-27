<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">

    <div class="col-md-4">

        <div class="card card-primary card-outline">

            <div class="card-body box-profile">

                <div class="text-center">

                    <img
                        class="profile-user-img img-fluid img-circle"
                        src="<?= base_url($user['photo'] ?? 'assets/img/avatar.png') ?>"
                        alt="User profile picture">

                </div>

                <h3 class="profile-username text-center">

                    <?= esc($user['full_name'] ?? '-') ?>

                </h3>

                <p class="text-muted text-center">

                    <?= esc($user['role_name'] ?? '-') ?>

                </p>

            </div>

        </div>

    </div>

    <div class="col-md-8">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-user-edit"></i>

                    Ubah Profil

                </h3>

            </div>

            <div class="card-body">

                <?php if (session()->getFlashdata('success')): ?>

                    <div class="alert alert-success alert-dismissible">

                        <button type="button" class="close" data-dismiss="alert">&times;</button>

                        <?= esc(session()->getFlashdata('success')) ?>

                    </div>

                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>

                    <div class="alert alert-danger alert-dismissible">

                        <button type="button" class="close" data-dismiss="alert">&times;</button>

                        <?= esc(session()->getFlashdata('error')) ?>

                    </div>

                <?php endif; ?>

                <form action="<?= site_url('profile/update') ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Nama Lengkap <span class="text-danger">*</span></label>

                            <input type="text" name="full_name"
                                class="form-control"
                                value="<?= old('full_name', $user['full_name'] ?? '') ?>">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Email <span class="text-danger">*</span></label>

                            <input type="email" name="email"
                                class="form-control"
                                value="<?= old('email', $user['email'] ?? '') ?>">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>No. Telepon</label>

                            <input type="text" name="phone"
                                class="form-control"
                                value="<?= old('phone', $profile['phone'] ?? '') ?>">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Jenis Pemohon</label>

                            <select name="applicant_type_id" class="form-control">

                                <option value="">-- Pilih --</option>

                                <?php foreach ($applicantTypes as $at): ?>

                                    <option value="<?= $at['id'] ?>"
                                        <?= ($profile['applicant_type_id'] ?? '') == $at['id'] ? 'selected' : '' ?>>

                                        <?= esc($at['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Jenis Kelamin</label>

                            <div class="d-flex gap-4 pt-2">

                                <div class="form-check">

                                    <input type="radio" name="gender" id="profile_gender_l" value="L"
                                        class="form-check-input"
                                        <?= ($user['gender'] ?? '') === 'L' ? 'checked' : '' ?>>

                                    <label for="profile_gender_l" class="form-check-label">Laki-laki</label>

                                </div>

                                <div class="form-check">

                                    <input type="radio" name="gender" id="profile_gender_p" value="P"
                                        class="form-check-input"
                                        <?= ($user['gender'] ?? '') === 'P' ? 'checked' : '' ?>>

                                    <label for="profile_gender_p" class="form-check-label">Perempuan</label>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>NIM</label>

                            <input type="text" name="nim"
                                class="form-control"
                                value="<?= old('nim', $profile['nim'] ?? '') ?>">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>NIK</label>

                            <input type="text" name="nik"
                                class="form-control"
                                value="<?= old('nik', $profile['nik'] ?? '') ?>">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Program Studi</label>

                            <select name="study_program_id" class="form-control">

                                <option value="">-- Pilih --</option>

                                <?php foreach ($studyPrograms as $sp): ?>

                                    <option value="<?= $sp['id'] ?>"
                                        <?= ($profile['study_program_id'] ?? '') == $sp['id'] ? 'selected' : '' ?>>

                                        <?= esc($sp['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Kelas</label>

                            <select name="class_id" class="form-control">

                                <option value="">-- Pilih --</option>

                                <?php foreach ($classes as $c): ?>

                                    <option value="<?= $c['id'] ?>"
                                        <?= ($profile['class_id'] ?? '') == $c['id'] ? 'selected' : '' ?>>

                                        <?= esc($c['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label>Alamat</label>

                        <textarea name="address" rows="2"
                            class="form-control"><?= old('address', $profile['address'] ?? '') ?></textarea>

                    </div>

                    <button type="submit" class="btn btn-primary">

                        <i class="fas fa-save"></i>

                        Simpan Perubahan

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>