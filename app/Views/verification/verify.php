<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<section class="content-header">

    <div class="container-fluid">

        <div class="row mb-2">

            <div class="col-sm-6">

                <h1>

                    <i class="fas fa-user-check text-primary"></i>

                    Verifikasi Tiket

                </h1>

                <p class="text-muted">

                    Lakukan pemeriksaan kelengkapan dokumen sebelum tiket diproses ke tahap disposisi.

                </p>

            </div>


        </div>

    </div>

</section>

<section class="content">

<div class="container-fluid">

<div class="row">

    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-info">

            <div class="inner">

                <h3><?= esc($ticket['status']) ?></h3>

                <p>Status Tiket</p>

            </div>

            <div class="icon">

                <i class="fas fa-ticket-alt"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-success">

            <div class="inner">

                <h3><?= esc($ticket['priority']) ?></h3>

                <p>Prioritas</p>

            </div>

            <div class="icon">

                <i class="fas fa-star"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-warning">

            <div class="inner">

                <h3><?= esc($ticket['submission_type']) ?></h3>

                <p>Jenis Pengajuan</p>

            </div>

            <div class="icon">

                <i class="fas fa-globe"></i>

            </div>

        </div>

    </div>

    <div class="col-lg-3 col-md-6">

        <div class="small-box bg-primary">

            <div class="inner">

                <h3>

                    <?= !empty($ticket['assigned_unit']) ? esc($ticket['assigned_unit']) : '-' ?>

                </h3>

                <p>Unit Tujuan</p>

            </div>

            <div class="icon">

                <i class="fas fa-building"></i>

            </div>

        </div>

    </div>

</div>

<form action="<?= base_url('verification/process/'.$ticket['id']) ?>" method="post">

<div class="card card-primary">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-id-card"></i>

            Informasi Permohonan

        </h3>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <table class="table table-borderless">

                    <tr>

                        <th width="180">Nomor Tiket</th>

                        <td><?= esc($ticket['ticket_number']) ?></td>

                    </tr>

                    <tr>

                        <th>Nama Pemohon</th>

                        <td><?= esc($ticket['applicant_name']) ?></td>

                    </tr>

                    <tr>

                        <th>NIM</th>

                        <td><?= esc($ticket['nim']) ?></td>

                    </tr>

                    <tr>

                        <th>Email</th>

                        <td><?= esc($ticket['email']) ?></td>

                    </tr>

                    <tr>

                        <th>No. HP</th>

                        <td><?= esc($ticket['phone']) ?></td>

                    </tr>

                </table>

            </div>

            <div class="col-md-6">

                <table class="table table-borderless">

                    <tr>

                        <th width="180">Layanan</th>

                        <td><?= esc($ticket['service_name']) ?></td>

                    </tr>

                    <tr>

                        <th>Jenis</th>

                        <td><?= esc($ticket['submission_type']) ?></td>

                    </tr>

                    <tr>

                        <th>Prioritas</th>

                        <td><?= esc($ticket['priority']) ?></td>

                    </tr>

                    <tr>

                        <th>Status</th>

                        <td>

                            <span class="badge badge-info">

                                <?= esc($ticket['status']) ?>

                            </span>

                        </td>

                    </tr>

                </table>

            </div>

        </div>

        <hr>

        <h5>Deskripsi Permohonan</h5>

        <div class="alert alert-light">

            <?= nl2br(esc($ticket['ticket_description'])) ?>

        </div>

    </div>

</div>

