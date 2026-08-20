<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container py-5">

   <h2 class="fw-bold">Layanan Kemahasiswaan</h2>

    <div class="row">

        <?php if(!empty($services)): ?>

            <?php foreach($services as $service): ?>

                <div class="col-md-6 col-lg-4 mb-4">

                    <div class="card shadow-sm border-0 h-100">

                        <div class="card-body">

                            <h5 class="fw-bold">
                                <?= esc($service['name']); ?>
                            </h5>

                            <p class="text-muted">
                                <?= esc($service['description']); ?>
                            </p>

                            <small class="text-secondary">
                                Estimasi :
                                <?= esc($service['service_hours']); ?> Jam
                            </small>

                            <br><br>
<a href="<?= base_url('layanan/detail/'.$service['id']) ?>"
   class="btn btn-ajukan w-100">
    Lihat Detail
</a>
                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="col-12">

                <div class="alert alert-warning">

                    Data layanan belum tersedia.

                </div>

            </div>

        <?php endif; ?>

    </div>

</div>

<?= $this->endSection() ?>