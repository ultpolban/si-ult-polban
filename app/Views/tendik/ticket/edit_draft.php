<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_tendik') ?>


<div class="content-wrapper">

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


    <section class="content">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-lg-8 col-md-10">


                    <div
                        class="card shadow-sm"
                        style="
                            border-top:5px solid #0b3d91;
                            border-radius:15px;
                        "
                    >


                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                            "
                        >

                            <h3 class="card-title">

                                <i class="fas fa-file-alt mr-2"></i>

                                Edit Draft Pengajuan

                            </h3>

                        </div>


                        <div class="card-body">


                            <?php if (
                                session()->getFlashdata('error')
                            ): ?>

                                <div
                                    class="alert alert-danger"
                                >

                                    <i
                                        class="fas fa-exclamation-circle mr-2"
                                    ></i>

                                    <?= esc(
                                        session()->getFlashdata('error')
                                    ) ?>

                                </div>

                            <?php endif; ?>


                            <<form
    action="<?= base_url(
        'tendik/ticket/draft/update/' .
        ($draft_index ?? 0)
    ) ?>"
    method="post"
    enctype="multipart/form-data"
>

                                <?= csrf_field() ?>


                                <!-- NOMOR -->
                                <div class="form-group">

                                    <label class="font-weight-bold">

                                        Nomor Draft

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control"
                                        value="<?= esc(
                                            $draft['nomor_tiket']
                                            ?? '-'
                                        ) ?>"
                                        readonly
                                    >

                                </div>


                                <!-- UNIT -->
                                <div class="form-group">

                                    <label class="font-weight-bold">

                                        Unit Tujuan

                                    </label>

                                    <select
                                        name="unit_tujuan"
                                        class="form-control"
                                        required
                                    >

                                        <option value="">

                                            -- Pilih Unit Tujuan --

                                        </option>


                                        <?php
                                        $units = [
                                            'Akademik',
                                            'Kemahasiswaan',
                                            'Keuangan',
                                            'Umum'
                                        ];
                                        ?>


                                        <?php foreach (
                                            $units
                                            as $unit
                                        ): ?>

                                            <option
                                                value="<?= $unit ?>"
                                                <?= (
                                                    ($draft['unit_tujuan'] ?? '')
                                                    === $unit
                                                )
                                                    ? 'selected'
                                                    : ''
                                                ?>
                                            >

                                                <?= $unit ?>

                                            </option>

                                        <?php endforeach; ?>


                                    </select>

                                </div>


                                <!-- JENIS LAYANAN -->
                                <div class="form-group">

                                    <label class="font-weight-bold">

                                        Jenis Layanan

                                    </label>

                                    <input
                                        type="text"
                                        name="jenis_layanan"
                                        class="form-control"
                                        value="<?= esc(
                                            $draft['jenis_layanan']
                                            ?? ''
                                        ) ?>"
                                        required
                                    >

                                </div>


                                <!-- JUDUL -->
                                <div class="form-group">

                                    <label class="font-weight-bold">

                                        Judul Pengajuan

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
                                <div class="form-group">

                                    <label class="font-weight-bold">

                                        Keterangan / Detail Permohonan

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

                                    <!-- ========================================== -->
<!-- DOKUMEN PENDUKUNG -->
<!-- ========================================== -->

<div class="form-group mt-4">

    <label
        for="dokumen"
        class="font-weight-bold"
    >

        <i class="fas fa-paperclip mr-1"></i>

        Dokumen Pendukung

        <span class="text-muted font-weight-normal">

            (Opsional)

        </span>

    </label>


    <!-- DOKUMEN LAMA -->

    <?php if (
        !empty($draft['dokumen']) &&
        !empty($draft['dokumen']['nama_asli'])
    ) : ?>

        <div
            class="alert alert-info"
        >

            <i class="fas fa-file-alt mr-2"></i>

            <strong>
                Dokumen saat ini:
            </strong>

            <?= esc(
                $draft['dokumen']['nama_asli']
            ) ?>

        </div>

    <?php endif; ?>


    <!-- INPUT FILE -->

    <div class="custom-file">

        <input
            type="file"
            name="dokumen"
            id="dokumen"
            class="custom-file-input"
            accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
        >

        <label
            class="custom-file-label"
            for="dokumen"
        >

            Pilih dokumen baru...

        </label>

    </div>


    <small class="form-text text-muted">

        Pilih file baru jika ingin mengganti
        dokumen sebelumnya.

        <br>

        Format:
        PDF, DOC, DOCX, JPG, JPEG, PNG.

        Maksimal ukuran <strong>2 MB</strong>.

    </small>

</div>

                                </div>


                                <!-- BUTTON -->
                                <div
                                    class="
                                        d-flex
                                        justify-content-between
                                        flex-wrap
                                        mt-4
                                    "
                                >


                                    <a
                                        href="<?= base_url(
                                            'tendik/ticket/draft'
                                        ) ?>"
                                        class="btn btn-secondary"
                                    >

                                        <i
                                            class="fas fa-arrow-left mr-1"
                                        ></i>

                                        Kembali

                                    </a>


                                    <div>


                                        <button
                                            type="submit"
                                            name="action"
                                            value="draft"
                                            class="btn"
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

<script>

document
    .getElementById('dokumen')
    ?.addEventListener('change', function (e) {

        const fileName =
            e.target.files[0]?.name
            || 'Pilih dokumen baru...';

        const label =
            document.querySelector(
                'label[for="dokumen"]'
            );

        if (label) {

            label.textContent =
                fileName;

        }

    });

</script>

<?= $this->include('layouts/footer') ?>