<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- =====================================================
         HEADER
    ====================================================== -->
    <div class="row mb-3">

        <div class="col-md-8">

            <h3 style="
                font-weight:700;
                color:#0b3d91;
                margin-bottom:5px;
            ">
                <i class="fas fa-file-signature mr-2"></i>
                Ajukan Layanan
            </h3>

            <p class="text-muted mb-0">
                Silakan lengkapi data pengajuan layanan Anda.
            </p>

        </div>

        <div class="col-md-4">

            <ol class="breadcrumb float-md-right">

                <li class="breadcrumb-item">
                    <a href="<?= base_url('dashboard-mahasiswa') ?>">
                        Dashboard
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    Ajukan Layanan
                </li>

            </ol>

        </div>

    </div>


    <!-- =====================================================
         FLASH MESSAGE
    ====================================================== -->

    <?php if (session()->getFlashdata('success')) : ?>

        <div class="alert alert-success alert-dismissible fade show">

            <i class="fas fa-check-circle mr-2"></i>

            <?= session()->getFlashdata('success') ?>

            <button type="button"
                class="close"
                data-dismiss="alert">

                <span>&times;</span>

            </button>

        </div>

    <?php endif; ?>


    <?php if (session()->getFlashdata('error')) : ?>

        <div class="alert alert-danger alert-dismissible fade show">

            <i class="fas fa-exclamation-circle mr-2"></i>

            <?= session()->getFlashdata('error') ?>

            <button type="button"
                class="close"
                data-dismiss="alert">

                <span>&times;</span>

            </button>

        </div>

    <?php endif; ?>


    <!-- =====================================================
         FORM
    ====================================================== -->

    <form
        action="<?= base_url('mahasiswa/ticket/store') ?>"
        method="post"
        enctype="multipart/form-data"
        id="formPengajuan">

        <?= csrf_field() ?>


        <!-- =================================================
             DATA PEMOHON
        ================================================== -->

        <div class="card shadow-sm mb-4"
            style="
                border-radius:15px;
                border:none;
            ">

            <div class="card-header"
                style="
                    background:#0b3d91;
                    color:white;
                    border-radius:15px 15px 0 0;
                    border-bottom:4px solid #f28c28;
                ">

                <h5 class="mb-0">

                    <i class="fas fa-user mr-2"></i>

                    Data Pemohon

                </h5>

            </div>


            <div class="card-body">

                <div class="row">

                    <!-- NAMA -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label class="font-weight-bold">

                                Nama Pemohon

                            </label>

                            <div class="input-group">

                                <div class="input-group-prepend">

                                    <span class="input-group-text">
                                        <i class="fas fa-user"></i>
                                    </span>

                                </div>

                                <input
                                    type="text"
                                    name="nama_pemohon"
                                    class="form-control"
                                    value="<?= esc($user['nama'] ?? 'Muhamad Rafi Putra Zakaria') ?>"
                                    readonly>

                            </div>

                            <small class="text-muted">

                                Nama pemohon diambil dari data akun dan tidak dapat diubah.

                            </small>

                        </div>

                    </div>


                    <!-- NIK -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label class="font-weight-bold">

                                NIK

                            </label>

                            <div class="input-group">

                                <div class="input-group-prepend">

                                    <span class="input-group-text">
                                        <i class="fas fa-id-card"></i>
                                    </span>

                                </div>

                                <input
                                    type="text"
                                    name="nik"
                                    class="form-control"
                                    value="<?= esc($user['nik'] ?? '3273010101040001') ?>"
                                    readonly>

                            </div>

                            <small class="text-muted">

                                NIK diambil dari data akun dan tidak dapat diubah.

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             LAYANAN
        ================================================== -->

        <div class="card shadow-sm mb-4"
            style="
                border-radius:15px;
                border:none;
            ">

            <div class="card-header"
                style="
                    background:#0b3d91;
                    color:white;
                    border-radius:15px 15px 0 0;
                    border-bottom:4px solid #f28c28;
                ">

                <h5 class="mb-0">

                    <i class="fas fa-list-alt mr-2"></i>

                    Pilih Layanan

                </h5>

            </div>


            <div class="card-body">

                <div class="row">

                    <!-- UNIT LAYANAN -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label class="font-weight-bold">

                                Unit Layanan

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="unit_layanan"
                                id="unitLayanan"
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

                    </div>


                    <!-- JENIS LAYANAN -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label class="font-weight-bold">

                                Jenis Layanan

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="jenis_layanan"
                                id="jenisLayanan"
                                class="form-control"
                                required
                                disabled>

                                <option value="">
                                    -- Pilih Unit Layanan Terlebih Dahulu --
                                </option>

                            </select>

                        </div>

                    </div>

                </div>


                <!-- =================================================
                     PERSYARATAN
                ================================================== -->

                <div
                    id="persyaratanContainer"
                    class="mt-3"
                    style="display:none;">

                    <div class="alert alert-info"
                        style="
                            border-radius:10px;
                            border-left:5px solid #0b3d91;
                        ">

                        <h5
                            style="
                                color:#0b3d91;
                                font-weight:700;
                            ">

                            <i class="fas fa-clipboard-list mr-2"></i>

                            Persyaratan

                        </h5>

                        <p class="text-muted mb-2">

                            Dokumen/data yang perlu disiapkan untuk layanan ini:

                        </p>


                        <ol
                            id="listPersyaratan"
                            class="mb-0">

                        </ol>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             DOKUMEN
        ================================================== -->

        <div class="card shadow-sm mb-4"
            style="
                border-radius:15px;
                border:none;
            ">

            <div class="card-header"
                style="
                    background:#0b3d91;
                    color:white;
                    border-radius:15px 15px 0 0;
                    border-bottom:4px solid #f28c28;
                ">

                <h5 class="mb-0">

                    <i class="fas fa-paperclip mr-2"></i>

                    Dokumen Persyaratan

                </h5>

            </div>


            <div class="card-body">

                <div class="alert alert-warning">

                    <i class="fas fa-info-circle mr-2"></i>

                    Anda dapat mengunggah lebih dari satu dokumen.
                    Pastikan dokumen sesuai dengan persyaratan layanan.

                </div>


                <div id="dokumenWrapper">

                    <div class="dokumen-item mb-3">

                        <div class="row">

                            <div class="col-md-10">

                                <input
                                    type="file"
                                    name="dokumen[]"
                                    class="form-control"
                                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">

                            </div>

                            <div class="col-md-2">

                                <button
                                    type="button"
                                    class="btn btn-danger btn-block btn-hapus-dokumen"
                                    style="display:none;">

                                    <i class="fas fa-trash mr-1"></i>

                                    Hapus

                                </button>

                            </div>

                        </div>

                    </div>

                </div>


                <button
                    type="button"
                    id="btnTambahDokumen"
                    class="btn btn-outline-primary">

                    <i class="fas fa-plus mr-1"></i>

                    Tambah Dokumen

                </button>


                <small class="d-block text-muted mt-2">

                    Format yang diperbolehkan:
                    PDF, JPG, JPEG, PNG, DOC, DOCX.

                </small>

            </div>

        </div>


        <!-- =================================================
             KETERANGAN
        ================================================== -->

        <div class="card shadow-sm mb-4"
            style="
                border-radius:15px;
                border:none;
            ">

            <div class="card-header"
                style="
                    background:#0b3d91;
                    color:white;
                    border-radius:15px 15px 0 0;
                    border-bottom:4px solid #f28c28;
                ">

                <h5 class="mb-0">

                    <i class="fas fa-comment-alt mr-2"></i>

                    Keterangan Pengajuan

                </h5>

            </div>


            <div class="card-body">

                <div class="form-group mb-0">

                    <label class="font-weight-bold">

                        Keterangan

                    </label>

                    <textarea
                        name="keterangan"
                        class="form-control"
                        rows="5"
                        placeholder="Tuliskan keterangan atau keperluan pengajuan Anda..."></textarea>

                </div>

            </div>

        </div>


        <!-- =================================================
             BUTTON
        ================================================== -->

        <div class="card shadow-sm mb-5"
            style="
                border-radius:15px;
                border:none;
            ">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center flex-wrap">

                    <a
                        href="<?= base_url('mahasiswa/ticket/history') ?>"
                        class="btn btn-secondary mb-2">

                        <i class="fas fa-arrow-left mr-1"></i>

                        Kembali

                    </a>


                    <div>

                        <!-- DRAFT -->

                        <button
                            type="submit"
                            name="action"
                            value="draft"
                            class="btn btn-outline-primary mr-2 mb-2">

                            <i class="fas fa-save mr-1"></i>

                            Simpan Draft

                        </button>


                        <!-- KIRIM -->

                        <button
                            type="submit"
                            name="action"
                            value="submit"
                            class="btn mb-2"
                            style="
                                background:#0b3d91;
                                color:white;
                                font-weight:600;
                                border-radius:8px;
                                padding:10px 25px;
                            ">

                            <i class="fas fa-paper-plane mr-1"></i>

                            Kirim Pengajuan

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>

