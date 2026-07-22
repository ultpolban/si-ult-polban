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
<section id="tentang" class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold text-primary">Tentang Politeknik Negeri Bandung</h2>
            <p class="text-muted">
                Kenali sejarah, visi, dan misi Politeknik Negeri Bandung sebagai institusi pendidikan vokasi unggulan.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-4">
                <div class="card about-card h-100 text-center">

                    <div class="card-body">

                        <i class="bi bi-building fs-1 text-primary"></i>

                        <h4 class="mt-3">
                            Sejarah
                        </h4>

                        <p class="text-muted">
                            Mengenal perjalanan berdirinya
                            Politeknik Negeri Bandung.
                        </p>

                        <button class="btn btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#sejarahModal">

                            Baca Selengkapnya

                        </button>

                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card about-card h-100 text-center">

                    <div class="card-body">

                        <i class="bi bi-bullseye fs-1 text-success"></i>

                        <h4 class="mt-3">
                            Visi
                        </h4>

                        <p class="text-muted">
                            Visi Politeknik Negeri Bandung.
                        </p>

                        <button class="btn btn-outline-success"
                            data-bs-toggle="modal"
                            data-bs-target="#visiModal">

                            Lihat Visi

                        </button>

                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="card about-card h-100 text-center">

                    <div class="card-body">

                        <i class="bi bi-flag fs-1 text-warning"></i>

                        <h4 class="mt-3">
                            Misi
                        </h4>

                        <p class="text-muted">
                            Misi Politeknik Negeri Bandung.
                        </p>

                        <button class="btn btn-outline-warning"
                            data-bs-toggle="modal"
                            data-bs-target="#misiModal">

                            Lihat Misi

                        </button>

                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

<!-- ============================= -->
<!-- SECTION JURUSAN -->
<!-- ============================= -->

<section id="jurusan" class="py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">Jurusan POLBAN</h2>

            <p class="text-muted">
                Klik salah satu jurusan untuk melihat Program Studi
            </p>

        </div>

        <div class="row g-4">

            <!-- ==================== -->
            <!-- Teknik Sipil -->
            <!-- ==================== -->

            <div class="col-lg-3 col-md-6">

                <div class="card jurusan-card h-100 text-center p-4"
                     data-bs-toggle="modal"
                     data-bs-target="#modalSipil">

                    <i class="bi bi-building display-4 text-primary"></i>

                    <h5 class="mt-3">
                        Teknik Sipil
                    </h5>

                    <small class="text-muted">
                        Klik untuk melihat Program Studi
                    </small>

                </div>

            </div>

            <!-- ==================== -->
            <!-- Teknik Mesin -->
            <!-- ==================== -->

            <div class="col-lg-3 col-md-6">

                <div class="card jurusan-card h-100 text-center p-4"
                     data-bs-toggle="modal"
                     data-bs-target="#modalMesin">

                    <i class="bi bi-gear-wide-connected display-4 text-primary"></i>

                    <h5 class="mt-3">
                        Teknik Mesin
                    </h5>

                    <small class="text-muted">
                        Klik untuk melihat Program Studi
                    </small>

                </div>

            </div>

            <!-- ==================== -->
            <!-- Teknik Refrigerasi -->
            <!-- ==================== -->

            <div class="col-lg-3 col-md-6">

                <div class="card jurusan-card h-100 text-center p-4"
                     data-bs-toggle="modal"
                     data-bs-target="#modalRefrigerasi">

                    <i class="bi bi-snow display-4 text-primary"></i>

                    <h5 class="mt-3">
                        Teknik Refrigerasi
                    </h5>

                    <small class="text-muted">
                        Klik untuk melihat Program Studi
                    </small>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="card jurusan-card h-100 text-center p-4"
                     data-bs-toggle="modal"
                     data-bs-target="#modalKonversi">

                    <i class="bi bi-sun-fill display-4 text-primary"></i>

                    <h5 class="mt-3">
                        Teknik Konversi Energi
                    </h5>

                    <small class="text-muted">
                        Klik untuk melihat Program Studi
                    </small>

                </div>

            </div>

             <div class="col-lg-3 col-md-6">

                <div class="card jurusan-card h-100 text-center p-4"
                     data-bs-toggle="modal"
                     data-bs-target="#modalElektro">

                    <i class="bi bi-lightning-fill display-4 text-primary"></i>

                    <h5 class="mt-3">
                        Teknik Elektro
                    </h5>

                    <small class="text-muted">
                        Klik untuk melihat Program Studi
                    </small>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="card jurusan-card h-100 text-center p-4"
                     data-bs-toggle="modal"
                     data-bs-target="#modalKimia">
                 <i class="bi bi-droplet-fill display-4 text-primary"></i>

           
                    <h5 class="mt-3">
                        Teknik Kimia
                    </h5>

                    <small class="text-muted">
                        Klik untuk melihat Program Studi
                    </small>

                </div>

            </div>

            <div class="col-lg-3 col-md-6">

                <div class="card jurusan-card h-100 text-center p-4"
                     data-bs-toggle="modal"
                     data-bs-target="#modalKomputer">
                 <i class="bi bi-pc-display-horizontal display-4 text-primary"></i>

           
                    <h5 class="mt-3">
                        Teknik Komputer dan Informatika
                    </h5>

                    <small class="text-muted">
                        Klik untuk melihat Program Studi
                    </small>

                </div>

            </div>

                <div class="col-lg-3 col-md-6">

                <div class="card jurusan-card h-100 text-center p-4"
                     data-bs-toggle="modal"
                     data-bs-target="#modalAkuntansi">
                 <i class="bi bi-receipt-cutoff display-4 text-primary"></i>

           
                    <h5 class="mt-3">
                        Akuntansi
                    </h5>

                    <small class="text-muted">
                        Klik untuk melihat Program Studi
                    </small>

                </div>

            </div>

               <div class="col-lg-3 col-md-6">

                <div class="card jurusan-card h-100 text-center p-4"
                     data-bs-toggle="modal"
                     data-bs-target="#modalAdministrasi">
                 <i class="bi bi-person-workspace display-4 text-primary"></i>

           
                    <h5 class="mt-3">
                        Administrasi Niaga
                    </h5>

                    <small class="text-muted">
                        Klik untuk melihat Program Studi
                    </small>

                </div>

            </div>

              <div class="col-lg-3 col-md-6">

                <div class="card jurusan-card h-100 text-center p-4"
                     data-bs-toggle="modal"
                     data-bs-target="#modalInggris">
                 <i class="bi bi-translate display-4 text-primary"></i>

           
                    <h5 class="mt-3">
                        Bahasa Inggris
                    </h5>

                    <small class="text-muted">
                        Klik untuk melihat Program Studi
                    </small>

                </div>

            </div>

        </div>

    </div>