<div class="card card-info">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-paperclip"></i>

            Lampiran Pemohon

        </h3>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-8">

                <?php if(!empty($ticket['attachment'])): ?>

                    <?php
                        $ext = strtolower(pathinfo($ticket['attachment'], PATHINFO_EXTENSION));
                    ?>

                    <?php if($ext == 'pdf'): ?>

                        <iframe
                            src="<?= base_url('uploads/'.$ticket['attachment']) ?>"
                            width="100%"
                            height="600"
                            style="border:1px solid #ddd;border-radius:5px;">
                        </iframe>

                    <?php else: ?>

                        <img
                            src="<?= base_url('uploads/'.$ticket['attachment']) ?>"
                            class="img-fluid img-thumbnail">

                    <?php endif; ?>

                <?php else: ?>

                    <div class="alert alert-warning">

                        <i class="fas fa-exclamation-circle"></i>

                        Tidak ada lampiran.

                    </div>

                <?php endif; ?>

            </div>

            <div class="col-md-4">

                <div class="card">

                    <div class="card-header bg-light">

                        <strong>File Lampiran</strong>

                    </div>

                    <div class="card-body text-center">

                        <?php if(!empty($ticket['attachment'])): ?>

                            <i class="fas fa-file-alt fa-4x text-primary mb-3"></i>

                            <p>

                                <?= esc($ticket['attachment']) ?>

                            </p>

                            <a
                                href="<?= base_url('uploads/'.$ticket['attachment']) ?>"
                                target="_blank"
                                class="btn btn-info btn-block">

                                <i class="fas fa-eye"></i>

                                Lihat Lampiran

                            </a>

                            <a
                                href="<?= base_url('uploads/'.$ticket['attachment']) ?>"
                                download
                                class="btn btn-success btn-block">

                                <i class="fas fa-download"></i>

                                Download

                            </a>

                        <?php else: ?>

                            <p class="text-muted">

                                Belum ada file.

                            </p>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<div class="card card-success">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-check-square"></i>

            Checklist Kelengkapan

        </h3>

    </div>

    <div class="card-body">

        <div class="custom-control custom-checkbox mb-2">

            <input type="checkbox" class="custom-control-input" id="cek1">

            <label class="custom-control-label" for="cek1">

                Formulir permohonan telah diisi lengkap

            </label>

        </div>

        <div class="custom-control custom-checkbox mb-2">

            <input type="checkbox" class="custom-control-input" id="cek2">

            <label class="custom-control-label" for="cek2">

                Dokumen persyaratan lengkap

            </label>

        </div>

        <div class="custom-control custom-checkbox mb-2">

            <input type="checkbox" class="custom-control-input" id="cek3">

            <label class="custom-control-label" for="cek3">

                Data pemohon sesuai

            </label>

        </div>

        <div class="custom-control custom-checkbox">

            <input type="checkbox" class="custom-control-input" id="cek4">

            <label class="custom-control-label" for="cek4">

                Siap diproses ke tahap disposisi

            </label>

        </div>

    </div>

</div>

<div class="card card-secondary">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-history"></i>

            Riwayat Proses Verifikasi

        </h3>

    </div>

    <div class="card-body">

        <?php if(!empty($logs)): ?>

            <ul class="timeline">

                <?php foreach($logs as $log): ?>

                <li>

                    <i class="fas fa-check bg-primary"></i>

                    <div class="timeline-item">

                        <span class="time">

                            <i class="far fa-clock"></i>

                            <?= date('d M Y H:i', strtotime($log['created_at'])) ?>

                        </span>

                        <h3 class="timeline-header">

                            <?= esc($log['user_name']) ?>

                        </h3>

                        <div class="timeline-body">

                            <?= esc($log['activity']) ?>

                        </div>

                    </div>

                </li>

                <?php endforeach; ?>

            </ul>

        <?php else: ?>

            <div class="alert alert-info">

                Belum ada riwayat verifikasi.

            </div>

        <?php endif; ?>

    </div>

