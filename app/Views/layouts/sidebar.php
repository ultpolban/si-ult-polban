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

if (str_contains($uriPath, 'kemahasiswaan')) {

    $menuType = 'kemahasiswaan';

} elseif (str_contains($uriPath, 'keuangan')) {

    $menuType = 'keuangan';

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

<div class="sidebar">

    <!-- ===================================================== -->
    <!-- LOGO -->
    <!-- ===================================================== -->

    <div style="
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


    <!-- ===================================================== -->
    <!-- SIDEBAR AKADEMIK -->
    <!-- ===================================================== -->

    <?php if ($menuType === 'akademik'): ?>

        <!-- Dashboard Akademik -->

        <a
            href="<?= base_url('akademik/dashboard') ?>"
            class="nav-link <?= url_is('akademik') || url_is('akademik/dashboard') ? 'active' : '' ?>"
        >

            <i class="fas fa-building"></i>

            <span>Dashboard</span>

        </a>


        <!-- Data Tiket Akademik -->

        <a
            href="<?= base_url('akademik/data-tiket') ?>"
            class="nav-link <?= url_is('akademik/data-tiket') ? 'active' : '' ?>"
        >

            <i class="fas fa-ticket-alt"></i>

            <span>Data Tiket</span>

        </a>


        <!-- Statistik Akademik -->

        <a
            href="<?= base_url('akademik/statistik') ?>"
            class="nav-link <?= url_is('akademik/statistik') ? 'active' : '' ?>"
        >

            <i class="fas fa-chart-bar"></i>

            <span>Statistik</span>

        </a>


        <!-- Profil Akademik -->

        <a
            href="<?= base_url('akademik/profile') ?>"
            class="nav-link <?= url_is('akademik/profile') ? 'active' : '' ?>"
        >

            <i class="fas fa-user-circle"></i>

            <span>Profil</span>

        </a>


    <!-- ===================================================== -->
    <!-- SIDEBAR KEMAHASISWAAN -->
    <!-- ===================================================== -->

    <?php elseif ($menuType === 'kemahasiswaan'): ?>

        <!-- Dashboard Kemahasiswaan -->

        <a
            href="<?= base_url('kemahasiswaan/dashboard') ?>"
            class="nav-link <?= url_is('kemahasiswaan') || url_is('kemahasiswaan/dashboard') ? 'active' : '' ?>"
        >

            <i class="fas fa-user-graduate"></i>

            <span>Dashboard</span>

        </a>


        <!-- Data Tiket Kemahasiswaan -->

        <a
            href="<?= base_url('kemahasiswaan/data-tiket') ?>"
            class="nav-link <?= url_is('kemahasiswaan/data-tiket') ? 'active' : '' ?>"
        >

            <i class="fas fa-ticket-alt"></i>

            <span>Data Tiket</span>

        </a>


        <!-- Statistik Kemahasiswaan -->

        <a
            href="<?= base_url('kemahasiswaan/statistik') ?>"
            class="nav-link <?= url_is('kemahasiswaan/statistik') ? 'active' : '' ?>"
        >

            <i class="fas fa-chart-bar"></i>

            <span>Statistik</span>

        </a>


        <!-- Profil Kemahasiswaan -->

        <a
            href="<?= base_url('kemahasiswaan/profile') ?>"
            class="nav-link <?= url_is('kemahasiswaan/profile') ? 'active' : '' ?>"
        >

            <i class="fas fa-user-circle"></i>

            <span>Profil</span>

        </a>


    <!-- ===================================================== -->
    <!-- SIDEBAR KEUANGAN -->
    <!-- ===================================================== -->

    <?php elseif ($menuType === 'keuangan'): ?>

        <!-- Dashboard Keuangan -->

        <a
            href="<?= base_url('keuangan/dashboard') ?>"
            class="nav-link <?= url_is('keuangan') || url_is('keuangan/dashboard') ? 'active' : '' ?>"
        >

            <i class="fas fa-money-bill-wave"></i>

            <span>Dashboard</span>

        </a>


        <!-- Data Tiket Keuangan -->

        <a
            href="<?= base_url('keuangan/data-tiket') ?>"
            class="nav-link <?= url_is('keuangan/data-tiket') ? 'active' : '' ?>"
        >

            <i class="fas fa-ticket-alt"></i>

            <span>Data Tiket</span>

        </a>


        <!-- Statistik Keuangan -->

        <a
            href="<?= base_url('keuangan/statistik') ?>"
            class="nav-link <?= url_is('keuangan/statistik') ? 'active' : '' ?>"
        >

            <i class="fas fa-chart-bar"></i>

            <span>Statistik</span>

        </a>


        <!-- Profil Keuangan -->

        <a
            href="<?= base_url('keuangan/profile') ?>"
            class="nav-link <?= url_is('keuangan/profile') ? 'active' : '' ?>"
        >

            <i class="fas fa-user-circle"></i>

            <span>Profil</span>

        </a>

    <?php endif; ?>

</div>