<aside class="ult-sidebar" id="sidebar">

    <a href="<?= site_url('dashboard') ?>"
        class="ult-brand">

        <img src="<?= base_url('assets/img/polban.png') ?>"
            alt="Logo Polban"
            class="ult-brand-polban">

        <span>SI ULT POLBAN</span>

    </a>

    <nav class="ult-menu">

        <?php
        $permissionService = new \App\Services\PermissionService();

        $can = static function (string $permission) use ($permissionService): bool {
            return $permissionService->hasPermission($permission);
        };
        ?>

        <!-- Dashboard -->
        <?php if ($can('dashboard.view')): ?>
            <a href="<?= site_url('dashboard') ?>">
                <i class="fas fa-home"></i>
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
            if ($can($permission)) {
                $showMaster = true;
                break;
            }
        }
        ?>

        <?php if ($showMaster): ?>
            <div class="ult-menu-header">Master Data</div>

            <?php if ($can('department.view')): ?>
                <a href="<?= site_url('master/departments') ?>">
                    <i class="fas fa-building"></i>
                    Department
                </a>
            <?php endif; ?>

            <?php if ($can('study_program.view')): ?>
                <a href="<?= site_url('master/study-programs') ?>">
                    <i class="fas fa-university"></i>
                    Program Studi
                </a>
            <?php endif; ?>

            <?php if ($can('class.view')): ?>
                <a href="<?= site_url('master/classes') ?>">
                    <i class="fas fa-users"></i>
                    Kelas
                </a>
            <?php endif; ?>

            <?php if ($can('applicant_type.view')): ?>
                <a href="<?= site_url('master/applicant-types') ?>">
                    <i class="fas fa-user-tag"></i>
                    Jenis Pemohon
                </a>
            <?php endif; ?>

            <?php if ($can('service_unit.view')): ?>
                <a href="<?= site_url('master/service-units') ?>">
                    <i class="fas fa-sitemap"></i>
                    Unit Layanan
                </a>
            <?php endif; ?>

            <?php if ($can('service_category.view')): ?>
                <a href="<?= site_url('master/service-categories') ?>">
                    <i class="fas fa-folder"></i>
                    Kategori Layanan
                </a>
            <?php endif; ?>

            <?php if ($can('service.view')): ?>
                <a href="<?= site_url('master/services') ?>">
                    <i class="fas fa-concierge-bell"></i>
                    Layanan
                </a>
            <?php endif; ?>

            <?php if ($can('service_requirement.view')): ?>
                <a href="<?= site_url('master/service-requirements') ?>">
                    <i class="fas fa-file-alt"></i>
                    Persyaratan
                </a>
            <?php endif; ?>
        <?php endif; ?>


        <!-- MANAGEMENT -->
        <?php
        $showManagement =
            $can('user.view') ||
            $can('role.view') ||
            $can('permission.view');
        ?>

        <?php if ($showManagement): ?>
            <div class="ult-menu-header">Management</div>

            <?php if ($can('user.view')): ?>
                <a href="<?= site_url('users') ?>">
                    <i class="fas fa-user"></i>
                    User
                </a>
            <?php endif; ?>

            <?php if ($can('role.view')): ?>
                <a href="<?= site_url('roles') ?>">
                    <i class="fas fa-user-shield"></i>
                    Role
                </a>
            <?php endif; ?>

            <?php if ($can('permission.view')): ?>
                <a href="<?= site_url('permissions') ?>">
                    <i class="fas fa-key"></i>
                    Permission
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
            <div class="ult-menu-header">Layanan</div>

            <?php if ($isPemohon): ?>

                <?php if ($can('request.create')): ?>
                    <a href="<?= site_url('service-requests/create') ?>">
                        <i class="fas fa-paper-plane"></i>
                        Buat Pengajuan
                    </a>
                <?php endif; ?>

                <?php if ($can('request.view')): ?>
                    <a href="<?= site_url('service-requests') ?>">
                        <i class="fas fa-list"></i>
                        Pengajuan Saya
                    </a>
                <?php endif; ?>

            <?php else: ?>

                <?php if ($can('request.view')): ?>
                    <a href="<?= site_url('tickets') ?>">
                        <i class="fas fa-ticket-alt"></i>
                        Manajemen Tiket
                    </a>
                <?php endif; ?>

                <?php if ($can('request.create')): ?>
                    <a href="<?= site_url('tickets/create') ?>">
                        <i class="fas fa-plus-circle"></i>
                        Buat Tiket
                    </a>
                <?php endif; ?>

                <?php if ($can('request.verify')): ?>
                    <a href="<?= site_url('verifications') ?>">
                        <i class="fas fa-check-circle"></i>
                        Verifikasi
                    </a>
                <?php endif; ?>

            <?php endif; ?>

            <?php if ($can('request.view')): ?>
                <a href="<?= site_url('tracking') ?>">
                    <i class="fas fa-search"></i>
                    Lacak Tiket
                </a>
            <?php endif; ?>

            <?php if ($can('report.view')): ?>
                <a href="<?= site_url('reports') ?>">
                    <i class="fas fa-file-alt"></i>
                    Laporan
                </a>
            <?php endif; ?>

            <?php if ($can('statistic.view')): ?>
                <a href="<?= site_url('statistics') ?>">
                    <i class="fas fa-chart-pie"></i>
                    Statistik
                </a>
            <?php endif; ?>
        <?php endif; ?>
        <!-- REGISTRASI -->
        <?php if ($can('registration_request.view')): ?>
            <div class="ult-menu-header">Registrasi</div>

            <a href="<?= site_url('registration-requests') ?>">
                <i class="fas fa-user-plus"></i>
                Permintaan Registrasi
            </a>
        <?php endif; ?>


        <!-- SYSTEM -->
        <?php
        $showSystem =
            $can('notification.view') ||
            $can('activity_log.view');
        ?>

        <?php if ($showSystem): ?>
            <div class="ult-menu-header">System</div>

            <?php if ($can('notification.view')): ?>
                <a href="<?= site_url('notifications') ?>">
                    <i class="fas fa-bell"></i>
                    Notifikasi
                </a>
            <?php endif; ?>

            <?php if ($can('activity_log.view')): ?>
                <a href="<?= site_url('activity-logs') ?>">
                    <i class="fas fa-history"></i>
                    Activity Log
                </a>
            <?php endif; ?>
        <?php endif; ?>


        <!-- PROFIL -->
        <a href="<?= site_url('profile') ?>">
            <i class="fas fa-user-cog"></i>
            Profil
        </a>

        <!-- KONTEN (FAQ) -->
        <?php if ($can('faq.view')): ?>
            <div class="ult-menu-header">Konten</div>

            <a href="<?= site_url('faqs') ?>">
                <i class="fas fa-question-circle"></i>
                Manajemen FAQ
            </a>
        <?php endif; ?>

    </nav>

</aside>