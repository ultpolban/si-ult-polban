<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
$tiket = $tiket ?? $ticket ?? [];
?>

<style>

/* =====================================================
   HEADER
===================================================== */

.process-header {
    margin-bottom: 25px;
}

.process-title {
    font-size: 30px;
    font-weight: 700;
    color: #172033;
}

.process-subtitle {
    color: #6c757d;
    margin-top: 5px;
}


/* =====================================================
   CARD
===================================================== */

.process-card {
    background: #fff;
    border: none;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0,0,0,.08);
    overflow: hidden;
}

.process-card-header {
    padding: 22px 28px;
    border-bottom: 1px solid #eee;
    background: #fff;
}

.process-card-header h5 {
    margin: 0;
    font-size: 20px;
    font-weight: 700;
    color: #172033;
}

.process-card-body {
    padding: 28px;
}


/* =====================================================
   FORM
===================================================== */

.process-label {
    display: block;
    color: #293582;
    font-weight: 700;
    margin-bottom: 7px;
    font-size: 15px;
}

.process-control {
    border: 1px solid #dee2e6;
    border-radius: 10px;
    min-height: 45px;
    padding: 10px 13px;
}

.process-control:focus {
    border-color: #293582;
    box-shadow: 0 0 0 .2rem rgba(41,53,130,.12);
}

textarea.process-control {
    min-height: 130px;
    resize: vertical;
}


/* =====================================================
   READ ONLY
===================================================== */

.readonly-box {
    background: #f8f9fa !important;
    color: #212529;
}


/* =====================================================
   SECTION
===================================================== */

.process-section {
    margin-bottom: 30px;
}

.process-section-title {
    font-size: 18px;
    font-weight: 700;
    color: #172033;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 1px solid #eee;
}


/* =====================================================
   ALERT
===================================================== */

.process-alert {
    border-radius: 10px;
    border: none;
}


/* =====================================================
   FILE LIST
===================================================== */

.file-list-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    border: 1px solid #dee2e6;
    background: #f8f9fa;
    border-radius: 10px;
    padding: 10px 13px;
    margin-bottom: 8px;
}

.file-list-info {
    display: flex;
    align-items: center;
    gap: 8px;
    min-width: 0;
}

.file-list-name {
    overflow-wrap: anywhere;
}


/* =====================================================
   BUTTON
===================================================== */

.process-actions {
    margin-top: 10px;
    padding-top: 25px;
    border-top: 1px solid #eee;
}

.process-actions .btn {
    border-radius: 10px;
    padding: 10px 20px;
    margin-right: 8px;
    margin-bottom: 8px;
}

.btn-process {
    background: #293582;
    border: none;
    color: white;
}

.btn-process:hover {
    background: #ff7f00;
    color: white;
}

.btn-back {
    background: #6c757d;
    border: none;
    color: white;
}

.btn-back:hover {
    background: #5a6268;
    color: white;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 768px) {

    .process-title {
        font-size: 24px;
    }

    .process-card-body {
        padding: 20px;
    }

}

</style>


<!-- =====================================================
     HEADER
===================================================== -->

<div class="process-header">

    <h2 class="process-title">
        Proses Tiket Layanan
    </h2>

    <p class="process-subtitle">
        Kelola status dan penanganan pengajuan tiket layanan Perpustakaan
    </p>

</div>


<!-- =====================================================
     FLASH MESSAGE
===================================================== -->

<?php if (session()->getFlashdata('success')): ?>

    <div class="alert alert-success process-alert">

        <i class="fas fa-check-circle me-2"></i>

        <?= esc(session()->getFlashdata('success')) ?>

    </div>

<?php endif; ?>


<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger process-alert">

        <i class="fas fa-exclamation-circle me-2"></i>

        <?= esc(session()->getFlashdata('error')) ?>

    </div>

<?php endif; ?>


<!-- =====================================================
     CARD UTAMA
===================================================== -->

