<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container py-5">

    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">
            🎓 Layanan Akademik
        </h2>

        <p class="text-muted">
            Pilih layanan akademik yang ingin Anda ajukan.
        </p>
    </div>

    <div class="row">

        <?php if (!empty($services)) : ?>

            <?php foreach ($services as $service) : ?>

                <div class="col-md-6 col-lg-4 mb-4">

                    <div class="card shadow-sm border-0 h-100">

                        <div class="card-body">

                            <h5 class="fw-bold">
                                <?= esc($service['service_name']); ?>
                            </h5>

                            <p class="text-muted">
                                <?= esc($service['description']); ?>
                            </p>

                            <p class="small text-secondary">
                                <strong>Estimasi Layanan:</strong>
                                <?= esc($service['sla_hours']); ?> Jam
                            </p>

                        <a href="<?= base_url('layanan/'.$service['id']) ?>" class="btn btn-primary w-100">
    Lihat Detail
</a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else : ?>

            <div class="col-12">

                <div class="alert alert-warning text-center">

                    Belum ada layanan akademik yang tersedia.

                </div>

            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>