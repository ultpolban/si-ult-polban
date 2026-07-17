<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h2 class="font-weight-bold text-primary">
Disposisi Tiket
</h2>

<p class="text-muted">
Teruskan tiket ke Unit Tujuan yang sesuai
</p>

</div>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card card-primary">

<div class="card-header">

<h3 class="card-title">

Form Disposisi

</h3>

</div>

<div class="card-body">

<form>

<div class="row">

<div class="col-md-6">

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

</div>

<div class="col-md-6">

<div class="form-group">

<label>Pilih Unit Tujuan</label>

<select class="form-control">

<option>-- Pilih Unit --</option>

<option>Unit Akademik</option>

<option>Unit Keuangan</option>

<option>Jurusan</option>

<option>Kemahasiswaan</option>

<option>Perpustakaan</option>

</select>

</div>

<div class="form-group">

<label>Prioritas</label>

<select class="form-control">

<option>Normal</option>

<option>Tinggi</option>

</select>

</div>

</div>

</div>

<div class="form-group">

<label>Catatan Petugas</label>

<textarea
class="form-control"
rows="5"
placeholder="Masukkan catatan..."></textarea>

</div>

</form>

</div>

<div class="card-footer">

<button class="btn btn-success">

<i class="fas fa-paper-plane"></i>

Kirim Disposisi

</button>

<a href="<?= base_url('petugas/tiket') ?>" class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</div>

</section>

</div>

<?= view('layouts/footer') ?>