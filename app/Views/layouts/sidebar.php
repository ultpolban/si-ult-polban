<style>
    /* ==============================
       SIDEBAR SI ULT POLBAN
    ============================== */

    .ult-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;

        width: 260px;

        background: #293b8f;
        color: #fff;

        z-index: 1038;

        overflow-y: auto;
        overflow-x: hidden;

        box-shadow: 3px 0 12px rgba(0, 0, 0, 0.08);
    }

    .ult-sidebar::-webkit-scrollbar {
        width: 5px;
    }

    .ult-sidebar::-webkit-scrollbar-thumb {
        background: rgba(255,255,255,.25);
        border-radius: 10px;
    }


    /* ==============================
       BRAND
    ============================== */

    .ult-brand {
        height: 80px;

        display: flex;
        align-items: center;
        justify-content: center;

        text-decoration: none !important;

        color: #fff !important;

        border-bottom: 1px solid rgba(255,255,255,.12);
    }

    .ult-brand-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ult-brand-icon {
        width: 42px;
        height: 42px;

        border-radius: 50%;

        background: rgba(255,255,255,.10);

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 19px;
    }

    .ult-brand-text {
        font-size: 18px;
        font-weight: 800;

        letter-spacing: .3px;
    }


    /* ==============================
       PROFIL
    ============================== */

    .ult-profile {
        display: flex;
        align-items: center;

        padding: 18px 20px;

        border-bottom: 1px solid rgba(255,255,255,.12);
    }

    .ult-profile-avatar {
        position: relative;

        width: 46px;
        height: 46px;

        min-width: 46px;

        border-radius: 50%;

        background: #5147df;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 14px;
        font-weight: 700;

        margin-right: 12px;
    }

    .ult-profile-avatar::after {
        content: "";

        position: absolute;

        width: 9px;
        height: 9px;

        right: 1px;
        bottom: 1px;

        border-radius: 50%;

        background: #2ecc71;

        border: 2px solid #293b8f;
    }

    .ult-profile-name {
        font-size: 14px;
        font-weight: 700;

        color: #fff;
    }

    .ult-profile-role {
        margin-top: 3px;

        font-size: 11px;

        color: #b6c1ec;
    }

    .ult-profile-role i {
        color: #ffc107;
        margin-right: 4px;
    }


    /* ==============================
       MENU CONTAINER
    ============================== */

    .ult-menu {
        padding: 14px 12px 25px;
    }


    /* ==============================
       JUDUL MENU
    ============================== */

    .ult-menu-title {
        padding: 14px 8px 8px;

        font-size: 10px;

        font-weight: 800;

        letter-spacing: 1.1px;

        color: rgba(255,255,255,.38);

        text-transform: uppercase;
    }


    /* ==============================
       MENU ITEM
    ============================== */

    .ult-menu-item {
        position: relative;

        display: flex;
        align-items: center;

        width: 100%;

        min-height: 47px;

        padding: 0 13px;

        margin-bottom: 5px;

        border-radius: 8px;

        color: #fff !important;

        text-decoration: none !important;

        transition: .2s ease;
    }

    .ult-menu-item i {
        width: 27px;
        min-width: 27px;

        margin-right: 10px;

        text-align: center;

        font-size: 17px;
    }

    .ult-menu-text {
        flex: 1;

        font-size: 14px;

        font-weight: 600;
    }

    .ult-menu-item:hover {
        background: rgba(255,255,255,.10);

        color: #fff !important;
    }


    /* ==============================
       MENU AKTIF
    ============================== */

    .ult-menu-item.active {
        background: #ff9800;

        color: #fff !important;

        box-shadow: 0 4px 10px rgba(255,152,0,.25);
    }

    .ult-menu-item.active:hover {
        background: #ff9800;
    }


    /* ==============================
       BADGE
    ============================== */

    .ult-badge {
        min-width: 30px;
        height: 30px;

        padding: 0 7px;

        display: flex;
        align-items: center;
        justify-content: center;

        border-radius: 5px;

        background: #fff;

        color: #293b8f;

        font-size: 12px;

        font-weight: 800;

        margin-left: 8px;
    }

    .ult-badge-orange {
        background: #ffc107;
        color: #fff;
    }

    .ult-badge-cyan {
        background: #11a8d4;
        color: #fff;
    }


    /* ==============================
       LOGOUT
    ============================== */

    .ult-logout {
        margin-top: 12px;

        padding-top: 5px;

        border-top: 1px solid rgba(255,255,255,.08);
    }


    /* ==============================
       CONTENT
    ============================== */

    .ult-main-content {
        margin-left: 260px;

        min-height: 100vh;
    }


    /* ==============================
       MOBILE
    ============================== */

    @media (max-width: 768px) {

        .ult-sidebar {
            transform: translateX(-100%);

            transition: transform .25s ease;
        }

        .ult-sidebar.show {
            transform: translateX(0);
        }

        .ult-main-content {
            margin-left: 0;
        }
    }
</style>


