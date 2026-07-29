<!DOCTYPE html>
<html>

<head>

<title><?= $title ?? 'SI ULT'; ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1">


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
rel="stylesheet">


<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
rel="stylesheet">



<style>


body{

background:#f4f6f9;
font-family:'Segoe UI',sans-serif;

}



.content{

min-height:100vh;

margin-left:250px;

padding-top:70px;

}



.card{

border:none;

border-radius:15px;

box-shadow:0 5px 15px rgba(0,0,0,.08);

}



.navbar-ult{

height:70px;

background:#293582;

box-shadow:0 3px 10px rgba(0,0,0,.15);

position:fixed;

top:0;

right:0;

left:250px;

z-index:1000;

}



.sidebar{

position:fixed;

top:0;

left:0;

width:250px;

height:100vh;

background:#293582;

z-index:2000;

}



.sidebar .menu a{

display:flex;

align-items:center;

gap:12px;

color:white;

padding:12px 20px;

margin:8px;

border-radius:10px;

text-decoration:none;

transition:.3s;

}



.sidebar .menu a:hover,

.sidebar .menu a.active{

background:#ff7f00;

}



.stat-card{

border-radius:15px;

color:white;

padding:20px;

height:140px;

}



.stat-card i{

font-size:45px;

opacity:.5;

float:right;

}



.table thead{

background:#293582;

color:white;

}



.btn-primary{

background:#293582;

border:none;

}



.btn-primary:hover{

background:#ff7f00;

}



</style>



</head>


<body>



<?= view('layouts/navbar'); ?>


<?= view('layouts/sidebar'); ?>



<main class="content">


<?= $this->renderSection('content'); ?>


</main>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>


</html>