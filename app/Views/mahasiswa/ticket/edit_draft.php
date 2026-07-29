<?= $this->include('layouts/header') ?>

<?= $this->include('layouts/navbar') ?>

<?= $this->include('layouts/sidebar_mahasiswa') ?>


<div class="content-wrapper">

    <!-- ==========================================
         HEADER
    =========================================== -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1
                        style="
                            color:#0b3d91;
                            font-weight:700;
                        "
                    >

                        <i class="fas fa-edit mr-2"></i>

                        Lanjutkan Draft Pengajuan

                    </h1>

                </div>


                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('dashboard-mahasiswa') ?>">

                                Dashboard

                            </a>

                        </li>

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('mahasiswa/ticket/draft') ?>">

                                Draft Pengajuan

                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            Edit Draft

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>



    <!-- ==========================================
         MAIN CONTENT
    =========================================== -->

    <section class="content">

        <div class="container-fluid">

            <div class="row justify-content-center">

                <div class="col-lg-8 col-md-10">


                    <!-- ==========================================
                         CARD
                    =========================================== -->

                    <div
                        class="card shadow-sm"
                        style="
                            border-top:5px solid #0b3d91;
                            border-radius:15px;
                        "
                    >


                        <!-- ==========================================
                             CARD HEADER
                        =========================================== -->

                        <div
                            class="card-header"
                            style="
                                background:#0b3d91;
                                color:white;
                            "
                        >

                            <h3 class="card-title">

                                <i class="fas fa-file-alt mr-2"></i>

                                Edit Draft Pengajuan

                            </h3>

                        </div>



                        <!-- ==========================================
                             CARD BODY
                        =========================================== -->

                        <div class="card-body">


                            <!-- ==========================================
                                 SUCCESS MESSAGE
                            =========================================== -->

                            <?php if (session()->getFlashdata('success')): ?>

                                <div
                                    class="alert alert-success alert-dismissible fade show"
                                >

                                    <i
                                        class="fas fa-check-circle mr-2"
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



                            <!-- ==========================================
                                 ERROR MESSAGE
                            =========================================== -->

                            <?php if (session()->getFlashdata('error')): ?>

                                <div
                                    class="alert alert-danger alert-dismissible fade show"
                                >

                                    <i
                                        class="fas fa-exclamation-circle mr-2"
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



                            <!-- ==========================================
                                 FORM

                                 PENTING:
                                 enctype diperlukan agar upload
                                 dokumen dapat diproses.
                            =========================================== -->

                            <form
                                action="<?= base_url(
                                    'mahasiswa/ticket/draft/update/' .
                                    ($draft_id ?? 0)
                                ) ?>"
                                method="post"
                                enctype="multipart/form-data"
                            >

                                <?= csrf_field() ?>



                                <!-- ==========================================
                                     NOMOR DRAFT
                                =========================================== -->

                                <div class="mb-4">

                                    <label
                                        class="form-label font-weight-bold"
                                    >

                                        Nomor Draft

                                    </label>


                                    <input
                                        type="text"
                                        class="form-control"
                                        value="<?= esc(
                                            $draft['nomor'] ?? '-'
                                        ) ?>"
                                        readonly
                                    >

                                </div>



                                <!-- ==========================================
                                     UNIT LAYANAN
                                =========================================== -->

                               <div class="form-group">

    <label
        for="unit_layanan"
        class="font-weight-bold"
    >

        Unit Layanan

        <span class="text-danger">

            *

        </span>

    </label>


    <select
        name="unit_layanan"
        id="unit_layanan"
        class="form-control"
        required
    >

        <option value="">

            -- Pilih Unit Layanan --

        </option>


        <?php
        $unitLayananSaatIni =
            $draft['unit_layanan']
            ?? '';
        ?>


        <option
            value="Akademik"
            <?= $unitLayananSaatIni === 'Akademik'
                ? 'selected'
                : '' ?>
        >

            Akademik

        </option>


        <option
            value="Kemahasiswaan"
            <?= $unitLayananSaatIni === 'Kemahasiswaan'
                ? 'selected'
                : '' ?>
        >

            Kemahasiswaan

        </option>


        <option
            value="Keuangan"
            <?= $unitLayananSaatIni === 'Keuangan'
                ? 'selected'
                : '' ?>
        >

            Keuangan

        </option>


        <option
            value="Direktorat"
            <?= $unitLayananSaatIni === 'Direktorat'
                ? 'selected'
                : '' ?>
        >

            Direktorat

        </option>


        <option
            value="Humas"
            <?= $unitLayananSaatIni === 'Humas'
                ? 'selected'
                : '' ?>
        >

            Humas

        </option>


        <option
            value="Perpustakaan"
            <?= $unitLayananSaatIni === 'Perpustakaan'
                ? 'selected'
                : '' ?>
        >

            Perpustakaan

        </option>


        <option
            value="SPI"
            <?= $unitLayananSaatIni === 'SPI'
                ? 'selected'
                : '' ?>
        >

            SPI

        </option>


        <option
            value="UPT Bahasa"
            <?= $unitLayananSaatIni === 'UPT Bahasa'
                ? 'selected'
                : '' ?>
        >

            UPT Bahasa

        </option>


        <option
            value="UPT K3"
            <?= $unitLayananSaatIni === 'UPT K3'
                ? 'selected'
                : '' ?>
        >

            UPT K3

        </option>


        <option
            value="UPT TIK"
            <?= $unitLayananSaatIni === 'UPT TIK'
                ? 'selected'
                : '' ?>
        >

            UPT TIK

        </option>

    </select>

