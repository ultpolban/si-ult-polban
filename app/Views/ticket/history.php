<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h1>Tracking Tiket</h1>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow">

<div class="card-header bg-danger text-white">
    <i class="fas fa-ticket-alt"></i>
    Daftar Tiket saya
</div>

<div class="card-body">

<div class="mb-3 text-end">
    <a href="<?= base_url('ticket/create') ?>" class="btn btn-danger">
        <i class="fas fa-plus-circle"></i>
        Ajukan Layanan
    </a>
</div>

<table class="table table-bordered table-hover">

<thead>

<tr>

<th>No</th>

<th>No Tiket</th>

<th>Layanan</th>

<th>Status</th>

<th>Tanggal</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php if(empty($tickets)): ?>

<tr>
    <td colspan="6" class="text-center">
        Belum ada data pengajuan.
    </td>
</tr>

<?php else: ?>

<?php $no=1; ?>

<?php foreach($tickets as $row): ?>
<tr>

<td><?= $no++ ?></td>

<td><?= $row['nomor'] ?></td>

<td><?= $row['layanan'] ?></td>

<td>

<?php if($row['status']=="Submitted"): ?>

<span class="badge bg-primary">
    <i class="fas fa-paper-plane"></i>
    Submitted
</span>

<?php elseif($row['status']=="In Progress"): ?>

<span class="badge bg-warning text-dark">
    <i class="fas fa-spinner"></i>
    In Progress
</span>

<?php elseif($row['status']=="Completed"): ?>

<span class="badge bg-success">
    <i class="fas fa-check-circle"></i>
    Completed
</span>

<?php else: ?>

<span class="badge bg-secondary">
    <?= $row['status'] ?>
</span>

<?php endif; ?>

</td>

<td><?= $row['tanggal'] ?></td>

<td>

<a href="<?= base_url('ticket/detail/'.$row['id']) ?>"
class="btn btn-outline-primary btn-sm">
<i class="fas fa-eye"></i> Detail
</a>

</td>

</tr>

<?php endforeach; ?>

<?php endif; ?>

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>