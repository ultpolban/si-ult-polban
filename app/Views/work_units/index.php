<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-building-fill-gear text-primary"></i>

                Management Unit Kerja

            </h2>

            <p class="text-muted mb-0">

                Kelola seluruh Unit Kerja yang tersedia pada SI-ULT POLBAN.

            </p>

        </div>

        <a
            href="<?= base_url('work-units/create') ?>"
            class="btn btn-primary">

            <i class="bi bi-plus-circle-fill"></i>

            Tambah Unit Kerja

        </a>

    </div>

    <?php if (session()->getFlashdata('success')) : ?>

        <div class="alert alert-success alert-dismissible fade show shadow-sm">

            <i class="bi bi-check-circle-fill"></i>

            <?= session()->getFlashdata('success') ?>

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"></button>

        </div>

    <?php endif; ?>

    <div class="card border-0 shadow">

        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <h5 class="mb-0">

                    Daftar Unit Kerja

                </h5>

                <span class="badge bg-primary">

                    Total :
                    <?= count($units) ?>

                </span>

            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th width="60">No</th>

                            <th width="120">Kode</th>

                            <th>Unit Kerja</th>

                            <th>Deskripsi</th>

                            <th width="110">Status</th>

                            <th width="170" class="text-center">Aksi</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (empty($units)) : ?>

                            <tr>

                                <td colspan="6" class="text-center py-5">

                                    <i class="bi bi-building fs-1 text-secondary"></i>

                                    <h5 class="mt-3">

                                        Belum ada Unit Kerja

                                    </h5>

                                    <p class="text-muted mb-0">

                                        Silakan tambahkan Unit Kerja terlebih dahulu.

                                    </p>

                                </td>

                            </tr>

                        <?php else : ?>

                            <?php $no = 1; ?>

                            <?php foreach ($units as $unit) : ?>

                                <tr>

                                    <td>

                                        <span class="fw-bold">

                                            <?= $no++ ?>

                                        </span>

                                    </td>

                                    <td>

                                        <span class="badge bg-secondary">

                                            <?= esc($unit['unit_code']) ?>

                                        </span>

                                    </td>

                                    <td>

                                        <span class="fw-semibold">

                                            <?= esc($unit['unit_name']) ?>

                                        </span>

                                    </td>

                                    <td>

                                        <?= !empty($unit['description']) ? esc($unit['description']) : '<span class="text-muted">-</span>' ?>

                                    </td>

                                    <td>

                                        <?php if ($unit['status'] == 'Aktif') : ?>

                                            <span class="badge bg-success">

                                                Aktif

                                            </span>

                                        <?php else : ?>

                                            <span class="badge bg-danger">

                                                Tidak Aktif

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td class="text-center">

                                        <a
                                            href="<?= base_url('work-units/edit/' . $unit['id']) ?>"
                                            class="btn btn-warning btn-sm">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                        <a
                                            href="<?= base_url('work-units/delete/' . $unit['id']) ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus Unit Kerja ini?')">

                                            <i class="bi bi-trash-fill"></i>

                                        </a>

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