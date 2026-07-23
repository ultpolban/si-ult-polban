<?= $this->include('layouts/header') ?>
<?= $this->include('layouts/navbar') ?>
<?= $this->include('layouts/sidebar_mahasiswa') ?>

<div class="content-wrapper">

    <!-- HEADER -->
    <section class="content-header">

        <div class="container-fluid">

            <div class="row align-items-center">

                <div class="col-md-8">

                    <h1 class="page-title">

                        <i class="fas fa-plus-circle"></i>

                        Ajukan Layanan

                    </h1>

                    <p class="text-muted mb-0">

                        Silakan lengkapi formulir pengajuan layanan Anda.

                    </p>

                </div>

            </div>

        </div>

    </section>


    <!-- CONTENT -->
    <section class="content">

        <div class="container-fluid">

            <div class="card ticket-form-card shadow-sm">


                <!-- CARD HEADER -->

                <div class="card-header ticket-form-header">

                    <div>

                        <h3 class="card-title">

                            <i class="fas fa-file-signature"></i>

                            Form Pengajuan Layanan

                        </h3>

                        <p class="mb-0">

                            Pastikan data yang Anda masukkan sudah benar.

                        </p>

                    </div>

                </div>


                <!-- FORM -->

                <form
                    action="<?= base_url('mahasiswa/ticket/store') ?>"
                    method="post"
                    enctype="multipart/form-data"
                >

                    <?= csrf_field() ?>


                    <div class="card-body">


                        <!-- NAMA -->

                        <div class="form-group mb-4">

                            <label>

                                Nama Lengkap

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="<?= esc($user['nama'] ?? '') ?>"
                                readonly
                            >

                        </div>


                        <!-- NIM -->

                        <div class="form-group mb-4">

                            <label>

                                NIM

                                <span class="text-danger">*</span>

                            </label>

                            <input
                                type="text"
                                class="form-control"
                                value="<?= esc($user['nim'] ?? '') ?>"
                                readonly
                            >

                        </div>


                        <!-- JENIS LAYANAN -->

                        <div class="form-group mb-4">

                            <label>

                                Jenis Layanan

                                <span class="text-danger">*</span>

                            </label>

                            <select
                                name="layanan"
                                class="form-control"
                                required
                            >

                                <option value="">

                                    -- Pilih Jenis Layanan --

                                </option>

                                <option value="Surat Keterangan Aktif Kuliah">

                                    Surat Keterangan Aktif Kuliah

                                </option>

                                <option value="Legalisir Ijazah/Transkrip">

                                    Legalisir Ijazah/Transkrip

                                </option>

                                <option value="Verifikasi Alumni">

                                    Verifikasi Alumni

                                </option>

                                <option value="Konfirmasi Pembayaran">

                                    Konfirmasi Pembayaran

                                </option>

                                <option value="Permohonan Informasi Publik">

                                    Permohonan Informasi Publik

                                </option>

                                <option value="Pengaduan Layanan">

                                    Pengaduan Layanan

                                </option>

                                <option value="Permohonan Kunjungan">

                                    Permohonan Kunjungan

                                </option>

                                <option value="Bantuan Akses Sistem Informasi">

                                    Bantuan Akses Sistem Informasi

                                </option>

                                <option value="Layanan Kemahasiswaan">

                                    Layanan Kemahasiswaan

                                </option>

                                <option value="Layanan Akademik">

                                    Layanan Akademik

                                </option>

                            </select>

                        </div>


                        <!-- KETERANGAN -->

                        <div class="form-group mb-4">

                            <label>

                                Keterangan

                            </label>

                            <textarea
                                name="keterangan"
                                class="form-control"
                                rows="5"
                                placeholder="Masukkan keterangan pengajuan..."
                            ></textarea>

                        </div>


                        <!-- DOKUMEN -->

                        <div class="form-group mb-4">

                            <label>

                                Upload Dokumen

                                <span class="text-muted">

                                    (Opsional)

                                </span>

                            </label>

                            <input
                                type="file"
                                name="dokumen"
                                class="form-control"
                                accept=".pdf,.jpg,.jpeg,.png"
                            >

                            <small class="text-muted">

                                Dokumen bersifat opsional.
                                Format yang diperbolehkan: PDF, JPG, JPEG, PNG.

                            </small>

                        </div>


                        <!-- INFO -->

                        <div class="draft-info">

                            <i class="fas fa-info-circle"></i>

                            Anda dapat menyimpan pengajuan sebagai
                            <strong>Draft</strong> terlebih dahulu dan
                            mengirimkannya nanti.

                        </div>


                    </div>


                    <!-- FOOTER -->

                    <div class="card-footer ticket-form-footer">


                        <a
                            href="<?= base_url('dashboard-mahasiswa') ?>"
                            class="btn btn-secondary"
                        >

                            <i class="fas fa-arrow-left"></i>

                            Kembali

                        </a>


                        <div class="action-buttons">


                            <!-- SIMPAN DRAFT -->

                            <button
                                type="submit"
                                name="action"
                                value="draft"
                                class="btn btn-outline-primary"
                            >

                                <i class="fas fa-save"></i>

                                Simpan Draft

                            </button>


                            <!-- SUBMIT -->

                            <button
                                type="submit"
                                name="action"
                                value="submit"
                                class="btn btn-primary"
                            >

                                <i class="fas fa-paper-plane"></i>

                                Kirim Pengajuan

                            </button>


                        </div>

                    </div>

                </form>

            </div>

        </div>

    </section>

