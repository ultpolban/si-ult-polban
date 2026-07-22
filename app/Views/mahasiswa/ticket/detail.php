<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>
                <i class="fas fa-file-alt"></i>
                Detail Tiket
            </h1>

        </div>

    </section>


    <section class="content">

        <div class="container-fluid">

            <div class="card shadow">

                <div class="card-header bg-danger text-white">

                    <h3 class="card-title">
                        Detail Pengajuan
                    </h3>

                </div>


                <div class="card-body">

                    <table class="table table-bordered">

                        <tr>

                            <th width="30%">
                                Nomor Tiket
                            </th>

                            <td>
                                <?= $ticket['nomor'] ?>
                            </td>

                        </tr>


                        <tr>

                            <th>
                                Layanan
                            </th>

                            <td>
                                <?= $ticket['layanan'] ?>
                            </td>

                        </tr>


                        <tr>

                            <th>
                                Unit Tujuan
                            </th>

                            <td>
                                <?= $ticket['unit'] ?>
                            </td>

                        </tr>


                        <tr>

                            <th>
                                Tanggal Pengajuan
                            </th>

                            <td>
                                <?= $ticket['tanggal'] ?>
                            </td>

                        </tr>


                        <tr>

                            <th>
                                Status
                            </th>

                            <td>

                                <span class="badge bg-warning">

                                    <?= $ticket['status'] ?>

                                </span>

                            </td>

                        </tr>


                        <tr>

                            <th>
                                Keterangan
                            </th>

                            <td>
                                <?= $ticket['keterangan'] ?>
                            </td>

                        </tr>

                    </table>

                </div>


                <div class="card-footer">

                    <a
                        href="<?= base_url('mahasiswa/ticket/history') ?>"
                        class="btn btn-secondary"
                    >

                        <i class="fas fa-arrow-left"></i>

                        Kembali ke Tracking Tiket

                    </a>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>