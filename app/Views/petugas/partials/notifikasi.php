<?php
// Ambil jumlah tiket yang berstatus 'Submitted' (menunggu verifikasi) sebagai simulasi notifikasi baru
// Jika menggunakan data dummy yang sudah kita gabungkan, kita bisa hitung langsung atau lewat variabel view.
$notifCount = 0;
$latestNotifs = [];

// Contoh pengecekan data tiket untuk badge notifikasi
if (!empty($tiket_list) && is_array($tiket_list)) {
    foreach ($tiket_list as $t) {
        if (strtolower(trim($t['status'] ?? '')) === 'submitted') {
            $notifCount++;
            if (count($latestNotifs) < 5) { // Ambil 5 notifikasi terbaru
                $latestNotifs[] = $t;
            }
        }
    }
}
?>

<!-- Custom CSS Notifikasi Ultra Professional & Interactive -->
<style>
/* Reset & Base Dropdown Animation */
.dropdown-notifications .dropdown-menu {
    width: 380px;
    border-radius: 16px !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    background: rgba(255, 255, 255, 0.96) !important;
    backdrop-filter: blur(12px) saturate(180%);
    -webkit-backdrop-filter: blur(12px) saturate(180%);
    box-shadow: 0 20px 40px -10px rgba(26, 35, 126, 0.22), 0 0 15px rgba(0, 0, 0, 0.03) !important;
    transform-origin: top right;
    animation: notifScaleIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    overflow: hidden;
}

