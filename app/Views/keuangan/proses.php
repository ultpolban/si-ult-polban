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
    margin-bottom:5px;
}

.process-subtitle{
    color:#6c757d;
    margin:0;
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
   FILE LIST
===================================================== */

.file-list{
    margin-top:15px;
}

.file-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:15px;

    background:#f8f9fa;
    border:1px solid #e5e7eb;
    border-radius:10px;

    padding:12px 14px;
    margin-bottom:8px;
}

.file-item-left{
    display:flex;
    align-items:center;
    min-width:0;
}

.file-item-name{
    word-break:break-all;
    color:#172033;
}

.file-item-size{
    color:#6c757d;
    font-size:13px;
    margin-left:8px;
}

.remove-file{
    flex-shrink:0;
}


/* =====================================================
   PREVIOUS DOCUMENT
===================================================== */

.previous-document{
    background:#eef7ff;
    border:1px solid #cfe2ff;
    border-radius:12px;
    padding:18px;
}

.previous-document ul{
    margin-bottom:0;
    padding-left:20px;
}

.previous-document a{
    text-decoration:none;
}

.previous-document a:hover{
    text-decoration:underline;
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
   ALERT
===================================================== */

.process-alert{
    border-radius:10px;
    border:none;
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

    .file-item{
        align-items:flex-start;
    }

}

</style>


<!-- =====================================================
     HEADER
===================================================== -->

<div class="process-header">

    <h2 class="process-title">
        Proses Tiket Layanan Keuangan
    </h2>

    <p class="process-subtitle">
        Kelola status, catatan, dan dokumen hasil pengajuan tiket
    </p>

</div>


<!-- =====================================================
     FLASH MESSAGE
===================================================== -->

<?php if(session()->getFlashdata('error')): ?>

    <div class="alert alert-danger process-alert">

        <i class="fas fa-exclamation-circle me-2"></i>

        <?= esc(session()->getFlashdata('error')) ?>

    </div>

<?php endif; ?>


<?php if(session()->getFlashdata('success')): ?>

    <div class="alert alert-success process-alert">

        <i class="fas fa-check-circle me-2"></i>

        <?= esc(session()->getFlashdata('success')) ?>

    </div>

<?php endif; ?>


<!-- =====================================================
     CARD
===================================================== -->

<div class="process-card">


    <!-- =================================================
         CARD HEADER
    ================================================== -->

    <div class="process-card-header">

        <h5>

            <i class="fas fa-coins text-primary me-2"></i>

            Informasi Tiket

        </h5>

    </div>


    <!-- =================================================
         CARD BODY
    ================================================== -->

    <div class="process-card-body">


        <!-- =================================================
             SATU FORM UNTUK STATUS + CATATAN + DOKUMEN
        ================================================== -->

        <form
            action="<?= base_url(
                'keuangan/updateProses/' .
                (int)($tiket['id'] ?? 0)
            ) ?>"
            method="post"
            enctype="multipart/form-data"
        >

            <?= csrf_field() ?>


            <!-- =================================================
                 INFORMASI PENGAJUAN
            ================================================== -->

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
                            $tiket['no_tiket']
                            ?? $tiket['ticket_number']
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- UNIT -->

                <div class="mb-4">

                    <label class="process-label">
                        Unit Layanan
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['nama_unit']
                            ?? 'Keuangan'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- KATEGORI -->

                <div class="mb-4">

                    <label class="process-label">
                        Kategori Layanan
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['nama_kategori']
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- LAYANAN -->

                <div class="mb-4">

                    <label class="process-label">
                        Jenis Layanan
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['nama_layanan']
                            ?? $tiket['service_name']
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- JUDUL -->

                <div class="mb-4">

                    <label class="process-label">
                        Judul Pengajuan
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['judul']
                            ?? $tiket['title']
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
                        $tiket['deskripsi']
                        ?? $tiket['description']
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
                        $currentStatus =
                            strtolower(
                                (string)(
                                    $tiket['status']
                                    ?? 'submitted'
                                )
                            );

                        $statusValue = match($currentStatus){
                            'submitted',
                            'menunggu'
                                => 'Menunggu',

                            'processing',
                            'diproses'
                                => 'Diproses',

                            'completed',
                            'selesai'
                                => 'Selesai',

                            default
                                => 'Menunggu',
                        };
                    ?>


                    <select
                        name="status"
                        id="status"
                        class="form-select process-control"
                        required
                    >

                        <option
                            value="Menunggu"
                            <?= $statusValue === 'Menunggu'
                                ? 'selected'
                                : '' ?>
                        >
                            Menunggu
                        </option>

                        <option
                            value="Diproses"
                            <?= $statusValue === 'Diproses'
                                ? 'selected'
                                : '' ?>
                        >
                            Diproses
                        </option>

                        <option
                            value="Selesai"
                            <?= $statusValue === 'Selesai'
                                ? 'selected'
                                : '' ?>
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

                        Catatan Unit Keuangan

                    </label>


                    <textarea
                        name="catatan"
                        id="catatan"
                        class="form-control process-control"
                        placeholder="Masukkan catatan atau hasil penanganan tiket..."
                    ><?= esc(
                        $tiket['catatan']
                        ?? $tiket['admin_note']
                        ?? ''
                    ) ?></textarea>


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


                    <!--
                    IMPORTANT:
                    Nama field HARUS file_hasil[]
                    karena akan diproses oleh updateProses()
                    -->

                    <input
                        type="file"
                        id="file_hasil"
                        name="file_hasil[]"
                        class="form-control process-control"
                        accept=".pdf,.jpg,.jpeg,.png"
                        multiple
                    >


                    <!-- DAFTAR FILE YANG DIPILIH -->

                    <div
                        id="list_file"
                        class="file-list"
                    ></div>


                    <small class="text-muted d-block mt-2">

                        <i class="fas fa-info-circle me-1"></i>

                        Bisa memilih beberapa dokumen sekaligus.

                        Format:
                        PDF, JPG, JPEG, PNG.

                        Maksimal 5 MB per file.

                    </small>

                </div>


                <!-- =================================================
                     DOKUMEN SEBELUMNYA
                ================================================== -->

                <?php if(!empty($tiket['dokumen_hasil'])): ?>

                    <div class="previous-document mb-4">

                        <strong>

                            <i class="fas fa-folder-open me-2"></i>

                            Dokumen Hasil yang Sudah Tersimpan

                        </strong>


                        <ul class="mt-3">

                            <?php foreach(
                                $tiket['dokumen_hasil']
                                as $index => $dokumen
                            ): ?>

                                <?php
                                    $namaFile =
                                        $dokumen['nama_file']
                                        ?? $dokumen['file_name']
                                        ?? '';

                                    $namaAsli =
                                        $dokumen['nama_asli']
                                        ?? $dokumen['original_name']
                                        ?? $namaFile;
                                ?>


                                <?php if($namaFile !== ''): ?>

                                    <li class="mb-2">

                                        <a
                                            href="<?= base_url(
                                                'keuangan/lihat/' .
                                                rawurlencode($namaFile)
                                            ) ?>"
                                            target="_blank"
                                        >

                                            <i class="fas fa-file me-1"></i>

                                            <?= esc($namaAsli) ?>

                                        </a>

                                    </li>

                                <?php endif; ?>

                            <?php endforeach; ?>

                        </ul>

                    </div>

                <?php endif; ?>


            </div>


            <!-- =================================================
                 ACTION
            ================================================== -->

            <div class="process-actions">


                <button
                    type="submit"
                    class="btn btn-process"
                >

                    <i class="fas fa-save me-1"></i>

                    Simpan Proses

                </button>


                <a
                    href="<?= base_url(
                        'keuangan/detail/' .
                        (int)($tiket['id'] ?? 0)
                    ) ?>"
                    class="btn btn-secondary"
                >

                    <i class="fas fa-arrow-left me-1"></i>

                    Kembali

                </a>


            </div>


        </form>


    </div>

