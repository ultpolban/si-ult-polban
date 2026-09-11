<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
    $tiket = $tiket ?? [];
    $id = (int) ($tiket['id'] ?? 0);
?>

<div class="mb-4">
    <h2 class="dashboard-title mb-1">Upload Hasil Layanan</h2>
    <p class="dashboard-subtitle mb-0">Unggah hasil layanan untuk tiket Administrasi Umum.</p>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header text-white" style="background:#293582">
        <h5 class="mb-0">
            <i class="fas fa-upload me-2"></i>
            <?= esc($tiket['ticket_number'] ?? '-') ?>
        </h5>
    </div>

    <div class="card-body p-4">
        <form method="post" enctype="multipart/form-data" action="<?= base_url('administrasi-umum/upload/' . $id) ?>">
            <div class="mb-3">
                <label class="form-label fw-bold">Catatan Hasil</label>
                <textarea
                    name="result_note"
                    class="form-control"
                    rows="4"
                    placeholder="Tulis ringkasan hasil layanan..."
                ><?= esc($tiket['result_note'] ?? '') ?></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">File Hasil Layanan</label>
                <input
                    type="file"
                    name="result_file[]"
                    class="form-control"
                    accept=".pdf,.jpg,.jpeg,.png"
                    multiple
                >
                <small class="text-muted d-block mt-2">
                    Format file: PDF, JPG, PNG. Maksimal 5 MB per file. Bisa upload beberapa file sekaligus.
                </small>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <button class="btn btn-primary">
                    <i class="fas fa-save me-1"></i>
                    Upload Hasil Layanan
                </button>

                <a href="<?= base_url('administrasi-umum/detail/' . $id) ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i>
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
