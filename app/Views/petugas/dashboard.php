<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h2 class="font-weight-bold text-primary">
Dashboard Petugas
</h2>

<p class="text-muted">
Selamat Datang di Sistem Informasi Unit Layanan Terpadu
Politeknik Negeri Bandung
</p>

</div>

<div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item">
<a href="<?= base_url('petugas') ?>">
Dashboard
</a>
</li>

<li class="breadcrumb-item active">
Home
</li>

</ol>

</div>

</div>

</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-lg-3">

<div class="small-box bg-primary">

<div class="inner">

<h3>20</h3>

<p>Tiket Masuk</p>

<small>+4 Hari Ini</small>

</div>

<div class="icon">

<i class="fas fa-inbox"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-warning">

<div class="inner">

<h3>7</h3>

<p>Perlu Verifikasi</p>

<small>Belum Diproses</small>

</div>

<div class="icon">

<i class="fas fa-user-check"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-success">

<div class="inner">

<h3>14</h3>

<p>Diproses</p>

<small>Oleh Unit Tujuan</small>

</div>

<div class="icon">

<i class="fas fa-spinner"></i>

</div>

</div>

</div>

<div class="col-lg-3">

<div class="small-box bg-danger">

<div class="inner">

<h3>2</h3>

<p>Terlambat SLA</p>

<small>Segera Ditindaklanjuti</small>

</div>

<div class="icon">

<i class="fas fa-clock"></i>

</div>

</div>

</div>

</div>

<div class="row mt-3">

<div class="col-md-12">

<div class="card">

<div class="card-header bg-primary">

<h3 class="card-title">

<i class="fas fa-bolt"></i>

Quick Action

</h3>

</div>

<div class="card-body">

<div class="row text-center">

<div class="col-md-3">

<a href="<?= base_url('petugas/verifikasi/1') ?>" class="btn btn-warning btn-lg btn-block">

<i class="fas fa-user-check fa-2x"></i>

<br><br>

Verifikasi

</a>

</div>

<div class="col-md-3">

<a href="<?= base_url('petugas/disposisi/1') ?>" class="btn btn-success btn-lg btn-block">

<i class="fas fa-share fa-2x"></i>

<br><br>

Disposisi

</a>

</div>

<div class="col-md-3">

<a href="<?= base_url('petugas/tiket') ?>" class="btn btn-info btn-lg btn-block">

<i class="fas fa-ticket-alt fa-2x"></i>

<br><br>

Data Tiket

</a>

</div>

<div class="col-md-3">

<a href="#" class="btn btn-danger btn-lg btn-block">

<i class="fas fa-search fa-2x"></i>

<br><br>

Cari Mahasiswa

</a>

</div>

</div>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-md-7">

<div class="card">

<div class="card-header bg-info">

<h3 class="card-title">

Aktivitas Terbaru

</h3>

</div>

<div class="card-body">

<ul class="timeline">

<li>

<b>09:20</b>

Mahasiswa <b>Rafi Putra</b>

mengajukan Surat Aktif Kuliah

</li>

<hr>

<li>

<b>09:45</b>

Petugas memverifikasi tiket

<b>#ULT001</b>

</li>

<hr>

<li>

<b>10:10</b>

Disposisi dikirim ke

<b>Unit Akademik</b>

</li>

<hr>

<li>

<b>10:45</b>

Unit mengubah status menjadi

<b>Diproses</b>

</li>

</ul>

</div>

</div>

</div>

<div class="col-md-5">

<div class="card">

<div class="card-header bg-danger">

<h3 class="card-title">

Notifikasi

</h3>

</div>

<div class="card-body">

<div class="alert alert-warning">

Ada

<b>3 tiket</b>

belum diverifikasi

</div>

<div class="alert alert-danger">

Ada

<b>1 tiket</b>

melewati SLA

</div>

<div class="alert alert-success">

Hari ini

<b>15 tiket</b>

berhasil diselesaikan

</div>

</div>

</div>

</div>

</div>

<div class="row mt-4">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header bg-primary">

                <h3 class="card-title">

                    <i class="fas fa-chart-line"></i>

                    Statistik Tiket Mingguan

                </h3>

            </div>

            <div class="card-body">

                <canvas id="grafikPetugas" height="110"></canvas>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card">

            <div class="card-header bg-success">

                <h3 class="card-title">

                    Ringkasan Bulan Ini

                </h3>

            </div>

            <div class="card-body">

                <h5>120 Tiket Masuk</h5>

                <hr>

                <h5>95 Diverifikasi</h5>

                <hr>

                <h5>20 Menunggu</h5>

                <hr>

                <h5>5 Ditolak</h5>

            </div>

        </div>

    </div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('grafikPetugas');

    if(ctx){

        new Chart(ctx,{
            type:'bar',
            data:{
                labels:['Sen','Sel','Rab','Kam','Jum'],
                datasets:[
                {
                    label:'Tiket Masuk',
                    data:[12,19,10,15,18],
                    backgroundColor:'#005BAC'
                },
                {
                    label:'Diverifikasi',
                    data:[8,15,9,12,16],
                    backgroundColor:'#28a745'
                }
                ]
            },
            options:{
                responsive:true,
                maintainAspectRatio:false
            }
        });

    }

});

</script>

<?= view('layouts/footer') ?>