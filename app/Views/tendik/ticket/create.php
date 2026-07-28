<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_tendik') ?>


<div class="content-wrapper">

    <!-- HEADER -->
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

                        <i class="fas fa-plus-circle"></i>

                        Ajukan Layanan

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url('dashboard-tendik') ?>"
                            >

                                Dashboard

                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            Ajukan Layanan

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>


    <!-- CONTENT -->
    <section class="content">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-lg-9 col-md-11">


                    <!-- ERROR -->
                    <?php if (session()->getFlashdata('error')): ?>

                        <div
                            class="alert alert-danger alert-dismissible fade show"
                        >

                            <i
                                class="fas fa-exclamation-circle mr-2"
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


                    <!-- CARD -->
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

                                <i
                                    class="fas fa-file-alt mr-2"
                                ></i>

                                Form Pengajuan Layanan Tendik

                            </h3>

                        </div>


                        <!-- CARD BODY -->
                        <div class="card-body">


                            <form
    action="<?= base_url(
        'tendik/ticket/store'
    ) ?>"
    method="post"
    enctype="multipart/form-data"
>

                                <?= csrf_field() ?>


                                <!-- UNIT TUJUAN -->
                                <div class="form-group">

                                    <label>

                                        Unit Tujuan

                                        <span
                                            class="text-danger"
                                        >
                                            *
                                        </span>

                                    </label>


                                    <select
                                        name="unit_tujuan"
                                        class="form-control"
                                        required
                                    >

                                        <option value="">

                                            -- Pilih Unit Tujuan --

                                        </option>


                                        <option value="Akademik">

                                            Akademik

                                        </option>


                                        <option value="Kemahasiswaan">

                                            Kemahasiswaan

                                        </option>


                                        <option value="Keuangan">

                                            Keuangan

                                        </option>


                                        <option value="Umum">

                                            Umum

                                        </option>


                                    </select>

                                </div>


                                <!-- JENIS LAYANAN -->
                                <div class="form-group">

                                    <label>

                                        Jenis Layanan

                                        <span
                                            class="text-danger"
                                        >
                                            *
                                        </span>

                                    </label>


                                    <select
                                        name="jenis_layanan"
                                        class="form-control"
                                        required
                                    >

                                        <option value="">

                                            -- Pilih Jenis Layanan --

                                        </option>


                                        <option value="Administrasi Kepegawaian">

                                            Administrasi Kepegawaian

                                        </option>


                                        <option value="Surat Keterangan">

                                            Surat Keterangan

                                        </option>


                                        <option value="Administrasi Umum">

                                            Administrasi Umum

                                        </option>


                                        <option value="Layanan Keuangan">

                                            Layanan Keuangan

                                        </option>


                                        <option value="Layanan Akademik">

                                            Layanan Akademik

                                        </option>


                                    </select>

                                </div>


                                <!-- JUDUL -->
                                <div class="form-group">

                                    <label>

                                        Judul Pengajuan

                                        <span
                                            class="text-danger"
                                        >
                                            *
                                        </span>

                                    </label>


                                    <input
                                        type="text"
                                        name="judul"
                                        class="form-control"
                                        placeholder="Masukkan judul pengajuan"
                                        value="<?= old('judul') ?>"
                                        required
                                    >

                                </div>


                                <!-- KETERANGAN -->
                                <div class="form-group">

                                    <label>

                                        Keterangan / Detail Permohonan

                                        <span
                                            class="text-danger"
                                        >
                                            *
                                        </span>

                                    </label>


                                    <textarea
                                        name="keterangan"
                                        class="form-control"
                                        rows="6"
                                        placeholder="Jelaskan detail permohonan layanan Anda..."
                                        required
                                    ><?= old('keterangan') ?></textarea>

                                </div>

                                <!-- ========================================== -->
<!-- UPLOAD DOKUMEN -->
<!-- ========================================== -->

<div class="form-group">

    <label>

        Dokumen Pendukung

        <span class="text-muted">
            (Opsional)
        </span>

    </label>


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

            Pilih dokumen...

        </label>

    </div>


    <small class="form-text text-muted">

        Format yang diperbolehkan:
        PDF, DOC, DOCX, JPG, JPEG, PNG.

        Maksimal ukuran file <strong>2 MB</strong>.

    </small>

</div>


                                <!-- INFORMASI USER -->
                                <div
                                    class="alert alert-info"
                                >

                                    <i
                                        class="fas fa-info-circle mr-2"
                                    ></i>

                                    Pastikan data pengajuan sudah benar
                                    sebelum dikirim.

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


                                    <!-- KEMBALI -->
                                    <a
                                        href="<?= base_url(
                                            'dashboard-tendik'
                                        ) ?>"
                                        class="btn btn-secondary"
                                    >

                                        <i
                                            class="fas fa-arrow-left mr-1"
                                        ></i>

                                        Kembali

                                    </a>


                                    <div>


                                        <!-- SIMPAN DRAFT -->
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

                                            Simpan Draft

                                        </button>


                                        <!-- AJUKAN -->
                                        <button
                                            type="submit"
                                            name="action"
                                            value="submit"
                                            class="btn btn-success"
                                        >

                                            <i
                                                class="fas fa-paper-plane mr-1"
                                            ></i>

                                            Ajukan Layanan

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
            || 'Pilih dokumen...';

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