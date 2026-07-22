<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">
        <h1>Detail Tiket</h1>
    </div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-danger text-white">

<i class="fas fa-ticket-alt"></i>

Informasi Tiket

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>
    <th width="30%">Nomor Tiket</th>
    <td><?= $ticket['ticket_number'] ?? 'ULT-20260716-0001' ?></td>
</tr>

<tr>
    <th>Layanan</th>
    <td><?= $ticket['service_name'] ?? 'Surat Keterangan Aktif Kuliah' ?></td>
</tr>

<tr>
    <th>Nama Pemohon</th>
    <td><?= $ticket['applicant_name'] ?? 'Nama Mahasiswa' ?></td>
</tr>

<tr>
    <th>NIM</th>
    <td><?= $ticket['nim'] ?? '231511001' ?></td>
</tr>

<tr>
    <th>Program Studi</th>
    <td><?= $ticket['study_program'] ?? 'D4 Teknik Informatika' ?></td>
</tr>

<tr>
    <th>Status</th>
    <td>

<span class="badge bg-warning">

<?= $ticket['status'] ?? 'Submitted' ?>

</span>

    </td>
</tr>

</table>

<hr>

<h5>Lampiran Dokumen</h5>

<table class="table table-bordered">

<tr>
    <th width="30%">KTM</th>
    <td>

<?php if(!empty($ticket['ktm_file'])): ?>

<a href="<?= base_url('uploads/ktm/'.$ticket['ktm_file']) ?>" target="_blank">

<i class="fas fa-file-pdf text-danger"></i>

Lihat KTM (Jika Ada)

</a>

<?php else: ?>

<span class="text-muted">Belum ada file</span>

<?php endif; ?>

    </td>
</tr>

<tr>
    <th>KRS</th>
    <td>

<?php if(!empty($ticket['krs_file'])): ?>

<a href="<?= base_url('uploads/krs/'.$ticket['krs_file']) ?>" target="_blank">

<i class="fas fa-file-pdf text-danger"></i>

Lihat KRS (Jika Ada)

</a>

<?php else: ?>

<span class="text-muted">Belum ada file</span>

<?php endif; ?>

    </td>
</tr>

</table>

<hr>



<hr>

<h5>Catatan Pemohon</h5>

<div class="alert alert-light">

<?= $ticket['catatan'] ?? 'Belum ada catatan.' ?>

</div>

</div>

</div>

<div class="card mt-3">

<div class="card-header bg-primary text-white">

Status Pengajuan

</div>

<div class="card-body">

<div class="timeline">

<div>

<i class="fas fa-check bg-success"></i>

<div class="timeline-item">

<span class="time">
17 Juli 2026
</span>

<h3 class="timeline-header">
Pengajuan Diterima
</h3>

<div class="timeline-body">
Pengajuan berhasil masuk ke sistem ULT.
</div>

</div>

</div>

<div>

<i class="fas fa-user-check bg-warning"></i>

<div class="timeline-item">

<span class="time">
18 Juli 2026
</span>

<h3 class="timeline-header">
Sedang Diverifikasi
</h3>

<div class="timeline-body">
Petugas sedang mengecek kelengkapan dokumen.
</div>

</div>

</div>

<div>

<i class="fas fa-spinner bg-info"></i>

<div class="timeline-item">

<h3 class="timeline-header">

Menunggu Diproses Unit

</h3>

</div>

</div>

</div>

</div>

</div>

<div class="mt-3">

<a href="<?= base_url('ticket/history') ?>" class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

<button class="btn btn-success">

<i class="fas fa-print"></i>

Cetak Bukti

</button>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>