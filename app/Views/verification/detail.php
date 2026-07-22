<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title">
            Detail Verifikasi Tiket
        </h3>
    </div>

    <div class="card-body">

        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered">

            <tr>
                <th width="220">Nomor Tiket</th>
                <td><?= esc($ticket['ticket_number']) ?></td>
            </tr>

            <tr>
                <th>Nama Pemohon</th>
                <td><?= esc($ticket['applicant_name']) ?></td>
            </tr>

            <tr>
                <th>Jenis Pemohon</th>
                <td><?= esc($ticket['applicant_type'] ?? '-') ?></td>
            </tr>

            <tr>
                <th>NIM</th>
                <td><?= !empty($ticket['nim']) ? esc($ticket['nim']) : '-' ?></td>
            </tr>

            <tr>
                <th>Email</th>
                <td><?= esc($ticket['email']) ?></td>
            </tr>

            <tr>
                <th>No HP</th>
                <td><?= esc($ticket['phone']) ?></td>
            </tr>

            <tr>
                <th>Jenis Layanan</th>
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
                    <span class="badge bg-info">
                        <?= esc($ticket['status']) ?>
                    </span>
                </td>
            </tr>

            <tr>
                <th>Unit Tujuan</th>
                <td><?= !empty($ticket['assigned_unit']) ? esc($ticket['assigned_unit']) : '-' ?></td>
            </tr>

            <tr>
                <th>Petugas Verifikasi</th>
                <td><?= !empty($ticket['verified_by']) ? esc($ticket['verified_by']) : '-' ?></td>
            </tr>

            <tr>
                <th>Catatan Verifikasi</th>
                <td><?= !empty($ticket['verification_note']) ? nl2br(esc($ticket['verification_note'])) : '-' ?></td>
            </tr>

            <tr>
                <th>Tanggal Verifikasi</th>
                <td>
                    <?= !empty($ticket['verified_at']) ? date('d-m-Y H:i', strtotime($ticket['verified_at'])) : '-' ?>
                </td>
            </tr>

            <tr>
                <th>Lampiran</th>
                <td>

                    <?php if(!empty($ticket['attachment'])): ?>

                        <a href="<?= base_url('uploads/'.$ticket['attachment']) ?>"
                           target="_blank"
                           class="btn btn-info btn-sm">

                            <i class="fas fa-paperclip"></i>
                            Lihat Lampiran

                        </a>

                    <?php else: ?>

                        <span class="text-muted">
                            Tidak ada lampiran
                        </span>

                    <?php endif; ?>

                </td>
            </tr>

        </table>

        <hr>

        <h5>Form Verifikasi</h5>

        <form action="<?= base_url('verification/process/'.$ticket['id']) ?>" method="post">

            <?= csrf_field() ?>

            <div class="form-group">

                <label>Keputusan Verifikasi</label>

                <select name="status" class="form-control" required>

                    <option value="">-- Pilih Keputusan --</option>
                    <option value="Verified">Verified</option>
                    <option value="Need Revision">Need Revision</option>
                    <option value="Rejected">Rejected</option>

                </select>

            </div>

            <div class="form-group">

                <label>Unit Tujuan</label>

                <select name="assigned_unit" class="form-control">

                    <option value="">-- Pilih Unit --</option>
                    <option value="BAAK">BAAK</option>
                    <option value="Keuangan">Keuangan</option>
                    <option value="Jurusan">Jurusan</option>
                    <option value="Kemahasiswaan">Kemahasiswaan</option>
                    <option value="UPT TIK">UPT TIK</option>

                </select>

            </div>

            <div class="form-group">

                <label>Catatan Petugas</label>

                <textarea
                    name="verification_note"
                    rows="4"
                    class="form-control"
                    required></textarea>

            </div>

            <button class="btn btn-success">
                <i class="fas fa-save"></i>
                Simpan Verifikasi
            </button>

            <a href="<?= base_url('verification') ?>" class="btn btn-secondary">
                Kembali
            </a>

        </form>

        <hr>

        <h4>
            <i class="fas fa-history"></i>
            Tracking / Riwayat Tiket
        </h4>

        <?php if(empty($logs)): ?>

            <div class="alert alert-secondary">
                Belum ada riwayat aktivitas.
            </div>

        <?php else: ?>

            <table class="table table-bordered table-striped">

                <thead class="thead-dark">

                    <tr>
                        <th width="180">Tanggal</th>
                        <th>Aktivitas</th>
                        <th width="180">Petugas</th>
                    </tr>

                </thead>

                <tbody>

                <?php foreach($logs as $log): ?>

                    <tr>

                        <td>
                            <?= date('d-m-Y H:i', strtotime($log['created_at'])) ?>
                        </td>

                        <td>
                            <?= esc($log['activity']) ?>
                        </td>

                        <td>
                            <?= esc($log['user_name']) ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        <?php endif; ?>

        <hr>

        <h4>
            <i class="fas fa-comments"></i>
            Riwayat Komentar
        </h4>

        <?php if(empty($comments)): ?>

            <div class="alert alert-secondary">
                Belum ada komentar.
            </div>

        <?php else: ?>

            <?php foreach($comments as $c): ?>

                <div class="card mb-2">

                    <div class="card-body">

                        <strong>
                            <?= esc($c['sender']) ?>
                        </strong>

                        <small class="float-right text-muted">
                            <?= date('d-m-Y H:i', strtotime($c['created_at'])) ?>
                        </small>

                        <hr>

                        <?= nl2br(esc($c['comment'])) ?>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php endif; ?>

        <form action="<?= base_url('verification/comment/'.$ticket['id']) ?>" method="post">

            <?= csrf_field() ?>

            <div class="form-group">

                <label>Tambah Komentar</label>

                <textarea
                    name="comment"
                    rows="4"
                    class="form-control"
                    placeholder="Masukkan komentar..."
                    required></textarea>

            </div>

            <button class="btn btn-primary">

                <i class="fas fa-comment"></i>
                Kirim Komentar

            </button>

        </form>

    </div>

</div>

<?= $this->endSection() ?>