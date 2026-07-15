<h1>Dashboard SI-ULT POLBAN</h1>

<p>Selamat datang <?= session()->get('name') ?></p>

<p>Role ID : <?= session()->get('role_id') ?></p>

<a href="<?= base_url('logout') ?>">Logout</a>