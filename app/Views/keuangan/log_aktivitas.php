<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>

/* =========================================================
   HEADER
========================================================= */

.log-header {
    margin-bottom: 25px;
}

.log-title {
    font-size: 30px;
    font-weight: 700;
    color: #172033;
    margin-bottom: 5px;
}

.log-subtitle {
    color: #6c757d;
    margin-bottom: 0;
}

/* =========================================================
   FILTERS
========================================================= */

.filter-section {
    background: #f8f9ff;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 25px;
}

.filter-section .form-label {
    font-weight: 600;
    color: #172033;
    margin-bottom: 8px;
}

.filter-section .form-control,
.filter-section .form-select {
    border-radius: 8px;
    border: 1px solid #e0e6ed;
}

.filter-section .form-control:focus,
.filter-section .form-select:focus {
    border-color: #293582;
    box-shadow: 0 0 0 0.2rem rgba(41, 53, 130, 0.25);
}

/* =========================================================
   CARD
========================================================= */

.card-logs {
    border: none;
    border-radius: 18px;
    box-shadow: 0 8px 25px rgba(0,0,0,.08);
    overflow: hidden;
}

.card-logs .card-header {
    background: #ffffff;
    border-bottom: 1px solid #eeeeee;
    padding: 20px;
}

/* =========================================================
   TABLE
========================================================= */

.table {
    margin-bottom: 0;
    min-width: 1100px;
}

.table thead th {
    background: #293582;
    color: #ffffff;
    font-weight: 600;
    vertical-align: middle;
    white-space: nowrap;
    padding: 14px 12px;
}

.table tbody td {
    vertical-align: middle;
    padding: 13px 12px;
}

.table tbody tr:hover {
    background: #f8f9ff;
}

/* =========================================================
   BADGE
========================================================= */

.badge-unit {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    background: #e3f2fd;
    color: #1976d2;
}

.badge-status {
    display: inline-block;
    padding: 7px 13px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    white-space: nowrap;
}

.status-pending {
    background: #fff3cd;
    color: #856404;
}

.status-processing {
    background: #cce5ff;
    color: #0c5460;
}

.status-completed {
    background: #d4edda;
    color: #155724;
}

/* =========================================================
   EMPTY STATE
========================================================= */

.empty-state {
    text-align: center;
    padding: 40px 20px;
}

.empty-state-icon {
    font-size: 48px;
    color: #ccc;
    margin-bottom: 15px;
}

.empty-state-text {
    color: #999;
    font-size: 16px;
}

/* =========================================================
   RESPONSIVE
========================================================= */

@media (max-width: 768px) {

    .log-title {
        font-size: 22px;
    }

    .table {
        font-size: 13px;
        min-width: 100%;
    }

    .table thead th {
        padding: 10px 8px;
    }

    .table tbody td {
        padding: 10px 8px;
    }

    .badge-status {
        padding: 5px 10px;
        font-size: 11px;
    }

}

</style>

<!-- =========================================================
     HEADER
========================================================= -->

<div class="log-header">
    <h1 class="log-title">
        📋 Log Aktivitas <?= esc($unit ?? 'Unit Layanan') ?>
    </h1>
    <p class="log-subtitle">
        Pantau semua aktivitas dan perubahan status tiket di unit
        <?= esc($unit ?? 'Unit Layanan') ?>
    </p>
</div>

<!-- =========================================================
     FILTER SECTION
========================================================= -->

<div class="filter-section">
    <form method="get" class="row g-3">
        
        <div class="col-md-6">
            <label for="keyword" class="form-label">🔍 Cari Aktivitas</label>
            <input 
                type="text" 
                class="form-control" 
                id="keyword" 
                name="keyword"
                placeholder="Cari tiket, unit, layanan, atau status..."
                value="<?= esc($keyword ?? '') ?>"
            >
        </div>

        <div class="col-md-4">
            <label for="unit_filter" class="form-label">🏢 Filter Unit</label>
            <select class="form-select" id="unit_filter" name="unit">
                <option value="">Semua Unit</option>
                <?php foreach($units as $u): ?>
                    <option value="<?= esc($u) ?>" <?= (($unit ?? '') === $u) ? 'selected' : '' ?>>
                        <?= esc($u) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">
                Cari
            </button>
        </div>

    </form>
</div>

<!-- =========================================================
     CARD LOG AKTIVITAS
========================================================= -->

<div class="card card-logs">

    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">📝 Daftar Log Aktivitas</h5>
            <small class="text-muted"><?= count($logs ?? []) ?> Aktivitas</small>
        </div>
    </div>

    <div class="card-body">

        <?php if(empty($logs)): ?>

            <div class="empty-state">
                <div class="empty-state-icon">📭</div>
                <p class="empty-state-text">
                    Belum ada log aktivitas.
                    <?php if($keyword || $unit): ?>
                        Coba ubah filter pencarian Anda.
                    <?php endif; ?>
                </p>
            </div>

        <?php else: ?>

            <div class="table-responsive">
                <table class="table table-hover">

                    <thead>
                        <tr>
                            <th style="width: 12%;">No Tiket</th>
                            <th style="width: 15%;">Unit</th>
                            <th style="width: 15%;">Layanan</th>
                            <th style="width: 35%;">Aktivitas</th>
                            <th style="width: 12%;">Status</th>
                            <th style="width: 11%;">Waktu</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach($logs as $log): ?>
                            <tr>
                                <td>
                                    <strong><?= esc($log['no_tiket'] ?? '-') ?></strong>
                                </td>

                                <td>
                                    <span class="badge-unit">
                                        <?= esc($log['unit'] ?? '-') ?>
                                    </span>
                                </td>

                                <td>
                                    <?= esc($log['layanan'] ?? '-') ?>
                                </td>

                                <td>
                                    <small><?= esc($log['aktivitas'] ?? '-') ?></small>
                                </td>

                                <td>
                                    <?php
                                        $status = strtolower($log['status'] ?? '');
                                        $badge_class = 'badge-status status-pending';
                                        
                                        if(str_contains($status, 'menunggu')) {
                                            $badge_class = 'badge-status status-pending';
                                        } elseif(str_contains($status, 'diproses') || str_contains($status, 'processing')) {
                                            $badge_class = 'badge-status status-processing';
                                        } elseif(str_contains($status, 'selesai') || str_contains($status, 'completed')) {
                                            $badge_class = 'badge-status status-completed';
                                        }
                                    ?>
                                    <span class="<?= $badge_class ?>">
                                        <?= esc($log['status'] ?? '-') ?>
                                    </span>
                                </td>

                                <td>
                                    <small class="text-muted">
                                        <?= esc($log['waktu'] ?? $log['tanggal'] ?? '-') ?>
                                    </small>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>
