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

        <span class="menu-title">
            MAIN MENU
        </span>

        <a href="<?= base_url('dashboard') ?>"
            class="<?= service('uri')->getSegment(1) == 'dashboard' ? 'active' : '' ?>">

            <i class="bi bi-speedometer2"></i>

            Dashboard

        </a>

        <a href="<?= base_url('users') ?>"
            class="<?= service('uri')->getSegment(1) == 'users' ? 'active' : '' ?>">

            <i class="bi bi-people-fill"></i>

            Management User

        </a>

        <a href="<?= base_url('roles') ?>"
            class="<?= service('uri')->getSegment(1) == 'roles' ? 'active' : '' ?>">

            <i class="bi bi-person-badge-fill"></i>

            Management Role

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

        <a href="<?= base_url('work-units') ?>"
            class="<?= service('uri')->getSegment(1) == 'work-units' ? 'active' : '' ?>">

            <i class="bi bi-building-fill-gear"></i>

            Unit Kerja

        </a>

        <a href="<?= base_url('classes') ?>"
            class="<?= service('uri')->getSegment(1) == 'classes' ? 'active' : '' ?>">

            <i class="bi bi-journal-bookmark-fill"></i>

            Kelas

        </a>

        <hr>

        <span class="menu-title">
            ACCOUNT
        </span>

        <a href="#">

            <i class="bi bi-person-circle"></i>

            Profil Saya

        </a>

        <a href="#">

            <i class="bi bi-gear-fill"></i>

            Pengaturan

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