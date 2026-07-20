<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">

<div class="container-fluid">

<h2 class="font-weight-bold text-primary">

Verifikasi Tiket

</h2>

<p class="text-muted">

Verifikasi dokumen sebelum dikirim ke Unit Tujuan

</p>

</div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row mb-3">

    <div class="col-md-3">

        <div class="small-box bg-primary">

            <div class="inner">

                <h4>Submitted</h4>

                <p>Status Saat Ini</p>

            </div>

            <div class="icon">

                <i class="fas fa-paper-plane"></i>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-warning">

            <div class="inner">

                <h4>Petugas ULT</h4>

                <p>Sedang Memverifikasi</p>

            </div>

            <div class="icon">

                <i class="fas fa-user-check"></i>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-info">

            <div class="inner">

                <h4>Akademik</h4>

                <p>Unit Tujuan</p>

            </div>

            <div class="icon">

                <i class="fas fa-building"></i>

            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="small-box bg-success">

            <div class="inner">

                <h4>High</h4>

                <p>Prioritas</p>

            </div>

            <div class="icon">

                <i class="fas fa-exclamation-circle"></i>

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

<div class="card-body">

<table class="table table-bordered">

<tr>

<th width="250">

Nomor Tiket

</th>

<td>

ULT-20260720-0001

</td>

</tr>

<tr>

<th>

Nama Pemohon

</th>

<td>

Rafi Putra

</td>

</tr>

<tr>

<th>

NIM

</th>

<td>

231511001

</td>

</tr>

<tr>

<th>

Jenis Layanan

</th>

<td>

Surat Aktif Kuliah

</td>

</tr>

<tr>

<th>

Kategori

</th>

<td>

Akademik

</td>

</tr>

<tr>

<th>

Prioritas

</th>

<td>

High

</td>

</tr>

<tr>

<th>

Status

</th>

<td>

Submitted

</td>

</tr>

</table>

</div>

</div>

<div class="card">

<div class="card-header bg-info">

<h3 class="card-title">

Lampiran Pemohon

</h3>

</div>

<div class="card-body text-center">

<i class="fas fa-file-pdf fa-5x text-danger"></i>

<br><br>

<button class="btn btn-primary">

Lihat Lampiran

</button>

</div>

</div>

<div class="card">

<div class="card-header bg-success">

<h3 class="card-title">

Verifikasi

</h3>

</div>

<hr>

<h5>

Checklist Kelengkapan

</h5>

<div class="form-check">

<input class="form-check-input" type="checkbox">

<label class="form-check-label">

Data Mahasiswa Sesuai

</label>

</div>

<div class="form-check">

<input class="form-check-input" type="checkbox">

<label class="form-check-label">

Lampiran Lengkap

</label>

</div>

<div class="form-check">

<input class="form-check-input" type="checkbox">

<label class="form-check-label">

Persyaratan Sudah Sesuai

</label>

</div>

<hr>

<div class="card-body">

<div class="form-group">

<label>

Status Verifikasi

</label>

<select class="form-control">

<option value="">

Pilih Keputusan

</option>

<option value="verified">

Verifikasi Berhasil

</option>

<option value="revision">

Minta Revisi Dokumen

</option>

<option value="rejected">

Tolak Pengajuan

</option>

</select>

</div>

<div class="form-group">

<label>

Catatan Petugas

</label>

<textarea

class="form-control"

rows="5"

placeholder="Masukkan catatan verifikasi...">

</textarea>

<hr>

<h5>

Riwayat Proses

</h5>

<table class="table table-bordered table-sm">

<tr>

<th>Waktu</th>

<th>Aktivitas</th>

</tr>

<tr>

<td>20 Juli 2026 08:15</td>

<td>Pengajuan dibuat mahasiswa</td>

</tr>

<tr>

<td>20 Juli 2026 09:20</td>

<td>Masuk ke antrean Petugas ULT</td>

</tr>

</table>

<div class="mt-3">

<button class="btn btn-success">

<i class="fas fa-save"></i>

Simpan Verifikasi

</button>

<a href="<?= base_url('petugas/disposisi/1') ?>"

class="btn btn-primary">

<i class="fas fa-share"></i>

Lanjut Disposisi

</a>

<a href="<?= base_url('petugas/detail/1') ?>"

class="btn btn-info">

<i class="fas fa-eye"></i>

Detail Tiket

</a>

<a href="<?= base_url('petugas/dashboard')?>"

class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

</div>
</div>

</div>

</section>

</div>

<?= view('layouts/footer') ?>