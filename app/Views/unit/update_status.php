<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar_unit') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h2 class="font-weight-bold text-primary">
Update Status Tiket
</h2>

<p class="text-muted">
Perbarui status penyelesaian layanan mahasiswa.
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

Form Update Status

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

<label>Status</label>

<select class="form-control">

<option>Diproses</option>

<option>Selesai</option>

<option>Ditolak</option>

</select>

</div>

<div class="form-group">

<label>Tanggal Update</label>

<input
type="date"
class="form-control">

</div>

</div>

</div>

<div class="form-group">

<label>Catatan Unit</label>

<textarea
class="form-control"
rows="5"
placeholder="Masukkan catatan proses layanan..."></textarea>

</div>

<div class="form-group">

<label>Upload Dokumen (Opsional)</label>

<input
type="file"
class="form-control">

</div>

</form>

</div>

<div class="card-footer">

<button class="btn btn-success">

<i class="fas fa-save"></i>

Simpan Status

</button>

<a href="<?= base_url('unit/tiket') ?>" class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</div>

</section>

</div>

<?= view('layouts/footer') ?>