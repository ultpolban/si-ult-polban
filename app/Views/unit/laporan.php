<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar_unit') ?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">

<div class="row mb-2">

<div class="col-sm-6">
<h1>Laporan Unit</h1>
<p class="text-muted">
Rekap seluruh tiket yang telah diproses
</p>
</div>

<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item">
<a href="<?= base_url('unit') ?>">Dashboard</a>
</li>
<li class="breadcrumb-item active">
Laporan
</li>
</ol>
</div>

</div>

</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header">
<h3 class="card-title">Data Laporan</h3>
</div>

<div class="card-body">

<table class="table table-bordered table-striped">

<thead>

<tr>
<th>No</th>
<th>No Tiket</th>
<th>Pemohon</th>
<th>Layanan</th>
<th>Status</th>
<th>Tanggal Selesai</th>
</tr>

</thead>

<tbody>

<tr>
<td>1</td>
<td>ULT-20260715-0001</td>
<td>Budi Santoso</td>
<td>Surat Aktif Kuliah</td>
<td>
<span class="badge badge-success">
Selesai
</span>
</td>
<td>15 Juli 2026</td>
</tr>

</tbody>

</table>

</div>

</div>

</div>

</section>

</div>

<?= view('layouts/footer') ?>