<?= $this->extend('layouts/template_public') ?>

<?= $this->section('content') ?>

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h2 class="text-success fw-bold mb-1">
                🎓 Layanan Kemahasiswaan
            </h2>

            <p class="text-muted mb-0">
                Informasi dan layanan administrasi kemahasiswaan melalui SI-ULT POLBAN.
            </p>

        </div>

        <button type="button"
                class="btn btn-outline-success"
                data-bs-toggle="modal"
                data-bs-target="#modalUnitKemahasiswaan">

            <i class="bi bi-info-circle me-1"></i>
            Tentang Unit

        </button>

    </div>


    <!-- Daftar Layanan -->

    <div class="row">

        <?php if (!empty($services)) : ?>

            <?php foreach ($services as $service) : ?>

                <div class="col-md-6 col-lg-4 mb-4">

                    <div class="card shadow-sm border-0 h-100">

                        <div class="card-body d-flex flex-column">

                            <h5 class="fw-bold mb-3">
                                <?= esc($service['name']); ?>
                            </h5>

                            <p class="text-muted">
                                <?= esc($service['description']); ?>
                            </p>

                            <div class="mt-auto">

                                <p class="small text-secondary mb-3">

                                    <strong>
                                        <i class="bi bi-clock me-1"></i>
                                        Estimasi Layanan:
                                    </strong>

                                    <?= esc($service['service_hours']); ?>

                                </p>

                                <a href="<?= base_url('layanan/detail/'.$service['id']) ?>"
                                   class="btn btn-ajukan w-100">

                                    Lihat Detail

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else : ?>

            <div class="col-12">

                <div class="alert alert-warning text-center">

                    Belum ada layanan kemahasiswaan yang tersedia.

                </div>

            </div>

        <?php endif; ?>

    </div>

</div>


<!-- ================================================= -->
<!-- MODAL PROFIL UNIT KEMAHASISWAAN -->
<!-- ================================================= -->

<div class="modal fade"
     id="modalUnitKemahasiswaan"
     tabindex="-1"
     aria-labelledby="modalUnitKemahasiswaanLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">

        <div class="modal-content border-0 shadow">

            <!-- MODAL HEADER -->
            <div class="modal-header">

                <div>

                    <h5 class="modal-title fw-bold"
                        id="modalUnitKemahasiswaanLabel">

                        🎓 <?= esc($unit['unit_name'] ?? 'Unit Layanan Kemahasiswaan'); ?>

                    </h5>

                    <small class="text-muted">
                        Profil unit berdasarkan fungsi layanan SI-ULT POLBAN
                    </small>

                </div>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>

            </div>


            <!-- MODAL BODY -->
            <div class="modal-body px-4">

                <!-- TENTANG UNIT -->
                <div class="mb-4">

                    <h6 class="fw-bold text-success mb-2">

                        <i class="bi bi-building me-2"></i>
                        Tentang Unit

                    </h6>

                    <p class="text-muted">
                        <?= esc($profile['description'] ?? 'Profil unit belum tersedia.'); ?>
                    </p>

                </div>

            </div>


            <!-- MODAL FOOTER -->
            <div class="modal-footer">

                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                    Tutup

                </button>

            </div>

        </div>

    </div>

</div>


<?= $this->endSection() ?>