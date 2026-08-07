<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_orangtua') ?>

<div class="content-wrapper">

    <!-- =====================================================
         HEADER
    ====================================================== -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1
                        style="
                            color:#0b3d91;
                            font-weight:700;
                        ">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Ajukan Layanan
                    </h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a
                                href="<?= base_url(
                                            'dashboard-orangtua'
                                        ) ?>">

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

    <!-- =====================================================
         CONTENT
    ====================================================== -->
    <section class="content">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-lg-8 col-md-10">
                    <!-- =================================================
                         ALERT ERROR
                    ================================================== -->

                    <?php if (
                        session()->getFlashdata('error')
                    ) : ?>

                        <div
                            class="
                                alert
                                alert-danger
                                alert-dismissible
                                fade
                                show
                            ">

                            <i
                                class="
                                    fas
                                    fa-exclamation-circle
                                    mr-2
                                "></i>

                            <?= esc(
                                session()->getFlashdata('error')
                            ) ?>

                            <button
                                type="button"
                                class="close"
                                data-dismiss="alert">

                                &times;

                            </button>
                        </div>

                    <?php endif; ?>
                    <!-- ================================================
                         CARD
                    ================================================== -->
                    <div
                        class="
                            card
                            shadow-sm
                        "
                        style="
                            border-top:5px solid #0b3d91;
                            border-radius:15px;
                        ">


                        <!-- CARD HEADER -->

                        <div
                            class="
                                card-header
                            "
                            style="
                                background:#0b3d91;
                                color:white;
                            ">

                            <h3 class="card-title">

                                <i
                                    class="
                                        fas
                                        fa-file-alt
                                        mr-2
                                    "></i>

                                Form Pengajuan Layanan

                            </h3>

                        </div>

                        <!-- CARD BODY -->

                        <div class="card-body">


                            <!-- =================================================
                                 FORM
                            ================================================== -->
                            <form
                                action="<?= base_url(
                                            'orangtua/ticket/store'
                                        ) ?>"
                                method="post"
                                enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <!-- =================================================
                                     UNIT LAYANAN
                                ================================================== -->
                                <div class="form-group">
                                    <label
                                        for="unit_layanan"
                                        class="
                                            font-weight-bold">
                                        Unit Layanan
                                        <span class="text-danger">
                                            *
                                        </span>
                                    </label>
                                    <select
                                        name="unit_layanan"
                                        id="unit_layanan"
                                        class="form-control"
                                        required>
                                        <option value="">

                                            -- Pilih Unit Layanan --

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
                                    </select>
                                </div>
                                <!-- =================================================
     NIK (Readonly)
================================================== -->

                                <div class="form-group">

                                    <label
                                        for="nik"
                                        class="font-weight-bold">
                                        NIK
                                    </label>

                                    <input
                                        type="text"
                                        id="nik"
                                        class="form-control"
                                        value="<?= session()->get('nik') ?? '3273010101040001'; ?>"
                                        readonly>
                                </div>
                                <!-- =================================================
     NAMA MAHASISWA (Readonly)
