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
    --polban-green: #198754;
    --soft-bg: #f4f6f9;
    --text-dark: #263238;
    --text-muted: #6c757d;
}

body {
    font-family: 'Plus Jakarta Sans', sans-serif !important;
    background: #f4f7fb !important;
    color: #1e293b;
}

.tracking-page {
    padding: 35px 42px;
}

.page-header-title {
    font-size: 30px;
    font-weight: 800;
    color: #18233f;
    letter-spacing: -.5px;
}

.page-header-title i {
    color: #ff9800;
}

.page-subtitle {
    color: #71819b;
    font-size: 14px;
}

/* CARD & SEARCH */
.dashboard-card {
    background: #fff;
    border: 1px solid #e1e8f1;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(25, 48, 90, .06);
}

.search-area {
    padding: 22px;
    border-bottom: 1px solid #e3e9f1;
}

.search-box-wrapper {
    position: relative;
    width: 500px;
    max-width: 100%;
}

.search-box-wrapper .form-control {
    height: 48px;
    border-radius: 12px;
    border: 1px solid #cdd8e7;
    padding-left: 45px;
    padding-right: 45px;
    font-size: 14px;
    transition: .25s ease;
}

.search-box-wrapper .form-control:focus {
    border-color: #293b9b;
    box-shadow: 0 0 0 4px rgba(41,59,155,.10);
}

.search-icon {
    position: absolute;
    left: 17px;
    top: 50%;
    transform: translateY(-50%);
    color: #293b9b;
    z-index: 5;
}

.btn-clear-search {
    position: absolute;
    right: 9px;
    top: 7px;
    width: 34px;
    height: 34px;
    border: 0;
    border-radius: 50%;
    background: #eef2f8;
    color: #293b9b;
    display: none;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: .2s;
}

.btn-clear-search:hover {
    background: #293b9b;
    color: white;
}

.search-result-info {
    color: #6b7b94;
    font-size: 14px;
    font-weight: 600;
}

.search-back-row {
    display: none;
    align-items: center;
    margin-top: 14px;
}

.btn-back-search {
    border: 1px solid #293b9b;
    background: #fff;
    color: #293b9b;
    border-radius: 9px;
    padding: 8px 15px;
    font-size: 13px;
    font-weight: 700;
    transition: .2s;
}

.btn-back-search:hover {
    background: #293b9b;
    color: #fff;
}

/* STYLING TABEL DESAIN DATA TIKET */
.ticket-table {
    margin-bottom: 0;
}

.ticket-table thead {
    background: var(--polban-navy);
}

.ticket-table thead th {
    color: #fff;
    border: 0;
    font-size: .83rem;
    font-weight: 700;
    padding: 14px 12px;
    white-space: nowrap;
}

.ticket-table tbody td {
    padding: 15px 12px;
    vertical-align: middle;
    border-color: #edf0f4;
    font-size: .9rem;
}

.ticket-table tbody tr {
    transition: .2s ease;
}

.ticket-table tbody tr:hover {
    background-color: #f8f9ff;
}

