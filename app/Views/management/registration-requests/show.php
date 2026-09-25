<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$permissionService = new \App\Services\PermissionService();

$canApprove = $permissionService->hasPermission('registration_request.approve');
$canReject  = $permissionService->hasPermission('registration_request.reject');
?>

<div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">

    <div>

        <h4 class="mb-0"><?= esc($pageTitle ?? 'Detail Permintaan Registrasi') ?></h4>

        <small class="text-muted">

            Detail permintaan izin registrasi.

        </small>

    </div>

</div>

<?= $this->include('components/alert') ?>

<div class="card card-premium">

    <div class="card-header">

        <h3 class="card-title">

            Data Pemohon

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-premium mb-0">

            <tr>

                <th width="220">Nama Lengkap</th>

                <td><?= esc($item['full_name'] ?? '') ?></td>

            </tr>

            <tr>

                <th>Jenis Kelamin</th>

                <td>
                    <?php if (($item['gender'] ?? '') === 'L') : ?>
                        Laki-laki
                    <?php elseif (($item['gender'] ?? '') === 'P') : ?>
                        Perempuan
                    <?php else : ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>

            </tr>

            <tr>

                <th>Email</th>

                <td><?= esc($item['email'] ?? '') ?></td>

            </tr>

            <tr>

                <th>Nomor HP</th>

                <td><?= ! empty($item['phone_number']) ? esc($item['phone_number']) : '<span class="text-muted">-</span>' ?></td>

            </tr>

            <tr>

                <th>Jenis Pemohon</th>

                <td>

                    <?php if (! empty($item['applicant_type_name'])) : ?>

                        <?= esc($item['applicant_type_name']) ?>

                        <span class="badge bg-secondary"><?= esc($item['applicant_type_code'] ?? '') ?></span>

                        <small class="text-muted">(ID: <?= esc((string) ($item['applicant_type_id'] ?? '')) ?>)</small>

                    <?php else : ?>

                        <span class="text-muted">-</span>

                    <?php endif; ?>

                </td>

            </tr>

            <tr>

                <th>Program Studi</th>

                <td>

                    <?php if (! empty($item['study_program_name'])) : ?>

                        <?= esc($item['study_program_name']) ?>

                        <small class="text-muted">(ID: <?= esc((string) ($item['study_program_id'] ?? '')) ?>)</small>

                    <?php else : ?>

                        <span class="text-muted">-</span>

                    <?php endif; ?>

                </td>

            </tr>

            <tr>

                <th>Kelas</th>

                <td>

                    <?php if (! empty($item['class_name'])) : ?>

                        <?= esc($item['class_name']) ?>

                        <small class="text-muted">(ID: <?= esc((string) ($item['class_id'] ?? '')) ?>)</small>

                    <?php else : ?>

                        <span class="text-muted">-</span>

                    <?php endif; ?>

                </td>

            </tr>

            <tr>

                <th>NIM</th>

                <td><?= ! empty($item['nim']) ? esc($item['nim']) : '<span class="text-muted">-</span>' ?></td>

            </tr>

            <tr>

                <th>NIK</th>

                <td><?= ! empty($item['nik']) ? esc($item['nik']) : '<span class="text-muted">-</span>' ?></td>

            </tr>

            <tr>

                <th>Nama Mahasiswa (Wali)</th>

                <td><?= ! empty($item['student_name']) ? esc($item['student_name']) : '<span class="text-muted">-</span>' ?></td>

            </tr>

            <tr>

                <th>Nama Instansi (Mitra)</th>

                <td><?= ! empty($item['institution_name']) ? esc($item['institution_name']) : '<span class="text-muted">-</span>' ?></td>

            </tr>

            <tr>

                <th>Jabatan</th>

                <td><?= ! empty($item['position']) ? esc($item['position']) : '<span class="text-muted">-</span>' ?></td>

            </tr>

            <tr>

                <th>Alamat</th>

                <td><?= ! empty($item['address']) ? nl2br(esc($item['address'])) : '<span class="text-muted">-</span>' ?></td>

            </tr>

            <tr>

                <th>Keperluan</th>

                <td><?= ! empty($item['purpose']) ? nl2br(esc($item['purpose'])) : '<span class="text-muted">-</span>' ?></td>

            </tr>

        </table>

    </div>

</div>

