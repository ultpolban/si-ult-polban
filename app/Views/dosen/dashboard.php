<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_dosen') ?>


<div class="content-wrapper">

    <!-- HEADER -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 style="color:#0b3d91;font-weight:700;">

                        <i class="fas fa-chalkboard-teacher"></i>

                        Dashboard Dosen

                    </h1>

                </div>


                <div class="col-sm-6 text-end">

                    <a
                        href="<?= base_url('dosen/ticket/create') ?>"
                        class="btn"
                        style="
                            background:#f28c28;
                            color:white;
                            font-weight:600;
                        "
                    >

                        <i class="fas fa-plus-circle"></i>

                        Ajukan Layanan

                    </a>

                </div>

            </div>

        </div>

    </section>


    <!-- MAIN CONTENT -->

    <section class="content">

        <div class="container-fluid">


            <!-- WELCOME -->

            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <h3 style="color:#0b3d91;font-weight:700;">

                        Selamat Datang,
                        <?= esc($user['nama'] ?? 'Dosen') ?>

                    </h3>


                    <p class="text-muted mb-0">

                        <strong>NIP/NIDN:</strong>

                        <?= esc($user['nip'] ?? '-') ?>

                        <br>

                        <strong>Program Studi:</strong>

                        <?= esc($user['prodi'] ?? '-') ?>

                        <br>

                        <strong>Fakultas:</strong>

                        <?= esc($user['fakultas'] ?? '-') ?>

                        <br>

                        <strong>Jabatan:</strong>

                        <?= esc($user['jabatan'] ?? '-') ?>

                    </p>

                </div>

            </div>


            <!-- STATISTIK -->

            <div class="row">


                <!-- TOTAL -->

                <div class="col-lg-3 col-6">

                    <div
                        class="small-box"
                        style="
                            background:#0b3d91;
                            color:white;
                            border-radius:15px;
                        "
                    >

                        <div class="inner">

                            <h3>

                                <?= $statistik['total'] ?? 0 ?>

                            </h3>

                            <p>

                                Jumlah Pengajuan

                            </p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-ticket-alt"></i>

                        </div>

                    </div>

                </div>


                <!-- DIPROSES -->

                <div class="col-lg-3 col-6">

                    <div
                        class="small-box"
                        style="
                            background:#f28c28;
                            color:white;
                            border-radius:15px;
                        "
                    >

                        <div class="inner">

                            <h3>

                                <?= $statistik['diproses'] ?? 0 ?>

                            </h3>

                            <p>

                                Sedang Diproses

                            </p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-spinner"></i>

                        </div>

                    </div>

                </div>


                <!-- REVISI -->

                <div class="col-lg-3 col-6">

                    <div
                        class="small-box"
                        style="
                            background:#dc3545;
                            color:white;
                            border-radius:15px;
                        "
                    >

                        <div class="inner">

                            <h3>

                                <?= $statistik['revisi'] ?? 0 ?>

                            </h3>

                            <p>

                                Perlu Revisi

                            </p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-exclamation-circle"></i>

                        </div>

                    </div>

                </div>


                <!-- SELESAI -->

                <div class="col-lg-3 col-6">

                    <div
                        class="small-box"
                        style="
                            background:#198754;
                            color:white;
                            border-radius:15px;
                        "
                    >

                        <div class="inner">

                            <h3>

                                <?= $statistik['selesai'] ?? 0 ?>

                            </h3>

                            <p>

                                Selesai

                            </p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-check-circle"></i>

                        </div>

                    </div>

                </div>

            </div>


            <!-- QUICK MENU -->

            <div class="row mt-3">


                <div class="col-md-4 mb-3">

                    <a
                        href="<?= base_url('dosen/ticket/create') ?>"
                        class="btn btn-block"
                        style="
                            background:#f28c28;
                            color:white;
                            font-weight:600;
                            padding:12px;
                        "
                    >

                        <i class="fas fa-plus-circle"></i>

                        Ajukan Layanan Baru

                    </a>

                </div>


                <div class="col-md-4 mb-3">

                    <a
                        href="<?= base_url('dosen/ticket/history') ?>"
                        class="btn btn-block"
                        style="
                            background:#0b3d91;
                            color:white;
                            font-weight:600;
                            padding:12px;
                        "
                    >

                        <i class="fas fa-history"></i>

                        Tracking Tiket

                    </a>

                </div>


                <div class="col-md-4 mb-3">

                    <a
                        href="<?= base_url('dosen/notification') ?>"
                        class="btn btn-block"
                        style="
                            background:#198754;
                            color:white;
                            font-weight:600;
                            padding:12px;
                        "
                    >

                        <i class="fas fa-bell"></i>

                        Notifikasi

                    </a>

                </div>

            </div>


            <!-- RIWAYAT -->

            <div class="card shadow-sm mt-4">

                <div class="card-header">

                    <h3
                        class="card-title"
                        style="
                            color:#0b3d91;
                            font-weight:700;
                        "
                    >

                        <i class="fas fa-history"></i>

                        Riwayat Pengajuan Terbaru

                    </h3>

                </div>


                <div class="card-body table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead style="background:#0b3d91;color:white;">

                            <tr>

                                <th>No</th>

                                <th>Nomor Tiket</th>

                                <th>Layanan</th>

                                <th>Tanggal</th>

                                <th>Status</th>

                                <th>Aksi</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php if (!empty($tickets)): ?>

                                <?php $no = 1; ?>

                                <?php foreach ($tickets as $ticket): ?>

                                    <tr>

                                        <td>

                                            <?= $no++ ?>

                                        </td>

                                        <td>

                                            <?= esc($ticket['nomor'] ?? '-') ?>

                                        </td>

                                        <td>

                                            <?= esc($ticket['layanan'] ?? '-') ?>

                                        </td>

                                        <td>

                                            <?= esc($ticket['tanggal'] ?? '-') ?>

                                        </td>

                                        <td>

                                            <span class="badge bg-primary">

                                                <?= esc($ticket['status'] ?? '-') ?>

                                            </span>

                                        </td>

                                        <td>

                                            <a
                                                href="<?= base_url('dosen/ticket/detail/' . ($ticket['id'] ?? 0)) ?>"
                                                class="btn btn-sm btn-info"
                                            >

                                                <i class="fas fa-eye"></i>

                                                Detail

                                            </a>

                                        </td>

                                    </tr>

                                <?php endforeach; ?>

                            <?php else: ?>

                                <tr>

                                    <td
                                        colspan="6"
                                        class="text-center text-muted py-4"
                                    >

                                        <i class="fas fa-inbox fa-2x mb-2"></i>

                                        <br>

                                        Belum ada pengajuan layanan.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>


        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>