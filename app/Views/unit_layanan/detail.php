<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>

/* =====================================================
   DETAIL TIKET
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
   CARD DETAIL
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
   INFORMASI
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
    font-size:15px;
    margin:0;
}


/* =====================================================
   DESKRIPSI / CATATAN
===================================================== */

.detail-box{
    border:1px solid #dee2e6;
    border-radius:10px;
    padding:15px;
    background:#f8f9fa;
    line-height:1.6;
}


/* =====================================================
   SECTION
===================================================== */

.detail-section{
    margin-top:30px;
    padding-top:25px;
    border-top:1px solid #e5e5e5;
}

.detail-section-title{
    font-size:18px;
    font-weight:700;
    color:#172033;
    margin-bottom:20px;
}


/* =====================================================
   FILE BUTTON
===================================================== */

.file-btn{
    border-radius:10px;
    margin-top:5px;
    margin-right:8px;
    margin-bottom:5px;
}


/* =====================================================
   STATUS
===================================================== */

.status-box{
    border:1px solid #e5e5e5;
    border-radius:12px;
    padding:18px;
    background:#fff;
}

.status-title{
    color:#293582;
    font-weight:700;
    margin-bottom:10px;
}


/* =====================================================
   TOMBOL
===================================================== */

.detail-actions{
    margin-top:30px;
    padding-top:25px;
    border-top:1px solid #e5e5e5;
}

.detail-actions .btn{
    border-radius:10px;
    padding:9px 18px;
    margin-right:8px;
    margin-bottom:8px;
}

.btn-primary-custom{
    background:#293582;
    border:none;
    color:#fff;
}

