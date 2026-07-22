<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?= base_url('dashboard') ?>" class="brand-link">
        <span class="brand-text font-weight-light">
            SI ULT POLBAN
        </span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <?php if (hasRole(1)): ?>

                    <!-- Manajemen User -->
                    <li class="nav-item">
                        <a href="<?= base_url('users') ?>" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Manajemen User</p>
                        </a>
                    </li>

                    <!-- Verifikasi Tiket -->
                    <li class="nav-item">
                        <a href="<?= base_url('verification') ?>" class="nav-link">
                            <i class="nav-icon fas fa-check-circle"></i>
                            <p>Verifikasi Tiket</p>
                        </a>
                    </li>

                    <!-- Laporan Tiket -->
                    <li class="nav-item">
                        <a href="<?= base_url('report') ?>" class="nav-link">
                            <i class="nav-icon fas fa-file-alt"></i>
                            <p>Laporan Tiket</p>
                        </a>
                    </li>

                    <!-- Statistik Tiket -->
                    <li class="nav-item">
                        <a href="<?= base_url('statistics') ?>" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>Statistik Tiket</p>
                        </a>
                    </li>

                    <!-- Laporan Tamu -->
                    <li class="nav-item">
                        <a href="<?= base_url('guest-report') ?>" class="nav-link">
                            <i class="nav-icon fas fa-clipboard-list"></i>
                            <p>Laporan Tamu</p>
                        </a>
                    </li>

                    <!-- Tracking Tiket -->
                    <li class="nav-item">
                        <a href="<?= base_url('tracking') ?>" class="nav-link">
                            <i class="nav-icon fas fa-search"></i>
                            <p>Tracking Tiket</p>
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