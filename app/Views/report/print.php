<!DOCTYPE html>
<html>
<head>
    <title>Cetak Laporan Tiket</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            margin:30px;
        }

        h3{
            text-align:center;
            margin-bottom:20px;
        }

        table{
            width:100%;
        }
    </style>
</head>
<body>

<h3>LAPORAN TIKET SI-ULT POLBAN</h3>

<table class="table table-bordered">

    <thead>

    <tr>
        <th>No</th>
        <th>No Tiket</th>
        <th>Status</th>
        <th>Prioritas</th>
        <th>Deskripsi</th>
        <th>Tanggal</th>
    </tr>

    </thead>

    <tbody>

    <?php $no=1; ?>

    <?php foreach($tickets as $ticket): ?>

    <tr>

        <td><?= $no++ ?></td>

        <td><?= esc($ticket['ticket_number']) ?></td>

        <td><?= esc($ticket['status']) ?></td>

        <td><?= esc($ticket['priority']) ?></td>

        <td><?= esc($ticket['ticket_description']) ?></td>

        <td><?= date('d-m-Y', strtotime($ticket['submitted_at'])) ?></td>

    </tr>

    <?php endforeach; ?>

    </tbody>

</table>

<script>
window.print();
</script>

</body>
</html>