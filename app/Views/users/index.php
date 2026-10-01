<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

    <div>

        <h2 class="mb-1">Manajemen User</h2>

        <p class="text-muted mb-0">Kelola akun pengguna yang terdaftar pada sistem.</p>

    </div>

    <a href="<?= base_url('users/create') ?>" class="btn btn-primary btn-sm">

        <i class="fas fa-user-plus me-1"></i> Tambah User

    </a>

</div>

<?php if (session()->getFlashdata('success')): ?>

    <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>

<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>

<?php endif; ?>

<div class="card">

    <div class="card-header"><h3 class="card-title">Daftar User</h3></div>

    <div class="card-body">

        <?php if (empty($users)): ?>

            <div class="alert alert-info mb-0">Belum ada user yang terdaftar.</div>

        <?php else: ?>

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-primary">

                        <tr>

                            <th>No</th>

                            <th>Nama Lengkap</th>

                            <th>Email</th>

                            <th>No. HP</th>

                            <th>Role</th>

                            <th>Status</th>

                            <th class="text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php foreach ($users as $no => $user): ?>

                        <tr>

                            <td><?= $no + 1 ?></td>

                            <td><?= esc($user['full_name'] ?? '-') ?></td>

                            <td><?= esc($user['email'] ?? '-') ?></td>

                            <td><?= esc($user['phone_number'] ?? '-') ?></td>

                            <td><?= esc($user['role_name'] ?? '-') ?></td>

                            <td>

                                <?php if ((int) ($user['is_active'] ?? 0) === 1): ?>

                                    <span class="badge bg-success">Aktif</span>

                                <?php else: ?>

                                    <span class="badge bg-secondary">Nonaktif</span>

                                <?php endif; ?>

                            </td>

                            <td class="text-center">

                                <a
                                    href="<?= base_url('users/edit/' . $user['id']) ?>"
                                    class="btn btn-sm btn-primary"
                                    title="Edit">

                                    <i class="fas fa-edit"></i>

                                </a>

                                <a
                                    href="<?= base_url('users/delete/' . $user['id']) ?>"
                                    class="btn btn-sm btn-danger"
                                    data-confirm-link="Yakin ingin menghapus user ini?"
                                    title="Hapus">

                                    <i class="fas fa-trash"></i>

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>
