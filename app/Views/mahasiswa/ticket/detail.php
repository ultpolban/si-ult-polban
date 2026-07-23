<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- ================================= -->
    <!-- HEADER -->
    <!-- ================================= -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-8">

                    <h1 class="page-title">

                        <i class="fas fa-ticket-alt"></i>

                        Detail Tiket

                    </h1>

                    <p class="text-muted mb-0">

                        Informasi lengkap dan perkembangan pengajuan layanan Anda.

                    </p>

                </div>

                <div class="col-md-4 text-md-end mt-3 mt-md-0">

                    <a
                        href="<?= base_url('mahasiswa/ticket/history') ?>"
                        class="btn btn-outline-primary"
                    >

                        <i class="fas fa-arrow-left"></i>

                        Kembali ke Tracking

                    </a>

                </div>

            </div>

        </div>

    </section>


    <!-- ================================= -->
    <!-- CONTENT -->
    <!-- ================================= -->

    <section class="content">

        <div class="container-fluid">


            <!-- ================================= -->
            <!-- TICKET HEADER CARD -->
            <!-- ================================= -->

            <div class="card ticket-header-card shadow-sm">

                <div class="card-body">

                    <div class="row align-items-center">


                        <!-- NOMOR TIKET -->

                        <div class="col-md-8">

                            <span class="ticket-label">

                                NOMOR TIKET

                            </span>

                            <h2 class="ticket-number">

                                <?= esc($ticket['nomor'] ?? '-') ?>

                            </h2>

                            <p class="mb-0 text-muted">

                                <i class="fas fa-calendar-alt"></i>

                                <?= esc($ticket['tanggal'] ?? '-') ?>

                            </p>

                        </div>


                        <!-- STATUS -->

                        <div class="col-md-4 text-md-end mt-3 mt-md-0">

                            <?php

                            $status = $ticket['status'] ?? 'Submitted';

                            $statusColor = [

                                'Draft' => 'secondary',

                                'Submitted' => 'primary',

                                'Verified' => 'info',

                                'Assigned' => 'warning',

                                'In Progress' => 'warning',

                                'Revision' => 'danger',

                                'Completed' => 'success',

                                'Closed' => 'dark'

                            ];

                            $color = $statusColor[$status] ?? 'secondary';

                            ?>


                            <span class="status-label">

                                STATUS SAAT INI

                            </span>


                            <div>

                                <span class="badge bg-<?= $color ?> status-badge">

                                    <?= esc($status) ?>

                                </span>

                            </div>

                        </div>


                    </div>

                </div>

            </div>


            <div class="row">


                <!-- ================================= -->
                <!-- LEFT COLUMN -->
                <!-- ================================= -->

                <div class="col-lg-7">


                    <!-- ================================= -->
                    <!-- INFORMASI PENGAJUAN -->
                    <!-- ================================= -->

                    <div class="card shadow-sm detail-card">

                        <div class="card-header">

                            <h3 class="card-title">

                                <i class="fas fa-file-alt"></i>

                                Informasi Pengajuan

                            </h3>

                        </div>


                        <div class="card-body">

                            <div class="detail-list">


                                <div class="detail-row">

                                    <span>

                                        <i class="fas fa-file-signature"></i>

                                        Jenis Layanan

                                    </span>

                                    <strong>

                                        <?= esc($ticket['layanan'] ?? '-') ?>

                                    </strong>

                                </div>


                                <div class="detail-row">

                                    <span>

                                        <i class="fas fa-building"></i>

                                        Unit Tujuan

                                    </span>

                                    <strong>

                                        <?= esc($ticket['unit'] ?? '-') ?>

                                    </strong>

                                </div>


                                <div class="detail-row">

                                    <span>

                                        <i class="fas fa-calendar-alt"></i>

                                        Tanggal Pengajuan

                                    </span>

                                    <strong>

                                        <?= esc($ticket['tanggal'] ?? '-') ?>

                                    </strong>

                                </div>


                                <div class="detail-row">

                                    <span>

                                        <i class="fas fa-comment-alt"></i>

                                        Keterangan

                                    </span>

                                    <strong>

                                        <?= esc($ticket['keterangan'] ?? '-') ?>

                                    </strong>

                                </div>


                            </div>

                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- DOKUMEN -->
                    <!-- ================================= -->

                    <div class="card shadow-sm detail-card">

                        <div class="card-header">

                            <h3 class="card-title">

                                <i class="fas fa-paperclip"></i>

                                Dokumen Pengajuan

                            </h3>

                        </div>


                        <div class="card-body">


                            <?php if (!empty($ticket['dokumen'])): ?>


                                <div class="document-item">

                                    <div class="document-icon">

                                        <i class="fas fa-file-pdf"></i>

                                    </div>


                                    <div class="document-info">

                                        <strong>

                                            <?= esc($ticket['dokumen']) ?>

                                        </strong>

                                        <small>

                                            Dokumen pengajuan

                                        </small>

                                    </div>


                                    <a
                                        href="#"
                                        class="btn btn-sm btn-outline-primary"
                                    >

                                        <i class="fas fa-eye"></i>

                                        Lihat

                                    </a>

                                </div>


                            <?php else: ?>


                                <div class="empty-document">

                                    <i class="fas fa-file-circle-xmark"></i>

                                    <p>

                                        Tidak ada dokumen yang diunggah.

                                    </p>

                                </div>


                            <?php endif; ?>


                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- CATATAN PETUGAS -->
                    <!-- ================================= -->

                    <div class="card shadow-sm detail-card">

                        <div class="card-header">

                            <h3 class="card-title">

                                <i class="fas fa-comments"></i>

                                Catatan Petugas

                            </h3>

                        </div>


                        <div class="card-body">


                            <?php if (!empty($ticket['catatan_petugas'])): ?>


                                <div class="officer-note">

                                    <div class="note-header">

                                        <div class="note-avatar">

                                            <i class="fas fa-user-tie"></i>

                                        </div>

                                        <div>

                                            <strong>

                                                Petugas ULT POLBAN

                                            </strong>

                                            <small>

                                                <?= esc($ticket['catatan_tanggal'] ?? 'Catatan terbaru') ?>

                                            </small>

                                        </div>

                                    </div>


                                    <div class="note-content">

                                        <?= esc($ticket['catatan_petugas']) ?>

                                    </div>

                                </div>


                            <?php else: ?>


                                <div class="empty-note">

                                    <i class="fas fa-comment-slash"></i>

                                    <p>

                                        Belum ada catatan dari petugas.

                                    </p>

                                </div>


                            <?php endif; ?>


                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- BALAS CATATAN -->
                    <!-- ================================= -->

                    <div class="card shadow-sm detail-card">

                        <div class="card-header">

                            <h3 class="card-title">

                                <i class="fas fa-reply"></i>

                                Balas Catatan

                            </h3>

                        </div>


                        <div class="card-body">


                            <form
                                action="<?= base_url('mahasiswa/ticket/reply/' . ($ticket['id'] ?? 0)) ?>"
                                method="post"
                            >

                                <?= csrf_field() ?>


                                <div class="form-group">

                                    <label>

                                        Pesan Anda

                                    </label>

                                    <textarea
                                        name="balasan"
                                        class="form-control"
                                        rows="4"
                                        placeholder="Tulis balasan atau tanggapan Anda..."
                                    ></textarea>

                                </div>


                                <div class="text-end mt-3">

                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >

                                        <i class="fas fa-paper-plane"></i>

                                        Kirim Balasan

                                    </button>

                                </div>

                            </form>


                        </div>

                    </div>


                </div>


                <!-- ================================= -->
                <!-- RIGHT COLUMN -->
                <!-- ================================= -->

                <div class="col-lg-5">


                    <!-- ================================= -->
                    <!-- STATUS TIMELINE -->
                    <!-- ================================= -->

                    <div class="card shadow-sm detail-card">

                        <div class="card-header">

                            <h3 class="card-title">

                                <i class="fas fa-history"></i>

                                Riwayat Status

                            </h3>

                        </div>


                        <div class="card-body">

                            <div class="detail-timeline">


                                <!-- SUBMITTED -->

                                <div class="timeline-step active">

                                    <div class="timeline-dot">

                                        <i class="fas fa-paper-plane"></i>

                                    </div>

                                    <div class="timeline-text">

                                        <strong>

                                            Pengajuan Dikirim

                                        </strong>

                                        <small>

                                            Pengajuan berhasil dikirim oleh mahasiswa.

                                        </small>

                                    </div>

                                </div>


                                <!-- VERIFIED -->

                                <div class="timeline-step
                                    <?= in_array($status, [
                                        'Verified',
                                        'Assigned',
                                        'In Progress',
                                        'Revision',
                                        'Completed',
                                        'Closed'
                                    ]) ? 'active' : '' ?>">

                                    <div class="timeline-dot">

                                        <i class="fas fa-check"></i>

                                    </div>

                                    <div class="timeline-text">

                                        <strong>

                                            Diverifikasi

                                        </strong>

                                        <small>

                                            Pengajuan telah diverifikasi petugas.

                                        </small>

                                    </div>

                                </div>


                                <!-- ASSIGNED -->

                                <div class="timeline-step
                                    <?= in_array($status, [
                                        'Assigned',
                                        'In Progress',
                                        'Revision',
                                        'Completed',
                                        'Closed'
                                    ]) ? 'active' : '' ?>">

                                    <div class="timeline-dot">

                                        <i class="fas fa-building"></i>

                                    </div>

                                    <div class="timeline-text">

                                        <strong>

                                            Diteruskan ke Unit

                                        </strong>

                                        <small>

                                            Tiket telah diteruskan ke unit terkait.

                                        </small>

                                    </div>

                                </div>


                                <!-- PROCESS -->

                                <div class="timeline-step
                                    <?= in_array($status, [
                                        'In Progress',
                                        'Revision',
                                        'Completed',
                                        'Closed'
                                    ]) ? 'active' : '' ?>">

                                    <div class="timeline-dot">

                                        <i class="fas fa-spinner"></i>

                                    </div>

                                    <div class="timeline-text">

                                        <strong>

                                            Sedang Diproses

                                        </strong>

                                        <small>

                                            Unit sedang memproses pengajuan.

                                        </small>

                                    </div>

                                </div>


                                <!-- REVISION -->

                                <?php if ($status === 'Revision'): ?>

                                    <div class="timeline-step active revision">

                                        <div class="timeline-dot">

                                            <i class="fas fa-exclamation"></i>

                                        </div>

                                        <div class="timeline-text">

                                            <strong>

                                                Perlu Revisi

                                            </strong>

                                            <small>

                                                Pengajuan membutuhkan perbaikan.

                                            </small>

                                        </div>

                                    </div>

                                <?php endif; ?>


                                <!-- COMPLETED -->

                                <div class="timeline-step
                                    <?= in_array($status, [
                                        'Completed',
                                        'Closed'
                                    ]) ? 'active' : '' ?>">

                                    <div class="timeline-dot">

                                        <i class="fas fa-check-circle"></i>

                                    </div>

                                    <div class="timeline-text">

                                        <strong>

                                            Selesai

                                        </strong>

                                        <small>

                                            Pengajuan telah selesai diproses.

                                        </small>

                                    </div>

                                </div>


                                <!-- CLOSED -->

                                <div class="timeline-step
                                    <?= $status === 'Closed' ? 'active' : '' ?>">

                                    <div class="timeline-dot">

                                        <i class="fas fa-lock"></i>

                                    </div>

                                    <div class="timeline-text">

                                        <strong>

                                            Ditutup

                                        </strong>

                                        <small>

                                            Tiket telah ditutup.

                                        </small>

                                    </div>

                                </div>


                            </div>

                        </div>

                    </div>


                    <!-- ================================= -->
                    <!-- BANTUAN -->
                    <!-- ================================= -->

                    <div class="help-card">

                        <div class="help-icon">

                            <i class="fas fa-headset"></i>

                        </div>

                        <div>

                            <strong>

                                Butuh Bantuan?

                            </strong>

                            <p>

                                Jika ada kendala terkait pengajuan,
                                silakan balas catatan petugas.

                            </p>

                        </div>

                    </div>


                </div>


            </div>

        </div>

    </section>

