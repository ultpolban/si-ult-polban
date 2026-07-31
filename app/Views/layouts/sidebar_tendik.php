<aside class="main-sidebar elevation-4">

    <!-- BRAND / LOGO POLBAN -->
    <a href="<?= base_url('dashboard-tendik') ?>" class="brand-link">

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
            "
        >

        <span
            class="brand-text font-weight-bold"
            style="
                color: white;
                font-size: 17px;
            "
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
                        href="<?= base_url('dashboard-tendik') ?>"
                        class="nav-link <?= uri_string() == 'dashboard-tendik' ? 'active' : '' ?>"
                    >

                        <i class="nav-icon fas fa-home"></i>

                        <p>
                            Dashboard Tendik
                        </p>

                    </a>

                </li>


                <!-- AJUKAN LAYANAN -->
                <li class="nav-item">

                    <a
                        href="<?= base_url('tendik/ticket/create') ?>"
                        class="nav-link <?= uri_string() == 'tendik/ticket/create' ? 'active' : '' ?>"
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
                        href="<?= base_url('tendik/ticket/draft') ?>"
                        class="nav-link <?= (
                            uri_string() == 'tendik/ticket/draft' ||
                            str_contains(
                                uri_string(),
                                'tendik/ticket/draft/edit'
                            )
                        ) ? 'active' : '' ?>"
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
                        href="<?= base_url('tendik/ticket/history') ?>"
                        class="nav-link <?= (
                            uri_string() == 'tendik/ticket/history' ||
                            str_contains(
                                uri_string(),
                                'tendik/ticket/detail/'
                            )
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
                        href="<?= base_url('tendik/profile') ?>"
                        class="nav-link <?= str_contains(
                            uri_string(),
                            'tendik/profile'
                        ) ? 'active' : '' ?>"
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
        href="<?= base_url('tendik/notification') ?>"
        class="nav-link <?= str_contains(
            uri_string(),
            'tendik/notification'
        ) ? 'active' : '' ?>"
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
                        href="<?= base_url('tendik/help') ?>"
                        class="nav-link <?= str_contains(
                            uri_string(),
                            'tendik/help'
                        ) ? 'active' : '' ?>"
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