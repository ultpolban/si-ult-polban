<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h2 class="font-weight-bold text-primary">
Dashboard Petugas
</h2>

<p class="text-muted">
Selamat Datang di Sistem Informasi Unit Layanan Terpadu
Politeknik Negeri Bandung
</p>

</div>

<div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item">
<a href="<?= base_url('petugas') ?>">
Dashboard
</a>
</li>

<li class="breadcrumb-item active">
Home
</li>

</ol>

</div>

</div>

</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-lg-3">

<div class="small-box bg-primary">

<div class="inner">

<h3>20</h3>

<p>Tiket Masuk</p>

<small>+4 Hari Ini</small>

</div>

<div class="icon">

<i class="fas fa-inbox"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-warning">

<div class="inner">

<h3>7</h3>

<p>Perlu Verifikasi</p>

<small>Belum Diproses</small>

</div>

<div class="icon">

<i class="fas fa-user-check"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-success">

<div class="inner">

<h3>14</h3>

<p>Diproses</p>

<small>Oleh Unit Tujuan</small>

</div>

<div class="icon">

<i class="fas fa-spinner"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-danger">

<div class="inner">

<h3>2</h3>

<p>Terlambat SLA</p>

<small>Segera Ditindaklanjuti</small>

</div>

<div class="icon">

<i class="fas fa-clock"></i>

</div>

</div>

</div>

</div>