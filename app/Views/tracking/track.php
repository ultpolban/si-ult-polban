<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-search"></i>

            Cek Status Tiket

        </h3>

    </div>

    <div class="card-body">

        <form action="<?= site_url('tracking/search') ?>" method="get" class="mb-4">

            <div class="input-group">

                <input type="text" name="ticket_number" class="form-control"

                    placeholder="Masukkan No. Tiket, contoh: ULT-20260715-XXXXXX"

                    value="<?= esc($ticketNumber ?? '') ?>">

                <span class="input-group-append">

                    <button type="submit" class="btn btn-primary">

                        <i class="fas fa-search"></i>

                        Cari

                    </button>

                </span>

            </div>

        </form>

        <?php if (!empty($ticket)): ?>

            <?php $statusMap = [
                'draft' => ['secondary', 'Draft'],
                'submitted' => ['warning', 'Diajukan'],
                'verification' => ['info', 'Verifikasi'],
                'revision' => ['secondary', 'Revisi'],
                'processing' => ['primary', 'Diproses'],
                'completed' => ['success', 'Selesai'],
                'rejected' => ['danger', 'Ditolak'],
                'cancelled' => ['danger', 'Dibatalkan'],
            ];
            [$badge, $label] = $statusMap[$ticket['status'] ?? ''] ?? ['secondary', 'Diajukan'];
            ?>

            <div class="card border-<?= $badge ?> mb-3">

                <div class="card-header">

                    <strong><?= esc($ticket['ticket_number']) ?></strong>

                    <span class="badge badge-<?= $badge ?> float-right"><?= esc($label) ?></span>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                            <p><strong>Judul:</strong> <?= esc($ticket['title']) ?></p>

                            <p><strong>Layanan:</strong> <?= esc($ticket['service_name']) ?></p>

                            <p><strong>Pemohon:</strong> <?= esc($ticket['applicant_name']) ?></p>

                        </div>

                        <div class="col-md-6">

                            <p><strong>Prioritas:</strong> <?= esc(ucfirst($ticket['priority'] ?? 'normal')) ?></p>

                            <p><strong>Diajukan:</strong> <?= esc($ticket['submitted_at'] ?? $ticket['created_at']) ?></p>

                            <a href="<?= site_url('tracking/show/' . $ticket['id']) ?>" class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i> Lihat Detail

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            <?php if (!empty($history)): ?>

                <h5 class="mt-4 mb-3">Riwayat Tiket</h5>

                <div class="timeline">

                    <?php foreach ($history as $h): ?>

                        <div class="time-label">

                            <span class="bg-info"><?= esc($h['created_at']) ?></span>

                        </div>

                        <div>

                            <i class="fas fa-circle bg-primary"></i>

                            <div class="timeline-item">

                                <h3 class="timeline-header"><?= esc($h['full_name'] ?? 'Sistem') ?></h3>

                                <div class="timeline-body">

                                    <?= esc($h['description'] ?? '') ?>

                                    <?php if (!empty($h['old_status']) && !empty($h['new_status'])): ?>

                                        <br>

                                        <span class="badge badge-secondary"><?= esc($h['old_status']) ?></span>

                                        <i class="fas fa-arrow-right"></i>

                                        <span class="badge badge-primary"><?= esc($h['new_status']) ?></span>

                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            <?php endif; ?>

        <?php elseif (isset($ticketNumber) && $ticketNumber !== ''): ?>

            <div class="alert alert-warning">

                <i class="fas fa-exclamation-triangle"></i>

                Tiket dengan nomor <strong><?= esc($ticketNumber) ?></strong> tidak ditemukan.

            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>