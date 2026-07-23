<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- Header -->
    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>
                        <i class="fas fa-question-circle"></i>
                        Pusat Bantuan
                    </h1>

                </div>

            </div>

        </div>

    </section>


    <!-- Content -->
    <section class="content">

        <div class="container-fluid">

            <!-- Welcome -->
            <div class="card shadow mb-4">

                <div class="card-body">

                    <div class="row align-items-center">

                        <div class="col-md-8">

                            <h3>
                                Halo, Mahasiswa! 👋
                            </h3>

                            <p class="text-muted mb-0">

                                Temukan jawaban dari pertanyaan yang sering
                                ditanyakan mengenai layanan SI-ULT POLBAN.

                            </p>

                        </div>

                        <div class="col-md-4 text-center">

                            <i class="fas fa-headset fa-5x text-primary"></i>

                        </div>

                    </div>

                </div>

            </div>


            <!-- FAQ -->
            <div class="card shadow">

    <div class="card-header text-white faq-header">

        <h3 class="card-title">
            <i class="fas fa-question-circle"></i>
            Pertanyaan yang Sering Ditanyakan
        </h3>

    </div>

    <div class="card-body">

        <?php foreach ($faqs as $faq): ?>

            <details class="mb-3">

                <summary
                    style="
                        cursor: pointer;
                        font-weight: 600;
                        padding: 15px;
                        background-color: #f8f9fa;
                        border-radius: 8px;
                    "
                >

                    <i class="fas fa-question-circle text-danger mr-2"></i>

                    <?= esc($faq['pertanyaan']) ?>

                </summary>

                <div
                    style="
                        padding: 15px;
                        margin-top: 5px;
                        background-color: #ffffff;
                        border: 1px solid #dee2e6;
                        border-radius: 8px;
                    "
                >

                    <i class="fas fa-info-circle text-primary mr-2"></i>

                    <?= esc($faq['jawaban']) ?>

                </div>

            </details>

        <?php endforeach; ?>

    </div>

</div>


            <!-- Kontak Bantuan -->
            <div class="row mt-4">

                <div class="col-md-6">

                    <div class="card shadow">

                        <div class="card-body text-center">

                            <i class="fas fa-envelope fa-3x text-primary mb-3"></i>

                            <h4>
                                Hubungi Kami
                            </h4>

                            <p class="text-muted">

                                Jika kamu masih mengalami kendala,
                                silakan hubungi layanan bantuan SI-ULT POLBAN.

                            </p>

                            <a
                                href="mailto:ult@polban.ac.id"
                                class="btn btn-primary"
                            >

                                <i class="fas fa-envelope"></i>

                                Kirim Email

                            </a>

                        </div>

                    </div>

                </div>


                <div class="col-md-6">

                    <div class="card shadow">

                        <div class="card-body text-center">

                            <i class="fas fa-phone-alt fa-3x text-danger mb-3"></i>

                            <h4>
                                Layanan Bantuan
                            </h4>

                            <p class="text-muted">

                                Hubungi petugas ULT jika membutuhkan
                                bantuan lebih lanjut.

                            </p>

                            <a
                                href="tel:+62222010000"
                                class="btn btn-danger"
                            >

                                <i class="fas fa-phone"></i>

                                Hubungi Petugas

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>