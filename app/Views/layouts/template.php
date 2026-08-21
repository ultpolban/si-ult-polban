<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SI ULT POLBAN</title>

    <link rel="stylesheet"
        href="<?= base_url('assets/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">

    <link rel="stylesheet"
        href="<?= base_url('assets/adminlte/css/adminlte.min.css') ?>">

    <link rel="stylesheet"
        href="<?= base_url('assets/adminlte/css/style.css') ?>">
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