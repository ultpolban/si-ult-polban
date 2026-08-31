```php
<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>


<style>

/* =====================================================
   HEADER
===================================================== */

.detail-header{
    margin-bottom:25px;
}

.detail-title{
    font-size:30px;
    font-weight:700;
    color:#172033;
}

.detail-subtitle{
    color:#6c757d;
    margin-top:5px;
}


/* =====================================================
   CARD
===================================================== */

.detail-card{
    background:#fff;
    border:none;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    overflow:hidden;
}

.detail-card-header{
    padding:22px 28px;
    border-bottom:1px solid #eee;
    background:#fff;
}

.detail-card-header h5{
    margin:0;
    font-size:20px;
    font-weight:700;
    color:#172033;
}

.detail-card-body{
    padding:28px;
}


/* =====================================================
   DETAIL ITEM
===================================================== */

.detail-item{
    margin-bottom:20px;
}

.detail-label{
    display:block;
    color:#293582;
    font-weight:700;
    margin-bottom:6px;
    font-size:15px;
}

.detail-value{
    color:#212529;
    margin:0;
    font-size:15px;
}


/* =====================================================
   DESCRIPTION BOX
===================================================== */

.detail-box{
    border:1px solid #dee2e6;
    border-radius:10px;
    padding:15px;
    background:#f8f9fa;
    line-height:1.7;
}


/* =====================================================
   SECTION
===================================================== */

.detail-section{
    margin-top:30px;
    padding-top:25px;
    border-top:1px solid #eee;
}

.detail-section-title{
    font-size:18px;
    font-weight:700;
    color:#172033;
    margin-bottom:20px;
}


/* =====================================================
   DOCUMENT
===================================================== */

.document-box{
    border:1px solid #e5e7eb;
    border-radius:12px;
    padding:15px;
    background:#f8f9fa;
}

.document-link{
    display:inline-flex;
    align-items:center;
    gap:7px;
    text-decoration:none;
    margin-top:5px;
}


/* =====================================================
   SEND STATUS
===================================================== */

.send-card{
    border:1px solid #e5e7eb;
    border-radius:12px;
    padding:18px;
    height:100%;
    background:#fff;
}

.send-card label{
    color:#293582;
    font-weight:700;
}

.send-status{
    margin-top:12px;
}


/* =====================================================
   BUTTON
===================================================== */

.detail-actions{
    margin-top:30px;
    padding-top:25px;
    border-top:1px solid #eee;
}

.detail-actions .btn{
    border-radius:10px;
    padding:10px 18px;
    margin-right:7px;
    margin-bottom:8px;
}

.btn-detail-primary{
    background:#293582;
    border:none;
    color:white;
}

.btn-detail-primary:hover{
    background:#ff7f00;
    color:white;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width:768px){

    .detail-title{
        font-size:24px;
    }

    .detail-card-body{
        padding:20px;
    }

}

</style>


<!-- =====================================================
     HEADER
===================================================== -->

<div class="detail-header">

    <h2 class="detail-title">
        Detail Pengajuan Tiket
    </h2>

    <p class="detail-subtitle">
        Informasi lengkap pengajuan tiket layanan Keuangan
    </p>

</div>


<!-- =====================================================
     FLASH MESSAGE
===================================================== -->

<?php if(session()->getFlashdata('success')): ?>

    <div class="alert alert-success">

        <i class="fas fa-check-circle me-2"></i>

        <?= esc(session()->getFlashdata('success')) ?>

    </div>

<?php endif; ?>


<?php if(session()->getFlashdata('error')): ?>

    <div class="alert alert-danger">

        <i class="fas fa-exclamation-circle me-2"></i>

        <?= esc(session()->getFlashdata('error')) ?>

    </div>

<?php endif; ?>


<!-- =====================================================
     CARD DETAIL
===================================================== -->

<div class="detail-card">


    <!-- =================================================
         HEADER CARD
    ================================================== -->

    <div class="detail-card-header">

        <h5>

            <i class="fas fa-ticket-alt text-primary me-2"></i>

            Informasi Tiket

        </h5>

    </div>


    <!-- =================================================
         BODY
    ================================================== -->

    <div class="detail-card-body">


        <!-- =============================================
             NOMOR TIKET
        ============================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Nomor Tiket
            </label>

            <p class="detail-value">

                <?= esc(
                    $tiket['no_tiket']
                    ?? $tiket['ticket_number']
                    ?? 'Nomor tiket belum tersedia'
                ) ?>

            </p>

        </div>


        <!-- =============================================
             TANGGAL PENGAJUAN
        ============================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Tanggal Pengajuan
            </label>

            <p class="detail-value">

                <?php if(!empty($tiket['created_at'])): ?>

                    <?= date(
                        'd-m-Y H:i:s',
                        strtotime(
                            $tiket['created_at']
                        )
                    ) ?>

                <?php else: ?>

                    Tanggal belum tersedia

                <?php endif; ?>

            </p>

        </div>


        <!-- =============================================
             NAMA PEMOHON
        ============================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Nama Pemohon
            </label>

            <p class="detail-value">

                <?= esc(
                    $tiket['nama_pemohon']
                    ?? $tiket['applicant_name']
                    ?? 'Nama pemohon belum tersedia'
                ) ?>

            </p>

        </div>


        <!-- =============================================
             NIK
        ============================================== -->

        <div class="detail-item">

            <label class="detail-label">
                NIK
            </label>

            <?php

            $nik =
                $tiket['nik']
                ?? $tiket['nim']
                ?? null;

            ?>

            <p class="detail-value">

                <?= !empty($nik)
                    ? esc($nik)
                    : 'NIK belum tersedia'
                ?>

            </p>

        </div>


        <!-- =============================================
             UNIT LAYANAN
        ============================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Unit Layanan
            </label>

            <p class="detail-value">

                <?= esc(
                    $tiket['nama_unit']
                    ?? 'Unit layanan belum tersedia'
                ) ?>

            </p>

        </div>


        <!-- =============================================
             JENIS LAYANAN
        ============================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Jenis Layanan
            </label>

            <p class="detail-value">

                <?= esc(
                    $tiket['nama_layanan']
                    ?? 'Jenis layanan belum tersedia'
                ) ?>

            </p>

        </div>


        <!-- =============================================
             DESKRIPSI
        ============================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Deskripsi Pengajuan
            </label>

            <div class="detail-box">

                <?= nl2br(
                    esc(
                        $tiket['deskripsi']
                        ?? 'Deskripsi belum tersedia'
                    )
                ) ?>

            </div>

        </div>


        <!-- =================================================
             DOKUMEN DARI PEMOHON
        ================================================== -->

        <div class="detail-section">

            <h6 class="detail-section-title">

                <i class="fas fa-file-alt text-primary me-2"></i>

                Dokumen dari Pemohon

            </h6>


            <div class="detail-item">

                <label class="detail-label">
                    File Pendukung
                </label>


                <?php

                $filePendukung =
                    $tiket['file_pendukung']
                    ?? null;

                ?>


                <?php if(!empty($filePendukung)): ?>

                    <div class="document-box">

                        <a
                            href="<?= base_url(
                                'uploads/pendukung/'
                                . $filePendukung
                            ) ?>"
                            target="_blank"
                            class="btn btn-info text-white"
                        >

                            <i class="fas fa-file me-1"></i>

                            Lihat Dokumen Pemohon

                        </a>


                        <div class="mt-2">

                            <small class="text-muted">

                                <?= esc(
                                    $filePendukung
                                ) ?>

                            </small>

                        </div>

                    </div>


                <?php else: ?>

                    <p class="text-muted">

                        <i class="fas fa-info-circle me-1"></i>

                        Pemohon belum mengupload file.

                    </p>

                <?php endif; ?>

            </div>

        </div>


        <!-- =================================================
             STATUS TIKET
        ================================================== -->

        <div class="detail-section">

            <h6 class="detail-section-title">

                <i class="fas fa-chart-line text-primary me-2"></i>

                Status Tiket

            </h6>


            <div class="detail-item">

                <label class="detail-label">
                    Status
                </label>


                <p>

                <?php

                /*
                |--------------------------------------------------------------------------
                | NORMALISASI STATUS
                |--------------------------------------------------------------------------
                */

                $statusDatabase = strtolower(
                    trim(
                        (string)(
                            $tiket['status']
                            ?? ''
                        )
                    )
                );


                switch($statusDatabase){

                    case 'draft':
                    case 'submitted':
                    case 'revision':
                    case 'menunggu':

                        $statusLabel =
                            'Menunggu';

                        $statusClass =
                            'bg-secondary';

                        break;


                    case 'verification':
                    case 'processing':
                    case 'in_progress':
                    case 'diproses':

                        $statusLabel =
                            'Diproses';

                        $statusClass =
                            'bg-warning text-dark';

                        break;


                    case 'completed':
                    case 'complete':
                    case 'selesai':

                        $statusLabel =
                            'Selesai';

                        $statusClass =
                            'bg-success';

                        break;


                    case 'rejected':
                    case 'ditolak':

                        $statusLabel =
                            'Ditolak';

                        $statusClass =
                            'bg-danger';

                        break;


                    case 'cancelled':
                    case 'canceled':
                    case 'dibatalkan':

                        $statusLabel =
                            'Dibatalkan';

                        $statusClass =
                            'bg-dark';

                        break;


                    default:

                        $statusLabel =
                            'Menunggu';

                        $statusClass =
                            'bg-secondary';

                        break;

                }

                ?>


                <span class="badge <?= $statusClass ?>">

                    <?= esc($statusLabel) ?>

                </span>


                </p>

            </div>

        </div>


        <!-- =================================================
             HASIL PENANGANAN
        ================================================== -->

        <div class="detail-section">

            <h6 class="detail-section-title">

                <i class="fas fa-tasks text-primary me-2"></i>

                Hasil Penanganan

            </h6>


            <!-- =============================================
                 CATATAN PETUGAS
            ============================================== -->

            <div class="detail-item">

                <label class="detail-label">
                    Catatan Petugas Layanan
                </label>


                <?php

                $catatan =
                    $tiket['catatan']
                    ?? $tiket['admin_note']
                    ?? '';

                ?>


                <div class="detail-box">

                    <?php if(
                        !empty(
                            trim(
                                (string)$catatan
                            )
                        )
                    ): ?>

                        <?= nl2br(
                            esc($catatan)
                        ) ?>

                    <?php else: ?>

                        <span class="text-muted">

                            Belum ada catatan

                        </span>

                    <?php endif; ?>

                </div>

            </div>


            <!-- =============================================
                 DOKUMEN HASIL
            ============================================== -->

            <div class="detail-item">

                <label class="detail-label">
                    Dokumen Hasil
                </label>


                <?php

                $files =
                    $tiket['dokumen_hasil']
                    ?? [];

                ?>


                <?php if(
                    !empty($files)
                    &&
                    is_array($files)
                ): ?>


                    <div class="document-box">


                        <?php foreach(
                            $files
                            as $file
                        ): ?>


                            <?php if(
                                !empty(
                                    $file['nama_file']
                                )
                            ): ?>


                                <a
                                    href="<?= base_url(
                                        'uploads/hasil/'
                                        . $file['nama_file']
                                    ) ?>"
                                    target="_blank"
                                    class="btn btn-success document-link me-2"
                                >

                                    <i class="fas fa-file"></i>

                                    <?= esc(
                                        $file['nama_asli']
                                        ?? $file['nama_file']
                                    ) ?>

                                </a>


                            <?php endif; ?>


                        <?php endforeach; ?>


                    </div>


                <?php else: ?>

                    <p class="text-muted">

                        <i class="fas fa-info-circle me-1"></i>

                        Belum ada dokumen hasil.

                    </p>

                <?php endif; ?>

            </div>

        </div>


        <!-- =================================================
             STATUS PENGIRIMAN
        ================================================== -->

        <div class="detail-section">

            <h6 class="detail-section-title">

                <i class="fas fa-paper-plane text-primary me-2"></i>

                Status Pengiriman

            </h6>


            <div class="row g-3">


                <!-- =========================================
                     PETUGAS ULT
                ========================================== -->

                <div class="col-md-6">

                    <div class="send-card">

                        <label>

                            <i class="fas fa-user-tie me-2"></i>

                            Petugas ULT

                        </label>


                        <div class="send-status">


                            <?php if(
                                (int)(
                                    $tiket['sent_to_ult']
                                    ?? 0
                                ) === 1
                            ): ?>


                                <span class="badge bg-success">

                                    ✓ Sudah Dikirim

                                </span>


                                <?php if(
                                    !empty(
                                        $tiket[
                                            'sent_to_ult_at'
                                        ]
                                    )
                                ): ?>


                                    <div class="text-muted small mt-2">

                                        Dikirim pada:

                                        <?= date(
                                            'd-m-Y H:i',
                                            strtotime(
                                                $tiket[
                                                    'sent_to_ult_at'
                                                ]
                                            )
                                        ) ?>

                                    </div>


                                <?php endif; ?>


                            <?php else: ?>


                                <span class="badge bg-warning text-dark">

                                    Belum Dikirim

                                </span>


                            <?php endif; ?>


                        </div>

                    </div>

                </div>


                <!-- =========================================
                     PEMOHON
                ========================================== -->

                <div class="col-md-6">

                    <div class="send-card">

                        <label>

                            <i class="fas fa-user me-2"></i>

                            Pemohon

                        </label>


                        <div class="send-status">


                            <?php if(
                                (int)(
                                    $tiket[
                                        'sent_to_applicant'
                                    ]
                                    ?? 0
                                ) === 1
                            ): ?>


                                <span class="badge bg-success">

                                    ✓ Sudah Dikirim

                                </span>


                                <?php if(
                                    !empty(
                                        $tiket[
                                            'sent_to_applicant_at'
                                        ]
                                    )
                                ): ?>


                                    <div class="text-muted small mt-2">

                                        Dikirim pada:

                                        <?= date(
                                            'd-m-Y H:i',
                                            strtotime(
                                                $tiket[
                                                    'sent_to_applicant_at'
                                                ]
                                            )
                                        ) ?>

                                    </div>


                                <?php endif; ?>


                            <?php else: ?>


                                <span class="badge bg-warning text-dark">

                                    Belum Dikirim

                                </span>


                            <?php endif; ?>


                        </div>

                    </div>

                </div>


            </div>

        </div>


        <!-- =================================================
             TOMBOL AKSI
        ================================================== -->

        <div class="detail-actions">


            <!-- =============================================
                 PROSES TIKET
            ============================================== -->

            <a
                href="<?= base_url(
                    'keuangan/proses/'
                    . $tiket['id']
                ) ?>"
                class="btn btn-detail-primary"
            >

                <i class="fas fa-cogs me-1"></i>

                Proses Tiket

            </a>


            <?php

            /*
            |--------------------------------------------------------------------------
            | CEK STATUS SELESAI
            |--------------------------------------------------------------------------
            */

            $statusBisaKirim =
                in_array(
                    $statusDatabase,
                    [
                        'completed',
                        'complete',
                        'selesai'
                    ],
                    true
                );

            ?>


            <?php if($statusBisaKirim): ?>


                <!-- =========================================
                     KIRIM KE PETUGAS ULT
                ========================================== -->

                <?php if(
                    (int)(
                        $tiket['sent_to_ult']
                        ?? 0
                    ) === 1
                ): ?>


                    <!--
                    =================================================
                    TIKET SUDAH PERNAH DIKIRIM
                    TETAP BISA DIKIRIM LAGI
                    =================================================
                    -->

                    <a
                        href="<?= base_url(
                            'keuangan/kirim/'
                            . $tiket['id']
                        ) ?>"
                        class="btn btn-warning"
                        onclick="return confirm(
                            'Apakah Anda yakin ingin mengirim ulang tiket ini ke Petugas ULT?\n\nTiket ini sebelumnya sudah pernah dikirim. Pastikan proses tiket dan dokumen hasil sudah benar.'
                        )"
                    >

                        <i class="fas fa-paper-plane me-1"></i>

                        Kirim Lagi ke Petugas ULT

                    </a>


                <?php else: ?>


                    <!--
                    =================================================
                    TIKET BELUM PERNAH DIKIRIM
                    =================================================
                    -->

                    <a
                        href="<?= base_url(
                            'keuangan/kirim/'
                            . $tiket['id']
                        ) ?>"
                        class="btn btn-warning"
                        onclick="return confirm(
                            'Apakah Anda yakin ingin mengirim tiket ini ke Petugas ULT?\n\nPastikan proses tiket dan dokumen hasil sudah benar.'
                        )"
                    >

                        <i class="fas fa-paper-plane me-1"></i>

                        Kirim ke Petugas ULT

                    </a>


                <?php endif; ?>


                <!-- =========================================
                     KIRIM KE PEMOHON
                ========================================== -->

                <?php if(
                    (int)(
                        $tiket[
                            'sent_to_applicant'
                        ]
                        ?? 0
                    ) === 1
                ): ?>


                    <!--
                    =================================================
                    TIKET SUDAH PERNAH DIKIRIM
                    TETAP BISA DIKIRIM LAGI
                    =================================================
                    -->

                    <a
                        href="<?= base_url(
                            'keuangan/kirim-pemohon/'
                            . $tiket['id']
                        ) ?>"
                        class="btn btn-success"
                        onclick="return confirm(
                            'Apakah Anda yakin ingin mengirim ulang tiket ini ke Pemohon?\n\nTiket ini sebelumnya sudah pernah dikirim. Pastikan dokumen hasil yang dikirim sudah benar.'
                        )"
                    >

                        <i class="fas fa-paper-plane me-1"></i>

                        Kirim Lagi ke Pemohon

                    </a>


                <?php else: ?>


                    <!--
                    =================================================
                    TIKET BELUM PERNAH DIKIRIM
                    =================================================
                    -->

                    <a
                        href="<?= base_url(
                            'keuangan/kirim-pemohon/'
                            . $tiket['id']
                        ) ?>"
                        class="btn btn-success"
                        onclick="return confirm(
                            'Apakah Anda yakin ingin mengirim tiket ini ke Pemohon?\n\nPastikan dokumen hasil yang dikirim sudah benar.'
                        )"
                    >

                        <i class="fas fa-paper-plane me-1"></i>

                        Kirim ke Pemohon

                    </a>


                <?php endif; ?>


            <?php endif; ?>


            <!-- =========================================
                 KEMBALI KE DASHBOARD KEUANGAN
            ========================================== -->

            <a
                href="<?= base_url(
                    'keuangan'
                ) ?>"
                class="btn btn-secondary"
            >

                <i class="fas fa-arrow-left me-1"></i>

                Kembali

            </a>


        </div>


    </div>

</div>


<?= $this->endSection() ?>
