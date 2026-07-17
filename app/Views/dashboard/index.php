<?= $this->include('layouts/header'); ?>
<?= $this->include('layouts/navbar'); ?>
<?= $this->include('layouts/sidebar'); ?>

<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Dashboard Pemohon</h1>
                </div>

                <div class="col-sm-6 text-end">

                    <a href="<?= base_url('ticket/create') ?>" class="btn btn-danger">

                        <i class="fas fa-plus-circle"></i>

                        Ajukan Layanan

                    </a>

                </div>

            </div>

        </div>
    </section>

    <!-- Main -->
    <section class="content">

        <div class="container-fluid">

            <!-- Welcome Card -->
            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <h3>
                        Selamat Datang,
                        <?= $user['nama']; ?>
                    </h3>

                    <p class="text-muted">

                        NIM :
                        <?= $user['nim']; ?>

                        <br>

                        Program Studi :
                        <?= $user['prodi']; ?>

                    </p>

                </div>

            </div>

            <!-- Statistik -->
            <div class="row">

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-primary">

                        <div class="inner">

                            <h3><?= $statistik['total']; ?></h3>

                            <p>Total Tiket</p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-ticket-alt"></i>

                        </div>

                    </div>

                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">

                        <div class="inner">

                            <h3><?= $statistik['diproses']; ?></h3>

                            <p>Sedang Diproses</p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-spinner"></i>

                        </div>

                    </div>

                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">

                        <div class="inner">

                            <h3><?= $statistik['revisi']; ?></h3>

                            <p>Perlu Revisi</p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-times-circle"></i>

                        </div>

                    </div>

                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-success">

                        <div class="inner">

                            <h3><?= $statistik['selesai']; ?></h3>

                            <p>Selesai</p>

                        </div>

                        <div class="icon">

                            <i class="fas fa-check-circle"></i>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Riwayat -->
            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">

                        Riwayat Pengajuan Layanan

                    </h3>

                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="table-dark">

                        <tr>

                            <th>No</th>

                            <th>Nomor Tiket</th>

                            <th>Layanan</th>

                            <th>Tanggal</th>

                            <th>Status</th>

                            <th>Aksi</th>

                        </tr>

                        </thead>

                        <tbody>

                        <?php $no=1; ?>

                        <?php foreach($tickets as $t): ?>

                            <tr>

                                <td><?= $no++; ?></td>

                                <td><?= $t['nomor']; ?></td>

                                <td><?= $t['layanan']; ?></td>

                                <td><?= $t['tanggal']; ?></td>

                                <td>

                                    <?php

                                    if($t['status']=="Submitted"){

                                        echo '<span class="badge bg-primary">Submitted</span>';

                                    }

                                    elseif($t['status']=="Completed"){

                                        echo '<span class="badge bg-success">Completed</span>';

                                    }

                                    else{

                                        echo '<span class="badge bg-warning">'.$t['status'].'</span>';

                                    }

                                    ?>

                                </td>

                                <td>

    <a href="<?= base_url('ticket/detail/'.$t['id']) ?>" class="btn btn-info btn-sm">

        <i class="fas fa-eye"></i>

        Detail

    </a>

</td>

                            </tr>

                        <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer'); ?>