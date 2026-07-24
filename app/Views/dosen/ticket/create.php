<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_dosen') ?>


<style>

/* =========================================
   HALAMAN AJUKAN LAYANAN DOSEN
========================================= */

.pengajuan-page {
    background: #f4f7fb;
    min-height: calc(100vh - 57px);
    padding-bottom: 40px;
}


/* =========================================
   JUDUL
========================================= */

.page-title {
    color: #0b3d91;
    font-weight: 700;
}

.page-subtitle {
    color: #64748b;
}


/* =========================================
   CARD
========================================= */

.pengajuan-card {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
}

.pengajuan-card .card-header {
    background: #0b3d91;
    color: white;
    padding: 20px 25px;
    border: none;
}

.pengajuan-card .card-header h3 {
    margin: 0;
    font-size: 21px;
    font-weight: 700;
}


/* =========================================
   SECTION TITLE
========================================= */

.section-title {
    color: #0b3d91;
    font-size: 20px;
    font-weight: 700;

    border-bottom: 2px solid #f28c28;

    padding-bottom: 10px;

    margin-bottom: 25px;
}


/* =========================================
   FORM
========================================= */

.form-label {
    color: #17365d;
    font-size: 16px;
    font-weight: 700;
}

.required {
    color: #dc3545;
    font-weight: bold;
}

.form-control,
.form-select {
    min-height: 50px;

    border-radius: 8px;

    border: 1px solid #cbd5e1;

    font-size: 16px;
}

.form-control:focus,
.form-select:focus {

    border-color: #0b3d91;

    box-shadow:
        0 0 0 .2rem
        rgba(11, 61, 145, .12);
}

textarea.form-control {
    min-height: 150px;
}


/* =========================================
   READONLY
========================================= */

.readonly-input {
    background: #eef3f8 !important;
    color: #64748b;
}


/* =========================================
   FILE UPLOAD
========================================= */

.file-upload-box {

    border: 2px dashed #b8c4d1;

    border-radius: 10px;

    padding: 25px;

    text-align: center;

    background: #f8fafc;

    transition: .2s;
}

.file-upload-box:hover {

    border-color: #0b3d91;

    background: #f1f6ff;
}

.file-upload-box i {

    color: #0b3d91;

    font-size: 40px;

    margin-bottom: 10px;
}

.file-info {

    color: #64748b;

    font-size: 14px;

    margin-top: 8px;
}


/* =========================================
   SIDEBAR INFORMASI
========================================= */

.info-card {

    border: none;

    border-radius: 15px;

    box-shadow: 0 5px 20px rgba(0,0,0,.07);

    overflow: hidden;

    margin-bottom: 20px;
}

.info-card .card-header {

    background: #0b3d91;

    color: white;

    font-weight: 700;

    padding: 15px 20px;
}

.info-card .card-body {

    padding: 20px;

    color: #475569;

    line-height: 1.7;
}


/* =========================================
   WARNING
========================================= */

.warning-card {

    border: none;

    border-radius: 15px;

    box-shadow: 0 5px 20px rgba(0,0,0,.07);

    overflow: hidden;

    margin-bottom: 20px;
}

.warning-card .card-header {

    background: #f28c28;

    color: white;

    font-weight: 700;

    padding: 15px 20px;
}

.warning-card .card-body {

    padding: 20px;

    color: #475569;

    line-height: 1.7;
}


/* =========================================
   BUTTON
========================================= */

.btn-draft {

    background: #64748b;

    color: white;

    border: none;

    padding: 11px 22px;

    border-radius: 8px;

    font-weight: 700;
}

.btn-draft:hover {

    background: #475569;

    color: white;
}

.btn-submit {

    background: #0b3d91;

    color: white;

    border: none;

    padding: 11px 25px;

    border-radius: 8px;

    font-weight: 700;
}

.btn-submit:hover {

    background: #082f70;

    color: white;
}

.btn-cancel {

    padding: 11px 22px;

    border-radius: 8px;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 991.98px) {

    .sidebar-info-column {

        margin-top: 25px;

    }

}

</style>


