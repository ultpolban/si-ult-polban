<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
</head>

<body>

    <h2>Edit User</h2>

    <?php if (session()->getFlashdata('errors')): ?>

        <div class="alert alert-danger">

            <ul>

                <?php foreach (session()->getFlashdata('errors') as $error): ?>

                    <li><?= $error ?></li>

                <?php endforeach; ?>

            </ul>

        </div>

    <?php endif; ?>

    <form action="<?= base_url('users/update/' . $user['id']) ?>" method="post">

        Nama

        <input
            type="text"
            name="name"
            value="<?= $user['name'] ?>">

        <br><br>

        Email

        <input
            type="email"
            name="email"
            value="<?= $user['email'] ?>">

        <br><br>

        No HP

        <input
            type="text"
            name="phone"
            value="<?= $user['phone'] ?>">

        <br><br>

        Role

        <select name="role_id">

            <?php foreach ($roles as $role): ?>

                <option
                    value="<?= $role['id'] ?>"
                    <?= ($role['id'] == $user['role_id']) ? 'selected' : '' ?>>

                    <?= $role['role_name'] ?>

                </option>

            <?php endforeach; ?>

        </select>

        <br><br>

        <button type="submit">

            Update

        </button>

    </form>

</body>

</html>