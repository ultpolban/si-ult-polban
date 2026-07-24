<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_dosen') ?>


<style>

/* =========================================
   HALAMAN DETAIL TIKET DOSEN
========================================= */

.detail-page {
    background: #f4f7fb;
    min-height: calc(100vh - 57px);
    padding-bottom: 40px;
}


/* =========================================
   JUDUL
========================================= */

.page-title {
    color: #0b3d91;
    font-weight: 700;
}

.page-subtitle {
    color: #64748b;
}


/* =========================================
   CARD
========================================= */

.detail-card {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
}

.detail-card .card-header {
    background: #0b3d91;
    color: white;
    padding: 20px 25px;
    border: none;
}

.detail-card .card-header h3 {
    margin: 0;
    font-size: 21px;
    font-weight: 700;
}


/* =========================================
   DETAIL TABLE
========================================= */

.detail-table {
    margin-bottom: 0;
}

.detail-table th {
    width: 30%;
    background: #f1f5f9;
    color: #17365d;
    font-weight: 700;
    padding: 16px;
    vertical-align: middle;
}

.detail-table td {
    color: #334155;
    padding: 16px;
    vertical-align: middle;
}


/* =========================================
   NOMOR TIKET
========================================= */

.ticket-number {
    color: #0b3d91;
    font-size: 18px;
    font-weight: 700;
}


/* =========================================
   STATUS
========================================= */

.status-badge {
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 700;
}


/* =========================================
   DOKUMEN
========================================= */

.document-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 15px;
}

.document-box i {
    color: #0b3d91;
    font-size: 25px;
    margin-right: 10px;
}


/* =========================================
   CATATAN PETUGAS
========================================= */

.note-card {
    border: none;
    border-left: 5px solid #f28c28;
    background: #fff8ef;
    border-radius: 10px;
    padding: 20px;
}

.note-card h5 {
    color: #d97617;
    font-weight: 700;
}

.note-card p {
    color: #475569;
    margin-bottom: 0;
    line-height: 1.7;
}


/* =========================================
   BALASAN PEMOHON
========================================= */

.reply-card {
    border: none;
    border-left: 5px solid #0b3d91;
    background: #f1f6ff;
    border-radius: 10px;
    padding: 20px;
}

.reply-card h5 {
    color: #0b3d91;
    font-weight: 700;
}


/* =========================================
   FORM BALASAN
========================================= */

.reply-form textarea {
    min-height: 130px;
    border-radius: 10px;
    border: 1px solid #cbd5e1;
}

.reply-form textarea:focus {
    border-color: #0b3d91;
    box-shadow: 0 0 0 .2rem rgba(11,61,145,.12);
}


/* =========================================
   BUTTON
========================================= */

.btn-back {
    background: #64748b;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 700;
}

.btn-back:hover {
    background: #475569;
    color: white;
}

.btn-reply {
    background: #0b3d91;
    color: white;
    border: none;
    border-radius: 8px;
    padding: 10px 22px;
    font-weight: 700;
}

.btn-reply:hover {
    background: #082f70;
    color: white;
}


/* =========================================
   INFO CARD
========================================= */

.info-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,.07);
    overflow: hidden;
}

.info-card .card-header {
    background: #f28c28;
    color: white;
    font-weight: 700;
    padding: 15px 20px;
}

.info-card .card-body {
    color: #475569;
    line-height: 1.7;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 768px) {

    .detail-table th {
        width: 40%;
    }

}

</style>


