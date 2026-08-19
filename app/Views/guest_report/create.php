<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    /* =========================================================
       STYLE HALAMAN AJUKAN LAYANAN
       ========================================================= */

    .guest-page {
        background: #f1f3f7;
        min-height: calc(100vh - 60px);
        padding: 0 0 30px 0;
    }

    .guest-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 20px 15px;
        background: #f1f3f7;
    }

    .guest-header-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .guest-header-icon {
        color: #114b9b;
        font-size: 28px;
    }

    .guest-header h1 {
        margin: 0;
        color: #124b93;
        font-size: 30px;
        font-weight: 700;
    }

    .guest-header p {
        margin: 4px 0 0;
        color: #6c757d;
        font-size: 15px;
    }

    .guest-breadcrumb {
        background: #e9ecef;
        padding: 14px 18px;
        border-radius: 4px;
        color: #6c757d;
        font-size: 14px;
    }

    .guest-breadcrumb a {
        color: #287bd3;
        text-decoration: none;
    }

    /* =========================================================
       SECTION CARD
       ========================================================= */

    .service-section {
        background: #fff;
        border-radius: 15px;
        margin: 0 0 22px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
    }

    .service-section-header {
        background: #124b93;
        color: #fff;
        padding: 12px 20px;
        border-bottom: 4px solid #ff9418;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .service-section-header i {
        font-size: 21px;
        width: 22px;
        text-align: center;
    }

    .service-section-header h3 {
        margin: 0;
        font-size: 21px;
        font-weight: 600;
    }

    .service-section-body {
        padding: 24px 20px;
    }

    /* =========================================================
       FORM
       ========================================================= */

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label,
    .form-label {
        font-weight: 600;
        color: #292929;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        min-height: 40px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        box-shadow: none;
    }

    .form-control:focus {
        border-color: #1b65b3;
        box-shadow: 0 0 0 .15rem rgba(27,101,179,.12);
    }

    textarea.form-control {
        min-height: 125px;
        resize: vertical;
    }

    select.form-control {
        height: 40px;
    }

    .required {
        color: #dc3545;
    }

    /* =========================================================
       ALERT
       ========================================================= */

    .info-alert {
        background: #ffc107;
        color: #343a40;
        border-radius: 4px;
        padding: 13px 17px;
        margin-bottom: 15px;
    }

    .info-alert-blue {
        background: #20a4b8;
        color: #fff;
        border-radius: 4px;
        padding: 13px 17px;
        margin-bottom: 15px;
    }

    .info-alert i,
    .info-alert-blue i {
        margin-right: 10px;
    }

    /* =========================================================
       REQUIREMENTS
       ========================================================= */

    #requirements-container {
        margin-top: 15px;
    }

    #requirements-container .card {
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        box-shadow: none;
    }

    #requirements-container .card-header {
        background: #f7f7f7;
        border-bottom: 1px solid #ddd;
        padding: 12px 15px;
    }

    #requirements-container .card-body {
        padding: 18px;
    }

    /* =========================================================
       PEMOHON TAMBAHAN
       ========================================================= */

    .additional-form {
        margin-top: 5px;
    }

    /* =========================================================
       FOOTER BUTTON
       ========================================================= */

    .form-actions {
        background: #fff;
        border-radius: 15px;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
        margin-top: 10px;
    }

    .btn {
        border-radius: 5px;
        padding: 9px 17px;
        font-size: 15px;
    }

    .btn-primary {
        background: #124b93;
        border-color: #124b93;
    }

    .btn-primary:hover {
        background: #0d3d7a;
        border-color: #0d3d7a;
    }

    .btn-warning {
        color: #fff;
    }

    /* =========================================================
       RESPONSIVE
       ========================================================= */

    @media (max-width: 768px) {

        .guest-header {
            display: block;
        }

        .guest-breadcrumb {
            margin-top: 12px;
        }

        .guest-header h1 {
            font-size: 24px;
        }

        .service-section-body {
            padding: 18px 15px;
        }

        .form-actions {
            display: block;
        }

        .form-actions .right-buttons {
            margin-top: 15px;
        }

        .form-actions .btn {
            width: 100%;
            margin-bottom: 8px;
        }
    }
