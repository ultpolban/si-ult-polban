<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- ===========================================================
HEADER
=========================================================== -->

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

    <div>

        <h2 class="fw-bold mb-1">

            Management User

        </h2>

        <p class="text-muted mb-0">

            Kelola seluruh data pengguna SI-ULT POLBAN.

        </p>

    </div>

    <a
        href="<?= base_url('users/create') ?>"
        class="btn btn-primary">

        <i class="bi bi-person-plus-fill me-2"></i>

        Tambah User

    </a>

</div>

<!-- ===========================================================
FLASH MESSAGE
=========================================================== -->

<?php if (session()->getFlashdata('success')) : ?>

    <div class="alert alert-success alert-dismissible fade show">

        <i class="bi bi-check-circle-fill me-2"></i>

        <?= session()->getFlashdata('success') ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

    </div>

<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>

    <div class="alert alert-danger alert-dismissible fade show">

        <i class="bi bi-exclamation-triangle-fill me-2"></i>

        <?= session()->getFlashdata('error') ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"></button>

    </div>

<?php endif; ?>

<!-- ===========================================================
STATISTIK USER
=========================================================== -->

<div class="row g-4 mb-4">

    <div class="col-xl-3 col-md-6">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <small class="text-muted">

                    Total User

                </small>

                <h2 class="fw-bold mt-2 mb-0">

                    <?= $totalUser ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <small class="text-muted">

                    User Aktif

                </small>

                <h2 class="fw-bold text-success mt-2 mb-0">

                    <?= $totalActive ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <small class="text-muted">

                    User Nonaktif

                </small>

                <h2 class="fw-bold text-danger mt-2 mb-0">

                    <?= $totalInactive ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-xl-3 col-md-6">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <small class="text-muted">

                    Mahasiswa

                </small>

                <h2 class="fw-bold text-primary mt-2 mb-0">

                    <?= $totalMahasiswa ?>

                </h2>

            </div>

        </div>

    </div>

</div>

<!-- ===========================================================
FILTER DATA USER
=========================================================== -->

<div class="card shadow-sm border-0 mb-4">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            <i class="bi bi-funnel-fill me-2"></i>

            Filter Data User

        </h5>

    </div>

    <div class="card-body">

        <form
            action="<?= current_url() ?>"
            method="get">

            <div class="row g-3">

                <!-- Kata Kunci -->

                <div class="col-lg-6">

                    <label class="form-label">

                        Kata Kunci

                    </label>

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        value="<?= esc($keyword) ?>"
                        placeholder="Cari nama, email, NIM, NIP atau NIDN">

                </div>

                <!-- Role -->

                <div class="col-lg-3">

                    <label class="form-label">

                        Role

                    </label>

                    <select
                        name="role"
                        class="form-select">

                        <option value="">

                            Semua Role

                        </option>

                        <?php foreach ($roles as $role): ?>

                            <option
                                value="<?= $role['id'] ?>"
                                <?= $selectedRole == $role['id'] ? 'selected' : '' ?>>

                                <?= esc($role['role_name'] ?? $role['name'] ?? '-') ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <!-- Jenis Pemohon -->

                <div class="col-lg-3">

                    <label class="form-label">

                        Jenis Pemohon

                    </label>

                    <select
                        name="type"
                        class="form-select">

                        <option value="">

                            Semua Jenis

                        </option>

                        <?php foreach ($userTypes as $type): ?>

                            <option
                                value="<?= $type['id'] ?>"
                                <?= $selectedType == $type['id'] ? 'selected' : '' ?>>

                                <?= esc($type['type_name'] ?? $type['name'] ?? '-') ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

            </div>

            <hr>

            <div class="d-flex justify-content-end gap-2">

                <a
                    href="<?= base_url('users') ?>"
                    class="btn btn-outline-secondary">

                    <i class="bi bi-arrow-clockwise me-2"></i>

                    Reset

                </a>

                <button
                    type="submit"
                    class="btn btn-primary">

                    <i class="bi bi-search me-2"></i>

                    Cari Data

                </button>

            </div>

        </form>

    </div>

</div>

<!-- ===========================================================
DAFTAR USER
=========================================================== -->

