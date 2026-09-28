<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>

<style>
    .verification-page {
        padding-bottom: 30px;
    }

    .page-header {
        background: #293b91;
        color: #fff;
        border-radius: 8px;
        padding: 18px 22px;
        margin-bottom: 20px;
    }

    .page-header h3 {
        margin: 0;
        font-size: 22px;
        font-weight: 600;
    }

    .page-header p {
        margin: 5px 0 0;
        opacity: .85;
        font-size: 14px;
    }

    .verification-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,.08);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .verification-card-header {
        background: #293b91;
        color: #fff;
        padding: 14px 18px;
        font-size: 17px;
        font-weight: 600;
    }

    .verification-card-header i {
        margin-right: 8px;
    }

    .verification-card-body {
        padding: 22px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .info-item {
        background: #f7f8fb;
        border: 1px solid #e4e7ee;
        border-radius: 8px;
        padding: 14px 16px;
    }

    .info-item.full {
        grid-column: 1 / -1;
    }

    .info-label {
        display: block;
        font-size: 13px;
        color: #777;
        margin-bottom: 6px;
        font-weight: 500;
    }

    .info-label i {
        color: #293b91;
        width: 18px;
    }

    .info-value {
        font-size: 15px;
        color: #222;
        font-weight: 600;
        word-break: break-word;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 20px;
        background: #ff9800;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .verification-box {
        background: #f8f9fc;
        border: 1px solid #e1e5ed;
        border-radius: 10px;
        padding: 20px;
    }

    .verification-title {
        font-size: 16px;
        font-weight: 600;
        color: #293b91;
        margin-bottom: 15px;
    }

    .check-item {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #fff;
        border: 1px solid #e1e5ed;
        border-radius: 7px;
        padding: 13px 15px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: .2s;
    }

    .check-item:hover {
        background: #f3f5fb;
        border-color: #293b91;
    }

    .check-item input {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .check-item span {
        font-size: 14px;
        color: #333;
    }

    .check-count {
        float: right;
        background: #293b91;
        color: #fff;
        padding: 4px 10px;
        border-radius: 15px;
        font-size: 12px;
    }

    .progress-wrapper {
        margin-top: 18px;
        margin-bottom: 20px;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        font-size: 13px;
        color: #555;
        margin-bottom: 7px;
    }

    .progress {
        height: 9px;
        border-radius: 10px;
        background: #e9ecef;
    }

    .progress-bar {
        border-radius: 10px;
        transition: width .25s ease;
    }

    .decision-grid {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 20px;
        margin-top: 20px;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        font-size: 14px;
        margin-bottom: 7px;
    }

    .form-control,
    .custom-select {
        border-radius: 7px;
        border: 1px solid #ced4da;
        min-height: 42px;
    }

    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    .decision-info {
        background: #eef3ff;
        border-left: 4px solid #293b91;
        padding: 12px 15px;
        border-radius: 5px;
        font-size: 13px;
        color: #4b5563;
        margin-top: 15px;
    }

    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
        padding-top: 18px;
        border-top: 1px solid #e5e7eb;
    }

    .btn-back {
        background: #6c757d;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 7px;
    }

    .btn-save {
        background: #28a745;
        color: #fff;
        border: none;
        padding: 10px 22px;
        border-radius: 7px;
        font-weight: 600;
    }

    .btn-back:hover,
    .btn-save:hover {
        color: #fff;
        opacity: .9;
    }

    @media (max-width: 768px) {

        .info-grid {
            grid-template-columns: 1fr;
        }

        .info-item.full {
            grid-column: auto;
        }

        .decision-grid {
            grid-template-columns: 1fr;
        }

        .action-buttons {
            flex-direction: column;
        }

        .action-buttons .btn {
            width: 100%;
        }
    }
</style>


<div class="container-fluid verification-page">

    <!-- ===================================================== -->
    <!-- HEADER -->
    <!-- ===================================================== -->

    <div class="page-header">

        <h3>
            <i class="fas fa-clipboard-check"></i>
            Verifikasi Tiket
        </h3>

        <p>
            Periksa kelengkapan data permohonan sebelum tiket
            diteruskan ke proses berikutnya.
        </p>

    </div>


    <!-- ===================================================== -->
    <!-- INFORMASI TIKET -->
    <!-- ===================================================== -->

    <div class="verification-card">

        <div class="verification-card-header">

            <i class="fas fa-ticket-alt"></i>

            Informasi Tiket

        </div>


        <div class="verification-card-body">

            <div class="info-grid">

                <!-- NOMOR TIKET -->
                <div class="info-item">

                    <span class="info-label">
                        <i class="fas fa-ticket-alt"></i>
                        Nomor Tiket
                    </span>

                    <div class="info-value">

                        <?= esc(
                            $ticket['ticket_number']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- STATUS -->
                <div class="info-item">

                    <span class="info-label">
                        <i class="fas fa-info-circle"></i>
                        Status
                    </span>

                    <div class="info-value">

                        <span class="status-badge">

                            <?= esc(
                                strtoupper(
                                    $ticket['status']
                                    ?? 'SUBMITTED'
                                )
                            ) ?>

                        </span>

                    </div>

                </div>


                <!-- NAMA PEMOHON -->
                <div class="info-item">

                    <span class="info-label">
                        <i class="fas fa-user"></i>
                        Nama Pemohon
                    </span>

                    <div class="info-value">

                        <?= esc(
                            $ticket['applicant_name']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- NIM -->
                <div class="info-item">

                    <span class="info-label">
                        <i class="fas fa-id-card"></i>
                        NIM / NIK / NIP
                    </span>

                    <div class="info-value">

                        <?= esc(
                            $ticket['nim']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- EMAIL -->
                <div class="info-item">

                    <span class="info-label">
                        <i class="fas fa-envelope"></i>
                        Email
                    </span>

                    <div class="info-value">

                        <?= esc(
                            $ticket['email']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- TELEPON -->
                <div class="info-item">

                    <span class="info-label">
                        <i class="fas fa-phone"></i>
                        No. Telepon
                    </span>

                    <div class="info-value">

                        <?= esc(
                            $ticket['phone']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- LAYANAN -->
                <div class="info-item">

                    <span class="info-label">
                        <i class="fas fa-concierge-bell"></i>
                        Layanan
                    </span>

                    <div class="info-value">

                        <?= esc(
                            $ticket['service_display_name']
                            ?? $ticket['service_name']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- PRIORITAS -->
                <div class="info-item">

                    <span class="info-label">
                        <i class="fas fa-exclamation-circle"></i>
                        Prioritas
                    </span>

                    <div class="info-value">

                        <?= esc(
                            $ticket['priority']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- JUDUL -->
                <div class="info-item full">

                    <span class="info-label">
                        <i class="fas fa-heading"></i>
                        Judul Tiket
                    </span>

                    <div class="info-value">

                        <?= esc(
                            $ticket['ticket_title']
                            ?? '-'
                        ) ?>

                    </div>

                </div>


                <!-- DESKRIPSI -->
                <div class="info-item full">

                    <span class="info-label">
                        <i class="fas fa-align-left"></i>
                        Deskripsi Permohonan
                    </span>

                    <div
                        class="info-value"
                        style="font-weight: 400; line-height: 1.6;">

                        <?= nl2br(
                            esc(
                                $ticket['ticket_description']
                                ?? '-'
                            )
                        ) ?>

                    </div>

                </div>


                <!-- TANGGAL PENGAJUAN -->
                <div class="info-item">

                    <span class="info-label">
                        <i class="fas fa-calendar-alt"></i>
                        Tanggal Pengajuan
                    </span>

                    <div class="info-value">

                        <?= esc(
                            $ticket['submitted_at']
                            ?? $ticket['created_at']
                            ?? '-'
                        ) ?>

                    </div>

                </div>

            </div>

        </div>

    </div>



    <!-- ===================================================== -->
    <!-- FORM VERIFIKASI -->
    <!-- ===================================================== -->

    <div class="verification-card">

        <div class="verification-card-header">

            <i class="fas fa-check-double"></i>

            Pemeriksaan Verifikasi

        </div>


        <div class="verification-card-body">

            <div class="verification-box">

                <div class="verification-title">

                    <i class="fas fa-list-check"></i>

                    Checklist Kelengkapan

                    <span
                        class="check-count"
                        id="checkCount">

                        0 / 3 lengkap

                    </span>

                </div>


                <!-- CHECKLIST 1 -->
                <label class="check-item">

                    <input
                        type="checkbox"
                        class="verification-check"
                        value="1">

                    <span>

                        <i class="fas fa-user-check"></i>

                        Data pemohon sudah sesuai

                    </span>

                </label>


                <!-- CHECKLIST 2 -->
                <label class="check-item">

                    <input
                        type="checkbox"
                        class="verification-check"
                        value="1">

                    <span>

                        <i class="fas fa-file-circle-check"></i>

                        Data/lampiran permohonan sudah lengkap

                    </span>

                </label>


                <!-- CHECKLIST 3 -->
                <label class="check-item">

                    <input
                        type="checkbox"
                        class="verification-check"
                        value="1">

                    <span>

                        <i class="fas fa-clipboard-check"></i>

                        Persyaratan layanan sudah sesuai

                    </span>

                </label>


                <!-- PROGRESS -->
                <div class="progress-wrapper">

                    <div class="progress-label">

                        <span>
                            Kelengkapan pemeriksaan
                        </span>

                        <strong id="progressText">
                            0%
                        </strong>

                    </div>


                    <div class="progress">

                        <div
                            id="progressBar"
                            class="progress-bar bg-success"
                            role="progressbar"
                            style="width: 0%;">

                        </div>

                    </div>

                </div>


                <!-- ================================================= -->
                <!-- KEPUTUSAN DAN CATATAN -->
                <!-- ================================================= -->

                <div class="decision-grid">

                    <!-- KEPUTUSAN -->
                    <div>

                        <label
                            for="verificationStatus"
                            class="form-label">

                            Status Verifikasi
                            <span class="text-danger">*</span>

                        </label>


                        <select
                            name="verification_status"
                            id="verificationStatus"
                            class="custom-select">

                            <option value="">
                                Pilih Keputusan...
                            </option>

                            <option value="verified">
                                Disetujui / Terverifikasi
                            </option>

                            <option value="need_revision">
                                Perlu Perbaikan / Need Revision
                            </option>

                            <option value="rejected">
                                Ditolak
                            </option>

                        </select>

                    </div>


                    <!-- CATATAN -->
                    <div>

                        <label
                            for="verificationNote"
                            class="form-label">

                            Catatan Petugas

                        </label>


                        <textarea
                            name="verification_note"
                            id="verificationNote"
                            class="form-control"
                            placeholder="Tambahkan catatan atau alasan verifikasi..."></textarea>

                    </div>

                </div>


                <!-- INFO -->
                <div class="decision-info">

                    <i class="fas fa-info-circle"></i>

                    <strong>Informasi:</strong>

                    Jika tiket disetujui, tiket akan dilanjutkan
                    ke proses <strong>Disposisi Tiket</strong>
                    untuk menentukan unit tujuan.

                </div>


                <!-- ================================================= -->
                <!-- ACTION -->
                <!-- ================================================= -->

                <div class="action-buttons">

                    <a
                        href="<?= site_url('verification') ?>"
                        class="btn btn-back">

                        <i class="fas fa-arrow-left"></i>

                        Kembali

                    </a>


                    <button
                        type="button"
                        id="saveVerification"
                        class="btn btn-save">

                        <i class="fas fa-save"></i>

                        Simpan Verifikasi

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>



<!-- ========================================================= -->
<!-- JAVASCRIPT -->
<!-- ========================================================= -->

<script>

document.addEventListener('DOMContentLoaded', function () {

    const checks =
        document.querySelectorAll('.verification-check');

    const count =
        document.getElementById('checkCount');

    const progressBar =
        document.getElementById('progressBar');

    const progressText =
        document.getElementById('progressText');

    const status =
        document.getElementById('verificationStatus');

    const note =
        document.getElementById('verificationNote');

    const saveButton =
        document.getElementById('saveVerification');


    function updateProgress() {

        let checked = 0;

        checks.forEach(function (checkbox) {

            if (checkbox.checked) {

                checked++;

            }

        });


        const total = checks.length;

        const percentage =
            total > 0
                ? Math.round((checked / total) * 100)
                : 0;


        count.textContent =
            checked + ' / ' + total + ' lengkap';


        progressText.textContent =
            percentage + '%';


        progressBar.style.width =
            percentage + '%';

    }


    checks.forEach(function (checkbox) {

        checkbox.addEventListener(
            'change',
            updateProgress
        );

    });


    saveButton.addEventListener('click', function () {

        if (!status.value) {

            alert(
                'Silakan pilih status verifikasi terlebih dahulu.'
            );

            status.focus();

            return;

        }


        if (
            status.value === 'verified'
            &&
            document.querySelectorAll(
                '.verification-check:checked'
            ).length !== checks.length
        ) {

            alert(
                'Jika tiket disetujui, semua checklist harus lengkap terlebih dahulu.'
            );

            return;

        }


        let message = '';


        if (status.value === 'verified') {

            message =
                'Tiket akan diverifikasi dan dilanjutkan ke Disposisi Tiket. Lanjutkan?';

        } else if (
            status.value === 'need_revision'
        ) {

            message =
                'Tiket akan dikembalikan untuk perbaikan. Lanjutkan?';

        } else if (
            status.value === 'rejected'
        ) {

            message =
                'Tiket akan ditolak. Lanjutkan?';

        }


        if (!confirm(message)) {

            return;

        }


        /*
         * Untuk sementara mengikuti controller
         * yang sekarang:
         *
         * verified -> verification/verify/{id}
         *
         */

        if (status.value === 'verified') {

            const form =
                document.createElement('form');

            form.method = 'POST';

            form.action =
                "<?= site_url('verification/verify/' . $ticket['id']) ?>";


            const csrf =
                document.createElement('input');

            csrf.type = 'hidden';

            csrf.name =
                "<?= csrf_token() ?>";

            csrf.value =
                "<?= csrf_hash() ?>";


            form.appendChild(csrf);

            document.body.appendChild(form);

            form.submit();

            return;

        }


        /*
         * Revision
         */

        if (status.value === 'need_revision') {

            const form =
                document.createElement('form');

            form.method = 'POST';

            form.action =
                "<?= site_url('verification/revision/' . $ticket['id']) ?>";


            const csrf =
                document.createElement('input');

            csrf.type = 'hidden';

            csrf.name =
                "<?= csrf_token() ?>";

            csrf.value =
                "<?= csrf_hash() ?>";


            const noteInput =
                document.createElement('input');

            noteInput.type = 'hidden';

            noteInput.name =
                'verification_note';

            noteInput.value =
                note.value;


            form.appendChild(csrf);

            form.appendChild(noteInput);

            document.body.appendChild(form);

            form.submit();

            return;

        }


        /*
         * Reject
         */

        if (status.value === 'rejected') {

            const form =
                document.createElement('form');

            form.method = 'POST';

            form.action =
                "<?= site_url('verification/reject/' . $ticket['id']) ?>";


            const csrf =
                document.createElement('input');

            csrf.type = 'hidden';

            csrf.name =
                "<?= csrf_token() ?>";

            csrf.value =
                "<?= csrf_hash() ?>";


            const noteInput =
                document.createElement('input');

            noteInput.type = 'hidden';

            noteInput.name =
                'verification_note';

            noteInput.value =
                note.value;


            form.appendChild(csrf);

            form.appendChild(noteInput);

            document.body.appendChild(form);

            form.submit();

        }

    });

});

</script>


<?= $this->endSection() ?>