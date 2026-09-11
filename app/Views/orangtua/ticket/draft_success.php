<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_orangtua') ?>

<div class="content-wrapper">

    <section class="content">

        <div class="container-fluid pt-4">

            <div class="row justify-content-center">

                <div class="col-md-8">

                    <div class="card shadow">

                        <div
                            class="card-header text-center"
                            style="background:#174a96;color:white;"
                        >

                            <h4 class="mb-0">

                                <i class="fas fa-save"></i>

                                Pengajuan Berhasil Diajukan

                            </h4>

                        </div>

                        <div class="card-body text-center p-5">

                            <div class="mb-4">

                                <i
                                    class="fas fa-file-alt"
                                    style="
                                        font-size:80px;
                                        color:#174a96;
                                    "
                                >
                                </i>

                            </div>

                            <h3>

                                Pengajuan Berhasil Diajukan!

                            </h3>

                            <p class="text-muted">

                                Pengajuan layanan Anda telah berhasil
                                dikirim dan masuk ke proses pelayanan.

                            </p>

                            <div class="alert alert-info mt-4">

                                <strong>

                                    Nomor Tiket

                                </strong>

                                <h3 class="font-weight-bold mt-2">

                                    <?= esc(
                                        $draft['ticket_number']
                                        ?? '-'
                                    ) ?>

                                </h3>

                            </div>

                            <div class="mt-4">

                                <a
                                    href="<?= base_url(
                                        'orangtua/ticket/history'
                                    ) ?>"
                                    class="btn btn-primary mr-2"
                                >

                                    <i class="fas fa-history"></i>

                                    Lihat Riwayat

                                </a>

                                <a
                                    href="<?= base_url(
                                        'dashboard-orangtua'
                                    ) ?>"
                                    class="btn btn-secondary"
                                >

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