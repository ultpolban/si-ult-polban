<div class="sidebar">

    <!-- Sidebar Header -->
    <div class="sidebar-header">

        <div class="logo-icon" style="background: transparent;">

            <img src="<?= base_url('assets/images/ULT POLBAN.png') ?>" alt="Logo" style="width: 100%; height: 100%; object-fit: contain; filter: drop-shadow(0px 0px 8px rgba(255,255,255,0.8));">

        </div>

        <div>

            <h4>SI ULT</h4>

            <p>Politeknik Negeri Bandung</p>

        </div>

    </div>

    <!-- Menu -->
    <div class="sidebar-menu">

        <span class="menu-title">
            MANAGEMENT
        </span>

        <a href="<?= base_url('dashboard') ?>"
            class="<?= service('uri')->getSegment(1) == 'dashboard' ? 'active' : '' ?>">

            <i class="bi bi-speedometer2"></i>

            Dashboard

        </a>

        <a href="<?= base_url('users') ?>"
            class="<?= service('uri')->getSegment(1) == 'users' ? 'active' : '' ?>">

            <i class="bi bi-person-fill"></i>

            User

        </a>

        <a href="<?= base_url('roles') ?>"
            class="<?= service('uri')->getSegment(1) == 'roles' ? 'active' : '' ?>">

            <i class="bi bi-shield-lock-fill"></i>

            Role

        </a>

        <a href="<?= base_url('permissions') ?>"
            class="<?= service('uri')->getSegment(1) == 'permissions' ? 'active' : '' ?>">

            <i class="bi bi-key-fill"></i>

            Permission

        </a>

        <a href="<?= base_url('user-types') ?>"
            class="<?= service('uri')->getSegment(1) == 'user-types' ? 'active' : '' ?>">

            <i class="bi bi-person-vcard-fill"></i>

            Jenis Pemohon

        </a>

        <hr>

        <span class="menu-title">
            MASTER DATA
        </span>

        <a href="<?= base_url('departments') ?>"
            class="<?= service('uri')->getSegment(1) == 'departments' ? 'active' : '' ?>">

            <i class="bi bi-diagram-3-fill"></i>

            Jurusan

        </a>

        <a href="<?= base_url('study-programs') ?>"
            class="<?= service('uri')->getSegment(1) == 'study-programs' ? 'active' : '' ?>">

            <i class="bi bi-mortarboard-fill"></i>

            Program Studi

        </a>

        <a href="<?= base_url('classes') ?>"
            class="<?= service('uri')->getSegment(1) == 'classes' ? 'active' : '' ?>">

            <i class="bi bi-journal-bookmark-fill"></i>

            Kelas

        </a>

        <a href="<?= base_url('work-units') ?>"
            class="<?= service('uri')->getSegment(1) == 'work-units' ? 'active' : '' ?>">

            <i class="bi bi-building-fill-gear"></i>

            Unit Kerja

        </a>

        <a href="<?= base_url('unit-layanan') ?>"
            class="<?= service('uri')->getSegment(1) == 'unit-layanan' ? 'active' : '' ?>">

            <i class="bi bi-building-fill"></i>

            Unit Layanan

        </a>

        <a href="<?= base_url('kategori-layanan') ?>"
            class="<?= service('uri')->getSegment(1) == 'kategori-layanan' ? 'active' : '' ?>">

            <i class="bi bi-tags-fill"></i>

            Kategori Layanan

        </a>

        <a href="<?= base_url('layanan') ?>"
            class="<?= service('uri')->getSegment(1) == 'layanan' ? 'active' : '' ?>">

            <i class="bi bi-clipboard-check"></i>

            Layanan

        </a>

        <a href="<?= base_url('persyaratan-layanan') ?>"
            class="<?= service('uri')->getSegment(1) == 'persyaratan-layanan' ? 'active' : '' ?>">

            <i class="bi bi-journal-text"></i>

            Persyaratan Layanan

        </a>

        <hr>

        <span class="menu-title">
            LAYANAN
        </span>

        <a href="<?= base_url('pengajuan-layanan') ?>"
            class="<?= service('uri')->getSegment(1) == 'pengajuan-layanan' ? 'active' : '' ?>">

            <i class="bi bi-send-fill"></i>

            Pengajuan Layanan

        </a>

        <a href="<?= base_url('verifikasi') ?>"
            class="<?= service('uri')->getSegment(1) == 'verifikasi' ? 'active' : '' ?>">

            <i class="bi bi-patch-check-fill"></i>

            Verifikasi

        </a>

        <hr>

        <span class="menu-title">
            SYSTEM
        </span>

        <a href="<?= base_url('notifikasi') ?>"
            class="<?= service('uri')->getSegment(1) == 'notifikasi' ? 'active' : '' ?>">
            <i class="bi bi-bell-fill"></i>
            Notifikasi
        </a>

        <a href="<?= base_url('activity-log') ?>"
            class="<?= service('uri')->getSegment(1) == 'activity-log' ? 'active' : '' ?>">
            <i class="bi bi-clock-history"></i>
            Activity Log
        </a>

        <hr>

        <span class="menu-title">
            TIKET
        </span>

        <a href="<?= base_url('tiket/manajemen') ?>"
            class="<?= service('uri')->getSegment(2) == 'manajemen' ? 'active' : '' ?>">
            <i class="bi bi-view-stacked"></i>
            Manajemen Tiket
        </a>

        <a href="<?= base_url('tiket/buat') ?>"
            class="<?= service('uri')->getSegment(2) == 'buat' ? 'active' : '' ?>">
            <i class="bi bi-plus-circle-fill"></i>
            Buat Tiket
        </a>

        <a href="<?= base_url('tiket/lacak') ?>"
            class="<?= service('uri')->getSegment(2) == 'lacak' ? 'active' : '' ?>">
            <i class="bi bi-search"></i>
            Lacak Tiket
        </a>

        <a href="<?= base_url('laporan') ?>"
            class="<?= service('uri')->getSegment(1) == 'laporan' ? 'active' : '' ?>">
            <i class="bi bi-file-earmark-text-fill"></i>
            Laporan
        </a>

        <a href="<?= base_url('statistik') ?>"
            class="<?= service('uri')->getSegment(1) == 'statistik' ? 'active' : '' ?>">
            <i class="bi bi-pie-chart-fill"></i>
            Statistik
        </a>

        <a href="<?= base_url('profil') ?>"
            class="<?= service('uri')->getSegment(1) == 'profil' ? 'active' : '' ?>">
            <i class="bi bi-person-gear"></i>
            Profil
        </a>

        <a href="<?= base_url('logout') ?>">

            <i class="bi bi-box-arrow-right"></i>

            Logout

        </a>

    </div>

    <!-- Footer Sidebar -->
    <div class="sidebar-footer">

        <small>

            SI ULT POLBAN

            <br>

            Version 1.0

        </small>

    </div>

</div>