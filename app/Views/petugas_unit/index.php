<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>


<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">
                Tiket Unit Layanan
            </h3>
        </div>


        <div class="card-body">


            <table class="table table-bordered table-striped">

                <thead>

                    <tr>
                        <th>No</th>
                        <th>No Tiket</th>
                        <th>Nama Pemohon</th>
                        <th>Layanan</th>
                        <th>Sumber</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                </thead>


                <tbody>


                <?php if(empty($tiket)): ?>

                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada tiket masuk
                        </td>
                    </tr>


                <?php else: ?>


                    <?php $no = 1; ?>

                    <?php foreach($tiket as $t): ?>


                    <tr>

                        <td>
                            <?= $no++ ?>
                        </td>


                        <td>
                            <?= $t['no_tiket'] ?>
                        </td>


                        <td>
                            <?= $t['nama_pemohon'] ?>
                        </td>


                        <td>
                            <?= $t['nama_layanan'] ?>
                        </td>


                        <td>
                            <?= $t['sumber'] ?>
                        </td>


                        <td>


                            <?php if($t['status'] == 'Selesai'): ?>

                                <span class="badge bg-success">
                                    Selesai
                                </span>


                            <?php elseif($t['status'] == 'Diproses'): ?>

                                <span class="badge bg-warning">
                                    Diproses
                                </span>


                            <?php else: ?>

                                <span class="badge bg-secondary">
                                    <?= $t['status'] ?>
                                </span>


                            <?php endif; ?>


                        </td>


                        <td>

                            <a href="<?= base_url('petugas-unit/proses/'.$t['id']) ?>"
                            class="btn btn-primary btn-sm">

                                Proses

                            </a>


                        </td>


                    </tr>


                    <?php endforeach; ?>


                <?php endif; ?>


                </tbody>


            </table>


        </div>

    </div>

</div>


<?= $this->endSection() ?>