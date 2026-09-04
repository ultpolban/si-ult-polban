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
                        style="color:#0b3d91;">

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
                    ">

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
                        enctype="multipart/form-data">

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
                                name="unit_id"
                                id="unit_layanan"
                                class="form-control"
                                required>

                                <option value="">
                                    -- Pilih Unit Layanan --
                                </option>

                                <?php foreach ($units as $unit): ?>

                                    <option
                                        value="<?= $unit['id'] ?>"
                                        <?= (int)$draft['service_unit_id'] === (int)$unit['id']
                                            ? 'selected'
                                            : '' ?>>
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
                                name="jenis_layanan"
                                id="layanan"
                                class="form-control"
                                required>

                                <option value="">
                                    -- Pilih Jenis Layanan --
                                </option>

                                <?php foreach ($services as $service): ?>

                                    <option
                                        value="<?= $service['id'] ?>"
                                        data-unit-id="<?= $service['service_unit_id'] ?>"
                                        <?= (int)$draft['service_id'] === (int)$service['id']
                                            ? 'selected'
                                            : '' ?>>
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
                                placeholder="Masukkan keterangan pengajuan..."><?= esc($draft['description'] ?? '') ?></textarea>

                        </div>

                        <!-- ==========================================
     PERSYARATAN DOKUMEN
========================================== -->

                        <div class="mb-4">

                            <label class="font-weight-bold">
                                Persyaratan Dokumen
                            </label>

                            <div id="requirements-container">

                                <?php if (!empty($requirements)): ?>

                                    <?php foreach ($requirements as $requirement): ?>

                                        <?php
                                        $oldFile =
                                            $uploadedFiles[$requirement['id']] ?? null;
                                        ?>

                                        <div
                                            class="card mb-3 requirement-item"
                                            data-requirement-id="<?= $requirement['id'] ?>">

                                            <div class="card-body">

                                                <label class="font-weight-bold">

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

                                                </label>


                                                <?php if (
                                                    !empty($requirement['description'])
                                                ): ?>

                                                    <p class="text-muted mb-2">

                                                        <?= esc(
                                                            $requirement['description']
                                                        ) ?>

                                                    </p>

                                                <?php endif; ?>


                                                <?php if ($oldFile): ?>

                                                    <div
                                                        class="alert alert-success">

                                                        <i
                                                            class="fas fa-check-circle mr-1"></i>

                                                        Dokumen sudah diupload:

                                                        <strong>
                                                            <?= esc(
                                                                $oldFile['original_name']
                                                            ) ?>
                                                        </strong>

                                                    </div>

                                                <?php else: ?>

                                                    <div
                                                        class="alert alert-warning">

                                                        <i
                                                            class="fas fa-exclamation-circle mr-1"></i>

                                                        Dokumen belum diupload.

                                                    </div>

                                                <?php endif; ?>


                                                <input
                                                    type="file"
                                                    name="dokumen[<?= $requirement['id'] ?>]"
                                                    class="form-control"
                                                    accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx">


                                                <small class="text-muted">

                                                    Maksimal:
                                                    <?= esc(
                                                        $requirement['max_file_size']
                                                            ?? 2048
                                                    ) ?>
                                                    KB

                                                    <?php if (
                                                        !empty($requirement['allowed_extensions'])
                                                    ): ?>

                                                        <br>

                                                        Format:
                                                        <?= esc(
                                                            $requirement['allowed_extensions']
                                                        ) ?>

                                                    <?php endif; ?>

                                                </small>

                                            </div>

                                        </div>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <div class="alert alert-info">

                                        <i class="fas fa-info-circle mr-1"></i>

                                        Tidak ada persyaratan dokumen
                                        untuk layanan ini.

                                    </div>

                                <?php endif; ?>

                            </div>

                        </div>

                        <!-- ==================================
                             TOMBOL
                        =================================== -->

                        <div class="mt-4">

                            <a
                                href="<?= base_url(
                                            'mahasiswa/ticket/draft'
                                        ) ?>"
                                class="btn btn-secondary">

                                <i class="fas fa-arrow-left mr-1"></i>

                                Kembali

                            </a>


                            <button
                                type="submit"
                                name="action"
                                value="draft"
                                class="btn btn-outline-primary">
                                <i class="fas fa-save mr-1"></i>
                                Simpan Draft
                            </button>

                            <button
                                type="submit"
                                name="action"
                                value="submit"
                                class="btn text-white"
                                style="
                                background:#0b3d91;
                                border-color:#0b3d91;
                                ">
                                <i class="fas fa-paper-plane mr-1"></i>
                                Ajukan
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>

