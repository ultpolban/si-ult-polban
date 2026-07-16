<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar_unit') ?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h1>Dashboard Unit</h1>

<p class="text-muted">
Unit Tujuan - Proses Layanan
</p>

</div>

<div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item">
<a href="/unit">Dashboard</a>
</li>

<li class="breadcrumb-item active">
Unit Tujuan
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
<div class="small-box bg-info">
<div class="inner">
<h3>18</h3>
<p>Tiket Masuk</p>
</div>
<div class="icon">
<i class="fas fa-inbox"></i>
</div>
</div>
</div>

<div class="col-lg-3">
<div class="small-box bg-warning">
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
<h3>10</h3>
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
<h3>3</h3>
<p>Revisi</p>
</div>
<div class="icon">
<i class="fas fa-edit"></i>
</div>
</div>
</div>

</div>

<div class="card">

<div class="card-header">

<h3 class="card-title">
Daftar Tiket Unit
</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>

<th>No Tiket</th>

<th>Pemohon</th>

<th>Layanan</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<tr>

<td>1</td>

<td>ULT-20260715-0001</td>

<td>Budi Santoso</td>

<td>Surat Aktif Kuliah</td>

<td>

<span class="badge badge-warning">
Diproses
</span>

</td>

<td>

<a href="/unit/detail/1"
class="btn btn-info btn-sm">

Detail

</a>

<a href="/unit/update-status/1"
class="btn btn-success btn-sm">

Update

</a>

</td>

</tr>

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>

<?= view('layouts/footer') ?>