<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<div class="row mb-3">

<div class="col-sm-6">

<h1 class="font-weight-bold text-primary">

<i class="fas fa-ticket-alt"></i>

Data Tiket

</h1>

<p class="text-muted mb-0">

Kelola seluruh tiket layanan mahasiswa Politeknik Negeri Bandung

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

Data Tiket

</li>

</ol>

</div>

</div>

</div>

</section>

<section class="content-header">

<div class="container-fluid">

<div class="card card-outline card-primary">

<div class="card-header">

<h3 class="card-title">

<i class="fas fa-filter"></i>

Filter Tiket

</h3>

</div>

<div class="card-body">

<div class="row align-items-end">

<div class="row align-items-end">

    <div class="col-lg-4">
        <label>Cari Mahasiswa</label>
        <input type="text"
               class="form-control"
               placeholder="NIM / Nama / Nomor Tiket">
    </div>

    <div class="col-lg-2">
        <label>Status</label>
        <select class="form-control">
            <option>Semua</option>
            <option>Submitted</option>
            <option>Verified</option>
            <option>Diproses</option>
            <option>Selesai</option>
        </select>
    </div>

    <div class="col-lg-2">
        <label>Kategori</label>
        <select class="form-control">
            <option>Semua</option>
            <option>Akademik</option>
            <option>Kemahasiswaan</option>
            <option>Keuangan</option>
        </select>
    </div>

    <div class="col-lg-2">
        <label>Unit</label>
        <select class="form-control">
            <option>Semua</option>
            <option>Direktorat Akademik</option>
            <option>Jurusan TI</option>
            <option>Keuangan</option>
        </select>
    </div>

    <div class="col-lg-2">
        <label>Prioritas</label>
        <select class="form-control">
            <option>Semua</option>
            <option>High</option>
            <option>Medium</option>
            <option>Low</option>
        </select>
    </div>

</div>

<div class="row mt-3 align-items-end">

    <div class="col-lg-3">

        <label>Tanggal</label>

        <input type="date"
               class="form-control">

    </div>

    <div class="col-lg-9 text-right">

        <button class="btn btn-primary">

            <i class="fas fa-search"></i>

            Cari

        </button>

        <button class="btn btn-secondary">

            <i class="fas fa-sync"></i>

            Reset

        </button>

    </div>

</div>

<div class="col-md-2">

<label>Tanggal</label>

<input
type="date"
class="form-control">

</div>

</div>

<br>



</div>

</div>

<div class="card card-outline card-primary">



<section class="content">

<div class="container-fluid">

<div class="card shadow-sm border-0">

    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-list text-primary"></i>
            Daftar Tiket Masuk
        </h5>

        <span class="badge badge-primary">
            Total : 25 Tiket
        </span>

    </div>

    <div class="card-body p-0">




</div>

</form>

</div>

<div class="card-body table-responsive">

<table class="table table-hover table-striped mb-0">

<thead class="bg-primary text-white">

<tr>

<th>No Tiket</th>
<th>Pemohon</th>
<th>Kategori</th>
<th>Layanan</th>
<th>Prioritas</th>
<th>SLA</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody id="tableBody">

<tr>

<td>ULT-20260720-0001</td>

<td>Rafi Putra</td>

<td>Akademik</td>

<td>Surat Aktif Kuliah</td>

<td>
<span class="badge badge-danger px-3 py-2">
High
</span>
</td>

<td>2 Hari</td>

<td>
<span class="badge badge-warning px-3 py-2">
Submitted
</span>
</td>

<td>

<a href="<?= base_url('petugas/detail/1') ?>" class="btn btn-info btn-sm">
<i class="fas fa-eye"></i>
</a>

<a href="<?= base_url('petugas/verifikasi/1') ?>" class="btn btn-success btn-sm">
<i class="fas fa-check"></i>
</a>

<a href="<?= base_url('petugas/disposisi/1') ?>" class="btn btn-primary btn-sm">
<i class="fas fa-share"></i>
</a>

</td>

</tr>

<tr>

<td>ULT-20260720-0002</td>

<td>Siti Nurhaliza</td>

<td>Kemahasiswaan</td>

<td>Legalisir Ijazah</td>

<td>
<span class="badge badge-warning px-3 py-2">
Medium
</span>
</td>

<td>1 Hari</td>

<span class="badge badge-secondary px-3 py-2">
Low
</span>

<td>
<span class="badge badge-success px-3 py-2">
Verified
</span>
</td>

<span class="badge badge-info px-3 py-2">
Diproses
</span>

<span class="badge badge-primary px-3 py-2">
Selesai
</span>

<td class="align-middle">

<div class="btn-group">

<a href="<?= base_url('petugas/detail/1') ?>"
class="btn btn-info btn-sm"
title="Detail">

<i class="fas fa-eye"></i>

</a>

<a href="<?= base_url('petugas/verifikasi/1') ?>"
class="btn btn-success btn-sm"
title="Verifikasi">

<i class="fas fa-check"></i>

</a>

<a href="<?= base_url('petugas/disposisi/1') ?>"
class="btn btn-primary btn-sm"
title="Disposisi">

<i class="fas fa-share"></i>

</a>

</div>

<div class="card-footer bg-white">

<nav>

<ul class="pagination pagination-sm justify-content-end mb-0">

<li class="page-item disabled">

<a class="page-link">

Previous

</a>

</li>

<li class="page-item active">

<a class="page-link">

1

</a>

</li>

<li class="page-item">

<a class="page-link">

2

</a>

</li>

<li class="page-item">

<a class="page-link">

Next

</a>

</li>

</ul>

</nav>

</div>

</td>
</td>

</tr>

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>

<script>

const input = document.getElementById("searchInput");

const status = document.getElementById("statusFilter");

const rows = document.querySelectorAll("#tableBody tr");

function filterTable(){

const keyword = input.value.toLowerCase();

const st = status.value.toLowerCase();

rows.forEach(function(row){

const text = row.innerText.toLowerCase();

const statusText = row.cells[5].innerText.toLowerCase();

const cocokKeyword = text.includes(keyword);

const cocokStatus = st==="" || statusText.includes(st);

row.style.display = (cocokKeyword && cocokStatus) ? "" : "none";

});

}

input.addEventListener("keyup",filterTable);

status.addEventListener("change",filterTable);

document.getElementById("formCari").addEventListener("submit",function(e){

e.preventDefault();

filterTable();

});

document.getElementById("resetFilter").addEventListener("click",function(){

input.value="";

status.value="";

filterTable();

});

</script>

<?= view('layouts/footer') ?>