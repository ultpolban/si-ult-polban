<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Laporan Tiket Permohonan</title>

    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 10px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 18px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }

        .header h2 {
            margin: 4px 0 0;
            font-size: 13px;
            font-weight: normal;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 9px;
            color: #666;
        }

        .line {
            border-top: 2px solid #1a237e;
            margin: 10px 0 15px;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .summary td {
            border: 1px solid #ddd;
            padding: 7px;
        }

        .summary .label {
            width: 25%;
            background: #f3f4f6;
            font-weight: bold;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
        }

        table.data th {
            background: #1a237e;
            color: white;
            border: 1px solid #1a237e;
            padding: 7px 5px;
            text-align: center;
            font-size: 9px;
        }

        table.data td {
            border: 1px solid #d9dde3;
            padding: 6px 5px;
            vertical-align: middle;
            font-size: 8.5px;
        }

        table.data tr:nth-child(even) {
            background: #f8f9fa;
        }

        .center {
            text-align: center;
        }

        .status {
            font-weight: bold;
        }

        .footer {
            margin-top: 18px;
            font-size: 8px;
            color: #666;
        }
    </style>
</head>

<body>

<?php
/*
|--------------------------------------------------------------------------
| NORMALISASI DATA
|--------------------------------------------------------------------------
| Data tetap berasal dari DataTicketController.
*/

$rows = [];

if (isset($tickets) && is_array($tickets)) {
    $rows = $tickets;
} elseif (isset($tiket_list) && is_array($tiket_list)) {
    $rows = $tiket_list;
} elseif (isset($data) && is_array($data)) {
    $rows = $data;
}

$total = count($rows);
?>

<div class="header">

    <h1>SISTEM INFORMASI UNIT LAYANAN TERPADU</h1>

    <h2>POLITEKNIK NEGERI BANDUNG</h2>

    <p>
        Laporan Data Tiket Permohonan Layanan
    </p>

</div>

<div class="line"></div>

<table class="summary">
    <tr>
        <td class="label">
            Total Tiket
        </td>

        <td>
            <?= $total ?>
        </td>

        <td class="label">
            Tanggal Cetak
        </td>

        <td>
            <?= date('d-m-Y H:i') ?>
        </td>
    </tr>
</table>

<table class="data">

    <thead>

        <tr>

            <th style="width: 4%;">
                No
            </th>

            <th style="width: 14%;">
                Nomor Tiket
            </th>

            <th style="width: 15%;">
                Nama Pemohon
            </th>

            <th style="width: 12%;">
                NIK / Identitas
            </th>

            <th style="width: 17%;">
                Layanan
            </th>

            <th style="width: 9%;">
                Status
            </th>

            <th style="width: 12%;">
                Prioritas
            </th>

            <th style="width: 17%;">
                Tanggal Pengajuan
            </th>

        </tr>

    </thead>

    <tbody>

    <?php if (!empty($rows)): ?>

        <?php foreach ($rows as $index => $row): ?>

            <?php
            $nomorTiket =
                $row['ticket_number']
                ?? $row['nomor_tiket']
                ?? '-';

            $namaPemohon =
                $row['applicant_name']
                ?? $row['student_name']
                ?? $row['name']
                ?? '-';

            $nik =
                $row['nik']
                ?? $row['identity_number']
                ?? '-';

            $layanan =
                $row['service_name']
                ?? $row['service_display_name']
                ?? $row['layanan']
                ?? '-';

            $status =
                $row['status']
                ?? 'submitted';

            $priority =
                $row['priority']
                ?? $row['prioritas']
                ?? 'normal';

            $tanggal =
                $row['submitted_at']
                ?? $row['created_at']
                ?? null;
            ?>

            <tr>

                <td class="center">
                    <?= $index + 1 ?>
                </td>

                <td>
                    <?= esc($nomorTiket) ?>
                </td>

                <td>
                    <?= esc($namaPemohon) ?>
                </td>

                <td>
                    <?= esc($nik) ?>
                </td>

                <td>
                    <?= esc($layanan) ?>
                </td>

                <td class="center status">
                    <?= esc(ucfirst($status)) ?>
                </td>

                <td class="center">
                    <?= esc(strtoupper($priority)) ?>
                </td>

                <td class="center">

                    <?php if (
                        !empty($tanggal)
                        && strtotime($tanggal) !== false
                    ): ?>

                        <?= date(
                            'd-m-Y H:i',
                            strtotime($tanggal)
                        ) ?>

                    <?php else: ?>

                        -

                    <?php endif; ?>

                </td>

            </tr>

        <?php endforeach; ?>

    <?php else: ?>

        <tr>

            <td
                colspan="8"
                class="center"
            >
                Tidak ada data tiket.
            </td>

        </tr>

    <?php endif; ?>

    </tbody>

</table>

<div class="footer">

    Dicetak dari Sistem Informasi Unit Layanan Terpadu
    Politeknik Negeri Bandung.

</div>

</body>
</html>
