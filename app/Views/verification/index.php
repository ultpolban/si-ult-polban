<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-check-circle"></i>
                Verifikasi Tiket
            </h3>
        </div>

        <div class="card-body">

            <?php if (session()->getFlashdata('success')): ?>

                <div class="alert alert-success alert-dismissible fade show">

                    <button type="button"
                            class="close"
                            data-dismiss="alert">

                        <span>&times;</span>

                    </button>

                    <i class="fas fa-check-circle"></i>

                    <?= esc(session()->getFlashdata('success')) ?>

                </div>

            <?php endif; ?>


            <?php if (session()->getFlashdata('error')): ?>

                <div class="alert alert-danger alert-dismissible fade show">

                    <button type="button"
                            class="close"
                            data-dismiss="alert">

                        <span>&times;</span>

                    </button>

                    <i class="fas fa-exclamation-circle"></i>

                    <?= esc(session()->getFlashdata('error')) ?>

                </div>

            <?php endif; ?>


            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="thead-light">

                        <tr>

                            <th width="5%">
                                No
                            </th>

                            <th>
                                Nomor Tiket
                            </th>

                            <th>
                                Layanan
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Prioritas
                            </th>

                            <th>
                                Tanggal Pengajuan
                            </th>

                            <th width="30%">
                                Aksi
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                    <?php if (!empty($tickets)): ?>

                        <?php $no = 1; ?>

                        <?php foreach ($tickets as $ticket): ?>

                            <?php
                            $status = strtolower(
                                trim(
                                    $ticket['status'] ?? ''
                                )
                            );

                            $ticketId = $ticket['id'];
                            ?>

                            <tr>

                                <td>
                                    <?= $no++ ?>
                                </td>

                                <td>
                                    <strong>
                                        <?= esc(
                                            $ticket['ticket_number'] ?? '-'
                                        ) ?>
                                    </strong>
                                </td>

                                <td>
                                    <?= esc(
                                        $ticket['service_display_name'] ?? '-'
                                    ) ?>
                                </td>

                                <td>

                                    <?php

                                    $badge = 'secondary';

                                    if ($status === 'submitted') {
                                        $badge = 'warning';
                                    } elseif ($status === 'verified') {
                                        $badge = 'success';
                                    } elseif (
                                        $status === 'need_revision' ||
                                        $status === 'revision'
                                    ) {
                                        $badge = 'info';
                                    } elseif ($status === 'rejected') {
                                        $badge = 'danger';
                                    }

                                    ?>

                                    <span class="badge badge-<?= $badge ?>">

                                        <?= esc(
                                            $ticket['status'] ?? '-'
                                        ) ?>

                                    </span>

                                </td>

                                <td>
                                    <?= esc(
                                        $ticket['priority'] ?? '-'
                                    ) ?>
                                </td>

                                <td>
                                    <?= esc(
                                        $ticket['submitted_at']
                                        ?? $ticket['created_at']
                                        ?? '-'
                                    ) ?>
                                </td>

                                <td>

                                    <!-- DETAIL -->
                                    <a href="<?= site_url(
                                        'verification/detail/' . $ticketId
                                    ) ?>"
                                       class="btn btn-info btn-sm">

                                        <i class="fas fa-eye"></i>
                                        Detail

                                    </a>


                                    <?php if ($status === 'submitted'): ?>

                                        <!-- ========================= -->
                                        <!-- TOMBOL VERIFIKASI -->
                                        <!-- ========================= -->

                                        <button
                                            type="button"
                                            class="btn btn-success btn-sm"
                                            data-toggle="modal"
                                            data-target="#modalVerifikasi<?= $ticketId ?>">

                                            <i class="fas fa-check"></i>
                                            Verifikasi

                                        </button>


                                        <!-- ========================= -->
                                        <!-- TOMBOL KEMBALIKAN -->
                                        <!-- ========================= -->

                                        <button
                                            type="button"
                                            class="btn btn-warning btn-sm"
                                            data-toggle="modal"
                                            data-target="#modalRevision<?= $ticketId ?>">

                                            <i class="fas fa-undo"></i>
                                            Kembalikan

                                        </button>


                                        <!-- ========================= -->
                                        <!-- TOMBOL TOLAK -->
                                        <!-- ========================= -->

                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm"
                                            data-toggle="modal"
                                            data-target="#modalReject<?= $ticketId ?>">

                                            <i class="fas fa-times"></i>
                                            Tolak

                                        </button>

                                    <?php endif; ?>

                                </td>

                            </tr>


                            <!-- ================================================= -->
                            <!-- MODAL VERIFIKASI -->
                            <!-- ================================================= -->

                            <div
                                class="modal fade"
                                id="modalVerifikasi<?= $ticketId ?>"
                                tabindex="-1"
                                role="dialog"
                                aria-hidden="true">

                                <div
                                    class="modal-dialog modal-dialog-centered"
                                    role="document">

                                    <div class="modal-content">

                                        <div class="modal-header bg-success">

                                            <h5 class="modal-title text-white">

                                                <i class="fas fa-check-circle"></i>
                                                Konfirmasi Verifikasi

                                            </h5>

                                            <button
                                                type="button"
                                                class="close text-white"
                                                data-dismiss="modal">

                                                <span>&times;</span>

                                            </button>

                                        </div>


                                        <div class="modal-body">

                                            <div class="text-center mb-3">

                                                <i
                                                    class="fas fa-check-circle text-success"
                                                    style="font-size: 55px;">
                                                </i>

                                            </div>

                                            <p class="text-center mb-2">

                                                Apakah data tiket ini sudah
                                                <strong>lengkap dan benar</strong>?

                                            </p>

                                            <div class="alert alert-info">

                                                <strong>Nomor Tiket:</strong><br>

                                                <?= esc(
                                                    $ticket['ticket_number'] ?? '-'
                                                ) ?>

                                                <br><br>

                                                <strong>Layanan:</strong><br>

                                                <?= esc(
                                                    $ticket['service_display_name'] ?? '-'
                                                ) ?>

                                            </div>

                                            <p class="text-center mb-0">

                                                Setelah diverifikasi, tiket akan
                                                masuk ke <strong>Disposisi Tiket</strong>
                                                untuk dipilih unit tujuan.

                                            </p>

                                        </div>


                                        <div class="modal-footer">

                                            <button
                                                type="button"
                                                class="btn btn-secondary"
                                                data-dismiss="modal">

                                                <i class="fas fa-times"></i>
                                                Batal

                                            </button>


                                            <form
                                                action="<?= site_url(
                                                    'verification/verify/' . $ticketId
                                                ) ?>"
                                                method="post"
                                                style="display:inline;">

                                                <?= csrf_field() ?>

                                                <button
                                                    type="submit"
                                                    class="btn btn-success">

                                                    <i class="fas fa-check"></i>
                                                    Ya, Verifikasi

                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            <!-- ================================================= -->
                            <!-- MODAL KEMBALIKAN / REVISI -->
                            <!-- ================================================= -->

                            <div
                                class="modal fade"
                                id="modalRevision<?= $ticketId ?>"
                                tabindex="-1"
                                role="dialog"
                                aria-hidden="true">

                                <div
                                    class="modal-dialog modal-dialog-centered"
                                    role="document">

                                    <div class="modal-content">

                                        <form
                                            action="<?= site_url(
                                                'verification/revision/' . $ticketId
                                            ) ?>"
                                            method="post">

                                            <?= csrf_field() ?>

                                            <div class="modal-header bg-warning">

                                                <h5 class="modal-title">

                                                    <i class="fas fa-undo"></i>
                                                    Kembalikan Data

                                                </h5>

                                                <button
                                                    type="button"
                                                    class="close"
                                                    data-dismiss="modal">

                                                    <span>&times;</span>

                                                </button>

                                            </div>


                                            <div class="modal-body">

                                                <div class="alert alert-warning">

                                                    <strong>
                                                        <?= esc(
                                                            $ticket['ticket_number'] ?? '-'
                                                        ) ?>
                                                    </strong>

                                                    akan dikembalikan kepada
                                                    pemohon untuk diperbaiki.

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        <strong>
                                                            Alasan / Data yang Harus Diperbaiki
                                                        </strong>
                                                        <span class="text-danger">*</span>
                                                    </label>

                                                    <textarea
                                                        name="comment"
                                                        class="form-control"
                                                        rows="5"
                                                        placeholder="Tuliskan data atau dokumen yang harus diperbaiki oleh pemohon..."
                                                        required></textarea>

                                                </div>

                                            </div>


                                            <div class="modal-footer">

                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-dismiss="modal">

                                                    <i class="fas fa-times"></i>
                                                    Batal

                                                </button>


                                                <button
                                                    type="submit"
                                                    class="btn btn-warning">

                                                    <i class="fas fa-undo"></i>
                                                    Kembalikan Data

                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>


                            <!-- ================================================= -->
                            <!-- MODAL TOLAK -->
                            <!-- ================================================= -->

                            <div
                                class="modal fade"
                                id="modalReject<?= $ticketId ?>"
                                tabindex="-1"
                                role="dialog"
                                aria-hidden="true">

                                <div
                                    class="modal-dialog modal-dialog-centered"
                                    role="document">

                                    <div class="modal-content">

                                        <form
                                            action="<?= site_url(
                                                'verification/reject/' . $ticketId
                                            ) ?>"
                                            method="post">

                                            <?= csrf_field() ?>

                                            <div class="modal-header bg-danger">

                                                <h5 class="modal-title text-white">

                                                    <i class="fas fa-times-circle"></i>
                                                    Tolak Tiket

                                                </h5>

                                                <button
                                                    type="button"
                                                    class="close text-white"
                                                    data-dismiss="modal">

                                                    <span>&times;</span>

                                                </button>

                                            </div>


                                            <div class="modal-body">

                                                <div class="alert alert-danger">

                                                    <strong>
                                                        <?= esc(
                                                            $ticket['ticket_number'] ?? '-'
                                                        ) ?>
                                                    </strong>

                                                    akan ditolak dan tidak
                                                    dilanjutkan ke proses disposisi.

                                                </div>


                                                <div class="form-group">

                                                    <label>
                                                        <strong>
                                                            Alasan Penolakan
                                                        </strong>
                                                        <span class="text-danger">*</span>
                                                    </label>

                                                    <textarea
                                                        name="comment"
                                                        class="form-control"
                                                        rows="5"
                                                        placeholder="Tuliskan alasan tiket ditolak..."
                                                        required></textarea>

                                                </div>

                                            </div>


                                            <div class="modal-footer">

                                                <button
                                                    type="button"
                                                    class="btn btn-secondary"
                                                    data-dismiss="modal">

                                                    <i class="fas fa-times"></i>
                                                    Batal

                                                </button>


                                                <button
                                                    type="submit"
                                                    class="btn btn-danger">

                                                    <i class="fas fa-times"></i>
                                                    Tolak Tiket

                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td
                                colspan="7"
                                class="text-center">

                                <i class="fas fa-inbox"></i>

                                Tidak ada tiket yang perlu diverifikasi.

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>