<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold text-dark mb-1">

            Management Jurusan

        </h2>

        <small class="text-muted">

            Kelola seluruh jurusan di SI-ULT POLBAN

        </small>

    </div>

    <a href="<?= base_url('departments/create') ?>"
        class="btn btn-primary">

        <i class="bi bi-plus-circle me-2"></i>

        Tambah Jurusan

    </a>

</div>

<?php if (session()->getFlashdata('success')) : ?>

    <div class="alert alert-success alert-dismissible fade show">

        <?= session()->getFlashdata('success') ?>

        <button class="btn-close" data-bs-dismiss="alert"></button>

    </div>

<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>

    <div class="alert alert-danger alert-dismissible fade show">

        <?= session()->getFlashdata('error') ?>

        <button class="btn-close" data-bs-dismiss="alert"></button>

    </div>

<?php endif; ?>



<div class="card mb-4">

    <div class="card-header">

        <i class="bi bi-search me-2"></i>

        Pencarian

    </div>

    <div class="card-body">

        <form method="get">

            <div class="row">

                <div class="col-md-10">

                    <label class="form-label">

                        Kata Kunci

                    </label>

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari kode atau nama jurusan..."
                        value="<?= esc($keyword) ?>">

                </div>

                <div class="col-md-2 d-grid">

                    <button
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

    <div class="card-header d-flex justify-content-between">

        <h5 class="mb-0">

            <i class="bi bi-building me-2"></i>

            Daftar Jurusan

        </h5>

        <span class="badge bg-warning text-dark">

            <?= $totalDepartment ?> Data

        </span>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-bordered align-middle mb-0">

                <thead>

                    <tr>

                        <th width="60">No</th>

                        <th width="120">Kode</th>

                        <th>Nama Jurusan</th>

                        <th width="150">Program Studi</th>

                        <th width="120">User</th>

                        <th width="150">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (empty($departments)) : ?>

                        <tr>

                            <td colspan="6" class="text-center py-5">

                                <i class="bi bi-database-fill-x display-4 text-secondary"></i>

                                <p class="mt-3 mb-0">

                                    Tidak ada data.

                                </p>

                            </td>

                        </tr>

                    <?php endif; ?>

                    <?php

                    $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());

                    ?>

                    <?php foreach ($departments as $department) : ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td>

                                <span class="badge bg-primary">

                                    <?= esc($department['department_code']) ?>

                                </span>

                            </td>

                            <td>

                                <strong>

                                    <?= esc($department['department_name']) ?>

                                </strong>

                            </td>

                            <td class="text-center">

                                <span class="badge bg-success">

                                    <?= $department['total_prodi'] ?>

                                </span>

                            </td>

                            <td class="text-center">

                                <span class="badge bg-info">

                                    <?= $department['total_user'] ?>

                                </span>

                            </td>

                            <td>

                                <div class="d-flex justify-content-center gap-1">

                                    <a href="<?= base_url('departments/edit/' . $department['id']) ?>"
                                        class="btn btn-warning btn-sm">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                    <form
                                        action="<?= base_url('departments/delete/' . $department['id']) ?>"
                                        method="post">

                                        <?= csrf_field() ?>

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus jurusan ini?')">

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

<div class="d-flex justify-content-between align-items-center mt-4">

    <small class="text-white-50">

        Menampilkan <?= count($departments) ?> data

    </small>

    <?= $pager->links() ?>

</div>

<?= $this->endSection() ?>