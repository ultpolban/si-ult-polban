<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>

<div class="container py-5">

    <div class="card shadow border-0">

        <div class="card-header text-white" style="background:#082B63;">
           <h3 class="mb-0"><?= esc($service['name']) ?></h3>
        </div>

        <div class="card-body">

            <h5 class="fw-bold">Deskripsi Layanan</h5>

            <p class="text-muted">
                <?= esc($service['description']) ?>
            </p>

            <hr>

            <h5 class="fw-bold">Estimasi Penyelesaian</h5>

            <p>
                <?= esc($service['service_hours']) ?> Jam
            </p>

            <hr>

           <h5 class="fw-bold">Estimasi Penyelesaian</h5>

<p>
    <?= esc($service['service_hours']) ?> Jam
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

               <button type="button"
        class="btn btn-ajukan"
        data-bs-toggle="modal"
        data-bs-target="#loginModal">
    Ajukan Layanan
</button>

            </div>

        </div>

    </div>

</div>


                <!-- Modal Login Diperlukan -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">
                    Login Diperlukan
                </h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <div class="modal-body text-center">

                <i class="bi bi-lock-fill fs-1 text-primary"></i>

                <h5 class="mt-3">
                    Silakan Login Terlebih Dahulu
                </h5>

                <p class="text-muted mb-0">
                    Anda harus login terlebih dahulu
                    untuk mengajukan layanan.
                </p>

            </div>

            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Batal
                </button>

                <a href="<?= base_url('login') ?>"
                   class="btn btn-ajukan">
                    Login Sekarang
                </a>

            </div>

        </div>
    </div>
</div>
<?= $this->include('layouts/footer') ?>