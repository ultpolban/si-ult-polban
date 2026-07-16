<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar_unit') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">
<h1>Detail Tiket</h1>
<p class="text-muted">
Informasi lengkap tiket layanan
</p>
</div>

<div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item">
<a href="/unit">Dashboard</a>
</li>

<li class="breadcrumb-item">
<a href="/unit/tiket">Data Tiket</a>
</li>

<li class="breadcrumb-item active">
Detail
</li>

</ol>

</div>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header bg-info">

<h3 class="card-title">
Detail Tiket
</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>
<th width="220">Nomor Tiket</th>
<td>ULT-20260715-0001</td>
</tr>

<tr>
<th>Pemohon</th>
<td>Budi Santoso</td>
</tr>

<tr>
<th>Layanan</th>
<td>Surat Aktif Kuliah</td>
</tr>

<tr>
<th>Status</th>
<td>
<span class="badge badge-warning">
Diproses
</span>
</td>
</tr>

<tr>
<th>Prioritas</th>
<td>
<span class="badge badge-danger">
High
</span>
</td>
</tr>

<tr>
<th>Tanggal</th>
<td>15 Juli 2026</td>
</tr>

<tr>
<th>Lampiran</th>
<td>

<a href="#" class="btn btn-primary btn-sm">

<i class="fas fa-download"></i>

Download KTM.pdf

</a>

</td>

</tr>

</table>

</div>

<div class="card-footer">

<a href="/unit/tiket"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

<a href="/unit/update-status/1"
class="btn btn-success">

<i class="fas fa-edit"></i>

Update Status

</a>

</div>

</div>

</div>

</section>

</div>

<?= view('layouts/footer') ?>