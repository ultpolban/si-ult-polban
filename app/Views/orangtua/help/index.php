<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_orangtua') ?>

<div class="content-wrapper">

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1
                    style="
                        font-weight:700;
                        color:#0b3d91;
                    ">

                    <i class="fas fa-life-ring mr-2"></i>

                    Pusat Bantuan

                </h1>

            </div>

            <div class="col-sm-6">

                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item">

                        <a href="<?= base_url('dashboard-orangtua') ?>">

                            Dashboard

                        </a>

                    </li>

                    <li class="breadcrumb-item active">

                        Pusat Bantuan

                    </li>

                </ol>

            </div>

        </div>

    </div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row">

<div class="col-lg-12">

<div
class="card shadow-sm"
style="
border-radius:18px;
overflow:hidden;
">

<div
class="card-body"
style="
background:linear-gradient(135deg,#0b3d91,#1f5fbf);
color:white;
padding:45px;
">

<div class="row align-items-center">

<div class="col-md-8">

<h2
style="
font-weight:700;
">

Selamat Datang di Pusat Bantuan SI-ULT POLBAN

</h2>

<p
class="mt-3 mb-0"
style="
font-size:17px;
line-height:30px;
opacity:.95;
">

Temukan jawaban atas pertanyaan yang
sering diajukan mengenai pengajuan layanan,
tracking tiket, hingga informasi kontak
Unit Layanan Terpadu (ULT) Politeknik Negeri Bandung.

</p>

</div>

<div class="col-md-4 text-center">

<i
class="fas fa-headset"
style="
font-size:120px;
opacity:.15;
"></i>

</div>

</div>

</div>

</div>

</div>

</div>

<!-- ============================================
     FAQ
============================================ -->

<div class="row mt-4">

<div class="col-lg-8">

<div
class="card shadow-sm"
style="
border-radius:15px;
">

<div
class="card-header"
style="
background:#0b3d91;
color:white;
border-bottom:4px solid #f28c28;
">

<h4 class="mb-0">

<i class="fas fa-question-circle mr-2"></i>

Frequently Asked Questions (FAQ)

</h4>

</div>

<div class="card-body">
    <div id="accordion">

    <!-- FAQ 1 -->
    <div class="card mb-2">

        <div class="card-header">

            <h2 class="mb-0">

                <button
                    class="btn btn-link btn-block text-left font-weight-bold"
                    type="button"
                    data-toggle="collapse"
                    data-target="#faq1">

                    <i class="fas fa-plus-circle text-primary mr-2"></i>

                    Bagaimana cara mengajukan layanan?

                </button>

            </h2>

        </div>

        <div
            id="faq1"
            class="collapse show"
            data-parent="#accordion">

            <div class="card-body">

                Masuk ke menu
                <strong>Ajukan Layanan</strong>,
                pilih Unit Layanan,
                pilih Jenis Layanan,
                isi keterangan,
                unggah dokumen pendukung (jika ada),
                kemudian klik
                <strong>Kirim Pengajuan</strong>.

            </div>

        </div>

    </div>

    <!-- FAQ 2 -->
    <div class="card mb-2">

        <div class="card-header">

            <h2 class="mb-0">

                <button
                    class="btn btn-link btn-block text-left font-weight-bold collapsed"
                    type="button"
                    data-toggle="collapse"
                    data-target="#faq2">

                    <i class="fas fa-plus-circle text-success mr-2"></i>

                    Bagaimana melihat status pengajuan?

                </button>

            </h2>

        </div>

        <div
            id="faq2"
            class="collapse"
            data-parent="#accordion">

            <div class="card-body">

                Buka menu
                <strong>Tracking Tiket</strong>.
                Semua tiket beserta statusnya akan muncul
                mulai dari
                Submitted,
                Diverifikasi,
                Diproses,
                hingga
                Selesai.

            </div>

        </div>

    </div>

    <!-- FAQ 3 -->
    <div class="card mb-2">

        <div class="card-header">

            <h2 class="mb-0">

                <button
                    class="btn btn-link btn-block text-left font-weight-bold collapsed"
                    type="button"
                    data-toggle="collapse"
                    data-target="#faq3">

                    <i class="fas fa-plus-circle text-warning mr-2"></i>

                    Berapa lama proses layanan?

                </button>

            </h2>

        </div>

        <div
            id="faq3"
            class="collapse"
            data-parent="#accordion">

            <div class="card-body">

                Lama proses bergantung pada
                jenis layanan yang diajukan.
                Status terbaru dapat dipantau
                melalui menu
                <strong>Tracking Tiket</strong>.

            </div>

        </div>

    </div>

    <!-- FAQ 4 -->

    <div class="card mb-2">

        <div class="card-header">

            <h2 class="mb-0">

                <button
                    class="btn btn-link btn-block text-left font-weight-bold collapsed"
                    type="button"
                    data-toggle="collapse"
                    data-target="#faq4">

                    <i class="fas fa-plus-circle text-danger mr-2"></i>

                    Bagaimana jika pengajuan ditolak?

                </button>

            </h2>

        </div>

        <div
            id="faq4"
            class="collapse"
            data-parent="#accordion">

            <div class="card-body">

                Silakan membaca
                catatan petugas pada halaman
                Detail Tiket,
                kemudian lakukan perbaikan
                sesuai arahan dan ajukan kembali
                apabila diperlukan.

            </div>

        </div>

    </div>

    <!-- FAQ 5 -->

    <div class="card">

        <div class="card-header">

            <h2 class="mb-0">

                <button
                    class="btn btn-link btn-block text-left font-weight-bold collapsed"
                    type="button"
                    data-toggle="collapse"
                    data-target="#faq5">

                    <i class="fas fa-plus-circle text-info mr-2"></i>

                    Siapa yang dapat saya hubungi jika mengalami kendala?

                </button>

            </h2>

        </div>

        <div
            id="faq5"
            class="collapse"
            data-parent="#accordion">

            <div class="card-body">

                Anda dapat menghubungi
                Unit Layanan Terpadu (ULT)
                melalui informasi kontak
                yang tersedia di halaman ini.

            </div>

        </div>

    </div>

</div>

</div>

</div>

</div>
<!-- ============================================
     KONTAK ULT
============================================ -->

<div class="col-lg-4">

    <div
        class="card shadow-sm mb-4"
        style="
            border-radius:15px;
        ">

        <div
            class="card-header"
            style="
                background:#0b3d91;
                color:white;
                border-bottom:4px solid #f28c28;
            ">

            <h4 class="mb-0">

                <i class="fas fa-headset mr-2"></i>

                Hubungi ULT

            </h4>

        </div>

        <div class="card-body">

            <!-- TELEPON -->

            <div class="mb-4">

                <h5
                    style="
                        color:#0b3d91;
                        font-weight:700;
                    ">

                    <i class="fas fa-phone-alt mr-2"></i>

                    Telepon

                </h5>

                <p class="mb-0 text-muted">

                    (022) 2013789

                </p>

            </div>

            <!-- EMAIL -->

            <div class="mb-4">

                <h5
                    style="
                        color:#0b3d91;
                        font-weight:700;
                    ">

                    <i class="fas fa-envelope mr-2"></i>

                    Email

                </h5>

                <p class="mb-0 text-muted">

                    ult@polban.ac.id

                </p>

            </div>

            <!-- WHATSAPP -->

            <div class="mb-4">

                <h5
                    style="
                        color:#0b3d91;
                        font-weight:700;
                    ">

                    <i class="fab fa-whatsapp mr-2"></i>

                    WhatsApp

                </h5>

                <p class="mb-0 text-muted">

                    +62 812-3456-7890

                </p>

            </div>

            <!-- ALAMAT -->

            <div class="mb-4">

                <h5
                    style="
                        color:#0b3d91;
                        font-weight:700;
                    ">

                    <i class="fas fa-map-marker-alt mr-2"></i>

                    Alamat

                </h5>

                <p class="mb-0 text-muted">

                    Politeknik Negeri Bandung<br>

                    Jl. Gegerkalong Hilir,
                    Ciwaruga,
                    Bandung Barat.

                </p>

            </div>

            <!-- JAM OPERASIONAL -->

            <div class="mb-4">

                <h5
                    style="
                        color:#0b3d91;
                        font-weight:700;
                    ">

                    <i class="fas fa-clock mr-2"></i>

                    Jam Operasional

                </h5>

                <table class="table table-sm">

                    <tr>

                        <td>Senin - Kamis</td>

                        <td>08.00 - 16.00</td>

                    </tr>

                    <tr>

                        <td>Jumat</td>

                        <td>08.00 - 16.30</td>

                    </tr>

                    <tr>

                        <td>Sabtu - Minggu</td>

                        <td class="text-danger">

                            Tutup

                        </td>

                    </tr>

                </table>

            </div>

            <a
                href="#"
                class="btn btn-block"
                style="
                    background:#0b3d91;
                    color:white;
                    font-weight:600;
                    border-radius:10px;
                ">

                <i class="fas fa-paper-plane mr-2"></i>

                Hubungi ULT

            </a>

        </div>

    </div>

</div>

</div>
<!-- ============================================
     TIPS PENGGUNAAN
============================================ -->

<div class="row mt-4">

    <div class="col-lg-12">

        <div
            class="card shadow-sm"
            style="
                border-left:5px solid #f28c28;
                border-radius:15px;
            ">

            <div class="card-body">

                <h4
                    style="
                        color:#0b3d91;
                        font-weight:700;
                    ">

                    <i class="fas fa-lightbulb mr-2"></i>

                    Tips Penggunaan SI-ULT

                </h4>

                <ul class="mb-0 text-muted" style="line-height:32px;">

                    <li>
                        Pastikan data mahasiswa yang digunakan sudah benar.
                    </li>

                    <li>
                        Pilih Unit Layanan sesuai kebutuhan agar pengajuan tidak salah tujuan.
                    </li>

                    <li>
                        Lengkapi dokumen pendukung apabila diperlukan.
                    </li>

                    <li>
                        Pantau perkembangan pengajuan melalui menu
                        <strong>Tracking Tiket</strong>.
                    </li>

                    <li>
                        Gunakan menu
                        <strong>Notifikasi</strong>
                        untuk melihat informasi terbaru mengenai pengajuan.
                    </li>

                </ul>

            </div>

        </div>

    </div>

</div>

<!-- ============================================
     INFORMASI
============================================ -->

<div class="row mt-4">

    <div class="col-lg-12">

        <div
            class="alert alert-primary"
            style="
                border-left:5px solid #0b3d91;
                border-radius:12px;
            ">

            <h5>

                <i class="fas fa-info-circle mr-2"></i>

                Informasi

            </h5>

            <p class="mb-0">

                Apabila mengalami kendala teknis pada sistem,
                silakan menghubungi Unit Layanan Terpadu (ULT)
                melalui kontak yang tersedia di atas.

            </p>

        </div>

    </div>

</div>

</div>

</section>

</div>

<?= $this->include('layouts/footer') ?>