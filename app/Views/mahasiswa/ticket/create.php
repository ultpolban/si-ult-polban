<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<style>
    /* =========================================
       HALAMAN AJUKAN LAYANAN
       ========================================= */

    .pengajuan-page {
        background-color: #f4f7fb;
        min-height: calc(100vh - 57px);
        padding-bottom: 40px;
    }

    /* Judul halaman */
    .pengajuan-page .page-title {
        color: #0b3d91;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .pengajuan-page .page-subtitle {
        color: #6b7c93;
        font-size: 16px;
        margin-bottom: 0;
    }

    /* Card utama */
    .pengajuan-page .main-card,
    .pengajuan-page .info-card,
    .pengajuan-page .warning-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    /* Header card */
    .pengajuan-page .main-card .card-header {
        background: #0b3d91;
        color: white;
        padding: 18px 24px;
        border: none;
    }

    .pengajuan-page .main-card .card-header h3 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
    }

    /* Card body */
    .pengajuan-page .main-card .card-body {
        padding: 30px;
        background: #ffffff;
    }

    /* Judul section */
    .pengajuan-page .section-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #0b3d91;
        font-size: 21px;
        font-weight: 700;
        padding-bottom: 10px;
        margin-bottom: 25px;
        border-bottom: 2px solid #f28c28;
    }

    .pengajuan-page .section-title i {
        color: #f28c28;
    }

    /* Label */
    .pengajuan-page label {
        color: #17365d;
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 9px;
    }

    /* Input dan select */
    .pengajuan-page .form-control,
    .pengajuan-page .form-select {
        min-height: 50px;
        padding: 11px 15px;
        border: 1px solid #cbd5e1;
        border-radius: 9px;
        color: #17365d;
        font-size: 16px;
        background-color: #fff;
    }

    /* Textarea */
    .pengajuan-page textarea.form-control {
        min-height: 140px;
        resize: vertical;
        line-height: 1.6;
    }

    /* Input readonly */
    .pengajuan-page .readonly-input {
        background-color: #eef3f8;
        color: #526b84;
        font-weight: 500;
    }

    /* Focus */
    .pengajuan-page .form-control:focus,
    .pengajuan-page .form-select:focus {
        border-color: #0b3d91;
        box-shadow: 0 0 0 0.2rem rgba(11, 61, 145, 0.12);
    }

    /* Bantuan */
    .pengajuan-page .form-text {
        color: #718096;
        font-size: 14px;
        margin-top: 7px;
    }

    /* File upload */
    .pengajuan-page input[type="file"] {
        padding: 11px;
        background-color: #fff;
    }

    /* Tombol */
    .pengajuan-page .btn-draft {
        background-color: #6c757d;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 11px 22px;
        font-weight: 600;
    }

    .pengajuan-page .btn-draft:hover {
        background-color: #545b62;
        color: #fff;
    }

    .pengajuan-page .btn-submit {
        background-color: #f28c28;
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 11px 24px;
        font-weight: 700;
    }

    .pengajuan-page .btn-submit:hover {
        background-color: #d97617;
        color: #fff;
    }

    /* Sidebar */
    .pengajuan-page .info-card .card-header {
        background-color: #0b3d91;
        color: white;
        border: none;
        padding: 16px 20px;
    }

    .pengajuan-page .warning-card .card-header {
        background-color: #f28c28;
        color: white;
        border: none;
        padding: 16px 20px;
    }

    .pengajuan-page .info-card .card-title,
    .pengajuan-page .warning-card .card-title {
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }

    .pengajuan-page .info-card .card-body,
    .pengajuan-page .warning-card .card-body {
        padding: 22px;
        color: #526b84;
        font-size: 15px;
        line-height: 1.7;
    }

    /* List informasi */
    .pengajuan-page .info-list {
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .pengajuan-page .info-list li {
        margin-bottom: 13px;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .pengajuan-page .info-list li i {
        color: #0b3d91;
        margin-top: 4px;
    }

    /* Alert upload */
    .pengajuan-page .upload-info {
        background-color: #eef5ff;
        border-left: 4px solid #0b3d91;
        padding: 12px 15px;
        border-radius: 7px;
        color: #38516b;
        font-size: 14px;
        margin-top: 10px;
    }

    /* Responsive */
    @media (max-width: 991.98px) {

        .pengajuan-page .main-card .card-body {
            padding: 20px;
        }

        .pengajuan-page .page-title {
            font-size: 24px;
        }

        .pengajuan-page .sidebar-wrapper {
            margin-top: 25px;
        }
    }

    @media (max-width: 575.98px) {

        .pengajuan-page .main-card .card-body {
            padding: 16px;
        }

        .pengajuan-page .button-wrapper {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .pengajuan-page .button-wrapper .btn {
            width: 100%;
        }
    }
</style>


<div class="content-wrapper pengajuan-page">

    <!-- =========================================
         HEADER HALAMAN
         ========================================= -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>

                    <h1 class="page-title">

                        <i class="fas fa-file-circle-plus"></i>

                        Ajukan Layanan

                    </h1>

                    <p class="page-subtitle">

                        Silakan lengkapi formulir pengajuan layanan dengan data yang benar.

                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================
         KONTEN
         ========================================= -->

    <section class="content">

        <div class="container-fluid">

            <div class="row align-items-start">


                <!-- =========================================
                     KOLOM KIRI - FORM
                     ========================================= -->

                <div class="col-lg-8">

                    <div class="card main-card">

                        <div class="card-header">

                            <h3>

                                <i class="fas fa-file-signature me-2"></i>

                                Form Pengajuan Layanan

                            </h3>

                        </div>


                        <div class="card-body">


                            <!-- FORM -->

                            <form
                                action="<?= base_url('mahasiswa/ticket/store') ?>"
                                method="post"
                                enctype="multipart/form-data"
                            >

                                <?= csrf_field() ?>


                                <!-- =================================
                                     DATA PEMOHON
                                     ================================= -->

                                <div class="section-title">

                                    <i class="fas fa-user"></i>

                                    <span>Data Pemohon</span>

                                </div>


                                <!-- NAMA -->

                                <div class="form-group mb-4">

                                    <label for="nama">

                                        Nama Lengkap

                                        <span class="text-danger">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        id="nama"
                                        class="form-control readonly-input"
                                        value="<?= esc($user['nama'] ?? '') ?>"
                                        readonly
                                    >

                                </div>


                                <!-- NIM -->

                                <div class="form-group mb-4">

                                    <label for="nim">

                                        NIM

                                        <span class="text-danger">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        id="nim"
                                        class="form-control readonly-input"
                                        value="<?= esc($user['nim'] ?? '') ?>"
                                        readonly
                                    >

                                </div>


                                <!-- =================================
                                     TUJUAN PENGAJUAN
                                     ================================= -->

                                <div class="section-title mt-4">

                                    <i class="fas fa-building"></i>

                                    <span>Tujuan Pengajuan</span>

                                </div>


                                <!-- UNIT TUJUAN -->

                                <div class="form-group mb-4">

                                    <label for="unit">

                                        Unit Tujuan

                                        <span class="text-danger">*</span>

                                    </label>

                                    <select
                                        name="unit"
                                        id="unit"
                                        class="form-select"
                                        required
                                    >

                                        <option value="">

                                            -- Pilih Unit Tujuan --

                                        </option>

                                        <option value="Bidang Akademik dan Kemahasiswaan">

                                            Bidang Akademik dan Kemahasiswaan

                                        </option>

                                        <option value="Bidang Keuangan">

                                            Bidang Keuangan

                                        </option>

                                        <option value="Bidang Umum">

                                            Bidang Umum

                                        </option>

                                        <option value="Pusat Teknologi Informasi">

                                            Pusat Teknologi Informasi

                                        </option>

                                    </select>

                                    <div class="form-text">

                                        Pilih unit tujuan terlebih dahulu untuk menampilkan jenis layanan yang tersedia.

                                    </div>

                                </div>


                                <!-- JENIS LAYANAN -->

                                <div class="form-group mb-4">

                                    <label for="layanan">

                                        Jenis Layanan

                                        <span class="text-danger">*</span>

                                    </label>

                                    <select
                                        name="layanan"
                                        id="layanan"
                                        class="form-select"
                                        required
                                        disabled
                                    >

                                        <option value="">

                                            -- Pilih Unit Tujuan Terlebih Dahulu --

                                        </option>

                                    </select>

                                </div>


                                <!-- =================================
                                     KETERANGAN
                                     ================================= -->

                                <div class="section-title mt-4">

                                    <i class="fas fa-align-left"></i>

                                    <span>Detail Pengajuan</span>

                                </div>


                                <div class="form-group mb-4">

                                    <label for="keterangan">

                                        Keterangan Pengajuan

                                        <span class="text-danger">*</span>

                                    </label>

                                    <textarea
                                        name="keterangan"
                                        id="keterangan"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Jelaskan kebutuhan atau keperluan pengajuan layanan Anda..."
                                        required
                                    ></textarea>

                                    <div class="form-text">

                                        Jelaskan informasi pengajuan secara singkat dan jelas.

                                    </div>

                                </div>


                                <!-- =================================
                                     UPLOAD DOKUMEN
                                     ================================= -->

                                <div class="form-group mb-4">

                                    <label for="dokumen">

                                        Dokumen Pendukung

                                        <span class="text-muted fw-normal">

                                            (Opsional)

                                        </span>

                                    </label>

                                    <input
                                        type="file"
                                        name="dokumen"
                                        id="dokumen"
                                        class="form-control"
                                        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                    >

                                    <div class="upload-info">

                                        <i class="fas fa-info-circle me-1"></i>

                                        Dokumen bersifat opsional.
                                        Format yang diperbolehkan:
                                        PDF, JPG, JPEG, PNG, DOC, DOCX.
                                        Ukuran maksimal <strong>2 MB</strong>.

                                    </div>

                                </div>


                                <!-- =================================
                                     TOMBOL
                                     ================================= -->

                                <div class="d-flex justify-content-end gap-2 button-wrapper mt-4">

                                    <button
                                        type="submit"
                                        name="action"
                                        value="draft"
                                        class="btn btn-draft"
                                    >

                                        <i class="fas fa-save me-1"></i>

                                        Simpan Draft

                                    </button>


                                    <button
                                        type="submit"
                                        name="action"
                                        value="submit"
                                        class="btn btn-submit"
                                    >

                                        <i class="fas fa-paper-plane me-1"></i>

                                        Ajukan Layanan

                                    </button>

                                </div>


                            </form>

                        </div>

                    </div>

                </div>


                <!-- =========================================
                     KOLOM KANAN - SIDEBAR
                     ========================================= -->

                <div class="col-lg-4 sidebar-wrapper">


                    <!-- =================================
                         INFORMASI PENGAJUAN
                         ================================= -->

                    <div class="card info-card mb-4">

                        <div class="card-header">

                            <h3 class="card-title">

                                <i class="fas fa-circle-info me-2"></i>

                                Informasi Pengajuan

                            </h3>

                        </div>


                        <div class="card-body">

                            <ul class="info-list">

                                <li>

                                    <i class="fas fa-check-circle"></i>

                                    <span>
                                        Pilih <strong>Unit Tujuan</strong> sesuai dengan kebutuhan layanan Anda.
                                    </span>

                                </li>

                                <li>

                                    <i class="fas fa-check-circle"></i>

                                    <span>
                                        Setelah unit dipilih, pilih <strong>Jenis Layanan</strong> yang tersedia.
                                    </span>

                                </li>

                                <li>

                                    <i class="fas fa-check-circle"></i>

                                    <span>
                                        Isi keterangan pengajuan secara lengkap dan jelas.
                                    </span>

                                </li>

                                <li>

                                    <i class="fas fa-check-circle"></i>

                                    <span>
                                        Dokumen pendukung dapat diunggah jika diperlukan.
                                    </span>

                                </li>

                                <li>

                                    <i class="fas fa-check-circle"></i>

                                    <span>
                                        Ukuran dokumen maksimal adalah <strong>2 MB</strong>.
                                    </span>

                                </li>

                            </ul>

                        </div>

                    </div>


                    <!-- =================================
                         PERHATIAN
                         ================================= -->

                    <div class="card warning-card">

                        <div class="card-header">

                            <h3 class="card-title">

                                <i class="fas fa-triangle-exclamation me-2"></i>

                                Perhatian

                            </h3>

                        </div>


                        <div class="card-body">

                            <p class="mb-3">

                                <i class="fas fa-circle-info text-warning me-1"></i>

                                Pastikan seluruh data pengajuan sudah benar sebelum dikirim.

                            </p>

                            <p class="mb-0">

                                <i class="fas fa-ticket text-warning me-1"></i>

                                Setelah pengajuan berhasil dikirim, Anda akan mendapatkan nomor tiket untuk memantau proses layanan melalui menu <strong>Tracking Tiket</strong>.

                            </p>

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </section>

</div>


<!-- =========================================
     JAVASCRIPT
     UNIT TUJUAN -> JENIS LAYANAN
     ========================================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const unitSelect = document.getElementById('unit');

    const layananSelect = document.getElementById('layanan');


    const layananByUnit = {

        "Bidang Akademik dan Kemahasiswaan": [

            "Surat Keterangan Aktif Kuliah",

            "Legalisir Ijazah/Transkrip",

            "Verifikasi Alumni",

            "Layanan Kemahasiswaan",

            "Layanan Akademik"

        ],

        "Bidang Keuangan": [

            "Konfirmasi Pembayaran"

        ],

        "Bidang Umum": [

            "Permohonan Kunjungan",

            "Permohonan Informasi Publik",

            "Pengaduan Layanan"

        ],

        "Pusat Teknologi Informasi": [

            "Bantuan Akses Sistem Informasi"

        ]

    };


    unitSelect.addEventListener('change', function () {

        const unit = this.value;


        layananSelect.innerHTML = '';

        layananSelect.disabled = true;


        if (unit === '') {

            const defaultOption = document.createElement('option');

            defaultOption.value = '';

            defaultOption.textContent = '-- Pilih Unit Tujuan Terlebih Dahulu --';

            layananSelect.appendChild(defaultOption);

            return;

        }


        const defaultOption = document.createElement('option');

        defaultOption.value = '';

        defaultOption.textContent = '-- Pilih Jenis Layanan --';

        layananSelect.appendChild(defaultOption);


        if (layananByUnit[unit]) {

            layananByUnit[unit].forEach(function (layanan) {

                const option = document.createElement('option');

                option.value = layanan;

                option.textContent = layanan;

                layananSelect.appendChild(option);

            });

        }


        layananSelect.disabled = false;

    });

});

</script>


<?= $this->include('layouts/footer') ?>