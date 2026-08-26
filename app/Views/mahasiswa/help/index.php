<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<?php
$faqs = $faqs ?? [];
?>

<div class="content-wrapper">

    <!-- =====================================================
         HEADER
    ====================================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-sm-6">

                    <h1
                        style="
                            color:#0b3d91;
                            font-weight:700;
                        "
                    >

                        <i
                            class="fas fa-question-circle mr-2"
                        ></i>

                        Pusat Bantuan

                    </h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a
                                href="<?= base_url(
                                    'dashboard-mahasiswa'
                                ) ?>"
                            >

                                Dashboard

                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            Pusat Bantuan

                        </li>

                    </ol>

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
                 WELCOME CARD
            ================================================== -->

            <div
                class="card shadow-sm mb-4"
                style="
                    border-radius:15px;
                    border-top:5px solid #0b3d91;
                    overflow:hidden;
                "
            >

                <div
                    class="card-body"
                    style="padding:30px;"
                >

                    <div class="row align-items-center">

                        <div class="col-md-8">

                            <h2
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                "
                            >

                                Halo, Mahasiswa! 👋

                            </h2>

                            <p
                                class="text-muted mb-0"
                                style="
                                    font-size:16px;
                                    line-height:1.7;
                                "
                            >

                                Selamat datang di Pusat Bantuan
                                SI-ULT POLBAN.

                                <br>

                                Temukan jawaban dari pertanyaan yang
                                sering ditanyakan mengenai layanan,
                                pengajuan, tracking tiket, dan profil.

                            </p>

                        </div>


                        <div
                            class="
                                col-md-4
                                text-center
                                mt-4
                                mt-md-0
                            "
                        >

                            <div
                                style="
                                    width:120px;
                                    height:120px;
                                    margin:auto;
                                    border-radius:50%;
                                    background:#f5f8fc;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                "
                            >

                                <i
                                    class="fas fa-headset"
                                    style="
                                        font-size:55px;
                                        color:#0b3d91;
                                    "
                                ></i>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <!-- =================================================
                 FAQ CARD
            ================================================== -->

            <div
                class="card shadow-sm"
                style="
                    border-radius:15px;
                    border-top:5px solid #0b3d91;
                "
            >

                <!-- CARD HEADER -->

                <div
                    class="card-header"
                    style="
                        background:#0b3d91;
                        color:white;
                        border-radius:10px 10px 0 0;
                    "
                >

                    <h3
                        class="card-title"
                        style="font-weight:600;"
                    >

                        <i
                            class="
                                fas
                                fa-question-circle
                                mr-2
                            "
                        ></i>

                        Pertanyaan yang Sering Ditanyakan

                    </h3>

                </div>


                <!-- CARD BODY -->

                <div class="card-body">

                    <?php if (!empty($faqs)): ?>

                        <?php foreach (
                            $faqs as $index => $faq
                        ): ?>

                            <div class="faq-box">

                                <!-- PERTANYAAN -->

                                <button
                                    type="button"
                                    class="faq-question"
                                    onclick="toggleFAQ(<?= $index ?>)"
                                >

                                    <span>

                                        <i
                                            class="
                                                fas
                                                fa-question-circle
                                                mr-2
                                            "
                                        ></i>

                                        <?= esc(
                                            $faq['pertanyaan']
                                        ) ?>

                                    </span>


                                    <i
                                        id="faqIcon<?= $index ?>"
                                        class="
                                            fas
                                            fa-chevron-down
                                            faq-icon
                                        "
                                    ></i>

                                </button>


                                <!-- JAWABAN -->

                                <div
                                    id="faqAnswer<?= $index ?>"
                                    class="faq-answer"
                                >

                                    <i
                                        class="
                                            fas
                                            fa-info-circle
                                            mr-2
                                        "
                                    ></i>

                                    <?= esc(
                                        $faq['jawaban']
                                    ) ?>

                                </div>

                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div
                            class="
                                alert
                                alert-info
                            "
                        >

                            <i
                                class="
                                    fas
                                    fa-info-circle
                                    mr-2
                                "
                            ></i>

                            Belum ada informasi bantuan yang tersedia.

                        </div>

                    <?php endif; ?>

                </div>

            </div>


            <!-- =================================================
                 KONTAK BANTUAN
            ================================================== -->

            <div class="row mt-4">


                <!-- EMAIL -->

                <div class="col-md-6 mb-4">

                    <div
                        class="card shadow-sm h-100"
                        style="
                            border-radius:15px;
                            border-top:4px solid #0b3d91;
                        "
                    >

                        <div
                            class="
                                card-body
                                text-center
                                p-4
                            "
                        >

                            <div
                                style="
                                    width:75px;
                                    height:75px;
                                    margin:0 auto 20px;
                                    border-radius:50%;
                                    background:#f5f8fc;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                "
                            >

                                <i
                                    class="
                                        fas
                                        fa-envelope
                                    "
                                    style="
                                        font-size:32px;
                                        color:#0b3d91;
                                    "
                                ></i>

                            </div>


                            <h4
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                "
                            >

                                Hubungi Kami

                            </h4>


                            <p
                                class="text-muted"
                                style="
                                    line-height:1.7;
                                "
                            >

                                Jika kamu masih mengalami kendala
                                setelah membaca informasi di atas,
                                silakan hubungi layanan bantuan
                                SI-ULT POLBAN melalui email.

                            </p>


                            <a
                                href="mailto:ult@polban.ac.id"
                                class="btn btn-primary"
                            >

                                <i
                                    class="
                                        fas
                                        fa-envelope
                                        mr-1
                                    "
                                ></i>

                                Kirim Email

                            </a>

                        </div>

                    </div>

                </div>


                <!-- TELEPON -->

                <div class="col-md-6 mb-4">

                    <div
                        class="card shadow-sm h-100"
                        style="
                            border-radius:15px;
                            border-top:4px solid #f28c28;
                        "
                    >

                        <div
                            class="
                                card-body
                                text-center
                                p-4
                            "
                        >

                            <div
                                style="
                                    width:75px;
                                    height:75px;
                                    margin:0 auto 20px;
                                    border-radius:50%;
                                    background:#fff5eb;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                "
                            >

                                <i
                                    class="
                                        fas
                                        fa-phone-alt
                                    "
                                    style="
                                        font-size:32px;
                                        color:#f28c28;
                                    "
                                ></i>

                            </div>


                            <h4
                                style="
                                    color:#0b3d91;
                                    font-weight:700;
                                "
                            >

                                Layanan Bantuan

                            </h4>


                            <p
                                class="text-muted"
                                style="
                                    line-height:1.7;
                                "
                            >

                                Jika membutuhkan bantuan lebih lanjut,
                                silakan hubungi petugas ULT melalui
                                nomor layanan yang tersedia.

                            </p>


                            <a
                                href="tel:+62222010000"
                                class="btn"
                                style="
                                    background:#f28c28;
                                    color:white;
                                    font-weight:600;
                                "
                            >

                                <i
                                    class="
                                        fas
                                        fa-phone
                                        mr-1
                                    "
                                ></i>

                                Hubungi Petugas

                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>


