<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php if(session()->getFlashdata('success')): ?>
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
    <i class="fas fa-check-circle"></i>
    <?= session()->getFlashdata('success') ?>
</div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">
        <span>&times;</span>
    </button>
    <i class="fas fa-times-circle"></i>
    <?= session()->getFlashdata('error') ?>
</div>
<?php endif; ?>

<div class="row mb-3">

    <div class="col-md-3">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $submitted ?></h3>
                <p>Submitted</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $verified ?></h3>
                <p>Verified</p>
            </div>
            <div class="icon">
                <i class="fas fa-check"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?= $revision ?></h3>
                <p>Need Revision</p>
            </div>
            <div class="icon">
                <i class="fas fa-edit"></i>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $rejected ?></h3>
                <p>Rejected</p>
            </div>
            <div class="icon">
                <i class="fas fa-times"></i>
            </div>
        </div>
    </div>

</div>

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Verifikasi Tiket</h3>
    </div>

    <div class="card-body">

        <form method="get" action="<?= base_url('verification') ?>" class="row mb-3">

            <div class="col-md-4">
                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Cari No Tiket / Nama / NIM"
                    value="<?= esc($_GET['keyword'] ?? '') ?>">
            </div>

            <div class="col-md-3">
                <select name="status" class="form-control">

                    <option value="">Semua Status</option>

                    <option value="Submitted" <?= (($_GET['status'] ?? '')=='Submitted')?'selected':'' ?>>
                        Submitted
                    </option>

                    <option value="Verified" <?= (($_GET['status'] ?? '')=='Verified')?'selected':'' ?>>
                        Verified
                    </option>

                    <option value="Need Revision" <?= (($_GET['status'] ?? '')=='Need Revision')?'selected':'' ?>>
                        Need Revision
                    </option>

                    <option value="Rejected" <?= (($_GET['status'] ?? '')=='Rejected')?'selected':'' ?>>
                        Rejected
                    </option>

                    <option value="Assigned" <?= (($_GET['status'] ?? '')=='Assigned')?'selected':'' ?>>
                        Assigned
                    </option>

                    <option value="Completed" <?= (($_GET['status'] ?? '')=='Completed')?'selected':'' ?>>
                        Completed
                    </option>

                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary btn-block">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>

            <div class="col-md-2">
                <a href="<?= base_url('verification') ?>" class="btn btn-secondary btn-block">
                    Reset
                </a>
            </div>

        </form>

        <table class="table table-bordered table-striped">

            <thead class="thead-dark">
                <tr>
                    <th width="50">No</th>
                    <th>No Tiket</th>
                    <th>Nama Pemohon</th>
                    <th>Layanan</th>
                    <th>Sumber</th>
                    <th>Status</th>
                    <th width="130">Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php if(empty($tickets)): ?>

                <tr>
                    <td colspan="7" class="text-center">
                        Tidak ada data tiket.
                    </td>
                </tr>

            <?php else: ?>

                <?php $no = 1; ?>

                <?php foreach($tickets as $ticket): ?>

                <?php
                    $badge = 'secondary';

                    switch($ticket['status']){

                        case 'Submitted':
                            $badge='warning';
                            break;

                        case 'Verified':
                            $badge='success';
                            break;

                        case 'Need Revision':
                            $badge='primary';
                            break;

                        case 'Rejected':
                            $badge='danger';
                            break;

                        case 'Assigned':
                            $badge='info';
                            break;

                        case 'Completed':
                            $badge='dark';
                            break;
                    }
                ?>

                <tr>

                    <td><?= $no++ ?></td>

                    <td><?= esc($ticket['ticket_number']) ?></td>

                    <td><?= esc($ticket['applicant_name']) ?></td>

                    <td><?= esc($ticket['service_name']) ?></td>

                    <td>
                        <?php if(($ticket['source'] ?? 'Online') == 'Walk-in'): ?>
                            <span class="badge bg-info">
                                Walk-in
                            </span>
                        <?php else: ?>
                            <span class="badge bg-secondary">
                                Online
                            </span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <span class="badge bg-<?= $badge ?>">
                            <?= esc($ticket['status']) ?>
                        </span>
                    </td>

                    <td>
                        <a href="<?= base_url('verification/detail/'.$ticket['id']) ?>"
                           class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> Detail
                        </a>
                    </td>

                </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>