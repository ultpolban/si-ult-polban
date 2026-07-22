<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">


    <h2>Tambah Layanan</h2>

    <hr>


    <form action="<?= base_url('layanan/store') ?>" method="post">


        <?= csrf_field(); ?>



        <!-- NAMA LAYANAN -->

        <div class="mb-3">

            <label class="form-label">
                Nama Layanan
            </label>


            <input
                type="text"
                name="nama_layanan"
                class="form-control"
                required>


        </div>





        <!-- DESKRIPSI -->

        <div class="mb-3">


            <label class="form-label">
                Deskripsi
            </label>


            <textarea
                name="deskripsi"
                class="form-control"
                rows="4"></textarea>


        </div>





        <!-- STATUS -->

        <div class="mb-3">


            <label class="form-label">
                Status
            </label>


            <select
                name="status"
                class="form-select">


                <option value="Aktif">
                    Aktif
                </option>


                <option value="Nonaktif">
                    Nonaktif
                </option>


            </select>


        </div>





        <!-- UNIT LAYANAN -->

        <div class="mb-3">


            <label class="form-label">
                Unit Layanan
            </label>


            <select
                name="unit_id"
                class="form-select"
                required>


                <option value="">
                    -- Pilih Unit --
                </option>


                <?php foreach($unit as $u): ?>


                    <option value="<?= $u['id']; ?>">

                        <?= esc($u['nama_unit']); ?>

                    </option>


                <?php endforeach; ?>


            </select>


        </div>





        <!-- KATEGORI LAYANAN -->

        <div class="mb-3">


            <label class="form-label">
                Kategori Layanan
            </label>


            <select
                name="kategori_id"
                class="form-select"
                required>


                <option value="">
                    -- Pilih Kategori --
                </option>


                <?php foreach($kategori as $k): ?>


                    <option value="<?= $k['id']; ?>">

                        <?= esc($k['nama_kategori']); ?>

                    </option>


                <?php endforeach; ?>


            </select>


        </div>





        <button type="submit" class="btn btn-primary">

            Simpan

        </button>



        <a href="<?= base_url('layanan') ?>"
           class="btn btn-secondary">

            Kembali

        </a>



    </form>


</div>


<?= $this->endSection() ?>