</div>
<div class="card card-success">

    <div class="card-header">

        <h3 class="card-title">

            <i class="fas fa-user-check"></i>

            Form Verifikasi Tiket

        </h3>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label>Status Verifikasi <span class="text-danger">*</span></label>

                    <select name="status" class="form-control" required>

                        <option value="">-- Pilih Keputusan --</option>

                        <option value="Verified">✔ Verifikasi</option>

                        <option value="Need Revision">📝 Need Revision</option>

                        <option value="Rejected">✖ Reject</option>

                    </select>

                </div>

            </div>

            <div class="col-md-6">

                <div class="form-group">

                    <label>Prioritas</label>

                    <select name="priority" class="form-control">

                        <option value="Low">Low</option>

                        <option value="Medium">Medium</option>

                        <option value="High">High</option>

                        <option value="Urgent">Urgent</option>

                    </select>

                </div>

            </div>
        </div>

        <div class="form-group">

            <label>Unit Tujuan</label>

            <select name="assigned_unit" class="form-control">

                <option value="">-- Pilih Unit --</option>

                <option value="Akademik">Akademik</option>

                <option value="Kemahasiswaan">Kemahasiswaan</option>

                <option value="Keuangan">Keuangan</option>

                <option value="SDM">SDM</option>

                <option value="Kerja Sama">Kerja Sama</option>

                <option value="Perpustakaan">Perpustakaan</option>

                <option value="UPT TIK">UPT TIK</option>

            </select>

        </div>

        <div class="form-group">

            <label>Catatan Verifikasi</label>

            <textarea
                name="verification_note"
                class="form-control"
                rows="5"
                placeholder="Tuliskan hasil pemeriksaan dokumen..."></textarea>

        </div>

        <div class="form-group">

            <label>Komentar Petugas</label>

            <textarea
                name="comment"
                class="form-control"
                rows="3"
                placeholder="Tambahkan komentar jika diperlukan..."></textarea>

        </div>

    </div>

   <div class="card-footer d-flex justify-content-between">

    <!-- KEMBALI -->
    <a href="<?= base_url('verification') ?>"
       class="btn btn-secondary">

        <i class="fas fa-arrow-left"></i>
        Kembali

    </a>


    <div>

        <!-- VERIFIKASI -->
        <button
            type="submit"
            name="action"
            value="verify"
            id="btnVerify"
            class="btn btn-success">

            <i class="fas fa-check-circle"></i>
            Simpan Verifikasi

        </button>


        <!-- NEED REVISION -->
        <button
            type="submit"
            name="action"
            value="revision"
            id="btnRevision"
            class="btn btn-warning">

            <i class="fas fa-edit"></i>
            Need Revision

        </button>


        <!-- REJECT -->
        <button
            type="submit"
            name="action"
            value="reject"
            id="btnReject"
            class="btn btn-danger">

            <i class="fas fa-times"></i>
            Reject

        </button>


        <!-- DISPOSISI -->
        <a
            href="<?= base_url('disposition') ?>"
            id="btnDisposition"
            class="btn btn-primary">

            <i class="fas fa-share"></i>
            Disposisi

        </a>

    </div>

</div>

</div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const statusSelect = document.querySelector('select[name="status"]');

    const btnVerify = document.getElementById('btnVerify');
    const btnRevision = document.getElementById('btnRevision');
    const btnReject = document.getElementById('btnReject');
    const btnDisposition = document.getElementById('btnDisposition');


    function updateButtons() {

        const status = statusSelect.value;

        // Sembunyikan semua tombol keputusan
        btnVerify.style.display = 'none';
        btnRevision.style.display = 'none';
        btnReject.style.display = 'none';


        // VERIFIKASI
        if (status === 'Verified') {

            btnVerify.style.display = 'inline-block';

        }


        // NEED REVISION
        else if (status === 'Need Revision') {

            btnRevision.style.display = 'inline-block';

        }


        // REJECT
        else if (status === 'Rejected') {

            btnReject.style.display = 'inline-block';

        }

    }


    // Jalankan saat halaman pertama dibuka
    updateButtons();


    // Jalankan setiap status berubah
    statusSelect.addEventListener('change', updateButtons);

});
</script>

</div>
</section>

<?= $this->endSection() ?>