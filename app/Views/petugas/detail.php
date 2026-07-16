<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>
<?= view('layouts/sidebar') ?>

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h2>Detail Tiket</h2>
            <p class="text-muted">
                Informasi lengkap permohonan layanan
            </p>
        </div>
    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <!-- Informasi Tiket -->
                <div class="col-md-8">

                    <div class="card card-primary">

                        <div class="card-header">
                            <h3 class="card-title">
                                Informasi Tiket
                            </h3>
                        </div>

                        <div class="card-body">

                            <table class="table table-bordered">

                                <tr>
                                    <th width="220">Nomor Tiket</th>
                                    <td>ULT-20260715-0001</td>
                                </tr>

                                <tr>
                                    <th>Nama Pemohon</th>
                                    <td>Budi Santoso</td>
                                </tr>

                                <tr>
                                    <th>NIM</th>
                                    <td>221511000</td>
                                </tr>

                                <tr>
                                    <th>Layanan</th>
                                    <td>Surat Keterangan Aktif Kuliah</td>
                                </tr>

                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <span class="badge badge-warning">
                                            Submitted
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Prioritas</th>
                                    <td>
                                        <span class="badge badge-danger">
                                            High
                                        </span>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Tanggal Pengajuan</th>
                                    <td>15 Juli 2026</td>
                                </tr>

                            </table>

                        </div>

                    </div>

                </div>

                <!-- Lampiran -->
                <div class="col-md-4">

                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">
                                Lampiran
                            </h3>
                        </div>

                        <div class="card-body">

<table class="table table-bordered">

<tr>
    <th width="220">Nomor Tiket</th>
    <td>ULT-20260715-0001</td>
</tr>

<tr>
    <th>Nama Pemohon</th>
    <td>Budi Santoso</td>
</tr>

<tr>
    <th>Email</th>
    <td>budi@gmail.com</td>
</tr>

<tr>
    <th>Jenis Layanan</th>
    <td>Surat Aktif Kuliah</td>
</tr>

<tr>
    <th>Status</th>
    <td>
        <span class="badge bg-warning">
            Submitted
        </span>
    </td>
</tr>

<tr>
    <th>Prioritas</th>
    <td>
        <span class="badge bg-danger">
            High
        </span>
    </td>
</tr>

<tr>
    <th>Tanggal</th>
    <td>15 Juli 2026</td>
</tr>

<tr>
    <th>Deskripsi</th>
    <td>
        Pengajuan Surat Aktif Kuliah untuk kebutuhan beasiswa.
    </td>
</tr>

<tr>
    <th>Lampiran</th>
    <td>
        <a href="#" class="btn btn-info btn-sm">
            Download KTM.pdf
        </a>
    </td>
</tr>

</table>

</div>

<div class="card-footer">

<a href="<?= base_url('petugas/tiket') ?>"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

</div>
                    </div>

                </div>

            </div>

            <!-- Riwayat -->
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">
                        Riwayat Status
                    </h3>
                </div>

                <div class="card-body">

                    <table class="table table-striped">

                        <thead>

                        <tr>

                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Keterangan</th>

                        </tr>

                        </thead>

                        <tbody>

                        <tr>

                            <td>15 Juli 2026</td>

                            <td>
                                <span class="badge badge-primary">
                                    Submitted
                                </span>
                            </td>

                            <td>Permohonan berhasil dibuat.</td>

                        </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- Tombol -->
            <div class="mb-4">

                <a href="/petugas/verifikasi/1"
                   class="btn btn-success">

                    <i class="fas fa-check"></i>

                    Verifikasi

                </a>

                <a href="/petugas/disposisi/1"
                   class="btn btn-primary">

                    <i class="fas fa-share"></i>

                    Disposisi

                </a>

                <a href="<?= base_url('petugas/update-status/1') ?>"
class="btn btn-warning">

<i class="fas fa-edit"></i>

Update Status

</a>

                <a href="/petugas/tiket"
                   class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Kembali

                </a>

            </div>

        </div>

    </section>

</div>

<?= view('layouts/footer') ?>