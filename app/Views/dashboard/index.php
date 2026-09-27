<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="dashboard-title mb-1">
                Dashboard
            </h2>

            <p class="dashboard-subtitle mb-0">
                Selamat datang,
                <strong>
                    <?= esc(session()->get('full_name') ?? 'User') ?>
                </strong>
                👋
            </p>
        </div>

        <div>
            <span class="text-muted">
                <?= date('d F Y') ?>
            </span>
        </div>

    </div>


    <div class="row g-4">

        <!-- TOTAL TIKET -->
        <div class="col-md-6 col-lg-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="text-muted small">
                        Total Tiket
                    </div>

                    <h3 class="fw-bold mt-2 mb-0">
                        0
                    </h3>

                </div>

            </div>

        </div>


        <!-- MENUNGGU -->
        <div class="col-md-6 col-lg-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="text-muted small">
                        Menunggu
                    </div>

                    <h3 class="fw-bold mt-2 mb-0">
                        0
                    </h3>

                </div>

            </div>

        </div>


        <!-- DIPROSES -->
        <div class="col-md-6 col-lg-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="text-muted small">
                        Diproses
                    </div>

                    <h3 class="fw-bold mt-2 mb-0">
                        0
                    </h3>

                </div>

            </div>

        </div>


        <!-- SELESAI -->
        <div class="col-md-6 col-lg-3">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="text-muted small">
                        Selesai
                    </div>

                    <h3 class="fw-bold mt-2 mb-0">
                        0
                    </h3>

                </div>

            </div>

        </div>

    </div>


    <!-- INFORMASI AKUN -->

    <div class="card border-0 shadow-sm mt-4">

        <div class="card-body">

            <h5 class="fw-bold mb-4">
                Informasi Akun
            </h5>


            <div class="row">

                <!-- NAMA -->

                <div class="col-md-6 mb-3">

                    <div class="text-muted small mb-1">
                        Nama
                    </div>

                    <div class="fw-semibold">
                        <?= esc(
                            session()->get('full_name') ?? '-'
                        ) ?>
                    </div>

                </div>


                <!-- EMAIL -->

                <div class="col-md-6 mb-3">

                    <div class="text-muted small mb-1">
                        Email
                    </div>

                    <div class="fw-semibold">
                        <?= esc(
                            session()->get('email') ?? '-'
                        ) ?>
                    </div>

                </div>


                <!-- ROLE -->

                <div class="col-md-6">

                    <div class="text-muted small mb-1">
                        Role
                    </div>

                    <div class="fw-semibold">
                        <?= esc(
                            session()->get('role_name')
                            ?? session()->get('role_code')
                            ?? '-'
                        ) ?>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>
