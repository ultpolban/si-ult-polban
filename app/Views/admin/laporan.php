<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-2">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Halaman Laporan</h3>
            <p class="text-muted mb-0">Ringkasan laporan layanan unit terpadu</p>
        </div>
    </div>

    <!-- Report Table Card -->
    <div class="card card-premium mt-3">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-premium text-nowrap" style="vertical-align: middle;">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Unit</th>
                            <th>Total Tiket</th>
                            <th>Selesai</th>
                            <th>Dalam Proses</th>
                            <th>Terlambat</th>
                            <th>SLA Tercapai</th>
                            <th>Rata-rata Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        $totalTiketSum = 0;
                        $selesaiSum = 0;
                        $prosesSum = 0;
                        $terlambatSum = 0;
                        
                        foreach ($laporan as $row): 
                            $totalTiketSum += $row['total'];
                            $selesaiSum += $row['selesai'];
                            $prosesSum += $row['proses'];
                            $terlambatSum += $row['terlambat'];
                        ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="font-weight-bold" style="color: #1e2f99;"><?= esc($row['unit']) ?></td>
                            <td><?= number_format($row['total'], 0, ',', '.') ?></td>
                            <td><?= number_format($row['selesai'], 0, ',', '.') ?></td>
                            <td><?= number_format($row['proses'], 0, ',', '.') ?></td>
                            <td>
                                <span class="<?= ($row['terlambat'] > 0) ? 'text-danger font-weight-bold' : '' ?>">
                                    <?= number_format($row['terlambat'], 0, ',', '.') ?>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <span class="mr-2"><?= esc($row['sla']) ?></span>
                                    <div class="progress progress-modern flex-grow-1" style="max-width: 60px; height: 6px; margin-bottom: 0;">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= intval($row['sla']) ?>%"></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark font-weight-normal px-2 py-1" style="border: 1px solid #cbd5e1; border-radius: 4px;">
                                    <?= esc($row['avg']) ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot style="background-color: #f8fafc; font-weight: 700; border-top: 2px solid #cbd5e1; color: #1e2f99;">
                        <tr>
                            <td colspan="2" class="text-uppercase" style="padding: 16px !important;">Total</td>
                            <td style="padding: 16px !important;">1.248</td>
                            <td style="padding: 16px !important;">1.000</td>
                            <td style="padding: 16px !important;">193</td>
                            <td style="padding: 16px !important;">55</td>
                            <td style="padding: 16px !important;">92,4%</td>
                            <td style="padding: 16px !important;">2,4 Hari</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection() ?>