</section>

    <div class="modal fade" id="modalSipil" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h4> Teknik Sipil</h4>

                <button class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="list-group">

                    <div class="list-group-item">
                        🎓 D3 Teknik Konstruksi Sipil
                    </div>

                    <div class="list-group-item">
                        🎓 D3 Teknik Konstruksi Gedung
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Teknik Perancangan Jalan dan Jembatan
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Teknik Perawatan dan Perbaikan Gedung
                    </div>

                    <div class="list-group-item">
                        🎓 S2 Rekayasa Infrastruktur
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
    <div class="modal fade" id="modalMesin" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h4> Teknik Mesin</h4>

                <button class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="list-group">

                    <div class="list-group-item">
                        🎓 D3 Teknik Mesin
                    </div>

                    <div class="list-group-item">
                        🎓 D3 Teknik Aeronautika
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Teknik Perancangan dan Konstruksi Mesin
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Proses Manufaktur
</div>
                </div>

            </div>

        </div>

    </div>

</div>
     <div class="modal fade" id="modalRefrigerasi" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h4> Teknik Refrigerasi dan Tata Udara</h4>

                <button class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="list-group">

                    <div class="list-group-item">
                        🎓 D3 Teknik Pendingin dan Tata Udara
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Teknik Pendingin dan Tata Udara
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
     <div class="modal fade" id="modalKonversi" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h4> Teknik Konversi Energi</h4>

                <button class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="list-group">

                    <div class="list-group-item">
                        🎓 D3 Teknik Konversi Energi
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Teknologi Pembangkit Tenaga Listrik
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Teknik Konversi Energi
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

     <div class="modal fade" id="modalElektro" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h4> Teknik Elektro</h4>

                <button class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="list-group">

                    <div class="list-group-item">
                        🎓 D3 Teknik Elektronika
                    </div>

                    <div class="list-group-item">
                        🎓 D3 Teknik Listrik
                    </div>

                    <div class="list-group-item">
                        🎓 D3 Teknik Telekomunikasi
                    </div>

                     <div class="list-group-item">
                        🎓 D4 Teknik Elektronika
                    </div>

                     <div class="list-group-item">
                        🎓 D4 Teknik Telekomunikasi
                    </div>

                     <div class="list-group-item">
                        🎓 D4 Teknik Otomasi Industri
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
     <div class="modal fade" id="modalKimia" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h4> Teknik Kimia</h4>

                <button class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="list-group">

                    <div class="list-group-item">
                        🎓 D3 Teknik Kimia
                    </div>

                    <div class="list-group-item">
                        🎓 D3 Analis Kimia
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Teknik Kimis Produksi Bersih
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
    </div>
     <div class="modal fade" id="modalKomputer" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h4> Teknik Komputer dan Informatika</h4>

                <button class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="list-group">

                    <div class="list-group-item">
                        🎓 D3 Teknik Informatika
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Teknik Informatika
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
     <div class="modal fade" id="modalAkuntansi" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h4>Akuntansi </h4>

                <button class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="list-group">

                    <div class="list-group-item">
                        🎓 D3 Akuntansi
                    </div>
                    <div class="list-group-item">
                        🎓 D3 Keuangan dan Perbankan
                    </div>
                    <div class="list-group-item">
                        🎓 D4 Akuntansi Manajemen Pemerintahan
                    </div>
                    <div class="list-group-item">
                        🎓 D4 Akuntansi
                    </div>
                    <div class="list-group-item">
                        🎓 D4 Keuangan Syariah
                    </div>
                    <div class="list-group-item">
                        🎓 S2 Keuangan & Perbankan Syariah
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="modalKomputer" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h4> Teknik Komputer dan Informatika</h4>

                <button class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="list-group">

                    <div class="list-group-item">
                        🎓 D3 Teknik Informatika
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Teknik Informatika
                    </div>
                </div>

