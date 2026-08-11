<header class="ult-topbar">

    <div class="ult-topbar-left">

        <button type="button" class="btn-icon"
            id="sidebarToggle"
            aria-label="Toggle Sidebar">

            <i class="fas fa-bars"></i>

        </button>

        <span class="fw-bold d-none d-sm-inline" style="color:var(--ult-primary);">

            Sistem Informasi Layanan Terpadu

        </span>

    </div>

    <div class="ult-topbar-right">

        <!-- Notification -->
        <div class="dropdown">

            <button type="button"
                class="btn-icon"
                data-bs-toggle="dropdown"
                aria-expanded="false">

                <i class="far fa-bell"></i>

                <?php if (!empty($notificationCount) && $notificationCount > 0): ?>

                    <span class="ult-badge ult-badge-red"
                        style="position:absolute;top:4px;right:4px;padding:2px 6px;font-size:.65rem;">

                        <?= $notificationCount ?>

                    </span>

                <?php endif; ?>

            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow"
                style="min-width:320px;">

                <li class="dropdown-header">
                    <?= $notificationCount ?? 0 ?> Notifikasi
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a class="dropdown-item text-center"
                        href="<?= site_url('notifications') ?>">

                        Lihat Semua Notifikasi

                    </a>
                </li>

            </ul>

        </div>

        <!-- User -->
        <div class="dropdown">

            <a href="#"
                class="ult-user-menu"
                data-bs-toggle="dropdown"
                aria-expanded="false">

                <img src="<?= base_url($user['photo'] ?? 'assets/img/avatar.svg') ?>"
                    alt="User">

                <span class="d-none d-md-inline">

                    <?= esc($user['full_name'] ?? 'User') ?>

                </span>

                <i class="fas fa-chevron-down small"></i>

            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow">

                <li>
                    <a class="dropdown-item"
                        href="<?= site_url('profile') ?>">

                        <i class="fas fa-user me-2"></i>
                        Profil

                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li>
                    <a class="dropdown-item text-danger"
                        href="<?= site_url('logout') ?>">

                        <i class="fas fa-sign-out-alt me-2"></i>
                        Logout

                    </a>
                </li>

            </ul>

        </div>

    </div>

</header>