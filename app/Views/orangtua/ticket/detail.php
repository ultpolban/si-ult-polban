<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_orangtua') ?>

<div class="content-wrapper">

<section class="content-header">
    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 style="font-weight:700;color:#0b3d91;">
                    <i class="fas fa-ticket-alt mr-2"></i>
                    Detail Tiket
                </h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('dashboard-orangtua') ?>">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="<?= base_url('orangtua/ticket/history') ?>">
                            Tracking Tiket
                        </a>
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

<div class="container-fluid">

<div class="card shadow-sm mb-4"
style="border-radius:15px;">

<div class="card-body">

<div class="d-flex justify-content-between align-items-start flex-wrap">

<div>

<h2
style="
font-weight:700;
color:#0b3d91;
margin-bottom:10px;
">

<?= $ticket['nomor'] ?>

</h2>

<p class="text-muted mb-0">

<i class="fas fa-calendar-alt mr-2"></i>

<?= $ticket['tanggal'] ?>

</p>

</div>

<span
class="badge badge-primary"
style="
padding:10px 18px;
font-size:14px;
background:#0b3d91;
">

Submitted

</span>

</div>

</div>

</div>

<div class="row">

<div class="col-lg-8">

<div
class="card shadow-sm mb-4"
style="border-radius:15px;">

<div
class="card-header"
style="
background:#0b3d91;
color:white;
border-bottom:4px solid #f28c28;
">

<h5 class="mb-0">

<i class="fas fa-file-alt mr-2"></i>

Informasi Pengajuan

</h5>

</div>

<div class="card-body p-0">

<table class="table table-bordered mb-0">

<tr>

<th width="35%">

<i class="fas fa-user text-primary mr-2"></i>

Nama Pengaju

</th>

<td>

<?= $ticket['nama'] ?>

</td>

</tr>

<tr>

<th>

<i class="fas fa-id-card text-primary mr-2"></i>

NIK

</th>

<td>

<?= $ticket['nik'] ?>

</td>

</tr>

<tr>

<th>

<i class="fas fa-file-signature text-primary mr-2"></i>

Jenis Layanan

</th>

<td>

<?= $ticket['layanan'] ?>

</td>

</tr>

<tr>

<th>

<i class="fas fa-building text-primary mr-2"></i>

Unit Tujuan

</th>

<td>

<?= $ticket['unit'] ?>

</td>

</tr>

<tr>

<th>

<i class="fas fa-calendar text-primary mr-2"></i>

Tanggal Pengajuan

</th>

<td>

<?= $ticket['tanggal'] ?>

</td>

</tr>

<tr>

<th>

<i class="fas fa-comment text-primary mr-2"></i>

Keterangan

</th>

<td>

<?= $ticket['keterangan'] ?>

</td>

</tr>

</table>

</div>

</div>