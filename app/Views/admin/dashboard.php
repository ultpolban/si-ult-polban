<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Dashboard Admin</h3>
            <p class="text-muted mb-0">Selamat datang kembali, Admin ULT</p>
        </div>
        <div>
            <span class="badge bg-white shadow-sm text-dark px-3 py-2" style="border-radius: 8px; font-weight: 500;">
                <i class="far fa-calendar-alt text-orange mr-1"></i> <?= date('d M Y') ?>
            </span>
        </div>
    </div>

    <!-- Stat Cards Row -->
    <div class="row">
        <!-- Card 1: Total User -->
        <div class="col-xl-3 col-md-6 col-12">
            <a href="<?= base_url('users') ?>" class="text-decoration-none text-white">
                <div class="card-stat card-stat-blue">
                    <div>
                        <div class="stat-label">Total User</div>
                        <div class="stat-value"><?= number_format($totalUser, 0, ',', '.') ?></div>
                    </div>
                    <div class="stat-meta">
                        <i class="fas fa-users"></i> Kelola Pengguna
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 2: User Aktif -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card-stat card-stat-teal" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;">
                <div>
                    <div class="stat-label">User Aktif</div>
                    <div class="stat-value"><?= number_format($userAktif, 0, ',', '.') ?></div>
                </div>
                <div class="stat-meta">
                    <i class="fas fa-check-circle"></i> Pengguna Aktif
                </div>
            </div>
        </div>

        <!-- Card 3: Petugas ULT -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card-stat card-stat-orange">
                <div>
                    <div class="stat-label">Petugas ULT</div>
                    <div class="stat-value"><?= number_format($petugasUlt, 0, ',', '.') ?></div>
                </div>
                <div class="stat-meta">
                    <i class="fas fa-user-shield"></i> Staf Unit Layanan
                </div>
            </div>
        </div>

        <!-- Card 4: Pemohon -->
        <div class="col-xl-3 col-md-6 col-12">
            <div class="card-stat card-stat-red">
                <div>
                    <div class="stat-label">Pemohon</div>
                    <div class="stat-value"><?= number_format($pemohon, 0, ',', '.') ?></div>
                </div>
                <div class="stat-meta">
                    <i class="fas fa-user-friends"></i> Mahasiswa & Publik
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Users Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card card-premium">
                <div class="card-header card-header-blue d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">User Terbaru</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-premium">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Email</th>
                                    <th style="width: 150px; text-align: center;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentUsers as $user): ?>
                                <tr>
                                    <td class="font-weight-bold" style="color: #1e2f99;"><?= esc($user['name']) ?></td>
                                    <td>
                                        <span class="badge bg-light text-dark font-weight-normal px-2 py-1" style="border: 1px solid #cbd5e1; border-radius: 4px;">
                                            <?= esc($user['role_name']) ?>
                                        </span>
                                    </td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td class="text-center">
                                        <span class="status-badge <?= ($user['is_active'] == 1) ? 'badge-aktif' : 'badge-nonaktif' ?>">
                                            <?= ($user['is_active'] == 1) ? 'Aktif' : 'Nonaktif' ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if (empty($recentUsers)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        Belum ada pengguna terdaftar.
                                    </td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
