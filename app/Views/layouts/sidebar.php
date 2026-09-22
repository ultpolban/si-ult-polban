<style>
    /* =========================================
       SIDEBAR SI ULT POLBAN - FRONTEND3 STYLE
    ========================================= */

    .main-sidebar {
        background: #2b3990 !important;
        border-right: none !important;
    }

    /* =========================================
       BRAND / LOGO POLBAN
    ========================================= */

    .main-sidebar .brand-link {
        height: 68px !important;
        min-height: 68px !important;

        display: flex !important;
        align-items: center !important;

        padding: 0 14px !important;

        background: #2b3990 !important;

        border-bottom: 1px solid rgba(255,255,255,.12) !important;

        color: #fff !important;
    }

    .main-sidebar .brand-link:hover {
        background: #2b3990 !important;
    }

    .polban-sidebar-logo {
        width: 42px;
        height: 42px;

        object-fit: contain;

        margin-left: 2px;
        margin-right: 10px;

        flex-shrink: 0;
    }

    .polban-brand-text {
        color: #fff !important;

        font-size: 17px;
        font-weight: 800;

        letter-spacing: .4px;

        line-height: 1.2;
    }


    /* =========================================
       SIDEBAR CONTENT
    ========================================= */

    .main-sidebar .sidebar {
        background: #2b3990 !important;

        padding-left: 8px !important;
        padding-right: 8px !important;
    }


    /* =========================================
       USER PANEL
    ========================================= */

    .main-sidebar .user-panel {
        padding: 12px 6px 14px !important;

        margin-top: 8px !important;
        margin-bottom: 8px !important;

        border-bottom: 1px solid rgba(255,255,255,.12) !important;
    }

    .sidebar-user-avatar {
        width: 40px;
        height: 40px;

        border-radius: 50%;

        background: #4f46e5;

        color: #fff;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 13px;
        font-weight: 700;

        box-shadow: 0 2px 5px rgba(0,0,0,.15);
    }

    .sidebar-online {
        position: absolute;

        width: 10px;
        height: 10px;

        right: -1px;
        bottom: 0;

        background: #2ecc71;

        border: 2px solid #2b3990;

        border-radius: 50%;
    }

    .main-sidebar .user-panel .info {
        padding-left: 8px !important;
    }

    .main-sidebar .user-panel .info a {
        color: #fff !important;

        font-size: 14px !important;
        font-weight: 700 !important;
    }

    .sidebar-role {
        display: block;

        margin-top: 2px;

        color: #a5b4fc !important;

        font-size: 11px;
    }

    .sidebar-role i {
        color: #ffc107;

        margin-right: 4px;
    }


    /* =========================================
       MENU
    ========================================= */

    .main-sidebar .nav-sidebar > .nav-item {
        margin-bottom: 3px;
    }

    .main-sidebar .nav-sidebar .nav-link {
        margin: 0 2px;

        padding: 11px 12px;

        border-radius: 8px;

        color: #fff !important;

        transition: all .2s ease;
    }

    .main-sidebar .nav-sidebar .nav-link:hover {
        background: rgba(255,255,255,.10) !important;

        color: #fff !important;
    }

    .main-sidebar .nav-sidebar .nav-link.active {
        background: #ff9800 !important;

        color: #fff !important;

        box-shadow: 0 4px 10px rgba(255,152,0,.25);
    }

    .main-sidebar .nav-sidebar .nav-icon {
        font-size: 16px !important;

        width: 25px !important;

        margin-right: 7px !important;
    }

    .main-sidebar .nav-sidebar .nav-link p {
        font-size: 14px;

        font-weight: 600;

        margin: 0;
    }


    /* =========================================
       HEADER MENU
    ========================================= */

    .main-sidebar .nav-header {
        padding: 13px 10px 5px !important;

        margin-top: 2px;

        color: rgba(255,255,255,.42) !important;

        font-size: 10px !important;

        font-weight: 800 !important;

        letter-spacing: 1px;

        text-transform: uppercase;
    }


    /* =========================================
       BADGE
    ========================================= */

    .sidebar-badge {
        float: right;

        min-width: 24px;

        padding: 3px 6px;

        border-radius: 5px;

        text-align: center;

        font-size: 11px;

        font-weight: 700;
    }


    /* =========================================
       LOGOUT
    ========================================= */

    .sidebar-logout {
        margin-top: 12px !important;

        margin-bottom: 20px !important;
    }

    .sidebar-logout .nav-link {
        background: rgba(239,68,68,.15) !important;

        border: 1px solid rgba(239,68,68,.30);

        color: #ff6b6b !important;
    }

    .sidebar-logout .nav-link:hover {
        background: rgba(239,68,68,.23) !important;
    }


    /* =========================================
       SCROLLBAR
    ========================================= */

    .main-sidebar {
        scrollbar-width: thin;

        scrollbar-color: rgba(255,255,255,.25) transparent;
    }

    .main-sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .main-sidebar::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,.25);

        border-radius: 10px;
    }
</style>


<?php
    $namaPetugas =
        session()->get('name')
        ?? session()->get('full_name')
        ?? session()->get('username')
        ?? 'Petugas ULT';

    $inisial = strtoupper(
        substr(trim($namaPetugas), 0, 2)
    );
?>


<!-- =========================================
     MAIN SIDEBAR
========================================= -->

