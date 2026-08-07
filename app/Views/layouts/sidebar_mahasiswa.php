<aside class="main-sidebar elevation-4">

    <!-- BRAND / LOGO POLBAN -->
    <a href="<?= base_url('dashboard-mahasiswa') ?>" class="brand-link">

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


    <div class="sidebar">

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column">

                <!-- DASHBOARD -->
                <li class="nav-item">

                    <a
                        href="<?= base_url('dashboard-mahasiswa') ?>"
                        class="nav-link <?= uri_string() == 'dashboard-mahasiswa' ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-home"></i>

                        <p>
                            Dashboard Mahasiswa
                        </p>

                    </a>

                </li>


                <!-- AJUKAN LAYANAN -->
                <li class="nav-item">

                    <a
                        href="<?= base_url('mahasiswa/ticket/create') ?>"
                        class="nav-link <?= uri_string() == 'mahasiswa/ticket/create' ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-plus-circle"></i>

                        <p>
                            Ajukan Layanan
                        </p>

                    </a>

                </li>


                <!-- DRAFT PENGAJUAN -->
                <li class="nav-item">

                    <a
                        href="<?= base_url('mahasiswa/ticket/draft') ?>"
                        class="nav-link <?= str_contains(uri_string(), 'mahasiswa/ticket/draft') ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-file-alt"></i>

                        <p>
                            Draft Pengajuan
                        </p>

                    </a>

                </li>


                <!-- TRACKING TIKET -->
                <li class="nav-item">

                    <a
                        href="<?= base_url('mahasiswa/ticket/history') ?>"
                        class="nav-link <?= (
                            uri_string() == 'mahasiswa/ticket/history' ||
                            str_contains(uri_string(), 'mahasiswa/ticket/detail/')
                        ) ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-ticket-alt"></i>

                        <p>
                            Tracking Tiket
                        </p>

                    </a>

                </li>


                <!-- PROFIL -->
                <li class="nav-item">

                    <a
                        href="<?= base_url('mahasiswa/profile') ?>"
                        class="nav-link <?= str_contains(uri_string(), 'mahasiswa/profile') ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-user"></i>

                        <p>
                            Profil
                        </p>

                    </a>

                </li>


                <!-- NOTIFIKASI -->
                <li class="nav-item">

                    <a
                        href="<?= base_url('mahasiswa/notification') ?>"
                        class="nav-link <?= str_contains(uri_string(), 'mahasiswa/notification') ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-bell"></i>

                        <p>
                            Notifikasi
                        </p>

                    </a>

                </li>


                <!-- PUSAT BANTUAN -->
                <li class="nav-item">

                    <a
                        href="<?= base_url('mahasiswa/help') ?>"
                        class="nav-link <?= str_contains(uri_string(), 'mahasiswa/help') ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-question-circle"></i>

                        <p>
                            Pusat Bantuan
                        </p>

                    </a>

                </li>


                <!-- LOGOUT -->
                <li class="nav-item">

                    <a
                        href="<?= base_url('logout') ?>"
                        class="nav-link text-danger"
                    >

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