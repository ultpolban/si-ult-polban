<?= $this->include('layouts/header') ?>

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