<?= $this->include('layouts/footer') ?>


<!-- =========================================================
     JAVASCRIPT
========================================================== -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    // =====================================================
    // DATA LAYANAN DARI CONTROLLER
    // =====================================================

    const dataLayanan = <?= json_encode($layanan ?? []) ?>;


    // =====================================================
    // ELEMENT
    // =====================================================

    const unitSelect = document.getElementById('unitLayanan');
    const jenisSelect = document.getElementById('jenisLayanan');

    const persyaratanContainer =
        document.getElementById('persyaratanContainer');

    const listPersyaratan =
        document.getElementById('listPersyaratan');


    // =====================================================
    // UNIT LAYANAN
    // =====================================================

    unitSelect.addEventListener('change', function () {

        const unit = this.value;

        jenisSelect.innerHTML = '';
        listPersyaratan.innerHTML = '';

        persyaratanContainer.style.display = 'none';


        // Reset jika belum memilih unit

        if (!unit || !dataLayanan[unit]) {

            jenisSelect.disabled = true;

            jenisSelect.innerHTML = `
                <option value="">
                    -- Pilih Unit Layanan Terlebih Dahulu --
                </option>
            `;

            return;
        }


        // Aktifkan jenis layanan

        jenisSelect.disabled = false;

        jenisSelect.innerHTML = `
            <option value="">
                -- Pilih Jenis Layanan --
            </option>
        `;


        // Ambil jenis layanan

        dataLayanan[unit].forEach(function (layanan) {

            const option =
                document.createElement('option');

            option.value = layanan.nama;

            option.textContent = layanan.nama;

            jenisSelect.appendChild(option);

        });

    });


    // =====================================================
    // JENIS LAYANAN
    // =====================================================

    jenisSelect.addEventListener('change', function () {

        const unit = unitSelect.value;
        const jenis = this.value;


        listPersyaratan.innerHTML = '';


        if (!unit || !jenis) {

            persyaratanContainer.style.display = 'none';

            return;
        }


        // Cari layanan yang dipilih

        const layananDipilih =
            dataLayanan[unit].find(function (layanan) {

                return layanan.nama === jenis;

            });


        if (!layananDipilih) {

            persyaratanContainer.style.display = 'none';

            return;
        }


        // =================================================
        // TAMPILKAN PERSYARATAN
        // =================================================

        layananDipilih.persyaratan.forEach(function (item) {

            const li =
                document.createElement('li');

            li.className = 'mb-2';

            li.innerHTML = `
                <i class="fas fa-check-circle text-success mr-2"></i>
                ${item}
            `;

            listPersyaratan.appendChild(li);

        });


        persyaratanContainer.style.display = 'block';

    });


    // =====================================================
    // TAMBAH DOKUMEN
    // =====================================================

    const dokumenWrapper =
        document.getElementById('dokumenWrapper');

    const btnTambahDokumen =
        document.getElementById('btnTambahDokumen');


    function updateTombolHapus() {

        const items =
            dokumenWrapper.querySelectorAll('.dokumen-item');


        items.forEach(function (item) {

            const btn =
                item.querySelector('.btn-hapus-dokumen');


            if (items.length > 1) {

                btn.style.display = 'block';

            } else {

                btn.style.display = 'none';

            }

        });

    }


    // =====================================================
    // TAMBAH FILE
    // =====================================================

    btnTambahDokumen.addEventListener('click', function () {

        const item =
            document.createElement('div');

        item.className =
            'dokumen-item mb-3';


        item.innerHTML = `

            <div class="row">

                <div class="col-md-10">

                    <input
                        type="file"
                        name="dokumen[]"
                        class="form-control"
                        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">

                </div>

                <div class="col-md-2">

                    <button
                        type="button"
                        class="btn btn-danger btn-block btn-hapus-dokumen">

                        <i class="fas fa-trash mr-1"></i>
                        Hapus

                    </button>

                </div>

            </div>

        `;


        dokumenWrapper.appendChild(item);

        updateTombolHapus();

    });


    // =====================================================
    // HAPUS FILE
    // =====================================================

    dokumenWrapper.addEventListener('click', function (event) {

        const button =
            event.target.closest('.btn-hapus-dokumen');


        if (!button) {
            return;
        }


        const item =
            button.closest('.dokumen-item');


        if (item) {

            item.remove();

        }


        updateTombolHapus();

    });


    // =====================================================
    // INITIAL
    // =====================================================

    updateTombolHapus();

});

</script>