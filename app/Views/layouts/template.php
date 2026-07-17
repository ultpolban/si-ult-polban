<?= $this->include('layouts/header') ?>

<body>

<?= $this->include('layouts/navbar') ?>

<div class="container mt-5">

    <?= $this->renderSection('content') ?>

</div>

<?= $this->include('layouts/footer') ?>