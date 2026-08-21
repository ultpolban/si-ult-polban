<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h3 class="card-title m-0 font-weight-bold">
                <i class="fas fa-ticket-alt text-primary mr-1"></i> Detail Tiket
            </h3>
            <div class="card-tools">
                <a href="<?= site_url('verification') ?>" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>

        <div class="card-body">
            <!-- FLASH MESSAGES -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= esc(session()->getFlashdata('success')) ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?= esc(session()->getFlashdata('error')) ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- INFORMASI TIKET -->
            <h5 class="mb-3 font-weight-bold text-dark">Informasi Tiket</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="25%" class="bg-light">Nomor Tiket</th>
                        <td><?= esc($ticket['ticket_number'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Layanan</th>
                        <td><?= esc($ticket['service_display_name'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Kode Layanan</th>
                        <td><?= esc($ticket['service_code'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Status</th>
                        <td>
                            <?php
                            $status = strtolower(trim($ticket['status'] ?? ''));
                            $badge = 'secondary';

                            if ($status === 'submitted') {
                                $badge = 'warning';
                            } elseif ($status === 'verified') {
                                $badge = 'success';
                            } elseif (in_array($status, ['need_revision', 'revision'])) {
                                $badge = 'info';
                            } elseif ($status === 'rejected') {
                                $badge = 'danger';
                            }
                            ?>
                            <span class="badge badge-<?= $badge ?> p-2">
                                <?= esc(str_replace('_', ' ', strtoupper($ticket['status'] ?? '-'))) ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light">Prioritas</th>
                        <td><?= esc(ucfirst($ticket['priority'] ?? '-')) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Tanggal Pengajuan</th>
                        <td><?= esc($ticket['submitted_at'] ?? $ticket['created_at'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Tanggal Verifikasi</th>
                        <td><?= esc($ticket['verified_at'] ?? '-') ?></td>
                    </tr>
                </table>
            </div>

            <!-- DATA PEMOHON -->
            <h5 class="mt-4 mb-3 font-weight-bold text-dark">Data Pemohon</h5>
            <?php if (!empty($profile)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <?php foreach ($profile as $key => $value): ?>
                            <?php if (in_array($key, ['id', 'created_at', 'updated_at'])) continue; ?>
                            <tr>
                                <th width="25%" class="bg-light">
                                    <?= esc(ucwords(str_replace('_', ' ', $key))) ?>
                                </th>
                                <td><?= esc($value ?? '-') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info">Data profil pemohon tidak ditemukan.</div>
            <?php endif; ?>

            <!-- UNIT LAYANAN -->
            <?php if (!empty($unit)): ?>
                <h5 class="mt-4 mb-3 font-weight-bold text-dark">Unit Layanan</h5>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <?php foreach ($unit as $key => $value): ?>
                            <?php if (in_array($key, ['id', 'created_at', 'updated_at'])) continue; ?>
                            <tr>
                                <th width="25%" class="bg-light">
                                    <?= esc(ucwords(str_replace('_', ' ', $key))) ?>
                                </th>
                                <td><?= esc($value ?? '-') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php endif; ?>

            <!-- TINDAKAN VERIFIKASI ADMIN -->
            <?php if ($status === 'submitted'): ?>
                <hr class="my-4">
                <div class="card border-primary mb-4">
                    <div class="card-header bg-primary text-white font-weight-bold">
                        <i class="fas fa-gavel mr-1"></i> Keputusan Verifikasi Admin
                    </div>
                    <div class="card-body">
                        <p class="text-muted">Pilih salah satu opsi tindakan verifikasi berkas di bawah ini:</p>
                        <div class="row">
                            <!-- Button Trigger Modal Approve & Disposisi -->
                            <div class="col-md-4 mb-2">
                                <button type="button" class="btn btn-success btn-block font-weight-bold" data-toggle="modal" data-target="#approveModal">
                                    <i class="fas fa-check-circle mr-1"></i> Verifikasi & Disposisi
                                </button>
                            </div>

                            <!-- Button Trigger Modal Revisi -->
                            <div class="col-md-4 mb-2">
                                <button type="button" class="btn btn-warning text-white btn-block font-weight-bold" data-toggle="modal" data-target="#revisionModal">
                                    <i class="fas fa-edit mr-1"></i> Minta Revisi
                                </button>
                            </div>

                            <!-- Button Trigger Modal Reject -->
                            <div class="col-md-4 mb-2">
                                <button type="button" class="btn btn-danger btn-block font-weight-bold" data-toggle="modal" data-target="#rejectModal">
                                    <i class="fas fa-times-circle mr-1"></i> Tolak Tiket
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- RIWAYAT KOMENTAR -->
            <h5 class="mt-4 mb-3 font-weight-bold text-dark">Riwayat Komentar</h5>
            <?php if (!empty($comments)): ?>
                <?php foreach ($comments as $comment): ?>
                    <div class="card card-outline card-secondary mb-2">
                        <div class="card-body py-2">
                            <?= esc($comment['comment'] ?? $comment['content'] ?? $comment['message'] ?? '-') ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted">Belum ada komentar.</p>
            <?php endif; ?>

            <!-- RIWAYAT TIKET / LOGS -->
            <h5 class="mt-4 mb-3 font-weight-bold text-dark">Riwayat Tiket</h5>
            <?php if (!empty($logs)): ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($logs as $log): ?>
                                <tr>
                                    <td>
                                        <span class="badge badge-secondary">
                                            <?= esc(str_replace('_', ' ', strtoupper($log['status'] ?? '-'))) ?>
                                        </span>
                                    </td>
                                    <td><?= esc($log['description'] ?? $log['note'] ?? $log['message'] ?? '-') ?></td>
                                    <td><?= esc($log['created_at'] ?? '-') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <p class="text-muted">Belum ada riwayat.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- MODAL 1: KONFIRMASI VERIFIKASI & DISPOSISI -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-check-circle mr-2"></i>Konfirmasi Verifikasi
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= site_url('verification/verify/' . $ticket['id']) ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    Apakah Anda yakin seluruh berkas telah sesuai dan ingin <strong>menyetujui serta meneruskan tiket ini ke tahap Disposisi</strong>?
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success btn-sm font-weight-bold">Ya, Verifikasi & Disposisi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL 2: NEED REVISION -->
<div class="modal fade" id="revisionModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-edit mr-2"></i>Kembalikan Untuk Revisi
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= site_url('verification/revision/' . $ticket['id']) ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Alasan Revisi <span class="text-danger">*</span></label>
                        <textarea name="comment" class="form-control" rows="4" placeholder="Jelaskan bagian berkas/data yang perlu diperbaiki oleh pemohon..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning text-white btn-sm font-weight-bold">Kirim Revisi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL 3: REJECT TICKET -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title font-weight-bold">
                    <i class="fas fa-times-circle mr-2"></i>Tolak Permohonan Tiket
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= site_url('verification/reject/' . $ticket['id']) ?>">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea name="comment" class="form-control" rows="4" placeholder="Jelaskan alasan kenapa tiket ini ditolak..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-sm font-weight-bold">Tolak Tiket</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>