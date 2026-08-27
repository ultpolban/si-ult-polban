<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="mb-1 fw-bold text-dark">Buat Tiket</h4>
        <small class="text-muted">Buat tiket layanan baru.</small>
    </div>
    <div>
        <a href="<?= base_url('tiket/manajemen') ?>" class="btn btn-secondary btn-sm shadow-sm rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
</div>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 bg-danger bg-opacity-10 text-danger mb-4">
        <i class="bi bi-exclamation-triangle-fill me-2"></i><?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form action="<?= base_url('tiket/simpan') ?>" method="post">
            <?= csrf_field() ?>

            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Pemohon <span class="text-danger">*</span></label>
                    <select name="pemohon_id" class="form-select bg-light border-0 py-2" required>
                        <option value="">Pilih Pemohon</option>
                        <?php foreach($users as $user): ?>
                            <option value="<?= $user['id'] ?>"><?= esc($user['name']) ?> (<?= esc($user['email']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Jenis Unit Layanan <span class="text-danger">*</span></label>
                    <select name="unit_id" class="form-select bg-light border-0 py-2" required>
                        <option value="">Pilih Jenis Unit Layanan</option>
                        <?php foreach($units as $unit): ?>
                            <option value="<?= $unit['id'] ?>"><?= esc($unit['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Layanan <span class="text-danger">*</span></label>
                    <select name="layanan_id" class="form-select bg-light border-0 py-2" required>
                        <option value="">Pilih Layanan</option>
                        <?php foreach($services as $service): ?>
                            <option value="<?= $service['id'] ?>"><?= esc($service['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Prioritas <span class="text-danger">*</span></label>
                    <select name="prioritas" class="form-select bg-light border-0 py-2" required>
                        <option value="normal">Normal</option>
                        <option value="high">Penting</option>
                        <option value="urgent">Mendesak</option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label text-muted small fw-semibold">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control bg-light border-0" rows="5" placeholder="Deskripsi masalah / kebutuhan"></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted small fw-semibold">Ditugaskan ke</label>
                    <select name="ditugaskan_ke" class="form-select bg-light border-0 py-2">
                        <option value="">Pilih Petugas</option>
                        <?php foreach($officers as $officer): ?>
                            <option value="<?= $officer['id'] ?>">
                                <?= esc($officer['name']) ?><?= !empty($officer['role_name']) ? ' — ' . esc($officer['role_name']) : '' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12 mt-4 pt-3 border-top">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm btn-simpan">
                        <i class="bi bi-floppy me-2"></i> Simpan
                    </button>
                    <a href="<?= base_url('tiket/manajemen') ?>" class="btn btn-secondary px-4 shadow-sm">
                        Kembali
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    .form-control, .form-select {
        transition: all 0.25s ease;
    }
    .form-control:focus, .form-select:focus {
        background-color: #fff !important;
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        transform: translateY(-1px);
    }
    .btn-simpan {
        transition: all 0.3s ease;
    }
    .btn-simpan:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(13, 110, 253, 0.3) !important;
    }
</style>

<?= $this->endSection() ?>
