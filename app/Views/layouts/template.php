<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<title><?= $title ?? 'SI ULT POLBAN' ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
rel="stylesheet">


<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}


body{

    background:#eef2f7;

    font-family:'Segoe UI',sans-serif;

}


/* ================= NAVBAR ================= */

.navbar-ult{

    position:fixed;

    top:0;

    left:250px;

    right:0;

    height:70px;

    background:#293582;

    box-shadow:0 5px 18px rgba(0,0,0,.15);

    z-index:1000;

}



/* ================= SIDEBAR ================= */


.sidebar{

    position:fixed;

    top:0;

    left:0;

    width:250px;

    height:100vh;

    background:#293582;

    overflow-y:auto;

    box-shadow:3px 0 15px rgba(0,0,0,.15);

    z-index:2000;

}

.sidebar-brand {
    border-bottom:1px solid rgba(255,255,255,.12);
}

.sidebar-user {
    display:flex;
    align-items:center;
    gap:12px;
    min-height:70px;
    padding:12px 16px;
    color:#fff;
    border-bottom:1px solid rgba(255,255,255,.12);
}

.sidebar-avatar {
    display:flex;
    align-items:center;
    justify-content:center;
    width:34px;
    height:34px;
    flex:0 0 34px;
    border-radius:50%;
    background:#6559e8;
    color:#fff;
    font-size:12px;
    font-weight:700;
}

.sidebar-user-info {
    min-width:0;
    line-height:1.2;
}

.sidebar-user-info strong,
.sidebar-user-info small {
    display:block;
    overflow:hidden;
    text-overflow:ellipsis;
    white-space:nowrap;
}

.sidebar-user-info strong {
    font-size:12px;
}

.sidebar-user-info small {
    margin-top:4px;
    color:rgba(255,255,255,.58);
    font-size:9px;
}

.sidebar-section {
    padding:14px 12px 6px;
    color:rgba(255,255,255,.58);
    font-size:9px;
    font-weight:700;
    letter-spacing:.03em;
    text-transform:uppercase;
}

.sidebar .nav-link {
    display:flex;
    align-items:center;
    gap:10px;
    margin:0 7px 2px;
    padding:10px 9px;
    border-radius:4px;
    color:rgba(255,255,255,.9);
    font-size:12px;
}

.sidebar .nav-link:hover,
.sidebar .nav-link.active {
    background:rgba(255,255,255,.12);
    color:#fff;
}

.sidebar .nav-link i {
    width:16px;
    text-align:center;
    font-size:12px;
}

.sidebar-logout {
    margin-top:auto;
    padding:8px 0 12px;
    border-top:1px solid rgba(255,255,255,.12);
}



/* ================= TITLE SIDEBAR ================= */


.sidebar h4,
.sidebar .fw-bold{

    color:white !important;

    text-align:center;

    padding:15px;

    transition:.3s;

    cursor:pointer;

}



/* ================= TITLE SIDEBAR ================= */


.sidebar h4,
.sidebar .fw-bold{

    color:white !important;

    text-align:center;

    padding:15px;

    transition:.3s;

    cursor:pointer;

}


/* tetap putih saat kursor */

.sidebar h4:hover,
.sidebar .fw-bold:hover{

    color:white !important;

}



/* ================= CONTENT ================= */


.content{

    margin-left:250px;

    margin-top:70px;

    padding:30px;

    min-height:100vh;

}



/* ================= CARD ================= */


.card{

    border:none;

    border-radius:18px;

    box-shadow:0 10px 25px rgba(0,0,0,.08);

    transition:.3s;

}

.dashboard-overview-card {
    border-radius: 8px;
}

.overview-icon {
    display:flex;
    align-items:center;
    justify-content:center;
    width:42px;
    height:42px;
    border-radius:6px;
    color:#fff;
    flex:0 0 42px;
}

.overview-number {
    display:block;
    color:#1267f5;
    font-size:26px;
    line-height:1.1;
}

.dashboard-overview-card small {
    display:block;
    color:#64748b;
    margin-top:5px;
}


.card:hover{

    transform:translateY(-2px);

}


.card-header{

    background:#fff;

    border:none;

    padding:18px 25px;

    border-radius:18px 18px 0 0 !important;

}


.card-body{

    padding:22px;

}



/* ================= STAT CARD ================= */


.stat-card{

    position:relative;

    overflow:hidden;

    border-radius:18px;

    color:#fff;

    padding:25px;

    height:160px;

    transition:.3s;

    box-shadow:0 12px 25px rgba(0,0,0,.15);

}


.stat-card:hover{

    transform:translateY(-8px);

}



.stat-card h2{

    font-size:38px;

    font-weight:bold;

}



.stat-card i{

    position:absolute;

    right:20px;

    bottom:20px;

    font-size:55px;

    opacity:.25;

}



/* ================= TABLE ================= */


.table{

    margin-bottom:0;

}


.table thead{

    background:#293582;

    color:white;

}



.table thead th{

    border:none;

    padding:15px;

}



.table tbody td{

    padding:15px;

    vertical-align:middle;

}



.table tbody tr:hover{

    background:#f5f7fb;

}



/* ================= BUTTON ================= */


.btn-primary{

    background:#293582;

    border:none;

    border-radius:10px;

    padding:8px 18px;

    transition:.3s;

}



.btn-primary:hover{

    background:#ff7f00;

}



/* ================= BADGE ================= */


.badge{

    padding:8px 12px;

    border-radius:30px;

}



/* ================= SIDEBAR MENU ================= */


.sidebar .nav{

    padding:0 15px;

}


.sidebar .nav-link{

    display:flex;

    align-items:center;

    gap:12px;

    color:white !important;

    padding:15px 20px;

    border-radius:15px;

    font-size:16px;

    font-weight:600;

    margin-bottom:8px;

    transition:.3s ease;

    position:relative;

    overflow:hidden;

}



/* icon */

.sidebar .nav-link i{

    width:22px;

    text-align:center;

    font-size:18px;

    color:white;

}



/* efek persegi panjang oren */

.sidebar .nav-link:hover{

    background:#ff7f00;

    color:white !important;

    transform:translateX(3px);

}



/* icon tetap putih */

.sidebar .nav-link:hover i{

    color:white;

}


/* kotak oren */

.sidebar .nav-link::after{

    content:"";

    position:absolute;

    left:0;

    top:0;

    width:0;

    height:100%;

    background:#ff7f00;

    border-radius:15px;

    transition:.3s ease;

    z-index:-1;

}













.sidebar .nav-link i{

    width:22px;

    text-align:center;

    font-size:18px;

}



/* ================= RESPONSIVE ================= */


@media(max-width:992px){

    .sidebar{

        width:70px;

    }


    .content{

        margin-left:70px;

    }


    .navbar-ult{

        left:70px;

    }

}




</style>

</head>


<body>


<?= view('layouts/navbar') ?>


<?= view('layouts/sidebar') ?>


<main class="content">

<?= $this->renderSection('content') ?>

</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>