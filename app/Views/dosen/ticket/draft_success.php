<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_dosen') ?>

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
                        <i class="fas fa-save text-success mr-2"></i>
                        Draft Berhasil Disimpan
                    </h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">
                            <a href="<?= base_url('dosen/dashboard') ?>">
                                Dashboard Dosen
                            </a>
                        </li>

                        <li class="breadcrumb-item active">
                            Draft Berhasil Disimpan
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

            <div class="row justify-content-center">

                <div class="col-lg-8 col-md-10">

                    <div
                        class="card shadow-sm border-0"
                        style="border-radius:12px;overflow:hidden;"
                    >

                        <!-- =========================
                             CARD HEADER
                        ========================== -->

                        <div
                            class="card-header text-white text-center"
                            style="
                                background:#0b3d91;
                                border-bottom:4px solid #f28c28;
                                padding:25px;
                            "
                        >

                            <div
                                class="mb-3"
                                style="
                                    font-size:60px;
                                    color:#ffffff;
                                "
                            >

                                <i class="fas fa-save"></i>

                            </div>

                            <h3 class="font-weight-bold mb-2">
                                Draft Berhasil Disimpan!
                            </h3>

                            <p class="mb-0">
                                Pengajuan Anda telah disimpan sebagai
                                draft dan dapat dilanjutkan kembali nanti.
                            </p>

                        </div>


                        <!-- =========================
                             BODY
                        ========================== -->

                        <div class="card-body p-4">

                            <div
                                class="alert"
                                style="
                                    background:#e8f1fb;
                                    border-left:5px solid #0b3d91;
                                    color:#17365d;
                                "
                            >

                                <i class="fas fa-info-circle mr-2"></i>

                                Silakan simpan nomor draft Anda.
                                Draft dapat dilanjutkan melalui menu
                                <strong>Draft Pengajuan</strong>.

                            </div>


                            <!-- =========================
                                 INFORMASI DRAFT
                            ========================== -->

                            <div class="mt-4">

                                <h5
                                    class="font-weight-bold mb-3"
                                    style="color:#0b3d91;"
                                >

                                    <i class="fas fa-file-alt mr-2"></i>

                                    Informasi Draft

                                </h5>


                                <div class="table-responsive">

                                    <table class="table table-bordered">

                                        <tbody>

                                            <tr>

                                                <th
                                                    style="
                                                        width:40%;
                                                        background:#f4f7fb;
                                                        color:#17365d;
                                                    "
                                                >
                                                    Nomor Draft
                                                </th>

                                                <td
                                                    class="font-weight-bold"
                                                    style="color:#0b3d91;"
                                                >

                                                    <?= esc(
                                                        $draft['ticket_number']
                                                        ??
                                                        $draft['nomor_draft']
                                                        ??
                                                        'Draft belum memiliki nomor'
                                                    ) ?>

                                                </td>

                                            </tr>


                                            <tr>

                                                <th
                                                    style="
                                                        background:#f4f7fb;
                                                        color:#17365d;
                                                    "
                                                >
                                                    Unit Layanan
                                                </th>

                                                <td>

                                                    <?= esc(
                                                        $draft['unit_name']
                                                        ??
                                                        $draft['unit']
                                                        ??
                                                        '-'
                                                    ) ?>

                                                </td>

                                            </tr>


                                            <tr>

                                                <th
                                                    style="
                                                        background:#f4f7fb;
                                                        color:#17365d;
                                                    "
                                                >
                                                    Jenis Layanan
                                                </th>

                                                <td>

                                                    <?= esc(
                                                        $draft['service_name']
                                                        ??
                                                        $draft['layanan']
                                                        ??
                                                        '-'
                                                    ) ?>

                                                </td>

                                            </tr>


                                            <tr>

                                                <th
                                                    style="
                                                        background:#f4f7fb;
                                                        color:#17365d;
                                                    "
                                                >
                                                    Status
                                                </th>

                                                <td>

                                                    <span
                                                        class="badge badge-secondary px-3 py-2"
                                                    >
                                                        Draft
                                                    </span>

                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>


                            <!-- =========================
                                 BUTTON
                            ========================== -->

                            <div
                                class="text-center mt-4 pt-3"
                                style="
                                    border-top:1px solid #dee2e6;
                                "
                            >

                                <a
                                    href="<?= base_url('dosen/ticket/draft') ?>"
                                    class="btn btn-primary mr-2"
                                    style="
                                        background:#0b3d91;
                                        border-color:#0b3d91;
                                    "
                                >

                                    <i class="fas fa-file-alt mr-1"></i>

                                    Lihat Draft

                                </a>


                                <a
                                    href="<?= base_url('dosen/ticket/create') ?>"
                                    class="btn btn-warning text-white"
                                    style="
                                        background:#f28c28;
                                        border-color:#f28c28;
                                    "
                                >

                                    <i class="fas fa-plus-circle mr-1"></i>

                                    Ajukan Layanan Baru

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