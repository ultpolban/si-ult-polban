<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard SI-ULT POLBAN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-4">

    <h2>Dashboard SI-ULT POLBAN</h2>

    <p>
        Selamat datang
        <strong><?= session()->get('name'); ?></strong>
    </p>

    <p>
        Role :
        <strong><?= session()->get('role_id'); ?></strong>
    </p>

    <hr>

    <div class="row">

        <div class="col-md-3">

            <div class="card bg-primary text-white">

                <div class="card-body">

                    <h5>Total Tiket</h5>

                    <h2><?= $total ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card bg-warning">

                <div class="card-body">

                    <h5>Submitted</h5>

                    <h2><?= $submitted ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card bg-success text-white">

                <div class="card-body">

                    <h5>Verified</h5>

                    <h2><?= $verified ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="card bg-info text-white">

                <div class="card-body">

                    <h5>Completed</h5>

                    <h2><?= $completed ?></h2>

                </div>

            </div>

        </div>

    </div>

    <hr>

    <h4>Daftar Tiket</h4>

    <table class="table table-bordered table-striped">

        <thead class="table-dark">

            <tr>

                <th>No</th>
                <th>No Tiket</th>
                <th>Status</th>
                <th>Prioritas</th>
                <th>Tanggal & Jam</th>

            </tr>

        </thead>

        <tbody>

        <?php $no = 1; ?>

        <?php foreach($tickets as $ticket): ?>

            <tr>

                <td><?= $no++; ?></td>

                <td><?= $ticket['ticket_number']; ?></td>

                <td><?= $ticket['status']; ?></td>

                <td><?= $ticket['priority']; ?></td>

                <td><?= date('d-m-Y H:i:s', strtotime($ticket['submitted_at'])); ?></td>

            </tr>

        <?php endforeach; ?>

        </tbody>

    </table>

    <a href="<?= base_url('verification'); ?>" class="btn btn-primary">
        Verifikasi Tiket
    </a>

    <a href="<?= base_url('logout'); ?>" class="btn btn-danger">
        Logout
    </a>

</div>

</body>
</html>