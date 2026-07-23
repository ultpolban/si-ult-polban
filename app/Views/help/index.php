<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- HEADER -->
    <section class="content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-sm-6">

                    <h1 class="dashboard-title">

                        <i class="fas fa-question-circle me-2"></i>

                        Pusat Bantuan

                    </h1>

                    <p class="text-muted mb-0">

                        Temukan informasi dan bantuan mengenai layanan SI-ULT POLBAN.

                    </p>

                </div>

                <div class="col-sm-6 text-sm-end mt-3 mt-sm-0">

                    <a
                        href="<?= base_url('dashboard-mahasiswa') ?>"
                        class="btn btn-outline-ult-blue"
                    >

                        <i class="fas fa-home me-1"></i>

                        Dashboard

                    </a>

                </div>

            </div>

        </div>

    </section>


    <!-- CONTENT -->
    <section class="content">

        <div class="container-fluid">

            <!-- BANNER BANTUAN -->
            <div class="help-banner">

                <div class="help-banner-icon">

                    <i class="fas fa-headset"></i>

                </div>

                <div class="help-banner-content">

                    <h3>
                        Ada yang bisa kami bantu?
                    </h3>

                    <p>
                        Silakan lihat pertanyaan yang sering ditanyakan
                        atau hubungi petugas ULT POLBAN jika membutuhkan bantuan.
                    </p>

                </div>

            </div>


            <div class="row">

                <!-- FAQ -->
                <div class="col-lg-8">

                    <div class="card dashboard-card shadow-sm">

                        <div class="card-header dashboard-card-header">

                            <h3 class="card-title">

                                <i class="fas fa-comments me-2"></i>

                                Pertanyaan yang Sering Ditanyakan

                            </h3>

                        </div>


                        <div class="card-body">

                            <!-- FAQ 1 -->
                            <div class="faq-item">

                                <button
                                    type="button"
                                    class="faq-question"
                                    onclick="toggleFaq(this)"
                                >

                                    <span>

                                        <i class="fas fa-question-circle"></i>

                                        Bagaimana cara mengajukan layanan?

                                    </span>

                                    <i class="fas fa-chevron-down faq-arrow"></i>

                                </button>


                                <div class="faq-answer">

                                    <p>

                                        Untuk mengajukan layanan, pilih menu
                                        <strong>Ajukan Layanan</strong> pada sidebar.
                                        Kemudian pilih jenis layanan, isi keterangan
                                        pengajuan, upload dokumen jika diperlukan,
                                        lalu klik tombol <strong>Kirim Pengajuan</strong>.

                                    </p>

                                </div>

                            </div>


                            <!-- FAQ 2 -->
                            <div class="faq-item">

                                <button
                                    type="button"
                                    class="faq-question"
                                    onclick="toggleFaq(this)"
                                >

                                    <span>

                                        <i class="fas fa-ticket-alt"></i>

                                        Bagaimana cara melihat status tiket?

                                    </span>

                                    <i class="fas fa-chevron-down faq-arrow"></i>

                                </button>


                                <div class="faq-answer">

                                    <p>

                                        Kamu dapat melihat status pengajuan melalui
                                        menu <strong>Tracking Tiket</strong>.
                                        Pilih tiket yang ingin dilihat untuk membuka
                                        detail pengajuan dan melihat status prosesnya.

                                    </p>

                                </div>

                            </div>


                            <!-- FAQ 3 -->
                            <div class="faq-item">

                                <button
                                    type="button"
                                    class="faq-question"
                                    onclick="toggleFaq(this)"
                                >

                                    <span>

                                        <i class="fas fa-clock"></i>

                                        Berapa lama proses pengajuan layanan?

                                    </span>

                                    <i class="fas fa-chevron-down faq-arrow"></i>

                                </button>


                                <div class="faq-answer">

                                    <p>

                                        Lama proses pengajuan dapat berbeda tergantung
                                        jenis layanan dan unit yang menangani.
                                        Kamu dapat memantau perkembangan pengajuan
                                        melalui menu <strong>Tracking Tiket</strong>.

                                    </p>

                                </div>

                            </div>


                            <!-- FAQ 4 -->
                            <div class="faq-item">

                                <button
                                    type="button"
                                    class="faq-question"
                                    onclick="toggleFaq(this)"
                                >

                                    <span>

                                        <i class="fas fa-file-upload"></i>

                                        Apa yang harus dilakukan jika dokumen kurang?

                                    </span>

                                    <i class="fas fa-chevron-down faq-arrow"></i>

                                </button>


                                <div class="faq-answer">

                                    <p>

                                        Jika dokumen yang diberikan belum lengkap,
                                        pengajuan dapat dikembalikan untuk diperbaiki.
                                        Silakan cek menu <strong>Notifikasi</strong>
                                        untuk melihat informasi terbaru mengenai
                                        pengajuan kamu.

                                    </p>

                                </div>

                            </div>


                            <!-- FAQ 5 -->
                            <div class="faq-item">

                                <button
                                    type="button"
                                    class="faq-question"
                                    onclick="toggleFaq(this)"
                                >

                                    <span>

                                        <i class="fas fa-bell"></i>

                                        Bagaimana mengetahui jika ada perubahan status tiket?

                                    </span>

                                    <i class="fas fa-chevron-down faq-arrow"></i>

                                </button>


                                <div class="faq-answer">

                                    <p>

                                        Setiap informasi terbaru mengenai pengajuan
                                        layanan dapat dilihat melalui menu
                                        <strong>Notifikasi</strong>.
                                        Pastikan untuk memeriksa notifikasi secara berkala.

                                    </p>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- KONTAK BANTUAN -->
                <div class="col-lg-4">

                    <div class="card help-contact-card shadow-sm">

                        <div class="card-body">

                            <div class="contact-icon">

                                <i class="fas fa-headset"></i>

                            </div>

                            <h4>
                                Butuh Bantuan Langsung?
                            </h4>

                            <p>

                                Jika pertanyaan kamu belum terjawab,
                                silakan hubungi petugas ULT POLBAN.

                            </p>


                            <div class="contact-item">

                                <i class="fas fa-envelope"></i>

                                <div>

                                    <small>Email</small>

                                    <strong>
                                        ult@polban.ac.id
                                    </strong>

                                </div>

                            </div>


                            <div class="contact-item">

                                <i class="fas fa-phone"></i>

                                <div>

                                    <small>Telepon</small>

                                    <strong>
                                        (022) 2013789
                                    </strong>

                                </div>

                            </div>


                            <div class="contact-item">

                                <i class="fas fa-map-marker-alt"></i>

                                <div>

                                    <small>Lokasi</small>

                                    <strong>
                                        Kampus POLBAN
                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- KEMBALI -->
                    <div class="card shadow-sm help-back-card">

                        <div class="card-body text-center">

                            <i class="fas fa-home"></i>

                            <h5>
                                Kembali ke Dashboard
                            </h5>

                            <p>
                                Kembali ke halaman utama Dashboard Mahasiswa.
                            </p>

                            <a
                                href="<?= base_url('dashboard-mahasiswa') ?>"
                                class="btn btn-ult-orange"
                            >

                                <i class="fas fa-arrow-left me-1"></i>

                                Kembali ke Dashboard

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


<script>

function toggleFaq(button) {

    const answer = button.nextElementSibling;

    const arrow = button.querySelector('.faq-arrow');

    const isOpen = answer.classList.contains('show');


    // Tutup semua FAQ lain
    document.querySelectorAll('.faq-answer').forEach(function(item) {

        item.classList.remove('show');

    });


    document.querySelectorAll('.faq-question').forEach(function(item) {

        item.classList.remove('active');

    });


    // Kalau sebelumnya belum terbuka, buka FAQ ini
    if (!isOpen) {

        answer.classList.add('show');

        button.classList.add('active');

    }

}

</script>


<?= $this->include('layouts/footer') ?>