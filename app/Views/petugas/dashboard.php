<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">

<h1 class="m-0 font-weight-bold text-primary">

Dashboard Petugas ULT

</h1>

<p class="text-muted">

Kelola tiket layanan mahasiswa Politeknik Negeri Bandung

</p>

</div>

<div class="col-sm-6">

<ol class="breadcrumb float-sm-right">

<li class="breadcrumb-item">

<a href="<?= base_url('petugas/dashboard') ?>">

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

<div class="col-lg-3 col-md-6">

<div class="small-box elevation-3" style="background:#005BAC;color:white;">

<div class="inner">

<h3><span class="badge badge-primary">
120
</span></h3>

<p>Tiket Masuk</p>

</div>

<div class="icon">

<i class="fas fa-inbox"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6">

<div class="small-box elevation-3"
     style="background:#0B8F4D;color:white;">

<div class="inner">

<h3><span class="badge badge-success">
95
</span></h3>

<p>Diverifikasi</p>

</div>

<div class="icon">

<i class="fas fa-check-circle"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6">

<div class="small-box elevation-3"
     style="background:#F4B400;color:white;">

<div class="inner">

<h3><span class="badge badge-warning">
20
</span></h3>

<p>Diproses Unit</p>

</div>

<div class="icon">

<i class="fas fa-spinner"></i>

</div>

</div>

</div>

<div class="col-lg-3 col-md-6">

<div class="small-box elevation-3"
     style="background:#D93025;color:white;">

<div class="inner">

<h3><span class="badge badge-danger">
5
</span></h3>

<p>Terlambat SLA</p>

</div>

<div class="icon">

<i class="fas fa-clock"></i>

</div>

</div>

</div>

</div>

</div>

<div class="card mt-3">

<div class="card-header bg-primary">

<h3 class="card-title">

<i class="fas fa-bolt"></i>

Quick Action

</h3>

</div>

<div class="card-body">

<div class="row text-center">

<div class="col-md-3">

<a href="<?= base_url('petugas/tiket') ?>" class="btn btn-primary shadow btn-lg btn-block">

<i class="fas fa-ticket-alt fa-2x"></i>

<br><br>

Data Tiket

</a>

</div>

<div class="col-md-3">

<a href="<?= base_url('petugas/verifikasi/1') ?>" class="btn btn-success shadow btn-lg btn-block">

<i class="fas fa-user-check fa-2x"></i>

<br><br>

Verifikasi

</a>

</div>

<div class="col-md-3">

<a href="<?= base_url('petugas/disposisi/1') ?>" class="btn btn-warning shadow btn-lg btn-block">

<i class="fas fa-share fa-2x"></i>

<br><br>

Disposisi

</a>

</div>

<div class="col-md-3">

<a href="<?= current_url() ?>" class="btn btn-dark shadow btn-lg btn-block">

<i class="fas fa-sync-alt fa-2x"></i>

<br><br>

Refresh

</a>

</div>

</div>

</div>

</div>

<div class="card mt-4">

    <div class="card-header bg-info">

        <h3 class="card-title">
            <i class="fas fa-filter"></i>
            Filter Tiket
        </h3>

    </div>

    <div class="card-body">

        <form>

            <div class="row">

                <div class="col-md-3 mb-3">

                    <label>Status</label>

                    <select class="form-control">

                        <option>Semua Status</option>
                        <option>Menunggu Verifikasi</option>
                        <option>Terverifikasi</option>
                        <option>Didisposisikan</option>
                        <option>Diproses Unit</option>
                        <option>Selesai</option>

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label>Kategori</label>

                    <select class="form-control">

                        <option>Semua Kategori</option>
                        <option>Akademik</option>
                        <option>Keuangan</option>
                        <option>Kemahasiswaan</option>

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label>Prioritas</label>

                    <select class="form-control">

                        <option>Semua Prioritas</option>
                        <option>High</option>
                        <option>Medium</option>
                        <option>Low</option>

                    </select>

                </div>

                <div class="col-md-3 mb-3">

                    <label>Unit Tujuan</label>

                    <select class="form-control">

                        <option>Semua Unit</option>
                        <option>Direktorat Akademik</option>
                        <option>Jurusan Teknik Informatika</option>
                        <option>Bagian Keuangan</option>

                    </select>

                </div>

            </div>

            <div class="row">

                <div class="col-md-10">

                    <label>Pencarian</label>

                    <input
                        type="text"
                        class="form-control"
                        placeholder="Cari berdasarkan NIM, Nama, atau Nomor Tiket">

                </div>

                <div class="col-md-2 d-flex align-items-end">

                    <button class="btn btn-primary btn-block">

                        <i class="fas fa-search"></i>

                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<div class="card mt-4">

    <div class="card-header bg-primary">

        <h3 class="card-title">

            <i class="fas fa-ticket-alt"></i>

            Antrian Tiket Terbaru

        </h3>

        <div class="card-tools">

           <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-outline-light btn-sm">
    <i class="fas fa-list"></i> Lihat Semua
