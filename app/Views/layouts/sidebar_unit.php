<!-- Main Sidebar -->
<aside class="main-sidebar elevation-4">

    <!-- Logo -->
    <a href="<?= base_url('unit') ?>" class="brand-link text-center">

        <img src="<?= base_url('assets/img/logo-polban.png') ?>"
             class="brand-image img-circle elevation-3"
             style="opacity:.9">

        <span class="brand-text font-weight-bold">
            SI-ULT POLBAN
        </span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- User -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">

                <img src="https://ui-avatars.com/api/?name=Unit&background=005BAC&color=fff"
                     class="img-circle elevation-2">

            </div>

            <div class="info">

                <a href="#" class="d-block">

                    Unit Tujuan

                </a>

            </div>

        </div>

        <!-- Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu">

                <li class="nav-item">

                    <a href="<?= base_url('unit') ?>" class="nav-link">

                        <i class="nav-icon fas fa-home"></i>

                        <p>Dashboard</p>

                    </a>

                </li>

                <li class="nav-item">

                   <a href="<?= base_url('unit/tiket') ?>" class="nav-link">
                        <i class="nav-icon fas fa-ticket-alt"></i>

                        <p>Data Tiket</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('unit/update-status/1') ?>" class="nav-link">

                        <i class="nav-icon fas fa-sync-alt"></i>

                        <p>Update Status</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('unit/laporan') ?>" class="nav-link">

                        <i class="nav-icon fas fa-chart-bar"></i>

                        <p>Laporan</p>

                    </a>

                </li>

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