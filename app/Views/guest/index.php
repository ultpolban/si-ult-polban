<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="card">

<div class="card-header bg-primary">

<h3 class="card-title">

Form Laporan Tamu

</h3>

</div>

<div class="card-body">

<?php if(session()->getFlashdata('success')): ?>

<div class="alert alert-success">

<?= session()->getFlashdata('success') ?>

</div>

<?php endif ?>

<form action="<?= base_url('guest-ticket/store') ?>" method="post">

<?= csrf_field() ?>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Nama Tamu</label>

<input type="text"
name="applicant_name"
class="form-control"
required>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>NIM (Opsional)</label>

<input type="text"
name="nim"
class="form-control">

</div>

</div>

</div>

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Email</label>

<input type="email"
name="email"
class="form-control">

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>No HP</label>

<input type="text"
name="phone"
class="form-control">

</div>

</div>

</div>

<div class="form-group">

<label>Jenis Layanan</label>

<select
name="service_name"
class="form-control"
required>

<option value="">-- Pilih Layanan --</option>

<option>Surat Aktif Kuliah</option>

<option>Legalisir</option>

<option>Beasiswa</option>

<option>Akademik</option>

<option>Lainnya</option>

</select>

</div>

<div class="form-group">

<label>Judul</label>

<input type="text"
name="ticket_title"
class="form-control"
required>

</div>

<div class="form-group">

<label>Deskripsi</label>

<textarea
name="ticket_description"
rows="4"
class="form-control"
required></textarea>

</div>

<button class="btn btn-success">

Simpan Pengajuan

</button>

</form>

</div>

</div>

<?= $this->endSection() ?>