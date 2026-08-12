<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <section class="content">

        <div class="container-fluid pt-4 pb-4">

            <div class="row justify-content-center">

                <div class="col-lg-8 col-md-10">

                    <div class="card shadow-lg border-0">

                        <!-- HEADER -->
                        <div class="card-header text-center border-0"
                             style="
                                background: linear-gradient(135deg, #0b3d91, #174a96);
                                color: white;
                                padding: 28px 20px;
                             ">

                            <div class="mb-2">
                                <i class="fas fa-check-circle"
                                   style="font-size:55px;">
                                </i>
                            </div>

                            <h3 class="font-weight-bold mb-1">
                                Pengajuan Berhasil!
                            </h3>

                            <p class="mb-0" style="opacity: .9;">
                                Pengajuan layanan kamu berhasil dikirim
                            </p>

                        </div>


                        <!-- BODY -->
                        <div class="card-body text-center p-4 p-md-5">

                            <!-- ICON SUCCESS -->

                            <div class="mb-3">

                                <div style="
                                    width:85px;
                                    height:85px;
                                    border-radius:50%;
                                    background:#e8f5e9;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    margin:auto;
                                ">

                                    <i class="fas fa-check"
                                       style="
                                            font-size:42px;
                                            color:#198754;
                                       ">
                                    </i>

                                </div>

                            </div>


                            <h4 class="font-weight-bold mb-2">
                                Pengajuan Layanan Berhasil Dikirim
                            </h4>

                            <p class="text-muted mb-4">
                                Pengajuan kamu telah berhasil diterima oleh
                                sistem ULT POLBAN dan sedang menunggu proses
                                verifikasi.
                            </p>


                            <!-- NOMOR TIKET -->

                            <div class="ticket-box mb-4"
                                 style="
                                    background:#f4f7fb;
                                    border:2px dashed #174a96;
                                    border-radius:12px;
                                    padding:25px 15px;
                                 ">

                                <div class="text-muted mb-2">
                                    <i class="fas fa-ticket-alt"></i>
                                    Nomor Tiket Kamu
                                </div>

                                <h2 class="font-weight-bold mb-2"
                                    style="
                                        color:#174a96;
                                        letter-spacing:2px;
                                    ">

                                    <?= esc($ticket['nomor_tiket']) ?>

                                </h2>

                                <small class="text-muted">
                                    Simpan nomor tiket ini untuk melihat
                                    perkembangan pengajuan kamu.
                                </small>

                            </div>


                            <!-- INFORMASI PENGAJUAN -->

                            <div class="text-left mb-4">

                                <h5 class="font-weight-bold mb-3"
                                    style="color:#174a96;">

                                    <i class="fas fa-file-alt"></i>
                                    Informasi Pengajuan

                                </h5>


                                <div class="table-responsive">

                                    <table class="table table-bordered mb-0">

                                        <tr>

                                            <th style="width:35%; background:#f8f9fa;">
                                                Nama Pemohon
                                            </th>

                                            <td>
                                                <?= esc($ticket['nama_pemohon']) ?>
                                            </td>

                                        </tr>


                                        <tr>

                                            <th style="background:#f8f9fa;">
                                                Unit Layanan
                                            </th>

                                            <td>
                                                <?= esc($ticket['unit_layanan']) ?>
                                            </td>

                                        </tr>


                                        <tr>

                                            <th style="background:#f8f9fa;">
                                                Jenis Layanan
                                            </th>

                                            <td>
                                                <?= esc($ticket['jenis_layanan']) ?>
                                            </td>

                                        </tr>


                                        <tr>

                                            <th style="background:#f8f9fa;">
                                                Status
                                            </th>

                                            <td>

                                                <span class="badge badge-warning px-3 py-2">

                                                    <i class="fas fa-clock"></i>

                                                    <?= esc($ticket['status']) ?>

                                                </span>

                                            </td>

                                        </tr>

                                    </table>

                                </div>

                            </div>


                            <!-- INFO -->

                            <div class="alert alert-light border text-left">

                                <div class="d-flex">

                                    <div class="mr-3">

                                        <i class="fas fa-info-circle"
                                           style="
                                                color:#174a96;
                                                font-size:24px;
                                           ">
                                        </i>

                                    </div>

                                    <div>

                                        <strong>
                                            Informasi
                                        </strong>

                                        <p class="mb-0 mt-1 text-muted">

                                            Gunakan nomor tiket untuk
                                            memantau proses pengajuan layanan
                                            kamu melalui halaman Tracking Tiket.

                                        </p>

                                    </div>

                                </div>

                            </div>


                            <hr class="my-4">


                            <!-- BUTTON -->

                            <div class="d-flex justify-content-center flex-wrap">

                                <a href="<?= base_url('mahasiswa/ticket/history') ?>"
                                   class="btn btn-primary mr-2 mb-2 px-4"
                                   style="
                                        background:#174a96;
                                        border-color:#174a96;
                                   ">

                                    <i class="fas fa-search mr-1"></i>

                                    Tracking Tiket

                                </a>


                                <a href="<?= base_url('mahasiswa/dashboard') ?>"
                                   class="btn btn-outline-secondary mb-2 px-4">

                                    <i class="fas fa-home mr-1"></i>

                                    Dashboard

                                </a>

                            </div>

                        </div>

                    </div>


                    <!-- FOOTER INFO -->

                    <div class="text-center mt-3">

                        <small class="text-muted">

                            <i class="fas fa-university"></i>

                            Unit Layanan Terpadu
                            Politeknik Negeri Bandung

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>