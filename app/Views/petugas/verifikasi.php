<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<!-- ASSETS FONTS & ICONS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* =========================================================
       ULT POLBAN - SYSTEM VERIFICATION STYLING
    ========================================================= */

    :root {
        --ult-navy-dark: #2b3990;
        --ult-navy: #2b3990;
        --ult-blue-accent: #3b4cca;
        --ult-orange: #ff8c00;
        --ult-green: #10b981;
        --ult-yellow: #f59e0b;
        --ult-cyan: #06b6d4;
        --ult-light-bg: #f8fafc;
        --ult-card-border: rgba(226, 232, 240, 0.8);
        --ult-shadow-sm: 0 4px 20px -2px rgba(43, 57, 144, 0.05);
        --ult-shadow-hover: 0 20px 35px -10px rgba(43, 57, 144, 0.12);
    }

    body, .container-fluid {
        font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif !important;
        background-color: #f1f5f9;
    }

    /* =========================
       HEADER CARD
    ========================= */
    .header-gradient-card {
        background: #2b3990 !important;
        border-radius: 20px;
        padding: 24px 28px;
        color: #ffffff;
        box-shadow: 0 12px 30px rgba(43, 57, 144, 0.25);
        position: relative;
        overflow: hidden;
    }

    .header-gradient-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
        pointer-events: none;
    }

    .detail-page-title {
        color: #ffffff;
        font-weight: 800;
        letter-spacing: -0.5px;
        font-size: 1.65rem;
    }

    .detail-page-subtitle {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.92rem;
    }

    /* =========================
       SUMMARY STAT CARDS
    ========================= */
    .stat-tamu-card {
        border-radius: 20px;
        border: 1px solid var(--ult-card-border);
        color: #ffffff;
        transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
        z-index: 1;
        min-height: 100px;
        display: flex;
        align-items: center;
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
        transform: translateY(-4px);
        box-shadow: var(--ult-shadow-hover);
    }

    .stat-tamu-card:hover::before { 
        transform: scale(1.25); 
    }

    .bg-tamu-navy { background: linear-gradient(135deg, #2b3990 0%, #3b4cca 100%) !important; }
    .bg-tamu-orange { background: linear-gradient(135deg, #ff8c00 0%, #f57c00 100%) !important; }
    .bg-tamu-yellow { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important; }
    .bg-tamu-green { background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important; }

    .icon-tamu-circle {
        width: 44px;
        height: 44px;
        min-width: 44px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(8px);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    .stat-title {
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        display: block;
        line-height: 1.2;
    }

    .stat-value {
        font-size: 1.1rem;
        font-weight: 800;
        line-height: 1.3;
        margin-top: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* =========================
       MAIN CARDS & SECTIONS
    ========================= */
    .detail-main-card {
        border: 1px solid var(--ult-card-border);
        border-radius: 20px;
        background: #ffffff;
        box-shadow: var(--ult-shadow-sm);
        transition: all 0.35s ease;
        overflow: hidden;
    }

    .detail-main-card:hover {
        box-shadow: var(--ult-shadow-hover);
    }

    .info-section-title {
        color: var(--ult-navy-dark);
        font-weight: 800;
        font-size: 1.05rem;
        margin-bottom: 20px;
        letter-spacing: -0.2px;
        display: flex;
        align-items: center;
    }

    .info-section-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: rgba(43, 57, 144, 0.08);
        color: var(--ult-navy);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        font-size: 1rem;
    }

    /* =========================
       3D INTERACTIVE ITEM BOX & READONLY
    ========================= */
    .info-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        padding: 16px 18px;
        height: 100%;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
    }

    .info-item:hover {
        background: #ffffff;
        border-color: var(--ult-navy);
        box-shadow: 0 10px 25px rgba(43, 57, 144, 0.08);
        transform: translateY(-3px);
    }

    .info-label {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 6px;
    }

    .info-label i {
        color: var(--ult-navy);
    }

    .info-value {
        display: block;
        color: #0f172a;
        font-weight: 700;
        font-size: 0.98rem;
        word-break: break-word;
    }

    .btn-copy-ticket {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #475569;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-copy-ticket:hover {
        background: var(--ult-orange);
        border-color: var(--ult-orange);
        color: #ffffff;
        transform: scale(1.08);
    }

    .description-box {
        background: linear-gradient(145deg, #f8fafc 0%, #f1f5f9 100%);
        border-left: 5px solid var(--ult-navy);
        border-radius: 14px;
        padding: 20px;
        color: #334155;
        line-height: 1.7;
        font-weight: 500;
        font-size: 0.96rem;
    }

    /* =========================
       FORM INPUTS & CONTAINERS
    ========================= */
    .disposisi-form-container {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 24px;
        transition: all 0.3s ease;
    }

    .disposisi-form-container:focus-within {
        border-color: var(--ult-navy);
        background: #ffffff;
        box-shadow: 0 10px 25px rgba(43, 57, 144, 0.08);
    }

    .custom-select-ultra, .custom-input-ultra {
        min-height: 48px;
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        font-weight: 600;
        font-size: 0.95rem;
        color: #0f172a;
        padding: 10px 16px;
        transition: all 0.25s ease;
        background-color: #fff;
    }

    .custom-select-ultra:focus, .custom-input-ultra:focus {
        border-color: var(--ult-navy);
        box-shadow: 0 0 0 4px rgba(43, 57, 144, 0.15);
        outline: none;
    }

    /* Buttons */
    .btn-detail-back {
        background: rgba(255, 255, 255, 0.15) !important;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        color: #ffffff !important;
        border-radius: 12px;
        font-weight: 700;
        padding: 10px 20px;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
    }

    .btn-detail-back:hover {
        background: #ffffff !important;
        color: #2b3990 !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-action-back {
        background-color: #ffffff;
        color: #475569;
        font-weight: 700;
        border-radius: 12px;
        padding: 12px 24px;
        border: 1px solid #cbd5e1;
        transition: all 0.25s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .btn-action-back:hover {
        background-color: #f1f5f9;
        color: #0f172a;
        transform: translateY(-2px);
    }

    .btn-action-submit {
        font-weight: 800;
        border-radius: 12px;
        padding: 12px 28px;
        border: none;
        transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-action-submit:hover {
        transform: translateY(-2px) scale(1.02);
    }

    /* =========================
       TOAST FLOATING NOTIFICATION
    ========================= */
    #ultToast {
        position: fixed;
        bottom: 25px;
        right: 25px;
        background: #0f172a;
        color: #ffffff;
        padding: 12px 22px;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.88rem;
        font-weight: 600;
        z-index: 9999;
        opacity: 0;
        transform: translateY(20px) scale(0.95);
        pointer-events: none;
        transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    #ultToast.show {
        opacity: 1;
        transform: translateY(0) scale(1);
        pointer-events: auto;
    }

    /* Page Entrance Animation */
    .detail-animate {
        opacity: 0;
        transform: translateY(18px);
    }

    .detail-animate.show {
        opacity: 1;
        transform: translateY(0);
        transition: opacity 0.5s cubic-bezier(0.165, 0.84, 0.44, 1), transform 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
</style>

<div class="container-fluid px-4 py-4">

    <!-- HEADER PAGE -->
    <div class="header-gradient-card d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 detail-animate">
        <div class="mb-3 mb-md-0">
            <h1 class="detail-page-title mb-1">
                <i class="fas fa-shield-halved me-2 text-warning"></i>Verifikasi Tiket
            </h1>
            <p class="detail-page-subtitle mb-0">
                Lakukan pemeriksaan data permohonan sebelum tiket diproses ke tahap selanjutnya.
            </p>
        </div>
        <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-detail-back align-self-start align-self-md-auto">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
        </a>
    </div>

    <!-- 4 SUMMARY CARDS -->
    <div class="row g-3 mb-4 detail-animate">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-navy p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between w-100 me-2" style="min-width: 0;">
                    <div style="min-width: 0;" class="me-2">
                        <span class="text-white-50 text-uppercase fw-bold stat-title">Status Tiket</span>
                        <div class="stat-value text-white" title="<?= esc($tiket['status'] ?? 'Submitted') ?>">
                            <?= esc($tiket['status'] ?? 'Submitted') ?>
                        </div>
                    </div>
                    <div class="icon-tamu-circle text-white ms-auto">
                        <i class="fas fa-ticket-alt"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-green p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between w-100 me-2" style="min-width: 0;">
                    <div style="min-width: 0;" class="me-2">
                        <span class="text-white-50 text-uppercase fw-bold stat-title">Prioritas</span>
                        <div class="stat-value text-white" title="<?= strtoupper(esc($tiket['prioritas'] ?? 'NORMAL')) ?>">
                            <?= strtoupper(esc($tiket['prioritas'] ?? 'NORMAL')) ?>
                        </div>
                    </div>
                    <div class="icon-tamu-circle text-white ms-auto">
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-orange p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between w-100 me-2" style="min-width: 0;">
                    <div style="min-width: 0;" class="me-2">
                        <span class="text-white-50 text-uppercase fw-bold stat-title">Layanan</span>
                        <div class="stat-value text-white" title="<?= esc($tiket['layanan'] ?? 'Layanan Surat') ?>">
                            <?= esc($tiket['layanan'] ?? 'Layanan Surat') ?>
                        </div>
                    </div>
                    <div class="icon-tamu-circle text-white ms-auto">
                        <i class="fas fa-concierge-bell"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-yellow p-3 shadow-sm">
                <div class="d-flex align-items-center justify-content-between w-100 me-2" style="min-width: 0;">
                    <div style="min-width: 0;" class="me-2">
                        <span class="text-white-50 text-uppercase fw-bold stat-title">Unit Tujuan</span>
                        <div class="stat-value text-white" title="<?= esc($tiket['unit_tujuan'] ?? '-') ?>">
                            <?= esc($tiket['unit_tujuan'] ?? '-') ?>
                        </div>
                    </div>
                    <div class="icon-tamu-circle text-white ms-auto">
                        <i class="fas fa-building"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- INFORMASI PERMOHONAN CARD -->
    <div class="card detail-main-card mb-4 detail-animate">
        <div class="card-body p-4">
            <h6 class="info-section-title">
                <span class="info-section-icon"><i class="fas fa-info-circle"></i></span>
                Informasi Permohonan
            </h6>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-hashtag"></i> Nomor Tiket</span>
                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <span id="ticketNumber" class="info-value text-primary fw-bold">
                                    <?= esc($tiket['nomor_tiket'] ?? '-') ?>
                                </span>
                                <button type="button" class="btn-copy-ticket" id="copyTicketBtn" onclick="copyTiket('<?= esc($tiket['nomor_tiket'] ?? '-') ?>')" title="Salin No. Tiket">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-user"></i> Nama Pemohon</span>
                            <span class="info-value mt-1"><?= esc($tiket['nama_pemohon'] ?? '-') ?></span>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-id-card"></i> NIM</span>
                                <span class="info-value mt-1"><?= esc($tiket['nim'] ?? '-') ?></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-address-card"></i> NIK</span>
                                <span class="info-value mt-1"><?= esc($tiket['nik'] ?? '-') ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-envelope"></i> Email</span>
                                <span class="info-value mt-1 text-truncate"><?= esc($tiket['email'] ?? '-') ?></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-item">
                                <span class="info-label"><i class="fab fa-whatsapp"></i> No. HP</span>
                                <span class="info-value mt-1"><?= esc($tiket['no_hp'] ?? '-') ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="info-item">
                            <span class="info-label"><i class="fas fa-concierge-bell"></i> Layanan</span>
                            <span class="info-value mt-1"><?= esc($tiket['layanan'] ?? '-') ?></span>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-flag"></i> Prioritas</span>
                                <span class="info-value mt-1 text-uppercase text-primary"><?= esc($tiket['prioritas'] ?? 'normal') ?></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-building"></i> Unit Tujuan</span>
                                <span class="info-value mt-1"><?= esc($tiket['unit_tujuan'] ?? '-') ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <div class="info-item">
                                <span class="info-label"><i class="fas fa-signal"></i> Status</span>
                                <span class="info-value mt-1 text-info fw-bold"><?= esc($tiket['status'] ?? 'Submitted') ?></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-item">
                                <span class="info-label"><i class="far fa-calendar-alt"></i> Tanggal Pengajuan</span>
                                <span class="info-value mt-1"><?= esc($tiket['tanggal'] ?? '-') ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="info-item">
                            <span class="info-label"><i class="far fa-clock"></i> Dibuat</span>
                            <span class="info-value mt-1"><?= esc($tiket['created_at'] ?? '-') ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4" style="border-color: #e2e8f0;">

            <div class="mb-3">
                <div class="info-item">
                    <span class="info-label"><i class="fas fa-heading"></i> Judul Permohonan</span>
                    <span class="info-value mt-1 fs-6"><?= esc($tiket['judul_permohonan'] ?? '-') ?></span>
                </div>
            </div>

            <div>
                <div class="description-box">
                    <div class="info-label text-dark fw-bold mb-2">
                        <i class="fas fa-quote-left text-primary"></i> Deskripsi Permohonan
                    </div>
                    <div>
                        <?= nl2br(esc($tiket['deskripsi'] ?? '-')) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RIWAYAT PROSES VERIFIKASI -->
    <div class="card detail-main-card mb-4 detail-animate">
        <div class="card-body p-4">
            <h6 class="info-section-title">
                <span class="info-section-icon"><i class="fas fa-history"></i></span>
                Riwayat Proses Verifikasi
            </h6>
            <?php if (empty($riwayat)): ?>
                <div class="alert alert-info border-0 rounded-3 mb-0" role="alert" style="background-color: #e0f2fe; color: #0369a1;">
                    <i class="fas fa-info-circle me-1"></i> Belum ada riwayat proses untuk tiket ini.
                </div>
            <?php else: ?>
                <ul class="list-group list-group-flush border rounded-3 overflow-hidden">
                    <?php foreach ($riwayat as $r): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <div>
                                <strong class="text-primary"><?= esc($r['status']) ?></strong> &mdash; <span><?= esc($r['catatan']) ?></span>
                            </div>
                            <small class="text-muted"><i class="far fa-clock me-1"></i><?= esc($r['created_at']) ?></small>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <!-- FORM VERIFIKASI TIKET DINAMIS -->
    <div class="card detail-main-card mb-4 detail-animate">
        <div class="card-body p-4">
            <h6 class="info-section-title">
                <span class="info-section-icon"><i class="fas fa-user-check"></i></span>
                Form Verifikasi Tiket
            </h6>
            <form id="verificationForm" action="<?= base_url('petugas/simpanVerifikasi/' . ($tiket['id'] ?? '')) ?>" method="POST">
                <?= csrf_field() ?>

                <div class="mb-4">
                    <label class="info-label text-primary" style="font-size: 0.82rem;">
                        <i class="fas fa-tasks"></i> Tentukan Hasil Verifikasi <span class="text-danger">*</span>
                    </label>
                    <select name="hasil_verifikasi" id="hasilVerifikasi" class="form-select custom-select-ultra shadow-sm" required>
                        <option value="" selected disabled>-- Pilih Hasil Verifikasi --</option>
                        <option value="verify">Verify / Verifikasi</option>
                        <option value="revision">Need Revision / Perlu Revisi</option>
                        <option value="reject">Reject / Tolak</option>
                    </select>
                </div>

                <div class="disposisi-form-container mb-4">
                    <!-- FIELD DINAMIS: VERIFY -->
                    <div id="sectionVerify" class="d-none">
                        <div class="mb-3">
                            <label class="info-label"><i class="fas fa-flag text-danger"></i> Tentukan Prioritas</label>
                            <select name="prioritas" class="form-select custom-select-ultra">
                                <option value="" selected disabled>-- Pilih Prioritas --</option>
                                <option value="Low">Low</option>
                                <option value="Medium">Medium</option>
                                <option value="High">High</option>
                                <option value="Urgent">Urgent</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="info-label"><i class="fas fa-building text-primary"></i> Unit Tujuan</label>
                            <input type="text" class="form-control custom-input-ultra bg-light" value="<?= esc($tiket['unit_tujuan'] ?? '-') ?>" readonly>
                            <small class="text-muted d-block mt-1"><i class="fas fa-info-circle text-primary"></i> Unit tujuan otomatis mengikuti unit yang dipilih saat pengajuan tiket.</small>
                        </div>

                        <div class="mb-0">
                            <label class="info-label"><i class="fas fa-comment-alt text-secondary"></i> Catatan Verifikasi</label>
                            <textarea name="catatan_verifikasi" class="form-control custom-input-ultra" rows="3" placeholder="Tuliskan hasil pemeriksaan dokumen..."></textarea>
                        </div>
                    </div>

                    <!-- FIELD DINAMIS: REVISION -->
                    <div id="sectionRevision" class="d-none">
                        <div class="mb-0">
                            <label class="info-label text-warning"><i class="fas fa-edit"></i> Alasan Revisi</label>
                            <textarea name="alasan_revisi" class="form-control custom-input-ultra" rows="3" placeholder="Tuliskan alasan mengapa tiket perlu diperbaiki..."></textarea>
                        </div>
                    </div>

                    <!-- FIELD DINAMIS: REJECT -->
                    <div id="sectionReject" class="d-none">
                        <div class="mb-0">
                            <label class="info-label text-danger"><i class="fas fa-times-circle"></i> Alasan Penolakan</label>
                            <textarea name="alasan_penolakan" class="form-control custom-input-ultra" rows="3" placeholder="Tuliskan alasan penolakan tiket..."></textarea>
                        </div>
                    </div>

                    <!-- ALERT INFORMASI STATUS -->
                    <div id="alertBox" class="alert alert-secondary border-0 mb-0 mt-3" role="alert">
                        <span id="alertText"><i class="fas fa-info-circle me-1"></i> Silakan pilih hasil verifikasi terlebih dahulu.</span>
                    </div>
                </div>

                <!-- TOMBOL AKSI -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-action-back">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    
                    <button type="submit" id="btnSubmitForm" class="btn btn-action-submit d-none">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- TOAST CONTAINER -->
<div id="ultToast">
    <i class="fas fa-check-circle text-success fs-5"></i>
    <span id="ultToastMessage">Nomor Tiket Berhasil Disalin!</span>
</div>

<!-- JAVASCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    
    /* 1. STAGGERED ENTRANCE ANIMATION */
    const animatedElements = document.querySelectorAll('.detail-animate');
    animatedElements.forEach(function (element, index) {
        setTimeout(function () {
            element.classList.add('show');
        }, index * 90);
    });

    /* 2. TOAST NOTIFICATION & COPY FUNCTIONALITY */
    const toast = document.getElementById('ultToast');
    const toastMsg = document.getElementById('ultToastMessage');

    function showToast(message) {
        if (!toast || !toastMsg) return;
        toastMsg.textContent = message;
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2500);
    }

    window.copyTiket = function(text) {
        if (!text || text === '-') return;
        if (navigator.clipboard) {
            navigator.clipboard.writeText(text).then(function () {
                showToast('Nomor Tiket "' + text + '" Berhasil Disalin!');
                
                const copyBtn = document.getElementById('copyTicketBtn');
                if (copyBtn) {
                    copyBtn.innerHTML = '<i class="fas fa-check text-success"></i>';
                    setTimeout(() => {
                        copyBtn.innerHTML = '<i class="fas fa-copy"></i>';
                    }, 1800);
                }
            });
        }
    };

    /* 3. INTERACTIVE CARD 3D TILT EFFECT */
    const cards = document.querySelectorAll('.info-item');
    cards.forEach(card => {
        card.addEventListener('mousemove', function(e) {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            card.style.transform = `perspective(1000px) rotateX(${-y / 20}deg) rotateY(${x / 20}deg) translateY(-3px)`;
        });

        card.addEventListener('mouseleave', function() {
            card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px)';
        });
    });

    /* 4. VERIFICATION FORM INTERACTION LOGIC */
    const hasilSelect = document.getElementById('hasilVerifikasi');
    const secVerify = document.getElementById('sectionVerify');
    const secRevision = document.getElementById('sectionRevision');
    const secReject = document.getElementById('sectionReject');
    const alertBox = document.getElementById('alertBox');
    const alertText = document.getElementById('alertText');
    const btnSubmit = document.getElementById('btnSubmitForm');

    if (hasilSelect) {
        hasilSelect.addEventListener('change', function () {
            const val = this.value;

            secVerify.classList.add('d-none');
            secRevision.classList.add('d-none');
            secReject.classList.add('d-none');
            btnSubmit.classList.remove('d-none');

            alertBox.className = 'alert border-0 mb-0 mt-3';

            if (val === 'verify') {
                secVerify.classList.remove('d-none');
                alertBox.classList.add('alert-success');
                alertBox.style.backgroundColor = '#d1fae5';
                alertBox.style.color = '#065f46';
                alertText.innerHTML = '<i class="fas fa-check-circle me-1"></i> Tiket akan diverifikasi dan dilanjutkan ke tahap disposisi.';
                btnSubmit.className = 'btn btn-action-submit text-white';
                btnSubmit.style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
                btnSubmit.style.boxShadow = '0 6px 18px rgba(16, 185, 129, 0.3)';
                btnSubmit.innerHTML = '<i class="fas fa-check me-1"></i> Verify';
            } else if (val === 'revision') {
                secRevision.classList.remove('d-none');
                alertBox.classList.add('alert-warning');
                alertBox.style.backgroundColor = '#fef3c7';
                alertBox.style.color = '#92400e';
                alertText.innerHTML = '<i class="fas fa-edit me-1"></i> Tiket akan dikembalikan kepada pemohon untuk diperbaiki.';
                btnSubmit.className = 'btn btn-action-submit text-white';
                btnSubmit.style.background = 'linear-gradient(135deg, #f59e0b 0%, #d97706 100%)';
                btnSubmit.style.boxShadow = '0 6px 18px rgba(245, 158, 11, 0.3)';
                btnSubmit.innerHTML = '<i class="fas fa-edit me-1"></i> Need Revision';
            } else if (val === 'reject') {
                secReject.classList.remove('d-none');
                alertBox.classList.add('alert-danger');
                alertBox.style.backgroundColor = '#fee2e2';
                alertBox.style.color = '#991b1b';
                alertText.innerHTML = '<i class="fas fa-times-circle me-1"></i> Tiket akan ditolak dan tidak dilanjutkan ke proses berikutnya.';
                btnSubmit.className = 'btn btn-action-submit text-white';
                btnSubmit.style.background = 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)';
                btnSubmit.style.boxShadow = '0 6px 18px rgba(239, 68, 68, 0.3)';
                btnSubmit.innerHTML = '<i class="fas fa-times me-1"></i> Reject';
            } else {
                alertBox.classList.add('alert-secondary');
                alertText.innerHTML = '<i class="fas fa-info-circle me-1"></i> Silakan pilih hasil verifikasi terlebih dahulu.';
                btnSubmit.classList.add('d-none');
            }
        });
    }
});
</script>

<?= $this->endSection() ?>