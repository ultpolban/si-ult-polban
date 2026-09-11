<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>

/* =====================================================
   HEADER
===================================================== */

.process-header{
    margin-bottom:25px;
}

.process-title{
    font-size:30px;
    font-weight:700;
    color:#172033;
}

.process-subtitle{
    color:#6c757d;
    margin-top:5px;
}


/* =====================================================
   CARD
===================================================== */

.process-card{
    background:#fff;
    border:none;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    overflow:hidden;
}

.process-card-header{
    padding:22px 28px;
    border-bottom:1px solid #eee;
    background:#fff;
}

.process-card-header h5{
    margin:0;
    font-size:20px;
    font-weight:700;
    color:#172033;
}

.process-card-body{
    padding:28px;
}


/* =====================================================
   FORM
===================================================== */

.process-label{
    display:block;
    color:#293582;
    font-weight:700;
    margin-bottom:7px;
    font-size:15px;
}

.process-control{
    border:1px solid #dee2e6;
    border-radius:10px;
    min-height:45px;
    padding:10px 13px;
}

.process-control:focus{
    border-color:#293582;
    box-shadow:0 0 0 .2rem rgba(41,53,130,.12);
}

textarea.process-control{
    min-height:130px;
    resize:vertical;
}


/* =====================================================
   READ ONLY
===================================================== */

.readonly-box{
    background:#f8f9fa;
    color:#212529;
}


/* =====================================================
   SECTION
===================================================== */

.process-section{
    margin-bottom:30px;
}

.process-section-title{
    font-size:18px;
    font-weight:700;
    color:#172033;
    margin-bottom:20px;
    padding-bottom:12px;
    border-bottom:1px solid #eee;
}


/* =====================================================
   ALERT
===================================================== */

.process-alert{
    border-radius:10px;
    border:none;
}


/* =====================================================
   BUTTON
===================================================== */

.process-actions{
    margin-top:10px;
    padding-top:25px;
    border-top:1px solid #eee;
}

.process-actions .btn{
    border-radius:10px;
    padding:10px 20px;
    margin-right:8px;
    margin-bottom:8px;
}

.btn-process{
    background:#293582;
    border:none;
    color:white;
}

.btn-process:hover{
    background:#ff7f00;
    color:white;
}

.btn-back{
    background:#6c757d;
    border:none;
    color:white;
}

.btn-back:hover{
    background:#5a6268;
    color:white;
}


/* =====================================================
   FILE LIST
===================================================== */

.file-item{
    background:#f8f9fa;
    border:1px solid #e9ecef;
    border-radius:10px;
    padding:10px 13px;
    margin-bottom:8px;
    display:flex;
    align-items:center;
}

.file-item i{
    color:#293582;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width:768px){

    .process-title{
        font-size:24px;
    }

    .process-card-body{
        padding:20px;
    }

}

</style>


<!-- =====================================================
     DATA TIKET
===================================================== -->

<?php

/*
|--------------------------------------------------------------------------
| Ambil data tiket Jurusan
|--------------------------------------------------------------------------
| Tidak menggunakan data dari Akademik,
| Administrasi Umum, Keuangan, Kemahasiswaan,
| Perpustakaan, atau UPT TIK.
*/

$ticket = [];

if (isset($tiket) && is_array($tiket)) {

    $ticket = $tiket;

} elseif (isset($ticket) && is_array($ticket)) {

    $ticket = $ticket;

}


/*
|--------------------------------------------------------------------------
| ID TIKET
|--------------------------------------------------------------------------
*/

$ticketId = (int) (
    $ticket['id']
    ?? 0
);


/*
|--------------------------------------------------------------------------
| STATUS
|--------------------------------------------------------------------------
*/

$currentStatus = strtolower(
    trim(
        (string) (
            $ticket['status']
            ?? 'submitted'
        )
    )
);


/*
|--------------------------------------------------------------------------
| CATATAN
|--------------------------------------------------------------------------
*/

$currentNote = $ticket['catatan']
    ?? $ticket['admin_note']
    ?? '';


/*
|--------------------------------------------------------------------------
| NORMALISASI STATUS
|--------------------------------------------------------------------------
*/

if (in_array(
    $currentStatus,
    [
        'submitted',
        'menunggu',
        'draft',
        'revision'
    ],
    true
)) {

    $currentStatus = 'menunggu';

} elseif (in_array(
    $currentStatus,
    [
        'processing',
        'diproses',
        'verification',
        'in_progress'
    ],
    true
)) {

    $currentStatus = 'diproses';

} elseif (in_array(
    $currentStatus,
    [
        'completed',
        'complete',
        'selesai'
    ],
    true
)) {

    $currentStatus = 'selesai';

} elseif ($currentStatus === 'rejected') {

    $currentStatus = 'ditolak';

}

?>


<!-- =====================================================
     HEADER
===================================================== -->

<div class="process-header">

    <h2 class="process-title">
        Proses Tiket Jurusan
    </h2>

    <p class="process-subtitle">
        Kelola status dan penanganan pengajuan tiket Jurusan
    </p>

</div>


<!-- =====================================================
     FLASH MESSAGE
===================================================== -->

