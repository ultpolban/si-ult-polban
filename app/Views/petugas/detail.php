<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center">

<div>

<h1 class="font-weight-bold text-primary mb-1">
<i class="fas fa-ticket-alt"></i>
Detail Tiket
</h1>

<p class="text-muted mb-0">
Informasi lengkap pengajuan layanan mahasiswa
</p>

</div>

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item">

<a href="<?= base_url('petugas/dashboard') ?>">
Dashboard
</a>

</li>

<li class="breadcrumb-item">

<a href="<?= base_url('petugas/tiket') ?>">
Data Tiket
</a>

</li>

<li class="breadcrumb-item active">
Detail
</li>

</ol>

</div>

</div>

</section>


<section class="content">

<div class="row">

<div class="col-md-3">

<div class="small-box elevation-2"
style="background:#005BAC;color:white;border-radius:12px;">

<div class="inner">

<h3>ULT-001</h3>

<p>No Tiket</p>

</div>

<div class="icon">

<i class="fas fa-ticket-alt"></i>

</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box elevation-2"
style="background:#F4B400;color:white;border-radius:12px;">

<div class="inner">

<h3>High</h3>

<p>Prioritas</p>

</div>

<div class="icon">

<i class="fas fa-exclamation"></i>

</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box elevation-2"
style="background:#00ACC1;color:white;border-radius:12px;">

<div class="inner">

<h3>Akademik</h3>

<p>Unit Tujuan</p>

</div>

<div class="icon">

<i class="fas fa-building"></i>

</div>

</div>

</div>

<div class="col-md-3">

<div class="small-box elevation-2"
style="background:#28A745;color:white;border-radius:12px;">

<div class="inner">

<h3>Submitted</h3>

<p>Status</p>

</div>

<div class="icon">

<i class="fas fa-check-circle"></i>

</div>

</div>

</div>

</div>



<div class="card shadow border-0 mt-3">

<div class="card-header bg-primary">

<h5 class="mb-0 text-white">

<i class="fas fa-file-alt"></i>

Data Pengajuan

</h5>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Nama Mahasiswa</label>

<input type="text" class="form-control bg-light" value="Rafi Putra" readonly>

</div>

<div class="form-group">

<label>NIM</label>

<input type="text"class="form-control bg-light" value="231511001" readonly>

</div>

<div class="form-group">

<label>Email</label>

<input type="text" class="form-control bg-light" value="rafi@student.polban.ac.id" readonly>

</div>

<div class="form-group">

<label>No HP</label>

<input type="text" class="form-control bg-light" value="081234567890" readonly>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Jenis Layanan</label>

<input type="text" class="form-control bg-light" value="Surat Aktif Kuliah" readonly>

</div>

<div class="form-group">

<label>Tanggal Pengajuan</label>

<input type="text" class="form-control bg-light" value="17 Juli 2026" readonly>

</div>

<div class="form-group">

<label>Status</label>

<div class="mt-2">

<span class="badge badge-warning px-3 py-2">

<i class="fas fa-clock"></i>

Menunggu Verifikasi

</span>

</div>
</div>

<div class="form-group">

<label>Lampiran</label>

<br>

<a href="#" class="btn btn-info btn-sm">

<i class="fas fa-file-pdf"></i>

Lihat Lampiran

</a>

</div>

</div>

</div>

<div class="form-group">

<label>Deskripsi Pengajuan</label>

<textarea class="form-control bg-light" rows="5" readonly>Saya mengajukan Surat Aktif Kuliah untuk keperluan beasiswa.</textarea>

</div>

</div>

<hr>

<h5 class="font-weight-bold mb-3">

<i class="fas fa-history"></i>


Riwayat Proses

</h5>

<div class="timeline mt-4">

    <div class="time-label">

        <span class="bg-primary">

            20 Juli 2026

        </span>

    </div>

    <div>

        <i class="fas fa-file bg-primary"></i>

        <div class="timeline-item">

            <span class="time">

                <i class="fas fa-clock"></i>

                08.00

            </span>

            <h3 class="timeline-header">

                Pengajuan dibuat mahasiswa

            </h3>

        </div>

    </div>

    <div>

        <i class="fas fa-user-check bg-warning"></i>

        <div class="timeline-item">

            <span class="time">

                <i class="fas fa-clock"></i>

                09.15

            </span>

            <h3 class="timeline-header">

                Menunggu Verifikasi Petugas

            </h3>

        </div>

    </div>

</div>

<div class="card-footer bg-white text-right">

<a href="<?= base_url('petugas/verifikasi/1') ?>" class="btn btn-success">

<i class="fas fa-check"></i>

Verifikasi

</a>

<a href="<?= base_url('petugas/disposisi/1') ?>" class="btn btn-primary">

<i class="fas fa-share"></i>

Disposisi

</a>

<a href="<?= base_url('petugas/tiket') ?>" class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

</div>

</div>

</div>

</section>

</div>

<style>

.small-box{
border-radius:12px;
transition:.3s;
}

.small-box:hover{
transform:translateY(-5px);
}

.card{
border-radius:12px;
}

.form-control{
border-radius:8px;
}

.btn{
border-radius:8px;
}

.timeline-item{
border-radius:10px;
}

</style>

<?= view('layouts/footer') ?>