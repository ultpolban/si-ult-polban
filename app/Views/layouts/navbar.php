<nav class="main-header navbar navbar-expand navbar-white navbar-light">

<ul class="navbar-nav">

<li class="nav-item">

<a class="nav-link" data-widget="pushmenu">

<i class="fas fa-bars"></i>

</a>

</li>

</ul>

<ul class="navbar-nav ms-auto">

<li class="nav-item">

<span class="nav-link">

<i class="fas fa-user-circle"></i>

<?= isset($user['nama']) ? $user['nama'] : 'Pemohon'; ?>

</span>

</li>

</ul>

</nav>