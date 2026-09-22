<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">

    <div class="col-md-12">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">

                    <i class="fas fa-ticket-alt"></i>

                    Tiket Saya

                </h3>

                <div class="card-tools">

                    <a href="<?= site_url('tracking/track') ?>" class="btn btn-primary btn-sm">

                        <i class="fas fa-search"></i>

                        Cek Status Tiket

                    </a>

                </div>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover table-sm">

                        <thead>

                            <tr>

                                <th>No</th>

                                <th>Tiket</th>

                                <th>Judul</th>

                                <th>Layanan</th>

                                <th>Status</th>

                                <th>Tanggal</th>

                                <th>Aksi</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if (empty($myTickets)): ?>

                                <tr>

                                    <td colspan="7" class="text-center text-muted">Belum ada tiket.</td>

                                </tr>

                            <?php else: ?>

                                <?php $no = 1; ?>

                                <?php foreach ($myTickets as $t): ?>

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
                                    [$badge, $label] = $statusMap[$t['status'] ?? ''] ?? ['secondary', 'Diajukan'];
                                    ?>

                                    <tr>

                                        <td><?= $no++ ?></td>

                                        <td><span class="badge badge-info"><?= esc($t['ticket_number']) ?></span></td>

                                        <td><?= esc($t['title']) ?></td>

                                        <td><?= esc($t['service_name']) ?></td>

                                        <td><span class="badge badge-<?= $badge ?>"><?= esc($label) ?></span></td>

                                        <td><?= esc($t['created_at']) ?></td>

                                        <td>

                                            <a href="<?= site_url('tracking/show/' . $t['id']) ?>" class="btn btn-info btn-xs">

                                                <i class="fas fa-eye"></i>

                                            </a>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>