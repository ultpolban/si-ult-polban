<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="process-header">
    <h2 class="process-title">Upload Hasil Layanan Perpustakaan</h2>
    <p class="process-subtitle">Unggah hasil pelayanan untuk tiket yang telah selesai diproses.</p>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
<?php endif; ?>

<div class="card process-card">
    <div class="card-header process-card-header">
        <h5>Dokumen Hasil Layanan</h5>
    </div>

    <div class="card-body process-card-body">
        <div class="mb-4">
            <label class="process-label">No Tiket</label>
            <div class="process-control readonly-box"><?= esc($tiket['ticket_number'] ?? $tiket['no_tiket'] ?? '-') ?></div>
        </div>

        <form action="<?= site_url('perpustakaan/simpanUpload/' . ($tiket['id'] ?? 0)) ?>" method="post" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="dokumen" class="process-label">Pilih Dokumen</label>
                <input type="file" name="dokumen" id="dokumen" class="form-control process-control" required>
            </div>

            <div class="process-actions">
                <button type="submit" class="btn btn-success"><i class="fas fa-upload me-1"></i>Upload</button>
                <a href="<?= site_url('perpustakaan/detail/' . ($tiket['id'] ?? 0)) ?>" class="btn btn-back"><i class="fas fa-arrow-left me-1"></i>Kembali</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