.btn-primary-custom:hover{
    background:#ff7f00;
    color:#fff;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width:768px){

    .content{
        padding:20px;
    }

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
        Informasi lengkap mengenai pengajuan tiket layanan
    </p>

</div>


<!-- =====================================================
     FLASH MESSAGE
===================================================== -->

<?php if(session()->getFlashdata('success')): ?>

    <div class="alert alert-success alert-dismissible fade show">

        <i class="fas fa-check-circle me-2"></i>

        <?= esc(session()->getFlashdata('success')) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

<?php endif; ?>


<?php if(session()->getFlashdata('error')): ?>

    <div class="alert alert-danger alert-dismissible fade show">

        <i class="fas fa-exclamation-circle me-2"></i>

        <?= esc(session()->getFlashdata('error')) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

<?php endif; ?>


<!-- =====================================================
     CARD UTAMA
===================================================== -->

<div class="detail-card">

    <div class="detail-card-header">

        <h5>

            <i class="fas fa-ticket-alt text-primary me-2"></i>

            Informasi Tiket

        </h5>

    </div>


    <div class="detail-card-body">


        <!-- NOMOR TIKET -->

        <div class="detail-item">

            <label class="detail-label">
                Nomor Tiket
            </label>

            <p class="detail-value fw-bold">

                <?= esc(
                    $tiket['no_tiket']
                    ?? '-'
                ) ?>

            </p>

        </div>


        <!-- TANGGAL PENGAJUAN -->

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

                    -

                <?php endif; ?>

            </p>

        </div>


        <!-- NAMA PEMOHON -->

        <div class="detail-item">

            <label class="detail-label">
                Nama Pemohon
            </label>

            <p class="detail-value">

                <?= esc(
                    $tiket['nama_pemohon']
                    ?? '-'
                ) ?>

            </p>

        </div>


        <!-- NIK -->

        <div class="detail-item">

            <label class="detail-label">
                NIK
            </label>

            <p class="detail-value">

                <?php

                $nik =
                    $tiket['nik']
                    ?? $tiket['nim']
                    ?? null;

                ?>

                <?= !empty($nik)
                    ? esc($nik)
                    : 'NIK belum tersedia'
                ?>

            </p>

        </div>


        <!-- UNIT LAYANAN -->

        <div class="detail-item">

            <label class="detail-label">
                Unit Layanan
            </label>

            <p class="detail-value">

                <?= esc(
                    $tiket['nama_unit']
                    ?? '-'
                ) ?>

            </p>

        </div>


        <!-- JENIS LAYANAN -->

        <div class="detail-item">

            <label class="detail-label">
                Jenis Layanan
            </label>

            <p class="detail-value">

                <?= esc(
                    $tiket['nama_layanan']
                    ?? '-'
                ) ?>

            </p>

        </div>


        <!-- DESKRIPSI -->

        <div class="detail-item">

            <label class="detail-label">
                Deskripsi Pengajuan
            </label>

            <div class="detail-box">

                <?= nl2br(
                    esc(
                        $tiket['deskripsi']
                        ?? '-'
                    )
                ) ?>

            </div>

        </div>


        <!-- =================================================
             DOKUMEN DARI PEMOHON
        ================================================== -->

        <div class="detail-section">

            <h5 class="detail-section-title">

                <i class="fas fa-file-alt text-primary me-2"></i>

                Dokumen dari Pemohon

            </h5>


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

                    <div>

                        <a
                            href="<?= base_url(
                                'uploads/pendukung/'
                                . $filePendukung
                            ) ?>"
                            target="_blank"
                            class="btn btn-info text-white file-btn"
                        >

                            <i class="fas fa-file me-1"></i>

                            <?= esc(
                                $filePendukung
                            ) ?>

                        </a>

                    </div>

                <?php else: ?>

                    <p class="text-muted mb-0">

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

            <h5 class="detail-section-title">

                <i class="fas fa-tasks text-primary me-2"></i>

                Status Tiket

            </h5>


            <div class="status-box">

                <div class="status-title">
                    Status
                </div>


                <?php

                $status =
                    $tiket['status']
                    ?? 'Menunggu';

                ?>


                <?php if($status === 'Selesai'): ?>

                    <span class="badge bg-success">

                        <i class="fas fa-check-circle me-1"></i>

                        Selesai

                    </span>


                <?php elseif($status === 'Diproses'): ?>

                    <span class="badge bg-warning text-dark">

                        <i class="fas fa-spinner me-1"></i>

                        Diproses

                    </span>


                <?php elseif($status === 'Ditolak'): ?>

                    <span class="badge bg-danger">

                        <i class="fas fa-times-circle me-1"></i>

                        Ditolak

                    </span>


                <?php elseif($status === 'Verifikasi'): ?>

                    <span class="badge bg-info">

                        <i class="fas fa-search me-1"></i>

                        Verifikasi

                    </span>

                <?php else: ?>

                    <span class="badge bg-secondary">

                        <i class="fas fa-clock me-1"></i>

                        <?= esc(
                            $status
                        ) ?>

                    </span>

                <?php endif; ?>


            </div>

        </div>


        <!-- =================================================
             HASIL PENANGANAN
        ================================================== -->

        <div class="detail-section">

            <h5 class="detail-section-title">

                <i class="fas fa-clipboard-check text-primary me-2"></i>

                Hasil Penanganan

            </h5>


            <!-- CATATAN -->

            <div class="detail-item">

                <label class="detail-label">
                    Catatan Petugas Layanan
                </label>

                <div class="detail-box">

                    <?= nl2br(
                        esc(
                            !empty(
                                $tiket['catatan']
                            )
                                ? $tiket['catatan']
                                : 'Belum ada catatan'
                        )
                    ) ?>

                </div>

            </div>

        </div>


        <!-- =================================================
             STATUS PENGIRIMAN
        ================================================== -->

        <div class="detail-section">

            <h5 class="detail-section-title">

                <i class="fas fa-paper-plane text-primary me-2"></i>

                Status Pengiriman

            </h5>


            <div class="row g-3">


                <!-- PETUGAS ULT -->

                <div class="col-md-6">

                    <div class="status-box h-100">

                        <div class="status-title">

                            <i class="fas fa-user-tie me-1"></i>

                            Petugas ULT

                        </div>


                        <?php if(
                            (int)(
                                $tiket['sent_to_ult']
                                ?? 0
                            ) === 1
                        ): ?>

                            <span class="badge bg-success">

                                <i class="fas fa-check me-1"></i>

                                Sudah Dikirim

                            </span>


                            <?php if(
                                !empty(
                                    $tiket['sent_to_ult_at']
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

                                <i class="fas fa-clock me-1"></i>

                                Belum Dikirim

                            </span>

                        <?php endif; ?>

                    </div>

                </div>


                <!-- PEMOHON -->

                <div class="col-md-6">

                    <div class="status-box h-100">

                        <div class="status-title">

                            <i class="fas fa-user me-1"></i>

                            Pemohon

                        </div>


                        <?php if(
                            (int)(
                                $tiket[
                                    'sent_to_applicant'
                                ]
                                ?? 0
                            ) === 1
                        ): ?>

                            <span class="badge bg-success">

                                <i class="fas fa-check me-1"></i>

                                Sudah Dikirim

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

                                <i class="fas fa-clock me-1"></i>

                                Belum Dikirim

                            </span>

                        <?php endif; ?>

                    </div>

                </div>


            </div>

        </div>


        <!-- =================================================
             TOMBOL AKSI
        ================================================== -->

        <div class="detail-actions">


            <!-- PROSES TIKET -->

            <a
                href="<?= base_url(
                    'unit-layanan/proses/'
                    . $tiket['id']
                ) ?>"
                class="btn btn-primary-custom"
            >

                <i class="fas fa-cogs me-1"></i>

                Proses Tiket

            </a>


            <?php if(
                ($tiket['status'] ?? '')
                === 'Selesai'
            ): ?>


                <!-- KIRIM KE PETUGAS ULT -->

                <?php if(
                    (int)(
                        $tiket['sent_to_ult']
                        ?? 0
                    ) === 1
                ): ?>

                    <a
                        href="<?= base_url(
                            'unit-layanan/kirim/'
                            . $tiket['id']
                        ) ?>"
                        class="btn btn-warning"
                        onclick="return confirm(
                            'Apakah Anda yakin ingin mengirim ulang tiket ini ke Petugas ULT?\n\nTiket ini sebelumnya sudah pernah dikirim.'
                        )"
                    >

                        <i class="fas fa-paper-plane me-1"></i>

                        Kirim Lagi ke Petugas ULT

                    </a>

                <?php else: ?>

                    <a
                        href="<?= base_url(
                            'unit-layanan/kirim/'
                            . $tiket['id']
                        ) ?>"
                        class="btn btn-warning"
                        onclick="return confirm(
                            'Apakah Anda yakin ingin mengirim tiket ini ke Petugas ULT?\n\nPastikan proses tiket sudah benar.'
                        )"
                    >

                        <i class="fas fa-paper-plane me-1"></i>

                        Kirim ke Petugas ULT

                    </a>

                <?php endif; ?>


                <!-- KIRIM KE PEMOHON -->

                <?php if(
                    (int)(
                        $tiket[
                            'sent_to_applicant'
                        ]
                        ?? 0
                    ) === 1
                ): ?>

                    <a
                        href="<?= base_url(
                            'unit-layanan/kirim-pemohon/'
                            . $tiket['id']
                        ) ?>"
                        class="btn btn-success"
                        onclick="return confirm(
                            'Apakah Anda yakin ingin mengirim ulang tiket ini ke Pemohon?\n\nTiket ini sebelumnya sudah pernah dikirim.'
                        )"
                    >

                        <i class="fas fa-paper-plane me-1"></i>

                        Kirim Lagi ke Pemohon

                    </a>

                <?php else: ?>

                    <a
                        href="<?= base_url(
                            'unit-layanan/kirim-pemohon/'
                            . $tiket['id']
                        ) ?>"
                        class="btn btn-success"
                        onclick="return confirm(
                            'Apakah Anda yakin ingin mengirim tiket ini ke Pemohon?\n\nPastikan proses tiket sudah benar.'
                        )"
                    >

                        <i class="fas fa-paper-plane me-1"></i>

                        Kirim ke Pemohon

                    </a>

                <?php endif; ?>


            <?php endif; ?>


            <!-- KEMBALI -->

            <a
                href="<?= base_url(
                    'unit-layanan/data-tiket'
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
