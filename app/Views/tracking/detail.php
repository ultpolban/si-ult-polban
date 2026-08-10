<?php

$ticket = $ticket ?? [];
$logs   = $logs ?? [];

$progressStep = (int) ($ticket['progress_step'] ?? 1);

$status = $ticket['status'] ?? 'Diajukan';

$ticketNumber = $ticket['ticket_number'] ?? '-';
$name         = $ticket['name'] ?? '-';
$nim          = $ticket['nim'] ?? '-';
$email        = $ticket['email'] ?? '-';
$phone        = $ticket['phone'] ?? '-';
$service      = $ticket['service'] ?? '-';
$source       = $ticket['source'] ?? '-';
$title        = $ticket['title'] ?? '-';
$priority     = $ticket['priority'] ?? 'Normal';
$unit         = $ticket['unit_display'] ?? '-';
$lamaProses   = $ticket['lama_proses'] ?? '-';

$baseUrl = base_url();

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Tracking Tiket</title>

    <style>

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            font-family:
                Arial,
                Helvetica,
                sans-serif;
            background: #eef2fb;
            color: #222;
        }

        body {
            min-height: 100vh;
        }

        /* =====================================
           SIDEBAR
        ===================================== */

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 247px;
            background: #293987;
            color: white;
            z-index: 1000;
        }

        .sidebar-title {
            height: 56px;
            display: flex;
            align-items: center;
            padding: 0 15px;
            font-size: 18px;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .menu {
            padding-top: 8px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 13px;
            height: 42px;
            padding: 0 30px;
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .menu a:hover {
            background: rgba(255,255,255,.10);
        }

        .menu a.active {
            background: rgba(255,255,255,.12);
        }

        .menu-icon {
            width: 20px;
            text-align: center;
            font-size: 18px;
        }

        /* =====================================
           TOP BAR
        ===================================== */

        .topbar {
            position: fixed;
            left: 247px;
            right: 0;
            top: 0;
            height: 56px;
            background: #293987;
            color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 22px;
            z-index: 900;
        }

        .toggle {
            font-size: 22px;
            font-weight: bold;
        }

        .administrator {
            font-size: 15px;
        }

        /* =====================================
           CONTENT
        ===================================== */

        .content {
            margin-left: 247px;
            padding: 70px 22px 30px;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 1360px;
            margin: auto;
        }

        /* =====================================
           CARD
        ===================================== */

        .card {
            background: white;
            border-radius: 8px;
            margin-bottom: 22px;
            box-shadow: 0 1px 4px rgba(0,0,0,.10);
            overflow: hidden;
        }

        .card-header {
            background: #293987;
            color: white;
            padding: 13px 20px;
            font-size: 20px;
            font-weight: bold;
        }

        .card-body {
            padding: 24px;
        }

        /* =====================================
           HEADER DETAIL
        ===================================== */

        .ticket-header {
            text-align: center;
            padding: 25px 20px 12px;
        }

        .ticket-label {
            color: #777;
            font-size: 15px;
            margin-bottom: 5px;
        }

        .ticket-number {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .status-badge {
            display: inline-block;
            background: #293987;
            color: white;
            border-radius: 4px;
            padding: 7px 15px;
            font-size: 13px;
            font-weight: bold;
        }

        /* =====================================
           PROGRESS
        ===================================== */

        .progress-wrapper {
            padding: 35px 40px 28px;
        }

        .progress-container {
            position: relative;
            display: flex;
            justify-content: space-between;
        }

        .progress-line {
            position: absolute;
            top: 23px;
            left: 5%;
            right: 5%;
            height: 5px;
            background: #dfe3e8;
            z-index: 1;
        }

        .progress-line-active {
            position: absolute;
            top: 23px;
            left: 5%;
            height: 5px;
            background: #20b24b;
            z-index: 2;
            transition: width .3s ease;
        }

        .progress-item {
            position: relative;
            z-index: 3;
            width: 20%;
            text-align: center;
        }

        .progress-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            margin: 0 auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e1e5e9;
            border: 3px solid #f3f5f7;
            color: #6c757d;
            font-size: 20px;
            font-weight: bold;
        }

        .progress-item.done .progress-circle {
            background: #20b24b;
            color: white;
        }

        .progress-item.active .progress-circle {
            background: #1683ff;
            color: white;
        }

        .progress-item.done .progress-title {
            color: #20a947;
        }

        .progress-item.active .progress-title {
            color: #0075ef;
        }

        .progress-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 6px;
            color: #666;
        }

        .progress-time {
            color: #888;
            font-size: 11px;
        }

        /* =====================================
           INFO
        ===================================== */

        .info-header {
            background: #293987;
            color: white;
            padding: 13px 20px;
            font-size: 17px;
            font-weight: bold;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px 60px;
            padding: 25px;
        }

        .info-item {
            margin-bottom: 20px;
        }

        .info-label {
            color: #666;
            font-size: 14px;
            margin-bottom: 5px;
        }

        .info-value {
            color: #222;
            font-size: 15px;
            font-weight: 500;
            word-break: break-word;
        }

        .unit-badge {
            display: inline-block;
            background: #293987;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        .duration-badge {
            display: inline-block;
            background: #19a9bd;
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
        }

        /* =====================================
           ACTIVITY LOG
        ===================================== */

        .activity {
            padding: 22px 25px;
        }

        .activity-item {
            position: relative;
            padding: 0 0 20px 18px;
            margin-bottom: 5px;
            border-left: 3px solid #1683ff;
        }

        .activity-item:last-child {
            border-left-color: transparent;
        }

        .activity-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .activity-meta {
            color: #888;
            font-size: 11px;
        }

        .activity-empty {
            color: #888;
            font-size: 14px;
        }

        /* =====================================
           BUTTON
        ===================================== */

        .button-row {
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            margin-bottom: 22px;
        }

        .btn {
            display: inline-block;
            padding: 9px 15px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-primary {
            background: #293987;
            color: white;
        }

        .btn-primary:hover {
            background: #202e72;
        }

        /* =====================================
           RESPONSIVE
        ===================================== */

        @media (max-width: 900px) {

            .sidebar {
                width: 210px;
            }

            .topbar {
                left: 210px;
            }

            .content {
                margin-left: 210px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 0;
            }

        }

        @media (max-width: 700px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .topbar {
                position: relative;
                left: 0;
            }

            .content {
                margin-left: 0;
                padding: 20px 10px;
            }

            .progress-wrapper {
                padding: 25px 5px;
                overflow-x: auto;
            }

            .progress-container {
                min-width: 650px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

        }

    </style>

</head>

<body>

<!-- =========================================
     SIDEBAR
========================================= -->

<aside class="sidebar">

    <div class="sidebar-title">
        SI ULT POLBAN
    </div>

    <nav class="menu">

        <a href="<?= base_url('dashboard') ?>">
            <span class="menu-icon">⌂</span>
            <span>Dashboard</span>
        </a>

        <a href="<?= base_url('ticket') ?>">
            <span class="menu-icon">▣</span>
            <span>Data Tiket</span>
        </a>

        <a href="<?= base_url('verification') ?>">
            <span class="menu-icon">●</span>
            <span>Verifikasi Tiket</span>
        </a>

        <a href="<?= base_url('disposition') ?>">
            <span class="menu-icon">➜</span>
            <span>Disposisi Tiket</span>
        </a>

        <a href="<?= base_url('report') ?>">
            <span class="menu-icon">▤</span>
            <span>Laporan Tiket</span>
        </a>

        <a href="<?= base_url('statistics') ?>">
            <span class="menu-icon">▥</span>
            <span>Statistik Tiket</span>
        </a>

        <a href="<?= base_url('guest-report') ?>">
            <span class="menu-icon">▦</span>
            <span>Laporan Tamu</span>
        </a>

        <a
            href="<?= base_url('tracking') ?>"
            class="active"
        >
            <span class="menu-icon">⌕</span>
            <span>Tracking Tiket</span>
        </a>

        <a href="<?= base_url('logout') ?>">
            <span class="menu-icon">➜</span>
            <span>Logout</span>
        </a>

    </nav>

</aside>


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

</main>

</body>
</html>