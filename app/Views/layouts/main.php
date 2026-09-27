<!DOCTYPE html>
<html lang="id">

<head>
    <?= $this->include('layouts/head') ?>
</head>

<body>

    <div class="ult-wrapper">

        <?= $this->include('layouts/sidebar') ?>

        <div class="ult-main">

            <?= $this->include('layouts/navbar') ?>

            <?= $this->include('layouts/breadcrumb') ?>

            <main class="ult-content">

                <?= $this->renderSection('content') ?>

            </main>

            <?= $this->include('layouts/footer') ?>

        </div>

    </div>

    <?= $this->include('layouts/scripts') ?>

</body>

</html>