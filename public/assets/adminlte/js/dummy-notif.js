// public/assets/js/dummy-notif.js
const globalDummyData = {
    tiketMasuk: 120,     // Angka untuk menu Data Tiket di sidebar
    verifikasi: 95,      // Angka untuk menu Verifikasi Tiket di sidebar & Lonceng Navbar
    disposisi: 20,       // Angka untuk menu Disposisi Tiket di sidebar
    
    // Daftar list pesan notifikasi untuk dropdown lonceng navbar
    listPesan: [
        { id: 1, nomor_tiket: 'ULT-001', nama_pemohon: 'Rafi Putra', layanan: 'Surat Aktif Kuliah', waktu: 'Baru saja' },
        { id: 2, nomor_tiket: 'ULT-002', nama_pemohon: 'Siti Nurhaliza', layanan: 'Legalisir Ijazah', waktu: '5 menit lalu' },
        { id: 3, nomor_tiket: 'ULT-003', nama_pemohon: 'Andi Saputra', layanan: 'Surat Keterangan Lulus', waktu: '1 jam lalu' }
    ]
};

// Fungsi otomatis untuk menyuntikkan data ke Sidebar & Navbar di setiap halaman
document.addEventListener("DOMContentLoaded", function () {
    // 1. Update Badge Sidebar
    const badgeTiket = document.getElementById('sidebar-badge-tiket');
    const badgeVerif = document.getElementById('sidebar-badge-verifikasi');
    const badgeDisposisi = document.getElementById('sidebar-badge-disposisi');

    if (badgeTiket) badgeTiket.innerText = globalDummyData.tiketMasuk;
    if (badgeVerif) badgeVerif.innerText = globalDummyData.verifikasi;
    if (badgeDisposisi) badgeDisposisi.innerText = globalDummyData.disposisi;

    // 2. Update Badge Navbar (Lonceng)
    const navBadgeCount = document.getElementById('notifBadgeCount');
    const headerCount = document.getElementById('notifHeaderCount');
    const unreadFilterBadge = document.getElementById('unreadFilterBadge');
    
    if (navBadgeCount) navBadgeCount.innerText = globalDummyData.verifikasi;
    if (headerCount) headerCount.innerText = globalDummyData.verifikasi + ' Belum Dibaca';
    if (unreadFilterBadge) unreadFilterBadge.innerText = '(' + globalDummyData.verifikasi + ')';
});