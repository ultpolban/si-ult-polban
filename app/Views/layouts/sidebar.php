<!-- ========================================================================= -->
<!-- SIDEBAR UTAMA - SI-ULT POLBAN (COSMIC-TIER ENTERPRISE EDITION)            -->
<!-- ========================================================================= -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background: linear-gradient(180deg, #0d1242 0%, #1a237e 40%, #090d38 100%); border-right: 1px solid rgba(255,255,255,0.08); transition: width 0.3s ease-in-out;">

    <!-- Brand Logo Sidebar Interaktif -->
    <a href="<?= base_url('petugas') ?>"
       class="brand-link text-center py-3.5 text-decoration-none"
       style="background: rgba(0, 0, 0, 0.3); border-bottom: 1px solid rgba(255, 255, 255, 0.12);">

        <div class="d-inline-flex align-items-center justify-content-center">
            <img src="<?= base_url('assets/img/logo-polban.png') ?>"
                 alt="POLBAN Logo"
                 class="brand-image img-circle elevation-3 mr-2"
                 style="opacity: .95; float: none; max-height: 38px; width: 38px; object-fit: contain;">

            <span class="brand-text font-weight-bold text-white" style="font-size: 1.12rem; letter-spacing: 0.8px; text-shadow: 0 2px 5px rgba(0,0,0,0.4);">
                SI-ULT POLBAN
            </span>
        </div>
    </a>

    <!-- Sidebar Wrapper Container dengan Penyesuaian Padding Kanan -->
    <div class="sidebar" style="overflow-x: hidden; padding-left: 14px; padding-right: 14px; padding-top: 16px; padding-bottom: 16px;">

        <!-- Panel Info User / Petugas -->
        <div class="user-panel mt-1 pb-3 mb-3 d-flex align-items-center" style="border-bottom: 1px solid rgba(255, 255, 255, 0.12);">
            <div class="image position-relative">
                <img src="https://ui-avatars.com/api/?name=Petugas+ULT&background=4f46e5&color=fff"
                     class="img-circle elevation-2" alt="Avatar Petugas" style="width: 42px; height: 42px; object-fit: cover;">
                <span class="position-absolute bottom-0 right-0 p-1 bg-success border border-white rounded-circle" style="width: 11px; height: 11px; bottom: 0; right: 0;"></span>
            </div>
            <div class="info ml-2.5">
                <a href="<?= base_url('petugas/profile') ?>" class="d-block text-white font-weight-bold text-decoration-none" style="font-size: 0.94rem; letter-spacing: 0.3px;">
                    Petugas ULT
                </a>
                <span class="d-block text-muted d-flex align-items-center mt-0.5" style="font-size: 0.74rem; color: #a5b4fc !important;">
                    <i class="fas fa-shield-alt text-warning mr-1" style="font-size: 0.65rem;"></i> Authorized Operator
                </span>
            </div>
        </div>

        <!-- Sidebar Navigation Menu -->
        <nav class="mt-2" style="width: 100%;">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                style="gap: 6px; width: 100%;">

                <!-- KODE CSS CUSTOM SIDEBAR (JARAK AMAN KANAN & WARNA ORANYE AKTIF) -->
                <style>
                /* Memastikan elemen ul & nav mengisi lebar dengan aman dari scrollbar */
                .sidebar {
                    box-sizing: border-box;
                }
                .nav-sidebar .nav-item {
                    width: 100%;
                }
                .nav-sidebar .nav-item .nav-link {
                    border-radius: 12px !important;
                    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                    color: rgba(255, 255, 255, 0.82);
                    padding: 11px 14px;
                    border: 1px solid transparent;
                    display: flex;
                    align-items: center;
                    width: 100%;
                    box-sizing: border-box;
                }
                .nav-sidebar .nav-item .nav-link p {
                    margin: 0;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    flex-grow: 1;
                }
                .nav-sidebar .nav-item .nav-link:hover {
                    background-color: rgba(255, 255, 255, 0.08);
                    color: #ffffff;
                    transform: translateX(3px);
                    border-color: rgba(255, 255, 255, 0.1);
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
                }
                /* Warna Menu Aktif: Oranye Elegan */
                .nav-sidebar .nav-item .nav-link.active {
                    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
                    color: #ffffff !important;
                    box-shadow: 0 6px 18px rgba(245, 158, 11, 0.4);
                    font-weight: 700;
                    border-color: rgba(255, 255, 255, 0.25);
                }
                .nav-sidebar .nav-item .nav-link .nav-icon {
                    font-size: 1.05rem;
                    margin-right: 12px;
                    color: #c7d2fe;
                    transition: all 0.3s ease;
                    min-width: 20px;
                    text-align: center;
                }
                .nav-sidebar .nav-item .nav-link.active .nav-icon {
                    color: #ffffff;
                    transform: scale(1.1);
                }
                .cosmic-sidebar-header {
                    font-size: 0.68rem;
                    text-transform: uppercase;
                    letter-spacing: 1.5px;
                    color: #94a3b8;
                    padding: 14px 8px 6px 8px;
                    font-weight: 800;
                }
                .sidebar-dynamic-badge {
                    font-size: 0.7rem;
                    font-weight: 800;
                    padding: 0.3em 0.6em;
                    border-radius: 6px;
                    margin-left: 8px;
                    flex-shrink: 0;
                    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
                }
                /* Styling Scrollbar Sidebar agar Berjarak Jauh dari Menu */
                .sidebar::-webkit-scrollbar {
                    width: 5px;
                }
                .sidebar::-webkit-scrollbar-track {
                    background: transparent;
                }
                .sidebar::-webkit-scrollbar-thumb {
                    background: rgba(255, 255, 255, 0.25);
                    border-radius: 10px;
                }
                .sidebar::-webkit-scrollbar-thumb:hover {
                    background: rgba(255, 255, 255, 0.45);
                }
                </style>

                <!-- Menu Utama: Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas') ?>" class="nav-link <?= url_is('petugas') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard Utama</p>
                    </a>
                </li>

                <!-- Menu Utama: Profil -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/profile') ?>" class="nav-link <?= url_is('petugas/profile*') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Profil Petugas</p>
                    </a>
                </li>

                <!-- Header Section: Manajemen Tiket -->
                <li class="nav-header cosmic-sidebar-header">Manajemen Tiket ULT</li>

                <!-- Data Tiket -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/tiket') ?>" class="nav-link <?= (url_is('petugas/tiket*') && !isset($_GET['status'])) ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>Data Tiket</p>
                        <span class="badge badge-light text-primary sidebar-dynamic-badge" id="sidebar-badge-tiket">0</span>
                    </a>
                </li>

                <!-- Verifikasi Tiket -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/tiket?status=Submitted') ?>" class="nav-link <?= (isset($_GET['status']) && $_GET['status'] == 'Submitted') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>Verifikasi Tiket</p>
                        <span class="badge sidebar-dynamic-badge" id="sidebar-badge-verifikasi" style="background-color: #fbbf24; color: #1e293b !important;">0</span>
                    </a>
                </li>

                <!-- Disposisi Tiket -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/tiket?status=Verified') ?>" class="nav-link <?= (isset($_GET['status']) && $_GET['status'] == 'Verified') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-share-square"></i>
                        <p>Disposisi Tiket</p>
                        <span class="badge text-white sidebar-dynamic-badge" id="sidebar-badge-disposisi" style="background-color: #0ea5e9;">0</span>
                    </a>
                </li>

                <!-- Header Section: Laporan & Statistik -->
                <li class="nav-header cosmic-sidebar-header">Laporan & Analitik</li>

                <!-- Laporan Tamu -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/laporan-tamu') ?>" class="nav-link <?= url_is('petugas/laporan-tamu*') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Laporan Tamu ULT</p>
                    </a>
                </li>

                <!-- Statistik Tiket -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/statistik-tiket') ?>" class="nav-link <?= url_is('petugas/statistik-tiket*') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Statistik Layanan</p>
                    </a>
                </li>

                <!-- Laporan Tiket -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/laporan-tiket') ?>" class="nav-link <?= url_is('petugas/laporan-tiket*') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>Laporan Tiket</p>
                    </a>
                </li>

                <!-- Tracking Tiket -->
                <li class="nav-item">
                    <a href="<?= base_url('petugas/tracking-tiket') ?>" class="nav-link <?= url_is('petugas/tracking-tiket*') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-route"></i>
                        <p>Tracking Tiket</p>
                    </a>
                </li>

                <!-- Tombol Keluar Sistem Khusus -->
                <li class="nav-item mt-4 mb-3">
                    <a href="<?= base_url('logout') ?>" class="nav-link text-white" style="background: rgba(239, 68, 68, 0.15); border: 1px solid rgba(239, 68, 68, 0.3); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(239,68,68,0.3)'" onmouseout="this.style.background='rgba(239,68,68,0.15)'">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p class="font-weight-bold text-danger">Keluar Aplikasi</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>

<!-- JAVASCRIPT DINAMIS PENGISI BADGE SIDEBAR OTOMATIS -->
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