================================================== -->
                                <div class="form-group">
                                    <label
                                        for="nama_mahasiswa"
                                        class="font-weight-bold">
                                        Nama Mahasiswa
                                    </label>

                                    <input
                                        type="text"
                                        id="nama_mahasiswa"
                                        class="form-control"
                                        value="<?= session()->get('nama') ?? 'Muhamad Rafi Putra Zakaria'; ?>"
                                        readonly>

                                </div>

                                <!-- =================================================
                                     JENIS LAYANAN
                                ================================================== -->
                                <div class="form-group">
                                    <label
                                        for="layanan"
                                        class="
                                            font-weight-bold">
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
                                        disabled>
                                        <option value="">
                                            -- Pilih Unit Layanan Terlebih Dahulu --
                                        </option>
                                    </select>
                                </div>
                                <!-- ================================================
                                     KETERANGAN
                                ================================================== -->
                                <div class="form-group">

                                    <label
                                        for="keterangan"
                                        class="
                                            font-weight-bold
                                        ">

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
                                        placeholder="
                                            Jelaskan detail permohonan layanan Anda...
                                        "
                                        required></textarea>
                                </div>
                                <!-- =================================================
                                     DOkUMEN
                                ================================================== -->
                                <div class="form-group">
                                    <label
                                        for="dokumen"
                                        class="
                                            font-weight-bold
                                        ">
                                        Dokumen Pendukung
                                        <span class="text-muted">
                                            (Opsional)
                                        </span>
                                    </label>
                                    <input
                                        type="file"
                                        name="dokumen"
                                        id="dokumen"
                                        class="
                                            form-control-file
                                        "
                                        accept="
                                            .pdf,
                                            .jpg,
                                            .jpeg,
                                            .png,
                                            .doc,
                                            .docx
                                        ">
                                    <small
                                        class="
                                            form-text
                                            text-muted
                                        ">
                                        Format yang diperbolehkan:
                                        PDF, JPG, JPEG, PNG, DOC, DOCX.
                                        <br>
                                        Ukuran maksimal:
                                        <strong>
                                            2 MB
                                        </strong>.
                                    </small>
                                </div>
                                <!-- =================================================
                                     BUTTON
                                ================================================== -->
                                <div
                                    class="
                                        d-flex
                                        justify-content-between
                                        flex-wrap
                                        mt-4
                                    ">
                                    <!-- KEMBALI -->
                                    <a
                                        href="<?= base_url(
                                                    'dashboard-orangtua'
                                                ) ?>"
                                        class="
                                            btn
                                            btn-secondary
                                        ">

                                        <i
                                            class="
                                                fas
                                                fa-arrow-left
                                                mr-1
                                            "></i>

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
                                            ">

                                            <i
                                                class="
                                                    fas
                                                    fa-save
                                                    mr-1
                                                "></i>

                                            Simpan Draft
                                        </button>
                                        <!-- KIRIM PENGAJUAN -->
                                        <button
                                            type="submit"
                                            name="action"
                                            value="submit"
                                            class="
                                                btn
                                                btn-success
                                            ">

                                            <i
                                                class="
                                                    fas
                                                    fa-paper-plane
                                                    mr-1
                                                "></i>

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
<!-- =====================================================
     DYNAMIC JENIS LAYANAN
====================================================== -->
<script>
    const layanan = {
        "Akademik": [
            "Surat Aktif Kuliah",
            "Surat Keterangan Mahasiswa",
            "Legalisir Ijazah",
            "Legalisir Transkrip Nilai",
            "Surat Keterangan Lulus",
            "Surat Keterangan Cuti Akademik",
            "Surat Keterangan Pengunduran Diri",
            "Perubahan Data Akademik",
            "Informasi KRS/KHS",
            "Informasi Jadwal Kuliah",
            "Informasi Nilai"
        ],

        "Kemahasiswaan": [
            "Surat Beasiswa",
            "Pengajuan Beasiswa",
            "Surat Keterangan Tidak Menerima Beasiswa",
            "Surat Keterangan Organisasi Mahasiswa",
            "Surat Keterangan Kegiatan Kemahasiswaan",
            "Pengajuan Kegiatan Mahasiswa",
            "Informasi UKM",
            "Informasi Organisasi Kemahasiswaan",
            "Konsultasi Kemahasiswaan"
        ],

        "Keuangan": [
            "Informasi UKT/SPP",
            "Informasi Pembayaran Kuliah",
            "Konfirmasi Pembayaran",
            "Permohonan Pengembalian Dana",
            "Informasi Tagihan",
            "Permohonan Keringanan Biaya Pendidikan",
            "Informasi Administrasi Keuangan"
        ]
    };

    const unit = document.getElementById('unit_layanan');
    const jenis = document.getElementById('layanan');

unit.addEventListener('change', function () {

    jenis.innerHTML = '<option value="">-- Pilih Jenis Layanan --</option>';

    if(this.value == ''){
        jenis.disabled = true;
        return;
    }

    jenis.disabled = false;

    let data = layanan[this.value];

    if(data){

        data.forEach(function(item){

            let option = document.createElement("option");

            option.value = item;

            option.textContent = item;

            jenis.appendChild(option);

        });

    }

});
</script>

<?= $this->include('layouts/footer') ?>