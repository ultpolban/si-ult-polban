<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title><?= esc($title ?? 'Login') ?></title>

    <link rel="stylesheet"
        href="<?= base_url('assets/css/bootstrap.min.css') ?>">

    <link rel="stylesheet"
        href="<?= base_url('assets/css/app.css') ?>">

</head>

<body class="bg-light">

    <?= $this->renderSection('content') ?>

    <script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>

</body>

</html>