<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
$tiket = is_array($tiket ?? null)
    ? $tiket
    : ($ticket ?? []);
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
        Detail Pengajuan Tiket
    </h2>

    <p class="detail-subtitle">
        Informasi lengkap mengenai pengajuan tiket layanan UPT Teknologi Informasi dan Komunikasi
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

    <!-- HEADER CARD -->

    <div class="detail-card-header">

        <h5>

            <i class="fas fa-ticket-alt text-primary me-2"></i>

            Informasi Tiket UPT TIK

        </h5>

    </div>


    <!-- BODY CARD -->

    <div class="detail-card-body">


        <!-- =================================================
             INFORMASI TIKET
             SATU KOLOM SEPERTI AKADEMIK
        ================================================== -->


        <!-- NOMOR TIKET -->

        <div class="detail-item">

            <label class="detail-label">
                Nomor Tiket
            </label>

            <p class="detail-value">

                <?= esc(
                    $tiket['ticket_number']
                    ?? $tiket['no_tiket']
                    ?? 'Nomor tiket belum tersedia'
                ) ?>

            </p>

        </div>


        <!-- TANGGAL -->

        <div class="detail-item">

            <label class="detail-label">
                Tanggal Pengajuan
            </label>

            <p class="detail-value">

                <?php if (!empty($tiket['created_at'])): ?>

                    <?= date(
                        'd-m-Y H:i:s',
                        strtotime($tiket['created_at'])
                    ) ?>

                <?php else: ?>

                    Tanggal belum tersedia

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
                    $tiket['applicant_name']
                    ?? $tiket['nama_pemohon']
                    ?? 'Nama pemohon belum tersedia'
                ) ?>

            </p>

        </div>


        <!-- NIK / IDENTITAS -->

        <div class="detail-item">

            <label class="detail-label">
                NIK / Identitas
            </label>

            <?php
            $identitas =
                $tiket['applicant_identifier']
                ?? $tiket['identity_number']
                ?? $tiket['nik']
                ?? $tiket['nim']
                ?? null;
            ?>

            <p class="detail-value">

                <?= !empty($identitas)
                    ? esc($identitas)
                    : 'Identitas belum tersedia'
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
                    $tiket['unit_name']
                    ?? $tiket['nama_unit']
                    ?? 'UPT TIK'
                ) ?>

            </p>

        </div>


        <!-- KATEGORI -->

        <div class="detail-item">

            <label class="detail-label">
                Kategori Layanan
            </label>

            <p class="detail-value">

                <?= esc(
                    $tiket['category_name']
                    ?? $tiket['nama_kategori']
                    ?? 'Kategori belum tersedia'
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
                    $tiket['service_name']
                    ?? $tiket['nama_layanan']
                    ?? 'Jenis layanan belum tersedia'
                ) ?>

            </p>

        </div>


        <!-- JUDUL PENGAJUAN -->

        <div class="detail-item">

            <label class="detail-label">
                Judul Pengajuan
            </label>

            <p class="detail-value">

                <?= esc(
                    $tiket['title']
                    ?? $tiket['judul']
                    ?? 'Judul belum tersedia'
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
                        $tiket['description']
                        ?? $tiket['deskripsi']
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
                    $tiket['supporting_file']
                    ?? $tiket['file_pendukung']
                    ?? null;

                ?>


                <?php if (!empty($filePendukung)): ?>

                    <a
                        href="<?= base_url(
                            'uploads/pendukung/' . rawurlencode($filePendukung)
                        ) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn btn-info text-white file-btn"
                    >

                        <i class="fas fa-file me-1"></i>

                        <?= esc($filePendukung) ?>

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

            $statusDatabase = strtolower(
                trim(
                    (string) (
                        $tiket['status']
                        ?? ''
                    )
                )
            );


            switch ($statusDatabase) {

                case 'draft':
                case 'submitted':
                case 'menunggu':
                case 'pending':

                    $statusLabel = 'Menunggu';
                    $statusClass = 'bg-secondary';

                    break;


                case 'verification':
                case 'processing':
                case 'in_progress':
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


            <!-- CATATAN -->

            <div class="detail-item">

                <label class="detail-label">
                    Catatan Petugas UPT TIK
                </label>


                <?php

                $catatan =
                    $tiket['admin_note']
                    ?? $tiket['catatan']
                    ?? $tiket['processing_note']
                    ?? '';

                ?>


                <div class="detail-box">

                    <?php if (
                        !empty(
                            trim(
                                (string) $catatan
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

            <div class="detail-section">

                <h6 class="detail-section-title">

                    <i class="fas fa-file-upload text-primary me-2"></i>

                    Hasil Layanan

                </h6>


                <?php

                $hasilLayanan =
                    $tiket['result_file']
                    ?? $tiket['dokumen_hasil']
                    ?? $tiket['result_documents']
                    ?? [];


                /*
                 * Jika database menyimpan JSON,
                 * ubah menjadi array.
                 */

                if (is_string($hasilLayanan)) {

                    $decoded = json_decode(
                        $hasilLayanan,
                        true
                    );

                    if (is_array($decoded)) {

                        $hasilLayanan = $decoded;

                    } else {

                        $hasilLayanan = [
                            $hasilLayanan
                        ];

                    }

                }

                ?>


                <?php if (
                    !empty($hasilLayanan)
                    && is_array($hasilLayanan)
                ): ?>

                    <div class="list-group">


                        <?php foreach (
                            $hasilLayanan as $file
                        ): ?>


                            <?php

                            if (is_array($file)) {

                                $namaFile = trim(
                                    (string) (
                                        $file['file_name']
                                        ?? $file['nama_file']
                                        ?? ''
                                    )
                                );

                                $namaAsli =
                                    $file['original_name']
                                    ?? $file['nama_asli']
                                    ?? $namaFile;

                            } else {

                                $namaFile = trim(
                                    (string) $file
                                );

                                $namaAsli = $namaFile;

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

                                    <i class="fas fa-file-alt text-primary"></i>

                                    <span>

                                        <?= esc(
                                            $namaAsli
                                        ) ?>

                                    </span>

                                </div>


                                <div
                                    class="d-flex flex-wrap gap-2"
                                >


                                    <!-- LIHAT FILE UPT TIK -->

                                    <a
                                        href="<?= base_url(
                                            'upt-tik/lihat/' . rawurlencode($namaFile)
                                        ) ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="btn btn-sm btn-outline-primary"
                                    >

                                        <i class="fas fa-eye me-1"></i>

                                        Lihat

                                    </a>


                                    <!-- DOWNLOAD FILE UPT TIK -->

                                    <a
                                        href="<?= base_url(
                                            'upt-tik/download/' . rawurlencode($namaFile)
                                        ) ?>"
                                        class="btn btn-sm btn-outline-success"
                                    >

                                        <i class="fas fa-download me-1"></i>

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


                <!-- PETUGAS ULT -->

                <div class="col-md-6">

                    <div class="status-box h-100">

                        <div class="status-title">

                            <i class="fas fa-user-tie me-2"></i>

                            Petugas ULT

                        </div>


                        <?php if (
                            (int) (
                                $tiket['sent_to_ult']
                                ?? 0
                            ) === 1
                        ): ?>

                            <span class="badge bg-success">

                                <i class="fas fa-check me-1"></i>

                                Sudah Dikirim

                            </span>


                            <?php if (
                                !empty(
                                    $tiket['sent_to_ult_at']
                                    ?? null
                                )
                            ): ?>

                                <div class="text-muted small mt-2">

                                    Dikirim pada:

                                    <?= date(
                                        'd-m-Y H:i',
                                        strtotime(
                                            $tiket['sent_to_ult_at']
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

                            <i class="fas fa-user me-2"></i>

                            Pemohon

                        </div>


                        <?php if (
                            (int) (
                                $tiket['sent_to_applicant']
                                ?? 0
                            ) === 1
                        ): ?>

                            <span class="badge bg-success">

                                <i class="fas fa-check me-1"></i>

                                Sudah Dikirim

                            </span>


                            <?php if (
                                !empty(
                                    $tiket['sent_to_applicant_at']
                                    ?? null
                                )
                            ): ?>

                                <div class="text-muted small mt-2">

                                    Dikirim pada:

                                    <?= date(
                                        'd-m-Y H:i',
                                        strtotime(
                                            $tiket['sent_to_applicant_at']
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


            <?php

            $idTiket = (int) (
                $tiket['id']
                ?? $tiket['tiket_id']
                ?? 0
            );

            ?>


            <!-- =================================================
                 PROSES TIKET UPT TIK
            ================================================== -->

            <?php if ($idTiket > 0): ?>

                <a
                    href="<?= base_url(
                        'upt-tik/proses/' . $idTiket
                    ) ?>"
                    class="btn btn-primary-custom"
                >

                    <i class="fas fa-cogs me-1"></i>

                    Proses Tiket

                </a>

            <?php else: ?>

                <button
                    type="button"
                    class="btn btn-secondary"
                    disabled
                >

                    <i class="fas fa-cogs me-1"></i>

                    Proses Tiket

                </button>

            <?php endif; ?>


            <!-- =================================================
                 KIRIM KE PETUGAS ULT
            ================================================== -->

            <?php

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


            <?php if ($statusBisaKirim): ?>


                <?php if ($idTiket > 0): ?>

                    <a
                        href="<?= base_url(
                            'upt-tik/kirim/' . $idTiket
                        ) ?>"
                        class="btn btn-warning"
                        onclick="return confirm(
                            'Apakah Anda yakin ingin mengirim tiket ini ke Petugas ULT?'
                        )"
                    >

                        <i class="fas fa-paper-plane me-1"></i>

                        <?= (
                            (int) (
                                $tiket['sent_to_ult']
                                ?? 0
                            ) === 1
                        )
                            ? 'Kirim Lagi ke Petugas ULT'
                            : 'Kirim ke Petugas ULT'
                        ?>

                    </a>

                <?php endif; ?>


                <!-- =================================================
                     KIRIM KE PEMOHON
                ================================================== -->

                <?php if ($idTiket > 0): ?>

                    <a
                        href="<?= base_url(
                            'upt-tik/kirim-pemohon/' . $idTiket
                        ) ?>"
                        class="btn btn-success"
                        onclick="return confirm(
                            'Apakah Anda yakin ingin mengirim tiket ini ke Pemohon?'
                        )"
                    >

                        <i class="fas fa-paper-plane me-1"></i>

                        <?= (
                            (int) (
                                $tiket['sent_to_applicant']
                                ?? 0
                            ) === 1
                        )
                            ? 'Kirim Lagi ke Pemohon'
                            : 'Kirim ke Pemohon'
                        ?>

                    </a>

                <?php endif; ?>


            <?php endif; ?>


            <!-- =================================================
                 KEMBALI
            ================================================== -->

            <a
                href="<?= base_url(
                    'upt-tik/data-tiket'
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