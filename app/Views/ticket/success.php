<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">

    <div class="col-md-8">

        <div class="card card-success shadow">

            <div class="card-header">

                <h3 class="card-title">
                    <i class="fas fa-ticket-alt"></i>
                    Tiket Layanan ULT POLBAN
                </h3>

            </div>

            <div class="card-body">

                <div class="text-center mb-4">

                    <h2 class="text-success">
                        Pengajuan Berhasil
                    </h2>

                    <p>
                        Simpan nomor tiket berikut untuk memantau proses layanan.
                    </p>

                    <h3 class="text-primary">
                        <?= $ticket['ticket_number'] ?>
                    </h3>

                </div>

                <table class="table table-bordered">

                    <tr>
                        <th width="35%">Nama Pemohon</th>
                        <td><?= esc($ticket['applicant_name']) ?></td>
                    </tr>

                    <tr>
                        <th>Kategori Pemohon</th>
                        <td><?= esc($ticket['applicant_type']) ?></td>
                    </tr>

                    <?php if($ticket['nim'] != ''): ?>

                    <tr>
                        <th>NIM</th>
                        <td><?= esc($ticket['nim']) ?></td>
                    </tr>

                    <?php endif; ?>

                    <tr>
                        <th>Email</th>
                        <td><?= esc($ticket['email']) ?></td>
                    </tr>

                    <tr>
                        <th>No HP</th>
                        <td><?= esc($ticket['phone']) ?></td>
                    </tr>

                    <tr>
                        <th>Layanan</th>
                        <td><?= esc($ticket['service_name']) ?></td>
                    </tr>

                    <tr>
                        <th>Judul</th>
                        <td><?= esc($ticket['ticket_title']) ?></td>
                    </tr>

                    <tr>
                        <th>Deskripsi</th>
                        <td><?= esc($ticket['ticket_description']) ?></td>
                    </tr>

                    <tr>
                        <th>Status</th>

                        <td>

                            <span class="badge badge-warning">
                                Submitted
                            </span>

                        </td>

                    </tr>

                    <tr>
                        <th>Tanggal Pengajuan</th>
                        <td><?= date('d F Y H:i', strtotime($ticket['submitted_at'])) ?></td>
                    </tr>

                </table>

                <hr>

                <h5>
                    Riwayat Tiket
                </h5>

                <ul class="timeline">

                    <li>
                        <i class="fas fa-paper-plane bg-primary"></i>

                        <div class="timeline-item">

                            <span class="time">
                                <?= date('d/m/Y H:i', strtotime($ticket['submitted_at'])) ?>
                            </span>

                            <h3 class="timeline-header">
                                Tiket berhasil dibuat
                            </h3>

                            <div class="timeline-body">
                                Menunggu proses verifikasi oleh Petugas ULT.
                            </div>

                        </div>

                    </li>

                </ul>

            </div>

            <div class="card-footer text-center">

                <button onclick="window.print()" class="btn btn-success">

                    <i class="fas fa-print"></i>

                    Cetak Tiket

                </button>

                <a href="<?= base_url('guest-report') ?>" class="btn btn-primary">

                    <i class="fas fa-plus"></i>

                    Laporan Baru

                </a>

                <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">

                    Dashboard

                </a>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>