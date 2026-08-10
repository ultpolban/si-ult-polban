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
                                <i class="fas fa-check-circle"></i>
                                Pengajuan Berhasil
                            </h4>

                        </div>

                        <div class="card-body text-center p-5">

                            <div class="mb-4">

                                <i class="fas fa-check-circle"
                                   style="font-size:80px;color:#28a745;">
                                </i>

                            </div>

                            <h3 class="mb-3">
                                Pengajuan Berhasil Dikirim!
                            </h3>

                            <p class="text-muted">
                                Pengajuan layanan Anda telah berhasil dikirim
                                dan sedang menunggu proses verifikasi.
                            </p>

                            <div class="alert alert-primary mt-4">

                                <div class="mb-2">
                                    <strong>Nomor Tiket Anda</strong>
                                </div>

                                <h2 class="font-weight-bold">
                                    <?= esc($ticket['nomor_tiket']) ?>
                                </h2>

                                <small>
                                    Simpan nomor tiket ini untuk melakukan
                                    tracking pengajuan Anda.
                                </small>

                            </div>

                            <div class="text-left mt-4">

                                <p>
                                    <strong>Nama Pemohon:</strong>
                                    <?= esc($ticket['nama_pemohon']) ?>
                                </p>

                                <p>
                                    <strong>Unit Layanan:</strong>
                                    <?= esc($ticket['unit_layanan']) ?>
                                </p>

                                <p>
                                    <strong>Jenis Layanan:</strong>
                                    <?= esc($ticket['jenis_layanan']) ?>
                                </p>

                                <p>
                                    <strong>Status:</strong>

                                    <span class="badge badge-warning">
                                        <?= esc($ticket['status']) ?>
                                    </span>

                                </p>

                            </div>

                            <hr>

                            <div class="d-flex justify-content-center gap-2">

                                <a href="<?= base_url('mahasiswa/ticket/tracking/' . $ticket['nomor_tiket']) ?>"
                                   class="btn btn-primary mr-2">

                                    <i class="fas fa-search"></i>
                                    Tracking Tiket

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