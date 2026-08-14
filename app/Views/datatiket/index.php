<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Data Tiket Permohonan</h1>
                <small class="text-muted">
                    Kelola dan pantau seluruh tiket permohonan layanan.
                </small>
            </div>
        </div>
    </div>
</section>


<section class="content">
<div class="container-fluid">

    <div class="card card-primary card-outline">

        <!-- ============================= -->
        <!-- FILTER -->
        <!-- ============================= -->
        <div class="card-header">

            <form method="get" action="<?= base_url('datatiket') ?>">

                <div class="row">

                    <!-- SEARCH -->
                    <div class="col-md-5">
                        <input
                            type="text"
                            name="keyword"
                            class="form-control"
                            placeholder="Cari No Tiket, Nama, NIM, Layanan..."
                            value="<?= esc($keyword ?? '') ?>"
                        >
                    </div>


                    <!-- STATUS -->
                    <div class="col-md-2">
                        <select name="status" class="form-control">

                            <option value="">
                                Semua Status
                            </option>

                            <option
                                value="Submitted"
                                <?= ($status ?? '') == 'Submitted' ? 'selected' : '' ?>
                            >
                                Submitted
                            </option>

                            <option
                                value="Verified"
                                <?= ($status ?? '') == 'Verified' ? 'selected' : '' ?>
                            >
                                Verified
                            </option>

                            <option
                                value="Need Revision"
                                <?= ($status ?? '') == 'Need Revision' ? 'selected' : '' ?>
                            >
                                Need Revision
                            </option>

                            <option
                                value="Rejected"
                                <?= ($status ?? '') == 'Rejected' ? 'selected' : '' ?>
                            >
                                Rejected
                            </option>

                            <option
                                value="Assigned"
                                <?= ($status ?? '') == 'Assigned' ? 'selected' : '' ?>
                            >
                                Assigned
                            </option>

                            <option
                                value="Completed"
                                <?= ($status ?? '') == 'Completed' ? 'selected' : '' ?>
                            >
                                Completed
                            </option>

                        </select>
                    </div>


                    <!-- JENIS -->
                    <div class="col-md-2">

                        <select
                            name="submission_type"
                            class="form-control"
                        >

                            <option value="">
                                Semua Jenis
                            </option>

                            <option
                                value="Online"
                                <?= ($submission_type ?? '') == 'Online' ? 'selected' : '' ?>
                            >
                                Online
                            </option>

                            <option
                                value="Walk In"
                                <?= ($submission_type ?? '') == 'Walk In' ? 'selected' : '' ?>
                            >
                                Walk In
                            </option>

                        </select>

                    </div>


                    <!-- BUTTON -->
                    <div class="col-md-3">

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            <i class="fas fa-search"></i>
                            Filter
                        </button>

                        <a
                            href="<?= base_url('datatiket') ?>"
                            class="btn btn-secondary"
                        >
                            Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>


        <!-- ============================= -->
        <!-- TABLE -->
        <!-- ============================= -->

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered table-hover mb-0">

                    <thead class="bg-primary text-white">

                        <tr>

                            <th width="60">
                                No
                            </th>

                            <th>
                                No Tiket
                            </th>

                            <th>
                                Nama
                            </th>

                            <th>
                                NIM
                            </th>

                            <th>
                                Layanan
                            </th>

                            <th>
                                Jenis
                            </th>

                            <th>
                                Status
                            </th>

                            <th width="170" class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                    <?php if (!empty($tickets)): ?>

                        <?php
                        // Nomor mengikuti halaman
                        $no = ($pager->getCurrentPage() - 1)
                            * $pager->getPerPage() + 1;
                        ?>


                        <?php foreach ($tickets as $ticket): ?>

                            <?php

                            $badge = 'secondary';

                            switch ($ticket['status']) {

                                case 'Submitted':
                                    $badge = 'warning';
                                    break;

                                case 'Verified':
                                    $badge = 'success';
                                    break;

                                case 'Need Revision':
                                    $badge = 'info';
                                    break;

                                case 'Rejected':
                                    $badge = 'danger';
                                    break;

                                case 'Assigned':
                                    $badge = 'primary';
                                    break;

                                case 'Completed':
                                    $badge = 'success';
                                    break;

                                case 'In Progress':
                                    $badge = 'warning';
                                    break;
                            }

                            ?>


                            <tr>

                                <!-- NOMOR -->
                                <td>
                                    <?= $no++ ?>
                                </td>


                                <!-- NO TIKET -->
                                <td>
                                    <strong>
                                        <?= esc(
                                            $ticket['ticket_number'] ?? '-'
                                        ) ?>
                                    </strong>
                                </td>


                                <!-- NAMA -->
                                <td>
                                    <?= esc(
                                        $ticket['applicant_name'] ?? '-'
                                    ) ?>
                                </td>


                                <!-- NIM -->
                                <td>
                                    <?= esc(
                                        $ticket['nim'] ?? '-'
                                    ) ?>
                                </td>


                                <!-- LAYANAN -->
                                <td>
                                    <?= esc(
                                        $ticket['service_name'] ?? '-'
                                    ) ?>
                                </td>


                                <!-- JENIS -->
                                <td>
                                    <?= esc(
                                        $ticket['submission_type'] ?? '-'
                                    ) ?>
                                </td>


                                <!-- STATUS -->
                                <td>

                                    <span
                                        class="badge badge-<?= $badge ?>"
                                    >
                                        <?= esc(
                                            $ticket['status'] ?? '-'
                                        ) ?>
                                    </span>

                                </td>


                                <!-- AKSI -->
                                <td class="text-center">

                                    <!-- DETAIL -->
                                    <a
                                        href="<?= base_url(
                                            'verification/detail/' .
                                            $ticket['id']
                                        ) ?>"
                                        class="btn btn-info btn-sm"
                                        title="Detail"
                                    >
                                        <i class="fas fa-eye"></i>
                                    </a>


                                    <!-- VERIFIKASI -->
                                    <a
                                        href="<?= base_url(
                                            'verification/detail/' .
                                            $ticket['id']
                                        ) ?>"
                                        class="btn btn-success btn-sm"
                                        title="Verifikasi"
                                    >
                                        <i class="fas fa-user-check"></i>
                                    </a>


                                    <!-- DISPOSISI -->
                                    <a
                                        href="<?= base_url(
                                            'disposition/detail/' .
                                            $ticket['id']
                                        ) ?>"
                                        class="btn btn-warning btn-sm"
                                        title="Disposisi"
                                    >
                                        <i class="fas fa-share-square"></i>
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>


                    <?php else: ?>

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-4"
                            >

                                <i class="fas fa-inbox fa-2x text-muted mb-2"></i>

                                <div>
                                    Tidak ada data tiket.
                                </div>

                            </td>

                        </tr>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>


            <!-- ============================= -->
            <!-- PAGINATION -->
            <!-- ============================= -->

            <?php if (!empty($tickets)): ?>

                <div class="card-footer">

                    <div class="row align-items-center">

                    

                        <!-- PAGINATION -->
                        <div class="col-md-6">

                            <div class="float-right">

                                <?= $pager->links() ?>

                            </div>

                        </div>

                    </div>

                </div>

            <?php endif; ?>


        </div>

    </div>

</div>
</section>


<?= $this->endSection() ?>