@keyframes notifScaleIn {
    0% {
        opacity: 0;
        transform: scale(0.85) translateY(-12px);
    }
    100% {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

/* Bell Icon & Hover Physics */
.notif-bell-wrapper {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: rgba(26, 35, 126, 0.05);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.dropdown-notifications:hover .notif-bell-wrapper {
    background: rgba(26, 35, 126, 0.12);
    transform: translateY(-1px);
}

.notif-bell-icon {
    color: #1a237e;
    font-size: 1.25rem;
    transition: transform 0.4s ease;
}

.dropdown-notifications:hover .notif-bell-icon {
    animation: bellJingle 0.8s ease-in-out infinite alternate;
}

@keyframes bellJingle {
    0% { transform: rotate(0deg); }
    20% { transform: rotate(15deg); }
    40% { transform: rotate(-15deg); }
    60% { transform: rotate(10deg); }
    80% { transform: rotate(-5deg); }
    100% { transform: rotate(0deg); }
}

/* Glowing Pulse & Animated Badge */
.bell-pulse-ring {
    position: absolute;
    top: 4px;
    right: 4px;
    width: 10px;
    height: 10px;
    background-color: #ff3547;
    border-radius: 50%;
    z-index: 1;
}

.bell-pulse-ring::after {
    content: '';
    position: absolute;
    top: -3px;
    left: -3px;
    right: -3px;
    bottom: -3px;
    border: 2px solid #ff3547;
    border-radius: 50%;
    animation: pulseRing 1.6s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
}

@keyframes pulseRing {
    0% { transform: scale(0.3); opacity: 0.8; }
    80% { transform: scale(1.8); opacity: 0; }
    100% { transform: scale(2.2); opacity: 0; }
}

.notif-badge-count {
    font-size: 0.65rem;
    font-weight: 800;
    padding: 0.25em 0.55em;
    background: linear-gradient(135deg, #ff3547 0%, #c82333 100%);
    box-shadow: 0 4px 10px rgba(255, 53, 71, 0.4);
    border: 2px solid #ffffff;
    border-radius: 50rem;
    transition: transform 0.3s ease;
}

.dropdown-notifications:hover .notif-badge-count {
    transform: scale(1.15) rotate(5deg);
}

/* Premium Header Gradient */
.notif-header {
    background: linear-gradient(135deg, #0d1259 0%, #1a237e 50%, #283593 100%);
    padding: 16px 20px;
    position: relative;
    overflow: hidden;
}

.notif-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 60%);
    pointer-events: none;
}

/* Filter Tab Pills */
.notif-filter-btn {
    font-size: 0.73rem;
    font-weight: 600;
    padding: 4px 12px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.12);
    color: rgba(255, 255, 255, 0.85);
    border: 1px solid rgba(255, 255, 255, 0.15);
    transition: all 0.25s ease;
    cursor: pointer;
    outline: none !important;
}

.notif-filter-btn:hover {
    background: rgba(255, 255, 255, 0.25);
    color: #ffffff;
}

.notif-filter-btn.active {
    background: #ffffff;
    color: #1a237e;
    font-weight: 700;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    border-color: #ffffff;
}

/* Mark Read Action Button */
.btn-mark-read {
    font-size: 0.72rem;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.9);
    background: rgba(255, 255, 255, 0.1);
    padding: 3px 10px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.2s ease;
    border: 1px solid rgba(255, 255, 255, 0.15);
}

.btn-mark-read:hover {
    background: rgba(255, 255, 255, 0.25);
    color: #ffffff;
    transform: translateY(-1px);
}

/* Notification Items & Micro-interactions */
.notif-item {
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    border-left: 4px solid transparent;
    text-decoration: none !important;
    position: relative;
    background: #ffffff;
}

.notif-item.unread {
    background: linear-gradient(90deg, rgba(26, 35, 126, 0.04) 0%, rgba(255, 255, 255, 1) 100%);
    border-left-color: #1a237e;
}

.notif-item:hover {
    background-color: rgba(26, 35, 126, 0.06) !important;
    transform: translateX(4px);
}

.notif-avatar {
    width: 42px;
    height: 42px;
    border-radius: 12px;
    background: linear-gradient(135deg, #1a237e 0%, #3949ab 100%);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.95rem;
    flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(26, 35, 126, 0.25);
    transition: transform 0.3s ease;
}

.notif-item:hover .notif-avatar {
    transform: scale(1.08) rotate(-3deg);
}

.notif-badge-ticket {
    background-color: rgba(26, 35, 126, 0.08);
    color: #1a237e;
    font-weight: 700;
    font-size: 0.7rem;
    padding: 3px 8px;
    border-radius: 6px;
    border: 1px solid rgba(26, 35, 126, 0.12);
}

.notif-time {
    font-size: 0.7rem;
    color: #8898aa;
    font-weight: 500;
}

.notif-indicator-dot {
    width: 8px;
    height: 8px;
    background-color: #1a237e;
    border-radius: 50%;
    display: inline-block;
    transition: transform 0.2s ease, opacity 0.2s ease;
}

/* Custom Scrollbar */
.notif-scroll {
    max-height: 330px;
    overflow-y: auto;
}

.notif-scroll::-webkit-scrollbar {
    width: 6px;
}

.notif-scroll::-webkit-scrollbar-track {
    background: #f8f9fa;
}

.notif-scroll::-webkit-scrollbar-thumb {
    background: #c5cae9;
    border-radius: 10px;
}

.notif-scroll::-webkit-scrollbar-thumb:hover {
    background: #1a237e;
}

/* Empty State Container */
.notif-empty-state {
    padding: 35px 20px;
    text-align: center;
}

.notif-empty-icon {
    width: 60px;
    height: 60px;
    background: #f4f5fa;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #9fa8da;
    font-size: 1.5rem;
    margin-bottom: 12px;
    animation: floatAnim 3s ease-in-out infinite;
}

@keyframes floatAnim {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-6px); }
}

/* Footer Accent */
.notif-footer {
    background-color: #f8f9fa;
    transition: background-color 0.2s ease;
}

