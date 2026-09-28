<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <h1>Dashboard Admin SI-ULT POLBAN</h1>
    </div>
</div>

<div class="row">

    <!-- Total User -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $totalUser ?></h3>
                <p>Total User</p>
            </div>

            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <!-- Total Tiket -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?= $totalTicket ?></h3>
                <p>Total Tiket</p>
            </div>

            <div class="icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
        </div>
    </div>

    <!-- Submitted -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $submitted ?></h3>
                <p>Tiket Submitted</p>
            </div>

            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

    <!-- Verified -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $verified ?></h3>
                <p>Tiket Verified</p>
            </div>

            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <!-- Completed -->
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3><?= $completed ?></h3>
                <p>Tiket Completed</p>
            </div>

            <div class="icon">
                <i class="fas fa-check-double"></i>
            </div>
        </div>
    </div>

</div>

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Daftar Tiket Terbaru</h3>
    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-striped">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nomor Tiket</th>
                    <th>Status</th>
                    <th>Prioritas</th>
                    <th>Tanggal & Jam</th>
                </tr>

            </thead>

            <tbody>

            <?php if(empty($tickets)): ?>

                <tr>
                    <td colspan="5" class="text-center">
                        Belum ada tiket.
                    </td>
                </tr>

            <?php else: ?>

                <?php $no=1; ?>

                <?php foreach($tickets as $ticket): ?>

                    <tr>

                        <td><?= $no++ ?></td>

                        <td><?= esc($ticket['ticket_number']) ?></td>

                        <td><?= esc($ticket['status']) ?></td>

                        <td><?= esc($ticket['priority']) ?></td>

                        <td><?= date('d-m-Y H:i:s', strtotime($ticket['submitted_at'])) ?></td>

                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>