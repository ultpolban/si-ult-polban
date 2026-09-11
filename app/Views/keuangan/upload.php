<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>

/* =====================================================
   HEADER
===================================================== */

.upload-header{
    margin-bottom:25px;
}

.upload-title{
    font-size:30px;
    font-weight:700;
    color:#172033;
    margin-bottom:5px;
}

.upload-subtitle{
    color:#6c757d;
    margin:0;
}


/* =====================================================
   CARD
===================================================== */

.upload-card{
    background:#fff;
    border:none;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.08);
    overflow:hidden;
}

.upload-card-header{
    padding:22px 28px;
    border-bottom:1px solid #eee;
    background:#fff;
}

.upload-card-header h5{
    margin:0;
    font-size:20px;
    font-weight:700;
    color:#172033;
}

.upload-card-body{
    padding:28px;
}


/* =====================================================
   TICKET INFO
===================================================== */

.ticket-info{
    background:#f8f9fa;
    border:1px solid #e5e7eb;
    border-radius:12px;
    padding:18px;
    margin-bottom:25px;
}

.ticket-info-label{
    display:block;
    color:#293582;
    font-size:14px;
    font-weight:700;
    margin-bottom:5px;
}

.ticket-info-value{
    margin:0;
    color:#172033;
    font-size:17px;
    font-weight:600;
}


/* =====================================================
   FORM
===================================================== */

.form-label{
    color:#293582;
    font-weight:700;
    margin-bottom:8px;
}

.form-control{
    border-radius:10px;
    padding:11px 13px;
}

.form-control:focus{
    border-color:#293582;
    box-shadow:0 0 0 .2rem rgba(41,53,130,.12);
}


/* =====================================================
   FILE INFO
===================================================== */

.file-info{
    margin-top:10px;
    padding:12px 15px;
    background:#f8f9fa;
    border:1px solid #e5e7eb;
    border-radius:10px;
    color:#6c757d;
    font-size:14px;
}

.file-info i{
    color:#293582;
}


/* =====================================================
   ACTION
===================================================== */

.upload-actions{
    margin-top:25px;
    padding-top:22px;
    border-top:1px solid #eee;
}

.upload-actions .btn{
    border-radius:10px;
    padding:10px 18px;
    margin-right:7px;
}

.btn-upload{
    background:#293582;
    border:none;
    color:#fff;
}

.btn-upload:hover{
    background:#ff7f00;
    color:#fff;
}


/* =====================================================
   ALERT
===================================================== */

.alert{
    border-radius:10px;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media(max-width:768px){

    .upload-title{
        font-size:24px;
    }

    .upload-card-body{
        padding:20px;
    }

}

</style>


<!-- =====================================================
     HEADER
===================================================== -->

<div class="upload-header">

    <h2 class="upload-title">
        Upload Dokumen Hasil Layanan
    </h2>

    <p class="upload-subtitle">
        Upload dokumen hasil layanan untuk pengajuan tiket Keuangan
    </p>

</div>


<!-- =====================================================
     FLASH MESSAGE
===================================================== -->

<?php if(session()->getFlashdata('success')): ?>

    <div class="alert alert-success">

        <i class="fas fa-check-circle me-2"></i>

        <?= esc(session()->getFlashdata('success')) ?>

    </div>

<?php endif; ?>


<?php if(session()->getFlashdata('error')): ?>

    <div class="alert alert-danger">

        <i class="fas fa-exclamation-circle me-2"></i>

        <?= esc(session()->getFlashdata('error')) ?>

    </div>

<?php endif; ?>


<?php if(isset($validation) && $validation->getErrors()): ?>

    <div class="alert alert-danger">

        <i class="fas fa-exclamation-circle me-2"></i>

        <?= esc($validation->listErrors()) ?>

    </div>

<?php endif; ?>


<!-- =====================================================
     CARD
===================================================== -->

<div class="upload-card">


    <!-- =================================================
         CARD HEADER
    ================================================== -->

    <div class="upload-card-header">

        <h5>

            <i class="fas fa-file-upload text-primary me-2"></i>

            Upload Dokumen Keuangan

        </h5>

    </div>


    <!-- =================================================
         CARD BODY
    ================================================== -->

    <div class="upload-card-body">


        <!-- =================================================
             INFORMASI TIKET
        ================================================== -->

        <div class="ticket-info">

            <span class="ticket-info-label">
                Nomor Tiket
            </span>

            <p class="ticket-info-value">

                <?= esc(
                    $tiket['no_tiket']
                    ?? $tiket['ticket_number']
                    ?? '-'
                ) ?>

            </p>

        </div>


        <!-- =================================================
             FORM UPLOAD
        ================================================== -->

        <form
            method="post"
            action="<?= base_url(
                'keuangan/simpanUpload/'
                . (int)($tiket['id'] ?? 0)
            ) ?>"
            enctype="multipart/form-data"
        >

            <?= csrf_field() ?>


            <!-- =================================================
                 FILE
            ================================================== -->

            <div class="mb-3">

                <label
                    for="dokumen"
                    class="form-label"
                >

                    <i class="fas fa-file me-1"></i>

                    Dokumen Hasil Layanan

                </label>


                <input
                    type="file"
                    name="dokumen"
                    id="dokumen"
                    class="form-control"
                    accept=".pdf,.jpg,.jpeg,.png"
                    required
                >


                <div class="file-info">

                    <i class="fas fa-info-circle me-1"></i>

                    Format yang diperbolehkan:
                    <strong>PDF, JPG, JPEG, PNG</strong>.

                    Ukuran maksimal:

                    <strong>5 MB</strong>.

                </div>

            </div>


            <!-- =================================================
                 ACTION
            ================================================== -->

            <div class="upload-actions">


                <button
                    type="submit"
                    class="btn btn-upload"
                >

                    <i class="fas fa-upload me-1"></i>

                    Upload Dokumen

                </button>


                <a
                    href="<?= base_url(
                        'keuangan/detail/'
                        . (int)($tiket['id'] ?? 0)
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


<script>

/*
|--------------------------------------------------------------------------
| Tampilkan nama file yang dipilih
|--------------------------------------------------------------------------
*/

document.addEventListener('DOMContentLoaded', function(){

    const input = document.getElementById('dokumen');

    if(!input){
        return;
    }

    input.addEventListener('change', function(){

        const file = this.files[0];

        if(!file){
            return;
        }

        const maxSize = 5 * 1024 * 1024;

        if(file.size > maxSize){

            alert(
                'Ukuran dokumen terlalu besar. Maksimal 5 MB.'
            );

            this.value = '';

            return;
        }

    });

});

</script>


<?= $this->endSection() ?>