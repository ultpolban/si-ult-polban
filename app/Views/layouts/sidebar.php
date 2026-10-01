<?php

/**
 * =====================================================================
 *  SIDEBAR — SI ULT POLBAN
 * =====================================================================
 *
 *  Satu sidebar untuk SEMUA role dan jenis pemohon.
 *  Isi menu ditentukan helper `ult_menu()` sehingga:
 *   - tiap role hanya melihat menu miliknya,
 *   - tiap jenis pemohon hanya melihat menu miliknya,
 *   - target menu divalidasi terhadap route yang benar-benar ada.
 */

helper('role');
echo $this->include('layouts/_sidebar_style');

$ultMenu      = ult_menu();
$ultDashboard = base_url(ult_role_dashboard());
$ultRoleName  = ult_current_role_name();
$ultGroup     = ult_role_group();
$ultName      = ult_user_display_name();
$ultInitials  = ult_user_initials();
$ultApplicant = ult_current_applicant_name();
$ultPhoto     = ult_user_photo();

$ultContext = match ($ultGroup) {
    'admin'    => ['Administrator',        'Administrator',      'fa-user-shield'],
    'petugas'  => ['Petugas ULT',          'Petugas ULT',        'fa-user-tie'],
    'pimpinan' => ['Pimpinan',             'Pimpinan',           'fa-user-check'],
    'unit'     => ['Unit Layanan',         'Unit Layanan',       'fa-building'],
    default    => [$ultApplicant,          $ultApplicant,        'fa-id-card'],
};
?>

<!-- ==========================
     SIDEBAR
========================== -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 ult-sidebar">

    <!-- BRAND -->
    <a href="<?= $ultDashboard ?>" class="brand-link ult-brand">

        <img src="<?= base_url('assets/img/logo-polban.png') ?>"
             alt="Logo POLBAN"
             class="ult-brand-logo">

        <span class="ult-brand-text">
            SI ULT <strong>POLBAN</strong>
            <small>Unit Layanan Terpadu</small>
        </span>

    </a>

    <div class="sidebar">

        <!-- USER PANEL -->
        <div class="user-panel ult-user-panel">

            <?php if ($ultPhoto): ?>
                <div class="image">
                    <img src="<?= base_url('uploads/profile/' . $ultPhoto) ?>"
                         class="ult-avatar"
                         alt="<?= esc($ultName) ?>">
                </div>
            <?php else: ?>
                <div class="image">
                    <span class="ult-avatar"><?= esc($ultInitials) ?></span>
                </div>
            <?php endif; ?>

            <div class="info">
                <a href="<?= base_url('profile') ?>" class="ult-user-name">
                    <?= esc($ultName) ?>
                </a>
                <span class="ult-user-role">
                    <i class="fas <?= esc($ultContext[2]) ?>"></i>
                    <?= esc($ultContext[1]) ?>
                </span>
            </div>

        </div>

        <!-- MENU -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column ult-menu" role="menu">

                <?php foreach ($ultMenu as $ultGroupMenu): ?>

                    <?php
                    $ultItems = array_filter(
                        $ultGroupMenu['items'] ?? [],
                        static fn ($item) => ult_menu_url_exists((string) ($item['url'] ?? ''))
                    );
                    ?>

                    <?php if ($ultItems === []) {
                        continue;
                    } ?>

                    <li class="nav-header"><?= esc($ultGroupMenu['label'] ?? '') ?></li>

                    <?php foreach ($ultItems as $ultItem): ?>

                        <?php
                        $ultActive = ult_menu_is_active((string) $ultItem['url']);
                        $ultDanger = ! empty($ultItem['danger']);
                        $ultUrl    = base_url($ultItem['url']);
                        ?>

                        <li class="nav-item">

                            <a href="<?= $ultUrl ?>"
                               class="nav-link <?= $ultActive ? 'active' : '' ?><?= $ultDanger ? ' ult-logout' : '' ?>">

                                <i class="nav-icon fas <?= esc($ultItem['icon'] ?? 'fa-circle') ?>"></i>

                                <p><?= esc($ultItem['label'] ?? '') ?></p>

                                <?php if ($ultActive): ?>
                                    <span class="ult-menu-active-dot"></span>
                                <?php endif ?>

                            </a>

                        </li>

                    <?php endforeach ?>

                <?php endforeach ?>

            </ul>
        </nav>

        <!-- FOOTER SIDEBAR -->
        <div class="ult-sidebar-foot">
            <div class="ult-sidebar-foot-title">
                <i class="fas fa-headset"></i> Butuh Bantuan?
            </div>
            <p>Hubungi Unit Layanan Terpadu POLBAN pada jam kerja.</p>
            <a href="<?= base_url('tracking') ?>">
                <i class="fas fa-route"></i> Lacak Tiket
            </a>
        </div>

    </div>

</aside>