</style>


<div class="guest-page">

    <!-- =====================================================
         HEADER
         ===================================================== -->

    <div class="guest-header">

        <div>
            <div class="guest-header-left">
                <i class="fas fa-file-alt guest-header-icon"></i>

                <div>
                    <h1>Ajukan Layanan</h1>
                    <p>Silakan lengkapi data pengajuan layanan Anda.</p>
                </div>
            </div>
        </div>

        <div class="guest-breadcrumb">
            <a href="<?= base_url('dashboard') ?>">Dashboard</a>
            <span class="mx-2">/</span>
            <span>Ajukan Layanan</span>
        </div>

    </div>


    <form
        action="<?= base_url('guest-report/store') ?>"
        method="post"
        enctype="multipart/form-data"
    >

        <?= csrf_field() ?>


        <!-- =================================================
             ERROR / SUCCESS
             ================================================= -->

        <?php if (session()->getFlashdata('errors')): ?>

            <div class="alert alert-danger">

                <ul class="mb-0">

                    <?php foreach (session()->getFlashdata('errors') as $error): ?>

                        <li><?= esc($error) ?></li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>


        <?php if (session()->getFlashdata('success')): ?>

            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>

        <?php endif; ?>


        <!-- =================================================
             DATA PEMOHON
             ================================================= -->

        <div class="service-section">

            <div class="service-section-header">

                <i class="fas fa-user"></i>

                <h3>Data Pemohon</h3>

            </div>


            <div class="service-section-body">

                <div class="row">

                    <!-- JENIS PEMOHON -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Jenis Pemohon
                            </label>

                            <select
                                name="applicant_type"
                                id="applicant_type"
                                class="form-control"
                                required
                            >

                                <option value="">
                                    -- Pilih --
                                </option>

                                <option value="Mahasiswa">
                                    Mahasiswa
                                </option>

                                <option value="Dosen">
                                    Dosen
                                </option>

                                <option value="Tendik">
                                    Tendik
                                </option>

                                <option value="Orang Tua">
                                    Orang Tua
                                </option>

                                <option value="Alumni">
                                    Alumni
                                </option>

                                <option value="Mitra">
                                    Mitra
                                </option>

                                <option value="Public">
                                    Public
                                </option>

                                <option value="Masyarakat">
                                    Masyarakat
                                </option>

                            </select>

                        </div>

                    </div>


                    <!-- NAMA -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label id="labelNama">
                                Nama Pemohon
                            </label>

                            <input
                                type="text"
                                name="applicant_name"
                                class="form-control"
                                value="<?= old('applicant_name') ?>"
                                required
                            >

                        </div>

                    </div>

                </div>


                <div class="row">

                    <!-- IDENTITAS -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label id="labelIdentitas">
                                NIM / NIP / NIK
                            </label>

                            <input
                                type="text"
                                name="nim"
                                class="form-control"
                                value="<?= old('nim') ?>"
                            >

                        </div>

                    </div>


                    <!-- EMAIL -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="<?= old('email') ?>"
                            >

                        </div>

                    </div>

                </div>


                <div class="row">

                    <!-- HP -->

                    <div class="col-md-6">

                        <div class="form-group">

                            <label>
                                No HP
                            </label>

                            <input
                                type="text"
                                name="phone"
                                class="form-control"
                                value="<?= old('phone') ?>"
                            >

                        </div>

                    </div>

                </div>

            </div>

        </div>


       <!-- =================================================
     PILIH LAYANAN
     ================================================= -->

