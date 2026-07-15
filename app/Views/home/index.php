<?= $this->extend('layouts/template_public') ?>

<?= $this->section('content') ?>

<section id="beranda" class="hero">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<h1>

Unit Layanan Terpadu

</h1>

<h3>

Politeknik Negeri Bandung

</h3>

<p class="mt-4">

Layanan Akademik dan Keuangan
secara cepat, mudah, transparan,
dan terintegrasi.

</p>

<a href="#layanan"
class="btn btn-warning btn-lg">

Ajukan Layanan

</a>

</div>

<div class="col-lg-6 text-center">

<img
src="img/landingpage.jpg"
class="img-fluid rounded">

</div>

</div>

</div>

</section>

<section id="alur" class="py-5 bg-light">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                Alur Pengajuan Layanan
            </h2>

            <p class="text-muted">
                Ikuti langkah-langkah berikut untuk mengajukan layanan di SI ULT POLBAN.
            </p>

        </div>

        <div class="row text-center">

            <div class="col-md-2 mb-4">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">

                        <div class="display-5">🔐</div>

                        <h5 class="mt-3">1. Login</h5>

                        <p class="text-muted small">
                            Masuk menggunakan akun yang telah terdaftar.
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-2 mb-4">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">

                        <div class="display-5">📂</div>

                        <h5 class="mt-3">2. Pilih Layanan</h5>

                        <p class="text-muted small">
                            Pilih kategori Akademik atau Keuangan.
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-3 mb-4">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">

                        <div class="display-5">📝</div>

                        <h5 class="mt-3">3. Isi Formulir</h5>

                        <p class="text-muted small">
                            Lengkapi data dan unggah dokumen yang dibutuhkan.
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-2 mb-4">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">

                        <div class="display-5">⏳</div>

                        <h5 class="mt-3">4. Verifikasi</h5>

                        <p class="text-muted small">
                            Pengajuan akan diperiksa oleh petugas ULT.
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-3 mb-4">

                <div class="card shadow-sm border-0 h-100">

                    <div class="card-body">

                        <div class="display-5">✅</div>

                        <h5 class="mt-3">5. Selesai</h5>

                        <p class="text-muted small">
                            Pantau status pengajuan hingga layanan selesai diproses.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- Kategori -->

<section id="layanan" class="pb-5">

<div class="container">

<h2 class="section-title text-center mb-5">

Kategori Layanan

</h2>

<div class="row">

<div class="col-md-6">

<div class="card card-service p-4">

<h3>

📚 Akademik

</h3>

<p>

Surat Aktif Kuliah<br>

Legalisir Ijazah<br>

Cuti Akademik

</p>

<a href="<?= base_url('akademik') ?>" class="btn btn-primary w-100">
    Lihat Layanan
</a>


</button>

</div>

</div>

<div class="col-md-6">

<div class="card card-service p-4">

<h3>

💰 Keuangan

</h3>

<p>

Pembayaran UKT<br>

Cicilan UKT<br>

Refund

</p>

<a href="<?= base_url('akademik') ?>" class="btn btn-primary w-100">
    Lihat Layanan
</a>

</button>

</div>

</div>

</div>

</div>

</section>

<?= $this->endSection() ?>