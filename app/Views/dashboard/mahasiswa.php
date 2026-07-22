<?= $this->include('layouts/header'); ?>
<?= $this->include('layouts/navbar'); ?>
<?= $this->include('layouts/sidebar_mahasiswa'); ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">

        <div class="d-flex justify-content-between">

            <h1>Dashboard Mahasiswa</h1>

            <span class="badge bg-danger p-2">
                Semester <?= $user['semester']; ?>
            </span>

        </div>

    </div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card shadow">

<div class="card-body">

<h3>

Selamat Datang,
<b><?= $user['nama']; ?></b>

</h3>

<hr>

<div class="row">

<div class="col-md-4">

<b>NIM</b>

<br>

<?= $user['nim']; ?>

</div>

<div class="col-md-4">

<b>Program Studi</b>

<br>

<?= $user['prodi']; ?>

</div>

<div class="col-md-4">

<b>Angkatan</b>

<br>

<?= $user['angkatan']; ?>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-lg-3">

<div class="small-box bg-primary">

<div class="inner">

<h3><?= $statistik['layanan']; ?></h3>

<p>Total Pengajuan</p>

</div>

<div class="icon">

<i class="fas fa-folder-open"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-warning">

<div class="inner">

<h3><?= $statistik['proses']; ?></h3>

<p>Sedang Diproses</p>

</div>

<div class="icon">

<i class="fas fa-spinner"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-success">

<div class="inner">

<h3><?= $statistik['selesai']; ?></h3>

<p>Selesai</p>

</div>

<div class="icon">

<i class="fas fa-check-circle"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-danger">

<div class="inner">

<h3><?= $statistik['notifikasi']; ?></h3>

<p>Notifikasi Baru</p>

</div>

<div class="icon">

<i class="fas fa-bell"></i>

</div>

</div>

</div>

</div>

<div class="card">

<div class="card-header bg-danger text-white">

<i class="fas fa-calendar-alt"></i>

Jadwal Penting

</div>

<div class="card-body">

<table class="table">

<thead>

<tr>

<th>Kegiatan</th>

<th>Tanggal</th>

</tr>

</thead>

<tbody>

<?php foreach($jadwal as $j): ?>

<tr>

<td><?= $j['judul']; ?></td>

<td><?= $j['tanggal']; ?></td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

<!-- Informasi Akademik -->
<div class="row mt-3">

    <div class="col-md-6">

        <div class="card card-danger">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-graduation-cap"></i>
                    Informasi Akademik
                </h3>
            </div>

            <div class="card-body">

                <table class="table table-borderless">

                    <tr>
                        <th width="35%">Program Studi</th>
                        <td><?= $user['prodi']; ?></td>
                    </tr>

                    <tr>
                        <th>Jurusan</th>
                        <td><?= $user['jurusan']; ?></td>
                    </tr>

                    <tr>
                        <th>Semester</th>
                        <td><?= $user['semester']; ?></td>
                    </tr>

                    <tr>
                        <th>Angkatan</th>
                        <td><?= $user['angkatan']; ?></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            <span class="badge bg-success">
                                <?= $user['status']; ?>
                            </span>
                        </td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card card-primary">

            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-bullhorn"></i>
                    Pengumuman
                </h3>
            </div>

            <div class="card-body">

                <ul class="mb-0">

                    <li>Periode pengajuan Surat Aktif Kuliah dibuka hingga 31 Juli 2026.</li>

                    <li>Pastikan data profil sudah lengkap.</li>

                    <li>Cek notifikasi secara berkala.</li>

                </ul>

            </div>

        </div>

    </div>

</div>

<!-- Statistik -->
<div class="row">

<div class="col-md-3">

<a href="<?= base_url('mahasiswa/ticket/create') ?>"
   class="btn btn-danger btn-block">

    <i class="fas fa-plus-circle"></i>

    Ajukan Layanan

</a>

</div>

<div class="col-md-3">

<a href="<?= base_url('mahasiswa/ticket/history') ?>"
   class="btn btn-primary btn-block">

    <i class="fas fa-history"></i>

    Tracking Tiket

</a>

</div>

<div class="col-md-3">

<a href="<?= base_url('mahasiswa/notification') ?>"
   class="btn btn-success btn-block">

    <i class="fas fa-bell"></i>

    Notifikasi

</a>

</div>

<div class="col-md-3">

<a href="<?= base_url('mahasiswa/profile') ?>"
   class="btn btn-warning btn-block">

    <i class="fas fa-user"></i>

    Profil

</a>

</div>

</div>

<div class="card shadow mt-4">

    <div class="card-header bg-danger text-white">

        <h5 class="mb-0">
            <i class="fas fa-history"></i>
            Riwayat Pengajuan Terbaru
        </h5>

    </div>

    <div class="card-body p-0">

        <table class="table table-hover mb-0">

            <thead class="table-light">

                <tr>

                    <th>No Tiket</th>
                    <th>Layanan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

            <?php foreach($tickets as $ticket): ?>

                <tr>

                    <td><?= $ticket['nomor']; ?></td>

                    <td><?= $ticket['layanan']; ?></td>

                    <td><?= $ticket['tanggal']; ?></td>

                    <td>

                        <?php

                        $badge='secondary';

                        if($ticket['status']=='Submitted') $badge='primary';
                        elseif($ticket['status']=='Verification') $badge='warning';
                        elseif($ticket['status']=='In Progress') $badge='info';
                        elseif($ticket['status']=='Revision') $badge='danger';
                        elseif($ticket['status']=='Completed') $badge='success';

                        ?>

                        <span class="badge bg-<?= $badge ?>">

                            <?= $ticket['status']; ?>

                        </span>

                    </td>

                    <td>

                        <a href="<?= base_url('ticket/detail/'.$ticket['id']) ?>"
   class="btn btn-info btn-sm">

                            Detail

                        </a>

                    </td>

                </tr>

            <?php endforeach; ?>

            </tbody>

        </table>

    </div>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>