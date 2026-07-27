<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">

    <!-- HEADER -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1
                        class="font-weight-bold"
                        style="color: #0d47a1;"
                    >

                        <i class="fas fa-file-alt mr-2"></i>

                        Draft Pengajuan

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url('dosen/dashboard') ?>"
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


    <!-- CONTENT -->

    <section class="content">

        <div class="container-fluid">


            <!-- SUCCESS MESSAGE -->

            <?php if (session()->getFlashdata('success')) : ?>

                <div
                    class="alert alert-success alert-dismissible fade show"
                >

                    <i class="fas fa-check-circle mr-2"></i>

                    <?= session()->getFlashdata('success') ?>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                    >

                        &times;

                    </button>

                </div>

            <?php endif; ?>


            <!-- CARD -->

            <div class="card shadow-sm border-0">


                <div
                    class="card-header text-white"
                    style="
                        background-color: #0d47a1;
                        border-bottom: 4px solid #f7941d;
                    "
                >

                    <h5 class="mb-0">

                        <i class="fas fa-save mr-2"></i>

                        Daftar Draft Pengajuan

                    </h5>

                </div>


                <div class="card-body">


                    <?php if (!empty($drafts)) : ?>


                        <div class="table-responsive">

                            <table class="table table-bordered table-hover">


                                <thead
                                    style="
                                        background-color: #e8f1fb;
                                        color: #17365d;
                                    "
                                >

                                    <tr>

                                        <th>
                                            No
                                        </th>

                                        <th>
                                            Unit Tujuan
                                        </th>

                                        <th>
                                            Jenis Layanan
                                        </th>

                                        <th>
                                            Judul
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

                                            <td>

                                                <?= $index + 1 ?>

                                            </td>


                                            <td>

                                                <?= esc(
                                                    $draft['unit_tujuan']
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <td>

                                                <?= esc(
                                                    $draft['jenis_layanan']
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <td>

                                                <?= esc(
                                                    $draft['judul']
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <td>

                                                <span
                                                    class="badge badge-secondary"
                                                >

                                                    Draft

                                                </span>

                                            </td>


                                            <td>

                                                <?= esc(
                                                    $draft['created_at']
                                                    ?? '-'
                                                ) ?>

                                            </td>

                                            <td>

    <a
        href="<?= base_url(
            'dosen/ticket/draft/edit/' . $index
        ) ?>"
        class="btn btn-sm text-white"
        style="
            background-color: #f7941d;
            border-color: #f7941d;
        "
    >

        <i class="fas fa-edit mr-1"></i>

        Lanjutkan

    </a>

</td>

                                        </tr>


                                    <?php endforeach; ?>

                                </tbody>

                            </table>

                        </div>


                    <?php else : ?>


                        <div
                            class="text-center py-5"
                        >

                            <i
                                class="fas fa-file-alt"
                                style="
                                    font-size: 60px;
                                    color: #b0bec5;
                                "
                            ></i>


                            <h5
                                class="mt-3"
                                style="color: #17365d;"
                            >

                                Belum Ada Draft

                            </h5>


                            <p class="text-muted">

                                Anda belum memiliki
                                draft pengajuan layanan.

                            </p>


                            <a
                                href="<?= base_url(
                                    'dosen/ticket/create'
                                ) ?>"
                                class="btn text-white"
                                style="
                                    background-color: #f7941d;
                                    border-color: #f7941d;
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

<?= $this->endSection() ?>