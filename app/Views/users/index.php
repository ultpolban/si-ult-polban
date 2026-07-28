<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Manajemen User</h3>
            <p class="text-muted mb-0">Kelola data pengguna sistem</p>
        </div>
        <div>
            <a href="<?= base_url('users/create') ?>" class="btn btn-filter-submit d-flex align-items-center" style="background: linear-gradient(135deg, #1e2f99 0%, #1e3a60 100%); box-shadow: 0 4px 10px rgba(11, 34, 64, 0.15);">
                <i class="fas fa-user-plus mr-1"></i> Tambah User
            </a>
        </div>
    </div>

    <!-- Alert Success -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius: 8px;">
            <i class="fas fa-check-circle mr-2"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <!-- Search Controls -->
    <div class="card card-premium card-orange-top">
        <div class="card-body p-3">
            <form action="" method="get" class="search-filter-container m-0 d-flex gap-2 align-items-center">
                <div class="search-input-group flex-grow-1 m-0">
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, email atau nomor HP..." value="<?= esc($search ?? '') ?>">
                </div>
                
                <button type="submit" class="btn btn-success px-4" style="height: 40px; border-radius: 8px; background: linear-gradient(135deg, #28a745 0%, #218838 100%); border: none; font-weight: 600; box-shadow: 0 4px 10px rgba(40, 167, 69, 0.15);">
                    Cari
                </button>
                <a href="<?= base_url('users') ?>" class="btn btn-secondary px-4 d-flex align-items-center justify-content-center" style="height: 40px; border-radius: 8px; background-color: #6c757d; border: none; font-weight: 600; box-shadow: 0 4px 10px rgba(108, 117, 125, 0.15);">
                    Reset
                </a>
            </form>
        </div>
    </div>

    <!-- Users Table Card -->
    <div class="card card-premium card-orange-top">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-premium">
                    <thead>
                        <tr>
                            <th style="width: 50px;">No</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th>Unit Kerja</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th style="width: 90px; text-align: center;">Status</th>
                            <th style="width: 130px; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        foreach ($users as $user): 
                            // Determine Unit Work based on role
                            $unit = '-';
                            if ($user['role_id'] == 2) {
                                $unit = 'ULT';
                            } elseif ($user['role_id'] == 3) {
                                $unit = ($user['id'] % 2 == 0) ? 'Keuangan' : 'Akademik';
                            } elseif ($user['role_id'] == 4) {
                                $unit = 'Pemohon';
                            } elseif ($user['role_id'] == 5) {
                                $unit = 'Pimpinan';
                            }
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="font-weight-bold" style="color: #1e2f99;"><?= esc($user['name']) ?></td>
                            <td>
                                <span class="badge bg-light text-dark font-weight-normal px-2 py-1" style="border: 1px solid #cbd5e1; border-radius: 4px;">
                                    <?= esc($user['role_name']) ?>
                                </span>
                            </td>
                            <td><?= $unit ?></td>
                            <td><?= esc($user['email']) ?></td>
                            <td><?= esc($user['phone'] ?? '-') ?></td>
                            <td class="text-center">
                                <span class="status-badge <?= ($user['is_active'] == 1) ? 'badge-aktif' : 'badge-nonaktif' ?>">
                                    <?= ($user['is_active'] == 1) ? 'Aktif' : 'Nonaktif' ?>
                                </span>
                            </td>
                            <!-- AKSI: compact icon group + dropdown -->
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center" style="gap: 4px;">
                                    <!-- Detail -->
                                    <button type="button"
                                        class="btn-icon-action btn-detail"
                                        title="Detail"
                                        data-name="<?= esc($user['name']) ?>"
                                        data-role="<?= esc($user['role_name']) ?>"
                                        data-unit="<?= $unit ?>"
                                        data-email="<?= esc($user['email']) ?>"
                                        data-phone="<?= esc($user['phone'] ?? '-') ?>"
                                        data-status="<?= ($user['is_active'] == 1) ? 'Aktif' : 'Nonaktif' ?>"
                                        data-created="<?= esc($user['created_at']) ?>"
                                        style="background: #0ea5e9; color: #fff;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <!-- Edit -->
                                    <a href="<?= base_url('users/edit/' . $user['id']) ?>"
                                       class="btn-icon-action"
                                       title="Edit"
                                       style="background: #f59e0b; color: #fff;">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <!-- More actions (toggle + delete) dropdown -->
                                    <div class="dropdown">
                                        <button class="btn-icon-action dropdown-toggle-no-caret"
                                                data-toggle="dropdown"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                                title="Lainnya"
                                                style="background: #64748b; color: #fff;">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right shadow border-0" style="border-radius: 10px; min-width: 160px; padding: 6px 0;">
                                            <a class="dropdown-item d-flex align-items-center py-2 px-3"
                                               href="<?= base_url('users/toggle/' . $user['id']) ?>"
                                               style="font-size: 0.875rem; color: <?= ($user['is_active'] == 1) ? '#475569' : '#16a34a' ?>;">
                                                <i class="fas fa-<?= ($user['is_active'] == 1) ? 'ban' : 'check-circle' ?> mr-2" style="width: 16px;"></i>
                                                <?= ($user['is_active'] == 1) ? 'Nonaktifkan' : 'Aktifkan' ?>
                                            </a>
                                            <div class="dropdown-divider my-1"></div>
                                            <a class="dropdown-item d-flex align-items-center py-2 px-3"
                                               href="<?= base_url('users/delete/' . $user['id']) ?>"
                                               style="font-size: 0.875rem; color: #dc2626;"
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus user <?= esc($user['name']) ?>?')">
                                                <i class="fas fa-trash-alt mr-2" style="width: 16px;"></i>
                                                Hapus
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if (empty($users)): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">
                                Tidak ada data user ditemukan.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Detail User Modal -->
