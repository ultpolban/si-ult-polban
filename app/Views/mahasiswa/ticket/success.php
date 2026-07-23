<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1 class="page-title">

                <i class="fas fa-check-circle"></i>

                <?= esc($title ?? 'Pengajuan') ?>

            </h1>

        </div>

    </section>


    <section class="content">

        <div class="container-fluid">

            <?php
                $isDraft = isset($ticket['status'])
                    && $ticket['status'] === 'Draft';
            ?>


            <?php if ($isDraft): ?>

                <!-- ================================= -->
                <!-- DRAFT BERHASIL DISIMPAN -->
                <!-- ================================= -->

                <div class="success-card draft-card">

                    <div class="success-icon draft-icon">

                        <i class="fas fa-save"></i>

                    </div>


                    <h2>

                        Draft Berhasil Disimpan

                    </h2>


                    <p class="text-muted">

                        Pengajuan Anda telah disimpan sebagai draft.
                        Anda dapat melanjutkan pengisian dan mengirimkannya nanti.

                    </p>


                    <div class="ticket-number-box draft-number">

                        <small>

                            Nomor Draft

                        </small>

                        <strong>

                            <?= esc($ticket['nomor'] ?? '-') ?>

                        </strong>

                    </div>


                    <div class="ticket-summary">

                        <div class="summary-item">

                            <span>

                                <i class="fas fa-file-alt"></i>

                                Jenis Layanan

                            </span>

                            <strong>

                                <?= esc($ticket['layanan'] ?? '-') ?>

                            </strong>

                        </div>


                        <div class="summary-item">

                            <span>

                                <i class="fas fa-info-circle"></i>

                                Status

                            </span>

                            <span class="badge bg-secondary">

                                Draft

                            </span>

                        </div>

                    </div>


                    <div class="action-buttons">

                        <a
                            href="<?= base_url('dashboard-mahasiswa') ?>"
                            class="btn btn-secondary"
                        >

                            <i class="fas fa-home"></i>

                            Dashboard

                        </a>


                        <a
                            href="<?= base_url('mahasiswa/ticket/history') ?>"
                            class="btn btn-primary"
                        >

                            <i class="fas fa-history"></i>

                            Lihat Tracking Tiket

                        </a>

                    </div>

                </div>


            <?php else: ?>


                <!-- ================================= -->
                <!-- PENGAJUAN BERHASIL DIKIRIM -->
                <!-- ================================= -->

                <div class="success-card submitted-card">

                    <div class="success-icon submitted-icon">

                        <i class="fas fa-check"></i>

                    </div>


                    <h2>

                        Pengajuan Berhasil Dikirim!

                    </h2>


                    <p class="text-muted">

                        Pengajuan layanan Anda telah berhasil dikirim
                        dan akan diproses oleh petugas ULT POLBAN.

                    </p>


                    <div class="ticket-number-box">

                        <small>

                            Nomor Tiket Anda

                        </small>

                        <strong>

                            <?= esc($ticket['nomor'] ?? '-') ?>

                        </strong>

                    </div>


                    <div class="ticket-summary">

                        <div class="summary-item">

                            <span>

                                <i class="fas fa-file-alt"></i>

                                Jenis Layanan

                            </span>

                            <strong>

                                <?= esc($ticket['layanan'] ?? '-') ?>

                            </strong>

                        </div>


                        <div class="summary-item">

                            <span>

                                <i class="fas fa-info-circle"></i>

                                Status

                            </span>

                            <span class="badge bg-primary">

                                Submitted

                            </span>

                        </div>

                    </div>


                    <div class="success-info">

                        <i class="fas fa-info-circle"></i>

                        Simpan nomor tiket Anda untuk memantau
                        perkembangan pengajuan layanan.

                    </div>


                    <div class="action-buttons">

                        <a
                            href="<?= base_url('dashboard-mahasiswa') ?>"
                            class="btn btn-secondary"
                        >

                            <i class="fas fa-home"></i>

                            Dashboard

                        </a>


                        <a
                            href="<?= base_url('mahasiswa/ticket/history') ?>"
                            class="btn btn-primary"
                        >

                            <i class="fas fa-ticket-alt"></i>

                            Tracking Tiket

                        </a>

                    </div>

                </div>


            <?php endif; ?>


        </div>

    </section>

</div>


<style>

/* ================================= */
/* PAGE TITLE */
/* ================================= */

.page-title {

    color: #0d47a1;

    font-weight: 700;

}


/* ================================= */
/* SUCCESS CARD */
/* ================================= */

.success-card {

    max-width: 700px;

    margin: 30px auto;

    background: white;

    border-radius: 16px;

    padding: 45px;

    text-align: center;

    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);

    border-top: 5px solid #0d47a1;

}


.success-card h2 {

    color: #0d47a1;

    font-weight: 700;

    margin-top: 20px;

}


.success-card p {

    line-height: 1.7;

}


/* ================================= */
/* ICON */
/* ================================= */

.success-icon {

    width: 85px;

    height: 85px;

    margin: 0 auto;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    font-size: 40px;

}


/* SUBMITTED */

.submitted-icon {

    background: #dcfce7;

    color: #16a34a;

}


/* DRAFT */

.draft-icon {

    background: #eff6ff;

    color: #0d47a1;

}


/* ================================= */
/* DRAFT CARD */
/* ================================= */

.draft-card {

    border-top-color: #0d47a1;

}


/* ================================= */
/* TICKET NUMBER */
/* ================================= */

.ticket-number-box {

    background: #eff6ff;

    border: 1px solid #bfdbfe;

    border-radius: 10px;

    padding: 18px;

    margin: 25px 0;

}


.ticket-number-box small {

    display: block;

    color: #64748b;

    margin-bottom: 5px;

}


.ticket-number-box strong {

    display: block;

    color: #0d47a1;

    font-size: 24px;

    letter-spacing: 1px;

}


/* DRAFT NUMBER */

.draft-number {

    background: #f8fafc;

    border-color: #cbd5e1;

}


.draft-number strong {

    color: #475569;

}


/* ================================= */
/* SUMMARY */
/* ================================= */

.ticket-summary {

    border-top: 1px solid #e2e8f0;

    border-bottom: 1px solid #e2e8f0;

    padding: 20px 0;

    margin: 20px 0;

}


.summary-item {

    display: flex;

    justify-content: space-between;

    align-items: center;

    padding: 10px 0;

}


.summary-item span:first-child {

    color: #64748b;

}


.summary-item i {

    color: #0d47a1;

    margin-right: 7px;

}


/* ================================= */
/* INFO */
/* ================================= */

.success-info {

    background: #eff6ff;

    border-left: 4px solid #0d47a1;

    padding: 14px;

    text-align: left;

    color: #1e3a8a;

    border-radius: 5px;

    margin-bottom: 25px;

}


.success-info i {

    margin-right: 5px;

}


/* ================================= */
/* BUTTON */
/* ================================= */

.action-buttons {

    display: flex;

    justify-content: center;

    gap: 12px;

}


.btn-primary {

    background: #0d47a1;

    border-color: #0d47a1;

}


.btn-primary:hover {

    background: #f59e0b;

    border-color: #f59e0b;

}


/* ================================= */
/* RESPONSIVE */
/* ================================= */

@media (max-width: 576px) {

    .success-card {

        padding: 30px 20px;

    }


    .action-buttons {

        flex-direction: column;

    }


    .action-buttons .btn {

        width: 100%;

    }


    .summary-item {

        flex-direction: column;

        align-items: flex-start;

        gap: 5px;

    }

}

</style>


<?= $this->include('layouts/footer') ?>