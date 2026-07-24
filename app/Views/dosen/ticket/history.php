<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_dosen') ?>


<style>

/* =========================================
   HALAMAN TRACKING TIKET DOSEN
========================================= */

.tracking-page {
    background: #f4f7fb;
    min-height: calc(100vh - 57px);
    padding-bottom: 40px;
}


/* =========================================
   JUDUL
========================================= */

.page-title {
    color: #0b3d91;
    font-weight: 700;
}

.page-subtitle {
    color: #64748b;
}


/* =========================================
   CARD
========================================= */

.tracking-card {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0, 0, 0, .08);
}

.tracking-card .card-header {
    background: #0b3d91;
    color: white;
    padding: 20px 25px;
    border: none;
}

.tracking-card .card-header h3 {
    margin: 0;
    font-size: 21px;
    font-weight: 700;
}


/* =========================================
   SEARCH
========================================= */

.search-box {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 3px 12px rgba(0,0,0,.05);
    margin-bottom: 25px;
}

.search-box label {
    color: #17365d;
    font-weight: 700;
}

.search-box .form-control {
    min-height: 48px;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
}

.search-box .form-control:focus {
    border-color: #0b3d91;
    box-shadow: 0 0 0 .2rem rgba(11,61,145,.12);
}

.btn-search {
    background: #0b3d91;
    color: white;
    border: none;
    min-height: 48px;
    padding: 0 25px;
    border-radius: 8px;
    font-weight: 700;
}

.btn-search:hover {
    background: #082f70;
    color: white;
}


/* =========================================
   TABLE
========================================= */

.ticket-table {
    vertical-align: middle;
}

.ticket-table thead th {
    background: #0b3d91;
    color: white;
    font-weight: 700;
    padding: 14px;
    white-space: nowrap;
}

.ticket-table tbody td {
    padding: 14px;
    color: #334155;
}

.ticket-table tbody tr:hover {
    background: #f8fafc;
}


/* =========================================
   NOMOR TIKET
========================================= */

.ticket-number {
    color: #0b3d91;
    font-weight: 700;
}


/* =========================================
   STATUS
========================================= */

.status-badge {
    padding: 7px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 700;
}


/* =========================================
   BUTTON DETAIL
========================================= */

.btn-detail {
    background: #f28c28;
    color: white;
    border: none;
    border-radius: 7px;
    padding: 7px 14px;
    font-weight: 600;
}

.btn-detail:hover {
    background: #d97617;
    color: white;
}


/* =========================================
   EMPTY STATE
========================================= */

.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state i {
    font-size: 60px;
    color: #94a3b8;
    margin-bottom: 15px;
}

.empty-state h4 {
    color: #475569;
    font-weight: 700;
}

.empty-state p {
    color: #64748b;
}


/* =========================================
   INFO CARD
========================================= */

.info-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,.07);
    overflow: hidden;
}

.info-card .card-header {
    background: #f28c28;
    color: white;
    font-weight: 700;
    padding: 15px 20px;
}

.info-card .card-body {
    color: #475569;
    line-height: 1.7;
}


/* =========================================
   RESPONSIVE
========================================= */

@media (max-width: 768px) {

    .ticket-table {
        min-width: 800px;
    }

}

</style>


