<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?= $total ?></h3>
                <p>Total Tiket</p>
            </div>
            <div class="icon">
                <i class="fas fa-ticket-alt"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3><?= $submitted ?></h3>
                <p>Submitted</p>
            </div>
            <div class="icon">
                <i class="fas fa-paper-plane"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= $assigned ?></h3>
                <p>Assigned</p>
            </div>
            <div class="icon">
                <i class="fas fa-share"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $progress ?></h3>
                <p>In Progress</p>
            </div>
            <div class="icon">
                <i class="fas fa-spinner"></i>
            </div>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-lg-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3><?= $completed ?></h3>
                <p>Completed</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3><?= $revision ?></h3>
                <p>Need Revision</p>
            </div>
            <div class="icon">
                <i class="fas fa-edit"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3><?= $rejected ?></h3>
                <p>Rejected</p>
            </div>
            <div class="icon">
                <i class="fas fa-times-circle"></i>
            </div>
        </div>
    </div>

</div>

<!-- Progress Penyelesaian -->

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Progress Penyelesaian Tiket
        </h3>

    </div>

    <div class="card-body">

        <div class="progress progress-lg">

            <div
                class="progress-bar bg-success"
                style="width: <?= $progressPercent ?>%;">

                <?= $progressPercent ?>%

            </div>

        </div>

    </div>

</div>

<!-- Grafik -->

<div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Grafik Statistik Tiket

        </h3>

    </div>

    <div class="card-body">

        <canvas id="ticketChart" height="100"></canvas>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('ticketChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [

            'Submitted',

            'Assigned',

            'In Progress',

            'Completed',

            'Revision',

            'Rejected'

        ],

        datasets: [{

            label: 'Jumlah Tiket',

            data: [

                <?= $submitted ?>,

                <?= $assigned ?>,

                <?= $progress ?>,

                <?= $completed ?>,

                <?= $revision ?>,

                <?= $rejected ?>

            ]

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                display: false

            }

        },

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});

</script>

<?= $this->endSection() ?>