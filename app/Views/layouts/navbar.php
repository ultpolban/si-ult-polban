<nav class="topbar">

    <div>

        <h4 class="page-title mb-0">

            <?= esc($title ?? 'Dashboard') ?>

        </h4>

        <small class="text-muted">

            Sistem Informasi Unit Layanan Terpadu POLBAN

        </small>

    </div>

    <div class="topbar-right">

        <div class="today">

            <i class="bi bi-calendar-event me-1"></i>

            <?= date('d F Y') ?>

        </div>

        <button
            class="notification"
            data-bs-toggle="tooltip"
            title="Notifikasi">

            <i class="bi bi-bell-fill"></i>

        </button>

        <div class="dropdown">

            <a
                href="#"
                class="text-decoration-none text-white d-flex align-items-center"
                data-bs-toggle="dropdown">

                <div class="avatar me-3">

                    <?= strtoupper(substr(session('full_name') ?? 'A', 0, 1)) ?>

                </div>

                <div class="text-start">

                    <div class="fw-semibold">

                        <?= esc(session('full_name') ?? 'Administrator') ?>

                    </div>

                    <span class="role-badge">

                        Administrator

                    </span>

                </div>

                <i class="bi bi-chevron-down ms-3"></i>

            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow">

                <li>

                    <h6 class="dropdown-header">

                        Akun

                    </h6>

                </li>

                <li>

                    <a
                        class="dropdown-item"
                        href="#">

                        <i class="bi bi-person-circle me-2"></i>

                        Profil Saya

                    </a>

                </li>

                <li>

                    <a
                        class="dropdown-item"
                        href="#">

                        <i class="bi bi-gear me-2"></i>

                        Pengaturan

                    </a>

                </li>

                <li>

                    <hr class="dropdown-divider">

                </li>

                <li>

                    <a
                        class="dropdown-item text-danger"
                        href="<?= base_url('logout') ?>">

                        <i class="bi bi-box-arrow-right me-2"></i>

                        Logout

                    </a>

                </li>

            </ul>

        </div>

    </div>

</nav>