<div class="service-section">

    <div class="service-section-header">
        <i class="fas fa-list-alt"></i>
        <h3>Pilih Layanan</h3>
    </div>

    <div class="service-section-body">

        <div class="row">

            <!-- UNIT LAYANAN -->
            <div class="col-md-6 mb-3">

                <label
                    for="unit_id"
                    class="form-label"
                >
                    Unit Layanan
                    <span class="text-danger">*</span>
                </label>

                <select
                    name="unit_id"
                    id="unit_id"
                    class="form-control"
                    required
                >

                    <option value="">
                        -- Pilih Unit Layanan --
                    </option>

                    <?php foreach ($units as $unit): ?>

                        <option
                            value="<?= esc($unit['id']) ?>"
                            <?= old('unit_id') == $unit['id'] ? 'selected' : '' ?>
                        >
                            <?= esc($unit['name']) ?>
                        </option>

                    <?php endforeach; ?>

                </select>

            </div>


            <!-- JENIS LAYANAN -->
            <div class="col-md-6 mb-3">

                <label
                    for="service_id"
                    class="form-label"
                >
                    Jenis Layanan
                    <span class="text-danger">*</span>
                </label>

                <select
                    name="service_id"
                    id="service_id"
                    class="form-control"
                    required
                    disabled
                >

                    <option value="">
                        -- Pilih Unit Layanan Terlebih Dahulu --
                    </option>

                </select>


                <!-- DIISI OTOMATIS OLEH JAVASCRIPT -->
                <input
                    type="hidden"
                    name="service_name"
                    id="service_name"
                    value="<?= old('service_name') ?>"
                >

            </div>

        </div>


        <!-- =====================================================
             PERSYARATAN
             ===================================================== -->

        <div
            id="requirement-container"
            class="mt-3"
            style="display:none;"
        >

            <div class="requirement-box">

                <div class="requirement-title">

                    <i class="fas fa-clipboard-list"></i>

                    <strong>
                        Persyaratan Layanan
                    </strong>

                </div>

                <div class="requirement-description">
                    Silakan upload dokumen sesuai persyaratan
                    layanan yang dipilih.
                </div>

                <div id="requirement-list"></div>

            </div>

        </div>

    </div>

