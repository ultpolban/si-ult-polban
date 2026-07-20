<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

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

<div class="row">

<div class="col-md-2">

<select class="form-control">

<option>Status</option>

<option>Submitted</option>

<option>Diverifikasi</option>

<option>Diproses</option>

<option>Selesai</option>

</select>

</div>

<div class="col-md-2">

<select class="form-control">

<option>Kategori</option>

<option>Akademik</option>

<option>Keuangan</option>

<option>Kemahasiswaan</option>

</select>

</div>

<div class="col-md-2">

<select class="form-control">

<option>Unit</option>

<option>BAAK</option>

<option>Keuangan</option>

<option>Jurusan</option>

</select>

</div>

<div class="col-md-2">

<select class="form-control">

<option>Prioritas</option>

<option>High</option>

<option>Medium</option>

<option>Low</option>

</select>

</div>

<div class="col-md-2">

<input type="date" class="form-control">

</div>

<div class="col-md-2">

<button class="btn btn-primary btn-block">

<i class="fas fa-search"></i>

Cari

</button>

</div>

</div>

</div>

</div>

<div class="card card-outline card-primary">

<div class="card-header">

<h3 class="card-title">

<i class="fas fa-list"></i>

Daftar Tiket Masuk

</h3>

</div>

<div class="card-body table-responsive">

....

</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">

<form id="formCari">

<div class="row">

<div class="col-md-3">

<input
id="searchInput"
type="text"
class="form-control"
placeholder="Cari NIM / Nama / No Tiket">

</div>

<div class="col-md-2">

<select
id="statusFilter"
class="form-control">

<option value="">Semua Status</option>

<option>Menunggu Verifikasi</option>

<option>Terverifikasi</option>

<option>Diproses Unit</option>

<option>Selesai</option>

</select>

</div>

<div class="col-md-2">

<select
class="form-control">

<option>Semua Prioritas</option>

<option>High</option>

<option>Medium</option>

<option>Low</option>

</select>

</div>

<div class="col-md-3">

<button
type="submit"
class="btn btn-primary">

<i class="fas fa-search"></i>

Cari

</button>

<button
type="button"
id="resetFilter"
class="btn btn-secondary">

Reset

</button>

</div>

</div>

</form>

</div>

<div class="card-body table-responsive">

<table class="table table-bordered table-hover">

<thead class="bg-primary">

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
<span class="badge badge-danger">
High
</span>
</td>

<td>2 Hari</td>

<td>
<span class="badge badge-warning">
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
<span class="badge badge-warning">
Medium
</span>
</td>

<td>1 Hari</td>

<td>
<span class="badge badge-success">
Verified
</span>
</td>

<td>

<a href="<?= base_url('petugas/detail/1') ?>"
   class="btn btn-info btn-sm"
   title="Lihat Detail">

    <i class="fas fa-eye"></i>

</a>

<a href="<?= base_url('petugas/verifikasi/1') ?>"
   class="btn btn-success btn-sm"
   title="Verifikasi Tiket">

    <i class="fas fa-check"></i>

</a>

<a href="<?= base_url('petugas/disposisi/1') ?>"
   class="btn btn-primary btn-sm"
   title="Disposisikan ke Unit">

    <i class="fas fa-share"></i>

</a>

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