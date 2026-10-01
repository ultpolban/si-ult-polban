<?php
/**
 * =====================================================================
 *  NAVBAR LANDING PAGE — HORISONTAL DI ATAS
 * =====================================================================
 *  Navbar membentang LEBAR di bagian atas halaman (bukan di samping).
 *  - Desktop : glass/sticky saat di-scroll, menu mendatar penuh.
 *  - Mobile  : tombol hamburger -> menu turun (collapse).
 *
 *  Catatan: file logo (logo-polban.png) sudah background transparan,
 *  jadi tidak perlu diberi kotak putih tambahan.
 */
$isLoggedIn = (bool) session()->get('isLoggedIn');

/**
 * Menu utama (anchor di halaman yang sama).
 * 'match' dipakai script untuk menandai menu aktif (scrollspy).
 */
$ultNavMain = [
    ['url' => base_url('/') . '#beranda',   'label' => 'Beranda',  'match' => 'beranda'],
    ['url' => base_url('/') . '#layanan',   'label' => 'Layanan',  'match' => 'layanan'],
    ['url' => base_url('/') . '#alur',      'label' => 'Alur',     'match' => 'alur'],
    ['url' => base_url('/') . '#statistik', 'label' => 'Statistik', 'match' => 'statistik'],
    ['url' => base_url('/') . '#tentang',   'label' => 'Tentang',  'match' => 'tentang'],
    ['url' => base_url('/') . '#faq',       'label' => 'FAQ',      'match' => 'faq'],
    ['url' => base_url('/') . '#kontak',    'label' => 'Kontak',   'match' => 'kontak'],
];

/** Dropdown "Layanan Cepat". */
$ultNavLayanan = [
    ['url' => base_url('services'),            'icon' => 'bi-list-check', 'label' => 'Daftar Layanan'],
    ['url' => base_url('/') . '#layanan',      'icon' => 'bi-grid',       'label' => 'Semua Unit Layanan'],
    ['url' => base_url('/') . '#alur',         'icon' => 'bi-signpost-split', 'label' => 'Alur Pengajuan'],
    ['url' => base_url('tracking'),            'icon' => 'bi-route',      'label' => 'Lacak Tiket'],
];
?>

<nav class="landing-navbar" id="ultNavbar" aria-label="Navigasi utama">

    <div class="container">

        <!-- ============ BRAND ============ -->
        <a class="navbar-brand" href="<?= base_url('/') ?>">
            <img src="<?= base_url('assets/img/logo-polban.png') ?>" alt="Logo POLBAN">
            <span class="brand-text">
                <b>SI ULT POLBAN</b>
                <small>Unit Layanan Terpadu</small>
            </span>
        </a>

        <!-- ============ TOGGLE (MOBILE) ============ -->
        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#landingNav"
                aria-controls="landingNav" aria-expanded="false" aria-label="Buka menu">
            <i class="bi bi-list"></i>
        </button>

        <!-- ============ MENU (MENDATAR, MELINTAR) ============ -->
        <div class="collapse navbar-collapse" id="landingNav">

            <ul class="navbar-nav landing-nav-list" data-nav-targets>

                <?php foreach ($ultNavMain as $ultItem): ?>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= $ultItem['url'] ?>"
                           data-nav-target="<?= esc($ultItem['match']) ?>">
                            <?= esc($ultItem['label']) ?>
                        </a>
                    </li>
                <?php endforeach ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="<?= base_url('/') ?>#layanan" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Layanan Cepat
                    </a>

                    <ul class="dropdown-menu">
                        <?php foreach ($ultNavLayanan as $ultItem): ?>
                            <li>
                                <a class="dropdown-item" href="<?= $ultItem['url'] ?>">
                                    <i class="bi <?= esc($ultItem['icon']) ?>"></i>
                                    <?= esc($ultItem['label']) ?>
                                </a>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </li>

            </ul>

            <!--
                ============ AKSI ============
                Tombol "Masuk" dan "Daftar" sengaja tidak ditampilkan
                di navbar ini, supaya navbar landing page tetap bersih.

                Pendaftaran langsung TIDAK lagi tersedia di seluruh
                aplikasi. Alur resmi hanya:
                  - /registration-request  (Ajukan Izin)
                  - tunggu persetujuan admin
                  - /register (verifikasi email) -> MFA -> login

                Pengguna masuk / mengajukan izin lewat:
                  - tombol Masuk & Ajukan Izin di section Hero
                  - tombol di band CTA di bagian bawah halaman
                  - menu "Akses" di footer

                Yang tampil di navbar hanya akses bagi pengguna yang
                sudah login.
            -->
            <?php if ($isLoggedIn): ?>
                <div class="landing-nav-actions">
                    <a href="<?= base_url(ult_role_dashboard()) ?>" class="btn-nav-hero">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>

                    <a href="<?= base_url('logout') ?>" class="btn-nav-logout">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </a>
                </div>
            <?php endif ?>

        </div>

    </div>

</nav>
