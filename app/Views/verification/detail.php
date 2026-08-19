<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="card">

        <div class="card-header">

            <h3 class="card-title">
                <i class="fas fa-ticket-alt"></i>
                Detail Tiket
            </h3>

            <div class="card-tools">

                <a href="<?= site_url('verification') ?>"
                   class="btn btn-secondary btn-sm">

                    <i class="fas fa-arrow-left"></i>
                    Kembali

                </a>

            </div>

        </div>


        <div class="card-body">

            <?php if (session()->getFlashdata('success')): ?>

                <div class="alert alert-success">

                    <?= esc(
                        session()->getFlashdata('success')
                    ) ?>

                </div>

            <?php endif; ?>


            <?php if (session()->getFlashdata('error')): ?>

                <div class="alert alert-danger">

                    <?= esc(
                        session()->getFlashdata('error')
                    ) ?>

                </div>

            <?php endif; ?>


            <!-- INFORMASI TIKET -->

            <h5 class="mb-3">
                Informasi Tiket
            </h5>

            <div class="table-responsive">

                <table class="table table-bordered">

                    <tr>

                        <th width="25%">
                            Nomor Tiket
                        </th>

                        <td>
                            <?= esc(
                                $ticket['ticket_number']
                                ?? '-'
                            ) ?>
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Layanan
                        </th>

                        <td>
                            <?= esc(
                                $ticket['service_display_name']
                                ?? '-'
                            ) ?>
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Kode Layanan
                        </th>

                        <td>
                            <?= esc(
                                $ticket['service_code']
                                ?? '-'
                            ) ?>
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Status
                        </th>

                        <td>

                            <?php
                            $status = strtolower(
                                trim(
                                    $ticket['status'] ?? ''
                                )
                            );

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

                    </tr>


                    <tr>

                        <th>
                            Prioritas
                        </th>

                        <td>
                            <?= esc(
                                $ticket['priority']
                                ?? '-'
                            ) ?>
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Tanggal Pengajuan
                        </th>

                        <td>
                            <?= esc(
                                $ticket['submitted_at']
                                ?? $ticket['created_at']
                                ?? '-'
                            ) ?>
                        </td>

                    </tr>


                    <tr>

                        <th>
                            Tanggal Verifikasi
                        </th>

                        <td>
                            <?= esc(
                                $ticket['verified_at']
                                ?? '-'
                            ) ?>
                        </td>

                    </tr>

                </table>

            </div>


            <!-- DATA PEMOHON -->

            <h5 class="mt-4 mb-3">
                Data Pemohon
            </h5>

            <?php if (!empty($profile)): ?>

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <?php foreach ($profile as $key => $value): ?>

                            <?php
                            if (
                                $key === 'id' ||
                                $key === 'created_at' ||
                                $key === 'updated_at'
                            ) {
                                continue;
                            }
                            ?>

                            <tr>

                                <th width="25%">

                                    <?= esc(
                                        ucwords(
                                            str_replace(
                                                '_',
                                                ' ',
                                                $key
                                            )
                                        )
                                    ) ?>

                                </th>

                                <td>
                                    <?= esc(
                                        $value ?? '-'
                                    ) ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </table>

                </div>

            <?php else: ?>

                <div class="alert alert-info">

                    Data profil pemohon tidak ditemukan.

                </div>

            <?php endif; ?>


            <!-- UNIT -->

            <?php if (!empty($unit)): ?>

                <h5 class="mt-4 mb-3">
                    Unit Layanan
                </h5>

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <?php foreach ($unit as $key => $value): ?>

                            <?php
                            if (
                                $key === 'id' ||
                                $key === 'created_at' ||
                                $key === 'updated_at'
                            ) {
                                continue;
                            }
                            ?>

                            <tr>

                                <th width="25%">

                                    <?= esc(
                                        ucwords(
                                            str_replace(
                                                '_',
                                                ' ',
                                                $key
                                            )
                                        )
                                    ) ?>

                                </th>

                                <td>
                                    <?= esc(
                                        $value ?? '-'
                                    ) ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </table>

                </div>

            <?php endif; ?>


            <!-- AKSI VERIFIKASI -->

            <?php if ($status === 'submitted'): ?>

                <hr>

                <h5 class="mb-3">
                    Tindakan Verifikasi
                </h5>

                <div class="row">

                    <div class="col-md-4">

                        <form
                            method="post"
                            action="<?= site_url(
                                'verification/verify/' .
                                $ticket['id']
                            ) ?>">

                            <?= csrf_field() ?>

                            <button
                                type="submit"
                                class="btn btn-success btn-block"
                                onclick="return confirm('Verifikasi tiket ini?')">

                                <i class="fas fa-check"></i>

                                Verifikasi

                            </button>

                        </form>

                    </div>


                    <div class="col-md-4">

                        <button
                            type="button"
                            class="btn btn-warning btn-block"
                            data-toggle="modal"
                            data-target="#revisionModal">

                            <i class="fas fa-edit"></i>

                            Need Revision

                        </button>

                    </div>


                    <div class="col-md-4">

                        <button
                            type="button"
                            class="btn btn-danger btn-block"
                            data-toggle="modal"
                            data-target="#rejectModal">

                            <i class="fas fa-times"></i>

                            Reject

                        </button>

                    </div>

                </div>

            <?php endif; ?>


            <!-- KOMENTAR -->

            <h5 class="mt-4 mb-3">
                Riwayat Komentar
            </h5>

            <?php if (!empty($comments)): ?>

                <?php foreach ($comments as $comment): ?>

                    <div class="card card-outline card-secondary mb-2">

                        <div class="card-body">

                            <?= esc(
                                $comment['comment']
                                ?? $comment['content']
                                ?? $comment['message']
                                ?? '-'
                            ) ?>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <p class="text-muted">
                    Belum ada komentar.
                </p>

            <?php endif; ?>


            <!-- LOG -->

            <h5 class="mt-4 mb-3">
                Riwayat Tiket
            </h5>

            <?php if (!empty($logs)): ?>

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>

                            <tr>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Keterangan
                                </th>

                                <th>
                                    Waktu
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($logs as $log): ?>

                                <tr>

                                    <td>
                                        <?= esc(
                                            $log['status']
                                            ?? '-'
                                        ) ?>
                                    </td>

                                    <td>
                                        <?= esc(
                                            $log['description']
                                            ?? $log['note']
                                            ?? $log['message']
                                            ?? '-'
                                        ) ?>
                                    </td>

                                    <td>
                                        <?= esc(
                                            $log['created_at']
                                            ?? '-'
                                        ) ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php else: ?>

                <p class="text-muted">
                    Belum ada riwayat.
                </p>

            <?php endif; ?>

        </div>

    </div>

