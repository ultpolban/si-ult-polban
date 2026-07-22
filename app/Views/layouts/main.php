<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= esc($title ?? 'SI ULT POLBAN') ?></title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #0d6efd;
            position: fixed;
            left: 0;
            top: 0;
            color: white;
        }

        .brand {
            font-size: 22px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, .2);
        }

        .sidebar a {
            color: white;
            display: block;
            text-decoration: none;
            padding: 14px 20px;
            transition: .2s;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, .2);
        }

        .content {
            margin-left: 250px;
            padding: 25px;
        }

        .navbar-custom {
            background: white;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .08);
        }

        .card {
            border: none;
        }

        .card-header {
            font-weight: 600;
        }

        .required {
            color: red;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        #photoPreview {
            max-width: 180px;
            margin-top: 10px;
        }
    </style>

</head>

<body>

    <div class="sidebar">

        <div class="brand">

            SI ULT POLBAN

        </div>

        <a href="<?= base_url('dashboard') ?>">

            <i class="bi bi-speedometer2"></i>

            Dashboard

        </a>

        <a href="<?= base_url('users') ?>">

            <i class="bi bi-people-fill"></i>

            Management User

        </a>

        <a href="<?= base_url('roles') ?>">

            <i class="bi bi-person-badge"></i>

            Role

        </a>

        <a href="<?= base_url('work-units') ?>">

            <i class="bi bi-building"></i>

            Unit Kerja

        </a>

        <a href="<?= base_url('departments') ?>">

            <i class="bi bi-diagram-3"></i>

            Jurusan

        </a>

        <a href="<?= base_url('study-programs') ?>">

            <i class="bi bi-book"></i>

            Program Studi

        </a>

        <hr>

        <a href="<?= base_url('logout') ?>">

            <i class="bi bi-box-arrow-right"></i>

            Logout

        </a>

    </div>

    <div class="content">

        <div class="navbar-custom d-flex justify-content-between align-items-center">

            <div>

                <h4 class="mb-0">

                    <?= esc($title ?? 'Dashboard') ?>

                </h4>

            </div>

            <div>

                <strong>

                    <?= esc(session()->get('full_name')) ?>

                </strong>

            </div>

        </div>

        <?= $this->renderSection('content') ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <?= $this->renderSection('script') ?>

</body>

</html>