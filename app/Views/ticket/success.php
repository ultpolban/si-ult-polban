<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

<section class="content">

<div class="container">

<div class="row justify-content-center mt-5">

<div class="col-md-6">

<div class="card text-center shadow">

<div class="card-body">

<i class="fas fa-check-circle fa-5x text-success mb-3"></i>

<h2>Pengajuan Berhasil</h2>

<p>

Nomor Tiket

</p>

<h4>

ULT-20260716-0001

</h4>

<span class="badge bg-primary">

Submitted

</span>

<br><br>

<a href="<?= base_url('dashboard') ?>" class="btn btn-danger">

Kembali ke Dashboard

</a>

</div>

</div>

</div>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>