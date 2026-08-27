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
    --polban-green: #117a43;
    --polban-green-hover: #0b5c31;
    --soft-bg: #f4f6f9;
    --text-dark: #263238;
    --text-muted: #6c757d;
}

/* =========================
   PAGE & GENERAL
========================= */
body,
.container-fluid {
    font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
    color: var(--text-dark);
}

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

/* ==========================================================================
   STATISTIC CARDS
   ========================================================================== */
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
    background: linear-gradient(135deg, #1a237e 0%, #283593 100%) !important;
}

.bg-tamu-orange {
    background: linear-gradient(135deg, #ff8c00 0%, #f57c00 100%) !important;
}

.bg-tamu-yellow {
    background: linear-gradient(135deg, #f4c400 0%, #fb8c00 100%) !important;
}

.bg-tamu-green {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
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

/* =========================
   FILTER BAR FIX
========================= */
.filter-card {
    background: #ffffff;
    border-radius: 16px;
    padding: 16px 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,.04);
    border: 1px solid #edf0f4;
    position: relative;
    z-index: 50;
    overflow: visible !important;
}

.filter-control {
    border-radius: 8px;
    border: 1px solid #dcdfe6;
    padding: 8px 12px;
    font-size: 0.875rem;
    color: #4a5568;
    height: 42px;
    width: 100%;
}

.filter-control:focus {
    border-color: var(--polban-blue);
    box-shadow: 0 0 0 3px rgba(0, 91, 172, 0.15);
    outline: none;
}

.search-input-group {
    position: relative;
    width: 100%;
}

.search-input-group .search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: #1e293b;
    font-size: 0.95rem;
    z-index: 5;
}

.search-input-group input {
    padding-left: 38px;
}

.btn-polban-filter {
    background-color: #121970;
    color: #ffffff;
    font-weight: 600;
    border-radius: 8px;
    height: 42px;
    padding: 0 20px;
    border: none;
    font-size: 0.9rem;
    white-space: nowrap;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.btn-polban-filter:hover {
    background-color: #0a0e4a;
    color: #ffffff;
}

.btn-reset {
    background-color: #64748b;
    color: #ffffff;
    border-radius: 8px;
    height: 42px;
    width: 42px;
    padding: 0;
    border: none;
    font-size: 0.95rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.btn-reset:hover {
    background-color: #475569;
    color: #ffffff;
}

/* Tombol Export Custom Dropdown */
.export-dropdown-wrapper {
    position: relative;
    display: inline-block;
}

.btn-export-custom {
    background-color: #107c41;
    color: #ffffff !important;
    border-radius: 10px;
    height: 42px;
    padding: 0 16px;
    border: none;
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    white-space: nowrap;
    text-decoration: none !important;
    font-weight: 700;
    font-size: 0.85rem;
    line-height: 1.1;
    text-align: center;
}

.btn-export-custom:hover, 
.btn-export-custom:focus {
    background-color: #0b5c31;
    color: #ffffff !important;
}

.dropdown-menu-export {
    border-radius: 12px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    padding: 8px 0;
    min-width: 170px;
    margin-top: 6px;
    z-index: 1060;
}

.dropdown-menu-export .dropdown-item {
    padding: 8px 16px;
    font-size: 0.875rem;
    font-weight: 500;
    color: #334155;
    display: flex;
    align-items: center;
    gap: 10px;
}

.dropdown-menu-export .dropdown-item:hover {
    background-color: #f8fafc;
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
    position: relative;
    z-index: 1;
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

.ticket-link:hover {
    text-decoration: underline;
}

@keyframes pageFadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

.reveal-item {
    opacity: 0;
    transform: translateY(12px);
}

.reveal-item.show {
    opacity: 1;
    transform: translateY(0);
    transition: all .4s ease;
}
</style>

<div class="container-fluid px-4 py-4 log-page">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-bold mb-1 log-title" style="font-size:1.75rem;">Log Aktivitas Sistem</h1>
            <p class="log-subtitle mb-0">Pantau seluruh riwayat aktivitas pengguna dan perubahan data sistem secara real-time.</p>
        </div>
    </div>

    <!-- STATISTIC CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-navy p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Total Tamu</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="8">8</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-users"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-orange p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Submitted</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="1">1</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-paper-plane"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-yellow p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Assigned / Diproses</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="5">5</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-spinner"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card stat-tamu-card bg-tamu-green p-3 shadow-sm reveal-item">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Verified / Selesai</span>
                        <h2 class="fw-extrabold mb-0 text-white mt-1 counter" data-target="2">2</h2>
                    </div>
                    <div class="icon-tamu-circle text-white"><i class="fas fa-check-circle"></i></div>
                </div>
            </div>
        </div>
    </div>

    <!-- FILTER BAR TERSTRUKTUR & RAPI -->
    <div class="filter-card mb-4 reveal-item">
        <form action="" method="GET">
            <div class="row g-2 align-items-center">
                
                <!-- Search Input -->
                <div class="col-md-3">
                    <div class="search-input-group">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="keyword" class="form-control filter-control" placeholder="Cari nama / tiket / aksi..." value="<?= esc($keyword ?? '') ?>">
                    </div>
                </div>

                <!-- Select Role -->
                <div class="col-md-2">
                    <select name="role" class="form-select filter-control">
                        <option value="">Semua Role</option>
                        <option value="Admin" <?= ($role ?? '') == 'Admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="Petugas" <?= ($role ?? '') == 'Petugas' ? 'selected' : '' ?>>Petugas</option>
                        <option value="Pengguna" <?= ($role ?? '') == 'Pengguna' ? 'selected' : '' ?>>Pengguna</option>
                    </select>
                </div>

                <!-- Select Jenis Aksi -->
                <div class="col-md-2">
                    <select name="aksi" class="form-select filter-control">
                        <option value="">Semua Aksi</option>
                        <option value="Disposisi Tiket" <?= ($aksi ?? '') == 'Disposisi Tiket' ? 'selected' : '' ?>>Disposisi Tiket</option>
                        <option value="Verifikasi Tiket" <?= ($aksi ?? '') == 'Verifikasi Tiket' ? 'selected' : '' ?>>Verifikasi Tiket</option>
                        <option value="Export Laporan" <?= ($aksi ?? '') == 'Export Laporan' ? 'selected' : '' ?>>Export Laporan</option>
                        <option value="User Login" <?= ($aksi ?? '') == 'User Login' ? 'selected' : '' ?>>User Login</option>
                    </select>
                </div>

                <!-- Input Angka / Limit -->
                <div class="col-md-1" style="max-width: 90px;">
                    <input type="text" name="limit" class="form-control filter-control text-center" value="10">
                </div>

                <!-- Tombol Filter & Reset -->
                <div class="col-md-2 d-flex gap-1">
                    <button type="submit" class="btn btn-polban-filter">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="<?= base_url('log-aktivitas') ?>" class="btn btn-reset" title="Reset Filter">
                        <i class="fas fa-redo-alt"></i>
                    </a>
                </div>

                <!-- Tombol Export Laporan -->
                <div class="col-md d-flex justify-content-end ms-auto">
                    <div class="export-dropdown-wrapper dropdown">
                        <button type="button" class="btn btn-export-custom dropdown-toggle" id="exportDropdownBtn" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-download"></i>
                            <span>Export<br>Laporan</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-export shadow" aria-labelledby="exportDropdownBtn">
                            <li>
                                <a class="dropdown-item" href="<?= base_url('log-aktivitas/export/excel') ?>">
                                    <i class="fas fa-file-excel text-success"></i> Export Excel
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('log-aktivitas/export/pdf') ?>" target="_blank">
                                    <i class="fas fa-file-pdf text-danger"></i> Export PDF
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= base_url('log-aktivitas/export/csv') ?>">
                                    <i class="fas fa-file-csv text-primary"></i> Export CSV
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <!-- TABEL LOG AKTIVITAS -->
    <div class="card log-card reveal-item">
        <div class="log-table-header d-flex justify-content-between align-items-center">
            <div>
                <div class="log-table-title">
                    <i class="fas fa-history me-2"></i> Riwayat Log Aktivitas
                </div>
                <small class="text-muted">Menampilkan seluruh catatan aktivitas di dalam sistem</small>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table log-table align-middle">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 60px;">No</th>
                            <th>Waktu & Tanggal</th>
                            <th>Aktor / Pelaku</th>
                            <th>Role</th>
                            <th>Jenis Aksi</th>
                            <th>No. Tiket / Referensi</th>
                            <th>Detail Catatan Aktivitas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $dummyLog = [
                            ['06-08-2026 08:15', 'Admin ULT', 'Admin', 'Disposisi Tiket', 'ULT-20260806074739865', 'Meneruskan tiket ke Bagian Keuangan.', 'badge-disposisi', 'fa-share'],
                            ['06-08-2026 07:50', 'Asep', 'Pengguna', 'Submit Tiket', 'ULT-20260806074739865', 'Membuat permohonan baru layanan Keuangan.', 'badge-login', 'fa-paper-plane'],
                            ['05-08-2026 09:30', 'Petugas Kemahasiswaan', 'Petugas', 'Verifikasi Tiket', 'ULT-20260805023213577', 'Mengubah status tiket menjadi Verified.', 'badge-verifikasi', 'fa-user-check'],
                            ['05-08-2026 08:00', 'Admin ULT', 'Admin', 'Export Laporan', '-', 'Mengeksport data laporan bulanan ke Excel.', 'badge-export', 'fa-file-excel'],
                            ['30-07-2026 08:30', 'Admin ULT', 'Admin', 'Disposisi Tiket', 'ULT-20260730081403481', 'Meneruskan tiket ke Bagian Kemahasiswaan.', 'badge-disposisi', 'fa-share'],
                            ['30-07-2026 08:10', 'Petugas Akademik', 'Petugas', 'User Login', '-', 'Petugas melakukan login ke sistem.', 'badge-login', 'fa-sign-in-alt'],
                        ];
                        foreach ($dummyLog as $idx => $row):
                        ?>
                            <tr>
                                <td class="text-center fw-bold text-muted"><?= $idx + 1 ?></td>
                                <td>
                                    <div class="time-date"><?= explode(' ', $row[0])[0] ?></div>
                                    <div class="time-sub"><?= explode(' ', $row[0])[1] ?> WIB</div>
                                </td>
                                <td>
                                    <div class="actor-name"><?= $row[1] ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border font-weight-bold px-2 py-1" style="border-radius:6px; font-size:0.75rem;">
                                        <?= $row[2] ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-activity <?= $row[6] ?>">
                                        <i class="fas <?= $row[7] ?>"></i> <?= $row[3] ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($row[4] !== '-'): ?>
                                        <a href="#" class="ticket-link"><?= $row[4] ?></a>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="text-dark"><?= $row[5] ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        document.querySelectorAll('.reveal-item').forEach(item => {
            item.classList.add('show');
        });
    }, 100);

    const exportBtn = document.getElementById('exportDropdownBtn');
    if (exportBtn) {
        exportBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            const menu = this.nextElementSibling;
            if (menu) {
                menu.classList.toggle('show');
            }
        });

        document.addEventListener('click', function(e) {
            const menu = exportBtn?.nextElementSibling;
            if (menu && menu.classList.contains('show') && !exportBtn.contains(e.target)) {
                menu.classList.remove('show');
            }
        });
    }
});
</script>

<?= $this->endSection() ?>