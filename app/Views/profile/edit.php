<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>Edit Profil</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header bg-danger text-white">

Form Edit Profil

</div>

<div class="card-body">

<?php if(session()->getFlashdata('success')): ?>

<div class="alert alert-success">

<?= session()->getFlashdata('success') ?>

</div>

<?php endif; ?>

<form action="<?= base_url('profile/update') ?>"
method="post"
enctype="multipart/form-data">

<div class="row">

<div class="col-md-6">

<label>Nama</label>

<input
type="text"
class="form-control"
name="nama"
value="<?= $user['nama'] ?>">

</div>

<div class="col-md-6">

<label>NIM</label>

<input
type="text"
class="form-control"
value="<?= $user['nim'] ?>"
readonly>

</div>

</div>

<br>

<label>Email</label>

<input
type="email"
class="form-control"
name="email"
value="<?= $user['email'] ?>">

<br>

<label>No HP</label>

<input
type="text"
class="form-control"
name="telepon"
value="<?= $user['telepon'] ?>">

<br>

<label>Program Studi</label>

<input
type="text"
class="form-control"
name="prodi"
value="<?= $user['prodi'] ?>">

<br>

<label>Foto Profil</label>

<div class="mb-3 text-center">

<img src="<?= base_url('assets/img/'.$user['foto']) ?>"
class="img-thumbnail"
width="180">

</div>

<input
type="file"
class="form-control"
name="foto">

<br>

<hr>

<h5>Ganti Password</h5>

<label>Password Baru</label>

<input
type="password"
class="form-control"
name="password">

<br>

<label>Konfirmasi Password</label>

<input
type="password"
class="form-control"
name="konfirmasi">

<br>

<button class="btn btn-danger">

Simpan Perubahan

</button>

<a href="<?= base_url('profile') ?>"
class="btn btn-secondary">

Batal

</a>

</form>

</div>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>