</div>


<style>

/* ============================== */
/* TITLE */
/* ============================== */

.page-title {

    color: #0d47a1;

    font-weight: 700;

}


/* ============================== */
/* CARD */
/* ============================== */

.ticket-form-card {

    border: none;

    border-radius: 14px;

    overflow: hidden;

}


/* ============================== */
/* HEADER */
/* ============================== */

.ticket-form-header {

    background: #0d47a1;

    color: white;

    padding: 20px 24px;

    border-bottom: 4px solid #f59e0b;

}


.ticket-form-header h3 {

    font-weight: 700;

}


.ticket-form-header p {

    opacity: 0.85;

    margin-top: 5px;

}


/* ============================== */
/* LABEL */
/* ============================== */

.form-group label {

    font-weight: 600;

    color: #172554;

    margin-bottom: 8px;

}


/* ============================== */
/* INPUT */
/* ============================== */

.form-control {

    border-radius: 8px;

    border: 1px solid #cbd5e1;

    padding: 10px 13px;

}


.form-control:focus {

    border-color: #0d47a1;

    box-shadow: 0 0 0 3px rgba(13, 71, 161, 0.12);

}


/* ============================== */
/* INFO */
/* ============================== */

.draft-info {

    background: #eff6ff;

    border-left: 4px solid #0d47a1;

    padding: 14px 16px;

    border-radius: 6px;

    color: #1e3a8a;

}


/* ============================== */
/* FOOTER */
/* ============================== */

.ticket-form-footer {

    display: flex;

    justify-content: space-between;

    align-items: center;

    padding: 18px 24px;

}


.action-buttons {

    display: flex;

    gap: 10px;

}


/* ============================== */
/* PRIMARY */
/* ============================== */

.btn-primary {

    background: #0d47a1;

    border-color: #0d47a1;

}


.btn-primary:hover {

    background: #f59e0b;

    border-color: #f59e0b;

}


/* ============================== */
/* RESPONSIVE */
/* ============================== */

@media (max-width: 576px) {

    .ticket-form-footer {

        flex-direction: column;

        gap: 15px;

        align-items: stretch;

    }


    .action-buttons {

        flex-direction: column;

    }


    .action-buttons button {

        width: 100%;

    }

}

</style>


<?= $this->include('layouts/footer') ?>