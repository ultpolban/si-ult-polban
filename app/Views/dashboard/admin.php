<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="row mb-4">

        <div class="col-lg-12">

            <div class="card shadow border-0">

                <div class="card-body">

                    <h2 class="fw-bold text-primary">
                        Dashboard SI ULT POLBAN
                    </h2>

                    <p class="text-muted mb-0">
                        Selamat Datang,
                        <strong><?= session('full_name') ?? 'Administrator' ?></strong>
                    </p>

                    <small class="text-secondary">
                        Sistem Informasi Unit Layanan Terpadu
                        Politeknik Negeri Bandung
                    </small>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-3 mb-3">

            <div class="card shadow border-start border-primary border-4">

                <div class="card-body">

                    <h5>Total User</h5>

                    <h1 class="fw-bold text-primary">
                        <?= $totalUsers ?>
                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card shadow border-start border-success border-4">

                <div class="card-body">

                    <h5>Jurusan</h5>

                    <h1 class="fw-bold text-success">
                        <?= $totalDepartments ?>
                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card shadow border-start border-warning border-4">

                <div class="card-body">

                    <h5>Program Studi</h5>

                    <h1 class="fw-bold text-warning">
                        <?= $totalPrograms ?>
                    </h1>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-3">

            <div class="card shadow border-start border-danger border-4">

                <div class="card-body">

                    <h5>Unit Kerja</h5>

                    <h1 class="fw-bold text-danger">
                        <?= $totalUnits ?>
                    </h1>

                </div>

            </div>

        </div>

    </div>

    <div class="row mt-3">

        <div class="col-lg-8">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">

                    Master Data

                </div>

                <div class="card-body">

                    <div class="list-group">

                        <a href="<?= base_url('users') ?>"
                            class="list-group-item list-group-item-action">

                            👤 Management User

                        </a>

                        <a href="<?= base_url('roles') ?>"
                            class="list-group-item list-group-item-action">

                            🔐 Management Role

                        </a>

                        <a href="<?= base_url('departments') ?>"
                            class="list-group-item list-group-item-action">

                            🏢 Jurusan

                        </a>

                        <a href="<?= base_url('study-programs') ?>"
                            class="list-group-item list-group-item-action">

                            🎓 Program Studi

                        </a>

                        <a href="<?= base_url('work-units') ?>"
                            class="list-group-item list-group-item-action">

                            🏛 Unit Kerja

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="card shadow">

                <div class="card-header bg-success text-white">

                    Informasi

                </div>

                <div class="card-body">

                    <table class="table">

                        <tr>

                            <th>Sistem</th>

                            <td>SI ULT POLBAN</td>

                        </tr>

                        <tr>

                            <th>Versi</th>

                            <td>1.0</td>

                        </tr>

                        <tr>

                            <th>Framework</th>

                            <td>CodeIgniter 4</td>

                        </tr>

                        <tr>

                            <th>Database</th>

                            <td>MySQL</td>

                        </tr>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>