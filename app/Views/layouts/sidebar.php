<?php
$uriPath = strtolower(service('request')->getUri()->getPath());
$roleId = (int) session()->get('role_id');

if (str_contains($uriPath, 'kemahasiswaan')) {
    $menuType = 'kemahasiswaan';
} elseif (str_contains($uriPath, 'keuangan')) {
    $menuType = 'keuangan';
} elseif ($roleId === 4) {
    $menuType = 'kemahasiswaan';
} elseif ($roleId === 5) {
    $menuType = 'keuangan';
} else {
    $menuType = 'akademik';
}
?>

<div class="sidebar">
    <div class="text-center text-white py-4">
        <h4 class="fw-bold">SI ULT POLBAN</h4>
    </div>

    <?php if ($menuType === 'akademik'): ?>
        <a href="<?= base_url('unit-layanan/dashboard') ?>"
           class="nav-link <?= url_is('unit-layanan*') ? 'active' : '' ?>">
            <i class="fas fa-building"></i>
            <span>Akademik</span>
        </a>
    <?php elseif ($menuType === 'kemahasiswaan'): ?>
        <a href="<?= base_url('kemahasiswaan/dashboard') ?>"
           class="nav-link <?= url_is('kemahasiswaan*') ? 'active' : '' ?>">
            <i class="fas fa-user-graduate"></i>
            <span>Kemahasiswaan</span>
        </a>
    <?php elseif ($menuType === 'keuangan'): ?>
        <a href="<?= base_url('keuangan/dashboard') ?>"
           class="nav-link <?= url_is('keuangan*') ? 'active' : '' ?>">
            <i class="fas fa-money-bill"></i>
            <span>Keuangan</span>
        </a>
    <?php endif; ?>
</div>