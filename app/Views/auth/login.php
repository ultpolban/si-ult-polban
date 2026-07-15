<!DOCTYPE html>
<html>

<head>
    <title>Login SI-ULT POLBAN</title>
</head>

<body>

    <h2>Login SI-ULT POLBAN</h2>

    <?php if (session()->getFlashdata('error')) : ?>

        <p style="color:red;">
            <?= session()->getFlashdata('error') ?>
        </p>

    <?php endif; ?>

    <form action="<?= base_url('login') ?>" method="post">

        <p>Email</p>

        <input type="email" name="email">

        <p>Password</p>

        <input type="password" name="password">

        <br><br>

        <button type="submit">

            Login

        </button>

        <p>
            Belum punya akun?
            <a href="<?= base_url('register') ?>">
                Daftar di sini
            </a>
        </p>

    </form>

</body>

</html>