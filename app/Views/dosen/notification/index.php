<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_dosen') ?>

<div class="content-wrapper">

    <!-- =====================================================
         HEADER
    ====================================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-sm-6">

                    <h1 class="dashboard-title">

                        <i class="fas fa-bell mr-2"></i>

                        Notifikasi

                    </h1>

                    <p class="text-muted mb-0">

                        Lihat informasi terbaru mengenai
                        pengajuan layanan Anda.

                    </p>

                </div>


                <div class="col-sm-6 text-sm-right mt-3 mt-sm-0">

                    <a
                        href="<?= base_url('dosen/dashboard') ?>"
                        class="btn btn-outline-ult-blue"
                    >

                        <i class="fas fa-home mr-1"></i>

                        Dashboard

                    </a>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CONTENT
    ====================================================== -->

    <section class="content">

        <div class="container-fluid">


            <!-- =================================================
                 FLASH MESSAGE
            ================================================== -->

            <?php if (
                session()->getFlashdata('success')
            ): ?>

                <div
                    class="
                        alert
                        alert-success
                        alert-dismissible
                        fade
                        show
                    "
                >

                    <i
                        class="
                            fas
                            fa-check-circle
                            mr-2
                        "
                    ></i>

                    <?= esc(
                        session()->getFlashdata('success')
                    ) ?>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                    >

                        &times;

                    </button>

                </div>

            <?php endif; ?>


            <?php if (
                session()->getFlashdata('error')
            ): ?>

                <div
                    class="
                        alert
                        alert-danger
                        alert-dismissible
                        fade
                        show
                    "
                >

                    <i
                        class="
                            fas
                            fa-exclamation-circle
                            mr-2
                        "
                    ></i>

                    <?= esc(
                        session()->getFlashdata('error')
                    ) ?>

                    <button
                        type="button"
                        class="close"
                        data-dismiss="alert"
                    >

                        &times;

                    </button>

                </div>

            <?php endif; ?>


            <!-- =================================================
                 RINGKASAN
            ================================================== -->

            <div class="row mb-4">


                <!-- TOTAL -->

                <div class="col-md-4">

                    <div
                        class="
                            notification-summary-card
                        "
                    >

                        <div
                            class="
                                notification-summary-icon
                                blue
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-bell
                                "
                            ></i>

                        </div>


                        <div>

                            <small>
                                Total Notifikasi
                            </small>

                            <h3>

                                <?= !empty($notifications)
                                    ? count($notifications)
                                    : 0 ?>

                            </h3>

                        </div>

                    </div>

                </div>


                <!-- BELUM DIBACA -->

                <div class="col-md-4">

                    <div
                        class="
                            notification-summary-card
                        "
                    >

                        <div
                            class="
                                notification-summary-icon
                                orange
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-envelope
                                "
                            ></i>

                        </div>


                        <div>

                            <small>
                                Belum Dibaca
                            </small>

                            <h3>

                                <?= (int) (
                                    $unreadCount ?? 0
                                ) ?>

                            </h3>

                        </div>

                    </div>

                </div>


                <!-- STATUS -->

                <div class="col-md-4">

                    <div
                        class="
                            notification-summary-card
                        "
                    >

                        <div
                            class="
                                notification-summary-icon
                                green
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-check-circle
                                "
                            ></i>

                        </div>


                        <div>

                            <small>
                                Status
                            </small>

                            <h3>
                                Aktif
                            </h3>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 DAFTAR NOTIFIKASI
            ================================================== -->

            <div
                class="
                    card
                    dashboard-card
                    shadow-sm
                "
            >

                <div
                    class="
                        card-header
                        dashboard-card-header
                        d-flex
                        justify-content-between
                        align-items-center
                    "
                >

                    <h3
                        class="
                            card-title
                            mb-0
                        "
                    >

                        <i
                            class="
                                fas
                                fa-list
                                mr-2
                            "
                        ></i>

                        Daftar Notifikasi

                    </h3>


                    <?php if (
                        ($unreadCount ?? 0) > 0
                    ): ?>

                        <a
                            href="<?= base_url(
                                'dosen/notification/read-all'
                            ) ?>"
                            class="
                                btn
                                btn-sm
                                btn-outline-primary
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-check-double
                                    mr-1
                                "
                            ></i>

                            Tandai Semua Dibaca

                        </a>

                    <?php endif; ?>

                </div>


                <div class="card-body p-0">


                    <?php if (
                        !empty($notifications)
                    ): ?>


                        <div
                            class="
                                notification-list
                            "
                        >


                            <?php foreach (
                                $notifications
                                as $notification
                            ): ?>


                                <?php

                                $isRead =
                                    isset(
                                        $notification[
                                            'dibaca'
                                        ]
                                    )
                                        ? $notification[
                                            'dibaca'
                                        ]
                                        : false;


                                $notificationUrl =
                                    !empty(
                                        $notification[
                                            'url'
                                        ]
                                    )
                                        ? $notification[
                                            'url'
                                        ]
                                        : base_url(
                                            'dosen/notification/read/' .
                                            (
                                                $notification[
                                                    'id'
                                                ] ?? 0
                                            )
                                        );

                                ?>


                                <a
                                    href="<?= esc(
                                        $notificationUrl
                                    ) ?>"
                                    class="
                                        notification-item
                                        text-decoration-none
                                        <?= !$isRead
                                            ? 'notification-unread'
                                            : '' ?>
                                    "
                                >


                                    <!-- ICON -->

                                    <div
                                        class="
                                            notification-icon
                                        "
                                    >

                                        <?php if (
                                            isset(
                                                $notification[
                                                    'tipe'
                                                ]
                                            )
                                            &&
                                            $notification[
                                                'tipe'
                                            ] === 'success'
                                        ): ?>

                                            <i
                                                class="
                                                    fas
                                                    fa-check-circle
                                                "
                                            ></i>


                                        <?php elseif (
                                            isset(
                                                $notification[
                                                    'tipe'
                                                ]
                                            )
                                            &&
                                            $notification[
                                                'tipe'
                                            ] === 'warning'
                                        ): ?>

                                            <i
                                                class="
                                                    fas
                                                    fa-exclamation-circle
                                                "
                                            ></i>


                                        <?php elseif (
                                            isset(
                                                $notification[
                                                    'tipe'
                                                ]
                                            )
                                            &&
                                            $notification[
                                                'tipe'
                                            ] === 'danger'
                                        ): ?>

                                            <i
                                                class="
                                                    fas
                                                    fa-times-circle
                                                "
                                            ></i>


                                        <?php elseif (
                                            isset(
                                                $notification[
                                                    'tipe'
                                                ]
                                            )
                                            &&
                                            $notification[
                                                'tipe'
                                            ] === 'info'
                                        ): ?>

                                            <i
                                                class="
                                                    fas
                                                    fa-info-circle
                                                "
                                            ></i>


                                        <?php else: ?>

                                            <i
                                                class="
                                                    fas
                                                    fa-bell
                                                "
                                            ></i>

                                        <?php endif; ?>

                                    </div>


                                    <!-- =================================================
                                         ISI
                                    ================================================== -->

                                    <div
                                        class="
                                            notification-content
                                        "
                                    >


                                        <div
                                            class="
                                                notification-top
                                            "
                                        >

                                            <h5>

                                                <?= esc(
                                                    $notification[
                                                        'judul'
                                                    ]
                                                    ??
                                                    'Notifikasi'
                                                ) ?>

                                            </h5>


                                            <?php if (
                                                !$isRead
                                            ): ?>

                                                <span
                                                    class="
                                                        notification-badge
                                                    "
                                                >

                                                    Baru

                                                </span>

                                            <?php endif; ?>

                                        </div>


                                        <p>

                                            <?= esc(
                                                $notification[
                                                    'pesan'
                                                ]
                                                ?? ''
                                            ) ?>

                                        </p>


                                        <small>

                                            <i
                                                class="
                                                    far
                                                    fa-clock
                                                    mr-1
                                                "
                                            ></i>

                                            <?= esc(
                                                $notification[
                                                    'tanggal'
                                                ]
                                                ?? '-'
                                            ) ?>

                                        </small>

                                    </div>


                                </a>


                            <?php endforeach; ?>


                        </div>


                    <?php else: ?>


                        <!-- =================================================
                             EMPTY STATE
                        ================================================== -->

                        <div
                            class="
                                empty-notification
                            "
                        >

                            <div
                                class="
                                    empty-notification-icon
                                "
                            >

                                <i
                                    class="
                                        far
                                        fa-bell-slash
                                    "
                                ></i>

                            </div>


                            <h5>

                                Belum Ada Notifikasi

                            </h5>


                            <p>

                                Saat ini belum ada
                                notifikasi untuk Anda.

                            </p>


                            <a
                                href="<?= base_url(
                                    'dosen/dashboard'
                                ) ?>"
                                class="
                                    btn
                                    btn-ult-orange
                                "
                            >

                                <i
                                    class="
                                        fas
                                        fa-home
                                        mr-1
                                    "
                                ></i>

                                Kembali ke Dashboard

                            </a>

                        </div>


                    <?php endif; ?>


                </div>

            </div>


        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>