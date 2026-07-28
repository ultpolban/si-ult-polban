<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_mahasiswa') ?>


<div class="content-wrapper">

    <!-- ==========================================
         HEADER
    =========================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1
                        style="
                            color:#0b3d91;
                            font-weight:700;
                        "
                    >

                        <i class="fas fa-edit"></i>

                        Lanjutkan Draft Pengajuan

                    </h1>

                </div>

            </div>

        </div>

    </section>


    <!-- ==========================================
         MAIN CONTENT
    =========================================== -->

    <section class="content">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-lg-8 col-md-10">


                    <!-- ==========================================
                         CARD
                    =========================================== -->

                    <div
                        class="card shadow-sm"
                        style="
                            border-top:5px solid #0b3d91;
                            border-radius:15px;
                        "
                    >


                        <!-- CARD HEADER -->

                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                            "
                        >

                            <h3 class="card-title">

                                <i class="fas fa-file-alt me-2"></i>

                                Edit Draft Pengajuan

                            </h3>

                        </div>


                        <!-- CARD BODY -->

                        <div class="card-body">


                            <!-- ==========================================
                                 SUCCESS MESSAGE
                            =========================================== -->

                            <?php if (session()->getFlashdata('success')): ?>

                                <div
                                    class="alert alert-success alert-dismissible fade show"
                                >

                                    <i
                                        class="fas fa-check-circle me-2"
                                    ></i>

                                    <?= esc(
                                        session()->getFlashdata('success')
                                    ) ?>

                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="alert"
                                    >
                                        &times;
                                    </button>

                                </div>

                            <?php endif; ?>


                            <!-- ==========================================
                                 ERROR MESSAGE
                            =========================================== -->

                            <?php if (session()->getFlashdata('error')): ?>

                                <div
                                    class="alert alert-danger alert-dismissible fade show"
                                >

                                    <i
                                        class="fas fa-exclamation-circle me-2"
                                    ></i>

                                    <?= esc(
                                        session()->getFlashdata('error')
                                    ) ?>

                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="alert"
                                    >
                                        &times;
                                    </button>

                                </div>

                            <?php endif; ?>


                            <!-- ==========================================
                                 FORM
                                 PENTING:
                                 enctype diperlukan untuk upload file
                            =========================================== -->

                            <form
    action="<?= base_url(
        'mahasiswa/ticket/draft/update/' .
        ($draft_id ?? 0)
    ) ?>"
    method="post"
    enctype="multipart/form-data"
>

                                <?= csrf_field() ?>


                                <!-- ==========================================
                                     NOMOR DRAFT
                                =========================================== -->

                                <div class="mb-4">

                                    <label
                                        class="form-label fw-bold"
                                    >

                                        Nomor Draft

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        value="<?= esc(
                                            $draft['nomor'] ?? '-'
                                        ) ?>"
                                        readonly
                                    >

                                </div>


                                <!-- ==========================================
                                     JENIS LAYANAN
                                =========================================== -->

                                <div class="mb-4">

                                    <label
                                        for="layanan"
                                        class="form-label fw-bold"
                                    >

                                        Jenis Layanan

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>


                                    <select
                                        name="layanan"
                                        id="layanan"
                                        class="form-control"
                                        required
                                    >

                                        <option value="">

                                            -- Pilih Jenis Layanan --

                                        </option>


                                        <option
                                            value="Surat Aktif Kuliah"
                                            <?= (
                                                ($draft['layanan'] ?? '')
                                                === 'Surat Aktif Kuliah'
                                            )
                                                ? 'selected'
                                                : ''
                                            ?>
                                        >

                                            Surat Aktif Kuliah

                                        </option>


                                        <option
                                            value="Surat Beasiswa"
                                            <?= (
                                                ($draft['layanan'] ?? '')
                                                === 'Surat Beasiswa'
                                            )
                                                ? 'selected'
                                                : ''
                                            ?>
                                        >

                                            Surat Beasiswa

                                        </option>


                                        <option
                                            value="Legalisir Transkrip"
                                            <?= (
                                                ($draft['layanan'] ?? '')
                                                === 'Legalisir Transkrip'
                                            )
                                                ? 'selected'
                                                : ''
                                            ?>
                                        >

                                            Legalisir Transkrip

                                        </option>


                                        <option
                                            value="Surat Keterangan Mahasiswa"
                                            <?= (
                                                ($draft['layanan'] ?? '')
                                                === 'Surat Keterangan Mahasiswa'
                                            )
                                                ? 'selected'
                                                : ''
                                            ?>
                                        >

                                            Surat Keterangan Mahasiswa

                                        </option>


                                    </select>

                                </div>


                                <!-- ==========================================
                                     KETERANGAN
                                =========================================== -->

                                <div class="mb-4">

                                    <label
                                        for="keterangan"
                                        class="form-label fw-bold"
                                    >

                                        Keterangan / Detail Permohonan

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>


                                    <textarea
                                        name="keterangan"
                                        id="keterangan"
                                        class="form-control"
                                        rows="6"
                                        placeholder="Jelaskan detail permohonan layanan Anda..."
                                        required
                                    ><?= esc(
                                        $draft['keterangan'] ?? ''
                                    ) ?></textarea>

                                </div>


                                <!-- ==========================================
     DOKUMEN PENDUKUNG
