<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold text-dark mb-1">

            Management Program Studi

        </h2>

        <small class="text-muted">

            Kelola seluruh Program Studi SI-ULT POLBAN

        </small>

    </div>

    <a href="<?= base_url('study-programs/create') ?>"
        class="btn btn-primary">

        <i class="bi bi-plus-circle me-2"></i>

        Tambah Program Studi

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

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        placeholder="Cari Program Studi..."
                        value="<?= esc($keyword) ?>">

                </div>

                <div class="col-md-2 d-grid">

                    <button class="btn btn-primary">

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>

                    <tr>

                        <th>No</th>

                        <th>Jurusan</th>

                        <th>Jenjang</th>

                        <th>Program Studi</th>

                        <th>User</th>

                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    <?php
                    $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());
                    ?>

                    <?php foreach ($studyPrograms as $program): ?>

                        <tr>

                            <td><?= $no++ ?></td>

                            <td><?= esc($program['department_name']) ?></td>

                            <td>

                                <span class="badge bg-success">

                                    <?= esc($program['education_level']) ?>

                                </span>

                            </td>

                            <td>

                                <?= esc($program['program_name']) ?>

                            </td>

                            <td>

                                <span class="badge bg-info">

                                    <?= $program['total_user'] ?>

                                </span>

                            </td>

                            <td>

                                <a
                                    href="<?= base_url('study-programs/edit/' . $program['id']) ?>"
                                    class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <form
                                    action="<?= base_url('study-programs/delete/' . $program['id']) ?>"
                                    method="post"
                                    class="d-inline">

                                    <?= csrf_field() ?>

                                    <button
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus Program Studi ini?')">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

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