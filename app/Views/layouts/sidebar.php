[cite: 3]<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?= base_url('petugas') ?>"
       class="brand-link text-center"
       style="background:#2B2E83;border-bottom:1px solid rgba(255,255,255,.15);">

        <img src="<?= base_url('assets/img/logo-polban.png') ?>"
             alt="POLBAN"
             class="brand-image img-circle elevation-3"
             style="opacity:.9">

        <span class="brand-text font-weight-bold text-white">
            SI-ULT POLBAN
        </span>

    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">
                <img src="https://ui-avatars.com/api/?name=Petugas&background=005BAC&color=fff"
                     class="img-circle elevation-2">
            </div>

            <div class="info">
                <a href="#" class="d-block">
                    Petugas ULT
                </a>
            </div>

        </div>

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu">

                <li class="nav-item">
                    <a href="<?= base_url('petugas/profile') ?>" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profil</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('petugas') ?>" class="nav-link <?= url_is('petugas') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Data Tiket dengan Badge -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/tiket') ?>" class="nav-link <?= (url_is('petugas/tiket*') && !isset($_GET['status'])) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>Data Tiket</p>
                        <span class="badge badge-primary float-right" id="sidebar-badge-tiket">0</span>
                    </a>
                </li>

                <!-- Verifikasi Tiket dengan Badge -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/tiket?status=Submitted') ?>" class="nav-link <?= (isset($_GET['status']) && $_GET['status'] == 'Submitted') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>Verifikasi Tiket</p>
                        <span class="badge badge-warning float-right text-white" id="sidebar-badge-verifikasi">0</span>
                    </a>
                </li>

                <!-- Disposisi Tiket dengan Badge -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/tiket?status=Verified') ?>" class="nav-link <?= (isset($_GET['status']) && $_GET['status'] == 'Verified') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-share-square"></i>
                        <p>Disposisi Tiket</p>
                        <span class="badge badge-info float-right" id="sidebar-badge-disposisi">0</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('petugas/laporan-tamu') ?>" class="nav-link <?= url_is('petugas/laporan-tamu*') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Laporan Tamu</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('petugas/statistik-tiket') ?>" class="nav-link <?= url_is('petugas/statistik-tiket*') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Statistik Tiket</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('petugas/laporan-tiket') ?>" class="nav-link <?= url_is('petugas/laporan-tiket*') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Laporan Tiket</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('petugas/tracking-tiket') ?>" class="nav-link <?= url_is('petugas/tracking-tiket*') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-route"></i>
                        <p>Tracking Tiket</p>
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