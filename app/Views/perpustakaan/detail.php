<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php

/*
|--------------------------------------------------------------------------
| DATA TIKET PERPUSTAKAAN
|--------------------------------------------------------------------------
| View ini hanya menggunakan data yang dikirim oleh controller
| Perpustakaan.
|
| Tidak menggunakan:
| - Akademik
| - Keuangan
| - Kemahasiswaan
| - Jurusan
| - Administrasi Umum
| - UPT TIK
|--------------------------------------------------------------------------
*/

$tiket = $tiket ?? $ticket ?? [];

$id = (int) ($tiket['id'] ?? 0);


/*
|--------------------------------------------------------------------------
| NOMOR TIKET
|--------------------------------------------------------------------------
*/

$nomorTiket =
    $tiket['ticket_number']
    ?? $tiket['no_tiket']
    ?? 'Nomor tiket belum tersedia';


/*
|--------------------------------------------------------------------------
| TANGGAL PENGAJUAN
|--------------------------------------------------------------------------
*/

$tanggalPengajuan =
    $tiket['created_at']
    ?? $tiket['submitted_at']
    ?? null;


/*
|--------------------------------------------------------------------------
| NAMA PEMOHON
|--------------------------------------------------------------------------
*/

$namaPemohon =
    $tiket['applicant_name']
    ?? $tiket['nama_pemohon']
    ?? $tiket['user_name']
    ?? 'Nama pemohon belum tersedia';


/*
|--------------------------------------------------------------------------
| IDENTITAS
|--------------------------------------------------------------------------
*/

$identitas =
    $tiket['applicant_identifier']
    ?? $tiket['identity_number']
    ?? $tiket['nik']
    ?? $tiket['nim']
    ?? null;


/*
|--------------------------------------------------------------------------
| UNIT LAYANAN
|--------------------------------------------------------------------------
*/

$unitLayanan =
    $tiket['unit_name']
    ?? $tiket['nama_unit']
    ?? 'Perpustakaan';


/*
|--------------------------------------------------------------------------
| KATEGORI
|--------------------------------------------------------------------------
*/

$kategoriLayanan =
    $tiket['category_name']
    ?? $tiket['nama_kategori']
    ?? 'Layanan Perpustakaan';


/*
|--------------------------------------------------------------------------
| JENIS LAYANAN
|--------------------------------------------------------------------------
*/

$jenisLayanan =
    $tiket['service_name']
    ?? $tiket['nama_layanan']
    ?? 'Layanan Perpustakaan';


/*
|--------------------------------------------------------------------------
| JUDUL
|--------------------------------------------------------------------------
*/

$judulPengajuan =
    $tiket['title']
    ?? $tiket['judul']
    ?? 'Judul pengajuan belum tersedia';


/*
|--------------------------------------------------------------------------
| DESKRIPSI
|--------------------------------------------------------------------------
*/

$deskripsi =
    $tiket['description']
    ?? $tiket['deskripsi']
    ?? '';


/*
|--------------------------------------------------------------------------
| FILE PENDUKUNG
|--------------------------------------------------------------------------
*/

$filePendukung =
    $tiket['file_pendukung']
    ?? $tiket['supporting_file']
    ?? null;


/*
|--------------------------------------------------------------------------
| CATATAN
|--------------------------------------------------------------------------
*/

$catatan =
    $tiket['catatan']
    ?? $tiket['admin_note']
    ?? $tiket['processing_note']
    ?? '';


/*
|--------------------------------------------------------------------------
| HASIL LAYANAN
|--------------------------------------------------------------------------
*/

$hasilLayanan =
    $tiket['dokumen_hasil']
    ?? $tiket['result_documents']
    ?? [];


/*
|--------------------------------------------------------------------------
| STATUS TIKET
|--------------------------------------------------------------------------
*/

