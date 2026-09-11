<?php
$currentUrl = uri_string();
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- BRAND / LOGO POLBAN -->
    <a href="<?= base_url('umum/dashboard') ?>" class="brand-link">

        <img
            src="<?= base_url('assets/adminlte/img/logo-polban.png') ?>"
            alt="Logo POLBAN"
            class="brand-image"
            style="
                width: 38px;
                height: 38px;
                object-fit: contain;
                opacity: 1;
                margin-left: 8px;
                margin-right: 8px;
            ">

        <span
            class="brand-text font-weight-bold"
            style="
                color: white;
                font-size: 17px;
            ">
            SI-ULT POLBAN
        </span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- =====================================
             MENU
        ====================================== -->

        <nav class="mt-2">

            <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">


                <!-- =================================
                     DASHBOARD
                ================================== -->

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('umum/dashboard') ?>"
                        class="nav-link <?= $currentUrl === 'umum/dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <!-- Ajukan Layanan -->
                <li class="nav-item">
                    <a href="<?= base_url('umum/ticket/create') ?>"
                        class="nav-link <?= $currentUrl === 'umum/ticket/create' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-plus-circle"></i>
                        <p>Ajukan Layanan</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a
                        href="<?= base_url('umum/ticket/draft') ?>"
                        class="nav-link <?= strpos($currentUrl, 'umum/ticket/draft') === 0 ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-file-alt"></i>

                        <p>
                            Draft Pengajuan
                        </p>

                    </a>
                </li>


                <!-- Tracking Tiket -->
                <li class="nav-item">
                    <a href="<?= base_url('umum/ticket/history') ?>"
                        class="nav-link <?= $currentUrl === 'umum/ticket/history' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>Tracking Tiket</p>
                    </a>
                </li>


                <!-- Notifikasi -->
                <li class="nav-item">
                    <a href="<?= base_url('umum/notification') ?>"
                        class="nav-link <?= strpos($currentUrl, 'umum/notification') === 0 ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notifikasi</p>
                    </a>
                </li>


                <!-- Profil -->
                <li class="nav-item">
                    <a href="<?= base_url('umum/profile') ?>"
                        class="nav-link <?= strpos($currentUrl, 'umum/profile') === 0 ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profil</p>
                    </a>
                </li>

                <!-- =================================
                     LOGOUT
                ================================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('logout') ?>"
                        class="nav-link">

                        <i class="nav-icon fas fa-sign-out-alt"></i>

                        <p>
                            Logout
                        </p>

                    </a>

                </li>


            </ul>

        </nav>


    </div>

</aside>