<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">

    <!-- Tombol Sidebar -->
    <ul class="navbar-nav">

        <li class="nav-item">

            <a class="nav-link" data-widget="pushmenu" href="#">

                <i class="fas fa-bars"></i>

            </a>

        </li>

    </ul>

    <!-- Judul -->
    <ul class="navbar-nav ml-2">

        <li class="nav-item d-flex align-items-center">

            <img src="<?= base_url('assets/img/logo-polban.png') ?>"
                 width="35"
                 class="mr-2">

            <span class="font-weight-bold text-primary">

                Sistem Informasi Unit Layanan Terpadu

            </span>

        </li>

    </ul>

    <!-- Right Navbar -->

    <ul class="navbar-nav ml-auto">

        <!-- Notifikasi -->

        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#">

                <i class="far fa-bell"></i>

                <span class="badge badge-danger navbar-badge">
                    3
                </span>

            </a>

        </li>

        <!-- User -->

        <li class="nav-item dropdown">

            <a class="nav-link" data-toggle="dropdown" href="#">

                <img src="https://ui-avatars.com/api/?name=Petugas&background=005BAC&color=fff"
                     class="img-circle elevation-2"
                     width="32">

                <span class="ml-2">

                    Petugas ULT

                </span>

            </a>

            <div class="dropdown-menu dropdown-menu-right">

                <a href="#" class="dropdown-item">

                    <i class="fas fa-user mr-2"></i>

                    Profil

                </a>

                <div class="dropdown-divider"></div>

                <a href="<?= base_url('/') ?>" class="dropdown-item">

                    <i class="fas fa-sign-out-alt mr-2"></i>

                    Logout

                </a>

            </div>

        </li>

    </ul>

</nav>