</div>


<!-- MODAL NEED REVISION -->

<div class="modal fade"
     id="revisionModal"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                method="post"
                action="<?= site_url(
                    'verification/revision/' .
                    $ticket['id']
                ) ?>">

                <?= csrf_field() ?>

                <div class="modal-header">

                    <h5 class="modal-title">
                        Need Revision
                    </h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>


                <div class="modal-body">

                    <div class="form-group">

                        <label>
                            Alasan Revisi
                        </label>

                        <textarea
                            name="comment"
                            class="form-control"
                            rows="5"
                            required></textarea>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-warning">

                        Kirim Revisi

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<!-- MODAL REJECT -->

<div class="modal fade"
     id="rejectModal"
     tabindex="-1">

    <div class="modal-dialog">

        <div class="modal-content">

            <form
                method="post"
                action="<?= site_url(
                    'verification/reject/' .
                    $ticket['id']
                ) ?>">

                <?= csrf_field() ?>

                <div class="modal-header">

                    <h5 class="modal-title">
                        Tolak Tiket
                    </h5>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="modal">

                        <span>&times;</span>

                    </button>

                </div>


                <div class="modal-body">

                    <div class="form-group">

                        <label>
                            Alasan Penolakan
                        </label>

                        <textarea
                            name="comment"
                            class="form-control"
                            rows="5"
                            required></textarea>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-danger">

                        Tolak Tiket

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>