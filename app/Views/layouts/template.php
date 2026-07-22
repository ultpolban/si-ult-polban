<!DOCTYPE html>
<html>

<head>

    <title><?= $title ?? 'SI ULT'; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>

        body {
            background: #f5f6fa;
        }


        .content {
            min-height: 90vh;
        }


        .card {
            border-radius: 12px;
        }


    </style>


</head>


<body>


<?= view('layouts/navbar'); ?>


<div class="d-flex">


    <?= view('layouts/sidebar'); ?>


    <main class="content container-fluid p-4">

        <?= $this->renderSection('content'); ?>

    </main>


</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap.bundle.min.js"></script>


</body>

</html>