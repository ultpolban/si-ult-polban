<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar_unit') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h1>Update Status Tiket</h1>

<p class="text-muted">

Perbarui status penyelesaian layanan

</p>

</div>

<div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item">

<a href="/unit">Dashboard</a>

</li>

<li class="breadcrumb-item">

<a href="/unit/tiket">

Data Tiket

</a>

</li>

<li class="breadcrumb-item active">

Update Status

</li>

</ol>

</div>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card card-success">

<div class="card-header">

<h3 class="card-title">

Form Update Status

</h3>

</div>

<div class="card-body">

<div class="form-group">

<label>Nomor Tiket</label>

<input
type="text"
class="form-control"
value="ULT-20260715-0001"
readonly>

</div>

<div class="form-group">

<label>Status Baru</label>

<select class="form-control">

<option>Diproses</option>

<option>Selesai</option>

<option>Perlu Revisi</option>

</select>

</div>

<div class="form-group">

<label>Catatan Unit</label>

<textarea
class="form-control"
rows="5"
placeholder="Masukkan catatan penyelesaian layanan..."></textarea>

</div>

</div>

<div class="card-footer">

<a href="/unit/detail/1"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

<button class="btn btn-success">

<i class="fas fa-save"></i>

Simpan Status

</button>

</div>

</div>

</div>

</section>

</div>

<?= view('layouts/footer') ?>