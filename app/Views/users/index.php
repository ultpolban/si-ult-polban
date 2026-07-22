<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h3 class="mb-0">

            Management User

        </h3>

        <small class="text-muted">

            Kelola seluruh pengguna SI ULT POLBAN

        </small>

    </div>

    <div>

        <a href="<?= base_url('users/create') ?>"
            class="btn btn-primary">

            <i class="bi bi-plus-circle"></i>

            Tambah User

        </a>

    </div>

</div>

<?php if (session()->getFlashdata('success')) : ?>

    <div class="alert alert-success">

        <?= session()->getFlashdata('success') ?>

    </div>

<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>

    <div class="alert alert-danger">

        <?= session()->getFlashdata('error') ?>

    </div>

<?php endif; ?>

<div class="row mb-4">

    <div class="col-md-3">

        <div class="card border-primary shadow-sm">

            <div class="card-body">

                <h6>Total User</h6>

                <h2>

                    <?= $totalUser ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-success shadow-sm">

            <div class="card-body">

                <h6>User Aktif</h6>

                <h2 class="text-success">

                    <?= $totalActive ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-danger shadow-sm">

            <div class="card-body">

                <h6>User Nonaktif</h6>

                <h2 class="text-danger">

                    <?= $totalInactive ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="card border-warning shadow-sm">

            <div class="card-body">

                <h6>Mahasiswa</h6>

                <h2 class="text-warning">

                    <?= $totalMahasiswa ?>

                </h2>

            </div>

        </div>

    </div>

</div>

<div class="card mb-4">

    <div class="card-body">

        <form method="get">

            <div class="row">

                <div class="col-md-4">

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari nama / email / NIM..."

                        value="<?= esc($keyword) ?>">

                </div>

                <div class="col-md-3">

                    <select
                        name="role"
                        class="form-select">

                        <option value="">

                            Semua Role

                        </option>

                        <?php foreach ($roles as $role): ?>

                            <option
                                value="<?= $role['id'] ?>"
                                <?= ($selectedRole == $role['id']) ? 'selected' : '' ?>>

                                <?= esc($role['role_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-3">

                    <select
                        name="type"
                        class="form-select">

                        <option value="">

                            Semua Jenis

                        </option>

                        <?php foreach ($userTypes as $type): ?>

                            <option
                                value="<?= $type['id'] ?>"
                                <?= ($selectedType == $type['id']) ? 'selected' : '' ?>>

                                <?= esc($type['type_name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-2 d-grid">

                    <button
                        class="btn btn-primary">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card shadow-sm">

    <div class="card-header bg-primary text-white">

        <strong>

            Daftar User

        </strong>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-bordered align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th width="60">No</th>

                        <th width="80">Foto</th>

                        <th>Nama User</th>

                        <th>Role</th>

                        <th>Jenis Pemohon</th>

                        <th>Email</th>

                        <th>No HP</th>

                        <th>Status</th>

                        <th width="180">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (empty($users)) : ?>

                        <tr>

                            <td colspan="9" class="text-center py-4">

                                Tidak ada data user.

                            </td>

                        </tr>

                    <?php endif; ?>

                    <?php

                    $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());

                    ?>

                    <?php foreach ($users as $user): ?>

                        <tr>

                            <td>

                                <?= $no++ ?>

                            </td>

                            <td class="text-center">

                                <?php if (!empty($user['photo'])) : ?>

                                    <img

                                        src="<?= base_url('uploads/users/' . $user['photo']) ?>"

                                        style="width:55px;height:55px;object-fit:cover"

                                        class="rounded-circle border">

                                <?php else : ?>

                                    <i class="bi bi-person-circle"

                                        style="font-size:45px;color:#adb5bd"></i>

                                <?php endif; ?>

                            </td>

                            <td>

                                <strong>

                                    <?= esc($user['full_name']) ?>

                                </strong>

                                <br>

                                <small class="text-muted">

                                    <?= esc($user['personal_email']) ?>

                                </small>

                            </td>

                            <td>

                                <?php

                                switch ($user['role_name']) {

                                    case 'Administrator':

                                        $badge = 'danger';

                                        break;

                                    case 'Petugas ULT':

                                        $badge = 'primary';

                                        break;

                                    case 'Unit Tujuan':

                                        $badge = 'warning';

                                        break;

                                    case 'Pimpinan':

                                        $badge = 'dark';

                                        break;

                                    default:

                                        $badge = 'success';
                                }

                                ?>

                                <span class="badge bg-<?= $badge ?>">

                                    <?= esc($user['role_name']) ?>

                                </span>

                            </td>

                            <td>

                                <?= esc($user['type_name'] ?? '-') ?>

                            </td>

                            <td>

                                <?= esc($user['personal_email']) ?>

                            </td>

                            <td>

                                <?= esc($user['phone']) ?>

                            </td>

                            <td>

                                <?php if ($user['is_active']) : ?>

                                    <span class="badge bg-success">

                                        Aktif

                                    </span>

                                <?php else : ?>

                                    <span class="badge bg-danger">

                                        Nonaktif

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td>

                                <div class="btn-group">

                                    <a

                                        href="<?= base_url('users/show/' . $user['id']) ?>"

                                        class="btn btn-info btn-sm">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <a

                                        href="<?= base_url('users/edit/' . $user['id']) ?>"

                                        class="btn btn-warning btn-sm">

                                        <i class="bi bi-pencil"></i>

                                    </a>

                                    <form

                                        action="<?= base_url('users/delete/' . $user['id']) ?>"

                                        method="post"

                                        class="d-inline">

                                        <?= csrf_field() ?>

                                        <button

                                            type="submit"

                                            onclick="return confirm('Yakin ingin menghapus user ini?')"

                                            class="btn btn-danger btn-sm">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<div class="mt-3">

    <?= $pager->links() ?>

</div>

<?= $this->endSection() ?>