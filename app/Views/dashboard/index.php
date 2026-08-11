<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="crud-header mb-4">

    <div>

        <h2 class="crud-title">

            Dashboard

        </h2>

        <div class="crud-subtitle">

            Selamat datang kembali,
            <strong><?= session('full_name') ?? 'Administrator' ?></strong>

        </div>

    </div>

</div>

<div class="row g-4">

    <div class="col-lg-3 col-md-6">

        <div class="dashboard-card bg-primary-card">

            <div class="card-body">

                <h6>Total User</h6>

                <h2><?= $totalUsers ?></h2>

                <i class="bi bi-people-fill"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="dashboard-card bg-orange-card">

            <div class="card-body">

                <h6>Total Role</h6>

                <h2><?= $totalRoles ?></h2>

                <i class="bi bi-person-badge-fill"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="dashboard-card bg-success-card">

            <div class="card-body">

                <h6>Jenis Pemohon</h6>

                <h2><?= $totalUserTypes ?></h2>

                <i class="bi bi-person-vcard-fill"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="dashboard-card bg-danger-card">

            <div class="card-body">

                <h6>Unit Kerja</h6>

                <h2><?= $totalWorkUnits ?></h2>

                <i class="bi bi-building-fill"></i>

            </div>

        </div>

    </div>

</div>

<div class="row g-4 mt-1">

    <div class="col-lg-3 col-md-6">

        <div class="dashboard-card bg-primary-card">

            <div class="card-body">

                <h6>Jurusan</h6>

                <h2><?= $totalDepartments ?></h2>

                <i class="bi bi-diagram-3-fill"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="dashboard-card bg-orange-card">

            <div class="card-body">

                <h6>Program Studi</h6>

                <h2><?= $totalStudyPrograms ?></h2>

                <i class="bi bi-mortarboard-fill"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="dashboard-card bg-success-card">

            <div class="card-body">

                <h6>User Aktif</h6>

                <h2><?= $activeUsers ?></h2>

                <i class="bi bi-check-circle-fill"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="dashboard-card bg-danger-card">

            <div class="card-body">

                <h6>User Nonaktif</h6>

                <h2><?= $inactiveUsers ?></h2>

                <i class="bi bi-x-circle-fill"></i>

            </div>

        </div>

    </div>

</div>

