<!-- Navbar -->
<nav class="main-header navbar navbar-expand shadow-sm" style="background:#2B2E83; border:none;">

    <!-- Tombol Sidebar -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-white" data-widget="pushmenu" href="#">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Judul -->
    <ul class="navbar-nav ml-2">
        <li class="nav-item d-flex align-items-center">
            <img src="<?= base_url('assets/img/logo-polban.png') ?>" width="35" class="mr-2">
            <span class="font-weight-bold text-white">Sistem Informasi Unit Layanan Terpadu</span>
        </li>
    </ul>

    <!-- Right Navbar -->
    <ul class="navbar-nav ml-auto align-items-center">

        <?php
        // Logika sederhana: Hitung jumlah tiket berstatus 'Submitted'
        // Variabel $tiket_list ini harus tersedia di controller/view yang memanggil navbar
        $notifCount = 0;
        if (isset($tiket_list) && is_array($tiket_list)) {
            foreach ($tiket_list as $t) {
                if (strtolower($t['status'] ?? '') === 'submitted') {
                    $notifCount++;
                }
            }
        }
        ?>

        <!-- Notifikasi -->
        <li class="nav-item dropdown">
            <a class="nav-link text-white" data-toggle="dropdown" href="#">
                <i class="fas fa-bell"></i>
                <?php if ($notifCount > 0): ?>
                    <span class="badge badge-danger navbar-badge"><?= $notifCount ?></span>
                <?php endif; ?>
            </a>
            
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header font-weight-bold">
                    <?= $notifCount ?> Notifikasi Baru
                </span>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('petugas/tiket?status=Submitted') ?>" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> Ada <?= $notifCount ?> tiket menunggu verifikasi
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('petugas/tiket') ?>" class="dropdown-item dropdown-footer">Lihat Semua Tiket</a>
            </div>
        </li>

        <!-- User -->
        <li class="nav-item dropdown ml-2">
            <a class="nav-link text-white" data-toggle="dropdown" href="#">
                <img src="https://ui-avatars.com/api/?name=Petugas&background=005BAC&color=fff" class="img-circle elevation-2" width="32">
                <span class="ml-2">Petugas ULT</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user mr-2"></i> Profil
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('/') ?>" class="dropdown-item">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
            </div>
        </li>

    </ul>
</nav>