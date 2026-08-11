<form action="<?= site_url('tickets') ?>" method="get" class="mb-3">
    <div class="row g-2">
        <div class="col-md-4">
            <input type="text" name="keyword" class="form-control" placeholder="Cari tiket / judul / pemohon..." value="<?= esc($keyword ?? '') ?>">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <?php foreach (
                    [
                        'submitted' => 'Diajukan',
                        'verification' => 'Verifikasi',
                        'revision' => 'Revisi',
                        'processing' => 'Diproses',
                        'completed' => 'Selesai',
                        'rejected' => 'Ditolak',
                        'cancelled' => 'Dibatalkan'
                    ] as $value => $label
                ): ?>
                    <option value="<?= $value ?>" <?= ($status ?? '') === $value ? 'selected' : '' ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="priority" class="form-select">
                <option value="">Semua Prioritas</option>
                <?php foreach (
                    [
                        'low' => 'Rendah',
                        'normal' => 'Normal',
                        'high' => 'Tinggi',
                        'urgent' => 'Urgent'
                    ] as $value => $label
                ): ?>
                    <option value="<?= $value ?>" <?= ($priority ?? '') === $value ? 'selected' : '' ?>><?= $label ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-search"></i> Cari
            </button>
        </div>
    </div>
</form>