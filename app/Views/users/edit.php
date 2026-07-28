<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2" style="max-width: 900px; margin: 0 auto;">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Edit User</h3>
            <p class="text-muted mb-0">Ubah data pengguna sistem</p>
        </div>
        <div>
            <a href="<?= base_url('users') ?>" class="btn btn-secondary px-3 d-flex align-items-center" style="border-radius: 8px; background-color: #6c757d; border: none; font-weight: 600; box-shadow: 0 4px 10px rgba(108, 117, 125, 0.15);">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Alert Errors -->
    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger border-0 shadow-sm mb-4" role="alert" style="border-radius: 8px;">
            <h6 class="font-weight-bold mb-2"><i class="fas fa-exclamation-triangle mr-2"></i> Perbaiki input berikut:</h6>
            <ul class="mb-0 pl-4">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Form Card -->
    <div class="card card-premium">
        <!-- Header custom styled blue bar -->
        <div class="card-header border-bottom-0 py-3" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); border-radius: 14px 14px 0 0;">
            <h5 class="text-white font-weight-bold m-0" style="font-size: 1.1rem; letter-spacing: 0.5px;">Edit User</h5>
        </div>
        <div class="card-body p-4">
            <form action="<?= base_url('users/update/' . $user['id']) ?>" method="post">
                
                <div class="row">
                    <!-- Row 1: Role & Unit Kerja -->
                    <div class="col-md-6 form-group mb-3">
                        <label for="role_id" class="font-weight-bold text-dark mb-1">Role</label>
                        <select name="role_id" id="role_id" class="form-control select-filter w-100" style="height: 40px; border-radius: 8px;" required>
                            <option value="">Pilih Role</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role['id'] ?>" <?= old('role_id', $user['role_id']) == $role['id'] ? 'selected' : '' ?>>
                                    <?= $role['role_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="unit_kerja" class="font-weight-bold text-dark mb-1">Unit Kerja</label>
                        <select name="unit_kerja" id="unit_kerja" class="form-control select-filter w-100" style="height: 40px; border-radius: 8px;">
                            <?php $selectedUnit = old('unit_kerja', ''); ?>
                            <option value="">Pilih Unit Kerja</option>
                            <option value="Direktorat" <?= $selectedUnit == 'Direktorat' ? 'selected' : '' ?>>Direktorat</option>
                            <option value="Bagian Akademik" <?= $selectedUnit == 'Bagian Akademik' ? 'selected' : '' ?>>Bagian Akademik</option>
                            <option value="Bagian Keuangan" <?= $selectedUnit == 'Bagian Keuangan' ? 'selected' : '' ?>>Bagian Keuangan</option>
                            <option value="Bagian Kemahasiswaan" <?= $selectedUnit == 'Bagian Kemahasiswaan' ? 'selected' : '' ?>>Bagian Kemahasiswaan</option>
                            <option value="Perpustakaan" <?= $selectedUnit == 'Perpustakaan' ? 'selected' : '' ?>>Perpustakaan</option>
                            <option value="UPT TIK" <?= $selectedUnit == 'UPT TIK' ? 'selected' : '' ?>>UPT TIK</option>
                            <option value="UPT Bahasa" <?= $selectedUnit == 'UPT Bahasa' ? 'selected' : '' ?>>UPT Bahasa</option>
                            <option value="UPT K3" <?= $selectedUnit == 'UPT K3' ? 'selected' : '' ?>>UPT K3</option>
                            <option value="Humas" <?= $selectedUnit == 'Humas' ? 'selected' : '' ?>>Humas</option>
                            <option value="SPI" <?= $selectedUnit == 'SPI' ? 'selected' : '' ?>>SPI</option>
                        </select>
                    </div>

                    <!-- Row 2: Nama Lengkap -->
                    <div class="col-12 form-group mb-3">
                        <label for="name" class="font-weight-bold text-dark mb-1">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control" style="border-radius: 8px; height: 40px;" placeholder="Masukkan nama lengkap" value="<?= esc(old('name', $user['name'])) ?>" required>
                    </div>

                    <!-- Row 3: Jenis Kelamin & No HP -->
                    <div class="col-md-6 form-group mb-3">
                        <label for="jenis_kelamin" class="font-weight-bold text-dark mb-1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control select-filter w-100" style="height: 40px; border-radius: 8px;">
                            <option value="">Pilih</option>
                            <option value="Laki-laki" <?= old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="Perempuan" <?= old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="phone" class="font-weight-bold text-dark mb-1">No HP</label>
                        <input type="text" name="phone" id="phone" class="form-control" style="border-radius: 8px; height: 40px;" placeholder="08xxxxxxxxxx" value="<?= esc(old('phone', $user['phone'])) ?>" required>
                    </div>

                    <!-- Row 4: NIP & NIDN -->
                    <div class="col-md-6 form-group mb-3">
                        <label for="nip" class="font-weight-bold text-dark mb-1">NIP</label>
                        <input type="text" name="nip" id="nip" class="form-control" style="border-radius: 8px; height: 40px;" placeholder="Masukkan NIP jika ada" value="<?= old('nip') ?>">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="nidn" class="font-weight-bold text-dark mb-1">NIDN</label>
                        <input type="text" name="nidn" id="nidn" class="form-control" style="border-radius: 8px; height: 40px;" placeholder="Masukkan NIDN jika ada" value="<?= old('nidn') ?>">
                    </div>

                    <!-- Row 5: Email Institusi & Email Pribadi -->
                    <div class="col-md-6 form-group mb-3">
                        <label for="email" class="font-weight-bold text-dark mb-1">Email Institusi</label>
                        <input type="email" name="email" id="email" class="form-control" style="border-radius: 8px; height: 40px;" placeholder="example@ultpolban.ac.id" value="<?= esc(old('email', $user['email'])) ?>" required>
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="email_pribadi" class="font-weight-bold text-dark mb-1">Email Pribadi</label>
                        <input type="email" name="email_pribadi" id="email_pribadi" class="form-control" style="border-radius: 8px; height: 40px;" placeholder="example@gmail.com" value="<?= old('email_pribadi') ?>">
                    </div>

                    <!-- Row 6: Tempat Lahir & Tanggal Lahir -->
                    <div class="col-md-6 form-group mb-3">
                        <label for="tempat_lahir" class="font-weight-bold text-dark mb-1">Tempat Lahir</label>
                        <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" style="border-radius: 8px; height: 40px;" placeholder="Masukkan tempat lahir" value="<?= old('tempat_lahir') ?>">
                    </div>
                    <div class="col-md-6 form-group mb-3">
                        <label for="tanggal_lahir" class="font-weight-bold text-dark mb-1">Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" style="border-radius: 8px; height: 40px;" value="<?= old('tanggal_lahir') ?>">
                    </div>

                    <!-- Row 7: Alamat -->
                    <div class="col-12 form-group mb-3">
                        <label for="alamat" class="font-weight-bold text-dark mb-1">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" rows="3" style="border-radius: 8px;" placeholder="Masukkan alamat lengkap"><?= old('alamat') ?></textarea>
                    </div>

                    <!-- Row 8: Password & Status -->
                    <div class="col-md-6 form-group mb-4">
                        <label for="password" class="font-weight-bold text-dark mb-1">Password (Kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" id="password" class="form-control" style="border-radius: 8px; height: 40px;" placeholder="Masukkan password baru">
                    </div>
                    <div class="col-md-6 form-group mb-4">
                        <label for="is_active" class="font-weight-bold text-dark mb-1">Status</label>
                        <select name="is_active" id="is_active" class="form-control select-filter w-100" style="height: 40px; border-radius: 8px;">
                            <option value="1" <?= old('is_active', $user['is_active']) == '1' ? 'selected' : '' ?>>Aktif</option>
                            <option value="0" <?= old('is_active', $user['is_active']) == '0' ? 'selected' : '' ?>>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <!-- Action Buttons styled exactly like the bottom-left layout of screenshot -->
                <div class="d-flex justify-content-start gap-2 pt-2 border-top">
                    <button type="submit" class="btn btn-primary px-4 mr-2" style="height: 40px; border-radius: 8px; background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); border: none; font-weight: 600; box-shadow: 0 4px 10px rgba(11, 34, 64, 0.15);">
                        Update
                    </button>
                    <a href="<?= base_url('users') ?>" class="btn btn-secondary px-4 d-flex align-items-center justify-content-center" style="height: 40px; border-radius: 8px; background-color: #6c757d; border: none; font-weight: 600; box-shadow: 0 4px 10px rgba(108, 117, 125, 0.15);">
                        Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
