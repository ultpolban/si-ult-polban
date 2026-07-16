<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-2">

                <div>
                    <h2>Data Tiket</h2>
                    <p class="text-muted mb-0">
                        Daftar seluruh tiket yang masuk ke ULT
                    </p>
                </div>

                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url('petugas') ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Data Tiket
                    </li>
                </ol>

            </div>

        </div>
    </section>

    <!-- Content -->
    <section class="content p-4">

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">
                    Data Tiket
                </h3>
            </div>

            <div class="card-body">

                <!-- Search -->
                <div class="row mb-3">

                    <div class="col-md-4">
                        <input type="text"
                               class="form-control"
                               placeholder="Cari nomor tiket atau nama pemohon...">
                    </div>

                    <div class="col-md-3">
                        <select class="form-control">
                            <option>Semua Status</option>
                            <option>Submitted</option>
                            <option>Verified</option>
                            <option>Assigned</option>
                            <option>In Progress</option>
                            <option>Completed</option>
                        </select>
                    </div>

                </div>

                <!-- Table -->
              <div class="row">

<div class="col-md-8">

<div class="card">

<div class="card-header bg-primary text-white">

<h3 class="card-title">

<i class="fas fa-ticket-alt"></i>

Tiket Terbaru

</h3>

</div>

<div class="card-body p-0">

<table class="table table-hover">

<thead>

<tr>

<th>No Tiket</th>
<th>Pemohon</th>
<th>Layanan</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<tr>

<td>ULT-0001</td>

<td>Budi Santoso</td>

<td>Surat Aktif Kuliah</td>

<td>

<span class="badge badge-warning">

Submitted

</span>

</td>

<td>

<a href="<?= base_url('petugas/detail/1') ?>"
class="btn btn-primary btn-sm">

Detail

</a>

</td>

</tr>

<tr>

<td>ULT-0002</td>

<td>Siti Rahma</td>

<td>Legalisir Ijazah</td>

<td>

<span class="badge badge-success">

Verified

</span>

</td>

<td>

<a href="#"
class="btn btn-primary btn-sm">

Detail

</a>

</td>

</tr>

</tbody>

</table>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<div class="card-header bg-warning">

<h3 class="card-title">

<i class="fas fa-bell"></i>

Aktivitas Hari Ini

</h3>

</div>

<div class="card-body">

<ul class="list-group">

<li class="list-group-item">

✅ Tiket ULT-0001 diverifikasi

</li>

<li class="list-group-item">

📤 Tiket ULT-0002 dikirim ke Akademik

</li>

<li class="list-group-item">

🏁 Tiket ULT-0003 selesai

</li>

<li class="list-group-item">

⚠ Ada 2 tiket melewati SLA

</li>

</ul>

</div>

</div>

</div>

</div>

</div>

</section>

</div>


<?= view('layouts/footer') ?>