<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<style>

body{

    font-family:Arial;

    font-size:12px;

}

table{

    width:100%;

    border-collapse:collapse;

}

table th,table td{

    border:1px solid #000;

    padding:6px;

}

th{

    background:#ddd;

}

h2{

    text-align:center;

}

</style>

</head>

<body>

<h2>

LAPORAN TIKET ULT POLBAN

</h2>

<table>

<tr>

<th>No</th>

<th>No Tiket</th>

<th>Nama</th>

<th>Jenis</th>

<th>Layanan</th>

<th>Status</th>

<th>Tanggal</th>

</tr>

<?php $no=1; ?>

<?php foreach($tickets as $t): ?>

<tr>

<td><?= $no++ ?></td>

<td><?= $t['ticket_number'] ?></td>

<td><?= $t['applicant_name'] ?></td>

<td><?= $t['applicant_type'] ?></td>

<td><?= $t['service_name'] ?></td>

<td><?= $t['status'] ?></td>

<td><?= date('d-m-Y',strtotime($t['submitted_at'])) ?></td>

</tr>

<?php endforeach ?>

</table>

</body>

</html>