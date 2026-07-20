<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h2 class="font-weight-bold text-primary">

Disposisi Tiket

</h2>

<p class="text-muted">

Teruskan tiket ke Unit Tujuan yang sesuai.

</p>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row mb-3">

    <div class="col-md-3">

        <div class="small-box bg-primary">

            <div class="inner">

                <h4>ULT-001</h4>

                <p>No Tiket</p>

            </div>

            <div class="icon">

                <i class="fas fa-ticket-alt"></i>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-success">

            <div class="inner">

                <h4>Verified</h4>

                <p>Status</p>

            </div>

            <div class="icon">

                <i class="fas fa-check-circle"></i>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-warning">

            <div class="inner">

                <h4>High</h4>

                <p>Prioritas</p>

            </div>

            <div class="icon">

                <i class="fas fa-exclamation-circle"></i>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-info">

            <div class="inner">

                <h4>Akademik</h4>

                <p>Kategori</p>

            </div>

            <div class="icon">

                <i class="fas fa-university"></i>

            </div>

        </div>

    </div>

</div>

<div class="card">

<div class="card-header bg-primary">

<h3 class="card-title">

Informasi Tiket

</h3>

</div>

<div class="card">

<div class="card-header bg-info">

<h3 class="card-title">

Progress Tiket

</h3>

</div>

<div class="card-body">

<div class="progress mb-3" style="height:25px;">

<div class="progress-bar bg-success"

style="width:60%;">

Verified

</div>

</div>

<small class="text-muted">

Tahap berikutnya adalah mengirim tiket ke Unit Tujuan.

</small>

</div>

</div>

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="220">Nomor Tiket</th>

<td>ULT-20260720-0001</td>

</tr>

<tr>

<th>Nama Pemohon</th>

<td>Rafi Putra</td>

</tr>

<tr>

<th>NIM</th>

<td>231511001</td>

</tr>

<tr>

<th>Layanan</th>

<td>Surat Aktif Kuliah</td>

</tr>

<tr>

<th>Kategori</th>

<td>Akademik</td>

</tr>

<tr>

<th>Prioritas</th>

<td>

<span class="badge badge-danger">

High

</span>

</td>

</tr>

<tr>

<th>Status</th>

<td>

<span class="badge badge-success">

Verified

</span>

</td>

</tr>

</table>

</div>

</div>

<div class="card">

<div class="card-header bg-success">

<h3 class="card-title">

Form Disposisi

</h3>

</div>

<div class="card-body">

<div class="form-group">

<label>

Unit Tujuan

</label>

<select class="form-control">

<option>-- Pilih Unit --</option>

<option>Direktorat Akademik</option>

<option>Jurusan Teknik Informatika</option>

<option>Bagian Keuangan</option>

<option>Perpustakaan</option>

</select>

</div>

<div class="form-group">

<label>

Prioritas

</label>

<select class="form-control">

<option>Low</option>

<option selected>Medium</option>

<option>High</option>

</select>

</div>

<div class="form-group mt-3">

<label>

Target Penyelesaian (SLA)

</label>

<input

type="date"

class="form-control">

</div>

<hr>

<h5>

Riwayat Disposisi

</h5>

<table class="table table-bordered table-sm">

<tr>

<th>Waktu</th>

<th>Aktivitas</th>

</tr>

<tr>

<td>20 Juli 2026 08:20</td>

<td>Pengajuan dibuat</td>

</tr>

<tr>

<td>20 Juli 2026 09:10</td>

<td>Diverifikasi Petugas</td>

</tr>

</table>

<div class="card-footer text-right">

<a href="<?= base_url('petugas/verifikasi/1') ?>" class="btn btn-warning">

<i class="fas fa-user-check"></i>

Kembali ke Verifikasi

</a>

<a href="<?= base_url('petugas/dashboard') ?>" class="btn btn-secondary">

<i class="fas fa-home"></i>

Dashboard

</a>

<button
type="button"
class="btn btn-primary"
data-toggle="modal"
data-target="#modalDisposisi">

<i class="fas fa-paper-plane"></i>

Kirim Disposisi

</button>

</div>

</div>

</div>

</div>

</section>

</div>

<div class="modal fade" id="modalDisposisi">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header bg-primary">

<h5 class="modal-title">

Konfirmasi Disposisi

</h5>

<button type="button" class="close" data-dismiss="modal">

<span>&times;</span>

</button>

</div>

<div class="modal-body">

Apakah Anda yakin ingin mengirim tiket ini ke Unit Tujuan?

</div>

<div class="modal-footer">

<button
type="button"
class="btn btn-secondary"
data-dismiss="modal">

Batal

</button>

<button
type="button"
class="btn btn-primary">

Ya, Kirim

</button>

</div>

</div>

</div>

</div>

<?= view('layouts/footer') ?>