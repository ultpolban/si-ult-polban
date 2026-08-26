<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="<?= base_url('petugas') ?>" class="brand-link py-3 text-decoration-none d-flex align-items-center" style="background: rgba(0, 0, 0, 0.25); border-bottom: 1px solid rgba(255, 255, 255, 0.12);">
        <img src="<?= base_url('assets/img/logo-polban.png') ?>"
             alt="POLBAN Logo"
             class="brand-image img-circle elevation-3 ml-3"
             style="opacity: .95; max-height: 34px; width: 34px; object-fit: contain;">

        <span class="brand-text font-weight-bold text-white ml-2" style="font-size: 1.1rem; letter-spacing: 0.5px;">
            SI-ULT POLBAN
        </span>
    </a>

    <!-- Sidebar Wrapper -->
    <div class="sidebar px-2 pt-2">

        <!-- User Panel -->
        <div class="user-panel mt-2 pb-3 mb-3 d-flex align-items-center" style="border-bottom: 1px solid rgba(255, 255, 255, 0.12);">
            <div class="image position-relative">
                <img src="https://ui-avatars.com/api/?name=Petugas+ULT&background=4f46e5&color=fff"
                     class="img-circle elevation-2" alt="Avatar Petugas" style="width: 40px; height: 40px; object-fit: cover;">
                <span class="position-absolute bg-success border border-white rounded-circle" style="width: 10px; height: 10px; bottom: 0; right: 0;"></span>
            </div>
            <div class="info ml-2">
                <a href="<?= base_url('petugas/profile') ?>" class="d-block text-white font-weight-bold text-decoration-none" style="font-size: 0.92rem;">
                    Petugas ULT
                </a>
                <span class="d-block text-muted" style="font-size: 0.73rem; color: #a5b4fc !important;">
                    <i class="fas fa-shield-alt text-warning mr-1"></i> Authorized Operator
                </span>
            </div>
        </div>

        <!-- Sidebar Navigation Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas') ?>" class="nav-link <?= url_is('petugas') ? 'active' : '' ?>" title="Dashboard Utama">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard Utama</p>
                    </a>
                </li>

                <!-- Profil -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/profile') ?>" class="nav-link <?= url_is('petugas/profile*') ? 'active' : '' ?>" title="Profil Petugas">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Profil Petugas</p>
                    </a>
                </li>

                <!-- Header: Manajemen Tiket -->
                <li class="nav-header text-uppercase font-weight-bold text-muted" style="font-size: 0.68rem; letter-spacing: 1px; padding: 12px 10px 4px 10px;">
                    Manajemen Tiket ULT
                </li>

                <!-- Data Tiket -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/tiket') ?>" class="nav-link <?= (url_is('petugas/tiket*') && !isset($_GET['status'])) ? 'active' : '' ?>" title="Data Tiket">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>
                            Data Tiket
                            <span class="badge badge-light text-dark right font-weight-bold" id="sidebar-badge-tiket">0</span>
                        </p>
                    </a>
                </li>

                <!-- Verifikasi Tiket -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/tiket?status=Submitted') ?>" class="nav-link <?= (isset($_GET['status']) && $_GET['status'] == 'Submitted') ? 'active' : '' ?>" title="Verifikasi Tiket">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>
                            Verifikasi Tiket
                            <span class="badge badge-warning right font-weight-bold" id="sidebar-badge-verifikasi">0</span>
                        </p>
                    </a>
                </li>

                <!-- Disposisi Tiket -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/tiket?status=Verified') ?>" class="nav-link <?= (isset($_GET['status']) && $_GET['status'] == 'Verified') ? 'active' : '' ?>" title="Disposisi Tiket">
                        <i class="nav-icon fas fa-share-square"></i>
                        <p>
                            Disposisi Tiket
                            <span class="badge badge-info right font-weight-bold" id="sidebar-badge-disposisi">0</span>
                        </p>
                    </a>
                </li>

                <!-- Header: Laporan & Analitik -->
                <li class="nav-header text-uppercase font-weight-bold text-muted" style="font-size: 0.68rem; letter-spacing: 1px; padding: 12px 10px 4px 10px;">
                    Laporan & Analitik
                </li>

                <!-- Laporan Tamu -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/laporan-tamu') ?>" class="nav-link <?= url_is('petugas/laporan-tamu*') ? 'active' : '' ?>" title="Laporan Tamu ULT">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Laporan Tamu ULT</p>
                    </a>
                </li>

                <!-- Statistik Layanan -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/statistik-tiket') ?>" class="nav-link <?= url_is('petugas/statistik-tiket*') ? 'active' : '' ?>" title="Statistik Layanan">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Statistik Layanan</p>
                    </a>
                </li>

                <!-- Laporan Tiket -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/laporan-tiket') ?>" class="nav-link <?= url_is('petugas/laporan-tiket*') ? 'active' : '' ?>" title="Laporan Tiket">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>Laporan Tiket</p>
                    </a>
                </li>

                <!-- Tracking Tiket -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/tracking-tiket') ?>" class="nav-link <?= url_is('petugas/tracking-tiket*') ? 'active' : '' ?>" title="Tracking Tiket">
                        <i class="nav-icon fas fa-route"></i>
                        <p>Tracking Tiket</p>
                    </a>
                </li>

                <!-- Log Aktivitas -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/log-aktivitas') ?>" class="nav-link <?= url_is('petugas/log-aktivitas*') ? 'active' : '' ?>" title="Log Aktivitas">
                        <i class="nav-icon fas fa-history text-info"></i>
                        <p>Log Aktivitas</p>
                    </a>
                </li>

                <!-- Logout -->
                <li class="nav-item mt-3 mb-4">
                    <a href="<?= base_url('logout') ?>" class="nav-link" title="Keluar Aplikasi" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3);">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p class="font-weight-bold text-danger">Keluar Aplikasi</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>

<!-- JAVASCRIPT BADGE DYNAMIC -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(() => {
        const verifBadgeEl = document.getElementById('sidebar-badge-verifikasi');
        const tiketBadgeEl = document.getElementById('sidebar-badge-tiket');
        const disposisiBadgeEl = document.getElementById('sidebar-badge-disposisi');

        const navCountEl = document.getElementById('cosmicBadgeCount');
        let initialVal = navCountEl ? parseInt(navCountEl.innerText) || 9 : 9;

        if (verifBadgeEl && verifBadgeEl.innerText === '0') {
            verifBadgeEl.innerText = initialVal;
        }
        if (tiketBadgeEl && tiketBadgeEl.innerText === '0') {
            tiketBadgeEl.innerText = 33;
        }
        if (disposisiBadgeEl && disposisiBadgeEl.innerText === '0') {
            disposisiBadgeEl.innerText = 7;
        }
    }, 150);
});
</script>