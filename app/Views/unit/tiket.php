<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar_unit') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h2 class="font-weight-bold text-primary">

Data Tiket Unit Tujuan

</h2>

<p class="text-muted">

Daftar tiket yang harus diproses oleh Unit Tujuan

</p>

</div>

<div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item">
Dashboard
</li>

<li class="breadcrumb-item active">
Data Tiket
</li>

</ol>

</div>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<div class="row">

<div class="col-md-4">

<input
type="text"
class="form-control"
placeholder="Cari mahasiswa...">

</div>

</div>

</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-hover">

<thead class="bg-primary">

<tr>

<th>No</th>

<th>NIM</th>

<th>Nama</th>

<th>Layanan</th>

<th>Tanggal</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<tr>

<td>1</td>

<td>231511001</td>

<td>Rafi Putra</td>

<td>Surat Aktif Kuliah</td>

<td>17 Juli 2026</td>

<td>

<span class="badge badge-warning">

Menunggu

</span>

</td>

<td>

<a href="<?= base_url('unit/update-status/1') ?>" class="btn btn-success btn-sm">

<i class="fas fa-edit"></i>

Update

</a>

</td>

</tr>

<tr>

<td>2</td>

<td>231511002</td>

<td>Budi Santoso</td>

<td>Legalisir Ijazah</td>

<td>17 Juli 2026</td>

<td>

<span class="badge badge-info">

Diproses

</span>

</td>

<td>

<a href="<?= base_url('unit/update-status/2') ?>" class="btn btn-success btn-sm">

<i class="fas fa-edit"></i>

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