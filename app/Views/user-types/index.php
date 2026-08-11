<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h2 class="fw-bold text-dark mb-1">

            Management Jenis Pemohon

        </h2>

        <small class="text-muted">

            Kelola seluruh jenis pemohon pada SI-ULT POLBAN

        </small>

    </div>

    <a
        href="<?= base_url('user-types/create') ?>"
        class="btn btn-primary">

        <i class="bi bi-plus-circle me-2"></i>

        Tambah Jenis Pemohon

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



<div class="card mb-4">

    <div class="card-header">

        <i class="bi bi-search me-2"></i>

        Pencarian

    </div>

    <div class="card-body">

        <form
            action="<?= current_url() ?>"
            method="get">

            <div class="row g-3 align-items-end">

                <div class="col-md-10">

                    <label class="form-label fw-semibold">

                        Kata Kunci

                    </label>

                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        value="<?= esc($keyword) ?>"
                        placeholder="Cari nama jenis pemohon...">

                </div>

                <div class="col-md-2 d-grid">

                    <button
                        class="btn btn-primary"
                        type="submit">

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

            <i class="bi bi-people me-2"></i>

            Daftar Jenis Pemohon

        </h5>

        <span class="badge bg-warning text-dark">

            <?= $totalType ?> Data

        </span>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover table-bordered align-middle mb-0">

                <thead>

                    <tr>

                        <th width="60">No</th>

                        <th>Jenis Pemohon</th>

                        <th>Deskripsi</th>

                        <th width="130" class="text-center">

                            Jumlah User

                        </th>

                        <th width="150" class="text-center">

                            Aksi

                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (empty($types)) : ?>

                        <tr>

                            <td colspan="5" class="text-center py-5">

                                <i class="bi bi-database-fill-x display-5 text-secondary"></i>

                                <p class="mt-3 mb-0">

                                    Belum ada data.

                                </p>

                            </td>

                        </tr>

                    <?php endif; ?>

                    <?php

                    $no = 1 + (($pager->getCurrentPage() - 1) * $pager->getPerPage());

                    ?>

                    <?php foreach ($types as $type) : ?>

                        <tr>

                            <td>

                                <?= $no++ ?>

                            </td>

                            <td>

                                <strong>

                                    <?= esc($type['type_name']) ?>

                                </strong>

                            </td>

                            <td>

                                <?= esc($type['description']) ?>

                            </td>

                            <td class="text-center">

                                <span class="badge bg-info">

                                    <?= $type['total_user'] ?>

                                </span>

                            </td>

                            <td>

                                <div class="d-flex justify-content-center gap-1">

                                    <a
                                        href="<?= base_url('user-types/edit/' . $type['id']) ?>"
                                        class="btn btn-warning btn-sm">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                    <form
                                        action="<?= base_url('user-types/delete/' . $type['id']) ?>"
                                        method="post">

                                        <?= csrf_field() ?>

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus data ini?')">

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

        Menampilkan <?= count($types) ?> data

    </small>

    <?= $pager->links() ?>

</div>

<?= $this->endSection() ?>