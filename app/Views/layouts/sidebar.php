<?php

$uriPath = strtolower(
    service('request')->getUri()->getPath()
);

$roleId = (int) session()->get('role_id');

/*
|--------------------------------------------------------------------------
| Tentukan jenis menu berdasarkan URL / role
|--------------------------------------------------------------------------
*/

if (str_contains($uriPath, 'perpustakaan')) {

    $menuType = 'perpustakaan';

} elseif (str_contains($uriPath, 'jurusan')) {

    $menuType = 'jurusan';

} elseif (str_contains($uriPath, 'kemahasiswaan')) {

    $menuType = 'kemahasiswaan';

} elseif (str_contains($uriPath, 'keuangan')) {

    $menuType = 'keuangan';

} elseif (str_contains($uriPath, 'upt-tik')) {

    $menuType = 'upt-tik';

} elseif (str_contains($uriPath, 'administrasi-umum')) {

    $menuType = 'administrasi-umum';

} elseif (str_contains($uriPath, 'akademik')) {

    $menuType = 'akademik';

} elseif ($roleId === 4) {

    $menuType = 'kemahasiswaan';

} elseif ($roleId === 5) {

    $menuType = 'keuangan';

} else {

    $menuType = 'akademik';
}

?>

<?php
$displayName = session()->get('full_name')
    ?: session()->get('name')
    ?: 'Petugas';
$roleName = session()->get('role_name')
    ?: session()->get('role_code')
    ?: 'Authorized Operator';
$initials = strtoupper(substr(trim($displayName), 0, 2));
?>

