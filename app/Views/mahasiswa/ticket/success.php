<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <h1>
                Pengajuan Berhasil
            </h1>

        </div>

    </section>


    <section class="content">

        <div class="container-fluid">

            <div class="card shadow">

                <div class="card-body text-center">

                    <i
                        class="fas fa-check-circle text-success"
                        style="font-size: 80px;"
                    ></i>

                    <h2 class="mt-3">
                        Pengajuan Berhasil Dikirim
                    </h2>

                    <p class="text-muted">

                        Pengajuan layanan kamu berhasil dikirim
                        dan sedang menunggu proses selanjutnya.

                    </p>


                    <a
                        href="<?= base_url('mahasiswa/ticket/history') ?>"
                        class="btn btn-primary"
                    >

                        <i class="fas fa-ticket-alt"></i>

                        Lihat Tracking Tiket

                    </a>


                    <a
                        href="<?= base_url('dashboard-mahasiswa') ?>"
                        class="btn btn-secondary"
                    >

                        <i class="fas fa-home"></i>

                        Kembali ke Dashboard

                    </a>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>