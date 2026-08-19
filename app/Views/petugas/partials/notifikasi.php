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

<!-- Custom CSS Notifikasi Ultra Professional & Interactive Level Dewa -->
<style>
/* Reset & Base Dropdown Animation dengan Efek Kaca Premium (Glassmorphism Pro Max) */
.dropdown-notifications .dropdown-menu {
    width: 400px;
    border-radius: 20px !important;
    border: 1px solid rgba(255, 255, 255, 0.4) !important;
    background: rgba(255, 255, 255, 0.98) !important;
    backdrop-filter: blur(20px) saturate(200%);
    -webkit-backdrop-filter: blur(20px) saturate(200%);
    box-shadow: 0 25px 50px -12px rgba(26, 35, 126, 0.35), 0 0 30px rgba(79, 70, 229, 0.1) !important;
    transform-origin: top right;
    animation: notifScaleIn 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    overflow: hidden;
}

@keyframes notifScaleIn {
    0% {
        opacity: 0;
        transform: scale(0.8) translateY(-16px);
    }
    100% {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}

/* Bell Icon & Hover Physics level dewa */
.notif-bell-wrapper {
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 14px;
    background: linear-gradient(135deg, rgba(26, 35, 126, 0.08) 0%, rgba(79, 70, 229, 0.12) 100%);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.6);
}

.dropdown-notifications:hover .notif-bell-wrapper {
    background: linear-gradient(135deg, rgba(26, 35, 126, 0.15) 0%, rgba(79, 70, 229, 0.22) 100%);
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 8px 20px rgba(26, 35, 126, 0.2), inset 0 1px 1px rgba(255, 255, 255, 0.9);
}

.notif-bell-icon {
    color: #1a237e;
    font-size: 1.35rem;
    transition: transform 0.4s ease;
}

.dropdown-notifications:hover .notif-bell-icon {
    animation: bellJingle 0.8s ease-in-out infinite alternate;
}

@keyframes bellJingle {
    0% { transform: rotate(0deg); }
    20% { transform: rotate(18deg); }
    40% { transform: rotate(-18deg); }
    60% { transform: rotate(12deg); }
    80% { transform: rotate(-6deg); }
    100% { transform: rotate(0deg); }
}

/* Glowing Pulse & Animated Badge Super Estetik */
.bell-pulse-ring {
    position: absolute;
    top: 5px;
    right: 5px;
    width: 10px;
    height: 10px;
    background-color: #ff3547;
    border-radius: 50%;
    z-index: 1;
}

.bell-pulse-ring::after {
    content: '';
    position: absolute;
    top: -4px;
    left: -4px;
    right: -4px;
    bottom: -4px;
    border: 2px solid #ff3547;
    border-radius: 50%;
    animation: pulseRing 1.5s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
}

@keyframes pulseRing {
    0% { transform: scale(0.4); opacity: 0.9; }
    80% { transform: scale(2.2); opacity: 0; }
    100% { transform: scale(2.6); opacity: 0; }
}

