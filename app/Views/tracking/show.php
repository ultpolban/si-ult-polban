<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">

    <div class="col-md-8">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-ticket-alt"></i>

                    Detail Tiket

                </h3>

                <div class="card-tools">

                    <a href="<?= site_url('tracking') ?>" class="btn btn-secondary btn-sm">

                        <i class="fas fa-arrow-left"></i>

                        Kembali

                    </a>

                </div>

            </div>

            <div class="card-body">

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

                <table class="table table-bordered">

                    <tr>

                        <th style="width:200px;">No. Tiket</th>

                        <td><span class="badge badge-info"><?= esc($ticket['ticket_number']) ?></span></td>

                    </tr>

                    <tr>

                        <th>Judul</th>

                        <td><?= esc($ticket['title']) ?></td>

                    </tr>

                    <tr>

                        <th>Layanan</th>

                        <td><?= esc($ticket['service_name']) ?></td>

                    </tr>

                    <tr>

                        <th>Pemohon</th>

                        <td><?= esc($ticket['applicant_name']) ?></td>

                    </tr>

                    <tr>

                        <th>Status</th>

                        <td><span class="badge badge-<?= $badge ?>"><?= esc($label) ?></span></td>

                    </tr>

                    <tr>

                        <th>Prioritas</th>

                        <td><?= esc(ucfirst($ticket['priority'] ?? 'normal')) ?></td>

                    </tr>

                    <tr>

                        <th>Deskripsi</th>

                        <td><?= nl2br(esc($ticket['description'] ?? '-')) ?></td>

                    </tr>

                    <tr>

                        <th>Diajukan</th>

                        <td><?= esc($ticket['submitted_at'] ?? $ticket['created_at']) ?></td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">Riwayat Tiket</h3>

            </div>

            <div class="card-body">

                <?php if (empty($history)): ?>

                    <p class="text-muted">Belum ada riwayat.</p>

                <?php else: ?>

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

            </div>

        </div>

        <?php if (!empty($files)): ?>

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">Dokumen</h3>

                </div>

                <div class="card-body">

                    <ul class="list-group">

                        <?php foreach ($files as $file): ?>

                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                <?= esc($file['original_name'] ?? $file['file_name']) ?>

                                <span class="badge badge-secondary"><?= esc($file['file_extension'] ?? '') ?></span>

                            </li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>