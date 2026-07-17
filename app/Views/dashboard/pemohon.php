<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>Dashboard Pemohon</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-lg-3">

<div class="small-box bg-primary">

<div class="inner">

<h3>10</h3>

<p>Total Pengajuan</p>

</div>

<div class="icon">

<i class="fas fa-ticket-alt"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-warning">

<div class="inner">

<h3>2</h3>

<p>Menunggu</p>

</div>

<div class="icon">

<i class="fas fa-clock"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-info">

<div class="inner">

<h3>5</h3>

<p>Diproses</p>

</div>

<div class="icon">

<i class="fas fa-spinner"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-success">

<div class="inner">

<h3>3</h3>

<p>Selesai</p>

</div>

<div class="icon">

<i class="fas fa-check-circle"></i>

</div>

</div>

</div>

</div>

<div class="card shadow">

<div class="card-header bg-danger text-white">

<i class="fas fa-history"></i>

Aktivitas Terbaru

</div>

<div class="card-body">

<ul class="list-group">

<li class="list-group-item">

Surat Aktif Kuliah sedang diverifikasi.

</li>

<li class="list-group-item">

Legalisir Ijazah telah selesai.

</li>

<li class="list-group-item">

Pengajuan UKT berhasil dikirim.

</li>

</ul>

</div>

</div>

<div class="row mt-3">

<div class="col-md-4">

<a href="<?= base_url('ticket/create') ?>" class="btn btn-danger btn-block">

<i class="fas fa-plus-circle"></i>

Ajukan Layanan

</a>

</div>

<div class="col-md-4">

<a href="<?= base_url('ticket/history') ?>" class="btn btn-primary btn-block">

<i class="fas fa-search"></i>

Tracking Tiket

</a>

</div>

<div class="col-md-4">

<a href="<?= base_url('profile') ?>" class="btn btn-success btn-block">

<i class="fas fa-user"></i>

Profil Saya

</a>

</div>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>