<div class="process-card">


    <!-- =================================================
         HEADER CARD
    ================================================== -->

    <div class="process-card-header">

        <h5>

            <i class="fas fa-book text-primary me-2"></i>

            Informasi Tiket Perpustakaan

        </h5>

    </div>


    <!-- =================================================
         BODY CARD
    ================================================== -->

    <div class="process-card-body">


        <form
            action="<?= base_url(
                'perpustakaan/updateProses/' .
                ($tiket['id'] ?? '')
            ) ?>"
            method="post"
            enctype="multipart/form-data"
        >

            <?= csrf_field() ?>


            <!-- =============================================
                 INFORMASI TIKET
            ============================================== -->

            <div class="process-section">

                <h6 class="process-section-title">

                    <i class="fas fa-ticket-alt text-primary me-2"></i>

                    Informasi Pengajuan

                </h6>


                <!-- NOMOR TIKET -->

                <div class="mb-4">

                    <label class="process-label">
                        Nomor Tiket
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['ticket_number']
                            ?? $tiket['no_tiket']
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- NAMA PEMOHON -->

                <div class="mb-4">

                    <label class="process-label">
                        Nama Pemohon
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['applicant_name']
                            ?? $tiket['nama_pemohon']
                            ?? 'Pemohon'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- IDENTITAS -->

                <div class="mb-4">

                    <label class="process-label">
                        NIK / Identitas
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['applicant_identifier']
                            ?? $tiket['identity_number']
                            ?? $tiket['nik']
                            ?? $tiket['nim']
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- UNIT LAYANAN -->

                <div class="mb-4">

                    <label class="process-label">
                        Unit Layanan
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['unit_name']
                            ?? $tiket['nama_unit']
                            ?? 'Perpustakaan'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- KATEGORI LAYANAN -->

                <div class="mb-4">

                    <label class="process-label">
                        Kategori Layanan
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['category_name']
                            ?? $tiket['nama_kategori']
                            ?? 'Layanan Perpustakaan'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- JENIS LAYANAN -->

                <div class="mb-4">

                    <label class="process-label">
                        Jenis Layanan
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['service_name']
                            ?? $tiket['nama_layanan']
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- JUDUL PENGAJUAN -->

                <div class="mb-4">

                    <label class="process-label">
                        Judul Pengajuan
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['title']
                            ?? $tiket['judul']
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- DESKRIPSI -->

                <div class="mb-4">

                    <label class="process-label">
                        Deskripsi Pengajuan
                    </label>

                    <textarea
                        class="form-control process-control readonly-box"
                        readonly
                    ><?= esc(
                        $tiket['description']
                        ?? $tiket['deskripsi']
                        ?? '-'
                    ) ?></textarea>

                </div>

            </div>


            <!-- =================================================
                 PENANGANAN TIKET
            ================================================== -->

            <div class="process-section">

                <h6 class="process-section-title">

                    <i class="fas fa-tasks text-primary me-2"></i>

                    Penanganan Tiket

                </h6>


                <!-- STATUS -->

                <div class="mb-4">

                    <label
                        for="status"
                        class="process-label"
                    >
                        Status Tiket
                    </label>


                    <?php

                    $currentStatus = strtolower(
                        trim(
                            (string) (
                                $tiket['status']
                                ?? ''
                            )
                        )
                    );

                    ?>


                    <select
                        name="status"
                        id="status"
                        class="form-select process-control"
                        required
                    >


                        <!-- MENUNGGU -->

                        <option
                            value="menunggu"
                            <?= in_array(
                                $currentStatus,
                                [
                                    'menunggu',
                                    'submitted',
                                    'draft',
                                    'revision'
                                ],
                                true
                            )
                                ? 'selected'
                                : ''
                            ?>
                        >

                            Menunggu

                        </option>


                        <!-- DIPROSES -->

                        <option
                            value="diproses"
                            <?= in_array(
                                $currentStatus,
                                [
                                    'diproses',
                                    'processing',
                                    'verification',
                                    'in_progress'
                                ],
                                true
                            )
                                ? 'selected'
                                : ''
                            ?>
                        >

                            Diproses

                        </option>


                        <!-- SELESAI -->

                        <option
                            value="selesai"
                            <?= in_array(
                                $currentStatus,
                                [
                                    'selesai',
                                    'completed',
                                    'complete'
                                ],
                                true
                            )
                                ? 'selected'
                                : ''
                            ?>
                        >

                            Selesai

                        </option>


                    </select>

                </div>


                <!-- CATATAN -->

                <div class="mb-4">

                    <label
                        for="catatan"
                        class="process-label"
                    >
                        Catatan Petugas Perpustakaan
                    </label>


                    <textarea
                        name="catatan"
                        id="catatan"
                        class="form-control process-control"
                        placeholder="Masukkan catatan atau hasil penanganan tiket Perpustakaan..."
                    ><?= esc(
                        $tiket['admin_note']
                        ?? $tiket['catatan']
                        ?? $tiket['processing_note']
                        ?? ''
                    ) ?></textarea>


                    <div class="form-text">

                        Tambahkan informasi mengenai proses atau hasil
                        penanganan tiket Perpustakaan.

                    </div>

                </div>

            </div>


            <!-- =================================================
                 DOKUMEN HASIL
            ================================================== -->

            <div class="process-section">

                <h6 class="process-section-title">

                    <i class="fas fa-file-upload text-primary me-2"></i>

                    Dokumen Hasil

                </h6>


                <div class="mb-4">

                    <label
                        for="file_hasil"
                        class="process-label"
                    >
                        Upload Dokumen Hasil
                    </label>


                    <input
                        type="file"
                        name="file_hasil[]"
                        id="file_hasil"
                        class="form-control process-control"
                        accept=".pdf,.jpg,.jpeg,.png"
                        multiple
                    >


                    <div
                        id="list_file"
                        class="mt-3"
                    ></div>


                    <small class="text-muted">

                        Bisa upload banyak file.
                        <br>

                        Format PDF, JPG, JPEG, PNG.
                        <br>

                        Maksimal 5 MB per file.

                    </small>

                </div>

            </div>


            <!-- =================================================
                 TOMBOL
            ================================================== -->

            <div class="process-actions">


                <!-- SIMPAN -->

                <button
                    type="submit"
                    class="btn btn-process"
                >

                    <i class="fas fa-save me-1"></i>

                    Simpan Perubahan

                </button>


                <!-- KEMBALI -->

                <a
                    href="<?= base_url(
                        'perpustakaan/detail/' .
                        ($tiket['id'] ?? '')
                    ) ?>"
                    class="btn btn-back"
                >

                    <i class="fas fa-arrow-left me-1"></i>

                    Kembali

                </a>


            </div>


        </form>

    </div>