<div class="card mt-3">

    <div class="card-header">

        <h3 class="card-title">

            Status Permintaan

        </h3>

    </div>

    <div class="card-body">

        <table class="table table-premium mb-0">

            <tr>

                <th width="220">Status</th>

                <td>

                    <?php if (($item['status'] ?? '') === 'pending') : ?>

                        <span class="badge bg-warning text-dark">
                            <i class="fas fa-clock me-1"></i>Pending
                        </span>

                    <?php elseif (($item['status'] ?? '') === 'approved') : ?>

                        <span class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i>Approved
                        </span>

                    <?php elseif (($item['status'] ?? '') === 'rejected') : ?>

                        <span class="badge bg-danger">
                            <i class="fas fa-times-circle me-1"></i>Rejected
                        </span>

                    <?php endif; ?>

                </td>

            </tr>

            <tr>

                <th>Tanggal Pengajuan</th>

                <td><?= esc($item['created_at'] ?? '') ?></td>

            </tr>

            <tr>

                <th>Admin Pemroses</th>

                <td>

                    <?php if (! empty($item['processed_by_name'])) : ?>

                        <?= esc($item['processed_by_name']) ?>

                        <?php if (! empty($item['processed_by'])) : ?>

                            <small class="text-muted">(ID: <?= esc((string) $item['processed_by']) ?>)</small>

                        <?php endif; ?>

                    <?php else : ?>

                        <span class="text-muted">-</span>

                    <?php endif; ?>

                </td>

            </tr>

            <tr>

                <th>Tanggal Diproses</th>

                <td>

                    <?= ! empty($item['processed_at'])
                        ? esc($item['processed_at'])
                        : '<span class="text-muted">-</span>' ?>

                </td>

            </tr>

            <tr>

                <th>Akun Dibuat</th>

                <td>

                    <?php if (! empty($item['created_user_id'])) : ?>

                        <a href="<?= site_url('users/show/' . $item['created_user_id']) ?>">

                            <i class="fas fa-user me-1"></i>

                            User ID <?= esc((string) $item['created_user_id']) ?>

                        </a>

                    <?php else : ?>

                        <span class="text-muted">Belum ada akun.</span>

                    <?php endif; ?>

                </td>

            </tr>

            <tr>

                <th>Alasan Penolakan</th>

                <td>

                    <?php if (! empty($item['rejection_reason'])) : ?>

                        <?= nl2br(esc($item['rejection_reason'])) ?>

                    <?php else : ?>

                        <span class="text-muted">-</span>

                    <?php endif; ?>

                </td>

            </tr>

        </table>

    </div>

    <div class="card-footer d-flex justify-content-between flex-wrap gap-2">

        <a
            href="<?= site_url('registration-requests') ?>"
            class="btn btn-light px-4">

            <i class="fas fa-arrow-left"></i>

            Kembali

        </a>

        <?php if (($item['status'] ?? '') === 'pending') : ?>

            <div>

                <?php if ($canApprove) : ?>

                    <form
                        action="<?= site_url('registration-requests/approve/' . $item['id']) ?>"
                        method="post"
                        class="d-inline"
                        onsubmit="return confirm('Setujui permintaan ini? Akun pemohon akan dibuat dan menunggu aktivasi MFA.');">

                        <?= csrf_field() ?>

                        <button
                            type="submit"
                            class="btn btn-success">

                            <i class="fas fa-check-circle me-1"></i>

                            Setujui

                        </button>

                    </form>

                <?php endif; ?>

                <?php if ($canReject) : ?>

                    <button
                        type="button"
                        class="btn btn-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#rejectModal">

                        <i class="fas fa-times-circle me-1"></i>

                        Tolak

                    </button>

                <?php endif; ?>

            </div>

        <?php endif; ?>

    </div>

</div>

<?php if (($item['status'] ?? '') === 'pending' && $canReject) : ?>

    <!-- Modal Alasan Penolakan -->
    <div
        class="modal fade"
        id="rejectModal"
        tabindex="-1"
        aria-labelledby="rejectModalLabel"
        aria-hidden="true">

        <div class="modal-dialog">

            <div class="modal-content">

                <form
                    action="<?= site_url('registration-requests/reject/' . $item['id']) ?>"
                    method="post">

                    <?= csrf_field() ?>

                    <div class="modal-header">

                        <h5 class="modal-title" id="rejectModalLabel">

                            Tolak Permintaan Registrasi

                        </h5>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"></button>

                    </div>

                    <div class="modal-body">

                        <div class="mb-3">

                            <label class="form-label">

                                Alasan Penolakan <span class="text-danger">*</span>

                            </label>

                            <textarea
                                name="rejection_reason"
                                class="form-control"
                                rows="4"
                                placeholder="Tuliskan alasan penolakan..."
                                maxlength="1000"
                                required></textarea>

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button
                            type="button"
                            class="btn btn-light px-4"
                            data-bs-dismiss="modal">

                            Batal

                        </button>

                        <button
                            type="submit"
                            class="btn btn-danger">

                            <i class="fas fa-times-circle me-1"></i>

                            Tolak Permintaan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

<?php endif; ?>

<?= $this->endSection() ?>

