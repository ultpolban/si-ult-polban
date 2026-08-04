<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- =========================================
         HEADER
    ========================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1 style="color:#0b3d91;font-weight:700;">

                        <i class="fas fa-ticket-alt"></i>

                        Detail Tiket

                    </h1>

                </div>

            </div>

        </div>

    </section>


    <!-- =========================================
         CONTENT
    ========================================== -->

    <section class="content">

        <div class="container-fluid">


            <!-- =========================================
                 HEADER TIKET
            ========================================== -->

            <div class="card shadow-sm mb-4">

                <div class="card-body">

                    <div class="row align-items-center">


                        <!-- NOMOR TIKET -->

                        <div class="col-md-8">

                            <h3
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                "
                            >

                                <?= esc(
                                    $ticket['nomor']
                                    ?? 'ULT-MHS-001'
                                ) ?>

                            </h3>


                            <p class="text-muted mb-0">

                                <i class="fas fa-calendar-alt"></i>

                                <?= esc(
                                    $ticket['tanggal']
                                    ?? date('d F Y')
                                ) ?>

                            </p>

                        </div>


                        <!-- STATUS -->

                        <div
                            class="
                                col-md-4
                                text-md-end
                                mt-3
                                mt-md-0
                            "
                        >

                            <span
                                class="
                                    badge
                                    bg-primary
                                    p-2
                                "
                            >

                                <?= esc(
                                    $ticket['status']
                                    ?? 'Submitted'
                                ) ?>

                            </span>

                        </div>


                    </div>

                </div>

            </div>



            <!-- =========================================
                 ROW UTAMA
            ========================================== -->

            <div class="row">


                <!-- =========================================
                     KOLOM KIRI
                ========================================== -->

                <div class="col-lg-8">


                    <!-- =========================================
                         INFORMASI PENGAJUAN
                    ========================================== -->

                    <div
                        class="
                            card
                            shadow-sm
                            mb-4
                        "
                    >

                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h3 class="card-title">

                                <i class="fas fa-file-alt"></i>

                                Informasi Pengajuan

                            </h3>

                        </div>


                        <div class="card-body">

                        <!-- NAMA PENGAJU -->
                        <div class="row py-3 border-bottom">

    <div class="col-md-5 text-muted">

        <i class="fas fa-user text-primary"></i>

        Nama Pengaju

    </div>

    <div class="col-md-7 text-md-end">

        <strong>

            muhamad rafi putra zakaria

        </strong>

    </div>

</div>


<div class="row py-3 border-bottom">

    <div class="col-md-5 text-muted">

        <i class="fas fa-id-card text-primary"></i>

        NIK

    </div>

    <div class="col-md-7 text-md-end">

        <strong>

            3276010101010001

        </strong>

    </div>