</div>


<style>

/* ================================ */
/* TITLE */
/* ================================ */

.page-title {

    color: #0d47a1;

    font-weight: 700;

}


/* ================================ */
/* HEADER CARD */
/* ================================ */

.ticket-header-card {

    border: none;

    border-radius: 14px;

    overflow: hidden;

    margin-bottom: 25px;

    border-top: 5px solid #f59e0b;

}


.ticket-label,
.status-label {

    font-size: 12px;

    color: #64748b;

    font-weight: 600;

}


.ticket-number {

    color: #0d47a1;

    font-weight: 700;

    margin: 5px 0;

}


.status-badge {

    font-size: 15px;

    padding: 9px 18px;

    margin-top: 5px;

}


/* ================================ */
/* CARD */
/* ================================ */

.detail-card {

    border: none;

    border-radius: 12px;

    margin-bottom: 20px;

    overflow: hidden;

}


.detail-card .card-header {

    background: #0d47a1;

    color: white;

    border-bottom: 4px solid #f59e0b;

}


.detail-card .card-title {

    font-weight: 600;

}


/* ================================ */
/* DETAIL */
/* ================================ */

.detail-row {

    display: flex;

    justify-content: space-between;

    gap: 20px;

    padding: 15px 0;

    border-bottom: 1px solid #e2e8f0;

}