</div>

        <!-- =================================================
             DATA TAMBAHAN PEMOHON
             ================================================= -->

        <div class="service-section additional-form">

            <div class="service-section-header">

                <i class="fas fa-user-edit"></i>

                <h3>Data Tambahan Pemohon</h3>

            </div>


            <div class="service-section-body">


                <!-- MAHASISWA -->

                <div
                    id="formMahasiswa"
                    style="display:none;"
                >

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    Program Studi
                                </label>

                                <input
                                    type="text"
                                    name="program_studi"
                                    class="form-control"
                                >

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    Jurusan
                                </label>

                                <input
                                    type="text"
                                    name="jurusan"
                                    class="form-control"
                                >

                            </div>

                        </div>

                    </div>


                    <div class="form-group">

                        <label>
                            Angkatan
                        </label>

                        <input
                            type="number"
                            name="angkatan"
                            class="form-control"
                        >

                    </div>

                </div>


                <!-- DOSEN -->

                <div
                    id="formDosen"
                    style="display:none;"
                >

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    Program Studi
                                </label>

                                <input
                                    type="text"
                                    name="prodi_dosen"
                                    class="form-control"
                                >

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    Jabatan
                                </label>

                                <input
                                    type="text"
                                    name="jabatan_dosen"
                                    class="form-control"
                                >

                            </div>

                        </div>

                    </div>

                </div>


                <!-- TENDIK -->

                <div
                    id="formTendik"
                    style="display:none;"
                >

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    Unit Kerja
                                </label>

                                <input
                                    type="text"
                                    name="unit_kerja"
                                    class="form-control"
                                >

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="form-group">

                                <label>
                                    Jabatan
                                </label>

                                <input
                                    type="text"
                                    name="jabatan_tendik"
                                    class="form-control"
                                >

                            </div>

                        </div>

                    </div>

                </div>


                <!-- MASYARAKAT -->

                <div
                    id="formMasyarakat"
                    style="display:none;"
                >

                    <div class="form-group">

                        <label>
                            Alamat
                        </label>

                        <textarea
                            name="alamat"
                            rows="3"
                            class="form-control"
                        ></textarea>

                    </div>

                </div>


                <!-- ORANG TUA -->

                <div
                    id="formOrangTua"
                    style="display:none;"
                >

                    <div class="form-group">

                        <label>
                            Nama Mahasiswa
                        </label>

                        <input
                            type="text"
                            name="nama_mahasiswa"
                            class="form-control"
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            NIM Mahasiswa
                        </label>

                        <input
                            type="text"
                            name="nim_mahasiswa"
                            class="form-control"
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Hubungan
                        </label>

                        <select
                            name="hubungan"
                            class="form-control"
                        >

                            <option>
                                Ayah
                            </option>

                            <option>
                                Ibu
                            </option>

                            <option>
                                Wali
                            </option>

                        </select>

                    </div>

                </div>


                <!-- ALUMNI -->

                <div
                    id="formAlumni"
                    style="display:none;"
                >

                    <div class="form-group">

                        <label>
                            Program Studi
                        </label>

                        <input
                            type="text"
                            name="prodi_alumni"
                            class="form-control"
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Tahun Lulus
                        </label>

                        <input
                            type="number"
                            name="tahun_lulus"
                            class="form-control"
                        >

                    </div>

                </div>


                <!-- MITRA -->

                <div
                    id="formMitra"
                    style="display:none;"
                >

                    <div class="form-group">

                        <label>
                            Nama Instansi
                        </label>

                        <input
                            type="text"
                            name="instansi"
                            class="form-control"
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Nama PIC
                        </label>

                        <input
                            type="text"
                            name="pic"
                            class="form-control"
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Jabatan
                        </label>

                        <input
                            type="text"
                            name="jabatan_mitra"
                            class="form-control"
                        >

                    </div>

                </div>


                <!-- PUBLIC -->

                <div
                    id="formPublic"
                    style="display:none;"
                >

                    <div class="form-group">

                        <label>
                            Instansi (Opsional)
                        </label>

                        <input
                            type="text"
                            name="instansi_public"
                            class="form-control"
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Alamat
                        </label>

                        <textarea
                            name="alamat_public"
                            class="form-control"
                        ></textarea>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             KETERANGAN / DESKRIPSI
             ================================================= -->

        <div class="service-section">

            <div class="service-section-header">

                <i class="fas fa-comment-alt"></i>

                <h3>Keterangan Pengajuan</h3>

            </div>


            <div class="service-section-body">

                <div class="form-group">

                    <label>
                        Keterangan
                    </label>

                    <textarea
                        name="ticket_description"
                        class="form-control"
                        rows="5"
                        required
                        placeholder="Tuliskan keterangan atau keperluan pengajuan Anda..."
                    ><?= old('ticket_description') ?></textarea>

                </div>

            </div>

        </div>


        <!-- =================================================
             UPLOAD
             ================================================= -->

        <div class="service-section">

            <div class="service-section-header">

                <i class="fas fa-paperclip"></i>

                <h3>Upload Dokumen Persyaratan</h3>

            </div>


            <div class="service-section-body">

                <div class="info-alert">

                    <i class="fas fa-info-circle"></i>

                    Silakan unggah dokumen sesuai dengan persyaratan layanan yang telah dipilih.

                </div>


                <div class="info-alert-blue">

                    <i class="fas fa-info-circle"></i>

                    Pilih jenis layanan terlebih dahulu untuk mengunggah dokumen persyaratan.

                </div>


                <div class="text-muted mb-3">

                    <i class="fas fa-file"></i>

                    Format yang diperbolehkan mengikuti ketentuan masing-masing persyaratan.

                </div>


                <div class="form-group">

                    <label>
                        Lampiran (PDF/JPG/PNG maks.5MB)
                    </label>

                    <input
                        type="file"
                        name="attachment"
                        class="form-control"
                    >

                </div>

            </div>

        </div>


        <!-- =================================================
             BUTTON
             ================================================= -->

        <div class="form-actions">

            <a
                href="<?= base_url('guest-report') ?>"
                class="btn btn-secondary"
            >
                <i class="fas fa-arrow-left"></i>
                Kembali
            </a>


            <div class="right-buttons">

                <button
                    type="reset"
                    class="btn btn-warning mr-2"
                >
                    <i class="fas fa-redo"></i>
                    Reset
                </button>


                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    <i class="fas fa-paper-plane"></i>
                    Kirim Pengajuan
                </button>

            </div>

        </div>

    </form>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    // =====================================================
    // ELEMENT DATA PEMOHON
    // =====================================================

    const applicantType = document.getElementById('applicant_type');

    const labelNama = document.getElementById('labelNama');
    const labelIdentitas = document.getElementById('labelIdentitas');


    // =====================================================
    // FORM TAMBAHAN PEMOHON
    // =====================================================

    const formMahasiswa = document.getElementById('formMahasiswa');
    const formDosen = document.getElementById('formDosen');
    const formTendik = document.getElementById('formTendik');
    const formOrangTua = document.getElementById('formOrangTua');
    const formAlumni = document.getElementById('formAlumni');
    const formMitra = document.getElementById('formMitra');
    const formPublic = document.getElementById('formPublic');
    const formMasyarakat = document.getElementById('formMasyarakat');


    // =====================================================
    // SEMBUNYIKAN SEMUA FORM
    // =====================================================

    function hideAllApplicantForms() {

        formMahasiswa.style.display = 'none';
        formDosen.style.display = 'none';
        formTendik.style.display = 'none';
        formOrangTua.style.display = 'none';
        formAlumni.style.display = 'none';
        formMitra.style.display = 'none';
        formPublic.style.display = 'none';
        formMasyarakat.style.display = 'none';
    }


    // =====================================================
    // RESET INPUT FORM TAMBAHAN
    // =====================================================

    function resetApplicantForms() {

        const forms = [
            formMahasiswa,
            formDosen,
            formTendik,
            formOrangTua,
            formAlumni,
            formMitra,
            formPublic,
            formMasyarakat
        ];

        forms.forEach(function (form) {

            if (!form) {
                return;
            }

            const inputs =
                form.querySelectorAll(
                    'input, textarea, select'
                );

            inputs.forEach(function (input) {

                if (
                    input.type !== 'hidden' &&
                    input.type !== 'file'
                ) {
                    input.value = '';
                }

            });

        });
    }


    // =====================================================
    // UBAH LABEL SESUAI JENIS PEMOHON
    // =====================================================

    function updateApplicantLabel(type) {

        labelNama.textContent = 'Nama Pemohon';

        switch (type) {

            case 'Mahasiswa':

                labelNama.textContent =
                    'Nama Mahasiswa';

                labelIdentitas.textContent =
                    'NIM';

                break;


            case 'Dosen':

                labelNama.textContent =
                    'Nama Dosen';

                labelIdentitas.textContent =
                    'NIP';

                break;


            case 'Tendik':

                labelNama.textContent =
                    'Nama Tendik';

                labelIdentitas.textContent =
                    'NIP / NIK';

                break;


            case 'Orang Tua':

                labelNama.textContent =
                    'Nama Orang Tua / Wali';

                labelIdentitas.textContent =
                    'NIK';

                break;


            case 'Alumni':

                labelNama.textContent =
                    'Nama Alumni';

                labelIdentitas.textContent =
                    'NIM';

                break;


            case 'Mitra':

                labelNama.textContent =
                    'Nama Pemohon / PIC';

                labelIdentitas.textContent =
                    'NIK / Identitas';

                break;


            case 'Public':

                labelNama.textContent =
                    'Nama Pemohon';

                labelIdentitas.textContent =
                    'NIK';

                break;


            case 'Masyarakat':

                labelNama.textContent =
                    'Nama Pemohon';

                labelIdentitas.textContent =
                    'NIK';

                break;


            default:

                labelNama.textContent =
                    'Nama Pemohon';

                labelIdentitas.textContent =
                    'NIM / NIP / NIK';

                break;
        }
    }


    // =====================================================
    // TAMPILKAN FORM BERDASARKAN JENIS PEMOHON
    // =====================================================

    function updateApplicantForm() {

        const type = applicantType.value;


        // ---------------------------------------------
        // SEMBUNYIKAN SEMUA DAHULU
        // ---------------------------------------------

        hideAllApplicantForms();


        // ---------------------------------------------
        // RESET ISIAN FORM TAMBAHAN
        // ---------------------------------------------

        resetApplicantForms();


        // ---------------------------------------------
        // UPDATE LABEL
        // ---------------------------------------------

        updateApplicantLabel(type);


        // ---------------------------------------------
        // TAMPILKAN FORM SESUAI JENIS
        // ---------------------------------------------

        switch (type) {

            case 'Mahasiswa':

                formMahasiswa.style.display =
                    'block';

                break;


            case 'Dosen':

                formDosen.style.display =
                    'block';

                break;


            case 'Tendik':

                formTendik.style.display =
                    'block';

                break;


            case 'Orang Tua':

                formOrangTua.style.display =
                    'block';

                break;


            case 'Alumni':

                formAlumni.style.display =
                    'block';

                break;


            case 'Mitra':

                formMitra.style.display =
                    'block';

                break;


            case 'Public':

                formPublic.style.display =
                    'block';

                break;


            case 'Masyarakat':

                formMasyarakat.style.display =
                    'block';

                break;


            default:

                break;
        }
    }


    // =====================================================
    // EVENT JENIS PEMOHON
    // =====================================================

    applicantType.addEventListener(
        'change',
        function () {

            updateApplicantForm();

        }
    );


    // =====================================================
    // ELEMENT LAYANAN
    // =====================================================

    const unitSelect =
        document.getElementById('unit_id');

    const serviceSelect =
        document.getElementById('service_id');

    const serviceNameInput =
        document.getElementById('service_name');

    const requirementContainer =
        document.getElementById(
            'requirement-container'
        );

    const requirementList =
        document.getElementById(
            'requirement-list'
        );


    // =====================================================
    // UNIT LAYANAN DIPILIH
    // =====================================================

    unitSelect.addEventListener(
        'change',
        function () {

            const unitId = this.value;


            // -----------------------------------------
            // RESET SERVICE
            // -----------------------------------------

            serviceSelect.innerHTML = `
                <option value="">
                    -- Memuat Jenis Layanan... --
                </option>
            `;

            serviceSelect.disabled = true;


            // -----------------------------------------
            // RESET SERVICE NAME
            // -----------------------------------------

            serviceNameInput.value = '';


            // -----------------------------------------
            // RESET REQUIREMENT
            // -----------------------------------------

            requirementContainer.style.display =
                'none';

            requirementList.innerHTML = '';


            if (!unitId) {

                serviceSelect.innerHTML = `
                    <option value="">
                        -- Pilih Unit Layanan
                        Terlebih Dahulu --
                    </option>
                `;

                return;
            }


            // =================================================
            // AMBIL JENIS LAYANAN
            // =================================================

            fetch(
                '<?= base_url('guest-report/services-by-unit') ?>/'
                + unitId
            )

            .then(function (response) {

                if (!response.ok) {

                    throw new Error(
                        'Gagal memuat jenis layanan'
                    );
                }

                return response.json();

            })

            .then(function (data) {

                serviceSelect.innerHTML = `
                    <option value="">
                        -- Pilih Jenis Layanan --
                    </option>
                `;


                if (
                    Array.isArray(data) &&
                    data.length > 0
                ) {

                    data.forEach(function (service) {

                        const option =
                            document.createElement(
                                'option'
                            );

                        option.value =
                            service.id;

                        option.textContent =
                            service.name;

                        serviceSelect.appendChild(
                            option
                        );

                    });


                    serviceSelect.disabled =
                        false;

                } else {

                    serviceSelect.innerHTML = `
                        <option value="">
                            -- Tidak Ada Jenis Layanan --
                        </option>
                    `;
                }

            })

            .catch(function (error) {

                console.error(error);

                serviceSelect.innerHTML = `
                    <option value="">
                        -- Gagal Memuat Jenis Layanan --
                    </option>
                `;

            });

        }
    );


    // =====================================================
    // JENIS LAYANAN DIPILIH
    // =====================================================

    serviceSelect.addEventListener(
        'change',
        function () {

            const serviceId = this.value;

            const selectedOption =
                this.options[
                    this.selectedIndex
                ];


            // -----------------------------------------
            // SIMPAN NAMA SERVICE
            // -----------------------------------------

            if (
                serviceId &&
                selectedOption
            ) {

                serviceNameInput.value =
                    selectedOption
                        .textContent
                        .trim();

            } else {

                serviceNameInput.value = '';
            }


            // -----------------------------------------
            // RESET REQUIREMENT
            // -----------------------------------------

            requirementContainer.style.display =
                'none';

            requirementList.innerHTML = '';


            if (!serviceId) {
                return;
            }


            // -----------------------------------------
            // LOADING
            // -----------------------------------------

            requirementContainer.style.display =
                'block';

            requirementList.innerHTML = `
                <div class="text-muted">
                    <i class="fas fa-spinner fa-spin"></i>
                    Memuat persyaratan...
                </div>
            `;


            // =================================================
            // AMBIL REQUIREMENT
            // =================================================

            fetch(
                '<?= base_url('guest-report/requirements') ?>/'
                + serviceId
            )

            .then(function (response) {

                if (!response.ok) {

                    throw new Error(
                        'Gagal memuat persyaratan'
                    );
                }

                return response.json();

            })

            .then(function (data) {

                requirementList.innerHTML = '';


                // -----------------------------------------
                // TIDAK ADA REQUIREMENT
                // -----------------------------------------

                if (
                    !Array.isArray(data) ||
                    data.length === 0
                ) {

                    requirementList.innerHTML = `
                        <div class="alert alert-info mb-0">
                            Tidak ada persyaratan khusus
                            untuk layanan ini.
                        </div>
                    `;

                    return;
                }


                // -----------------------------------------
                // TAMPILKAN REQUIREMENT
                // -----------------------------------------

                data.forEach(
                    function (
                        requirement,
                        index
                    ) {

                        const wrapper =
                            document.createElement(
                                'div'
                            );

                        wrapper.className =
                            'mb-4';


                        const wajib =
                            Number(
                                requirement.is_required
                            ) === 1;


                        wrapper.innerHTML = `

                            <label
                                class="form-label fw-bold"
                            >

                                ${index + 1}.
                                ${escapeHtml(
                                    requirement.name
                                )}

                                ${
                                    wajib
                                    ?
                                    '<span class="badge bg-danger ms-2">Wajib</span>'
                                    :
                                    '<span class="badge bg-secondary ms-2">Opsional</span>'
                                }

                            </label>


                            ${
                                requirement.description
                                ?
                                `
                                <div
                                    class="small text-muted mb-2"
                                >
                                    ${escapeHtml(
                                        requirement.description
                                    )}
                                </div>
                                `
                                :
                                ''
                            }


                            <input
                                type="file"
                                name="requirement_${requirement.id}"
                                class="form-control"
                                accept=".pdf,.jpg,.jpeg,.png"
                                ${wajib ? 'required' : ''}
                            >


                            <div
                                class="small text-muted mt-1"
                            >
                                Format:
                                PDF / JPG / JPEG / PNG
                            </div>

                        `;


                        requirementList.appendChild(
                            wrapper
                        );

                    }
                );

            })

            .catch(function (error) {

                console.error(error);

                requirementList.innerHTML = `
                    <div class="alert alert-danger">
                        Gagal memuat persyaratan layanan.
                    </div>
                `;

            });

        }
    );


    // =====================================================
    // RESET BUTTON
    // =====================================================

    const form =
        applicantType.closest('form');


    if (form) {

        form.addEventListener(
            'reset',
            function () {

                setTimeout(function () {

                    hideAllApplicantForms();

                    updateApplicantLabel('');

                    serviceSelect.innerHTML = `
                        <option value="">
                            -- Pilih Unit Layanan
                            Terlebih Dahulu --
                        </option>
                    `;

                    serviceSelect.disabled =
                        true;

                    serviceNameInput.value =
                        '';

                    requirementContainer
                        .style
                        .display = 'none';

                    requirementList.innerHTML =
                        '';

                }, 10);

            }
        );

    }


    // =====================================================
    // ESCAPE HTML
    // =====================================================

    function escapeHtml(text) {

        const div =
            document.createElement('div');

        div.textContent =
            text ?? '';

        return div.innerHTML;
    }


    // =====================================================
    // JALANKAN SAAT HALAMAN PERTAMA DIBUKA
    // =====================================================

    updateApplicantForm();

});

</script>

<?= $this->endSection() ?>