</div>
        </div>

    </div>
</div>

<div class="modal fade" id="modalAdministrasi" 
tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">

                <h4 class="modal-title">Administrasi Niaga</h4>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <!-- Body -->
            <div class="modal-body">

                <div class="list-group">

                    <div class="list-group-item">
                        🎓 D3 Administrasi Bisnis
                    </div>

                    <div class="list-group-item">
                        🎓 D3 Manajemen Perusahaan
                    </div>

                    <div class="list-group-item">
                        🎓 D3 Usaha Perjalanan Wisata
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Manajemen Aset
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Administrasi Bisnis
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Manajemen Pemasaran
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Destinasi Pariwisata
                    </div>

                    <div class="list-group-item">
                        🎓 S2 Pemasaran, Inovasi, dan Teknologi
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="modal fade" id="modalInggris" tabindex="-1">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h4>Bahasa Inggris</h4>

                <button class="btn-close"
                        data-bs-dismiss="modal"></button>

            </div>

            <div class="modal-body">

                <div class="list-group">

                    <div class="list-group-item">
                        🎓 D3 Bahasa Inggris
                    </div>

                    <div class="list-group-item">
                        🎓 D4 Bahasa Inggris untuk Komunikasi Bisnis dan Profesional
                    </div>
                </div>

</div>
        </div>

    </div>
</div>
    
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

            <div class="card shadow-sm border-0 h-100 alur-card">

                    <div class="card-body">

                       <div class="display-5 alur-icon">🔐</div>

                        <h5 class="mt-3">1. Login</h5>

                        <p class="text-muted small">
                            Masuk menggunakan akun yang telah terdaftar.
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-2 mb-4">

                <div class="card shadow-sm border-0 h-100 alur-card">

                    <div class="card-body">

                        <div class="display-5 alur-icon">📂</div>

                        <h5 class="mt-3">2. Pilih Layanan</h5>

                        <p class="text-muted small">
                            Pilih kategori Akademik atau Keuangan.
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-3 mb-4">

                <div class="card shadow-sm border-0 h-100 alur-card">

                    <div class="card-body">

                        <div class="display-5 alur-icon">📝</div>

                        <h5 class="mt-3">3. Isi Formulir</h5>

                        <p class="text-muted small">
                            Lengkapi data dan unggah dokumen yang dibutuhkan.
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-2 mb-4">

                <div class="card shadow-sm border-0 h-100 alur-card">

                    <div class="card-body">

                        <div class="display-5 alur-icon">⏳</div>

                        <h5 class="mt-3">4. Verifikasi</h5>

                        <p class="text-muted small">
                            Pengajuan akan diperiksa oleh petugas ULT.
                        </p>

                    </div>

                </div>

            </div>

            <div class="col-md-3 mb-4">

               <div class="card shadow-sm border-0 h-100 alur-card">

                    <div class="card-body">

                        <div class="display-5 alur-icon">✅</div>

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

<a href="<?= base_url('keuangan') ?>" class="btn btn-primary w-100">
    Lihat Layanan
</a>

</button>