</a>

        </div>

    </div>

    <div class="card-body table-responsive p-0">

        <table class="table table-hover text-nowrap">

            <thead class="bg-light">

                <tr>

                    <th>No Tiket</th>
                    <th>Mahasiswa</th>
                    <th>Layanan</th>
                    <th>Prioritas</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>ULT-001</td>

                    <td>Rafi Putra</td>

                    <td>Surat Aktif Kuliah</td>

                    <td>

                        <span class="badge badge-danger">

                            High

                        </span>

                    </td>

                    <td>

                        <span class="badge badge-warning">

                            Menunggu Verifikasi

                        </span>

                    </td>

                    <td>20 Juli 2026</td>

                    <td>

                        <a href="<?= base_url('petugas/detail/1') ?>" class="btn btn-primary shadow btn-sm">

                            <i class="fas fa-eye"></i>

                        </a>

                        <a href="<?= base_url('petugas/verifikasi/1') ?>" class="btn btn-success shadow btn-sm">

                            <i class="fas fa-check"></i>

                        </a>

                    </td>

                </tr>

                <tr>

                    <td>ULT-002</td>

                    <td>Siti Nurhaliza</td>

                    <td>Legalisir Ijazah</td>

                    <td>

                        <span class="badge badge-warning">

                            Medium

                        </span>

                    </td>

                    <td>

                        <span class="badge badge-success">

                            Terverifikasi

                        </span>

                    </td>

                    <td>20 Juli 2026</td>

                    <td>

                        <a href="<?= base_url('petugas/detail/2') ?>" class="btn btn-primary shadow btn-sm">

                            <i class="fas fa-eye"></i>

                        </a>

                        <a href="<?= base_url('petugas/disposisi/2') ?>" class="btn btn-primary btn-sm">

                            <i class="fas fa-share"></i>

                        </a>

                    </td>

                </tr>

                <tr>

                    <td>ULT-003</td>

                    <td>Andi Saputra</td>

                    <td>Surat Keterangan Lulus</td>

                    <td>

                        <span class="badge badge-secondary">

                            Low

                        </span>

                    </td>

                    <td>

                        <span class="badge badge-info">

                            Diproses Unit

                        </span>

                    </td>

                    <td>19 Juli 2026</td>

                    <td>

                        <a href="<?= base_url('petugas/detail/3') ?>" class="btn btn-primary shadow btn-sm">

                            <i class="fas fa-eye"></i>

                        </a>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>

</div>

<div class="card mt-4">

<div class="card-header bg-danger">

<h3 class="card-title">

<i class="fas fa-exclamation-triangle"></i>

Tiket Prioritas Tinggi

</h3>

</div>

<div class="card-body table-responsive">

<table class="table table-hover">

<thead>

<tr>

<th>No Tiket</th>

<th>Mahasiswa</th>

<th>Layanan</th>

<th>SLA</th>

<th>Status</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<tr>

<td>ULT-004</td>

<td>Rafi Putra</td>

<td>Surat Aktif Kuliah</td>

<td>

<span class="badge badge-danger">

1 Hari

</span>

</td>

<td>

<span class="badge badge-warning">

Menunggu

</span>

</td>

<td>

<a href="<?= base_url('petugas/detail/1') ?>" class="btn btn-info btn-sm">

