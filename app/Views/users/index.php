<!DOCTYPE html>
<html>

<head>
    <title>Data User</title>
</head>

<body>

    <h2>Data User</h2>

    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>

    <?php endif; ?>

    <a href="<?= base_url('users/create') ?>">
        <button>Tambah User</button>
    </a>

    <br><br>

    <table border="1" cellpadding="10">

        <tr>

            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>

        </tr>

        <?php $no = 1; ?>

        <?php foreach ($users as $user): ?>

            <tr>

                <td><?= $no++ ?></td>

                <td><?= $user['name'] ?></td>

                <td><?= $user['email'] ?></td>

                <td><?= $user['role_name'] ?></td>

                <td>

                    <a href="<?= base_url('users/edit/' . $user['id']) ?>">

                        <button>Edit</button>

                    </a>

                    <a href="<?= base_url('users/delete/' . $user['id']) ?>"
                        onclick="return confirm('Yakin hapus user?')">

                        <button>Hapus</button>

                    </a>

                </td>

            </tr>

        <?php endforeach; ?>

    </table>

</body>

</html>