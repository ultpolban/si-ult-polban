<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>Ajukan Layanan</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-danger text-white">

Form Pengajuan Layanan

</div>

<div class="card-body">

<form action="<?= base_url('ticket/store') ?>" method="post" enctype="multipart/form-data">

<div class="mb-3">

<label>Layanan</label>

<select class="form-control" name="service">

<option value="">Pilih Layanan</option>

<?php foreach($services as $service): ?>

<option value="<?= $service['nama']; ?>">

<?= $service['nama']; ?>

</option>

<?php endforeach; ?>

</select>

</div>

<div class="mb-3">

<label>Nama Lengkap</label>

<input
type="text"
name="nama"
class="form-control"
placeholder="Masukkan Nama">

</div>

<div class="mb-3">

<label>NIM</label>

<input
type="text"
name="nim"
class="form-control">

</div>

<div class="mb-3">

<label>Program Studi</label>

<input
type="text"
name="prodi"
class="form-control">

</div>

<div class="mb-3">
    <label>Keperluan</label>
    <textarea
        name="keperluan"
        class="form-control"
        rows="4"></textarea>
</div>

<div class="mb-3">
    <label>Upload KTM (opsional)</label>
    <input type="file" name="ktm" class="form-control">
</div>

<div class="mb-3">
    <label>Upload KRS (opsional)</label>
    <input type="file" name="krs" class="form-control">
</div>

<div class="mb-3">
    <label>Catatan</label>
    <textarea name="catatan" class="form-control" rows="3"></textarea>
</div>

<button class="btn btn-danger">

<i class="fas fa-paper-plane"></i>

Kirim Pengajuan

</button>

</form>

</div>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>