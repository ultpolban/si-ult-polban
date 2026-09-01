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

                    <h1 class="font-weight-bold" style="color: #0d47a1;">
                        <i class="fas fa-check-circle text-success mr-2"></i>
                        Pengajuan Berhasil
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
                            Pengajuan Berhasil
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

                    <div class="card shadow-sm border-0">

                        <!-- HEADER CARD -->

                        <div
                            class="card-header text-white text-center"
                            style="
                                background-color: #0d47a1;
                                border-bottom: 4px solid #f7941d;
                                padding: 25px;
                            ">

                            <div
                                class="mb-3"
                                style="
                                    font-size: 60px;
                                    color: #ffffff;
                                ">

                                <i class="fas fa-check-circle"></i>

                            </div>

                            <h3 class="font-weight-bold mb-2">
                                Pengajuan Berhasil Dikirim!
                            </h3>

                            <p class="mb-0">
                                Pengajuan layanan Anda telah berhasil dikirim
                                dan sedang menunggu proses dari petugas.
                            </p>

                        </div>


                        <!-- BODY -->

                        <div class="card-body p-4">

                            <div
                                class="alert"
                                style="
                                    background-color: #e8f1fb;
                                    border-left: 5px solid #0d47a1;
                                    color: #17365d;
                                ">

                                <i class="fas fa-info-circle mr-2"></i>

                                Silakan simpan nomor tiket Anda untuk
                                memantau perkembangan pengajuan melalui
                                menu <strong>Tracking Tiket</strong>.

                            </div>


                            <!-- INFORMASI TIKET -->

                            <div class="mt-4">

                                <h5
                                    class="font-weight-bold mb-3"
                                    style="color: #0d47a1;">

                                    <i class="fas fa-ticket-alt mr-2"></i>

                                    Informasi Pengajuan

                                </h5>


                                <div class="table-responsive">

                                    <table class="table table-bordered">

                                        <tbody>

                                            <tr>

                                                <th
                                                    style="
                                                        width: 40%;
                                                        background-color: #f4f7fb;
                                                        color: #17365d;
                                                    ">
                                                    Nomor Tiket
                                                </th>

                                                <td class="font-weight-bold text-primary">

                                                    <?= esc($ticket['nomor'] ?? 'Akan dibuat oleh sistem') ?>

                                                </td>

                                            </tr>


                                            <tr>

                                                <th
                                                    style="
                                                        background-color: #f4f7fb;
                                                        color: #17365d;
                                                    ">
                                                    Unit Tujuan
                                                </th>

                                                <td>

                                                    <?= esc($ticket['unit'] ?? '-') ?>

                                                </td>

                                            </tr>


                                            <tr>

                                                <th
                                                    style="
                                                        background-color: #f4f7fb;
                                                        color: #17365d;
                                                    ">
                                                    Jenis Layanan
                                                </th>

                                                <td>

                                                    <?= esc($ticket['layanan'] ?? '-') ?>

                                                </td>

                                            </tr>


                                            <tr>

                                                <th
                                                    style="
                                                        background-color: #f4f7fb;
                                                        color: #17365d;
                                                    ">
                                                    Status
                                                </th>

                                                <td>

                                                    <span class="badge badge-primary px-3 py-2">

                                                        <?= esc($ticket['status'] ?? 'Submitted') ?>

                                                    </span>

                                                </td>

                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>


                            <!-- BUTTON -->

                            <div
                                class="text-center mt-4 pt-3"
                                style="border-top: 1px solid #dee2e6;">

                                <a
                                    href="<?= base_url('dosen/ticket/history') ?>"
                                    class="btn btn-primary mr-2"
                                    style="
                                        background-color: #0d47a1;
                                        border-color: #0d47a1;
                                    ">

                                    <i class="fas fa-ticket-alt mr-1"></i>

                                    Lihat Tracking Tiket

                                </a>


                                <a
                                    href="<?= base_url('dosen/ticket/create') ?>"
                                    class="btn btn-warning text-white"
                                    style="
                                        background-color: #f7941d;
                                        border-color: #f7941d;
                                    ">

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