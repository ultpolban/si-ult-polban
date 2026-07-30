<?php

$sessionUser = session()->get('user') ?? [];
$dosen = session()->get('dosen_profile') ?? [];

$nama = $dosen['nama']
    ?? $sessionUser['nama']
    ?? 'Pengguna';

?>

<nav class="main-header navbar navbar-expand navbar-dark navbar-ult">

    <ul class="navbar-nav">

        <li class="nav-item">

            <a
                class="nav-link"
                data-widget="pushmenu"
                href="#"
            >

                <i class="fas fa-bars"></i>

            </a>

        </li>

    </ul>

    <ul class="navbar-nav ms-auto">

        <li class="nav-item">

            <span class="nav-link user-navbar">

                <i class="fas fa-user-circle me-2"></i>

                <?= esc($nama) ?>

            </span>

        </li>

    </ul>

</nav>