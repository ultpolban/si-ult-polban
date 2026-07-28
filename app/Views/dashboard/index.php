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

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0">

                    Statistik User

                </h5>

            </div>

            <div class="card-body">

                <canvas id="userChart" height="110"></canvas>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card">

            <div class="card-header">

                <h5 class="mb-0">

                    Quick Menu

                </h5>

            </div>

            <div class="card-body d-grid gap-3">

                <a href="<?= base_url('users') ?>" class="btn btn-primary">

                    <i class="bi bi-people-fill me-2"></i>

                    Management User

                </a>

                <a href="<?= base_url('roles') ?>" class="btn btn-orange">

                    <i class="bi bi-person-badge-fill me-2"></i>

                    Management Role

                </a>

                <a href="<?= base_url('departments') ?>" class="btn btn-outline-primary">

                    <i class="bi bi-diagram-3-fill me-2"></i>

                    Jurusan

                </a>

                <a href="<?= base_url('study-programs') ?>" class="btn btn-outline-primary">

                    <i class="bi bi-mortarboard-fill me-2"></i>

                    Program Studi

                </a>

                <a href="<?= base_url('work-units') ?>" class="btn btn-outline-primary">

                    <i class="bi bi-building-fill me-2"></i>

                    Unit Kerja

                </a>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx=document.getElementById('userChart');

new Chart(ctx,{

type:'bar',

data:{

labels:['Aktif','Nonaktif'],

datasets:[{

label:'Jumlah User',

data:[<?= $activeUsers ?>,<?= $inactiveUsers ?>],

backgroundColor:['#293582','#FF7F00']

}]

},

options:{

responsive:true,

plugins:{

legend:{display:false}

}

}

});

</script>

<?= $this->endSection() ?>