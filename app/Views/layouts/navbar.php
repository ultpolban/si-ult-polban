<nav class="main-header navbar navbar-expand navbar-dark navbar-ult">

    <!-- Tombol Sidebar -->
    <ul class="navbar-nav">

        <li class="nav-item">

            <a
                class="nav-link"
                data-widget="pushmenu"
                href="#"
                role="button"
            >

                <i class="fas fa-bars"></i>

            </a>

        </li>

    </ul>


    <!-- Bagian Kanan -->
    <ul class="navbar-nav ms-auto">

        <li class="nav-item">

            <span class="nav-link user-navbar">

                <i class="fas fa-user-circle me-2"></i>

                <?= esc($user['nama'] ?? 'Pemohon') ?>

            </span>

        </li>

    </ul>

</nav>