</div>

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            const unit =
                document.getElementById(
                    'unit_layanan'
                );

            const layanan =
                document.getElementById(
                    'layanan'
                );

            const container =
                document.getElementById(
                    'requirements-container'
                );


            function filterServices() {

                const unitId =
                    unit.value;


                Array.from(
                    layanan.options
                ).forEach(function(option) {

                    if (!option.value) {
                        return;
                    }


                    option.hidden =
                        option.dataset.unitId !==
                        unitId;
                });


                if (
                    layanan.value &&
                    layanan.selectedOptions[0] &&
                    layanan.selectedOptions[0]
                    .dataset.unitId !== unitId
                ) {

                    layanan.value = '';

                    container.innerHTML = '';
                }
            }


            unit.addEventListener(
                'change',
                function() {

                    filterServices();

                    layanan.value = '';

                    container.innerHTML = '';

                }
            );


            layanan.addEventListener(
                'change',
                function() {

                    const serviceId =
                        this.value;


                    if (!serviceId) {

                        container.innerHTML = '';

                        return;
                    }


                    fetch(
                            '<?= base_url(
                                    'mahasiswa/ticket/persyaratan'
                                ) ?>?service_id=' +
                            serviceId
                        )
                        .then(
                            response =>
                            response.json()
                        )
                        .then(
                            result => {

                                if (
                                    !result.success
                                ) {

                                    container.innerHTML =
                                        '<div class="alert alert-danger">' +
                                        'Persyaratan gagal dimuat.' +
                                        '</div>';

                                    return;
                                }


                                renderRequirements(
                                    result.data
                                );

                            }
                        )
                        .catch(
                            error => {

                                console.error(error);

                                container.innerHTML =
                                    '<div class="alert alert-danger">' +
                                    'Terjadi kesalahan saat memuat persyaratan.' +
                                    '</div>';
                            }
                        );

                }
            );


            function renderRequirements(
                requirements
            ) {

                if (
                    !requirements.length
                ) {

                    container.innerHTML =
                        '<div class="alert alert-info">' +
                        '<i class="fas fa-info-circle mr-1"></i>' +
                        'Tidak ada persyaratan dokumen untuk layanan ini.' +
                        '</div>';

                    return;
                }


                let html = '';


                requirements.forEach(
                    function(requirement) {

                        html += `

                        <div
                            class="card mb-3"
                        >

                            <div class="card-body">

                                <label
                                    class="font-weight-bold"
                                >

                                    ${escapeHtml(
                                        requirement.name
                                    )}

                                    ${
                                        requirement.is_required == 1
                                        ? '<span class="text-danger">*</span>'
                                        : ''
                                    }

                                </label>

                                ${
                                    requirement.description
                                    ? `
                                        <p class="text-muted">
                                            ${escapeHtml(
                                                requirement.description
                                            )}
                                        </p>
                                    `
                                    : ''
                                }

                                <input
                                    type="file"
                                    name="dokumen[${requirement.id}]"
                                    class="form-control"
                                >

                                <small
                                    class="text-muted"
                                >

                                    Maksimal
                                    ${requirement.max_file_size || 2048}
                                    KB

                                </small>

                            </div>

                        </div>

                    `;
                    }
                );


                container.innerHTML = html;
            }


            function escapeHtml(text) {

                const div =
                    document.createElement('div');

                div.textContent =
                    text ?? '';

                return div.innerHTML;
            }


            filterServices();

        }
    );
</script>




<?= $this->include('layouts/footer') ?>