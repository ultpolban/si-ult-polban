<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold text-dark">
            <i class="bi bi-file-earmark-text-fill text-primary me-2"></i>Laporan Pengajuan
        </h4>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 border-bottom">
        <!-- Export Dropdown -->
        <div class="mb-3">
            <h5 class="fw-bold mb-2"><i class="bi bi-file-earmark-text-fill me-2"></i>Laporan Pengajuan</h5>
            <div class="dropdown">
                <button class="btn btn-primary btn-sm dropdown-toggle shadow-sm" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-download me-1"></i> Export Laporan
                </button>
                <ul class="dropdown-menu shadow" aria-labelledby="exportDropdown">
                    <li>
                        <a class="dropdown-item text-danger" href="<?= base_url('laporan') ?>?export=pdf&status=<?= urlencode($status) ?>&unit_id=<?= urlencode($unit_id) ?>&applicant_type_id=<?= urlencode($applicant_type_id) ?>&start_date=<?= urlencode($start_date) ?>&end_date=<?= urlencode($end_date) ?>" target="_blank">
                            <i class="bi bi-file-earmark-pdf-fill me-2"></i> Export PDF
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item text-success" href="<?= base_url('laporan') ?>?export=excel&status=<?= urlencode($status) ?>&unit_id=<?= urlencode($unit_id) ?>&applicant_type_id=<?= urlencode($applicant_type_id) ?>&start_date=<?= urlencode($start_date) ?>&end_date=<?= urlencode($end_date) ?>">
                            <i class="bi bi-file-earmark-excel-fill me-2"></i> Export Excel
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item text-secondary" href="<?= base_url('laporan') ?>?export=csv&status=<?= urlencode($status) ?>&unit_id=<?= urlencode($unit_id) ?>&applicant_type_id=<?= urlencode($applicant_type_id) ?>&start_date=<?= urlencode($start_date) ?>&end_date=<?= urlencode($end_date) ?>">
                            <i class="bi bi-filetype-csv me-2"></i> Export CSV
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Filter Bar -->
        <form method="GET" action="<?= base_url('laporan') ?>" class="row g-2 align-items-center">
            
            <div class="col-md-2">
                <select name="status" class="form-select bg-light text-muted">
                    <option value="">Semua Status</option>
                    <option value="submitted" <?= $status === 'submitted' ? 'selected' : '' ?>>Diajukan</option>
                    <option value="in_progress" <?= $status === 'in_progress' ? 'selected' : '' ?>>Diproses</option>
                    <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Selesai</option>
                    <option value="rejected" <?= $status === 'rejected' ? 'selected' : '' ?>>Ditolak</option>
                </select>
            </div>
            
            <div class="col-md-3">
                <select name="unit_id" class="form-select bg-light text-muted">
                    <option value="">Semua Unit</option>
                    <?php foreach ($units as $u) : ?>
                        <option value="<?= $u['id'] ?>" <?= $unit_id == $u['id'] ? 'selected' : '' ?>>
                            <?= esc($u['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-3">
                <select name="applicant_type_id" class="form-select bg-light text-muted">
                    <option value="">Semua Jenis Pemohon</option>
                    <?php foreach ($applicantTypes as $type) : ?>
                        <option value="<?= $type['id'] ?>" <?= $applicant_type_id == $type['id'] ? 'selected' : '' ?>>
                            <?= esc($type['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-4">
                <div class="input-group">
                    <input type="date" name="start_date" class="form-control bg-light text-muted" value="<?= esc($start_date) ?>" placeholder="dd/mm/yyyy">
                    <span class="input-group-text bg-light border-0">s/d</span>
                    <input type="date" name="end_date" class="form-control bg-light text-muted" value="<?= esc($end_date) ?>" placeholder="dd/mm/yyyy">
                </div>
            </div>
            
            <div class="col-12 mt-2">
                <button type="submit" class="btn btn-primary btn-sm shadow-sm">
                    <i class="bi bi-funnel-fill me-1"></i> Filter
                </button>
                <a href="<?= base_url('laporan') ?>" class="btn btn-secondary btn-sm shadow-sm text-white ms-1" style="background-color: #475569;">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 border-bottom">
                <thead class="table-light text-muted" style="font-size: 0.85rem;">
                    <tr>
                        <th class="ps-4 fw-semibold" style="width:50px;">No</th>
                        <th class="fw-semibold">No. Tiket</th>
                        <th class="fw-semibold">Judul</th>
                        <th class="fw-semibold">Layanan</th>
                        <th class="fw-semibold">Unit</th>
                        <th class="fw-semibold">Pemohon</th>
                        <th class="fw-semibold">Jenis Pemohon</th>
                        <th class="fw-semibold">Status</th>
                        <th class="fw-semibold">Prioritas</th>
                        <th class="fw-semibold">Tanggal</th>
                    </tr>
                </thead>
                <tbody style="font-size: 0.9rem;">
                    <?php if (empty($laporan)) : ?>
                        <tr>
                            <td colspan="10" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-25"></i>
                                Tidak ada data pengajuan yang sesuai dengan filter.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($laporan as $i => $row) : ?>
                            <?php
                                // Status badge
                                $st = $row['status'] ?? 'submitted';
                                $statusMap = [
                                    'submitted'   => ['label' => 'Diajukan',  'class' => 'bg-warning text-dark'],
                                    'in_progress' => ['label' => 'Diproses',  'class' => 'bg-info text-dark'],
                                    'completed'   => ['label' => 'Selesai',   'class' => 'bg-success'],
                                    'rejected'    => ['label' => 'Ditolak',   'class' => 'bg-danger'],
                                    'cancelled'   => ['label' => 'Dibatalkan','class' => 'bg-secondary'],
                                ];
                                $statusInfo = $statusMap[$st] ?? ['label' => ucfirst($st), 'class' => 'bg-secondary'];

                                // Priority text mapping
                                $pr = $row['priority'] ?? 'normal';
                                $priorityMap = [
                                    'normal' => 'Normal',
                                    'high'   => 'Penting',
                                    'urgent' => 'Mendesak',
                                ];
                                $priorityLabel = $priorityMap[$pr] ?? ucfirst($pr);
                                
                                $num = (($page - 1) * $perPage) + $i + 1;
                            ?>
                            <tr>
                                <td class="ps-4 text-muted"><?= $num ?></td>
                                <td>
                                    <span class="badge bg-light text-primary border border-primary border-opacity-25 px-2 py-1">
                                        <?= esc($row['ticket_number']) ?>
                                    </span>
                                </td>
                                <td class="fw-medium text-dark"><?= esc($row['title']) ?></td>
                                <td class="text-dark"><?= esc($row['layanan_nama'] ?? '-') ?></td>
                                <td class="text-dark"><?= esc($row['unit_nama'] ?? '-') ?></td>
                                <td class="text-dark"><?= esc($row['pemohon_nama'] ?? 'Unknown') ?></td>
                                <td class="text-muted"><small><?= esc($row['pemohon_tipe'] ?? '-') ?></small></td>
                                <td>
                                    <span class="badge rounded-pill px-2 py-1 <?= $statusInfo['class'] ?>" style="font-size: 0.8rem;">
                                        <?= $statusInfo['label'] ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-muted" style="font-size: 0.85rem;"><?= $priorityLabel ?></span>
                                </td>
                                <td>
                                    <div class="text-dark" style="font-size: 0.85rem;"><?= date('Y-m-d H:i:s', strtotime($row['created_at'])) ?></div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <?php if (isset($totalPages) && $totalPages > 1) : ?>
    <div class="card-footer bg-white py-3 d-flex justify-content-between align-items-center">
        <small class="text-muted">
            Menampilkan <?= count($laporan) ?> dari <?= number_format($total) ?> data
        </small>
        <nav>
            <ul class="pagination pagination-sm mb-0 gap-1">
                <?php if ($page > 1) : ?>
                    <li class="page-item">
                        <a class="page-link rounded shadow-sm" href="?page=<?= $page - 1 ?>&status=<?= urlencode($status) ?>&unit_id=<?= urlencode($unit_id) ?>&applicant_type_id=<?= urlencode($applicant_type_id) ?>&start_date=<?= urlencode($start_date) ?>&end_date=<?= urlencode($end_date) ?>">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php for ($p = max(1, $page - 2); $p <= min($totalPages, $page + 2); $p++) : ?>
                    <li class="page-item <?= $p === $page ? 'active' : '' ?>">
                        <a class="page-link rounded shadow-sm" href="?page=<?= $p ?>&status=<?= urlencode($status) ?>&unit_id=<?= urlencode($unit_id) ?>&applicant_type_id=<?= urlencode($applicant_type_id) ?>&start_date=<?= urlencode($start_date) ?>&end_date=<?= urlencode($end_date) ?>"><?= $p ?></a>
                    </li>
                <?php endfor; ?>
                
                <?php if ($page < $totalPages) : ?>
                    <li class="page-item">
                        <a class="page-link rounded shadow-sm" href="?page=<?= $page + 1 ?>&status=<?= urlencode($status) ?>&unit_id=<?= urlencode($unit_id) ?>&applicant_type_id=<?= urlencode($applicant_type_id) ?>&start_date=<?= urlencode($start_date) ?>&end_date=<?= urlencode($end_date) ?>">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <?php endif; ?>
</div>

<style>
    .table-hover tbody tr:hover {
        background-color: #f8fafc;
        transition: all 0.2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.15);
    }
</style>

<?= $this->endSection() ?>
