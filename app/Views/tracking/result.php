<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="card">

<div class="card-header bg-success">

<h3 class="card-title">

Status Tiket

</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="250">Nomor Tiket</th>

<td><?= $ticket['ticket_number'] ?></td>

</tr>

<tr>

<th>Nama Pemohon</th>

<td><?= $ticket['applicant_name'] ?></td>

</tr>

<tr>

<th>Layanan</th>

<td><?= $ticket['service_name'] ?></td>

</tr>

<tr>

<th>Judul</th>

<td><?= $ticket['ticket_title'] ?></td>

</tr>

<tr>

<th>Status</th>

<td>

<?php

$badge='warning';

switch($ticket['status']){

case 'Verified':
$badge='success';
break;

case 'Need Revision':
$badge='primary';
break;

case 'Rejected':
$badge='danger';
break;

case 'Assigned':
$badge='info';
break;

case 'In Progress':
$badge='secondary';
break;

case 'Completed':
$badge='dark';
break;

}

?>

<span class="badge bg-<?= $badge ?>">

<?= $ticket['status'] ?>

</span>

</td>

</tr>

<tr>

<th>Unit Tujuan</th>

<td><?= $ticket['assigned_unit'] ?: '-' ?></td>

</tr>

<tr>

<th>Catatan Petugas</th>

<td><?= $ticket['verification_note'] ?: '-' ?></td>

</tr>

<tr>

<th>Tanggal Pengajuan</th>

<td><?= $ticket['submitted_at'] ?></td>

</tr>

</table>

<hr>

<h5>Alur Tiket</h5>

<ul class="timeline">

<li>

<i class="fas fa-check bg-green"></i>

<div class="timeline-item">

<h3 class="timeline-header">

Submitted

</h3>

<div class="timeline-body">

Tiket berhasil dibuat.

</div>

</div>

</li>

<?php if($ticket['verified_at']): ?>

<li>

<i class="fas fa-user-check bg-blue"></i>

<div class="timeline-item">

<h3 class="timeline-header">

Diverifikasi Petugas ULT

</h3>

<div class="timeline-body">

<?= $ticket['verified_at'] ?>

</div>

</div>

</li>

<?php endif ?>

<?php if($ticket['completed_at']): ?>

<li>

<i class="fas fa-flag-checkered bg-success"></i>

<div class="timeline-item">

<h3 class="timeline-header">

Selesai

</h3>

<div class="timeline-body">

<?= $ticket['completed_at'] ?>

</div>

</div>

</li>

<?php endif; ?>

</ul>

</div>

<div class="card-footer">

<a href="<?= base_url('tracking') ?>" class="btn btn-primary">

Cari Lagi

</a>

</div>

</div>

<?= $this->endSection() ?>