<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_mahasiswa') ?>


<div class="content-wrapper">

    <!-- ==========================================
         HEADER
    =========================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1
                        style="
                            color:#0b3d91;
                            font-weight:700;
                        "
                    >

                        <i class="fas fa-file-alt"></i>

                        Draft Pengajuan

                    </h1>

                </div>

            </div>

        </div>

    </section>


    <!-- ==========================================
         MAIN CONTENT
    =========================================== -->

    <section class="content">

        <div class="container-fluid">

            <div
                class="row justify-content-center"
            >

                <div
                    class="col-lg-8 col-md-10"
                >

                    <div
                        class="card shadow-sm"
                        style="
                            border-top:5px solid #0b3d91;
                            border-radius:15px;
                        "
                    >

                        <div
                            class="card-body text-center p-5"
                        >


                            <!-- ICON -->

                            <div
                                style="
                                    width:95px;
                                    height:95px;
                                    background:#eef5ff;
                                    border-radius:50%;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    margin:0 auto 25px;
                                "
                            >

                                <i
                                    class="fas fa-save"
                                    style="
                                        font-size:45px;
                                        color:#0b3d91;
                                    "
                                ></i>

                            </div>


                            <!-- TITLE -->

                            <h2
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                "
                            >

                                Draft Berhasil Disimpan

                            </h2>


                            <!-- DESCRIPTION -->

                            <p
                                class="text-muted mt-3"
                                style="
                                    font-size:17px;
                                "
                            >

                                Pengajuan Anda telah berhasil disimpan sebagai
                                <strong>Draft</strong>.

                                <br>

                                Anda dapat melanjutkan pengisian dan
                                mengirimkannya nanti.

                            </p>


                            <!-- ==========================================
                                 DATA DRAFT
                            =========================================== -->

                            <?php if (!empty($ticket)): ?>


                                <div
                                    class="mt-4 p-4"
                                    style="
                                        background:#f8fafc;
                                        border:1px solid #dbe4ef;
                                        border-radius:12px;
                                    "
                                >


                                    <!-- NOMOR DRAFT -->

                                    <div class="mb-3">

                                        <small
                                            class="text-muted"
                                        >

                                            Nomor Draft

                                        </small>

                                        <h4
                                            style="
                                                color:#0b3d91;
                                                font-weight:700;
                                            "
                                        >

                                            <?= esc(
                                                $ticket['nomor']
                                                ?? '-'
                                            ) ?>

                                        </h4>

                                    </div>


                                    <hr>


                                    <!-- JENIS LAYANAN -->

                                    <div
                                        class="row text-start mb-3"
                                    >

                                        <div
                                            class="col-md-6"
                                        >

                                            <span
                                                class="text-muted"
                                            >

                                                <i
                                                    class="fas fa-file-alt me-1"
                                                ></i>

                                                Jenis Layanan

                                            </span>

                                        </div>


                                        <div
                                            class="col-md-6 text-md-end"
                                        >

                                            <strong>

                                                <?= esc(
                                                    $ticket['layanan']
                                                    ?? '-'
                                                ) ?>

                                            </strong>

                                        </div>

                                    </div>


                                    <!-- STATUS -->

                                    <div
                                        class="row text-start"
                                    >

                                        <div
                                            class="col-md-6"
                                        >

                                            <span
                                                class="text-muted"
                                            >

                                                <i
                                                    class="fas fa-info-circle me-1"
                                                ></i>

                                                Status

                                            </span>

                                        </div>


                                        <div
                                            class="col-md-6 text-md-end"
                                        >

                                            <span
                                                class="badge bg-secondary"
                                            >

                                                <i
                                                    class="fas fa-file-alt me-1"
                                                ></i>

                                                <?= esc(
                                                    $ticket['status']
                                                    ?? 'Draft'
                                                ) ?>

                                            </span>

                                        </div>

                                    </div>


                                </div>


                            <?php endif; ?>


                            <!-- ==========================================
                                 BUTTON
                            =========================================== -->

                            <div
                                class="
                                    d-flex
                                    justify-content-center
                                    flex-wrap
                                    gap-2
                                    mt-4
                                "
                            >


                                <!-- DASHBOARD -->

                                <a
                                    href="<?= base_url(
                                        'mahasiswa/dashboard'
                                    ) ?>"
                                    class="btn btn-secondary"
                                    style="
                                        font-weight:600;
                                        padding:10px 20px;
                                    "
                                >

                                    <i
                                        class="fas fa-home me-1"
                                    ></i>

                                    Dashboard

                                </a>


                                <!-- LIHAT DRAFT -->

                                <a
                                    href="<?= base_url(
                                        'mahasiswa/ticket/draft'
                                    ) ?>"
                                    class="btn"
                                    style="
                                        background:#0b3d91;
                                        color:white;
                                        font-weight:600;
                                        padding:10px 20px;
                                    "
                                >

                                    <i
                                        class="fas fa-history me-1"
                                    ></i>

                                    Lihat Draft Pengajuan

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