</div>
                            <!-- LAYANAN -->

                            <div
                                class="
                                    row
                                    py-3
                                    border-bottom
                                "
                            >

                                <div class="col-md-5 text-muted">

                                    <i
                                        class="
                                            fas
                                            fa-file-signature
                                            text-primary
                                        "
                                    ></i>

                                    Jenis Layanan

                                </div>


                                <div
                                    class="
                                        col-md-7
                                        text-md-end
                                    "
                                >

                                    <strong>

                                        <?= esc(
                                            $ticket['layanan']
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </div>

                            </div>



                            <!-- UNIT -->

                            <div
                                class="
                                    row
                                    py-3
                                    border-bottom
                                "
                            >

                                <div class="col-md-5 text-muted">

                                    <i
                                        class="
                                            fas
                                            fa-building
                                            text-primary
                                        "
                                    ></i>

                                    Unit Tujuan

                                </div>


                                <div
                                    class="
                                        col-md-7
                                        text-md-end
                                    "
                                >

                                    <strong>

                                        <?= esc(
                                            $ticket['unit']
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </div>

                            </div>



                            <!-- TANGGAL -->

                            <div
                                class="
                                    row
                                    py-3
                                    border-bottom
                                "
                            >

                                <div class="col-md-5 text-muted">

                                    <i
                                        class="
                                            fas
                                            fa-calendar-alt
                                            text-primary
                                        "
                                    ></i>

                                    Tanggal Pengajuan

                                </div>


                                <div
                                    class="
                                        col-md-7
                                        text-md-end
                                    "
                                >

                                    <strong>

                                        <?= esc(
                                            $ticket['tanggal']
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </div>

                            </div>



                            <!-- KETERANGAN -->

                            <div class="row py-3">

                                <div class="col-md-5 text-muted">

                                    <i
                                        class="
                                            fas
                                            fa-comment-alt
                                            text-primary
                                        "
                                    ></i>

                                    Keterangan

                                </div>


                                <div
                                    class="
                                        col-md-7
                                        text-md-end
                                    "
                                >

                                    <strong>

                                        <?= esc(
                                            $ticket['keterangan']
                                            ?? '-'
                                        ) ?>

                                    </strong>

                                </div>

                            </div>


                        </div>

                    </div>



                    <!-- =========================================
                         DOKUMEN PENGAJUAN
                    ========================================== -->

                    <div
                        class="
                            card
                            shadow-sm
                            mb-4
                        "
                    >

                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h3 class="card-title">

                                <i class="fas fa-paperclip"></i>

                                Dokumen Pengajuan

                            </h3>

                        </div>


                        <div
                            class="
                                card-body
                                text-center
                                py-5
                            "
                        >

                            <?php if (
                                !empty($ticket['dokumen'])
                            ): ?>


                                <i
                                    class="
                                        fas
                                        fa-file-alt
                                        fa-3x
                                        text-primary
                                        mb-3
                                    "
                                ></i>


                                <p>

                                    <?= esc(
                                        $ticket['dokumen']
                                    ) ?>

                                </p>


                                <a
                                    href="<?= base_url(
                                        'uploads/' .
                                        $ticket['dokumen']
                                    ) ?>"
                                    target="_blank"
                                    class="
                                        btn
                                        btn-primary
                                    "
                                >

                                    <i class="fas fa-eye"></i>

                                    Lihat Dokumen

                                </a>


                            <?php else: ?>


                                <i
                                    class="
                                        fas
                                        fa-file-circle-xmark
                                        fa-3x
                                    "
                                    style="color:#94a3b8;"
                                ></i>


                                <p
                                    class="
                                        text-muted
                                        mt-3
                                    "
                                >

                                    Tidak ada dokumen yang diunggah.

                                </p>


                            <?php endif; ?>


                        </div>

                    </div>



                    <!-- =========================================
                         CATATAN PETUGAS
                    ========================================== -->

                    <div
                        class="
                            card
                            shadow-sm
                            mb-4
                        "
                    >

                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h3 class="card-title">

                                <i class="fas fa-comments"></i>

                                Catatan Petugas

                            </h3>

                        </div>


                        <div class="card-body">


                            <?php if (
                                !empty(
                                    $ticket['catatan_petugas']
                                )
                            ): ?>


                                <div
                                    class="
                                        alert
                                        alert-info
                                        mb-0
                                    "
                                >

                                    <div
                                        class="
                                            d-flex
                                        "
                                    >


                                        <div class="me-3">

                                            <i
                                                class="
                                                    fas
                                                    fa-user-tie
                                                    fa-2x
                                                "
                                            ></i>

                                        </div>


                                        <div>

                                            <strong>

                                                Catatan Petugas

                                            </strong>


                                            <p
                                                class="
                                                    mb-0
                                                    mt-2
                                                "
                                            >

                                                <?= esc(
                                                    $ticket[
                                                        'catatan_petugas'
                                                    ]
                                                ) ?>

                                            </p>

                                        </div>


                                    </div>

                                </div>


                            <?php else: ?>


                                <div
                                    class="
                                        text-center
                                        text-muted
                                        py-4
                                    "
                                >

                                    <i
                                        class="
                                            fas
                                            fa-comment-slash
                                            fa-3x
                                            mb-3
                                        "
                                    ></i>


                                    <p class="mb-0">

                                        Belum ada catatan dari petugas.

                                    </p>

                                </div>


                            <?php endif; ?>


                        </div>

                    </div>



                    <!-- =========================================
                         BALASAN MAHASISWA
                    ========================================== -->

                    <div
                        class="
                            card
                            shadow-sm
                            mb-4
                        "
                    >

                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h3 class="card-title">

                                <i class="fas fa-reply"></i>

                                Balasan Anda

                            </h3>

                        </div>


                        <div class="card-body">


                            <!-- BALASAN YANG SUDAH ADA -->

                            <?php if (
                                !empty(
                                    $ticket['balasan']
                                )
                            ): ?>


                                <div
                                    class="
                                        alert
                                        alert-success
                                    "
                                >

                                    <strong>

                                        <i
                                            class="
                                                fas
                                                fa-user
                                            "
                                        ></i>

                                        Anda

                                    </strong>


                                    <div class="mt-2">

    <?php if (!empty($ticket['balasan'])): ?>

        <?php if (is_array($ticket['balasan'])): ?>

            <?php foreach ($ticket['balasan'] as $balasan): ?>

                <div class="alert alert-light border mb-2">

                    <i class="fas fa-reply mr-2 text-primary"></i>

                    <?= esc(
                        is_array($balasan)
                            ? ($balasan['pesan'] ?? '')
                            : $balasan
                    ) ?>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div class="alert alert-light border mb-2">

                <i class="fas fa-reply mr-2 text-primary"></i>

                <?= esc($ticket['balasan']) ?>

            </div>

        <?php endif; ?>

    <?php else: ?>

        <div class="text-muted">

            Belum ada balasan dari Anda.

        </div>

    <?php endif; ?>

</div>

                                </div>


                            <?php endif; ?>



                            <!-- FORM BALASAN -->

                            <form
                                action="<?= base_url(
                                    'mahasiswa/ticket/reply/' .
                                    ($ticket['id'] ?? 0)
                                ) ?>"
                                method="post"
                            >

                                <?= csrf_field() ?>


                                <div class="mb-3">

                                    <label
                                        class="form-label"
                                    >

                                        Tulis Balasan

                                    </label>


<textarea
    name="pesan"
    class="form-control"
    rows="5"
    placeholder="Tulis balasan Anda..."
    required
></textarea>

                                </div>


                                <div
                                    class="
                                        text-end
                                    "
                                >

                                    <button
                                        type="submit"
                                        class="btn"
                                        style="
                                            background:#0b3d91;
                                            color:white;
                                            font-weight:600;
                                        "
                                    >

                                        <i
                                            class="
                                                fas
                                                fa-paper-plane
                                            "
                                        ></i>

                                        Kirim Balasan

                                    </button>

                                </div>


                            </form>


                        </div>

                    </div>


                </div>



                <!-- =========================================
                     KOLOM KANAN
                ========================================== -->

                <div class="col-lg-4">


                    <!-- =========================================
                         RIWAYAT STATUS
                    ========================================== -->

                    <div
                        class="
                            card
                            shadow-sm
                        "
                    >

                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                                border-bottom:4px solid #f28c28;
                            "
                        >

                            <h3 class="card-title">

                                <i class="fas fa-history"></i>

                                Riwayat Status

                            </h3>

                        </div>


                        <div class="card-body">


                            <!-- STATUS 1 -->

                            <div class="mb-4">

                                <div>

                                    <i
                                        class="
                                            fas
                                            fa-paper-plane
                                            text-primary
                                        "
                                    ></i>

                                    <strong>

                                        Pengajuan Dikirim

                                    </strong>

                                </div>


                                <small
                                    class="
                                        text-muted
                                        ms-4
                                    "
                                >

                                    Pengajuan berhasil dikirim oleh mahasiswa.

                                </small>

                            </div>



                            <!-- STATUS 2 -->

                            <div class="mb-4">

                                <div>

                                    <i
                                        class="
                                            fas
                                            fa-check-circle
                                            text-secondary
                                        "
                                    ></i>

                                    <strong>

                                        Diverifikasi

                                    </strong>

                                </div>


                                <small
                                    class="
                                        text-muted
                                        ms-4
                                    "
                                >

                                    Pengajuan telah diverifikasi petugas.

                                </small>

                            </div>



                            <!-- STATUS 3 -->

                            <div class="mb-4">

                                <div>

                                    <i
                                        class="
                                            fas
                                            fa-building
                                            text-secondary
                                        "
                                    ></i>

                                    <strong>

                                        Diteruskan ke Unit

                                    </strong>

                                </div>


                                <small
                                    class="
                                        text-muted
                                        ms-4
                                    "
                                >

                                    Tiket telah diteruskan ke unit terkait.

                                </small>

                            </div>



                            <!-- STATUS 4 -->

                            <div class="mb-4">

                                <div>

                                    <i
                                        class="
                                            fas
                                            fa-spinner
                                            text-secondary
                                        "
                                    ></i>

                                    <strong>

                                        Sedang Diproses

                                    </strong>

                                </div>


                                <small
                                    class="
                                        text-muted
                                        ms-4
                                    "
                                >

                                    Unit sedang memproses pengajuan.

                                </small>

                            </div>



                            <!-- STATUS 5 -->

                            <div class="mb-4">

                                <div>

                                    <i
                                        class="
                                            fas
                                            fa-check
                                            text-secondary
                                        "
                                    ></i>

                                    <strong>

                                        Selesai

                                    </strong>

                                </div>


                                <small
                                    class="
                                        text-muted
                                        ms-4
                                    "
                                >

                                    Pengajuan telah selesai diproses.

                                </small>

                            </div>



                            <!-- STATUS 6 -->

                            <div>

                                <div>

                                    <i
                                        class="
                                            fas
                                            fa-lock
                                            text-secondary
                                        "
                                    ></i>

                                    <strong>

                                        Ditutup

                                    </strong>

                                </div>


                                <small
                                    class="
                                        text-muted
                                        ms-4
                                    "
                                >

                                    Tiket telah ditutup.

                                </small>

                            </div>


                        </div>

                    </div>



                    <!-- =========================================
                         BANTUAN
                    ========================================== -->

                    <div
                        class="
                            card
                            mt-4
                            shadow-sm
                        "
                        style="
                            border-left:4px solid #0b3d91;
                        "
                    >

                        <div class="card-body">

                            <h5
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                "
                            >

                                <i
                                    class="
                                        fas
                                        fa-headset
                                    "
                                ></i>

                                Butuh Bantuan?

                            </h5>


                            <p
                                class="
                                    text-muted
                                    mb-0
                                "
                            >

                                Jika ada kendala terkait pengajuan,
                                silakan balas catatan petugas.

                            </p>

                        </div>

                    </div>


                </div>


            </div>



            <!-- =========================================
                 TOMBOL KEMBALI
            ========================================== -->

            <div class="mb-4">

                <a
                    href="<?= base_url(
                        'mahasiswa/ticket/history'
                    ) ?>"
                    class="
                        btn
                        btn-secondary
                    "
                >

                    <i class="fas fa-arrow-left"></i>

                    Kembali ke Tracking Tiket

                </a>

            </div>


        </div>

    </section>

</div>


<?= $this->include('layouts/footer') ?>