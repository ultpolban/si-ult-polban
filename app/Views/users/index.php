<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">

    <!-- Header -->

    <div class="row mb-4">

        <div class="col-lg-8">

            <h2 class="fw-bold mb-1">

                <i class="bi bi-people-fill text-primary"></i>

                Management User

            </h2>

            <p class="text-muted mb-0">

                Kelola seluruh data pengguna SI-ULT POLBAN

            </p>

        </div>

        <div class="col-lg-4 text-end">

            <a href="<?= base_url('users/create') ?>"
                class="btn btn-primary shadow">

                <i class="bi bi-plus-circle-fill me-2"></i>

                Tambah User

            </a>

        </div>

    </div>

    <!-- Flash Message -->

    <?php if (session()->getFlashdata('success')) : ?>

        <div class="alert alert-success alert-dismissible fade show shadow-sm">

            <i class="bi bi-check-circle-fill me-2"></i>

            <?= session()->getFlashdata('success') ?>

            <button
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    <?php if (session()->getFlashdata('error')) : ?>

        <div class="alert alert-danger alert-dismissible fade show shadow-sm">

            <i class="bi bi-exclamation-circle-fill me-2"></i>

            <?= session()->getFlashdata('error') ?>

            <button
                class="btn-close"
                data-bs-dismiss="alert">
            </button>

        </div>

    <?php endif; ?>


    <!-- Statistik -->

    <div class="row mb-4">

        <div class="col-md-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <small class="text-muted">

                                Total User

                            </small>

                            <h2 class="fw-bold mb-0">

                                <?= $pager->getTotal() ?>

                            </h2>

                        </div>

                        <i class="bi bi-people-fill text-primary"
                            style="font-size:45px;"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Card -->

    <div class="card border-0 shadow">

        <div class="card-body">

            <!-- Search -->

            <form method="GET"
                action="<?= base_url('users') ?>">

                <div class="row g-2 mb-4">

                    <div class="col-lg-8">

                        <div class="input-group">

                            <span class="input-group-text bg-white">

                                <i class="bi bi-search"></i>

                            </span>

                            <input
                                type="text"
                                name="keyword"
                                class="form-control"
                                placeholder="Cari nama, email, atau nomor HP..."
                                value="<?= esc($keyword) ?>">

                        </div>

                    </div>

                    <div class="col-lg-2">

                        <button
                            class="btn btn-primary w-100">

                            <i class="bi bi-search"></i>

                            Cari

                        </button>

                    </div>

                    <div class="col-lg-2">

                        <a href="<?= base_url('users') ?>"
                            class="btn btn-outline-secondary w-100">

                            <i class="bi bi-arrow-clockwise"></i>

                            Reset

                        </a>

                    </div>

                </div>

            </form>

            <div class="table-responsive">

                <table class="table table-hover align-middle">

                    <thead class="table-light">

                        <tr>

                            <th width="60">No</th>

                            <th>Pengguna</th>

                            <th>Role</th>

                            <th>Unit Kerja</th>

                            <th>Email</th>

                            <th>No HP</th>

                            <th>Status</th>

                            <th width="220" class="text-center">

                                Aksi

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php if (empty($users)) : ?>

                            <tr>

                                <td colspan="8" class="text-center py-5">

                                    <div class="my-4">

                                        <i class="bi bi-database-x text-secondary"
                                            style="font-size:70px;"></i>

                                        <h5 class="mt-3 text-secondary">

                                            Data User Tidak Ditemukan

                                        </h5>

                                        <p class="text-muted">

                                            Silakan tambahkan user baru atau ubah kata kunci pencarian.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        <?php else : ?>

                            <?php

                            $no = 1 + (10 * ($pager->getCurrentPage() - 1));

                            ?>

                            <?php foreach ($users as $user) : ?>

                                <tr>

                                    <!-- Nomor -->

                                    <td class="fw-bold text-center">

                                        <?= $no++ ?>

                                    </td>

                                    <!-- User -->

                                    <td>

                                        <div class="d-flex align-items-center">

                                            <!-- Avatar -->

                                            <?php if (!empty($user['photo'])) : ?>

                                                <img
                                                    src="<?= base_url('uploads/users/' . $user['photo']) ?>"
                                                    class="rounded-circle border shadow-sm me-3"
                                                    width="50"
                                                    height="50"
                                                    style="object-fit:cover;">

                                            <?php else : ?>

                                                <div
                                                    class="rounded-circle bg-primary text-white
                           d-flex justify-content-center
                           align-items-center me-3 shadow-sm"
                                                    style="width:50px;height:50px;">

                                                    <i class="bi bi-person-fill fs-4"></i>

                                                </div>

                                            <?php endif; ?>

                                            <div>

                                                <div class="fw-semibold">

                                                    <?= esc($user['full_name']) ?>

                                                </div>

                                                <small class="text-muted">

                                                    ID :
                                                    <?= $user['id'] ?>

                                                </small>

                                            </div>

                                        </div>

                                    </td>

                                    <!-- Role -->

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

                                                break;
                                        }

                                        ?>

                                        <span class="badge bg-<?= $badge ?> px-3 py-2">

                                            <?= esc($user['role_name']) ?>

                                        </span>

                                    </td>

                                    <!-- Unit -->

                                    <td>

                                        <?= esc($user['unit_name'] ?? '-') ?>

                                    </td>

                                    <!-- Email -->

                                    <td>

                                        <div class="small">

                                            <?= esc($user['personal_email']) ?>

                                        </div>

                                    </td>

                                    <!-- HP -->

                                    <td>

                                        <?= esc($user['phone']) ?>

                                    </td>

                                    <!-- Status -->

                                    <td>

                                        <?php if ($user['is_active']) : ?>

                                            <span class="badge rounded-pill bg-success px-3 py-2">

                                                <i class="bi bi-check-circle-fill"></i>

                                                Aktif

                                            </span>

                                        <?php else : ?>

                                            <span class="badge rounded-pill bg-danger px-3 py-2">

                                                <i class="bi bi-x-circle-fill"></i>

                                                Non Aktif

                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <!-- Tombol -->

                                    <td class="text-center">

                                        <!-- Detail -->

                                        <a
                                            href="<?= base_url('users/show/' . $user['id']) ?>"
                                            class="btn btn-outline-info btn-sm"
                                            data-bs-toggle="tooltip"
                                            title="Detail">

                                            <i class="bi bi-eye-fill"></i>

                                        </a>

                                        <!-- Edit -->

                                        <a
                                            href="<?= base_url('users/edit/' . $user['id']) ?>"
                                            class="btn btn-outline-warning btn-sm"
                                            data-bs-toggle="tooltip"
                                            title="Edit">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                        <!-- Aktif / Nonaktif -->

                                        <?php if ($user['is_active']) : ?>

                                            <a
                                                href="<?= base_url('users/toggle/' . $user['id']) ?>"
                                                class="btn btn-outline-secondary btn-sm"
                                                onclick="return confirm('Nonaktifkan user ini?')"
                                                data-bs-toggle="tooltip"
                                                title="Nonaktifkan">

                                                <i class="bi bi-person-x-fill"></i>

                                            </a>

                                        <?php else : ?>

                                            <a
                                                href="<?= base_url('users/toggle/' . $user['id']) ?>"
                                                class="btn btn-outline-success btn-sm"
                                                onclick="return confirm('Aktifkan user ini?')"
                                                data-bs-toggle="tooltip"
                                                title="Aktifkan">

                                                <i class="bi bi-person-check-fill"></i>

                                            </a>

                                        <?php endif; ?>

                                        <!-- Hapus -->

                                        <a
                                            href="<?= base_url('users/delete/' . $user['id']) ?>"
                                            class="btn btn-outline-danger btn-sm"
                                            onclick="return confirm('Yakin ingin menghapus user ini?')"
                                            data-bs-toggle="tooltip"
                                            title="Hapus">

                                            <i class="bi bi-trash-fill"></i>

                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

            <hr>

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div class="text-muted small">

                    Menampilkan

                    <strong><?= count($users) ?></strong>

                    data

                    |

                    Halaman

                    <strong><?= $pager->getCurrentPage() ?></strong>

                    dari

                    <strong><?= $pager->getPageCount() ?></strong>

                </div>

                <div>

                    <?= $pager->links() ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>