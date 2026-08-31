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

.file-item{
    background:#f8f9fa;
    border:1px solid #e5e7eb;
    border-radius:10px;
    padding:10px 14px;
    margin-bottom:8px;
}

.file-item-name{
    word-break:break-all;
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
        Kelola status dan penanganan pengajuan tiket
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
     CARD UTAMA
===================================================== -->

<div class="process-card">


    <!-- =================================================
         HEADER CARD
    ================================================== -->

    <div class="process-card-header">

        <h5>

            <i class="fas fa-coins text-primary me-2"></i>

            Informasi Tiket

        </h5>

    </div>


    <!-- =================================================
         BODY
    ================================================== -->

    <div class="process-card-body">


        <form
            action="<?= base_url(
                'keuangan/updateProses/'
                . ($tiket['id'] ?? '')
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


                <!-- =========================================
                     NOMOR TIKET
                ========================================== -->

                <div class="mb-4">

                    <label class="process-label">
                        Nomor Tiket
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['no_tiket']
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- =========================================
                     UNIT LAYANAN
                ========================================== -->

                <div class="mb-4">

                    <label class="process-label">
                        Unit Layanan
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['nama_unit']
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- =========================================
                     KATEGORI LAYANAN
                ========================================== -->

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


                <!-- =========================================
                     JENIS LAYANAN
                ========================================== -->

                <div class="mb-4">

                    <label class="process-label">
                        Jenis Layanan
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['nama_layanan']
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- =========================================
                     JUDUL PENGAJUAN
                ========================================== -->

                <div class="mb-4">

                    <label class="process-label">
                        Judul Pengajuan
                    </label>

                    <input
                        type="text"
                        class="form-control process-control readonly-box"
                        value="<?= esc(
                            $tiket['judul']
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- =========================================
                     DESKRIPSI
                ========================================== -->

                <div class="mb-4">

                    <label class="process-label">
                        Deskripsi Pengajuan
                    </label>

                    <textarea
                        class="form-control process-control readonly-box"
                        readonly
                    ><?= esc(
                        $tiket['deskripsi']
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


                <!-- =========================================
                     STATUS
                ========================================== -->

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
                            value="Menunggu"
                            <?= (
                                ($tiket['status'] ?? '')
                                === 'Menunggu'
                            )
                                ? 'selected'
                                : ''
                            ?>
                        >
                            Menunggu
                        </option>


                        <option
                            value="Diproses"
                            <?= (
                                ($tiket['status'] ?? '')
                                === 'Diproses'
                            )
                                ? 'selected'
                                : ''
                            ?>
                        >
                            Diproses
                        </option>


                        <option
                            value="Selesai"
                            <?= (
                                ($tiket['status'] ?? '')
                                === 'Selesai'
                            )
                                ? 'selected'
                                : ''
                            ?>
                        >
                            Selesai
                        </option>


                    </select>

                </div>


                <!-- =========================================
                     CATATAN
                ========================================== -->

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


                    <!-- INPUT UNTUK MEMILIH FILE -->

                    <input
                        type="file"
                        id="file_hasil"
                        class="form-control process-control"
                        accept=".pdf,.jpg,.jpeg,.png"
                        multiple
                    >


                    <!-- INPUT SEBENARNYA YANG DIKIRIM KE SERVER -->

                    <input
                        type="file"
                        name="file_hasil[]"
                        id="file_storage"
                        multiple
                        hidden
                    >


                    <!-- DAFTAR FILE BARU -->

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


                <!-- =================================================
                     DOKUMEN SEBELUMNYA
                ================================================== -->

                <?php if(!empty($tiket['dokumen_hasil'])): ?>

                    <div class="previous-document mb-4">

                        <strong>

                            <i class="fas fa-folder-open me-2"></i>

                            Dokumen sebelumnya:

                        </strong>


                        <ul class="mt-3">


                            <?php foreach(
                                $tiket['dokumen_hasil']
                                as $dokumen
                            ): ?>


                                <li class="mb-2">

                                    <a
                                        href="<?= base_url(
                                            'uploads/hasil/'
                                            . $dokumen['nama_file']
                                        ) ?>"
                                        target="_blank"
                                    >

                                        <i class="fas fa-file me-1"></i>

                                        <?= esc(
                                            $dokumen['nama_asli']
                                            ?? $dokumen['nama_file']
                                        ) ?>

                                    </a>


                                    <a
                                        href="<?= base_url(
                                            'keuangan/hapus-dokumen/'
                                            . $dokumen['id']
                                        ) ?>"
                                        class="btn btn-danger btn-sm ms-2"
                                        onclick="return confirm(
                                            'Hapus dokumen ini?'
                                        )"
                                    >

                                        <i class="fas fa-trash"></i>

                                    </a>

                                </li>


                            <?php endforeach; ?>


                        </ul>

                    </div>

                <?php endif; ?>


            </div>


            <!-- =================================================
                 TOMBOL
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
                        'keuangan/detail/'
                        . ($tiket['id'] ?? '')
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
     JAVASCRIPT UPLOAD MULTIPLE FILE
===================================================== -->

<script>

let inputFile =
    document.getElementById('file_hasil');

let storageFile =
    document.getElementById('file_storage');

let listFile =
    document.getElementById('list_file');


let daftarFile = [];


/* =====================================================
   PILIH FILE
===================================================== */

inputFile.addEventListener(
    'change',
    function(){

        let fileBaru =
            Array.from(this.files);


        fileBaru.forEach(
            function(file){

                /* Maksimal 5 MB */

                if(file.size > 5242880){

                    alert(
                        'Ukuran ' +
                        file.name +
                        ' maksimal 5 MB'
                    );

                    return;

                }


                /*
                 * Cegah file yang sama
                 * dimasukkan dua kali
                 */

                let sudahAda =
                    daftarFile.some(
                        function(existingFile){

                            return (
                                existingFile.name
                                === file.name
                                &&
                                existingFile.size
                                === file.size
                            );

                        }
                    );


                if(!sudahAda){

                    daftarFile.push(file);

                }

            }
        );


        tampilkanFile();

        simpanFile();


        /*
         * Reset input supaya
         * file yang sama bisa dipilih kembali
         */

        this.value = '';

    }
);


/* =====================================================
   TAMPILKAN DAFTAR FILE
===================================================== */

function tampilkanFile(){

    listFile.innerHTML = '';


    daftarFile.forEach(
        function(file,index){

            let ukuran =
                (file.size / 1024 / 1024)
                .toFixed(2);


            listFile.innerHTML += `

                <div class="file-item d-flex justify-content-between align-items-center">

                    <div class="file-item-name">

                        <i class="fas fa-file me-2 text-primary"></i>

                        <strong>
                            ${file.name}
                        </strong>

                        <small class="text-muted ms-2">
                            (${ukuran} MB)
                        </small>

                    </div>


                    <button
                        type="button"
                        class="btn btn-danger btn-sm"
                        onclick="hapusFile(${index})"
                    >

                        <i class="fas fa-times"></i>

                    </button>

                </div>

            `;

        }
    );

}


/* =====================================================
   SIMPAN FILE KE INPUT FORM
===================================================== */

function simpanFile(){

    let dataTransfer =
        new DataTransfer();


    daftarFile.forEach(
        function(file){

            dataTransfer.items.add(file);

        }
    );


    storageFile.files =
        dataTransfer.files;

}


/* =====================================================
   HAPUS FILE
===================================================== */

function hapusFile(index){

    daftarFile.splice(
        index,
        1
    );


    tampilkanFile();

    simpanFile();

}

</script>


<?= $this->endSection() ?>