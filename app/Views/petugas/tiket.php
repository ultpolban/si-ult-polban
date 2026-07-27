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

<form id="formCari">

<div class="row">

    <div class="col-lg-4">
        <label>Cari Mahasiswa</label>

        <input
            id="searchInput"
            type="text"
            class="form-control"
            placeholder="NIM / Nama / Nomor Tiket">
    </div>

    <div class="col-lg-2">
        <label>Status</label>

        <select
            id="statusFilter"
            class="form-control">

            <option value="">Semua</option>
            <option value="Submitted">Submitted</option>
            <option value="Verified">Verified</option>
            <option value="Diproses">Diproses</option>
            <option value="Selesai">Selesai</option>

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

<div class="row mt-3">

    <div class="col-lg-3">

        <label>Tanggal</label>

        <input
            type="date"
            class="form-control">

    </div>

    <div class="col-lg-9 text-right align-self-end">

        <button
            class="btn btn-primary"
            type="submit">

            <i class="fas fa-search"></i>

            Cari

        </button>

        <button
            id="resetFilter"
            type="button"
            class="btn btn-secondary">

            <i class="fas fa-sync"></i>

            Reset

        </button>

    </div>

</div>

</form>

</div>

</div>

</div>

<div class="card card-outline card-primary">



<section class="content">

<div class="row mt-3 mb-4">

    <div class="col-lg-3 col-md-6 mb-3">

       <div class="small-box elevation-2"
style="background:#005BAC;color:white;">

            <div class="inner">

                <h3>25</h3>

                <p>Total Tiket</p>

            </div>

            <div class="icon">

                <i class="fas fa-ticket-alt"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-3">

      <div class="small-box elevation-2"
style="background:#F4B400;color:white;">

            <div class="inner">

                <h3>7</h3>

                <p>Menunggu</p>

            </div>

            <div class="icon">

                <i class="fas fa-hourglass-half"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-3">

      <div class="small-box elevation-2"
style="background:#0B8F4D;color:white;">
            <div class="inner">

                <h3>12</h3>

                <p>Selesai</p>

            </div>

            <div class="icon">

                <i class="fas fa-check-circle"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6 mb-3">

      <div class="small-box elevation-2"
style="background:#D93025;color:white;">

            <div class="inner">

                <h3>6</h3>

                <p>Prioritas Tinggi</p>

            </div>

            <div class="icon">

                <i class="fas fa-exclamation-circle"></i>

            </div>

        </div>

    </div>

</div>

<div class="container-fluid">

<div class="card shadow-sm border-0">

    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">

        <h5 class="mb-0">
            <i class="fas fa-list text-primary"></i>
            Daftar Tiket Masuk
        </h5>

        <span class="badge badge-primary">
            Total : 25 Tiket
        </span>

    </div>

<div class="card-body table-responsive">

<table class="table table-hover align-middle text-center mb-0">

<thead style="background:#005BAC;color:white;">

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
       <span class="badge badge-danger rounded-pill px-3 py-2">
High
</span>
    </td>

    <td>2 Hari</td>

    <td>
        <span class="badge badge-warning rounded-pill px-3 py-2">
Submitted
</span>
    </td>


    <td class="text-center">

        <a href="<?= base_url('petugas/detail/1') ?>"
           class="btn btn-info btn-sm mx-1">
            <i class="fas fa-eye"></i>

        </a>

        <a href="<?= base_url('petugas/verifikasi/1') ?>"
          class="btn btn-success btn-sm mx-1">

            <i class="fas fa-check"></i>

        </a>

        <a href="<?= base_url('petugas/disposisi/1') ?>"
           class="btn btn-primary btn-sm mx-1">

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

    <td>

        <span class="badge badge-success px-3 py-2">

            Verified

        </span>

    </td>

    <td class="text-center">

        <a href="<?= base_url('petugas/detail/2') ?>"
          class="btn btn-info btn-sm mr-1">

            <i class="fas fa-eye"></i>

        </a>

        <a href="<?= base_url('petugas/verifikasi/2') ?>"
           class="btn btn-success btn-sm mr-1">

            <i class="fas fa-check"></i>

        </a>

        <a href="<?= base_url('petugas/disposisi/2') ?>"
            class="btn btn-primary btn-sm">

            <i class="fas fa-share"></i>

        </a>

    </td>

</tr>

</tbody>

</table>

</div> <!-- card-body -->

<div class="card-footer bg-white">

    <nav>

        <ul class="pagination justify-content-end mb-0">

            <li class="page-item disabled">
                <a class="page-link">Previous</a>
            </li>

            <li class="page-item active">
                <a class="page-link">1</a>
            </li>

            <li class="page-item">
                <a class="page-link">2</a>
            </li>

            <li class="page-item">
                <a class="page-link">Next</a>
            </li>

        </ul>

    </nav>

</div> <!-- card-footer -->

</div> <!-- card -->

</div> <!-- container-fluid -->

</section>

</div> <!-- content-wrapper -->



<script>

const input = document.getElementById("searchInput");

const status = document.getElementById("statusFilter");

const rows = document.querySelectorAll("#tableBody tr");

function filterTable(){

const keyword = input.value.toLowerCase();

const st = status.value.toLowerCase();

rows.forEach(function(row){

const text = row.innerText.toLowerCase();

const statusText = row.cells[6].innerText.toLowerCase();

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

<style>

.small-box{
transition:.3s;
border-radius:12px;
}

.small-box:hover{
transform:translateY(-5px);
}

.table tbody tr:hover{
background:#F8FAFC;
}

.badge{
font-size:13px;
font-weight:600;
}

.btn-sm{
border-radius:8px;
}

.card{
border-radius:12px;
}

.table thead th{
    vertical-align: middle;
    font-size:15px;
}

.table td{
    vertical-align: middle;
}

.btn-sm{
    width:36px;
    height:36px;
    padding:0;
    line-height:36px;
}

.card-header h5{
    font-weight:600;
}

.card-header{
    border-bottom:1px solid #eee;
}

.pagination .page-link{
    border-radius:8px;
    margin:0 2px;
}

.badge{
    min-width:85px;
}

</style>

<?= view('layouts/footer') ?>