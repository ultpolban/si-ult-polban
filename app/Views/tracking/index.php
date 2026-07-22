<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title">
            Tracking Status Tiket
        </h3>
    </div>

    <div class="card-body">

        <form action="<?= base_url('tracking/search') ?>" method="post">

            <?= csrf_field() ?>

            <div class="form-group">

                <label>Nomor Tiket</label>

                <input
                    type="text"
                    name="ticket_number"
                    class="form-control"
                    placeholder="Contoh : ULT-202607170001"
                    required>

            </div>

            <button class="btn btn-primary">

                <i class="fas fa-search"></i>

                Cari Tiket

            </button>

        </form>

        <?php if(isset($ticket)): ?>

            <hr>

            <?php if($ticket): ?>

                <table class="table table-bordered">

                    <tr>
                        <th width="220">Nomor Tiket</th>
                        <td><?= esc($ticket['ticket_number']) ?></td>
                    </tr>

                    <tr>
                        <th>Nama Pemohon</th>
                        <td><?= esc($ticket['applicant_name']) ?></td>
                    </tr>

                    <tr>
                        <th>Jenis Layanan</th>
                        <td><?= esc($ticket['service_name']) ?></td>
                    </tr>

                    <tr>
                        <th>Judul</th>
                        <td><?= esc($ticket['ticket_title']) ?></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>

                            <?php

                            $badge = "secondary";

                            switch($ticket['status']){

                                case 'Submitted':
                                    $badge="warning";
                                    break;

                                case 'Assigned':
                                    $badge="info";
                                    break;

                                case 'In Progress':
                                    $badge="primary";
                                    break;

                                case 'Completed':
                                    $badge="success";
                                    break;

                                case 'Need Revision':
                                    $badge="warning";
                                    break;

                                case 'Rejected':
                                    $badge="danger";
                                    break;

                            }

                            ?>

                            <span class="badge bg-<?= $badge ?>">
                                <?= esc($ticket['status']) ?>
                            </span>

                        </td>

                    </tr>

                    <tr>
                        <th>Catatan Petugas</th>
                        <td>

                            <?= $ticket['verification_note'] ?: '-' ?>

                        </td>

                    </tr>

                    <tr>
                        <th>Unit Tujuan</th>
                        <td>

                            <?= $ticket['assigned_unit'] ?: '-' ?>

                        </td>

                    </tr>

                </table>

            <?php else: ?>

                <div class="alert alert-danger mt-3">

                    Nomor tiket tidak ditemukan.

                </div>

            <?php endif; ?>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>