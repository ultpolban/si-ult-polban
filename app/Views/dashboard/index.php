<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Dashboard SI ULT POLBAN</h1>
    </div>
</div>

<section class="content">

<div class="container-fluid">

    <!-- Statistik -->
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

        <div class="col-lg-3 col-6">
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

    <!-- Grafik -->
    <div class="row">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        Grafik Status Tiket
                    </h3>
                </div>

                <div class="card-body">
                    <canvas id="ticketChart" height="100"></canvas>
                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        Persentase Status
                    </h3>
                </div>

                <div class="card-body">
                    <canvas id="pieChart"></canvas>
                </div>

            </div>

        </div>

    </div>

    <!-- Tiket Terbaru -->
    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                5 Tiket Terbaru
            </h3>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped">

                <thead>

                    <tr>

                        <th>No Tiket</th>
                        <th>Pemohon</th>
                        <th>Layanan</th>
                        <th>Status</th>
                        <th>Tanggal</th>

                    </tr>

                </thead>

                <tbody>

                <?php foreach($tickets as $ticket): ?>

                    <?php

                    $badge = 'secondary';

                    switch($ticket['status']){

                        case 'Submitted':
                            $badge='warning';
                            break;

                        case 'Assigned':
                            $badge='info';
                            break;

                        case 'Verified':
                            $badge='success';
                            break;

                        case 'In Progress':
                            $badge='primary';
                            break;

                        case 'Completed':
                            $badge='success';
                            break;

                        case 'Need Revision':
                            $badge='dark';
                            break;

                        case 'Rejected':
                            $badge='danger';
                            break;

                    }

                    ?>

                    <tr>

                        <td><?= esc($ticket['ticket_number']) ?></td>

                        <td><?= esc($ticket['applicant_name']) ?></td>

                        <td><?= esc($ticket['service_name']) ?></td>

                        <td>

                            <span class="badge badge-<?= $badge ?>">
                                <?= esc($ticket['status']) ?>
                            </span>

                        </td>

                        <td><?= date('d-m-Y H:i',strtotime($ticket['submitted_at'])) ?></td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx=document.getElementById('ticketChart');

new Chart(ctx,{

    type:'bar',

    data:{

        labels:[
            'Submitted',
            'Assigned',
            'Verified',
            'Progress',
            'Completed',
            'Revision',
            'Rejected'
        ],

        datasets:[{

            label:'Jumlah Tiket',

            data:[

                <?= $submitted ?>,
                <?= $assigned ?>,
                <?= $verified ?>,
                <?= $progress ?>,
                <?= $completed ?>,
                <?= $revision ?>,
                <?= $rejected ?>

            ]

        }]

    },

    options:{

        responsive:true,

        plugins:{

            legend:{
                display:false
            }

        }

    }

});

const pie=document.getElementById('pieChart');

new Chart(pie,{

    type:'doughnut',

    data:{

        labels:[
            'Submitted',
            'Assigned',
            'Verified',
            'Progress',
            'Completed',
            'Revision',
            'Rejected'
        ],

        datasets:[{

            data:[

                <?= $submitted ?>,
                <?= $assigned ?>,
                <?= $verified ?>,
                <?= $progress ?>,
                <?= $completed ?>,
                <?= $revision ?>,
                <?= $rejected ?>

            ]

        }]

    },

    options:{

        responsive:true,

        plugins:{

            legend:{
                position:'bottom'
            }

        }

    }

});

</script>

<?= $this->endSection() ?>