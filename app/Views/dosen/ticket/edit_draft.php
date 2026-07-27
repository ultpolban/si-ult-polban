<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1
                        class="font-weight-bold"
                        style="color: #0d47a1;"
                    >

                        <i class="fas fa-edit mr-2"></i>

                        Lanjutkan Draft Pengajuan

                    </h1>

                </div>

            </div>

        </div>

    </section>


    <section class="content">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-lg-8">

                    <div class="card shadow-sm">


                        <div
                            class="card-header text-white"
                            style="
                                background-color: #0d47a1;
                                border-bottom: 4px solid #f7941d;
                            "
                        >

                            <h5 class="mb-0">

                                <i class="fas fa-file-alt mr-2"></i>

                                Edit Draft Pengajuan

                            </h5>

                        </div>


                        <div class="card-body">


                            <?php if (session()->getFlashdata('error')) : ?>

                                <div class="alert alert-danger">

                                    <i class="fas fa-exclamation-circle mr-2"></i>

                                    <?= session()->getFlashdata('error') ?>

                                </div>

                            <?php endif; ?>


                            <form
                                action="<?= base_url(
                                    'dosen/ticket/draft/update/' . $draft_index
                                ) ?>"
                                method="post"
                                enctype="multipart/form-data"
                            >

                                <?= csrf_field() ?>


                                <!-- UNIT TUJUAN -->

                                <div class="mb-4">

                                    <label class="form-label font-weight-bold">

                                        Unit Tujuan

                                        <span class="text-danger">*</span>

                                    </label>


                                    <select
                                        name="unit_tujuan"
                                        id="unit_tujuan"
                                        class="form-select"
                                        required
                                    >

                                        <option value="">

                                            -- Pilih Unit Tujuan --

                                        </option>


                                        <option
                                            value="akademik_kemahasiswaan"
                                            <?= ($draft['unit_tujuan'] ?? '') === 'akademik_kemahasiswaan'
                                                ? 'selected'
                                                : '' ?>
                                        >

                                            Bidang Akademik & Kemahasiswaan

                                        </option>


                                        <option
                                            value="keuangan"
                                            <?= ($draft['unit_tujuan'] ?? '') === 'keuangan'
                                                ? 'selected'
                                                : '' ?>
                                        >

                                            Bagian Keuangan

                                        </option>


                                        <option
                                            value="umum"
                                            <?= ($draft['unit_tujuan'] ?? '') === 'umum'
                                                ? 'selected'
                                                : '' ?>
                                        >

                                            Bagian Umum dan Kepegawaian

                                        </option>


                                        <option
                                            value="tik"
                                            <?= ($draft['unit_tujuan'] ?? '') === 'tik'
                                                ? 'selected'
                                                : '' ?>
                                        >

                                            Unit Teknologi Informasi dan Komunikasi

                                        </option>


                                        <option
                                            value="humas"
                                            <?= ($draft['unit_tujuan'] ?? '') === 'humas'
                                                ? 'selected'
                                                : '' ?>
                                        >

                                            Bagian Humas dan Informasi Publik

                                        </option>

                                    </select>

                                </div>


                                <!-- JENIS LAYANAN -->

                                <div class="mb-4">

                                    <label class="form-label font-weight-bold">

                                        Jenis Layanan

                                        <span class="text-danger">*</span>

                                    </label>


                                    <select
                                        name="jenis_layanan"
                                        id="jenis_layanan"
                                        class="form-select"
                                        required
                                    >

                                        <option
                                            value="<?= esc(
                                                $draft['jenis_layanan']
                                                ?? ''
                                            ) ?>"
                                            selected
                                        >

                                            <?= esc(
                                                $draft['jenis_layanan']
                                                ?? 'Pilih Jenis Layanan'
                                            ) ?>

                                        </option>

                                    </select>

                                </div>


                                <!-- JUDUL -->

                                <div class="mb-4">

                                    <label class="form-label font-weight-bold">

                                        Judul / Keperluan

                                        <span class="text-danger">*</span>

                                    </label>


                                    <input
                                        type="text"
                                        name="judul"
                                        class="form-control"
                                        value="<?= esc(
                                            $draft['judul']
                                            ?? ''
                                        ) ?>"
                                        required
                                    >

                                </div>


                                <!-- KETERANGAN -->

                                <div class="mb-4">

                                    <label class="form-label font-weight-bold">

                                        Keterangan / Detail Permohonan

                                        <span class="text-danger">*</span>

                                    </label>


                                    <textarea
                                        name="keterangan"
                                        class="form-control"
                                        rows="6"
                                        required
                                    ><?= esc(
                                        $draft['keterangan']
                                        ?? ''
                                    ) ?></textarea>

                                </div>


                                <!-- DOKUMEN -->

                                <div class="mb-4">

                                    <label class="form-label font-weight-bold">

                                        Ganti Dokumen Pendukung

                                    </label>


                                    <input
                                        type="file"
                                        name="dokumen"
                                        class="form-control"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                    >


                                    <small class="text-muted">

                                        Format PDF, JPG, JPEG, PNG.
                                        Maksimal 2 MB.

                                    </small>

                                </div>


                                <!-- BUTTON -->

                                <div class="d-flex justify-content-end gap-2">

                                    <a
                                        href="<?= base_url(
                                            'dosen/ticket/draft'
                                        ) ?>"
                                        class="btn btn-secondary"
                                    >

                                        <i class="fas fa-arrow-left mr-1"></i>

                                        Kembali

                                    </a>


                                    <button
                                        type="submit"
                                        class="btn text-white"
                                        style="
                                            background-color: #0d47a1;
                                            border-color: #0d47a1;
                                        "
                                    >

                                        <i class="fas fa-paper-plane mr-1"></i>

                                        Ajukan Layanan

                                    </button>

                                </div>


                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->endSection() ?>