.ticket-copy-btn {
    background: transparent;
    border: none;
    color: var(--polban-blue);
    font-weight: 800;
    cursor: pointer;
    padding: 4px 8px;
    border-radius: 6px;
    transition: all 0.2s ease;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.ticket-copy-btn:hover {
    background: rgba(0, 91, 172, 0.1);
    color: var(--polban-navy);
}

.ticket-copy-btn i {
    font-size: 0.8rem;
    opacity: 0.7;
}

.ticket-name {
    font-weight: 700;
    color: #263238;
}

.ticket-category {
    display: inline-flex;
    align-items: center;
    padding: 6px 10px;
    border-radius: 6px;
    background: #f5f7fa;
    border: 1px solid #dee2e6;
    color: #344054;
    font-size: .76rem;
    font-weight: 700;
}

.ticket-status {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 6px 10px;
    border-radius: 6px;
    font-size: .76rem;
    font-weight: 700;
    white-space: nowrap;
}

.status-verified {
    background: #d1e7dd;
    color: #0f5132;
}

.status-assigned {
    background: #fff3cd;
    color: #856404;
}

.btn-action-view {
    border: 1px solid #cddcff;
    background: #eff4ff;
    color: #293b9b;
    border-radius: 8px;
    padding: 8px 14px;
    font-size: 12px;
    font-weight: 700;
    transition: .25s ease;
}

.btn-action-view:hover {
    background: #293b9b;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(41,59,155,.2);
}

.no-result-row td {
    text-align: center;
    padding: 45px !important;
    color: #8795aa;
}

/* TOAST NOTIFIKASI */
.copy-toast {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: #198754;
    color: #fff;
    padding: 12px 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    font-weight: 600;
    z-index: 10000;
    display: none;
    align-items: center;
    gap: 8px;
}

/* DETAIL HEADER & STYLING */
.detail-header-card {
    background: linear-gradient(135deg, #26388f 0%, #354cac 100%);
    color: #fff;
}

.detail-header-card h5 { font-size: 17px; }

.detail-status {
    font-size: 12px;
    padding: 8px 15px;
    border-radius: 30px;
    font-weight: 800;
}

.detail-status.verified { background: #d9f8eb; color: #087c58; }
.detail-status.assigned { background: #fff0c5; color: #9a6500; }

.info-metric-card {
    height: 100%;
    background: #f8fafc;
    border: 1px solid #e0e7f0;
    border-radius: 13px;
    padding: 18px;
    transition: .25s ease;
}

.info-metric-card:hover {
    background: #fff;
    border-color: #cbd7e8;
    box-shadow: 0 6px 18px rgba(25,48,90,.06);
}

.info-label {
    display: block;
    color: #77869d;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 7px;
}

.info-value {
    color: #27344a;
    font-size: 15px;
    font-weight: 800;
}

/* TIMELINE */
.timeline-wrapper {
    position: relative;
    width: 100%;
    padding: 35px 18px 20px;
    overflow: hidden;
}

.timeline {
    position: relative;
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    width: 100%;
    min-height: 145px;
}

.timeline::before {
    content: "";
    position: absolute;
    left: 10%;
    right: 10%;
    top: 29px;
    height: 6px;
    background: #dfe6ef;
    border-radius: 10px;
    z-index: 1;
}

.timeline::after {
    content: "";
    position: absolute;
    left: 10%;
    width: 40%;
    top: 29px;
    height: 6px;
    background: linear-gradient(90deg, #0dbb83, #10b981);
    border-radius: 10px;
    z-index: 2;
    transition: width .5s ease;
}

.timeline-item {
    position: relative;
    z-index: 5;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    min-width: 0;
}

.timeline-circle {
    width: 58px;
    height: 58px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border: 5px solid #dce4ef;
    color: #95a3b7;
    font-size: 20px;
    box-sizing: border-box;
    position: relative;
    z-index: 10;
    transition: transform .25s ease, box-shadow .25s ease, background .25s ease, border-color .25s ease;
}

.timeline-item.completed .timeline-circle {
    background: #0dbb83;
    border-color: #0dbb83;
    color: #fff;
    box-shadow: 0 5px 16px rgba(13,187,131,.25);
}

.timeline-item.active .timeline-circle {
    background: #ff9800;
    border-color: #ff9800;
    color: #fff;
    box-shadow: 0 0 0 6px rgba(255,152,0,.14), 0 7px 20px rgba(255,152,0,.3);
    transform: scale(1.05);
}

.timeline-item.pending .timeline-circle {
    background: #fff;
    border-color: #dce4ef;
    color: #a0adbd;
}

.timeline-title {
    margin-top: 13px;
    font-size: 14px;
    line-height: 1.3;
    font-weight: 800;
    color: #29364c;
}

.timeline-item.completed .timeline-title { color: #07845b; }
.timeline-item.active .timeline-title { color: #e87900; }

.timeline-desc {
    margin-top: 5px;
    color: #8a99ad;
    font-size: 11px;
    line-height: 1.4;
}

.activity-log-box {
    margin-top: 25px;
    background: #f8fafc;
    border: 1px solid #dfe7f0;
    border-radius: 14px;
    padding: 20px;
}

.activity-title {
    color: #29364c;
    font-weight: 800;
    font-size: 14px;
}

.activity-icon {
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #dff8ec;
    color: #0a9a69;
}

.btn-back-pro {
    border: none;
    background: #293b9b;
    color: #fff;
    border-radius: 10px;
    padding: 10px 18px;
    font-size: 13px;
    font-weight: 700;
    transition: .25s ease;
}

.btn-back-pro:hover {
    background: #1f2f82;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(41,59,155,.2);
}

.view-pane {
    animation: fadeTracking .35s ease;
}

@keyframes fadeTracking {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

@media (max-width: 900px) {
    .tracking-page { padding: 25px 20px; }
    .timeline-wrapper { overflow-x: auto; }
    .timeline { min-width: 720px; }
}

@media (max-width: 576px) {
    .tracking-page { padding: 20px 12px; }
    .page-header-title { font-size: 24px; }
    .timeline { min-width: 650px; }
}
</style>

<div class="tracking-page">

    <!-- HALAMAN UTAMA TRACKING -->
    <div id="viewIndexTracking" class="view-pane">
        <div class="mb-4">
            <h3 class="page-header-title mb-1">
                <i class="fas fa-route me-2"></i>
                Tracking Status Tiket
            </h3>
            <p class="page-subtitle mb-0">
                Daftar permohonan layanan yang telah didisposisikan ke unit untuk dipantau progresnya.
            </p>
        </div>

        <div class="dashboard-card">
            <!-- SEARCH AREA -->
            <div class="search-area">
                <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                    <div class="search-box-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchTrackingInput" class="form-control" placeholder="Cari nomor tiket, nama pemohon, atau layanan..." autocomplete="off">
                        <button type="button" id="btnClearSearch" class="btn-clear-search">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <div class="search-result-info">
                        Total Disposisi:
                        <span id="totalDisposisiBadge" class="badge text-white ms-1 px-3 py-2 rounded-pill" style="background:#293b9b;">
                            6 Tiket
                        </span>
                    </div>
                </div>

                <div id="searchBackRow" class="search-back-row">
                    <button type="button" id="btnBackSearch" class="btn-back-search">
                        <i class="fas fa-arrow-left me-1"></i>
                        Kembali / Tampilkan Semua
                    </button>
                    <span id="searchInfoText" class="ms-3 search-result-info">
                        Menampilkan hasil pencarian
                    </span>
                </div>
            </div>

            <!-- TABLE KUSTOMISASI MODEL DATA TIKET -->
            <div class="table-responsive">
                <table class="table ticket-table align-middle" id="tabelTrackingIndex">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 50px;">No</th>
                            <th>Nomor Tiket</th>
                            <th>Nama Pemohon</th>
                            <th>Layanan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" style="width: 170px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $disposisiData = [
                        ['ULT-20260806074739865', 'Asep', 'Keuangan', 'Verified', 'Bagian Keuangan', 'Dokumen pengajuan anggaran telah diverifikasi lengkap, valid, dan didisposisikan ke Bagian Keuangan.'],
                        ['ULT-20260805023213577', 'Apin', 'Beasiswa', 'Verified', 'Bagian Akademik & Kemahasiswaan', 'Syarat administratif beasiswa memenuhi kriteria dan telah didisposisikan.'],
                        ['ULT-20260730081403481', 'Apin', 'Kemahasiswaan', 'Assigned', 'Bagian Akademik & Kemahasiswaan', 'Tiket telah diverifikasi dan masuk tahap disposisi pimpinan unit kemahasiswaan.'],
                        ['ULT-20260730080403262', 'Ikbal', 'Kemahasiswaan', 'Assigned', 'Subbag Kerjasama & Humas', 'Disposisi tiket diterima unit untuk koordinasi layanan tamu institusi.'],
                        ['ULT-20260730002942605', 'Rizki AM', 'Beasiswa', 'Assigned', 'Bagian Keuangan', 'Verifikasi berkas rekening telah selesai dan didisposisikan ke petugas loket.'],
                        ['ULT-20260730002841489', 'Adit', 'Informasi Akademik', 'Assigned', 'UPT TIK', 'Disposisi penanganan sistem informasi akademik diteruskan ke tim teknis UPT TIK.']
                    ];

                    foreach ($disposisiData as $i => $row):
                    ?>
                        <tr class="tracking-row" data-notiket="<?= esc(strtolower($row[0])) ?>" data-nama="<?= esc(strtolower($row[1])) ?>" data-layanan="<?= esc(strtolower($row[2])) ?>">
                            <td class="text-center fw-bold text-muted"><?= $i + 1 ?></td>
                            <td>
                                <button type="button" class="ticket-copy-btn" onclick="copyTicketNumber('<?= esc($row[0]) ?>')" title="Klik untuk menyalin nomor tiket">
                                    <?= esc($row[0]) ?>
                                    <i class="far fa-copy"></i>
                                </button>
                            </td>
                            <td>
                                <div class="ticket-name"><?= esc($row[1]) ?></div>
                            </td>
                            <td><?= esc($row[2]) ?></td>
                            <td class="text-center">
                                <span class="ticket-status <?= ($row[3] === 'Verified') ? 'status-verified' : 'status-assigned' ?>">
                                    <?= esc($row[3]) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn-action-view btn-lihat-progres" data-notiket="<?= esc($row[0]) ?>" data-nama="<?= esc($row[1]) ?>" data-layanan="<?= esc($row[2]) ?>" data-status="<?= esc($row[3]) ?>" data-unit="<?= esc($row[4]) ?>" data-catatan="<?= esc($row[5]) ?>">
                                    <i class="fas fa-route me-1"></i> Lihat Progres
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                        <tr id="noResultRow" class="no-result-row" style="display:none;">
                            <td colspan="6">
                                <i class="fas fa-search-minus fa-2x mb-3"></i>
                                <div class="fw-bold">Tiket tidak ditemukan</div>
                                <small>Coba gunakan nomor tiket, nama pemohon, atau layanan lain.</small>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- DETAIL TRACKING -->
    <div id="viewDetailTracking" class="view-pane d-none">
        <div class="mb-4">
            <h3 class="page-header-title mb-1">
                <i class="fas fa-chart-line me-2"></i> Tracking Status Tiket
            </h3>
            <p class="page-subtitle mb-0">
                Pantau dan lacak detail tahapan penyelesaian permohonan layanan secara real-time.
            </p>
        </div>

        <div class="dashboard-card mb-4">
            <!-- DETAIL HEADER -->
            <div class="detail-header-card py-3 px-4 d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <i class="fas fa-ticket-alt" style="color:#ffd000;"></i>
                    <h5 class="mb-0 fw-bold">Detail Pelacakan Tiket Layanan</h5>
                </div>
                <span id="detailBadgeStatus" class="detail-status assigned">Assigned</span>
            </div>

            <div class="card-body p-4">
                <!-- INFO ROW 1 -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3 col-sm-6">
                        <div class="info-metric-card">
                            <span class="info-label"><i class="fas fa-hashtag text-primary me-1"></i> Nomor Tiket</span>
                            <strong id="detailNoTiket" class="info-value text-primary font-monospace">-</strong>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="info-metric-card">
                            <span class="info-label"><i class="fas fa-user text-primary me-1"></i> Nama Pemohon</span>
                            <strong id="detailNama" class="info-value">-</strong>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="info-metric-card">
                            <span class="info-label"><i class="fas fa-concierge-bell text-primary me-1"></i> Kategori Layanan</span>
                            <strong id="detailLayanan" class="info-value">-</strong>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="info-metric-card">
                            <span class="info-label"><i class="far fa-calendar-alt text-primary me-1"></i> Tanggal Pengajuan</span>
                            <strong class="info-value">10-08-2026 14:00</strong>
                        </div>
                    </div>
                </div>

                <!-- INFO ROW 2 -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="info-metric-card">
                            <span class="info-label"><i class="fas fa-sitemap text-success me-1"></i> Unit Disposisi Tujuan</span>
                            <strong id="detailUnit" class="info-value">-</strong>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-metric-card">
                            <span class="info-label"><i class="fas fa-clock text-warning me-1"></i> Estimasi Waktu Penanganan</span>
                            <strong class="info-value">1 - 2 Hari Kerja</strong>
                        </div>
                    </div>
                </div>

                <!-- LINIMASA -->
                <div class="pt-3 border-top">
                    <h6 class="fw-bold text-dark mb-0">
                        <i class="fas fa-route me-2" style="color:#ff9800;"></i> Linimasa Tahapan Progres
                    </h6>

                    <div class="timeline-wrapper">
                        <div class="timeline">
                            <div id="step1" class="timeline-item completed">
                                <div class="timeline-circle"><i class="fas fa-paper-plane"></i></div>
                                <div class="timeline-title">Diajukan</div>
                                <div class="timeline-desc">Tiket Dibuat</div>
                            </div>
                            <div id="step2" class="timeline-item completed">
                                <div class="timeline-circle"><i class="fas fa-user-check"></i></div>
                                <div class="timeline-title">Verifikasi</div>
                                <div class="timeline-desc">Cek Berkas</div>
                            </div>
                            <div id="step3" class="timeline-item active">
                                <div class="timeline-circle"><i class="fas fa-share-square"></i></div>
                                <div class="timeline-title">Disposisi</div>
                                <div class="timeline-desc">Diteruskan Unit</div>
                            </div>
                            <div id="step4" class="timeline-item pending">
                                <div class="timeline-circle"><i class="fas fa-cogs"></i></div>
                                <div class="timeline-title">Proses Unit</div>
                                <div class="timeline-desc">Dikerjakan</div>
                            </div>
                            <div id="step5" class="timeline-item pending">
                                <div class="timeline-circle"><i class="fas fa-check-circle"></i></div>
                                <div class="timeline-title">Selesai</div>
                                <div class="timeline-desc">Tuntas</div>
                            </div>
                        </div>
                    </div>

                    <!-- RIWAYAT -->
                    <div class="activity-log-box">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-history text-primary me-2"></i>
                            <strong class="activity-title">Riwayat Aktivitas & Catatan Petugas Unit</strong>
                        </div>
                        <hr>
                        <div class="d-flex align-items-start gap-3">
                            <div class="activity-icon"><i class="fas fa-check"></i></div>
                            <div>
                                <strong class="d-block" style="font-size:14px;">Pembaruan Status Disposisi</strong>
                                <p id="detailCatatan" class="mb-1 text-muted small">-</p>
                                <small class="text-muted"><i class="far fa-clock me-1"></i> 10 Agustus 2026, 14:30 WIB</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <button type="button" id="btnKembaliIndex" class="btn-back-pro">
                <i class="fas fa-arrow-left me-1"></i> Kembali ke Daftar Tracking
            </button>
        </div>
    </div>
</div>

<!-- TOAST NOTIFIKASI COPY -->
<div id="copyToast" class="copy-toast">
    <i class="fas fa-check-circle"></i> Nomor tiket berhasil disalin!
</div>

<script>
function copyTicketNumber(text) {
    navigator.clipboard.writeText(text).then(function() {
        const toast = document.getElementById('copyToast');
        toast.style.display = 'flex';
        setTimeout(() => {
            toast.style.display = 'none';
        }, 2000);
    }).catch(function(err) {
        console.error('Gagal menyalin text: ', err);
    });
}

document.addEventListener('DOMContentLoaded', function () {

    const viewIndex = document.getElementById('viewIndexTracking');
    const viewDetail = document.getElementById('viewDetailTracking');
    const searchInput = document.getElementById('searchTrackingInput');
    const clearButton = document.getElementById('btnClearSearch');
    const backSearchButton = document.getElementById('btnBackSearch');
    const searchBackRow = document.getElementById('searchBackRow');
    const searchInfoText = document.getElementById('searchInfoText');
    const noResultRow = document.getElementById('noResultRow');
    const totalBadge = document.getElementById('totalDisposisiBadge');
    const trackingRows = document.querySelectorAll('.tracking-row');
    const btnKembaliIndex = document.getElementById('btnKembaliIndex');

    const detailNoTiket = document.getElementById('detailNoTiket');
    const detailNama = document.getElementById('detailNama');
    const detailLayanan = document.getElementById('detailLayanan');
    const detailBadgeStatus = document.getElementById('detailBadgeStatus');
    const detailUnit = document.getElementById('detailUnit');
    const detailCatatan = document.getElementById('detailCatatan');

    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');
    const step3 = document.getElementById('step3');
    const step4 = document.getElementById('step4');
    const step5 = document.getElementById('step5');

    function resetTimeline() {
        step1.className = 'timeline-item completed';
        step2.className = 'timeline-item completed';
        step3.className = 'timeline-item active';
        step4.className = 'timeline-item pending';
        step5.className = 'timeline-item pending';
    }

    function setDisposisiStatus(status) {
        resetTimeline();
        if (status === 'Verified') {
            detailBadgeStatus.innerText = 'Verified';
            detailBadgeStatus.className = 'detail-status verified';
        } else {
            detailBadgeStatus.innerText = 'Assigned';
            detailBadgeStatus.className = 'detail-status assigned';
        }
    }

    document.querySelectorAll('.btn-lihat-progres').forEach(function (button) {
        button.addEventListener('click', function () {
            detailNoTiket.innerText = this.dataset.notiket;
            detailNama.innerText = this.dataset.nama;
            detailLayanan.innerText = this.dataset.layanan;
            detailUnit.innerText = this.dataset.unit;
            detailCatatan.innerText = this.dataset.catatan;

            setDisposisiStatus(this.dataset.status);

            viewIndex.classList.add('d-none');
            viewDetail.classList.remove('d-none');

            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    });

    if (btnKembaliIndex) {
        btnKembaliIndex.addEventListener('click', function () {
            viewDetail.classList.add('d-none');
            viewIndex.classList.remove('d-none');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    function performSearch() {
        const keyword = searchInput.value.toLowerCase().trim();
        let visibleCount = 0;

        trackingRows.forEach(function (row) {
            const noTiket = row.dataset.notiket || '';
            const nama = row.dataset.nama || '';
            const layanan = row.dataset.layanan || '';

            const match = noTiket.includes(keyword) || nama.includes(keyword) || layanan.includes(keyword);

            if (match) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        if (noResultRow) noResultRow.style.display = visibleCount === 0 ? '' : 'none';
        if (clearButton) clearButton.style.display = keyword.length > 0 ? 'flex' : 'none';
        if (searchBackRow) searchBackRow.style.display = keyword.length > 0 ? 'flex' : 'none';
        if (totalBadge) totalBadge.innerText = keyword.length > 0 ? visibleCount + ' Tiket' : trackingRows.length + ' Tiket';

        if (searchInfoText) {
            searchInfoText.innerText = keyword.length > 0 
                ? 'Menampilkan ' + visibleCount + ' hasil pencarian' 
                : 'Menampilkan seluruh data tiket';
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', performSearch);
    }

    if (clearButton) {
        clearButton.addEventListener('click', function () {
            searchInput.value = '';
            performSearch();
            searchInput.focus();
        });
    }

    if (backSearchButton) {
        backSearchButton.addEventListener('click', function () {
            searchInput.value = '';
            performSearch();
            searchInput.focus();
        });
    }

    resetTimeline();
});
</script>

<?= $this->endSection() ?>