=========================================== -->

<div class="mb-4">

    <label
        for="dokumen"
        class="form-label fw-bold"
    >

        Dokumen Pendukung

        <span class="text-muted">
            (Opsional)
        </span>

    </label>

    <input
        type="file"
        name="dokumen"
        id="dokumen"
        class="form-control"
        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
    >

    <small class="text-muted">

        Maksimal ukuran file 2 MB.
        Format yang diperbolehkan:
        PDF, JPG, JPEG, PNG, DOC, DOCX.

    </small>


    <?php if (!empty($draft['dokumen'])) : ?>

        <div class="mt-2">

            <i class="fas fa-paperclip"></i>

            Dokumen saat ini:

            <strong>
                <?= esc(
                    basename($draft['dokumen'])
                ) ?>
            </strong>

        </div>

    <?php endif; ?>

</div>


                                    <!-- ======================================
                                         FILE LAMA
                                    ======================================= -->

                                    <?php if (
                                        !empty(
                                            $draft['dokumen']
                                            ?? null
                                        )
                                    ): ?>

                                        <div
                                            class="mt-3 p-3"
                                            style="
                                                background:#f5f8fc;
                                                border-left:4px solid #0b3d91;
                                                border-radius:5px;
                                            "
                                        >

                                            <div
                                                class="font-weight-bold"
                                                style="
                                                    color:#0b3d91;
                                                "
                                            >

                                                <i
                                                    class="fas fa-file-alt mr-1"
                                                ></i>

                                                Dokumen Saat Ini

                                            </div>


                                            <div class="mt-2">

                                                <a
                                                    href="<?= base_url(
                                                        'uploads/dokumen/' .
                                                        $draft['dokumen']
                                                    ) ?>"
                                                    target="_blank"
                                                    class="btn btn-sm btn-primary"
                                                >

                                                    <i
                                                        class="fas fa-eye mr-1"
                                                    ></i>

                                                    Lihat Dokumen

                                                </a>

                                            </div>

                                        </div>

                                    <?php endif; ?>


                                </div>


                                <!-- ==========================================
                                     STATUS
                                =========================================== -->

                                <div class="mb-4">

                                    <label
                                        class="form-label fw-bold"
                                    >

                                        Status Draft

                                    </label>


                                    <div>

                                        <span
                                            class="badge badge-secondary"
                                            style="
                                                font-size:14px;
                                            "
                                        >

                                            <i
                                                class="fas fa-file-alt mr-1"
                                            ></i>

                                            Draft

                                        </span>

                                    </div>

                                </div>


                                <!-- ==========================================
                                     BUTTON
                                =========================================== -->

                                <div
                                    class="
                                        d-flex
                                        justify-content-between
                                        flex-wrap
                                        mt-4
                                    "
                                >


                                    <!-- KEMBALI -->

                                    <a
                                        href="<?= base_url(
                                            'mahasiswa/ticket/draft'
                                        ) ?>"
                                        class="btn btn-secondary"
                                    >

                                        <i
                                            class="fas fa-arrow-left mr-1"
                                        ></i>

                                        Kembali

                                    </a>


                                    <div
                                        class="
                                            d-flex
                                            flex-wrap
                                        "
                                    >


                                        <!-- SIMPAN PERUBAHAN -->

                                        <button
                                            type="submit"
                                            name="action"
                                            value="draft"
                                            class="btn mr-2"
                                            style="
                                                background:#f28c28;
                                                color:white;
                                                font-weight:600;
                                            "
                                        >

                                            <i
                                                class="fas fa-save mr-1"
                                            ></i>

                                            Simpan Perubahan

                                        </button>


                                        <!-- KIRIM PENGAJUAN -->

                                        <button
                                            type="submit"
                                            name="action"
                                            value="submit"
                                            class="btn btn-success"
                                        >

                                            <i
                                                class="fas fa-paper-plane mr-1"
                                            ></i>

                                            Kirim Pengajuan

                                        </button>


                                    </div>


                                </div>


                            </form>


                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>