.detail-row:last-child {

    border-bottom: none;

}


.detail-row span {

    color: #64748b;

}


.detail-row span i {

    color: #0d47a1;

    width: 22px;

}


.detail-row strong {

    text-align: right;

    color: #172554;

}


/* ================================ */
/* DOCUMENT */
/* ================================ */

.document-item {

    display: flex;

    align-items: center;

    gap: 15px;

    padding: 15px;

    background: #eff6ff;

    border-radius: 10px;

}


.document-icon {

    width: 45px;

    height: 45px;

    background: #0d47a1;

    color: white;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 8px;

    font-size: 20px;

}


.document-info {

    flex: 1;

}


.document-info strong {

    display: block;

}


.document-info small {

    color: #64748b;

}


/* ================================ */
/* EMPTY */
/* ================================ */

.empty-document,
.empty-note {

    text-align: center;

    color: #94a3b8;

    padding: 25px;

}


.empty-document i,
.empty-note i {

    font-size: 35px;

    margin-bottom: 10px;

}


/* ================================ */
/* NOTE */
/* ================================ */

.officer-note {

    background: #eff6ff;

    border-left: 4px solid #0d47a1;

    border-radius: 8px;

    padding: 18px;

}


.note-header {

    display: flex;

    align-items: center;

    gap: 12px;

    margin-bottom: 15px;

}


