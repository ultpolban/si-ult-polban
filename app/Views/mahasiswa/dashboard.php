<?= $this->include('layouts/header'); ?>
<?= $this->include('layouts/navbar'); ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">
                    <h1>Dashboard Mahasiswa</h1>
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
<h3>
Selamat Datang Mahasiswa,
<?= $user['nama']; ?>
</h3>

<p class="text-muted">

NIM :
<?= $user['nim']; ?>

<br>

Program Studi :
<?= $user['prodi']; ?>

<br>

Jurusan :
<?= $user['jurusan']; ?>

<br>

Semester :
<?= $user['semester']; ?>

<br>

Status :
<span class="badge bg-success">
<?= $user['status']; ?>
</span>

</p>

            <!-- Statistik -->
            <div class="row">

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-primary elevation-3"
     style="border-radius:15px;">

                        <div class="inner">

                            <h2 class="fw-bold">
    <?= $statistik['total']; ?>
</h2>

                            <p>Jumlah Pengajuan</p>

                        </div>

                        <div class="icon">
    <i class="fas fa-ticket-alt fa-3x"
       style="top:18px;"></i>
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

            <div class="row mt-3">

    <div class="col-md-4">

        <a href="<?= base_url('ticket/create') ?>" class="btn btn-danger btn-block">

            <i class="fas fa-plus-circle"></i>

            Ajukan Layanan Baru

        </a>

    </div>

    <div class="col-md-4">

        <a href="<?= base_url('ticket/history') ?>" class="btn btn-primary btn-block">

            <i class="fas fa-history"></i>

            Riwayat Pengajuan

        </a>

    </div>

    <div class="col-md-4">

        <a href="<?= base_url('notification') ?>" class="btn btn-success btn-block">

            <i class="fas fa-bell"></i>

            Notifikasi

        </a>

    </div>

</div>

<br>

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

                        <?php

$statusColor = [

    'Submitted'   => 'primary',
    'Verification'=> 'warning',
    'In Progress' => 'info',
    'Revision'    => 'danger',
    'Completed'   => 'success'

];

?>

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