<aside class="ult-sidebar">


    <!-- ==============================
         BRAND
    ============================== -->

    <a
        href="<?= base_url('dashboard') ?>"
        class="ult-brand"
    >

        <div class="ult-brand-wrapper">

            <div class="ult-brand-icon">
                <i class="fas fa-layer-group"></i>
            </div>

            <span class="ult-brand-text">
                SI-ULT POLBAN
            </span>

        </div>

    </a>


    <!-- ==============================
         PROFIL PETUGAS
    ============================== -->

    <?php

        $namaPetugas =
            session()->get('name')
            ?? session()->get('username')
            ?? 'Petugas ULT';

        $inisial = strtoupper(
            substr($namaPetugas, 0, 2)
        );

    ?>

    <div class="ult-profile">

        <div class="ult-profile-avatar">
            <?= esc($inisial) ?>
        </div>

        <div>

            <div class="ult-profile-name">
                <?= esc($namaPetugas) ?>
            </div>

            <div class="ult-profile-role">

                <i class="fas fa-shield-alt"></i>

                Authorized Operator

            </div>

        </div>

    </div>


    <!-- ==============================
         MENU
    ============================== -->

    <nav class="ult-menu">


        <!-- DASHBOARD -->

        <a
            href="<?= base_url('dashboard') ?>"
            class="ult-menu-item <?= uri_string() == 'dashboard' || uri_string() == '' ? 'active' : '' ?>"
        >

            <i class="fas fa-home"></i>

            <span class="ult-menu-text">
                Dashboard Utama
            </span>

        </a>


        <!-- PROFIL -->

        <a
            href="<?= base_url('profile') ?>"
            class="ult-menu-item <?= strpos(uri_string(), 'profile') === 0 ? 'active' : '' ?>"
        >

            <i class="fas fa-user-cog"></i>

            <span class="ult-menu-text">
                Profil Petugas
            </span>

        </a>


        <?php if (hasRole(1)): ?>


            <!-- ==================================
                 MANAJEMEN TIKET
            ================================== -->

            <div class="ult-menu-title">
                Manajemen Tiket ULT
            </div>


            <!-- DATA TIKET -->

            <a
                href="<?= base_url('datatiket') ?>"
                class="ult-menu-item <?= strpos(uri_string(), 'datatiket') === 0 ? 'active' : '' ?>"
            >

                <i class="fas fa-ticket-alt"></i>

                <span class="ult-menu-text">
                    Data Tiket
                </span>

                <?php if (isset($total_tiket) && $total_tiket > 0): ?>

                    <span class="ult-badge">
                        <?= $total_tiket ?>
                    </span>

                <?php endif; ?>

            </a>


            <!-- VERIFIKASI -->

            <a
                href="<?= base_url('verification') ?>"
                class="ult-menu-item <?= strpos(uri_string(), 'verification') === 0 ? 'active' : '' ?>"
            >

                <i class="fas fa-user-check"></i>

                <span class="ult-menu-text">
                    Verifikasi Tiket
                </span>

                <?php if (isset($submitted) && $submitted > 0): ?>

                    <span class="ult-badge ult-badge-orange">
                        <?= $submitted ?>
                    </span>

                <?php endif; ?>

            </a>


            <!-- DISPOSISI -->

            <a
                href="<?= base_url('disposition') ?>"
                class="ult-menu-item <?= strpos(uri_string(), 'disposition') === 0 ? 'active' : '' ?>"
            >

                <i class="fas fa-share-square"></i>

                <span class="ult-menu-text">
                    Disposisi Tiket
                </span>

                <?php if (isset($total_disposisi) && $total_disposisi > 0): ?>

                    <span class="ult-badge ult-badge-cyan">
                        <?= $total_disposisi ?>
                    </span>

                <?php endif; ?>

            </a>


            <!-- ==================================
                 LAPORAN & ANALITIK
            ================================== -->

            <div class="ult-menu-title">
                Laporan & Analitik
            </div>


            <!-- LAPORAN TAMU -->

            <a
                href="<?= base_url('guest-report') ?>"
                class="ult-menu-item <?= strpos(uri_string(), 'guest-report') === 0 ? 'active' : '' ?>"
            >

                <i class="fas fa-users"></i>

                <span class="ult-menu-text">
                    Laporan Tamu ULT
                </span>

            </a>


            <!-- STATISTIK -->

            <a
                href="<?= base_url('statistics') ?>"
                class="ult-menu-item <?= strpos(uri_string(), 'statistics') === 0 ? 'active' : '' ?>"
            >

                <i class="fas fa-chart-pie"></i>

                <span class="ult-menu-text">
                    Statistik Layanan
                </span>

            </a>


            <!-- LAPORAN TIKET -->

            <a
                href="<?= base_url('report') ?>"
                class="ult-menu-item <?= strpos(uri_string(), 'report') === 0 ? 'active' : '' ?>"
            >

                <i class="fas fa-file-alt"></i>

                <span class="ult-menu-text">
                    Laporan Tiket
                </span>

            </a>


            <!-- TRACKING -->

            <a
                href="<?= base_url('tracking') ?>"
                class="ult-menu-item <?= strpos(uri_string(), 'tracking') === 0 ? 'active' : '' ?>"
            >

                <i class="fas fa-route"></i>

                <span class="ult-menu-text">
                    Tracking Tiket
                </span>

            </a>


            <!-- LOG AKTIVITAS -->

            <a
                href="<?= base_url('log-aktivitas') ?>"
                class="ult-menu-item <?= strpos(uri_string(), 'log-aktivitas') === 0 ? 'active' : '' ?>"
            >

                <i class="fas fa-history"></i>

                <span class="ult-menu-text">
                    Log Aktivitas
                </span>

            </a>


        <?php endif; ?>


        <!-- ==============================
             LOGOUT
        ============================== -->

        <div class="ult-logout">

            <a
                href="<?= base_url('logout') ?>"
                class="ult-menu-item"
            >

                <i class="fas fa-sign-out-alt"></i>

                <span class="ult-menu-text">
                    Logout
                </span>

            </a>

        </div>


    </nav>

</aside>