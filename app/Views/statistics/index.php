<?= $this->extend('layouts/main') ?>

<?= $this->section('styles') ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row">

    <div class="col-md-3 col-sm-6 col-12">

        <div class="info-box">

            <span class="info-box-icon bg-primary">

                <i class="fas fa-ticket-alt"></i>

            </span>

            <div class="info-box-content">

                <span class="info-box-text">Total Pengajuan</span>

                <span class="info-box-number"><?= esc($summary['total']) ?></span>

            </div>

        </div>

    </div>

    <div class="col-md-3 col-sm-6 col-12">

        <div class="info-box">

            <span class="info-box-icon bg-warning">

                <i class="fas fa-clock"></i>

            </span>

            <div class="info-box-content">

                <span class="info-box-text">Menunggu</span>

                <span class="info-box-number"><?= esc($summary['pending']) ?></span>

            </div>

        </div>

    </div>

    <div class="col-md-3 col-sm-6 col-12">

        <div class="info-box">

            <span class="info-box-icon bg-info">

                <i class="fas fa-cogs"></i>

            </span>

            <div class="info-box-content">

                <span class="info-box-text">Diproses</span>

                <span class="info-box-number"><?= esc($summary['processing']) ?></span>

            </div>

        </div>

    </div>

    <div class="col-md-3 col-sm-6 col-12">

        <div class="info-box">

            <span class="info-box-icon bg-success">

                <i class="fas fa-check-circle"></i>

            </span>

            <div class="info-box-content">

                <span class="info-box-text">Selesai</span>

                <span class="info-box-number"><?= esc($summary['completed']) ?></span>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-6">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">Pengajuan per Status</h3>

            </div>

            <div class="card-body">

                <canvas id="statusChart" height="250"></canvas>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">Pengajuan per Unit Layanan</h3>

            </div>

            <div class="card-body">

                <canvas id="unitChart" height="250"></canvas>

            </div>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-md-6">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">Pengajuan per Jenis Pemohon</h3>

            </div>

            <div class="card-body">

                <canvas id="applicantChart" height="250"></canvas>

            </div>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card">

            <div class="card-header">

                <h3 class="card-title">Pengajuan per Bulan</h3>

            </div>

            <div class="card-body">

                <canvas id="monthChart" height="250"></canvas>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    const statusLabels = [];

    const statusData = [];

    <?php foreach ($byStatus as $row): ?>

        statusLabels.push('<?= addslashes($statusMap[$row['status']] ?? $row['status']) ?>');

        statusData.push(<?= (int) $row['total'] ?>);

    <?php endforeach; ?>

    new Chart(document.getElementById('statusChart'), {

        type: 'doughnut',

        data: {

            labels: statusLabels,

            datasets: [{

                data: statusData,

                backgroundColor: [

                    '#6c757d', '#ffc107', '#17a2b8', '#6c757d',

                    '#007bff', '#28a745', '#dc3545', '#dc3545'

                ]

            }]

        }

    });

    const unitLabels = [];

    const unitData = [];

    <?php foreach ($byUnit as $row): ?>

        unitLabels.push('<?= addslashes($row['unit']) ?>');

        unitData.push(<?= (int) $row['total'] ?>);

    <?php endforeach; ?>

    new Chart(document.getElementById('unitChart'), {

        type: 'bar',

        data: {

            labels: unitLabels,

            datasets: [{

                label: 'Jumlah',

                data: unitData,

                backgroundColor: '#007bff'

            }]

        },

        options: {

            responsive: true,

            plugins: {
                legend: {
                    display: false
                }
            }

        }

    });

    const applicantLabels = [];

    const applicantData = [];

    <?php foreach ($byApplicantType as $row): ?>

        applicantLabels.push('<?= addslashes($row['applicant_type']) ?>');

        applicantData.push(<?= (int) $row['total'] ?>);

    <?php endforeach; ?>

    new Chart(document.getElementById('applicantChart'), {

        type: 'pie',

        data: {

            labels: applicantLabels,

            datasets: [{

                data: applicantData,

                backgroundColor: ['#28a745', '#007bff', '#ffc107', '#dc3545', '#17a2b8', '#6f42c1', '#fd7e14', '#20c997']

            }]

        }

    });

    const monthLabels = [];

    const monthData = [];

    <?php foreach ($byMonth as $row): ?>

        monthLabels.push('<?= addslashes($row['month']) ?>');

        monthData.push(<?= (int) $row['total'] ?>);

    <?php endforeach; ?>

    new Chart(document.getElementById('monthChart'), {

        type: 'line',

        data: {

            labels: monthLabels,

            datasets: [{

                label: 'Jumlah',

                data: monthData,

                borderColor: '#28a745',

                fill: false,

                tension: 0.3

            }]

        }

    });
</script>

<?= $this->endSection() ?>