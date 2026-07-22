<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">


    <h2>Tambah Unit Layanan</h2>

    <hr>


    <form action="<?= base_url('unit/store') ?>" method="post">


        <?= csrf_field(); ?>



        <!-- NAMA UNIT -->

        <div class="mb-3">


            <label class="form-label">
                Nama Unit
            </label>


            <input
                type="text"
                name="nama_unit"
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





        <button type="submit" class="btn btn-primary">

            Simpan

        </button>



        <a href="<?= base_url('unit') ?>"
           class="btn btn-secondary">

            Kembali

        </a>



    </form>


</div>


<?= $this->endSection() ?>