<!-- =====================================================
     FAQ STYLE
====================================================== -->

<style>

    .faq-box {
        margin-bottom: 12px;
        border: 1px solid #dfe4ea;
        border-radius: 10px;
        overflow: hidden;
        background: #ffffff;
    }


    .faq-box:last-child {
        margin-bottom: 0;
    }


    .faq-question {
        width: 100%;
        border: none;
        outline: none;

        display: flex;
        align-items: center;
        justify-content: space-between;

        text-align: left;

        padding: 18px 20px;

        background: #f5f8fc;

        color: #0b3d91;

        font-size: 16px;
        font-weight: 600;

        cursor: pointer;

        transition: background 0.2s ease;
    }


    .faq-question:hover {
        background: #eaf1f9;
    }


    .faq-question:focus {
        outline: none;
        box-shadow: none;
    }


    .faq-icon {
        transition: transform 0.2s ease;
        margin-left: 15px;
        flex-shrink: 0;
    }


    .faq-answer {
        display: none;

        padding: 18px 20px;

        background: #ffffff;

        border-top: 1px solid #dfe4ea;

        color: #555;

        font-size: 15px;

        line-height: 1.7;
    }


    .faq-answer .fa-info-circle {
        color: #0b3d91;
    }

</style>


<!-- =====================================================
     FAQ JAVASCRIPT
====================================================== -->

<script>

    function toggleFAQ(index) {

        const answer =
            document.getElementById(
                'faqAnswer' + index
            );

        const icon =
            document.getElementById(
                'faqIcon' + index
            );


        if (!answer) {
            return;
        }


        const isOpen =
            answer.style.display === 'block';


        if (isOpen) {

            answer.style.display = 'none';

            if (icon) {

                icon.style.transform =
                    'rotate(0deg)';

            }

        } else {

            answer.style.display = 'block';

            if (icon) {

                icon.style.transform =
                    'rotate(180deg)';

            }

        }

    }

</script>


<?= $this->include('layouts/footer') ?>