<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="<?= base_url('dashboard') ?>"

        class="brand-link">

        <span class="brand-text">

            SI ULT POLBAN

        </span>

    </a>

    <div class="sidebar">

        <nav>

            <ul class="nav nav-pills nav-sidebar flex-column">

                <li class="nav-item">
                    <a href="<?= base_url('dashboard') ?>" class="nav-link">
                        Dashboard
                    </a>
                </li>

                <?php if (hasRole(1)): ?>

                    <li class="nav-item">
                        <a href="<?= base_url('users') ?>" class="nav-link">
                            <p>Manajemen User</p>
                        </a>
                    </li>

                <?php endif; ?>

                <li class="nav-item">
                    <a href="<?= base_url('logout') ?>" class="nav-link">
                        Logout
                    </a>
                </li>

            </ul>

        </nav>

    </div>

</aside>