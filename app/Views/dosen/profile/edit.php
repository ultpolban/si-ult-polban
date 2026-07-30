<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_dosen') ?>

<div class="content-wrapper">

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 style="font-weight:700;color:#0b3d91;">

                    <i class="fas fa-user-edit"></i>

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

<?php if(session()->getFlashdata('error')) : ?>

<div class="alert alert-danger">

    <?= session()->getFlashdata('error') ?>

</div>

<?php endif; ?>

<div class="card shadow-sm">

<div class="card-header bg-primary">

<h3 class="card-title">

<i class="fas fa-user-cog"></i>

Edit Profil

</h3>

</div>

<form
action="<?= base_url('dosen/profile/update') ?>"
method="post"
enctype="multipart/form-data"
>

<?= csrf_field() ?>

<div class="card-body">

<div class="row">

<!-- FOTO -->
<div class="col-md-4">

    <div class="text-center">

        <?php if(!empty($profile['foto'])) : ?>

            <img
                src="<?= base_url('uploads/profile/'.$profile['foto']) ?>"
                class="img-circle elevation-2 mb-3"
                style="width:180px;height:180px;object-fit:cover;"
            >

        <?php else : ?>

            <img
                src="<?= base_url('assets/img/default-user.png') ?>"
                class="img-circle elevation-2 mb-3"
                style="width:180px;height:180px;object-fit:cover;"
            >

        <?php endif; ?>

        <div class="form-group">

            <label>Foto Profil</label>

            <input
                type="file"
                name="foto"
                class="form-control"
                accept=".jpg,.jpeg,.png,.webp"
            >

            <small class="text-muted">

                JPG / PNG / WEBP (Maks. 2MB)

            </small>

        </div>

    </div>

</div>


<!-- DATA DOSEN -->
<div class="col-md-8">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Nama Lengkap</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= old('nama',$profile['nama']) ?>"
required>

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>NIP</label>

<input
type="text"
name="nip"
class="form-control"
value="<?= old('nip',$profile['nip']) ?>"
required>

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>NIDN</label>

<input
type="text"
name="nidn"
class="form-control"
value="<?= old('nidn',$profile['nidn']) ?>">

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>NIK</label>

<input
type="text"
name="nik"
class="form-control"
value="<?= old('nik',$profile['nik']) ?>">

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?= old('email',$profile['email']) ?>"
required>

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>No HP</label>

<input
type="text"
name="no_hp"
class="form-control"
value="<?= old('no_hp',$profile['no_hp']) ?>">

</div>

</div>


<div class="col-md-6">

<div class="form-group">

<label>Jenis Kelamin</label>

<select
name="jenis_kelamin"
class="form-control">

<option value="Laki-laki"
<?= ($profile['jenis_kelamin']=='Laki-laki') ? 'selected' : '' ?>>

Laki-laki

</option>

<option value="Perempuan"
<?= ($profile['jenis_kelamin']=='Perempuan') ? 'selected' : '' ?>>

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
class="form-control"><?= old('alamat',$profile['alamat']) ?></textarea>

</div>

</div>

</div>

<hr>

<h4 style="font-weight:700;color:#0b3d91;">

    <i class="fas fa-graduation-cap"></i>

    Informasi Akademik

</h4>

<div class="row">

    <div class="col-md-6">

        <div class="form-group">

            <label>Program Studi</label>

            <input
                type="text"
                name="prodi"
                class="form-control"
                value="<?= old('prodi',$profile['prodi']) ?>"
            >

        </div>

    </div>


    <div class="col-md-6">

        <div class="form-group">

            <label>Jurusan</label>

            <input
                type="text"
                name="jurusan"
                class="form-control"
                value="<?= old('jurusan',$profile['jurusan']) ?>"
            >

        </div>

    </div>


    <div class="col-md-6">

        <div class="form-group">

            <label>Fakultas</label>

            <input
                type="text"
                name="fakultas"
                class="form-control"
                value="<?= old('fakultas',$profile['fakultas']) ?>"
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
                value="<?= old('jabatan',$profile['jabatan']) ?>"
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

                <option value="Aktif"
                    <?= ($profile['status']=='Aktif') ? 'selected' : '' ?>>
                    Aktif
                </option>

                <option value="Cuti"
                    <?= ($profile['status']=='Cuti') ? 'selected' : '' ?>>
                    Cuti
                </option>

                <option value="Tugas Belajar"
                    <?= ($profile['status']=='Tugas Belajar') ? 'selected' : '' ?>>
                    Tugas Belajar
                </option>

                <option value="Pensiun"
                    <?= ($profile['status']=='Pensiun') ? 'selected' : '' ?>>
                    Pensiun
                </option>

            </select>

        </div>

    </div>

</div>

</div>

<div class="card-footer text-right">

    <a
        href="<?= base_url('dosen/profile') ?>"
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