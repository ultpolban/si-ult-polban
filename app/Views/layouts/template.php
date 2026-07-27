<!DOCTYPE html>
<html>

<head>

    <title><?= $title ?? 'SI ULT'; ?></title>


    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
    rel="stylesheet">



    <style>


        body {

            background:#f5f6fa;

        }



        .content {

            min-height:90vh;

        }



        .card {

            border-radius:12px;

        }




        /* ======================
           TABLE HEADER
           WARNA BIRU
        ====================== */


        .table th {

            background:#293582 !important;

            color:white !important;

            border-color:#293582 !important;

        }



        .table {

            background:white;

        }




        /* ======================
           BUTTON PRIMARY
           TAMBAH DATA
        ====================== */


        .btn-primary {

            background:#293582 !important;

            border-color:#293582 !important;

            color:white !important;

        }



        .btn-primary:hover {


            background:#ff7f00 !important;

            border-color:#ff7f00 !important;


        }




        /* ======================
           NAVBAR
        ====================== */


        .navbar-ult {

            background:#293582 !important;

        }



        .navbar-ult .navbar-brand {

            color:white !important;

            font-weight:bold;

        }




        /* ======================
           SIDEBAR
        ====================== */


        .sidebar {


            width:250px;


            min-height:100vh;


            background:#293582;


        }



        .sidebar h4 {


            color:white;


            font-weight:bold;


        }



        .sidebar .nav-link {


            color:white !important;


            padding:10px 15px;


            border-radius:8px;


            transition:0.3s;


        }




        /* ======================
           HOVER MENU SIDEBAR
           WARNA OREN
        ====================== */


        .sidebar .nav-link:hover {


            background:#ff7f00;


            color:white !important;


        }




        /* ======================
           MENU AKTIF
        ====================== */


        .sidebar .nav-link.active {


            background:#ff7f00;


            color:white !important;


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