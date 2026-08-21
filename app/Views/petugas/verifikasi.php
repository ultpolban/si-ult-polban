<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    /* =========================================================
       VERIFIKASI TIKET
       Tema mengikuti halaman Data Tiket
    ========================================================= */

    .verification-page {
        animation: pageFadeIn .35s ease-out;
    }

    @keyframes pageFadeIn {
        from {
            opacity: 0;
            transform: translateY(8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Header */
    .page-title {
        color: #1a237e;
        font-weight: 700;
        letter-spacing: -0.3px;
    }

    .breadcrumb-item a {
        color: #0d6efd;
        text-decoration: none;
    }

    /* =========================================================
       SUMMARY CARD
    ========================================================= */

    .summary-card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        min-height: 105px;
        transition: all .25s ease;
    }

    .summary-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,.12) !important;
    }

    .summary-navy {
        background: #1a237e;
        color: #fff;
    }

    .summary-orange {
        background: #ff8c00;
        color: #fff;
    }

    .summary-blue {
        background: #17a2b8;
        color: #fff;
    }

    .summary-green {
        background: #198754;
        color: #fff;
    }

    .summary-icon {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,.18);
        flex-shrink: 0;
    }

    .summary-label {
        font-size: .74rem;
        text-transform: uppercase;
        font-weight: 700;
        opacity: .78;
        margin-bottom: 4px;
    }

    .summary-value {
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
    }

    /* =========================================================
       GENERAL CARD
    ========================================================= */

    .professional-card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 3px 12px rgba(0,0,0,.06);
        overflow: hidden;
        transition: box-shadow .25s ease;
    }

    .professional-card:hover {
        box-shadow: 0 6px 18px rgba(0,0,0,.08);
    }

    .card-title-custom {
        font-size: 1.05rem;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }

    .card-title-custom i {
        color: #1a237e;
    }

    /* =========================================================
       INFO DATA
    ========================================================= */

    .info-item {
        height: 100%;
        padding: 15px 16px;
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 9px;
        transition: all .2s ease;
    }

    .info-item:hover {
        background: #f8f9ff;
        border-color: #c9cdf5;
        transform: translateY(-1px);
    }

    .info-label {
        display: block;
        color: #6c757d;
        font-size: .78rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .info-label i {
        color: #1a237e;
        width: 17px;
    }

    .info-value {
        display: block;
        color: #212529;
        font-size: .94rem;
        font-weight: 700;
        word-break: break-word;
    }

    .ticket-number {
        color: #0d6efd;
    }

    /* =========================================================
       LAMPIRAN
    ========================================================= */

    .attachment-box {
        border: 1px dashed #cfd4da;
        background: #f8f9fa;
        border-radius: 10px;
        padding: 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        transition: all .2s ease;
    }

    .attachment-box:hover {
        background: #f8f9ff;
        border-color: #1a237e;
    }

    .attachment-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background: #fff0f0;
        color: #dc3545;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .attachment-title {
        font-weight: 700;
        color: #212529;
        margin-bottom: 3px;
    }

    .attachment-info {
        font-size: .82rem;
        color: #6c757d;
        margin: 0;
    }

    .btn-view-file {
        background: #1a237e;
        border: none;
        color: #fff;
        border-radius: 8px;
        padding: 9px 16px;
        font-weight: 600;
        transition: all .2s ease;
        white-space: nowrap;
    }

    .btn-view-file:hover {
        background: #12185c;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(26,35,126,.25);
    }

    /* Tombol Export Laporan Green (Mengikuti halaman Data Tiket) */
    .btn-export-green {
        background-color: #198754;
        border-color: #198754;
        color: #ffffff;
        font-weight: 700;
        border-radius: 8px;
        height: 44px;
        padding: 0 20px;
        transition: all 0.25s ease-in-out;
    }
    .btn-export-green:hover {
        background-color: #146c43;
        border-color: #13653f;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.35);
        transform: translateY(-1px);
    }

    .export-action-group {
        position: relative;
        z-index: 105 !important;
    }

    .export-dropdown {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .export-menu {
        display: none;
        position: absolute;
        right: 0;
        top: calc(100% + 8px);
        min-width: 210px;
        background: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 6px 0;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.18);
        z-index: 9999 !important;
    }

    .export-menu.show {
        display: block !important;
    }

    .export-menu .dropdown-item {
        display: flex;
        align-items: center;
        padding: 11px 15px;
        color: #212529;
        font-size: 0.9rem;
        text-decoration: none;
        white-space: nowrap;
        transition: background-color 0.2s ease;
    }

    .export-menu .dropdown-item:hover {
        background-color: #f5f7fa;
    }

    .export-menu .dropdown-item i {
        width: 22px;
        text-align: center;
    }

    /* =========================================================
       VERIFICATION CHECKLIST
    ========================================================= */

    .verification-header {
        background: #1a237e;
        color: #fff;
        padding: 15px 20px;
    }

    .checklist-box {
        border: 1px solid #e9ecef;
        border-radius: 10px;
        overflow: hidden;
    }

    .check-item {
        display: flex;
        align-items: center;
        padding: 14px 16px;
        border-bottom: 1px solid #edf0f2;
        cursor: pointer;
        transition: all .2s ease;
        margin: 0;
    }

    .check-item:last-child {
        border-bottom: none;
    }

    .check-item:hover {
        background: #f8f9ff;
    }

    .check-item.checked {
        background: #f1fbf5;
    }

    .check-input {
        width: 19px;
        height: 19px;
        margin-right: 12px;
        accent-color: #198754;
        cursor: pointer;
        flex-shrink: 0;
    }

    .check-icon {
        color: #adb5bd;
        margin-right: 10px;
        transition: color .2s ease;
    }

    .check-item.checked .check-icon {
        color: #198754;
    }

    .check-text {
        font-weight: 600;
        color: #343a40;
        font-size: .9rem;
    }

    /* =========================================================
       PROGRESS CHECKLIST
    ========================================================= */

    .verification-progress {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 9px;
        padding: 13px 15px;
    }

    .progress {
        height: 8px;
        border-radius: 10px;
        background: #e9ecef;
        overflow: hidden;
    }

    .progress-bar {
        background: #198754;
        transition: width .3s ease;
    }

    .progress-text {
        font-size: .8rem;
        font-weight: 700;
        color: #6c757d;
    }

    /* =========================================================
       FORM
    ========================================================= */

    .form-label-custom {
        font-size: .88rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 7px;
    }

    .custom-form-control {
        border: 1px solid #ced4da;
        border-radius: 8px;
        min-height: 42px;
        font-size: .9rem;
        transition: all .2s ease;
    }

    .custom-form-control:focus {
        border-color: #1a237e;
        box-shadow: 0 0 0 .2rem rgba(26,35,126,.12);
    }

    textarea.custom-form-control {
        min-height: 110px;
        resize: vertical;
    }

    /* =========================================================
       BUTTON
    ========================================================= */

    .btn-save-verification {
        background: #198754;
        border: none;
        color: #fff;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 700;
        transition: all .2s ease;
    }

    .btn-save-verification:hover {
        background: #146c43;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(25,135,84,.25);
    }

    .btn-cancel {
        background: #6c757d;
        border: none;
        color: #fff;
        border-radius: 8px;
        padding: 10px 20px;
        font-weight: 700;
        transition: all .2s ease;
    }

    .btn-cancel:hover {
        background: #5a6268;
        color: #fff;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 767px) {

        .attachment-box {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-view-file {
            width: 100%;
            text-align: center;
        }

        .action-buttons {
            flex-direction: column;
            width: 100%;
        }

        .action-buttons .btn {
            width: 100%;
            margin: 0 0 8px 0 !important;
        }
    }
</style>


<div class="container-fluid px-4 py-4 verification-page">

    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="h3 page-title mb-1">
                <i class="fas fa-user-check mr-2"></i>
                Verifikasi Tiket
            </h1>

            <p class="text-muted mb-0">
                Periksa kelengkapan data dan dokumen sebelum tiket diproses.
            </p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <!-- TOMBOL EXPORT LAPORAN -->
            <div class="export-action-group mr-3">
                <div class="export-dropdown">
                    <button type="button" class="btn btn-export-green d-flex align-items-center justify-content-center" id="dropdownExport" onclick="toggleExportMenu(event)">
                        <i class="fas fa-download mr-2"></i>
                        Export Laporan
                        <i class="fas fa-chevron-down ml-2"></i>
                    </button>
                    <div class="export-menu" id="exportMenu">
                        <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/excel') ?>">
                            <i class="fas fa-file-excel mr-2" style="color:#0B8F4D;"></i> Export Excel
                        </a>
                        <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/pdf') ?>">
                            <i class="fas fa-file-pdf mr-2" style="color:#D93025;"></i> Export PDF
                        </a>
                        <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/csv') ?>">
                            <i class="fas fa-file-csv mr-2" style="color:#005BAC;"></i> Export CSV
                        </a>
                    </div>
                </div>
            </div>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 m-0">

                    <li class="breadcrumb-item">
                        <a href="<?= base_url('petugas/dashboard') ?>">
                            Dashboard
                        </a>
                    </li>

                    <li class="breadcrumb-item">
                        <a href="<?= base_url('petugas/tiket') ?>">
                            Data Tiket
                        </a>
                    </li>

                    <li class="breadcrumb-item active" aria-current="page">
                        Verifikasi
                    </li>

                </ol>
            </nav>
        </div>

    </div>


    <!-- =====================================================
         RINGKASAN TIKET
    ====================================================== -->

    <div class="row mb-4">

        <!-- No Tiket -->
        <div class="col-xl-3 col-md-6 mb-3">

            <div class="card summary-card summary-navy shadow-sm">

                <div class="card-body d-flex align-items-center justify-content-between p-3">

                    <div>
                        <div class="summary-label">
                            No Tiket
                        </div>

                        <p class="summary-value">
                            <?= esc($tiket['nomor_tiket'] ?? 'ULT-20260720-0001') ?>
                        </p>
                    </div>

                    <div class="summary-icon">
                        <i class="fas fa-ticket-alt"></i>
                    </div>

                </div>

            </div>

        </div>


        <!-- Pemohon -->
        <div class="col-xl-3 col-md-6 mb-3">

            <div class="card summary-card summary-orange shadow-sm">

                <div class="card-body d-flex align-items-center justify-content-between p-3">

                    <div>
                        <div class="summary-label">
                            Pemohon
                        </div>

                        <p class="summary-value">
                            <?= esc($tiket['nama_pemohon'] ?? 'Rafi Putra') ?>
                        </p>
                    </div>

                    <div class="summary-icon">
                        <i class="fas fa-user"></i>
                    </div>

                </div>

            </div>

        </div>


        <!-- Layanan -->
        <div class="col-xl-3 col-md-6 mb-3">

            <div class="card summary-card summary-blue shadow-sm">

                <div class="card-body d-flex align-items-center justify-content-between p-3">

                    <div>
                        <div class="summary-label">
                            Layanan
                        </div>

                        <p class="summary-value">
                            <?= esc($tiket['layanan'] ?? 'Surat Aktif Kuliah') ?>
                        </p>
                    </div>

                    <div class="summary-icon">
                        <i class="fas fa-concierge-bell"></i>
                    </div>

                </div>

            </div>

        </div>


        <!-- Status -->
        <div class="col-xl-3 col-md-6 mb-3">

            <div class="card summary-card summary-green shadow-sm">

                <div class="card-body d-flex align-items-center justify-content-between p-3">

                    <div>
                        <div class="summary-label">
                            Status
                        </div>

                        <p class="summary-value" id="summaryStatus">
                            <?= esc($tiket['status'] ?? 'Submitted') ?>
                        </p>
                    </div>

                    <div class="summary-icon">
                        <i class="fas fa-clock"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         INFORMASI PERMOHONAN
    ====================================================== -->

    <div class="card professional-card mb-4">

        <div class="card-header bg-white border-0 py-3 px-4">

            <h5 class="card-title-custom">
                <i class="fas fa-id-card mr-2"></i>
                Informasi Permohonan
            </h5>

        </div>

        <div class="card-body px-4 pb-4">

            <div class="row">

                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-ticket-alt"></i>
                            Nomor Tiket
                        </span>

                        <span class="info-value ticket-number">
                            <?= esc($tiket['nomor_tiket'] ?? 'ULT-20260720-0001') ?>
                        </span>

                    </div>
                </div>


                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-user"></i>
                            Nama Pemohon
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['nama_pemohon'] ?? 'Rafi Putra') ?>
                        </span>

                    </div>
                </div>


                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-id-badge"></i>
                            NIM
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['nim'] ?? '231511001') ?>
                        </span>

                    </div>
                </div>


                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-concierge-bell"></i>
                            Jenis Layanan
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['layanan'] ?? 'Surat Aktif Kuliah') ?>
                        </span>

                    </div>
                </div>


                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-layer-group"></i>
                            Kategori
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['kategori'] ?? 'Akademik') ?>
                        </span>

                    </div>
                </div>


                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-exclamation-circle"></i>
                            Prioritas
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['prioritas'] ?? 'High') ?>
                        </span>

                    </div>
                </div>


                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-envelope"></i>
                            Email
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['email'] ?? 'rafi@student.polban.ac.id') ?>
                        </span>

                    </div>
                </div>


                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="info-item">

                        <span class="info-label">
                            <i class="fas fa-phone"></i>
                            No HP
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['no_hp'] ?? '081234567890') ?>
                        </span>

                    </div>
                </div>


                <div class="col-lg-4 col-md-6 mb-3">
                    <div class="info-item">

                        <span class="info-label">
                            <i class="far fa-calendar-alt"></i>
                            Tanggal Pengajuan
                        </span>

                        <span class="info-value">
                            <?= esc($tiket['tanggal'] ?? '17 Juli 2026') ?>
                        </span>

                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         LAMPIRAN
    ====================================================== -->

    <div class="card professional-card mb-4">

        <div class="card-header bg-white border-0 py-3 px-4">

            <h5 class="card-title-custom">
                <i class="fas fa-paperclip mr-2"></i>
                Lampiran Pemohon
            </h5>

        </div>

        <div class="card-body px-4 pb-4">

            <div class="attachment-box">

                <div class="d-flex align-items-center">

                    <div class="attachment-icon mr-3">
                        <i class="fas fa-file-pdf"></i>
                    </div>

                    <div>
                        <div class="attachment-title">
                            Dokumen Persyaratan
                        </div>

                        <p class="attachment-info">
                            File lampiran yang dikirim oleh pemohon.
                        </p>
                    </div>

                </div>

                <a href="<?= base_url('uploads/' . ($tiket['lampiran'] ?? 'sample.pdf')) ?>"
                   target="_blank"
                   class="btn btn-view-file">

                    <i class="fas fa-eye mr-1"></i>
                    Lihat Lampiran

                </a>

            </div>

        </div>

    </div>


    <!-- =====================================================
         FORM VERIFIKASI
    ====================================================== -->

    <div class="card professional-card mb-4">

        <div class="verification-header">

            <h5 class="mb-0 font-weight-bold">
                <i class="fas fa-check-double mr-2"></i>
                Verifikasi Tiket
            </h5>

        </div>

        <div class="card-body p-4">

            <form
                id="verificationForm"
                action="<?= base_url('petugas/verifikasi/simpan' . (isset($tiket['id']) ? '/'.$tiket['id'] : '')) ?>"
                method="POST">

                <?= csrf_field() ?>


                <!-- Checklist -->

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h6 class="font-weight-bold text-dark mb-0">
                        Checklist Kelengkapan
                    </h6>

                    <span class="badge badge-light border px-3 py-2"
                          id="checkCount">
                        0 / 3 lengkap
                    </span>

                </div>


                <div class="checklist-box mb-3">

                    <label class="check-item" data-check-item>

                        <input
                            type="checkbox"
                            class="check-input verification-check"
                            id="checkMahasiswa"
                            name="check_mahasiswa"
                            value="1">

                        <i class="fas fa-user-check check-icon"></i>

                        <span class="check-text">
                            Data Mahasiswa Sesuai
                        </span>

                    </label>


                    <label class="check-item" data-check-item>

                        <input
                            type="checkbox"
                            class="check-input verification-check"
                            id="checkLampiran"
                            name="check_lampiran"
                            value="1">

                        <i class="fas fa-file-check check-icon"></i>

                        <span class="check-text">
                            Lampiran Lengkap
                        </span>

                    </label>


                    <label class="check-item" data-check-item>

                        <input
                            type="checkbox"
                            class="check-input verification-check"
                            id="checkPersyaratan"
                            name="check_persyaratan"
                            value="1">

                        <i class="fas fa-clipboard-check check-icon"></i>

                        <span class="check-text">
                            Persyaratan Sudah Sesuai
                        </span>

                    </label>

                </div>


                <!-- Progress -->

                <div class="verification-progress mb-4">

                    <div class="d-flex justify-content-between mb-2">

                        <span class="progress-text">
                            Kelengkapan Verifikasi
                        </span>

                        <span class="progress-text" id="progressPercent">
                            0%
                        </span>

                    </div>

                    <div class="progress">

                        <div
                            id="verificationProgress"
                            class="progress-bar"
                            role="progressbar"
                            style="width: 0%;">

                        </div>

                    </div>

                </div>


                <div class="row">

                    <!-- Status -->

                    <div class="col-md-6 mb-4">

                        <label class="form-label-custom">
                            Status Verifikasi
                        </label>

                        <select
                            name="status_verifikasi"
                            id="statusVerifikasi"
                            class="form-control custom-form-control"
                            required>

                            <option value="" selected disabled>
                                Pilih Keputusan...
                            </option>

                            <option value="Verified">
                                Disetujui / Terverifikasi
                            </option>

                            <option value="Rejected">
                                Ditolak / Perlu Perbaikan
                            </option>

                        </select>

                    </div>


                    <!-- Catatan -->

                    <div class="col-md-6 mb-4">

                        <label class="form-label-custom">
                            Catatan Petugas
                        </label>

                        <textarea
                            name="catatan"
                            id="catatanVerifikasi"
                            class="form-control custom-form-control"
                            rows="4"
                            placeholder="Tambahkan catatan atau alasan verifikasi..."></textarea>

                    </div>

                </div>


                <!-- BUTTON -->

                <div class="d-flex justify-content-end action-buttons">

                    <a
                        href="<?= base_url('petugas/tiket') ?>"
                        class="btn btn-cancel mr-2">

                        <i class="fas fa-arrow-left mr-1"></i>
                        Batal

                    </a>


                    <button
                        type="submit"
                        id="btnSubmitVerification"
                        class="btn btn-save-verification">

                        <i class="fas fa-save mr-1"></i>
                        Simpan Verifikasi

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script>
function toggleExportMenu(event) {
    event.stopPropagation();
    const menu = document.getElementById('exportMenu');
    if (menu) {
        menu.classList.toggle('show');
    }
}