<i class="fas fa-eye"></i>

</a>

</td>

</tr>

<tr>

<td>ULT-005</td>

<td>Siti Nurhaliza</td>

<td>Legalisir</td>

<td>

<span class="badge badge-danger">

Hari Ini

</span>

</td>

<td>

<span class="badge badge-danger">

Urgent

</span>

</td>

<td>

<a href="<?= base_url('petugas/detail/2') ?>" class="btn btn-info btn-sm">

<i class="fas fa-eye"></i>

</a>

</td>

</tr>

</tbody>

</table>

</div>

</div>

<div class="card mt-4">

<div class="card-header bg-warning">

<h3 class="card-title">

<i class="fas fa-clock"></i>

Monitoring SLA

</h3>

</div>

<div class="card-body">

<table class="table table-bordered">

<thead>

<tr>

<th>Status SLA</th>

<th>Jumlah</th>

<th>Keterangan</th>

</tr>

</thead>

<tbody>

<tr>

<td>

<span class="badge badge-success">

Aman

</span>

</td>

<td>96</td>

<td>Masih dalam batas SLA</td>

</tr>

<tr>

<td>

<span class="badge badge-warning">

Mendekati Deadline

</span>

</td>

<td>14</td>

<td>< 24 Jam</td>

</tr>

<tr>

<td>

<span class="badge badge-danger">

Melewati SLA

</span>

</td>

<td>3</td>

<td>Harus segera diproses</td>

</tr>

</tbody>

</table>

</div>

</div>

<div class="row mt-4">

    <!-- Aktivitas -->
    <div class="col-lg-8">

        <div class="card">

           <div class="card-header"

style="background:#005BAC;color:white;">
                <h3 class="card-title">

                    <i class="fas fa-history"></i>

                    Aktivitas Terbaru

                </h3>

            </div>

            <div class="card-body">

                <div class="timeline">

                    <div class="time-label">
                        <span class="bg-primary">20 Juli 2026</span>
                    </div>

                    <div>

                        <i class="fas fa-file-alt bg-primary"></i>

                        <div class="timeline-item">

                            <span class="time">
                                <i class="fas fa-clock"></i> 08:15
                            </span>

                            <h3 class="timeline-header">

                                Pengajuan Baru

                            </h3>

                            <div class="timeline-body">

                                <b>Rafi Putra</b> mengajukan
                                <br>
                                Surat Aktif Kuliah.

                            </div>

                        </div>

                    </div>

                    <div>

                        <i class="fas fa-check"
   style="background:#0B8F4D;color:white;"></i>

                        <div class="timeline-item">

                            <span class="time">

                                <i class="fas fa-clock"></i>

                                09:00

                            </span>

                            <h3 class="timeline-header">

                                Tiket Diverifikasi

                            </h3>

                            <div class="timeline-body">

                                Tiket <b>ULT-001</b>
                                berhasil diverifikasi.

                            </div>

                        </div>

                    </div>

                    <div>

                       <i class="fas fa-share"
   style="background:#F4B400;color:white;"></i>

                        <div class="timeline-item">

                            <span class="time">

                                <i class="fas fa-clock"></i>

                                10:20

                            </span>

                            <h3 class="timeline-header">

                                Disposisi

                            </h3>

                            <div class="timeline-body">

                                Tiket dikirim ke
                                <b>Direktorat Akademik</b>.

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    

    </div>

</div>


        </div>

    </div>


</div>

</section>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById("grafikStatus");

    if (ctx) {

        new Chart(ctx, {

            type: "doughnut",

            data: {

                labels: [

                    "Menunggu",

                    "Diproses",

                    "Selesai",

                    "Ditolak"

                ],

                datasets: [{

                    data: [25, 20, 70, 5],

                    backgroundColor: [

                        "#005BAC",

                        "#F4B400",

                        "#34A853",

                        "#EA4335"

                    ],

                    borderWidth: 2

                }]

            },

options: {

    responsive: true,

    maintainAspectRatio: true,

    cutout: '78%',

    plugins: {

        legend: {

            position: 'bottom'

        }

    }

}

        });

    }

});

</script>
<?= view('layouts/footer') ?> 