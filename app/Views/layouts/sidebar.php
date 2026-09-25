<aside class="ult-sidebar" id="sidebar">

    <a href="<?= site_url('dashboard') ?>"
        class="ult-brand">

        <img src="<?= base_url('assets/img/polban.png') ?>"
            alt="Logo" class="ult-brand-polban">

        <span>SI ULT POLBAN</span>

    </a>

    <div class="ult-user">

        <img src="<?= base_url($user['photo'] ?? 'assets/img/avatar.svg') ?>"
            alt="User">

        <div>

            <a href="<?= site_url('profile') ?>"
                class="name">

                <?= esc($user['full_name'] ?? 'User') ?>

            </a>

            <div class="role">

                <?= esc($user['role_name'] ?? '') ?>

            </div>

        </div>

    </div>

    <nav class="ult-menu">

        <?php
        $permissionService = new \App\Services\PermissionService();

        $can = static function (string $permission) use ($permissionService): bool {
            return $permissionService->hasPermission($permission);
        };

        $here = trim(uri_string(), '/');

        $active = static function () use ($here): string {
            $paths = func_get_args();
            foreach ($paths as $p) {
                $p = trim($p, '/');
                if ($p === '' && $here === '') return 'active';
                if ($p !== '' && ($here === $p || str_starts_with($here . '/', $p . '/'))) return 'active';
            }
            return '';
        };

        $any = static function () use ($can): bool {
            foreach (func_get_args() as $p) {
                if ($can($p)) return true;
            }
            return false;
        };

        $isPemohon = strtoupper((string) session('role_code')) === 'PEMOHON';
        ?>

        <!-- ================= UTAMA ================= -->
        <div class="ult-menu-header">Utama</div>

        <?php if ($can('dashboard.view')): ?>
            <a href="<?= site_url('dashboard') ?>" class="<?= $active('dashboard', '') ?>">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        <?php endif; ?>

        <?php if ($any('request.view', 'request.create', 'request.verify')): ?>
            <?php if ($isPemohon): ?>
                <?php if ($can('request.create')): ?>
                    <a href="<?= site_url('service-requests/create') ?>" class="<?= $active('service-requests/create') ?>">
                        <i class="fas fa-paper-plane"></i>
                        <span>Buat Pengajuan</span>
                    </a>
                <?php endif; ?>
                <?php if ($can('request.view')): ?>
                    <a href="<?= site_url('service-requests') ?>" class="<?= $active('service-requests') ?>">
                        <i class="fas fa-inbox"></i>
                        <span>Pengajuan Saya</span>
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <?php if ($can('request.view')): ?>
                    <a href="<?= site_url('tickets') ?>" class="<?= $active('tickets') ?>">
                        <i class="fas fa-ticket-alt"></i>
                        <span>Tiket Masuk</span>
                    </a>
                <?php endif; ?>
                <?php if ($can('request.create')): ?>
                    <a href="<?= site_url('tickets/create') ?>" class="<?= $active('tickets/create') ?>">
                        <i class="fas fa-plus-circle"></i>
                        <span>Buat Tiket</span>
                    </a>
                <?php endif; ?>
                <?php if ($can('request.verify')): ?>
                    <a href="<?= site_url('verifications') ?>" class="<?= $active('verifications') ?>">
                        <i class="fas fa-check-double"></i>
                        <span>Verifikasi</span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($can('request.view')): ?>
                <a href="<?= site_url('tracking') ?>" class="<?= $active('tracking') ?>">
                    <i class="fas fa-search-location"></i>
                    <span>Lacak Tiket</span>
                </a>
            <?php endif; ?>
        <?php endif; ?>

        <!-- ================= DATA MASTER ================= -->

        <?php if ($any('department.view', 'study_program.view', 'class.view', 'applicant_type.view', 'service_unit.view', 'service_category.view', 'service.view', 'service_requirement.view')): ?>
            <div class="ult-menu-header">Data Master</div>

            <?php if ($any('department.view', 'study_program.view', 'class.view', 'applicant_type.view')): ?>
                <div class="ult-menu-subheader">Akademik</div>
            <?php endif; ?>
            <?php if ($can('department.view')): ?>
                <a href="<?= site_url('master/departments') ?>" class="<?= $active('master/departments') ?>">
                    <i class="fas fa-building"></i>
                    <span>Jurusan</span>
                </a>
            <?php endif; ?>

            <?php if ($can('study_program.view')): ?>
                <a href="<?= site_url('master/study-programs') ?>" class="<?= $active('master/study-programs') ?>">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Program Studi</span>
                </a>
            <?php endif; ?>

            <?php if ($can('class.view')): ?>
                <a href="<?= site_url('master/classes') ?>" class="<?= $active('master/classes') ?>">
                    <i class="fas fa-chalkboard"></i>
                    <span>Kelas</span>
                </a>
            <?php endif; ?>

            <?php if ($can('applicant_type.view')): ?>
                <a href="<?= site_url('master/applicant-types') ?>" class="<?= $active('master/applicant-types') ?>">
                    <i class="fas fa-id-badge"></i>
                    <span>Jenis Pemohon</span>
                </a>
            <?php endif; ?>

            <?php if ($any('service_unit.view', 'service_category.view', 'service.view', 'service_requirement.view')): ?>
                <div class="ult-menu-subheader">Layanan</div>
            <?php endif; ?>
            <?php if ($can('service_unit.view')): ?>
                <a href="<?= site_url('master/service-units') ?>" class="<?= $active('master/service-units') ?>">
                    <i class="fas fa-sitemap"></i>
                    <span>Unit Layanan</span>
                </a>
            <?php endif; ?>

            <?php if ($can('service_category.view')): ?>
                <a href="<?= site_url('master/service-categories') ?>" class="<?= $active('master/service-categories') ?>">
                    <i class="fas fa-folder-open"></i>
                    <span>Kategori Layanan</span>
                </a>
            <?php endif; ?>

            <?php if ($can('service.view')): ?>
                <a href="<?= site_url('master/services') ?>" class="<?= $active('master/services') ?>">
                    <i class="fas fa-concierge-bell"></i>
                    <span>Daftar Layanan</span>
                </a>
            <?php endif; ?>

            <?php if ($can('service_requirement.view')): ?>
                <a href="<?= site_url('master/service-requirements') ?>" class="<?= $active('master/service-requirements') ?>">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Persyaratan</span>
                </a>
            <?php endif; ?>
        <?php endif; ?>


        <!-- KONTEN & INFORMASI -->
        <?php if ($any('unit_profile.view', 'faq.view')): ?>
            <div class="ult-menu-header">Konten &amp; Informasi</div>
            <?php if ($can('unit_profile.view')): ?>
                <a href="<?= site_url('units-profiles') ?>" class="<?= $active('units-profiles') ?>">
                    <i class="fas fa-address-card"></i>
                    <span>Deskripsi Unit</span>
                </a>
            <?php endif; ?>
            <?php if ($can('faq.view')): ?>
                <a href="<?= site_url('faqs') ?>" class="<?= $active('faqs') ?>">
                    <i class="fas fa-question-circle"></i>
                    <span>FAQ</span>
                </a>
            <?php endif; ?>
        <?php endif; ?>


        <!-- LAPORAN -->
        <?php if ($any('report.view', 'statistic.view')): ?>
            <div class="ult-menu-header">Laporan</div>
            <?php if ($can('report.view')): ?>
                <a href="<?= site_url('reports') ?>" class="<?= $active('reports') ?>">
                    <i class="fas fa-file-invoice"></i>
                    <span>Laporan</span>
                </a>
            <?php endif; ?>
            <?php if ($can('statistic.view')): ?>
                <a href="<?= site_url('statistics') ?>" class="<?= $active('statistics') ?>">
                    <i class="fas fa-chart-bar"></i>
                    <span>Statistik</span>
                </a>
            <?php endif; ?>
        <?php endif; ?>

        <!-- PENGGUNA -->

        <?php if ($any('registration_request.view', 'user.view', 'role.view', 'permission.view')): ?>
            <div class="ult-menu-header">Pengguna</div>
            <?php if ($can('registration_request.view')): ?>
                <a href="<?= site_url('registration-requests') ?>" class="<?= $active('registration-requests') ?>">
                    <i class="fas fa-user-plus"></i>
                    <span>Permintaan Registrasi</span>
                </a>
            <?php endif; ?>
            <?php if ($can('user.view')): ?>
                <a href="<?= site_url('users') ?>" class="<?= $active('users') ?>">
                    <i class="fas fa-users-cog"></i>
                    <span>Manajemen User</span>
                </a>
            <?php endif; ?>
            <?php if ($can('role.view')): ?>
                <a href="<?= site_url('roles') ?>" class="<?= $active('roles') ?>">
                    <i class="fas fa-user-shield"></i>
                    <span>Role &amp; Akses</span>
                </a>
            <?php endif; ?>
            <?php if ($can('permission.view')): ?>
                <a href="<?= site_url('permissions') ?>" class="<?= $active('permissions') ?>">
                    <i class="fas fa-key"></i>
                    <span>Permission</span>
                </a>
            <?php endif; ?>
        <?php endif; ?>


        <!-- SISTEM -->
        <?php if ($any('notification.view', 'activity_log.view')): ?>
            <div class="ult-menu-header">Sistem</div>
            <?php if ($can('notification.view')): ?>
                <a href="<?= site_url('notifications') ?>" class="<?= $active('notifications') ?>">
                    <i class="fas fa-bell"></i>
                    <span>Notifikasi</span>
                </a>
            <?php endif; ?>
            <?php if ($can('activity_log.view')): ?>
                <a href="<?= site_url('activity-logs') ?>" class="<?= $active('activity-logs') ?>">
                    <i class="fas fa-history"></i>
                    <span>Activity Log</span>
                </a>
            <?php endif; ?>
        <?php endif; ?>

        <!-- AKUN -->
        <div class="ult-menu-header">Akun</div>
        <a href="<?= site_url('profile') ?>" class="<?= $active('profile') ?>">
            <i class="fas fa-user-circle"></i>
            <span>Profil Saya</span>
        </a>
        <a href="<?= site_url('logout') ?>" class="ult-menu-logout" data-confirm-logout>
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>

    </nav>

    <script>
        (function () {
            var menu = document.querySelector('.ult-menu');
            if (!menu || !('sessionStorage' in window)) return;
            var KEY = 'ult-sidebar-scroll';
            var apply = function (val) {
                var n = parseInt(val, 10);
                if (!isNaN(n) && n > 0) menu.scrollTop = n;
            };
            try { apply(sessionStorage.getItem(KEY)); } catch (e) {}
            // Terapkan lagi setelah font/gambar selesai dimuat (layout stabil)
            window.addEventListener('load', function () {
                try { apply(sessionStorage.getItem(KEY)); } catch (e) {}
                // Jika belum ada posisi tersimpan, pastikan menu aktif terlihat
                try {
                    if (sessionStorage.getItem(KEY) === null) {
                        var act = menu.querySelector('a.active');
                        if (act && act.scrollIntoView) act.scrollIntoView({ block: 'nearest' });
                    }
                } catch (e) {}
            });
            menu.addEventListener('scroll', function () {
                try { sessionStorage.setItem(KEY, String(menu.scrollTop)); } catch (e) {}
            }, { passive: true });
            menu.querySelectorAll('a').forEach(function (a) {
                a.addEventListener('click', function () {
                    try { sessionStorage.setItem(KEY, String(menu.scrollTop)); } catch (e) {}
                });
            });
        })();
    </script>

</aside>