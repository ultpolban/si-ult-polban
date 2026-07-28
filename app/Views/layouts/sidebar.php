<aside class="main-sidebar sidebar-light-primary elevation-0">

    <a href="<?= base_url('dashboard') ?>" class="brand-link d-flex align-items-center">
        <img src="<?= base_url('assets/images/ULT%20POLBAN.png') ?>"
             alt="Logo POLBAN"
             class="brand-logo"
             onerror="this.style.display='none'; document.getElementById('brandIconFallback').style.display='flex';">
        <span class="brand-icon-fallback" id="brandIconFallback" style="display:none;">
            <i class="fas fa-shield-alt"></i>
        </span>
        <span class="brand-text">
            ULT POLBAN
            <small>Unit Layanan Terpadu</small>
        </span>
    </a>

    <div class="sidebar">

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <?php
                $uri = service('request')->getUri()->getPath();
                $isAdmin = hasRole(1);
                $isPimpinan = hasRole(5);
                ?>

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link <?= ($uri == 'dashboard' || strpos($uri, 'dashboard') !== false) ? 'active' : '' ?>">
                        <i class="fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Manajemen User Dropdown -->
                <?php if ($isAdmin): ?>
                    <?php
                    $isUserActive = (
                        strpos($uri, 'users') !== false ||
                        strpos($uri, 'roles') !== false ||
                        strpos($uri, 'unit-kerja') !== false ||
                        strpos($uri, 'jurusan') !== false ||
                        strpos($uri, 'program-studi') !== false
                    );
                    ?>
                    <li class="nav-item <?= $isUserActive ? 'menu-open' : '' ?>">
                        <a href="#" class="nav-link <?= $isUserActive ? 'active' : '' ?>">
                            <i class="fas fa-users-cog"></i>
                            <p>
                                Manajemen User
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview" style="padding-left: 15px; display: <?= $isUserActive ? 'block' : 'none' ?>;">
                            <li class="nav-item">
                                <a href="<?= base_url('users') ?>" class="nav-link <?= ($uri == 'users' || (strpos($uri, 'users') !== false && strpos($uri, 'create') === false && strpos($uri, 'edit') === false)) ? 'active' : '' ?>">
                                    <i class="fas fa-user-friends"></i>
                                    <p>User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('roles') ?>" class="nav-link <?= (strpos($uri, 'roles') !== false) ? 'active' : '' ?>">
                                    <i class="fas fa-user-shield"></i>
                                    <p>Role</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('unit-kerja') ?>" class="nav-link <?= (strpos($uri, 'unit-kerja') !== false) ? 'active' : '' ?>">
                                    <i class="fas fa-briefcase"></i>
                                    <p>Unit Kerja</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('jurusan') ?>" class="nav-link <?= (strpos($uri, 'jurusan') !== false) ? 'active' : '' ?>">
                                    <i class="fas fa-graduation-cap"></i>
                                    <p>Jurusan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('program-studi') ?>" class="nav-link <?= (strpos($uri, 'program-studi') !== false) ? 'active' : '' ?>">
                                    <i class="fas fa-book"></i>
                                    <p>Program Studi</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- Manajemen Layanan -->
                <?php if ($isAdmin): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/layanan') ?>" class="nav-link <?= (strpos($uri, 'admin/layanan') !== false) ? 'active' : '' ?>">
                            <i class="fas fa-concierge-bell"></i>
                            <p>Manajemen Layanan</p>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Laporan -->
                <?php if ($isAdmin || $isPimpinan): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/laporan') ?>" class="nav-link <?= (strpos($uri, 'admin/laporan') !== false) ? 'active' : '' ?>">
                            <i class="fas fa-file-invoice"></i>
                            <p>Laporan Tiket</p>
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Grafik Statistik -->
                <?php if ($isAdmin || $isPimpinan): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('admin/statistik') ?>" class="nav-link <?= (strpos($uri, 'admin/statistik') !== false) ? 'active' : '' ?>">
                            <i class="fas fa-chart-pie"></i>
                            <p>Grafik Statistik</p>
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item mt-4" style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 10px;">
                    <a href="<?= base_url('logout') ?>" class="nav-link text-danger">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>

        </nav>

    </div>

</aside>