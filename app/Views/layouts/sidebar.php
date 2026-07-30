<!-- Main Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">


    <!-- Logo -->
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

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- User -->
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

        <!-- Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu">

                <li class="nav-item">
                    <a href="<?= base_url('petugas') ?>" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('petugas/tiket') ?>" class="nav-link">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>Data Tiket</p>
                    </a>
                </li>

                <li class="nav-item">
    <a href="<?= base_url('petugas/tiket?status=Submitted') ?>" class="nav-link">
        <i class="nav-icon fas fa-user-check"></i>
        <p>Verifikasi Tiket</p>
    </a>
</li>

                <li class="nav-item">
    <a href="<?= base_url('petugas/tiket?status=Verified') ?>" class="nav-link">
        <i class="nav-icon fas fa-share-square"></i>
        <p>Disposisi</p>
    </a>
</li>

                <!-- Laporan Tamu -->
<li class="nav-item">
    <a href="<?= base_url('petugas/laporan-tamu') ?>" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Laporan Tamu</p>
    </a>
</li>

<!-- Statistik Tiket -->
<li class="nav-item">
    <a href="<?= base_url('petugas/statistik-tiket') ?>" class="nav-link">
        <i class="nav-icon fas fa-chart-pie"></i>
        <p>Statistik Tiket</p>
    </a>
</li>

<!-- Laporan Tiket -->
<li class="nav-item">
    <a href="<?= base_url('petugas/laporan-tiket') ?>" class="nav-link">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>Laporan Tiket</p>
    </a>
</li>

<!-- Tracking Tiket -->
<li class="nav-item">
    <a href="<?= base_url('petugas/tracking-tiket') ?>" class="nav-link">
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