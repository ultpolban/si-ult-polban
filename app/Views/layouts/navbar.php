<?php

/**
 * =====================================================================
 *  NAVBAR — SI ULT POLBAN
 * =====================================================================
 *
 *  Topbar untuk seluruh role: tombol sidebar, pencarian cepat,
 *  notifikasi, dan menu akun.
 */

use App\Models\NotificationModel;

helper('role');

$ultName      = ult_user_display_name();
$ultInitials  = ult_user_initials();
$ultRoleName  = ult_current_role_name();
$ultDashboard = base_url(ult_role_dashboard());
$ultTicketUrl = base_url(ult_ticket_index_url());

$ultNotifCount = 0;
$ultNotifs     = [];

$ultUserId = ult_current_user_id();

if ($ultUserId > 0) {
    $ultNotifs = (new NotificationModel())
        ->where('user_id', $ultUserId)
        ->orderBy('created_at', 'DESC')
        ->findAll();

    foreach ($ultNotifs as $ultNotif) {
        if ((int) ($ultNotif['is_read'] ?? 0) === 0) {
            $ultNotifCount++;
        }
    }

    $ultNotifs = array_slice($ultNotifs, 0, 8);
}
?>

<nav class="main-header navbar navbar-expand ult-topbar">

    <!-- Toggle Sidebar -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link ult-icon-btn" data-widget="pushmenu" href="#" role="button" aria-label="Buka / tutup menu">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Breadcrumb Singkat -->
    <ul class="navbar-nav ult-topbar-crumb d-none d-lg-flex">
        <li class="nav-item">
            <a class="nav-link" href="<?= $ultDashboard ?>">
                <i class="fas fa-home"></i>
            </a>
        </li>
        <li class="nav-item d-none d-md-flex">
            <span class="nav-link ult-crumb-text">
                <?= esc($title ?? $pageTitle ?? 'Dashboard') ?>
            </span>
        </li>
    </ul>

    <!-- Kanan -->
    <ul class="navbar-nav ml-auto ult-topbar-right">

        <!-- Cari Tiket -->
        <li class="nav-item d-none d-md-flex">
            <form class="ult-search" action="<?= base_url('tracking') ?>" method="get">
                <i class="fas fa-search"></i>
                <input type="text"
                       name="q"
                       class="ult-search-input"
                       placeholder="Cari / lacak tiket..."
                       aria-label="Cari tiket">
            </form>
        </li>

        <!-- Notifikasi -->
        <li class="nav-item dropdown">
            <a class="nav-link ult-icon-btn" href="#" data-toggle="dropdown" aria-label="Notifikasi">
                <i class="far fa-bell"></i>
                <?php if ($ultNotifCount > 0): ?>
                    <span class="ult-badge"><?= $ultNotifCount > 99 ? '99+' : (int) $ultNotifCount ?></span>
                <?php endif ?>
            </a>

            <div class="dropdown-menu dropdown-menu-right ult-dropdown ult-notif-menu">
                <div class="ult-dropdown-head">
                    <strong>Notifikasi</strong>
                    <a href="<?= base_url('notifications') ?>">Lihat Semua</a>
                </div>

                <div class="ult-dropdown-body">
                    <?php if ($ultNotifs === []): ?>
                        <div class="ult-empty">
                            <i class="far fa-bell-slash"></i>
                            <span>Belum ada notifikasi</span>
                        </div>
                    <?php else: ?>
                        <?php foreach ($ultNotifs as $ultNotif): ?>
                            <a class="ult-notif-item <?= (int) ($ultNotif['is_read'] ?? 0) === 0 ? 'unread' : '' ?>"
                               href="<?= esc($ultNotif['url'] ?: $ultTicketUrl) ?>">
                                <span class="ult-notif-dot"></span>
                                <span class="ult-notif-body">
                                    <strong><?= esc($ultNotif['title'] ?? 'Notifikasi') ?></strong>
                                    <small><?= esc($ultNotif['message'] ?? '') ?></small>
                                    <em><?= esc($ultNotif['created_at'] ?? '') ?></em>
                                </span>
                            </a>
                        <?php endforeach ?>
                    <?php endif ?>
                </div>
            </div>
        </li>

        <!-- Menu Akun -->
        <li class="nav-item dropdown">
            <a class="nav-link ult-user-btn" href="#" data-toggle="dropdown" aria-label="Menu akun">
                <span class="ult-avatar-sm"><?= esc($ultInitials) ?></span>
                <span class="ult-user-meta d-none d-sm-flex">
                    <strong><?= esc($ultName) ?></strong>
                    <small><?= esc($ultRoleName) ?></small>
                </span>
                <i class="fas fa-chevron-down ult-chevron"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right ult-dropdown ult-user-menu">
                <div class="ult-user-card">
                    <span class="ult-avatar"><?= esc($ultInitials) ?></span>
                    <div>
                        <strong><?= esc($ultName) ?></strong>
                        <small><?= esc($ultRoleName) ?></small>
                    </div>
                </div>

                <div class="ult-dropdown-divider"></div>

                <a class="ult-menu-link" href="<?= base_url('profile') ?>">
                    <i class="fas fa-user"></i> Profil Saya
                </a>
                <a class="ult-menu-link" href="<?= $ultDashboard ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
                <a class="ult-menu-link" href="<?= $ultTicketUrl ?>">
                    <i class="fas fa-ticket-alt"></i> Tiket Saya
                </a>
                <a class="ult-menu-link" href="<?= base_url('notifications') ?>">
                    <i class="far fa-bell"></i> Notifikasi
                </a>

                <div class="ult-dropdown-divider"></div>

                <a class="ult-menu-link ult-menu-danger" href="<?= base_url('logout') ?>">
                    <i class="fas fa-right-from-bracket"></i> Keluar Aplikasi
                </a>
            </div>
        </li>

    </ul>

</nav>
