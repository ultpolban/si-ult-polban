<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar') ?>

<div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<h1>Pusat Bantuan</h1>
</div>
</section>

<section class="content">

<div class="container-fluid">

<div class="card">

<div class="card-header bg-danger text-white">

FAQ

</div>

<div class="card-body">

<div class="accordion" id="faq">

<div class="accordion-item">

<h2 class="accordion-header">

<button class="accordion-button"
data-bs-toggle="collapse"
data-bs-target="#q1">

Bagaimana cara mengajukan layanan?

</button>

</h2>

<div id="q1" class="accordion-collapse collapse show">

<div class="accordion-body">

Masuk ke menu Ajukan Layanan,
lengkapi formulir,
upload dokumen,
kemudian klik Kirim.

</div>

</div>

</div>

<div class="accordion-item">

<h2 class="accordion-header">

<button class="accordion-button collapsed"
data-bs-toggle="collapse"
data-bs-target="#q2">

Bagaimana melihat status pengajuan?

</button>

</h2>

<div id="q2" class="accordion-collapse collapse">

<div class="accordion-body">

Masuk ke menu Tracking Tiket.

</div>

</div>

</div>

<div class="accordion-item">

<h2 class="accordion-header">

<button class="accordion-button collapsed"
data-bs-toggle="collapse"
data-bs-target="#q3">

Apa yang harus dilakukan jika pengajuan direvisi?

</button>

</h2>

<div id="q3" class="accordion-collapse collapse">

<div class="accordion-body">

Perbaiki dokumen kemudian upload kembali sesuai instruksi petugas.

</div>

</div>

</div>

</div>

</div>

</div>

<br>

<div class="card">

<div class="card-header bg-primary text-white">

Kontak ULT POLBAN

</div>

<div class="card-body">

<p>

<i class="fas fa-map-marker-alt text-danger"></i>

Jl. Gegerkalong Hilir, Bandung

</p>

<p>

<i class="fas fa-phone text-success"></i>

(022) 2013789

</p>

<p>

<i class="fas fa-envelope text-primary"></i>

ult@polban.ac.id

</p>

<p>

<i class="fas fa-clock text-warning"></i>

Senin - Jumat
08.00 - 16.00 WIB

</p>

</div>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>