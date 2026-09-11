<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_umum') ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1
                        class="font-weight-bold"
                        style="color:#0b3d91;"
                    >

                        <i class="fas fa-check-circle mr-2"></i>

                        Draft Pengajuan

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url('umum/dashboard') ?>"
                            >
                                Dashboard
                            </a>

                        </li>


                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url('umum/ticket/draft') ?>"
                            >
                                Draft Pengajuan
                            </a>

                        </li>


                        <li class="breadcrumb-item active">

                            Berhasil

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>


    <section class="content">

        <div class="container-fluid">

            <div class="card shadow-sm border-0">

                <div class="card-body text-center py-5">


                    <!-- ICON -->

                    <div class="mb-4">

                        <i
                            class="fas fa-check-circle text-success"
                            style="font-size:80px;"
                        ></i>

                    </div>


                    <!-- TITLE -->

                    <h3
                        class="font-weight-bold text-success"
                    >

                        Draft Berhasil Disimpan

                    </h3>


                    <!-- DESCRIPTION -->

                    <p class="text-muted mt-3">

                        Draft pengajuan layanan Anda berhasil
                        disimpan.

                        Anda dapat melanjutkannya kapan saja melalui
                        menu Draft Pengajuan.

                    </p>


                    <?php
                        $draft =
                            session()->get(
                                'draft_success'
                            );
                    ?>


                    <?php if (!empty($draft)) : ?>

                        <?php if (!empty($draft['nomor_draft'])) : ?>

                            <div
                                class="alert alert-info mt-4"
                            >

                                <strong>
                                    Nomor Draft:
                                </strong>

                                <?= esc(
                                    $draft['nomor_draft']
                                ) ?>

                            </div>

                        <?php endif; ?>

                    <?php endif; ?>


                    <!-- BUTTON -->

                    <div class="mt-4">


                        <a
                            href="<?= base_url('umum/ticket/draft') ?>"
                            class="btn btn-primary mr-2"
                        >

                            <i class="fas fa-file-alt mr-1"></i>

                            Lihat Draft

                        </a>


                        <a
                            href="<?= base_url('umum/dashboard') ?>"
                            class="btn btn-secondary"
                        >

                            <i class="fas fa-home mr-1"></i>

                            Dashboard

                        </a>


                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>