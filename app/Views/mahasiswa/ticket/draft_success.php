<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <section class="content">

        <div class="container-fluid pt-4">

            <div class="row justify-content-center">

                <div class="col-md-8">

                    <div class="card shadow">

                        <div class="card-header text-center"
                             style="background:#174a96;color:white;">

                            <h4 class="mb-0">
                                <i class="fas fa-save"></i>
                                Draft Berhasil Disimpan
                            </h4>

                        </div>

                        <div class="card-body text-center p-5">

                            <div class="mb-4">

                                <i class="fas fa-file-alt"
                                   style="font-size:80px;color:#174a96;">
                                </i>

                            </div>

                            <h3>
                                Draft Berhasil Disimpan!
                            </h3>

                            <p class="text-muted">
                                Pengajuan Anda telah disimpan sebagai draft
                                dan dapat dilanjutkan kembali nanti.
                            </p>

                            <div class="alert alert-info mt-4">

                                <strong>Nomor Draft</strong>

                                <h3 class="font-weight-bold mt-2">
                                    <?= esc($draft['nomor_draft']) ?>
                                </h3>

                            </div>

                            <div class="mt-4">

                                <a href="<?= base_url('mahasiswa/ticket/draft') ?>"
                                   class="btn btn-primary mr-2">

                                    <i class="fas fa-file-alt"></i>
                                    Lihat Draft

                                </a>

                                <a href="<?= base_url('mahasiswa/dashboard') ?>"
                                   class="btn btn-secondary">

                                    <i class="fas fa-home"></i>
                                    Dashboard

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>