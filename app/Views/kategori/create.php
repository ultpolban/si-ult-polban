<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>


<div class="container-fluid">


    <h3>Tambah Kategori Layanan</h3>

    <hr>



    <?php if(session()->getFlashdata('error')): ?>

        <div class="alert alert-danger">

            <?= session()->getFlashdata('error'); ?>

        </div>

    <?php endif; ?>





    <form action="<?= base_url('kategori/store'); ?>" method="post">


        <?= csrf_field(); ?>



        <!-- NAMA KATEGORI -->

        <div class="mb-3">


            <label class="form-label">
                Nama Kategori
            </label>


            <input 
                type="text"
                name="nama_kategori"
                class="form-control"
                placeholder="Masukkan nama kategori"
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
                rows="4"
                placeholder="Masukkan deskripsi kategori"></textarea>


        </div>





        <!-- STATUS -->

        <div class="mb-3">


            <label class="form-label">
                Status
            </label>


            <select 
                name="status"
                class="form-select"
                required>


                <option value="">
                    -- Pilih Status --
                </option>


                <option value="Aktif">
                    Aktif
                </option>


                <option value="Tidak Aktif">
                    Tidak Aktif
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
                    -- Pilih Unit Layanan --
                </option>



                <?php if(!empty($unit)): ?>


                    <?php foreach($unit as $u): ?>


                        <option value="<?= $u['id']; ?>">


                            <?= esc($u['nama_unit']); ?>


                        </option>


                    <?php endforeach; ?>



                <?php else: ?>


                    <option value="">
                        Data unit belum tersedia
                    </option>



                <?php endif; ?>



            </select>



        </div>






        <button type="submit" class="btn btn-primary">

            Simpan

        </button>




        <a href="<?= base_url('kategori'); ?>" 
           class="btn btn-secondary">

            Kembali

        </a>



    </form>


</div>



<?= $this->endSection() ?>