<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

    <div>

        <h2 class="fw-bold mb-1">

            Management Kelas

        </h2>

        <p class="text-muted mb-0">

            Kelola seluruh data kelas SI-ULT POLBAN.

        </p>

    </div>

    <a href="<?= base_url('classes/create') ?>" class="btn btn-primary">

        <i class="bi bi-plus-circle-fill me-2"></i>

        Tambah Kelas

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

<div class="row g-4 mb-4">

    <div class="col-lg-4">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <small class="text-muted">

                    Total Kelas

                </small>

                <h2 class="fw-bold mt-2">

                    <?= $totalClass ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <small class="text-muted">

                    Kelas Aktif

                </small>

                <h2 class="fw-bold text-success mt-2">

                    <?= $activeClass ?>

                </h2>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card shadow-sm border-0">

            <div class="card-body">

                <small class="text-muted">

                    Kelas Nonaktif

                </small>

                <h2 class="fw-bold text-danger mt-2">

                    <?= $inactiveClass ?>

                </h2>

            </div>

        </div>

    </div>

</div>

<div class="card shadow-sm border-0 mb-4">

    <div class="card-body">

        <form method="get">

            <div class="row">

                <div class="col-md-10">

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari kelas atau program studi..."
                        value="<?= esc($keyword) ?>">

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100">

                        <i class="bi bi-search"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="card-header bg-white">

        <h5 class="mb-0">

            Daftar Kelas

        </h5>

    </div>

    <div class="table-responsive">

        <table class="table table-hover align-middle mb-0">

            <thead class="table-light">

                <tr>

                    <th width="60">No</th>

                    <th>Program Studi</th>

                    <th>Kelas</th>

                    <th>Status</th>

                    <th width="170" class="text-center">

                        Aksi

                    </th>

                </tr>

            </thead>

            <tbody>

                <?php if (empty($classes)) : ?>

                    <tr>

                        <td colspan="5" class="text-center py-5">

                            Belum ada data kelas.

                        </td>

                    </tr>

                <?php endif; ?>

                <?php

                $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());

                ?>

                <?php foreach ($classes as $class) : ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td>

                            <?= esc($class['education_level'] ?? $class['degree'] ?? '-') ?>

                            -

                            <?= esc($class['program_name']) ?>

                        </td>

                        <td>

                            <strong>

                                <?= esc($class['class_name'] ?? $class['name'] ?? '-') ?>

                            </strong>

                        </td>

                        <td>

                            <?php if (($class['status'] ?? $class['is_active'] ?? 0)) : ?>

                                <span class="badge bg-success">

                                    Aktif

                                </span>

                            <?php else : ?>

                                <span class="badge bg-danger">

                                    Nonaktif

                                </span>

                            <?php endif; ?>

                        </td>

                        <td class="text-center">

                            <div class="btn-group">

                                <a
                                    href="<?= base_url('classes/show/' . $class['id']) ?>"
                                    class="btn btn-info btn-sm">

                                    <i class="bi bi-eye-fill"></i>

                                </a>

                                <a
                                    href="<?= base_url('classes/edit/' . $class['id']) ?>"
                                    class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil-fill"></i>

                                </a>

                                <form
                                    action="<?= base_url('classes/delete/' . $class['id']) ?>"
                                    method="post">

                                    <?= csrf_field() ?>

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus kelas ini?')">

                                        <i class="bi bi-trash-fill"></i>

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

<div class="mt-4">

    <?= $pager->links() ?>

</div>

<?= $this->endSection() ?>