<div class="sidebar">

    <!-- ===================================================== -->
    <!-- LOGO -->
    <!-- ===================================================== -->

    <div class="sidebar-brand" style="
        display:flex;
        align-items:center;
        height:70px;
        padding:8px 15px;
        gap:10px;
        color:white;
        box-sizing:border-box;
    ">

        <img
            src="<?= base_url('assets/img/logo.jpeg') ?>"
            alt="Logo POLBAN"
            style="
                width:42px;
                height:42px;
                object-fit:contain;
                border-radius:50%;
                flex-shrink:0;
                display:block;
            "
        >

        <span style="
            font-size:15px;
            font-weight:700;
            color:white;
            white-space:nowrap;
            line-height:1;
        ">
            SI-ULT POLBAN
        </span>

    </div>

    <div class="sidebar-user">
        <div class="sidebar-avatar">
            <?= esc($initials) ?>
        </div>
        <div class="sidebar-user-info">
            <strong><?= esc($displayName) ?></strong>
            <small><?= esc(ucwords(strtolower(str_replace('_', ' ', $roleName)))) ?></small>
        </div>
    </div>


    <!-- ===================================================== -->
    <!-- SIDEBAR ADMINISTRASI UMUM -->
    <!-- ===================================================== -->

    <?php if ($menuType === 'administrasi-umum'): ?>

        <div class="sidebar-section">Dashboard</div>

        <a href="<?= base_url('administrasi-umum/dashboard') ?>"
           class="nav-link <?= url_is('administrasi-umum') || url_is('administrasi-umum/dashboard') ? 'active' : '' ?>">
            <i class="fas fa-building"></i>
            <span>Dashboard Utama</span>
        </a>

        <a href="<?= base_url('administrasi-umum/profile') ?>"
           class="nav-link <?= url_is('administrasi-umum/profile') ? 'active' : '' ?>">
            <i class="fas fa-user-circle"></i>
            <span>Profil Petugas</span>
        </a>

        <div class="sidebar-section">Manajemen Tiket</div>

        <a href="<?= base_url('administrasi-umum/data-tiket') ?>"
           class="nav-link <?= url_is('administrasi-umum/data-tiket') ? 'active' : '' ?>">
            <i class="fas fa-ticket-alt"></i>
            <span>Data Tiket</span>
        </a>

        <div class="sidebar-section">Laporan &amp; Analitik</div>

        <a href="<?= base_url('administrasi-umum/statistik') ?>"
           class="nav-link <?= url_is('administrasi-umum/statistik') ? 'active' : '' ?>">
            <i class="fas fa-chart-bar"></i>
            <span>Statistik Layanan</span>
        </a>

        <a href="<?= base_url('administrasi-umum/log-aktivitas') ?>"
           class="nav-link <?= url_is('administrasi-umum/log-aktivitas') ? 'active' : '' ?>">
            <i class="fas fa-history"></i>
            <span>Log Aktivitas</span>
        </a>

    <!-- ===================================================== -->
    <!-- SIDEBAR UPT TIK -->
    <!-- ===================================================== -->

    <?php elseif ($menuType === 'upt-tik'): ?>

        <div class="sidebar-section">Dashboard</div>

        <a href="<?= base_url('upt-tik/dashboard') ?>"
           class="nav-link <?= url_is('upt-tik') || url_is('upt-tik/dashboard') ? 'active' : '' ?>">
            <i class="fas fa-network-wired"></i>
            <span>Dashboard Utama</span>
        </a>

        <a href="<?= base_url('upt-tik/profile') ?>"
           class="nav-link <?= url_is('upt-tik/profile') ? 'active' : '' ?>">
            <i class="fas fa-user-circle"></i>
            <span>Profil Petugas</span>
        </a>

        <div class="sidebar-section">Manajemen Tiket</div>

        <a href="<?= base_url('upt-tik/data-tiket') ?>"
           class="nav-link <?= url_is('upt-tik/data-tiket') ? 'active' : '' ?>">
            <i class="fas fa-ticket-alt"></i>
            <span>Data Tiket</span>
        </a>

        <div class="sidebar-section">Laporan &amp; Analitik</div>

        <a href="<?= base_url('upt-tik/statistik') ?>"
           class="nav-link <?= url_is('upt-tik/statistik') ? 'active' : '' ?>">
            <i class="fas fa-chart-bar"></i>
            <span>Statistik Layanan</span>
        </a>

        <a href="<?= base_url('upt-tik/log-aktivitas') ?>"
           class="nav-link <?= url_is('upt-tik/log-aktivitas') ? 'active' : '' ?>">
            <i class="fas fa-history"></i>
            <span>Log Aktivitas</span>
        </a>

    <!-- ===================================================== -->
    <!-- SIDEBAR AKADEMIK -->
    <!-- ===================================================== -->

    <?php elseif ($menuType === 'akademik'): ?>

        <div class="sidebar-section">Dashboard</div>

        <!-- Dashboard Akademik -->

        <a
            href="<?= base_url('akademik/dashboard') ?>"
            class="nav-link <?= url_is('akademik') || url_is('akademik/dashboard') ? 'active' : '' ?>"
        >

            <i class="fas fa-building"></i>

            <span>Dashboard Utama</span>

        </a>


        <!-- Profil Akademik -->

        <a
            href="<?= base_url('akademik/profile') ?>"
            class="nav-link <?= url_is('akademik/profile') ? 'active' : '' ?>"
        >

            <i class="fas fa-user-circle"></i>

            <span>Profil Petugas</span>

        </a>


        <div class="sidebar-section">Manajemen Tiket</div>

        <!-- Data Tiket Akademik -->

        <a
            href="<?= base_url('akademik/data-tiket') ?>"
            class="nav-link <?= url_is('akademik/data-tiket') ? 'active' : '' ?>"
        >

            <i class="fas fa-ticket-alt"></i>

            <span>Data Tiket</span>

        </a>


        <div class="sidebar-section">Laporan &amp; Analitik</div>

        <!-- Statistik Akademik -->

        <a
            href="<?= base_url('akademik/statistik') ?>"
            class="nav-link <?= url_is('akademik/statistik') ? 'active' : '' ?>"
        >

            <i class="fas fa-chart-bar"></i>

            <span>Statistik Layanan</span>

        </a>


        <!-- Log Aktivitas Akademik -->

        <a
            href="<?= base_url('akademik/log-aktivitas') ?>"
            class="nav-link <?= url_is('akademik/log-aktivitas') ? 'active' : '' ?>"
        >

            <i class="fas fa-history"></i>

            <span>Log Aktivitas</span>

        </a>


    <!-- ===================================================== -->
    <!-- SIDEBAR KEMAHASISWAAN -->
    <!-- ===================================================== -->

    <?php elseif ($menuType === 'kemahasiswaan'): ?>

        <div class="sidebar-section">Dashboard</div>

        <!-- Dashboard Kemahasiswaan -->

        <a
            href="<?= base_url('kemahasiswaan/dashboard') ?>"
            class="nav-link <?= url_is('kemahasiswaan') || url_is('kemahasiswaan/dashboard') ? 'active' : '' ?>"
        >

            <i class="fas fa-user-graduate"></i>

            <span>Dashboard Utama</span>

        </a>

        <!-- Profil Kemahasiswaan -->

        <a
            href="<?= base_url('kemahasiswaan/profile') ?>"
            class="nav-link <?= url_is('kemahasiswaan/profile') ? 'active' : '' ?>"
        >

            <i class="fas fa-user-circle"></i>

            <span>Profil Petugas</span>

        </a>


        <div class="sidebar-section">Manajemen Tiket</div>

        <!-- Data Tiket Kemahasiswaan -->

        <a
            href="<?= base_url('kemahasiswaan/data-tiket') ?>"
            class="nav-link <?= url_is('kemahasiswaan/data-tiket') ? 'active' : '' ?>"
        >

            <i class="fas fa-ticket-alt"></i>

            <span>Data Tiket</span>

        </a>


        <div class="sidebar-section">Laporan &amp; Analitik</div>

        <!-- Statistik Kemahasiswaan -->

        <a
            href="<?= base_url('kemahasiswaan/statistik') ?>"
            class="nav-link <?= url_is('kemahasiswaan/statistik') ? 'active' : '' ?>"
        >

            <i class="fas fa-chart-bar"></i>

            <span>Statistik Layanan</span>

        </a>


        <!-- Log Aktivitas Kemahasiswaan -->

        <a
            href="<?= base_url('kemahasiswaan/log-aktivitas') ?>"
            class="nav-link <?= url_is('kemahasiswaan/log-aktivitas') ? 'active' : '' ?>"
        >

            <i class="fas fa-history"></i>

            <span>Log Aktivitas</span>

        </a>


    <!-- ===================================================== -->
    <!-- SIDEBAR KEUANGAN -->
    <!-- ===================================================== -->

    <?php elseif ($menuType === 'keuangan'): ?>

        <div class="sidebar-section">Dashboard</div>

        <!-- Dashboard Keuangan -->

        <a
            href="<?= base_url('keuangan/dashboard') ?>"
            class="nav-link <?= url_is('keuangan') || url_is('keuangan/dashboard') ? 'active' : '' ?>"
        >

            <i class="fas fa-money-bill-wave"></i>

            <span>Dashboard Utama</span>

        </a>

        <!-- Profil Keuangan -->

        <a
            href="<?= base_url('keuangan/profile') ?>"
            class="nav-link <?= url_is('keuangan/profile') ? 'active' : '' ?>"
        >

            <i class="fas fa-user-circle"></i>

            <span>Profil Petugas</span>

        </a>


        <div class="sidebar-section">Manajemen Tiket</div>

        <!-- Data Tiket Keuangan -->

        <a
            href="<?= base_url('keuangan/data-tiket') ?>"
            class="nav-link <?= url_is('keuangan/data-tiket') ? 'active' : '' ?>"
        >

            <i class="fas fa-ticket-alt"></i>

            <span>Data Tiket</span>

        </a>


        <div class="sidebar-section">Laporan &amp; Analitik</div>

        <!-- Statistik Keuangan -->

        <a
            href="<?= base_url('keuangan/statistik') ?>"
            class="nav-link <?= url_is('keuangan/statistik') ? 'active' : '' ?>"
        >

            <i class="fas fa-chart-bar"></i>

            <span>Statistik Layanan</span>

        </a>


        <!-- Log Aktivitas Keuangan -->

        <a
            href="<?= base_url('keuangan/log-aktivitas') ?>"
            class="nav-link <?= url_is('keuangan/log-aktivitas') ? 'active' : '' ?>"
        >

            <i class="fas fa-history"></i>

            <span>Log Aktivitas</span>

        </a>


    <!-- ===================================================== -->
    <!-- SIDEBAR JURUSAN -->
    <!-- ===================================================== -->

    <?php elseif ($menuType === 'jurusan'): ?>

        <div class="sidebar-section">Dashboard</div>

        <a
            href="<?= base_url('jurusan/dashboard') ?>"
            class="nav-link <?= url_is('jurusan') || url_is('jurusan/dashboard') ? 'active' : '' ?>"
        >

            <i class="fas fa-university"></i>

            <span>Dashboard Utama</span>

        </a>

        <a
            href="<?= base_url('jurusan/profile') ?>"
            class="nav-link <?= url_is('jurusan/profile') ? 'active' : '' ?>"
        >

            <i class="fas fa-user-circle"></i>

            <span>Profil Petugas</span>

        </a>


        <div class="sidebar-section">Manajemen Tiket</div>

        <a
            href="<?= base_url('jurusan/data-tiket') ?>"
            class="nav-link <?= url_is('jurusan/data-tiket') ? 'active' : '' ?>"
        >

            <i class="fas fa-ticket-alt"></i>

            <span>Data Tiket</span>

        </a>


        <div class="sidebar-section">Laporan &amp; Analitik</div>

        <a
            href="<?= base_url('jurusan/statistik') ?>"
            class="nav-link <?= url_is('jurusan/statistik') ? 'active' : '' ?>"
        >

            <i class="fas fa-chart-bar"></i>

            <span>Statistik Layanan</span>

        </a>

        <a
            href="<?= base_url('jurusan/log-aktivitas') ?>"
            class="nav-link <?= url_is('jurusan/log-aktivitas') ? 'active' : '' ?>"
        >

            <i class="fas fa-history"></i>

            <span>Log Aktivitas</span>

        </a>


    <!-- ===================================================== -->
    <!-- SIDEBAR PERPUSTAKAAN -->
    <!-- ===================================================== -->

    <?php elseif ($menuType === 'perpustakaan'): ?>

        <div class="sidebar-section">Dashboard</div>

        <a
            href="<?= base_url('perpustakaan/dashboard') ?>"
            class="nav-link <?= url_is('perpustakaan') || url_is('perpustakaan/dashboard') ? 'active' : '' ?>"
        >

            <i class="fas fa-book"></i>

            <span>Dashboard Utama</span>

        </a>

        <a
            href="<?= base_url('perpustakaan/profile') ?>"
            class="nav-link <?= url_is('perpustakaan/profile') ? 'active' : '' ?>"
        >

            <i class="fas fa-user-circle"></i>

            <span>Profil Petugas</span>

        </a>


        <div class="sidebar-section">Manajemen Tiket</div>

        <a
            href="<?= base_url('perpustakaan/data-tiket') ?>"
            class="nav-link <?= url_is('perpustakaan/data-tiket') ? 'active' : '' ?>"
        >

            <i class="fas fa-ticket-alt"></i>

            <span>Data Tiket</span>

        </a>




        <div class="sidebar-section">Laporan &amp; Analitik</div>

        <a
            href="<?= base_url('perpustakaan/statistik') ?>"
            class="nav-link <?= url_is('perpustakaan/statistik') ? 'active' : '' ?>"
        >

            <i class="fas fa-chart-bar"></i>

            <span>Statistik Layanan</span>

        </a>

        <a
            href="<?= base_url('perpustakaan/log-aktivitas') ?>"
            class="nav-link <?= url_is('perpustakaan/log-aktivitas') ? 'active' : '' ?>"
        >

            <i class="fas fa-history"></i>

            <span>Log Aktivitas</span>

        </a>


    <?php endif; ?>

    <div class="sidebar-logout">
        <a
            href="<?= base_url('logout') ?>"
            class="nav-link"
            onclick="return confirm('Apakah Anda yakin ingin logout?')"
        >
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </div>

</div>