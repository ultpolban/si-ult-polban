<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">

    <div>

        <h4 class="mb-0"><?= esc($pageTitle) ?></h4>

        <small class="text-muted">

            Detail tiket layanan.

        </small>

    </div>

    <div>

        <a href="<?= site_url('tickets/edit/' . $ticket['id']) ?>" class="btn btn-warning">

            <i class="fas fa-edit"></i> Edit

        </a>

        <a href="<?= site_url('tickets') ?>" class="btn btn-secondary">

            <i class="fas fa-arrow-left"></i> Kembali

        </a>

    </div>

</div>

<?= $this->include('components/alert') ?>

<div class="row">

    <div class="col-md-8">

        <div class="card mb-3">

            <div class="card-header">

                <h5 class="card-title mb-0">

                    <i class="fas fa-ticket-alt"></i>

                    <?= esc($ticket['ticket_number'] ?? '-') ?>

                </h5>

            </div>

            <div class="card-body">

                <h5><?= esc($ticket['title'] ?? '-') ?></h5>

                <p class="text-muted"><?= esc($ticket['description'] ?? '-') ?></p>

                <hr>

                <div class="row">

                    <div class="col-md-6 mb-2">

                        <strong>Pemohon:</strong>

                        <br>

                        <?= esc($ticket['applicant_name'] ?? '-') ?>

                        <?php if (!empty($ticket['applicant_type'])): ?>

                            <br>

                            <small class="text-muted"><?= esc($ticket['applicant_type']) ?></small>

                        <?php endif; ?>

                    </div>

                    <div class="col-md-6 mb-2">

                        <strong>Layanan:</strong>

                        <br>

                        <?= esc($ticket['service_name'] ?? '-') ?>

                        <?php if (!empty($ticket['service_unit_name'])): ?>

                            <br>

                            <small class="text-muted"><?= esc($ticket['service_unit_name']) ?></small>

                        <?php endif; ?>

                    </div>

                    <div class="col-md-6 mb-2">

                        <strong>Status:</strong>

                        <br>

                        <?php
                        $statusMap = [
                            'submitted'   => ['warning', 'Diajukan'],
                            'verification' => ['info', 'Verifikasi'],
                            'revision'    => ['secondary', 'Revisi'],
                            'processing'  => ['primary', 'Diproses'],
                            'completed'   => ['success', 'Selesai'],
                            'rejected'    => ['danger', 'Ditolak'],
                            'cancelled'   => ['danger', 'Dibatalkan'],
                        ];
                        $st = $ticket['status'] ?? '';
                        [$badge, $label] = $statusMap[$st] ?? ['secondary', ucfirst(str_replace('_', ' ', $st))];
                        ?>

                        <span class="badge bg-<?= $badge ?>"><?= esc($label) ?></span>

                    </div>

                    <div class="col-md-6 mb-2">

                        <strong>Prioritas:</strong>

                        <br>

                        <?php
                        $priorityMap = [
                            'low'    => ['secondary', 'Rendah'],
                            'normal' => ['info', 'Normal'],
                            'high'   => ['warning', 'Tinggi'],
                            'urgent' => ['danger', 'Urgent'],
                        ];
                        $pr = $ticket['priority'] ?? 'normal';
                        [$pBadge, $pLabel] = $priorityMap[$pr] ?? ['info', 'Normal'];
                        ?>

                        <span class="badge bg-<?= $pBadge ?>"><?= esc($pLabel) ?></span>

                    </div>

                    <div class="col-md-6 mb-2">

                        <strong>Diajukan:</strong>

                        <br>

                        <?= esc($ticket['created_at'] ?? '-') ?>

                    </div>

                    <div class="col-md-6 mb-2">

                        <strong>Ditugaskan ke:</strong>

                        <br>

                        <?= esc($ticket['assigned_name'] ?? '-') ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card mb-3">

            <div class="card-header">

                <h5 class="card-title mb-0">

                    <i class="fas fa-history"></i>

                    Riwayat

                </h5>

            </div>

            <div class="card-body">

                <?php if (empty($history)): ?>

                    <p class="text-muted text-center">Belum ada riwayat.</p>

                <?php else: ?>

                    <ul class="timeline">

                        <?php foreach ($history as $h): ?>

                            <li class="mb-3">

                                <div class="fw-bold"><?= esc($h['action'] ?? '-') ?></div>

                                <div class="text-muted small"><?= esc($h['description'] ?? '-') ?></div>

                                <div class="text-muted small">

                                    <?= esc($h['full_name'] ?? '-') ?> - <?= esc($h['created_at'] ?? '-') ?>

                                </div>

                            </li>

                        <?php endforeach; ?>

                    </ul>

                <?php endif; ?>

            </div>

        </div>

        <div class="card">

            <div class="card-header">

                <h5 class="card-title mb-0">

                    <i class="fas fa-edit"></i>

                    Ubah Status

                </h5>

            </div>

            <div class="card-body">

                <form action="<?= site_url('tickets/change-status/' . $ticket['id']) ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="mb-3">

                        <label>Status</label>

                        <select name="status" class="form-select" required>

                            <option value="submitted" <?= $ticket['status'] === 'submitted' ? 'selected' : '' ?>>Diajukan</option>

                            <option value="verification" <?= $ticket['status'] === 'verification' ? 'selected' : '' ?>>Verifikasi</option>

                            <option value="revision" <?= $ticket['status'] === 'revision' ? 'selected' : '' ?>>Revisi</option>

                            <option value="processing" <?= $ticket['status'] === 'processing' ? 'selected' : '' ?>>Diproses</option>

                            <option value="completed" <?= $ticket['status'] === 'completed' ? 'selected' : '' ?>>Selesai</option>

                            <option value="rejected" <?= $ticket['status'] === 'rejected' ? 'selected' : '' ?>>Ditolak</option>

                            <option value="cancelled" <?= $ticket['status'] === 'cancelled' ? 'selected' : '' ?>>Dibatalkan</option>

                        </select>

                    </div>

                    <div class="mb-3">

                        <label>Catatan</label>

                        <textarea name="note" class="form-control" rows="3" placeholder="Catatan perubahan status"></textarea>

                    </div>

                    <button type="submit" class="btn btn-primary w-100">

                        <i class="fas fa-save"></i>

                        Simpan

                    </button>

                </form>

                <hr>

                <button type="button"
                    class="btn btn-danger w-100 btn-delete-ticket"
                    data-id="<?= $ticket['id'] ?>"
                    data-name="<?= esc($ticket['ticket_number'] ?? ('Tiket #' . $ticket['id'])) ?>">
                    <i class="fas fa-trash"></i> Hapus Tiket
                </button>

            </div>

        </div>

    </div>

</div>

<?= $this->include('tickets/_modal') ?>

<?= $this->endSection() ?>