</div>

</div>

</div>

</div>

</section>

<section id="kontak" class="py-5">

    <div class="container">

        <div class="text-center mb-5">

            <h2 class="fw-bold">
                Kontak Kami
            </h2>

            <p class="text-muted">
                Jika memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi Unit Layanan Terpadu POLBAN melalui informasi berikut.
            </p>

        </div>

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card shadow-sm border-0">

                    <div class="card-body p-4">

                        <table class="table table-borderless mb-0">

                            <tr>
                                <td width="180"><strong>Alamat</strong></td>
                                <td>Jl. Gegerkalong Hilir, Ciwaruga, Kabupaten Bandung Barat, Jawa Barat</td>
                            </tr>

                            <tr>
                                <td><strong>Email</strong></td>
                                <td>ult@polban.ac.id</td>
                            </tr>

                            <tr>
                                <td><strong>Telepon</strong></td>
                                <td>(022) 2013789</td>
                            </tr>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- Modal Sejarah -->
<div class="modal fade" id="sejarahModal" tabindex="-1" aria-labelledby="sejarahModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title fw-bold" id="sejarahModalLabel">
                    Sejarah Politeknik Negeri Bandung
                </h4>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <p>
    Politeknik Negeri Bandung (POLBAN) merupakan perguruan tinggi vokasi yang
    berawal dari Politeknik Institut Teknologi Bandung (ITB). Pendidikan
    politeknik di Indonesia berkembang untuk memenuhi kebutuhan tenaga ahli
    terampil yang siap bekerja di dunia industri dengan waktu pendidikan yang
    lebih singkat dibandingkan pendidikan insinyur.
</p>

<p>
    Politeknik ITB mulai menyelenggarakan pendidikan pada tahun akademik
    1982/1983 dengan beberapa program studi di bidang teknik. Seiring
    perkembangannya, POLBAN terus membuka jurusan dan program studi baru sesuai
    kebutuhan dunia industri serta perkembangan ilmu pengetahuan dan teknologi.
</p>

<p>
    Pada tahun 1997, berdasarkan Keputusan Menteri Pendidikan dan Kebudayaan,
    Politeknik ITB resmi menjadi institusi mandiri dengan nama
    <strong>Politeknik Negeri Bandung (POLBAN)</strong>. Hingga saat ini,
    POLBAN terus berkembang sebagai salah satu perguruan tinggi vokasi unggulan
    di Indonesia dengan berbagai program Diploma Tiga (D3), Sarjana Terapan
    (D4), dan Magister Terapan yang berorientasi pada pendidikan terapan dan
    kebutuhan industri.
</p>
            </div>

        </div>
    </div>
</div>

<!-- Modal Visi -->
<div class="modal fade" id="visiModal" tabindex="-1" aria-labelledby="visiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title fw-bold" id="visiModalLabel">
                    Visi POLBAN
                </h4>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="modal-body">



    <p>
        Menjadi institusi yang unggul dan terdepan dalam pendidikan vokasi yang
        inovatif dan adaptif terhadap perkembangan ilmu pengetahuan dan teknologi
        terapan.
    </p>

    <hr>

    <p class="text-muted">
        Visi ini menjadi landasan bagi POLBAN dalam menyelenggarakan pendidikan
        vokasi yang berorientasi pada pengembangan kompetensi, inovasi, serta
        kesiapan lulusan untuk menghadapi kebutuhan dunia usaha, dunia industri,
        dan perkembangan teknologi yang terus berubah.
    </p>

</div>

            </div>

        </div>
    </div>
</div>

<!-- Modal Misi -->
<div class="modal fade" id="misiModal" tabindex="-1" aria-labelledby="misiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title fw-bold" id="misiModalLabel">
                    Misi POLBAN
                </h4>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <ul>
                    <li>Menyelenggarakan pendidikan untuk menghasilkan lulusan yang kompeten, memiliki semangat terus berkembang, bermoral, berjiwa kewirausahaan dan berwawasan lingkungan;</li>
                    <li>Melaksanakan penelitian dan menyebarluaskan hasil-hasilnya untuk mengembangkan ilmu pengetahuan dan teknologi.</li>
                    <li>Melaksanakan kegiatan pengabdian kepada masyarakat melalui pemanfaatan ilmu pengetahuan dan teknologi untuk mendukung peningkatan mutu kehidupan; dan.</li>
                    <li>Menyelenggarakan dan mengembangkan tata kelola yang efisien, akuntabel, transparan, dan berkeadilan untuk mendukung tercapainya visi dan tujuan Polban.</li>
                </ul>

            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>