<div class="content-wrapper pengajuan-page">


    <!-- =====================================
         HEADER
    ====================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <h1 class="page-title">

                <i class="fas fa-file-circle-plus"></i>

                Ajukan Layanan

            </h1>

            <p class="page-subtitle">

                Sampaikan permohonan layanan Anda kepada unit terkait.

            </p>

        </div>

    </section>



    <!-- =====================================
         CONTENT
    ====================================== -->

    <section class="content">

        <div class="container-fluid">

            <div class="row">


                <!-- =================================
                     FORM
                ================================== -->

                <div class="col-lg-8">

                    <div class="card pengajuan-card">


                        <!-- CARD HEADER -->

                        <div class="card-header">

                            <h3>

                                <i class="fas fa-file-signature me-2"></i>

                                Form Pengajuan Layanan Dosen

                            </h3>

                        </div>


                        <!-- CARD BODY -->

                        <div class="card-body">


                            <form
                                id="formPengajuanDosen"
                                action="<?= base_url('dosen/ticket/store') ?>"
                                method="post"
                                enctype="multipart/form-data"
                            >

                                <?= csrf_field() ?>


                                <!-- =================================
                                     DATA PEMOHON
                                ================================== -->

                                <div class="section-title">

                                    <i class="fas fa-user me-2"></i>

                                    Data Pemohon

                                </div>


                                <!-- NAMA -->

                                <div class="mb-4">

                                    <label class="form-label">

                                        Nama Lengkap

                                        <span class="required">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control readonly-input"
                                        value="<?= esc($user['nama'] ?? '') ?>"
                                        readonly
                                    >

                                </div>


                                <!-- NIP / NIDN -->

                                <div class="mb-4">

                                    <label class="form-label">

                                        NIP / NIDN

                                        <span class="required">*</span>

                                    </label>

                                    <input
                                        type="text"
                                        class="form-control readonly-input"
                                        value="<?= esc($user['nip'] ?? '') ?>"
                                        readonly
                                    >

                                </div>


                                <!-- EMAIL -->

                                <div class="mb-4">

                                    <label class="form-label">

                                        Email

                                        <span class="required">*</span>

                                    </label>

                                    <input
                                        type="email"
                                        class="form-control readonly-input"
                                        value="<?= esc($user['email'] ?? '') ?>"
                                        readonly
                                    >

                                </div>



                                <!-- =================================
                                     UNIT TUJUAN
                                ================================== -->

                                <div class="section-title mt-4">

                                    <i class="fas fa-building me-2"></i>

                                    Tujuan Layanan

                                </div>


                                <div class="mb-4">

                                    <label
                                        for="unit_tujuan"
                                        class="form-label"
                                    >

                                        Unit Tujuan

                                        <span class="required">*</span>

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


                                        <option value="akademik_kemahasiswaan">

                                            Bidang Akademik & Kemahasiswaan

                                        </option>


                                        <option value="keuangan">

                                            Bagian Keuangan

                                        </option>


                                        <option value="umum">

                                            Bagian Umum dan Kepegawaian

                                        </option>


                                        <option value="tik">

                                            Unit Teknologi Informasi dan Komunikasi

                                        </option>


                                        <option value="humas">

                                            Bagian Humas dan Informasi Publik

                                        </option>


                                    </select>

                                </div>



                                <!-- =================================
                                     JENIS LAYANAN
                                ================================== -->

                                <div class="mb-4">

                                    <label
                                        for="jenis_layanan"
                                        class="form-label"
                                    >

                                        Jenis Layanan

                                        <span class="required">*</span>

                                    </label>


                                    <select
                                        name="jenis_layanan"
                                        id="jenis_layanan"
                                        class="form-select"
                                        required
                                        disabled
                                    >

                                        <option value="">

                                            -- Pilih Unit Tujuan Terlebih Dahulu --

                                        </option>

                                    </select>


                                    <div class="form-text">

                                        Pilihan layanan akan menyesuaikan dengan unit tujuan.

                                    </div>

                                </div>



                                <!-- =================================
                                     JUDUL / KEPERLUAN
                                ================================== -->

                                <div class="mb-4">

                                    <label
                                        for="judul"
                                        class="form-label"
                                    >

                                        Judul / Keperluan

                                        <span class="required">*</span>

                                    </label>


                                    <input
                                        type="text"
                                        name="judul"
                                        id="judul"
                                        class="form-control"
                                        placeholder="Masukkan judul atau keperluan pengajuan"
                                        required
                                    >

                                </div>



                                <!-- =================================
                                     KETERANGAN
                                ================================== -->

                                <div class="mb-4">

                                    <label
                                        for="keterangan"
                                        class="form-label"
                                    >

                                        Keterangan / Detail Permohonan

                                        <span class="required">*</span>

                                    </label>


                                    <textarea
                                        name="keterangan"
                                        id="keterangan"
                                        class="form-control"
                                        placeholder="Jelaskan detail permohonan layanan Anda..."
                                        required
                                    ></textarea>

                                </div>



                                <!-- =================================
                                     DOKUMEN
                                ================================== -->

                                <div class="section-title mt-4">

                                    <i class="fas fa-paperclip me-2"></i>

                                    Dokumen Pendukung

                                </div>


                                <div class="file-upload-box">


                                    <i class="fas fa-cloud-upload-alt"></i>


                                    <div>

                                        <label
                                            for="dokumen"
                                            class="btn btn-outline-primary"
                                        >

                                            <i class="fas fa-folder-open"></i>

                                            Pilih Dokumen

                                        </label>

                                    </div>


                                    <input
                                        type="file"
                                        name="dokumen"
                                        id="dokumen"
                                        class="d-none"
                                    >


                                    <div
                                        id="namaDokumen"
                                        class="mt-2 text-muted"
                                    >

                                        Belum ada dokumen dipilih.

                                    </div>


                                    <div class="file-info">

                                        Dokumen bersifat opsional.

                                        <br>

                                        Format yang diperbolehkan:
                                        PDF, JPG, JPEG, PNG.

                                        <br>

                                        Ukuran maksimal: <strong>2 MB</strong>.

                                    </div>


                                </div>



                                <!-- =================================
                                     BUTTON
                                ================================== -->

                                <div class="d-flex justify-content-end gap-2 mt-4">


                                    <a
                                        href="<?= base_url('dosen/dashboard') ?>"
                                        class="btn btn-secondary btn-cancel"
                                    >

                                        <i class="fas fa-arrow-left me-1"></i>

                                        Batal

                                    </a>


                                    <button
                                        type="submit"
                                        name="action"
                                        value="draft"
                                        class="btn btn-draft"
                                    >

                                        <i class="fas fa-save me-1"></i>

                                        Simpan Draft

                                    </button>


                                    <button
                                        type="submit"
                                        name="action"
                                        value="submit"
                                        class="btn btn-submit"
                                    >

                                        <i class="fas fa-paper-plane me-1"></i>

                                        Ajukan Layanan

                                    </button>


                                </div>


                            </form>


                        </div>

                    </div>

                </div>



                <!-- =================================
                     SIDEBAR INFORMASI
                ================================== -->

                <div class="col-lg-4 sidebar-info-column">


                    <!-- INFORMASI -->

                    <div class="card info-card">

                        <div class="card-header">

                            <i class="fas fa-info-circle me-2"></i>

                            Informasi Pengajuan

                        </div>


                        <div class="card-body">

                            <p>

                                <strong>1.</strong>

                                Pilih unit tujuan sesuai dengan layanan yang ingin Anda ajukan.

                            </p>


                            <p>

                                <strong>2.</strong>

                                Setelah memilih unit tujuan, pilih jenis layanan yang tersedia.

                            </p>


                            <p>

                                <strong>3.</strong>

                                Lengkapi seluruh data pengajuan yang wajib diisi.

                            </p>


                            <p>

                                <strong>4.</strong>

                                Dokumen pendukung dapat dilampirkan jika diperlukan.

                            </p>


                            <p class="mb-0">

                                <strong>5.</strong>

                                Simpan sebagai draft jika pengajuan belum siap dikirim.

                            </p>

                        </div>

                    </div>



                    <!-- PERHATIAN -->

                    <div class="card warning-card">

                        <div class="card-header">

                            <i class="fas fa-triangle-exclamation me-2"></i>

                            Perhatian

                        </div>


                        <div class="card-body">

                            <p>

                                Pastikan informasi yang Anda masukkan sudah benar sebelum mengirim pengajuan.

                            </p>


                            <p>

                                Setelah pengajuan dikirim, sistem akan membuat nomor tiket secara otomatis.

                            </p>


                            <p class="mb-0">

                                Gunakan nomor tiket untuk memantau perkembangan permohonan Anda.

                            </p>

                        </div>

                    </div>


                </div>


            </div>

        </div>

    </section>

