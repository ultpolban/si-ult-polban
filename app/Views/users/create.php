<!DOCTYPE html>
<html>

<head>
    <title>Tambah User</title>
</head>

<body>

    <h2>Tambah User</h2>

    <?php if (session()->getFlashdata('errors')): ?>

        <div class="alert alert-danger">

            <ul>

                <?php foreach (session()->getFlashdata('errors') as $error): ?>

                    <li><?= $error ?></li>

                <?php endforeach; ?>

            </ul>

        </div>

    <?php endif; ?>

    <form action="<?= base_url('users/store') ?>" method="post">

        Nama

        <input type="text" name="name">

        <br><br>

        Email

        <input type="email" name="email">

        <br><br>

        No HP

        <input type="text" name="phone">

        <br><br>

        Password

        <input type="password" name="password">

        <br><br>

        Role

        <select name="role_id">

            <?php foreach ($roles as $role): ?>

                <option value="<?= $role['id'] ?>">

                    <?= $role['role_name'] ?>

                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <button type="submit">

            Simpan

        </button>

    </form>

</body>

</html>