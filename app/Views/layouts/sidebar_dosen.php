<?php
$currentUrl = uri_string();
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- BRAND / LOGO POLBAN -->
    <a href="<?= base_url('dashboard-dosen') ?>" class="brand-link">

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
             PROFIL DOSEN
        ====================================== -->

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">

                <img
                    src="<?= base_url('assets/adminlte/img/default-profil.png') ?>"
                    class="img-circle elevation-2"
                    alt="Foto Profil">

            </div>

            <div class="info">

                <a
                    href="<?= base_url('dosen/profile') ?>"
                    class="d-block">

                    <?= esc(
                        session()->get('user')['full_name']
                            ?? session()->get('user')['nama']
                            ?? 'Dosen'
                    ) ?>

                </a>

            </div>

        </div>



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
                    <a href="<?= base_url('dosen/dashboard') ?>"
                        class="nav-link <?= $currentUrl === 'dosen/dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <!-- Ajukan Layanan -->
                <li class="nav-item">
                    <a href="<?= base_url('dosen/ticket/create') ?>"
                        class="nav-link <?= $currentUrl === 'dosen/ticket/create' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-plus-circle"></i>
                        <p>Ajukan Layanan</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a
                        href="<?= base_url('dosen/ticket/draft') ?>"
                        class="nav-link <?= strpos($currentUrl, 'dosen/ticket/draft') === 0 ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-file-alt"></i>

                        <p>
                            Draft Pengajuan
                        </p>

                    </a>
                </li>


                <!-- Tracking Tiket -->
                <li class="nav-item">
                    <a href="<?= base_url('dosen/ticket/history') ?>"
                        class="nav-link <?= $currentUrl === 'dosen/ticket/history' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>Tracking Tiket</p>
                    </a>
                </li>


                <!-- Notifikasi -->
                <li class="nav-item">
                    <a href="<?= base_url('dosen/notification') ?>"
                        class="nav-link <?= strpos($currentUrl, 'dosen/notification') === 0 ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notifikasi</p>
                    </a>
                </li>


                <!-- Profil -->
                <li class="nav-item">
                    <a href="<?= base_url('dosen/profile') ?>"
                        class="nav-link <?= strpos($currentUrl, 'dosen/profile') === 0 ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profil</p>
                    </a>
                </li>


                <!-- =================================
                     PEMBATAS
                ================================== -->

                <li class="nav-header">
                    AKUN
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