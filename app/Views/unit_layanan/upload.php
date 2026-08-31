<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        <?= esc($title ?? 'Upload Dokumen Hasil') ?>
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body{
            background:#f8f9fa;
        }

        .card{
            border:none;
            border-radius:15px;
        }

        .btn-primary{
            background:#293582;
            border:none;
        }

        .btn-primary:hover{
            background:#ff7f00;
        }

        .file-item{
            border:1px solid #dee2e6;
            border-radius:10px;
            padding:12px 15px;
            margin-bottom:10px;
            background:#fff;
        }

    </style>

</head>


<body>


<div class="container mt-4 mb-5">


    <h3 class="mb-4">
        Upload Dokumen Hasil Tiket
    </h3>


    <!-- =====================================================
         FLASH ERROR
    ====================================================== -->

    <?php if (session()->getFlashdata('error')): ?>

        <div class="alert alert-danger alert-dismissible fade show">

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
         FLASH SUCCESS
    ====================================================== -->

    <?php if (session()->getFlashdata('success')): ?>

        <div class="alert alert-success alert-dismissible fade show">

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
         CARD
    ====================================================== -->

    <div class="card shadow">

        <div class="card-body p-4">


            <!-- =================================================
                 FORM
            ================================================== -->

            <form
                action="<?= base_url(
                    'unit-layanan/simpanUpload/'
                    . $tiket['id']
                ) ?>"
                method="post"
                enctype="multipart/form-data"
            >

                <?= csrf_field(); ?>


                <!-- =================================================
                     NOMOR TIKET
                ================================================== -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Nomor Tiket
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc(
                            $tiket['no_tiket']
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- =================================================
                     NAMA LAYANAN
                ================================================== -->

                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Nama Layanan
                    </label>

                    <input
                        type="text"
                        class="form-control"
                        value="<?= esc(
                            $tiket['nama_layanan']
                            ?? '-'
                        ) ?>"
                        readonly
                    >

                </div>


                <!-- =================================================
                     DOKUMEN HASIL YANG SUDAH ADA
                ================================================== -->

                <?php if (
                    !empty($dokumen_hasil) &&
                    is_array($dokumen_hasil)
                ): ?>

                    <div class="mb-4">

                        <label class="form-label fw-bold">
                            Dokumen Hasil Yang Sudah Ada
                        </label>


                        <?php foreach (
                            $dokumen_hasil
                            as $dokumen
                        ): ?>

                            <?php

                            $namaFile =
                                $dokumen['nama_file']
                                ?? '';

                            ?>


                            <?php if (
                                !empty($namaFile)
                            ): ?>

                                <div class="file-item">

                                    <div
                                        class="d-flex justify-content-between align-items-center flex-wrap gap-2"
                                    >

                                        <div>

                                            <i class="fas fa-file me-2"></i>

                                            <?= esc(
                                                $namaFile
                                            ) ?>

                                        </div>


                                        <a
                                            href="<?= base_url(
                                                'uploads/hasil/'
                                                . $namaFile
                                            ) ?>"
                                            target="_blank"
                                            class="btn btn-success btn-sm"
                                        >

                                            <i class="fas fa-eye me-1"></i>

                                            Lihat Dokumen

                                        </a>

                                    </div>

                                </div>

                            <?php endif; ?>

                        <?php endforeach; ?>

                    </div>

                <?php else: ?>

                    <div class="alert alert-secondary">

                        <i class="fas fa-info-circle me-2"></i>

                        Belum ada dokumen hasil yang diupload.

                    </div>

                <?php endif; ?>


                <!-- =================================================
                     UPLOAD FILE BARU
                ================================================== -->

                <div class="mb-3">

                    <label
                        for="file_hasil"
                        class="form-label fw-bold"
                    >
                        Upload Dokumen Hasil Baru
                    </label>


                    <input
                        type="file"
                        name="file_hasil[]"
                        id="file_hasil"
                        class="form-control"
                        multiple
                        accept=".pdf,.jpg,.jpeg,.png"
                    >


                    <small class="text-muted">

                        Bisa upload banyak file tanpa batas.<br>

                        Format:
                        PDF, JPG, JPEG, PNG.<br>

                        Maksimal 5 MB per file.

                    </small>

                </div>


                <!-- =================================================
                     TOMBOL
                ================================================== -->

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="fas fa-upload me-1"></i>

                    Upload Dokumen

                </button>


                <a
                    href="<?= base_url(
                        'unit-layanan/dashboard'
                    ) ?>"
                    class="btn btn-secondary"
                >

                    <i class="fas fa-arrow-left me-1"></i>

                    Kembali

                </a>


            </form>


        </div>

    </div>


</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>