<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<!-- Custom Styling agar Presisi dengan Desain SI-ULT POLBAN -->
<style>
    .bg-ult-navy { background-color: #1e236e !important; }
    .text-ult-navy { color: #1e236e !important; }
    .btn-ult-filter { background-color: #1e236e !important; border-color: #1e236e !important; color: #ffffff !important; }
    .btn-ult-filter:hover { background-color: #161a54 !important; }
    .btn-ult-export { background-color: #065f46 !important; border-color: #065f46 !important; color: #ffffff !important; }
    .btn-ult-export:hover { background-color: #044e39 !important; }
    .btn-ult-reset { background-color: #4b5563 !important; border-color: #4b5563 !important; color: #ffffff !important; }
    .btn-ult-reset:hover { background-color: #374151 !important; }
    
    .card-stat-blue { background: linear-gradient(135deg, #2563eb, #3b82f6); color: #fff; }
    .card-stat-orange { background: linear-gradient(135deg, #f97316, #fb923c); color: #fff; }
    .card-stat-green { background: linear-gradient(135deg, #10b981, #34d399); color: #fff; }
    .card-stat-yellow { background: linear-gradient(135deg, #f59e0b, #fbbf24); color: #1e293b; }
    
    .badge-disposisi { background-color: #fef3c7; color: #d97706; }
    .badge-verifikasi { background-color: #d1fae5; color: #059669; }
    .badge-export { background-color: #f3e8ff; color: #7c3aed; }
    .badge-lainnya { background-color: #e2e8f0; color: #475569; }
    
    .badge-priority-high { background-color: #ef4444; color: #ffffff; }
    .badge-priority-medium { background-color: #f59e0b; color: #ffffff; }
    .badge-priority-low { background-color: #3b82f6; color: #ffffff; }

    .form-control-ult {
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 13px;
        color: #475569;
    }
    .form-control-ult:focus {
        border-color: #1e236e;
        box-shadow: 0 0 0 2px rgba(30, 35, 110, 0.15);
    }
</style>

<div class="p-2">
    
    <!-- HEADER HALAMAN -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h3 class="font-weight-bold text-dark mb-1">Riwayat Log Sistem</h3>
            <p class="text-muted small mb-0">Pantau seluruh rekam jejak aktivitas dan riwayat transaksi sistem.</p>
        </div>
        <div class="bg-white px-3 py-1.5 border text-muted small" style="border-radius: 8px;">
            Menampilkan <?= $startData ?>-<?= $endData ?> dari total <?= $totalFiltered ?> log
        </div>
    </div>

    <!-- KARTU STATISTIK GRID -->
    <div class="row mb-4">
        <div class="col-lg-3 col-6 mb-2">
            <div class="p-4 shadow-sm card-stat-blue d-flex justify-content-between align-items-center" style="border-radius: 12px;">
                <div>
                    <small class="text-uppercase font-weight-bold" style="opacity: 0.9; font-size: 11px;">Total Log Aktivitas</small>
                    <h2 class="font-weight-bold mb-0 mt-1"><?= $totalLog ?></h2>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(255,255,255,0.15);">
                    <i class="fas fa-history fa-lg"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6 mb-2">
            <div class="p-4 shadow-sm card-stat-orange d-flex justify-content-between align-items-center" style="border-radius: 12px;">
                <div>
                    <small class="text-uppercase font-weight-bold" style="opacity: 0.9; font-size: 11px;">Disposisi Tiket</small>
                    <h2 class="font-weight-bold mb-0 mt-1"><?= $disposisi ?></h2>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(255,255,255,0.15);">
                    <i class="fas fa-share fa-lg"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6 mb-2">
            <div class="p-4 shadow-sm card-stat-green d-flex justify-content-between align-items-center" style="border-radius: 12px;">
                <div>
                    <small class="text-uppercase font-weight-bold" style="opacity: 0.9; font-size: 11px;">Verifikasi Berkas</small>
                    <h2 class="font-weight-bold mb-0 mt-1"><?= $verifikasi ?></h2>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(255,255,255,0.15);">
                    <i class="fas fa-check-circle fa-lg"></i>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-6 mb-2">
            <div class="p-4 shadow-sm card-stat-yellow d-flex justify-content-between align-items-center" style="border-radius: 12px;">
                <div>
                    <small class="text-uppercase font-weight-bold" style="color: #1e293b; font-size: 11px;">Aktivitas Lainnya</small>
                    <h2 class="font-weight-bold mb-0 mt-1" style="color: #0f172a;"><?= $lainnya ?></h2>
                </div>
                <div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; background: rgba(0,0,0,0.1);">
                    <i class="fas fa-cog fa-lg"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- SEARCH & FILTER BAR -->
    <form action="<?= base_url('log-aktivitas') ?>" method="GET" class="bg-white p-3 shadow-sm border mb-4" style="border-radius: 12px;">
        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
            <div class="d-flex flex-wrap align-items-center flex-grow-1" style="gap: 10px;">
                
                <!-- Search Input -->
                <div class="input-group flex-grow-1" style="min-width: 260px;">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-white border-right-0" style="border-radius: 8px 0 0 8px; border-color: #cbd5e1;"><i class="fas fa-search text-muted small"></i></span>
                    </div>
                    <input type="text" name="search" value="<?= esc($search) ?>" class="form-control form-control-ult border-left-0" style="border-radius: 0 8px 8px 0;" placeholder="Cari No Tiket, Nama, NIK...">
                </div>

                <!-- Dropdown Status -->
                <select name="status" class="form-control form-control-ult" style="width: 170px;">
                    <option value="">-- Semua Status --</option>
                    <option value="Disposisi" <?= $status == 'Disposisi' ? 'selected' : '' ?>>Disposisi</option>
                    <option value="Verifikasi" <?= $status == 'Verifikasi' ? 'selected' : '' ?>>Verifikasi</option>
                    <option value="Export Data" <?= $status == 'Export Data' ? 'selected' : '' ?>>Export Data</option>
                    <option value="Lainnya" <?= $status == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                </select>

                <!-- Dropdown Unit -->
                <select name="unit" class="form-control form-control-ult" style="width: 160px;">
                    <option value="">-- Semua Unit --</option>
                    <option value="Akademik">Unit Akademik</option>
                    <option value="Kemahasiswaan">Kemahasiswaan</option>
                    <option value="Keuangan">Keuangan</option>
                </select>

                <!-- Input Limit Angka -->
                <input type="number" name="limit" value="<?= $limit ?>" class="form-control form-control-ult text-center" style="width: 65px;" min="1" max="50">

                <!-- Button Filter -->
                <button type="submit" class="btn btn-ult-filter font-weight-bold px-3 d-flex align-items-center" style="border-radius: 8px; height: 35px; font-size: 13px;">
                    <i class="fas fa-filter mr-1"></i> Filter
                </button>

                <!-- Button Reset Filter -->
                <a href="<?= base_url('log-aktivitas') ?>" class="btn btn-ult-reset px-2.5 d-flex align-items-center justify-content-center" style="border-radius: 8px; height: 35px; width: 35px;" title="Reset Filter">
                    <i class="fas fa-sync-alt"></i>
                </a>
            </div>

            <!-- Button Export Laporan -->
            <button type="button" onclick="exportData()" class="btn btn-ult-export font-weight-bold px-3 d-flex align-items-center" style="border-radius: 8px; height: 35px; font-size: 13px;">
                <i class="fas fa-download mr-1"></i> Export Laporan <i class="fas fa-chevron-down small ml-1"></i>
            </button>
        </div>
    </form>

    <!-- TABEL DATA LOG -->
    <div class="bg-white shadow-sm border overflow-hidden" style="border-radius: 12px;">
        <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-light">
            <h6 class="font-weight-bold text-dark mb-0 d-flex align-items-center" style="font-size: 14px;">
                <i class="fas fa-list-alt text-ult-navy mr-2"></i> Riwayat Log Sistem
            </h6>
            <small class="text-muted">Menampilkan <?= $startData ?>-<?= $endData ?> dari total <?= $totalFiltered ?> log</small>
        </div>

        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="bg-ult-navy text-white text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                    <tr>
                        <th style="padding: 12px 16px;">Waktu</th>
                        <th style="padding: 12px 16px;">Petugas / Aktor</th>
                        <th style="padding: 12px 16px;">Aktivitas</th>
                        <th style="padding: 12px 16px;">Objek Tiket</th>
                        <th style="padding: 12px 16px;">Rincian Detail</th>
                        <th style="padding: 12px 16px;" class="text-right">IP Address</th>
                    </tr>
                </thead>
                <tbody style="font-size: 13px;">
                    <?php if (!empty($logs)): ?>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td class="align-middle px-3">
                                    <div class="font-weight-bold text-dark"><?= esc($log['waktu']) ?></div>
                                    <small class="text-muted"><i class="far fa-clock mr-1"></i><?= esc($log['jam']) ?></small>
                                </td>
                                <td class="align-middle px-3">
                                    <div class="font-weight-bold text-dark"><?= esc($log['aktor']) ?></div>
                                    <small class="text-muted"><?= esc($log['nip']) ?></small>
                                </td>
                                <td class="align-middle px-3">
                                    <?php if ($log['aktivitas'] == 'Disposisi'): ?>
                                        <span class="badge badge-disposisi px-2.5 py-1" style="border-radius: 6px;"><i class="fas fa-share mr-1"></i> Disposisi</span>
                                    <?php elseif ($log['aktivitas'] == 'Verifikasi'): ?>
                                        <span class="badge badge-verifikasi px-2.5 py-1" style="border-radius: 6px;"><i class="fas fa-check-circle mr-1"></i> Verifikasi</span>
                                    <?php elseif ($log['aktivitas'] == 'Export Data'): ?>
                                        <span class="badge badge-export px-2.5 py-1" style="border-radius: 6px;"><i class="fas fa-file-export mr-1"></i> Export Data</span>
                                    <?php else: ?>
                                        <span class="badge badge-lainnya px-2.5 py-1" style="border-radius: 6px;"><i class="fas fa-cog mr-1"></i> <?= esc($log['aktivitas']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle px-3 font-weight-bold <?= $log['objek_tiket'] != '-' ? 'text-primary' : 'text-muted' ?>">
                                    <?= esc($log['objek_tiket']) ?>
                                </td>
                                <td class="align-middle px-3">
                                    <div><?= $log['detail'] ?></div>
                                    <?php if (!empty($log['priority'])): ?>
                                        <?php 
                                            $pClass = 'badge-priority-high';
                                            if ($log['priority'] == 'Medium') $pClass = 'badge-priority-medium';
                                            if ($log['priority'] == 'Low') $pClass = 'badge-priority-low';
                                        ?>
                                        <span class="badge <?= $pClass ?> px-1.5 py-0.5 mt-1 text-uppercase" style="font-size: 9px; border-radius: 4px;"><?= esc($log['priority']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle px-3 text-right text-muted small font-monospace"><?= esc($log['ip_address']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Tidak ada data log aktivitas yang ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- PAGINASI INTERAKTIF -->
        <?php if ($totalPages > 1): ?>
            <div class="p-3 border-top d-flex justify-content-between align-items-center bg-light">
                <small class="text-muted">Halaman <?= $currentPage ?> dari <?= $totalPages ?></small>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item <?= $currentPage <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= base_url('log-aktivitas?page=' . ($currentPage - 1) . '&search=' . urlencode($search) . '&status=' . urlencode($status) . '&limit=' . $limit) ?>">&laquo; Prev</a>
                        </li>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= $currentPage == $i ? 'active' : '' ?>">
                                <a class="page-link" href="<?= base_url('log-aktivitas?page=' . $i . '&search=' . urlencode($search) . '&status=' . urlencode($status) . '&limit=' . $limit) ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>

                        <li class="page-item <?= $currentPage >= $totalPages ? 'disabled' : '' ?>">
                            <a class="page-link" href="<?= base_url('log-aktivitas?page=' . ($currentPage + 1) . '&search=' . urlencode($search) . '&status=' . urlencode($status) . '&limit=' . $limit) ?>">Next &raquo;</a>
                        </li>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>

</div>

<script>
    function exportData() {
        alert('Mengunduh Laporan Log Sistem (Format Excel)...');
    }
</script>

<?= $this->endSection() ?>