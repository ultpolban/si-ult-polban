<?php

$uri = service('uri');

?>
<!-- Main Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="<?= base_url('dashboard-orangtua') ?>" class="brand-link">

        <img
            src="<?= base_url('assets/adminlte/img/logo-polban.png') ?>"
            alt="POLBAN"
            class="brand-image"
            style="width: 38px;
                height: 38px;
                object-fit: contain;
                opacity: 1;
                margin-left: 8px;
                margin-right: 8px;"
                >

        <span
            class="brand-text font-weight-bold"
            style="
                color: white;
                font-size: 17px;"
        >
            SI-ULT POLBAN
        </span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Menu -->
        <nav class="mt-2">

            <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a
                        href="<?= base_url('dashboard-orangtua') ?>"
                        class="nav-link <?= uri_string() == 'dashboard-orangtua' ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-home"></i>

                        <p>Dashboard Orang Tua</p>

                    </a>
                </li>

                <!-- Ajukan -->
                <li class="nav-item">
                    <a
                        href="<?= base_url('orangtua/ticket/create') ?>"
                        class="nav-link <?= uri_string() == 'orangtua/ticket/create' ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-plus-circle"></i>

                        <p>Ajukan Layanan</p>

                    </a>
                </li>

                <!-- Tracking -->
                <li class="nav-item">
                    <a
                        href="<?= base_url('orangtua/ticket/draft') ?>"
                        class="nav-link <?= str_contains(uri_string(), 'orangtua/ticket/draft') ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-file-alt"></i>

                        <p>Draft Pengajuan</p>

                    </a>
                </li>

                <!-- Tracking -->
                <li class="nav-item">
                    <a
                        href="<?= base_url('orangtua/ticket/history') ?>"
                        class="nav-link <?= (
                                            uri_string() == 'orangtua/ticket/history' ||
                                            str_contains(uri_string(), 'orangtua/ticket/detail/')
                                        ) ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-ticket-alt"></i>

                        <p>Tracking Tiket</p>

                    </a>
                </li>

                <!-- Profil -->
                <li class="nav-item">
                    <a
                        href="<?= base_url('orangtua/profile') ?>"
                        class="nav-link <?= str_contains(uri_string(), 'orangtua/profile') ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-user"></i>

                        <p>Profil</p>

                    </a>
                </li>

                <!-- Notifikasi -->
                <li class="nav-item">
                    <a
                        href="<?= base_url('orangtua/notification') ?>"
                        class="nav-link <?= str_contains(uri_string(), 'orangtua/notification') ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-bell"></i>

                        <p>Notifikasi</p>

                    </a>
                </li>

                <li class="nav-item">
                    <a
                        href="<?= base_url('orangtua/help') ?>"
                        class="nav-link <?= str_contains(uri_string(), 'orangtua/help') ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-question-circle"></i>

                        <p>Pusat Bantuan</p>

                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item">

                    <a href="<?= base_url('logout') ?>" class="nav-link">

                        <i class="nav-icon fas fa-sign-out-alt"></i>

                        <p>Logout</p>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</aside>