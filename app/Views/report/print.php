<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Laporan Tiket SI ULT POLBAN</title>

<style>

body{
    font-family:Arial;
    font-size:13px;
}

h2{
    text-align:center;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

table,th,td{
    border:1px solid black;
}

th{
    background:#eeeeee;
}

th,td{
    padding:8px;
}

</style>

</head>

<body>

<h2>LAPORAN TIKET SI ULT POLBAN</h2>

<table>

<thead>

<tr>

<th>No</th>
<th>No Tiket</th>
<th>Status</th>
<th>Prioritas</th>
<th>Isi Tiket</th>
<th>Tanggal Pengajuan</th>
<th>Verifikasi</th>

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

<td><?= esc($ticket['description']) ?></td>

<td><?= date('d F Y H:i:s',strtotime($ticket['submitted_at'])) ?></td>

<td>

<?= !empty($ticket['verified_at'])
? date('d F Y H:i:s',strtotime($ticket['verified_at']))
: '-' ?>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

<script>
window.print();
</script>

</body>

</html>