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

                    <?= esc(
                        session()->getFlashdata('success')
                    ) ?>

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

                    <?= esc(
                        session()->getFlashdata('error')
                    ) ?>

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

                            <th width="25%">
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
                            ?>

                            <tr>

                                <td>
                                    <?= $no++ ?>
                                </td>

                                <td>
                                    <strong>
                                        <?= esc(
                                            $ticket['ticket_number']
                                            ?? '-'
                                        ) ?>
                                    </strong>
                                </td>

                                <td>
                                    <?= esc(
                                        $ticket['service_display_name']
                                        ?? '-'
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

                                    <a href="<?= site_url(
                                        'verification/detail/' .
                                        $ticket['id']
                                    ) ?>"
                                       class="btn btn-info btn-sm">

                                        <i class="fas fa-eye"></i>
                                        Detail

                                    </a>


                                    <?php if ($status === 'submitted'): ?>

                                        <form
                                            action="<?= site_url(
                                                'verification/verify/' .
                                                $ticket['id']
                                            ) ?>"
                                            method="post"
                                            style="display:inline;">

                                            <?= csrf_field() ?>

                                            <button
                                                type="submit"
                                                class="btn btn-success btn-sm"
                                                onclick="return confirm('Verifikasi tiket ini?')">

                                                <i class="fas fa-check"></i>
                                                Verifikasi

                                            </button>

                                        </form>

                                    <?php endif; ?>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="7"
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