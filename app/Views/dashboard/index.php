<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard SI ULT POLBAN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <h2>Dashboard SI ULT POLBAN</h2>

    <hr>

    <div class="alert alert-success">

        Selamat datang <b><?= session()->get('name') ?></b>

        <br>

        Role : <?= session()->get('role_id') ?>

    </div>

    <div class="row">

        <!-- Manajemen Layanan -->
        <div class="col-md-3 mb-4">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>Manajemen Layanan</h5>

                    <p>Kelola seluruh layanan.</p>

                    <a href="<?= base_url('layanan') ?>" class="btn btn-primary">

                        Buka

                    </a>

                </div>

            </div>

        </div>

        <!-- Kategori -->
        <div class="col-md-3 mb-4">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>Kategori Layanan</h5>

                    <p>Kelola kategori layanan.</p>

                    <a href="<?= base_url('kategori') ?>" class="btn btn-success">

                        Buka

                    </a>

                </div>

            </div>

        </div>

        <!-- Unit Kerja -->
        <div class="col-md-3 mb-4">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>Unit Kerja</h5>

                    <p>Kelola Unit Kerja.</p>

                    <a href="<?= base_url('unit') ?>" class="btn btn-warning">

                        Buka

                    </a>

                </div>

            </div>

        </div>

        <!-- Logout -->
        <div class="col-md-3 mb-4">

            <div class="card shadow">

                <div class="card-body text-center">

                    <h5>Logout</h5>

                    <p>Keluar dari aplikasi.</p>

                    <a href="<?= base_url('logout') ?>" class="btn btn-danger">

                        Logout

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>