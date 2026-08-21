<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<style>
    /* Styling Card Ringkasan Statistik Berwarna Solid */
    .stat-mini-card {
        border-radius: 12px;
        border: none;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        color: #ffffff;
    }
    .stat-mini-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15) !important;
    }

    /* WARNA KARTU SAMA DENGAN DASHBOARD UTAMA */
    .bg-card-navy {
        background-color: #1a237e !important;
        color: #ffffff !important;
    }
    .bg-card-orange {
        background-color: #ff8c00 !important;
        color: #ffffff !important;
    }
    .bg-card-yellow {
        background-color: #f4c400 !important;
        color: #ffffff !important;
    }
    .bg-card-green {
        background-color: #198754 !important;
        color: #ffffff !important;
    }

    /* Circle Icon Container */
    .icon-circle-bg {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .icon-circle-bg-dark {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Styling Tombol Filter & Reset */
    .btn-filter-orange {
        background-color: #ff8c00;
        border-color: #ff8c00;
        color: #ffffff;
        font-weight: 600;
        border-radius: 8px;
        height: 42px;
        padding: 0 20px;
        transition: all 0.25s ease-in-out;
    }
    .btn-filter-orange:hover {
        background-color: #e07b00;
        border-color: #e07b00;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(255, 140, 0, 0.35);
        transform: translateY(-1px);
    }

    .btn-reset-grey {
        background-color: #6c757d;
        border-color: #6c757d;
        color: #ffffff;
        border-radius: 8px;
        height: 42px;
        width: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease-in-out;
    }
    .btn-reset-grey:hover {
        background-color: #5a6268;
        border-color: #545b62;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.35);
        transform: translateY(-1px);
    }

    /* Tombol Export Laporan Green */
    .btn-export-green {
        background-color: #198754;
        border-color: #198754;
        color: #ffffff;
        font-weight: 600;
        border-radius: 8px;
        height: 42px;
        padding: 0 20px;
        transition: all 0.25s ease-in-out;
    }
    .btn-export-green:hover {
        background-color: #146c43;
        border-color: #13653f;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.35);
        transform: translateY(-1px);
    }

    /* Form Control Styling */
    .custom-form-control, .custom-select {
        border-color: #ced4da;
        font-size: 0.9rem;
        height: 42px;
        border-radius: 8px;
    }
    .custom-form-control:focus, .custom-select:focus {
        border-color: #1a237e;
        box-shadow: 0 0 0 0.2rem rgba(26, 35, 126, 0.15);
    }

    /* Custom Table Styling */
    .table-custom-header {
        background-color: #1a237e !important;
        color: #ffffff !important;
        font-weight: 600;
        font-size: 0.9rem;
    }
    .table-custom tbody tr {
        transition: background-color 0.2s ease;
    }
    .table-custom tbody tr:hover {
        background-color: #f8f9ff !important;
    }

    .filter-action-group {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .filter-card {
        position: relative;
        z-index: 100 !important;
        overflow: visible !important;
    }

    .export-action-group {
        position: relative;
        z-index: 105 !important;
        padding-left: 15px;
    }

    .export-dropdown {
        position: relative;
        display: inline-block;
    }

    .export-menu {
        display: none;
        position: absolute;
        right: 0;
        top: calc(100% + 8px);
        min-width: 210px;
        background: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        padding: 6px 0;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.18);
        z-index: 9999 !important;
    }

    .export-menu.show {
        display: block !important;
    }

    .export-menu .dropdown-item {
        display: flex;
        align-items: center;
        padding: 11px 15px;
        color: #212529;
        font-size: 0.9rem;
        text-decoration: none;
        white-space: nowrap;
        transition: background-color 0.2s ease;
    }

    .export-menu .dropdown-item:hover {
        background-color: #f5f7fa;
    }

    .export-menu .dropdown-item i {
        width: 22px;
        text-align: center;
    }
</style>

<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="font-weight-bold mb-1" style="font-size: 1.75rem; color: #1a237e;">Laporan Tiket</h2>
            <p class="text-muted mb-0" style="font-size: 0.95rem;">Kelola, rekap, dan ekspor seluruh laporan data tiket permohonan layanan secara komprehensif.</p>
        </div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent p-0 m-0" style="font-size: 0.9rem;">
                <li class="breadcrumb-item"><a href="<?= base_url('petugas') ?>" class="text-primary text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">Laporan Tiket</li>
            </ol>
        </nav>
    </div>

    <!-- Statistik Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-sm-6">
            <div class="card stat-mini-card bg-card-navy shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-white-50 d-block text-uppercase font-weight-bold" style="font-size: 0.75rem;">Total Laporan</small>
                        <h3 class="mb-0 font-weight-bold text-white" style="font-size: 1.75rem;"><?= $total_tiket ?? 13 ?></h3>
                    </div>
                    <div class="icon-circle-bg">
                        <i class="fas fa-file-alt fs-5 text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card stat-mini-card bg-card-orange shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-white-50 d-block text-uppercase font-weight-bold" style="font-size: 0.75rem;">Waiting Verification</small>
                        <h3 class="mb-0 font-weight-bold text-white" style="font-size: 1.75rem;"><?= $waiting_verification ?? 5 ?></h3>
                    </div>
                    <div class="icon-circle-bg">
                        <i class="fas fa-clock fs-5 text-white"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card stat-mini-card bg-card-yellow shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-dark d-block text-uppercase font-weight-bold" style="font-size: 0.75rem; opacity: 0.75;">Diproses / Assigned</small>
                        <h3 class="mb-0 font-weight-bold text-dark" style="font-size: 1.75rem;"><?= $diproses ?? 3 ?></h3>
                    </div>
                    <div class="icon-circle-bg-dark">
                        <i class="fas fa-cogs fs-5 text-dark"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 col-sm-6">
            <div class="card stat-mini-card bg-card-green shadow-sm p-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <small class="text-white-50 d-block text-uppercase font-weight-bold" style="font-size: 0.75rem;">Tiket Selesai</small>
                        <h3 class="mb-0 font-weight-bold text-white" style="font-size: 1.75rem;"><?= $selesai ?? 5 ?></h3>
                    </div>
                    <div class="icon-circle-bg">
                        <i class="fas fa-check-circle fs-5 text-white"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter & Export Section -->
    <div class="card filter-card shadow-sm border-0 mb-4" style="border-radius: 12px; background: #ffffff;">
        <div class="card-body p-3">
            <form action="" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-md-4 col-12">
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0 text-muted ps-3" style="border-color: #ced4da; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" name="keyword" class="form-control border-start-0 ps-2 custom-form-control" 
                                   placeholder="Cari No Tiket, Nama, NIM..." 
                                   value="<?= esc($keyword ?? '') ?>">
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <select name="status" class="form-select custom-select">
                            <option value="">-- Semua Status --</option>
                            <option value="Waiting Verification" <?= (isset($status) && $status == 'Waiting Verification') ? 'selected' : '' ?>>Waiting Verification</option>
                            <option value="Assigned" <?= (isset($status) && $status == 'Assigned') ? 'selected' : '' ?>>Assigned</option>
                            <option value="In Progress" <?= (isset($status) && $status == 'In Progress') ? 'selected' : '' ?>>In Progress</option>
                            <option value="Completed" <?= (isset($status) && $status == 'Completed') ? 'selected' : '' ?>>Completed</option>
                            <option value="Rejected" <?= (isset($status) && $status == 'Rejected') ? 'selected' : '' ?>>Rejected</option>
                        </select>
                    </div>

                    <div class="col-md-auto col-sm-6 filter-action-group">
                        <button type="submit" class="btn btn-filter-orange d-inline-flex align-items-center gap-2">
                            <i class="fas fa-filter"></i>
                            <span>Filter</span>
                        </button>
                        <a href="<?= current_url() ?>" class="btn btn-reset-grey" title="Reset Filter">
                            <i class="fas fa-undo" style="font-size: 0.95rem;"></i>
                        </a>
                    </div>

                    <div class="col-md col-12 text-md-end mt-2 mt-md-0 export-action-group">
                        <div class="export-dropdown">
                            <button type="button" class="btn btn-export-green" id="dropdownExport" onclick="toggleExportMenu(event)">
                                <i class="fas fa-download me-2"></i>
                                Export Laporan
                                <i class="fas fa-chevron-down ms-2"></i>
                            </button>
                            <div class="export-menu" id="exportMenu">
                                <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/excel') ?>">
                                    <i class="fas fa-file-excel me-2" style="color:#0B8F4D;"></i> Export Excel
                                </a>
                                <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/pdf') ?>">
                                    <i class="fas fa-file-pdf me-2" style="color:#D93025;"></i> Export PDF
                                </a>
                                <a class="dropdown-item" href="<?= base_url('petugas/laporan/export/csv') ?>">
                                    <i class="fas fa-file-csv me-2" style="color:#005BAC;"></i> Export CSV
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data Laporan -->
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 12px;">
        <div class="card-header text-white py-3 px-4 d-flex justify-content-between align-items-center" style="background-color: #1a237e;">
            <div class="d-flex align-items-center gap-2">
                <i class="fas fa-list-alt fs-5 me-2"></i>
                <h5 class="mb-0 font-weight-bold" style="font-size: 1.05rem;">Data Laporan Tiket</h5>
            </div>
            <span class="badge bg-light text-dark px-3 py-2 font-weight-bold" style="font-size: 0.8rem; border-radius: 6px;">
                Total: <?= count($laporan_list ?? [1]) ?> Data
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr class="table-custom-header text-center">
                            <th style="width: 50px;">No</th>
                            <th>No Tiket</th>
                            <th>Nama Pemohon</th>
                            <th>Jenis Pemohon</th>
                            <th>Layanan</th>
                            <th>Status</th>
                            <th>Prioritas</th>
                            <th>Tanggal Pengajuan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($laporan_list)): ?>
                            <?php $no = 1; foreach ($laporan_list as $row): ?>
                                <tr class="text-center">
                                    <td class="font-weight-bold text-muted"><?= $no++ ?></td>
                                    <td>
                                        <a href="<?= base_url('petugas/tiket/detail/' . ($row['id'] ?? 1)) ?>" class="text-primary font-weight-bold text-decoration-none">
                                            <?= esc($row['nomor_tiket'] ?? $row['no_tiket']) ?>
                                        </a>
                                    </td>
                                    <td class="text-start font-weight-semibold text-dark"><?= esc($row['nama_pemohon']) ?></td>
                                    <td><span class="badge bg-light text-dark border px-2 py-1"><?= esc($row['jenis_pemohon'] ?? 'Mahasiswa') ?></span></td>
                                    <td class="text-start"><?= esc($row['layanan']) ?></td>
                                    <td>
                                        <?php 
                                            $st = $row['status'] ?? 'Waiting Verification';
                                            $badgeClass = 'bg-warning text-dark';
                                            if ($st == 'Completed' || $st == 'Verified') $badgeClass = 'bg-success text-white';
                                            else if ($st == 'In Progress' || $st == 'Assigned' || $st == 'Disposisi') $badgeClass = 'bg-info text-dark';
                                            else if ($st == 'Rejected') $badgeClass = 'bg-danger text-white';
                                        ?>
                                        <span class="badge <?= $badgeClass ?> px-3 py-2 font-weight-bold" style="font-size: 0.78rem; border-radius: 6px;">
                                            <?= esc($st) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary px-2 py-1"><?= esc($row['prioritas'] ?? 'Normal') ?></span>
                                    </td>
                                    <td class="text-muted" style="font-size: 0.88rem;">
                                        <?= date('d-m-Y', strtotime($row['created_at'] ?? '2026-07-30')) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr class="text-center">
                                <td class="font-weight-bold text-muted">1</td>
                                <td>
                                    <a href="#" class="text-primary font-weight-bold text-decoration-none">
                                        ULT-20260730081403481
                                    </a>
                                </td>
                                <td class="text-start font-weight-semibold text-dark">Apin</td>
                                <td><span class="badge bg-light text-dark border px-2 py-1">Mahasiswa</span></td>
                                <td class="text-start">Kemahasiswaan</td>
                                <td>
                                    <span class="badge bg-warning text-dark px-3 py-2 font-weight-bold" style="font-size: 0.78rem; border-radius: 6px;">
                                        Waiting Verification
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1">Normal</span>
                                </td>
                                <td class="text-muted" style="font-size: 0.88rem;">
                                    30-07-2026
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
function toggleExportMenu(event) {
    event.stopPropagation();
    const menu = document.getElementById('exportMenu');
    if (menu) {
        menu.classList.toggle('show');
    }
}

// Menutup dropdown jika pengguna mengklik di luar area tombol/menu
document.addEventListener('click', function(event) {
    const dropdown = document.querySelector('.export-dropdown');
    const menu = document.getElementById('exportMenu');

    if (dropdown && menu && !dropdown.contains(event.target)) {
        menu.classList.remove('show');
    }
});
</script>

<?= $this->endSection() ?>