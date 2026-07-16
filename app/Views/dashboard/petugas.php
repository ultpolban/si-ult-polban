<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0 font-weight-bold">
            Dashboard Petugas ULT
        </h1>

        <small class="text-muted">
            Kelola tiket layanan mahasiswa
        </small>
    </div>
</div>

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>120</h3>
                <p>Tiket Masuk</p>
            </div>
            <div class="icon">
                <i class="fas fa-inbox"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>15</h3>
                <p>Perlu Verifikasi</p>
            </div>
            <div class="icon">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>87</h3>
                <p>Sudah Disposisi</p>
            </div>
            <div class="icon">
                <i class="fas fa-share"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>4</h3>
                <p>Over SLA</p>
            </div>
            <div class="icon">
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

</div>

<div class="card">

    <div class="card-header bg-primary">

        <h3 class="card-title">

            Daftar Tiket Masuk

        </h3>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover">

            <thead class="bg-light">

            <tr>

                <th>No</th>

                <th>No Tiket</th>

                <th>Pemohon</th>

                <th>Layanan</th>

                <th>Status</th>

                <th>Prioritas</th>

                <th>Aksi</th>

            </tr>

            </thead>

            <tbody>

            <tr>

                <td>1</td>

                <td>ULT-0001</td>

                <td>Rafi Putra</td>

                <td>Surat Aktif Kuliah</td>

                <td>

                    <span class="badge badge-warning">

                        Submitted

                    </span>

                </td>

                <td>

                    <span class="badge badge-success">

                        Normal

                    </span>

                </td>

                <td>

                    <a href="<?= base_url('petugas/verifikasi') ?>" class="btn btn-primary btn-sm">

                        Verifikasi

                    </a>

                </td>

            </tr>

            <tr>

                <td>2</td>

                <td>ULT-0002</td>

                <td>Andi Saputra</td>

                <td>Legalisir Ijazah</td>

                <td>

                    <span class="badge badge-warning">

                        Submitted

                    </span>

                </td>

                <td>

                    <span class="badge badge-danger">

                        Urgent

                    </span>

                </td>

                <td>

                    <a href="<?= base_url('petugas/verifikasi') ?>" class="btn btn-primary btn-sm">

                        Verifikasi

                    </a>

                </td>

            </tr>

            </tbody>

        </table>

    </div>

</div>

<?= $this->endSection() ?>