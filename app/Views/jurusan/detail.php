<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
$ticket = $ticket ?? $tiket ?? [];

/*
|--------------------------------------------------------------------------
| DATA TIKET JURUSAN
|--------------------------------------------------------------------------
*/

$id = (int) ($ticket['id'] ?? 0);

$statusDatabase = strtolower(
    trim((string) ($ticket['status'] ?? ''))
);

$statusBisaKirim = in_array(
    $statusDatabase,
    [
        'completed',
        'complete',
        'selesai'
    ],
    true
);
?>

<style>

/* =====================================================
   HEADER
===================================================== */

.detail-header {
    margin-bottom: 25px;
}

.detail-title {
    font-size: 30px;
    font-weight: 700;
    color: #172033;
}

.detail-subtitle {
    color: #6c757d;
    margin-top: 5px;
}


/* =====================================================
   CARD
===================================================== */

.detail-card {
    background: #fff;
    border: none;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
    overflow: hidden;
}

.detail-card-header {
    padding: 22px 28px;
    border-bottom: 1px solid #eee;
    background: #fff;
}

.detail-card-header h5 {
    margin: 0;
    font-size: 20px;
    font-weight: 700;
    color: #172033;
}

.detail-card-body {
    padding: 28px;
}


/* =====================================================
   DETAIL ITEM
===================================================== */

.detail-item {
    margin-bottom: 20px;
}

.detail-label {
    display: block;
    color: #293582;
    font-weight: 700;
    margin-bottom: 6px;
    font-size: 15px;
}

.detail-value {
    color: #212529;
    margin: 0;
    font-size: 15px;
}


/* =====================================================
   DESCRIPTION BOX
===================================================== */

.detail-box {
    border: 1px solid #dee2e6;
    border-radius: 10px;
    padding: 15px;
    background: #f8f9fa;
    line-height: 1.7;
}


/* =====================================================
   SECTION
===================================================== */

.detail-section {
    margin-top: 30px;
    padding-top: 25px;
    border-top: 1px solid #eee;
}

.detail-section-title {
    font-size: 18px;
    font-weight: 700;
    color: #172033;
    margin-bottom: 20px;
}


/* =====================================================
   FILE BUTTON
===================================================== */

.file-btn {
    border-radius: 10px;
    margin-top: 5px;
    margin-right: 8px;
    margin-bottom: 5px;
}


/* =====================================================
   STATUS
===================================================== */

.status-box {
    border: 1px solid #e5e5e5;
    border-radius: 12px;
    padding: 18px;
    height: 100%;
    background: #fff;
}

.status-title {
    color: #293582;
    font-weight: 700;
    margin-bottom: 10px;
}


/* =====================================================
   BUTTON
===================================================== */

.detail-actions {
    margin-top: 30px;
    padding-top: 25px;
    border-top: 1px solid #eee;
}

.detail-actions .btn {
    border-radius: 10px;
    padding: 10px 18px;
    margin-right: 7px;
    margin-bottom: 8px;
}

.btn-primary-custom {
    background: #293582;
    border: none;
    color: #fff;
}

.btn-primary-custom:hover {
    background: #ff7f00;
    color: #fff;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 768px) {

    .detail-title {
        font-size: 24px;
    }

    .detail-card-body {
        padding: 20px;
    }

}

</style>


<!-- =====================================================
     HEADER
===================================================== -->

<div class="detail-header">

    <h2 class="detail-title">
        Detail Pengajuan Tiket Jurusan
    </h2>

    <p class="detail-subtitle">
        Informasi lengkap mengenai pengajuan tiket dari unit Jurusan.
    </p>

</div>


<!-- =====================================================
     FLASH MESSAGE
===================================================== -->

<?php if (session()->getFlashdata('success')): ?>

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


