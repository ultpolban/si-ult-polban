<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_tendik') ?>

<div class="content-wrapper">

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 style="color:#0b3d91;font-weight:700;">

                    <i class="fas fa-user-edit mr-2"></i>

                    Edit Profil Tendik

                </h1>

            </div>

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item">

                        <a href="<?= base_url('dashboard-tendik') ?>">

                            Dashboard

                        </a>

                    </li>

                    <li class="breadcrumb-item">

                        <a href="<?= base_url('tendik/profile') ?>">

                            Profil

                        </a>

                    </li>

                    <li class="breadcrumb-item active">

                        Edit Profil

                    </li>

                </ol>

            </div>

        </div>

    </div>

</section>

<section class="content">

<div class="container-fluid">

<?php if(session()->getFlashdata('error')) : ?>

<div class="alert alert-danger">

    <?= session()->getFlashdata('error') ?>

</div>

<?php endif; ?>


<div class="card shadow-sm">

<div

class="card-header"

style="background:#0b3d91;color:white;"

>

<h3 class="card-title">

<i class="fas fa-user-cog"></i>

Form Edit Profil

</h3>

</div>


<form

action="<?= base_url('tendik/profile/update') ?>"

method="post"

enctype="multipart/form-data"

>

<?= csrf_field() ?>


<div class="card-body">

<div class="row">


<!-- FOTO -->

<div class="col-md-4 text-center">

<?php if(!empty($profile['foto'])) : ?>

<img

src="<?= base_url('uploads/profile/'.$profile['foto']) ?>"

class="img-circle elevation-3 mb-3"

style="

width:190px;

height:190px;

object-fit:cover;

border:5px solid #fff;

box-shadow:0 8px 20px rgba(0,0,0,.2);

"

>

<?php else : ?>

<img

src="<?= base_url('assets/img/default-user.png') ?>"

class="img-circle elevation-3 mb-3"

style="

width:190px;

height:190px;

object-fit:cover;

border:5px solid #fff;

box-shadow:0 8px 20px rgba(0,0,0,.2);

"

>

<?php endif; ?>


<div class="form-group">

<label>Ganti Foto</label>

<input

type="file"

name="foto"

class="form-control"

accept=".jpg,.jpeg,.png,.webp"

>

<small class="text-muted">

JPG, PNG, WEBP (maks 2MB)

</small>

</div>

</div>


<!-- DATA -->

<div class="col-md-8">

<h4

style="

color:#0b3d91;

font-weight:700;

"

>

<i class="fas fa-user mr-2"></i>

Data Pribadi

</h4>

<hr>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Nama Lengkap</label>

<input

type="text"

name="nama"

class="form-control"

value="<?= old('nama',$profile['nama'] ?? '') ?>"

required

>

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>NIK</label>

<input

type="text"

name="nik"

class="form-control"

value="<?= old('nik',$profile['nik'] ?? '') ?>"

required

>

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>NIP</label>

<input

type="text"

name="nip"

class="form-control"

value="<?= old('nip',$profile['nip'] ?? '') ?>"

required

>

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>Email</label>

<input

type="email"

name="email"

class="form-control"

value="<?= old('email',$profile['email'] ?? '') ?>"

required

>

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>Nomor HP</label>

<input

type="text"

name="no_hp"

class="form-control"

value="<?= old('no_hp',$profile['no_hp'] ?? '') ?>"

>

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>Jenis Kelamin</label>

<select

name="jenis_kelamin"

class="form-control"

>

<option value="Laki-laki" <?= (($profile['jenis_kelamin'] ?? '')=='Laki-laki')?'selected':''; ?>>

Laki-laki

</option>

<option value="Perempuan" <?= (($profile['jenis_kelamin'] ?? '')=='Perempuan')?'selected':''; ?>>

Perempuan

</option>

</select>

</div>

</div>


<div class="col-md-12">

<div class="form-group">

<label>Alamat</label>

<textarea

name="alamat"

rows="3"

class="form-control"

><?= old('alamat',$profile['alamat'] ?? '') ?></textarea>

</div>

</div>

</div>


<hr>

<h4

style="

color:#0b3d91;

font-weight:700;

"

>

<i class="fas fa-briefcase mr-2"></i>

Informasi Kepegawaian

</h4>

<hr>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Unit Kerja</label>

<input

type="text"

name="unit_kerja"

class="form-control"

value="<?= old('unit_kerja',$profile['unit_kerja'] ?? '') ?>"

>

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>Bagian</label>

<input

type="text"

name="bagian"

class="form-control"

value="<?= old('bagian',$profile['bagian'] ?? '') ?>"

>

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>Jabatan</label>

<input

type="text"

name="jabatan"

class="form-control"

value="<?= old('jabatan',$profile['jabatan'] ?? '') ?>"

>

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>Status</label>

<select

name="status"

class="form-control"

>

<option value="Aktif" <?= (($profile['status'] ?? '')=='Aktif')?'selected':''; ?>>

Aktif

</option>

<option value="Cuti" <?= (($profile['status'] ?? '')=='Cuti')?'selected':''; ?>>

Cuti

</option>

<option value="Tugas Belajar" <?= (($profile['status'] ?? '')=='Tugas Belajar')?'selected':''; ?>>

Tugas Belajar

</option>

<option value="Pensiun" <?= (($profile['status'] ?? '')=='Pensiun')?'selected':''; ?>>

Pensiun

</option>

</select>

</div>

</div>

</div>

</div>

</div>

</div>

<div class="card-footer text-right">

<a

href="<?= base_url('tendik/profile') ?>"

class="btn btn-secondary"

>

<i class="fas fa-arrow-left"></i>

Batal

</a>

<button

type="submit"

class="btn btn-success"

>

<i class="fas fa-save"></i>

Simpan Perubahan

</button>

</div>

</form>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>