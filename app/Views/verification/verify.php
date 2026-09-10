<?= $this->extend('layouts/template') ?>
<?= $this->section('content') ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>
                    <i class="fas fa-user-check text-primary"></i>
                    Verifikasi Tiket
                </h1>

                <p class="text-muted">
                    Lakukan pemeriksaan data permohonan sebelum tiket diproses ke tahap selanjutnya.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="content">

    <div class="container-fluid">

        <!-- =====================================================
             INFORMASI SINGKAT TIKET
        ====================================================== -->

        <div class="row">

            <!-- STATUS -->
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-info">

                    <div class="inner">

                        <?php
                        $status = strtolower(trim($ticket['status'] ?? ''));

                        $statusText = [
                            'draft'      => 'Draft',
                            'submitted'  => 'Submitted',
                            'verified'   => 'Verified',
                            'revision'   => 'Revision',
                            'assigned'   => 'Assigned',
                            'processing' => 'Processing',
                            'completed'  => 'Completed',
                            'rejected'   => 'Rejected',
                            'cancelled'  => 'Cancelled'
                        ];

                        $displayStatus = $statusText[$status]
                            ?? ucfirst($status);
                        ?>

                        <h3>
                            <?= esc($displayStatus) ?>
                        </h3>

                        <p>Status Tiket</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-ticket-alt"></i>
                    </div>

                </div>
            </div>


            <!-- PRIORITAS -->
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-success">

                    <div class="inner">

                        <h3>
                            <?= esc($ticket['priority'] ?? '-') ?>
                        </h3>

                        <p>Prioritas</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-star"></i>
                    </div>

                </div>
            </div>


            <!-- LAYANAN -->
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-warning">

                    <div class="inner">

                        <h3 style="font-size:20px;">
                            <?= esc($ticket['service_name'] ?? '-') ?>
                        </h3>

                        <p>Layanan</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-concierge-bell"></i>
                    </div>

                </div>
            </div>


            <!-- UNIT TUJUAN -->
            <div class="col-lg-3 col-md-6">
                <div class="small-box bg-primary">

                    <div class="inner">

                        <h3 style="font-size:20px;">
                            <?= !empty($ticket['assigned_to'])
                                ? esc($ticket['assigned_to'])
                                : '-' ?>
                        </h3>

                        <p>Unit Tujuan</p>

                    </div>

                    <div class="icon">
                        <i class="fas fa-building"></i>
                    </div>

                </div>
            </div>

        </div>


        <!-- =====================================================
             INFORMASI PERMOHONAN
        ====================================================== -->

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">
                    <i class="fas fa-id-card"></i>
                    Informasi Permohonan
                </h3>

            </div>

            <div class="card-body">

                <div class="row">

                    <!-- DATA PEMOHON -->
                    <div class="col-md-6">

                        <table class="table table-borderless">

                            <tr>
                                <th width="180">
                                    Nomor Tiket
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['ticket_number'] ?? '-'
                                    ) ?>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Nama Pemohon
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['applicant_name'] ?? '-'
                                    ) ?>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    NIM
                                </th>

                                <td>
                                    <?= !empty($ticket['nim'])
                                        ? esc($ticket['nim'])
                                        : '-' ?>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    NIK
                                </th>

                                <td>
                                    <?= !empty($ticket['nik'])
                                        ? esc($ticket['nik'])
                                        : '-' ?>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Email
                                </th>

                                <td>
                                    <?= !empty($ticket['email'])
                                        ? esc($ticket['email'])
                                        : '-' ?>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    No. HP
                                </th>

                                <td>
                                    <?= !empty($ticket['phone'])
                                        ? esc($ticket['phone'])
                                        : '-' ?>
                                </td>
                            </tr>

                        </table>

                    </div>


                    <!-- DATA TIKET -->
                    <div class="col-md-6">

                        <table class="table table-borderless">

                            <tr>
                                <th width="180">
                                    Layanan
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['service_name'] ?? '-'
                                    ) ?>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Prioritas
                                </th>

                                <td>
                                    <?= esc(
                                        $ticket['priority'] ?? '-'
                                    ) ?>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Unit Tujuan
                                </th>

                                <td>
                                    <?= !empty($ticket['assigned_to'])
                                        ? esc($ticket['assigned_to'])
                                        : '-' ?>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Status
                                </th>

                                <td>
                                    <span class="badge badge-info">
                                        <?= esc($displayStatus) ?>
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Tanggal Pengajuan
                                </th>

                                <td>
                                    <?= !empty($ticket['submitted_at'])
                                        ? esc($ticket['submitted_at'])
                                        : '-' ?>
                                </td>
                            </tr>

                            <tr>
                                <th>
                                    Dibuat
                                </th>

                                <td>
                                    <?= !empty($ticket['created_at'])
                                        ? esc($ticket['created_at'])
                                        : '-' ?>
                                </td>
                            </tr>

                        </table>

                    </div>

                </div>

                <hr>

                <!-- JUDUL -->
                <?php if (!empty($ticket['title'])): ?>

                    <h5>
                        Judul Permohonan
                    </h5>

                    <div class="alert alert-light">
                        <?= nl2br(
                            esc($ticket['title'])
                        ) ?>
                    </div>

                <?php endif; ?>


                <!-- DESKRIPSI -->
                <?php if (!empty($ticket['description'])): ?>

                    <h5>
                        Deskripsi Permohonan
                    </h5>

                    <div class="alert alert-light">
                        <?= nl2br(
                            esc($ticket['description'])
                        ) ?>
                    </div>

                <?php endif; ?>


                <?php if (
                    empty($ticket['title']) &&
                    empty($ticket['description'])
                ): ?>

                    <div class="alert alert-secondary">
                        Tidak ada detail tambahan pada permohonan.
                    </div>

                <?php endif; ?>

            </div>

        </div>


        <!-- =====================================================
             RIWAYAT PROSES
        ====================================================== -->

        <div class="card card-secondary">

            <div class="card-header">

                <h3 class="card-title">
                    <i class="fas fa-history"></i>
                    Riwayat Proses Verifikasi
                </h3>

            </div>

            <div class="card-body">

                <?php if (!empty($logs)): ?>

                    <ul class="timeline">

                        <?php foreach ($logs as $log): ?>

                            <li>

                                <i class="fas fa-check bg-primary"></i>

                                <div class="timeline-item">

                                    <span class="time">

                                        <i class="far fa-clock"></i>

                                        <?= !empty($log['created_at'])
                                            ? date(
                                                'd M Y H:i',
                                                strtotime(
                                                    $log['created_at']
                                                )
                                            )
                                            : '-' ?>

                                    </span>

                                    <h3 class="timeline-header">

                                        <?= esc(
                                            $log['user_name']
                                            ?? 'Petugas ULT'
                                        ) ?>

                                    </h3>

                                    <div class="timeline-body">

                                        <?= esc(
                                            $log['activity']
                                            ?? '-'
                                        ) ?>

                                    </div>

                                </div>

                            </li>

                        <?php endforeach; ?>

                    </ul>

                <?php else: ?>

                    <div class="alert alert-info">

                        <i class="fas fa-info-circle"></i>

                        Belum ada riwayat proses untuk tiket ini.

                    </div>

                <?php endif; ?>

            </div>

        </div>


        <!-- =====================================================
             FORM VERIFIKASI
        ====================================================== -->

        <form
            id="verificationForm"
            action="<?= base_url(
                'verification/process/' . $ticket['id']
            ) ?>"
            method="post"
        >

            <?= csrf_field() ?>


            <div class="card card-success">

                <div class="card-header">

                    <h3 class="card-title">

                        <i class="fas fa-user-check"></i>

                        Form Verifikasi Tiket

                    </h3>

                </div>


                <div class="card-body">

                    <!-- =================================================
                         HASIL VERIFIKASI
                    ================================================== -->

                    <div class="form-group">

                        <label for="verification_action">
                            Hasil Verifikasi
                        </label>

                        <select
                            id="verification_action"
                            name="action"
                            class="form-control"
                            required
                        >

                            <option value="">
                                -- Pilih Hasil Verifikasi --
                            </option>

                            <option value="verify">
                                Verify / Verifikasi
                            </option>

                            <option value="revision">
                                Need Revision / Perlu Revisi
                            </option>

                            <option value="reject">
                                Reject / Tolak
                            </option>

                        </select>

                    </div>


                    <!-- =================================================
                         FIELD VERIFY
                    ================================================== -->

                    <div
                        id="verifyFields"
                        style="display:none;"
                    >

                        <!-- PRIORITAS -->

                        <div class="form-group">

                            <label>
                                Prioritas
                            </label>

                            <select
                                name="priority"
                                class="form-control"
                            >

                                <option value="">
                                    -- Pilih Prioritas --
                                </option>

                                <option
                                    value="Low"
                                    <?= strtolower(
                                        $ticket['priority'] ?? ''
                                    ) === 'low'
                                        ? 'selected'
                                        : '' ?>
                                >
                                    Low
                                </option>

                                <option
                                    value="Medium"
                                    <?= strtolower(
                                        $ticket['priority'] ?? ''
                                    ) === 'medium'
                                        ? 'selected'
                                        : '' ?>
                                >
                                    Medium
                                </option>

                                <option
                                    value="High"
                                    <?= strtolower(
                                        $ticket['priority'] ?? ''
                                    ) === 'high'
                                        ? 'selected'
                                        : '' ?>
                                >
                                    High
                                </option>

                                <option
                                    value="Urgent"
                                    <?= strtolower(
                                        $ticket['priority'] ?? ''
                                    ) === 'urgent'
                                        ? 'selected'
                                        : '' ?>
                                >
                                    Urgent
                                </option>

                            </select>

                        </div>


                        <!-- =================================================
                             UNIT TUJUAN OTOMATIS
                        ================================================== -->

                        <div class="form-group">

                            <label>
                                Unit Tujuan
                            </label>

                            <input
                                type="text"
                                name="assigned_to"
                                class="form-control"
                                value="<?= esc(
                                    $ticket['assigned_to'] ?? ''
                                ) ?>"
                                readonly
                            >

                            <small class="form-text text-muted">
                                Unit tujuan otomatis mengikuti unit yang dipilih saat pengajuan tiket.
                            </small>

                        </div>


                        <!-- CATATAN VERIFIKASI -->

                        <div class="form-group">

                            <label>
                                Catatan Verifikasi
                            </label>

                            <textarea
                                name="verification_note"
                                class="form-control"
                                rows="5"
                                placeholder="Tuliskan hasil pemeriksaan dokumen..."
                            ></textarea>

                        </div>

                    </div>


                    <!-- =================================================
                         FIELD REVISION
                    ================================================== -->

                    <div
                        id="revisionFields"
                        style="display:none;"
                    >

                        <div class="form-group">

                            <label>
                                Alasan Revisi
                            </label>

                            <textarea
                                name="comment"
                                class="form-control"
                                rows="5"
                                placeholder="Tuliskan alasan mengapa tiket perlu diperbaiki..."
                            ></textarea>

                        </div>

                    </div>


                    <!-- =================================================
                         FIELD REJECT
                    ================================================== -->

                    <div
                        id="rejectFields"
                        style="display:none;"
                    >

                        <div class="form-group">

                            <label>
                                Alasan Penolakan
                            </label>

                            <textarea
                                name="reject_reason"
                                class="form-control"
                                rows="5"
                                placeholder="Tuliskan alasan penolakan tiket..."
                            ></textarea>

                        </div>

                    </div>


                    <!-- =================================================
                         INFORMASI AKSI
                    ================================================== -->

                    <div
                        id="actionInfo"
                        class="alert alert-secondary"
                    >

                        <i class="fas fa-info-circle"></i>

                        Silakan pilih hasil verifikasi terlebih dahulu.

                    </div>

                </div>


                <!-- =================================================
                     FOOTER
                ================================================== -->

                <div class="card-footer d-flex justify-content-between">

                    <a
                        href="<?= base_url('verification') ?>"
                        class="btn btn-secondary"
                    >

                        <i class="fas fa-arrow-left"></i>

                        Kembali

                    </a>


                    <div>

                        <!-- VERIFY -->

                        <button
                            type="submit"
                            id="btnVerify"
                            class="btn btn-success"
                            style="display:none;"
                        >

                            <i class="fas fa-check-circle"></i>

                            Verify

                        </button>


                        <!-- REVISION -->

                        <button
                            type="submit"
                            id="btnRevision"
                            class="btn btn-warning"
                            style="display:none;"
                        >

                            <i class="fas fa-edit"></i>

                            Need Revision

                        </button>


                        <!-- REJECT -->

                        <button
                            type="submit"
                            id="btnReject"
                            class="btn btn-danger"
                            style="display:none;"
                        >

                            <i class="fas fa-times"></i>

                            Reject

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</section>