<?php if (session()->getFlashdata('error')): ?>

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


        <!-- =================================================
             NOMOR TIKET
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Nomor Tiket
            </label>

            <p class="detail-value">

                <?= esc(
                    $ticket['ticket_number']
                    ?? $ticket['no_tiket']
                    ?? 'Nomor tiket belum tersedia'
                ) ?>

            </p>

        </div>


        <!-- =================================================
             TANGGAL
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Tanggal Pengajuan
            </label>

            <p class="detail-value">

                <?php if (!empty($ticket['created_at'])): ?>

                    <?= date(
                        'd-m-Y H:i:s',
                        strtotime($ticket['created_at'])
                    ) ?>

                <?php else: ?>

                    Tanggal belum tersedia

                <?php endif; ?>

            </p>

        </div>


        <!-- =================================================
             NAMA PEMOHON
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Nama Pemohon
            </label>

            <p class="detail-value">

                <?= esc(
                    $ticket['applicant_name']
                    ?? $ticket['nama_pemohon']
                    ?? 'Nama pemohon belum tersedia'
                ) ?>

            </p>

        </div>


        <!-- =================================================
             NIK / IDENTITAS
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                NIK / Identitas
            </label>

            <?php

            $identitas =
                $ticket['nik']
                ?? $ticket['nim']
                ?? $ticket['identity_number']
                ?? null;

            ?>

            <p class="detail-value">

                <?= !empty($identitas)
                    ? esc($identitas)
                    : 'Identitas belum tersedia'
                ?>

            </p>

        </div>


        <!-- =================================================
             UNIT
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Unit Layanan
            </label>

            <p class="detail-value">

                <?= esc(
                    $ticket['nama_unit']
                    ?? 'Jurusan'
                ) ?>

            </p>

        </div>


        <!-- =================================================
             LAYANAN
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Jenis Layanan
            </label>

            <p class="detail-value">

                <?= esc(
                    $ticket['nama_layanan']
                    ?? 'Jenis layanan belum tersedia'
                ) ?>

            </p>

        </div>


        <!-- =================================================
             JUDUL
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Judul Pengajuan
            </label>

            <p class="detail-value">

                <?= esc(
                    $ticket['title']
                    ?? $ticket['judul']
                    ?? 'Judul belum tersedia'
                ) ?>

            </p>

        </div>


        <!-- =================================================
             DESKRIPSI
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Deskripsi Pengajuan
            </label>

            <div class="detail-box">

                <?= nl2br(
                    esc(
                        $ticket['description']
                        ?? $ticket['deskripsi']
                        ?? 'Deskripsi belum tersedia'
                    )
                ) ?>

            </div>

        </div>


        <!-- =================================================
             DOKUMEN PEMOHON
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
                    $ticket['file_pendukung']
                    ?? $ticket['supporting_file']
                    ?? null;

                ?>


                <?php if (!empty($filePendukung)): ?>

                    <a
                        href="<?= base_url(
                            'jurusan/lihat/' .
                            rawurlencode(
                                basename($filePendukung)
                            )
                        ) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn btn-info text-white file-btn"
                    >

                        <i class="fas fa-file me-1"></i>

                        <?= esc(
                            basename($filePendukung)
                        ) ?>

                    </a>

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

            <h6 class="detail-section-title">

                <i class="fas fa-chart-line text-primary me-2"></i>

                Status Tiket

            </h6>


            <?php

            switch ($statusDatabase) {

                case 'draft':
                case 'submitted':
                case 'revision':
                case 'menunggu':

                    $statusLabel = 'Menunggu';
                    $statusClass = 'bg-secondary';

                    break;


                case 'verification':
                case 'processing':
                case 'in_progress':
                case 'in progress':
                case 'diproses':

                    $statusLabel = 'Diproses';
                    $statusClass = 'bg-warning text-dark';

                    break;


                case 'completed':
                case 'complete':
                case 'selesai':

                    $statusLabel = 'Selesai';
                    $statusClass = 'bg-success';

                    break;


                case 'rejected':
                case 'ditolak':

                    $statusLabel = 'Ditolak';
                    $statusClass = 'bg-danger';

                    break;


                case 'cancelled':
                case 'canceled':
                case 'dibatalkan':

                    $statusLabel = 'Dibatalkan';
                    $statusClass = 'bg-dark';

                    break;


                default:

                    $statusLabel = 'Menunggu';
                    $statusClass = 'bg-secondary';

                    break;

            }

            ?>


            <div class="status-box">

                <div class="status-title">

                    Status

                </div>


                <span class="badge <?= $statusClass ?>">

                    <?= esc($statusLabel) ?>

                </span>

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


            <!-- =================================================
                 CATATAN
            ================================================== -->

            <div class="detail-item">

                <label class="detail-label">
                    Catatan Petugas Layanan
                </label>


                <?php

                $catatan =
                    $ticket['catatan']
                    ?? $ticket['admin_note']
                    ?? $ticket['note']
                    ?? '';

                ?>


                <div class="detail-box">

                    <?php if (
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


            <!-- =================================================
                 HASIL LAYANAN
            ================================================== -->

            <div class="detail-item">

                <label class="detail-label">
                    Dokumen Hasil Layanan
                </label>


                <?php

                $hasilLayanan = [];

                $resultFile =
                    $ticket['result_file']
                    ?? $ticket['dokumen_hasil']
                    ?? $ticket['file_hasil']
                    ?? null;


                /*
                |--------------------------------------------------------------------------
                | ARRAY
                |--------------------------------------------------------------------------
                */

                if (
                    is_array($resultFile)
                ) {

                    $hasilLayanan =
                        $resultFile;

                }


                /*
                |--------------------------------------------------------------------------
                | JSON
                |--------------------------------------------------------------------------
                */

                elseif (
                    is_string($resultFile)
                    && $resultFile !== ''
                ) {

                    $decodedResult =
                        json_decode(
                            $resultFile,
                            true
                        );


                    if (
                        is_array(
                            $decodedResult
                        )
                    ) {

                        $hasilLayanan =
                            $decodedResult;

                    } else {

                        $hasilLayanan = [
                            [
                                'nama_file' =>
                                    $resultFile,

                                'nama_asli' =>
                                    basename(
                                        $resultFile
                                    )
                            ]
                        ];

                    }

                }

                ?>


                <?php if (
                    !empty($hasilLayanan)
                ): ?>

                    <div class="list-group">

                        <?php foreach (
                            $hasilLayanan
                            as $file
                        ): ?>


                            <?php

                            if (
                                is_array($file)
                            ) {

                                $namaFile =
                                    trim(
                                        (string)(
                                            $file['nama_file']
                                            ?? $file['file_name']
                                            ?? $file['filename']
                                            ?? ''
                                        )
                                    );


                                $namaAsli =
                                    $file['nama_asli']
                                    ?? $file['original_name']
                                    ?? $namaFile;

                            } else {

                                $namaFile =
                                    trim(
                                        (string)$file
                                    );

                                $namaAsli =
                                    basename(
                                        $namaFile
                                    );

                            }

                            ?>


                            <?php if (
                                $namaFile === ''
                            ): ?>

                                <?php continue; ?>

                            <?php endif; ?>


                            <div
                                class="list-group-item d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2"
                            >


                                <div
                                    class="d-flex align-items-center gap-2 text-break"
                                >

                                    <i
                                        class="fas fa-file-alt text-primary"
                                    ></i>

                                    <span>

                                        <?= esc(
                                            $namaAsli
                                        ) ?>

                                    </span>

                                </div>


                                <div
                                    class="d-flex flex-wrap gap-2"
                                >


                                    <!-- LIHAT -->

                                    <a
                                        href="<?= base_url(
                                            'jurusan/lihat/' .
                                            rawurlencode(
                                                basename(
                                                    $namaFile
                                                )
                                            )
                                        ) ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="btn btn-sm btn-outline-primary"
                                    >

                                        <i
                                            class="fas fa-eye me-1"
                                        ></i>

                                        Lihat

                                    </a>


                                    <!-- DOWNLOAD -->

                                    <a
                                        href="<?= base_url(
                                            'jurusan/download/' .
                                            rawurlencode(
                                                basename(
                                                    $namaFile
                                                )
                                            )
                                        ) ?>"
                                        class="btn btn-sm btn-outline-success"
                                    >

                                        <i
                                            class="fas fa-download me-1"
                                        ></i>

                                        Download

                                    </a>

                                </div>

                            </div>


                        <?php endforeach; ?>

                    </div>

                <?php else: ?>

                    <p class="text-muted mb-0">

                        <i class="fas fa-info-circle me-1"></i>

                        Belum ada dokumen hasil layanan.

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


                <!-- =================================================
                     PETUGAS ULT
                ================================================== -->

                <div class="col-md-6">

                    <div class="status-box h-100">

                        <div class="status-title">

                            <i class="fas fa-user-tie me-2"></i>

                            Petugas ULT

                        </div>


                        <?php if (
                            (int)(
                                $ticket['sent_to_ult']
                                ?? 0
                            ) === 1
                        ): ?>

                            <span class="badge bg-success">

                                <i class="fas fa-check me-1"></i>

                                Sudah Dikirim

                            </span>


                            <?php if (
                                !empty(
                                    $ticket['sent_to_ult_at']
                                    ?? null
                                )
                            ): ?>

                                <div class="text-muted small mt-2">

                                    Dikirim pada:

                                    <?= date(
                                        'd-m-Y H:i',
                                        strtotime(
                                            $ticket[
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


                <!-- =================================================
                     PEMOHON
                ================================================== -->

                <div class="col-md-6">

                    <div class="status-box h-100">

                        <div class="status-title">

                            <i class="fas fa-user me-2"></i>

                            Pemohon

                        </div>


                        <?php if (
                            (int)(
                                $ticket['sent_to_applicant']
                                ?? 0
                            ) === 1
                        ): ?>

                            <span class="badge bg-success">

                                <i class="fas fa-check me-1"></i>

                                Sudah Dikirim

                            </span>


                            <?php if (
                                !empty(
                                    $ticket[
                                        'sent_to_applicant_at'
                                    ] ?? null
                                )
                            ): ?>

                                <div class="text-muted small mt-2">

                                    Dikirim pada:

                                    <?= date(
                                        'd-m-Y H:i',
                                        strtotime(
                                            $ticket[
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


            <!-- =================================================
                 PROSES TIKET JURUSAN
                 SELALU ADA
            ================================================== -->

            <?php if ($id > 0): ?>

                <a
                    href="<?= base_url(
                        'jurusan/proses/' . $id
                    ) ?>"
                    class="btn btn-primary-custom"
                >

                    <i class="fas fa-cogs me-1"></i>

                    Proses Tiket

                </a>

            <?php endif; ?>


            <!-- =================================================
                 KIRIM SETELAH SELESAI
            ================================================== -->

            <?php if ($statusBisaKirim): ?>


                <!-- =================================================
                     KIRIM KE PETUGAS ULT
                ================================================== -->

                <a
                    href="<?= base_url(
                        'jurusan/kirim/' . $id
                    ) ?>"
                    class="btn btn-warning"
                    onclick="return confirm(
                        'Apakah Anda yakin ingin mengirim tiket ini ke Petugas ULT?'
                    )"
                >

                    <i class="fas fa-paper-plane me-1"></i>

                    <?= (
                        (int)(
                            $ticket['sent_to_ult']
                            ?? 0
                        ) === 1
                    )
                        ? 'Kirim Lagi ke Petugas ULT'
                        : 'Kirim ke Petugas ULT'
                    ?>

                </a>


                <!-- =================================================
                     KIRIM KE PEMOHON
                ================================================== -->

                <a
                    href="<?= base_url(
                        'jurusan/kirim-pemohon/' . $id
                    ) ?>"
                    class="btn btn-success"
                    onclick="return confirm(
                        'Apakah Anda yakin ingin mengirim hasil tiket ini ke Pemohon?'
                    )"
                >

                    <i class="fas fa-paper-plane me-1"></i>

                    <?= (
                        (int)(
                            $ticket['sent_to_applicant']
                            ?? 0
                        ) === 1
                    )
                        ? 'Kirim Lagi ke Pemohon'
                        : 'Kirim ke Pemohon'
                    ?>

                </a>

            <?php endif; ?>


            <!-- =================================================
                 KEMBALI
            ================================================== -->

            <a
                href="<?= base_url(
                    'jurusan/data-tiket'
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