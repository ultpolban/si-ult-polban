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


            <!-- ==========================================
                 FLASH MESSAGE SUCCESS
            =========================================== -->

            <?php if (session()->getFlashdata('success')): ?>

                <div class="alert alert-success alert-dismissible fade show">

                    <i class="fas fa-check-circle me-2"></i>

                    <?= esc(
                        session()->getFlashdata('success')
                    ) ?>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            <?php endif; ?>


            <!-- ==========================================
                 FLASH MESSAGE ERROR
            =========================================== -->

            <?php if (session()->getFlashdata('error')): ?>

                <div class="alert alert-danger alert-dismissible fade show">

                    <i class="fas fa-exclamation-circle me-2"></i>

                    <?= esc(
                        session()->getFlashdata('error')
                    ) ?>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                    ></button>

                </div>

            <?php endif; ?>


            <!-- ==========================================
                 CARD DRAFT
            =========================================== -->

            <div class="card shadow-sm">

                <!-- CARD HEADER -->

                <div
                    class="card-header"
                    style="
                        background:#0b3d91;
                        color:white;
                    "
                >

                    <h3 class="card-title">

                        <i class="fas fa-file-alt me-2"></i>

                        Daftar Draft Pengajuan

                    </h3>

                </div>


                <!-- CARD BODY -->

                <div class="card-body">


                    <?php if (!empty($drafts)): ?>


                        <!-- ==========================================
                             TABLE
                        =========================================== -->

                        <div class="table-responsive">

                            <table
                                class="table table-bordered table-hover align-middle"
                            >

                                <thead
                                    style="
                                        background:#0b3d91;
                                        color:white;
                                    "
                                >

                                    <tr>

                                        <th
                                            style="width:70px;"
                                            class="text-center"
                                        >
                                            No
                                        </th>

                                        <th>
                                            Nomor Draft
                                        </th>

                                        <th>
                                            Jenis Layanan
                                        </th>

                                        <th>
                                            Keterangan
                                        </th>

                                        <th>
                                            Tanggal
                                        </th>

                                        <th
                                            class="text-center"
                                        >
                                            Status
                                        </th>

                                        <th
                                            style="width:180px;"
                                            class="text-center"
                                        >
                                            Aksi
                                        </th>

                                    </tr>

                                </thead>


                                <tbody>


                                    <?php foreach (
                                        $drafts
                                        as $index => $draft
                                    ): ?>


                                        <tr>


                                            <!-- NO -->

                                            <td
                                                class="text-center"
                                            >

                                                <?= $index + 1 ?>

                                            </td>


                                            <!-- NOMOR DRAFT -->

                                            <td>

                                                <strong
                                                    style="
                                                        color:#0b3d91;
                                                    "
                                                >

                                                    <?= esc(
                                                        $draft['nomor']
                                                        ?? '-'
                                                    ) ?>

                                                </strong>

                                            </td>


                                            <!-- LAYANAN -->

                                            <td>

                                                <?= esc(
                                                    $draft['layanan']
                                                    ?? 'Belum dipilih'
                                                ) ?>

                                            </td>


                                            <!-- KETERANGAN -->

                                            <td>

                                                <?php

                                                $keterangan =
                                                    $draft['keterangan']
                                                    ?? '-';

                                                ?>

                                                <?= esc(
                                                    strlen($keterangan) > 60
                                                        ? substr(
                                                            $keterangan,
                                                            0,
                                                            60
                                                        ) . '...'
                                                        : $keterangan
                                                ) ?>

                                            </td>


                                            <!-- TANGGAL -->

                                            <td>

                                                <?= esc(
                                                    $draft['tanggal']
                                                    ?? '-'
                                                ) ?>

                                            </td>


                                            <!-- STATUS -->

                                            <td
                                                class="text-center"
                                            >

                                                <span
                                                    class="badge bg-secondary"
                                                >

                                                    <i
                                                        class="fas fa-file-alt me-1"
                                                    ></i>

                                                    <?= esc(
                                                        $draft['status']
                                                        ?? 'Draft'
                                                    ) ?>

                                                </span>

                                            </td>


                                            <!-- AKSI -->

                                            <td
                                                class="text-center"
                                            >

                                                <a
                                                    href="<?= base_url(
                                                        'mahasiswa/ticket/draft/edit/' .
                                                        $index
                                                    ) ?>"
                                                    class="btn btn-sm"
                                                    style="
                                                        background:#f28c28;
                                                        color:white;
                                                        font-weight:600;
                                                    "
                                                >

                                                    <i
                                                        class="fas fa-edit me-1"
                                                    ></i>

                                                    Lanjutkan

                                                </a>

                                            </td>


                                        </tr>


                                    <?php endforeach; ?>


                                </tbody>

                            </table>

                        </div>


                    <?php else: ?>


                        <!-- ==========================================
                             EMPTY STATE
                        =========================================== -->

                        <div
                            class="text-center py-5"
                        >

                            <div
                                style="
                                    width:90px;
                                    height:90px;
                                    background:#eef5ff;
                                    border-radius:50%;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    margin:0 auto 20px;
                                "
                            >

                                <i
                                    class="fas fa-file-alt"
                                    style="
                                        font-size:40px;
                                        color:#0b3d91;
                                    "
                                ></i>

                            </div>


                            <h4
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                "
                            >

                                Belum Ada Draft Pengajuan

                            </h4>


                            <p
                                class="text-muted"
                            >

                                Anda belum memiliki draft pengajuan layanan.

                                <br>

                                Silakan buat pengajuan layanan baru.

                            </p>


                            <a
                                href="<?= base_url(
                                    'mahasiswa/ticket/create'
                                ) ?>"
                                class="btn"
                                style="
                                    background:#f28c28;
                                    color:white;
                                    font-weight:600;
                                "
                            >

                                <i
                                    class="fas fa-plus-circle me-1"
                                ></i>

                                Ajukan Layanan

                            </a>

                        </div>


                    <?php endif; ?>


                </div>

            </div>


            <!-- ==========================================
                 BUTTON KEMBALI
            =========================================== -->

            <div class="mt-3">

                <a
                    href="<?= base_url(
                        'mahasiswa/dashboard'
                    ) ?>"
                    class="btn btn-secondary"
                >

                    <i
                        class="fas fa-arrow-left me-1"
                    ></i>

                    Kembali ke Dashboard

                </a>

            </div>


        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>