</div>


<!-- =====================================================
     JAVASCRIPT FILE
===================================================== -->

<script>

const inputFile = document.getElementById('file_hasil');
const listFile = document.getElementById('list_file');

if (inputFile && listFile) {

    inputFile.addEventListener('change', function () {

        const files = Array.from(this.files);

        listFile.innerHTML = '';

        files.forEach(function (file) {

            /* =============================================
               VALIDASI UKURAN
            ============================================== */

            if (file.size > 5 * 1024 * 1024) {

                alert(
                    'Ukuran file "' +
                    file.name +
                    '" maksimal 5 MB.'
                );

                return;

            }


            /* =============================================
               VALIDASI FORMAT
            ============================================== */

            const ekstensi = file.name
                .split('.')
                .pop()
                .toLowerCase();

            const formatDiizinkan = [
                'pdf',
                'jpg',
                'jpeg',
                'png'
            ];


            if (!formatDiizinkan.includes(ekstensi)) {

                alert(
                    'Format file "' +
                    file.name +
                    '" tidak diperbolehkan.'
                );

                return;

            }


            /* =============================================
               TAMPILKAN FILE
            ============================================== */

            const item = document.createElement('div');

            item.className = 'file-list-item';


            const info = document.createElement('div');

            info.className = 'file-list-info';


            const icon = document.createElement('i');

            icon.className = 'fas fa-file-alt text-primary';


            const nama = document.createElement('span');

            nama.className = 'file-list-name';

            nama.textContent = file.name;


            info.appendChild(icon);
            info.appendChild(nama);


            const size = document.createElement('small');

            size.className = 'text-muted';

            size.textContent =
                (file.size / 1024 / 1024).toFixed(2)
                + ' MB';


            item.appendChild(info);
            item.appendChild(size);

            listFile.appendChild(item);

        });

    });

}

</script>


<?= $this->endSection() ?>