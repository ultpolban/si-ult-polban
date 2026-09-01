<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<!-- ASSETS FONTS & ICONS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* =========================================================
       ULT POLBAN - SYSTEM DETAIL STYLING
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
       HEADER CARD (MATCHING NAVBAR #2b3990)
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

    /* =========================
       ULTRA GLASS CARD & GRID
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
       3D INTERACTIVE ITEM BOX
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

    /* Nomor Tiket Styling */
    .ticket-badge-glow {
        color: var(--ult-navy);
        font-size: 1.1rem;
        font-weight: 800;
        letter-spacing: 0.3px;
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

    /* =========================
       DYNAMIC STATUS BADGE
    ========================= */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 30px;
        padding: 6px 16px;
        font-size: 0.82rem;
        font-weight: 800;
        letter-spacing: 0.3px;
    }

    .pulse-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: currentColor;
        animation: pulseDot 1.6s infinite;
    }

    @keyframes pulseDot {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.3); }
        70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(0, 0, 0, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(0, 0, 0, 0); }
    }

    .status-submitted { background: #fef3c7; color: #b45309; }
    .status-verified  { background: #d1fae5; color: #047857; }
    .status-disposisi { background: #e0f2fe; color: #0369a1; }
    .status-default   { background: #f1f5f9; color: #475569; }

    /* =========================
       DESCRIPTION QUOTE BOX
    ========================= */
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
       TIMELINE
    ========================= */
    .timeline {
        position: relative;
        padding-left: 10px;
    }

    .timeline::before {
        content: "";
        position: absolute;
        left: 27px;
        top: 15px;
        bottom: 15px;
        width: 3px;
        background: #e2e8f0;
        border-radius: 4px;
    }

    .timeline-item {
        position: relative;
        display: flex;
        gap: 18px;
        margin-bottom: 20px;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-icon {
        position: relative;
        z-index: 2;
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 0.9rem;
        box-shadow: 0 0 0 5px #ffffff, 0 4px 10px rgba(0,0,0,0.1);
    }

    .timeline-icon-primary {
        background: var(--ult-navy);
    }

    .timeline-content {
        flex: 1;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 18px;
        transition: all 0.25s ease;
    }

    .timeline-content:hover {
        background: #ffffff;
        border-color: var(--ult-navy);
        box-shadow: 0 6px 18px rgba(0,0,0,0.05);
    }

    .timeline-title {
        margin: 0 0 4px;
        font-size: 0.95rem;
        font-weight: 800;
        color: #0f172a;
    }

    .timeline-date {
        font-size: 0.78rem;
        font-weight: 600;
        color: #64748b;
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

    <!-- HEADER PAGE (SESUAI WARNA NAVBAR #2b3990) -->
    <div class="header-gradient-card d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 detail-animate">
        <div class="mb-3 mb-md-0">
            <h1 class="detail-page-title mb-1">
                <i class="fas fa-ticket-alt me-2 text-warning"></i>Detail Informasi Tiket
            </h1>
            <p class="detail-page-subtitle mb-0">
                Layanan Informasi & Verifikasi Data Permohonan Terpadu POLBAN
            </p>
        </div>
        <!-- TOMBOL KEMBALI DIARAHKAN KE PETUGAS/TIKET (MENGATASI ERROR 404) -->
        <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-detail-back align-self-start align-self-md-auto">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
        </a>
    </div>

    <!-- 1. INFORMASI TIKET -->
    <div class="card detail-main-card mb-4 detail-animate">
        <div class="card-body p-4">
            <h6 class="info-section-title">
                <span class="info-section-icon"><i class="fas fa-folder-open"></i></span>
                Informasi Tiket & Status
            </h6>

            <div class="row g-3">
                <!-- NOMOR TIKET -->
                <div class="col-md-6 col-lg-4">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-hashtag"></i> Nomor Tiket
                        </span>
                        <div class="d-flex align-items-center justify-content-between mt-1">
                            <span id="ticketNumber" class="info-value ticket-badge-glow">
                                <?= esc($tiket['nomor_tiket'] ?? $tiket['ticket_number'] ?? '-') ?>
                            </span>
                            <button type="button" class="btn-copy-ticket" id="copyTicketBtn" title="Salin Nomor Tiket">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- STATUS -->
                <div class="col-md-6 col-lg-4">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-signal"></i> Status Permohonan
                        </span>
                        <div class="mt-1">
                            <?php 
                                $statusVal = strtoupper($tiket['status'] ?? 'SUBMITTED');
                                $statusClass = match ($statusVal) {
                                    'SUBMITTED' => 'status-submitted',
                                    'VERIFIED'  => 'status-verified',
                                    'ASSIGNED', 'DISPOSISI' => 'status-disposisi',
                                    default     => 'status-default',
                                };
                            ?>
                            <span class="status-badge <?= $statusClass ?>">
                                <span class="pulse-dot"></span>
                                <?= esc($statusVal) ?>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- PRIORITAS -->
                <div class="col-md-6 col-lg-4">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-flag"></i> Tingkat Prioritas
                        </span>
                        <span class="info-value mt-1 text-primary">
                            <i class="fas fa-layer-group me-1"></i> <?= esc($tiket['prioritas'] ?? 'Normal') ?>
                        </span>
                    </div>
                </div>

                <!-- LAYANAN -->
                <div class="col-md-6 col-lg-6">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-concierge-bell"></i> Kategori Layanan
                        </span>
                        <span class="info-value mt-1">
                            <?= esc($tiket['layanan'] ?? '-') ?>
                        </span>
                    </div>
                </div>

                <!-- TANGGAL PENGAJUAN -->
                <div class="col-md-6 col-lg-6">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="far fa-calendar-alt"></i> Tanggal & Waktu Pengajuan
                        </span>
                        <span class="info-value mt-1">
                            <?= esc($tiket['created_at'] ?? $tiket['tanggal_pengajuan'] ?? '-') ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. DATA PEMOHON -->
    <div class="card detail-main-card mb-4 detail-animate">
        <div class="card-body p-4">
            <h6 class="info-section-title">
                <span class="info-section-icon"><i class="fas fa-user-shield"></i></span>
                Data Identitas Pemohon
            </h6>

            <div class="row g-3">
                <!-- NAMA PEMOHON -->
                <div class="col-md-6 col-lg-3">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-user"></i> Nama Lengkap
                        </span>
                        <span class="info-value mt-1">
                            <?= esc($tiket['nama_pemohon'] ?? $tiket['nama'] ?? '-') ?>
                        </span>
                    </div>
                </div>

                <!-- NIM / IDENTITAS -->
                <div class="col-md-6 col-lg-3">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-id-card"></i> NIM / Identitas
                        </span>
                        <span class="info-value mt-1">
                            <?= esc($tiket['nim'] ?? '-') ?>
                        </span>
                    </div>
                </div>

                <!-- EMAIL -->
                <div class="col-md-6 col-lg-3">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-envelope"></i> Alamat Email
                        </span>
                        <span class="info-value mt-1 text-truncate">
                            <?= esc($tiket['email'] ?? '-') ?>
                        </span>
                    </div>
                </div>

                <!-- NO HP -->
                <div class="col-md-6 col-lg-3">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fab fa-whatsapp"></i> No. HP / WhatsApp
                        </span>
                        <span class="info-value mt-1">
                            <?= esc($tiket['no_hp'] ?? $tiket['phone'] ?? '-') ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. DETAIL PERMOHONAN -->
    <div class="card detail-main-card mb-4 detail-animate">
        <div class="card-body p-4">
            <h6 class="info-section-title">
                <span class="info-section-icon"><i class="fas fa-file-alt"></i></span>
                Rincian & Keterangan Permohonan
            </h6>

            <div class="row g-3">
                <div class="col-12">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-heading"></i> Judul Permohonan
                        </span>
                        <span class="info-value mt-1 fs-6">
                            <?= esc($tiket['judul_permohonan'] ?? $tiket['layanan'] ?? '-') ?>
                        </span>
                    </div>
                </div>

                <div class="col-12">
                    <div class="description-box">
                        <div class="info-label text-dark fw-bold mb-2">
                            <i class="fas fa-quote-left text-primary"></i> Deskripsi Keperluan
                        </div>
                        <div>
                            <?= nl2br(esc($tiket['keterangan'] ?? $tiket['deskripsi'] ?? 'Tidak ada deskripsi tambahan.')) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. INFORMASI PROSES / TIMELINE -->
    <div class="card detail-main-card mb-4 detail-animate">
        <div class="card-body p-4">
            <h6 class="info-section-title">
                <span class="info-section-icon"><i class="fas fa-history"></i></span>
                Lacak Riwayat Proses
            </h6>

            <div class="timeline mt-3">
                <div class="timeline-item">
                    <div class="timeline-icon timeline-icon-primary">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <div class="timeline-content">
                        <h6 class="timeline-title">Tiket Berhasil Diajukan</h6>
                        <span class="timeline-date">
                            <i class="far fa-clock me-1"></i><?= esc($tiket['created_at'] ?? $tiket['tanggal_pengajuan'] ?? '-') ?>
                        </span>
                    </div>
                </div>
            </div>
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

    /* 2. ADVANCED COPY TO CLIPBOARD WITH TOAST */
    const copyButton = document.getElementById('copyTicketBtn');
    const ticketNumber = document.getElementById('ticketNumber');
    const toast = document.getElementById('ultToast');
    const toastMsg = document.getElementById('ultToastMessage');

    function showToast(message) {
        toastMsg.textContent = message;
        toast.classList.add('show');
        setTimeout(() => {
            toast.classList.remove('show');
        }, 2500);
    }

    if (copyButton && ticketNumber) {
        copyButton.addEventListener('click', function () {
            const textToCopy = ticketNumber.innerText.trim();
            if (navigator.clipboard) {
                navigator.clipboard.writeText(textToCopy).then(function () {
                    showToast('Nomor Tiket "' + textToCopy + '" Berhasil Disalin!');
                    
                    // Button Micro Animation
                    copyButton.innerHTML = '<i class="fas fa-check text-success"></i>';
                    setTimeout(() => {
                        copyButton.innerHTML = '<i class="fas fa-copy"></i>';
                    }, 1800);
                });
            }
        });
    }

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
});
</script>

<?= $this->endSection() ?>