.note-avatar {

    width: 42px;

    height: 42px;

    background: #0d47a1;

    color: white;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

}


.note-header strong {

    display: block;

}


.note-header small {

    color: #64748b;

}


.note-content {

    color: #334155;

    line-height: 1.7;

}


/* ================================ */
/* TIMELINE */
/* ================================ */

.detail-timeline {

    position: relative;

}


.detail-timeline::before {

    content: '';

    position: absolute;

    top: 20px;

    bottom: 20px;

    left: 19px;

    width: 3px;

    background: #e2e8f0;

}


.timeline-step {

    position: relative;

    display: flex;

    gap: 15px;

    margin-bottom: 25px;

}


.timeline-dot {

    position: relative;

    z-index: 2;

    flex-shrink: 0;

    width: 40px;

    height: 40px;

    border-radius: 50%;

    background: #e2e8f0;

    color: #94a3b8;

    display: flex;

    align-items: center;

    justify-content: center;

    border: 3px solid white;

}


.timeline-step.active .timeline-dot {

    background: #0d47a1;

    color: white;

    box-shadow: 0 0 0 3px rgba(13, 71, 161, 0.12);

}


.timeline-step.revision .timeline-dot {

    background: #dc3545;

}


.timeline-text strong {

    display: block;

    color: #172554;

}


.timeline-text small {

    display: block;

    color: #64748b;

    margin-top: 4px;

    line-height: 1.5;

}


/* ================================ */
/* HELP */
/* ================================ */

.help-card {

    display: flex;

    gap: 15px;

    background: #eff6ff;

    border-left: 4px solid #0d47a1;

    padding: 18px;

    border-radius: 8px;

}


.help-icon {

    color: #0d47a1;

    font-size: 25px;

}


.help-card strong {

    color: #172554;

}


.help-card p {

    color: #64748b;

    margin: 5px 0 0;

}


/* ================================ */
/* BUTTON */
/* ================================ */

.btn-primary {

    background: #0d47a1;

    border-color: #0d47a1;

}


.btn-primary:hover {

    background: #f59e0b;

    border-color: #f59e0b;

}


.btn-outline-primary {

    color: #0d47a1;

    border-color: #0d47a1;

}


.btn-outline-primary:hover {

    background: #f59e0b;

    border-color: #f59e0b;

    color: white;

}


/* ================================ */
/* RESPONSIVE */
/* ================================ */

@media (max-width: 768px) {

    .detail-row {

        flex-direction: column;

        gap: 5px;

    }


    .detail-row strong {

        text-align: left;

    }


    .document-item {

        flex-wrap: wrap;

    }

}

</style>


<?= $this->include('layouts/footer') ?>