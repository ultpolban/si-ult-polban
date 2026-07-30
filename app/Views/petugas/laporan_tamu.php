<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4 py-4">

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h2 class="font-weight-bold">
            Laporan Tamu (Walk In)
        </h2>
    </div>

</div>

<div class="card shadow-sm border-0">

    <div class="card-header text-white"
         style="background:#1a237e">

        <a href="#"
           class="btn btn-success">

            <i class="fas fa-plus"></i>

            Tambah Laporan

        </a>

    </div>

    <div class="card-body">

    <form>

<div class="row mb-3">

<div class="col-md-5">

<input
type="text"
class="form-control"
placeholder="Cari Nomor Tiket / Nama / NIM">

</div>

<div class="col-md-3">

<select class="form-control">

<option>Semua Status</option>

<option>Waiting Verification</option>

<option>Assigned</option>

<option>Completed</option>

</select>

</div>

<div class="col-md-2">

<button class="btn btn-primary btn-block">

<i class="fas fa-search"></i>

Cari

</button>

</div>

<div class="col-md-2">

<button class="btn btn-secondary btn-block">

Reset

</button>

</div>

</div>

</form>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead
style="background:#1a237e;color:white">

<tr>

<th>No</th>

<th>No Tiket</th>

<th>Nama</th>

<th>Layanan</th>

<th>Status</th>

<th>Tanggal</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<tr>

<td>1</td>

<td>ULT-20260730081403481</td>

<td>Apin</td>

<td>Kemahasiswaan</td>

<td>

<span class="badge badge-warning">

Waiting Verification

</span>

</td>

<td>

30-07-2026

<br>

08:14

</td>

<td>

<a href="#"
class="btn btn-info btn-sm">

Detail

</a>

<a href="#"
class="btn btn-warning btn-sm">

Edit

</a>

<a href="#"
class="btn btn-danger btn-sm">

Hapus

</a>

</td>

</tr>

</tbody>
</table>

</div>

</div>
</div>

<?= $this->endSection() ?>