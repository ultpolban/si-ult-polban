<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-header">

<div class="container-fluid">

<h2>

Dashboard Pemohon

</h2>

<p>

Selamat datang di Sistem Informasi Unit Layanan Terpadu POLBAN

</p>

</div>

</div>

<div class="row">

<div class="col-lg-3">

<div class="small-box bg-primary">

<div class="inner">

<h3>12</h3>

<p>Tiket Aktif</p>

</div>

<div class="icon">

<i class="fas fa-ticket-alt"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-success">

<div class="inner">

<h3>20</h3>

<p>Selesai</p>

</div>

<div class="icon">

<i class="fas fa-check-circle"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-warning">

<div class="inner">

<h3>3</h3>

<p>Menunggu</p>

</div>

<div class="icon">

<i class="fas fa-clock"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-danger">

<div class="inner">

<h3>1</h3>

<p>Revisi</p>

</div>

<div class="icon">

<i class="fas fa-times-circle"></i>

</div>

</div>

</div>

</div>

<div class="card">

<div class="card-header">

<h3 class="card-title">

Tiket Saya

</h3>

</div>

<div class="card-body">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>No</th>

<th>No Tiket</th>

<th>Layanan</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<tr>

<td>1</td>

<td>ULT-20260715-0001</td>

<td>Surat Aktif Kuliah</td>

<td>

<span class="badge badge-warning">

Diproses

</span>

</td>

<td>

<a href="<?= base_url('dashboard/detail') ?>" class="btn btn-primary btn-sm">

Detail

</a>

</td>

</tr>

</tbody>

</table>

</div>

</div>

<?= $this->endSection() ?>