.notif-badge-count {
    font-size: 0.68rem;
    font-weight: 900;
    padding: 0.3em 0.6em;
    background: linear-gradient(135deg, #ff3547 0%, #ff6b6b 50%, #c82333 100%);
    box-shadow: 0 4px 15px rgba(255, 53, 71, 0.5);
    border: 2px solid #ffffff;
    border-radius: 50rem;
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.dropdown-notifications:hover .notif-badge-count {
    transform: scale(1.2) rotate(8deg);
}

/* Premium Header Gradient Cyber/Deep Blue Level Dewa */
.notif-header {
    background: linear-gradient(135deg, #090d38 0%, #1a237e 50%, #3949ab 100%);
    padding: 18px 22px;
    position: relative;
    overflow: hidden;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

.notif-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 65%);
    pointer-events: none;
    animation: headerGlowPulse 6s ease-in-out infinite alternate;
}

@keyframes headerGlowPulse {
    0% { transform: translate(-10px, -10px); }
    100% { transform: translate(10px, 10px); }
}

/* Filter Tab Pills Interaktif Modern */
.notif-filter-btn {
    font-size: 0.75rem;
    font-weight: 700;
    padding: 5px 14px;
    border-radius: 25px;
    background: rgba(255, 255, 255, 0.12);
    color: rgba(255, 255, 255, 0.9);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    outline: none !important;
}

.notif-filter-btn:hover {
    background: rgba(255, 255, 255, 0.28);
    color: #ffffff;
    transform: translateY(-1px);
}

.notif-filter-btn.active {
    background: #ffffff;
    color: #1a237e;
    font-weight: 800;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    border-color: #ffffff;
}

/* Mark Read Action Button Elegan */
.btn-mark-read {
    font-size: 0.75rem;
    font-weight: 700;
    color: #ffffff;
    background: rgba(255, 255, 255, 0.15);
    padding: 5px 12px;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(5px);
}

.btn-mark-read:hover {
    background: rgba(255, 255, 255, 0.3);
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Notification Items & Micro-interactions Kelas Berat */
.notif-item {
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    border-left: 5px solid transparent;
    text-decoration: none !important;
    position: relative;
    background: #ffffff;
    border-bottom: 1px solid rgba(0, 0, 0, 0.04);
}

.notif-item.unread {
    background: linear-gradient(90deg, rgba(26, 35, 126, 0.05) 0%, rgba(255, 255, 255, 1) 100%);
    border-left-color: #1a237e;
}

.notif-item:hover {
    background-color: rgba(26, 35, 126, 0.08) !important;
    transform: translateX(6px);
    box-shadow: 0 4px 15px rgba(26, 35, 126, 0.06);
}

.notif-avatar {
    width: 46px;
    height: 46px;
    border-radius: 14px;
    background: linear-gradient(135deg, #1a237e 0%, #4f46e5 100%);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 1rem;
    flex-shrink: 0;
    box-shadow: 0 6px 15px rgba(26, 35, 126, 0.3);
    transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.notif-item:hover .notif-avatar {
    transform: scale(1.12) rotate(-5deg);
}

.notif-badge-ticket {
    background: linear-gradient(135deg, rgba(26, 35, 126, 0.08) 0%, rgba(79, 70, 229, 0.12) 100%);
    color: #1a237e;
    font-weight: 800;
    font-size: 0.72rem;
    padding: 4px 10px;
    border-radius: 8px;
    border: 1px solid rgba(26, 35, 126, 0.15);
    box-shadow: 0 2px 5px rgba(0,0,0,0.02);
}

.notif-time {
    font-size: 0.72rem;
    color: #64748b;
    font-weight: 600;
}

.notif-indicator-dot {
    width: 9px;
    height: 9px;
    background: linear-gradient(135deg, #1a237e 0%, #4f46e5 100%);
    border-radius: 50%;
    display: inline-block;
    transition: transform 0.3s ease, opacity 0.3s ease;
    box-shadow: 0 0 8px rgba(26, 35, 126, 0.5);
}

/* Custom Scrollbar Super Halus */
.notif-scroll {
    max-height: 350px;
    overflow-y: auto;
    scroll-behavior: smooth;
}

.notif-scroll::-webkit-scrollbar {
    width: 7px;
}

.notif-scroll::-webkit-scrollbar-track {
    background: #f1f5f9;
}

.notif-scroll::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

.notif-scroll::-webkit-scrollbar-thumb:hover {
    background: #1a237e;
}

/* Empty State Container Estetik */
.notif-empty-state {
    padding: 40px 20px;
    text-align: center;
}

.notif-empty-icon {
    width: 65px;
    height: 65px;
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    font-size: 1.6rem;
    margin-bottom: 14px;
    animation: floatAnim 3.5s ease-in-out infinite;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
}

@keyframes floatAnim {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

/* Footer Accent Berkelas */
.notif-footer {
    background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    transition: all 0.3s ease;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
}

.notif-footer-link {
    color: #1a237e;
    font-weight: 800;
    font-size: 0.85rem;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.notif-footer-link i {
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.notif-footer:hover .notif-footer-link {
    color: #4f46e5;
}

.notif-footer:hover .notif-footer-link i {
    transform: translateX(6px);
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
                <h6 class="font-weight-bold mb-0 text-white d-flex align-items-center" style="font-size: 1rem; letter-spacing: 0.4px;">
                    <i class="fas fa-layer-group mr-2" style="color: #c7d2fe;"></i> Notifikasi Tiket
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
                <span class="badge badge-light text-primary font-weight-bold px-2 py-1" id="notifHeaderCount" style="border-radius: 10px; font-size: 0.75rem; background: #ffffff; color: #1a237e !important; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
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
                                <p class="mb-0 text-dark" style="font-size: 0.85rem; line-height: 1.45;">
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
                    <p class="mb-1 font-weight-bold text-dark" style="font-size: 0.9rem;">Tidak Ada Notifikasi Baru</p>
                    <small class="text-muted d-block" style="font-size: 0.78rem;">Semua tiket masuk saat ini telah ditinjau dengan baik.</small>
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

<!-- Super Interactive Engine JavaScript Level Dewa Mentok -->
<script>
// Web Audio API Sound Generator Pro (Efek Suara Audio Modern Dinamis Tanpa File External)
function playNotificationChime() {
    try {
        const AudioContext = window.AudioContext || window.webkitAudioContext;
        if (!AudioContext) return;
        const ctx = new AudioContext();
        
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        
        osc.type = 'triangle';
        osc.frequency.setValueAtTime(659.25, ctx.currentTime); // E5
        osc.frequency.exponentialRampToValueAtTime(987.77, ctx.currentTime + 0.18); // B5
        
        gain.gain.setValueAtTime(0.2, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.3);
        
        osc.connect(gain);
        gain.connect(ctx.destination);
        
        osc.start();
        osc.stop(ctx.currentTime + 0.3);
    } catch(e) {
        // Fallback jika browser memblokir autoplay audio secara otomatis
    }
}

// Sparkle/Confetti/Particle Effect Premium Level Dewa saat Klik Tandai Dibaca
function triggerSparkles(element) {
    const rect = element.getBoundingClientRect();
    const colors = ['#1a237e', '#4f46e5', '#ff3547', '#3b82f6', '#10b981'];
    for (let i = 0; i < 12; i++) {
        const particle = document.createElement('div');
        particle.style.position = 'fixed';
        particle.style.left = (rect.left + rect.width / 2) + 'px';
        particle.style.top = (rect.top + rect.height / 2) + 'px';
        particle.style.width = (Math.random() * 6 + 4) + 'px';
        particle.style.height = particle.style.width;
        particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
        particle.style.borderRadius = '50%';
        particle.style.pointerEvents = 'none';
        particle.style.zIndex = '99999';
        
        document.body.appendChild(particle);
        
        const destinationX = (Math.random() - 0.5) * 120;
        const destinationY = (Math.random() - 0.5) * 120;
        
        particle.animate([
            { transform: 'translate(0, 0) scale(1)', opacity: 1 },
            { transform: `translate(${destinationX}px, ${destinationY}px) scale(0)`, opacity: 0 }
        ], {
            duration: 800,
            easing: 'cubic-bezier(0,0,0.2,1)'
        }).onfinish = () => particle.remove();
    }
}

// Tandai Satu Notifikasi Dibaca dengan Animasi Smooth Ripple
function markSingleAsRead(item) {
    if (item.classList.contains('unread')) {
        item.classList.remove('unread');
        item.style.background = '#ffffff';
        const dot = item.querySelector('.notif-indicator-dot');
        if (dot) {
            dot.style.transform = 'scale(0)';
            dot.style.opacity = '0';
        }
        
        updateUnreadCounts();
    }
}

// Tandai Semua Notifikasi Dibaca dengan Staggered Wave Efek Keren
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
            if (dot) {
                dot.style.transform = 'scale(0)';
                dot.style.opacity = '0';
            }
        }, idx * 60); // Staggered Animation Delay
    });

    setTimeout(() => {
        updateUnreadCounts(true);
    }, items.length * 60 + 120);
}

// Update State & Counter secara Realtime & Interaktif Dinamis
function updateUnreadCounts(allRead = false) {
    const unreadItems = document.querySelectorAll('.notif-item.unread');
    const count = allRead ? 0 : unreadItems.length;

    const badge = document.getElementById('notifBadgeCount');
    const pulse = document.getElementById('notifPulse');
    const headerCount = document.getElementById('notifHeaderCount');
    const unreadFilterBadge = document.getElementById('unreadFilterBadge');
    const btnMarkRead = document.getElementById('btnMarkAllRead');

    if (count === 0) {
        if (badge) {
            badge.style.transform = 'scale(0)';
            setTimeout(() => badge.style.display = 'none', 250);
        }
        if (pulse) pulse.style.display = 'none';
        if (headerCount) headerCount.innerText = '0 Belum Dibaca';
        if (unreadFilterBadge) unreadFilterBadge.innerText = '(0)';
        if (btnMarkRead) {
            btnMarkRead.style.opacity = '0';
            btnMarkRead.style.transform = 'scale(0.8)';
            setTimeout(() => btnMarkRead.style.display = 'none', 250);
        }
    } else {
        if (badge) badge.innerText = count;
        if (headerCount) headerCount.innerText = count + ' Belum Dibaca';
        if (unreadFilterBadge) unreadFilterBadge.innerText = '(' + count + ')';
    }
}

// Filter Tab Switcher dengan Transisi Halus Level Tinggi
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