<nav class="topbar">

    <div>

        <h4 class="page-title mb-0">

            <?= esc($title ?? 'Dashboard') ?>

        </h4>

        <small class="text-muted">

            Sistem Informasi Unit Layanan Terpadu POLBAN

        </small>

    </div>

    <div class="topbar-right">

        <div class="today">

            <i class="bi bi-calendar-event me-1"></i>

            <?= date('d F Y') ?>

        </div>

        <!-- Notification Dropdown -->
        <div class="dropdown">

            <button
                class="notification position-relative"
                data-bs-toggle="dropdown"
                aria-expanded="false">

                <i class="bi bi-bell-fill"></i>

                <?php if (!empty($notificationCount) && $notificationCount > 0): ?>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="font-size:.6rem;">
                        <?= (int) $notificationCount ?>
                    </span>
                <?php endif; ?>

            </button>

            <ul class="dropdown-menu dropdown-menu-end shadow" style="min-width:300px; max-height:400px; overflow-y:auto;">

                <li>
                    <h6 class="dropdown-header">
                        <i class="bi bi-bell me-1"></i>
                        Notifikasi (<?= $notificationCount ?? 0 ?>)
                    </h6>
                </li>

                <li><hr class="dropdown-divider"></li>

                <?php if (empty($notifications)): ?>
                    <li>
                        <a class="dropdown-item text-muted" href="<?= site_url('notifications') ?>">
                            <em>Tidak ada notifikasi baru.</em>
                        </a>
                    </li>
                <?php else: ?>
                    <?php $nCount = 0; ?>
                    <?php foreach ($notifications as $n): ?>
                        <?php if ($nCount >= 8) { break; } $nCount++; ?>
                        <li>
                            <a class="dropdown-item"
                                href="<?= !empty($n['url']) ? esc($n['url']) : site_url('notifications/read/' . $n['id']) ?>">
                                <div class="d-flex justify-content-between">
                                    <strong class="small"><?= esc($n['title']) ?></strong>
                                    <small class="text-muted ms-2 text-nowrap"><?= esc(date('d/m H:i', strtotime($n['created_at'] ?? 'now'))) ?></small>
                                </div>
                                <div class="small text-muted text-truncate" style="max-width:240px;"><?= esc($n['message']) ?></div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item text-center small" href="<?= site_url('notifications') ?>">
                        Lihat Semua Notifikasi
                    </a>
                </li>

            </ul>

        </div>

        <!-- User Dropdown -->
        <div class="dropdown">

            <a
                href="#"
                class="text-decoration-none text-dark d-flex align-items-center gap-2"
                data-bs-toggle="dropdown">

                <div class="avatar">

                    <?= strtoupper(substr(session('full_name') ?? 'A', 0, 1)) ?>

                </div>

                <div class="text-start d-none d-md-block">

                    <div class="fw-semibold" style="font-size:14px;">

                        <?= esc(session('full_name') ?? 'Administrator') ?>

                    </div>

                    <span class="role-badge">

                        <?= esc(session('role_name') ?? 'User') ?>

                    </span>

                </div>

                <i class="bi bi-chevron-down ms-1" style="font-size:12px;"></i>

            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow">

                <li>
                    <h6 class="dropdown-header">Akun</h6>
                </li>

                <li>
                    <a class="dropdown-item" href="<?= base_url('profile') ?>">
                        <i class="bi bi-person-circle me-2"></i>
                        Profil Saya
                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item text-danger" href="<?= base_url('logout') ?>">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout
                    </a>
                </li>

            </ul>

        </div>

    </div>

</nav>