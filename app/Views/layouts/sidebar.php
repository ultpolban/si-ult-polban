<div class="sidebar">

    <!-- Sidebar Header -->
    <div class="sidebar-header">

        <div class="logo-icon">

            <i class="bi bi-buildings-fill"></i>

        </div>

        <div>

            <h4>SI ULT</h4>

            <p>Politeknik Negeri Bandung</p>

        </div>

    </div>

    <!-- Menu -->
    <div class="sidebar-menu">

        <?php
        $permissionService = new \App\Services\PermissionService();
        $can = static function (string $permission) use ($permissionService): bool {
            return $permissionService->hasPermission($permission);
        };
        $currentSegment1 = service('uri')->getSegment(1);
        $currentSegment2 = service('uri')->getSegment(2);
        ?>

        <!-- MAIN MENU -->
        <span class="menu-title">MAIN MENU</span>

        <?php if ($can('dashboard.view')): ?>
            <a href="<?= base_url('dashboard') ?>"
                class="<?= $currentSegment1 == 'dashboard' ? 'active' : '' ?>">

                <i class="bi bi-speedometer2"></i>

                Dashboard

            </a>
        <?php endif; ?>

        <!-- MASTER DATA -->
        <?php
        $masterMenus = [
            'department.view',
            'study_program.view',
            'class.view',
            'applicant_type.view',
            'service_unit.view',
            'service_category.view',
            'service.view',
            'service_requirement.view',
        ];
        $showMaster = false;
        foreach ($masterMenus as $permission) {
            if ($can($permission)) { $showMaster = true; break; }
        }
        ?>

        <?php if ($showMaster): ?>
            <span class="menu-title">MASTER DATA</span>

            <?php if ($can('department.view')): ?>
                <a href="<?= base_url('master/departments') ?>"
                    class="<?= ($currentSegment1 == 'master' && $currentSegment2 == 'departments') ? 'active' : '' ?>">
                    <i class="bi bi-building"></i>
                    Department
                </a>
            <?php endif; ?>

            <?php if ($can('study_program.view')): ?>
                <a href="<?= base_url('master/study-programs') ?>"
                    class="<?= ($currentSegment1 == 'master' && $currentSegment2 == 'study-programs') ? 'active' : '' ?>">
                    <i class="bi bi-mortarboard-fill"></i>
                    Program Studi
                </a>
            <?php endif; ?>

            <?php if ($can('class.view')): ?>
                <a href="<?= base_url('master/classes') ?>"
                    class="<?= ($currentSegment1 == 'master' && $currentSegment2 == 'classes') ? 'active' : '' ?>">
                    <i class="bi bi-people-fill"></i>
                    Kelas
                </a>
            <?php endif; ?>

            <?php if ($can('applicant_type.view')): ?>
                <a href="<?= base_url('master/applicant-types') ?>"
                    class="<?= ($currentSegment1 == 'master' && $currentSegment2 == 'applicant-types') ? 'active' : '' ?>">
                    <i class="bi bi-person-badge-fill"></i>
                    Jenis Pemohon
                </a>
            <?php endif; ?>

            <?php if ($can('service_unit.view')): ?>
                <a href="<?= base_url('master/service-units') ?>"
                    class="<?= ($currentSegment1 == 'master' && $currentSegment2 == 'service-units') ? 'active' : '' ?>">
                    <i class="bi bi-diagram-3-fill"></i>
                    Unit Layanan
                </a>
            <?php endif; ?>

            <?php if ($can('service_category.view')): ?>
                <a href="<?= base_url('master/service-categories') ?>"
                    class="<?= ($currentSegment1 == 'master' && $currentSegment2 == 'service-categories') ? 'active' : '' ?>">
                    <i class="bi bi-folder-fill"></i>
                    Kategori Layanan
                </a>
            <?php endif; ?>

            <?php if ($can('service.view')): ?>
                <a href="<?= base_url('master/services') ?>"
                    class="<?= ($currentSegment1 == 'master' && $currentSegment2 == 'services') ? 'active' : '' ?>">
                    <i class="bi bi-bell-fill"></i>
                    Layanan
                </a>
            <?php endif; ?>

            <?php if ($can('service_requirement.view')): ?>
                <a href="<?= base_url('master/service-requirements') ?>"
                    class="<?= ($currentSegment1 == 'master' && $currentSegment2 == 'service-requirements') ? 'active' : '' ?>">
                    <i class="bi bi-file-earmark-text-fill"></i>
                    Persyaratan
                </a>
            <?php endif; ?>
        <?php endif; ?>


        <!-- MANAGEMENT -->
        <?php
        $showManagement = $can('user.view') || $can('role.view') || $can('permission.view') || $can('role_permission.view');
        ?>

        <?php if ($showManagement): ?>
            <span class="menu-title">MANAGEMENT</span>

            <?php if ($can('user.view')): ?>
                <a href="<?= base_url('users') ?>"
                    class="<?= $currentSegment1 == 'users' ? 'active' : '' ?>">
                    <i class="bi bi-people-fill"></i>
                    Management User
                </a>
            <?php endif; ?>

            <?php if ($can('role.view')): ?>
                <a href="<?= base_url('roles') ?>"
                    class="<?= $currentSegment1 == 'roles' ? 'active' : '' ?>">
                    <i class="bi bi-person-badge-fill"></i>
                    Management Role
                </a>
            <?php endif; ?>

            <?php if ($can('permission.view')): ?>
                <a href="<?= base_url('permissions') ?>"
                    class="<?= $currentSegment1 == 'permissions' ? 'active' : '' ?>">
                    <i class="bi bi-key-fill"></i>
                    Permission
                </a>
            <?php endif; ?>

            <?php if ($can('role_permission.view')): ?>
                <a href="<?= base_url('role-permissions') ?>"
                    class="<?= $currentSegment1 == 'role-permissions' ? 'active' : '' ?>">
                    <i class="bi bi-shield-lock-fill"></i>
                    Role-Permission
                </a>
            <?php endif; ?>
        <?php endif; ?>


        <!-- LAYANAN -->
        <?php
        $isPemohon = strtoupper((string) session('role_code')) === 'PEMOHON';
        $showLayanan =
            $can('request.view') ||
            $can('request.create') ||
            $can('request.verify') ||
            $can('report.view') ||
            $can('statistic.view');
        ?>

        <?php if ($showLayanan): ?>
            <span class="menu-title">LAYANAN</span>

            <?php if ($isPemohon): ?>

                <?php if ($can('request.create')): ?>
                    <a href="<?= base_url('service-requests/create') ?>"
                        class="<?= ($currentSegment1 == 'service-requests' && $currentSegment2 == 'create') ? 'active' : '' ?>">
                        <i class="bi bi-send-fill"></i>
                        Buat Pengajuan
                    </a>
                <?php endif; ?>

                <?php if ($can('request.view')): ?>
                    <a href="<?= base_url('service-requests') ?>"
                        class="<?= ($currentSegment1 == 'service-requests' && $currentSegment2 != 'create') ? 'active' : '' ?>">
                        <i class="bi bi-list-task"></i>
                        Pengajuan Saya
                    </a>
                <?php endif; ?>

            <?php else: ?>

                <?php if ($can('request.view')): ?>
                    <a href="<?= base_url('tickets') ?>"
                        class="<?= $currentSegment1 == 'tickets' ? 'active' : '' ?>">
                        <i class="bi bi-ticket-perforated-fill"></i>
                        Manajemen Tiket
                    </a>
                <?php endif; ?>

                <?php if ($can('request.verify')): ?>
                    <a href="<?= base_url('verifications') ?>"
                        class="<?= $currentSegment1 == 'verifications' ? 'active' : '' ?>">
                        <i class="bi bi-check-circle-fill"></i>
                        Verifikasi
                    </a>
                <?php endif; ?>

            <?php endif; ?>

            <?php if ($can('request.view')): ?>
                <a href="<?= base_url('tracking') ?>"
                    class="<?= $currentSegment1 == 'tracking' ? 'active' : '' ?>">
                    <i class="bi bi-search"></i>
                    Lacak Tiket
                </a>
            <?php endif; ?>

            <?php if ($can('report.view')): ?>
                <a href="<?= base_url('reports') ?>"
                    class="<?= $currentSegment1 == 'reports' ? 'active' : '' ?>">
                    <i class="bi bi-bar-chart-fill"></i>
                    Laporan
                </a>
            <?php endif; ?>

            <?php if ($can('statistic.view')): ?>
                <a href="<?= base_url('statistics') ?>"
                    class="<?= $currentSegment1 == 'statistics' ? 'active' : '' ?>">
                    <i class="bi bi-pie-chart-fill"></i>
                    Statistik
                </a>
            <?php endif; ?>
        <?php endif; ?>


        <!-- REGISTRASI -->
        <?php if ($can('registration_request.view')): ?>
            <span class="menu-title">REGISTRASI</span>

            <a href="<?= base_url('registration-requests') ?>"
                class="<?= $currentSegment1 == 'registration-requests' ? 'active' : '' ?>">
                <i class="bi bi-person-plus-fill"></i>
                Permintaan Registrasi
            </a>
        <?php endif; ?>


        <!-- SYSTEM -->
        <?php
        $showSystem = $can('notification.view') || $can('activity_log.view');
        ?>

        <?php if ($showSystem): ?>
            <span class="menu-title">SYSTEM</span>

            <?php if ($can('notification.view')): ?>
                <a href="<?= base_url('notifications') ?>"
                    class="<?= $currentSegment1 == 'notifications' ? 'active' : '' ?>">
                    <i class="bi bi-bell-fill"></i>
                    Notifikasi
                    <?php if (!empty($notificationCount) && $notificationCount > 0): ?>
                        <span class="badge bg-danger ms-auto"><?= (int) $notificationCount ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>

            <?php if ($can('activity_log.view')): ?>
                <a href="<?= base_url('activity-logs') ?>"
                    class="<?= $currentSegment1 == 'activity-logs' ? 'active' : '' ?>">
                    <i class="bi bi-clock-history"></i>
                    Activity Log
                </a>
            <?php endif; ?>
        <?php endif; ?>


        <!-- KONTEN -->
        <?php if ($can('faq.view')): ?>
            <span class="menu-title">KONTEN</span>

            <a href="<?= base_url('faqs') ?>"
                class="<?= $currentSegment1 == 'faqs' ? 'active' : '' ?>">
                <i class="bi bi-question-circle-fill"></i>
                Manajemen FAQ
            </a>
        <?php endif; ?>

    </div>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">

        <a href="<?= base_url('profile') ?>"
            class="<?= $currentSegment1 == 'profile' ? 'active' : '' ?>">

            <div class="avatar">

                <?= strtoupper(substr(session('full_name') ?? 'A', 0, 1)) ?>

            </div>

            <div>

                <div class="fw-semibold small"><?= esc(session('full_name') ?? 'User') ?></div>

                <div class="text-muted" style="font-size:11px;"><?= esc(session('role_name') ?? '') ?></div>

            </div>

        </a>

        <a href="<?= base_url('logout') ?>"
            class="text-danger"
            data-bs-toggle="tooltip"
            title="Logout">

            <i class="bi bi-box-arrow-right"></i>

        </a>

    </div>

</div>