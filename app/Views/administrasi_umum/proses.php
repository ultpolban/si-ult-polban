<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<?php
    /*
    |--------------------------------------------------------------------------
    | DATA TIKET ADMINISTRASI UMUM
    |--------------------------------------------------------------------------
    | Semua data diambil dari tiket Administrasi Umum.
    | Tidak menggunakan controller/model/tabel unit lain.
    */

    $tiket = $tiket ?? [];

    $id = (int) (
        $tiket['id']
        ?? 0
    );

    $currentStatus = strtolower(
        trim(
            (string) (
                $tiket['status']
                ?? 'submitted'
            )
        )
    );
?>

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
    margin-bottom:0;
}

.process-subtitle{
    color:#6c757d;
    margin-top:5px;
    margin-bottom:0;
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
   FILE LIST
===================================================== */

.file-item{
    background:#f8f9fa;
    border:1px solid #dee2e6;
    border-radius:8px;
    padding:9px 13px;
    margin-bottom:8px;
    font-size:14px;
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
    color:#fff;
}

.btn-process:hover{
    background:#ff7f00;
    color:#fff;
}

.btn-back{
    background:#6c757d;
    border:none;
    color:#fff;
}

.btn-back:hover{
    background:#5a6268;
    color:#fff;
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
     HEADER
===================================================== -->

<div class="process-header">

    <h2 class="process-title">
        Proses Tiket Layanan
    </h2>

    <p class="process-subtitle">
        Kelola status dan penanganan pengajuan tiket Administrasi Umum
    </p>

</div>


<!-- =====================================================
     FLASH MESSAGE
===================================================== -->

<?php if(session()->getFlashdata('success')): ?>

    <div class="alert alert-success process-alert">

        <i class="fas fa-check-circle me-2"></i>

        <?= esc(
            session()->getFlashdata('success')
        ) ?>

    </div>

<?php endif; ?>


<?php if(session()->getFlashdata('error')): ?>

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

            Informasi Tiket Administrasi Umum

        </h5>

    </div>


    <!-- =================================================
         BODY
    ================================================== -->

    <div class="process-card-body">


        <!-- =================================================
             FORM PROSES
        ================================================== -->

        <form
            action="<?= base_url(
                'administrasi-umum/proses/update/' . $id
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
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- NIK / IDENTITAS -->

                <div class="mb-4">

                    <label class="process-label">
                        NIK / Identitas
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['identity_number']
                            ?? $tiket['nik']
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
                            ?? 'Bagian Administrasi Umum'
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
                            $tiket['service_category']
                            ?? $tiket['category_name']
                            ?? $tiket['nama_kategori']
                            ?? 'Administrasi Umum'
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


                    <select
                        name="status"
                        id="status"
                        class="form-select process-control"
                        required
                    >

                        <option
                            value="submitted"
                            <?= in_array(
                                $currentStatus,
                                [
                                    'submitted',
                                    'menunggu',
                                    'draft'
                                ],
                                true
                            )
                                ? 'selected'
                                : ''
                            ?>
                        >
                            Menunggu
                        </option>


                        <option
                            value="processing"
                            <?= in_array(
                                $currentStatus,
                                [
                                    'processing',
                                    'diproses',
                                    'in_progress',
                                    'verification'
                                ],
                                true
                            )
                                ? 'selected'
                                : ''
                            ?>
                        >
                            Diproses
                        </option>


                        <option
                            value="completed"
                            <?= in_array(
                                $currentStatus,
                                [
                                    'completed',
                                    'selesai',
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
                        for="admin_note"
                        class="process-label"
                    >
                        Catatan Petugas
                    </label>


                    <textarea
                        name="admin_note"
                        id="admin_note"
                        class="form-control process-control"
                        rows="5"
                        placeholder="Masukkan catatan atau hasil penanganan tiket..."
                    ><?= esc(
                        $tiket['admin_note']
                        ?? ''
                    ) ?></textarea>


                    <div class="form-text">

                        Tambahkan informasi mengenai proses atau hasil
                        penanganan tiket Administrasi Umum.

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
                        for="result_file"
                        class="process-label"
                    >
                        Upload Dokumen Hasil
                    </label>


                    <input
                        type="file"
                        name="result_file[]"
                        id="result_file"
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
                        'administrasi-umum/detail/' . $id
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

const inputFile = document.getElementById('result_file');
const listFile = document.getElementById('list_file');

if(inputFile && listFile){

    inputFile.addEventListener('change', function(){

        listFile.innerHTML = '';

        const files = Array.from(this.files);

        if(files.length === 0){
            return;
        }

        files.forEach(function(file){

            const extension = file.name
                .split('.')
                .pop()
                .toLowerCase();

            const allowedFormats = [
                'pdf',
                'jpg',
                'jpeg',
                'png'
            ];

            /* =============================================
               VALIDASI UKURAN
            ============================================== */

            if(file.size > 5 * 1024 * 1024){

                const errorItem =
                    document.createElement('div');

                errorItem.className =
                    'alert alert-danger py-2 px-3 mb-2';

                errorItem.innerHTML =
                    '<i class="fas fa-exclamation-circle me-2"></i>' +
                    file.name +
                    ' terlalu besar. Maksimal 5 MB.';

                listFile.appendChild(errorItem);

                return;
            }


            /* =============================================
               VALIDASI FORMAT
            ============================================== */

            if(!allowedFormats.includes(extension)){

                const errorItem =
                    document.createElement('div');

                errorItem.className =
                    'alert alert-danger py-2 px-3 mb-2';

                errorItem.innerHTML =
                    '<i class="fas fa-exclamation-circle me-2"></i>' +
                    file.name +
                    ' memiliki format yang tidak diperbolehkan.';

                listFile.appendChild(errorItem);

                return;
            }


            /* =============================================
               FILE VALID
            ============================================== */

            const item =
                document.createElement('div');

            item.className =
                'file-item';

            item.innerHTML =
                '<i class="fas fa-file me-2 text-primary"></i>' +
                '<strong>' +
                file.name +
                '</strong>' +
                '<span class="text-muted ms-2">' +
                '(' +
                (file.size / 1024 / 1024).toFixed(2) +
                ' MB)' +
                '</span>';

            listFile.appendChild(item);

        });

    });

}

</script>


<?= $this->endSection() ?>