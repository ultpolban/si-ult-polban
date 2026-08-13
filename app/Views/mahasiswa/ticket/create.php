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

                                <?php foreach ($units as $unit): ?>

                                    <option value="<?= esc($unit['id']) ?>">

                                        <?= esc($unit['name']) ?>

                                    </option>

                                <?php endforeach; ?>

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
     DOKUMEN PERSYARATAN
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

                    Upload Dokumen Persyaratan

                </h5>

            </div>


            <div class="card-body">

                <div class="alert alert-warning">

                    <i class="fas fa-info-circle mr-2"></i>

                    Silakan unggah dokumen sesuai dengan persyaratan
                    layanan yang telah dipilih.

                </div>


                <!-- =============================================
             CONTAINER DOKUMEN
        ============================================== -->

                <div id="dokumenWrapper">

                    <div class="alert alert-info mb-0">

                        <i class="fas fa-info-circle mr-2"></i>

                        Pilih jenis layanan terlebih dahulu untuk
                        mengunggah dokumen persyaratan.

                    </div>

                </div>


                <small class="d-block text-muted mt-3">

                    <i class="fas fa-file mr-1"></i>

                    Format yang diperbolehkan mengikuti ketentuan
                    masing-masing persyaratan.

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
                        href="<?= base_url('dashboard-mahasiswa') ?>"
                        class="btn btn-secondary mb-2">

                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali

                    </a>


                    <div>

                        <!-- =========================
                     SIMPAN DRAFT
                ========================== -->

                        <button
                            type="submit"
                            name="action"
                            value="draft"
                            formnovalidate
                            formaction="<?= base_url('mahasiswa/ticket/save-draft') ?>"
                            class="btn btn-outline-primary mr-2 mb-2">

                            <i class="fas fa-save mr-1"></i>
                            Simpan Draft

                        </button>


                        <!-- =========================
                     KIRIM PENGAJUAN
                ========================== -->

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
    document.addEventListener('DOMContentLoaded', function() {

        // =====================================================
        // ELEMENT
        // =====================================================

        const unitSelect =
            document.getElementById('unitLayanan');

        const jenisSelect =
            document.getElementById('jenisLayanan');

        const persyaratanContainer =
            document.getElementById('persyaratanContainer');

        const listPersyaratan =
            document.getElementById('listPersyaratan');

        const dokumenWrapper =
            document.getElementById('dokumenWrapper');


        // =====================================================
        // UNIT LAYANAN
        // =====================================================

        unitSelect.addEventListener('change', function() {

            const unitId = this.value;


            // Reset jenis layanan

            jenisSelect.innerHTML = `
            <option value="">
                -- Memuat Jenis Layanan... --
            </option>
        `;

            jenisSelect.disabled = true;


            // Reset persyaratan

            listPersyaratan.innerHTML = '';

            persyaratanContainer.style.display = 'none';


            // Reset dokumen

            dokumenWrapper.innerHTML = `
            <div class="alert alert-info mb-0">

                <i class="fas fa-info-circle mr-2"></i>

                Pilih jenis layanan terlebih dahulu untuk
                mengunggah dokumen persyaratan.

            </div>
        `;


            // Jika unit belum dipilih

            if (!unitId) {

                jenisSelect.innerHTML = `
                <option value="">
                    -- Pilih Unit Layanan Terlebih Dahulu --
                </option>
            `;

                return;
            }


            // =================================================
            // AMBIL JENIS LAYANAN
            // =================================================

            fetch(
                    '<?= base_url('mahasiswa/ticket/jenis-layanan') ?>?unit_id=' +
                    encodeURIComponent(unitId)
                )

                .then(function(response) {

                    if (!response.ok) {
                        throw new Error(
                            'Gagal mengambil jenis layanan.'
                        );
                    }

                    return response.json();

                })

                .then(function(result) {

                    jenisSelect.innerHTML = `
                <option value="">
                    -- Pilih Jenis Layanan --
                </option>
            `;


                    if (
                        !result.success ||
                        !result.data ||
                        result.data.length === 0
                    ) {

                        jenisSelect.innerHTML = `
                    <option value="">
                        -- Tidak Ada Jenis Layanan --
                    </option>
                `;

                        return;
                    }


                    result.data.forEach(function(layanan) {

                        const option =
                            document.createElement('option');

                        option.value = layanan.id;

                        option.textContent = layanan.name;

                        jenisSelect.appendChild(option);

                    });


                    jenisSelect.disabled = false;

                })

                .catch(function(error) {

                    console.error(error);

                    jenisSelect.innerHTML = `
                <option value="">
                    -- Gagal Mengambil Data --
                </option>
            `;

                });

        });


        // =====================================================
        // JENIS LAYANAN
        // =====================================================

        jenisSelect.addEventListener('change', function() {

            const serviceId = this.value;


            // Reset

            listPersyaratan.innerHTML = '';

            persyaratanContainer.style.display = 'none';


            dokumenWrapper.innerHTML = `
            <div class="alert alert-info mb-0">

                <i class="fas fa-info-circle mr-2"></i>

                Pilih jenis layanan untuk melihat dokumen
                persyaratan.

            </div>
        `;


            if (!serviceId) {
                return;
            }


            // =================================================
            // LOADING
            // =================================================

            persyaratanContainer.style.display = 'block';

            listPersyaratan.innerHTML = `
            <li class="text-muted">

                <i class="fas fa-spinner fa-spin mr-2"></i>

                Memuat persyaratan...

            </li>
        `;


            // =================================================
            // AMBIL PERSYARATAN
            // =================================================

            fetch(
                    '<?= base_url('mahasiswa/ticket/persyaratan') ?>?service_id=' +
                    encodeURIComponent(serviceId)
                )

                .then(function(response) {

                    if (!response.ok) {
                        throw new Error(
                            'Gagal mengambil persyaratan.'
                        );
                    }

                    return response.json();

                })

                .then(function(result) {


                    if (
                        !result.success ||
                        !result.data ||
                        result.data.length === 0
                    ) {

                        listPersyaratan.innerHTML = `
                    <li class="text-muted">

                        Tidak ada persyaratan khusus
                        untuk layanan ini.

                    </li>
                `;


                        dokumenWrapper.innerHTML = `
                    <div class="alert alert-warning mb-0">

                        <i class="fas fa-exclamation-triangle mr-2"></i>

                        Tidak ada dokumen persyaratan
                        untuk layanan ini.

                    </div>
                `;

                        return;
                    }


                    // =================================================
                    // TAMPILKAN PERSYARATAN
                    // =================================================

                    result.data.forEach(function(persyaratan) {

                        const li =
                            document.createElement('li');

                        li.className = 'mb-3';


                        let html = `

                    <i class="fas fa-check-circle
                        text-success mr-2"></i>

                    <strong>
                        ${escapeHtml(persyaratan.name)}
                    </strong>

                `;


                        // Wajib / Opsional

                        if (persyaratan.is_required == 1) {

                            html += `
                        <span class="badge badge-danger ml-2">
                            Wajib
                        </span>
                    `;

                        } else {

                            html += `
                        <span class="badge badge-secondary ml-2">
                            Opsional
                        </span>
                    `;

                        }


                        // Deskripsi

                        if (persyaratan.description) {

                            html += `
                        <div class="text-muted small ml-4 mt-1">

                            ${escapeHtml(
                                persyaratan.description
                            )}

                        </div>
                    `;

                        }


                        li.innerHTML = html;

                        listPersyaratan.appendChild(li);

                    });


                    // =================================================
                    // TAMPILKAN UPLOAD DOKUMEN
                    // =================================================

                    dokumenWrapper.innerHTML = '';


                    result.data.forEach(function(persyaratan) {

                        const item =
                            document.createElement('div');

                        item.className =
                            'border rounded p-3 mb-3';


                        let requiredAttribute = '';

                        if (persyaratan.is_required == 1) {
                            requiredAttribute = 'required';
                        }


                        item.innerHTML = `

                    <div class="mb-2">

                        <strong>
                            ${escapeHtml(
                                persyaratan.name
                            )}
                        </strong>

                        ${
                            persyaratan.is_required == 1
                            ? `
                                <span class="badge badge-danger ml-2">
                                    Wajib
                                </span>
                              `
                            : `
                                <span class="badge badge-secondary ml-2">
                                    Opsional
                                </span>
                              `
                        }

                    </div>


                    ${
                        persyaratan.description
                        ? `
                            <div class="text-muted small mb-2">

                                ${escapeHtml(
                                    persyaratan.description
                                )}

                            </div>
                          `
                        : ''
                    }


                    <input
                        type="file"
                        name="dokumen[${persyaratan.id}]"
                        class="form-control dokumen-persyaratan"
                        accept="${getAcceptExtensions(
                            persyaratan.allowed_extensions
                        )}"
                        ${requiredAttribute}>


                    <small class="text-muted">

                        <i class="fas fa-upload mr-1"></i>

                        Upload:
                        ${escapeHtml(
                            persyaratan.name
                        )}

                    </small>

                `;


                        dokumenWrapper.appendChild(item);

                    });

                })

                .catch(function(error) {

                    console.error(error);


                    listPersyaratan.innerHTML = `
                <li class="text-danger">

                    <i class="fas fa-times-circle mr-2"></i>

                    Gagal mengambil data persyaratan.

                </li>
            `;


                    dokumenWrapper.innerHTML = `
                <div class="alert alert-danger mb-0">

                    <i class="fas fa-times-circle mr-2"></i>

                    Gagal mengambil dokumen persyaratan.

                </div>
            `;

                });

        });


        // =====================================================
        // ESCAPE HTML
        // =====================================================

        function escapeHtml(text) {

            if (
                text === null ||
                text === undefined
            ) {

                return '';

            }


            return String(text)

                .replace(/&/g, '&amp;')

                .replace(/</g, '&lt;')

                .replace(/>/g, '&gt;')

                .replace(/"/g, '&quot;')

                .replace(/'/g, '&#039;');

        }


        // =====================================================
        // FORMAT EXTENSION FILE
        // =====================================================

        function getAcceptExtensions(extensions) {

            if (!extensions) {

                return '.pdf,.jpg,.jpeg,.png,.doc,.docx';

            }


            // Jika sudah berupa array

            if (Array.isArray(extensions)) {

                return extensions

                    .map(function(ext) {

                        ext = String(ext).trim();

                        if (!ext.startsWith('.')) {
                            ext = '.' + ext;
                        }

                        return ext;

                    })

                    .join(',');

            }


            // Jika berupa JSON

            try {

                const parsed =
                    JSON.parse(extensions);


                if (Array.isArray(parsed)) {

                    return parsed

                        .map(function(ext) {

                            ext = String(ext).trim();

                            if (!ext.startsWith('.')) {
                                ext = '.' + ext;
                            }

                            return ext;

                        })

                        .join(',');

                }

            } catch (error) {

                // Bukan JSON

            }


            // Jika berupa:
            // pdf,jpg,jpeg

            return String(extensions)

                .split(',')

                .map(function(ext) {

                    ext = ext.trim();

                    if (!ext.startsWith('.')) {
                        ext = '.' + ext;
                    }

                    return ext;

                })

                .join(',');

        }

    });
</script>