// Menutup dropdown jika pengguna mengklik di luar area tombol/menu
document.addEventListener('click', function(event) {
    const dropdown = document.querySelector('.export-dropdown');
    const menu = document.getElementById('exportMenu');

    if (dropdown && menu && !dropdown.contains(event.target)) {
        menu.classList.remove('show');
    }
});

document.addEventListener('DOMContentLoaded', function () {

    /* =====================================================
       CHECKLIST PROGRESS
    ====================================================== */

    const checks = document.querySelectorAll('.verification-check');
    const checkItems = document.querySelectorAll('[data-check-item]');
    const progressBar = document.getElementById('verificationProgress');
    const progressPercent = document.getElementById('progressPercent');
    const checkCount = document.getElementById('checkCount');

    function updateChecklist() {

        let checked = 0;

        checks.forEach(function (checkbox, index) {

            const item = checkItems[index];

            if (checkbox.checked) {

                checked++;

                if (item) {
                    item.classList.add('checked');
                }

            } else {

                if (item) {
                    item.classList.remove('checked');
                }

            }

        });

        const total = checks.length;

        const percent = total > 0
            ? Math.round((checked / total) * 100)
            : 0;

        progressBar.style.width = percent + '%';
        progressPercent.textContent = percent + '%';
        checkCount.textContent = checked + ' / ' + total + ' lengkap';

    }

    checks.forEach(function (checkbox) {

        checkbox.addEventListener('change', updateChecklist);

    });

    updateChecklist();


    /* =====================================================
       FORM SUBMIT LOADING
    ====================================================== */

    const form = document.getElementById('verificationForm');
    const submitButton = document.getElementById('btnSubmitVerification');

    if (form && submitButton) {

        form.addEventListener('submit', function () {

            submitButton.disabled = true;

            submitButton.innerHTML =
                '<i class="fas fa-spinner fa-spin mr-1"></i> Menyimpan...';

        });

    }


    /* =====================================================
       STATUS VERIFIKASI
    ====================================================== */

    const statusSelect = document.getElementById('statusVerifikasi');
    const noteField = document.getElementById('catatanVerifikasi');

    if (statusSelect && noteField) {

        statusSelect.addEventListener('change', function () {

            if (this.value === 'Rejected') {

                noteField.placeholder =
                    'Jelaskan alasan penolakan atau dokumen yang perlu diperbaiki...';

                noteField.focus();

            } else {

                noteField.placeholder =
                    'Tambahkan catatan atau alasan verifikasi...';

            }

        });

    }

});
</script>


<?= $this->endSection() ?>