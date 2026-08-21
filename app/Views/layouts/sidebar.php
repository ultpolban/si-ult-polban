<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="<?= base_url('dashboard') ?>" class="brand-link">
        <span class="brand-text font-weight-light">
            SI ULT POLBAN
        </span>
    </a>

    <!-- Sidebar Menu -->
    <div class="sidebar">

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                
                <!-- Profil -->
                <li class="nav-item">
                    <a href="<?= base_url('profile') ?>" class="nav-link <?= uri_string() == 'profile' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profil</p>
                    </a>
                </li>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link <?= uri_string() == 'dashboard' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <?php if (hasRole(1)): ?>
                    <!-- Data Tiket -->
                    <li class="nav-item">
                        <a href="<?= base_url('datatiket') ?>" class="nav-link <?= uri_string() == 'datatiket' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-ticket-alt"></i>
                            <p>
                                Data Tiket
                                <?php if (isset($total_tiket) && $total_tiket > 0): ?>
                                    <span class="right badge badge-primary">
                                        <?= $total_tiket ?>
                                    </span>
                                <?php endif; ?>
                            </p>
                        </a>
                    </li>

                    <!-- Verifikasi Tiket -->
                    <li class="nav-item">
                        <a href="<?= base_url('verification') ?>" class="nav-link <?= uri_string() == 'verification' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-check-circle"></i>
                            <p>
                                Verifikasi Tiket
                                <?php if (isset($submitted) && $submitted > 0): ?>
                                    <span class="right badge badge-danger">
                                        <?= $submitted ?>
                                    </span>
                                <?php endif; ?>
                            </p>
                        </a>
                    </li>

                    <!-- Disposisi Tiket -->
                    <li class="nav-item">
                        <a href="<?= base_url('disposition') ?>" class="nav-link <?= uri_string() == 'disposition' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-share"></i>
                            <p>Disposisi Tiket</p>
                        </a>
                    </li>

                    <!-- Laporan Tamu -->
                    <li class="nav-item">
                        <a href="<?= base_url('guest-report') ?>" class="nav-link <?= uri_string() == 'guest-report' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Laporan Tamu</p>
                        </a>
                    </li>

                    <!-- Statistik Tiket -->
                    <li class="nav-item">
                        <a href="<?= base_url('statistics') ?>" class="nav-link <?= uri_string() == 'statistics' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Statistik Tiket</p>
                        </a>
                    </li>

                    <!-- Laporan Tiket -->
                    <li class="nav-item">
                        <a href="<?= base_url('report') ?>" class="nav-link <?= uri_string() == 'report' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Laporan Tiket</p>
                        </a>
                    </li>

                    <!-- Tracking Tiket -->
                    <li class="nav-item">
                        <a href="<?= base_url('tracking') ?>" class="nav-link <?= uri_string() == 'tracking' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-search"></i>
                            <p>Tracking Tiket</p>
                        </a>
                    </li>

                    <!-- Log Aktivitas (DITAMBAHKAN DI SINI) -->
                    <li class="nav-item">
                        <a href="<?= base_url('log-aktivitas') ?>" class="nav-link <?= uri_string() == 'log-aktivitas' ? 'active' : '' ?>">
                            <i class="nav-icon fas fa-history"></i>
                            <p>Log Aktivitas</p>
                        </a>
                    </li>

                <?php endif; ?>

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