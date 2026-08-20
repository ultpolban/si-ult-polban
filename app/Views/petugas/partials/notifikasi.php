<?php
// Ambil jumlah tiket yang berstatus 'Submitted' (menunggu verifikasi) sebagai simulasi notifikasi baru
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
/* Reset & Base Dropdown Animation dengan Efek Kaca Premium */
.dropdown-notifications .dropdown-menu {
    width: 380px !important;
    max-width: 90vw !important;
    border-radius: 16px !important;
    border: 1px solid rgba(255, 255, 255, 0.4) !important;
    background: rgba(255, 255, 255, 0.98) !important;
    backdrop-filter: blur(20px) saturate(200%);
    -webkit-backdrop-filter: blur(20px) saturate(200%);
    box-shadow: 0 20px 40px -10px rgba(26, 35, 126, 0.25) !important;
    transform-origin: top right;
    animation: notifScaleIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    overflow: hidden;
    padding: 0 !important;
    margin-top: 12px !important;
}

@keyframes notifScaleIn {
    0% {
        opacity: 0;
        transform: scale(0.9) translateY(-10px);
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
    background: rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.dropdown-notifications:hover .notif-bell-wrapper,
.dropdown-notifications.show .notif-bell-wrapper {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-1px);
}

.notif-bell-icon {
    color: #ffffff;
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

.dropdown-notifications:hover .notif-bell-icon {
    animation: bellJingle 0.7s ease-in-out infinite alternate;
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
    width: 8px;
    height: 8px;
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
    80% { transform: scale(2); opacity: 0; }
    100% { transform: scale(2.4); opacity: 0; }
}

.notif-badge-count {
    font-size: 0.65rem;
    font-weight: 800;
    padding: 0.25em 0.55em;
    background: #ff3547;
    border: 2px solid #1a237e;
    border-radius: 50rem;
}

/* Premium Header Gradient */
.notif-header {
    background: linear-gradient(135deg, #090d38 0%, #1a237e 100%);
    padding: 16px 20px;
    position: relative;
}

/* Filter Tab Pills */
.notif-filter-btn {
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 20px;
    background: rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.85);
    border: 1px solid rgba(255, 255, 255, 0.15);
    transition: all 0.25s ease;
    cursor: pointer;
}

.notif-filter-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    color: #ffffff;
}

.notif-filter-btn.active {
    background: #ffffff;
    color: #1a237e;
    font-weight: 800;
    border-color: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

/* Mark Read Action Button */
.btn-mark-read {
    font-size: 0.72rem;
    font-weight: 700;
    color: #ffffff;
    background: rgba(255, 255, 255, 0.12);
    padding: 4px 10px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.25s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.btn-mark-read:hover {
    background: rgba(255, 255, 255, 0.25);
    color: #ffffff;
}

/* Notification Items */
.notif-item {
    transition: all 0.25s ease;
    border-left: 4px solid transparent;
    text-decoration: none !important;
    background: #ffffff;
    border-bottom: 1px solid rgba(0, 0, 0, 0.04);
}

.notif-item.unread {
    background: rgba(26, 35, 126, 0.03);
    border-left-color: #1a237e;
}

.notif-item:hover {
    background-color: rgba(26, 35, 126, 0.06) !important;
}

.notif-avatar {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: linear-gradient(135deg, #1a237e 0%, #4f46e5 100%);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 0.9rem;
    flex-shrink: 0;
    box-shadow: 0 4px 10px rgba(26, 35, 126, 0.2);
}

.notif-badge-ticket {
    background: rgba(26, 35, 126, 0.06);
    color: #1a237e;
    font-weight: 700;
    font-size: 0.7rem;
    padding: 3px 8px;
    border-radius: 6px;
    border: 1px solid rgba(26, 35, 126, 0.1);
}

.notif-time {
    font-size: 0.7rem;
    color: #64748b;
    font-weight: 600;
}

.notif-indicator-dot {
    width: 8px;
    height: 8px;
    background: #1a237e;
    border-radius: 50%;
    display: inline-block;
    transition: transform 0.25s ease, opacity 0.25s ease;
}

/* Custom Scrollbar */
.notif-scroll {
    max-height: 320px;
    overflow-y: auto;
    scroll-behavior: smooth;
}

.notif-scroll::-webkit-scrollbar {
    width: 5px;
}

.notif-scroll::-webkit-scrollbar-track {
    background: #f1f5f9;
}

.notif-scroll::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

/* Empty State */
.notif-empty-state {
    padding: 35px 20px;
    text-align: center;
}

.notif-empty-icon {
    width: 55px;
    height: 55px;
    background: #f1f5f9;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    font-size: 1.4rem;
    margin-bottom: 12px;
}

/* Footer Accent */
.notif-footer-link {
    color: #1a237e;
    font-weight: 700;
    font-size: 0.8rem;
    transition: color 0.2s ease;
}

.notif-footer-link:hover {
    color: #4f46e5;
    text-decoration: none;
}
</style>

<!-- Dropdown Notifikasi Navbar -->
<li class="nav-item dropdown dropdown-notifications mx-2">
    <a class="nav-link position-relative px-2 d-flex align-items-center" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Notifikasi Tiket">
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

    <div class="dropdown-menu dropdown-menu-right border-0 py-0 shadow-lg" aria-labelledby="notificationDropdown">
        
        <!-- Header Dropdown -->
        <div class="notif-header text-white">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="font-weight-bold mb-0 text-white d-flex align-items-center" style="font-size: 0.9rem;">
                    <i class="fas fa-bell mr-2" style="color: #c7d2fe;"></i> Notifikasi Tiket
                </h6>
                <?php if ($notifCount > 0): ?>
                    <span class="btn-mark-read" id="btnMarkAllRead" onclick="markAllNotificationsAsRead(event)" title="Tandai semua telah dibaca">
                        <i class="fas fa-check-double mr-1"></i> Dibaca Semua
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
                <span class="badge badge-light text-primary font-weight-bold px-2 py-1" id="notifHeaderCount" style="border-radius: 8px; font-size: 0.7rem; background: #ffffff; color: #1a237e !important;">
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
                       class="list-group-item list-group-item-action p-3 notif-item unread" 
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
                                <p class="mb-0 text-dark" style="font-size: 0.82rem; line-height: 1.4;">
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
                    <p class="mb-1 font-weight-bold text-dark" style="font-size: 0.85rem;">Tidak Ada Notifikasi Baru</p>
                    <small class="text-muted d-block" style="font-size: 0.75rem;">Semua tiket masuk saat ini telah ditinjau.</small>
                </div>
            <?php endif; ?>
        </div>

        <!-- Footer Dropdown -->
        <div class="p-2.5 text-center bg-light border-top">
            <a href="<?= base_url('petugas/tiket') ?>" class="notif-footer-link d-block py-1">
                Lihat Semua Data Tiket <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
</li>

<!-- JavaScript Interaktif -->
<script>
function playNotificationChime() {
    try {
        const AudioContext = window.AudioContext || window.webkitAudioContext;
        if (!AudioContext) return;
        const ctx = new AudioContext();
        const osc = ctx.createOscillator();
        const gain = ctx.createGain();
        
        osc.type = 'triangle';
        osc.frequency.setValueAtTime(659.25, ctx.currentTime);
        osc.frequency.exponentialRampToValueAtTime(987.77, ctx.currentTime + 0.15);
        
        gain.gain.setValueAtTime(0.15, ctx.currentTime);
        gain.gain.exponentialRampToValueAtTime(0.001, ctx.currentTime + 0.25);
        
        osc.connect(gain);
        gain.connect(ctx.destination);
        
        osc.start();
        osc.stop(ctx.currentTime + 0.25);
    } catch(e) {}
}

function markSingleAsRead(item) {
    if (item.classList.contains('unread')) {
        item.classList.remove('unread');
        const dot = item.querySelector('.notif-indicator-dot');
        if (dot) {
            dot.style.transform = 'scale(0)';
            dot.style.opacity = '0';
        }
        updateUnreadCounts();
    }
}

function markAllNotificationsAsRead(e) {
    if (e) e.stopPropagation();
    playNotificationChime();

    const items = document.querySelectorAll('.notif-item.unread');
    items.forEach((item, idx) => {
        setTimeout(() => {
            item.classList.remove('unread');
            const dot = item.querySelector('.notif-indicator-dot');
            if (dot) {
                dot.style.transform = 'scale(0)';
                dot.style.opacity = '0';
            }
        }, idx * 40);
    });

    setTimeout(() => {
        updateUnreadCounts(true);
    }, items.length * 40 + 100);
}

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
            setTimeout(() => badge.style.display = 'none', 200);
        }
        if (pulse) pulse.style.display = 'none';
        if (headerCount) headerCount.innerText = '0 Belum Dibaca';
        if (unreadFilterBadge) unreadFilterBadge.innerText = '(0)';
        if (btnMarkRead) {
            btnMarkRead.style.opacity = '0';
            setTimeout(() => btnMarkRead.style.display = 'none', 200);
        }
    } else {
        if (badge) badge.innerText = count;
        if (headerCount) headerCount.innerText = count + ' Belum Dibaca';
        if (unreadFilterBadge) unreadFilterBadge.innerText = '(' + count + ')';
    }
}

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