<aside class="main-sidebar sidebar-dark-danger elevation-4">

    <!-- Logo / Brand -->
    <a href="<?= base_url('dashboard') ?>" class="brand-link">

        <span class="brand-text font-weight-light">
            SI-ULT POLBAN
        </span>

    </a>

    <div class="sidebar">

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column">

                <!-- Dashboard Pemohon -->
                <li class="nav-item">

                    <a href="<?= base_url('dashboard') ?>"
                       class="nav-link <?= uri_string() == 'dashboard' ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-home"></i>

                        <p>
                            Dashboard Pemohon
                        </p>

                    </a>

                </li>


                <!-- Ajukan Layanan -->
                <li class="nav-item">

                    <a href="<?= base_url('ticket/create') ?>"
                       class="nav-link <?= uri_string() == 'ticket/create' ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-plus-circle"></i>

                        <p>
                            Ajukan Layanan
                        </p>

                    </a>

                </li>


                <!-- Tracking Tiket -->
                <li class="nav-item">

                    <a href="<?= base_url('ticket/history') ?>"
                       class="nav-link <?= str_contains(uri_string(), 'ticket/history') ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-ticket-alt"></i>

                        <p>
                            Tracking Tiket
                        </p>

                    </a>

                </li>


                <!-- Profil -->
                <li class="nav-item">

                    <a href="<?= base_url('profile') ?>"
                       class="nav-link <?= str_contains(uri_string(), 'profile') ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-user"></i>

                        <p>
                            Profil
                        </p>

                    </a>

                </li>


                <!-- Notifikasi -->
                <li class="nav-item">

                    <a href="<?= base_url('notification') ?>"
                       class="nav-link <?= str_contains(uri_string(), 'notification') ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-bell"></i>

                        <p>
                            Notifikasi
                        </p>

                    </a>

                </li>


                <!-- Pusat Bantuan -->
                <li class="nav-item">

                    <a href="<?= base_url('help') ?>"
                       class="nav-link <?= str_contains(uri_string(), 'help') ? 'active' : '' ?>">

                        <i class="nav-icon fas fa-question-circle"></i>

                        <p>
                            Pusat Bantuan
                        </p>

                    </a>

                </li>


                <!-- Logout -->
                <li class="nav-item">

                    <a href="<?= base_url('logout') ?>"
                       class="nav-link text-danger">

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