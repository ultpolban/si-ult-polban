<aside class="main-sidebar sidebar-dark-danger elevation-4">

    <a href="<?= base_url('dashboard-mahasiswa') ?>" class="brand-link">

        <span class="brand-text font-weight-light">
            SI-ULT POLBAN
        </span>

    </a>

    <div class="sidebar">

        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column">

                <li class="nav-item">
    <a href="<?= base_url('dashboard-mahasiswa') ?>"
       class="nav-link <?= uri_string() == 'dashboard-mahasiswa' ? 'active' : '' ?>">
        <i class="nav-icon fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>

                <li class="nav-item">
                   <a href="<?= base_url('ticket/create') ?>"
   class="nav-link <?= uri_string() == 'ticket/create' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-plus-circle"></i>
                        <p>Ajukan Layanan</p>
                    </a>
                </li>

                <li class="nav-item">
                   <a href="<?= base_url('ticket/history') ?>"
   class="nav-link <?= uri_string() == 'ticket/history' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>Tracking Tiket</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('profile') ?>"
   class="nav-link <?= uri_string() == 'profile' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profil</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('notification') ?>"
   class="nav-link <?= uri_string() == 'notification' ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Notifikasi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('logout') ?>" class="nav-link text-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>

        </nav>

    </div>

</aside>