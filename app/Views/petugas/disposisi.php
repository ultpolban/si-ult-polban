<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<!-- ASSETS FONTS & ICONS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* =========================================================
       ULT POLBAN - SYSTEM DETAIL & DISPOSISI STYLING
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
       FORM DISPOSISI AREA
    ========================= */
    .disposisi-form-container {
        background: linear-gradient(145deg, #f8fafc 0%, #f1f5f9 100%);
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

    .custom-select-ultra {
        height: 52px;
        border-radius: 12px;
        border: 1px solid #cbd5e1;
        font-weight: 600;
        font-size: 0.95rem;
        color: #1e293b;
        padding-left: 16px;
        transition: all 0.25s ease;
        background-color: #fff;
    }

    .custom-select-ultra:focus {
        border-color: var(--ult-navy);
        box-shadow: 0 0 0 4px rgba(43, 57, 144, 0.15);
        outline: none;
    }

    .btn-action-disposisi {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        font-weight: 800;
        border-radius: 12px;
        padding: 12px 28px;
        border: none;
        box-shadow: 0 6px 18px rgba(16, 185, 129, 0.3);
        transition: all 0.25s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-action-disposisi:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 24px rgba(16, 185, 129, 0.4);
        color: white;
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
                <i class="fas fa-route me-2 text-warning"></i>Disposisi Tiket Permohonan
            </h1>
            <p class="detail-page-subtitle mb-0">
                Tinjau detail permohonan dan teruskan tiket ke unit penanggung jawab terkait
            </p>
        </div>
        <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-detail-back align-self-start align-self-md-auto">
            <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
        </a>
    </div>

    <!-- INFORMASI & LEMBAR DISPOSISI -->
    <div class="card detail-main-card mb-4 detail-animate">
        <div class="card-body p-4">
            <h6 class="info-section-title">
                <span class="info-section-icon"><i class="fas fa-folder-open"></i></span>
                Informasi & Lembar Disposisi Tiket
            </h6>

            <div class="row g-3 mb-3">
                <!-- NOMOR TIKET -->
                <div class="col-md-6 col-lg-4">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-hashtag"></i> Nomor Tiket
                        </span>
                        <div class="d-flex align-items-center justify-content-between mt-1">
                            <span id="ticketNumber" class="info-value ticket-badge-glow">
                                <?= esc($tiket['nomor_tiket'] ?? $tiket['no_tiket'] ?? '-') ?>
                            </span>
                            <button type="button" class="btn-copy-ticket" id="copyTicketBtn" title="Salin Nomor Tiket">
                                <i class="fas fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- STATUS TIKET -->
                <div class="col-md-6 col-lg-4">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-signal"></i> Status Permohonan
                        </span>
                        <div class="mt-1">
                            <?php 
                                $statusVal = strtoupper($tiket['status'] ?? 'VERIFIED');
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

                <!-- JUDUL PERMOHONAN -->
                <div class="col-12">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-heading"></i> Judul / Permohonan Tiket
                        </span>
                        <span class="info-value mt-1 fs-6">
                            <?= esc($tiket['judul'] ?? $tiket['judul_tiket'] ?? $tiket['layanan'] ?? '-') ?>
                        </span>
                    </div>
                </div>

                <!-- LAYANAN KATEGORI -->
                <div class="col-md-6">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="fas fa-concierge-bell"></i> Kategori Layanan
                        </span>
                        <span class="info-value mt-1">
                            <?= esc($tiket['layanan'] ?? '-') ?>
                        </span>
                    </div>
                </div>

                <!-- WAKTU VERIFIKASI -->
                <div class="col-md-6">
                    <div class="info-item">
                        <span class="info-label">
                            <i class="far fa-clock"></i> Waktu Verifikasi Masuk
                        </span>
                        <span class="info-value mt-1">
                            <?= esc($tiket['waktu_verifikasi'] ?? $tiket['updated_at'] ?? date('d-m-Y H:i:s')) ?>
                        </span>
                    </div>
                </div>

                <!-- DESKRIPSI -->
                <div class="col-12">
                    <div class="description-box">
                        <div class="info-label text-dark fw-bold mb-2">
                            <i class="fas fa-quote-left text-primary"></i> Deskripsi Keperluan Pemohon
                        </div>
                        <div>
                            <?= nl2br(esc($tiket['deskripsi'] ?? $tiket['keterangan'] ?? 'Tidak ada deskripsi tambahan.')) ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- FORM DISPOSISI UNIT TUJUAN -->
            <form action="<?= base_url('petugas/disposisi/kirim' . (isset($tiket['id']) ? '/'.$tiket['id'] : '')) ?>" method="POST" id="formKirimDisposisi">
                <?= csrf_field() ?>

                <div class="disposisi-form-container my-4">
                    <div class="row g-3 align-items-center">
                        <div class="col-12">
                            <label class="info-label text-primary" style="font-size: 0.85rem;">
                                <i class="fas fa-paper-plane"></i> Tentukan Unit Tujuan Disposisi <span class="text-danger">*</span>
                            </label>
                            
                            <?php 
                                $selectedUnit = $tiket['unit_tujuan'] ?? $tiket['unit'] ?? $tiket['id_unit'] ?? ''; 
                            ?>

                            <select name="unit_tujuan" id="unit_tujuan" class="form-select custom-select-ultra shadow-sm" required>
                                <option value="" disabled <?= empty($selectedUnit) ? 'selected' : '' ?>>-- Pilih Unit Tujuan Disposisi --</option>
                                <option value="Unit Layanan Terpadu - ULT" <?= ($selectedUnit == 'Unit Layanan Terpadu - ULT' || $selectedUnit == 'ULT') ? 'selected' : '' ?>>🏢 Unit Layanan Terpadu - ULT</option>
                                <option value="Bagian Akademik - AKD" <?= ($selectedUnit == 'Bagian Akademik - AKD' || $selectedUnit == 'Akademik') ? 'selected' : '' ?>>🎓 Bagian Akademik - AKD</option>
                                <option value="Bagian Keuangan - KEU" <?= ($selectedUnit == 'Bagian Keuangan - KEU' || $selectedUnit == 'Keuangan') ? 'selected' : '' ?>>💳 Bagian Keuangan - KEU</option>
                                <option value="Bagian Kemahasiswaan - KEMHS" <?= ($selectedUnit == 'Bagian Kemahasiswaan - KEMHS' || $selectedUnit == 'Kemahasiswaan') ? 'selected' : '' ?>>🏆 Bagian Kemahasiswaan - KEMHS</option>
                                <option value="Perpustakaan - PERPUS" <?= ($selectedUnit == 'Perpustakaan - PERPUS' || $selectedUnit == 'Perpustakaan') ? 'selected' : '' ?>>📚 Perpustakaan - PERPUS</option>
                                <option value="Jurusan - JUR" <?= ($selectedUnit == 'Jurusan - JUR' || $selectedUnit == 'Jurusan') ? 'selected' : '' ?>>🏛️ Jurusan - JUR</option>
                                <option value="UPT Teknologi Informasi dan Komunikasi - UPTIK" <?= ($selectedUnit == 'UPT Teknologi Informasi dan Komunikasi - UPTIK' || $selectedUnit == 'UPTIK') ? 'selected' : '' ?>>💻 UPT Teknologi Informasi dan Komunikasi - UPTIK</option>
                                <option value="Bagian Administrasi Umum - BAUK" <?= ($selectedUnit == 'Bagian Administrasi Umum - BAUK' || $selectedUnit == 'BAUK') ? 'selected' : '' ?>>📑 Bagian Administrasi Umum - BAUK</option>
                                <option value="Administrasi Umum - ADM" <?= ($selectedUnit == 'Administrasi Umum - ADM' || $selectedUnit == 'ADM') ? 'selected' : '' ?>>📁 Administrasi Umum - ADM</option>
                            </select>
                            
                            <div class="d-flex align-items-center gap-2 mt-2 text-muted" style="font-size: 0.83rem;">
                                <i class="fas fa-info-circle text-primary"></i> Tiket akan dialihkan ke antrean kerja unit yang Anda pilih di atas.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between align-items-center mt-4 pt-2">
                    <a href="<?= base_url('petugas/tiket') ?>" class="btn btn-detail-back text-dark" style="background: #e2e8f0 !important; color: #334155 !important; border: none !important;">
                        <i class="fas fa-arrow-left me-2"></i>Kembali Ke Daftar
                    </a>

                    <button type="submit" class="btn btn-action-disposisi" id="btnSubmitDisposisi">
                        <i class="fas fa-paper-plane"></i> Kirim Disposisi Sekarang
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

    /* 4. SUBMIT FORM LOADING STATE */
    const form = document.getElementById('formKirimDisposisi');
    const submitBtn = document.getElementById('btnSubmitDisposisi');

    if(form && submitBtn) {
        form.addEventListener('submit', function() {
            submitBtn.disabled = true;
            submitBtn.innerHTML = `<i class="fas fa-spinner fa-spin me-2"></i> Memproses Disposisi...`;
        });
    }
});
</script>

<?= $this->endSection() ?>