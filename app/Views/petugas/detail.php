<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h2 class="font-weight-bold text-primary">

Detail Tiket

</h2>

<p class="text-muted">

Informasi lengkap pengajuan mahasiswa

</p>

</div>

<div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item">
Dashboard
</li>

<li class="breadcrumb-item">
Data Tiket
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

<div class="card card-primary">

<div class="card-header">

<h3 class="card-title">

Data Pengajuan

</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Nama Mahasiswa</label>

<input type="text" class="form-control" value="Rafi Putra" readonly>

</div>

<div class="form-group">

<label>NIM</label>

<input type="text" class="form-control" value="231511001" readonly>

</div>

<div class="form-group">

<label>Email</label>

<input type="text" class="form-control" value="rafi@student.polban.ac.id" readonly>

</div>

<div class="form-group">

<label>No HP</label>

<input type="text" class="form-control" value="081234567890" readonly>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Jenis Layanan</label>

<input type="text" class="form-control" value="Surat Aktif Kuliah" readonly>

</div>

<div class="form-group">

<label>Tanggal Pengajuan</label>

<input type="text" class="form-control" value="17 Juli 2026" readonly>

</div>

<div class="form-group">

<label>Status</label>

<input type="text" class="form-control" value="Menunggu Verifikasi" readonly>

</div>

<div class="form-group">

<label>Lampiran</label>

<br>

<a href="#" class="btn btn-info">

<i class="fas fa-file-pdf"></i>

Lihat Lampiran

</a>

</div>

</div>

</div>

<div class="form-group">

<label>Deskripsi Pengajuan</label>

<textarea class="form-control" rows="5" readonly>Saya mengajukan Surat Aktif Kuliah untuk keperluan beasiswa.</textarea>

</div>

</div>

<div class="card-footer">

<a href="<?= base_url('petugas/verifikasi/1') ?>" class="btn btn-success">

<i class="fas fa-check"></i>

Verifikasi

</a>

<a href="<?= base_url('petugas/tiket') ?>" class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</div>

</section>

</div>

<?= view('layouts/footer') ?>