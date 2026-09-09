<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_tendik') ?>

<div class="content-wrapper">

    <!-- =========================
         HEADER
    ========================== -->

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

                            <a href="<?= base_url('dashboard-tendik') ?>">

                                Dashboard Tendik

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


    <!-- =========================
         CONTENT
    ========================== -->

    <section class="content">

        <div class="container-fluid">


            <!-- =========================
                 SUCCESS
            ========================== -->

            <?php if (session()->getFlashdata('success')) : ?>

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


            <!-- =========================
                 ERROR
            ========================== -->

            <?php if (session()->getFlashdata('error')) : ?>

                <div
                    class="alert alert-danger alert-dismissible fade show"
                >

                    <i class="fas fa-exclamation-circle mr-2"></i>

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


            <!-- =========================
                 CARD
            ========================== -->

            <div class="card shadow-sm border-0">


                <!-- CARD HEADER -->

                <div
                    class="card-header text-white"
                    style="
                        background:#0b3d91;
                        border-bottom:4px solid #f28c28;
                    "
                >

                    <h5 class="mb-0">

                        <i class="fas fa-save mr-2"></i>

                        Daftar Draft Pengajuan

                    </h5>

                </div>


                <!-- CARD BODY -->

                <div class="card-body">


                    <?php if (!empty($drafts)) : ?>


                        <div class="table-responsive">

                            <table
                                class="table table-bordered table-hover"
                            >

                                <thead
                                    style="
                                        background:#e8f1fb;
                                        color:#17365d;
                                    "
                                >

                                    <tr>

                                        <th style="width:5%;">
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

                                        <th style="width:18%;">
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
                                                    $draft['unit_name']
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <!-- JENIS LAYANAN -->

                                            <td>

                                                <?= esc(
                                                    $draft['service_name']
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <!-- KETERANGAN -->

                                            <td>

                                                <?php
                                                $description =
                                                    trim(
                                                        (string) (
                                                            $draft['description']
                                                            ?? ''
                                                        )
                                                    );
                                                ?>

                                                <?php if ($description !== '') : ?>

                                                    <?= esc(
                                                        $description
                                                    ) ?>

                                                <?php else : ?>

                                                    <span class="text-muted">
                                                        -
                                                    </span>

                                                <?php endif; ?>

                                            </td>


                                            <!-- DOKUMEN -->

                                            <td>

                                                <?php if (
                                                    isset(
                                                        $draft['document_complete']
                                                    )
                                                    &&
                                                    $draft['document_complete']
                                                ) : ?>

                                                    <span
                                                        class="badge badge-success px-2 py-1"
                                                    >

                                                        <i
                                                            class="fas fa-check mr-1"
                                                        ></i>

                                                        Lengkap

                                                    </span>

                                                <?php else : ?>

                                                    <span
                                                        class="badge badge-warning px-2 py-1"
                                                    >

                                                        <i
                                                            class="fas fa-exclamation-circle mr-1"
                                                        ></i>

                                                        Belum Lengkap

                                                    </span>

                                                <?php endif; ?>

                                            </td>


                                            <!-- STATUS -->

                                            <td>

                                                <span
                                                    class="badge badge-secondary px-3 py-2"
                                                >

                                                    Draft

                                                </span>

                                            </td>


                                            <!-- TANGGAL -->

                                            <td>

                                                <?php
                                                $createdAt =
                                                    $draft['created_at']
                                                    ?? null;
                                                ?>

                                                <?= $createdAt
                                                    ? date(
                                                        'd-m-Y H:i',
                                                        strtotime($createdAt)
                                                    )
                                                    : '-'
                                                ?>

                                            </td>


                                            <!-- AKSI -->

                                            <td>

                                                <a
                                                    href="<?= base_url(
                                                        'tendik/ticket/draft/edit/' .
                                                        $draft['id']
                                                    ) ?>"
                                                    class="btn btn-sm text-white mb-1"
                                                    style="
                                                        background:#f28c28;
                                                        border-color:#f28c28;
                                                    "
                                                >

                                                    <i
                                                        class="fas fa-edit mr-1"
                                                    ></i>

                                                    Lanjutkan

                                                </a>


                                                <a
                                                    href="<?= base_url(
                                                        'tendik/ticket/draft/delete/' .
                                                        $draft['id']
                                                    ) ?>"
                                                    class="btn btn-sm btn-danger mb-1"
                                                    onclick="
                                                        return confirm(
                                                            'Apakah Anda yakin ingin menghapus draft ini?'
                                                        );
                                                    "
                                                >

                                                    <i
                                                        class="fas fa-trash mr-1"
                                                    ></i>

                                                    Hapus

                                                </a>

                                            </td>


                                        </tr>


                                    <?php endforeach; ?>


                                </tbody>

                            </table>

                        </div>


                    <?php else : ?>


                        <!-- =========================
                             EMPTY STATE
                        ========================== -->

                        <div class="text-center py-5">

                            <i
                                class="fas fa-file-alt"
                                style="
                                    font-size:60px;
                                    color:#b0bec5;
                                "
                            ></i>


                            <h5
                                class="mt-3"
                                style="color:#17365d;"
                            >

                                Belum Ada Draft

                            </h5>


                            <p class="text-muted">

                                Anda belum memiliki
                                draft pengajuan layanan.

                            </p>


                            <a
                                href="<?= base_url(
                                    'tendik/ticket/create'
                                ) ?>"
                                class="btn text-white"
                                style="
                                    background:#f28c28;
                                    border-color:#f28c28;
                                "
                            >

                                <i
                                    class="fas fa-plus-circle mr-1"
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