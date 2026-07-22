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

<div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item">
Dashboard
</li>

<li class="breadcrumb-item">
Data Tiket
</li>

<li class="breadcrumb-item active">
Detail
</li>

</ol>

</div>

</div>

</div>

</section>

<section class="content">

<div class="row mb-3">

    <div class="col-md-3">

        <div class="small-box bg-primary">

            <div class="inner">
                <h4>ULT-001</h4>
                <p>No Tiket</p>
            </div>

            <div class="icon">
                <i class="fas fa-ticket-alt"></i>
            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-warning">

            <div class="inner">
                <h4>High</h4>
                <p>Prioritas</p>
            </div>

            <div class="icon">
                <i class="fas fa-exclamation"></i>
            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-info">

            <div class="inner">
                <h4>Akademik</h4>
                <p>Unit Tujuan</p>
            </div>

            <div class="icon">
                <i class="fas fa-building"></i>
            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-success">

            <div class="inner">
                <h4>Submitted</h4>
                <p>Status</p>
            </div>

            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>

        </div>

    </div>

</div>



<div class="card shadow-sm">

<div class="card-header bg-primary text-white">

<h3 class="card-title">

Data Pengajuan

</h3>

</div>

<div class="card-body">

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label>Nama Mahasiswa</label>

<input type="text" class="form-control" value="Rafi Putra" readonly>

</div>

<div class="form-group">

<label>NIM</label>

<input type="text" class="form-control" value="231511001" readonly>

</div>

<div class="form-group">

<label>Email</label>

<input type="text" class="form-control" value="rafi@student.polban.ac.id" readonly>

</div>

<div class="form-group">

<label>No HP</label>

<input type="text" class="form-control" value="081234567890" readonly>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label>Jenis Layanan</label>

<input type="text" class="form-control" value="Surat Aktif Kuliah" readonly>

</div>

<div class="form-group">

<label>Tanggal Pengajuan</label>

<input type="text" class="form-control" value="17 Juli 2026" readonly>

</div>

<div class="form-group">

<label>Status</label>

<div class="mt-2">

<span class="badge badge-warning p-2">

<i class="fas fa-clock"></i>

Menunggu Verifikasi

</span>

</div>
</div>

<div class="form-group">

<label>Lampiran</label>

<br>

<a href="#" class="btn btn-info">

<i class="fas fa-file-pdf"></i>

Lihat Lampiran

</a>

</div>

</div>

</div>

<div class="form-group">

<label>Deskripsi Pengajuan</label>

<textarea class="form-control" rows="5" readonly>Saya mengajukan Surat Aktif Kuliah untuk keperluan beasiswa.</textarea>

</div>

</div>

<hr>

<h5 class="font-weight-bold mb-3">

<i class="fas fa-history"></i>


Riwayat Proses

</h5>

<div class="timeline">

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

<div class="card-footer">

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

<?= view('layouts/footer') ?>