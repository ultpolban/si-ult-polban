<?= $this->include('layouts/header') ?>

<head>
    <meta charset="utf-8">

    <title>ULT POLBAN</title>

    <link rel="stylesheet" href="<?= base_url('plugins/fontawesome-free/css/all.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('dist/css/adminlte.min.css') ?>">

  <link rel="stylesheet" href="<?= base_url('assets/adminlte/css/ult-theme.css') ?>">
</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">

        <?= $this->include('layouts/navbar') ?>

        <?= $this->include('layouts/sidebar') ?>

        <div class="content-wrapper">

            <section class="content">

                <div class="container-fluid pt-3">

                    <?= $this->renderSection('content') ?>

                </div>

            </section>

        </div>

        <?= $this->include('layouts/footer') ?>