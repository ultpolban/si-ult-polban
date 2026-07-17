<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h2 class="font-weight-bold text-primary">
Verifikasi Tiket
</h2>

<p class="text-muted">
Verifikasi pengajuan mahasiswa sebelum diteruskan ke Unit Tujuan.
</p>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header bg-primary">

<h3 class="card-title">

Form Verifikasi Tiket

</h3>

</div>

<div class="card-body">

<form>

<div class="form-group">

<label>Nama Mahasiswa</label>

<input
type="text"
class="form-control"
value="Rafi Putra"
readonly>

</div>

<div class="form-group">

<label>NIM</label>

<input
type="text"
class="form-control"
value="231511001"
readonly>

</div>

<div class="form-group">

<label>Jenis Layanan</label>

<input
type="text"
class="form-control"
value="Surat Aktif Kuliah"
readonly>

</div>

<div class="form-group">

<label>Status Verifikasi</label>

<select class="form-control">

<option>Disetujui</option>

<option>Ditolak</option>

</select>

</div>

<div class="form-group">

<label>Catatan</label>

<textarea
class="form-control"
rows="5"></textarea>

</div>

<button
class="btn btn-primary">

Simpan Verifikasi

</button>

</form>

</div>

</div>

</div>

</section>

</div>

<?= view('layouts/footer') ?>