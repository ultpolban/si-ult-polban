<!-- Main Sidebar -->
<aside class="main-sidebar elevation-4">

    <!-- Logo -->
    <a href="<?= base_url('petugas') ?>" class="brand-link text-center">

        <img src="<?= base_url('assets/img/logo-polban.png') ?>"
             alt="POLBAN"
             class="brand-image img-circle elevation-3"
             style="opacity:.9">

        <span class="brand-text font-weight-bold">
            SI-ULT POLBAN
        </span>

    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- User Panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">

                <img src="https://ui-avatars.com/api/?name=Petugas&background=005BAC&color=fff"
                     class="img-circle elevation-2">

            </div>

            <div class="info">

                <a href="#" class="d-block">
                    Petugas ULT
                </a>

            </div>

        </div>

        <!-- Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu">

                <li class="nav-item">

                    <a href="<?= base_url('petugas') ?>" class="nav-link">

                        <i class="nav-icon fas fa-home"></i>

                        <p>Dashboard</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('petugas/tiket') ?>" class="nav-link">

                        <i class="nav-icon fas fa-ticket-alt"></i>

                        <p>Data Tiket</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('unit') ?>" class="nav-link">

                        <i class="nav-icon fas fa-building"></i>

                        <p>Unit Tujuan</p>

                    </a>

                </li>

                <li class="nav-item">

                    <a href="<?= base_url('/') ?>" class="nav-link">

                        <i class="nav-icon fas fa-sign-out-alt"></i>

                        <p>Logout</p>

                    </a>

                </li>

            </ul>

        </nav>

    </div>

</aside>