<div class="content-wrapper detail-page">


    <!-- =====================================
         HEADER
    ====================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <h1 class="page-title">

                <i class="fas fa-file-circle-check"></i>

                Detail Tiket

            </h1>

            <p class="page-subtitle">

                Lihat informasi lengkap dan perkembangan pengajuan layanan Anda.

            </p>

        </div>

    </section>



    <!-- =====================================
         CONTENT
    ====================================== -->

    <section class="content">

        <div class="container-fluid">

            <div class="row">


                <!-- =================================
                     DETAIL TIKET
                ================================== -->

                <div class="col-lg-8">

                    <div class="card detail-card">


                        <!-- HEADER -->

                        <div class="card-header">

                            <h3>

                                <i class="fas fa-ticket-alt me-2"></i>

                                Informasi Pengajuan

                            </h3>

                        </div>


                        <!-- BODY -->

                        <div class="card-body p-0">


                            <?php

                            /*
                            =====================================
                            DATA TIKET
                            =====================================
                            */

                            $status =
                                $ticket['status']
                                ?? 'Submitted';


                            $statusLower =
                                strtolower(
                                    $status
                                );


                            $statusClass =
                                'primary';


                            if (
                                in_array(
                                    $statusLower,
                                    [
                                        'draft'
                                    ]
                                )
                            ) {

                                $statusClass =
                                    'secondary';

                            }


                            elseif (
                                in_array(
                                    $statusLower,
                                    [
                                        'submitted',
                                        'diajukan'
                                    ]
                                )
                            ) {

                                $statusClass =
                                    'primary';

                            }


                            elseif (
                                in_array(
                                    $statusLower,
                                    [
                                        'verification',
                                        'verifikasi',
                                        'menunggu verifikasi'
                                    ]
                                )
                            ) {

                                $statusClass =
                                    'warning';

                            }


                            elseif (
                                in_array(
                                    $statusLower,
                                    [
                                        'in progress',
                                        'diproses',
                                        'sedang diproses'
                                    ]
                                )
                            ) {

                                $statusClass =
                                    'info';

                            }


                            elseif (
                                in_array(
                                    $statusLower,
                                    [
                                        'revision',
                                        'revisi',
                                        'perlu revisi'
                                    ]
                                )
                            ) {

                                $statusClass =
                                    'danger';

                            }


                            elseif (
                                in_array(
                                    $statusLower,
                                    [
                                        'completed',
                                        'selesai'
                                    ]
                                )
                            ) {

                                $statusClass =
                                    'success';

                            }

                            ?>


                            <table class="table table-bordered detail-table">


                                <!-- NOMOR TIKET -->

                                <tr>

                                    <th>

                                        <i class="fas fa-hashtag me-2"></i>

                                        Nomor Tiket

                                    </th>

                                    <td>

                                        <span class="ticket-number">

                                            <?= esc(
                                                $ticket['nomor']
                                                ?? '-'
                                            ) ?>

                                        </span>

                                    </td>

                                </tr>



                                <!-- UNIT TUJUAN -->

                                <tr>

                                    <th>

                                        <i class="fas fa-building me-2"></i>

                                        Unit Tujuan

                                    </th>

                                    <td>

                                        <?= esc(
                                            $ticket['unit']
                                            ??
                                            $ticket['unit_tujuan']
                                            ??
                                            '-'
                                        ) ?>

                                    </td>

                                </tr>



                                <!-- JENIS LAYANAN -->

                                <tr>

                                    <th>

                                        <i class="fas fa-list-check me-2"></i>

                                        Jenis Layanan

                                    </th>

                                    <td>

                                        <?= esc(
                                            $ticket['layanan']
                                            ??
                                            $ticket['jenis_layanan']
                                            ??
                                            '-'
                                        ) ?>

                                    </td>

                                </tr>



                                <!-- JUDUL -->

                                <tr>

                                    <th>

                                        <i class="fas fa-heading me-2"></i>

                                        Judul / Keperluan

                                    </th>

                                    <td>

                                        <?= esc(
                                            $ticket['judul']
                                            ?? '-'
                                        ) ?>

                                    </td>

                                </tr>



                                <!-- TANGGAL -->

                                <tr>

                                    <th>

                                        <i class="fas fa-calendar me-2"></i>

                                        Tanggal Pengajuan

                                    </th>

                                    <td>

                                        <?= esc(
                                            $ticket['tanggal']
                                            ??
                                            $ticket['created_at']
                                            ??
                                            '-'
                                        ) ?>

                                    </td>

                                </tr>



                                <!-- STATUS -->

                                <tr>

                                    <th>

                                        <i class="fas fa-circle-info me-2"></i>

                                        Status

                                    </th>

                                    <td>

                                        <span
                                            class="badge bg-<?= $statusClass ?> status-badge"
                                        >

                                            <?= esc(
                                                $status
                                            ) ?>

                                        </span>

                                    </td>

                                </tr>



                                <!-- KETERANGAN -->

                                <tr>

                                    <th>

                                        <i class="fas fa-align-left me-2"></i>

                                        Keterangan

                                    </th>

                                    <td>

                                        <?= nl2br(
                                            esc(
                                                $ticket['keterangan']
                                                ?? '-'
                                            )
                                        ) ?>

                                    </td>

                                </tr>



                                <!-- DOKUMEN -->

                                <tr>

                                    <th>

                                        <i class="fas fa-paperclip me-2"></i>

                                        Dokumen Pendukung

                                    </th>

                                    <td>


                                        <?php if (
                                            !empty(
                                                $ticket['dokumen']
                                            )
                                        ): ?>


                                            <div class="document-box">

                                                <i class="fas fa-file-alt"></i>


                                                <span>

                                                    <?= esc(
                                                        basename(
                                                            $ticket['dokumen']
                                                        )
                                                    ) ?>

                                                </span>


                                                <a
                                                    href="<?= base_url(
                                                        'uploads/tickets/' .
                                                        $ticket['dokumen']
                                                    ) ?>"
                                                    target="_blank"
                                                    class="btn btn-sm btn-outline-primary float-end"
                                                >

                                                    <i class="fas fa-eye"></i>

                                                    Lihat Dokumen

                                                </a>

                                            </div>


                                        <?php else: ?>


                                            <span class="text-muted">

                                                Tidak ada dokumen pendukung.

                                            </span>


                                        <?php endif; ?>


                                    </td>

                                </tr>


                            </table>


                        </div>

                    </div>



                    <!-- =================================
                         CATATAN PETUGAS
                    ================================== -->

                    <?php if (
                        !empty(
                            $ticket['catatan_petugas']
                        )
                    ): ?>


                        <div class="note-card mt-4">


                            <h5>

                                <i class="fas fa-comment-dots me-2"></i>

                                Catatan dari Petugas

                            </h5>


                            <p>

                                <?= nl2br(
                                    esc(
                                        $ticket['catatan_petugas']
                                    )
                                ) ?>

                            </p>


                        </div>


                    <?php endif; ?>



                    <!-- =================================
                         BALASAN PEMOHON
                    ================================== -->

                    <?php if (
                        !empty(
                            $ticket['balasan_pemohon']
                        )
                    ): ?>


                        <div class="reply-card mt-4">


                            <h5>

                                <i class="fas fa-reply me-2"></i>

                                Balasan Anda

                            </h5>


                            <p>

                                <?= nl2br(
                                    esc(
                                        $ticket['balasan_pemohon']
                                    )
                                ) ?>

                            </p>


                        </div>


                    <?php endif; ?>



                    <!-- =================================
                         FORM BALAS CATATAN
                    ================================== -->

                    <?php if (
                        in_array(
                            $statusLower,
                            [
                                'revision',
                                'revisi',
                                'perlu revisi'
                            ]
                        )
                    ): ?>


                        <div class="card detail-card mt-4">


                            <div class="card-header">

                                <h3>

                                    <i class="fas fa-reply me-2"></i>

                                    Balas Catatan Petugas

                                </h3>

                            </div>


                            <div class="card-body">


                                <form
                                    action="<?= base_url(
                                        'dosen/ticket/reply/' .
                                        ($ticket['id'] ?? 0)
                                    ) ?>"
                                    method="post"
                                    class="reply-form"
                                >

                                    <?= csrf_field() ?>


                                    <div class="mb-3">

                                        <label
                                            for="balasan"
                                            class="form-label fw-bold"
                                        >

                                            Balasan

                                        </label>


                                        <textarea
                                            name="balasan"
                                            id="balasan"
                                            class="form-control"
                                            placeholder="Tuliskan balasan atau informasi tambahan..."
                                            required
                                        ></textarea>

                                    </div>


                                    <button
                                        type="submit"
                                        class="btn btn-reply"
                                    >

                                        <i class="fas fa-paper-plane me-2"></i>

                                        Kirim Balasan

                                    </button>


                                </form>


                            </div>


                        </div>


                    <?php endif; ?>


                </div>



                <!-- =================================
                     SIDEBAR
                ================================== -->

                <div class="col-lg-4 mt-4 mt-lg-0">


                    <!-- INFORMASI STATUS -->

                    <div class="card info-card">


                        <div class="card-header">

                            <i class="fas fa-info-circle me-2"></i>

                            Informasi Status

                        </div>


                        <div class="card-body">


                            <p>

                                <span class="badge bg-primary">

                                    Submitted

                                </span>

                                Pengajuan telah dikirim.

                            </p>


                            <p>

                                <span class="badge bg-warning">

                                    Verification

                                </span>

                                Pengajuan sedang diverifikasi.

                            </p>


                            <p>

                                <span class="badge bg-info">

                                    In Progress

                                </span>

                                Pengajuan sedang diproses.

                            </p>


                            <p>

                                <span class="badge bg-danger">

                                    Revision

                                </span>

                                Pengajuan membutuhkan revisi.

                            </p>


                            <p class="mb-0">

                                <span class="badge bg-success">

                                    Completed

                                </span>

                                Pengajuan telah selesai.

                            </p>


                        </div>


                    </div>



                    <!-- KEMBALI -->

                    <div class="mt-3">

                        <a
                            href="<?= base_url('dosen/ticket/history') ?>"
                            class="btn btn-back w-100"
                        >

                            <i class="fas fa-arrow-left me-2"></i>

                            Kembali ke Tracking Tiket

                        </a>

                    </div>


                </div>


            </div>

        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>