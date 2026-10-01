<?php
/**
 * =====================================================================
 *  DETAIL TIKET (publik)
 * ---------------------------------------------------------------------
 *  Memakai layout publik (layouts/template_public) supaya konsisten
 *  dengan landing page dan tidak menampilkan sidebar dashboard.
 *
 *  Variabel: $ticket, $logs
 * =====================================================================
 */
helper('role');

$isLoggedIn = (bool) session()->get('isLoggedIn');
?>

<?= $this->extend('layouts/template_public') ?>

<?= $this->section('content') ?>

<section class="py-5" style="background:var(--px-bg-soft);">

    <div class="container">

<!-- =========================================
     TOP BAR
========================================= -->

<header class="topbar">

    <div class="toggle">
        ☰
    </div>

    <div class="administrator">
        Administrator
    </div>

</header>


<!-- =========================================
     CONTENT
========================================= -->

<main class="content">

    <div class="container">

        <!-- =================================
             HEADER TRACKING
        ================================== -->

        <div class="card">

            <div class="card-header">
                📍 &nbsp; Tracking Progres Tiket
            </div>

            <div class="ticket-header">

                <div class="ticket-label">
                    Nomor Tiket
                </div>

                <div class="ticket-number">
                    <?= esc($ticketNumber) ?>
                </div>

                <div class="status-badge">
                    <?= esc($status) ?>
                </div>

            </div>


            <!-- =================================
                 PROGRESS
            ================================== -->

            <div class="progress-wrapper">

                <div class="progress-container">

                    <div class="progress-line"></div>

                    <?php

                    /*
                     * Posisi progress aktif.
                     *
                     * Step:
                     * 1 = 0%
                     * 2 = 25%
                     * 3 = 50%
                     * 4 = 75%
                     * 5 = 100%
                     */

                    $activeWidth = (($progressStep - 1) / 4) * 90;

                    ?>

                    <div
                        class="progress-line-active"
                        style="width: <?= $activeWidth ?>%;"
                    ></div>


                    <!-- STEP 1 -->

                    <div
                        class="progress-item
                        <?= $progressStep >= 1 ? 'done' : '' ?>
                        <?= $progressStep === 1 ? 'active' : '' ?>"
                    >

                        <div class="progress-circle">
                            ✓
                        </div>

                        <div class="progress-title">
                            Diajukan
                        </div>

                        <div class="progress-time">
                            <?= $progressStep >= 1 ? 'Selesai' : 'Menunggu' ?>
                        </div>

                    </div>


                    <!-- STEP 2 -->

                    <div
                        class="progress-item
                        <?= $progressStep >= 2 ? 'done' : '' ?>
                        <?= $progressStep === 2 ? 'active' : '' ?>"
                    >

                        <div class="progress-circle">
                            ✓
                        </div>

                        <div class="progress-title">
                            Diverifikasi
                        </div>

                        <div class="progress-time">
                            <?= $progressStep >= 2 ? 'Selesai' : 'Menunggu' ?>
                        </div>

                    </div>


                    <!-- STEP 3 -->

                    <div
                        class="progress-item
                        <?= $progressStep >= 3 ? 'done' : '' ?>
                        <?= $progressStep === 3 ? 'active' : '' ?>"
                    >

                        <div class="progress-circle">
                            ➜
                        </div>

                        <div class="progress-title">
                            Didisposisi
                        </div>

                        <div class="progress-time">
                            <?= $progressStep >= 3 ? 'Selesai' : 'Menunggu' ?>
                        </div>

                    </div>


                    <!-- STEP 4 -->

                    <div
                        class="progress-item
                        <?= $progressStep >= 4 ? 'done' : '' ?>
                        <?= $progressStep === 4 ? 'active' : '' ?>"
                    >

                        <div class="progress-circle">
                            ⚙
                        </div>

                        <div class="progress-title">
                            Diproses Unit
                        </div>

                        <div class="progress-time">
                            <?= $progressStep >= 4 ? 'Selesai' : 'Menunggu' ?>
                        </div>

                    </div>


                    <!-- STEP 5 -->

                    <div
                        class="progress-item
                        <?= $progressStep >= 5 ? 'done' : '' ?>
                        <?= $progressStep === 5 ? 'active' : '' ?>"
                    >

                        <div class="progress-circle">
                            ✓
                        </div>

                        <div class="progress-title">
                            Selesai
                        </div>

                        <div class="progress-time">
                            <?= $progressStep >= 5 ? 'Selesai' : 'Menunggu' ?>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================
             INFORMASI STATUS
        ================================== -->

        <div class="card">

            <div class="info-header">
                ● &nbsp; Status Tiket
            </div>

            <div class="card-body">

                <?php if ($status === 'Assigned'): ?>

                    <div>
                        Tiket sudah didisposisikan ke unit
                        <strong><?= esc($unit) ?></strong>
                        dan menunggu diproses oleh unit.
                    </div>

                <?php elseif ($status === 'In Progress'): ?>

                    <div>
                        Tiket sedang
                        <strong>diproses oleh unit <?= esc($unit) ?></strong>.
                    </div>

                <?php elseif ($status === 'Completed'): ?>

                    <div>
                        Tiket telah
                        <strong>selesai diproses oleh unit <?= esc($unit) ?></strong>.
                    </div>

                <?php else: ?>

                    <div>
                        Tiket sedang dalam proses pengajuan.
                    </div>

                <?php endif; ?>

            </div>

        </div>


        <!-- =================================
             INFORMASI TIKET
        ================================== -->

        <div class="card">

            <div class="info-header">
                ℹ &nbsp; Informasi Tiket
            </div>

            <div class="info-grid">

                <!-- KOLOM KIRI -->

                <div>

                    <div class="info-item">

                        <div class="info-label">
                            Nomor Tiket
                        </div>

                        <div class="info-value">
                            <?= esc($ticketNumber) ?>
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Nama Pemohon
                        </div>

                        <div class="info-value">
                            <?= esc($name) ?>
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            NIM
                        </div>

                        <div class="info-value">
                            <?= esc($nim) ?>
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Nomor HP
                        </div>

                        <div class="info-value">
                            <?= esc($phone) ?>
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Judul Tiket
                        </div>

                        <div class="info-value">
                            <?= esc($title) ?>
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Prioritas
                        </div>

                        <div class="info-value">
                            <?= esc($priority) ?>
                        </div>

                    </div>

                </div>


                <!-- KOLOM KANAN -->

                <div>

                    <div class="info-item">

                        <div class="info-label">
                            Email
                        </div>

                        <div class="info-value">
                            <?= esc($email) ?>
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Layanan
                        </div>

                        <div class="info-value">
                            <?= esc($service) ?>
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Sumber
                        </div>

                        <div class="info-value">
                            <?= esc($source) ?>
                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Unit Tujuan
                        </div>

                        <div class="info-value">

                            <span class="unit-badge">
                                ▦ &nbsp;
                                <?= esc($unit) ?>
                            </span>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Status
                        </div>

                        <div class="info-value">

                            <span class="unit-badge">
                                <?= esc($status) ?>
                            </span>

                        </div>

                    </div>


                    <div class="info-item">

                        <div class="info-label">
                            Lama Proses
                        </div>

                        <div class="info-value">

                            <span class="duration-badge">
                                <?= esc($lamaProses) ?>
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================
             RIWAYAT AKTIVITAS
        ================================== -->

        <div class="card">

            <div class="info-header">
                ◉ &nbsp; Riwayat Aktivitas
            </div>

            <div class="activity">

                <?php if (!empty($logs)): ?>

                    <?php foreach ($logs as $log): ?>

                        <?php

                        $logMessage =
                            $log['description']
                            ?? $log['action']
                            ?? $log['message']
                            ?? 'Aktivitas tiket';

                        $logDate =
                            $log['created_at']
                            ?? '-';

                        $logUser =
                            $log['created_by']
                            ?? $log['user_name']
                            ?? $log['username']
                            ?? 'Administrator';

                        ?>

                        <div class="activity-item">

                            <div class="activity-title">
                                <?= esc($logMessage) ?>
                            </div>

                            <div class="activity-meta">

                                <?= esc($logDate) ?>

                                &nbsp; - &nbsp;

                                <?= esc($logUser) ?>

                            </div>

                        </div>

                    <?php endforeach; ?>

                <?php else: ?>

                    <div class="activity-empty">
                        Belum ada riwayat aktivitas.
                    </div>

                <?php endif; ?>

            </div>

        </div>


        <!-- =================================
             KEMBALI
        ================================== -->

        <div class="button-row">

            <a
                href="<?= base_url('tracking') ?>"
                class="btn btn-primary"
            >
                ← Kembali ke Tracking
            </a>

        </div>

    </div>


    </div>
</section>

<?= $this->endSection() ?>
