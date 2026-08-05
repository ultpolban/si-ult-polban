<?= $this->extend('layouts/template_public') ?>

<?= $this->section('content') ?>

<section id="beranda" class="hero">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<h1>

Unit Layanan Terpadu

</h1>

<p class="mt-4">
Unit Layanan Terpadu (ULT) Politeknik Negeri Bandung menghadirkan layanan yang terintegrasi guna memudahkan mahasiswa, dosen, tenaga kependidikan, alumni, mitra, dan masyarakat dalam mengakses berbagai kebutuhan layanan kampus.

</p>

<a href="#layanan"
class="btn-ajukan">

Ajukan Layanan

</a>

</div>

<div class="col-lg-6 text-center">

    <div class="hero-image">

        <img src="<?= base_url('img/landingpage.jpg') ?>"
             class="img-fluid hero-img"
             alt="POLBAN">

    </div>

</div>
</div>
</div>

</div>

</div>

</section>
<section id="tentang" class="py-5">
    <div class="container">

        <div class="text-center mb-5">
            <h2>Tentang Politeknik Negeri Bandung</h2>
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

<section class="py-5" id="statistik">
    <div class="container">

        <div class="text-center mb-5">
            <h2 >
               Layanan dengan Jumlah Pengajuan Terbanyak
            </h2>

            <p class="text-muted">
               Data berikut merupakan statistik jumlah pengajuan setiap layanan yang tersimpan di sistem.
            </p>
        </div>

      <div class="row g-4">

    <?php foreach($popular_services as $service): ?>

    <div class="col-lg-3 col-md-6">

        <div class="stat-card">

            <div class="stat-icon">
                <i class="bi bi-fire"></i>
            </div>

           <h3 class="counter">
    <?= $service['total_submission']; ?>
</h3>

<h5>
    <?= $service['service_name']; ?>
</h5>

<p>
    Jumlah Pengajuan Tahun <?= date('Y'); ?>
</p>

        </div>

    </div>

    <?php endforeach; ?>

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

<a href="<?= base_url('layanan/akademik') ?>" class="btn btn-ajukan w-100">
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

<a href="<?= base_url('layanan/keuangan') ?>" class="btn btn-ajukan w-100">
    Lihat Layanan
</a>

</button>



</div>

    </div>
    <!-- UPA -->
    <div class="col-lg-6 mb-4">

        <div class="card h-100 shadow-sm">

            <div class="card-body">

                <h2 class="mb-3">
                    🏢 <strong>UPA</strong>
                </h2>

                <p>
                    UPA Bahasa <br>
                    UPA TIK <br>
                    UPA Perpustakaan
                </p>

                <a href="<?= base_url('layanan/upa') ?>" class="btn btn-ajukan w-100">
                    Lihat Layanan
                </a>

            </div>

        </div>

    </div>

    <!-- Kemahasiswaan -->
    <div class="col-lg-6 mb-4">

        <div class="card h-100 shadow-sm">

            <div class="card-body">

                <h2 class="mb-3">
                    <i class="bi bi-mortarboard-fill"></i>
                    <strong>Kemahasiswaan</strong>
                </h2>

                <p>
                    Pengajuan Beasiswa <br>
                    Informasi Beasiswa <br>
                    Pengajuan Kegiatan Mahasiswa
                </p>

                <a href="<?= base_url('layanan/kemahasiswaan') ?>" class="btn btn-ajukan w-100">
                    Lihat Layanan
                </a>

            </div>

        </div>

    </div>

</div>



</section>

<!-- Jam Operasional -->
<section id="jam-operasional" class="py-5 bg-light">

    <div class="container">

        <div class="text-center">

            <i class="bi bi-clock-history display-4 text-primary"></i>

            <h2 class="mt-3 mb-3">
                Jam Operasional
            </h2>

            <p class="fs-5 mb-2">
                <strong>Senin - Jumat</strong>
            </p>

            <p class="text-muted">
                08.00 - 16.00 WIB
            </p>

            <span class="badge bg-danger px-3 py-2">
                Sabtu, Minggu & Hari Libur Nasional Tutup
            </span>

        </div>

    </div>

</section>

<section class="faq-section py-5">
    <div class="container">

        <div class="text-center mb-5">
            <span class="faq-badge">
                <i class="bi bi-question-circle-fill"></i> FAQ
            </span>

            <h2 class="mt-3 fw-bold">Frequently Asked Questions</h2>

            <p class="text-muted">
                Temukan jawaban atas pertanyaan yang sering diajukan mengenai
                layanan Unit Layanan Terpadu (ULT) Politeknik Negeri Bandung.
            </p>
        </div>

        <div class="accordion shadow-sm" id="faqAccordion">

          <?php foreach($faqs as $faq): ?>

<div class="accordion-item">

    <h2 class="accordion-header">

        <button class="accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#faq<?= $faq['id']; ?>">

            <?= esc($faq['question']); ?>

        </button>

    </h2>

    <div id="faq<?= $faq['id']; ?>"
         class="accordion-collapse collapse"
         data-bs-parent="#faqAccordion">

        <div class="accordion-body">

            <?= esc($faq['answer']); ?>

        </div>

    </div>

</div>

<?php endforeach; ?>

        </div>

    </div>
</section>

<!-- Hubungi Kami -->
<section id="kontak" class="py-5 bg-light">
    <div class="container">

        <div class="text-center mb-5">
            <h2 class="fw-bold">Hubungi Kami</h2>
            <p class="text-muted">
                Jika memiliki pertanyaan atau membutuhkan bantuan, silakan hubungi kami melalui informasi berikut.
            </p>
        </div>

        <div class="row justify-content-center g-4">

            <!-- Alamat -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm contact-card">
                    <div class="card-body text-center">
                        <i class="bi bi-geo-alt-fill display-5 text-primary"></i>
                        <h5 class="mt-3">Alamat</h5>
                      <a href="https://maps.google.com/?q=Politeknik+Negeri+Bandung"
   target="_blank"
   class="text-decoration-none text-dark">

    <i class="bi bi-geo-alt-fill text-danger"></i>
    Jl. Gegerkalong Hilir, Ciwaruga, Kec. Parongpong,
    Kabupaten Bandung Barat, Jawa Barat 40559
    <p class="text-primary fw-semibold">
    Klik untuk melihat 
</p>
</a>
    
                    </div>
                </div>
            </div>

            <!-- Telepon -->
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm contact-card">
                    <div class="card-body text-center">
                        <i class="bi bi-telephone-fill display-5 text-success"></i>
                        <h5 class="mt-3">Telepon</h5>
                     <a href="tel:+62222013789" class="text-decoration-none text-dark">
    <i class="bi bi-telephone-fill text-success"></i>
    (022) 2013789
    <p class="text-primary fw-semibold">
    Klik untuk melihat 
</p>
</a>
                    
                    </div>
                </div>
            </div>

            <!-- Email -->
            <div class="col-md-3>
                <div class="card h-100 border-0 shadow-sm contact-card">
                    <div class="card-body text-center">
                        <i class="bi bi-envelope-fill display-5 text-danger"></i>
                        <h5 class="mt-3">Email</h5>
                       <a href="mailto:ult@polban.ac.id" class="text-decoration-none text-dark">
    <i class="bi bi-envelope-fill text-danger"></i>
    ult@polban.ac.id
    <p class="text-primary fw-semibold">
    Klik untuk melihat 
</p>
</a>
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

<!-- Scroll To Top -->
<button id="scrollTopBtn" title="Kembali ke Atas">
    <i class="bi bi-arrow-up"></i>
</button>

<?= $this->endSection() ?>