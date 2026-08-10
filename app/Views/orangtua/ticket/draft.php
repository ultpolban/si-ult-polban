<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_orangtua') ?>


<div class="content-wrapper">

    <!-- ==========================================
         HEADER
    =========================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1
                        class="font-weight-bold"
                        style="color:#0b3d91;"
                    >

                        <i class="fas fa-file-alt mr-2"></i>

                        Draft Pengajuan

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url(
                                    'dashboard-orangtua'
                                ) ?>"
                            >

                                Dashboard

                            </a>

                        </li>


                        <li class="breadcrumb-item active">

                            Draft Pengajuan

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
                    class="alert alert-success alert-dismissible fade show"
                >

                    <i class="fas fa-check-circle mr-2"></i>

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
                    class="alert alert-danger alert-dismissible fade show"
                >

                    <i
                        class="fas fa-exclamation-circle mr-2"
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
                class="card shadow-sm border-0"
            >


                <!-- CARD HEADER -->

                <div
                    class="card-header text-white"
                    style="
                        background-color:#0b3d91;
                        border-bottom:4px solid #f28c28;
                    "
                >

                    <h5 class="mb-0">

                        <i
                            class="fas fa-save mr-2"
                        ></i>

                        Daftar Draft Pengajuan

                    </h5>

                </div>



                <!-- CARD BODY -->

                <div class="card-body">


                    <?php if (
                        !empty($drafts)
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
                                            Unit Layanan
                                        </th>

                                        <th>
                                            Jenis Layanan
                                        </th>

                                        <th>
                                            Keterangan
                                        </th>

                                        <th>
                                            Dokumen
                                        </th>

                                        <th>
                                            Status
                                        </th>

                                        <th>
                                            Tanggal
                                        </th>

                                        <th>
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>



                                <tbody>


                                    <?php foreach (
                                        $drafts
                                        as $index => $draft
                                    ) : ?>


                                        <tr>


                                            <!-- NO -->

                                            <td>

                                                <?= $index + 1 ?>

                                            </td>



                                            <!-- UNIT LAYANAN -->

                                            <td>

                                                <?= esc(
                                                    $draft[
                                                        'unit_layanan'
                                                    ]
                                                    ?? '-'
                                                ) ?>

                                            </td>



                                            <!-- JENIS LAYANAN -->

                                            <td>

                                                <?= esc(
                                                    $draft[
                                                        'layanan'
                                                    ]
                                                    ?? '-'
                                                ) ?>

                                            </td>



                                            <!-- KETERANGAN -->

                                            <td>

                                                <?= esc(
                                                    $draft[
                                                        'keterangan'
                                                    ]
                                                    ?? '-'
                                                ) ?>

                                            </td>



                                            <!-- DOKUMEN -->

                                            <td>

                                                <?php if (
                                                    !empty(
                                                        $draft[
                                                            'dokumen'
                                                        ]
                                                    )
                                                ) : ?>


                                                    <a
                                                        href="<?= base_url(
                                                            'uploads/dokumen/' .
                                                            $draft[
                                                                'dokumen'
                                                            ]
                                                        ) ?>"
                                                        target="_blank"
                                                        class="
                                                            btn
                                                            btn-sm
                                                            btn-primary
                                                        "
                                                    >

                                                        <i
                                                            class="
                                                                fas
                                                                fa-file-alt
                                                            "
                                                        ></i>

                                                        Lihat

                                                    </a>


                                                <?php else : ?>


                                                    <span
                                                        class="
                                                            text-muted
                                                        "
                                                    >

                                                        Tidak ada

                                                    </span>


                                                <?php endif; ?>

                                            </td>



                                            <!-- STATUS -->

                                            <td>

                                                <span
                                                    class="
                                                        badge
                                                        badge-secondary
                                                    "
                                                >

                                                    <i
                                                        class="
                                                            fas
                                                            fa-file-alt
                                                            mr-1
                                                        "
                                                    ></i>

                                                    Draft

                                                </span>

                                            </td>



                                            <!-- TANGGAL -->

                                            <td>

                                                <?= esc(
                                                    $draft[
                                                        'created_at'
                                                    ]
                                                    ?? '-'
                                                ) ?>

                                            </td>



                                            <!-- AKSI -->

                                            <td>

                                                <div
                                                    class="
                                                        d-flex
                                                        flex-wrap
                                                    "
                                                >


                                                    <!-- LANJUTKAN -->

                                                    <a
                                                        href="<?= base_url(
                                                            'orangtua/ticket/draft/edit/' .
                                                            $index
                                                        ) ?>"
                                                        class="
                                                            btn
                                                            btn-sm
                                                            mr-1
                                                            mb-1
                                                        "
                                                        style="
                                                            background-color:#f28c28;
                                                            border-color:#f28c28;
                                                            color:white;
                                                        "
                                                    >

                                                        <i
                                                            class="
                                                                fas
                                                                fa-edit
                                                                mr-1
                                                            "
                                                        ></i>

                                                        Lanjutkan

                                                    </a>



                                                    <!-- HAPUS -->

                                                    <form
                                                        action="<?= base_url(
                                                            'orangtua/ticket/draft/delete/' .
                                                            $index
                                                        ) ?>"
                                                        method="post"
                                                        class="d-inline"
                                                        onsubmit="
                                                            return confirm(
                                                                'Apakah Anda yakin ingin menghapus draft ini?'
                                                            );
                                                        "
                                                    >

                                                        <?= csrf_field() ?>


                                                        <button
                                                            type="submit"
                                                            class="
                                                                btn
                                                                btn-sm
                                                                btn-danger
                                                                mb-1
                                                            "
                                                        >

                                                            <i
                                                                class="
                                                                    fas
                                                                    fa-trash
                                                                    mr-1
                                                                "
                                                            ></i>

                                                            Hapus

                                                        </button>

                                                    </form>


                                                </div>

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
                                    fa-file-alt
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

                                Belum Ada Draft

                            </h5>


                            <p class="text-muted">

                                Anda belum memiliki
                                draft pengajuan layanan.

                            </p>


                            <a
                                href="<?= base_url(
                                    'orangtua/ticket/create'
                                ) ?>"
                                class="btn text-white"
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