<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>

    <h2>Registrasi Akun</h2>

    <?php if (session()->getFlashdata('errors')): ?>

        <ul style="color:red">

            <?php foreach (session()->getFlashdata('errors') as $error): ?>

                <li><?= $error ?></li>

            <?php endforeach; ?>

        </ul>

    <?php endif; ?>

    <form action="<?= base_url('register') ?>" method="post">

        <p>Nama</p>

        <input
            type="text"
            name="name"
            value="<?= old('name') ?>">

        <p>Email</p>

        <input
            type="email"
            name="email"
            value="<?= old('email') ?>">

        <p>No HP</p>

        <input
            type="text"
            name="phone"
            value="<?= old('phone') ?>">

        <p>Password</p>

        <input
            type="password"
            name="password">

        <p>Konfirmasi Password</p>

        <input
            type="password"
            name="confirm_password">

        <br><br>

        <button type="submit">

            Daftar

        </button>

    </form>

    <br>

    <a href="<?= base_url('login') ?>">

        Sudah punya akun? Login

    </a>

</body>

</html>