<div class="modal fade" id="detailUserModal" tabindex="-1" aria-labelledby="detailUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 12px;">
            <div class="modal-header border-bottom-0 pt-4 px-4 pb-2">
                <h5 class="modal-title font-weight-bold" id="detailUserModalLabel" style="color: #1e2f99;">Detail Informasi Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4 pb-4 pt-2">
                <div class="d-flex align-items-center mb-4">
                    <img id="detail-avatar" src="" alt="Avatar" class="rounded-circle mr-3" style="width: 60px; height: 60px; object-fit: cover; border: 2px solid #e2e8f0;">
                    <div>
                        <h4 id="detail-name" class="font-weight-bold mb-1" style="color: #0f172a; font-size: 1.2rem;">-</h4>
                        <span id="detail-role" class="badge badge-light border text-dark px-2 py-1">-</span>
                    </div>
                </div>
                
                <div class="row pt-2 border-top">
                    <div class="col-12 mb-3">
                        <small class="text-muted d-block">Unit Kerja</small>
                        <span id="detail-unit" class="font-weight-medium" style="color: #334155;">-</span>
                    </div>
                    <div class="col-12 mb-3">
                        <small class="text-muted d-block">Email</small>
                        <span id="detail-email" class="font-weight-medium" style="color: #334155;">-</span>
                    </div>
                    <div class="col-12 mb-3">
                        <small class="text-muted d-block">Nomor HP</small>
                        <span id="detail-phone" class="font-weight-medium" style="color: #334155;">-</span>
                    </div>
                    <div class="col-6 mb-2">
                        <small class="text-muted d-block">Status</small>
                        <span id="detail-status" class="badge">-</span>
                    </div>
                    <div class="col-6 mb-2">
                        <small class="text-muted d-block">Tanggal Terdaftar</small>
                        <span id="detail-created" class="font-weight-medium" style="color: #334155;">-</span>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0 pt-0 px-4 pb-4">
                <button type="button" class="btn btn-light w-100" data-dismiss="modal" style="border-radius: 8px; font-weight: 600;">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const detailButtons = document.querySelectorAll('.btn-detail');
    detailButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const name = this.getAttribute('data-name');
            const role = this.getAttribute('data-role');
            const unit = this.getAttribute('data-unit');
            const email = this.getAttribute('data-email');
            const phone = this.getAttribute('data-phone');
            const status = this.getAttribute('data-status');
            const created = this.getAttribute('data-created');

            document.getElementById('detail-name').innerText = name;
            document.getElementById('detail-role').innerText = role;
            document.getElementById('detail-unit').innerText = unit;
            document.getElementById('detail-email').innerText = email;
            document.getElementById('detail-phone').innerText = phone;
            document.getElementById('detail-created').innerText = created;

            const statusEl = document.getElementById('detail-status');
            statusEl.innerText = status;
            statusEl.className = 'badge px-2.5 py-1 ' + (status === 'Aktif' ? 'bg-success text-white' : 'bg-secondary text-white');

            const avatarUrl = `https://ui-avatars.com/api/?name=${encodeURIComponent(name)}&background=0b2240&color=fff`;
            document.getElementById('detail-avatar').src = avatarUrl;

            $('#detailUserModal').modal('show');
        });
    });
});
</script>

<?= $this->endSection() ?>