<div class="card table-card">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            <i class="bi bi-people-fill me-2"></i>

            Daftar User

        </h5>

        <span class="badge bg-primary">

            Total <?= $totalUser ?> User

        </span>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>

                    <tr>

                        <th width="60" class="text-center">No</th>

                        <th width="80" class="text-center">Foto</th>

                        <th>User</th>

                        <th>Role</th>

                        <th>Jenis</th>

                        <th>Email</th>

                        <th>No HP</th>

                        <th>Status</th>

                        <th width="170" class="text-center">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (empty($users)): ?>

                        <tr>

                            <td colspan="9" class="text-center py-5">

                                <i class="bi bi-people display-4 text-secondary"></i>

                                <br><br>

                                Belum ada data user.

                            </td>

                        </tr>

                    <?php endif; ?>

                    <?php

                    $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());

                    ?>

                    <?php foreach ($users as $user): ?>

                        <tr>

                            <td class="text-center fw-semibold">

                                <?= $no++ ?>

                            </td>

                            <td class="text-center">

                                <?php if (!empty($user['photo'])): ?>

                                    <img

                                        src="<?= base_url('uploads/users/' . $user['photo']) ?>"

                                        class="rounded-circle border"

                                        width="55"

                                        height="55"

                                        style="object-fit:cover;">

                                <?php else: ?>

                                    <i

                                        class="bi bi-person-circle text-secondary"

                                        style="font-size:50px;"></i>

                                <?php endif; ?>

                            </td>

                            <td>

                                <div class="fw-bold">

                                    <?= esc($user['full_name']) ?>

                                </div>

                                <small class="text-muted">

                                    <?php

                                    if (!empty($user['nim'])) {

                                        echo "NIM : " . $user['nim'];
                                    } elseif (!empty($user['nip'])) {

                                        echo "NIP : " . $user['nip'];
                                    } elseif (!empty($user['nidn'])) {

                                        echo "NIDN : " . $user['nidn'];
                                    } else {

                                        echo "-";
                                    }

                                    ?>

                                </small>

                            </td>

                            <!-- ==========================================
                    ROLE
                    =========================================== -->

                            <td>

                                <?php

                                $badgeRole = match ($user['role_name'] ?? $user['name'] ?? 'User') {

                                    'Administrator' => 'danger',

                                    'Petugas ULT' => 'primary',

                                    'Unit Tujuan' => 'warning',

                                    'Pimpinan' => 'dark',

                                    default => 'success'
                                };

                                ?>

                                <span class="badge bg-<?= $badgeRole ?>">

                                    <?= esc($user['role_name'] ?? $user['name'] ?? '-') ?>

                                </span>

                            </td>

                            <!-- ==========================================
                            JENIS PEMOHON
                            =========================================== -->

                            <td>

                                <span class="badge bg-info text-dark">

                                    <?= esc($user['type_name'] ?? '-') ?>

                                </span>

                            </td>

                            <!-- ==========================================
                            EMAIL
                            =========================================== -->

                            <td>

                                <small>

                                    <?= esc($user['personal_email']) ?>

                                </small>

                            </td>

                            <!-- ==========================================
                            NO HP
                            =========================================== -->

                            <td>

                                <?= esc($user['phone'] ?: '-') ?>

                            </td>

                            <!-- ==========================================
                            STATUS
                            =========================================== -->

                            <td class="text-center">

                                <?php if ($user['role_name'] == 'Administrator') : ?>

                                    <span class="badge bg-dark">

                                        Administrator

                                    </span>

                                <?php else : ?>

                                    <a
                                        href="<?= base_url('users/toggle/' . $user['id']) ?>"
                                        class="text-decoration-none"
                                        onclick="return confirm('Apakah Anda yakin ingin mengubah status user ini?')">

                                        <?php if ($user['is_active']) : ?>

                                            <span class="badge bg-success">

                                                <i class="bi bi-check-circle-fill me-1"></i>

                                                Aktif

                                            </span>

                                        <?php else : ?>

                                            <span class="badge bg-danger">

                                                <i class="bi bi-x-circle-fill me-1"></i>

                                                Nonaktif

                                            </span>

                                        <?php endif; ?>

                                    </a>

                                <?php endif; ?>

                            </td>

                            <!-- ==========================================
                            AKSI
                            =========================================== -->

                            <td class="text-center">

                                <div class="btn-group" role="group">

                                    <a
                                        href="<?= base_url('users/show/' . $user['id']) ?>"
                                        class="btn btn-info btn-sm"
                                        title="Detail">

                                        <i class="bi bi-eye-fill"></i>

                                    </a>

                                    <a
                                        href="<?= base_url('users/edit/' . $user['id']) ?>"
                                        class="btn btn-warning btn-sm"
                                        title="Edit">

                                        <i class="bi bi-pencil-fill"></i>

                                    </a>

                                    <?php if (($user['role_code'] ?? '') !== 'SUPER_ADMIN') : ?>

                                        <form
                                            action="<?= base_url('users/delete/' . $user['id']) ?>"
                                            method="post"
                                            class="d-inline">

                                            <?= csrf_field() ?>

                                            <button
                                                type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin ingin menghapus user ini?')">

                                                <i class="bi bi-trash-fill"></i>

                                            </button>

                                        </form>

                                    <?php else : ?>

                                        <button
                                            class="btn btn-secondary btn-sm"
                                            disabled
                                            title="Super Administrator tidak dapat dihapus">

                                            <i class="bi bi-lock-fill"></i>

                                        </button>

                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- ===========================================================
PAGINATION
=========================================================== -->

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mt-4">

    <div class="text-muted">

        Menampilkan

        <strong><?= count($users) ?></strong>

        data dari

        <strong><?= $totalUser ?></strong>

        user.

    </div>

    <div>

        <?= $pager->links() ?>

    </div>

</div>

<?= $this->endSection() ?>
