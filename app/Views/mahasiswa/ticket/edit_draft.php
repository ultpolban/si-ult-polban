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