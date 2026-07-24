<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Logo / Brand -->
    <a href="<?= base_url('dosen/dashboard') ?>" class="brand-link">

        <img
            src="<?= base_url('assets/img/logo-polban.png') ?>"
            alt="Logo POLBAN"
            class="brand-image img-circle elevation-3"
            style="opacity: .9"
        >

        <span class="brand-text font-weight-light">
            SI-ULT POLBAN
        </span>

    </a>


    <!-- Sidebar -->
    <div class="sidebar">


        <!-- =====================================
             PROFIL DOSEN
        ====================================== -->

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class="image">

                <img
                    src="<?= base_url('assets/img/default-profile.png') ?>"
                    class="img-circle elevation-2"
                    alt="Foto Profil"
                >

            </div>

            <div class="info">

                <a
                    href="<?= base_url('dosen/profile') ?>"
                    class="d-block"
                >

                    <?= esc(
                        session()->get('user')['nama']
                        ?? 'Dosen'
                    ) ?>

                </a>

            </div>

        </div>



        <!-- =====================================
             MENU
        ====================================== -->

        <nav class="mt-2">

            <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false"
            >


                <!-- =================================
                     DASHBOARD
                ================================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('dosen/dashboard') ?>"
                        class="nav-link"
                    >

                        <i class="nav-icon fas fa-home"></i>

                        <p>
                            Dashboard
                        </p>

                    </a>

                </li>



                <!-- =================================
                     AJUKAN LAYANAN
                ================================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('dosen/ticket/create') ?>"
                        class="nav-link"
                    >

                        <i class="nav-icon fas fa-plus-circle"></i>

                        <p>
                            Ajukan Layanan
                        </p>

                    </a>

                </li>



                <!-- =================================
                     TRACKING TIKET
                ================================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('dosen/ticket/history') ?>"
                        class="nav-link"
                    >

                        <i class="nav-icon fas fa-ticket-alt"></i>

                        <p>
                            Tracking Tiket
                        </p>

                    </a>

                </li>



                <!-- =================================
                     NOTIFIKASI
                ================================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('dosen/notification') ?>"
                        class="nav-link"
                    >

                        <i class="nav-icon fas fa-bell"></i>

                        <p>
                            Notifikasi
                        </p>

                    </a>

                </li>



                <!-- =================================
                     PROFIL
                ================================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('dosen/profile') ?>"
                        class="nav-link"
                    >

                        <i class="nav-icon fas fa-user"></i>

                        <p>
                            Profil
                        </p>

                    </a>

                </li>



                <!-- =================================
                     PEMBATAS
                ================================== -->

                <li class="nav-header">
                    AKUN
                </li>



                <!-- =================================
                     LOGOUT
                ================================== -->

                <li class="nav-item">

                    <a
                        href="<?= base_url('logout') ?>"
                        class="nav-link"
                    >

                        <i class="nav-icon fas fa-sign-out-alt"></i>

                        <p>
                            Logout
                        </p>

                    </a>

                </li>


            </ul>

        </nav>


    </div>

</aside>