.notif-footer-link {
    color: #1a237e;
    font-weight: 700;
    font-size: 0.8rem;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.notif-footer-link i {
    transition: transform 0.2s ease;
}

.notif-footer:hover .notif-footer-link {
    color: #283593;
}

.notif-footer:hover .notif-footer-link i {
    transform: translateX(4px);
}
</style>

<!-- Dropdown Notifikasi Navbar -->
<li class="nav-item dropdown dropdown-notifications mx-2">
    <a class="nav-link text-dark position-relative px-2 d-flex align-items-center" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Notifikasi Tiket">
        <div class="notif-bell-wrapper">
            <i class="fas fa-bell notif-bell-icon"></i>
            
            <!-- Pulse Effect & Badge Angka Notifikasi -->
            <?php if ($notifCount > 0): ?>
                <span class="bell-pulse-ring" id="notifPulse"></span>
                <span class="position-absolute top-0 start-100 translate-middle badge notif-badge-count text-white" id="notifBadgeCount">
                    <?= $notifCount ?>
                </span>
            <?php endif; ?>
        </div>
    </a>

    <div class="dropdown-menu dropdown-menu-right border-0 py-0 mt-2" aria-labelledby="notificationDropdown">
        
        <!-- Header Dropdown -->
        <div class="notif-header text-white">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="font-weight-bold mb-0 text-white d-flex align-items-center" style="font-size: 0.95rem; letter-spacing: 0.3px;">
                    <i class="fas fa-layer-group mr-2" style="color: #9fa8da;"></i> Notifikasi Tiket
                </h6>
                <?php if ($notifCount > 0): ?>
                    <span class="btn-mark-read" id="btnMarkAllRead" onclick="markAllNotificationsAsRead(event)" title="Tandai semua telah dibaca">
                        <i class="fas fa-check-double mr-1"></i> Dibaca
                    </span>
                <?php endif; ?>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="btn-group">
                    <button type="button" class="notif-filter-btn active mr-1" onclick="filterNotif('all', this, event)">Semua</button>
                    <button type="button" class="notif-filter-btn" onclick="filterNotif('unread', this, event)">
                        Baru <span id="unreadFilterBadge">(<?= $notifCount ?>)</span>
                    </button>
                </div>
                <span class="badge badge-light text-primary font-weight-bold px-2 py-1" id="notifHeaderCount" style="border-radius: 8px; font-size: 0.72rem; background: #ffffff; color: #1a237e !important;">
                    <?= $notifCount ?> Belum Dibaca
                </span>
            </div>
        </div>

        <!-- Daftar List Notifikasi -->
        <div class="list-group list-group-flush notif-scroll" id="notifContainer">
            <?php if (!empty($latestNotifs)): ?>
                <?php foreach ($latestNotifs as $index => $notif): ?>
                    <?php 
                        $namaPemohon = esc($notif['nama_pemohon'] ?? 'Mahasiswa');
                        $inisial = strtoupper(substr($namaPemohon, 0, 1));
                    ?>
                    <a href="<?= base_url('petugas/detail/' . ($notif['id'] ?? 1)) ?>" 
                       class="list-group-item list-group-item-action p-3 border-bottom notif-item unread" 
                       data-index="<?= $index ?>"
                       onclick="markSingleAsRead(this)">
                        <div class="d-flex align-items-start">
                            <div class="notif-avatar mr-3">
                                <?= $inisial ?>
                            </div>
                            <div class="w-100">
                                <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                    <span class="notif-badge-ticket">
                                        <i class="fas fa-ticket-alt mr-1"></i><?= esc($notif['nomor_tiket'] ?? 'ULT-00X') ?>
                                    </span>
                                    <div class="d-flex align-items-center">
                                        <small class="notif-time mr-2">
                                            <i class="far fa-clock mr-1"></i>Baru saja
                                        </small>
                                        <span class="notif-indicator-dot" title="Belum dibaca"></span>
                                    </div>
                                </div>
                                <p class="mb-0 text-dark" style="font-size: 0.83rem; line-height: 1.4;">
                                    <strong><?= $namaPemohon ?></strong> mengajukan 
                                    <span class="text-primary font-weight-semibold"><?= esc($notif['layanan'] ?? 'Layanan') ?></span>
                                </p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="notif-empty-state text-muted" id="emptyNotifState">
                    <div class="notif-empty-icon">
                        <i class="fas fa-bell-slash"></i>
                    </div>
                    <p class="mb-1 font-weight-bold text-dark" style="font-size: 0.88rem;">Tidak Ada Notifikasi Baru</p>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">Semua tiket masuk saat ini telah ditinjau.</small>
                </div>
            <?php endif; ?>
        </div>

        <!-- Footer Dropdown -->
        <div class="p-3 text-center notif-footer border-top">
            <a href="<?= base_url('petugas/tiket') ?>" class="notif-footer-link text-decoration-none w-100">
                Lihat Semua Data Tiket <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</li>

<!-- Super Interactive Engine JavaScript -->
<script>
// Web Audio API Sound Generator (Tanpa File External)
function playNotificationChime() {
    try {
        const AudioContext = window.AudioContext || window.webkitAudioContext;
        if (!AudioContext) return;
        const ctx = new AudioContext();
        
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        
        osc.type = 'sine';
        osc.frequency.setValueAtTime(587.33, ctx.currentTime); // D5
        osc.frequency.exponentialRampToValueAtTime(880, ctx.currentTime + 0.15); // A5
        
        gain.gain.setValueAtTime(0.15, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.25);
        
        osc.connect(gain);
        gain.connect(ctx.destination);
        
        osc.start();
        osc.stop(ctx.currentTime + 0.25);
    } catch(e) {
        // Fallback jika browser memblokir autoplayaudio
    }
}

// Particle Effect/Sparkle saat Klik Tandai Dibaca
function triggerSparkles(element) {
    const rect = element.getBoundingClientRect();
    for (let i = 0; i < 8; i++) {
        const particle = document.createElement('div');
        particle.style.position = 'fixed';
        particle.style.left = (rect.left + rect.width / 2) + 'px';
        particle.style.top = (rect.top + rect.height / 2) + 'px';
        particle.style.width = '6px';
        particle.style.height = '6px';
        particle.style.backgroundColor = '#1a237e';
        particle.style.borderRadius = '50%';
        particle.style.pointerEvents = 'none';
        particle.style.zIndex = '9999';
        
        document.body.appendChild(particle);
        
        const destinationX = (Math.random() - 0.5) * 80;
        const destinationY = (Math.random() - 0.5) * 80;
        
        particle.animate([
            { transform: 'translate(0, 0) scale(1)', opacity: 1 },
            { transform: `translate(${destinationX}px, ${destinationY}px) scale(0)`, opacity: 0 }
        ], {
            duration: 600,
            easing: 'cubic-bezier(0,0,0.2,1)'
        }).onfinish = () => particle.remove();
    }
}

// Tandai Satu Notifikasi Dibaca
function markSingleAsRead(item) {
    if (item.classList.contains('unread')) {
        item.classList.remove('unread');
        item.style.background = '#ffffff';
        const dot = item.querySelector('.notif-indicator-dot');
        if (dot) dot.style.opacity = '0';
        
        updateUnreadCounts();
    }
}

// Tandai Semua Notifikasi Dibaca
function markAllNotificationsAsRead(e) {
    if (e) {
        e.stopPropagation();
        triggerSparkles(e.currentTarget);
    }

    playNotificationChime();

    const items = document.querySelectorAll('.notif-item.unread');
    items.forEach((item, idx) => {
        setTimeout(() => {
            item.classList.remove('unread');
            item.style.background = '#ffffff';
            const dot = item.querySelector('.notif-indicator-dot');
            if (dot) dot.style.opacity = '0';
        }, idx * 50); // Staggered Animation Effect
    });

    setTimeout(() => {
        updateUnreadCounts(true);
    }, items.length * 50 + 100);
}

// Update State & Counter
function updateUnreadCounts(allRead = false) {
    const unreadItems = document.querySelectorAll('.notif-item.unread');
    const count = allRead ? 0 : unreadItems.length;

    const badge = document.getElementById('notifBadgeCount');
    const pulse = document.getElementById('notifPulse');
    const headerCount = document.getElementById('notifHeaderCount');
    const unreadFilterBadge = document.getElementById('unreadFilterBadge');
    const btnMarkRead = document.getElementById('btnMarkAllRead');

    if (count === 0) {
        if (badge) badge.style.transform = 'scale(0)', setTimeout(() => badge.style.display = 'none', 200);
        if (pulse) pulse.style.display = 'none';
        if (headerCount) headerCount.innerText = '0 Belum Dibaca';
        if (unreadFilterBadge) unreadFilterBadge.innerText = '(0)';
        if (btnMarkRead) btnMarkRead.style.opacity = '0', setTimeout(() => btnMarkRead.style.display = 'none', 200);
    } else {
        if (badge) badge.innerText = count;
        if (headerCount) headerCount.innerText = count + ' Belum Dibaca';
        if (unreadFilterBadge) unreadFilterBadge.innerText = '(' + count + ')';
    }
}

// Filter Tab Switcher
function filterNotif(type, btn, e) {
    if (e) e.stopPropagation();

    const buttons = document.querySelectorAll('.notif-filter-btn');
    buttons.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    const items = document.querySelectorAll('.notif-item');
    let visibleCount = 0;

    items.forEach(item => {
        if (type === 'all') {
            item.style.display = 'block';
            visibleCount++;
        } else if (type === 'unread') {
            if (item.classList.contains('unread')) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        }
    });

    const emptyState = document.getElementById('emptyNotifState');
    if (emptyState) {
        emptyState.style.display = (visibleCount === 0) ? 'block' : 'none';
    }
}
</script>