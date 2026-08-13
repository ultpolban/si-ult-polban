<?php
$uriPath = strtolower(service('request')->getUri()->getPath());
$roleId = (int) session()->get('role_id');

if (str_contains($uriPath, 'kemahasiswaan')) {
    $menuType = 'kemahasiswaan';
} elseif (str_contains($uriPath, 'keuangan')) {
    $menuType = 'keuangan';
} elseif ($roleId === 4) {
    $menuType = 'kemahasiswaan';
} elseif ($roleId === 5) {
    $menuType = 'keuangan';
} else {
    $menuType = 'akademik';
}
?>

<div class="sidebar">

    <!-- LOGO -->
    <div style="
        display: flex;
        align-items: center;
        height: 70px;
        padding: 8px 15px;
        gap: 10px;
        color: white;
        box-sizing: border-box;
    ">

        <img src="<?= base_url('assets/img/logo.jpeg') ?>" 
             alt="Logo POLBAN"
             style="
                width: 42px;
                height: 42px;
                object-fit: contain;
                border-radius: 50%;
                flex-shrink: 0;
                display: block;
             ">

        <span style="
            font-size: 15px;
            font-weight: 700;
            color: white;
            white-space: nowrap;
            line-height: 1;
        ">
            SI-ULT POLBAN
        </span>

    </div>


    <!-- ========================================= -->
    <!-- SIDEBAR AKADEMIK -->
    <!-- ========================================= -->

    <?php if ($menuType === 'akademik'): ?>

        <!-- Dashboard Akademik -->
        <a href="<?= base_url('unit-layanan/dashboard') ?>"
           class="nav-link <?= url_is('unit-layanan/dashboard') ? 'active' : '' ?>">

            <i class="fas fa-building"></i>

            <span>Akademik</span>

        </a>


        <!-- Profil Akademik -->
        <a href="<?= base_url('unit-layanan/profile') ?>"
           class="nav-link <?= url_is('unit-layanan/profile') ? 'active' : '' ?>">

            <i class="fas fa-user-circle"></i>

            <span>Profil</span>

        </a>


    <!-- ========================================= -->
    <!-- SIDEBAR KEMAHASISWAAN -->
    <!-- ========================================= -->

    <?php elseif ($menuType === 'kemahasiswaan'): ?>

        <!-- Dashboard Kemahasiswaan -->
        <a href="<?= base_url('kemahasiswaan/dashboard') ?>"
           class="nav-link <?= url_is('kemahasiswaan/dashboard') ? 'active' : '' ?>">

            <i class="fas fa-user-graduate"></i>

            <span>Kemahasiswaan</span>

        </a>


        <!-- Profil Kemahasiswaan -->
        <a href="<?= base_url('kemahasiswaan/profile') ?>"
           class="nav-link <?= url_is('kemahasiswaan/profile') ? 'active' : '' ?>">

            <i class="fas fa-user-circle"></i>

            <span>Profil</span>

        </a>


    <!-- ========================================= -->
    <!-- SIDEBAR KEUANGAN -->
    <!-- ========================================= -->

    <?php elseif ($menuType === 'keuangan'): ?>

        <!-- Dashboard Keuangan -->
        <a href="<?= base_url('keuangan/dashboard') ?>"
           class="nav-link <?= url_is('keuangan/dashboard') ? 'active' : '' ?>">

            <i class="fas fa-money-bill"></i>

            <span>Keuangan</span>

        </a>


        <!-- Profil Keuangan -->
        <a href="<?= base_url('keuangan/profile') ?>"
           class="nav-link <?= url_is('keuangan/profile') ? 'active' : '' ?>">

            <i class="fas fa-user-circle"></i>

            <span>Profil</span>

        </a>

    <?php endif; ?>

</div>