</div>



<script>

/* =========================================
   DATA LAYANAN BERDASARKAN UNIT TUJUAN
========================================= */

const layananPerUnit = {

    akademik_kemahasiswaan: [

        {
            value: 'surat_aktif_kuliah',
            text: 'Surat Keterangan Aktif Kuliah'
        },

        {
            value: 'legalisir',
            text: 'Legalisir Ijazah / Transkrip'
        },

        {
            value: 'verifikasi_alumni',
            text: 'Verifikasi Alumni'
        },

        {
            value: 'layanan_kemahasiswaan',
            text: 'Layanan Kemahasiswaan'
        },

        {
            value: 'layanan_akademik',
            text: 'Layanan Akademik'
        }

    ],


    keuangan: [

        {
            value: 'konfirmasi_pembayaran',
            text: 'Konfirmasi Pembayaran'
        }

    ],


    umum: [

        {
            value: 'permohonan_kunjungan',
            text: 'Permohonan Kunjungan'
        }

    ],


    tik: [

        {
            value: 'bantuan_sistem',
            text: 'Bantuan Akses Sistem Informasi'
        }

    ],


    humas: [

        {
            value: 'informasi_publik',
            text: 'Permohonan Informasi Publik'
        },

        {
            value: 'pengaduan_layanan',
            text: 'Pengaduan Layanan'
        }

    ]

};