<aside class="main-sidebar sidebar-dark-primary elevation-4">


    <!-- =====================================
         BRAND POLBAN
    ====================================== -->

    <a href="<?= base_url('dashboard') ?>"
       class="brand-link text-decoration-none">

        <img
            src="<?= base_url('assets/img/logo-polban.png') ?>"
            alt="Logo POLBAN"
            class="polban-sidebar-logo"
        >

        <span class="polban-brand-text">
            SI-ULT POLBAN
        </span>

    </a>


    <!-- =====================================
         SIDEBAR
    ====================================== -->

    <div class="sidebar">


        <!-- =================================
             USER PANEL
        ================================== -->

        <div class="user-panel d-flex align-items-center">

            <div class="image position-relative">

                <div class="sidebar-user-avatar">
                    <?= esc($inisial) ?>
                </div>

                <span class="sidebar-online"></span>

            </div>


            <div class="info">

                <a
                    href="<?= base_url('profile') ?>"
                    class="d-block text-decoration-none"
                >
                    <?= esc($namaPetugas) ?>
                </a>

                <span class="sidebar-role">

                    <i class="fas fa-shield-alt"></i>

                    Authorized Operator

                </span>

            </div>

        </div>


        <!-- =================================
             NAVIGATION
        ================================== -->

        <nav class="mt-2">

            <ul
                class="nav nav-pills nav-sidebar flex-column"
                role="menu"
            >


                <!-- =========================
                     DASHBOARD
                ========================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('dashboard') ?>"
                        class="nav-link <?= uri_string() == 'dashboard' || uri_string() == '' ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-home"></i>

                        <p>
                            Dashboard Utama
                        </p>

                    </a>

                </li>


                <!-- =========================
                     PROFILE
                ========================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('profile') ?>"
                        class="nav-link <?= strpos(uri_string(), 'profile') === 0 ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-user-cog"></i>

                        <p>
                            Profil Petugas
                        </p>

                    </a>

                </li>


                <!-- =========================
                     HEADER
                ========================== -->

                <li class="nav-header">
                    Manajemen Tiket ULT
                </li>


                <!-- =========================
                     DATA TIKET
                ========================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('datatiket') ?>"
                        class="nav-link <?= strpos(uri_string(), 'datatiket') === 0 ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-ticket-alt"></i>

                        <p>

                            Data Tiket

                            <?php if (isset($total_tiket) && $total_tiket > 0): ?>

                                <span class="badge badge-light text-dark sidebar-badge">

                                    <?= esc($total_tiket) ?>

                                </span>

                            <?php endif; ?>

                        </p>

                    </a>

                </li>


                <!-- =========================
                     VERIFIKASI
                ========================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('verification') ?>"
                        class="nav-link <?= strpos(uri_string(), 'verification') === 0 ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-user-check"></i>

                        <p>

                            Verifikasi Tiket

                            <?php if (isset($submitted) && $submitted > 0): ?>

                                <span class="badge badge-warning sidebar-badge">

                                    <?= esc($submitted) ?>

                                </span>

                            <?php endif; ?>

                        </p>

                    </a>

                </li>


                <!-- =========================
                     DISPOSISI
                ========================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('disposition') ?>"
                        class="nav-link <?= strpos(uri_string(), 'disposition') === 0 ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-share-square"></i>

                        <p>

                            Disposisi Tiket

                            <?php if (isset($total_disposisi) && $total_disposisi > 0): ?>

                                <span class="badge badge-info sidebar-badge">

                                    <?= esc($total_disposisi) ?>

                                </span>

                            <?php endif; ?>

                        </p>

                    </a>

                </li>


                <!-- =========================
                     HEADER
                ========================== -->

                <li class="nav-header">
                    Laporan & Analitik
                </li>


                <!-- =========================
                     LAPORAN TAMU
                ========================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('guest-report') ?>"
                        class="nav-link <?= strpos(uri_string(), 'guest-report') === 0 ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-users"></i>

                        <p>
                            Laporan Tamu ULT
                        </p>

                    </a>

                </li>


                <!-- =========================
                     STATISTIK
                ========================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('statistics') ?>"
                        class="nav-link <?= strpos(uri_string(), 'statistics') === 0 ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-chart-pie"></i>

                        <p>
                            Statistik Layanan
                        </p>

                    </a>

                </li>


                <!-- =========================
                     LAPORAN TIKET
                ========================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('report') ?>"
                        class="nav-link <?= strpos(uri_string(), 'report') === 0 ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-file-invoice"></i>

                        <p>
                            Laporan Tiket
                        </p>

                    </a>

                </li>


                <!-- =========================
                     TRACKING
                ========================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('tracking') ?>"
                        class="nav-link <?= strpos(uri_string(), 'tracking') === 0 ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-route"></i>

                        <p>
                            Tracking Tiket
                        </p>

                    </a>

                </li>


                <!-- =========================
                     LOG AKTIVITAS
                ========================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('log-aktivitas') ?>"
                        class="nav-link <?= strpos(uri_string(), 'log-aktivitas') === 0 ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-history text-info"></i>

                        <p>
                            Log Aktivitas
                        </p>

                    </a>

                </li>


                <!-- =========================
                     LOGOUT
                ========================== -->

                <li class="nav-item sidebar-logout">

                    <a
                        href="<?= base_url('logout') ?>"
                        class="nav-link"
                    >

                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>

                        <p class="font-weight-bold text-danger">
                            Keluar Aplikasi
                        </p>

                    </a>

                </li>


            </ul>

        </nav>

    </div>

</aside>
