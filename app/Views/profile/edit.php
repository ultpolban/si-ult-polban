<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Edit Profil - SI-ULT POLBAN') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-width: 250px;
            --navy-primary: #1e3a8a;
            --navy-sidebar: #22326e;
            --navy-dark: #1a2556;
            --orange-primary: #f97316;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6; }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; top: 0; left: 0; background-color: var(--navy-sidebar); color: #ffffff; z-index: 1000; overflow-y: auto; }
        .sidebar .brand { padding: 20px; font-weight: 700; font-size: 1.1rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1); }
        .sidebar-menu { list-style: none; padding: 15px 0; margin: 0; }
        .sidebar-menu li a { display: flex; align-items: center; padding: 12px 25px; color: #d1d5db; text-decoration: none; font-size: 0.9rem; }
        .sidebar-menu li a:hover, .sidebar-menu li a.active { color: #ffffff; background-color: var(--navy-dark); }
        .sidebar-menu li a i { font-size: 1.1rem; margin-right: 12px; width: 20px; text-align: center; }
        .main-wrapper { margin-left: var(--sidebar-width); min-height: 100vh; }
        .top-navbar { height: 60px; background-color: var(--navy-primary); color: #ffffff; display: flex; align-items: center; justify-content: space-between; padding: 0 25px; }
        .content-body { padding: 30px; }
        .card-custom { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.03); background: #ffffff; }
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="brand d-flex align-items-center gap-2">
            <i class="bi bi-layers-fill text-warning fs-4"></i>
            <span>SI-ULT POLBAN</span>
        </div>
        <ul class="sidebar-menu">
            <li><a href="<?= base_url('profile') ?>" class="active"><i class="bi bi-person"></i> Profil</a></li>
            <li><a href="<?= base_url('dashboard') ?>"><i class="bi bi-house"></i> Dashboard</a></li>
            <li><a href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-left"></i> Logout</a></li>
        </ul>
    </div>

    <div class="main-wrapper">
        <div class="top-navbar">
            <span class="fw-semibold">Sistem Informasi Unit Layanan Terpadu</span>
        </div>

        <div class="content-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold text-dark mb-0">Edit Profil Petugas</h4>
                <a href="<?= base_url('profile') ?>" class="btn btn-secondary px-4 rounded-3">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <!-- Error Validation List -->
            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger border-0 shadow-sm rounded-3">
                    <ul class="mb-0">
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card card-custom p-4">
                <form action="<?= base_url('profile/update') ?>" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="full_name" class="form-control" value="<?= old('full_name', $user['full_name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= old('email', $user['email'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nomor HP</label>
                            <input type="text" name="phone_number" class="form-control" value="<?= old('phone_number', $user['phone_number'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Foto Profil</label>
                            <input type="file" name="profile_photo" class="form-control" accept="image/*">
                            <small class="text-muted">Format: JPG, PNG, WEBP (Maks 2MB)</small>
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn text-white px-4 fw-semibold" style="background-color: var(--orange-primary);">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>