<!-- ============================================================
     SCRIPT HASIL VERIFIKASI
============================================================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const actionSelect = document.getElementById(
        'verification_action'
    );

    const form = document.getElementById(
        'verificationForm'
    );

    const verifyFields = document.getElementById(
        'verifyFields'
    );

    const revisionFields = document.getElementById(
        'revisionFields'
    );

    const rejectFields = document.getElementById(
        'rejectFields'
    );

    const btnVerify = document.getElementById(
        'btnVerify'
    );

    const btnRevision = document.getElementById(
        'btnRevision'
    );

    const btnReject = document.getElementById(
        'btnReject'
    );

    const actionInfo = document.getElementById(
        'actionInfo'
    );


    function resetAll() {

        verifyFields.style.display = 'none';

        revisionFields.style.display = 'none';

        rejectFields.style.display = 'none';

        btnVerify.style.display = 'none';

        btnRevision.style.display = 'none';

        btnReject.style.display = 'none';

        form.action =
            "<?= base_url(
                'verification/process/' . $ticket['id']
            ) ?>";

        actionInfo.className =
            'alert alert-secondary';

        actionInfo.innerHTML =
            '<i class="fas fa-info-circle"></i> ' +
            'Silakan pilih hasil verifikasi terlebih dahulu.';
    }


    actionSelect.addEventListener(
        'change',
        function () {

            const action = this.value;

            resetAll();


            /* ==================================================
               VERIFY
            ================================================== */

            if (action === 'verify') {

                verifyFields.style.display = 'block';

                btnVerify.style.display = 'inline-block';

                form.action =
                    "<?= base_url(
                        'verification/process/' . $ticket['id']
                    ) ?>";

                actionInfo.className =
                    'alert alert-success';

                actionInfo.innerHTML =
                    '<i class="fas fa-check-circle"></i> ' +
                    'Tiket akan diverifikasi dan dilanjutkan ke tahap disposisi.';
            }


            /* ==================================================
               REVISION
            ================================================== */

            else if (action === 'revision') {

                revisionFields.style.display = 'block';

                btnRevision.style.display = 'inline-block';

                form.action =
                    "<?= base_url(
                        'verification/revision/' . $ticket['id']
                    ) ?>";

                actionInfo.className =
                    'alert alert-warning';

                actionInfo.innerHTML =
                    '<i class="fas fa-edit"></i> ' +
                    'Tiket akan dikembalikan kepada pemohon untuk diperbaiki.';
            }


            /* ==================================================
               REJECT
            ================================================== */

            else if (action === 'reject') {

                rejectFields.style.display = 'block';

                btnReject.style.display = 'inline-block';

                form.action =
                    "<?= base_url(
                        'verification/reject/' . $ticket['id']
                    ) ?>";

                actionInfo.className =
                    'alert alert-danger';

                actionInfo.innerHTML =
                    '<i class="fas fa-times-circle"></i> ' +
                    'Tiket akan ditolak dan tidak dilanjutkan ke proses berikutnya.';
            }

        }
    );

});

</script>


<?= $this->endSection() ?>