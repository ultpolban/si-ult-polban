<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="dashboard-title mb-1">
            Dashboard Kemahasiswaan
        </h2>

        <p class="dashboard-subtitle">
            Selamat datang,
            <strong><?= esc(session()->get('name') ?? 'Petugas') ?></strong>
            👋
        </p>
    </div>

    <div class="text-end">
        <span class="badge bg-primary px-3 py-2">
            <i class="fas fa-calendar-alt me-1"></i>
            <?= date('d M Y') ?>
        </span>
    </div>

</div>


<!-- STATISTIK -->

<div class="row g-4 mb-4">

    <div class="col-lg-3 col-md-6">

        <div class="stat-card bg-primary">

            <h2><?= $total ?? 0 ?></h2>

            <p>Total Tiket</p>

            <i class="fas fa-ticket-alt"></i>

        </div>

    </div>


    <div class="col-lg-3 col-md-6">

        <div class="stat-card bg-warning">

            <h2><?= $menunggu ?? 0 ?></h2>

            <p>Menunggu</p>

            <i class="fas fa-hourglass-half"></i>

        </div>

    </div>


    <div class="col-lg-3 col-md-6">

        <div class="stat-card bg-info">

            <h2><?= $diproses ?? 0 ?></h2>

            <p>Diproses</p>

            <i class="fas fa-spinner"></i>

        </div>

    </div>


    <div class="col-lg-3 col-md-6">

        <div class="stat-card bg-success">

            <h2><?= $selesai ?? 0 ?></h2>

            <p>Selesai</p>

            <i class="fas fa-check-circle"></i>

        </div>

    </div>

</div>


<?php

$totalTiket = (int) ($total ?? 0);

$persenMenunggu = $totalTiket > 0
    ? round((($menunggu ?? 0) / $totalTiket) * 100)
    : 0;

$persenDiproses = $totalTiket > 0
    ? round((($diproses ?? 0) / $totalTiket) * 100)
    : 0;

$persenSelesai = $totalTiket > 0
    ? round((($selesai ?? 0) / $totalTiket) * 100)
    : 0;

?>


<!-- DATA TIKET KEMAHASISWAAN -->

<div class="card mb-4 dashboard-overview-card">

    <div class="card-body d-flex justify-content-between align-items-center">

        <div class="d-flex align-items-center gap-3">

            <div class="overview-icon bg-primary">

                <i class="fas fa-ticket-alt"></i>

            </div>

            <div>

                <h5 class="mb-1 fw-bold">
                    Data Tiket Kemahasiswaan
                </h5>

                <p class="mb-0 text-muted">
                    Lihat dan kelola seluruh tiket yang masuk ke Unit Kemahasiswaan.
                </p>

            </div>

        </div>


        <a
            href="<?= base_url('kemahasiswaan/data-tiket') ?>"
            class="btn btn-primary"
        >

            <i class="fas fa-list me-1"></i>

            Lihat Data Tiket

        </a>

    </div>

</div>


<!-- STATISTIK TIKET -->

<div class="card mb-4 dashboard-overview-card">

    <div class="card-body">

        <h5 class="mb-1 fw-bold">

            <i class="fas fa-chart-bar text-primary me-2"></i>

            Statistik Tiket

        </h5>


        <p class="text-muted small">
            Ringkasan statistik tiket Unit Kemahasiswaan
        </p>


        <!-- ANGKA STATISTIK -->

        <div class="row text-center py-3">

            <div class="col-md-3">

                <strong class="overview-number">

                    <?= $totalTiket ?>

                </strong>

                <small>

                    Total Tiket

                </small>

            </div>


            <div class="col-md-3">

                <strong class="overview-number">

                    <?= $persenMenunggu ?>%

                </strong>

                <small>

                    Tiket Menunggu

                </small>

            </div>


            <div class="col-md-3">

                <strong class="overview-number">

                    <?= $persenDiproses ?>%

                </strong>

                <small>

                    Tiket Diproses

                </small>

            </div>


            <div class="col-md-3">

                <strong class="overview-number">

                    <?= $persenSelesai ?>%

                </strong>

                <small>

                    Tiket Selesai

                </small>

            </div>

        </div>


        <hr>


        <!-- MENUNGGU -->

        <div class="status-item">

            <div class="status-left">

                <span class="status-icon waiting">

                    <i class="fas fa-hourglass-half"></i>

                </span>

                <span>

                    Menunggu

                </span>

            </div>


            <strong>

                <?= $menunggu ?? 0 ?> tiket
                (<?= $persenMenunggu ?>%)

            </strong>

        </div>


        <div class="progress mb-3">

            <div
                class="progress-bar bg-warning"
                role="progressbar"
                style="width: <?= $persenMenunggu ?>%;"
            >
            </div>

        </div>


        <!-- DIPROSES -->

        <div class="status-item">

            <div class="status-left">

                <span class="status-icon processing">

                    <i class="fas fa-spinner"></i>

                </span>

                <span>

                    Diproses

                </span>

            </div>


            <strong>

                <?= $diproses ?? 0 ?> tiket
                (<?= $persenDiproses ?>%)

            </strong>

        </div>


        <div class="progress mb-3">

            <div
                class="progress-bar bg-info"
                role="progressbar"
                style="width: <?= $persenDiproses ?>%;"
            >
            </div>

        </div>


        <!-- SELESAI -->

        <div class="status-item">

            <div class="status-left">

                <span class="status-icon completed">

                    <i class="fas fa-check-circle"></i>

                </span>

                <span>

                    Selesai

                </span>

            </div>


            <strong>

                <?= $selesai ?? 0 ?> tiket
                (<?= $persenSelesai ?>%)

            </strong>

        </div>


        <div class="progress">

            <div
                class="progress-bar bg-success"
                role="progressbar"
                style="width: <?= $persenSelesai ?>%;"
            >
            </div>

        </div>

    </div>

</div>


<?= $this->endSection() ?>