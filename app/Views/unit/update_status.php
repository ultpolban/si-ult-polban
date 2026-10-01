<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
$labelStatus = [
    'assigned'   => 'Menunggu Tindak Lanjut',
    'processing' => 'Sedang Diproses',
    'completed'  => 'Selesai',
    'rejected'   => 'Ditolak',
];

$current = strtolower(trim($ticket['status'] ?? ''));
?>

<div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

    <div>

        <h2 class="mb-1">Update Status Tiket</h2>

        <p class="text-muted mb-0"><?= esc($ticket['ticket_number'] ?? '-') ?></p>

    </div>

    <a href="<?= base_url('unit') ?>" class="btn btn-secondary btn-sm">

        <i class="fas fa-arrow-left me-1"></i> Data Tiket

    </a>

</div>

<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>

<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>

    <?php foreach (session()->getFlashdata('errors') as $error): ?>

        <div class="alert alert-danger"><?= esc($error) ?></div>

    <?php endforeach; ?>

<?php endif; ?>

<div class="card">

    <div class="card-header"><h3 class="card-title">Form Update Status</h3></div>

    <div class="card-body">

        <form
            method="post"
            action="<?= base_url('unit/update-status/' . $ticket['id']) ?>"
            data-lock-submit>

            <?= csrf_field() ?>

            <div class="mb-3">

                <label class="form-label">Status Saat Ini</label>

                <input
                    type="text"
                    class="form-control"
                    value="<?= esc($labelStatus[$current] ?? $current) ?>"
                    disabled>

            </div>

            <div class="mb-3">

                <label class="form-label">Status Baru <span class="text-danger">*</span></label>

                <select name="status" class="form-select" required>

                    <option value="">-- Pilih Status --</option>

                    <?php foreach ($statuses as $status): ?>

                        <option
                            value="<?= esc($status) ?>"
                            <?= old('status', $current) === $status ? 'selected' : '' ?>>

                            <?= esc($labelStatus[$status] ?? ucfirst($status)) ?>

                        </option>

                    <?php endforeach; ?>

                </select>

            </div>

            <div class="mb-3">

                <label class="form-label">Catatan</label>

                <textarea
                    name="catatan"
                    class="form-control"
                    rows="3"
                    maxlength="500"
                    placeholder="Tambahkan keterangan perubahan status (opsional)"><?= esc(old('catatan')) ?></textarea>

            </div>

            <button type="submit" class="btn btn-primary">

                <i class="fas fa-save me-1"></i> Simpan Perubahan

            </button>

            <a href="<?= base_url('unit') ?>" class="btn btn-secondary">Batal</a>

        </form>

    </div>

</div>

<?= $this->endSection() ?>
