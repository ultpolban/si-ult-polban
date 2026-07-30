<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="font-weight-bold">
            Laporan Tiket
        </h2>
    </div>

</div>

<div class="card shadow-sm mb-4">

    <div class="card-header text-white"
         style="background:#1a237e;">

        <strong>Cari Laporan Tiket</strong>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-8">

                <label>Nomor Tiket</label>

                <input
                    type="text"
                    class="form-control"
                    placeholder="Masukkan Nomor Tiket">

            </div>

            <div class="col-md-4 d-flex align-items-end">

                <button class="btn btn-primary mr-2">

                    <i class="fas fa-search"></i>

                    Cari

                </button>

                <button class="btn btn-secondary">

                    Reset

                </button>

            </div>

        </div>

    </div>

</div>

<div class="card shadow-sm">

    <div class="card-header text-white"
         style="background:#1a237e;">

        <strong>Data Laporan Tiket</strong>

    </div>

    <div class="card-body">

        <button class="btn btn-primary mb-3">

            <i class="fas fa-download"></i>

            Export Laporan

        </button>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead
                    class="text-white"
                    style="background:#1a237e;">

                <tr>

                    <th>No</th>

                    <th>No Tiket</th>

                    <th>Nama Pemohon</th>

                    <th>Jenis Pemohon</th>

                    <th>Layanan</th>

                    <th>Status</th>

                    <th>Prioritas</th>

                    <th>Tanggal Pengajuan</th>

                </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>1</td>

                        <td>ULT-20260730081403481</td>

                        <td>Apin</td>

                        <td>Mahasiswa</td>

                        <td>Kemahasiswaan</td>

                        <td>

                            <span class="badge badge-warning">

                                Waiting Verification

                            </span>

                        </td>

                        <td>Normal</td>

                        <td>30-07-2026</td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>