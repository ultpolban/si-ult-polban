<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">
        <div class="container-fluid">

            <h1>
                <i class="fas fa-check-circle text-success"></i>
                Pengajuan Berhasil
            </h1>

        </div>
    </section>


    <!-- Content -->
    <section class="content">

        <div class="container-fluid">

            <div class="card shadow">

                <div class="card-body text-center py-5">

                    <!-- Icon -->
                    <div class="mb-4">

                        <i
                            class="fas fa-check-circle text-success"
                            style="font-size: 80px;"
                        ></i>

                    </div>


                    <!-- Judul -->
                    <h2 class="text-success mb-3">
                        Pengajuan Berhasil Dikirim!
                    </h2>


                    <!-- Deskripsi -->
                    <p class="text-muted mb-4">

                        Pengajuan layanan Anda telah berhasil dikirim
                        dan akan segera diproses oleh unit terkait.

                    </p>


                    <!-- Nomor Tiket -->
                    <div class="alert alert-info d-inline-block px-5">

                        <strong>
                            Nomor Tiket Anda:
                        </strong>

                        <br>

                        <span class="h4">
                            ULT-MHS-<?= date('Ymd') ?>-001
                        </span>

                    </div>


                    <!-- Tombol -->
                    <div class="mt-4">

                        <a
                            href="<?= base_url('mahasiswa/ticket/history') ?>"
                            class="btn btn-primary"
                        >

                            <i class="fas fa-ticket-alt"></i>

                            Tracking Tiket

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

        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>