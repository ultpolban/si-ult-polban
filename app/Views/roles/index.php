<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Management Role</h3>
            <p class="text-muted mb-0">Kelola data role pengguna sistem</p>
        </div>
        <a href="<?= base_url('roles/create') ?>" class="btn btn-filter-submit d-flex align-items-center" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); box-shadow: 0 4px 10px rgba(11, 34, 64, 0.15);">
            <i class="fas fa-plus mr-1"></i> Tambah Role
        </a>
    </div>

    <!-- Alert Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 8px;">
            <i class="fas fa-check-circle mr-2"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 8px;">
            <i class="fas fa-exclamation-triangle mr-2"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Role Table Card -->
    <div class="card card-premium">
        <!-- Blue header bar matching screenshot -->
        <div class="card-header py-3" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); border-radius: 14px 14px 0 0; border-bottom: 4px solid #F58220 !important;">
            <h5 class="text-white font-weight-bold m-0" style="font-size: 1.05rem; letter-spacing: 0.4px;">Management Role</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-premium">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th style="width: 200px;">Role</th>
                            <th>Deskripsi</th>
                            <th style="width: 120px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($roles)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">Belum ada data role.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($roles as $role): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="font-weight-bold" style="color: #1e2f99;"><?= esc($role['role_name']) ?></td>
                                <td class="text-muted"><?= esc($role['description'] ?? '-') ?></td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center justify-content-center" style="gap: 6px;">
                                        <a href="<?= base_url('roles/edit/' . $role['id']) ?>"
                                           class="btn-icon-action"
                                           title="Edit"
                                           style="background: #f59e0b; color: #fff;">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                        <a href="<?= base_url('roles/delete/' . $role['id']) ?>"
                                           class="btn-icon-action"
                                           title="Hapus"
                                           style="background: #ef4444; color: #fff;"
                                           onclick="return confirm('Hapus role <?= esc($role['role_name']) ?>? Pastikan tidak ada user yang menggunakan role ini.')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

