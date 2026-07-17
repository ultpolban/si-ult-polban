<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar_unit') ?>

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-3">

                <div class="col-sm-6">

                    <h2 class="font-weight-bold text-primary">
                        Dashboard Unit Tujuan
                    </h2>

                    <p class="text-muted">
                        Selamat datang di Sistem Informasi Unit Layanan Terpadu
                        Politeknik Negeri Bandung
                    </p>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            Dashboard
                        </li>

                        <li class="breadcrumb-item active">
                            Unit Tujuan
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

                    <div class="small-box bg-info">

                        <div class="inner">

                            <h3>8</h3>

                            <p>Menunggu Tindak Lanjut</p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-folder-open"></i>

                        </div>

                    </div>

                </div>

                <div class="col-lg-3">

                    <div class="small-box bg-warning">

                        <div class="inner">

                            <h3>5</h3>

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

                            <h3>15</h3>

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

                            <h3>2</h3>

                            <p>Ditolak</p>

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
                        Tiket Terbaru
                    </h3>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="bg-primary">

                            <tr>

                                <th>No</th>

                                <th>Nama Mahasiswa</th>

                                <th>Layanan</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>1</td>

                                <td>Rafi Putra</td>

                                <td>Surat Aktif Kuliah</td>

                                <td>
                                    <span class="badge badge-warning">
                                        Diproses
                                    </span>
                                </td>

                            </tr>

                            <tr>

                                <td>2</td>

                                <td>Budi</td>

                                <td>Legalisir Ijazah</td>

                                <td>
                                    <span class="badge badge-success">
                                        Selesai
                                    </span>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

<div class="row mt-4">

    <div class="col-lg-8">

        <div class="card">

            <div class="card-header bg-success">

                <h3 class="card-title">

                    <i class="fas fa-chart-line"></i>

                    Grafik Penyelesaian Tiket

                </h3>

            </div>

            <div class="card-body">

                <div style="height:350px">

                    <canvas id="grafikUnit"></canvas>

                </div>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card">

            <div class="card-header bg-primary">

                <h3 class="card-title">

                    Ringkasan Unit

                </h3>

            </div>

            <div class="card-body">

                <h5>15 Tiket Diproses</h5>

                <hr>

                <h5>10 Tiket Selesai</h5>

                <hr>

                <h5>3 Menunggu</h5>

                <hr>

                <h5>2 Ditolak</h5>

            </div>

        </div>

    </div>

</div>

<div class="row mt-4">

    <div class="col-md-12">

        <div class="card">

            <div class="card-header bg-success">

                <h3 class="card-title">
                    <i class="fas fa-bolt"></i>
                    Quick Action
                </h3>

            </div>

            <div class="card-body">

                <div class="row text-center">

                    <div class="col-md-3">

                        <a href="<?= base_url('unit/tiket') ?>" class="btn btn-primary btn-lg btn-block">

                            <i class="fas fa-ticket-alt fa-2x"></i>

                            <br><br>

                            Data Tiket

                        </a>

                    </div>

                    <div class="col-md-3">

                        <a href="<?= base_url('unit/update-status/1') ?>" class="btn btn-success btn-lg btn-block">

                            <i class="fas fa-edit fa-2x"></i>

                            <br><br>

                            Update Status

                        </a>

                    </div>

                    <div class="col-md-3">

                        <a href="<?= base_url('unit/laporan') ?>" class="btn btn-warning btn-lg btn-block">

                            <i class="fas fa-chart-bar fa-2x"></i>

                            <br><br>

                            Laporan

                        </a>

                    </div>

                    <div class="col-md-3">

                        <a href="#" class="btn btn-danger btn-lg btn-block">

                            <i class="fas fa-search fa-2x"></i>

                            <br><br>

                            Cari Tiket

                        </a>

                    </div>

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

Tugas Saya

</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>No</th>

<th>Mahasiswa</th>

<th>Layanan</th>

<th>Status</th>

</tr>

</thead>

<tbody>

<tr>

<td>1</td>

<td>Rafi Putra</td>

<td>Surat Aktif Kuliah</td>

<td><span class="badge badge-warning">Diproses</span></td>

</tr>

<tr>

<td>2</td>

<td>Dimas</td>

<td>Legalisir</td>

<td><span class="badge badge-success">Selesai</span></td>

</tr>

</tbody>

</table>

</div>

</div>

</div>

<div class="col-lg-4">

<div class="card">

<div class="card-header bg-danger">

<h3 class="card-title">

Deadline Hari Ini

</h3>

</div>

<div class="card-body">

<div class="alert alert-warning">

Surat Aktif Kuliah

<br>

Sisa waktu

<b>2 Jam</b>

</div>

<div class="alert alert-danger">

Legalisir

<br>

Sisa waktu

<b>30 Menit</b>

</div>

</div>

</div>

</div>

</div>

<div class="row mt-4">

<div class="col-lg-7">

<div class="card">

<div class="card-header bg-info">

<h3 class="card-title">

Aktivitas Terbaru

</h3>

</div>

<div class="card-body">

<ul>

<li>09.00 Tiket #ULT001 diterima</li>

<li>09.30 Status menjadi Diproses</li>

<li>10.00 Dokumen selesai dibuat</li>

<li>10.20 Tiket selesai</li>

</ul>

</div>

</div>

</div>

<div class="col-lg-5">

<div class="card">

<div class="card-header bg-warning">

<h3 class="card-title">

Notifikasi

</h3>

</div>

<div class="card-body">

<div class="alert alert-success">

10 tiket selesai hari ini

</div>

<div class="alert alert-warning">

3 tiket masih diproses

</div>

<div class="alert alert-danger">

1 tiket melewati deadline

</div>

</div>

</div>

</div>

</div>

<script>

document.addEventListener("DOMContentLoaded", function(){

    var ctx=document.getElementById("grafikUnit");

    if(ctx){

        new Chart(ctx,{

            type:'line',

            data:{

                labels:['Sen','Sel','Rab','Kam','Jum'],

                datasets:[{

                    label:'Tiket Selesai',

                    data:[3,6,5,8,10],

                    borderColor:'#198754',

                    backgroundColor:'rgba(25,135,84,0.2)',

                    fill:true,

                    tension:0.4

                }]

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