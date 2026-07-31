<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_tendik') ?>

<div class="content-wrapper">

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1 style="font-weight:700;color:#0b3d91;">

                    <i class="fas fa-user-tie mr-2"></i>

                    Profil Tendik

                </h1>

            </div>

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item">

                        <a href="<?= base_url('dashboard-tendik') ?>">

                            Dashboard

                        </a>

                    </li>

                    <li class="breadcrumb-item active">

                        Profil

                    </li>

                </ol>

            </div>

        </div>

    </div>

</section>

<section class="content">

<div class="container-fluid">

<?php if(session()->getFlashdata('success')) : ?>

<div class="alert alert-success">

    <?= session()->getFlashdata('success') ?>

</div>

<?php endif; ?>


<div class="row">


<!-- FOTO -->

<div class="col-md-4">

<div class="card shadow-sm">

<div

class="card-header text-center"

style="

background:#0b3d91;

color:white;

border-bottom:4px solid #f28c28;

"

>

<h3 class="card-title w-100">

Profil Tendik

</h3>

</div>


<div class="card-body text-center">


<?php if(!empty($profile['foto'])) : ?>

<img

src="<?= base_url('uploads/profile/'.$profile['foto']) ?>"

class="img-circle elevation-3"

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

class="img-circle elevation-3"

style="

width:190px;

height:190px;

object-fit:cover;

border:5px solid #fff;

box-shadow:0 8px 20px rgba(0,0,0,.2);

"

>

<?php endif; ?>


<h3 class="mt-3">

<?= esc($profile['nama'] ?? '-') ?>

</h3>

<p class="text-muted">

<?= esc($profile['jabatan'] ?? '-') ?>

</p>


<a

href="<?= base_url('tendik/profile/edit') ?>"

class="btn btn-warning btn-block"

>

<i class="fas fa-edit"></i>

Edit Profil

</a>

</div>

</div>

</div>



<!-- DATA -->

<div class="col-md-8">

<div class="card shadow-sm">

<div

class="card-header"

style="

background:#0b3d91;

color:white;

border-bottom:4px solid #f28c28;

"

>

<h3 class="card-title">

<i class="fas fa-id-card"></i>

Data Tendik

</h3>

</div>


<div class="card-body">


<h4

style="

color:#0b3d91;

font-weight:bold;

"

>

Data Pribadi

</h4>


<table class="table table-bordered">

<tr>

<th width="35%">Nama Lengkap</th>

<td><?= esc($profile['nama'] ?? '-') ?></td>

</tr>

<tr>

<th>NIK</th>

<td><?= esc($profile['nik'] ?? '-') ?></td>

</tr>

<tr>

<th>NIP</th>

<td><?= esc($profile['nip'] ?? '-') ?></td>

</tr>

<tr>

<th>Email</th>

<td><?= esc($profile['email'] ?? '-') ?></td>

</tr>

<tr>

<th>No HP</th>

<td><?= esc($profile['no_hp'] ?? '-') ?></td>

</tr>

<tr>

<th>Jenis Kelamin</th>

<td><?= esc($profile['jenis_kelamin'] ?? '-') ?></td>

</tr>

<tr>

<th>Alamat</th>

<td><?= esc($profile['alamat'] ?? '-') ?></td>

</tr>

</table>


<hr>


<h4

style="

color:#0b3d91;

font-weight:bold;

"

>

Informasi Kepegawaian

</h4>


<table class="table table-bordered">

<tr>

<th width="35%">Unit Kerja</th>

<td><?= esc($profile['unit_kerja'] ?? '-') ?></td>

</tr>

<tr>

<th>Bagian</th>

<td><?= esc($profile['bagian'] ?? '-') ?></td>

</tr>

<tr>

<th>Jabatan</th>

<td><?= esc($profile['jabatan'] ?? '-') ?></td>

</tr>

<tr>

<th>Status</th>

<td><?= esc($profile['status'] ?? '-') ?></td>

</tr>

</table>


</div>

</div>

</div>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>