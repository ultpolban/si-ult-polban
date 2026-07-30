<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-4 py-4">

    <h2 class="mb-4 font-weight-bold text-dark">Statistik Tiket</h2>

    <div class="row mb-3">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #17a2b8; border-radius: 10px;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="mb-0 font-weight-bold" style="font-size: 2.2rem;"><?= $total_tiket ?? 13 ?></h2>
                        <span class="text-white font-weight-normal d-block mt-1">Total Tiket</span>
                    </div>
                    <div>
                        <i class="fas fa-ticket-alt text-white opacity-25" style="font-size: 2.8rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 text-dark shadow-sm h-100" style="background-color: #ffc107; border-radius: 10px;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="mb-0 font-weight-bold text-dark" style="font-size: 2.2rem;"><?= $submitted ?? 5 ?></h2>
                        <span class="text-dark font-weight-normal d-block mt-1">Submitted</span>
                    </div>
                    <div>
                        <i class="fas fa-paper-plane text-dark opacity-25" style="font-size: 2.8rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #6c757d; border-radius: 10px;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="mb-0 font-weight-bold" style="font-size: 2.2rem;"><?= $assigned ?? 3 ?></h2>
                        <span class="text-white font-weight-normal d-block mt-1">Assigned</span>
                    </div>
                    <div>
                        <i class="fas fa-user-check text-white opacity-25" style="font-size: 2.8rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #28a745; border-radius: 10px;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="mb-0 font-weight-bold" style="font-size: 2.2rem;"><?= $in_progress ?? 0 ?></h2>
                        <span class="text-white font-weight-normal d-block mt-1">In Progress</span>
                    </div>
                    <div>
                        <i class="fas fa-spinner text-white opacity-25" style="font-size: 2.8rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #28a745; border-radius: 10px;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="mb-0 font-weight-bold" style="font-size: 2.2rem;"><?= $completed ?? 0 ?></h2>
                        <span class="text-white font-weight-normal d-block mt-1">Completed</span>
                    </div>
                    <div>
                        <i class="fas fa-check-circle text-white opacity-25" style="font-size: 2.8rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #6c757d; border-radius: 10px;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="mb-0 font-weight-bold" style="font-size: 2.2rem;"><?= $need_revision ?? 2 ?></h2>
                        <span class="text-white font-weight-normal d-block mt-1">Need Revision</span>
                    </div>
                    <div>
                        <i class="fas fa-edit text-white opacity-25" style="font-size: 2.8rem;"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card border-0 text-white shadow-sm h-100" style="background-color: #dc3545; border-radius: 10px;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="mb-0 font-weight-bold" style="font-size: 2.2rem;"><?= $rejected ?? 1 ?></h2>
                        <span class="text-white font-weight-normal d-block mt-1">Rejected</span>
                    </div>
                    <div>
                        <i class="fas fa-times-circle text-white opacity-25" style="font-size: 2.8rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 8px; overflow: hidden;">
        <div class="card-header text-white font-weight-bold py-2 px-3" style="background-color: #1a237e;">
            Progress Penyelesaian Tiket
        </div>
        <div class="card-body p-3">
            <div class="progress" style="height: 22px; border-radius: 4px; background-color: #e9ecef;">
                <div class="progress-bar bg-success font-weight-bold" 
                     role="progressbar" 
                     style="width: <?= $progress ?? 70 ?>%; font-size: 0.85rem;" 
                     aria-valuenow="<?= $progress ?? 70 ?>" 
                     aria-valuemin="0" 
                     aria-valuemax="100">
                    <?= $progress ?? 70 ?>%
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4" style="border-radius: 8px; overflow: hidden;">
        <div class="card-header text-white font-weight-bold py-2 px-3" style="background-color: #1a237e;">
            Grafik Statistik Tiket
        </div>
        <div class="card-body p-3" style="min-height: 280px;">
            <canvas id="grafikStatistik" style="width: 100%; max-height: 250px;"></canvas>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('grafikStatistik').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Submitted',
                    'Assigned',
                    'In Progress',
                    'Completed',
                    'Need Revision',
                    'Rejected'
                ],
                datasets: [{
                    label: 'Jumlah Tiket',
                    data: [
                        <?= $submitted ?? 5 ?>,
                        <?= $assigned ?? 3 ?>,
                        <?= $in_progress ?? 0 ?>,
                        <?= $completed ?? 0 ?>,
                        <?= $need_revision ?? 2 ?>,
                        <?= $rejected ?? 1 ?>
                    ],
                    backgroundColor: [
                        '#17a2b8', // Submitted (Tosca)
                        '#6c757d', // Assigned (Abu-abu)
                        '#28a745', // In Progress (Hijau)
                        '#28a745', // Completed (Hijau)
                        '#6c757d', // Need Revision (Abu-abu)
                        '#dc3545'  // Rejected (Merah)
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>

<?= $this->endSection() ?>