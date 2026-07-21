<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- Header -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="fw-bold mb-1">

                <i class="bi bi-shield-lock-fill text-primary"></i>

                Management Role

            </h2>

            <p class="text-muted mb-0">

                Kelola seluruh role pengguna SI-ULT POLBAN

            </p>

        </div>

        <a
            href="<?= base_url('roles/create') ?>"
            class="btn btn-primary">

            <i class="bi bi-plus-circle-fill"></i>

            Tambah Role

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


    <!-- Card -->

    <div class="card border-0 shadow">

        <div class="card-body">


            <div class="d-flex justify-content-between align-items-center mb-4">

                <h5 class="mb-0">

                    Daftar Role

                </h5>

                <span class="badge bg-primary">

                    Total :
                    <?= count($roles) ?>

                </span>

            </div>


            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th width="70">

                                No

                            </th>

                            <th>

                                Nama Role

                            </th>

                            <th>

                                Deskripsi

                            </th>

                            <th width="160" class="text-center">

                                Aksi

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (empty($roles)) : ?>

                            <tr>

                                <td colspan="4" class="text-center py-5">

                                    <i class="bi bi-database-fill-x fs-1 text-secondary"></i>

                                    <h5 class="mt-3">

                                        Belum ada data role

                                    </h5>

                                    <p class="text-muted mb-0">

                                        Silakan tambahkan role terlebih dahulu.

                                    </p>

                                </td>

                            </tr>

                        <?php else : ?>

                            <?php $no = 1; ?>

                            <?php foreach ($roles as $role) : ?>

                                <tr>

                                    <td>

                                        <span class="fw-bold">

                                            <?= $no++ ?>

                                        </span>

                                    </td>

                                    <td>

                                        <span class="fw-semibold">

                                            <?= esc($role['role_name']) ?>

                                        </span>

                                    </td>

                                    <td>

                                        <?php if (!empty($role['description'])) : ?>

                                            <?= esc($role['description']) ?>

                                        <?php else : ?>

                                            <span class="text-muted">

                                                -

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td class="text-center">

                                        <a
                                            href="<?= base_url('roles/edit/' . $role['id']) ?>"
                                            class="btn btn-warning btn-sm">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                        <a
                                            href="<?= base_url('roles/delete/' . $role['id']) ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus role ini?')">

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