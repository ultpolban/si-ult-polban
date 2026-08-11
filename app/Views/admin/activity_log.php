<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-0 text-primary">Activity Log</h4>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3">
        <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Activity Log</h5>
    </div>
    
    <div class="card-body p-0">
        <div class="p-3 border-bottom">
            <div class="w-100" style="max-width: 400px;">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari aksi / modul...">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>User</th>
                        <th>Aksi</th>
                        <th>Modul</th>
                        <th>Tanggal</th>
                        <th class="pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($logs)) : ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                Belum ada aktivitas.
                            </td>
                        </tr>
                    <?php else : ?>
                        <!-- If data exists -->
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
