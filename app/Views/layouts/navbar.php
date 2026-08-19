<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto align-items-center">

        <!-- Lonceng Notifikasi Dropdown -->
        <li class="nav-item dropdown mr-2">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <?php if (isset($submitted) && $submitted > 0): ?>
                    <span class="badge badge-danger navbar-badge"><?= $submitted ?></span>
                <?php endif; ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">
                    <?= isset($submitted) ? $submitted : 0 ?> Notifikasi Baru
                </span>
                <div class="dropdown-divider"></div>

                <a href="<?= base_url('verification') ?>" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 
                    Ada <?= isset($submitted) ? $submitted : 0 ?> tiket menunggu verifikasi
                </a>

                <div class="dropdown-divider"></div>
                <a href="<?= base_url('datatiket') ?>" class="dropdown-item dropdown-footer">Lihat Semua Tiket</a>
            </div>
        </li>

        <!-- Profile Avatar & Name -->
        <li class="nav-item d-flex align-items-center">
            <span class="badge badge-primary rounded-circle mr-2 p-2" style="width: 28px; height: 28px; display: inline-flex; align-items: center; justify-content: center; font-size: 0.75rem;">
                PE
            </span>
            <span class="font-weight-bold text-dark" style="font-size: 0.9rem;">
                <?= session()->get('name') ?>
            </span>
        </li>

    </ul>

</nav>