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
                                    'dashboard-mahasiswa'
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


                                    <?php foreach ($drafts as $index => $draft): ?>

<tr>

    <!-- NO -->
    <td>
        <?= $index + 1 ?>
    </td>

    <!-- UNIT LAYANAN -->
    <td>
        <?= esc($draft['unit_name'] ?? '-') ?>
    </td>

    <!-- JENIS LAYANAN -->
    <td>
        <?= esc($draft['service_name'] ?? '-') ?>
    </td>

    <!-- KETERANGAN -->
    <td>
        <?= esc($draft['description'] ?? '-') ?>
    </td>

    <!-- DOKUMEN -->
    <td>
        Tidak ada
    </td>

    <!-- STATUS -->
    <td>
        <span class="badge bg-secondary">
            <i class="fas fa-file-alt"></i>
            Draft
        </span>
    </td>

    <!-- TANGGAL -->
    <td>
        <?= !empty($draft['created_at'])
            ? date('Y-m-d H:i:s', strtotime($draft['created_at']))
            : '-' ?>
    </td>

    <!-- AKSI -->
    <td>

        <a
            href="<?= base_url('mahasiswa/ticket/edit-draft/' . $draft['id']) ?>"
            class="btn btn-warning btn-sm"
        >
            <i class="fas fa-edit"></i>
            Lanjutkan
        </a>

        <a
            href="<?= base_url('mahasiswa/ticket/delete-draft/' . $draft['id']) ?>"
            class="btn btn-danger btn-sm"
            onclick="return confirm('Yakin ingin menghapus draft ini?')"
        >
            <i class="fas fa-trash"></i>
            Hapus
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
                                    'mahasiswa/ticket/create'
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