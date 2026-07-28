<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold text-white mb-1">

            Management Role

        </h2>

        <small class="text-white-50">

            Kelola seluruh role pengguna SI-ULT POLBAN

        </small>

    </div>

    <a
        href="<?= base_url('roles/create') ?>"
        class="btn btn-primary">

        <i class="bi bi-plus-circle me-2"></i>

        Tambah Role

    </a>

</div>

<?php if (session()->getFlashdata('success')) : ?>

    <div class="alert alert-success alert-dismissible fade show">

        <?= session()->getFlashdata('success') ?>

        <button
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>

    <div class="alert alert-danger alert-dismissible fade show">

        <?= session()->getFlashdata('error') ?>

        <button
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

<?php endif; ?>

<div class="row mb-4">

    <div class="col-md-3">

        <div class="card stat-card">

            <div class="card-body">

                <h6 class="text-uppercase text-white-50">

                    Total Role

                </h6>

                <h2 class="fw-bold text-warning">

                    <?= $totalRole ?>

                </h2>

            </div>

        </div>

    </div>

</div>

<div class="card mb-4">

    <div class="card-header">

        <i class="bi bi-search me-2"></i>

        Pencarian Role

    </div>

    <div class="card-body">

        <form
            method="get"
            action="<?= current_url() ?>">

            <div class="row g-3 align-items-end">

                <div class="col-md-10">

                    <label class="form-label fw-semibold">

                        Kata Kunci

                    </label>

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari nama role atau deskripsi..."
                        value="<?= esc($keyword) ?>">

                </div>

                <div class="col-md-2 d-grid">

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-search me-2"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="mb-0">

            <i class="bi bi-shield-lock me-2"></i>

            Daftar Role

        </h5>

        <span class="badge bg-warning text-dark">

            Total : <?= $totalRole ?>

        </span>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-bordered align-middle mb-0">

                <thead>

                    <tr>

                        <th width="60">No</th>

                        <th>Nama Role</th>

                        <th>Deskripsi</th>

                        <th width="120" class="text-center">

                            Jumlah User

                        </th>

                        <th width="160" class="text-center">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (empty($roles)) : ?>

                        <tr>

                            <td colspan="5" class="text-center py-5">

                                <i class="bi bi-database-fill-x display-5 text-secondary"></i>

                                <p class="mt-3 mb-0">

                                    Belum ada data role.

                                </p>

                            </td>

                        </tr>

                    <?php endif; ?>

                    <?php

                    $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());

                    ?>

                    <?php foreach ($roles as $role) : ?>

                        <tr>

                            <td>

                                <?= $no++ ?>

                            </td>

                            <td>

                                <strong>

                                    <?= esc($role['role_name']) ?>

                                </strong>

                            </td>

                            <td>

                                <?= esc($role['description']) ?>

                            </td>

                            <td class="text-center">

                                <span class="badge bg-info">

                                    <?= $role['total_user'] ?>

                                </span>

                            </td>

                            <td>

                                <div class="d-flex justify-content-center gap-1">

                                    <a
                                        href="<?= base_url('roles/edit/' . $role['id']) ?>"
                                        class="btn btn-warning btn-sm">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                    <?php if ($role['id'] != 1) : ?>

                                        <form
                                            action="<?= base_url('roles/delete/' . $role['id']) ?>"
                                            method="post">

                                            <?= csrf_field() ?>

                                            <button
                                                type="submit"
                                                onclick="return confirm('Yakin ingin menghapus role ini?')"
                                                class="btn btn-danger btn-sm">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    <?php else : ?>

                                        <button
                                            class="btn btn-secondary btn-sm"
                                            disabled>

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

<div class="d-flex justify-content-between align-items-center mt-4">

    <small class="text-white-50">

        Menampilkan <?= count($roles) ?> data

    </small>

    <?= $pager->links() ?>

</div>

<?= $this->endSection() ?>