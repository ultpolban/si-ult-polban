<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h2 class="fw-bold mb-4">

    Dashboard Administrator

</h2>

<div class="row g-4">

    <div class="col-lg-3">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card dashboard-card bg-user position-relative">

                <div class="card-body">

                    <i class="bi bi-people-fill"></i>

                    <small>Total User</small>

                    <h2><?= $totalUser ?></h2>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card dashboard-card bg-role position-relative">

                <div class="card-body">

                    <i class="bi bi-person-badge-fill"></i>

                    <small>Role</small>

                    <h2><?= $totalRole ?></h2>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card dashboard-card bg-type position-relative">

                <div class="card-body">

                    <i class="bi bi-person-lines-fill"></i>

                    <small>Jenis Pemohon</small>

                    <h2><?= $totalUserType ?></h2>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card dashboard-card bg-department position-relative">

                <div class="card-body">

                    <i class="bi bi-diagram-3-fill"></i>

                    <small>Jurusan</small>

                    <h2><?= $totalDepartment ?></h2>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card dashboard-card bg-study position-relative">

                <div class="card-body">

                    <i class="bi bi-mortarboard-fill"></i>

                    <small>Program Studi</small>

                    <h2><?= $totalStudyProgram ?></h2>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card dashboard-card bg-unit position-relative">

                <div class="card-body">

                    <i class="bi bi-building-fill"></i>

                    <small>Unit Kerja</small>

                    <h2><?= $totalWorkUnit ?></h2>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card dashboard-card bg-active position-relative">

                <div class="card-body">

                    <i class="bi bi-check-circle-fill"></i>

                    <small>User Aktif</small>

                    <h2><?= $totalActive ?></h2>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-3">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card dashboard-card bg-inactive position-relative">

                <div class="card-body">

                    <i class="bi bi-x-circle-fill"></i>

                    <small>User Nonaktif</small>

                    <h2><?= $totalInactive ?></h2>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card mt-4">

    <div class="card-header">

        User Terbaru

    </div>

    <div class="card-body p-0">

        <table class="table mb-0">

            <thead>

                <tr>

                    <th>Nama</th>

                    <th>Email</th>

                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($latestUsers as $user): ?>

                    <tr>

                        <td><?= esc($user['full_name']) ?></td>

                        <td><?= esc($user['personal_email']) ?></td>

                        <td>

                            <?php if ($user['is_active']): ?>

                                <span class="badge bg-success">

                                    Aktif

                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">

                                    Nonaktif

                                </span>

                            <?php endif; ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>
