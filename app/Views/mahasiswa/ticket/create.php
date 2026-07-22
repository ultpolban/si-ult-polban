<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- ============================= -->
    <!-- HEADER -->
    <!-- ============================= -->

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>
                        <i class="fas fa-plus-circle text-danger"></i>
                        Ajukan Layanan
                    </h1>

                </div>

                <div class="col-sm-6">

                    <ol class="breadcrumb float-sm-right">

                        <li class="breadcrumb-item">

                            <a href="<?= base_url('dashboard-mahasiswa') ?>">

                                Dashboard Mahasiswa

                            </a>

                        </li>

                        <li class="breadcrumb-item active">

                            Ajukan Layanan

                        </li>

                    </ol>

                </div>

            </div>

        </div>

    </section>


    <!-- ============================= -->
    <!-- CONTENT -->
    <!-- ============================= -->

    <section class="content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-lg-8">

                    <div class="card shadow-sm">

                        <!-- CARD HEADER -->

                        <div class="card-header bg-danger text-white">

                            <h3 class="card-title mb-0">

                                <i class="fas fa-file-alt mr-2"></i>

                                Form Pengajuan Layanan

                            </h3>

                        </div>


                        <!-- FORM -->

                        <form
                            action="<?= base_url('mahasiswa/ticket/store') ?>"
                            method="post"
                            enctype="multipart/form-data"
                        >

                            <div class="card-body">


                                <!-- NAMA -->

                                <div class="form-group mb-3">

                                    <label>

                                        <i class="fas fa-user text-danger"></i>

                                        Nama Pemohon

                                    </label>

                                    <input
                                        type="text"
                                        name="nama"
                                        class="form-control"
                                        value="<?= $user['nama'] ?>"
                                        readonly
                                    >

                                </div>


                                <!-- NIM -->

                                <div class="form-group mb-3">

                                    <label>

                                        <i class="fas fa-id-card text-danger"></i>

                                        NIM

                                    </label>

                                    <input
                                        type="text"
                                        name="nim"
                                        class="form-control"
                                        value="<?= $user['nim'] ?>"
                                        readonly
                                    >

                                </div>


                                <!-- PROGRAM STUDI -->

                                <div class="form-group mb-3">

                                    <label>

                                        <i class="fas fa-graduation-cap text-danger"></i>

                                        Program Studi

                                    </label>

                                    <input
                                        type="text"
                                        name="prodi"
                                        class="form-control"
                                        value="<?= $user['prodi'] ?? 'D3 Teknik Informatika' ?>"
                                        readonly
                                    >

                                </div>


                                <!-- JENIS LAYANAN -->

                                <div class="form-group mb-3">

                                    <label>

                                        <i class="fas fa-list text-danger"></i>

                                        Jenis Layanan

                                    </label>

                                    <select
                                        name="service"
                                        class="form-control"
                                        required
                                    >

                                        <option value="">

                                            -- Pilih Layanan --

                                        </option>

                                        <?php if (isset($services) && !empty($services)): ?>

                                            <?php foreach ($services as $service): ?>

                                                <option
                                                    value="<?= esc($service['nama']) ?>"
                                                >

                                                    <?= esc($service['nama']) ?>

                                                </option>

                                            <?php endforeach; ?>

                                        <?php else: ?>

                                            <option value="Surat Aktif Kuliah">

                                                Surat Aktif Kuliah

                                            </option>

                                            <option value="Surat Beasiswa">

                                                Surat Beasiswa

                                            </option>

                                            <option value="Legalisir Transkrip">

                                                Legalisir Transkrip

                                            </option>

                                            <option value="Surat Keterangan">

                                                Surat Keterangan

                                            </option>

                                        <?php endif; ?>

                                    </select>

                                </div>


                                <!-- KETERANGAN -->

                                <div class="form-group mb-3">

                                    <label>

                                        <i class="fas fa-comment-alt text-danger"></i>

                                        Keterangan Pengajuan

                                    </label>

                                    <textarea
                                        name="catatan"
                                        class="form-control"
                                        rows="5"
                                        placeholder="Masukkan keterangan atau tujuan pengajuan layanan..."
                                        required
                                    ></textarea>

                                </div>


                                <!-- UPLOAD KTM -->

                                <div class="form-group mb-3">

                                    <label>

                                        <i class="fas fa-id-card text-danger"></i>

                                        Upload KTM

                                    </label>

                                    <input
                                        type="file"
                                        name="ktm"
                                        class="form-control"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                    >

                                    <small class="text-muted">

                                        Format yang diperbolehkan:
                                        PDF, JPG, JPEG, PNG.

                                    </small>

                                </div>


                                <!-- UPLOAD KRS -->

                                <div class="form-group mb-3">

                                    <label>

                                        <i class="fas fa-file-upload text-danger"></i>

                                        Upload KRS

                                    </label>

                                    <input
                                        type="file"
                                        name="krs"
                                        class="form-control"
                                        accept=".pdf,.jpg,.jpeg,.png"
                                    >

                                    <small class="text-muted">

                                        Format yang diperbolehkan:
                                        PDF, JPG, JPEG, PNG.

                                    </small>

                                </div>


                            </div>


                            <!-- CARD FOOTER -->

                            <div class="card-footer d-flex justify-content-between">

                                <a
                                    href="<?= base_url('dashboard-mahasiswa') ?>"
                                    class="btn btn-secondary"
                                >

                                    <i class="fas fa-arrow-left mr-1"></i>

                                    Kembali

                                </a>


                                <button
                                    type="submit"
                                    class="btn btn-danger"
                                >

                                    <i class="fas fa-paper-plane mr-1"></i>

                                    Kirim Pengajuan

                                </button>

                            </div>

                        </form>

                    </div>

                </div>


                <!-- ============================= -->
                <!-- INFORMASI -->
                <!-- ============================= -->

                <div class="col-lg-4">

                    <div class="card shadow-sm">

                        <div class="card-header bg-primary text-white">

                            <h3 class="card-title mb-0">

                                <i class="fas fa-info-circle mr-2"></i>

                                Informasi Pengajuan

                            </h3>

                        </div>

                        <div class="card-body">

                            <p>

                                Silakan lengkapi formulir pengajuan layanan
                                dengan data yang benar.

                            </p>

                            <hr>

                            <p class="mb-2">

                                <i class="fas fa-check-circle text-success mr-2"></i>

                                Pastikan layanan yang dipilih sudah sesuai.

                            </p>

                            <p class="mb-2">

                                <i class="fas fa-check-circle text-success mr-2"></i>

                                Isi keterangan pengajuan dengan jelas.

                            </p>

                            <p class="mb-2">

                                <i class="fas fa-check-circle text-success mr-2"></i>

                                Upload dokumen yang diperlukan.

                            </p>

                            <p class="mb-0">

                                <i class="fas fa-check-circle text-success mr-2"></i>

                                Periksa kembali data sebelum mengirim.

                            </p>

                        </div>

                    </div>


                    <!-- STATUS -->

                    <div class="card shadow-sm">

                        <div class="card-header bg-warning">

                            <h3 class="card-title mb-0">

                                <i class="fas fa-exclamation-circle mr-2"></i>

                                Perhatian

                            </h3>

                        </div>

                        <div class="card-body">

                            <p class="mb-0">

                                Setelah pengajuan dikirim, kamu dapat memantau
                                status pengajuan melalui menu

                                <b>Tracking Tiket</b>.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?= $this->include('layouts/footer') ?>