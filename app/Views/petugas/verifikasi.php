<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --polban-navy: #1a237e;
        --polban-blue: #005bac;
        --polban-orange: #ff8c00;
        --polban-yellow: #f4c400;
        --polban-green: #10b981;
        --soft-bg: #f4f6f9;
        --text-dark: #263238;
        --text-muted: #6c757d;
    }

    body, .container-fluid {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        color: var(--text-dark);
    }

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
        color: var(--polban-navy);
        font-weight: 800;
        letter-spacing: -0.4px;
    }

    .breadcrumb-item a {
        color: var(--polban-blue);
        text-decoration: none;
    }

    /* =========================================================
       SUMMARY CARD (PERSIS SEPERTI FOTO)
    ========================================================= */
    .stat-tamu-card {
        border-radius: 18px;
        border: none;
        color: #ffffff;
        transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .stat-tamu-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -30%;
        width: 180px;
        height: 180px;
        background: rgba(255, 255, 255, 0.12);
        border-radius: 50%;
        z-index: -1;
        transition: transform 0.5s ease;
    }

    .stat-tamu-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.15) !important;
    }

    .stat-tamu-card:hover::before {
        transform: scale(1.25);
    }

    .bg-tamu-navy {
        background: linear-gradient(135deg, #1b2e85 0%, #283593 100%) !important;
    }

    .bg-tamu-orange {
        background: linear-gradient(135deg, #ff7a00 0%, #ff8c00 100%) !important;
    }

    .bg-tamu-yellow {
        background: linear-gradient(135deg, #ffb300 0%, #f4c400 100%) !important;
    }

    .bg-tamu-green {
        background: linear-gradient(135deg, #00a86b 0%, #10b981 100%) !important;
    }

    .icon-tamu-circle {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        background: rgba(255, 255, 255, 0.22);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        box-shadow: inset 0 0 12px rgba(255, 255, 255, 0.25);
    }

    /* =========================================================
       GENERAL CARD & DETAILS
    ========================================================= */
    .professional-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 4px 18px rgba(0,0,0,.06);
        overflow: hidden;
        transition: box-shadow .25s ease;
    }

    .professional-card:hover {
        box-shadow: 0 6px 20px rgba(0,0,0,.08);
    }

    .card-title-custom {
        font-size: 1.05rem;
        font-weight: 800;
        color: var(--text-dark);
        margin: 0;
    }

    .card-title-custom i {
        color: var(--polban-navy);
    }

    .info-item {
        height: 100%;
        padding: 15px 16px;
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        transition: all .2s ease;
    }

    .info-item:hover {
        background: #f8f9ff;
        border-color: #c9cdf5;
        transform: translateY(-1px);
    }

    .info-label {
        display: block;
        color: var(--text-muted);
        font-size: .78rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .info-label i {
        color: var(--polban-navy);
        width: 17px;
    }

    .info-value {
        display: block;
        color: var(--text-dark);
        font-size: .94rem;
        font-weight: 700;
        word-break: break-word;
    }

    .ticket-number {
        color: var(--polban-blue);
    }

    .attachment-box {
        border: 2px dashed #cbd5e1;
        background: #f8fafc;
        border-radius: 12px;
        padding: 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        transition: all .2s ease;
    }

    .attachment-box:hover {
        background: #f8f9ff;
        border-color: var(--polban-navy);
    }

    .attachment-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: #fff0f0;
        color: #dc3545;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        flex-shrink: 0;
    }

    .btn-view-file {
        background: var(--polban-navy);
        border: none;
        color: #fff;
        border-radius: 8px;
        padding: 9px 18px;
        font-weight: 700;
        transition: all .2s ease;
    }

    .btn-view-file:hover {
        background: #12185c;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(26,35,126,.25);
    }

    /* Checklist & Progress */
    .verification-header {
        background: linear-gradient(135deg, #1a237e 0%, #283593 100%);
        color: #fff;
        padding: 16px 20px;
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
        accent-color: #10b981;
        cursor: pointer;
        flex-shrink: 0;
    }

    .check-icon {
        color: #adb5bd;
        margin-right: 10px;
        transition: color .2s ease;
    }

    .check-item.checked .check-icon {
        color: #10b981;
    }

    .check-text {
        font-weight: 600;
        color: #343a40;
        font-size: .9rem;
    }

    .verification-progress {
        background: #f8f9fa;
        border: 1px solid #e9ecef;
        border-radius: 10px;
        padding: 14px 16px;
    }

    .progress {
        height: 8px;
        border-radius: 10px;
        background: #e9ecef;
        overflow: hidden;
    }

    .progress-bar {
        background: #10b981;
        transition: width .3s ease;
    }

    /* Form Inputs */
    .form-label-custom {
        font-size: .88rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 7px;
    }

    .custom-form-control {
        border: 1px solid #cbd5e1;
        border-radius: 10px;
        min-height: 44px;
        font-size: .9rem;
        transition: all .2s ease;
    }

    .custom-form-control:focus {
        border-color: var(--polban-navy);
        box-shadow: 0 0 0 .2rem rgba(26,35,126,.12);
    }

    textarea.custom-form-control {
        min-height: 110px;
        resize: vertical;
    }

    .btn-save-verification {
        background: #10b981;
        border: none;
        color: #fff;
        border-radius: 8px;
        padding: 10px 22px;
        font-weight: 700;
        transition: all .2s ease;
    }

    .btn-save-verification:hover {
        background: #059669;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(16,185,129,.25);
    }

    .btn-cancel {
        background: #6c757d;
        border: none;
        color: #fff;
        border-radius: 8px;
        padding: 10px 22px;
        font-weight: 700;
        transition: all .2s ease;
    }

    .btn-cancel:hover {
        background: #5a6268;
        color: #fff;
    }

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

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 page-title mb-1">
                <i class="fas fa-user-check me-2"></i> Verifikasi Tiket Permohonan
            </h1>
            <p class="text-muted mb-0">
                Periksa kelengkapan data dan dokumen sebelum tiket diproses.
            </p>
        </div>

        <div class="d-flex align-items-center gap-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 m-0">
                    <li class="breadcrumb-item"><a href="<?= base_url('petugas/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('petugas/tiket') ?>">Data Tiket</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Verifikasi</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- SUMMARY CARDS (PERSIS KOTAK FOTO) -->
    <div class="row g-3 mb-4">
        <!-- TOTAL TAMU / TOTAL -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-navy p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">TOTAL TAMU</span>
                        <h4 class="fw-bold mb-0 text-white mt-1" style="font-size: 1.8rem;">
                            <?= esc($stats['total'] ?? '8') ?>
                        </h4>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- SUBMITTED -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-orange p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">SUBMITTED</span>
                        <h4 class="fw-bold mb-0 text-white mt-1" style="font-size: 1.8rem;">
                            <?= esc($stats['submitted'] ?? '1') ?>
                        </h4>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- ASSIGNED / DIPROSES -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-yellow p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">ASSIGNED / DIPROSES</span>
                        <h4 class="fw-bold mb-0 text-white mt-1" style="font-size: 1.8rem;">
                            <?= esc($stats['assigned'] ?? '5') ?>
                        </h4>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-spinner"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- VERIFIED / SELESAI -->
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-green p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">VERIFIED / SELESAI</span>
                        <h4 class="fw-bold mb-0 text-white mt-1" style="font-size: 1.8rem;">
                            <?= esc($stats['verified'] ?? '2') ?>
                        </h4>
                    </div>
                    <div class="icon-tamu-circle text-white">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- INFORMASI PERMOHONAN -->
    <div class="card professional-card mb-4">
        <div class="card-header bg-white border-0 py-3 px-4">
            <h5 class="card-title-custom">
                <i class="fas fa-id-card me-2"></i> Informasi Permohonan
            </h5>
        </div>
        <div class="card-body px-4 pb-4">
            <div class="row g-3">
                <div class="col-lg-4 col-md-6">
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-ticket-alt"></i> Nomor Tiket</span>
                        <span class="info-value ticket-number"><?= esc($tiket['nomor_tiket'] ?? 'ULT-20260808-0015') ?></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-user"></i> Nama Pemohon</span>
                        <span class="info-value"><?= esc($tiket['nama_pemohon'] ?? 'Rian Hidayat') ?></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-id-badge"></i> NIM</span>
                        <span class="info-value"><?= esc($tiket['nim'] ?? '231511001') ?></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-concierge-bell"></i> Jenis Layanan</span>
                        <span class="info-value"><?= esc($tiket['layanan'] ?? 'Surat Aktif Kuliah') ?></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-layer-group"></i> Kategori</span>
                        <span class="info-value"><?= esc($tiket['kategori'] ?? 'Akademik') ?></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-exclamation-circle"></i> Prioritas</span>
                        <span class="info-value"><?= esc($tiket['prioritas'] ?? 'High') ?></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-envelope"></i> Email</span>
                        <span class="info-value"><?= esc($tiket['email'] ?? 'rian@student.polban.ac.id') ?></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="info-item">
                        <span class="info-label"><i class="fas fa-phone"></i> No HP</span>
                        <span class="info-value"><?= esc($tiket['no_hp'] ?? '081234567890') ?></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="info-item">
                        <span class="info-label"><i class="far fa-calendar-alt"></i> Tanggal Pengajuan</span>
                        <span class="info-value"><?= esc($tiket['tanggal'] ?? '17 Juli 2026') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- LAMPIRAN -->
    <div class="card professional-card mb-4">
        <div class="card-header bg-white border-0 py-3 px-4">
            <h5 class="card-title-custom">
                <i class="fas fa-paperclip me-2"></i> Lampiran Pemohon
            </h5>
        </div>
        <div class="card-body px-4 pb-4">
            <div class="attachment-box">
                <div class="d-flex align-items-center">
                    <div class="attachment-icon me-3">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div>
                        <div class="attachment-title fw-bold">Dokumen Persyaratan</div>
                        <p class="attachment-info mb-0">File lampiran yang dikirim oleh pemohon.</p>
                    </div>
                </div>
                <a href="<?= base_url('uploads/' . ($tiket['lampiran'] ?? 'sample.pdf')) ?>" target="_blank" class="btn btn-view-file">
                    <i class="fas fa-eye me-1"></i> Lihat Lampiran
                </a>
            </div>
        </div>
    </div>

    <!-- FORM VERIFIKASI -->
    <div class="card professional-card mb-4">
        <div class="verification-header">
            <h5 class="mb-0 fw-bold"><i class="fas fa-check-double me-2"></i> Verifikasi Tiket</h5>
        </div>
        <div class="card-body p-4">
            <form id="verificationForm" action="<?= base_url('petugas/verifikasi/simpan' . (isset($tiket['id']) ? '/'.$tiket['id'] : '')) ?>" method="POST">
                <?= csrf_field() ?>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold text-dark mb-0">Checklist Kelengkapan</h6>
                    <span class="badge bg-light text-dark border px-3 py-2" id="checkCount">0 / 3 lengkap</span>
                </div>

                <div class="checklist-box mb-3">
                    <label class="check-item" data-check-item>
                        <input type="checkbox" class="check-input verification-check" id="checkMahasiswa" name="check_mahasiswa" value="1">
                        <i class="fas fa-user-check check-icon"></i>
                        <span class="check-text">Data Mahasiswa Sesuai</span>
                    </label>

                    <label class="check-item" data-check-item>
                        <input type="checkbox" class="check-input verification-check" id="checkLampiran" name="check_lampiran" value="1">
                        <i class="fas fa-file-circle-check check-icon"></i>
                        <span class="check-text">Lampiran Lengkap</span>
                    </label>

                    <label class="check-item" data-check-item>
                        <input type="checkbox" class="check-input verification-check" id="checkPersyaratan" name="check_persyaratan" value="1">
                        <i class="fas fa-clipboard-check check-icon"></i>
                        <span class="check-text">Persyaratan Sudah Sesuai</span>
                    </label>
                </div>

                <div class="verification-progress mb-4">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="progress-text font-weight-bold">Kelengkapan Verifikasi</span>
                        <span class="progress-text font-weight-bold" id="progressPercent">0%</span>
                    </div>
                    <div class="progress">
                        <div id="verificationProgress" class="progress-bar" role="progressbar" style="width: 0%;"></div>
                    </div>
                </div>

                <div class="row">
                    <!-- STATUS DROPDOWN -->
                    <div class="col-md-6 mb-4">
                        <label class="form-label-custom">Status Verifikasi</label>
                        <select name="status_verifikasi" id="statusVerifikasi" class="form-select custom-form-control" required>
                            <option value="" selected disabled>Pilih Keputusan...</option>
                            <option value="Verified">Disetujui / Terverifikasi</option>
                            <option value="Need Revision">Perlu Perbaikan / Need Revision</option>
                            <option value="Rejected">Ditolak</option>
                        </select>
                    </div>

                    <!-- CATATAN -->
                    <div class="col-md-6 mb-4">
                        <label class="form-label-custom">Catatan Petugas</label>
                        <textarea name="catatan" id="catatanVerifikasi" class="form-control custom-form-control" rows="4" placeholder="Tambahkan catatan atau alasan verifikasi..."></textarea>
                    </div>
                </div>

                <!-- BUTTONS -->
                <div class="d-flex justify-content-end action-buttons">
                    <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-cancel me-2">
                        <i class="fas fa-arrow-left me-1"></i> Batal
                    </a>
                    <button type="submit" id="btnSubmitVerification" class="btn btn-save-verification">
                        <i class="fas fa-save me-1"></i> Simpan Verifikasi
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

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
                if (item) item.classList.add('checked');
            } else {
                if (item) item.classList.remove('checked');
            }
        });

        const total = checks.length;
        const percent = total > 0 ? Math.round((checked / total) * 100) : 0;

        progressBar.style.width = percent + '%';
        progressPercent.textContent = percent + '%';
        checkCount.textContent = checked + ' / ' + total + ' lengkap';
    }

    checks.forEach(function (checkbox) {
        checkbox.addEventListener('change', updateChecklist);
    });

    updateChecklist();

    const form = document.getElementById('verificationForm');
    const submitButton = document.getElementById('btnSubmitVerification');

    if (form && submitButton) {
        form.addEventListener('submit', function () {
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Menyimpan...';
        });
    }

    const statusSelect = document.getElementById('statusVerifikasi');
    const noteField = document.getElementById('catatanVerifikasi');

    if (statusSelect && noteField) {
        statusSelect.addEventListener('change', function () {
            if (this.value === 'Need Revision') {
                noteField.placeholder = 'Jelaskan poin-poin dokumen atau data yang perlu diperbaiki oleh pemohon...';
                noteField.focus();
            } else if (this.value === 'Rejected') {
                noteField.placeholder = 'Jelaskan alasan penolakan permohonan...';
                noteField.focus();
            } else {
                noteField.placeholder = 'Tambahkan catatan atau alasan verifikasi...';
            }
        });
    }
});
</script>

<?= $this->endSection() ?>