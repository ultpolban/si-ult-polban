<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<style>

body {

    font-family: Arial;

    font-size: 11px;

}

h2 {

    text-align: center;

    margin-bottom: 4px;

}

.meta {

    text-align: center;

    margin-top: 0;

    color: #444;

}

table {

    width: 100%;

    border-collapse: collapse;

    margin-top: 14px;

}

table th,table td {

    border: 1px solid #293582;

    padding: 6px;

}

th {

    background: #ddd;

}

</style>

</head>

<body>

<h2>

    DATA TIKET UNIT LAYANAN TERPADU

</h2>

<p class="meta">

    Politeknik Negeri Bandung &mdash; Dicetak: <?= esc($tanggal ?? '') ?>

</p>

<table>

<thead>

<tr>

    <th>No</th>

    <th>No Tiket</th>

    <th>Pemohon</th>

    <th>Layanan</th>

    <th>Unit</th>

    <th>Status</th>

    <th>Prioritas</th>

    <th>Tanggal Pengajuan</th>

</tr>

</thead>

<tbody>

<?php $no = 1; ?>

<?php if (! empty($tickets)): ?>

    <?php foreach ($tickets as $t): ?>

        <tr>

            <td><?= $no++ ?></td>

            <td><?= esc($t['ticket_number'] ?? '-') ?></td>

            <td><?= esc($t['applicant_name'] ?? '-') ?></td>

            <td><?= esc($t['service_display_name'] ?? '-') ?></td>

            <td><?= esc($t['unit_name'] ?? '-') ?></td>

            <td>

                <?= esc(ucwords(strtolower(trim((string) ($t['status'] ?? ''))))) ?: '-' ?>

            </td>

            <td><?= esc($t['priority'] ?? '-') ?></td>

            <td>

                <?= esc($t['submitted_at'] ?? ($t['created_at'] ?? '-')) ?>

            </td>

        </tr>

    <?php endforeach; ?>

<?php else: ?>

    <tr>

        <td colspan="8" style="text-align:center;">

            Belum ada tiket yang didisposisikan ke unit.

        </td>

    </tr>

<?php endif; ?>

</tbody>

</table>

</body>

</html>