$statusDatabase = strtolower(
    trim(
        (string) (
            $tiket['status']
            ?? $tiket['status_tampilan']
            ?? 'menunggu'
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


/*
|--------------------------------------------------------------------------
| STATUS SELESAI
|--------------------------------------------------------------------------
*/

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
    margin-bottom: 0;
}

.detail-subtitle {
    color: #6c757d;
    margin-top: 5px;
    margin-bottom: 0;
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
   DESCRIPTION
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
   FILE BUTTON
===================================================== */

.file-btn {
    border-radius: 10px;
    margin-top: 5px;
    margin-right: 8px;
    margin-bottom: 5px;
}


/* =====================================================
   DOCUMENT
===================================================== */

.document-box {
    border: 1px solid #dee2e6;
    border-radius: 12px;
    padding: 15px;
    background: #f8f9fa;
}

.document-item {
    padding: 12px 0;
    border-bottom: 1px solid #e9ecef;
}

.document-item:last-child {
    border-bottom: none;
}


/* =====================================================
   ACTION
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
        Informasi lengkap mengenai pengajuan tiket layanan Perpustakaan
    </p>

</div>


<!-- =====================================================
     FLASH SUCCESS
===================================================== -->

<?php if (session()->getFlashdata('success')): ?>

    <div class="alert alert-success alert-dismissible fade show">

        <i class="fas fa-check-circle me-2"></i>

        <?= esc(
            session()->getFlashdata('success')
        ) ?>

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert">
        </button>

    </div>

<?php endif; ?>


<!-- =====================================================
     FLASH ERROR
===================================================== -->

<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger alert-dismissible fade show">

        <i class="fas fa-exclamation-circle me-2"></i>

        <?= esc(
            session()->getFlashdata('error')
        ) ?>

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


    <!-- =================================================
         CARD HEADER
    ================================================== -->

    <div class="detail-card-header">

        <h5>

            <i class="fas fa-book text-primary me-2"></i>

            Informasi Tiket

        </h5>

    </div>


    <!-- =================================================
         CARD BODY
    ================================================== -->

    <div class="detail-card-body">


        <!-- =================================================
             NOMOR TIKET
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Nomor Tiket
            </label>

            <p class="detail-value">

                <?= esc($nomorTiket) ?>

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

                <?php if (!empty($tanggalPengajuan)): ?>

                    <?= date(
                        'd-m-Y H:i:s',
                        strtotime($tanggalPengajuan)
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

                <?= esc($namaPemohon) ?>

            </p>

        </div>


        <!-- =================================================
             IDENTITAS
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                NIK / Identitas
            </label>

            <p class="detail-value">

                <?= !empty($identitas)
                    ? esc($identitas)
                    : 'Identitas belum tersedia'
                ?>

            </p>

        </div>


        <!-- =================================================
             UNIT LAYANAN
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Unit Layanan
            </label>

            <p class="detail-value">

                <?= esc($unitLayanan) ?>

            </p>

        </div>


        <!-- =================================================
             KATEGORI
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Kategori Layanan
            </label>

            <p class="detail-value">

                <?= esc($kategoriLayanan) ?>

            </p>

        </div>


        <!-- =================================================
             JENIS LAYANAN
        ================================================== -->

        <div class="detail-item">

            <label class="detail-label">
                Jenis Layanan
            </label>

            <p class="detail-value">

                <?= esc($jenisLayanan) ?>

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

                <?= esc($judulPengajuan) ?>

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

                <?php if (
                    !empty(
                        trim(
                            (string) $deskripsi
                        )
                    )
                ): ?>

                    <?= nl2br(
                        esc($deskripsi)
                    ) ?>

                <?php else: ?>

                    <span class="text-muted">
                        Deskripsi belum tersedia
                    </span>

                <?php endif; ?>

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


                <?php if (!empty($filePendukung)): ?>

                    <a
                        href="<?= base_url(
                            'uploads/pendukung/' . $filePendukung
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


            <div class="status-box">

                <div class="status-title">
                    Status Saat Ini
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
                    Catatan Petugas Perpustakaan
                </label>

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


                <?php if (
                    !empty($hasilLayanan)
                    && is_array($hasilLayanan)
                ): ?>

                    <div class="document-box">

                        <?php foreach (
                            $hasilLayanan
                            as $file
                        ): ?>

                            <?php

                            $namaFile = trim(
                                (string) (
                                    $file['nama_file']
                                    ?? $file['file_name']
                                    ?? ''
                                )
                            );

                            $namaAsli =
                                $file['nama_asli']
                                ?? $file['original_name']
                                ?? $namaFile;

                            ?>


                            <?php if ($namaFile === ''): ?>

                                <?php continue; ?>

                            <?php endif; ?>


                            <div class="document-item">

                                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">


                                    <!-- NAMA FILE -->

                                    <div class="d-flex align-items-center gap-2 text-break">

                                        <i class="fas fa-file-alt text-primary"></i>

                                        <span>

                                            <?= esc(
                                                $namaAsli
                                            ) ?>

                                        </span>

                                    </div>


                                    <!-- AKSI -->

                                    <div class="d-flex flex-wrap gap-2">

                                        <a
                                            href="<?= base_url(
                                                'perpustakaan/lihat/' . $namaFile
                                            ) ?>"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-sm btn-outline-primary"
                                        >

                                            <i class="fas fa-eye me-1"></i>

                                            Lihat

                                        </a>


                                        <a
                                            href="<?= base_url(
                                                'perpustakaan/download/' . $namaFile
                                            ) ?>"
                                            class="btn btn-sm btn-outline-success"
                                        >

                                            <i class="fas fa-download me-1"></i>

                                            Download

                                        </a>

                                    </div>

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


            <!-- PROSES TIKET -->

            <a
                href="<?= base_url(
                    'perpustakaan/proses/' . $id
                ) ?>"
                class="btn btn-primary-custom"
            >

                <i class="fas fa-cogs me-1"></i>

                Proses Tiket

            </a>


            <?php if ($statusBisaKirim): ?>


                <!-- KIRIM KE PETUGAS ULT -->

                <a
                    href="<?= base_url(
                        'perpustakaan/kirim/' . $id
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


                <!-- KIRIM KE PEMOHON -->

                <a
                    href="<?= base_url(
                        'perpustakaan/kirim-pemohon/' . $id
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


            <!-- KEMBALI -->

            <a
                href="<?= base_url(
                    'perpustakaan/data-tiket'
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