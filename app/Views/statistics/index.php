<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <h1>Statistik Tiket</h1>
</div>

<div class="card">
    <div class="card-body">

        <canvas id="chartTiket" height="120"></canvas>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx = document.getElementById('chartTiket');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [
            'Submitted',
            'Verified',
            'Completed',
            'Diproses Unit'
        ],

        datasets: [{

            label: 'Jumlah Tiket',

            data: [
                <?= $submitted ?>,
                <?= $verified ?>,
                <?= $completed ?>,
                <?= $diproses ?>
            ]

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

</script>

<?= $this->endSection() ?>