<div class="row mt-4">

    <div class="col-lg-8">

        <div class="card h-100">

            <div class="card-header border-0 bg-transparent pt-4 pb-0 px-4">

                <h5 class="mb-0 fw-bold">

                    Statistik User

                </h5>

            </div>

            <div class="card-body p-4" style="height: 320px;">

                <canvas id="userChart"></canvas>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card h-100">

            <div class="card-header border-0 bg-transparent pt-4 pb-0 px-4">

                <h5 class="mb-0 fw-bold">

                    Quick Menu

                </h5>

            </div>

            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6">
                        <a href="<?= base_url('users') ?>" class="qm-btn qm-btn-blue d-flex flex-column align-items-center justify-content-center w-100 py-3 rounded-4 text-decoration-none">
                            <i class="bi bi-people-fill fs-3"></i>
                            <span>User</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= base_url('roles') ?>" class="qm-btn qm-btn-orange d-flex flex-column align-items-center justify-content-center w-100 py-3 rounded-4 text-decoration-none">
                            <i class="bi bi-person-badge-fill fs-3"></i>
                            <span>Role</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= base_url('departments') ?>" class="qm-btn qm-btn-blue d-flex flex-column align-items-center justify-content-center w-100 py-3 rounded-4 text-decoration-none">
                            <i class="bi bi-diagram-3-fill fs-3"></i>
                            <span>Jurusan</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= base_url('study-programs') ?>" class="qm-btn qm-btn-blue d-flex flex-column align-items-center justify-content-center w-100 py-3 rounded-4 text-decoration-none">
                            <i class="bi bi-mortarboard-fill fs-3"></i>
                            <span>Prodi</span>
                        </a>
                    </div>
                    <div class="col-12">
                        <a href="<?= base_url('work-units') ?>" class="qm-btn qm-btn-blue d-flex flex-column align-items-center justify-content-center w-100 py-3 rounded-4 text-decoration-none">
                            <i class="bi bi-building-fill fs-3"></i>
                            <span>Unit Kerja</span>
                        </a>
                    </div>
                </div>
                <style>
                    .qm-btn {
                        background: #fff;
                        transition: all 0.3s ease;
                        gap: 8px;
                        font-size: 0.85rem;
                        font-weight: 600;
                        color: #1F2937;
                    }
                    .qm-btn-blue {
                        border: 1.5px solid rgba(41, 53, 130, 0.35);
                        box-shadow:
                            0 0 0 1px rgba(41, 53, 130, 0.10),
                            0 0 14px rgba(41, 53, 130, 0.18),
                            0 0 28px rgba(41, 53, 130, 0.08);
                        color: var(--primary);
                    }
                    .qm-btn-blue i { color: var(--primary); }
                    .qm-btn-blue span { color: #1F2937; }
                    .qm-btn-blue:hover {
                        transform: translateY(-5px);
                        background: rgba(41, 53, 130, 0.05);
                        border-color: rgba(41, 53, 130, 0.6);
                        box-shadow:
                            0 8px 24px rgba(41, 53, 130, 0.15),
                            0 0 0 1.5px rgba(41, 53, 130, 0.35),
                            0 0 24px rgba(41, 53, 130, 0.28),
                            0 0 48px rgba(41, 53, 130, 0.12);
                    }
                    .qm-btn-orange {
                        border: 1.5px solid rgba(255, 127, 0, 0.40);
                        box-shadow:
                            0 0 0 1px rgba(255, 127, 0, 0.12),
                            0 0 14px rgba(255, 127, 0, 0.22),
                            0 0 28px rgba(255, 127, 0, 0.10);
                    }
                    .qm-btn-orange i { color: var(--orange); }
                    .qm-btn-orange span { color: #1F2937; }
                    .qm-btn-orange:hover {
                        transform: translateY(-5px);
                        background: rgba(255, 127, 0, 0.05);
                        border-color: rgba(255, 127, 0, 0.70);
                        box-shadow:
                            0 8px 24px rgba(255, 127, 0, 0.15),
                            0 0 0 1.5px rgba(255, 127, 0, 0.40),
                            0 0 24px rgba(255, 127, 0, 0.30),
                            0 0 48px rgba(255, 127, 0, 0.14);
                    }
                </style>
            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx=document.getElementById('userChart');

new Chart(ctx,{

type: 'bar',
data: {
    labels: ['User Aktif', 'User Nonaktif'],
    datasets: [{
        label: 'Jumlah User',
        data: [<?= $activeUsers ?>, <?= $inactiveUsers ?>],
        backgroundColor: ['rgba(41, 53, 130, 0.85)', 'rgba(255, 127, 0, 0.85)'],
        hoverBackgroundColor: ['#293582', '#FF7F00'],
        borderRadius: 8,
        borderSkipped: false,
        barPercentage: 0.5,
        categoryPercentage: 0.8
    }]
},
options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
        legend: { display: false },
        tooltip: {
            backgroundColor: '#fff',
            titleColor: '#000',
            bodyColor: '#555',
            borderColor: '#ddd',
            borderWidth: 1,
            padding: 12,
            boxPadding: 6,
            usePointStyle: true,
            titleFont: { size: 14, family: "'Inter', sans-serif" },
            bodyFont: { size: 13, family: "'Inter', sans-serif" }
        }
    },
    scales: {
        y: {
            beginAtZero: true,
            grid: {
                color: '#f0f0f0',
                drawBorder: false,
                borderDash: [5, 5]
            },
            ticks: {
                stepSize: 1,
                font: { family: "'Inter', sans-serif" },
                color: '#888'
            },
            border: { display: false }
        },
        x: {
            grid: { display: false },
            ticks: {
                font: { family: "'Inter', sans-serif", weight: '600' },
                color: '#444'
            },
            border: { display: false }
        }
    }
}

});

</script>

<?= $this->endSection() ?>