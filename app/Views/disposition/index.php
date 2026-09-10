<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-share-square mr-2"></i>
                Disposisi Tiket
            </h3>
        </div>

        <div class="card-body">

            <!-- FLASH MESSAGE -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle mr-2"></i>
                    <?= esc(session()->getFlashdata('success')) ?>

                    <button type="button"
                            class="close"
                            data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <?= esc(session()->getFlashdata('error')) ?>

                    <button type="button"
                            class="close"
                            data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <!-- INFO -->
            <div class="alert alert-info">
                <i class="fas fa-info-circle mr-2"></i>
                Berikut adalah tiket yang sudah diverifikasi dan menunggu
                untuk didisposisikan ke unit tujuan.
            </div>

            <!-- TABLE -->
            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-primary">
                        <tr>
                            <th width="50">No</th>
                            <th>No. Tiket</th>
                            <th>Judul</th>
                            <th>Layanan</th>
                            <th>Prioritas</th>
                            <th>Status</th>
                            <th>Waktu Verifikasi</th>

                            <!-- Aksi -->
                            <th width="180">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($tickets)): ?>

                            <?php $no = 1; ?>

                            <?php foreach ($tickets as $ticket): ?>

                                <tr>

                                    <!-- NO -->
                                    <td>
                                        <?= $no++ ?>
                                    </td>

                                    <!-- TICKET NUMBER -->
                                    <td>
                                        <strong>
                                            <?= esc(
                                                $ticket['ticket_number'] ?? '-'
                                            ) ?>
                                        </strong>
                                    </td>

                                    <!-- TITLE -->
                                    <td>
                                        <?= esc(
                                            $ticket['title'] ?? '-'
                                        ) ?>
                                    </td>

                                    <!-- SERVICE -->
                                    <td>
                                        <?= esc(
                                            $ticket['service_display_name']
                                            ?? $ticket['service_name']
                                            ?? '-'
                                        ) ?>
                                    </td>

                                    <!-- PRIORITY -->
                                    <td>

                                        <?php
                                        $priority = strtolower(
                                            trim(
                                                $ticket['priority']
                                                ?? 'normal'
                                            )
                                        );
                                        ?>

                                        <?php if ($priority === 'urgent'): ?>

                                            <span class="badge badge-danger">
                                                URGENT
                                            </span>

                                        <?php elseif ($priority === 'high'): ?>

                                            <span class="badge badge-warning">
                                                HIGH
                                            </span>

                                        <?php elseif ($priority === 'low'): ?>

                                            <span class="badge badge-secondary">
                                                LOW
                                            </span>

                                        <?php else: ?>

                                            <span class="badge badge-info">
                                                NORMAL
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <!-- STATUS -->
                                    <td>
                                        <span class="badge badge-success">
                                            VERIFIED
                                        </span>
                                    </td>

                                    <!-- VERIFIED AT -->
                                    <td>

                                        <?php if (
                                            !empty($ticket['verified_at'])
                                        ): ?>

                                            <?= date(
                                                'd-m-Y H:i',
                                                strtotime(
                                                    $ticket['verified_at']
                                                )
                                            ) ?>

                                        <?php else: ?>

                                            -

                                        <?php endif; ?>

                                    </td>

                                    <!-- ACTION -->
                                    <td class="text-center">

                                        <div
                                            class="d-flex justify-content-center align-items-center"
                                            style="gap: 5px;">

                                            <!-- DETAIL -->
                                            <a
                                                href="<?= base_url(
                                                    'verification/detail/' .
                                                    $ticket['id']
                                                ) ?>"
                                                class="btn btn-info btn-sm">

                                                <i class="fas fa-eye"></i>
                                                Detail

                                            </a>

                                            <!-- DISPOSISI -->
                                            <a
                                                href="<?= base_url(
                                                    'disposition/detail/' .
                                                    $ticket['id']
                                                ) ?>"
                                                class="btn btn-primary btn-sm">

                                                <i class="fas fa-share-square"></i>
                                                Disposisi

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td
                                    colspan="8"
                                    class="text-center text-muted py-4">

                                    <i class="fas fa-inbox fa-2x mb-2"></i>

                                    <br>

                                    Tidak ada tiket yang menunggu disposisi.

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