<?php if (session()->getFlashdata('success')): ?>

    <div class="alert alert-success process-alert">

        <i class="fas fa-check-circle me-2"></i>

        <?= esc(
            session()->getFlashdata('success')
        ) ?>

    </div>

<?php endif; ?>


<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger process-alert">

        <i class="fas fa-exclamation-circle me-2"></i>

        <?= esc(
            session()->getFlashdata('error')
        ) ?>

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

            <i class="fas fa-cogs text-primary me-2"></i>

            Informasi Tiket

        </h5>

    </div>


    <!-- =================================================
         BODY
    ================================================= -->

    <div class="process-card-body">


        <!-- =================================================
             FORM
        ================================================== -->

        <form
            action="<?= base_url(
                'jurusan/updateProses/' . $ticketId
            ) ?>"
            method="post"
            enctype="multipart/form-data"
        >

            <?= csrf_field() ?>


            <!-- =============================================
                 INFORMASI PENGAJUAN
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
                            $ticket['ticket_number']
                            ?? $ticket['no_tiket']
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
                            $ticket['nama_unit']
                            ?? $ticket['unit_layanan']
                            ?? 'Jurusan'
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
                            $ticket['nama_kategori']
                            ?? $ticket['kategori_layanan']
                            ?? 'Layanan Jurusan'
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
                            $ticket['nama_layanan']
                            ?? $ticket['service_name']
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
                            $ticket['judul']
                            ?? $ticket['title']
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
                        $ticket['deskripsi']
                        ?? $ticket['description']
                        ?? '-'
                    ) ?></textarea>

                </div>

            </div>


            <!-- =================================================
                 PROSES TIKET
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


                    <select
                        name="status"
                        id="status"
                        class="form-select process-control"
                        required
                    >

                        <option
                            value="menunggu"
                            <?= $currentStatus === 'menunggu'
                                ? 'selected'
                                : ''
                            ?>
                        >
                            Menunggu
                        </option>


                        <option
                            value="diproses"
                            <?= $currentStatus === 'diproses'
                                ? 'selected'
                                : ''
                            ?>
                        >
                            Diproses
                        </option>


                        <option
                            value="selesai"
                            <?= $currentStatus === 'selesai'
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
                        Catatan Petugas
                    </label>


                    <textarea
                        name="catatan"
                        id="catatan"
                        class="form-control process-control"
                        placeholder="Masukkan catatan atau hasil penanganan tiket..."
                    ><?= esc($currentNote) ?></textarea>


                    <div class="form-text">

                        Tambahkan informasi mengenai proses atau hasil
                        penanganan tiket.

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

                        Bisa upload banyak file.<br>

                        Format PDF, JPG, JPEG, PNG.<br>

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
                        'jurusan/detail/' . $ticketId
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
     JAVASCRIPT UPLOAD
===================================================== -->

<script>

const inputFile = document.getElementById('file_hasil');

const listFile = document.getElementById('list_file');


if (inputFile && listFile) {

    inputFile.addEventListener(
        'change',
        function () {

            const fileBaru = Array.from(
                this.files
            );

            listFile.innerHTML = '';


            fileBaru.forEach(
                function (file) {

                    /*
                    |--------------------------------------------------------------------------
                    | Validasi ukuran
                    |--------------------------------------------------------------------------
                    */

                    if (
                        file.size >
                        5 * 1024 * 1024
                    ) {

                        const item =
                            document.createElement('div');

                        item.className =
                            'alert alert-danger py-2 px-3 mb-2';

                        item.innerHTML =
                            '<i class="fas fa-exclamation-circle me-2"></i>' +
                            'Ukuran ' +
                            escapeHtml(file.name) +
                            ' melebihi maksimal 5 MB.';

                        listFile.appendChild(
                            item
                        );

                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Validasi format
                    |--------------------------------------------------------------------------
                    */

                    const ekstensi =
                        file.name
                            .split('.')
                            .pop()
                            .toLowerCase();


                    const formatDiizinkan = [
                        'pdf',
                        'jpg',
                        'jpeg',
                        'png'
                    ];


                    if (
                        !formatDiizinkan.includes(
                            ekstensi
                        )
                    ) {

                        const item =
                            document.createElement('div');

                        item.className =
                            'alert alert-danger py-2 px-3 mb-2';

                        item.innerHTML =
                            '<i class="fas fa-exclamation-circle me-2"></i>' +
                            'Format file ' +
                            escapeHtml(file.name) +
                            ' tidak diperbolehkan.';

                        listFile.appendChild(
                            item
                        );

                        return;
                    }


                    /*
                    |--------------------------------------------------------------------------
                    | Tampilkan file
                    |--------------------------------------------------------------------------
                    */

                    const item =
                        document.createElement('div');

                    item.className =
                        'file-item';


                    item.innerHTML =
                        '<i class="fas fa-file me-2"></i>' +
                        '<span>' +
                        escapeHtml(file.name) +
                        '</span>';


                    listFile.appendChild(
                        item
                    );

                }
            );

        }
    );

}


/*
|--------------------------------------------------------------------------
| Escape HTML
|--------------------------------------------------------------------------
*/

function escapeHtml(text) {

    const div =
        document.createElement('div');

    div.textContent = text;

    return div.innerHTML;

}

</script>


<?= $this->endSection() ?>