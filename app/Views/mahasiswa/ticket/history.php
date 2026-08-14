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

                        <i class="fas fa-ticket-alt mr-2"></i>

                        Tracking Tiket

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url(
                                    'dashboard-mahasiswa'
                                ) ?>"
                            >

                                Dashboard

                            </a>

                        </li>


                        <li class="breadcrumb-item active">

                            Tracking Tiket

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>



    <!-- ==========================================
         CONTENT
    =========================================== -->

    <section class="content">

        <div class="container-fluid">


            <!-- ==========================================
                 ALERT SUCCESS
            =========================================== -->

            <?php if (
                session()->getFlashdata('success')
            ) : ?>

                <div
                    class="
                        alert
                        alert-success
                        alert-dismissible
                        fade
                        show
                    "
                >

                    <i
                        class="
                            fas
                            fa-check-circle
                            mr-2
                        "
                    ></i>

                    <?= esc(
                        session()->getFlashdata('success')
                    ) ?>


                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                    >

                        &times;

                    </button>

                </div>

            <?php endif; ?>



            <!-- ==========================================
                 ALERT ERROR
            =========================================== -->

            <?php if (
                session()->getFlashdata('error')
            ) : ?>

                <div
                    class="
                        alert
                        alert-danger
                        alert-dismissible
                        fade
                        show
                    "
                >

                    <i
                        class="
                            fas
                            fa-exclamation-circle
                            mr-2
                        "
                    ></i>

                    <?= esc(
                        session()->getFlashdata('error')
                    ) ?>


                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                    >

                        &times;

                    </button>

                </div>

            <?php endif; ?>



            <!-- ==========================================
                 CARD
            =========================================== -->

            <div
                class="
                    card
                    shadow-sm
                    border-0
                "
            >


                <!-- CARD HEADER -->

                <div
                    class="
                        card-header
                        text-white
                    "
                    style="
                        background-color:#0b3d91;
                        border-bottom:4px solid #f28c28;
                    "
                >

                    <h5 class="mb-0">

                        <i
                            class="
                                fas
                                fa-ticket-alt
                                mr-2
                            "
                        ></i>

                        Daftar Tiket Pengajuan

                    </h5>

                </div>



                <!-- CARD BODY -->

                <div class="card-body">


                    <?php if (
                        !empty($tickets)
                    ) : ?>


                        <!-- ==========================================
                             TABLE
                        =========================================== -->

                        <div class="table-responsive">

                            <table
                                class="
                                    table
                                    table-bordered
                                    table-hover
                                "
                            >


                                <thead
                                    style="
                                        background-color:#e8f1fb;
                                        color:#17365d;
                                    "
                                >

                                    <tr>

                                        <th>
                                            No
                                        </th>

                                        <th>
                                            Nomor Tiket
                                        </th>

                                        <th>
                                            Unit Layanan
                                        </th>

                                        <th>
                                            Jenis Layanan
                                        </th>

                                        <th>
                                            Keterangan
                                        </th>


                                        <th>
                                            Status
                                        </th>

                                        <th>
                                            Tanggal Pengajuan
                                        </th>

                                        <th>
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>



                                <tbody>


                                    <?php foreach (
                                        $tickets
                                        as $index => $ticket
                                    ) : ?>


                                        <tr>


                                            <!-- NO -->

                                            <td>

                                                <?= $index + 1 ?>

                                            </td>



                                            <!-- NOMOR TIKET -->

                                            <td>

                                                <strong>

                                                    <?= esc(
                                                        $ticket[
                                                            'nomor'
                                                        ]
                                                        ?? '-'
                                                    ) ?>

                                                </strong>

                                            </td>



                                            <!-- UNIT LAYANAN -->

                                            <td>

                                                <?= esc(
                                                    $ticket[
                                                        'unit_layanan'
                                                    ]
                                                    ?? '-'
                                                ) ?>

                                            </td>



                                            <!-- JENIS LAYANAN -->

                                            <td>

                                                <?= esc(
                                                    $ticket[
                                                        'layanan'
                                                    ]
                                                    ?? '-'
                                                ) ?>

                                            </td>



                                            <!-- KETERANGAN -->

                                            <td>

                                                <?= esc(
                                                    $ticket[
                                                        'keterangan'
                                                    ]
                                                    ?? '-'
                                                ) ?>

                                            </td>



                                            <!-- STATUS -->

                                            <td>


                                                <?php
                                                $status =
                                                    $ticket[
                                                        'status'
                                                    ]
                                                    ?? 'Submitted';
                                                ?>


                                                <?php if (
                                                    strtolower(
                                                        $status
                                                    )
                                                    === 'submitted'
                                                ) : ?>


                                                    <span
                                                        class="
                                                            badge
                                                            badge-warning
                                                        "
                                                    >

                                                        <i
                                                            class="
                                                                fas
                                                                fa-clock
                                                                mr-1
                                                            "
                                                        ></i>

                                                        Submitted

                                                    </span>


                                                <?php elseif (
                                                    strtolower(
                                                        $status
                                                    )
                                                    === 'diproses'
                                                    ||
                                                    strtolower(
                                                        $status
                                                    )
                                                    === 'processed'
                                                ) : ?>


                                                    <span
                                                        class="
                                                            badge
                                                            badge-info
                                                        "
                                                    >

                                                        <i
                                                            class="
                                                                fas
                                                                fa-spinner
                                                                mr-1
                                                            "
                                                        ></i>

                                                        Diproses

                                                    </span>


                                                <?php elseif (
                                                    strtolower(
                                                        $status
                                                    )
                                                    === 'selesai'
                                                    ||
                                                    strtolower(
                                                        $status
                                                    )
                                                    === 'completed'
                                                ) : ?>


                                                    <span
                                                        class="
                                                            badge
                                                            badge-success
                                                        "
                                                    >

                                                        <i
                                                            class="
                                                                fas
                                                                fa-check-circle
                                                                mr-1
                                                            "
                                                        ></i>

                                                        Selesai

                                                    </span>


                                                <?php elseif (
                                                    strtolower(
                                                        $status
                                                    )
                                                    === 'ditolak'
                                                    ||
                                                    strtolower(
                                                        $status
                                                    )
                                                    === 'rejected'
                                                ) : ?>


                                                    <span
                                                        class="
                                                            badge
                                                            badge-danger
                                                        "
                                                    >

                                                        <i
                                                            class="
                                                                fas
                                                                fa-times-circle
                                                                mr-1
                                                            "
                                                        ></i>

                                                        Ditolak

                                                    </span>


                                                <?php else : ?>


                                                    <span
                                                        class="
                                                            badge
                                                            badge-secondary
                                                        "
                                                    >

                                                        <?= esc(
                                                            $status
                                                        ) ?>

                                                    </span>


                                                <?php endif; ?>


                                            </td>



                                            <!-- TANGGAL -->

                                            <td>

                                                <?= esc(
                                                    $ticket[
                                                        'created_at'
                                                    ]
                                                    ?? '-'
                                                ) ?>

                                            </td>



                                            <!-- AKSI -->

                                            <td>

                                                <a
                                                    href="<?= base_url(
                                                        'mahasiswa/ticket/detail/' .
                                                        (
                                                            $ticket[
                                                                'id'
                                                            ]
                                                            ?? $index
                                                        )
                                                    ) ?>"
                                                    class="
                                                        btn
                                                        btn-sm
                                                        btn-primary
                                                    "
                                                >

                                                    <i
                                                        class="
                                                            fas
                                                            fa-eye
                                                            mr-1
                                                        "
                                                    ></i>

                                                    Detail

                                                </a>

                                            </td>


                                        </tr>


                                    <?php endforeach; ?>


                                </tbody>

                            </table>

                        </div>


                    <?php else : ?>


                        <!-- ==========================================
                             EMPTY STATE
                        =========================================== -->

                        <div
                            class="
                                text-center
                                py-5
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-ticket-alt
                                "
                                style="
                                    font-size:60px;
                                    color:#b0bec5;
                                "
                            ></i>


                            <h5
                                class="mt-3"
                                style="
                                    color:#17365d;
                                "
                            >

                                Belum Ada Tiket

                            </h5>


                            <p class="text-muted">

                                Anda belum memiliki
                                pengajuan layanan.

                            </p>


                            <a
                                href="<?= base_url(
                                    'mahasiswa/ticket/create'
                                ) ?>"
                                class="
                                    btn
                                    text-white
                                "
                                style="
                                    background-color:#f28c28;
                                    border-color:#f28c28;
                                "
                            >

                                <i
                                    class="
                                        fas
                                        fa-plus-circle
                                        mr-1
                                    "
                                ></i>

                                Buat Pengajuan

                            </a>

                        </div>


                    <?php endif; ?>


                </div>

            </div>


        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>