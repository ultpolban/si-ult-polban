<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_dosen') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h1 style="font-weight:700;color:#0b3d91;">

<i class="fas fa-user-edit mr-2"></i>

Edit Profil Dosen

</h1>

</div>

<div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item">

<a href="<?= base_url('dosen/dashboard') ?>">

Dashboard

</a>

</li>

<li class="breadcrumb-item">

<a href="<?= base_url('dosen/profile') ?>">

Profil

</a>

</li>

<li class="breadcrumb-item active">

Edit

</li>

</ol>

</div>

</div>

</div>

</section>

<section class="content">

<div class="container-fluid">

<?php if(session()->getFlashdata('error')): ?>

<div class="alert alert-danger">

<?= session()->getFlashdata('error') ?>

</div>

<?php endif; ?>


<form
action="<?= base_url('dosen/profile/update') ?>"
method="post"
enctype="multipart/form-data"
>

<?= csrf_field() ?>

<div class="row">

<!-- FOTO -->

<div class="col-md-4">

<div class="card shadow">

<div class="card-body text-center">

<?php if(!empty($profile['foto'])): ?>

<img

src="<?= base_url('uploads/profile/'.$profile['foto']) ?>"

id="preview"

class="img-circle elevation-2"

style="width:180px;height:180px;object-fit:cover;"

>

<?php else: ?>

<img

src="<?= base_url('assets/img/default-user.png') ?>"

id="preview"

class="img-circle elevation-2"

style="width:180px;height:180px;object-fit:cover;"

>

<?php endif; ?>

<div class="mt-3">

<input

type="file"

name="foto"

class="form-control"

accept=".jpg,.jpeg,.png,.webp"

onchange="previewFoto(event)"

>

</div>

</div>

</div>

</div>



<!-- DATA -->

<div class="col-md-8">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<b>Data Pribadi</b>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6 mb-3">

<label>Nama</label>

<input

type="text"

name="nama"

class="form-control"

value="<?= esc($profile['nama']) ?>"

required

>

</div>

<div class="col-md-6 mb-3">

<label>NIP</label>

<input

type="text"

name="nip"

class="form-control"

value="<?= esc($profile['nip']) ?>"

required

>

</div>

<div class="col-md-6 mb-3">

<label>NIDN</label>

<input

type="text"

name="nidn"

class="form-control"

value="<?= esc($profile['nidn']) ?>"

required

>

</div>

<div class="col-md-6 mb-3">

<label>NIK</label>

<input

type="text"

name="nik"

class="form-control"

value="<?= esc($profile['nik']) ?>"

required

>

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input

type="email"

name="email"

class="form-control"

value="<?= esc($profile['email']) ?>"

required

>

</div>

<div class="col-md-6 mb-3">

<label>No HP</label>

<input

type="text"

name="no_hp"

class="form-control"

value="<?= esc($profile['no_hp']) ?>"

required

>

</div>

<div class="col-md-6 mb-3">

<label>Jenis Kelamin</label>

<select

name="jenis_kelamin"

class="form-control"

>

<option <?= $profile['jenis_kelamin']=='Laki-laki'?'selected':'' ?>>

Laki-laki

</option>

<option <?= $profile['jenis_kelamin']=='Perempuan'?'selected':'' ?>>

Perempuan

</option>

</select>

</div>

<div class="col-md-12 mb-3">

<label>Alamat</label>

<textarea

name="alamat"

class="form-control"

rows="3"

><?= esc($profile['alamat']) ?></textarea>

</div>

</div>

</div>

</div>


<div class="card shadow mt-3">

<div class="card-header bg-warning text-white">

<b>Informasi Akademik</b>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6 mb-3">

<label>Program Studi</label>

<input

type="text"

name="prodi"

class="form-control"

value="<?= esc($profile['prodi']) ?>"

>

</div>

<div class="col-md-6 mb-3">

<label>Jurusan</label>

<input

type="text"

name="jurusan"

class="form-control"

value="<?= esc($profile['jurusan']) ?>"

>

</div>

<div class="col-md-6 mb-3">

<label>Fakultas</label>

<input

type="text"

name="fakultas"

class="form-control"

value="<?= esc($profile['fakultas']) ?>"

>

</div>

<div class="col-md-6 mb-3">

<label>Jabatan</label>

<input

type="text"

name="jabatan"

class="form-control"

value="<?= esc($profile['jabatan']) ?>"

>

</div>

<div class="col-md-6 mb-3">

<label>Status</label>

<select

name="status"

class="form-control"

>

<option <?= $profile['status']=='Aktif'?'selected':'' ?>>

Aktif

</option>

<option <?= $profile['status']=='Tidak Aktif'?'selected':'' ?>>

Tidak Aktif

</option>

</select>

</div>

</div>

</div>

</div>


<div class="mt-3 text-end">

<a

href="<?= base_url('dosen/profile') ?>"

class="btn btn-secondary"

>

Kembali

</a>

<button

type="submit"

class="btn btn-primary"

>

<i class="fas fa-save mr-1"></i>

Simpan Perubahan

</button>

</div>

</div>

</div>

</form>

</div>

</section>

</div>

<script>

function previewFoto(e){

const reader=new FileReader();

reader.onload=function(){

document.getElementById('preview').src=reader.result;

}

reader.readAsDataURL(e.target.files[0]);

}

</script>

<?= $this->include('layouts/footer') ?>