</div>


<!-- =====================================================
     JAVASCRIPT MULTIPLE FILE
===================================================== -->

<script>

document.addEventListener('DOMContentLoaded', function(){

    const inputFile =
        document.getElementById('file_hasil');

    const listFile =
        document.getElementById('list_file');


    if(!inputFile || !listFile){
        return;
    }


    /*
    |--------------------------------------------------------------------------
    | Daftar file yang dipilih
    |--------------------------------------------------------------------------
    */

    let daftarFile = [];


    /*
    |--------------------------------------------------------------------------
    | Ketika user memilih file
    |--------------------------------------------------------------------------
    */

    inputFile.addEventListener('change', function(){

        const files =
            Array.from(this.files);


        files.forEach(function(file){

            /*
            | Maksimal 5 MB
            */

            if(file.size > 5 * 1024 * 1024){

                alert(
                    'File "' +
                    file.name +
                    '" melebihi ukuran maksimal 5 MB.'
                );

                return;
            }


            /*
            | Cek ekstensi
            */

            const extension =
                file.name
                    .split('.')
                    .pop()
                    .toLowerCase();


            const allowed = [
                'pdf',
                'jpg',
                'jpeg',
                'png'
            ];


            if(!allowed.includes(extension)){

                alert(
                    'Format file "' +
                    file.name +
                    '" tidak diperbolehkan.'
                );

                return;
            }


            /*
            | Cegah file yang sama masuk dua kali
            */

            const sudahAda =
                daftarFile.some(function(existingFile){

                    return (
                        existingFile.name === file.name &&
                        existingFile.size === file.size &&
                        existingFile.lastModified === file.lastModified
                    );

                });


            if(!sudahAda){

                daftarFile.push(file);

            }

        });


        renderFileList();


        /*
        | Penting:
        | File input langsung menyimpan semua file.
        */

        updateInputFiles();

    });


    /*
    |--------------------------------------------------------------------------
    | Tampilkan daftar file
    |--------------------------------------------------------------------------
    */

    function renderFileList(){

        listFile.innerHTML = '';


        daftarFile.forEach(function(file,index){

            const ukuran =
                (
                    file.size /
                    1024 /
                    1024
                ).toFixed(2);


            const item =
                document.createElement('div');


            item.className =
                'file-item';


            item.innerHTML = `

                <div class="file-item-left">

                    <i class="fas fa-file text-primary me-2"></i>

                    <span class="file-item-name">

                        <strong>
                            ${escapeHtml(file.name)}
                        </strong>

                        <span class="file-item-size">
                            (${ukuran} MB)
                        </span>

                    </span>

                </div>


                <button
                    type="button"
                    class="btn btn-danger btn-sm remove-file"
                    data-index="${index}"
                >

                    <i class="fas fa-times"></i>

                </button>

            `;


            listFile.appendChild(item);

        });


        /*
        | Tombol hapus file
        */

        document
            .querySelectorAll('.remove-file')
            .forEach(function(button){

                button.addEventListener(
                    'click',
                    function(){

                        const index =
                            parseInt(
                                this.dataset.index,
                                10
                            );


                        daftarFile.splice(
                            index,
                            1
                        );


                        renderFileList();

                        updateInputFiles();

                    }
                );

            });

    }


    /*
    |--------------------------------------------------------------------------
    | Masukkan kembali file ke input
    |--------------------------------------------------------------------------
    */

    function updateInputFiles(){

        const dataTransfer =
            new DataTransfer();


        daftarFile.forEach(function(file){

            dataTransfer.items.add(file);

        });


        inputFile.files =
            dataTransfer.files;

    }


    /*
    |--------------------------------------------------------------------------
    | Escape HTML
    |--------------------------------------------------------------------------
    */

    function escapeHtml(text){

        const div =
            document.createElement('div');

        div.textContent =
            text;

        return div.innerHTML;

    }

});

</script>


<?= $this->endSection() ?>