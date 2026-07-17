<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar_unit') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h2 class="font-weight-bold text-primary">

Laporan Unit Tujuan

</h2>

<p class="text-muted">

Rekapitulasi penyelesaian layanan mahasiswa.

</p>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-lg-3">

<div class="small-box bg-info">

<div class="inner">

<h3>30</h3>

<p>Total Tiket</p>

</div>

<div class="icon">

<i class="fas fa-ticket-alt"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-warning">

<div class="inner">

<h3>8</h3>

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

<h3>20</h3>

<p>Selesai</p>

</div>

<div class="icon">

<i class="fas fa-check-circle"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-danger">

<div class="inner">

<h3>2</h3>

<p>Ditolak</p>

</div>

<div class="icon">

<i class="fas fa-times-circle"></i>

</div>

</div>

</div>

</div>

<div class="card">

<div class="card-header">

<h3 class="card-title">

Rekap Data Tiket

</h3>

</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-hover">

<thead class="bg-primary">

<tr>

<th>No</th>

<th>Layanan</th>

<th>Total</th>

<th>Selesai</th>

<th>Diproses</th>

</tr>

</thead>

<tbody>

<tr>

<td>1</td>

<td>Surat Aktif Kuliah</td>

<td>10</td>

<td>8</td>

<td>2</td>

</tr>

<tr>

<td>2</td>

<td>Legalisir Ijazah</td>

<td>20</td>

<td>12</td>

<td>8</td>

</tr>

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>

<?= view('layouts/footer') ?>