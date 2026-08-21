<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
:root {
    --polban-navy: #1a237e;
    --polban-blue: #005bac;
    --polban-orange: #ff8c00;
    --polban-yellow: #f4c400;
    --polban-green: #117a43;
    --polban-green-hover: #0b5c31;
    --soft-bg: #f4f6f9;
    --text-dark: #263238;
    --text-muted: #6c757d;
}

/* =========================
   PAGE & GENERAL
========================= */
.log-page {
    animation: pageFadeIn .45s ease;
}

.log-title {
    color: var(--polban-navy);
    font-weight: 800;
    letter-spacing: -.4px;
}

.log-subtitle {
    color: #718096;
    font-size: .95rem;
}

/* =========================
   STATISTIC CARDS
========================= */
.ticket-stat-card {
    position: relative;
    overflow: hidden;
    border: 0;
    border-radius: 14px;
    min-height: 120px;
    color: white;
    transition: all .25s ease;
}

.ticket-stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,.14) !important;
}

.ticket-stat-card::after {
    content: "";
    position: absolute;
    width: 100px;
    height: 100px;
    right: -25px;
    bottom: -35px;
    border-radius: 50%;
    background: rgba(255,255,255,.08);
}

.stat-blue { background: linear-gradient(135deg,#005bac,#006fc9); }
.stat-orange { background: linear-gradient(135deg,#ff8c00,#ff9f1c); }
.stat-yellow { background: linear-gradient(135deg,#f4c400,#f8d323); color: #212529; }
.stat-green { background: linear-gradient(135deg,#198754,#159957); }

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,.22);
    font-size: 1.25rem;
}

.stat-number { font-size: 1.8rem; font-weight: 800; line-height: 1; }
.stat-label { font-size: .74rem; text-transform: uppercase; font-weight: 700; opacity: .85; }

/* =========================
   FILTER BAR MODERN & EXACT STYLING
========================= */
.filter-card {
    background: #ffffff;
    border-radius: 14px;
    padding: 16px 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,.04);
    border: 1px solid #edf0f4;
}

.filter-control {
    border-radius: 8px;
    border: 1px solid #dcdfe6;
    padding: 7px 12px;
    font-size: 0.875rem;
    color: #2d3748;
    transition: all 0.2s ease-in-out;
}

.filter-control:focus {
    border-color: var(--polban-blue);
    box-shadow: 0 0 0 3px rgba(0, 91, 172, 0.15);
    outline: none;
}

.search-input-group {
    position: relative;
}

.search-input-group .search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #0d1b3e;
    font-size: 0.95rem;
    font-weight: bold;
    z-index: 5;
}

.search-input-group input {
    padding-left: 38px;
}

/* Tombol Filter & Reset Presisi */
.btn-polban-filter {
    background-color: #121970;
    color: #ffffff;
    font-weight: 700;
    border-radius: 10px;
    padding: 8px 22px;
    border: none;
    font-size: 0.95rem;
    transition: all 0.2s ease;
}

.btn-polban-filter:hover {
    background-color: #0a0e4a;
    color: #ffffff;
    transform: translateY(-1px);
}

.btn-reset {
    background-color: #64748b;
    color: #ffffff;
    border-radius: 10px;
    padding: 8px 14px;
    border: none;
    font-size: 1.05rem;
    transition: all 0.2s ease;
}

.btn-reset:hover {
    background-color: #475569;
    color: #ffffff;
}

/* Tombol Export Laporan Sesuai Gambar Referensi Baru */
.export-dropdown-wrapper {
    position: relative;
    display: inline-block;
    width: 100%;
}

.btn-export-custom {
    background-color: var(--polban-green);
    color: #ffffff !important;
    border-radius: 12px;
    padding: 6px 16px;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    transition: all 0.2s ease;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(17, 122, 67, 0.2);
    width: 100%;
    text-decoration: none !important;
}

.btn-export-custom:hover, 
.btn-export-custom:focus {
    background-color: var(--polban-green-hover);
    color: #ffffff !important;
}

/* Menghapus panah default bawaan bootstrap */
.btn-export-custom::after {
    display: none !important;
}

.btn-export-custom .export-text-group {
    display: flex;
    flex-direction: column;
    text-align: center;
    line-height: 1.15;
}

.btn-export-custom .export-text-main {
    font-weight: 700;
    font-size: 0.85rem;
    letter-spacing: 0.2px;
}

.btn-export-custom .export-text-sub {
    font-weight: 800;
    font-size: 0.95rem;
    letter-spacing: 0.2px;
}

.btn-export-custom .export-icon {
    font-size: 1.1rem;
}

.btn-export-custom .export-arrow {
    font-size: 0.9rem;
}

/* Style Dropdown Menu Export */
.dropdown-menu-export {
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    padding: 8px 0;
    min-width: 170px;
    margin-top: 6px;
    z-index: 1050;
}

.dropdown-menu-export.show {
    display: block !important;
}

.dropdown-menu-export .dropdown-item {
    padding: 8px 16px;
    font-size: 0.875rem;
    font-weight: 600;
    color: #334155;
    display: flex;
    align-items: center;
    gap: 10px;
    transition: background 0.15s ease;
    cursor: pointer;
}

.dropdown-menu-export .dropdown-item:hover {
    background-color: #f1f5f9;
    color: #0f172a;
}

/* =========================
   TABLE
========================= */
.log-card {
    border: 0;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(0,0,0,.07);
    background: #fff;
}

.log-table-header {
    background: #fff;
    padding: 18px 20px;
    border-bottom: 1px solid #edf0f4;
}

.log-table-title {
    color: var(--text-dark);
    font-size: 1.1rem;
    font-weight: 800;
}

.log-table-title i { color: var(--polban-blue); }

.log-table { margin-bottom: 0; width: 100%; }
.log-table thead { background: var(--polban-navy); }
.log-table thead th {
    color: #fff;
    border: 0;
    font-size: .85rem;
    font-weight: 700;
    padding: 14px 16px;
    white-space: nowrap;
}

.log-table tbody td {
    padding: 16px;
    vertical-align: middle;
    border-color: #edf0f4;
    font-size: .9rem;
}

.log-table tbody tr:hover { background-color: #f8f9ff; }

.time-date { font-weight: 700; color: #263238; }
.time-sub { font-size: .8rem; color: #6c757d; }
.actor-name { font-weight: 700; color: #263238; }
.actor-sub { font-size: .8rem; color: #6c757d; }

/* BADGES */
.badge-activity {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: .8rem;
    font-weight: 700;
}

.badge-disposisi { background-color: #ffe8cc; color: #d97706; }
.badge-verifikasi { background-color: #d1e7dd; color: #0f5132; }
.badge-export { background-color: #e2d9f3; color: #432874; }
.badge-login { background-color: #cff4fc; color: #055160; }

.ticket-link {
    font-weight: 700;
    color: var(--polban-blue);
    text-decoration: none;
}
.ticket-link:hover { text-decoration: underline; }

.badge-priority-high {
    background-color: #dc3545;
    color: #fff;
    font-size: .75rem;
    padding: 3px 8px;
    border-radius: 4px;
    font-weight: 700;
    display: inline-block;
    margin-top: 4px;
}

.ip-text {
    color: #6c757d;
    font-size: .85rem;
    font-family: monospace;
}

/* PAGINATION */
.log-pagination {
    padding: 16px 20px;
    border-top: 1px solid #edf0f4;
    background: #fff;
}

.log-pagination .page-link {
    color: var(--polban-navy);
    border-radius: 6px !important;
    margin: 0 2px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s ease;
}

.log-pagination .page-item.active .page-link {
    background: var(--polban-navy);
    border-color: var(--polban-navy);
    color: #fff;
    box-shadow: 0 2px 6px rgba(26, 35, 126, 0.3);
}

@keyframes pageFadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<div class="container-fluid px-4 py-4 log-page">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="log-title mb-1" style="font-size:1.75rem;">
                Riwayat Log Sistem
            </h1>
            <p class="log-subtitle mb-0">
                Pantau seluruh rekam jejak aktivitas dan riwayat transaksi sistem.
            </p>
        </div>
        <div>
            <span class="badge badge-light border px-3 py-2 text-muted" id="headerInfoBadge" style="font-size: .85rem;">
                Menampilkan data...
            </span>
        </div>
    </div>

    <!-- 4 KOTAK STATISTIK -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card ticket-stat-card stat-blue shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">Total Log Aktivitas</div>
                            <div class="stat-number mt-2" id="statTotalLog">25</div>
                        </div>
                        <div class="stat-icon"><i class="fas fa-history"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card ticket-stat-card stat-orange shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">Disposisi Tiket</div>
                            <div class="stat-number mt-2">12</div>
                        </div>
                        <div class="stat-icon"><i class="fas fa-share-square"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card ticket-stat-card stat-green shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">Verifikasi Berkas</div>
                            <div class="stat-number mt-2">8</div>
                        </div>
                        <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card ticket-stat-card stat-yellow shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="stat-label">Aktivitas Lainnya</div>
                            <div class="stat-number mt-2">5</div>
                        </div>
                        <div class="stat-icon"><i class="fas fa-cogs"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTER BAR -->
    <div class="filter-card mb-4">
        <form id="filterForm" onsubmit="event.preventDefault(); applyFilter();">
            <div class="row g-2 align-items-center">
                <!-- Search Box -->
                <div class="col-lg-3 col-md-4">
                    <div class="search-input-group">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" class="form-control form-control-sm filter-control" placeholder="Cari No Tiket, Nama, NIK...">
                    </div>
                </div>

                <!-- Dropdown Status -->
                <div class="col-lg-2 col-md-3">
                    <select id="statusSelect" class="form-select form-select-sm filter-control">
                        <option value="">-- Semua Status --</option>
                        <option value="Disposisi">Disposisi</option>
                        <option value="Verifikasi">Verifikasi</option>
                        <option value="Export Data">Export Data</option>
                        <option value="Login">Login</option>
                    </select>
                </div>

                <!-- Dropdown Unit / Kategori -->
                <div class="col-lg-2 col-md-3">
                    <select id="unitSelect" class="form-select form-select-sm filter-control">
                        <option value="">-- Semua Unit --</option>
                        <option value="Akademik">Akademik</option>
                        <option value="Keuangan">Keuangan</option>
                        <option value="Kemahasiswaan">Kemahasiswaan</option>
                    </select>
                </div>

                <!-- Items Per Page (Default 10 Tiket) -->
                <div class="col-lg-1 col-md-2">
                    <input type="number" id="pageSizeInput" class="form-control form-control-sm filter-control text-center" value="10" min="1" max="50">
                </div>

                <!-- Tombol Filter & Reset -->
                <div class="col-lg-2 col-md-4 d-flex gap-2">
                    <button type="button" class="btn btn-polban-filter d-flex align-items-center gap-2" onclick="applyFilter()">
                        <i class="fas fa-filter" style="font-size:0.85rem;"></i> Filter
                    </button>
                    <button type="button" class="btn btn-reset" onclick="resetFilter()" title="Reset Filter">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>

                <!-- Dropdown Export Laporan (Sudah Diperbaiki - Bekerja 100%) -->
                <div class="col-lg-2 col-md-4 text-end">
                    <div class="dropdown export-dropdown-wrapper">
                        <button class="btn btn-export-custom dropdown-toggle" 
                                type="button" 
                                id="exportDropdownBtn" 
                                data-bs-toggle="dropdown" 
                                data-toggle="dropdown" 
                                aria-expanded="false">
                            <i class="fas fa-download export-icon"></i>
                            <div class="export-text-group">
                                <span class="export-text-main">Export</span>
                                <span class="export-text-sub">Laporan</span>
                            </div>
                            <i class="fas fa-chevron-down export-arrow"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-export" id="exportMenu" aria-labelledby="exportDropdownBtn">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="exportData('Excel')">
                                    <i class="fas fa-file-excel text-success me-2"></i> Export Excel
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="exportData('PDF')">
                                    <i class="fas fa-file-pdf text-danger me-2"></i> Export PDF
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)" onclick="exportData('CSV')">
                                    <i class="fas fa-file-csv text-primary me-2"></i> Export CSV
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- TABEL LOG SISTEM -->
    <div class="card log-card">

        <div class="log-table-header d-flex justify-content-between align-items-center">
            <div class="log-table-title">
                <i class="fas fa-list-alt mr-2"></i> Riwayat Log Sistem
            </div>
            <span class="badge badge-light border px-3 py-2 text-muted" id="tableHeaderInfo">
                Menampilkan 0-0 dari total 0 log
            </span>
        </div>

        <div class="table-responsive">
            <table class="table log-table">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Petugas / Aktor</th>
                        <th>Aktivitas</th>
                        <th>Objek Tiket</th>
                        <th>Rincian Detail</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody id="logTableBody">
                    <!-- Data dummy di-render oleh Javascript -->
                </tbody>
            </table>
        </div>

        <!-- PAGINASI DINAMIS -->
        <div class="log-pagination d-flex justify-content-between align-items-center">
            <small class="text-muted" id="footerPaginationText">
                Menampilkan data log sistem secara realtime
            </small>

            <nav aria-label="Navigasi log">
                <ul class="pagination pagination-sm mb-0" id="paginationNav">
                    <!-- Navigasi pagination di-render oleh Javascript -->
                </ul>
            </nav>
        </div>

    </div>

</div>

<!-- SCRIPT LOGIKA FILTER & PAGINASI (TERMASUK FALLBACK DROPDOWN HANDLER) -->
<script>
// Data Dummy Master (25 Data - Tiket ULT-025 adalah yang TERBARU dan di urutan PERTAMA)
const rawLogsData = [
    { date: "21 Agu 2026", time: "15:30:10 WIB", actor: "Admin ULT 01", sub: "NIP: 19850312...", activity: "Disposisi", unit: "Akademik", ticket: "ULT-025", detail: "Meneruskan tiket ke <strong>Unit Akademik</strong> dengan prioritas <br><span class=\"badge-priority-high\">High</span>", ip: "10.15.2.42" },
    { date: "21 Agu 2026", time: "15:12:00 WIB", actor: "Siti Nurjanah", sub: "Petugas Kemahasiswaan", activity: "Verifikasi", unit: "Kemahasiswaan", ticket: "ULT-024", detail: "Memverifikasi kelengkapan berkas beasiswa pemohon <strong>Rizky Febian</strong>", ip: "10.15.3.88" },
    { date: "21 Agu 2026", time: "14:45:19 WIB", actor: "Budi Santoso", sub: "Petugas Keuangan", activity: "Export Data", unit: "Keuangan", ticket: "-", detail: "Mengunduh Laporan Keuangan Harian format Excel (.xlsx)", ip: "10.15.4.11" },
    { date: "21 Agu 2026", time: "14:15:22 WIB", actor: "Admin ULT 01", sub: "NIP: 19850312...", activity: "Disposisi", unit: "Akademik", ticket: "ULT-023", detail: "Meneruskan tiket perbaikan nilai ke <strong>Unit Akademik</strong>", ip: "10.15.2.42" },
    { date: "21 Agu 2026", time: "13:40:05 WIB", actor: "Admin ULT 02", sub: "NIP: 19900101...", activity: "Verifikasi", unit: "Akademik", ticket: "ULT-022", detail: "Memverifikasi kelengkapan berkas pemohon <strong>Siti Nurhaliza</strong>", ip: "10.15.2.43" },
    { date: "21 Agu 2026", time: "12:10:00 WIB", actor: "Budi Santoso", sub: "Petugas Keuangan", activity: "Disposisi", unit: "Keuangan", ticket: "ULT-021", detail: "Mengalihkan tiket tagihan UKT ke Bagian Keuangan", ip: "10.15.4.11" },
    { date: "21 Agu 2026", time: "11:30:15 WIB", actor: "Ahmad Dahlan", sub: "Petugas Akademik", activity: "Verifikasi", unit: "Akademik", ticket: "ULT-020", detail: "Memverifikasi ijazah kelulusan mahasiswa <strong>Dewi Persik</strong>", ip: "10.15.1.09" },
    { date: "21 Agu 2026", time: "11:00:00 WIB", actor: "Admin ULT 01", sub: "NIP: 19850312...", activity: "Login", unit: "Akademik", ticket: "-", detail: "Berhasil masuk ke dalam Dashboard Petugas ULT POLBAN", ip: "10.15.2.42" },
    { date: "21 Agu 2026", time: "10:45:22 WIB", actor: "Rina Nose", sub: "Petugas Kemahasiswaan", activity: "Disposisi", unit: "Kemahasiswaan", ticket: "ULT-019", detail: "Proses disposisi pengajuan klaim asuransi kesehatan", ip: "10.15.3.12" },
    { date: "21 Agu 2026", time: "10:15:00 WIB", actor: "Admin ULT 02", sub: "NIP: 19900101...", activity: "Export Data", unit: "Akademik", ticket: "-", detail: "Mengunduh rekap rekam medis mahasiswa baru", ip: "10.15.2.43" },
    { date: "20 Agu 2026", time: "16:20:11 WIB", actor: "Budi Santoso", sub: "Petugas Keuangan", activity: "Verifikasi", unit: "Keuangan", ticket: "ULT-018", detail: "Verifikasi pembayaran administrasi wisuda", ip: "10.15.4.11" },
    { date: "20 Agu 2026", time: "15:00:00 WIB", actor: "Admin ULT 01", sub: "NIP: 19850312...", activity: "Disposisi", unit: "Akademik", ticket: "ULT-017", detail: "Meneruskan pendaftaran Cuti Akademik ke Jurusan", ip: "10.15.2.42" },
    { date: "20 Agu 2026", time: "14:10:00 WIB", actor: "Siti Nurjanah", sub: "Petugas Kemahasiswaan", activity: "Disposisi", unit: "Kemahasiswaan", ticket: "ULT-016", detail: "Pengajuan surat rekomendasi Beasiswa D3", ip: "10.15.3.88" },
    { date: "20 Agu 2026", time: "13:00:40 WIB", actor: "Ahmad Dahlan", sub: "Petugas Akademik", activity: "Verifikasi", unit: "Akademik", ticket: "ULT-015", detail: "Verifikasi transkrip nilai sementara", ip: "10.15.1.09" },
    { date: "20 Agu 2026", time: "11:22:10 WIB", actor: "Budi Santoso", sub: "Petugas Keuangan", activity: "Login", unit: "Keuangan", ticket: "-", detail: "Login berhasil dari workstation 04", ip: "10.15.4.11" },
    { date: "20 Agu 2026", time: "09:15:33 WIB", actor: "Admin ULT 01", sub: "NIP: 19850312...", activity: "Disposisi", unit: "Akademik", ticket: "ULT-014", detail: "Disposisi permohonan legalisir Akreditasi", ip: "10.15.2.42" },
    { date: "19 Agu 2026", time: "16:45:00 WIB", actor: "Rina Nose", sub: "Petugas Kemahasiswaan", activity: "Export Data", unit: "Kemahasiswaan", ticket: "-", detail: "Export daftar penerima KIP-Kuliah tahun 2026", ip: "10.15.3.12" },
    { date: "19 Agu 2026", time: "14:12:09 WIB", actor: "Ahmad Dahlan", sub: "Petugas Akademik", activity: "Disposisi", unit: "Akademik", ticket: "ULT-013", detail: "Disposisi permohonan Kartu Tanda Mahasiswa Hilang", ip: "10.15.1.09" },
    { date: "19 Agu 2026", time: "11:05:00 WIB", actor: "Admin ULT 02", sub: "NIP: 19900101...", activity: "Verifikasi", unit: "Akademik", ticket: "ULT-012", detail: "Verifikasi syarat seminar hasil skripsi/TA", ip: "10.15.2.43" },
    { date: "19 Agu 2026", time: "08:30:11 WIB", actor: "Siti Nurjanah", sub: "Petugas Kemahasiswaan", activity: "Login", unit: "Kemahasiswaan", ticket: "-", detail: "Sistem menerima autentikasi login pengguna", ip: "10.15.3.88" },
    { date: "18 Agu 2026", time: "15:20:00 WIB", actor: "Budi Santoso", sub: "Petugas Keuangan", activity: "Disposisi", unit: "Keuangan", ticket: "ULT-011", detail: "Disposisi permohonan penurunan Golongan UKT", ip: "10.15.4.11" },
    { date: "18 Agu 2026", time: "13:10:00 WIB", actor: "Admin ULT 01", sub: "NIP: 19850312...", activity: "Verifikasi", unit: "Akademik", ticket: "ULT-010", detail: "Verifikasi data calon wisudawan periode II", ip: "10.15.2.42" },
    { date: "18 Agu 2026", time: "10:00:00 WIB", actor: "Ahmad Dahlan", sub: "Petugas Akademik", activity: "Export Data", unit: "Akademik", ticket: "-", detail: "Mengunduh rekap jadwal perkuliahan semester ganjil", ip: "10.15.1.09" },
    { date: "18 Agu 2026", time: "09:05:12 WIB", actor: "Admin ULT 02", sub: "NIP: 19900101...", activity: "Disposisi", unit: "Akademik", ticket: "ULT-009", detail: "Meneruskan permohonan pemindahan kelas", ip: "10.15.2.43" },
    { date: "18 Agu 2026", time: "08:00:00 WIB", actor: "Admin ULT 01", sub: "NIP: 19850312...", activity: "Login", unit: "Akademik", ticket: "-", detail: "Berhasil masuk ke dalam Dashboard Petugas ULT POLBAN", ip: "10.15.2.42" }
];

let filteredData = [...rawLogsData];
let currentPage = 1;
let pageSize = 10;

// Render Badge Aktivitas
function getBadgeHtml(activity) {
    switch(activity) {
        case 'Disposisi':
            return `<span class="badge-activity badge-disposisi"><i class="fas fa-share-square"></i> Disposisi</span>`;
        case 'Verifikasi':
            return `<span class="badge-activity badge-verifikasi"><i class="fas fa-check-circle"></i> Verifikasi</span>`;
        case 'Export Data':
            return `<span class="badge-activity badge-export"><i class="fas fa-file-excel"></i> Export Data</span>`;
        case 'Login':
            return `<span class="badge-activity badge-login"><i class="fas fa-sign-in-alt"></i> Login</span>`;
        default:
            return `<span class="badge badge-secondary">${activity}</span>`;
    }
}

// Render Tabel
function renderTable() {
    const tbody = document.getElementById('logTableBody');
    tbody.innerHTML = '';

    pageSize = parseInt(document.getElementById('pageSizeInput').value) || 10;
    const totalItems = filteredData.length;
    const totalPages = Math.ceil(totalItems / pageSize) || 1;

    if (currentPage > totalPages) currentPage = totalPages;
    if (currentPage < 1) currentPage = 1;

    const startIdx = (currentPage - 1) * pageSize;
    const endIdx = Math.min(startIdx + pageSize, totalItems);
    const pageData = filteredData.slice(startIdx, endIdx);

    if (pageData.length === 0) {
        tbody.innerHTML = `<tr><td colspan="6" class="text-center py-4 text-muted">Tidak ada data log yang ditemukan</td></tr>`;
    } else {
        pageData.forEach(item => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <div class="time-date">${item.date}</div>
                    <div class="time-sub"><i class="far fa-clock me-1"></i> ${item.time}</div>
                </td>
                <td>
                    <div class="actor-name">${item.actor}</div>
                    <div class="actor-sub">${item.sub}</div>
                </td>
                <td>${getBadgeHtml(item.activity)}</td>
                <td>
                    ${item.ticket !== '-' ? `<a href="#" class="ticket-link">${item.ticket}</a>` : '<span class="text-muted">-</span>'}
                </td>
                <td>${item.detail}</td>
                <td class="ip-text">${item.ip}</td>
            `;
            tbody.appendChild(tr);
        });
    }

    // Update Text Badges Informasi Paginasi
    const infoText = totalItems > 0 
        ? `Menampilkan ${startIdx + 1}-${endIdx} dari total ${totalItems} log`
        : `Menampilkan 0 log`;
        
    document.getElementById('headerInfoBadge').innerText = infoText;
    document.getElementById('tableHeaderInfo').innerText = infoText;
    document.getElementById('statTotalLog').innerText = totalItems;

    renderPagination(totalPages);
}

// Render Paginasi Dinamis
function renderPagination(totalPages) {
    const nav = document.getElementById('paginationNav');
    nav.innerHTML = '';

    // Prev Button
    const prevLi = document.createElement('li');
    prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
    prevLi.innerHTML = `<span class="page-link" onclick="changePage(${currentPage - 1})">Previous</span>`;
    nav.appendChild(prevLi);

    // Page Numbers
    for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement('li');
        li.className = `page-item ${i === currentPage ? 'active' : ''}`;
        li.innerHTML = `<span class="page-link" onclick="changePage(${i})">${i}</span>`;
        nav.appendChild(li);
    }

    // Next Button
    const nextLi = document.createElement('li');
    nextLi.className = `page-item ${currentPage === totalPages || totalPages === 0 ? 'disabled' : ''}`;
    nextLi.innerHTML = `<span class="page-link" onclick="changePage(${currentPage + 1})">Next</span>`;
    nav.appendChild(nextLi);
}

function changePage(page) {
    const totalPages = Math.ceil(filteredData.length / pageSize) || 1;
    if (page < 1 || page > totalPages) return;
    currentPage = page;
    renderTable();
}

// Filter Function
function applyFilter() {
    const searchVal = document.getElementById('searchInput').value.toLowerCase().trim();
    const statusVal = document.getElementById('statusSelect').value;
    const unitVal = document.getElementById('unitSelect').value;

    filteredData = rawLogsData.filter(item => {
        const matchesSearch = item.ticket.toLowerCase().includes(searchVal) ||
                              item.actor.toLowerCase().includes(searchVal) ||
                              item.detail.toLowerCase().includes(searchVal);
        
        const matchesStatus = statusVal === "" || item.activity === statusVal;
        const matchesUnit = unitVal === "" || item.unit === unitVal;

        return matchesSearch && matchesStatus && matchesUnit;
    });

    currentPage = 1;
    renderTable();
}

// Reset Function
function resetFilter() {
    document.getElementById('searchInput').value = '';
    document.getElementById('statusSelect').value = '';
    document.getElementById('unitSelect').value = '';
    document.getElementById('pageSizeInput').value = '10';
    filteredData = [...rawLogsData];
    currentPage = 1;
    renderTable();
}

// Export Function
function exportData(type) {
    alert(`Mengeksport ${filteredData.length} data log terfilter ke format ${type}...`);
    // Tutup dropdown setelah item diklik
    document.getElementById('exportMenu').classList.remove('show');
}

// Event Listeners
document.getElementById('searchInput').addEventListener('keyup', applyFilter);
document.getElementById('statusSelect').addEventListener('change', applyFilter);
document.getElementById('unitSelect').addEventListener('change', applyFilter);
document.getElementById('pageSizeInput').addEventListener('input', applyFilter);

// Handler Khusus JavaScript untuk Menjamin Dropdown Selalu Bisa Diklik
document.addEventListener('DOMContentLoaded', () => {
    renderTable();

    const btnExport = document.getElementById('exportDropdownBtn');
    const menuExport = document.getElementById('exportMenu');

    if (btnExport && menuExport) {
        btnExport.addEventListener('click', (e) => {
            e.stopPropagation();
            menuExport.classList.toggle('show');
        });

        // Menutup menu jika klik di luar dropdown
        document.addEventListener('click', (e) => {
            if (!btnExport.contains(e.target) && !menuExport.contains(e.target)) {
                menuExport.classList.remove('show');
            }
        });
    }
});
</script>

<?= $this->endSection() ?>