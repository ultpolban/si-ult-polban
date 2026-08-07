<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_orangtua') ?>

<div class="content-wrapper">

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1
                    style="
                        font-weight:700;
                        color:#0b3d91;
                    ">

                    <i class="fas fa-bell mr-2"></i>

                    Notifikasi

                </h1>

            </div>

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item">

                        <a href="<?= base_url('dashboard-orangtua') ?>">

                            Dashboard

                        </a>

                    </li>

                    <li class="breadcrumb-item active">

                        Notifikasi

                    </li>

                </ol>

            </div>

        </div>

    </div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-lg-12">

<div
class="card shadow-sm"
style="
border-radius:15px;
">

<div
class="card-header"
style="
background:#0b3d91;
color:white;
border-bottom:4px solid #f28c28;
">

<div class="d-flex justify-content-between align-items-center">

<h3 class="card-title mb-0">

<i class="fas fa-bell mr-2"></i>

Daftar Notifikasi

</h3>

<span
class="badge badge-light">

<?= count($notifications) ?>

Notifikasi

</span>

</div>

</div>

<div class="card-body p-0">

<?php if(empty($notifications)): ?>

<div
class="text-center py-5">

<i
class="fas fa-bell-slash"
style="
font-size:80px;
color:#adb5bd;
"></i>

<h4
class="mt-3 text-muted">

Belum ada notifikasi

</h4>

<p class="text-muted">

Semua informasi mengenai tiket
akan muncul di sini.

</p>

</div>

<?php else: ?>

<div class="list-group list-group-flush">
    <?php foreach($notifications as $notif): ?>

<div
class="list-group-item p-4"
style="
border-left:6px solid #0b3d91;
transition:.25s;
">

<div class="d-flex">

<div
class="mr-4 text-center"
style="
width:60px;
">

<div
style="
width:55px;
height:55px;
border-radius:50%;
background:#0b3d91;
display:flex;
align-items:center;
justify-content:center;
">

<i
class="<?= $notif['icon'] ?>"
style="
font-size:22px;
color:white;
"></i>

</div>

</div>

<div class="flex-fill">

<div
class="d-flex
justify-content-between
align-items-center
flex-wrap">

<h5
class="mb-1"
style="
font-weight:700;
color:#0b3d91;
">

<?= esc($notif['judul']) ?>

</h5>

<small class="text-muted">

<i class="far fa-clock mr-1"></i>

<?= esc($notif['waktu']) ?>

</small>

</div>

<p
class="mb-2 text-muted">

<?= esc($notif['pesan']) ?>

</p>

<span
class="badge badge-<?= $notif['color'] ?>">

<?= esc($notif['judul']) ?>

</span>

</div>

</div>

</div>

<?php endforeach; ?>
</div>

<?php endif; ?>

</div>

<div
    class="card-footer
    d-flex
    justify-content-between
    align-items-center
    flex-wrap">

    <small class="text-muted">

        Total Notifikasi :
        <strong>

            <?= count($notifications) ?>

        </strong>

    </small>

    <button
        class="btn"
        style="
            background:#0b3d91;
            color:white;
            font-weight:600;
            border-radius:8px;
        ">

        <i class="fas fa-check-double mr-2"></i>

        Tandai Semua Sudah Dibaca

    </button>

</div>

</div>

</div>

</div>

<!-- =====================================================
     TIPS
====================================================== -->

<div class="row mt-4">

<div class="col-lg-12">

<div
class="card shadow-sm"
style="
border-left:5px solid #f28c28;
border-radius:15px;
">

<div class="card-body">

<h4
style="
font-weight:700;
color:#0b3d91;
">

<i class="fas fa-info-circle mr-2"></i>

Informasi

</h4>

<p class="mb-0 text-muted">

Semua perubahan status tiket akan otomatis
muncul pada halaman ini.

Mulai dari:

<strong>Submitted</strong>,
<strong>Diverifikasi</strong>,
<strong>Diteruskan</strong>,
<strong>Diproses</strong>,
hingga
<strong>Selesai</strong>.

</p>

</div>

</div>

</div>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>