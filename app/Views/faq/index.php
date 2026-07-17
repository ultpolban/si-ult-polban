<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Bantuan & FAQ</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="accordion" id="faq">

<div class="card">

<div class="card-header">

<button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#faq1">

Bagaimana cara mengajukan layanan?

</button>

</div>

<div id="faq1" class="collapse show">

<div class="card-body">

Pilih menu Ajukan Layanan, isi formulir, lalu upload dokumen yang diminta.

</div>

</div>

</div>

<div class="card">

<div class="card-header">

<button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#faq2">

Bagaimana melihat status pengajuan?

</button>

</div>

<div id="faq2" class="collapse">

<div class="card-body">

Masuk ke menu Tracking Tiket untuk melihat progres.

</div>

</div>

</div>

<div class="card">

<div class="card-header">

<button class="btn btn-link" data-bs-toggle="collapse" data-bs-target="#faq3">

Bagaimana jika pengajuan ditolak?

</button>

</div>

<div id="faq3" class="collapse">

<div class="card-body">

Silakan lakukan revisi dokumen sesuai catatan petugas lalu kirim kembali.

</div>

</div>

</div>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>