</div>
                                <!-- ==========================================
                                     JENIS LAYANAN
                                =========================================== -->

                               <div class="form-group">

    <label
        for="layanan"
        class="font-weight-bold"
    >

        Jenis Layanan

        <span class="text-danger">

            *

        </span>

    </label>


    <select
        name="layanan"
        id="layanan"
        class="form-control"
        required
    >

        <option value="">

            -- Pilih Jenis Layanan --

        </option>

    </select>

</div>
                                <!-- ==========================================
                                     KETERANGAN
                                =========================================== -->

                                <div class="mb-4">

                                    <label
                                        for="keterangan"
                                        class="form-label font-weight-bold"
                                    >

                                        Keterangan / Detail Permohonan

                                        <span class="text-danger">
                                            *
                                        </span>

                                    </label>


                                    <textarea
                                        name="keterangan"
                                        id="keterangan"
                                        class="form-control"
                                        rows="6"
                                        placeholder="Jelaskan detail permohonan layanan Anda..."
                                        required
                                    ><?= esc(
                                        $draft['keterangan'] ?? ''
                                    ) ?></textarea>

                                </div>



                                <!-- ==========================================
                                     DOKUMEN PENDUKUNG
                                =========================================== -->

                                <div class="mb-4">

                                    <label
                                        for="dokumen"
                                        class="form-label font-weight-bold"
                                    >

                                        Dokumen Pendukung

                                        <span class="text-muted">
                                            (Opsional)
                                        </span>

                                    </label>


                                    <input
                                        type="file"
                                        name="dokumen"
                                        id="dokumen"
                                        class="form-control"
                                        accept=".pdf,.jpg,.jpeg,.png,.doc,.docx"
                                    >


                                    <small
                                        class="form-text text-muted"
                                    >

                                        <i class="fas fa-info-circle mr-1"></i>

                                        Maksimal ukuran file:

                                        <strong>
                                            2 MB
                                        </strong>

                                        <br>

                                        Format yang diperbolehkan:

                                        PDF, JPG, JPEG, PNG, DOC, DOCX.

                                    </small>



                                    <!-- ======================================
                                         FILE LAMA
                                    ======================================= -->

                                    <?php if (
                                        !empty(
                                            $draft['dokumen']
                                            ?? null
                                        )
                                    ): ?>

                                        <div
                                            class="mt-3 p-3"
                                            style="
                                                background:#f5f8fc;
                                                border-left:4px solid #0b3d91;
                                                border-radius:5px;
                                            "
                                        >

                                            <div
                                                class="font-weight-bold"
                                                style="
                                                    color:#0b3d91;
                                                "
                                            >

                                                <i
                                                    class="fas fa-file-alt mr-1"
                                                ></i>

                                                Dokumen Saat Ini

                                            </div>


                                            <div class="mt-2">

                                                <span
                                                    class="text-muted"
                                                >

                                                    <?= esc(
                                                        basename(
                                                            $draft['dokumen']
                                                        )
                                                    ) ?>

                                                </span>


                                                <a
                                                    href="<?= base_url(
                                                        'uploads/dokumen/' .
                                                        $draft['dokumen']
                                                    ) ?>"
                                                    target="_blank"
                                                    class="btn btn-sm btn-primary ml-2"
                                                >

                                                    <i
                                                        class="fas fa-eye mr-1"
                                                    ></i>

                                                    Lihat Dokumen

                                                </a>

                                            </div>

                                        </div>

                                    <?php endif; ?>

                                </div>



                                <!-- ==========================================
                                     STATUS
                                =========================================== -->

                                <div class="mb-4">

                                    <label
                                        class="form-label font-weight-bold"
                                    >

                                        Status Draft

                                    </label>


                                    <div>

                                        <span
                                            class="badge badge-secondary"
                                            style="
                                                font-size:14px;
                                            "
                                        >

                                            <i
                                                class="fas fa-file-alt mr-1"
                                            ></i>

                                            Draft

                                        </span>

                                    </div>

                                </div>



                                <!-- ==========================================
                                     BUTTON
                                =========================================== -->

                                <div
                                    class="
                                        d-flex
                                        justify-content-between
                                        flex-wrap
                                        mt-4
                                    "
                                >


                                    <!-- KEMBALI -->

                                    <a
                                        href="<?= base_url(
                                            'mahasiswa/ticket/draft'
                                        ) ?>"
                                        class="btn btn-secondary"
                                    >

                                        <i
                                            class="fas fa-arrow-left mr-1"
                                        ></i>

                                        Kembali

                                    </a>



                                    <div
                                        class="
                                            d-flex
                                            flex-wrap
                                        "
                                    >


                                        <!-- SIMPAN PERUBAHAN -->

                                        <button
                                            type="submit"
                                            name="action"
                                            value="draft"
                                            class="btn mr-2"
                                            style="
                                                background:#f28c28;
                                                color:white;
                                                font-weight:600;
                                            "
                                        >

                                            <i
                                                class="fas fa-save mr-1"
                                            ></i>

                                            Simpan Perubahan

                                        </button>



                                        <!-- KIRIM PENGAJUAN -->

                                        <button
                                            type="submit"
                                            name="action"
                                            value="submit"
                                            class="btn btn-success"
                                        >

                                            <i
                                                class="fas fa-paper-plane mr-1"
                                            ></i>

                                            Kirim Pengajuan

                                        </button>


                                    </div>


                                </div>


                            </form>


                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {

        const unitLayanan =
            document.getElementById(
                'unit_layanan'
            );

        const layanan =
            document.getElementById(
                'layanan'
            );


        const layananSaatIni =
            <?= json_encode(
                $draft['layanan']
                ?? ''
            ) ?>;


        const unitLayananSaatIni =
            <?= json_encode(
                $draft['unit_layanan']
                ?? ''
            ) ?>;


        const daftarLayanan = {

            "Akademik": [

                "Surat Aktif Kuliah",
                "Surat Keterangan Mahasiswa",
                "Legalisir Ijazah",
                "Legalisir Transkrip Nilai",
                "Surat Keterangan Lulus",
                "Surat Keterangan Cuti Akademik",
                "Surat Keterangan Pengunduran Diri",
                "Perubahan Data Akademik",
                "Informasi KRS/KHS",
                "Informasi Jadwal Kuliah",
                "Informasi Nilai"

            ],


            "Kemahasiswaan": [

                "Surat Beasiswa",
                "Pengajuan Beasiswa",
                "Surat Keterangan Tidak Menerima Beasiswa",
                "Surat Keterangan Organisasi Mahasiswa",
                "Surat Keterangan Kegiatan Kemahasiswaan",
                "Pengajuan Kegiatan Mahasiswa",
                "Informasi UKM",
                "Informasi Organisasi Kemahasiswaan",
                "Konsultasi Kemahasiswaan"

            ],


            "Keuangan": [

                "Informasi UKT/SPP",
                "Informasi Pembayaran Kuliah",
                "Konfirmasi Pembayaran",
                "Permohonan Pengembalian Dana",
                "Informasi Tagihan",
                "Permohonan Keringanan Biaya Pendidikan",
                "Informasi Administrasi Keuangan"

            ],


            "Direktorat": [

                "Surat Permohonan Resmi",
                "Surat Pengantar",
                "Surat Rekomendasi",
                "Permohonan Tanda Tangan Pimpinan",
                "Permohonan Pengesahan Dokumen",
                "Informasi Kebijakan Institusi",
                "Informasi Administrasi Direktorat"

            ],


            "Humas": [

                "Informasi Publikasi",
                "Permohonan Informasi",
                "Permohonan Dokumentasi",
                "Permohonan Publikasi Kegiatan",
                "Kerja Sama dan Kemitraan",
                "Permohonan Media/Publikasi",
                "Informasi Kegiatan Institusi"

            ],


            "Perpustakaan": [

                "Peminjaman Buku",
                "Pengembalian Buku",
                "Perpanjangan Peminjaman",
                "Informasi Koleksi Buku",
                "Akses E-Book",
                "Akses Jurnal",
                "Surat Bebas Pustaka",
                "Denda Keterlambatan",
                "Keanggotaan Perpustakaan"

            ],


            "SPI": [

                "Pengaduan Pelanggaran",
                "Pengaduan Gratifikasi",
                "Laporan Dugaan Penyimpangan",
                "Konsultasi Pengawasan Internal",
                "Informasi Pengawasan Internal"

            ],


            "UPT Bahasa": [

                "Pendaftaran Tes Bahasa",
                "Informasi Tes Bahasa",
                "Sertifikat Kemampuan Bahasa",
                "Kursus Bahasa",
                "Pelatihan Bahasa",
                "Konsultasi Bahasa",
                "Penerjemahan Dokumen"

            ],


            "UPT K3": [

                "Pelaporan Kondisi Tidak Aman",
                "Pelaporan Kecelakaan Kerja",
                "Konsultasi Keselamatan dan Kesehatan Kerja",
                "Informasi K3",
                "Pelaporan Keadaan Darurat",
                "Pemeriksaan Kesehatan/Keselamatan",
                "Informasi Prosedur K3"

            ],


            "UPT TIK": [

                "Masalah Akun SIAKAD",
                "Masalah Login Sistem",
                "Reset Password",
                "Permasalahan Wi-Fi/Internet",
                "Permasalahan Email Institusi",
                "Permasalahan Sistem Informasi",
                "Permasalahan Akses Aplikasi",
                "Bantuan Teknologi Informasi"

            ]

        };


        function isiJenisLayanan(
            unit,
            layananTerpilih = ''
        ) {

            layanan.innerHTML = '';


            if (
                !unit ||
                !daftarLayanan[
                    unit
                ]
            ) {

                layanan.disabled =
                    true;


                const option =
                    document.createElement(
                        'option'
                    );


                option.value =
                    '';


                option.textContent =
                    '-- Pilih Unit Layanan Terlebih Dahulu --';


                layanan.appendChild(
                    option
                );


                return;

            }


            layanan.disabled =
                false;


            const defaultOption =
                document.createElement(
                    'option'
                );


            defaultOption.value =
                '';


            defaultOption.textContent =
                '-- Pilih Jenis Layanan --';


            layanan.appendChild(
                defaultOption
            );


            daftarLayanan[
                unit
            ].forEach(
                function (namaLayanan) {

                    const option =
                        document.createElement(
                            'option'
                        );


                    option.value =
                        namaLayanan;


                    option.textContent =
                        namaLayanan;


                    if (
                        namaLayanan ===
                        layananTerpilih
                    ) {

                        option.selected =
                            true;

                    }


                    layanan.appendChild(
                        option
                    );

                }
            );

        }


        unitLayanan.addEventListener(
            'change',
            function () {

                isiJenisLayanan(
                    this.value
                );

            }
        );


        // =====================================================
        // SAAT EDIT DRAFT DIBUKA
        // LANGSUNG TAMPILKAN JENIS LAYANAN LAMA
        // =====================================================

        isiJenisLayanan(
            unitLayananSaatIni,
            layananSaatIni
        );

    }
);

</script>

<?= $this->include('layouts/footer') ?>