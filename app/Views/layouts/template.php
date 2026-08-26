<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SI ULT POLBAN</title>

    <!-- CSS Plugins -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/adminlte.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/style.css') ?>">

    <style>
        /* Modern Background Sidebar Warna Solid Sesuai Foto (#2b3990) */
        .main-sidebar {
            background: #2b3990 !important;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            transition: width 0.3s ease-in-out, margin-left 0.3s ease-in-out !important;
        }

        /* Nav Link Base Style */
        .nav-sidebar .nav-item .nav-link {
            border-radius: 12px !important;
            transition: all 0.2s ease;
            color: rgba(255, 255, 255, 0.85);
            padding: 10px 14px;
            margin-bottom: 4px;
        }

        /* Warna Menu Aktif: Oranye Elegan */
        .nav-sidebar .nav-item .nav-link.active {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(245, 158, 11, 0.4);
            font-weight: 700;
        }

        /* Fix Posisi Ikon Supaya Presisi di Tengah Saat Sidebar Ditutup */
        body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-link {
            text-align: center;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        body.sidebar-collapse .main-sidebar:not(:hover) .nav-sidebar .nav-link .nav-icon {
            margin-right: 0 !important;
            font-size: 1.2rem;
            width: 100% !important;
        }

        body.sidebar-collapse .main-sidebar:not(:hover) .user-panel {
            padding-left: 0 !important;
            padding-right: 0 !important;
            justify-content: center !important;
        }

        body.sidebar-collapse .main-sidebar:not(:hover) .user-panel .image {
            margin: 0 auto !important;
            float: none !important;
        }

        body.sidebar-collapse .main-sidebar:not(:hover) .brand-link {
            text-align: center !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        body.sidebar-collapse .main-sidebar:not(:hover) .brand-link .brand-image {
            margin: 0 auto !important;
            float: none !important;
        }

        /* Sembunyikan Header Kategori Saat Ditutup */
        body.sidebar-collapse .main-sidebar:not(:hover) .nav-header {
            display: none !important;
        }
    </style>
    <link rel="icon" type="image/png" href="<?= base_url('assets/img/logo-polban.png'); ?>">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">

    <?= view('layouts/navbar') ?>
    <?= view('layouts/sidebar') ?>

    <div class="content-wrapper">
        <section class="content pt-3">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </section>
    </div>

</div>

<!-- JavaScript Dependencies -->
<script src="<?= base_url('assets/adminlte/plugins/jquery/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/adminlte/js/adminlte.min.js') ?>"></script>
<script src="<?= base_url('assets/js/dummy-notif.js') ?>"></script>

</body>
</html>