<?= $this->extend('layouts/template') ?>
<?= $this->section('content'); ?>


<h3>Data Layanan</h3>


<a href="<?= base_url('layanan/create'); ?>" class="btn btn-primary mb-3">

    Tambah Layanan

</a>



<table class="table table-bordered table-striped">


    <thead class="table-dark">


        <tr>

            <th width="60">No</th>

            <th>Nama Layanan</th>

            <th>Kategori</th>

            <th>Unit Layanan</th>

            <th>Deskripsi</th>

            <th>Status</th>

            <th width="170">Aksi</th>

        </tr>


    </thead>



    <tbody>


    <?php if(empty($layanan)): ?>


        <tr>

            <td colspan="7" class="text-center">

                Belum ada data layanan.

            </td>

        </tr>



    <?php else: ?>



        <?php $no=1; ?>



        <?php foreach($layanan as $l): ?>



        <tr>


            <td>
                <?= $no++; ?>
            </td>



            <td>
                <?= esc($l['nama_layanan']); ?>
            </td>



            <td>
                <?= esc($l['nama_kategori']); ?>
            </td>



            <td>
                <?= esc($l['nama_unit']); ?>
            </td>



            <td>
                <?= esc($l['deskripsi']); ?>
            </td>



            <td>
                <?= esc($l['status']); ?>
            </td>



            <td>


                <a href="<?= base_url('layanan/edit/'.$l['id']); ?>"
                class="btn btn-warning btn-sm">

                    Edit

                </a>



                <a href="<?= base_url('layanan/delete/'.$l['id']); ?>"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Yakin hapus data?')">

                    Hapus

                </a>


            </td>



        </tr>



        <?php endforeach; ?>



    <?php endif; ?>



    </tbody>


</table>



<?= $this->endSection(); ?>