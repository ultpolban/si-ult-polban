<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>

<div class="container py-5">

    <div class="card shadow border-0">

        <div class="card-header text-white" style="background:#082B63;">
            <h3 class="mb-0"><?= esc($service['service_name']) ?></h3>
        </div>

        <div class="card-body">

            <h5 class="fw-bold">Deskripsi Layanan</h5>

            <p class="text-muted">
                <?= esc($service['description']) ?>
            </p>

            <hr>

            <h5 class="fw-bold">Estimasi Penyelesaian</h5>

            <p>
                <?= esc($service['sla_hours']) ?> Jam
            </p>

            <hr>

            <h5 class="fw-bold mb-3">Persyaratan</h5>

            <?php if(!empty($requirements)): ?>

                <ul class="list-group mb-4">

                    <?php foreach($requirements as $requirement): ?>

                        <li class="list-group-item">

                            <i class="bi bi-check-circle-fill text-success me-2"></i>

                            <?= esc($requirement['requirement']) ?>

                        </li>

                    <?php endforeach; ?>

                </ul>

            <?php else: ?>

                <div class="alert alert-warning">

                    Belum ada persyaratan.

                </div>

            <?php endif; ?>

            <div class="d-flex justify-content-between">

                <a href="<?= previous_url() ?>" class="btn btn-secondary">

                    Kembali

                </a>

                <a href="#" class="btn btn-ajukan">

                    Ajukan Layanan

                </a>

            </div>

        </div>

    </div>

</div>

<?= $this->include('layouts/footer') ?>