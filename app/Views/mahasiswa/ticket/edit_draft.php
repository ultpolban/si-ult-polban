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
                        class="font-weight-bold"
                        style="color:#0b3d91;"
                    >

                        <i class="fas fa-edit mr-2"></i>

                        Edit Draft Pengajuan

                    </h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('dashboard-mahasiswa') ?>">

                                Dashboard

                            </a>

                        </li>

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('mahasiswa/ticket/draft') ?>">

                                Draft Pengajuan

                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            Edit Draft

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>


    <!-- ==========================================
         CONTENT
    =========================================== -->

    <section class="content">

        <div class="container-fluid">

            <div class="card shadow-sm border-0">

                <!-- HEADER CARD -->

                <div
                    class="card-header text-white"
                    style="
                        background-color:#0b3d91;
                        border-bottom:4px solid #f28c28;
                    "
                >

                    <h5 class="mb-0">

                        <i class="fas fa-file-alt mr-2"></i>

                        Lanjutkan Draft Pengajuan

                    </h5>

                </div>


                <!-- BODY -->

                <div class="card-body">

                    <form
    action="<?= base_url(
        'mahasiswa/ticket/update-draft/' . $draft['id']
    ) ?>"
    method="post"
    enctype="multipart/form-data"
>

                        <?= csrf_field() ?>


                        <!-- ==================================
                             UNIT LAYANAN
                        =================================== -->

                        <div class="form-group">

                            <label>

                                <i class="fas fa-building mr-1"></i>

                                Unit Layanan

                            </label>

                            <select
                                name="unit_layanan"
                                id="unit_layanan"
                                class="form-control"
                                required
                            >

                                <option value="">

                                    -- Pilih Unit Layanan --

                                </option>

                                <?php foreach ($units as $unit): ?>

                                    <option
                                        value="<?= $unit['id'] ?>"
                                        <?= (
                                            $draft['service_unit_id']
                                            == $unit['id']
                                        )
                                            ? 'selected'
                                            : ''
                                        ?>
                                    >

                                        <?= esc($unit['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <!-- ==================================
                             JENIS LAYANAN
                        =================================== -->

                        <div class="form-group">

                            <label>

                                <i class="fas fa-list mr-1"></i>

                                Jenis Layanan

                            </label>

                            <select
                                name="service_id"
                                id="service_id"
                                class="form-control"
                                required
                            >

                                <option value="">

                                    -- Pilih Jenis Layanan --

                                </option>

                                <?php foreach ($services as $service): ?>

                                    <option
                                        value="<?= $service['id'] ?>"
                                        data-unit="<?= $service['service_unit_id'] ?>"
                                        <?= (
                                            $draft['service_id']
                                            == $service['id']
                                        )
                                            ? 'selected'
                                            : ''
                                        ?>
                                    >

                                        <?= esc($service['name']) ?>

                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>


                        <!-- ==================================
                             KETERANGAN
                        =================================== -->

                        <div class="form-group">

                            <label>

                                <i class="fas fa-align-left mr-1"></i>

                                Keterangan

                            </label>

                            <textarea
                                name="description"
                                class="form-control"
                                rows="5"
                                placeholder="Masukkan keterangan pengajuan..."
                            ><?= esc($draft['description'] ?? '') ?></textarea>

                        </div>

                        <!-- ==========================================
     DOKUMEN PERSYARATAN
========================================== -->

<div class="form-group mt-4">

    <label class="font-weight-bold">

        <i class="fas fa-file-upload mr-1"></i>

        Dokumen Persyaratan

    </label>


    <?php if (!empty($requirements)): ?>

        <div class="alert alert-info">

            <i class="fas fa-info-circle mr-2"></i>

            Silakan upload semua dokumen yang dipersyaratkan
            untuk layanan ini.

        </div>


        <?php foreach ($requirements as $requirement): ?>

            <?php

                $requirementId = $requirement['id'];

                $existingFile =
                    $uploadedFiles[$requirementId] ?? null;

            ?>


            <div
                class="card mb-3 border"
            >

                <div class="card-body">


                    <div class="row">


                        <!-- INFORMASI PERSYARATAN -->

                        <div class="col-md-7">

                            <h6
                                class="font-weight-bold"
                                style="color:#17365d;"
                            >

                                <?= esc(
                                    $requirement['name']
                                ) ?>


                                <?php if (
                                    $requirement['is_required']
                                ): ?>

                                    <span class="text-danger">
                                        *
                                    </span>

                                <?php endif; ?>

                            </h6>


                            <?php if (
                                !empty(
                                    $requirement['description']
                                )
                            ): ?>

                                <small class="text-muted">

                                    <?= esc(
                                        $requirement['description']
                                    ) ?>

                                </small>

                            <?php endif; ?>


                            <div class="mt-2">

                                <small class="text-muted">

                                    Format:
                                    <?= esc(
                                        $requirement[
                                            'allowed_extensions'
                                        ] ?? 'pdf,jpg,jpeg,png,doc,docx'
                                    ) ?>

                                    <br>

                                    Maksimal:
                                    <?= esc(
                                        $requirement[
                                            'max_file_size'
                                        ] ?? 2048
                                    ) ?>
                                    KB

                                </small>

                            </div>

                        </div>


                        <!-- FILE -->

                        <div class="col-md-5">


                            <?php if ($existingFile): ?>

                                <div
                                    class="alert alert-success py-2"
                                >

                                    <i
                                        class="fas fa-check-circle mr-1"
                                    ></i>

                                    Dokumen sudah diupload

                                    <br>

                                    <small>

                                        <?= esc(
                                            $existingFile[
                                                'original_name'
                                            ]
                                        ) ?>

                                    </small>

                                </div>


                                <input
                                    type="file"
                                    name="documents[<?= $requirementId ?>]"
                                    class="form-control"
                                >

                                <small class="text-muted">

                                    Upload file baru jika ingin
                                    mengganti dokumen.

                                </small>


                            <?php else: ?>

                                <input
                                    type="file"
                                    name="documents[<?= $requirementId ?>]"
                                    class="form-control"
                                    <?= $requirement['is_required']
                                        ? 'required'
                                        : '' ?>
                                >

                            <?php endif; ?>


                        </div>

                    </div>

                </div>

            </div>


        <?php endforeach; ?>


    <?php else: ?>

        <div class="alert alert-warning">

            <i class="fas fa-exclamation-triangle mr-2"></i>

            Tidak ada persyaratan dokumen untuk layanan ini.

        </div>

    <?php endif; ?>

</div>


                        <!-- ==================================
                             TOMBOL
                        =================================== -->

                        <div class="mt-4">

                            <a
                                href="<?= base_url(
                                    'mahasiswa/ticket/draft'
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
                                    background-color:#f28c28;
                                    border-color:#f28c28;
                                "
                            >

                                <i class="fas fa-save mr-1"></i>

                                Simpan Draft

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const unitSelect = document.getElementById('unit_layanan');

    const serviceSelect = document.getElementById('service_id');

    function filterServices() {

        const selectedUnit = unitSelect.value;

        const options = serviceSelect.querySelectorAll('option');

        options.forEach(function (option) {

            if (!option.value) {
                return;
            }

            const unitId = option.getAttribute('data-unit');

            if (
                selectedUnit === ''
                ||
                unitId === selectedUnit
            ) {

                option.style.display = '';

            } else {

                option.style.display = 'none';

                if (option.selected) {
                    option.selected = false;
                }

            }

        });

    }

    unitSelect.addEventListener(
        'change',
        filterServices
    );

    filterServices();

});

</script>


<?= $this->include('layouts/footer') ?>