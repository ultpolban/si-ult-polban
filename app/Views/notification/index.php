<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">
        <h1>Notifikasi</h1>
    </div>
</section>

<section class="content">

<div class="container-fluid">

<?php foreach($notifications as $notif): ?>

<div class="card mb-3 shadow-sm">

<div class="card-body">

<?php

$color = "primary";
$icon  = "fa-bell";

if($notif['icon']=="success"){
    $color="success";
    $icon="fa-check-circle";
}

elseif($notif['icon']=="warning"){
    $color="warning";
    $icon="fa-clock";
}

?>

<div class="d-flex">

<div class="me-3">

<i class="fas <?= $icon ?> fa-2x text-<?= $color ?>"></i>

</div>

<div>

<h5><?= $notif['judul'] ?></h5>

<p class="mb-1">

<?= $notif['isi'] ?>

</p>

<small class="text-muted">

<?= $notif['tanggal'] ?>

</small>

</div>

</div>

</div>

</div>

<?php endforeach; ?>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>