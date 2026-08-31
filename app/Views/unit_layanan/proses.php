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
        Kelola status dan penanganan pengajuan tiket
    </p>

</div>


<!-- =====================================================
     FLASH MESSAGE
===================================================== -->

<?php if(session()->getFlashdata('success')): ?>

    <div class="alert alert-success process-alert">

        <i class="fas fa-check-circle me-2"></i>

        <?= session()->getFlashdata('success') ?>

    </div>

<?php endif; ?>


<?php if(session()->getFlashdata('error')): ?>

    <div class="alert alert-danger process-alert">

        <i class="fas fa-exclamation-circle me-2"></i>

        <?= session()->getFlashdata('error') ?>

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
    ================================================== -->

    <div class="process-card-body">


        <form
            action="<?= base_url(
                'unit-layanan/updateProses/'
                . ($tiket['id'] ?? '')
            ) ?>"
            method="post"
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
                            ?? 'Layanan ULT'
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
                 PROSES TIKET
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

                        <?php

                        $currentStatus =
                            strtolower(
                                trim(
                                    (string)(
                                        $tiket[
                                            'status'
                                        ]
                                        ?? ''
                                    )
                                )
                            );

                        ?>


                        <option
                            value="menunggu"
                            <?= in_array(
                                $currentStatus,
                                [
                                    'menunggu',
                                    'submitted'
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
                            value="diproses"
                            <?= in_array(
                                $currentStatus,
                                [
                                    'diproses',
                                    'processing'
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
                            value="selesai"
                            <?= in_array(
                                $currentStatus,
                                [
                                    'selesai',
                                    'completed'
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


                <!-- =========================================
                     CATATAN
                ========================================== -->

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
                 TOMBOL
            ================================================== -->

            <div class="process-actions">


                <button
                    type="submit"
                    class="btn btn-process"
                >

                    <i class="fas fa-save me-1"></i>

                    Simpan Perubahan

                </button>


                <a
                    href="<?= base_url(
                        'unit-layanan/detail/'
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


<?= $this->endSection() ?>