/* =========================================
   UNIT TUJUAN
========================================= */

const unitTujuan =
    document.getElementById('unit_tujuan');


const jenisLayanan =
    document.getElementById('jenis_layanan');



unitTujuan.addEventListener(
    'change',
    function () {


        const unit =
            this.value;


        jenisLayanan.innerHTML = '';


        if (!unit) {

            jenisLayanan.disabled = true;


            const option =
                document.createElement('option');


            option.value = '';

            option.textContent =
                '-- Pilih Unit Tujuan Terlebih Dahulu --';


            jenisLayanan.appendChild(option);


            return;

        }



        jenisLayanan.disabled = false;


        const defaultOption =
            document.createElement('option');


        defaultOption.value = '';

        defaultOption.textContent =
            '-- Pilih Jenis Layanan --';


        jenisLayanan.appendChild(
            defaultOption
        );



        layananPerUnit[unit].forEach(
            function (layanan) {


                const option =
                    document.createElement('option');


                option.value =
                    layanan.value;


                option.textContent =
                    layanan.text;


                jenisLayanan.appendChild(
                    option
                );

            }
        );


    }
);



/* =========================================
   VALIDASI DOKUMEN
   MAKSIMAL 2 MB
========================================= */

const dokumenInput =
    document.getElementById('dokumen');


const namaDokumen =
    document.getElementById('namaDokumen');



dokumenInput.addEventListener(
    'change',
    function () {


        const file =
            this.files[0];


        if (!file) {

            namaDokumen.textContent =
                'Belum ada dokumen dipilih.';

            return;

        }



        /* CEK FORMAT */

        const allowedExtensions = [

            'pdf',

            'jpg',

            'jpeg',

            'png'

        ];


        const extension =
            file.name
                .split('.')
                .pop()
                .toLowerCase();



        if (
            !allowedExtensions.includes(
                extension
            )
        ) {

            alert(
                'Format dokumen harus PDF, JPG, JPEG, atau PNG.'
            );

            this.value = '';

            namaDokumen.textContent =
                'Belum ada dokumen dipilih.';

            return;

        }



        /* CEK UKURAN */

        if (
            file.size >
            2 * 1024 * 1024
        ) {

            alert(
                'Ukuran dokumen maksimal adalah 2 MB.'
            );

            this.value = '';

            namaDokumen.textContent =
                'Belum ada dokumen dipilih.';

            return;

        }



        /* TAMPILKAN NAMA FILE */

        namaDokumen.innerHTML =

            '<i class="fas fa-file"></i> ' +

            '<strong>' +

            file.name +

            '</strong>';


    }
);



/* =========================================
   CEK SUBMIT
========================================= */

const form =
    document.getElementById(
        'formPengajuanDosen'
    );


form.addEventListener(
    'submit',
    function (event) {


        const unit =
            unitTujuan.value;


        const layanan =
            jenisLayanan.value;


        const keterangan =
            document.getElementById(
                'keterangan'
            ).value.trim();



        /* CEK UNIT */

        if (!unit) {

            event.preventDefault();

            alert(
                'Silakan pilih unit tujuan terlebih dahulu.'
            );

            unitTujuan.focus();

            return;

        }



        /* CEK LAYANAN */

        if (!layanan) {

            event.preventDefault();

            alert(
                'Silakan pilih jenis layanan terlebih dahulu.'
            );

            jenisLayanan.focus();

            return;

        }



        /* CEK KETERANGAN */

        if (!keterangan) {

            event.preventDefault();

            alert(
                'Silakan isi keterangan atau detail permohonan.'
            );

            document
                .getElementById(
                    'keterangan'
                )
                .focus();

            return;

        }


    }
);

</script>



<?= $this->include('layouts/footer') ?>