<div class="content-wrapper tracking-page">


    <!-- =====================================
         HEADER
    ====================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <h1 class="page-title">

                <i class="fas fa-ticket-alt"></i>

                Tracking Tiket

            </h1>

            <p class="page-subtitle">

                Pantau status dan perkembangan pengajuan layanan Anda.

            </p>

        </div>

    </section>



    <!-- =====================================
         CONTENT
    ====================================== -->

    <section class="content">

        <div class="container-fluid">


            <!-- =================================
                 SEARCH
            ================================== -->

            <div class="search-box">

                <form
                    action="<?= base_url('dosen/ticket/history') ?>"
                    method="get"
                >

                    <div class="row align-items-end">

                        <div class="col-md-9 mb-3 mb-md-0">

                            <label
                                for="keyword"
                                class="mb-2"
                            >

                                Cari Tiket

                            </label>

                            <input
                                type="text"
                                name="keyword"
                                id="keyword"
                                class="form-control"
                                placeholder="Masukkan nomor tiket atau jenis layanan..."
                                value="<?= esc($keyword ?? '') ?>"
                            >

                        </div>


                        <div class="col-md-3">

                            <button
                                type="submit"
                                class="btn btn-search w-100"
                            >

                                <i class="fas fa-search me-2"></i>

                                Cari Tiket

                            </button>

                        </div>

                    </div>

                </form>

            </div>



            <!-- =================================
                 TABEL TIKET
            ================================== -->

            <div class="card tracking-card">


                <!-- CARD HEADER -->

                <div class="card-header">

                    <h3>

                        <i class="fas fa-list-check me-2"></i>

                        Riwayat Pengajuan Layanan

                    </h3>

                </div>


                <!-- CARD BODY -->

                <div class="card-body p-0">


                    <?php if (!empty($tickets)): ?>


                        <div class="table-responsive">


                            <table
                                class="table table-bordered table-hover mb-0 ticket-table"
                            >


                                <thead>

                                    <tr>

                                        <th width="5%">

                                            No

                                        </th>

                                        <th>

                                            Nomor Tiket

                                        </th>

                                        <th>

                                            Unit Tujuan

                                        </th>

                                        <th>

                                            Jenis Layanan

                                        </th>

                                        <th>

                                            Tanggal Pengajuan

                                        </th>

                                        <th>

                                            Status

                                        </th>

                                        <th width="10%">

                                            Aksi

                                        </th>

                                    </tr>

                                </thead>


                                <tbody>


                                    <?php $no = 1; ?>


                                    <?php foreach ($tickets as $ticket): ?>


                                        <?php

                                        /*
                                        =====================================
                                        MENENTUKAN WARNA STATUS
                                        =====================================
                                        */

                                        $status =
                                            $ticket['status']
                                            ?? 'Submitted';


                                        $statusLower =
                                            strtolower(
                                                $status
                                            );


                                        $statusClass =
                                            'primary';


                                        if (
                                            in_array(
                                                $statusLower,
                                                [
                                                    'draft'
                                                ]
                                            )
                                        ) {

                                            $statusClass =
                                                'secondary';

                                        }


                                        elseif (
                                            in_array(
                                                $statusLower,
                                                [
                                                    'submitted',
                                                    'diajukan'
                                                ]
                                            )
                                        ) {

                                            $statusClass =
                                                'primary';

                                        }


                                        elseif (
                                            in_array(
                                                $statusLower,
                                                [
                                                    'verification',
                                                    'verifikasi',
                                                    'menunggu verifikasi'
                                                ]
                                            )
                                        ) {

                                            $statusClass =
                                                'warning';

                                        }


                                        elseif (
                                            in_array(
                                                $statusLower,
                                                [
                                                    'in progress',
                                                    'diproses',
                                                    'sedang diproses'
                                                ]
                                            )
                                        ) {

                                            $statusClass =
                                                'info';

                                        }


                                        elseif (
                                            in_array(
                                                $statusLower,
                                                [
                                                    'revision',
                                                    'revisi',
                                                    'perlu revisi'
                                                ]
                                            )
                                        ) {

                                            $statusClass =
                                                'danger';

                                        }


                                        elseif (
                                            in_array(
                                                $statusLower,
                                                [
                                                    'completed',
                                                    'selesai'
                                                ]
                                            )
                                        ) {

                                            $statusClass =
                                                'success';

                                        }


                                        ?>


                                        <tr>


                                            <!-- NO -->

                                            <td>

                                                <?= $no++ ?>

                                            </td>



                                            <!-- NOMOR TIKET -->

                                            <td>

                                                <span class="ticket-number">

                                                    <?= esc(
                                                        $ticket['nomor']
                                                        ?? '-'
                                                    ) ?>

                                                </span>

                                            </td>



                                            <!-- UNIT TUJUAN -->

                                            <td>

                                                <?= esc(
                                                    $ticket['unit']
                                                    ??
                                                    $ticket['unit_tujuan']
                                                    ??
                                                    '-'
                                                ) ?>

                                            </td>



                                            <!-- JENIS LAYANAN -->

                                            <td>

                                                <?= esc(
                                                    $ticket['layanan']
                                                    ??
                                                    $ticket['jenis_layanan']
                                                    ??
                                                    '-'
                                                ) ?>

                                            </td>



                                            <!-- TANGGAL -->

                                            <td>

                                                <?= esc(
                                                    $ticket['tanggal']
                                                    ??
                                                    $ticket['created_at']
                                                    ??
                                                    '-'
                                                ) ?>

                                            </td>



                                            <!-- STATUS -->

                                            <td>

                                                <span
                                                    class="badge bg-<?= $statusClass ?> status-badge"
                                                >

                                                    <?= esc(
                                                        $status
                                                    ) ?>

                                                </span>

                                            </td>



                                            <!-- AKSI -->

                                            <td>

                                                <a
                                                    href="<?= base_url(
                                                        'dosen/ticket/detail/' .
                                                        ($ticket['id'] ?? 0)
                                                    ) ?>"
                                                    class="btn btn-detail btn-sm"
                                                >

                                                    <i class="fas fa-eye"></i>

                                                    Detail

                                                </a>

                                            </td>


                                        </tr>


                                    <?php endforeach; ?>


                                </tbody>


                            </table>


                        </div>


                    <?php else: ?>


                        <!-- =================================
                             EMPTY STATE
                        ================================== -->

                        <div class="empty-state">


                            <i class="fas fa-ticket-alt"></i>


                            <h4>

                                Belum Ada Pengajuan

                            </h4>


                            <p>

                                Anda belum memiliki riwayat pengajuan layanan.

                            </p>


                            <a
                                href="<?= base_url('dosen/ticket/create') ?>"
                                class="btn btn-detail"
                            >

                                <i class="fas fa-plus-circle me-1"></i>

                                Ajukan Layanan

                            </a>


                        </div>


                    <?php endif; ?>


                </div>


            </div>



            <!-- =================================
                 INFORMASI
            ================================== -->

            <div class="card info-card mt-4">


                <div class="card-header">

                    <i class="fas fa-info-circle me-2"></i>

                    Informasi Tracking Tiket

                </div>


                <div class="card-body">


                    <p>

                        <strong>

                            <i class="fas fa-ticket-alt text-primary"></i>

                            Nomor Tiket

                        </strong>

                        digunakan untuk mengidentifikasi setiap pengajuan layanan.

                    </p>


                    <p>

                        <strong>

                            <i class="fas fa-clock text-warning"></i>

                            Sedang Diproses

                        </strong>

                        berarti pengajuan sedang ditangani oleh unit terkait.

                    </p>


                    <p>

                        <strong>

                            <i class="fas fa-exclamation-circle text-danger"></i>

                            Perlu Revisi

                        </strong>

                        berarti terdapat catatan dari petugas yang perlu ditindaklanjuti.

                    </p>


                    <p class="mb-0">

                        <strong>

                            <i class="fas fa-check-circle text-success"></i>

                            Selesai

                        </strong>

                        berarti pengajuan layanan telah selesai diproses.

                    </p>


                </div>


            </div>


        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>