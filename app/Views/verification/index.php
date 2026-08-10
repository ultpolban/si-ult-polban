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
<form method="get" action="<?= base_url('verification') ?>">

    <div class="row mb-3">

        <!-- SEARCH -->
        <div class="col-md-5">
            <div class="input-group">

                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fas fa-search"></i>
                    </span>
                </div>

                <input
                    type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Cari No Tiket, Nama, NIM, Layanan..."
                    value="<?= esc($keyword ?? '') ?>"
                >

            </div>
        </div>


        <!-- STATUS -->
        <div class="col-md-3">

            <select name="status" class="form-control">

                <option value="">
                    -- Semua Status --
                </option>

                <option value="Submitted"
                    <?= ($status ?? '') == 'Submitted' ? 'selected' : '' ?>>
                    Submitted
                </option>

                <option value="Verified"
                    <?= ($status ?? '') == 'Verified' ? 'selected' : '' ?>>
                    Verified
                </option>

                <option value="Need Revision"
                    <?= ($status ?? '') == 'Need Revision' ? 'selected' : '' ?>>
                    Need Revision
                </option>

                <option value="Rejected"
                    <?= ($status ?? '') == 'Rejected' ? 'selected' : '' ?>>
                    Rejected
                </option>

                <option value="Assigned"
                    <?= ($status ?? '') == 'Assigned' ? 'selected' : '' ?>>
                    Assigned
                </option>

                <option value="In Progress"
                    <?= ($status ?? '') == 'In Progress' ? 'selected' : '' ?>>
                    In Progress
                </option>

                <option value="Completed"
                    <?= ($status ?? '') == 'Completed' ? 'selected' : '' ?>>
                    Completed
                </option>

            </select>

        </div>


        <!-- SUMBER -->
        <div class="col-md-2">

            <select name="submission_type" class="form-control">

                <option value="">
                    -- Semua Sumber --
                </option>

                <option value="Online"
                    <?= ($submission_type ?? '') == 'Online' ? 'selected' : '' ?>>
                    Online
                </option>

                <option value="Walk In"
                    <?= ($submission_type ?? '') == 'Walk In' ? 'selected' : '' ?>>
                    Walk In
                </option>

            </select>

        </div>


        <!-- FILTER -->
        <div class="col-md-1">

            <button
                type="submit"
                class="btn btn-warning btn-block"
                title="Filter">

                <i class="fas fa-filter"></i>

            </button>

        </div>


        <!-- RESET -->
        <div class="col-md-1">

            <a
                href="<?= base_url('verification') ?>"
                class="btn btn-secondary btn-block"
                title="Reset">

                <i class="fas fa-redo"></i>

            </a>

        </div>

    </div>

</form>

        <table class="table table-bordered table-striped">

            <thead style="background:#293582; color:white;">
                <tr>
                    <th>No. Tiket</th>
                    <th>Nama Pemohon</th>
                    <th>NIM</th>
                    <th>Layanan</th>
                    <th>Sumber</th>
                    <th>Status</th>
                    <th width="170">Aksi</th>
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

               

                <?php foreach($tickets as $ticket): ?>

                <?php
                    $badge = 'secondary';

                    switch($ticket['status']){
                        case 'Submitted':
                            $badge = 'warning';
                            break;
                        case 'Verified':
                            $badge = 'success';
                           break;
                        case 'Need Revision':
                            $badge = 'primary';
                            break;
                        case 'Rejected':
                            $badge = 'danger';
                            break;
                        case 'Assigned':
                            $badge = 'info';
                            break;
                        case 'Completed':
                            $badge = 'dark';
                            break;
                    }
                ?>

                <tr>

                   

                    <td><?= esc($ticket['ticket_number']) ?></td>

                    <td><?= esc($ticket['applicant_name']) ?></td>

                    <td><?= esc($ticket['nim']) ?></td>

                    <td><?= esc($ticket['service_name']) ?></td>

                 <td>
    <?php if(($ticket['submission_type'] ?? '') == 'Walk In'): ?>

    <span class="badge badge-info">
        Walk In
    </span>

<?php else: ?>

    <span class="badge badge-secondary">
        Online
    </span>

<?php endif; ?>
</td>

                    <td>
                        <span class="badge badge-<?= $badge ?>">
                            <?= esc($ticket['status']) ?>
                        </span>
                    </td>

                 <td class="text-center">

    <!-- DETAIL -->
    <a href="<?= base_url('verification/detail/' . $ticket['id']) ?>"
       class="btn btn-info btn-sm"
       title="Detail">

        <i class="fas fa-eye"></i>

    </a>


    <!-- VERIFIKASI -->
    <a href="<?= base_url('verification/verify/' . $ticket['id']) ?>"
       class="btn btn-success btn-sm"
       title="Verifikasi">

        <i class="fas fa-check"></i>

    </a>


    <!-- DISPOSISI -->
    <a href="<?= base_url('disposition/create/' . $ticket['id']) ?>"
       class="btn btn-primary btn-sm"
       title="Disposisi">

        <i class="fas fa-share"></i>

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