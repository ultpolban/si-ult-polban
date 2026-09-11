<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
$tiket = $tiket ?? $ticket ?? [];
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
   HASIL FILE
===================================================== */

.result-file-item {
    border: 1px solid #dee2e6;
    border-radius: 12px;
    padding: 14px 16px;
    background: #fff;
    margin-bottom: 10px;
}

.result-file-name {
    min-width: 0;
    word-break: break-word;
}

.result-file-actions {
    flex-shrink: 0;
}

.result-file-actions .btn {
    border-radius: 8px;
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

    .result-file-item {
        align-items: flex-start !important;
    }

    .result-file-actions {
        width: 100%;
    }

    .result-file-actions .btn {
        flex: 1;
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
        Informasi lengkap mengenai pengajuan tiket layanan Akademik
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
                    $tiket['no_tiket']
                    ?? $tiket['ticket_number']
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


        <!-- =================================================
             NAMA PEMOHON
        ================================================== -->

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


        <!-- =================================================
             NIK
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                NIK
            </label>

            <?php
            $nik = $tiket['nik']
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


        <!-- =================================================
             UNIT
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Unit Layanan
            </label>

            <p class="detail-value">

                <?= esc(
                    $tiket['nama_unit']
                    ?? $tiket['unit_name']
                    ?? 'Unit layanan belum tersedia'
                ) ?>

            </p>

        </div>


        <!-- =================================================
             KATEGORI
        ================================================== -->

        <?php if (
            !empty($tiket['nama_kategori'])
            || !empty($tiket['service_category'])
        ): ?>

            <div class="detail-item">

                <label class="detail-label">
                    Kategori Layanan
                </label>

                <p class="detail-value">

                    <?= esc(
                        $tiket['nama_kategori']
                        ?? $tiket['service_category']
                    ) ?>

                </p>

            </div>

        <?php endif; ?>


        <!-- =================================================
             LAYANAN
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Jenis Layanan
            </label>

            <p class="detail-value">

                <?= esc(
                    $tiket['nama_layanan']
                    ?? $tiket['service_name']
                    ?? 'Jenis layanan belum tersedia'
                ) ?>

            </p>

        </div>


        <!-- =================================================
             JUDUL
        ================================================== -->

        <?php if (
            !empty($tiket['judul'])
            || !empty($tiket['title'])
        ): ?>

            <div class="detail-item">

                <label class="detail-label">
                    Judul Pengajuan
                </label>

                <p class="detail-value">

                    <?= esc(
                        $tiket['judul']
                        ?? $tiket['title']
                    ) ?>

                </p>

            </div>

        <?php endif; ?>


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
                        $tiket['deskripsi']
                        ?? $tiket['description']
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
                    $tiket['file_pendukung']
                    ?? $tiket['supporting_file']
                    ?? null;
                ?>


                <?php if (!empty($filePendukung)): ?>

                    <?php
                    $namaFilePendukung = basename(
                        urldecode(
                            (string) $filePendukung
                        )
                    );

                    $urlFilePendukung = base_url(
                        'uploads/pendukung/' .
                        rawurlencode(
                            $namaFilePendukung
                        )
                    );
                    ?>


                    <a
                        href="<?= esc($urlFilePendukung) ?>"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn btn-info text-white file-btn"
                    >

                        <i class="fas fa-file me-1"></i>

                        <?= esc($namaFilePendukung) ?>

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
                        $tiket['status'] ?? ''
                    )
                )
            );

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

                <span class="badge <?= esc($statusClass) ?>">

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
                    $tiket['catatan']
                    ?? $tiket['admin_note']
                    ?? $tiket['result_note']
                    ?? '';
                ?>


                <div class="detail-box">

                    <?php if (
                        trim((string) $catatan) !== ''
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

                /*
                 * =================================================
                 * AMBIL DATA DOKUMEN HASIL
                 * =================================================
                 *
                 * Bisa menerima:
                 *
                 * 1. String:
                 *    "file.pdf"
                 *
                 * 2. Array:
                 *    [
                 *       [
                 *          'nama_file' => 'file.pdf',
                 *          'nama_asli' => 'surat.pdf'
                 *       ]
                 *    ]
                 *
                 * 3. JSON:
                 *    [{"nama_file":"file.pdf",...}]
                 *
                 * Kita normalisasi semuanya menjadi
                 * array file sederhana.
                 */

                $hasilLayanan =
                    $tiket['dokumen_hasil']
                    ?? $tiket['result_file']
                    ?? '';


                $daftarFile = [];


                /*
                 * -------------------------------------------------
                 * CASE 1: ARRAY
                 * -------------------------------------------------
                 */

                if (is_array($hasilLayanan)) {

                    foreach (
                        $hasilLayanan
                        as $file
                    ) {

                        /*
                         * Array file
                         */

                        if (is_array($file)) {

                            $namaFile = trim(
                                (string) (
                                    $file['nama_file']
                                    ?? $file['filename']
                                    ?? $file['file_name']
                                    ?? ''
                                )
                            );

                            $namaAsli = trim(
                                (string) (
                                    $file['nama_asli']
                                    ?? $file['original_name']
                                    ?? $namaFile
                                )
                            );

                            if ($namaFile !== '') {

                                $daftarFile[] = [
                                    'nama_file' => basename(
                                        urldecode(
                                            $namaFile
                                        )
                                    ),
                                    'nama_asli' => (
                                        $namaAsli !== ''
                                            ? $namaAsli
                                            : $namaFile
                                    ),
                                ];

                            }

                        }

                        /*
                         * Array berisi string filename
                         */

                        elseif (
                            is_string($file)
                            && trim($file) !== ''
                        ) {

                            $namaFile = basename(
                                urldecode(
                                    trim($file)
                                )
                            );

                            $daftarFile[] = [
                                'nama_file' => $namaFile,
                                'nama_asli' => $namaFile,
                            ];

                        }

                    }

                }


                /*
                 * -------------------------------------------------
                 * CASE 2: STRING
                 * -------------------------------------------------
                 */

                elseif (
                    is_string($hasilLayanan)
                    && trim($hasilLayanan) !== ''
                ) {

                    $hasilString = trim(
                        $hasilLayanan
                    );


                    /*
                     * Coba baca JSON.
                     *
                     * Ini menangani kondisi apabila
                     * database/controller masih
                     * mengirim JSON seperti:
                     *
                     * [{"nama_file":"file.pdf"}]
                     */

                    $jsonData = json_decode(
                        $hasilString,
                        true
                    );


                    if (
                        json_last_error() === JSON_ERROR_NONE
                        && is_array($jsonData)
                    ) {

                        /*
                         * JSON berupa array file
                         */

                        foreach (
                            $jsonData
                            as $file
                        ) {

                            if (!is_array($file)) {
                                continue;
                            }

                            $namaFile = trim(
                                (string) (
                                    $file['nama_file']
                                    ?? $file['filename']
                                    ?? $file['file_name']
                                    ?? ''
                                )
                            );

                            if ($namaFile === '') {
                                continue;
                            }

                            $namaAsli = trim(
                                (string) (
                                    $file['nama_asli']
                                    ?? $file['original_name']
                                    ?? $namaFile
                                )
                            );

                            $daftarFile[] = [
                                'nama_file' => basename(
                                    urldecode(
                                        $namaFile
                                    )
                                ),
                                'nama_asli' => (
                                    $namaAsli !== ''
                                        ? $namaAsli
                                        : $namaFile
                                ),
                            ];

                        }

                    } else {

                        /*
                         * String biasa = langsung filename
                         */

                        $namaFile = basename(
                            urldecode(
                                $hasilString
                            )
                        );

                        $daftarFile[] = [
                            'nama_file' => $namaFile,
                            'nama_asli' => $namaFile,
                        ];

                    }

                }


                /*
                 * Hilangkan file kosong
                 */

                $daftarFile = array_values(
                    array_filter(
                        $daftarFile,
                        static function ($file) {

                            return !empty(
                                $file['nama_file']
                            );

                        }
                    )
                );

                ?>


                <?php if (!empty($daftarFile)): ?>

                    <div class="list-group">

                        <?php foreach (
                            $daftarFile
                            as $file
                        ): ?>

                            <?php

                            $namaFile = basename(
                                (string) (
                                    $file['nama_file']
                                    ?? ''
                                )
                            );

                            $namaAsli = trim(
                                (string) (
                                    $file['nama_asli']
                                    ?? $namaFile
                                )
                            );


                            if ($namaFile === '') {
                                continue;
                            }


                            if ($namaAsli === '') {
                                $namaAsli = $namaFile;
                            }


                            /*
                             * URL HANYA menggunakan
                             * nama file.
                             *
                             * Bukan array.
                             * Bukan JSON.
                             */

                            $lihatUrl = base_url(
                                'akademik/lihat/' .
                                rawurlencode(
                                    $namaFile
                                )
                            );


                            $downloadUrl = base_url(
                                'akademik/download/' .
                                rawurlencode(
                                    $namaFile
                                )
                            );

                            ?>


                            <div
                                class="result-file-item d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3"
                            >

                                <!-- NAMA FILE -->

                                <div
                                    class="result-file-name d-flex align-items-center gap-2"
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


                                <!-- AKSI -->

                                <div
                                    class="result-file-actions d-flex flex-wrap gap-2"
                                >

                                    <a
                                        href="<?= esc($lihatUrl) ?>"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="btn btn-sm btn-outline-primary"
                                    >

                                        <i class="fas fa-eye me-1"></i>

                                        Lihat

                                    </a>


                                    <a
                                        href="<?= esc($downloadUrl) ?>"
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
                                $tiket['sent_to_ult'] ?? 0
                            ) === 1
                        ): ?>

                            <span class="badge bg-success">

                                <i class="fas fa-check me-1"></i>

                                Sudah Dikirim

                            </span>


                            <?php if (
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

                            <i class="fas fa-user me-2"></i>

                            Pemohon

                        </div>


                        <?php if (
                            (int) (
                                $tiket['sent_to_applicant'] ?? 0
                            ) === 1
                        ): ?>

                            <span class="badge bg-success">

                                <i class="fas fa-check me-1"></i>

                                Sudah Dikirim

                            </span>


                            <?php if (
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


            <!-- PROSES -->

            <a
                href="<?= base_url(
                    'akademik/proses/' .
                    (int) ($tiket['id'] ?? 0)
                ) ?>"
                class="btn btn-primary-custom"
            >

                <i class="fas fa-cogs me-1"></i>

                Proses Tiket

            </a>


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


                <!-- KIRIM ULT -->

                <a
                    href="<?= base_url(
                        'akademik/kirim/' .
                        (int) ($tiket['id'] ?? 0)
                    ) ?>"
                    class="btn btn-warning"
                    onclick="return confirm(
                        'Apakah Anda yakin ingin mengirim tiket ini ke Petugas ULT?'
                    )"
                >

                    <i class="fas fa-paper-plane me-1"></i>

                    <?= (
                        (int) (
                            $tiket['sent_to_ult'] ?? 0
                        ) === 1
                    )
                        ? 'Kirim Lagi ke Petugas ULT'
                        : 'Kirim ke Petugas ULT'
                    ?>

                </a>


                <!-- KIRIM PEMOHON -->

                <a
                    href="<?= base_url(
                        'akademik/kirim-pemohon/' .
                        (int) ($tiket['id'] ?? 0)
                    ) ?>"
                    class="btn btn-success"
                    onclick="return confirm(
                        'Apakah Anda yakin ingin mengirim tiket ini ke Pemohon?'
                    )"
                >

                    <i class="fas fa-paper-plane me-1"></i>

                    <?= (
                        (int) (
                            $tiket[
                                'sent_to_applicant'
                            ] ?? 0
                        ) === 1
                    )
                        ? 'Kirim Lagi ke Pemohon'
                        : 'Kirim ke Pemohon'
                    ?>

                </a>

            <?php endif; ?>


            <!-- KEMBALI -->

            <a
                href="<?= base_url(
                    'akademik/data-tiket'
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