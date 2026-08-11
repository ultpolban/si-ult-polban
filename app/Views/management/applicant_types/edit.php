<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0"><?= esc($title) ?></h4>
        <small class="text-muted">
            Edit jenis pemohon
        </small>
    </div>
    <a href="<?= site_url('management/applicant-types') ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i>
        Kembali
    </a>
</div>

<?= $this->include('components/alert') ?>

<div class="card">
    <div class="card-body">
        <form action="<?= site_url('management/applicant-types/update/' . $type['id']) ?>" method="post">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label>Kode <span class="text-danger">*</span></label>
                <input type="text" name="code" class="form-control" value="<?= esc($type['code']) ?>" required>
                <small class="text-muted">Kode unik untuk jenis pemohon</small>
            </div>
            
            <div class="mb-3">
                <label>Nama <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" value="<?= esc($type['name']) ?>" required>
            </div>
            
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="3"><?= esc($type['description'] ?? '') ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>