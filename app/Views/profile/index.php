<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="mb-4">
        <h3 class="mb-1">Profil Saya</h3>
        <p class="text-muted mb-0">Kelola informasi akun yang sedang digunakan.</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <form method="post" action="<?= site_url('profil/update') ?>">
                <?= csrf_field() ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="full_name" class="form-control" value="<?= esc($user['full_name'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= esc($user['email'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control" value="<?= esc($user['phone_number'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="<?= esc($user['role_name'] ?? '-') ?>" readonly>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
